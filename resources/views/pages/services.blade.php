@extends('layouts.public')

@section('title', 'Our Services - Telehealth Mart')

@section('content')

<!-- Page Hero -->
<section class="bg-gradient-to-br from-brand-50 via-white to-brand-50 py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <span class="inline-block px-4 py-1 bg-brand-100 text-brand-700 rounded-full text-sm font-medium mb-4">What We Offer</span>
        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Our Services</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Supporting better healthcare access through reliable and easy-to-use telemedicine services. Connect with qualified doctors across India through simple and affordable online consultations.</p>
    </div>
</section>

<!-- Services Grid -->
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service 1: OPD Consultation -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-lg transition-shadow p-6 group">
                <div class="w-14 h-14 bg-brand-50 rounded-xl flex items-center justify-center mb-5 group-hover:bg-brand-100 transition">
                    <svg class="w-7 h-7 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">OPD Consultation</h3>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">Consult qualified general physicians through secure video or audio calls. Patients in small towns and rural areas can receive primary medical advice without travelling to bigger cities.</p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-center"><svg class="w-4 h-4 text-brand-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Video & Audio Consultation</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-brand-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Instant E-Prescription</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-brand-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Follow-up Support</li>
                </ul>
            </div>

            <!-- Service 2: Specialist Consultation -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-lg transition-shadow p-6 group">
                <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center mb-5 group-hover:bg-blue-100 transition">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Specialist Consultation</h3>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">Connect with experienced specialists across India including cardiologists, dermatologists, pediatricians and more. Get expert opinions even when specialists are not available locally.</p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-center"><svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Cardiology & Dermatology</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Pediatrics & Gynecology</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Orthopedics & ENT</li>
                </ul>
            </div>

            <!-- Service 3: E-Prescriptions -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-lg transition-shadow p-6 group">
                <div class="w-14 h-14 bg-purple-50 rounded-xl flex items-center justify-center mb-5 group-hover:bg-purple-100 transition">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">E-Prescriptions</h3>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">Receive digital prescriptions after your consultation. Easy to download, share, and use at nearby pharmacies for convenient treatment.</p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-center"><svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Digital Prescription PDF</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Share with Any Pharmacy</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Access Anytime, Anywhere</li>
                </ul>
            </div>

            <!-- Service 4: Health Records -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-lg transition-shadow p-6 group">
                <div class="w-14 h-14 bg-orange-50 rounded-xl flex items-center justify-center mb-5 group-hover:bg-orange-100 transition">
                    <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Health Records</h3>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">Store medical reports, prescriptions, and consultation history in one secure place. Access your records anytime for better continuity of care.</p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-center"><svg class="w-4 h-4 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Secure Cloud Storage</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Upload Reports & Scans</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Share with Doctors</li>
                </ul>
            </div>

            <!-- Service 5: Appointment Booking -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-lg transition-shadow p-6 group">
                <div class="w-14 h-14 bg-teal-50 rounded-xl flex items-center justify-center mb-5 group-hover:bg-teal-100 transition">
                    <svg class="w-7 h-7 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Appointment Booking</h3>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">Book consultations with available doctors through a simple scheduling system. Choose a convenient time slot based on your availability.</p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-center"><svg class="w-4 h-4 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Real-time Slot Availability</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Flexible Scheduling</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Instant Confirmation</li>
                </ul>
            </div>

            <!-- Service 6: Follow-up Care -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-lg transition-shadow p-6 group">
                <div class="w-14 h-14 bg-red-50 rounded-xl flex items-center justify-center mb-5 group-hover:bg-red-100 transition">
                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Follow-up Care</h3>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">Schedule follow-up consultations to monitor progress and adjust treatment when needed. Ensures continuous care without repeated travel.</p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-center"><svg class="w-4 h-4 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Treatment Progress Tracking</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Easy Re-booking</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Continuous Doctor Support</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-gradient-to-r from-brand-600 to-brand-700 py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Start Your Health Journey Today</h2>
        <p class="text-brand-100 text-lg mb-2">Register with Telehealth Mart and connect with experienced doctors across India through simple online consultations.</p>
        <p class="text-brand-200 text-base mb-8">आज ही पंजीकरण करें और घर बैठे डॉक्टर से परामर्श प्राप्त करें।</p>
        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-brand-700 rounded-lg font-bold text-lg hover:bg-brand-50 transition shadow-lg">
            Book Consultation
        </a>
    </div>
</section>

@endsection
