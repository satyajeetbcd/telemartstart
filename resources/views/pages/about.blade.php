@extends('layouts.public')

@section('title', 'About Us - Telehealth Mart')

@section('content')

<!-- Page Hero -->
<section class="bg-gradient-to-br from-brand-50 via-white to-brand-50 py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <span class="inline-block px-4 py-1 bg-brand-100 text-brand-700 rounded-full text-sm font-medium mb-4">About Us</span>
        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Telehealth Mart: Consult Better. Live Healthier.</h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">An initiative by Nirmala Welfare Foundation to make quality healthcare accessible across India.</p>
    </div>
</section>

<!-- About Content Section -->
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Illustration -->
            <div class="flex justify-center">
                <div class="relative">
                    <div class="w-80 h-80 lg:w-96 lg:h-96 bg-brand-50 rounded-2xl flex items-center justify-center">
                        <svg class="w-48 h-48 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div class="absolute -bottom-4 -right-4 bg-brand-600 text-white rounded-xl p-4 shadow-lg">
                        <p class="text-2xl font-bold">NWF</p>
                        <p class="text-sm text-brand-100">Initiative</p>
                    </div>
                </div>
            </div>

            <!-- Right Content -->
            <div>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">Our Mission</h2>
                <p class="text-gray-600 mb-4 leading-relaxed">Telehealth Mart, an initiative by Nirmala Welfare Foundation, is a telehealth platform that connects experienced and qualified doctors across India with patients in suburban, Tier-3 cities, and rural areas through online consultations. Our goal is to make quality healthcare accessible without the need for long-distance travel, especially in regions where specialist care is limited.</p>
                <p class="text-gray-600 mb-4 leading-relaxed">In many smaller towns and villages, access to experienced doctors is still a challenge. Telehealth Mart helps bridge this gap by enabling patients to consult verified medical professionals using their mobile phone or computer. From general health concerns to specialist advice, patients can receive guidance from trusted doctors without leaving their locality.</p>
                <p class="text-gray-600 mb-4 leading-relaxed">We focus on improving accessibility, affordability, and convenience. Patients can book appointments, consult doctors online, share medical reports, and receive digital prescriptions in a simple and secure way. This helps save time, reduce travel expenses, and ensure timely medical support for families in underserved communities.</p>
                <p class="text-gray-600 mb-6 leading-relaxed">Designed to be easy to use and reliable, Telehealth Mart aims to extend quality healthcare services beyond major cities. By connecting doctors with patients across rural and semi-urban India, we are working towards improving healthcare access where it is needed the most.</p>

                <div class="grid grid-cols-2 gap-6">
                    <div class="text-center p-4 bg-brand-50 rounded-xl">
                        <p class="text-3xl font-bold text-brand-600">10,000+</p>
                        <p class="text-sm text-gray-600 mt-1">Happy Patients</p>
                    </div>
                    <div class="text-center p-4 bg-brand-50 rounded-xl">
                        <p class="text-3xl font-bold text-brand-600">500+</p>
                        <p class="text-sm text-gray-600 mt-1">Verified Doctors</p>
                    </div>
                    <div class="text-center p-4 bg-brand-50 rounded-xl">
                        <p class="text-3xl font-bold text-brand-600">20+</p>
                        <p class="text-sm text-gray-600 mt-1">Specializations</p>
                    </div>
                    <div class="text-center p-4 bg-brand-50 rounded-xl">
                        <p class="text-3xl font-bold text-brand-600">28+</p>
                        <p class="text-sm text-gray-600 mt-1">States Covered</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-16 lg:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Why Choose Us</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Telehealth Mart combines trusted doctors, simple technology, and affordable consultations.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="w-12 h-12 bg-brand-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Verified & Qualified Doctors</h4>
                <p class="text-gray-600 text-sm">Consult experienced doctors verified with valid credentials and professional qualifications across multiple specialties.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="w-12 h-12 bg-brand-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Secure & Private</h4>
                <p class="text-gray-600 text-sm">Your personal and medical information is kept safe. We follow secure systems to protect your privacy.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="w-12 h-12 bg-brand-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Affordable Consultation</h4>
                <p class="text-gray-600 text-sm">Access quality healthcare at reasonable consultation charges, suitable for families in smaller towns and villages.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="w-12 h-12 bg-brand-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Digital Prescriptions</h4>
                <p class="text-gray-600 text-sm">Receive prescriptions online after consultation. Easily share them with nearby pharmacies.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="w-12 h-12 bg-brand-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Multi-Language Support</h4>
                <p class="text-gray-600 text-sm">Consult doctors in Hindi, English, and other regional languages for better understanding and comfort.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="w-12 h-12 bg-brand-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Quick & Convenient Care</h4>
                <p class="text-gray-600 text-sm">Avoid long travel and waiting time. Get medical advice from home through simple online consultations.</p>
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
            Get Started Free
        </a>
    </div>
</section>

@endsection
