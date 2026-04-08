@extends('layouts.public')

@section('title', 'FAQs - Telehealth Mart')

@section('content')

<!-- Page Hero -->
<section class="bg-gradient-to-br from-brand-50 via-white to-brand-50 py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <span class="inline-block px-4 py-1 bg-brand-100 text-brand-700 rounded-full text-sm font-medium mb-4">Help Center</span>
        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Find answers to common questions about Telehealth Mart and our online consultation services.</p>
    </div>
</section>

<!-- FAQ Content -->
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-3xl mx-auto px-4" x-data="{ openFaq: null }">
        <div class="space-y-4">

            <!-- FAQ 1 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button @click="openFaq = openFaq === 1 ? null : 1" class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">1. What is Telehealth Mart?</span>
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" :class="openFaq === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 1" x-collapse class="px-5 pb-5">
                    <p class="text-gray-600 text-sm leading-relaxed">Telehealth Mart is an online platform that connects patients with experienced and qualified doctors across India through video consultations. It helps people in small towns and rural areas access healthcare without travelling.</p>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button @click="openFaq = openFaq === 2 ? null : 2" class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">2. How do I book an online consultation?</span>
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" :class="openFaq === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 2" x-collapse class="px-5 pb-5">
                    <p class="text-gray-600 text-sm leading-relaxed">You can register on the website, choose a doctor, select a convenient time slot, and confirm your appointment. The consultation will take place through a video call.</p>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button @click="openFaq = openFaq === 3 ? null : 3" class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">3. Who can use Telehealth Mart?</span>
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" :class="openFaq === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 3" x-collapse class="px-5 pb-5">
                    <p class="text-gray-600 text-sm leading-relaxed">Only individuals who are 18 years of age or older can register and use the platform.</p>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button @click="openFaq = openFaq === 4 ? null : 4" class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">4. What type of consultations are available?</span>
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" :class="openFaq === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 4" x-collapse class="px-5 pb-5">
                    <p class="text-gray-600 text-sm leading-relaxed">Telehealth Mart currently offers video-based consultations with general physicians and specialists across different medical fields.</p>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button @click="openFaq = openFaq === 5 ? null : 5" class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">5. Are the doctors verified?</span>
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" :class="openFaq === 5 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 5" x-collapse class="px-5 pb-5">
                    <p class="text-gray-600 text-sm leading-relaxed">Yes, all doctors available on Telehealth Mart are verified based on their professional qualifications and credentials before being listed.</p>
                </div>
            </div>

            <!-- FAQ 6 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button @click="openFaq = openFaq === 6 ? null : 6" class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">6. Can I get a prescription after consultation?</span>
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" :class="openFaq === 6 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 6" x-collapse class="px-5 pb-5">
                    <p class="text-gray-600 text-sm leading-relaxed">Yes, doctors may provide a digital prescription after the consultation, which you can download and use at your nearby pharmacy.</p>
                </div>
            </div>

            <!-- FAQ 7 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button @click="openFaq = openFaq === 7 ? null : 7" class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">7. Do I need to travel for consultation?</span>
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" :class="openFaq === 7 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 7" x-collapse class="px-5 pb-5">
                    <p class="text-gray-600 text-sm leading-relaxed">No, consultations are conducted online through video calls. You can consult from your home using your mobile phone or computer.</p>
                </div>
            </div>

            <!-- FAQ 8 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button @click="openFaq = openFaq === 8 ? null : 8" class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">8. How much does a consultation cost?</span>
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" :class="openFaq === 8 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 8" x-collapse class="px-5 pb-5">
                    <p class="text-gray-600 text-sm leading-relaxed">Consultation charges may vary depending on the doctor and specialty. The fee will be displayed before booking the appointment.</p>
                </div>
            </div>

            <!-- FAQ 9 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button @click="openFaq = openFaq === 9 ? null : 9" class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">9. Can I upload my medical reports?</span>
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" :class="openFaq === 9 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 9" x-collapse class="px-5 pb-5">
                    <p class="text-gray-600 text-sm leading-relaxed">Yes, you can upload your previous medical reports, test results, or prescriptions to help the doctor understand your condition better.</p>
                </div>
            </div>

            <!-- FAQ 10 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button @click="openFaq = openFaq === 10 ? null : 10" class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">10. What happens if the doctor is not available?</span>
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" :class="openFaq === 10 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 10" x-collapse class="px-5 pb-5">
                    <p class="text-gray-600 text-sm leading-relaxed">If the doctor is unavailable or fails to appear for the scheduled consultation, you will be eligible for a refund or rescheduling.</p>
                </div>
            </div>

            <!-- FAQ 11 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button @click="openFaq = openFaq === 11 ? null : 11" class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">11. Is my personal information secure?</span>
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" :class="openFaq === 11 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 11" x-collapse class="px-5 pb-5">
                    <p class="text-gray-600 text-sm leading-relaxed">Yes, your personal and medical information is stored securely and used only for consultation and service-related purposes.</p>
                </div>
            </div>

            <!-- FAQ 12 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button @click="openFaq = openFaq === 12 ? null : 12" class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">12. Can I book a follow-up consultation?</span>
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" :class="openFaq === 12 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 12" x-collapse class="px-5 pb-5">
                    <p class="text-gray-600 text-sm leading-relaxed">Yes, you can book follow-up consultations to discuss your progress or continue treatment.</p>
                </div>
            </div>

            <!-- FAQ 13 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button @click="openFaq = openFaq === 13 ? null : 13" class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">13. Do I need any special equipment?</span>
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" :class="openFaq === 13 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 13" x-collapse class="px-5 pb-5">
                    <p class="text-gray-600 text-sm leading-relaxed">No special equipment is required. A smartphone or computer with internet connection and camera is sufficient.</p>
                </div>
            </div>

            <!-- FAQ 14 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button @click="openFaq = openFaq === 14 ? null : 14" class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">14. Can I cancel my appointment?</span>
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" :class="openFaq === 14 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 14" x-collapse class="px-5 pb-5">
                    <p class="text-gray-600 text-sm leading-relaxed">You may contact support for assistance. Refunds are only applicable if the doctor is unavailable for the scheduled consultation.</p>
                </div>
            </div>

            <!-- FAQ 15 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button @click="openFaq = openFaq === 15 ? null : 15" class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">15. How can I contact support?</span>
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" :class="openFaq === 15 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 15" x-collapse class="px-5 pb-5">
                    <p class="text-gray-600 text-sm leading-relaxed">You can contact our support team at: <a href="mailto:support@telehealthmart.com" class="text-brand-600 hover:text-brand-700">support@telehealthmart.com</a></p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-gradient-to-r from-brand-600 to-brand-700 py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Still Have Questions?</h2>
        <p class="text-brand-100 text-lg mb-8">Feel free to reach out to our support team. We're here to help.</p>
        <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-brand-700 rounded-lg font-bold text-lg hover:bg-brand-50 transition shadow-lg">
            Contact Us
        </a>
    </div>
</section>

@endsection
