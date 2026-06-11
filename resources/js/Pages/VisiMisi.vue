<template>
    <Head title="Visi & Misi" />
    <MainLayout>
        <!-- Hero Section -->
        <section class="relative bg-emerald-900 py-24 overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-dot-pattern opacity-20"></div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-emerald-800 text-emerald-300 text-sm font-semibold mb-4 border border-emerald-700">
                    Profil Lembaga
                </span>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
                    Visi & Misi
                </h1>
                <p class="text-xl text-emerald-100 max-w-2xl mx-auto leading-relaxed">
                    Komitmen teguh Pondok Pesantren Riyadussalikin Padaherang dalam mencetak generasi berkualitas.
                </p>
            </div>
        </section>

        <!-- Unified Section: Visi, Misi & Pengasuh -->
        <section class="py-20 bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
                    <!-- Left Column: Visi & Misi -->
                    <div class="w-full lg:w-2/3 space-y-12">
                        <!-- Visi Part -->
                        <div>
                            <div class="inline-block bg-emerald-100 text-emerald-700 px-6 py-2 rounded-full font-semibold mb-6">
                                VISI
                            </div>
                            <div class="card bg-gradient-to-br from-emerald-50 to-white border-2 border-emerald-200 p-8 shadow-sm rounded-3xl">
                                <div v-if="visiMisi" class="prose prose-emerald max-w-none text-gray-900 leading-relaxed text-justify" v-html="visiMisi.visi"></div>
                                <p v-else class="text-2xl font-bold text-gray-900 leading-relaxed text-justify">
                                    "Menjadi Lembaga Pendidikan Islam Terdepan dalam Mencetak Generasi Qur'ani yang Berakhlak Mulia, Berilmu Luas, dan Mandiri"
                                </p>
                            </div>
                        </div>

                        <!-- Misi Part -->
                        <div>
                            <div class="inline-block bg-emerald-100 text-emerald-700 px-6 py-2 rounded-full font-semibold mb-6">
                                MISI
                            </div>
                            <div v-if="visiMisi" class="card bg-gradient-to-br from-emerald-50 to-white border-2 border-emerald-200 p-8 shadow-sm rounded-3xl">
                                <div class="prose prose-emerald max-w-none text-gray-900 leading-relaxed text-justify prose-ol:list-decimal prose-ol:pl-5" v-html="visiMisi.misi"></div>
                            </div>
                            <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group card bg-gradient-to-br from-emerald-50 to-white border-2 border-emerald-200 p-6 shadow-sm rounded-2xl hover:shadow-lg transition-all duration-300">
                                    <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center mb-4 font-bold text-lg shadow-emerald-200 shadow-lg">1</div>
                                    <h3 class="font-bold text-gray-900 mb-2">Pendidikan Al-Qur'an</h3>
                                    <p class="text-sm text-gray-600 text-justify">Menyelenggarakan pendidikan Al-Qur'an yang komprehensif dengan metode tahfidz dan tahsin.</p>
                                </div>
                                <div class="group card bg-gradient-to-br from-emerald-50 to-white border-2 border-emerald-200 p-6 shadow-sm rounded-2xl hover:shadow-lg transition-all duration-300">
                                    <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center mb-4 font-bold text-lg shadow-emerald-200 shadow-lg">2</div>
                                    <h3 class="font-bold text-gray-900 mb-2">Karakter Islami</h3>
                                    <p class="text-sm text-gray-600 text-justify">Membina akhlak mulia melalui keteladanan dan pembiasaan ibadah sesuai sunnah.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Pengasuh -->
                    <div v-if="visiMisi?.nama_pengasuh" class="w-full lg:w-1/3">
                        <div class="sticky top-24 space-y-8">
                            <!-- Foto Pengasuh -->
                            <div class="relative group">
                                <div class="aspect-[3/4] rounded-3xl overflow-hidden shadow-2xl relative z-10 border-8 border-white group transform-gpu transition-transform duration-500 hover:scale-105 ">
                                    <img 
                                        v-if="visiMisi.foto_pengasuh" 
                                        :src="'/storage/' + visiMisi.foto_pengasuh" 
                                        :alt="visiMisi.nama_pengasuh"
                                        loading="lazy"
                                        class="w-full h-full object-cover transform-gpu backface-hidden"
                                    />
                                    <div v-else class="w-full h-full bg-emerald-100 flex items-center justify-center">
                                        <svg class="w-20 h-20 text-emerald-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <!-- Decorative Elements -->
                                <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-emerald-100 rounded-full -z-0 animate-pulse"></div>
                                <div class="absolute -top-4 -left-4 w-24 h-24 bg-yellow-100 rounded-full -z-0 animate-bounce-slow"></div>
                            </div>

                            <!-- Profil Pengasuh -->
                            <div class="text-center lg:text-left">
                                <div class="inline-block px-4 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold mb-4">
                                    Pengasuh Pondok
                                </div>
                                <h2 class="text-2xl font-extrabold text-gray-900 mb-4 leading-tight">
                                    {{ visiMisi.nama_pengasuh }}
                                </h2>
                                <div class="prose prose-sm prose-emerald text-gray-700 leading-relaxed mb-6 text-justify" v-html="visiMisi.kata_sambutan"></div>
                                <div class="h-1 w-16 bg-emerald-600 rounded-full mx-auto lg:mx-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Nilai-Nilai Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="section-title">Nilai-Nilai Pesantren</h2>
                    <p class="section-subtitle">
                        Prinsip yang menjadi landasan dalam setiap aktivitas di Pondok Pesantren Riyadussalikin
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="card text-center bg-gradient-to-br from-emerald-50 to-white border-2 border-emerald-100 p-6">
                        <div class="bg-emerald-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Ikhlas</h3>
                        <p class="text-sm text-gray-600">Melakukan segala sesuatu dengan niat yang tulus karena Allah SWT</p>
                    </div>

                    <div class="card text-center bg-gradient-to-br from-emerald-50 to-white border-2 border-emerald-100 p-6">
                        <div class="bg-emerald-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Ilmu</h3>
                        <p class="text-sm text-gray-600">Menuntut ilmu dengan sungguh-sungguh dan mengamalkannya</p>
                    </div>

                    <div class="card text-center bg-gradient-to-br from-emerald-50 to-white border-2 border-emerald-100 p-6">
                        <div class="bg-emerald-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Ukhuwah</h3>
                        <p class="text-sm text-gray-600">Membangun persaudaraan yang kuat sesama muslim</p>
                    </div>

                    <div class="card text-center bg-gradient-to-br from-emerald-50 to-white border-2 border-emerald-100 p-6">
                        <div class="bg-emerald-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Amanah</h3>
                        <p class="text-sm text-gray-600">Bertanggung jawab dan dapat dipercaya dalam setiap tugas</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <CallToAction 
            title="Wujudkan Visi Bersama Kami" 
            description="Bergabunglah dengan Pondok Pesantren Riyadussalikin untuk menjadi bagian dari generasi Qur'ani yang berakhlak mulia" 
        />
    </MainLayout>
</template>

<script setup>
import MainLayout from '../Layouts/MainLayout.vue';
import CallToAction from '../Components/CallToAction.vue';
import { Link, Head } from '@inertiajs/vue3';

defineProps({
    visiMisi: Object,
});
</script>

<style scoped>
.backface-hidden {
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
}

.animate-bounce-slow {
    animation: bounce 3s infinite;
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(-5%);
        animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
    }
    50% {
        transform: translateY(0);
        animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
    }
}

img {
    image-rendering: -webkit-optimize-contrast;
}

/* Fix: Tailwind reset hides list markers inside v-html content */
.prose :deep(ol) {
    list-style-type: decimal;
    padding-left: 1.5rem;
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}

.prose :deep(ul) {
    list-style-type: disc;
    padding-left: 1.5rem;
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}

.prose :deep(ol li),
.prose :deep(ul li) {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
    padding-left: 0.25rem;
}
</style>
