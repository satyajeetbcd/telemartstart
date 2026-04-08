@extends('layouts.public')

@section('title', 'Refund Policy - Telehealth Mart')

@section('content')

<!-- Page Hero -->
<section class="bg-gradient-to-br from-brand-50 via-white to-brand-50 py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <span class="inline-block px-4 py-1 bg-brand-100 text-brand-700 rounded-full text-sm font-medium mb-4">Legal</span>
        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Refund Policy</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Telehealth Mart - Last Updated: 08 Apr, 2026</p>
    </div>
</section>

<!-- Refund Policy Content -->
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="prose prose-gray max-w-none">
            <p class="text-gray-600 leading-relaxed mb-8">Telehealth Mart is an initiative of Nirmala Welfare Foundation. This Refund Policy outlines the conditions under which refunds may be issued for online consultations booked through the platform.</p>

            <!-- Section 1 -->
            <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">1. Eligibility for Refund</h2>
            <p class="text-gray-600 mb-4">Refunds will be issued only in the following situation:</p>
            <div class="bg-brand-50 border-l-4 border-brand-500 p-4 mb-4 rounded-r-lg">
                <p class="text-gray-700 font-medium">The doctor is unavailable or fails to appear for the scheduled consultation.</p>
            </div>
            <p class="text-gray-600 mb-2">In such cases, users may request either:</p>
            <ul class="list-disc list-inside text-gray-600 mb-6 space-y-1">
                <li>A full refund, or</li>
                <li>Rescheduling of the consultation (subject to availability)</li>
            </ul>

            <!-- Section 2 -->
            <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">2. Non-Refundable Situations</h2>
            <p class="text-gray-600 mb-2">Refunds will not be provided in the following cases:</p>
            <ul class="list-disc list-inside text-gray-600 mb-6 space-y-1">
                <li>The consultation has been successfully completed</li>
                <li>User fails to join the consultation at the scheduled time</li>
                <li>Incorrect information provided by the user</li>
                <li>Network or technical issues from the user's side</li>
                <li>Change of mind after booking</li>
                <li>Delay caused by user unavailability</li>
            </ul>

            <!-- Section 3 -->
            <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">3. Refund Process</h2>
            <ul class="list-disc list-inside text-gray-600 mb-6 space-y-1">
                <li>Refund requests must be submitted within 24 hours of the scheduled appointment.</li>
                <li>Requests can be made by contacting <a href="mailto:support@telehealthmart.com" class="text-brand-600 hover:text-brand-700">support@telehealthmart.com</a></li>
                <li>Users should include booking details and registered contact information.</li>
            </ul>

            <!-- Section 4 -->
            <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">4. Refund Timeline</h2>
            <ul class="list-disc list-inside text-gray-600 mb-6 space-y-1">
                <li>Approved refunds will be processed within 5-7 business days.</li>
                <li>Refunds will be credited to the original payment method used during booking.</li>
                <li>Processing time may vary depending on the payment provider or bank.</li>
            </ul>

            <!-- Section 5 -->
            <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">5. Rescheduling Option</h2>
            <p class="text-gray-600 mb-2">Instead of a refund, users may choose to reschedule the consultation with:</p>
            <ul class="list-disc list-inside text-gray-600 mb-6 space-y-1">
                <li>The same doctor (subject to availability), or</li>
                <li>Another available doctor</li>
            </ul>

            <!-- Section 6 -->
            <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">6. Platform Rights</h2>
            <p class="text-gray-600 mb-2">Telehealth Mart reserves the right to:</p>
            <ul class="list-disc list-inside text-gray-600 mb-6 space-y-1">
                <li>Verify refund eligibility</li>
                <li>Reject requests not meeting the criteria</li>
                <li>Modify this policy at any time</li>
            </ul>

            <!-- Section 7 -->
            <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">7. Contact for Refund Requests</h2>
            <div class="bg-gray-50 rounded-xl p-6 mt-4">
                <p class="font-semibold text-gray-900">Telehealth Mart</p>
                <p class="text-gray-600">Nirmala Welfare Foundation</p>
                <p class="text-gray-600">House No. N1/66R-15K, Ganga Bihar Colony</p>
                <p class="text-gray-600">Samne Ghat, Varanasi, Uttar Pradesh, 221005</p>
                <p class="text-gray-600 mt-2">Email: <a href="mailto:support@telehealthmart.com" class="text-brand-600 hover:text-brand-700">support@telehealthmart.com</a></p>
            </div>
        </div>
    </div>
</section>

@endsection
