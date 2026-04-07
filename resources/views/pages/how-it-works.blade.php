@extends('layouts.public')

@section('title', 'How It Works - Tele Health Mart')

@section('content')

<!-- Page Hero -->
<section class="bg-gradient-to-br from-brand-50 via-white to-brand-50 py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <span class="inline-block px-4 py-1 bg-brand-100 text-brand-700 rounded-full text-sm font-medium mb-4">Simple Process</span>
        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">How It Works</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Get started with your online consultation in just 4 easy steps. It's simple, fast, and convenient.</p>
    </div>
</section>

<!-- Steps Section -->
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Step 1 -->
            <div class="text-center relative">
                <div class="w-16 h-16 bg-brand-600 rounded-full flex items-center justify-center mx-auto mb-5 text-white text-xl font-bold shadow-lg shadow-brand-600/30">1</div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Register</h3>
                <p class="text-gray-600 text-sm">Create your account with basic details like name, email, and phone number.</p>
                <!-- Arrow (hidden on mobile) -->
                <div class="hidden lg:block absolute top-8 left-[60%] w-[80%]">
                    <svg class="w-full h-4 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 200 20">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M0 10h180M170 4l10 6-10 6" stroke-dasharray="6 4"/>
                    </svg>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="text-center relative">
                <div class="w-16 h-16 bg-brand-600 rounded-full flex items-center justify-center mx-auto mb-5 text-white text-xl font-bold shadow-lg shadow-brand-600/30">2</div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Find a Doctor</h3>
                <p class="text-gray-600 text-sm">Browse specialists, check their qualifications, ratings, and availability.</p>
                <div class="hidden lg:block absolute top-8 left-[60%] w-[80%]">
                    <svg class="w-full h-4 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 200 20">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M0 10h180M170 4l10 6-10 6" stroke-dasharray="6 4"/>
                    </svg>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="text-center relative">
                <div class="w-16 h-16 bg-brand-600 rounded-full flex items-center justify-center mx-auto mb-5 text-white text-xl font-bold shadow-lg shadow-brand-600/30">3</div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Book Appointment</h3>
                <p class="text-gray-600 text-sm">Select a convenient date and time slot and confirm your appointment.</p>
                <div class="hidden lg:block absolute top-8 left-[60%] w-[80%]">
                    <svg class="w-full h-4 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 200 20">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M0 10h180M170 4l10 6-10 6" stroke-dasharray="6 4"/>
                    </svg>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="text-center">
                <div class="w-16 h-16 bg-brand-600 rounded-full flex items-center justify-center mx-auto mb-5 text-white text-xl font-bold shadow-lg shadow-brand-600/30">4</div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Consult Online</h3>
                <p class="text-gray-600 text-sm">Join the video call at your appointment time and get your prescription.</p>
            </div>
        </div>
    </div>
</section>

<!-- Detailed Steps -->
<section class="py-16 lg:py-24 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 space-y-16">
        <!-- Detail 1 -->
        <div class="flex flex-col md:flex-row items-center gap-8">
            <div class="w-24 h-24 bg-brand-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                <svg class="w-12 h-12 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Step 1: Create Your Account</h3>
                <p class="text-gray-600">Sign up in minutes with your basic details. We only ask for your name, email, phone number, and a password. Your information is kept secure and private at all times.</p>
            </div>
        </div>

        <!-- Detail 2 -->
        <div class="flex flex-col md:flex-row items-center gap-8">
            <div class="w-24 h-24 bg-blue-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Step 2: Find the Right Doctor</h3>
                <p class="text-gray-600">Browse our network of verified and licensed doctors. Filter by specialization, check OPD timings, and view doctor profiles to find the best match for your healthcare needs.</p>
            </div>
        </div>

        <!-- Detail 3 -->
        <div class="flex flex-col md:flex-row items-center gap-8">
            <div class="w-24 h-24 bg-teal-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                <svg class="w-12 h-12 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Step 3: Book Your Appointment</h3>
                <p class="text-gray-600">Choose a convenient date and time slot from the doctor's available schedule. Get instant confirmation and reminders so you never miss your appointment.</p>
            </div>
        </div>

        <!-- Detail 4 -->
        <div class="flex flex-col md:flex-row items-center gap-8">
            <div class="w-24 h-24 bg-purple-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Step 4: Consult & Get Prescription</h3>
                <p class="text-gray-600">Join your video or audio consultation at the scheduled time. After the consultation, receive your e-prescription instantly which you can download and share with any pharmacy.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-gradient-to-r from-brand-600 to-brand-700 py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Ready to Get Started?</h2>
        <p class="text-brand-100 text-lg mb-8">Register now and book your first consultation in minutes.</p>
        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-brand-700 rounded-lg font-bold text-lg hover:bg-brand-50 transition shadow-lg">
            Register Now
        </a>
    </div>
</section>

@endsection
