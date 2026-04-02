@extends('layouts.patient')

@section('title', 'Family Members')

@section('content')
<div x-data="familyMemberManager()">

    <!-- Header -->
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
        <div>
            <h2 style="font-size: 1.5rem; font-weight: 700; color: #111827; margin: 0;">Family Members</h2>
            <p style="font-size: 0.875rem; color: #6b7280; margin-top: 4px;">Manage your family members to book consultations on their behalf.</p>
        </div>
        <button @click="openAddModal()"
                style="display: inline-flex; align-items: center; padding: 10px 20px; background-color: #16a34a; color: #ffffff; font-size: 0.875rem; font-weight: 600; border-radius: 8px; border: none; cursor: pointer;"
                onmouseover="this.style.backgroundColor='#15803d'" onmouseout="this.style.backgroundColor='#16a34a'">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 8px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Add Member
        </button>
    </div>

    @if(!empty($members) && count($members) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($members as $member)
            <div style="border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; background: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <!-- Member Avatar & Info -->
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <div style="width: 52px; height: 52px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.25rem; color: #ffffff; flex-shrink: 0;
                        background-color: {{ match($member['gender'] ?? '') { 'Male' => '#3b82f6', 'Female' => '#ec4899', default => '#8b5cf6' } }};">
                        {{ strtoupper(substr($member['first_name'] ?? 'F', 0, 1)) }}
                    </div>
                    <div style="margin-left: 14px; min-width: 0;">
                        <p style="font-weight: 600; color: #111827; font-size: 1.0625rem; margin: 0;">{{ ($member['first_name'] ?? '') . ' ' . ($member['last_name'] ?? '') }}</p>
                        <span style="display: inline-block; margin-top: 4px; padding: 2px 10px; font-size: 0.75rem; font-weight: 500; border-radius: 9999px; background-color: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0;">
                            {{ $member['relationship'] ?? 'N/A' }}
                        </span>
                    </div>
                </div>
                <!-- Details -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; font-size: 0.8125rem; margin-bottom: 16px;">
                    <div>
                        <span style="color: #9ca3af; font-size: 0.75rem;">Gender</span>
                        <p style="color: #374151; margin: 2px 0 0 0; font-weight: 500;">{{ $member['gender'] ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span style="color: #9ca3af; font-size: 0.75rem;">Date of Birth</span>
                        <p style="color: #374151; margin: 2px 0 0 0; font-weight: 500;">{{ $member['date_of_birth'] ?? 'N/A' }}</p>
                    </div>
                    @if(!empty($member['phone']))
                    <div>
                        <span style="color: #9ca3af; font-size: 0.75rem;">Phone</span>
                        <p style="color: #374151; margin: 2px 0 0 0; font-weight: 500;">{{ $member['phone'] }}</p>
                    </div>
                    @endif
                    @if(!empty($member['blood_group']))
                    <div>
                        <span style="color: #9ca3af; font-size: 0.75rem;">Blood Group</span>
                        <p style="color: #374151; margin: 2px 0 0 0; font-weight: 500;">
                            <span style="display: inline-block; padding: 1px 8px; background-color: #fef2f2; color: #dc2626; border-radius: 4px; font-weight: 600;">{{ $member['blood_group'] }}</span>
                        </p>
                    </div>
                    @endif
                </div>
                <!-- Actions -->
                <div style="display: flex; gap: 8px; padding-top: 14px; border-top: 1px solid #f3f4f6;">
                    <button @click="openEditModal({{ json_encode($member) }})"
                            style="flex: 1; padding: 8px 14px; font-size: 0.8125rem; font-weight: 500; color: #16a34a; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 4px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </button>
                    <form method="POST" action="{{ route('patient.family-members.delete', $member['id'] ?? 0) }}" style="flex: 1;"
                          onsubmit="return confirm('Are you sure you want to remove this family member?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                style="width: 100%; padding: 8px 14px; font-size: 0.8125rem; font-weight: 500; color: #dc2626; background: #fef2f2; border: 1px solid #fecaca; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 4px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Remove
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-sm" style="border: 1px solid #f3f4f6;">
            <div class="flex flex-col items-center justify-center py-16">
                <div class="w-28 h-28 rounded-full flex items-center justify-center mb-5" style="background-color: #eff6ff;">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <p class="text-lg font-medium" style="color: #6b7280;">No family members added yet.</p>
                <p class="text-sm mt-2" style="color: #9ca3af;">Click "Add Member" to add your first family member.</p>
            </div>
        </div>
    @endif

    <!-- Add/Edit Family Member Modal -->
    <div x-show="showModal" x-transition x-cloak
         style="position: fixed; inset: 0; z-index: 100;"
         @keydown.escape.window="showModal = false">
        <div @click="showModal = false" style="position: fixed; inset: 0; background-color: rgba(0,0,0,0.5);"></div>
        <div style="position: fixed; inset: 0; display: flex; align-items: center; justify-content: center; pointer-events: none;">
        <div style="position: relative; background: #ffffff; border-radius: 16px; width: 100%; max-width: 520px; margin: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.15); max-height: 90vh; overflow-y: auto; z-index: 101; pointer-events: auto;">
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 20px 24px; border-bottom: 1px solid #f3f4f6;">
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #111827; margin: 0;" x-text="editMode ? 'Edit Family Member' : 'Add Family Member'"></h3>
                <button @click="showModal = false" style="background: none; border: none; cursor: pointer; padding: 4px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form :action="editMode ? '{{ url('patient/family-members') }}/' + editId : '{{ route('patient.family-members.store') }}'"
                  method="POST" style="padding: 24px;">
                @csrf
                <template x-if="editMode">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 4px;">First Name <span style="color: #ef4444;">*</span></label>
                        <input type="text" name="first_name" x-model="form.first_name" required placeholder="Enter first name"
                               style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; outline: none; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#16a34a';this.style.boxShadow='0 0 0 3px rgba(22,163,74,0.1)'"
                               onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 4px;">Last Name <span style="color: #ef4444;">*</span></label>
                        <input type="text" name="last_name" x-model="form.last_name" required placeholder="Enter last name"
                               style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; outline: none; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#16a34a';this.style.boxShadow='0 0 0 3px rgba(22,163,74,0.1)'"
                               onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 4px;">Relationship <span style="color: #ef4444;">*</span></label>
                        <select name="relationship" x-model="form.relationship" required
                                style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; outline: none; box-sizing: border-box; background: white;">
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
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 4px;">Gender <span style="color: #ef4444;">*</span></label>
                        <select name="gender" x-model="form.gender" required
                                style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; outline: none; box-sizing: border-box; background: white;">
                            <option value="">Select...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 4px;">Date of Birth <span style="color: #ef4444;">*</span></label>
                        <input type="date" name="date_of_birth" x-model="form.date_of_birth" required
                               style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; outline: none; box-sizing: border-box;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 4px;">Blood Group</label>
                        <select name="blood_group" x-model="form.blood_group"
                                style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; outline: none; box-sizing: border-box; background: white;">
                            <option value="">Select...</option>
                            <option value="A+">A+</option><option value="A-">A-</option>
                            <option value="B+">B+</option><option value="B-">B-</option>
                            <option value="AB+">AB+</option><option value="AB-">AB-</option>
                            <option value="O+">O+</option><option value="O-">O-</option>
                        </select>
                    </div>
                    <div style="grid-column: span 2;">
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 4px;">Phone Number</label>
                        <input type="tel" name="phone" x-model="form.phone" placeholder="Enter phone number"
                               style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; outline: none; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#16a34a';this.style.boxShadow='0 0 0 3px rgba(22,163,74,0.1)'"
                               onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                    </div>
                </div>
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
