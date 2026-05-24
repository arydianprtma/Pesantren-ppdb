<template>
    <Head :title="berita.judul" />
    <MainLayout>
        <!-- Article Header & Content -->
        <section class="relative py-12 overflow-hidden bg-white">
            <div class="relative z-10 max-w-[1600px] mx-auto px-4 sm:px-6 lg:pl-32 lg:pr-12">
                <!-- Header Content (Full Width) -->
                <div class="mb-12 max-w-7xl lg:mx-0">
                    <!-- Breadcrumb -->
                    <nav class="mb-8">
                        <ol class="flex items-center gap-2 text-sm text-gray-500">
                            <li>
                                <Link :href="route('home')" class="hover:text-emerald-600 transition-colors">Beranda</Link>
                            </li>
                            <li>
                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </li>
                            <li>
                                <Link :href="route('berita')" class="hover:text-emerald-600 transition-colors">Berita</Link>
                            </li>
                            <li>
                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </li>
                            <li class="text-emerald-800 font-medium truncate max-w-xs">{{ berita.judul }}</li>
                        </ol>
                    </nav>

                    <!-- Title -->
                    <div class="relative mb-8">
                        <div class="absolute -inset-y-4 -inset-x-6 bg-gradient-to-br from-emerald-100/60 via-emerald-50/40 to-transparent rounded-2xl -rotate-1"></div>
                        <h1 class="relative z-10 text-3xl md:text-5xl font-extrabold text-gray-900 leading-tight tracking-tight">
                            {{ berita.judul }}
                        </h1>
                    </div>

                    <!-- Meta Info -->
                    <div class="flex flex-wrap items-center gap-4 pb-6 border-b border-gray-100">
                        <span 
                            v-if="berita.is_new"
                            class="px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-red-500 to-pink-600 text-white shadow-md flex items-center gap-1.5"
                        >
                            BARU
                        </span>
                        <span 
                            class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border bg-emerald-50 text-emerald-700 border-emerald-200"
                        >
                            {{ formatKategori(berita.kategori) }}
                        </span>
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ formatDate(berita.published_at) }}
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ berita.author_name }}
                            </span>
                            <span class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-gray-50 text-gray-600 border border-gray-100">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span class="font-bold text-emerald-700">{{ berita.views ?? 0 }}</span>
                                <span class="text-xs uppercase tracking-wider font-medium">Dilihat</span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row gap-12 lg:gap-20 xl:gap-32 items-start justify-between">
                    <!-- Main Content -->
                    <div class="lg:w-[65%] xl:w-[70%] min-w-0">
                        <!-- Featured Image -->
                        <div v-if="berita.gambar" class="mb-10 rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                            <img 
                                :src="'/storage/' + berita.gambar" 
                                :alt="berita.judul"
                                loading="lazy"
                                class="w-full h-auto object-cover max-h-[650px]"
                            />
                        </div>

                        <!-- Article Content -->
                        <article class="prose prose-lg prose-emerald max-w-none article-justify">
                            <div v-html="berita.konten"></div>
                        </article>
                    </div>

                    <!-- Sidebar -->
                    <aside class="lg:w-[30%] xl:w-[25%] space-y-8 self-start sticky top-24">
                        <!-- Social Media Widget -->
                        <div v-if="webSetting" class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <span class="w-2 h-8 bg-emerald-600 rounded-full"></span>
                                Ikuti Kami
                            </h3>
                            <div class="grid grid-cols-1 gap-3">
                                <a v-if="webSetting.facebook" :href="webSetting.facebook" target="_blank" class="flex items-center gap-3 p-2.5 rounded-xl bg-blue-50 text-blue-700 hover:bg-blue-600 hover:text-white transition-all duration-300 group">
                                    <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    </div>
                                    <span class="text-sm font-bold">Facebook</span>
                                </a>
                                <a v-if="webSetting.instagram" :href="webSetting.instagram" target="_blank" class="flex items-center gap-3 p-2.5 rounded-xl bg-pink-50 text-pink-700 hover:bg-gradient-to-tr hover:from-purple-600 hover:to-pink-500 hover:text-white transition-all duration-300 group">
                                    <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-pink-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                    </div>
                                    <span class="text-sm font-bold">Instagram</span>
                                </a>
                                <a v-if="webSetting.tiktok" :href="webSetting.tiktok" target="_blank" class="flex items-center gap-3 p-2.5 rounded-xl bg-gray-50 text-gray-900 hover:bg-black hover:text-white transition-all duration-300 group">
                                    <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-gray-900" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.9-.32-1.98-.23-2.81.33-.85.51-1.44 1.43-1.58 2.41-.14.99.13 2.02.74 2.81.59.8 1.48 1.35 2.45 1.49.95.11 1.94-.15 2.69-.75.75-.56 1.21-1.46 1.25-2.4.03-2.99.02-5.98.02-8.97z"/></svg>
                                    </div>
                                    <span class="text-sm font-bold">TikTok</span>
                                </a>
                            </div>
                        </div>

                        <!-- Related News Sidebar Widget -->
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <span class="w-2 h-8 bg-emerald-600 rounded-full"></span>
                                Berita Terkini
                            </h3>
                            <div class="space-y-6">
                                <Link v-for="latest in relatedBeritas.slice(0, 4)" :key="latest.id" :href="route('berita.show', latest.slug)" class="flex gap-4 group">
                                    <div class="w-20 h-20 rounded-2xl overflow-hidden flex-shrink-0 bg-gray-100 shadow-sm border border-gray-50">
                                        <img v-if="latest.gambar" :src="'/storage/' + latest.gambar" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-bold text-gray-900 group-hover:text-emerald-600 transition-colors line-clamp-2 leading-snug">
                                            {{ latest.judul }}
                                        </h4>
                                        <p class="text-xs text-gray-400 mt-1.5 font-medium uppercase tracking-tighter">{{ formatDate(latest.published_at) }}</p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <!-- Related Articles Carousel -->
        <section v-if="relatedBeritas.length > 0" class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Berita Terkait</h2>
                    <div class="flex gap-2">
                        <button 
                            @click="scrollRelated('left')"
                            class="p-2 rounded-full bg-white shadow-md hover:bg-emerald-50 hover:shadow-lg transition-all duration-300 text-gray-600 hover:text-emerald-600"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button 
                            @click="scrollRelated('right')"
                            class="p-2 rounded-full bg-white shadow-md hover:bg-emerald-50 hover:shadow-lg transition-all duration-300 text-gray-600 hover:text-emerald-600"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Scrollable Container -->
                <div 
                    ref="relatedContainer"
                    class="flex gap-6 overflow-x-auto scroll-smooth pb-4 scrollbar-hide"
                    style="scroll-snap-type: x mandatory;"
                    @mouseenter="pauseAutoScroll"
                    @mouseleave="resumeAutoScroll"
                >
                    <Link 
                        v-for="related in relatedBeritas" 
                        :key="related.id"
                        :href="route('berita.show', related.slug)"
                        class="group flex-shrink-0 w-72 sm:w-80"
                        style="scroll-snap-align: start;"
                    >
                        <article class="card overflow-hidden hover:shadow-xl transition-all duration-300 h-full bg-white">
                            <div class="aspect-video overflow-hidden bg-gray-100 -mx-6 -mt-6 mb-4 relative">
                                <!-- Badge Baru -->
                                <span 
                                    v-if="related.is_new"
                                    class="absolute top-2 left-2 px-2 py-0.5 rounded-full text-xs font-bold bg-red-500 text-white z-10 flex items-center gap-1"
                                >
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    BARU
                                </span>
                                <img 
                                    v-if="related.gambar"
                                    :src="'/storage/' + related.gambar" 
                                    :alt="related.judul"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                    loading="lazy"
                                />
                                <div v-else class="w-full h-full flex items-center justify-center bg-gradient-to-br from-emerald-100 to-emerald-50">
                                    <svg class="w-12 h-12 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="font-bold text-gray-900 group-hover:text-emerald-600 transition-colors line-clamp-2 mb-2">
                                {{ related.judul }}
                            </h3>
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <span>{{ formatDate(related.published_at) }}</span>
                                <span>•</span>
                                <span>{{ related.author_name }}</span>
                            </div>
                        </article>
                    </Link>
                </div>
            </div>
        </section>

        <!-- Back to News -->
        <section class="py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <Link 
                    :href="route('berita')"
                    class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-semibold"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Daftar Berita
                </Link>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import MainLayout from '../../Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';

const props = defineProps({
    berita: {
        type: Object,
        required: true
    },
    relatedBeritas: {
        type: Array,
        default: () => []
    },
    webSetting: {
        type: Object,
        default: null
    }
});

const relatedContainer = ref(null);
const isHovering = ref(false);
let autoScrollInterval = null;

// Scroll related news carousel
const scrollRelated = (direction) => {
    if (relatedContainer.value) {
        const scrollAmount = 320;
        if (direction === 'left') {
            relatedContainer.value.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            relatedContainer.value.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }
};

// Auto scroll carousel
const autoScroll = () => {
    if (relatedContainer.value && !isHovering.value) {
        const container = relatedContainer.value;
        const maxScroll = container.scrollWidth - container.clientWidth;
        
        if (container.scrollLeft >= maxScroll - 10) {
            container.scrollTo({ left: 0, behavior: 'smooth' });
        } else {
            container.scrollBy({ left: 320, behavior: 'smooth' });
        }
    }
};

const pauseAutoScroll = () => {
    isHovering.value = true;
};

const resumeAutoScroll = () => {
    isHovering.value = false;
};

onMounted(() => {
    if (props.relatedBeritas.length > 0) {
        autoScrollInterval = setInterval(autoScroll, 4000);
    }
});

onUnmounted(() => {
    if (autoScrollInterval) {
        clearInterval(autoScrollInterval);
    }
});

const formatKategori = (kategori) => {
    const map = {
        'pengumuman': 'Pengumuman',
        'kegiatan': 'Kegiatan',
        'prestasi': 'Prestasi',
        'umum': 'Umum'
    };
    return map[kategori] || kategori;
};

const formatDate = (dateString) => {
    if (!dateString) return '';
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });
};
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Text Justify for Article Content */
.article-justify,
.article-justify p,
.article-justify div {
    text-align: justify !important;
    text-justify: inter-word !important;
}

/* Hide scrollbar for carousel */
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

.prose {
    color: #374151;
}

.prose h1, .prose h2, .prose h3, .prose h4 {
    color: #111827;
    font-weight: 700;
    text-align: left !important;
}

.prose a {
    color: #2563eb !important;
    text-decoration: underline !important;
}

.prose a:hover {
    color: #1d4ed8 !important;
}

.prose img {
    border-radius: 0.75rem;
}

.prose blockquote {
    border-left-color: #059669;
    color: #4B5563;
}
</style>