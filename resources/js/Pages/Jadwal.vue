<template>
    <Head title="Jadwal & Agenda Kegiatan" />
    <MainLayout>
        <div class="bg-gray-50 min-h-screen py-12 relative overflow-hidden">
            <!-- Background Decorative Gradients -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-100/40 rounded-full blur-3xl -z-10"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-emerald-50/50 rounded-full blur-3xl -z-10"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="text-center mb-12">
                    <span class="text-emerald-600 font-bold uppercase tracking-widest text-sm mb-3 block">Kalender Pondok</span>
                    <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">Jadwal & Agenda Kegiatan</h1>
                    <div class="w-24 h-1.5 bg-emerald-500 mx-auto rounded-full mb-6"></div>
                    <p class="text-gray-500 max-w-2xl mx-auto">
                        Ikuti berbagai agenda penting, jadwal seleksi penerimaan santri baru (SPMB), kegiatan akademik, dan acara umum Pondok Pesantren Riyadussalikin.
                    </p>
                </div>

                <!-- Main Grid Layout -->
                <div class="main-grid gap-8 items-start">
                    
                    <!-- Left/Middle Column: Calendar & Filters (8 cols) -->
                    <div class="main-content-col space-y-6">
                        <!-- Category Filters -->
                        <div class="bg-white rounded-3xl p-4 shadow-sm border border-gray-100 flex flex-wrap gap-2 justify-center sm:justify-start">
                            <button 
                                v-for="cat in categories" 
                                :key="cat.value"
                                @click="selectedCategory = cat.value"
                                class="px-5 py-2.5 rounded-2xl text-sm font-bold transition-all duration-300 flex items-center gap-2 focus:outline-none"
                                :class="selectedCategory === cat.value 
                                    ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/20' 
                                    : 'bg-gray-50 text-gray-600 hover:bg-gray-100 hover:text-gray-900'"
                            >
                                <span v-if="cat.value !== 'all'" class="w-2.5 h-2.5 rounded-full" :class="cat.dotColor"></span>
                                {{ cat.label }}
                            </button>
                        </div>

                        <!-- Calendar Grid Card -->
                        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
                            <!-- Calendar Header -->
                            <div class="calendar-header px-6 py-6 text-white flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <h2 class="text-2xl font-black tracking-tight select-none">
                                        {{ monthName }} {{ currentYear }}
                                    </h2>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button 
                                        @click="prevMonth"
                                        class="p-2.5 rounded-2xl bg-white/10 hover:bg-white/20 transition-colors border border-white/5 focus:outline-none"
                                        aria-label="Bulan Sebelumnya"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>
                                    <button 
                                        @click="goToToday"
                                        class="px-4 py-2 rounded-2xl bg-white text-emerald-800 hover:bg-emerald-50 text-sm font-bold transition-colors focus:outline-none"
                                    >
                                        Hari Ini
                                    </button>
                                    <button 
                                        @click="nextMonth"
                                        class="p-2.5 rounded-2xl bg-white/10 hover:bg-white/20 transition-colors border border-white/5 focus:outline-none"
                                        aria-label="Bulan Berikutnya"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Weekday Headers -->
                            <div class="calendar-grid gap-px bg-gray-100 border-b border-gray-100 text-center font-bold text-xs uppercase tracking-wider text-gray-500 py-4 bg-gray-50/50">
                                <div v-for="day in weekdayLabels" :key="day" class="select-none">
                                    {{ day }}
                                </div>
                            </div>

                            <!-- Calendar Day Cells -->
                            <div class="calendar-grid gap-px bg-gray-100">
                                <div 
                                    v-for="(cell, idx) in calendarCells" 
                                    :key="idx"
                                    @click="selectCell(cell)"
                                    class="bg-white min-h-[90px] sm:min-h-[120px] p-2 flex flex-col justify-between transition-all duration-200 cursor-pointer select-none group"
                                    :class="{
                                        'bg-gray-50/60 text-gray-300 pointer-events-none': !cell.isCurrentMonth,
                                        'hover:bg-emerald-50/40': cell.isCurrentMonth && !cell.isSelected,
                                        'bg-emerald-50/80 ring-2 ring-emerald-500 ring-inset': cell.isSelected,
                                    }"
                                >
                                    <template v-if="cell.isCurrentMonth">
                                        <!-- Date Number -->
                                        <div class="flex justify-between items-center">
                                            <span 
                                                class="w-8 h-8 rounded-full flex flex-col items-center justify-center font-bold text-sm relative"
                                                :class="cell.isToday 
                                                    ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/25' 
                                                    : (cell.isSelected ? 'bg-emerald-50 text-emerald-700 border border-emerald-300' : 'text-gray-700')"
                                            >
                                                {{ cell.day }}
                                                <!-- Dot indicator under the number -->
                                                <span 
                                                    v-if="cell.events.length > 0" 
                                                    class="absolute bottom-1 w-1.5 h-1.5 rounded-full"
                                                    :class="cell.isToday ? 'bg-white' : getEventDotColorClass(cell.events)"
                                                ></span>
                                            </span>
                                            
                                            <!-- Mobile dot counts -->
                                            <span v-if="cell.events.length > 0" class="block sm:hidden w-2 h-2 rounded-full" :class="getEventDotColorClass(cell.events)"></span>
                                        </div>

                                        <!-- Events list inside cell (Desktop only) -->
                                        <div class="hidden sm:block space-y-1 mt-2 grow overflow-hidden">
                                            <div 
                                                v-for="event in cell.events.slice(0, 2)" 
                                                :key="event.id"
                                                class="text-[10px] px-2 py-1 rounded-lg truncate font-medium border"
                                                :class="getEventStyleClass(event.kategori)"
                                                :title="event.judul"
                                            >
                                                {{ event.judul }}
                                            </div>
                                            <div 
                                                v-if="cell.events.length > 2" 
                                                class="text-[9px] text-emerald-600 font-bold pl-2"
                                            >
                                                +{{ cell.events.length - 2 }} lainnya
                                            </div>
                                        </div>

                                        <!-- Bottom Category Dot Indicators (Desktop only when no events slice fits) -->
                                        <div class="hidden sm:flex gap-1 mt-1 justify-end">
                                            <span 
                                                v-for="cat in getUniqueCategories(cell.events)" 
                                                :key="cat"
                                                class="w-1.5 h-1.5 rounded-full"
                                                :class="{
                                                    'bg-emerald-500': cat === 'ppdb',
                                                    'bg-blue-500': cat === 'akademik',
                                                    'bg-purple-500': cat === 'umum'
                                                }"
                                            ></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Agenda Details & Timeline (4 cols) -->
                    <div class="sidebar-col space-y-6">
                        <!-- Selected Date Details Panel -->
                        <div class="bg-white rounded-[2rem] p-6 shadow-lg shadow-gray-200/50 border border-gray-100 transition-all duration-300">
                            <h3 class="text-lg font-black text-gray-900 border-b border-gray-100 pb-4 mb-4 flex items-center justify-between">
                                <span>Detail Agenda</span>
                                <span class="text-xs bg-emerald-50 text-emerald-800 font-bold px-3 py-1 rounded-xl">
                                    {{ formatSelectedDateLabel }}
                                </span>
                            </h3>

                            <div v-if="selectedCellEvents.length === 0" class="py-8 text-center text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-3 opacity-60 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-sm font-medium">Tidak ada agenda pada tanggal ini.</p>
                            </div>

                            <div v-else class="space-y-4 max-h-[300px] overflow-y-auto pr-1">
                                <div 
                                    v-for="event in selectedCellEvents" 
                                    :key="event.id"
                                    class="border border-gray-100 hover:border-emerald-100 rounded-2xl p-4 transition-all hover:bg-emerald-50/10"
                                >
                                    <div class="flex items-start justify-between gap-2 mb-2">
                                        <span 
                                            class="px-2.5 py-0.5 rounded-lg text-[10px] font-bold uppercase tracking-wider"
                                            :class="{
                                                'bg-emerald-100 text-emerald-800': event.kategori === 'ppdb',
                                                'bg-blue-100 text-blue-800': event.kategori === 'akademik',
                                                'bg-purple-100 text-purple-800': event.kategori === 'umum'
                                            }"
                                        >
                                            {{ event.kategori === 'ppdb' ? 'SPMB' : event.kategori === 'akademik' ? 'Akademik' : 'Umum' }}
                                        </span>
                                        <span class="text-xs text-gray-500 font-semibold">{{ formatTime(event.jam_mulai) }}</span>
                                    </div>
                                    <h4 class="font-bold text-gray-900 leading-snug mb-1">{{ event.judul }}</h4>
                                    <p class="text-xs text-gray-500 leading-relaxed mb-3">{{ event.deskripsi }}</p>
                                    
                                    <div class="flex items-center gap-1.5 text-gray-600 text-[11px] font-medium border-t border-gray-50 pt-2">
                                        <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="truncate">{{ event.lokasi || 'Pondok Pesantren' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Timeline View of Upcoming Events -->
                        <div class="bg-white rounded-[2rem] p-6 shadow-lg shadow-gray-200/50 border border-gray-100">
                            <h3 class="text-lg font-black text-gray-900 border-b border-gray-100 pb-4 mb-6">
                                Daftar Agenda Mendatang
                            </h3>

                            <div v-if="filteredAgendas.length === 0" class="py-12 text-center text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-3 opacity-60 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <p class="text-sm font-medium">Belum ada agenda terdaftar.</p>
                            </div>

                            <div v-else class="relative pl-6 border-l-2 border-emerald-100 space-y-6 pr-1">
                                <div 
                                    v-for="event in paginatedAgendas" 
                                    :key="event.id"
                                    @click="focusDate(event.tgl_mulai)"
                                    class="relative cursor-pointer group"
                                >
                                    <!-- Dot on timeline -->
                                    <div 
                                        class="absolute -left-[31px] top-1.5 w-4 h-4 rounded-full border-2 border-white ring-2 transition-all duration-300 group-hover:scale-125"
                                        :class="{
                                            'bg-emerald-500 ring-emerald-200': event.kategori === 'ppdb',
                                            'bg-blue-500 ring-blue-200': event.kategori === 'akademik',
                                            'bg-purple-500 ring-purple-200': event.kategori === 'umum'
                                        }"
                                    ></div>

                                    <!-- Content -->
                                    <div class="bg-gray-50/50 hover:bg-emerald-50/20 border border-transparent hover:border-emerald-100/50 rounded-2xl p-4 transition-all">
                                        <div class="flex items-center justify-between gap-2 mb-1">
                                            <span class="text-xs text-emerald-700 font-bold">{{ formatDateString(event.tgl_mulai, event.tgl_selesai) }}</span>
                                            <span class="text-[10px] text-gray-400 font-semibold">{{ formatTime(event.jam_mulai) }}</span>
                                        </div>
                                        <h4 class="font-bold text-gray-900 leading-snug group-hover:text-emerald-700 transition-colors mb-1">{{ event.judul }}</h4>
                                        <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed mb-2">{{ event.deskripsi }}</p>
                                        
                                        <div class="flex items-center gap-1 text-[10px] text-gray-500 font-semibold">
                                            <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <span class="truncate">{{ event.lokasi || 'Pondok Pesantren' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pagination Controls -->
                            <div v-if="totalPages > 1" class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
                                <button 
                                    @click="prevPage" 
                                    :disabled="currentPage === 1"
                                    class="px-3 py-1.5 rounded-xl border text-xs font-bold transition-all focus:outline-none flex items-center gap-1"
                                    :class="currentPage === 1 
                                        ? 'border-gray-100 text-gray-300 cursor-not-allowed' 
                                        : 'border-emerald-100 text-emerald-700 hover:bg-emerald-50'"
                                >
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                                    </svg>
                                    Kembali
                                </button>
                                <span class="text-xs text-gray-400 font-semibold">
                                    Halaman {{ currentPage }} dari {{ totalPages }}
                                </span>
                                <button 
                                    @click="nextPage" 
                                    :disabled="currentPage === totalPages"
                                    class="px-3 py-1.5 rounded-xl border text-xs font-bold transition-all focus:outline-none flex items-center gap-1"
                                    :class="currentPage === totalPages 
                                        ? 'border-gray-100 text-gray-300 cursor-not-allowed' 
                                        : 'border-emerald-100 text-emerald-700 hover:bg-emerald-50'"
                                >
                                    Lanjut
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import MainLayout from '../Layouts/MainLayout.vue';

const props = defineProps({
    agendas: {
        type: Array,
        default: () => []
    }
});

// Category definition
const categories = [
    { value: 'all', label: 'Semua Agenda', dotColor: '' },
    { value: 'ppdb', label: 'SPMB', dotColor: 'bg-emerald-500' },
    { value: 'akademik', label: 'Akademik', dotColor: 'bg-blue-500' },
    { value: 'umum', label: 'Kegiatan Umum', dotColor: 'bg-purple-500' }
];

const selectedCategory = ref('all');

// Date management
const today = new Date();
const currentYear = ref(today.getFullYear());
const currentMonth = ref(today.getMonth());
const selectedDate = ref(new Date());

const weekdayLabels = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
const monthNames = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
];

const monthName = computed(() => monthNames[currentMonth.value]);

// Filter agendas based on selected category
const filteredAgendas = computed(() => {
    if (selectedCategory.value === 'all') {
        return props.agendas;
    }
    return props.agendas.filter(e => e.kategori === selectedCategory.value);
});

// Generate days for the grid view
const calendarCells = computed(() => {
    const year = currentYear.value;
    const month = currentMonth.value;

    const startOfMonth = new Date(year, month, 1);
    const endOfMonth = new Date(year, month + 1, 0);

    const numDaysInMonth = endOfMonth.getDate();
    const startDayOfWeek = startOfMonth.getDay(); // 0 = Sunday, 1 = Monday, etc.

    const cells = [];

    // 1. Previous Month Padding Days
    const prevMonthEnd = new Date(year, month, 0).getDate();
    for (let i = startDayOfWeek - 1; i >= 0; i--) {
        const cellDate = new Date(year, month - 1, prevMonthEnd - i);
        cells.push({
            date: cellDate,
            day: prevMonthEnd - i,
            isCurrentMonth: false,
            isToday: isSameDay(cellDate, today),
            isSelected: isSameDay(cellDate, selectedDate.value),
            events: []
        });
    }

    // 2. Current Month Days
    for (let i = 1; i <= numDaysInMonth; i++) {
        const cellDate = new Date(year, month, i);
        cells.push({
            date: cellDate,
            day: i,
            isCurrentMonth: true,
            isToday: isSameDay(cellDate, today),
            isSelected: isSameDay(cellDate, selectedDate.value),
            events: getEventsForDate(cellDate)
        });
    }

    // 3. Next Month Padding Days to complete standard 6-row layout (42 cells)
    const remainingCells = 42 - cells.length;
    for (let i = 1; i <= remainingCells; i++) {
        const cellDate = new Date(year, month + 1, i);
        cells.push({
            date: cellDate,
            day: i,
            isCurrentMonth: false,
            isToday: isSameDay(cellDate, today),
            isSelected: isSameDay(cellDate, selectedDate.value),
            events: []
        });
    }

    return cells;
});

const parseDateLocal = (dateString) => {
    if (!dateString) return null;
    if (typeof dateString === 'string') {
        const match = dateString.match(/^(\d{4})-(\d{2})-(\d{2})/);
        if (match) {
            const year = parseInt(match[1], 10);
            const month = parseInt(match[2], 10) - 1; // 0-indexed month
            const day = parseInt(match[3], 10);
            return new Date(year, month, day);
        }
    }
    const d = new Date(dateString);
    if (isNaN(d.getTime())) return null;
    return new Date(d.getFullYear(), d.getMonth(), d.getDate());
};

// Get event dot color class
const getEventDotColorClass = (events) => {
    if (!events || events.length === 0) return '';
    const categories = events.map(e => e.kategori);
    if (categories.includes('ppdb')) return 'bg-emerald-500';
    if (categories.includes('akademik')) return 'bg-blue-500';
    return 'bg-purple-500';
};

// Get events occurring on a specific date, taking into account multiday spans
const getEventsForDate = (date) => {
    const checkTime = new Date(date.getFullYear(), date.getMonth(), date.getDate()).getTime();
    
    return filteredAgendas.value.filter(event => {
        const startTime = parseDateLocal(event.tgl_mulai)?.getTime();
        if (!startTime) return false;
        
        if (event.tgl_selesai) {
            const endTime = parseDateLocal(event.tgl_selesai)?.getTime();
            return checkTime >= startTime && checkTime <= endTime;
        }
        
        return checkTime === startTime;
    });
};

// Events for the selected calendar date
const selectedCellEvents = computed(() => {
    return getEventsForDate(selectedDate.value);
});

// Format label for selected date card
const formatSelectedDateLabel = computed(() => {
    return selectedDate.value.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'short',
        year: 'numeric'
    });
});

// Navigation Functions
const prevMonth = () => {
    if (currentMonth.value === 0) {
        currentMonth.value = 11;
        currentYear.value--;
    } else {
        currentMonth.value--;
    }
};

const nextMonth = () => {
    if (currentMonth.value === 11) {
        currentMonth.value = 0;
        currentYear.value++;
    } else {
        currentMonth.value++;
    }
};

const goToToday = () => {
    currentYear.value = today.getFullYear();
    currentMonth.value = today.getMonth();
    selectedDate.value = new Date(today);
};

const selectCell = (cell) => {
    selectedDate.value = cell.date;
    // If user clicked a day from next/prev month, navigate there
    if (cell.date.getMonth() !== currentMonth.value) {
        currentMonth.value = cell.date.getMonth();
        currentYear.value = cell.date.getFullYear();
    }
};

const focusDate = (dateStr) => {
    const targetDate = parseDateLocal(dateStr);
    if (!targetDate) return;
    selectedDate.value = targetDate;
    currentMonth.value = targetDate.getMonth();
    currentYear.value = targetDate.getFullYear();
    
    // Smooth scroll to top/calendar area on mobile when an item is selected from upcoming list
    window.scrollTo({ top: 200, behavior: 'smooth' });
};

// Utilities
const isSameDay = (d1, d2) => {
    return d1.getFullYear() === d2.getFullYear() &&
           d1.getMonth() === d2.getMonth() &&
           d1.getDate() === d2.getDate();
};

const getUniqueCategories = (events) => {
    return [...new Set(events.map(e => e.kategori))];
};

const getEventStyleClass = (category) => {
    switch (category) {
        case 'ppdb':
            return 'bg-emerald-50 text-emerald-700 border-emerald-100 hover:bg-emerald-100/50';
        case 'akademik':
            return 'bg-blue-50 text-blue-700 border-blue-100 hover:bg-blue-100/50';
        case 'umum':
            return 'bg-purple-50 text-purple-700 border-purple-100 hover:bg-purple-100/50';
        default:
            return 'bg-gray-50 text-gray-700 border-gray-100 hover:bg-gray-100';
    }
};

const formatTime = (timeString) => {
    if (!timeString) return 'Selesai';
    const parts = timeString.split(':');
    if (parts.length >= 2) {
        return `${parts[0]}:${parts[1]} WIB`;
    }
    return timeString;
};

const formatDateString = (startStr, endStr) => {
    const start = parseDateLocal(startStr);
    if (!start) return '';
    const startFormatted = start.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
    
    if (endStr) {
        const end = parseDateLocal(endStr);
        if (end && start.getTime() !== end.getTime()) {
            const endFormatted = end.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
            return `${startFormatted} - ${endFormatted}`;
        }
    }
    return start.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
};

// Pagination state & logic
const currentPage = ref(1);
const itemsPerPage = 3;

const totalPages = computed(() => {
    return Math.ceil(filteredAgendas.value.length / itemsPerPage);
});

const paginatedAgendas = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return filteredAgendas.value.slice(start, end);
});

const nextPage = () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
    }
};

const prevPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
    }
};

// Keep calendar and pagination in sync when selected category changes
watch(selectedCategory, () => {
    currentPage.value = 1;
});
</script>

<style scoped>
.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, minmax(0, 1fr));
}

.main-grid {
    display: grid;
    grid-template-columns: repeat(1, minmax(0, 1fr));
}

.calendar-header {
    background: linear-gradient(to right, #065f46, #047857);
}

.main-content-col {
    width: 100%;
}

.sidebar-col {
    width: 100%;
}

@media (min-width: 1024px) {
    .main-grid {
        grid-template-columns: repeat(12, minmax(0, 1fr));
    }
    
    .main-content-col {
        grid-column: span 8 / span 8;
    }
    
    .sidebar-col {
        grid-column: span 4 / span 4;
    }
}

/* Custom thin scrollbar for event details container */
::-webkit-scrollbar {
    width: 6px;
}
::-webkit-scrollbar-track {
    background: transparent;
}
::-webkit-scrollbar-thumb {
    background: rgba(16, 185, 129, 0.2);
    border-radius: 9999px;
}
::-webkit-scrollbar-thumb:hover {
    background: rgba(16, 185, 129, 0.4);
}
</style>
