@extends('layouts.patient')

@section('title', 'Medical Records')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="p-6 border-b border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h3 class="text-lg font-semibold text-gray-900">My Medical Records</h3>
            <a href="{{ route('patient.medical-records.add') }}" class="inline-flex items-center px-4 py-2 bg-brand-600 text-white rounded-lg text-sm font-medium hover:bg-brand-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Record
            </a>
        </div>
    </div>

    @if(count($records) > 0)
        <div class="divide-y divide-gray-100">
            @foreach($records as $record)
            <div class="p-6 hover:bg-gray-50 transition">
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-3 mb-1">
                            <h4 class="font-semibold text-gray-900">{{ $record['title'] }}</h4>
                            @php
                                $typeColors = [
                                    'consultation' => 'bg-blue-100 text-blue-800',
                                    'lab_report' => 'bg-purple-100 text-purple-800',
                                    'prescription' => 'bg-green-100 text-green-800',
                                    'diagnosis' => 'bg-orange-100 text-orange-800',
                                    'discharge_summary' => 'bg-red-100 text-red-800',
                                    'imaging' => 'bg-cyan-100 text-cyan-800',
                                    'vaccination' => 'bg-teal-100 text-teal-800',
                                    'surgical' => 'bg-rose-100 text-rose-800',
                                    'follow_up' => 'bg-amber-100 text-amber-800',
                                    'other' => 'bg-gray-100 text-gray-800',
                                ];
                                $typeColor = $typeColors[$record['record_type'] ?? 'other'] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-0.5 text-xs font-medium rounded-full {{ $typeColor }}">
                                {{ ucwords(str_replace('_', ' ', $record['record_type'] ?? 'General')) }}
                            </span>
                        </div>

                        <div class="flex items-center gap-4 text-sm text-gray-500 mt-1">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $record['date'] }}
                            </span>
                            @if($record['doctor_name'])
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Dr. {{ $record['doctor_name'] }}
                            </span>
                            @endif
                        </div>

                        @if($record['description'])
                            <p class="text-sm text-gray-600 mt-2">{{ $record['description'] }}</p>
                        @endif

                        @if($record['notes'])
                            <p class="text-sm text-gray-500 mt-1 italic">{{ $record['notes'] }}</p>
                        @endif
                    </div>
                </div>

                {{-- Attachments --}}
                @if(!empty($record['attachments']))
                    <div class="mt-3 flex flex-wrap gap-2">
                        @foreach($record['attachments'] as $attachment)
                            <a href="{{ route('patient.medical-records.download', [$record['id'], $attachment['index']]) }}"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 border border-gray-200 rounded-lg text-xs text-gray-700 hover:bg-gray-100 hover:border-gray-300 transition">
                                @php
                                    $ext = pathinfo($attachment['name'], PATHINFO_EXTENSION);
                                    $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png']);
                                    $isPdf = strtolower($ext) === 'pdf';
                                @endphp
                                @if($isPdf)
                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                    </svg>
                                @elseif($isImage)
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                    </svg>
                                @endif
                                <span class="max-w-[150px] truncate">{{ $attachment['name'] }}</span>
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
            @endforeach
        </div>
    @else
        <div class="p-12 text-center">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p class="text-gray-500 font-medium">No medical records found.</p>
            <p class="text-sm text-gray-400 mt-1">Upload your medical records to keep them organized.</p>
            <a href="{{ route('patient.medical-records.add') }}" class="inline-flex items-center mt-4 px-4 py-2 bg-brand-600 text-white rounded-lg text-sm font-medium hover:bg-brand-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Your First Record
            </a>
        </div>
    @endif
</div>
@endsection
