<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PatientDashboardController extends Controller
{
    protected function apiGet(string $endpoint)
    {
        $token = session('api_token');
        $response = Http::withToken($token)
            ->timeout(10)
            ->get(config('services.telemartmain.api_url') . $endpoint);

        if ($response->status() === 401) {
            session()->forget(['api_token', 'patient']);
            return null;
        }

        return $response->json();
    }

    protected function apiPut(string $endpoint, array $data)
    {
        $token = session('api_token');
        $response = Http::withToken($token)
            ->timeout(10)
            ->put(config('services.telemartmain.api_url') . $endpoint, $data);

        if ($response->status() === 401) {
            session()->forget(['api_token', 'patient']);
            return null;
        }

        return $response;
    }

    protected function apiPost(string $endpoint, array $data)
    {
        $token = session('api_token');
        $response = Http::withToken($token)
            ->timeout(10)
            ->post(config('services.telemartmain.api_url') . $endpoint, $data);

        if ($response->status() === 401) {
            session()->forget(['api_token', 'patient']);
            return null;
        }

        return $response;
    }

    public function index()
    {
        $stats = $this->apiGet('/patient/dashboard-stats');

        if ($stats === null) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        $familyData = $this->apiGet('/patient/family-members');
        $familyMembers = $familyData['members'] ?? [];

        $patient = session('patient');

        return view('patient.dashboard', compact('stats', 'patient', 'familyMembers'));
    }

    public function appointments()
    {
        $data = $this->apiGet('/patient/appointments');

        if ($data === null) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        $patient = session('patient');

        return view('patient.appointments', ['appointments' => $data['appointments'] ?? [], 'patient' => $patient]);
    }

    public function profile()
    {
        $data = $this->apiGet('/patient/profile');

        if ($data === null) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        return view('patient.profile', ['profile' => $data, 'patient' => session('patient')]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:500',
        ]);

        $response = $this->apiPut('/patient/profile', $request->only(['name', 'phone', 'date_of_birth', 'address', 'postal_code']));

        if ($response === null) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        if ($response->successful()) {
            $patientData = session('patient');
            $nameParts = explode(' ', $request->name, 2);
            $patientData['first_name'] = $nameParts[0];
            $patientData['last_name'] = $nameParts[1] ?? '';
            session(['patient' => $patientData]);

            return back()->with('success', 'Profile updated successfully.');
        }

        return back()->with('error', 'Failed to update profile. Please try again.');
    }

    public function bookAppointment(Request $request)
    {
        $data = $this->apiGet('/patient/doctors' . ($request->specialization ? '?specialization=' . urlencode($request->specialization) : ''));

        if ($data === null) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        // Get pre-selected doctor from consultation session data
        $consultationData = session('consultation_data');
        $preSelectedDoctorId = $consultationData['doctor_id'] ?? null;

        return view('patient.book-appointment', [
            'doctors' => $data['doctors'] ?? [],
            'specializations' => $data['specializations'] ?? [],
            'selectedSpecialization' => $request->specialization,
            'patient' => session('patient'),
            'preSelectedDoctorId' => $preSelectedDoctorId,
            'hasConsultation' => !empty($consultationData),
        ]);
    }

    public function getDoctorSlots(Request $request)
    {
        if (!$request->doctor_id || !$request->date) {
            return response()->json(['slots' => []]);
        }

        $data = $this->apiGet('/patient/doctors/' . $request->doctor_id . '/slots?date=' . $request->date);

        if ($data === null) {
            return response()->json(['error' => 'Session expired'], 401);
        }

        return response()->json($data);
    }

    public function storeAppointment(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'reason' => 'nullable|string|max:1000',
        ]);

        $token = session('api_token');
        $consultationData = session('consultation_data');

        // If consultation data exists in session, submit it first
        if ($consultationData) {
            $http = Http::withToken($token)->timeout(30);

            // Attach stored health record files
            if (!empty($consultationData['health_records'])) {
                foreach ($consultationData['health_records'] as $file) {
                    $filePath = storage_path('app/private/' . $file['path']);
                    if (file_exists($filePath)) {
                        $http = $http->attach(
                            'health_records[]',
                            file_get_contents($filePath),
                            $file['name']
                        );
                    }
                }
            }

            $consultPayload = $consultationData;
            $consultPayload['doctor_id'] = $request->doctor_id;
            unset($consultPayload['health_records']);

            $consultResponse = $http->post(config('services.telemartmain.api_url') . '/patient/consultations', $consultPayload);

            if ($consultResponse->status() === 401) {
                session()->forget(['api_token', 'patient']);
                return redirect()->route('login')->with('error', 'Session expired. Please login again.');
            }

            // Clean up temp files
            if (!empty($consultationData['health_records'])) {
                foreach ($consultationData['health_records'] as $file) {
                    $filePath = storage_path('app/private/' . $file['path']);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }

            session()->forget('consultation_data');
        }

        // Book the appointment
        $response = $this->apiPost('/patient/appointments', [
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'reason' => $request->reason,
        ]);

        if ($response === null) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        if ($response->successful()) {
            return redirect()->route('patient.appointments')->with('success', 'Appointment booked successfully!');
        }

        $message = $response->json('message', 'Failed to book appointment. Please try again.');
        return back()->with('error', $message)->withInput();
    }

    public function medicalRecords()
    {
        $data = $this->apiGet('/patient/medical-records');

        if ($data === null) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        return view('patient.medical-records', [
            'records' => $data['records'] ?? [],
            'recordTypes' => $data['record_types'] ?? [],
            'patient' => session('patient'),
        ]);
    }

    public function addMedicalRecord()
    {
        $data = $this->apiGet('/patient/medical-records');

        if ($data === null) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        return view('patient.add-medical-record', [
            'recordTypes' => $data['record_types'] ?? [],
            'patient' => session('patient'),
        ]);
    }

    public function storeMedicalRecord(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'record_type' => 'required|string',
            'record_date' => 'required|date',
            'description' => 'nullable|string|max:2000',
            'notes' => 'nullable|string|max:1000',
            'attachments' => 'nullable|array|max:5',
            'attachments.*' => 'file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        ]);

        $token = session('api_token');

        $http = Http::withToken($token)->timeout(30);

        // Attach files if present
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $http = $http->attach(
                    'attachments[]',
                    file_get_contents($file->getRealPath()),
                    $file->getClientOriginalName()
                );
            }
        }

        $response = $http->post(config('services.telemartmain.api_url') . '/patient/medical-records', [
            'title' => $request->title,
            'record_type' => $request->record_type,
            'record_date' => $request->record_date,
            'description' => $request->description,
            'notes' => $request->notes,
        ]);

        if ($response->status() === 401) {
            session()->forget(['api_token', 'patient']);
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        if ($response->successful()) {
            return redirect()->route('patient.medical-records')->with('success', 'Medical record added successfully!');
        }

        $message = $response->json('message', 'Failed to add medical record.');
        return back()->with('error', $message)->withInput();
    }

    public function downloadAttachment($record, $index)
    {
        $token = session('api_token');

        $response = Http::withToken($token)
            ->timeout(30)
            ->get(config('services.telemartmain.api_url') . "/patient/medical-records/{$record}/download/{$index}");

        if ($response->status() === 401) {
            session()->forget(['api_token', 'patient']);
            return redirect()->route('login')->with('error', 'Session expired.');
        }

        if (!$response->successful()) {
            return back()->with('error', 'Failed to download file.');
        }

        $contentDisposition = $response->header('Content-Disposition');
        $filename = 'attachment';
        if ($contentDisposition && preg_match('/filename="?([^";\n]+)/', $contentDisposition, $matches)) {
            $filename = $matches[1];
        }

        return response($response->body(), 200)
            ->header('Content-Type', $response->header('Content-Type'))
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function consultation()
    {
        $data = $this->apiGet('/patient/doctors');

        if ($data === null) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        return view('patient.consultation', [
            'doctors' => $data['doctors'] ?? [],
            'patient' => session('patient'),
        ]);
    }

    public function consultationsList()
    {
        $data = $this->apiGet('/patient/consultations');

        if ($data === null) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        return view('patient.consultations-list', [
            'consultations' => $data['consultations'] ?? [],
            'patient' => session('patient'),
        ]);
    }

    public function showConsultation($id)
    {
        $data = $this->apiGet('/patient/consultations/' . $id);

        if ($data === null) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        return view('patient.consultation-show', [
            'consultation' => $data['consultation'] ?? [],
            'patient' => session('patient'),
        ]);
    }

    public function editConsultation($id)
    {
        $data = $this->apiGet('/patient/consultations/' . $id);

        if ($data === null) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        $consultation = $data['consultation'] ?? [];

        if (($consultation['status'] ?? '') !== 'pending') {
            return redirect()->route('patient.consultation.show', $id)
                ->with('error', 'Only pending consultations can be edited.');
        }

        $doctorsData = $this->apiGet('/patient/doctors');

        return view('patient.consultation', [
            'doctors' => $doctorsData['doctors'] ?? [],
            'patient' => session('patient'),
            'consultation' => $consultation,
            'editMode' => true,
        ]);
    }

    public function updateConsultation(Request $request, $id)
    {
        $request->validate([
            'is_followup' => 'required|in:0,1',
            'chief_complaints' => 'required|json',
            'patient_history' => 'nullable|json',
            'personal_history' => 'nullable|json',
            'family_history' => 'nullable|json',
            'allergies' => 'nullable|json',
            'medications' => 'nullable|json',
            'location_preference' => 'nullable|string',
            'state' => 'nullable|string',
            'opd' => 'nullable|string',
            'doctor_id' => 'nullable|integer',
            'query' => 'required|string|max:1500',
            'health_records' => 'nullable|array|max:5',
            'health_records.*' => 'file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        ]);

        $token = session('api_token');
        $http = Http::withToken($token)->timeout(30);

        // Attach health record files if any
        if ($request->hasFile('health_records')) {
            foreach ($request->file('health_records') as $file) {
                $http = $http->attach(
                    'health_records[]',
                    file_get_contents($file->getRealPath()),
                    $file->getClientOriginalName()
                );
            }
        }

        $response = $http->put(config('services.telemartmain.api_url') . '/patient/consultations/' . $id, [
            'is_followup' => (bool) $request->is_followup,
            'chief_complaints' => json_decode($request->chief_complaints, true),
            'patient_history' => json_decode($request->patient_history ?? '[]', true),
            'personal_history' => json_decode($request->personal_history ?? '{}', true),
            'family_history' => json_decode($request->family_history ?? '[]', true),
            'allergies' => json_decode($request->allergies ?? '[]', true),
            'medications' => json_decode($request->medications ?? '[]', true),
            'location_preference' => $request->location_preference,
            'state' => $request->state,
            'opd' => $request->opd,
            'doctor_id' => $request->doctor_id,
            'query' => $request->input('query'),
        ]);

        if ($response->status() === 401) {
            session()->forget(['api_token', 'patient']);
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        if ($response->successful()) {
            return redirect()->route('patient.consultation.show', $id)
                ->with('success', 'Consultation updated successfully!');
        }

        $message = $response->json('message', 'Failed to update consultation.');
        return back()->with('error', $message)->withInput();
    }

    public function storeConsultation(Request $request)
    {
        $request->validate([
            'is_followup' => 'required|in:0,1',
            'chief_complaints' => 'required|json',
            'patient_history' => 'nullable|json',
            'personal_history' => 'nullable|json',
            'family_history' => 'nullable|json',
            'allergies' => 'nullable|json',
            'medications' => 'nullable|json',
            'location_preference' => 'nullable|string',
            'state' => 'nullable|string',
            'opd' => 'nullable|string',
            'doctor_id' => 'nullable|integer',
            'query' => 'required|string|max:1500',
            'health_records' => 'nullable|array|max:5',
            'health_records.*' => 'file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        ]);

        // Store uploaded files temporarily
        $uploadedFiles = [];
        if ($request->hasFile('health_records')) {
            foreach ($request->file('health_records') as $file) {
                $path = $file->store('temp/health_records', 'local');
                $uploadedFiles[] = [
                    'path' => $path,
                    'name' => $file->getClientOriginalName(),
                ];
            }
        }

        // Save consultation data to session
        session([
            'consultation_data' => [
                'is_followup' => (bool) $request->is_followup,
                'chief_complaints' => json_decode($request->chief_complaints, true),
                'patient_history' => json_decode($request->patient_history ?? '[]', true),
                'personal_history' => json_decode($request->personal_history ?? '{}', true),
                'family_history' => json_decode($request->family_history ?? '[]', true),
                'allergies' => json_decode($request->allergies ?? '[]', true),
                'medications' => json_decode($request->medications ?? '[]', true),
                'location_preference' => $request->location_preference,
                'state' => $request->state,
                'opd' => $request->opd,
                'doctor_id' => $request->doctor_id,
                'query' => $request->input('query'),
                'health_records' => $uploadedFiles,
            ],
        ]);

        return redirect()->route('patient.book-appointment')
            ->with('success', 'Consultation saved! Now select a doctor and book your appointment.');
    }

    public function prescriptions()
    {
        $data = $this->apiGet('/patient/prescriptions');

        if ($data === null) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        $patient = session('patient');

        return view('patient.prescriptions', ['prescriptions' => $data['prescriptions'] ?? [], 'patient' => $patient]);
    }

    public function prescriptionPdf($id)
    {
        $token = session('api_token');
        $response = Http::withToken($token)
            ->timeout(30)
            ->get(config('services.telemartmain.api_url') . '/patient/prescriptions/' . $id . '/pdf');

        if ($response->status() === 401) {
            session()->forget(['api_token', 'patient']);
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        if (!$response->successful()) {
            return back()->with('error', 'Failed to download prescription PDF.');
        }

        $filename = 'Prescription-' . $id . '.pdf';
        $contentDisposition = $response->header('Content-Disposition');
        if ($contentDisposition && preg_match('/filename="?([^"]+)"?/', $contentDisposition, $matches)) {
            $filename = $matches[1];
        }

        return response($response->body(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function invoicePdf($id)
    {
        $token = session('api_token');
        $response = Http::withToken($token)
            ->timeout(30)
            ->get(config('services.telemartmain.api_url') . '/patient/appointments/' . $id . '/invoice-pdf');

        if ($response->status() === 401) {
            session()->forget(['api_token', 'patient']);
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        if (!$response->successful()) {
            return back()->with('error', 'Failed to download invoice PDF.');
        }

        $filename = 'Invoice-' . $id . '.pdf';
        $contentDisposition = $response->header('Content-Disposition');
        if ($contentDisposition && preg_match('/filename="?([^"]+)"?/', $contentDisposition, $matches)) {
            $filename = $matches[1];
        }

        return response($response->body(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function familyMembers()
    {
        $data = $this->apiGet('/patient/family-members');

        if ($data === null) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        return view('patient.family-members', [
            'members' => $data['members'] ?? [],
            'patient' => session('patient'),
        ]);
    }

    public function storeFamilyMember(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'relationship' => 'required|string|max:100',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'phone' => 'nullable|string|max:15',
            'blood_group' => 'nullable|string|max:10',
        ]);

        $response = $this->apiPost('/patient/family-members', $request->only([
            'first_name', 'last_name', 'relationship', 'date_of_birth',
            'gender', 'phone', 'blood_group',
        ]));

        if ($response === null) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        if ($response->successful()) {
            return back()->with('success', 'Family member added successfully!');
        }

        $message = $response->json('message', 'Failed to add family member.');
        return back()->with('error', $message)->withInput();
    }

    public function updateFamilyMember(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'relationship' => 'required|string|max:100',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'phone' => 'nullable|string|max:15',
            'blood_group' => 'nullable|string|max:10',
        ]);

        $response = $this->apiPut('/patient/family-members/' . $id, $request->only([
            'first_name', 'last_name', 'relationship', 'date_of_birth',
            'gender', 'phone', 'blood_group',
        ]));

        if ($response === null) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        if ($response->successful()) {
            return back()->with('success', 'Family member updated successfully!');
        }

        $message = $response->json('message', 'Failed to update family member.');
        return back()->with('error', $message)->withInput();
    }

    public function deleteFamilyMember($id)
    {
        $token = session('api_token');
        $response = Http::withToken($token)
            ->timeout(10)
            ->delete(config('services.telemartmain.api_url') . '/patient/family-members/' . $id);

        if ($response->status() === 401) {
            session()->forget(['api_token', 'patient']);
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        if ($response->successful()) {
            return back()->with('success', 'Family member removed successfully!');
        }

        $message = $response->json('message', 'Failed to remove family member.');
        return back()->with('error', $message);
    }
}
