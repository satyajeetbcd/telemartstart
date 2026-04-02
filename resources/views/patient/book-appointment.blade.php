@extends('layouts.patient')

@section('title', 'Book Appointment')

@section('content')
<div x-data="appointmentBooking()" class="max-w-4xl">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('patient.appointments') }}" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-gray-900">Book Appointment</h2>
        </div>
        <p class="text-gray-500">Select a doctor, pick a date & time, and confirm your booking.</p>
    </div>

    <!-- Consultation Saved Banner -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-xl">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Progress Steps -->
    <div class="flex items-center mb-8">
        <template x-for="(label, index) in ['Select Doctor', 'Date & Time', 'Confirm']" :key="index">
            <div class="flex items-center" :class="index < 2 ? 'flex-1' : ''">
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold transition-colors"
                         :class="step > index + 1 ? 'bg-brand-600 text-white' : (step === index + 1 ? 'bg-brand-600 text-white' : 'bg-gray-200 text-gray-500')">
                        <template x-if="step > index + 1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </template>
                        <template x-if="step <= index + 1">
                            <span x-text="index + 1"></span>
                        </template>
                    </div>
                    <span class="ml-2 text-sm font-medium hidden sm:inline"
                          :class="step >= index + 1 ? 'text-gray-900' : 'text-gray-400'"
                          x-text="label"></span>
                </div>
                <template x-if="index < 2">
                    <div class="flex-1 mx-4 h-0.5 rounded" :class="step > index + 1 ? 'bg-brand-600' : 'bg-gray-200'"></div>
                </template>
            </div>
        </template>
    </div>

    <!-- Step 1: Select Doctor -->
    <div x-show="step === 1" x-transition>
        <!-- Filter -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-4">
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1">
                    <select x-model="filterSpecialization" @change="filterDoctors()"
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-brand-500 focus:ring-brand-500">
                        <option value="">All Specializations</option>
                        @foreach($specializations as $spec)
                            <option value="{{ $spec }}">{{ $spec }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1">
                    <input type="text" x-model="searchQuery" @input="filterDoctors()" placeholder="Search doctor name..."
                           class="w-full rounded-lg border-gray-300 text-sm focus:border-brand-500 focus:ring-brand-500">
                </div>
            </div>
        </div>

        <!-- Doctors List -->
        @if(count($doctors) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($doctors as $doctor)
                    <div class="doctor-card bg-white rounded-xl shadow-sm border border-gray-100 p-5 cursor-pointer transition hover:shadow-md hover:border-brand-200"
                         :class="selectedDoctor?.id === {{ $doctor['id'] }} ? 'ring-2 ring-brand-500 border-brand-300' : ''"
                         data-name="{{ strtolower($doctor['name']) }}"
                         data-specialization="{{ strtolower($doctor['specialization'] ?? '') }}"
                         @click="selectDoctor({{ json_encode($doctor) }})">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 bg-brand-50 rounded-full flex items-center justify-center flex-shrink-0">
                                @if($doctor['profile_image'])
                                    <img src="{{ config('services.telemartmain.base_url') }}/storage/{{ $doctor['profile_image'] }}" alt="" class="w-14 h-14 rounded-full object-cover">
                                @else
                                    <span class="text-brand-600 font-semibold text-lg">{{ substr($doctor['name'], 0, 1) }}</span>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="font-semibold text-gray-900">Dr. {{ $doctor['name'] }}</h4>
                                <p class="text-sm text-brand-600 font-medium">{{ $doctor['specialization'] ?? 'General' }}</p>
                                @if($doctor['qualifications'])
                                    <p class="text-xs text-gray-400 mt-0.5 truncate">{{ $doctor['qualifications'] }}</p>
                                @endif
                                <div class="flex items-center gap-3 mt-2 text-xs text-gray-500">
                                    @if($doctor['experience_years'])
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $doctor['experience_years'] }} yrs exp
                                        </span>
                                    @endif
                                    @if($doctor['consultation_fee'])
                                        <span class="flex items-center gap-1 font-medium text-gray-700">
                                            &#8377;{{ $doctor['consultation_fee'] }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition"
                                     :class="selectedDoctor?.id === {{ $doctor['id'] }} ? 'border-brand-500 bg-brand-500' : 'border-gray-300'">
                                    <svg x-show="selectedDoctor?.id === {{ $doctor['id'] }}" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex justify-end">
                <button @click="goToStep2()" :disabled="!selectedDoctor"
                        class="px-6 py-2.5 bg-brand-600 text-white rounded-lg font-medium hover:bg-brand-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                    Continue
                    <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <p class="text-gray-500 font-medium">No doctors available.</p>
                <p class="text-sm text-gray-400 mt-1">Please try again later.</p>
            </div>
        @endif
    </div>

    <!-- Step 2: Date & Time -->
    <div x-show="step === 2" x-transition>
        <!-- Selected Doctor Summary -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-brand-50 rounded-full flex items-center justify-center">
                    <span class="text-brand-600 font-semibold" x-text="selectedDoctor?.name?.charAt(0)"></span>
                </div>
                <div>
                    <p class="font-medium text-gray-900">Dr. <span x-text="selectedDoctor?.name"></span></p>
                    <p class="text-sm text-gray-500" x-text="selectedDoctor?.specialization"></p>
                </div>
                <button @click="step = 1" class="ml-auto text-sm text-brand-600 hover:text-brand-700 font-medium">Change</button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <!-- Date Picker -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <h4 class="font-semibold text-gray-900 mb-3">Select Date</h4>
                <input type="date" x-model="selectedDate" @change="fetchSlots()"
                       :min="today"
                       class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500">
            </div>

            <!-- Time Slots -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <h4 class="font-semibold text-gray-900 mb-3">Available Time Slots</h4>

                <div x-show="loadingSlots" class="flex items-center justify-center py-8">
                    <svg class="animate-spin h-6 w-6 text-brand-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="ml-2 text-sm text-gray-500">Loading slots...</span>
                </div>

                <div x-show="!loadingSlots && !selectedDate" class="text-center py-8">
                    <p class="text-sm text-gray-400">Please select a date first.</p>
                </div>

                <div x-show="!loadingSlots && selectedDate && slots.length === 0" class="text-center py-8">
                    <p class="text-sm text-gray-500">No available slots for this date.</p>
                    <p class="text-xs text-gray-400 mt-1">Try selecting a different date.</p>
                </div>

                <div x-show="!loadingSlots && slots.length > 0" class="grid grid-cols-3 gap-2 max-h-64 overflow-y-auto">
                    <template x-for="slot in slots" :key="slot">
                        <button @click="selectedTime = slot" type="button"
                                class="px-3 py-2 text-sm rounded-lg border transition font-medium"
                                :class="selectedTime === slot ? 'bg-brand-600 text-white border-brand-600' : 'bg-white text-gray-700 border-gray-200 hover:border-brand-300 hover:bg-brand-50'">
                            <span x-text="formatTime(slot)"></span>
                        </button>
                    </template>
                </div>
            </div>
        </div>

        <!-- Reason -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mt-4">
            <h4 class="font-semibold text-gray-900 mb-3">Reason for Visit <span class="text-gray-400 font-normal text-sm">(optional)</span></h4>
            <textarea x-model="reason" rows="3" placeholder="Briefly describe your symptoms or reason for consultation..."
                      class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500 text-sm"></textarea>
        </div>

        <div class="mt-6 flex justify-between">
            <button @click="step = 1" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back
            </button>
            <button @click="goToStep3()" :disabled="!selectedDate || !selectedTime"
                    class="px-6 py-2.5 bg-brand-600 text-white rounded-lg font-medium hover:bg-brand-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                Review Booking
                <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Step 3: Confirm -->
    <div x-show="step === 3" x-transition>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-5">Review Your Appointment</h3>

            <div class="space-y-4">
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-sm text-gray-500">Doctor</span>
                    <span class="text-sm font-medium text-gray-900">Dr. <span x-text="selectedDoctor?.name"></span></span>
                </div>
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-sm text-gray-500">Specialization</span>
                    <span class="text-sm font-medium text-gray-900" x-text="selectedDoctor?.specialization"></span>
                </div>
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-sm text-gray-500">Date</span>
                    <span class="text-sm font-medium text-gray-900" x-text="formatDate(selectedDate)"></span>
                </div>
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-sm text-gray-500">Time</span>
                    <span class="text-sm font-medium text-gray-900" x-text="formatTime(selectedTime)"></span>
                </div>
                <div x-show="selectedDoctor?.consultation_fee" class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-sm text-gray-500">Consultation Fee</span>
                    <span class="text-sm font-semibold text-brand-600">&#8377;<span x-text="selectedDoctor?.consultation_fee"></span></span>
                </div>
                <div x-show="reason" class="py-3 border-b border-gray-100">
                    <span class="text-sm text-gray-500 block mb-1">Reason</span>
                    <span class="text-sm text-gray-900" x-text="reason"></span>
                </div>
            </div>

            <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm text-yellow-800">Your appointment will be in <strong>pending</strong> status until confirmed by the doctor.</p>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-between">
            <button @click="step = 2" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back
            </button>

            <form method="POST" action="{{ route('patient.book-appointment.store') }}" @submit="submitting = true">
                @csrf
                <input type="hidden" name="doctor_id" :value="selectedDoctor?.id">
                <input type="hidden" name="appointment_date" :value="selectedDate">
                <input type="hidden" name="appointment_time" :value="selectedTime">
                <input type="hidden" name="reason" :value="reason">
                <button type="submit" :disabled="submitting"
                        class="px-6 py-2.5 bg-brand-600 text-white rounded-lg font-medium hover:bg-brand-700 transition disabled:opacity-50">
                    <span x-show="!submitting">Confirm Booking</span>
                    <span x-show="submitting" class="flex items-center">
                        <svg class="animate-spin h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Booking...
                    </span>
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function appointmentBooking() {
    return {
        step: 1,
        selectedDoctor: null,
        selectedDate: '',
        selectedTime: '',
        reason: '',
        slots: [],
        loadingSlots: false,
        submitting: false,
        filterSpecialization: '{{ $selectedSpecialization ?? '' }}',
        searchQuery: '',
        today: new Date().toISOString().split('T')[0],
        hasConsultation: {{ !empty($hasConsultation) ? 'true' : 'false' }},
        preSelectedDoctorId: {{ $preSelectedDoctorId ?? 'null' }},

        init() {
            // Auto-select doctor if coming from consultation page
            if (this.preSelectedDoctorId) {
                const allDoctors = @json($doctors);
                const doctor = allDoctors.find(d => d.id == this.preSelectedDoctorId);
                if (doctor) {
                    this.selectedDoctor = doctor;
                }
            }
        },

        selectDoctor(doctor) {
            this.selectedDoctor = doctor;
        },

        goToStep2() {
            if (this.selectedDoctor) {
                this.step = 2;
                this.selectedDate = '';
                this.selectedTime = '';
                this.slots = [];
            }
        },

        goToStep3() {
            if (this.selectedDate && this.selectedTime) {
                this.step = 3;
            }
        },

        async fetchSlots() {
            if (!this.selectedDoctor || !this.selectedDate) return;
            this.loadingSlots = true;
            this.selectedTime = '';
            this.slots = [];

            try {
                const response = await fetch(`{{ route('patient.book-appointment.slots') }}?doctor_id=${this.selectedDoctor.id}&date=${this.selectedDate}`);
                if (response.status === 401) {
                    window.location.href = '{{ route('login') }}';
                    return;
                }
                const data = await response.json();
                this.slots = data.slots || [];
            } catch (e) {
                this.slots = [];
            } finally {
                this.loadingSlots = false;
            }
        },

        filterDoctors() {
            const cards = document.querySelectorAll('.doctor-card');
            const search = this.searchQuery.toLowerCase();
            const spec = this.filterSpecialization.toLowerCase();

            cards.forEach(card => {
                const name = card.dataset.name;
                const cardSpec = card.dataset.specialization;
                const matchSearch = !search || name.includes(search);
                const matchSpec = !spec || cardSpec === spec;
                card.style.display = matchSearch && matchSpec ? '' : 'none';
            });
        },

        formatTime(time) {
            if (!time) return '';
            const [h, m] = time.split(':');
            const hour = parseInt(h);
            const ampm = hour >= 12 ? 'PM' : 'AM';
            const hour12 = hour % 12 || 12;
            return `${hour12}:${m} ${ampm}`;
        },

        formatDate(dateStr) {
            if (!dateStr) return '';
            const date = new Date(dateStr + 'T00:00:00');
            return date.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        }
    };
}
</script>
@endpush
@endsection
