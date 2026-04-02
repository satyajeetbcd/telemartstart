@extends('layouts.patient')

@section('title', 'Prescriptions')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="p-6 border-b border-gray-100">
        <h3 class="text-lg font-semibold text-gray-900">My Prescriptions</h3>
    </div>
    <div class="overflow-x-auto">
        @if(count($prescriptions) > 0)
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Doctor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diagnosis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Medications</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Notes</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($prescriptions as $i => $prescription)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $i + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Dr. {{ $prescription['doctor_name'] ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $prescription['date'] ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $prescription['diagnosis'] ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            @if(!empty($prescription['items']))
                                @foreach($prescription['items'] as $item)
                                    <span class="inline-block px-2 py-0.5 bg-brand-50 text-brand-700 text-xs rounded mr-1 mb-1">{{ $item['medicine_name'] ?? $item }}</span>
                                @endforeach
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $prescription['notes'] ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('patient.prescriptions.pdf', $prescription['id']) }}"
                               class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                PDF
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="p-12 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                </svg>
                <p class="text-gray-500 font-medium">No prescriptions found.</p>
                <p class="text-sm text-gray-400 mt-1">Your prescriptions will appear here after consultations.</p>
            </div>
        @endif
    </div>
</div>
@endsection
