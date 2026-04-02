@extends('layouts.patient')

@section('title', 'Consultation Details')

@section('content')
<div class="max-w-4xl mx-auto">

    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('patient.consultations') }}" class="inline-flex items-center text-gray-600 hover:text-green-700 font-medium text-sm">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Consultations
        </a>
    </div>

    @if(session('success'))
        <div style="background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 12px 16px; margin-bottom: 16px;">
            <p style="color: #166534; font-size: 0.875rem; font-weight: 500;">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div style="background-color: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; padding: 12px 16px; margin-bottom: 16px;">
            <p style="color: #991b1b; font-size: 0.875rem; font-weight: 500;">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Header -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-4">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 style="font-size: 1.5rem; font-weight: 700; color: #111827; margin: 0;">Consultation Details</h2>
                <p style="color: #6b7280; font-size: 0.875rem; margin-top: 4px;">{{ $consultation['consultation_number'] ?? '' }}</p>
            </div>
            <div style="display: flex; gap: 8px;">
                @if(($consultation['status'] ?? '') === 'pending')
                    <a href="{{ route('patient.consultation.edit', $consultation['id']) }}"
                       style="display: inline-flex; align-items: center; padding: 8px 20px; background-color: #16a34a; color: #ffffff; font-size: 0.875rem; font-weight: 600; border-radius: 8px; text-decoration: none;">
                        Edit Consultation
                    </a>
                @endif
            </div>
        </div>
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-top: 20px;">
            <div>
                <p style="font-size: 0.75rem; font-weight: 500; color: #9ca3af; text-transform: uppercase;">Doctor</p>
                <p style="font-size: 0.875rem; color: #111827; margin-top: 4px;">{{ $consultation['doctor_name'] !== 'Unassigned' ? 'Dr. ' . $consultation['doctor_name'] : 'Unassigned' }}</p>
            </div>
            <div>
                <p style="font-size: 0.75rem; font-weight: 500; color: #9ca3af; text-transform: uppercase;">Status</p>
                <div style="margin-top: 4px;">
                    @php
                        $cStatusStyles = [
                            'pending' => 'background-color: #fef9c3; color: #854d0e;',
                            'in_review' => 'background-color: #dbeafe; color: #1e40af;',
                            'completed' => 'background-color: #dcfce7; color: #166534;',
                            'cancelled' => 'background-color: #fee2e2; color: #991b1b;',
                        ];
                        $cStyle = $cStatusStyles[$consultation['status'] ?? ''] ?? 'background-color: #f3f4f6; color: #374151;';
                    @endphp
                    <span class="px-2 py-1 text-xs font-semibold rounded-full" style="{{ $cStyle }}">
                        {{ ucfirst(str_replace('_', ' ', $consultation['status'] ?? 'N/A')) }}
                    </span>
                    @if($consultation['is_followup'] ?? false)
                        <span class="px-2 py-1 text-xs font-semibold rounded-full" style="background-color: #f3e8ff; color: #7c3aed; margin-left: 4px;">Follow-up</span>
                    @endif
                </div>
            </div>
            <div>
                <p style="font-size: 0.75rem; font-weight: 500; color: #9ca3af; text-transform: uppercase;">Date</p>
                <p style="font-size: 0.875rem; color: #111827; margin-top: 4px;">{{ $consultation['date'] ?? 'N/A' }}</p>
            </div>
            <div>
                <p style="font-size: 0.75rem; font-weight: 500; color: #9ca3af; text-transform: uppercase;">Type</p>
                <p style="font-size: 0.875rem; color: #111827; margin-top: 4px;">{{ ($consultation['is_followup'] ?? false) ? 'Follow-up' : 'New Consultation' }}</p>
            </div>
        </div>
    </div>

    <!-- Query -->
    @if(!empty($consultation['query']))
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-4">
        <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0 0 12px 0;">Patient Query</h3>
        <p style="font-size: 0.875rem; color: #374151; background-color: #eff6ff; padding: 16px; border-radius: 8px; line-height: 1.6;">{{ $consultation['query'] }}</p>
    </div>
    @endif

    <!-- Chief Complaints -->
    @if(!empty($consultation['chief_complaints']))
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-4">
        <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0 0 16px 0;">Chief Complaints</h3>
        <div style="display: flex; flex-direction: column; gap: 12px;">
            @foreach($consultation['chief_complaints'] as $complaint)
            <div style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 16px;">
                <h4 style="font-weight: 600; color: #16a34a; font-size: 0.875rem; margin: 0 0 8px 0;">{{ $complaint['name'] ?? 'Unknown' }}</h4>
                @if(!empty($complaint['sub_answers']))
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                    @foreach($complaint['sub_answers'] as $key => $answer)
                    <div style="background-color: #f9fafb; border-radius: 6px; padding: 8px 12px;">
                        <span style="font-size: 0.75rem; font-weight: 500; color: #9ca3af; text-transform: capitalize;">{{ str_replace('_', ' ', $key) }}</span>
                        <p style="font-size: 0.875rem; color: #111827; margin: 2px 0 0 0;">
                            @if(is_array($answer))
                                {{ implode(', ', $answer) }}
                            @else
                                {{ $answer }}
                            @endif
                        </p>
                    </div>
                    @endforeach
                </div>
                @else
                <p style="font-size: 0.75rem; color: #9ca3af; font-style: italic;">No assessment answers recorded</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- History -->
    @php
        $hasHistory = !empty($consultation['patient_history']) ||
                      !empty($consultation['family_history']) ||
                      (!empty($consultation['personal_history']) && collect($consultation['personal_history'])->filter(fn($v) => $v !== null)->count() > 0) ||
                      !empty($consultation['allergies']);
    @endphp
    @if($hasHistory)
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-4">
        <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0 0 16px 0;">History</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            @if(!empty($consultation['patient_history']))
            <div>
                <h4 style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin: 0 0 8px 0;">Patient History</h4>
                <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                    @foreach($consultation['patient_history'] as $item)
                        <span style="padding: 4px 10px; background-color: #fff7ed; color: #c2410c; font-size: 0.75rem; border-radius: 9999px; font-weight: 500;">{{ $item }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            @if(!empty($consultation['family_history']))
            <div>
                <h4 style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin: 0 0 8px 0;">Family History</h4>
                <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                    @foreach($consultation['family_history'] as $item)
                        <span style="padding: 4px 10px; background-color: #fef2f2; color: #b91c1c; font-size: 0.75rem; border-radius: 9999px; font-weight: 500;">{{ $item }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            @if(!empty($consultation['personal_history']) && is_array($consultation['personal_history']))
            <div>
                <h4 style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin: 0 0 8px 0;">Personal History</h4>
                <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                    @foreach($consultation['personal_history'] as $key => $value)
                        @if($value !== null)
                        <span style="padding: 4px 10px; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; {{ $value ? 'background-color: #fef2f2; color: #b91c1c;' : 'background-color: #f0fdf4; color: #166534;' }}">
                            {{ ucfirst($key) }}: {{ $value ? 'Yes' : 'No' }}
                        </span>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

            @if(!empty($consultation['allergies']))
            <div>
                <h4 style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin: 0 0 8px 0;">Allergies</h4>
                <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                    @foreach($consultation['allergies'] as $item)
                        <span style="padding: 4px 10px; background-color: #fefce8; color: #a16207; font-size: 0.75rem; border-radius: 9999px; font-weight: 500;">{{ $item }}</span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Medications -->
    @php $hasMeds = !empty($consultation['medications']) && collect($consultation['medications'])->filter(fn($m) => !empty($m['name'] ?? null))->count() > 0; @endphp
    @if($hasMeds)
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-4">
        <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0 0 16px 0;">Active Medications</h3>
        <div class="overflow-x-auto">
            <table class="w-full" style="font-size: 0.875rem;">
                <thead style="background-color: #f9fafb;">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase" style="color: #6b7280;">Medicine</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase" style="color: #6b7280;">Dose</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase" style="color: #6b7280;">Frequency</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase" style="color: #6b7280;">Duration</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consultation['medications'] as $med)
                        @if(!empty($med['name'] ?? null))
                        <tr style="border-bottom: 1px solid #f3f4f6;">
                            <td class="px-4 py-3 font-medium" style="color: #111827;">{{ $med['name'] }}</td>
                            <td class="px-4 py-3" style="color: #6b7280;">{{ $med['dose'] ?? '-' }}</td>
                            <td class="px-4 py-3" style="color: #6b7280;">{{ $med['frequency'] ?? '-' }}</td>
                            <td class="px-4 py-3" style="color: #6b7280;">{{ ($med['duration_value'] ?? '') . ' ' . ($med['duration_type'] ?? '') }}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Location -->
    @if(!empty($consultation['location_preference']) || !empty($consultation['state']) || !empty($consultation['opd']))
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-4">
        <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0 0 16px 0;">Location Preference</h3>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
            @if(!empty($consultation['location_preference']))
            <div>
                <p style="font-size: 0.75rem; font-weight: 500; color: #9ca3af;">Preference</p>
                <p style="font-size: 0.875rem; color: #111827; margin-top: 4px;">{{ ucfirst(str_replace('_', ' ', $consultation['location_preference'])) }}</p>
            </div>
            @endif
            @if(!empty($consultation['state']))
            <div>
                <p style="font-size: 0.75rem; font-weight: 500; color: #9ca3af;">State/UT</p>
                <p style="font-size: 0.875rem; color: #111827; margin-top: 4px;">{{ $consultation['state'] }}</p>
            </div>
            @endif
            @if(!empty($consultation['opd']))
            <div>
                <p style="font-size: 0.75rem; font-weight: 500; color: #9ca3af;">OPD</p>
                <p style="font-size: 0.875rem; color: #111827; margin-top: 4px;">{{ $consultation['opd'] }}</p>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Health Records -->
    @if(!empty($consultation['health_records']))
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-4">
        <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0 0 16px 0;">Uploaded Health Records</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
            @foreach($consultation['health_records'] as $file)
            <div style="display: flex; align-items: center; padding: 12px; background-color: #f9fafb; border-radius: 8px;">
                <svg class="w-5 h-5" style="color: #6b7280; margin-right: 12px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                </svg>
                <div>
                    <p style="font-size: 0.875rem; font-weight: 500; color: #111827;">{{ $file['name'] ?? 'File' }}</p>
                    @if(isset($file['size']))
                        <p style="font-size: 0.75rem; color: #9ca3af;">{{ number_format($file['size'] / 1024, 1) }} KB</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
