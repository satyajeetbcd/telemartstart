@extends('layouts.patient')

@section('title', 'Dashboard')

@section('content')
<div x-data="{ activeTab: 'dashboard' }">

    <!-- Horizontal Tab Bar -->
    <div class="rounded-lg mb-6 flex items-center overflow-x-auto" style="background-color: #15803d;">
        <button @click="activeTab = 'dashboard'"
                :style="activeTab === 'dashboard' ? 'background-color: #166534; color: #ffffff; border-bottom: 4px solid #ffffff;' : 'color: #bbf7d0;'"
                class="flex items-center px-6 py-3 text-sm font-semibold transition-colors whitespace-nowrap"
                style="min-width: fit-content;">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
            </svg>
            Dashboard
        </button>
        <button @click="activeTab = 'past'"
                :style="activeTab === 'past' ? 'background-color: #166534; color: #ffffff; border-bottom: 4px solid #ffffff;' : 'color: #bbf7d0;'"
                class="flex items-center px-6 py-3 text-sm font-semibold transition-colors whitespace-nowrap"
                style="min-width: fit-content;">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
            </svg>
            Past Consultations
        </button>
        <button @click="activeTab = 'family'"
                :style="activeTab === 'family' ? 'background-color: #166534; color: #ffffff; border-bottom: 4px solid #ffffff;' : 'color: #bbf7d0;'"
                class="flex items-center px-6 py-3 text-sm font-semibold transition-colors whitespace-nowrap"
                style="min-width: fit-content;">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
            </svg>
            Family Members
        </button>
    </div>

    <!-- Dashboard Tab -->
    <div x-show="activeTab === 'dashboard'" x-transition>

        <!-- Two-column Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

            <!-- Consult Now Card -->
            <div class="rounded-2xl shadow-sm" style="border: 2px solid #4ade80; border-bottom: 4px solid #16a34a; background: #ffffff;">
                <div class="p-8 flex flex-col items-center justify-center">
                    <!-- Doctor Illustration -->
                    <div class="mb-6">
                        <svg width="130" height="130" viewBox="0 0 130 130" xmlns="http://www.w3.org/2000/svg">
                            <!-- Phone body -->
                            <rect x="35" y="10" width="55" height="95" rx="12" fill="#E8F5E9" stroke="#16a34a" stroke-width="2.5"/>
                            <rect x="43" y="22" width="39" height="62" rx="4" fill="white" stroke="#16a34a" stroke-width="1.5"/>
                            <circle cx="62" cy="97" r="4" fill="#16a34a"/>
                            <!-- Doctor head -->
                            <circle cx="62" cy="40" r="10" fill="#C8E6C9" stroke="#16a34a" stroke-width="2"/>
                            <!-- Doctor body -->
                            <path d="M48 68c0-7.732 6.268-14 14-14s14 6.268 14 14" fill="#C8E6C9" stroke="#16a34a" stroke-width="2"/>
                            <!-- Stethoscope -->
                            <circle cx="57" cy="47" r="2.5" fill="#16a34a"/>
                            <!-- Signal waves -->
                            <path d="M95 28c3 0 5 3 5 6" stroke="#f97316" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                            <path d="M95 20c6 0 12 6 12 14" stroke="#f97316" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                            <path d="M95 12c10 0 19 9 19 22" stroke="#f97316" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                        </svg>
                    </div>
                    <a href="{{ route('patient.consultation') }}"
                       style="display: inline-flex; align-items: center; padding: 14px 40px; background-color: #1e3a5f; color: #ffffff; font-size: 1.125rem; font-weight: 700; border-radius: 12px; box-shadow: 0 4px 14px rgba(0,0,0,0.2); text-decoration: none; transition: background-color 0.2s;"
                       onmouseover="this.style.backgroundColor='#2c4f7c'" onmouseout="this.style.backgroundColor='#1e3a5f'">
                        Consult Now
                    </a>
                </div>
            </div>

            <!-- Total Consultations Card -->
            <div class="rounded-2xl shadow-sm" style="border: 2px solid #4ade80; border-bottom: 4px solid #16a34a; background: #ffffff;">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <!-- Consultation Icon -->
                            <div class="w-16 h-16 rounded-xl flex items-center justify-center" style="background-color: #f0fdf4;">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke="#16a34a" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3 13h18" stroke="#16a34a" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3" stroke="#16a34a" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <!-- Doctor on screen -->
                                    <circle cx="12" cy="7" r="2" fill="#C8E6C9" stroke="#16a34a" stroke-width="1"/>
                                    <path d="M9 12c0-1.657 1.343-3 3-3s3 1.343 3 3" fill="#C8E6C9" stroke="#16a34a" stroke-width="1"/>
                                    <!-- Green badge -->
                                    <circle cx="18" cy="4" r="2.5" fill="#22c55e" stroke="white" stroke-width="1"/>
                                    <path d="M17.2 4l.6.6 1.2-1.2" stroke="white" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium" style="color: #6b7280;">Total consultations</p>
                            <p class="font-bold mt-1" style="color: #111827; font-size: 3rem; line-height: 1;">{{ $stats['total_consultations'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <!-- Wave decoration at bottom -->
                <div style="margin-top: auto;">
                    <svg width="100%" height="50" viewBox="0 0 400 50" preserveAspectRatio="none">
                        <path d="M0 25 Q25 5 50 25 T100 25 T150 25 T200 25 T250 25 T300 25 T350 25 T400 25 V50 H0 Z" fill="#dcfce7"/>
                        <path d="M0 28 Q25 8 50 28 T100 28 T150 28 T200 28 T250 28 T300 28 T350 28 T400 28" fill="none" stroke="#22c55e" stroke-width="2.5" opacity="0.6"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Recent Consultations Preview -->
        <div class="bg-white rounded-2xl shadow-sm" style="border: 1px solid #f3f4f6;">
            <div class="p-6 flex items-center justify-between" style="border-bottom: 1px solid #f3f4f6;">
                <h3 class="text-xl font-bold" style="color: #111827;">Recent Consultations</h3>
                <a href="{{ route('patient.consultations') }}" style="font-size: 0.875rem; font-weight: 600; color: #16a34a; text-decoration: none;">View All &rarr;</a>
            </div>
            <div class="p-6">
                @if(!empty($stats['recent_consultations']) && count($stats['recent_consultations']) > 0)
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
                                @foreach($stats['recent_consultations'] as $consultation)
                                <tr style="border-bottom: 1px solid #f3f4f6;">
                                    <td class="px-4 py-4 text-sm font-medium" style="color: #111827;">{{ $consultation['consultation_number'] ?? '-' }}</td>
                                    <td class="px-4 py-4 text-sm" style="color: #6b7280;">
                                        @foreach($consultation['chief_complaints'] ?? [] as $cc)
                                            <span style="display: inline-block; background-color: #f0fdf4; color: #166534; font-size: 0.75rem; padding: 2px 8px; border-radius: 9999px; margin-right: 4px;">{{ $cc }}</span>
                                        @endforeach
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
                        <p class="text-lg font-medium" style="color: #6b7280;">No consultations found !</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Past Consultations Tab -->
    <div x-show="activeTab === 'past'" x-transition>
        <div class="bg-white rounded-2xl shadow-sm" style="border: 1px solid #f3f4f6;">
            <div class="p-6 flex items-center justify-between" style="border-bottom: 1px solid #f3f4f6;">
                <h3 class="text-xl font-bold" style="color: #111827;">All Consultations</h3>
                <a href="{{ route('patient.consultations') }}" style="font-size: 0.875rem; font-weight: 600; color: #16a34a; text-decoration: none;">View All &rarr;</a>
            </div>
            <div class="p-6">
                @if(!empty($stats['recent_consultations']) && count($stats['recent_consultations']) > 0)
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
                                @foreach($stats['recent_consultations'] as $consultation)
                                <tr style="border-bottom: 1px solid #f3f4f6;">
                                    <td class="px-4 py-4 text-sm font-medium" style="color: #111827;">{{ $consultation['consultation_number'] ?? '-' }}</td>
                                    <td class="px-4 py-4 text-sm" style="color: #6b7280;">
                                        @foreach($consultation['chief_complaints'] ?? [] as $cc)
                                            <span style="display: inline-block; background-color: #f0fdf4; color: #166534; font-size: 0.75rem; padding: 2px 8px; border-radius: 9999px; margin-right: 4px;">{{ $cc }}</span>
                                        @endforeach
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
                        <p class="text-lg font-medium" style="color: #6b7280;">No consultations found !</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Family Members Tab -->
    <div x-show="activeTab === 'family'" x-transition x-data="familyMemberManager()">
        <div class="bg-white rounded-2xl shadow-sm" style="border: 1px solid #f3f4f6;">
            <div class="p-6 flex items-center justify-between" style="border-bottom: 1px solid #f3f4f6;">
                <h3 class="text-xl font-bold" style="color: #111827;">Family Members</h3>
                <button @click="openAddModal()"
                        style="display: inline-flex; align-items: center; padding: 8px 16px; background-color: #16a34a; color: #ffffff; font-size: 0.875rem; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; text-decoration: none;"
                        onmouseover="this.style.backgroundColor='#15803d'" onmouseout="this.style.backgroundColor='#16a34a'">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 8px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add Member
                </button>
            </div>
            <div class="p-6">
                @if(!empty($familyMembers) && count($familyMembers) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($familyMembers as $member)
                        <div style="border: 1px solid #e5e7eb; border-radius: 12px; padding: 20px; background: #ffffff; position: relative;">
                            <!-- Member Avatar & Info -->
                            <div style="display: flex; align-items: center; margin-bottom: 16px;">
                                <div style="width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.125rem; color: #ffffff; flex-shrink: 0;
                                    background-color: {{ match($member['gender'] ?? '') { 'Male' => '#3b82f6', 'Female' => '#ec4899', default => '#8b5cf6' } }};">
                                    {{ strtoupper(substr($member['first_name'] ?? 'F', 0, 1)) }}
                                </div>
                                <div style="margin-left: 12px; min-width: 0;">
                                    <p style="font-weight: 600; color: #111827; font-size: 1rem; margin: 0;">{{ ($member['first_name'] ?? '') . ' ' . ($member['last_name'] ?? '') }}</p>
                                    <p style="font-size: 0.8125rem; color: #6b7280; margin: 2px 0 0 0;">{{ $member['relationship'] ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <!-- Details -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; font-size: 0.8125rem;">
                                <div>
                                    <span style="color: #9ca3af;">Gender</span>
                                    <p style="color: #374151; margin: 2px 0 0 0; font-weight: 500;">{{ $member['gender'] ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <span style="color: #9ca3af;">DOB</span>
                                    <p style="color: #374151; margin: 2px 0 0 0; font-weight: 500;">{{ $member['date_of_birth'] ?? 'N/A' }}</p>
                                </div>
                                @if(!empty($member['phone']))
                                <div>
                                    <span style="color: #9ca3af;">Phone</span>
                                    <p style="color: #374151; margin: 2px 0 0 0; font-weight: 500;">{{ $member['phone'] }}</p>
                                </div>
                                @endif
                                @if(!empty($member['blood_group']))
                                <div>
                                    <span style="color: #9ca3af;">Blood Group</span>
                                    <p style="color: #374151; margin: 2px 0 0 0; font-weight: 500;">{{ $member['blood_group'] }}</p>
                                </div>
                                @endif
                            </div>
                            <!-- Actions -->
                            <div style="display: flex; gap: 8px; margin-top: 16px; padding-top: 12px; border-top: 1px solid #f3f4f6;">
                                <button @click="openEditModal({{ json_encode($member) }})"
                                        style="flex: 1; padding: 6px 12px; font-size: 0.8125rem; font-weight: 500; color: #16a34a; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; cursor: pointer;">
                                    Edit
                                </button>
                                <form method="POST" action="{{ route('patient.family-members.delete', $member['id'] ?? 0) }}" style="flex: 1;"
                                      onsubmit="return confirm('Are you sure you want to remove this family member?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            style="width: 100%; padding: 6px 12px; font-size: 0.8125rem; font-weight: 500; color: #dc2626; background: #fef2f2; border: 1px solid #fecaca; border-radius: 6px; cursor: pointer;">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-12">
                        <div class="w-24 h-24 rounded-full flex items-center justify-center mb-4" style="background-color: #eff6ff;">
                            <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <p class="text-lg font-medium" style="color: #6b7280;">No family members added yet.</p>
                        <p class="text-sm mt-1" style="color: #9ca3af;">Add family members to book consultations on their behalf.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Add/Edit Family Member Modal -->
        <div x-show="showModal" x-transition x-cloak
             style="position: fixed; inset: 0; z-index: 100;"
             @keydown.escape.window="showModal = false">
            <!-- Backdrop -->
            <div @click="showModal = false" style="position: fixed; inset: 0; background-color: rgba(0,0,0,0.5);"></div>
            <!-- Centering Wrapper -->
            <div style="position: fixed; inset: 0; display: flex; align-items: center; justify-content: center; pointer-events: none;">
            <!-- Modal Content -->
            <div style="position: relative; background: #ffffff; border-radius: 16px; padding: 0; width: 100%; max-width: 520px; margin: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.15); max-height: 90vh; overflow-y: auto; z-index: 101; pointer-events: auto;">
                <!-- Modal Header -->
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 20px 24px; border-bottom: 1px solid #f3f4f6;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #111827; margin: 0;" x-text="editMode ? 'Edit Family Member' : 'Add Family Member'"></h3>
                    <button @click="showModal = false" style="background: none; border: none; cursor: pointer; padding: 4px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <!-- Modal Body -->
                <form :action="editMode ? '{{ url('patient/family-members') }}/' + editId : '{{ route('patient.family-members.store') }}'"
                      method="POST" style="padding: 24px;">
                    @csrf
                    <template x-if="editMode">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <!-- First Name -->
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 4px;">First Name <span style="color: #ef4444;">*</span></label>
                            <input type="text" name="first_name" x-model="form.first_name" required
                                   style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; outline: none; box-sizing: border-box;"
                                   onfocus="this.style.borderColor='#16a34a'; this.style.boxShadow='0 0 0 3px rgba(22,163,74,0.1)'"
                                   onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none'"
                                   placeholder="Enter first name">
                        </div>
                        <!-- Last Name -->
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 4px;">Last Name <span style="color: #ef4444;">*</span></label>
                            <input type="text" name="last_name" x-model="form.last_name" required
                                   style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; outline: none; box-sizing: border-box;"
                                   onfocus="this.style.borderColor='#16a34a'; this.style.boxShadow='0 0 0 3px rgba(22,163,74,0.1)'"
                                   onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none'"
                                   placeholder="Enter last name">
                        </div>
                        <!-- Relationship -->
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 4px;">Relationship <span style="color: #ef4444;">*</span></label>
                            <select name="relationship" x-model="form.relationship" required
                                    style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; outline: none; box-sizing: border-box; background: white;"
                                    onfocus="this.style.borderColor='#16a34a'" onblur="this.style.borderColor='#d1d5db'">
                                <option value="">Select...</option>
                                <option value="Spouse">Spouse</option>
                                <option value="Father">Father</option>
                                <option value="Mother">Mother</option>
                                <option value="Son">Son</option>
                                <option value="Daughter">Daughter</option>
                                <option value="Brother">Brother</option>
                                <option value="Sister">Sister</option>
                                <option value="Grandfather">Grandfather</option>
                                <option value="Grandmother">Grandmother</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <!-- Gender -->
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 4px;">Gender <span style="color: #ef4444;">*</span></label>
                            <select name="gender" x-model="form.gender" required
                                    style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; outline: none; box-sizing: border-box; background: white;"
                                    onfocus="this.style.borderColor='#16a34a'" onblur="this.style.borderColor='#d1d5db'">
                                <option value="">Select...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <!-- Date of Birth -->
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 4px;">Date of Birth <span style="color: #ef4444;">*</span></label>
                            <input type="date" name="date_of_birth" x-model="form.date_of_birth" required
                                   style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; outline: none; box-sizing: border-box;"
                                   onfocus="this.style.borderColor='#16a34a'" onblur="this.style.borderColor='#d1d5db'">
                        </div>
                        <!-- Blood Group -->
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 4px;">Blood Group</label>
                            <select name="blood_group" x-model="form.blood_group"
                                    style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; outline: none; box-sizing: border-box; background: white;"
                                    onfocus="this.style.borderColor='#16a34a'" onblur="this.style.borderColor='#d1d5db'">
                                <option value="">Select...</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                        <!-- Phone -->
                        <div style="grid-column: span 2;">
                            <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 4px;">Phone Number</label>
                            <input type="tel" name="phone" x-model="form.phone"
                                   style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; outline: none; box-sizing: border-box;"
                                   onfocus="this.style.borderColor='#16a34a'; this.style.boxShadow='0 0 0 3px rgba(22,163,74,0.1)'"
                                   onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none'"
                                   placeholder="Enter phone number">
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div style="display: flex; gap: 12px; margin-top: 24px; padding-top: 16px; border-top: 1px solid #f3f4f6;">
                        <button type="button" @click="showModal = false"
                                style="flex: 1; padding: 10px 20px; font-size: 0.875rem; font-weight: 600; color: #374151; background: #ffffff; border: 1px solid #d1d5db; border-radius: 8px; cursor: pointer;">
                            Cancel
                        </button>
                        <button type="submit"
                                style="flex: 1; padding: 10px 20px; font-size: 0.875rem; font-weight: 600; color: #ffffff; background-color: #16a34a; border: none; border-radius: 8px; cursor: pointer;"
                                onmouseover="this.style.backgroundColor='#15803d'" onmouseout="this.style.backgroundColor='#16a34a'"
                                x-text="editMode ? 'Update Member' : 'Add Member'">
                        </button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
function familyMemberManager() {
    return {
        showModal: false,
        editMode: false,
        editId: null,
        form: {
            first_name: '',
            last_name: '',
            relationship: '',
            gender: '',
            date_of_birth: '',
            blood_group: '',
            phone: '',
        },
        openAddModal() {
            this.editMode = false;
            this.editId = null;
            this.form = { first_name: '', last_name: '', relationship: '', gender: '', date_of_birth: '', blood_group: '', phone: '' };
            this.showModal = true;
        },
        openEditModal(member) {
            this.editMode = true;
            this.editId = member.id;
            this.form = {
                first_name: member.first_name || '',
                last_name: member.last_name || '',
                relationship: member.relationship || '',
                gender: member.gender || '',
                date_of_birth: member.date_of_birth || '',
                blood_group: member.blood_group || '',
                phone: member.phone || '',
            };
            this.showModal = true;
        },
    };
}
</script>
@endpush
@endsection
