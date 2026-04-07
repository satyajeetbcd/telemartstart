<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\OpdTimingController;
use App\Http\Controllers\PageController;

// Public routes
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/opd-timings', [OpdTimingController::class, 'index'])->name('opd-timings');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/how-it-works', [PageController::class, 'howItWorks'])->name('how-it-works');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected patient routes
Route::middleware('api.token')->prefix('patient')->name('patient.')->group(function () {
    Route::get('/dashboard', [PatientDashboardController::class, 'index'])->name('dashboard');
    Route::get('/appointments', [PatientDashboardController::class, 'appointments'])->name('appointments');
    Route::get('/book-appointment', [PatientDashboardController::class, 'bookAppointment'])->name('book-appointment');
    Route::get('/book-appointment/slots', [PatientDashboardController::class, 'getDoctorSlots'])->name('book-appointment.slots');
    Route::post('/book-appointment', [PatientDashboardController::class, 'storeAppointment'])->name('book-appointment.store');
    Route::get('/profile', [PatientDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [PatientDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::get('/medical-records', [PatientDashboardController::class, 'medicalRecords'])->name('medical-records');
    Route::get('/medical-records/add', [PatientDashboardController::class, 'addMedicalRecord'])->name('medical-records.add');
    Route::post('/medical-records', [PatientDashboardController::class, 'storeMedicalRecord'])->name('medical-records.store');
    Route::get('/medical-records/{record}/download/{index}', [PatientDashboardController::class, 'downloadAttachment'])->name('medical-records.download');
    Route::get('/prescriptions', [PatientDashboardController::class, 'prescriptions'])->name('prescriptions');
    Route::get('/appointments/{id}/invoice-pdf', [PatientDashboardController::class, 'invoicePdf'])->name('appointments.invoice-pdf');
    Route::get('/prescriptions/{id}/pdf', [PatientDashboardController::class, 'prescriptionPdf'])->name('prescriptions.pdf');
    Route::get('/consultation', [PatientDashboardController::class, 'consultation'])->name('consultation');
    Route::post('/consultation', [PatientDashboardController::class, 'storeConsultation'])->name('consultation.store');
    Route::get('/consultations', [PatientDashboardController::class, 'consultationsList'])->name('consultations');
    Route::get('/consultations/{id}', [PatientDashboardController::class, 'showConsultation'])->name('consultation.show');
    Route::get('/consultations/{id}/edit', [PatientDashboardController::class, 'editConsultation'])->name('consultation.edit');
    Route::put('/consultations/{id}', [PatientDashboardController::class, 'updateConsultation'])->name('consultation.update');
    Route::get('/family-members', [PatientDashboardController::class, 'familyMembers'])->name('family-members');
    Route::post('/family-members', [PatientDashboardController::class, 'storeFamilyMember'])->name('family-members.store');
    Route::put('/family-members/{id}', [PatientDashboardController::class, 'updateFamilyMember'])->name('family-members.update');
    Route::delete('/family-members/{id}', [PatientDashboardController::class, 'deleteFamilyMember'])->name('family-members.delete');
});
