@extends('layouts.public')

@section('title', 'About Us - Tele Health Mart')

@section('content')

<!-- Page Hero -->
<section class="bg-gradient-to-br from-brand-50 via-white to-brand-50 py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <span class="inline-block px-4 py-1 bg-brand-100 text-brand-700 rounded-full text-sm font-medium mb-4">About Us</span>
        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">About Tele Health Mart</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">We are committed to providing the highest quality telemedicine services with a focus on patient convenience and care.</p>
    </div>
</section>

<!-- Mission Section -->
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
                        <p class="text-2xl font-bold">24/7</p>
                        <p class="text-sm text-brand-100">Available</p>
                    </div>
                </div>
            </div>

            <!-- Right Content -->
            <div>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">Our Mission</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">Tele Health Mart is a trusted telemedicine platform that connects patients with verified and licensed doctors across India. Our mission is to make quality healthcare accessible, affordable, and convenient for everyone, regardless of their location.</p>
                <p class="text-gray-600 mb-8 leading-relaxed">We believe that everyone deserves access to quality healthcare. Through our platform, patients can consult with experienced doctors from the comfort of their homes, receive instant e-prescriptions, and manage their complete health records digitally.</p>

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
                        <p class="text-3xl font-bold text-brand-600">24/7</p>
                        <p class="text-sm text-gray-600 mt-1">Support Available</p>
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
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Why Choose Us?</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Here's what makes Tele Health Mart the preferred choice for online healthcare.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="w-12 h-12 bg-brand-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Verified & Licensed Doctors</h4>
                <p class="text-gray-600 text-sm">All doctors on our platform are verified with valid medical licenses and KYC documentation.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="w-12 h-12 bg-brand-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Secure & Private</h4>
                <p class="text-gray-600 text-sm">Your health data is encrypted and stored securely. We follow strict privacy guidelines.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="w-12 h-12 bg-brand-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Affordable Consultation</h4>
                <p class="text-gray-600 text-sm">Quality healthcare at affordable prices. No hidden charges or surprise fees.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="w-12 h-12 bg-brand-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Digital Prescriptions</h4>
                <p class="text-gray-600 text-sm">Get instant e-prescriptions that can be shared with any pharmacy digitally.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="w-12 h-12 bg-brand-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Multi-Language Support</h4>
                <p class="text-gray-600 text-sm">Access healthcare services in Hindi, English, and other regional languages.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="w-12 h-12 bg-brand-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Quick Turnaround</h4>
                <p class="text-gray-600 text-sm">Get your consultation within minutes. No long waiting rooms or travel time needed.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-gradient-to-r from-brand-600 to-brand-700 py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Join Thousands of Happy Patients</h2>
        <p class="text-brand-100 text-lg mb-8">Experience quality healthcare from the comfort of your home.</p>
        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-brand-700 rounded-lg font-bold text-lg hover:bg-brand-50 transition shadow-lg">
            Get Started Free
        </a>
    </div>
</section>

@endsection
