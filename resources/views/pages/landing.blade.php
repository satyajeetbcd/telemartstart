@extends('layouts.public')

@section('title', 'Tele Health Mart - Online Doctor Consultation')

@section('content')

<!-- Hero Section -->
<section class="bg-gradient-to-br from-brand-50 via-white to-brand-50 min-h-[80vh] flex items-center">
    <div class="max-w-7xl mx-auto px-4 py-16 lg:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div>
                <span class="inline-block px-4 py-1 bg-brand-100 text-brand-700 rounded-full text-sm font-medium mb-6">An Initiative by Nirmala Welfare Foundation</span>
                <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 leading-tight mb-6">
                    Connecting India to
                    <span class="text-brand-600">Better Healthcare</span>
                </h1>
                <p class="text-lg text-gray-600 leading-relaxed mb-8 max-w-lg">
                    Telehealth Mart connects experienced and qualified doctors across India with patients in Tier-3 cities, suburban, and rural areas. Through simple online consultations, patients can receive expert medical advice without travelling long distances.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 mb-8">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 bg-brand-600 text-white rounded-lg font-semibold hover:bg-brand-700 transition shadow-lg shadow-brand-600/30">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Book Consultation
                    </a>
                    <a href="#doctors" class="inline-flex items-center justify-center px-8 py-3 border-2 border-brand-600 text-brand-600 rounded-lg font-semibold hover:bg-brand-50 transition">
                        Meet Our Doctors
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </a>
                </div>
                <div class="flex items-center space-x-4 text-sm text-gray-500">
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full bg-brand-200 border-2 border-white flex items-center justify-center text-brand-700 text-xs font-bold">A</div>
                        <div class="w-8 h-8 rounded-full bg-blue-200 border-2 border-white flex items-center justify-center text-blue-700 text-xs font-bold">R</div>
                        <div class="w-8 h-8 rounded-full bg-purple-200 border-2 border-white flex items-center justify-center text-purple-700 text-xs font-bold">S</div>
                        <div class="w-8 h-8 rounded-full bg-orange-200 border-2 border-white flex items-center justify-center text-orange-700 text-xs font-bold">M</div>
                    </div>
                    <span>Trusted by <strong class="text-gray-700">10,000+</strong> patients across India</span>
                </div>
            </div>

            <!-- Right Illustration - Rotating Carousel -->
            <div class="hidden lg:flex flex-col items-center" x-data="{
                currentSlide: 0,
                totalSlides: 5,
                autoplayInterval: null,
                init() {
                    this.autoplayInterval = setInterval(() => {
                        this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                    }, 4000);
                },
                goToSlide(index) {
                    this.currentSlide = index;
                    clearInterval(this.autoplayInterval);
                    this.autoplayInterval = setInterval(() => {
                        this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                    }, 4000);
                }
            }">
                <div class="relative w-[28rem] h-[28rem]">

                    {{-- Slide 1: Video Consultation --}}
                    <div x-show="currentSlide === 0"
                         x-transition:enter="transition ease-out duration-700"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-500"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute inset-0">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <img src="{{ asset('images/banner/slide-1.jpg') }}"
                                 alt="Indian patient on a video consultation"
                                 onerror="this.onerror=null;this.src='{{ asset('images/logo.png') }}';this.classList.add('object-contain','p-16');"
                                 class="w-72 h-72 rounded-full object-cover shadow-xl ring-8 ring-white bg-brand-100">

                        </div>
                        <div class="absolute top-2 left-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Chat & Video</p>
                                <p class="text-xs text-gray-500">Consultation</p>
                            </div>
                        </div>
                        <div class="absolute top-2 right-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-brand-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Free of Cost</p>
                                <p class="text-xs text-gray-500">Telemedicine</p>
                            </div>
                        </div>
                        <div class="absolute bottom-6 left-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Real Time</p>
                                <p class="text-xs text-gray-500">Telemedicine</p>
                            </div>
                        </div>
                        <div class="absolute bottom-6 right-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">State Services</p>
                                <p class="text-xs text-gray-500">Doctors</p>
                            </div>
                        </div>
                    </div>

                    {{-- Slide 2: ABHA & Multilingual --}}
                    <div x-show="currentSlide === 1"
                         x-transition:enter="transition ease-out duration-700"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-500"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute inset-0">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <img src="{{ asset('images/banner/slide-2.jpg') }}"
                                 alt="Indian family accessing healthcare online"
                                 onerror="this.onerror=null;this.src='{{ asset('images/logo.png') }}';this.classList.add('object-contain','p-16');"
                                 class="w-72 h-72 rounded-full object-cover shadow-xl ring-8 ring-white bg-blue-100">
                        </div>
                        <div class="absolute top-2 left-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">ABHA</p>
                                <p class="text-xs text-gray-500">Integration</p>
                            </div>
                        </div>
                        <div class="absolute top-2 right-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Multilingual</p>
                                <p class="text-xs text-gray-500">Interface</p>
                            </div>
                        </div>
                        <div class="absolute bottom-6 left-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Consult Doctor</p>
                                <p class="text-xs text-gray-500">Remotely</p>
                            </div>
                        </div>
                        <div class="absolute bottom-6 right-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Allopathic & Ayush</p>
                                <p class="text-xs text-gray-500">Health Services</p>
                            </div>
                        </div>
                    </div>

                    {{-- Slide 3: Specialists & Prescriptions --}}
                    <div x-show="currentSlide === 2"
                         x-transition:enter="transition ease-out duration-700"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-500"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute inset-0">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <img src="{{ asset('images/banner/slide-3.jpg') }}"
                                 alt="Indian doctor reviewing a digital prescription"
                                 onerror="this.onerror=null;this.src='{{ asset('images/logo.png') }}';this.classList.add('object-contain','p-16');"
                                 class="w-72 h-72 rounded-full object-cover shadow-xl ring-8 ring-white bg-emerald-100">
                        </div>
                        <div class="absolute top-2 left-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Verified</p>
                                <p class="text-xs text-gray-500">Specialists</p>
                            </div>
                        </div>
                        <div class="absolute top-2 right-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">E-Prescriptions</p>
                                <p class="text-xs text-gray-500">Instant Digital Rx</p>
                            </div>
                        </div>
                        <div class="absolute bottom-6 left-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-cyan-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Health Records</p>
                                <p class="text-xs text-gray-500">Digital Storage</p>
                            </div>
                        </div>
                        <div class="absolute bottom-6 right-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-rose-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Follow-up</p>
                                <p class="text-xs text-gray-500">Care</p>
                            </div>
                        </div>
                    </div>

                    {{-- Slide 4: Pan-India Coverage --}}
                    <div x-show="currentSlide === 3"
                         x-transition:enter="transition ease-out duration-700"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-500"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute inset-0">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <img src="{{ asset('images/banner/slide-4.jpg') }}"
                                 alt="Healthcare reaching rural India"
                                 onerror="this.onerror=null;this.src='{{ asset('images/logo.png') }}';this.classList.add('object-contain','p-16');"
                                 class="w-72 h-72 rounded-full object-cover shadow-xl ring-8 ring-white bg-purple-100">
                        </div>
                        <div class="absolute top-2 left-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-violet-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">28+ States</p>
                                <p class="text-xs text-gray-500">Coverage</p>
                            </div>
                        </div>
                        <div class="absolute top-2 right-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-sky-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">50,000+</p>
                                <p class="text-xs text-gray-500">Consultations</p>
                            </div>
                        </div>
                        <div class="absolute bottom-6 left-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-lime-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-lime-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Rural Health</p>
                                <p class="text-xs text-gray-500">Reach</p>
                            </div>
                        </div>
                        <div class="absolute bottom-6 right-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Secure &</p>
                                <p class="text-xs text-gray-500">Private</p>
                            </div>
                        </div>
                    </div>

                    {{-- Slide 5: 24/7 Wellness --}}
                    <div x-show="currentSlide === 4"
                         x-transition:enter="transition ease-out duration-700"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-500"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute inset-0">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <img src="{{ asset('images/banner/slide-5.jpg') }}"
                                 alt="Indian senior receiving 24/7 telehealth care"
                                 onerror="this.onerror=null;this.src='{{ asset('images/logo.png') }}';this.classList.add('object-contain','p-16');"
                                 class="w-72 h-72 rounded-full object-cover shadow-xl ring-8 ring-white bg-orange-100">
                        </div>
                        <div class="absolute top-2 left-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">24/7</p>
                                <p class="text-xs text-gray-500">Available</p>
                            </div>
                        </div>
                        <div class="absolute top-2 right-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Affordable</p>
                                <p class="text-xs text-gray-500">Care</p>
                            </div>
                        </div>
                        <div class="absolute bottom-6 left-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Digital</p>
                                <p class="text-xs text-gray-500">Reports</p>
                            </div>
                        </div>
                        <div class="absolute bottom-6 right-0 bg-white rounded-xl shadow-lg p-3 flex items-center space-x-2 hero-badge">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Multi-Specialty</p>
                                <p class="text-xs text-gray-500">Services</p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Dot Indicators --}}
                <div class="flex justify-center space-x-2 mt-6">
                    <template x-for="i in totalSlides" :key="i">
                        <button @click="goToSlide(i - 1)"
                                :class="currentSlide === (i - 1) ? 'bg-brand-600 w-6' : 'bg-brand-300 w-2'"
                                class="h-2 rounded-full transition-all duration-300 hover:bg-brand-400">
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Counter Section -->
<section class="bg-brand-600 py-12 lg:py-16" x-data="{ shown: false }" x-intersect.once="shown = true">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
            <div x-data="{ count: 0, target: 50000 }" x-effect="if(shown) { let i = setInterval(() => { count += Math.ceil(target/60); if(count >= target) { count = target; clearInterval(i); } }, 30); }">
                <div class="text-3xl lg:text-4xl font-bold text-white" x-text="count.toLocaleString() + '+'">0+</div>
                <p class="text-brand-100 mt-2 text-sm lg:text-base">Consultations Done</p>
            </div>
            <div x-data="{ count: 0, target: 500 }" x-effect="if(shown) { let i = setInterval(() => { count += Math.ceil(target/60); if(count >= target) { count = target; clearInterval(i); } }, 30); }">
                <div class="text-3xl lg:text-4xl font-bold text-white" x-text="count.toLocaleString() + '+'">0+</div>
                <p class="text-brand-100 mt-2 text-sm lg:text-base">Verified Doctors</p>
            </div>
            <div x-data="{ count: 0, target: 10000 }" x-effect="if(shown) { let i = setInterval(() => { count += Math.ceil(target/60); if(count >= target) { count = target; clearInterval(i); } }, 30); }">
                <div class="text-3xl lg:text-4xl font-bold text-white" x-text="count.toLocaleString() + '+'">0+</div>
                <p class="text-brand-100 mt-2 text-sm lg:text-base">Happy Patients</p>
            </div>
            <div x-data="{ count: 0, target: 28 }" x-effect="if(shown) { let i = setInterval(() => { count += 1; if(count >= target) { count = target; clearInterval(i); } }, 60); }">
                <div class="text-3xl lg:text-4xl font-bold text-white" x-text="count + '+'">0+</div>
                <p class="text-brand-100 mt-2 text-sm lg:text-base">States Covered</p>
            </div>
        </div>
    </div>
</section>


<!-- How It Works Section -->
@php
    $journeySteps = [
        [
            'title' => 'Book Appointment',
            'hi'    => 'अपॉइंटमेंट बुक करें',
            'desc'  => 'Choose telemedicine, pick a date & time, and add your reason for the visit.',
            'icon'  => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
        ],
        [
            'title' => 'Register & Verify',
            'hi'    => 'पंजीकरण और सत्यापन',
            'desc'  => 'Sign up, verify your identity, and share your medical history & documents.',
            'icon'  => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
        ],
        [
            'title' => 'Consultation',
            'hi'    => 'परामर्श',
            'desc'  => 'Join the virtual call; the doctor reviews your symptoms & medical history.',
            'icon'  => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z',
        ],
        [
            'title' => 'Diagnosis & Plan',
            'hi'    => 'निदान और योजना',
            'desc'  => 'The doctor provides a diagnosis, a treatment plan, and your next steps.',
            'icon'  => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4',
        ],
        [
            'title' => 'Prescription & Advice',
            'hi'    => 'प्रिस्क्रिप्शन और सलाह',
            'desc'  => 'Get an e-prescription, lifestyle advice, and recommended tests if needed.',
            'icon'  => 'M9 12h6m-6 4h4m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
        ],
        [
            'title' => 'Medication & Follow Through',
            'hi'    => 'दवा और अनुवर्ती',
            'desc'  => 'Collect medicine or get home delivery, and follow the doctor’s instructions.',
            'icon'  => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
        ],
        [
            'title' => 'Monitor & Track',
            'hi'    => 'निगरानी और ट्रैकिंग',
            'desc'  => 'Track your health and share vitals or reports with your doctor as advised.',
            'icon'  => 'M3 3v18h18M18.7 8l-5.1 5.2-2.8-2.7L7 14.3',
        ],
        [
            'title' => 'Follow-up Consultation',
            'hi'    => 'फॉलो-अप परामर्श',
            'desc'  => 'Have a scheduled follow-up; the doctor reviews progress & adjusts treatment.',
            'icon'  => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-4 4v-4z',
        ],
        [
            'title' => 'Continuous Care',
            'hi'    => 'निरंतर देखभाल',
            'desc'  => 'Ongoing support for better health — reach a doctor whenever you need one.',
            'icon'  => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
        ],
    ];
@endphp
<section class="py-16 lg:py-24 bg-white" id="how-it-works">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10 lg:mb-14">
            <span class="inline-block px-4 py-1 bg-brand-100 text-brand-700 rounded-full text-sm font-medium mb-4">Simple Process</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">How Telemedicine Works</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Your complete telemedicine journey, from your first booking to continuous care.</p>
            <p class="text-gray-400 max-w-2xl mx-auto mt-2">पहली बुकिंग से लेकर निरंतर देखभाल तक — आपकी संपूर्ण टेलीमेडिसिन यात्रा।</p>
        </div>

        {{-- 9-step journey grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" x-data="{ shown: false }" x-intersect.once="shown = true">
            @foreach($journeySteps as $step)
            <div class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-700 ease-out overflow-hidden"
                 :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                 style="transition-delay: {{ ($loop->index) * 80 }}ms">
                {{-- Top accent bar --}}
                <div class="h-1.5 bg-gradient-to-r from-brand-400 via-brand-600 to-brand-700"></div>

                <div class="p-6">
                    {{-- Icon tile with numbered badge --}}
                    <div class="relative w-14 h-14 mb-5">
                        <div class="w-14 h-14 rounded-2xl bg-brand-50 flex items-center justify-center text-brand-600 group-hover:bg-brand-100 transition-colors">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}"/>
                            </svg>
                        </div>
                        <span class="absolute -top-2 -right-2 w-7 h-7 rounded-full bg-brand-600 text-white text-xs font-bold flex items-center justify-center shadow-md shadow-brand-600/40 ring-2 ring-white">{{ $loop->iteration }}</span>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-900">{{ $step['title'] }}</h3>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $step['hi'] }}</p>
                    <p class="text-sm text-gray-600 leading-relaxed mt-3">{{ $step['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Continuous Health Journey ribbon --}}
        <div class="mt-12 flex justify-center">
            <div class="inline-flex items-center gap-2.5 px-6 py-3 bg-brand-50 border border-brand-100 rounded-full shadow-sm">
                <svg class="w-5 h-5 text-brand-600 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
                </svg>
                <span class="text-sm font-semibold text-brand-700">Continuous Health Journey</span>
                <span class="hidden sm:inline text-xs text-brand-500">· निरंतर स्वास्थ्य यात्रा</span>
            </div>
        </div>

        {{-- Outcomes + trust bar --}}
        <div class="mt-10 rounded-2xl border border-gray-100 bg-gradient-to-r from-brand-50/60 via-white to-brand-50/60 shadow-sm p-6 flex flex-col lg:flex-row items-center justify-between gap-6">
            {{-- Outcome chips --}}
            <div class="flex flex-wrap items-center justify-center gap-2.5">
                @foreach(['Better Access' => 'बेहतर पहुँच', 'Timely Care' => 'समय पर देखभाल', 'Improved Health' => 'बेहतर स्वास्थ्य'] as $outcome => $outcomeHi)
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-white border border-brand-100 rounded-full text-sm font-medium text-gray-700 shadow-sm">
                    <svg class="w-4 h-4 text-brand-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ $outcome }}
                </span>
                @endforeach
            </div>

            {{-- Trust row --}}
            <div class="flex items-center gap-4 text-gray-500">
                <span class="hidden md:inline text-sm font-semibold text-gray-700">Secure • Private • Compliant</span>
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-label="Data encryption">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-label="Secure platform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-label="Privacy compliant">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
            </div>
        </div>
        <p class="text-center text-xs text-gray-400 mt-4">Your health information is safe and protected at every step. · आपकी स्वास्थ्य जानकारी हर चरण पर सुरक्षित रहती है।</p>
    </div>
</section>

<!-- Doctors Visiting Section -->
<section class="py-16 lg:py-24 bg-gradient-to-b from-white to-brand-50/40" id="doctors">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12 lg:mb-16">
            <span class="inline-block px-4 py-1 bg-brand-100 text-brand-700 rounded-full text-sm font-medium mb-4">Our Doctors</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Meet Our Verified Doctors</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Every doctor on Telehealth Mart is KYC-verified and available for secure online consultations.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($doctors as $doctor)
            <div class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden">
                {{-- Top accent bar --}}
                <div class="h-1.5 bg-gradient-to-r from-brand-400 via-brand-600 to-brand-700"></div>

                <div class="p-6">
                    {{-- Header row: doctor image (left, with availability dot) + TeleHealthMart logo (right) --}}
                    <div class="flex items-center justify-between mb-4">
                        <div class="relative shrink-0">
                            @if(!empty($doctor['profile_image']))
                                <img src="{{ $imageBaseUrl . ltrim($doctor['profile_image'], '/') }}"
                                     alt="{{ $doctor['name'] }}"
                                     onerror="this.onerror=null;this.style.display='none';this.nextElementSibling.style.display='flex';"
                                     style="width:84px;height:84px;"
                                     class="rounded-full object-cover ring-4 ring-brand-50 shadow-md bg-white">
                                <div style="width:84px;height:84px;display:none;" class="rounded-full ring-4 ring-brand-50 bg-gradient-to-br from-brand-100 to-brand-200 items-center justify-center text-3xl font-bold text-brand-700">
                                    {{ strtoupper(substr($doctor['name'], 0, 1)) }}
                                </div>
                            @else
                                <div style="width:84px;height:84px;" class="rounded-full ring-4 ring-brand-50 bg-gradient-to-br from-brand-100 to-brand-200 flex items-center justify-center text-3xl font-bold text-brand-700">
                                    {{ strtoupper(substr($doctor['name'], 0, 1)) }}
                                </div>
                            @endif
                            {{-- availability indicator --}}
                            <span class="absolute bottom-1 right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full" title="Available for consultation"></span>
                        </div>

                        <img src="{{ asset('images/logo.png') }}" alt="Telehealth Mart" style="height:38px;width:auto;">
                    </div>

                    {{-- Name + verified --}}
                    <div class="flex items-center gap-1.5">
                        <h3 class="text-xl font-bold text-gray-900">Dr. {{ $doctor['name'] }}</h3>
                        @if($doctor['verified'] ?? false)
                            <svg class="w-5 h-5 text-brand-600 shrink-0" viewBox="0 0 20 20" fill="currentColor" title="Verified">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </div>

                    {{-- Specialty + qualifications --}}
                    <div class="mt-2 flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-brand-50 text-brand-700 text-xs font-semibold rounded-full">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11a3 3 0 100-6 3 3 0 000 6zM5 11v3a5 5 0 0010 0M15 14a3 3 0 100 6 3 3 0 000-6z"/></svg>
                            {{ $doctor['specialization'] }}
                        </span>
                        @if(!empty($doctor['qualifications']))
                            <span class="text-gray-500 text-xs font-medium">{{ $doctor['qualifications'] }}</span>
                        @endif
                    </div>

                    {{-- Stats tiles --}}
                    <div class="mt-5 grid grid-cols-3 gap-2.5">
                        <div class="rounded-xl bg-brand-50/70 border border-brand-100/60 py-3 px-1 text-center">
                            <svg class="w-4 h-4 text-brand-500 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <p class="text-sm font-bold text-gray-900 leading-none">{{ $doctor['experience_years'] ?? '—' }}@if(!empty($doctor['experience_years']))+@endif</p>
                            <p class="text-[10px] text-gray-500 uppercase tracking-wide mt-1">Years</p>
                        </div>
                        <div class="rounded-xl bg-brand-50/70 border border-brand-100/60 py-3 px-1 text-center">
                            <svg class="w-4 h-4 text-brand-500 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            <p class="text-sm font-bold text-gray-900 leading-none">@if(!empty($doctor['consultation_fee']))₹{{ $doctor['consultation_fee'] }}@else—@endif</p>
                            <p class="text-[10px] text-gray-500 uppercase tracking-wide mt-1">Consult</p>
                        </div>
                        <div class="rounded-xl bg-green-50 border border-green-100 py-3 px-1 text-center">
                            <svg class="w-4 h-4 text-green-600 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <p class="text-sm font-bold text-green-700 leading-none">KYC</p>
                            <p class="text-[10px] text-gray-500 uppercase tracking-wide mt-1">Verified</p>
                        </div>
                    </div>

                    <a href="{{ route('register') }}" class="mt-5 group/btn flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-brand-600 to-brand-700 text-white rounded-xl text-sm font-semibold hover:from-brand-700 hover:to-brand-800 transition shadow-md shadow-brand-600/30">
                        Book Consultation
                        <svg class="w-4 h-4 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="w-16 h-16 bg-brand-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <p class="text-gray-500 font-medium">Verified doctors will appear here soon.</p>
                <p class="text-sm text-gray-400 mt-1">Our medical team is being onboarded and KYC-verified.</p>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('opd-timings') }}" class="inline-flex items-center px-6 py-3 border-2 border-brand-600 text-brand-600 rounded-lg font-semibold hover:bg-brand-50 transition">
                View All Doctors & OPD Timings
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-gradient-to-r from-brand-600 to-brand-700 py-16 lg:py-20">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">Start Your Health Journey Today</h2>
        <p class="text-brand-100 text-lg mb-2 max-w-2xl mx-auto">Register with Telehealth Mart and connect with experienced doctors across India through simple online consultations.</p>
        <p class="text-brand-200 text-base mb-8 max-w-2xl mx-auto">आज ही पंजीकरण करें और घर बैठे डॉक्टर से परामर्श प्राप्त करें।</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-brand-700 rounded-lg font-bold text-lg hover:bg-brand-50 transition shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Get Started Free
            </a>
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-white rounded-lg font-bold text-lg hover:bg-white/10 transition">
                Already have an account? Login
            </a>
        </div>
    </div>
</section>

@endsection
