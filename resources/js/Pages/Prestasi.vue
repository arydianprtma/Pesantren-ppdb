<template>
    <Head title="Prestasi Santri" />
    <MainLayout>
        <!-- Hero Section -->
        <section class="relative bg-emerald-900 py-24 overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
                </svg>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-emerald-800 text-emerald-300 text-sm font-semibold mb-4 border border-emerald-700">
                    Hall of Fame
                </span>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
                    Jejak Prestasi Santri
                </h1>
                <p class="text-xl text-emerald-100 max-w-2xl mx-auto leading-relaxed">
                    Bukti nyata dedikasi dan keunggulan santri Pondok Pesantren Riyadussalikin dalam berbagai bidang kompetisi.
                </p>
            </div>
        </section>

        <!-- Filter & Content Section -->
        <section class="py-12 bg-gray-50 min-h-screen">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Filters Bar -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-12 flex flex-col md:flex-row gap-4 items-center justify-between sticky top-4 z-30 opacity-95 backdrop-blur-sm">
                    <div class="flex items-center gap-2 text-gray-600 font-medium">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        <span>Filter Prestasi:</span>
                    </div>
                    <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                        <select 
                            v-model="selectedKategori" 
                            @change="filterPrestasi"
                            class="pl-4 pr-10 py-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm cursor-pointer hover:border-emerald-300 transition-colors bg-gray-50"
                        >
                            <option value="semua">Semua Kategori</option>
                            <option value="akademik">Akademik</option>
                            <option value="non_akademik">Non-Akademik</option>
                            <option value="keagamaan">Keagamaan</option>
                        </select>

                        <select 
                            v-model="selectedTahun" 
                            @change="filterPrestasi"
                            class="pl-4 pr-10 py-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm cursor-pointer hover:border-emerald-300 transition-colors bg-gray-50"
                        >
                            <option value="">Semua Tahun</option>
                            <option v-for="tahun in tahunList" :key="tahun" :value="tahun">{{ tahun }}</option>
                        </select>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-if="!prestasi?.data?.length" class="flex flex-col items-center justify-center py-20 text-center">
                    <div class="bg-gray-100 p-6 rounded-full mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada prestasi ditemukan</h3>
                    <p class="text-gray-500">Coba ubah filter kategori atau tahun pencarian Anda.</p>
                </div>

                <!-- Modern Grid Layout -->
                <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 content-start">
                    <div v-for="item in prestasi.data" :key="item.id" 
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full relative group"
                    >
                        <!-- Top Decoration & Category -->
                        <div class="h-56 bg-gray-50 relative overflow-hidden group">
                            <!-- Image / Pattern -->
                            <template v-if="item.gambar">
                                <img 
                                    :src="'/img/medium/' + item.gambar" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                    :alt="item.judul"
                                    loading="lazy"
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-80"></div>
                            </template>
                            
                            <template v-else>
                                <div class="absolute inset-0 flex items-center justify-center transform group-hover:scale-105 transition-transform duration-700">
                                    <div class="opacity-10 absolute inset-0">
                                        <svg v-if="item.kategori === 'akademik'" class="w-full h-full text-green-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>
                                        <svg v-else-if="item.kategori === 'non_akademik'" class="w-full h-full text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" /></svg>
                                        <svg v-else class="w-full h-full text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" /></svg>
                                    </div>
                                    <!-- Trophy Icon in Empty State -->
                                    <div class="z-10 bg-white/80 backdrop-blur-sm p-4 rounded-full shadow-lg">
                                        <i :class="[getRankIconClass(item.deskripsi), getRankColorClass(item.deskripsi)]" class="text-4xl filter drop-shadow"></i>
                                    </div>
                                </div>
                            </template>
                            
                            <!-- Badges (Absolute Positioned) -->
                            <div class="absolute top-4 right-4 flex flex-col gap-2 items-end">
                                <div class="bg-white/90 backdrop-blur text-gray-800 text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm">
                                    {{ item.tahun }}
                                </div>
                                <div v-if="item.gambar" class="bg-white/90 backdrop-blur p-2.5 rounded-full shadow-sm flex items-center justify-center">
                                    <i :class="[getRankIconClass(item.deskripsi), getRankColorClass(item.deskripsi)]" class="text-xl"></i>
                                </div>
                            </div>
                            
                            <!-- Category Badge (Bottom Left) -->
                            <div class="absolute bottom-4 left-4">
                                <span 
                                    class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm border border-white/20"
                                    :class="item.gambar ? 'bg-black/50 text-white backdrop-blur' : getCategoryBadgeClass(item.kategori)"
                                >
                                    {{ getCategoryLabel(item.kategori) }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <div class="mb-4">
                                <span 
                                    class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-2"
                                    :class="getCategoryBadgeClass(item.kategori)"
                                >
                                    {{ getCategoryLabel(item.kategori) }}
                                </span>
                                <div class="flex items-center text-xs text-gray-500 font-medium uppercase tracking-wide">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    {{ item.tingkat }}
                                </div>
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 leading-tight mb-3 group-hover:text-emerald-700 transition-colors">
                                {{ item.judul }}
                            </h3>
                            
                            <p class="text-gray-600 text-sm leading-relaxed mb-4 flex-grow">
                                {{ item.deskripsi || 'Prestasi membanggakan dari santri terbaik kami.' }}
                            </p>
                            
                        </div>
                        
                        <!-- Footer Indicator -->
                        <div class="h-1 w-full" :class="getCategoryColor(item.kategori)"></div>
                    </div>
                </div>

                <!-- Pagination -->
                <div v-if="prestasi?.links?.length > 3" class="mt-16 flex justify-center">
                    <div class="inline-flex bg-white rounded-lg shadow-sm border border-gray-200 p-1 space-x-1">
                        <template v-for="(link, key) in prestasi.links" :key="key">
                            <Link
                                v-if="link.url"
                                :href="link.url"
                                v-html="link.label"
                                class="px-4 py-2 rounded-md text-sm font-medium transition-all"
                                :class="{
                                    'bg-emerald-600 text-white shadow-md': link.active,
                                    'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700': !link.active
                                }"
                                preserve-scroll
                            />
                            <span
                                v-else
                                v-html="link.label"
                                class="px-4 py-2 text-sm font-medium text-gray-300 cursor-not-allowed"
                            ></span>
                        </template>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import MainLayout from '../Layouts/MainLayout.vue';
import { router, Link, Head } from '@inertiajs/vue3'; // Import Head

const props = defineProps({
    prestasi: {
        type: Object, // Changed back to Object for Pagination result
        default: () => ({ data: [], links: [] }) // Safe default structure
    },
    tahunList: {
        type: Array,
        default: () => []
    },
    filters: {
        type: Object,
        default: () => ({ kategori: 'semua', tahun: '' })
    }
});

const selectedKategori = ref(props.filters.kategori);
const selectedTahun = ref(props.filters.tahun);

const filterPrestasi = () => {
    router.get(route('prestasi'), {
        kategori: selectedKategori.value,
        tahun: selectedTahun.value
    }, {
        preserveState: true,
        preserveScroll: true
    });
};

// Helper Functions
const getCategoryLabel = (kategori) => {
    const labels = {
        'akademik': 'Akademik',
        'non_akademik': 'Non-Akademik',
        'keagamaan': 'Keagamaan'
    };
    return labels[kategori] || kategori;
};

const getCategoryColor = (kategori) => {
    const colors = {
        'akademik': 'bg-green-500',
        'non_akademik': 'bg-blue-500',
        'keagamaan': 'bg-purple-500'
    };
    return colors[kategori] || 'bg-gray-500';
};

const getCategoryBadgeClass = (kategori) => {
    const classes = {
        'akademik': 'bg-green-100 text-green-800',
        'non_akademik': 'bg-blue-100 text-blue-800',
        'keagamaan': 'bg-purple-100 text-purple-800'
    };
    return classes[kategori] || 'bg-gray-100 text-gray-800';
};

const getRankIconClass = (text) => {
    if (!text) return 'fas fa-trophy';
    const lower = text.toLowerCase();
    if (lower.includes('1') || lower.includes('satu') || lower.includes('emas') || lower.includes('gold')) return 'fas fa-trophy';
    if (lower.includes('2') || lower.includes('dua') || lower.includes('perak') || lower.includes('silver')) return 'fas fa-medal';
    if (lower.includes('3') || lower.includes('tiga') || lower.includes('perunggu') || lower.includes('bronze')) return 'fas fa-medal';
    if (lower.includes('harapan') || lower.includes('favorit')) return 'fas fa-award';
    return 'fas fa-star';
};

const getRankColorClass = (text) => {
    if (!text) return 'text-yellow-500';
    const lower = text.toLowerCase();
    if (lower.includes('1') || lower.includes('satu') || lower.includes('emas') || lower.includes('gold')) return 'text-yellow-500';
    if (lower.includes('2') || lower.includes('dua') || lower.includes('perak') || lower.includes('silver')) return 'text-gray-400';
    if (lower.includes('3') || lower.includes('tiga') || lower.includes('perunggu') || lower.includes('bronze')) return 'text-amber-700'; // Bronze color
    if (lower.includes('harapan') || lower.includes('favorit')) return 'text-blue-500';
    return 'text-emerald-500';
};
</script>
