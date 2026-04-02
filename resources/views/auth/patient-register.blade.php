@extends('layouts.public')

@section('title', 'Patient Registration - Tele Health Mart')

@section('content')
<section class="min-h-[80vh] flex items-center bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 py-12 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Left Panel - Branding -->
            <div class="bg-gradient-to-br from-brand-600 to-brand-700 p-8 lg:p-12 flex flex-col justify-center text-white">
                <div class="mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="Tele Health Mart" class="h-16 w-auto object-contain brightness-0 invert mb-6">
                    <h2 class="text-3xl font-bold mb-4">Join Tele Health Mart</h2>
                    <p class="text-brand-100 text-lg leading-relaxed">
                        Create your free account and start consulting with verified doctors from anywhere in India.
                    </p>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-brand-100">Free Registration</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-brand-100">500+ Verified Doctors</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-brand-100">Instant Video Consultation</span>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Registration Form -->
            <div class="p-8 lg:p-12 flex flex-col justify-center">
                <div class="max-w-md mx-auto w-full">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Create Account</h3>
                    <p class="text-gray-500 mb-8">Fill in your details to get started</p>

                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.submit') }}" class="space-y-4">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                                placeholder="Enter your full name">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                                placeholder="Enter your email">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                                placeholder="Enter your phone number">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input type="password" name="password" id="password" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                                placeholder="Create a password (min 8 characters)">
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                                placeholder="Confirm your password">
                        </div>

                        <!-- Terms -->
                        <div class="flex items-start">
                            <input type="checkbox" name="terms" id="terms" required
                                class="w-4 h-4 text-brand-600 border-gray-300 rounded focus:ring-brand-500 mt-0.5">
                            <label for="terms" class="ml-2 text-sm text-gray-600">
                                I agree to the <a href="#" class="text-brand-600 hover:text-brand-700 font-medium">Terms of Service</a> and <a href="#" class="text-brand-600 hover:text-brand-700 font-medium">Privacy Policy</a>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full py-3 px-4 bg-brand-600 text-white rounded-lg font-semibold hover:bg-brand-700 focus:ring-4 focus:ring-brand-200 transition">
                            Create Account
                        </button>
                    </form>

                    <p class="mt-6 text-center text-sm text-gray-500">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-brand-600 hover:text-brand-700 font-medium">Sign in here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
