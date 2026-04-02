@extends('layouts.patient')

@section('title', 'My Consultations')

@section('content')
<div class="max-w-5xl mx-auto">

    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('patient.dashboard') }}" class="inline-flex items-center text-gray-600 hover:text-green-700 font-medium text-sm">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Dashboard
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm" style="border: 1px solid #f3f4f6;">
        <div class="p-6 flex items-center justify-between" style="border-bottom: 1px solid #f3f4f6;">
            <h3 class="text-xl font-bold" style="color: #111827;">My Consultations</h3>
            <a href="{{ route('patient.consultation') }}"
               style="display: inline-flex; align-items: center; padding: 8px 16px; background-color: #16a34a; color: #ffffff; font-size: 0.875rem; font-weight: 600; border-radius: 8px; text-decoration: none;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 6px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                New Consultation
            </a>
        </div>
        <div class="p-6">
            @if(!empty($consultations) && count($consultations) > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead style="background-color: #f9fafb;">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase" style="color: #6b7280;">#</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase" style="color: #6b7280;">Chief Complaints</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase" style="color: #6b7280;">Doctor</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase" style="color: #6b7280;">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase" style="color: #6b7280;">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase" style="color: #6b7280;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($consultations as $consultation)
                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                <td class="px-4 py-4 text-sm font-medium" style="color: #111827;">{{ $consultation['consultation_number'] ?? '-' }}</td>
                                <td class="px-4 py-4 text-sm" style="color: #6b7280;">
                                    @if(!empty($consultation['chief_complaints']))
                                        @foreach(array_slice($consultation['chief_complaints'], 0, 3) as $cc)
                                            <span style="display: inline-block; background-color: #f0fdf4; color: #166534; font-size: 0.75rem; padding: 2px 8px; border-radius: 9999px; margin-right: 4px;">{{ $cc['name'] ?? $cc }}</span>
                                        @endforeach
                                        @if(count($consultation['chief_complaints']) > 3)
                                            <span style="font-size: 0.75rem; color: #9ca3af;">+{{ count($consultation['chief_complaints']) - 3 }} more</span>
                                        @endif
                                    @else
                                        <span style="color: #9ca3af;">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-sm" style="color: #111827;">{{ $consultation['doctor_name'] !== 'Unassigned' ? 'Dr. ' . $consultation['doctor_name'] : 'Unassigned' }}</td>
                                <td class="px-4 py-4 text-sm" style="color: #6b7280;">{{ $consultation['date'] ?? 'N/A' }}</td>
                                <td class="px-4 py-4">
                                    @php
                                        $cStatusStyles = [
                                            'pending' => 'background-color: #fef9c3; color: #854d0e;',
                                            'in_review' => 'background-color: #dbeafe; color: #1e40af;',
                                            'completed' => 'background-color: #dcfce7; color: #166534;',
                                            'cancelled' => 'background-color: #fee2e2; color: #991b1b;',
                                        ];
                                        $cStyle = $cStatusStyles[$consultation['status'] ?? ''] ?? 'background-color: #f3f4f6; color: #374151;';
                                    @endphp
                                    <span class="px-2 py-1 text-xs font-medium rounded-full" style="{{ $cStyle }}">
                                        {{ ucfirst(str_replace('_', ' ', $consultation['status'] ?? 'N/A')) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-sm">
                                    <a href="{{ route('patient.consultation.show', $consultation['id']) }}" style="color: #16a34a; font-weight: 500; text-decoration: none; margin-right: 8px;">View</a>
                                    @if(($consultation['status'] ?? '') === 'pending')
                                        <a href="{{ route('patient.consultation.edit', $consultation['id']) }}" style="color: #2563eb; font-weight: 500; text-decoration: none;">Edit</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-12">
                    <div class="w-24 h-24 rounded-full flex items-center justify-center mb-4" style="background-color: #fff7ed;">
                        <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="#fb923c" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <p class="text-lg font-medium" style="color: #6b7280;">No consultations yet.</p>
                    <p class="text-sm mt-1" style="color: #9ca3af;">Start your first consultation to see it listed here.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
