@extends('layouts.patient')

@section('title', 'My Appointments')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="p-6 border-b border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h3 class="text-lg font-semibold text-gray-900">All Appointments</h3>
            <a href="{{ route('patient.book-appointment') }}" class="inline-flex items-center px-4 py-2 bg-brand-600 text-white rounded-lg text-sm font-medium hover:bg-brand-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Book New Appointment
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        @if(count($appointments) > 0)
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Doctor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Specialization</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fee</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($appointments as $i => $appointment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $i + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Dr. {{ $appointment['doctor_name'] ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $appointment['specialization'] ?? 'General' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $appointment['appointment_date'] ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $appointment['appointment_time'] ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusColors = [
                                    'confirmed' => 'bg-green-100 text-green-800',
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'completed' => 'bg-blue-100 text-blue-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                ];
                                $color = $statusColors[$appointment['status'] ?? ''] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $color }}">
                                {{ ucfirst($appointment['status'] ?? 'N/A') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $appointment['consultation_fee'] ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex items-center gap-2">
                                @if(!empty($appointment['zoom_join_url']) && in_array($appointment['status'], ['confirmed']))
                                    <a href="{{ $appointment['zoom_join_url'] }}"
                                       target="_blank"
                                       class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 transition-colors"
                                       title="Join Video Call with Doctor">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                        Join Call
                                    </a>
                                @endif
                                <a href="{{ route('patient.appointments.invoice-pdf', $appointment['id']) }}"
                                   class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 transition-colors"
                                   title="Download Invoice PDF">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Invoice
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="p-12 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-gray-500 font-medium">No appointments found.</p>
                <p class="text-sm text-gray-400 mt-1">Your appointments will appear here once booked.</p>
            </div>
        @endif
    </div>
</div>
@endsection
