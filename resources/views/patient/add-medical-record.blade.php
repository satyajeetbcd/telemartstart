@extends('layouts.patient')

@section('title', 'Add Medical Record')

@section('content')
<div class="max-w-2xl">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('patient.medical-records') }}" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-gray-900">Add Medical Record</h2>
        </div>
        <p class="text-gray-500">Upload your lab reports, prescriptions, or other medical documents.</p>
    </div>

    <form method="POST" action="{{ route('patient.medical-records.store') }}" enctype="multipart/form-data" x-data="recordForm()">
        @csrf

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">
            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                       placeholder="e.g., Blood Test Report - March 2026"
                       class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500 text-sm">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Record Type & Date -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="record_type" class="block text-sm font-medium text-gray-700 mb-1">Record Type <span class="text-red-500">*</span></label>
                    <select name="record_type" id="record_type" required
                            class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500 text-sm">
                        <option value="">Select type...</option>
                        @foreach($recordTypes as $key => $label)
                            <option value="{{ $key }}" {{ old('record_type') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('record_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="record_date" class="block text-sm font-medium text-gray-700 mb-1">Date <span class="text-red-500">*</span></label>
                    <input type="date" name="record_date" id="record_date" value="{{ old('record_date', date('Y-m-d')) }}" required
                           max="{{ date('Y-m-d') }}"
                           class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500 text-sm">
                    @error('record_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="3"
                          placeholder="Brief description of this record..."
                          class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500 text-sm">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                <textarea name="notes" id="notes" rows="2"
                          placeholder="Any additional notes..."
                          class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500 text-sm">{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- File Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Attachments</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-brand-400 transition cursor-pointer"
                     @click="$refs.fileInput.click()"
                     @dragover.prevent="dragging = true"
                     @dragleave.prevent="dragging = false"
                     @drop.prevent="handleDrop($event)"
                     :class="dragging ? 'border-brand-500 bg-brand-50' : ''">
                    <input type="file" name="attachments[]" multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                           x-ref="fileInput" class="hidden" @change="handleFiles($event)">
                    <svg class="w-10 h-10 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    <p class="text-sm text-gray-600 font-medium">Click to upload or drag and drop</p>
                    <p class="text-xs text-gray-400 mt-1">PDF, JPG, PNG, DOC up to 10MB each (max 5 files)</p>
                </div>

                <!-- File List -->
                <div x-show="files.length > 0" class="mt-3 space-y-2">
                    <template x-for="(file, index) in files" :key="index">
                        <div class="flex items-center justify-between p-2.5 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex items-center gap-2 min-w-0">
                                <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                </svg>
                                <span class="text-sm text-gray-700 truncate" x-text="file.name"></span>
                                <span class="text-xs text-gray-400 flex-shrink-0" x-text="formatSize(file.size)"></span>
                            </div>
                            <button type="button" @click="removeFile(index)" class="text-gray-400 hover:text-red-500 transition flex-shrink-0 ml-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>

                @error('attachments')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                @error('attachments.*')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-6 flex justify-between">
            <a href="{{ route('patient.medical-records') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition">
                Cancel
            </a>
            <button type="submit" :disabled="submitting" @click="submitting = true"
                    class="px-6 py-2.5 bg-brand-600 text-white rounded-lg font-medium hover:bg-brand-700 transition disabled:opacity-50">
                <span x-show="!submitting">Save Record</span>
                <span x-show="submitting" class="flex items-center">
                    <svg class="animate-spin h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Uploading...
                </span>
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
function recordForm() {
    return {
        files: [],
        dragging: false,
        submitting: false,

        handleFiles(event) {
            this.addFiles(event.target.files);
        },

        handleDrop(event) {
            this.dragging = false;
            this.addFiles(event.dataTransfer.files);
        },

        addFiles(fileList) {
            const allowed = ['application/pdf', 'image/jpeg', 'image/png', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            const maxSize = 10 * 1024 * 1024;

            for (let i = 0; i < fileList.length; i++) {
                if (this.files.length >= 5) break;

                const file = fileList[i];
                if (!allowed.includes(file.type)) continue;
                if (file.size > maxSize) continue;

                this.files.push(file);
            }

            this.updateFileInput();
        },

        removeFile(index) {
            this.files.splice(index, 1);
            this.updateFileInput();
        },

        updateFileInput() {
            const dt = new DataTransfer();
            this.files.forEach(f => dt.items.add(f));
            this.$refs.fileInput.files = dt.files;
        },

        formatSize(bytes) {
            if (bytes < 1024) return bytes + ' B';
            if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
            return (bytes / 1048576).toFixed(1) + ' MB';
        }
    };
}
</script>
@endpush
@endsection
