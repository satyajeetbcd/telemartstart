@extends('layouts.patient')

@section('title', isset($editMode) ? 'Edit Consultation' : 'Consult Now')

@section('content')
<div x-data="consultationForm()" class="max-w-4xl mx-auto">

    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ isset($editMode) ? route('patient.consultation.show', $consultation['id']) : route('patient.dashboard') }}" class="inline-flex items-center text-gray-600 hover:text-green-700 font-medium text-sm">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            {{ isset($editMode) ? 'Back to Consultation' : 'Back' }}
        </a>
    </div>

    <!-- Completion Score -->
    <div style="background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 16px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
            <h3 style="font-size: 1.125rem; font-weight: 700; color: #111827; margin: 0;">Completion Score: <span x-text="completionPercent + '%'"></span></h3>
        </div>
        <div style="width: 100%; height: 16px; border-radius: 9999px; overflow: hidden; display: flex;">
            <div x-ref="progressFill"
                 x-effect="
                    let color = '#ef4444';
                    if (completionPercent >= 70) color = '#22c55e';
                    else if (completionPercent >= 30) color = '#f59e0b';
                    $refs.progressFill.style.width = completionPercent + '%';
                    $refs.progressFill.style.backgroundColor = color;
                 "
                 style="height: 100%; width: 0%; background-color: #ef4444; transition: width 0.5s ease, background-color 0.3s ease; border-radius: 9999px 0 0 9999px;"></div>
            <div style="flex: 1; height: 100%; background-color: #bbf7d0; border-radius: 0 9999px 9999px 0;"></div>
        </div>
    </div>

    <form method="POST"
          action="{{ isset($editMode) ? route('patient.consultation.update', $consultation['id']) : route('patient.consultation.store') }}"
          enctype="multipart/form-data" @submit="prepareSubmit()">
        @csrf
        @if(isset($editMode))
            @method('PUT')
        @endif

        <!-- Hidden fields for JSON data -->
        <input type="hidden" name="is_followup" :value="isFollowup === null ? '' : (isFollowup ? '1' : '0')">
        <input type="hidden" name="chief_complaints" :value="JSON.stringify(selectedComplaints.map(c => ({name: c, sub_answers: subAnswers[c] || {}})))">
        <input type="hidden" name="patient_history" :value="JSON.stringify(patientHistory)">
        <input type="hidden" name="personal_history" :value="JSON.stringify(personalHistory)">
        <input type="hidden" name="family_history" :value="JSON.stringify(familyHistory)">
        <input type="hidden" name="allergies" :value="JSON.stringify(allergies)">
        <input type="hidden" name="medications" :value="JSON.stringify(medications)">
        <input type="hidden" name="location_preference" :value="locationPreference">
        <input type="hidden" name="state" :value="selectedState">
        <input type="hidden" name="opd" :value="opd">
        <input type="hidden" name="doctor_id" :value="doctorId">
        <input type="hidden" name="query" :value="queryText">

        <!-- Follow-up Question -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-4">
            <p class="text-base font-semibold text-gray-900">Is it a follow-up consultation?<span class="text-red-500">*</span></p>
            <div class="flex items-center space-x-6 mt-3">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="followup_radio" value="yes" x-model="isFollowup" class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500" :checked="isFollowup === true" @click="isFollowup = true">
                    <span class="ml-2 text-sm text-gray-700">Yes</span>
                </label>
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="followup_radio" value="no" x-model="isFollowup" class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500" :checked="isFollowup === false" @click="isFollowup = false">
                    <span class="ml-2 text-sm text-gray-700">No</span>
                </label>
            </div>
        </div>

        <!-- Step 1: Chief Complaints -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4 overflow-hidden">
            <button type="button" @click="toggleStep(1)"
                    class="w-full flex items-center justify-between p-5 text-left hover:bg-gray-50 transition-colors">
                <div class="flex items-center">
                    <span class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3"
                          :class="selectedComplaints.length > 0 ? 'bg-green-500' : 'bg-orange-500'">1</span>
                    <span class="text-base font-semibold text-gray-900">Chief Complaints <span class="text-red-500">*</span></span>
                </div>
                <svg class="w-5 h-5 text-gray-400 transition-transform" :class="openStep === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="openStep === 1" x-transition x-collapse class="border-t border-gray-200">
                <div class="p-5">

                    <!-- Search -->
                    <div class="relative mb-4 max-w-sm">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" x-model="complaintSearch" placeholder="Type here for search"
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    </div>

                    <!-- Complaint Tags -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        <template x-for="complaint in filteredComplaints" :key="complaint">
                            <button type="button" @click="addComplaint(complaint)"
                                    class="px-4 py-2 rounded-full text-sm font-medium border transition-colors"
                                    :class="selectedComplaints.includes(complaint) ? 'bg-green-100 border-green-500 text-green-700' : 'bg-white border-gray-300 text-gray-700 hover:border-green-400 hover:bg-green-50'">
                                <span x-text="complaint"></span>
                            </button>
                        </template>
                    </div>

                    <!-- Selected Complaints -->
                    <template x-if="selectedComplaints.length > 0">
                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-600 mb-2">Selected:</p>
                            <div class="flex flex-wrap gap-2">
                                <template x-for="(complaint, idx) in selectedComplaints" :key="'sel-'+idx">
                                    <span class="inline-flex items-center px-3 py-1.5 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                        <span x-text="complaint"></span>
                                        <button type="button" @click="removeComplaint(idx)" class="ml-2 text-green-600 hover:text-red-500">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                        </button>
                                    </span>
                                </template>
                            </div>
                        </div>
                    </template>

                    <!-- Add Custom Complaint -->
                    <div class="flex items-center gap-2 mb-4">
                        <input type="text" x-model="customComplaint" placeholder="Enter custom complaint"
                               class="flex-1 max-w-xs px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <button type="button" @click="addCustomComplaint()"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                            Add to the list
                        </button>
                    </div>

                    <!-- Wizard-style sub-questions for each selected complaint -->
                    <template x-for="complaint in selectedComplaints" :key="'wizard-'+complaint">
                        <div x-show="subQuestionMap[complaint]" class="mt-4 border border-gray-200 rounded-xl overflow-hidden">

                            <!-- Complaint Header -->
                            <div class="bg-green-50 px-5 py-3 flex items-center justify-between">
                                <h4 class="font-semibold text-green-800 text-sm" x-text="complaint + ' - Assessment'"></h4>
                                <span class="text-xs font-medium px-2 py-1 rounded-full"
                                      :class="isComplaintDone(complaint) ? 'bg-green-200 text-green-800' : 'bg-orange-100 text-orange-700'"
                                      x-text="isComplaintDone(complaint) ? 'Completed' : ('Question ' + (getComplaintStep(complaint) + 1) + ' of ' + (subQuestionMap[complaint] || []).length)">
                                </span>
                            </div>

                            <!-- Question Progress Bar -->
                            <div class="px-5 pt-3">
                                <div class="w-full h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-green-500 rounded-full transition-all duration-300"
                                         :style="'width: ' + getComplaintProgress(complaint) + '%'"></div>
                                </div>
                            </div>

                            <!-- Wizard: Show one question at a time -->
                            <div x-show="!isComplaintDone(complaint)" class="p-5">
                                <!-- Question Text -->
                                <p class="text-base font-medium text-gray-900 mb-4"
                                   x-text="(subQuestionMap[complaint] && subQuestionMap[complaint][getComplaintStep(complaint)]) ? subQuestionMap[complaint][getComplaintStep(complaint)].question : ''"></p>

                                <!-- Single Select Options -->
                                <div x-show="subQuestionMap[complaint] && subQuestionMap[complaint][getComplaintStep(complaint)] && subQuestionMap[complaint][getComplaintStep(complaint)].type === 'single'"
                                     class="flex flex-wrap gap-2">
                                    <template x-for="opt in (subQuestionMap[complaint] && subQuestionMap[complaint][getComplaintStep(complaint)] && subQuestionMap[complaint][getComplaintStep(complaint)].type === 'single') ? subQuestionMap[complaint][getComplaintStep(complaint)].options : []" :key="opt">
                                        <button type="button"
                                                @click="selectSingleAnswer(complaint, subQuestionMap[complaint][getComplaintStep(complaint)].id, opt)"
                                                class="px-4 py-2.5 rounded-lg text-sm font-medium border transition-all"
                                                :class="subAnswers[complaint] && subAnswers[complaint][subQuestionMap[complaint][getComplaintStep(complaint)].id] === opt
                                                    ? 'bg-green-100 border-green-500 text-green-700 ring-2 ring-green-200'
                                                    : 'bg-white border-gray-300 text-gray-700 hover:border-green-400 hover:bg-green-50'">
                                            <span x-text="opt"></span>
                                        </button>
                                    </template>
                                </div>

                                <!-- Multi Select Options -->
                                <div x-show="subQuestionMap[complaint] && subQuestionMap[complaint][getComplaintStep(complaint)] && subQuestionMap[complaint][getComplaintStep(complaint)].type === 'multi'"
                                     class="flex flex-wrap gap-2">
                                    <template x-for="opt in (subQuestionMap[complaint] && subQuestionMap[complaint][getComplaintStep(complaint)] && subQuestionMap[complaint][getComplaintStep(complaint)].type === 'multi') ? subQuestionMap[complaint][getComplaintStep(complaint)].options : []" :key="opt">
                                        <button type="button"
                                                @click="toggleMultiAnswer(complaint, subQuestionMap[complaint][getComplaintStep(complaint)].id, opt)"
                                                class="px-4 py-2.5 rounded-lg text-sm font-medium border transition-all"
                                                :class="subAnswers[complaint] && Array.isArray(subAnswers[complaint][subQuestionMap[complaint][getComplaintStep(complaint)].id]) && subAnswers[complaint][subQuestionMap[complaint][getComplaintStep(complaint)].id].includes(opt)
                                                    ? 'bg-green-100 border-green-500 text-green-700 ring-2 ring-green-200'
                                                    : 'bg-white border-gray-300 text-gray-700 hover:border-green-400 hover:bg-green-50'">
                                            <span class="inline-flex items-center">
                                                <svg x-show="subAnswers[complaint] && Array.isArray(subAnswers[complaint][subQuestionMap[complaint][getComplaintStep(complaint)].id]) && subAnswers[complaint][subQuestionMap[complaint][getComplaintStep(complaint)].id].includes(opt)"
                                                     class="w-4 h-4 mr-1.5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                                <span x-text="opt"></span>
                                            </span>
                                        </button>
                                    </template>
                                </div>

                                <!-- Text Input -->
                                <div x-show="subQuestionMap[complaint] && subQuestionMap[complaint][getComplaintStep(complaint)] && subQuestionMap[complaint][getComplaintStep(complaint)].type === 'text'">
                                    <input type="text"
                                           :placeholder="(subQuestionMap[complaint] && subQuestionMap[complaint][getComplaintStep(complaint)]) ? (subQuestionMap[complaint][getComplaintStep(complaint)].placeholder || 'Type your answer...') : ''"
                                           x-model="subAnswers[complaint] && subQuestionMap[complaint] && subQuestionMap[complaint][getComplaintStep(complaint)] ? subAnswers[complaint][subQuestionMap[complaint][getComplaintStep(complaint)].id] : ''"
                                           @input="if(subQuestionMap[complaint] && subQuestionMap[complaint][getComplaintStep(complaint)]) { if(!subAnswers[complaint]) subAnswers[complaint]={}; subAnswers[complaint][subQuestionMap[complaint][getComplaintStep(complaint)].id] = $event.target.value; subAnswers = Object.assign({}, subAnswers); }"
                                           class="w-full max-w-md px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
                                    <div>
                                        <button type="button"
                                                x-show="getComplaintStep(complaint) > 0"
                                                @click="prevQuestion(complaint)"
                                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                            </svg>
                                            Previous
                                        </button>
                                    </div>

                                    <button type="button"
                                            @click="nextQuestion(complaint)"
                                            :disabled="!hasCurrentAnswer(complaint)"
                                            class="inline-flex items-center px-5 py-2 text-sm font-semibold rounded-lg transition-colors"
                                            :class="hasCurrentAnswer(complaint) ? 'bg-brand-600 hover:bg-brand-700 text-white' : 'bg-gray-200 text-gray-400 cursor-not-allowed'">
                                        <span x-text="getComplaintStep(complaint) < (subQuestionMap[complaint] || []).length - 1 ? 'Next Question' : 'Complete'"></span>
                                        <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Summary View (after all questions answered) -->
                            <div x-show="isComplaintDone(complaint)" class="p-5">
                                <div class="space-y-3">
                                    <template x-for="(q, qIdx) in (subQuestionMap[complaint] || [])" :key="'summary-'+q.id">
                                        <div class="flex items-start p-3 rounded-lg" :class="qIdx % 2 === 0 ? 'bg-gray-50' : 'bg-white'">
                                            <div class="flex-shrink-0 w-6 h-6 bg-green-100 text-green-700 rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-0.5"
                                                 x-text="qIdx + 1"></div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-700" x-text="q.question"></p>
                                                <p class="text-sm text-green-700 font-semibold mt-1"
                                                   x-text="formatAnswer(complaint, q.id)"></p>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <div class="mt-4 pt-3 border-t border-gray-100">
                                    <button type="button" @click="editComplaintAnswers(complaint)"
                                            class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-700">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit Answers
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Save & Next -->
                    <div class="mt-4">
                        <button type="button" @click="openStep = 2"
                                class="inline-flex items-center px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg transition-colors">
                            Save & Next
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 2: History -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4 overflow-hidden">
            <button type="button" @click="toggleStep(2)"
                    class="w-full flex items-center justify-between p-5 text-left hover:bg-gray-50 transition-colors">
                <div class="flex items-center">
                    <span class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3"
                          :class="patientHistory.length > 0 || familyHistory.length > 0 || personalHistory.alcohol || personalHistory.smoking || personalHistory.drug ? 'bg-green-500' : 'bg-orange-500'">2</span>
                    <span class="text-base font-semibold text-gray-900">History</span>
                </div>
                <svg class="w-5 h-5 text-gray-400 transition-transform" :class="openStep === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="openStep === 2" x-transition x-collapse class="border-t border-gray-200">
                <div class="p-5 space-y-6">

                    <!-- Patient History -->
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-3">Patient History</h4>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            <template x-for="item in patientHistoryOptions" :key="item">
                                <label class="flex items-center cursor-pointer p-2 rounded-lg hover:bg-gray-50">
                                    <input type="checkbox" :value="item" x-model="patientHistory"
                                           class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                    <span class="ml-2 text-sm text-gray-700" x-text="item"></span>
                                </label>
                            </template>
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <!-- Personal History -->
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-3">Personal History</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <template x-for="item in personalHistoryOptions" :key="item.key">
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <span class="text-sm font-medium text-gray-700" x-text="item.label"></span>
                                    <div class="flex items-center space-x-3">
                                        <label class="flex items-center cursor-pointer">
                                            <input type="radio" :name="'personal_' + item.key" value="yes"
                                                   @click="personalHistory[item.key] = true"
                                                   :checked="personalHistory[item.key] === true"
                                                   class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                                            <span class="ml-1 text-sm text-gray-600">Yes</span>
                                        </label>
                                        <label class="flex items-center cursor-pointer">
                                            <input type="radio" :name="'personal_' + item.key" value="no"
                                                   @click="personalHistory[item.key] = false"
                                                   :checked="personalHistory[item.key] === false"
                                                   class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                                            <span class="ml-1 text-sm text-gray-600">No</span>
                                        </label>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <!-- Family Medical History -->
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-3">Family Medical History</h4>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            <template x-for="item in familyHistoryOptions" :key="item">
                                <label class="flex items-center cursor-pointer p-2 rounded-lg hover:bg-gray-50">
                                    <input type="checkbox" :value="item" x-model="familyHistory"
                                           class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                    <span class="ml-2 text-sm text-gray-700" x-text="item"></span>
                                </label>
                            </template>
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <!-- Allergy -->
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-3">Allergy</h4>
                        <template x-for="(allergy, idx) in allergies" :key="'allergy-'+idx">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-3 p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Allergy Name</label>
                                    <input type="text" x-model="allergy.name" placeholder="e.g. Penicillin"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Duration</label>
                                    <input type="text" x-model="allergy.duration" placeholder="e.g. 2 years"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Severity</label>
                                    <select x-model="allergy.severity"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        <option value="">Select...</option>
                                        <option value="Mild">Mild</option>
                                        <option value="Moderate">Moderate</option>
                                        <option value="Severe">Severe</option>
                                    </select>
                                </div>
                                <div class="flex items-end">
                                    <button type="button" @click="allergies.splice(idx, 1)"
                                            class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg text-sm font-medium transition-colors">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </template>
                        <button type="button" @click="allergies.push({name:'', duration:'', severity:''})"
                                class="text-sm text-green-600 hover:text-green-700 font-medium">
                            + Add Allergy
                        </button>
                    </div>

                    <!-- Save & Next -->
                    <div class="mt-4">
                        <button type="button" @click="openStep = 3"
                                class="inline-flex items-center px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg transition-colors">
                            Save & Next
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 3: Active Medication -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4 overflow-hidden">
            <button type="button" @click="toggleStep(3)"
                    class="w-full flex items-center justify-between p-5 text-left hover:bg-gray-50 transition-colors">
                <div class="flex items-center">
                    <span class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3"
                          :class="medications.some(m => m.name) ? 'bg-green-500' : 'bg-orange-500'">3</span>
                    <span class="text-base font-semibold text-gray-900">Active Medication</span>
                </div>
                <svg class="w-5 h-5 text-gray-400 transition-transform" :class="openStep === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="openStep === 3" x-transition x-collapse class="border-t border-gray-200">
                <div class="p-5">
                    <template x-for="(med, idx) in medications" :key="'med-'+idx">
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 mb-3">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-semibold text-gray-700" x-text="'Medication ' + (idx + 1)"></span>
                                <button type="button" @click="medications.splice(idx, 1)" x-show="medications.length > 1"
                                        class="text-red-500 hover:text-red-700 text-sm font-medium">Remove</button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Medicine Name</label>
                                    <input type="text" x-model="med.name" placeholder="Enter medicine name"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Frequency</label>
                                    <select x-model="med.frequency"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        <option value="">Select...</option>
                                        <option value="Once daily">Once daily</option>
                                        <option value="Twice daily">Twice daily</option>
                                        <option value="Three times daily">Three times daily</option>
                                        <option value="Four times daily">Four times daily</option>
                                        <option value="As needed">As needed</option>
                                        <option value="Weekly">Weekly</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Dose</label>
                                    <input type="text" x-model="med.dose" placeholder="e.g. 500mg"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Type</label>
                                    <select x-model="med.type"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        <option value="">Select...</option>
                                        <option value="Tablet">Tablet</option>
                                        <option value="Capsule">Capsule</option>
                                        <option value="Syrup">Syrup</option>
                                        <option value="Injection">Injection</option>
                                        <option value="Cream">Cream</option>
                                        <option value="Drops">Drops</option>
                                        <option value="Inhaler">Inhaler</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Duration Value</label>
                                    <input type="number" x-model="med.duration_value" placeholder="e.g. 7" min="1"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Duration Type</label>
                                    <select x-model="med.duration_type"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        <option value="">Select...</option>
                                        <option value="Days">Days</option>
                                        <option value="Weeks">Weeks</option>
                                        <option value="Months">Months</option>
                                        <option value="Years">Years</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </template>

                    <button type="button" @click="medications.push({name:'', frequency:'', dose:'', type:'', duration_value:'', duration_type:''})"
                            class="text-sm text-green-600 hover:text-green-700 font-medium">
                        + Add Another Medication
                    </button>

                    <!-- Save & Next -->
                    <div class="mt-4">
                        <button type="button" @click="openStep = 4"
                                class="inline-flex items-center px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg transition-colors">
                            Save & Next
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 4: Health Records -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4 overflow-hidden">
            <button type="button" @click="toggleStep(4)"
                    class="w-full flex items-center justify-between p-5 text-left hover:bg-gray-50 transition-colors">
                <div class="flex items-center">
                    <span class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3"
                          :class="files.length > 0 ? 'bg-green-500' : 'bg-orange-500'">4</span>
                    <span class="text-base font-semibold text-gray-900">Health Records</span>
                </div>
                <svg class="w-5 h-5 text-gray-400 transition-transform" :class="openStep === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="openStep === 4" x-transition x-collapse class="border-t border-gray-200">
                <div class="p-5">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-green-400 transition-colors"
                         @dragover.prevent="$el.classList.add('border-green-500', 'bg-green-50')"
                         @dragleave.prevent="$el.classList.remove('border-green-500', 'bg-green-50')"
                         @drop.prevent="handleDrop($event); $el.classList.remove('border-green-500', 'bg-green-50')">
                        <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p class="text-sm text-gray-600 mb-2">Drag & drop files here, or</p>
                        <label class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg cursor-pointer transition-colors">
                            Browse Files
                            <input type="file" name="health_records[]" multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                   @change="handleFiles($event)" class="hidden">
                        </label>
                        <p class="text-xs text-gray-400 mt-2">PDF, JPG, PNG, DOC, DOCX - Max 10MB each (up to 5 files)</p>
                    </div>

                    <template x-if="files.length > 0">
                        <div class="mt-4 space-y-2">
                            <template x-for="(file, idx) in files" :key="'file-'+idx">
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center min-w-0">
                                        <svg class="w-5 h-5 text-gray-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <span class="text-sm text-gray-700 truncate" x-text="file.name"></span>
                                        <span class="text-xs text-gray-400 ml-2 flex-shrink-0" x-text="(file.size / 1024 / 1024).toFixed(2) + ' MB'"></span>
                                    </div>
                                    <button type="button" @click="removeFile(idx)" class="text-red-500 hover:text-red-700 ml-2 flex-shrink-0">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </template>

                    <!-- Save & Next -->
                    <div class="mt-4">
                        <button type="button" @click="openStep = 5"
                                class="inline-flex items-center px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg transition-colors">
                            Save & Next
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 5: Query -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4 overflow-hidden">
            <button type="button" @click="toggleStep(5)"
                    class="w-full flex items-center justify-between p-5 text-left hover:bg-gray-50 transition-colors">
                <div class="flex items-center">
                    <span class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3"
                          :class="queryText.length > 0 ? 'bg-green-500' : 'bg-orange-500'">5</span>
                    <span class="text-base font-semibold text-gray-900">Query <span class="text-red-500">*</span></span>
                </div>
                <svg class="w-5 h-5 text-gray-400 transition-transform" :class="openStep === 5 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="openStep === 5" x-transition x-collapse class="border-t border-gray-200">
                <div class="p-5 space-y-5">

                    <!-- Query Textarea -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Query <span class="text-red-500">*</span></label>
                        <textarea x-model="queryText" rows="4" required
                                  placeholder="Enter Query (Recommended: minimum 100 characters)"
                                  maxlength="1500"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 resize-y"></textarea>
                        <p class="text-xs text-gray-500 mt-1">Limit: <span x-text="queryText.length"></span>/1500 Characters</p>
                    </div>

                    <!-- Location Preference -->
                    <div class="flex flex-wrap gap-4">
                        <template x-for="pref in locationOptions" :key="pref.value">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="location_pref_radio" :value="pref.value"
                                       x-model="locationPreference"
                                       class="w-4 h-4 text-brand-600 border-gray-300 focus:ring-brand-500">
                                <span class="ml-2 text-sm text-gray-700" x-text="pref.label"></span>
                            </label>
                        </template>
                    </div>

                    <!-- State, OPD Selection -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">State/UT</label>
                            <select x-model="selectedState"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                                <option value="">Select State...</option>
                                <template x-for="s in indianStates" :key="s">
                                    <option :value="s" x-text="s"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">OPD</label>
                            <select x-model="opd"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                                <option value="">Select OPD...</option>
                                <template x-for="item in opdOptions" :key="item">
                                    <option :value="item" x-text="item"></option>
                                </template>
                            </select>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="pt-4 border-t border-gray-200">
                        <button type="submit"
                                class="inline-flex items-center px-8 py-3 bg-brand-600 hover:bg-brand-700 text-white text-base font-semibold rounded-lg shadow transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                            </svg>
                            {{ isset($editMode) ? 'Update Consultation' : 'Save & Book Appointment' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

@push('scripts')
<script>
const SUB_QUESTION_MAP = {
    'Fever': [
        { id: 'duration', question: 'Since how long do you have fever?', type: 'single', options: ['Every seasonal change', 'Recently (1-2 days)', '1-2 weeks', '1 month', 'Since last night'] },
        { id: 'onset', question: 'How did the fever start?', type: 'single', options: ['Slowly', 'Suddenly'] },
        { id: 'fever_type', question: 'How is your fever?', type: 'single', options: ['High fever with shivering', 'High fever with chills', 'High fever with chills & shivering', 'Low grade fever'] },
        { id: 'temperature', question: 'What is your temperature?', type: 'text', placeholder: 'e.g. 101°F or 38.5°C' },
        { id: 'causes', question: 'Possible associated causes or triggers?', type: 'multi', options: ['Heat exhaustion', 'Sunburn', 'Sunstroke', 'Insect bite', 'Abdominal discomfort', 'Blood donation', 'Receiving blood', 'Burning urination', 'Other / Not applicable'] },
    ],
    'Headache': [
        { id: 'duration', question: 'Since when are you having headache?', type: 'single', options: ['Every seasonal change', 'Since birth', 'Recently (1-2 days)', '1-2 weeks', '1 month', 'Many years'] },
        { id: 'when_worse', question: 'When in the day headache is more?', type: 'single', options: ['All day', 'Morning', 'Afternoon', 'Evening'] },
        { id: 'recurrence', question: 'Is the headache recurrent?', type: 'single', options: ['Not recurrent', 'Recurred after days', 'Recurred after weeks', 'Recurred after months'] },
        { id: 'triggers', question: 'What makes your headache worse?', type: 'multi', options: ['Sunlight', 'Stress', 'Reading', 'Watching television', 'Working on computer', 'Loud sound', 'Hunger', 'Other / Not applicable'] },
        { id: 'relief', question: 'What makes your headache better?', type: 'multi', options: ['Rest', 'Painkillers', 'Vomiting', 'Home treatment', 'Other'] },
        { id: 'related_conditions', question: 'Possible related conditions?', type: 'multi', options: ['Seizure', 'Migraine', 'High blood pressure', 'Not applicable'] },
        { id: 'associated', question: 'Associated symptoms?', type: 'multi', options: ['Fever', 'Seizure', 'Vomiting', 'High BP', 'Recent or past head injury', 'Vision problems', 'Sinus infection', 'Weakness in any limb', 'Other / Not applicable'] },
    ],
    'Common Cold': [
        { id: 'duration', question: 'Since how long do you have common cold?', type: 'single', options: ['Every seasonal change', 'Since birth', 'Recently (1-2 days)', '1-2 weeks', '1 month', 'Many years'] },
        { id: 'onset', question: 'How did the cold start?', type: 'single', options: ['Suddenly', 'Slowly'] },
        { id: 'when_worse', question: 'When is the problem more?', type: 'single', options: ['All day', 'Morning', 'Afternoon', 'Evening'] },
        { id: 'triggers', question: 'What makes your cold worse?', type: 'multi', options: ['Dust', 'Cold weather', 'Cold things', 'Passive air pollution', 'Exertion during activity', 'Other / Not applicable'] },
        { id: 'relief', question: 'What makes your cold better?', type: 'multi', options: ['Rest', 'Home treatment', 'Medication', 'Nebulization', 'Other', 'Not applicable'] },
        { id: 'family', question: 'Is anyone else in your family or home experiencing cold symptoms?', type: 'single', options: ['Yes - seen in family member', 'No - not seen in family/home', 'Not applicable'] },
        { id: 'associated', question: 'Do you have any associated problems?', type: 'multi', options: ['Sneezing', 'Cough', 'Runny nose', 'Cough when lying on back', 'Chest tightness', 'Retractions', 'Wheezing', 'Whooping', 'Other / Not applicable'] },
    ],
    'Cough': [
        { id: 'duration', question: 'Since how long do you have a cough?', type: 'single', options: ['Few days', 'Few weeks', 'Few months', 'Many years'] },
        { id: 'when_worse', question: 'When is the coughing more?', type: 'single', options: ['Early Morning', 'Morning', 'Evening', 'Night', 'Whole Day'] },
        { id: 'continuous', question: 'Do you have continuous cough?', type: 'single', options: ['No, cough with pauses', 'Continuous cough for days', 'Continuous cough for weeks', 'Not applicable'] },
        { id: 'relief', question: 'What makes your cough better?', type: 'multi', options: ['Rest', 'Home treatment', 'Medication', 'Nebulization', 'Other'] },
        { id: 'cough_type', question: 'What is the nature of cough?', type: 'single', options: ['Dry cough', 'Wet cough', 'Allergic cough', 'Other', 'Not applicable'] },
        { id: 'mucus', question: 'How many times do you spit mucus?', type: 'single', options: ['Whole day', 'Few times', '1-2 times', 'Not applicable'] },
        { id: 'actions', question: 'Which actions lead to coughing?', type: 'multi', options: ['Cough after eating', 'Cough at rest', 'Cough during exercise', 'Cough when swallowing', 'Not applicable'] },
        { id: 'associated', question: 'Associated symptoms?', type: 'multi', options: ['Fever', 'Common Cold', 'Runny Nose', 'Weight loss', 'Chills', 'Rigor', 'Throat pain', 'Acidity', 'Stiffness in neck', 'Other / Not applicable'] },
    ],
    'Stomach Pain': [
        { id: 'duration', question: 'Since how long do you have stomach pain?', type: 'single', options: ['Recently', 'Some weeks', 'Some months'] },
        { id: 'severity', question: 'How much is the pain?', type: 'single', options: ['Bearable', 'Unbearable', 'Not applicable'] },
        { id: 'location', question: 'Where do you have pain in your abdomen?', type: 'single', options: ['Near the navel', 'Above navel', 'Below navel', 'Middle left abdomen', 'Middle right abdomen', 'Below the ribs (left)', 'Below the ribs (right)', 'Lower right side', 'Not applicable'] },
        { id: 'radiating', question: 'Where is your pain radiating?', type: 'single', options: ['No radiating pain', 'To left shoulder', 'To right shoulder', 'To loin', 'To groin', 'Not applicable'] },
        { id: 'onset', question: 'How did the pain start?', type: 'single', options: ['Pain started slowly', 'Pain started suddenly', 'Pain is continuous', 'Pain is throbbing', 'Not applicable'] },
        { id: 'food_relation', question: 'How is your pain associated with eating habits?', type: 'single', options: ['No effect with food', 'Increases with food', 'Relieves with food', 'After 2 hours of meals', 'Increase on empty stomach', 'Not applicable'] },
        { id: 'appetite', question: 'Describe your appetite', type: 'single', options: ['No hunger', 'On fast recently', 'Slightly decreased', 'Nothing looks good', 'Overeating', 'Not applicable'] },
        { id: 'triggers', question: 'What factors increase your stomach pain?', type: 'multi', options: ['Food', 'Acidity', 'Stools', 'Recumbency', 'Pressure on abdomen', 'Other', 'Not applicable'] },
    ],
    'Loose Motion': [
        { id: 'duration', question: 'Since how long do you have loose motion?', type: 'single', options: ['Recently', 'Some weeks', 'Some months', 'Many years'] },
        { id: 'frequency', question: 'How frequently do you pass stool?', type: 'single', options: ['2-4 times a day', '4-6 times a day', 'More than 6 times a day', 'More than 10 times a day'] },
        { id: 'reason', question: 'Possible reason for loose motion?', type: 'multi', options: ['New medicine commenced', 'New medicine added', 'New food', 'Meals outside', 'Overeating', 'Other / Not applicable'] },
        { id: 'blood', question: 'Is there blood in stool?', type: 'single', options: ['Lot of blood in stool', 'Stool is black', 'Stool has clots of blood', 'Not applicable'] },
        { id: 'stool_type', question: 'Type of stool?', type: 'single', options: ['Formed', 'Unformed', 'Porridge-like', 'Frothy', 'Watery', 'Not applicable'] },
        { id: 'food_relation', question: 'Relation with food?', type: 'single', options: ['No effect', 'Increased with food', 'Relieved with food', 'After 2 hours of meals', 'Not applicable'] },
        { id: 'associated', question: 'Associated symptoms?', type: 'multi', options: ['Vomiting', 'Weight loss', 'Fever', 'Difficulty in swallowing', 'Heartburn', 'Excessive burping', 'Abdominal distension', 'Other / Not applicable'] },
        { id: 'dehydration', question: 'Signs of dehydration?', type: 'multi', options: ['Excessive thirst', 'Dry mouth', 'Sunken eyes', 'Rapid pulse', 'Rapid breathing', 'Infrequent urination', 'Other / Not applicable'] },
    ],
    'Joint Pain': [
        { id: 'location', question: 'Where is the joint pain located?', type: 'multi', options: ['Spine', 'Shoulder', 'Elbow', 'Wrist', 'Hand', 'Fingers', 'Hip', 'Knee', 'Other'] },
        { id: 'onset', question: 'How did the pain start?', type: 'single', options: ['Slowly', 'Suddenly', 'Not applicable'] },
        { id: 'duration', question: 'Duration of pain?', type: 'single', options: ['Recently (1-2 days)', '1-2 weeks', '1 month', 'Many years'] },
        { id: 'symptoms', question: 'Associated joint symptoms?', type: 'multi', options: ['Pain', 'Injury', 'Joint stiffness', 'Swelling', 'Grating feeling on movement', 'Weakness', 'Restricted range of motion', 'Other'] },
        { id: 'nature', question: 'Nature of pain?', type: 'single', options: ['Vague pain', 'Dull aching', 'Other'] },
        { id: 'radiating', question: 'Is the pain radiating to other body parts?', type: 'single', options: ['Yes', 'No', 'Not applicable'] },
        { id: 'injury', question: 'Any previous injury?', type: 'single', options: ['Accident', 'Fall / Slip', 'Sports injury', 'Twisting injury', 'Other', 'Not applicable'] },
        { id: 'other_symptoms', question: 'Other associated symptoms?', type: 'multi', options: ['Joint instability', 'Difficulty in walking', 'Tingling', 'Difficulty climbing stairs', 'Fever', 'Chills', 'Rigors', 'Weight loss'] },
    ],
    'Acidity': [
        { id: 'duration', question: 'Since how long do you have acidity?', type: 'single', options: ['Since birth', 'Recently', 'Some weeks', 'Some months', 'Many years'] },
        { id: 'when_worse', question: 'When during the day is the issue more?', type: 'single', options: ['All day', 'Morning', 'Afternoon', 'Evening'] },
        { id: 'main_problem', question: 'What is the main problem?', type: 'multi', options: ['Burning sensation in stomach', 'Burning sensation in throat / heartburn', 'Reflux while sleeping', 'Difficulty swallowing', 'Restlessness', 'Belching', 'Nausea', 'Vomiting', 'Other / Not applicable'] },
        { id: 'eating_habits', question: 'How are your eating habits?', type: 'multi', options: ['Skipping meals / irregular eating', 'Overeating', 'Eating just before sleeping', 'Eating just before bathing', 'Not applicable'] },
        { id: 'foods', question: 'Do you eat these foods often?', type: 'multi', options: ['Tea / Coffee', 'Cold drinks / Soda', 'Spicy foods', 'Acidic foods (lemon, orange)', 'Fat-rich foods (fried foods)', 'Junk foods (burgers, donuts)', 'Not applicable'] },
        { id: 'associated', question: 'Any other associated problems?', type: 'multi', options: ['Swollen lymph nodes', 'Stiff neck', 'Cramps', 'Tarry stools', 'Gas in stomach', 'Other / Not applicable'] },
    ],
    'Diabetes Follow-Up': [
        { id: 'diagnosis_duration', question: 'Since when were you diagnosed with diabetes?', type: 'single', options: ['Recently', '1-2 years', '4 years', 'Many years'] },
        { id: 'diabetes_type', question: 'Which type of diabetes were you diagnosed with?', type: 'single', options: ['Type 1 Diabetes', 'Type 2 Diabetes', 'Gestational diabetes', 'Other'] },
        { id: 'family_history', question: 'Any family history of diabetes?', type: 'single', options: ['Yes', 'No', 'Not known'] },
        { id: 'health_condition', question: 'How is your current health condition?', type: 'single', options: ['Normal', 'Stable', 'Improving', 'Poor', 'Worsening'] },
        { id: 'associated', question: 'Do you have any other associated problems?', type: 'multi', options: ['Hypertension', 'Heart disease', 'Kidney disorder', 'Cancer', 'TB', 'Arthritis', 'Thyroid disorders', 'COPD', 'Other', 'Not applicable'] },
    ],
};

function consultationForm() {
    @php
        $editData = isset($editMode) ? ($consultation ?? null) : null;
        $editComplaints = [];
        $editSubAnswers = [];
        $editComplaintDone = [];
        if ($editData && !empty($editData['chief_complaints'])) {
            foreach ($editData['chief_complaints'] as $cc) {
                $name = $cc['name'] ?? '';
                $editComplaints[] = $name;
                $editSubAnswers[$name] = $cc['sub_answers'] ?? [];
                $editComplaintDone[$name] = true;
            }
        }
    @endphp

    return {
        editMode: {{ isset($editMode) ? 'true' : 'false' }},
        openStep: 1,
        isFollowup: @json($editData['is_followup'] ?? null),

        // Step 1: Chief Complaints
        complaintSearch: '',
        availableComplaints: [
            'Joint Pain', 'Fever', 'Headache', 'Common Cold', 'Cough',
            'Acidity', 'Stomach Pain', 'Loose Motion', 'Diabetes Follow-Up'
        ],
        selectedComplaints: @json($editComplaints ?: []),
        customComplaint: '',
        subQuestionMap: SUB_QUESTION_MAP,
        subAnswers: @json((object)$editSubAnswers ?: (object)[]),
        complaintSteps: {},
        complaintDone: @json((object)$editComplaintDone ?: (object)[]),

        // Step 2: History
        patientHistoryOptions: [
            'Diabetes', 'Mental Disorders', 'Hypertension', 'Past Surgeries',
            'Endocrine Disorders', 'Metabolic Disorders', 'Cardiovascular Disease',
            'Thyroid Disease', 'Stroke'
        ],
        patientHistory: @json($editData['patient_history'] ?? []) || [],
        personalHistoryOptions: [
            { key: 'alcohol', label: 'Alcohol Use' },
            { key: 'drug', label: 'Drug Use' },
            { key: 'smoking', label: 'Smoking' },
        ],
        personalHistory: Object.assign({ alcohol: null, drug: null, smoking: null }, @json($editData['personal_history'] ?? []) || {}),
        familyHistoryOptions: [
            'Diabetes', 'Osteoporosis', 'High Cholesterol', 'Hypertension',
            'Asthma', 'Birth Defects', 'Mental Illness', 'Stroke',
            'Heart Disease', 'Cancer', 'Genetic Conditions'
        ],
        familyHistory: @json($editData['family_history'] ?? []) || [],
        allergies: @json($editData['allergies'] ?? []) || [],

        // Step 3: Medications
        medications: (() => {
            const meds = @json($editData['medications'] ?? []);
            return (Array.isArray(meds) && meds.length > 0) ? meds : [{ name: '', frequency: '', dose: '', type: '', duration_value: '', duration_type: '' }];
        })(),

        // Step 4: Files
        files: [],
        fileInput: null,

        // Step 5: Query
        queryText: @json($editData['query'] ?? ''),
        opdOptions: [
            'General OPD',
            'Specialist OPD',
            'Emergency OPD',
            'Dental OPD',
            'Eye OPD',
            'ENT OPD',
            'Orthopedic OPD',
            'Gynecology OPD',
            'Pediatric OPD',
            'Skin OPD',
            'Cardiology OPD',
            'Neurology OPD',
            'Psychiatry OPD',
            'Ayush OPD',
        ],
        locationOptions: [
            { value: 'within_state', label: 'Within State Only' },
            { value: 'neighbouring', label: 'Neighbouring States' },
            { value: 'anywhere', label: 'Anywhere in India' },
            { value: 'hospital', label: 'Hospital/Organization' },
        ],
        locationPreference: @json($editData['location_preference'] ?? 'within_state'),
        selectedState: @json($editData['state'] ?? ''),
        opd: @json($editData['opd'] ?? ''),
        doctorId: @json($editData['doctor_id'] ?? ''),
        indianStates: [
            'Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh',
            'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka',
            'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram',
            'Nagaland', 'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu',
            'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal',
            'Andaman and Nicobar Islands', 'Chandigarh', 'Dadra and Nagar Haveli and Daman and Diu',
            'Delhi', 'Jammu and Kashmir', 'Ladakh', 'Lakshadweep', 'Puducherry'
        ],

        // Computed
        get completionPercent() {
            let score = 0;
            if (this.isFollowup !== null) score += 5;
            if (this.selectedComplaints.length > 0) score += 25;
            if (this.patientHistory.length > 0 || this.familyHistory.length > 0 ||
                this.personalHistory.alcohol !== null || this.personalHistory.smoking !== null ||
                this.personalHistory.drug !== null) score += 20;
            if (this.medications.some(m => m.name)) score += 15;
            if (this.files.length > 0) score += 15;
            if (this.queryText.length > 0) score += 20;
            return score;
        },

        get filteredComplaints() {
            return this.availableComplaints.filter(c =>
                c.toLowerCase().includes(this.complaintSearch.toLowerCase())
            );
        },

        toggleStep(n) {
            this.openStep = this.openStep === n ? null : n;
        },

        // Complaint wizard methods
        getComplaintStep(complaint) {
            return this.complaintSteps[complaint] || 0;
        },

        isComplaintDone(complaint) {
            return this.complaintDone[complaint] || false;
        },

        getComplaintProgress(complaint) {
            const questions = this.subQuestionMap[complaint] || [];
            if (questions.length === 0) return 0;
            if (this.isComplaintDone(complaint)) return 100;
            return Math.round(((this.getComplaintStep(complaint)) / questions.length) * 100);
        },

        hasCurrentAnswer(complaint) {
            const questions = this.subQuestionMap[complaint] || [];
            const step = this.getComplaintStep(complaint);
            if (step >= questions.length) return false;
            const q = questions[step];
            const answers = this.subAnswers[complaint];
            if (!answers) return false;
            const answer = answers[q.id];
            if (answer === undefined || answer === null) return false;
            if (q.type === 'multi') return Array.isArray(answer) && answer.length > 0;
            if (q.type === 'text') return String(answer).trim().length > 0;
            return true;
        },

        selectSingleAnswer(complaint, qId, value) {
            if (!this.subAnswers[complaint]) {
                this.subAnswers[complaint] = {};
            }
            this.subAnswers[complaint][qId] = value;
            // Force Alpine reactivity by reassigning the object
            this.subAnswers = Object.assign({}, this.subAnswers);
        },

        toggleMultiAnswer(complaint, qId, value) {
            if (!this.subAnswers[complaint]) {
                this.subAnswers[complaint] = {};
            }
            if (!Array.isArray(this.subAnswers[complaint][qId])) {
                this.subAnswers[complaint][qId] = [];
            }
            const arr = this.subAnswers[complaint][qId];
            const idx = arr.indexOf(value);
            if (idx === -1) {
                arr.push(value);
            } else {
                arr.splice(idx, 1);
            }
            // Force Alpine reactivity by reassigning the object
            this.subAnswers = Object.assign({}, this.subAnswers);
        },

        nextQuestion(complaint) {
            const questions = this.subQuestionMap[complaint] || [];
            const step = this.getComplaintStep(complaint);
            if (step < questions.length - 1) {
                this.complaintSteps = Object.assign({}, this.complaintSteps, { [complaint]: step + 1 });
            } else {
                this.complaintDone = Object.assign({}, this.complaintDone, { [complaint]: true });
            }
        },

        prevQuestion(complaint) {
            const step = this.getComplaintStep(complaint);
            if (step > 0) {
                this.complaintSteps = Object.assign({}, this.complaintSteps, { [complaint]: step - 1 });
            }
        },

        editComplaintAnswers(complaint) {
            this.complaintDone = Object.assign({}, this.complaintDone, { [complaint]: false });
            this.complaintSteps = Object.assign({}, this.complaintSteps, { [complaint]: 0 });
        },

        formatAnswer(complaint, qId) {
            const answer = this.subAnswers[complaint] ? this.subAnswers[complaint][qId] : null;
            if (!answer) return 'Not answered';
            if (Array.isArray(answer)) return answer.join(', ');
            return answer;
        },

        addComplaint(complaint) {
            if (!this.selectedComplaints.includes(complaint)) {
                this.selectedComplaints.push(complaint);
                this.subAnswers = Object.assign({}, this.subAnswers, { [complaint]: {} });
                this.complaintSteps = Object.assign({}, this.complaintSteps, { [complaint]: 0 });
                this.complaintDone = Object.assign({}, this.complaintDone, { [complaint]: false });
            } else {
                this.removeComplaint(this.selectedComplaints.indexOf(complaint));
            }
        },

        removeComplaint(idx) {
            const name = this.selectedComplaints[idx];
            this.selectedComplaints.splice(idx, 1);
            const newAnswers = Object.assign({}, this.subAnswers);
            delete newAnswers[name];
            this.subAnswers = newAnswers;
            const newSteps = Object.assign({}, this.complaintSteps);
            delete newSteps[name];
            this.complaintSteps = newSteps;
            const newDone = Object.assign({}, this.complaintDone);
            delete newDone[name];
            this.complaintDone = newDone;
        },

        addCustomComplaint() {
            const name = this.customComplaint.trim();
            if (name && !this.selectedComplaints.includes(name)) {
                if (!this.availableComplaints.includes(name)) {
                    this.availableComplaints.push(name);
                }
                this.selectedComplaints.push(name);
                this.subAnswers = Object.assign({}, this.subAnswers, { [name]: {} });
                this.complaintSteps = Object.assign({}, this.complaintSteps, { [name]: 0 });
                this.complaintDone = Object.assign({}, this.complaintDone, { [name]: false });
                this.customComplaint = '';
            }
        },

        handleFiles(event) {
            const newFiles = Array.from(event.target.files);
            this.addFiles(newFiles);
            event.target.value = '';
        },

        handleDrop(event) {
            const newFiles = Array.from(event.dataTransfer.files);
            this.addFiles(newFiles);
        },

        addFiles(newFiles) {
            const allowed = ['application/pdf', 'image/jpeg', 'image/png',
                'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            const maxSize = 10 * 1024 * 1024;
            for (const file of newFiles) {
                if (this.files.length >= 5) break;
                if (!allowed.includes(file.type)) continue;
                if (file.size > maxSize) continue;
                this.files.push(file);
            }
            this.updateFileInput();
        },

        removeFile(idx) {
            this.files.splice(idx, 1);
            this.updateFileInput();
        },

        updateFileInput() {
            const dt = new DataTransfer();
            this.files.forEach(f => dt.items.add(f));
            const input = this.$el.querySelector('input[name="health_records[]"]');
            if (input) input.files = dt.files;
        },

        prepareSubmit() {
            this.updateFileInput();
        }
    };
}
</script>
@endpush
@endsection
