<!-- Top Info Bar -->
<div class="bg-brand-700 text-white text-sm hidden md:block">
    <div class="max-w-7xl mx-auto px-4 py-2 flex items-center justify-between">
        <div class="flex items-center space-x-6">
            <a href="tel:+911800111234" class="flex items-center space-x-1 hover:text-brand-200 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <span>1800-111-1234</span>
            </a>
            <a href="mailto:support@telehealthmart.com" class="flex items-center space-x-1 hover:text-brand-200 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span>support@telehealthmart.com</span>
            </a>
        </div>
        <div class="flex items-center space-x-4">
            <span>Follow us:</span>
            <a href="#" class="hover:text-brand-200 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            <a href="#" class="hover:text-brand-200 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
            </a>
            <a href="#" class="hover:text-brand-200 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.18-.357.295-.6.295l.213-3.053 5.56-5.023c.24-.213-.054-.334-.373-.121l-6.869 4.326-2.96-.924c-.64-.203-.658-.64.135-.954l11.566-4.458c.538-.196 1.006.128.828.94z"/></svg>
            </a>
        </div>
    </div>
</div>

<!-- Main Navigation -->
<nav class="bg-white shadow-md sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between h-20 lg:h-24">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center flex-shrink-0">
                <img src="{{ asset('images/logo.png') }}" alt="Tele Health Mart" class="h-16 lg:h-20 w-auto object-contain">
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-brand-600 font-medium transition {{ request()->routeIs('home') ? 'text-brand-600 border-b-2 border-brand-600 pb-1' : '' }}">Home</a>
                <a href="{{ route('services') }}" class="text-gray-700 hover:text-brand-600 font-medium transition {{ request()->routeIs('services') ? 'text-brand-600 border-b-2 border-brand-600 pb-1' : '' }}">Services</a>
                <a href="{{ route('how-it-works') }}" class="text-gray-700 hover:text-brand-600 font-medium transition {{ request()->routeIs('how-it-works') ? 'text-brand-600 border-b-2 border-brand-600 pb-1' : '' }}">How It Works</a>
                <a href="{{ route('about') }}" class="text-gray-700 hover:text-brand-600 font-medium transition {{ request()->routeIs('about') ? 'text-brand-600 border-b-2 border-brand-600 pb-1' : '' }}">About</a>
                <a href="{{ route('contact') }}" class="text-gray-700 hover:text-brand-600 font-medium transition {{ request()->routeIs('contact') ? 'text-brand-600 border-b-2 border-brand-600 pb-1' : '' }}">Contact</a>
                <a href="{{ route('opd-timings') }}" class="text-gray-700 hover:text-brand-600 font-medium transition {{ request()->routeIs('opd-timings') ? 'text-brand-600 border-b-2 border-brand-600 pb-1' : '' }}">OPD Timings</a>
            </div>

            <!-- Auth Buttons -->
            <div class="hidden lg:flex items-center space-x-3">
                @if(session('api_token'))
                    <a href="{{ route('patient.dashboard') }}" class="px-5 py-2 bg-brand-600 text-white rounded-lg font-medium hover:bg-brand-700 transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 border-2 border-brand-600 text-brand-600 rounded-lg font-medium hover:bg-brand-50 transition">
                        Patient Login
                    </a>
                    <a href="{{ config('services.telemartmain.admin_login_url') }}" target="_blank" class="px-5 py-2 border-2 border-blue-600 text-blue-600 rounded-lg font-medium hover:bg-blue-50 transition">
                        Doctor Login
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2 bg-brand-600 text-white rounded-lg font-medium hover:bg-brand-700 transition">
                        Register
                    </a>
                @endif
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-gray-700 hover:text-brand-600 transition">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden border-t border-gray-100 py-4" style="display: none;">
            <div class="space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-700 hover:bg-brand-50 hover:text-brand-600 rounded-lg transition">Home</a>
                <a href="{{ route('services') }}" class="block px-4 py-2 text-gray-700 hover:bg-brand-50 hover:text-brand-600 rounded-lg transition {{ request()->routeIs('services') ? 'bg-brand-50 text-brand-600' : '' }}">Services</a>
                <a href="{{ route('how-it-works') }}" class="block px-4 py-2 text-gray-700 hover:bg-brand-50 hover:text-brand-600 rounded-lg transition {{ request()->routeIs('how-it-works') ? 'bg-brand-50 text-brand-600' : '' }}">How It Works</a>
                <a href="{{ route('about') }}" class="block px-4 py-2 text-gray-700 hover:bg-brand-50 hover:text-brand-600 rounded-lg transition {{ request()->routeIs('about') ? 'bg-brand-50 text-brand-600' : '' }}">About</a>
                <a href="{{ route('contact') }}" class="block px-4 py-2 text-gray-700 hover:bg-brand-50 hover:text-brand-600 rounded-lg transition {{ request()->routeIs('contact') ? 'bg-brand-50 text-brand-600' : '' }}">Contact</a>
                <a href="{{ route('opd-timings') }}" class="block px-4 py-2 text-gray-700 hover:bg-brand-50 hover:text-brand-600 rounded-lg transition {{ request()->routeIs('opd-timings') ? 'bg-brand-50 text-brand-600' : '' }}">OPD Timings</a>
            </div>
            <div class="mt-4 px-4 space-y-2">
                @if(session('api_token'))
                    <a href="{{ route('patient.dashboard') }}" class="block w-full text-center px-5 py-2 bg-brand-600 text-white rounded-lg font-medium hover:bg-brand-700 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block w-full text-center px-5 py-2 border-2 border-brand-600 text-brand-600 rounded-lg font-medium hover:bg-brand-50 transition">Patient Login</a>
                    <a href="{{ config('services.telemartmain.admin_login_url') }}" target="_blank" class="block w-full text-center px-5 py-2 border-2 border-blue-600 text-blue-600 rounded-lg font-medium hover:bg-blue-50 transition">Doctor Login</a>
                    <a href="{{ route('register') }}" class="block w-full text-center px-5 py-2 bg-brand-600 text-white rounded-lg font-medium hover:bg-brand-700 transition">Register</a>
                @endif
            </div>
        </div>
    </div>
</nav>
