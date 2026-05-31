<template>
    <Head title="Profil Sekolah - SMP Dharma Ksatria" />
    <MainLayout>
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-blue-950 via-blue-900 to-slate-950 py-24 overflow-hidden">
            <!-- Decorative Glow Elements -->
            <div class="absolute top-1/4 left-1/10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl -z-0"></div>
            <div class="absolute bottom-1/4 right-1/10 w-96 h-96 bg-sky-500/10 rounded-full blur-3xl -z-0"></div>
            <div class="absolute inset-0 bg-dot-pattern opacity-10"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
                <span class="inline-flex items-center gap-1.5 py-1 px-3.5 rounded-full bg-blue-900/50 text-blue-300 text-xs font-bold mb-4 border border-blue-700/50 backdrop-blur-md">
                    <span class="w-1.5 h-1.5 rounded-full bg-sky-400 animate-pulse"></span>
                    Profil Lembaga
                </span>
                <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight leading-none uppercase">
                    Profil Sekolah
                </h1>
                <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed font-medium">
                    Mengenal lebih dekat SMP Dharma Ksatria - sejarah singkat, visi & misi, serta sambutan pimpinan sekolah kami.
                </p>
            </div>
        </section>

        <!-- Sambutan Kepala Sekolah Section -->
        <section class="py-20 bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-center">
                    <!-- Left: Foto Kepala Sekolah -->
                    <div class="w-full lg:w-5/12 flex flex-col items-center relative">
                        <!-- Decorative Shapes -->
                        <div class="absolute -bottom-6 -right-6 w-72 h-72 bg-blue-100 rounded-full blur-3xl -z-0"></div>
                        <div class="absolute -top-6 -left-6 w-36 h-36 bg-sky-100 rounded-full blur-2xl -z-0"></div>

                        <div class="relative group z-10 w-full max-w-sm mb-4">
                            <div class="aspect-[3/4] rounded-3xl overflow-hidden shadow-2xl relative border-8 border-slate-50 group hover:scale-102 transition-transform duration-500 bg-slate-100 flex items-center justify-center">
                                <img 
                                    v-if="profil?.foto_kepsek" 
                                    :src="'/storage/' + profil.foto_kepsek" 
                                    :alt="profil?.nama_kepsek || 'Kepala Sekolah'"
                                    class="w-full h-full object-cover object-center"
                                />
                                <div v-else class="w-full h-full bg-blue-50 flex flex-col items-center justify-center py-10 px-6 text-center text-blue-300">
                                    <svg class="w-24 h-24 mb-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span class="text-xs font-semibold text-blue-400">Belum ada foto kepala sekolah</span>
                                </div>
                            </div>
                        </div>

                        <!-- Nama di Bawah Foto -->
                        <div class="relative z-10 text-center">
                            <h3 class="text-lg font-extrabold text-slate-900 font-poppins">
                                {{ profil?.nama_kepsek || 'Drs. H. Ahmad Dahlan, M.Pd.' }}
                            </h3>
                            <p class="text-xs text-blue-600 font-bold tracking-wider uppercase mt-0.5">
                                Kepala Sekolah SMP Dharma Ksatria
                            </p>
                        </div>
                    </div>

                    <!-- Right: Sambutan Konten -->
                    <div class="w-full lg:w-7/12 space-y-6">
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-sm font-bold rounded-full uppercase tracking-wider">Sambutan Pimpinan</span>
                        
                        <div class="space-y-1">
                            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight leading-tight font-poppins">
                                {{ profil?.nama_kepsek || 'Kepala Sekolah SMP Dharma Ksatria' }}
                            </h2>
                            <p class="text-blue-600 font-bold text-sm tracking-wide uppercase">
                                Kepala Sekolah SMP Dharma Ksatria
                            </p>
                        </div>

                        <div class="h-1 w-20 bg-blue-600 rounded-full my-4"></div>

                        <div class="text-slate-700 leading-relaxed text-justify whitespace-pre-line text-base font-medium italic">
                            <template v-if="profil?.sambutan_kepsek">
                                "{{ profil.sambutan_kepsek }}"
                            </template>
                            <template v-else>
                                "Assalamualaikum Warahmatullahi Wabarakatuh,<br/><br/>
                                Selamat datang di halaman profil resmi SMP Dharma Ksatria Padaherang. Kami sangat bersyukur dan bangga menyambut Anda di lembaga pendidikan tingkat pertama kami yang dirancang khusus untuk mengintegrasikan keunggulan akademik umum dengan kurikulum akhlak diniyah pesantren klasik.<br/><br/>
                                Di SMP Dharma Ksatria, kami berikhtiar semaksimal mungkin untuk melatih nalar kritis keilmuan para murid di masa transisi remaja mereka, sekaligus membentengi jiwa mereka dengan adab Islami yang luhur. Kami percaya bahwa kecerdasan intelektual yang diimbangi dengan kedalaman spiritual adalah kunci utama untuk membentuk generasi masa depan yang tangguh, cerdas, berkarakter, dan berakhlakul karimah.<br/><br/>
                                Terima kasih atas amanah dan kepercayaan yang diberikan kepada kami untuk mendidik putra-putri Anda. Mari berkolaborasi bersama demi mewujudkan masa depan anak-anak kita yang gemilang.<br/><br/>
                                Wassalamualaikum Warahmatullahi Wabarakatuh."
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Profil Singkat & Stats -->
        <section class="py-20 bg-slate-50 border-t border-b border-slate-100 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    <!-- Left: Description -->
                    <div class="lg:col-span-7 space-y-6">
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-sm font-bold rounded-full uppercase tracking-wider">Tentang Sekolah</span>
                        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                            SMP Dharma Ksatria Padaherang
                        </h2>
                        
                        <div v-if="profil?.profil" class="prose prose-slate max-w-none text-slate-700 leading-relaxed text-justify whitespace-pre-line" v-html="profil.profil"></div>
                        <div v-else class="space-y-4 text-slate-700 leading-relaxed text-justify">
                            <p>
                                SMP Dharma Ksatria adalah sekolah menengah pertama swasta berbasis pesantren yang berada di bawah naungan Yayasan Pondok Pesantren Riyadussalikin Padaherang. Didirikan dengan komitmen tinggi untuk menyediakan pendidikan formal tingkat menengah yang unggul dan terintegrasi secara holistik.
                            </p>
                            <p>
                                Sekolah ini menyelaraskan Kurikulum Nasional (Kurikulum Merdeka) secara seimbang dengan materi Diniyah Pesantren klasik. Penyelarasan ini bertujuan agar para siswa tidak hanya menguasai sains, teknologi dasar, dan literasi umum, namun juga memiliki kedalaman akhlak, adab, serta pemahaman agama Islam yang kokoh sejak usia dini.
                            </p>
                        </div>
                    </div>

                    <!-- Right: Stats / Info Cards -->
                    <div class="lg:col-span-5 grid grid-cols-2 gap-4">
                        <div class="p-6 bg-white text-center border border-slate-150 rounded-3xl shadow-sm hover:shadow-md transition-all duration-300">
                            <div class="text-4xl font-extrabold text-blue-900 mb-1">
                                {{ profil?.stat_1_val ?? 'A' }}
                            </div>
                            <div class="text-xs font-black text-slate-500 uppercase tracking-widest">
                                {{ profil?.stat_1_lbl ?? 'Akreditasi BAN-SM' }}
                            </div>
                        </div>
                        <div class="p-6 bg-white text-center border border-slate-150 rounded-3xl shadow-sm hover:shadow-md transition-all duration-300">
                            <div class="text-4xl font-extrabold text-blue-900 mb-1">
                                {{ profil?.stat_2_val ?? '100%' }}
                            </div>
                            <div class="text-xs font-black text-slate-500 uppercase tracking-widest">
                                {{ profil?.stat_2_lbl ?? 'Kelulusan Siswa' }}
                            </div>
                        </div>
                        <div class="p-6 bg-white text-center border border-slate-150 rounded-3xl shadow-sm hover:shadow-md transition-all duration-300">
                            <div class="text-4xl font-extrabold text-blue-900 mb-1">
                                {{ profil?.stat_3_val ?? '2' }}
                            </div>
                            <div class="text-xs font-black text-slate-500 uppercase tracking-widest">
                                {{ profil?.stat_3_lbl ?? 'Kurikulum Terpadu' }}
                            </div>
                        </div>
                        <div class="p-6 bg-white text-center border border-slate-150 rounded-3xl shadow-sm hover:shadow-md transition-all duration-300">
                            <div class="text-4xl font-extrabold text-blue-900 mb-1">
                                {{ profil?.stat_4_val ?? '10+' }}
                            </div>
                            <div class="text-xs font-black text-slate-500 uppercase tracking-widest">
                                {{ profil?.stat_4_lbl ?? 'Ekskul & Kegiatan' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Visi & Misi Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-sm font-bold rounded-full uppercase tracking-wider mb-3">Arah & Komitmen</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        Visi & Misi Sekolah
                    </h2>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                    <!-- Visi Card -->
                    <div class="bg-slate-50 border border-slate-200/60 p-8 shadow-sm rounded-3xl relative overflow-hidden group hover:shadow-md transition-all duration-300">
                        <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-blue-50 rounded-full -z-0 group-hover:scale-110 transition-transform duration-500"></div>
                        <div class="relative z-10 space-y-4">
                            <div class="inline-block bg-blue-600 text-white px-5 py-1.5 rounded-full text-xs font-black uppercase tracking-wider shadow-md shadow-blue-200">
                                Visi Sekolah
                            </div>
                            <div v-if="profil?.visi" class="prose prose-blue max-w-none text-slate-800 leading-relaxed text-justify text-lg font-bold italic" v-html="profil.visi"></div>
                            <p v-else class="text-lg md:text-xl font-bold text-slate-800 italic leading-relaxed text-justify">
                                "Mewujudkan lulusan SMP yang unggul dalam Imtaq, terampil dalam teknologi dasar, berbudaya ilmiah, dan tangguh berakhlak mulia."
                            </p>
                        </div>
                    </div>

                    <!-- Misi Card -->
                    <div class="bg-slate-50 border border-slate-200/60 p-8 shadow-sm rounded-3xl relative overflow-hidden group hover:shadow-md transition-all duration-300">
                        <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-sky-50/70 rounded-full -z-0 group-hover:scale-110 transition-transform duration-500"></div>
                        <div class="relative z-10 space-y-4">
                            <div class="inline-block bg-sky-500 text-white px-5 py-1.5 rounded-full text-xs font-black uppercase tracking-wider shadow-md shadow-sky-100">
                                Misi Sekolah
                            </div>
                            <div v-if="profil?.misi" class="prose prose-blue max-w-none text-slate-700 leading-relaxed text-justify text-sm list-decimal pl-2 prose-ol:list-decimal prose-ol:pl-5" v-html="profil.misi"></div>
                            <div v-else class="space-y-4">
                                <div class="flex gap-4 items-start">
                                    <div class="flex-shrink-0 w-8 h-8 bg-blue-50 text-blue-600 font-bold rounded-lg flex items-center justify-center">1</div>
                                    <p class="text-sm text-slate-700 leading-relaxed">Penyelarasan adab dan tata krama Islami di lingkungan belajar sehari-hari.</p>
                                </div>
                                <div class="flex gap-4 items-start">
                                    <div class="flex-shrink-0 w-8 h-8 bg-blue-50 text-blue-600 font-bold rounded-lg flex items-center justify-center">2</div>
                                    <p class="text-sm text-slate-700 leading-relaxed">Menyelenggarakan pembelajaran Kurikulum Nasional yang terpadu secara aktif dan menyenangkan.</p>
                                </div>
                                <div class="flex gap-4 items-start">
                                    <div class="flex-shrink-0 w-8 h-8 bg-blue-50 text-blue-600 font-bold rounded-lg flex items-center justify-center">3</div>
                                    <p class="text-sm text-slate-700 leading-relaxed">Membekali murid dengan keterampilan komputer dasar, logika pemrograman sederhana (coding), serta bahasa asing harian.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 relative bg-gradient-to-br from-blue-950 to-slate-950 overflow-hidden text-center border-t border-blue-900">
            <!-- Decorative Glow Elements -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-500/5 rounded-full blur-3xl -z-0"></div>
            
            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
                <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4 uppercase tracking-tight">
                    Mulai Langkah Pendidikan Terbaik Sekarang
                </h2>
                <p class="text-blue-100 text-sm md:text-base mb-10 max-w-2xl mx-auto leading-relaxed">
                    SMP Dharma Ksatria berkomitmen mendidik siswa dengan kurikulum berkualitas tinggi yang menyelaraskan sains, teknologi, dan akhlak mulia.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a 
                        href="https://ppdb.riyadussalikin.my.id/login"
                        class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white font-bold text-xs uppercase tracking-widest rounded-xl hover:bg-blue-500 transition-all duration-300 shadow-lg shadow-blue-900/30 border border-blue-500 hover:scale-105"
                    >
                        Daftar PPDB SMP
                    </a>
                    <Link 
                        :href="route('kontak')"
                        class="w-full sm:w-auto px-8 py-4 bg-transparent border border-white/20 hover:bg-white/5 text-white font-bold text-xs uppercase tracking-widest rounded-xl transition-all duration-300"
                    >
                        Hubungi Panitia
                    </Link>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import MainLayout from '../Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';

defineProps({
    profil: {
        type: Object,
        default: () => null
    }
});
</script>

<style scoped>
img {
    image-rendering: -webkit-optimize-contrast;
}
.bg-dot-pattern {
    background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
    background-size: 20px 20px;
}
</style>
