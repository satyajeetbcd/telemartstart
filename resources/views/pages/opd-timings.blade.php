@extends('layouts.public')

@section('title', 'OPD Timings - Tele Health Mart')
@section('meta_description', 'Find doctor OPD timings and schedules across different states and specializations on Tele Health Mart.')

@section('content')

<!-- Hero Banner -->
<section class="bg-gradient-to-br from-brand-50 via-white to-brand-50 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <span class="inline-block px-4 py-1 bg-brand-100 text-brand-700 rounded-full text-sm font-medium mb-4">Find Doctors</span>
        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">OPD Timings</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Search and find doctor OPD schedules across different states and specializations.</p>
    </div>
</section>

<!-- Filter & Results -->
<section class="py-8 lg:py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4" x-data="opdTimings()">

        <!-- Filter Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Search OPD Timings</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- State Dropdown -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                    <select x-model="filters.state" @change="applyFilters()" class="w-full rounded-lg border-gray-300 text-sm focus:border-brand-500 focus:ring-brand-500 py-2.5 px-3 border shadow-sm">
                        <option value="">All States</option>
                        @foreach($states as $state)
                            <option value="{{ $state }}">{{ $state }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Specialization Dropdown -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Specialization</label>
                    <select x-model="filters.specialization" @change="applyFilters()" class="w-full rounded-lg border-gray-300 text-sm focus:border-brand-500 focus:ring-brand-500 py-2.5 px-3 border shadow-sm">
                        <option value="">All Specializations</option>
                        @foreach($specializations as $spec)
                            <option value="{{ $spec }}">{{ $spec }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Doctor Name Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Doctor Name</label>
                    <input type="text" x-model="filters.search" @input.debounce.300ms="applyFilters()" placeholder="Search by doctor name..." class="w-full rounded-lg border-gray-300 text-sm focus:border-brand-500 focus:ring-brand-500 py-2.5 px-3 border shadow-sm">
                </div>

                <!-- Search Button -->
                <div class="flex items-end">
                    <button @click="applyFilters()" class="w-full px-6 py-2.5 bg-brand-600 text-white rounded-lg font-medium hover:bg-brand-700 transition flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span>Search</span>
                    </button>
                </div>
            </div>

            <!-- Reset Filters -->
            <div class="mt-4 flex items-center justify-between">
                <p class="text-sm text-gray-500">
                    Showing <span class="font-medium text-gray-700" x-text="filteredDoctors.length"></span> of <span class="font-medium text-gray-700" x-text="allDoctors.length"></span> doctors
                </p>
                <button @click="resetFilters()" class="text-sm text-brand-600 hover:text-brand-700 font-medium transition">Reset Filters</button>
            </div>
        </div>

        <!-- Results Table -->
        <div x-show="paginatedDoctors.length > 0" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-brand-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-brand-700 uppercase tracking-wider">S.No</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-brand-700 uppercase tracking-wider">Doctor Name</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-brand-700 uppercase tracking-wider">Specialization</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-brand-700 uppercase tracking-wider">State</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-brand-700 uppercase tracking-wider">OPD Days</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-brand-700 uppercase tracking-wider">OPD Timing</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <template x-for="(doctor, index) in paginatedDoctors" :key="doctor.id">
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm text-gray-600" x-text="(currentPage - 1) * perPage + index + 1"></td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-brand-100 rounded-full flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900" x-text="doctor.name"></span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800" x-text="doctor.specialization"></span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600" x-text="doctor.state"></td>
                                <td class="px-4 py-3 text-sm text-gray-600" x-text="doctor.opd_days"></td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center space-x-1 text-sm text-gray-700">
                                        <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span x-text="doctor.timing_from + ' - ' + doctor.timing_to"></span>
                                    </span>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div x-show="totalPages > 1" class="px-4 py-3 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                <p class="text-sm text-gray-600">
                    Page <span class="font-medium" x-text="currentPage"></span> of <span class="font-medium" x-text="totalPages"></span>
                </p>
                <div class="flex items-center space-x-2">
                    <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1" :class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-brand-50'" class="px-3 py-1.5 text-sm font-medium text-brand-600 border border-brand-200 rounded-lg transition">
                        Previous
                    </button>
                    <template x-for="page in totalPages" :key="page">
                        <button @click="goToPage(page)" :class="page === currentPage ? 'bg-brand-600 text-white border-brand-600' : 'text-gray-700 border-gray-200 hover:bg-brand-50'" class="px-3 py-1.5 text-sm font-medium border rounded-lg transition" x-text="page"></button>
                    </template>
                    <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages" :class="currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : 'hover:bg-brand-50'" class="px-3 py-1.5 text-sm font-medium text-brand-600 border border-brand-200 rounded-lg transition">
                        Next
                    </button>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div x-show="filteredDoctors.length === 0" class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">No Results Found</h3>
            <p class="text-gray-500 mb-4">No doctors match your search criteria. Try adjusting your filters.</p>
            <button @click="resetFilters()" class="px-5 py-2 bg-brand-600 text-white rounded-lg font-medium hover:bg-brand-700 transition">
                Reset Filters
            </button>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    function opdTimings() {
        return {
            allDoctors: @json($doctors),
            filteredDoctors: [],
            paginatedDoctors: [],
            filters: {
                state: '',
                specialization: '',
                search: ''
            },
            currentPage: 1,
            perPage: 10,
            totalPages: 1,

            init() {
                this.applyFilters();
            },

            applyFilters() {
                this.currentPage = 1;
                let results = this.allDoctors;

                if (this.filters.state) {
                    results = results.filter(d => d.state === this.filters.state);
                }
                if (this.filters.specialization) {
                    results = results.filter(d => d.specialization === this.filters.specialization);
                }
                if (this.filters.search) {
                    const search = this.filters.search.toLowerCase();
                    results = results.filter(d => d.name.toLowerCase().includes(search));
                }

                this.filteredDoctors = results;
                this.totalPages = Math.max(1, Math.ceil(this.filteredDoctors.length / this.perPage));
                this.paginate();
            },

            paginate() {
                const start = (this.currentPage - 1) * this.perPage;
                this.paginatedDoctors = this.filteredDoctors.slice(start, start + this.perPage);
            },

            goToPage(page) {
                if (page >= 1 && page <= this.totalPages) {
                    this.currentPage = page;
                    this.paginate();
                }
            },

            resetFilters() {
                this.filters = { state: '', specialization: '', search: '' };
                this.applyFilters();
            }
        };
    }
</script>
@endpush
