<template>
    <Head title="SMP Dharma Ksatria" />
    <MainLayout>
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-blue-950 via-blue-900 to-slate-950 py-24 md:py-32 overflow-hidden">
            <!-- Decorative Glow Elements -->
            <div class="absolute top-1/4 left-1/10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl -z-0"></div>
            <div class="absolute bottom-1/4 right-1/10 w-96 h-96 bg-sky-500/10 rounded-full blur-3xl -z-0"></div>
            <div class="absolute inset-0 bg-dot-pattern opacity-10"></div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
                <!-- Logo Sekolah -->
                <img src="/assets/Logo_Sekolah/smp_dharma_ksatria.png" alt="Logo SMP Dharma Ksatria" class="w-28 h-28 mx-auto mb-6 object-contain filter drop-shadow-xl" />
                <span class="inline-flex items-center gap-1.5 py-1 px-3.5 rounded-full bg-blue-900/50 text-blue-300 text-xs font-bold mb-6 border border-blue-700/50 backdrop-blur-md">
                    <span class="w-1.5 h-1.5 rounded-full bg-sky-400 animate-pulse"></span>
                    Unit Pendidikan Formal
                </span>
                <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight leading-none uppercase">
                    SMP Dharma Ksatria
                </h1>
                <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed font-medium mb-10">
                    Mengintegrasikan Kurikulum Nasional (Merdeka) dengan Pendidikan Kepesantrenan Klasik untuk Membentuk Generasi Berkarakter, Cerdas, dan Berakhlakul Karimah.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a 
                        :href="ppdbUrl"
                        class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white font-bold text-xs uppercase tracking-widest rounded-xl hover:bg-blue-500 transition-all duration-300 shadow-lg shadow-blue-900/30 border border-blue-500 hover:scale-105"
                    >
                        Daftar SPMB SMP
                    </a>
                    <Link 
                        :href="route('kontak')"
                        class="w-full sm:w-auto px-8 py-4 bg-white/10 text-white border border-white/20 font-bold text-xs uppercase tracking-widest rounded-xl hover:bg-white/25 transition-all duration-300 backdrop-blur-sm"
                    >
                        Tanya Pendaftaran
                    </Link>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="relative -mt-8 z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-8 bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-100/50">
                <div class="text-center p-4 border-r border-slate-100 last:border-0">
                    <div class="text-3xl md:text-4xl font-extrabold text-blue-900 mb-1">
                        {{ profil?.stat_1_val ?? 'A' }}
                    </div>
                    <div class="text-xs font-black text-slate-500 uppercase tracking-widest">
                        {{ profil?.stat_1_lbl ?? 'Akreditasi BAN-SM' }}
                    </div>
                </div>
                <div class="text-center p-4 md:border-r border-slate-100 last:border-0">
                    <div class="text-3xl md:text-4xl font-extrabold text-blue-900 mb-1">
                        {{ profil?.stat_2_val ?? '100%' }}
                    </div>
                    <div class="text-xs font-black text-slate-500 uppercase tracking-widest">
                        {{ profil?.stat_2_lbl ?? 'Kurikulum Terintegrasi' }}
                    </div>
                </div>
                <div class="text-center p-4 border-r border-slate-100 last:border-0">
                    <div class="text-3xl md:text-4xl font-extrabold text-blue-900 mb-1">
                        {{ profil?.stat_3_val ?? '1:15' }}
                    </div>
                    <div class="text-xs font-black text-slate-500 uppercase tracking-widest">
                        {{ profil?.stat_3_lbl ?? 'Rasio Guru & Siswa' }}
                    </div>
                </div>
                <div class="text-center p-4 last:border-0">
                    <div class="text-3xl md:text-4xl font-extrabold text-blue-900 mb-1">
                        {{ profil?.stat_4_val ?? '10+' }}
                    </div>
                    <div class="text-xs font-black text-slate-500 uppercase tracking-widest">
                        {{ profil?.stat_4_lbl ?? 'Fasilitas Penunjang' }}
                    </div>
                </div>
            </div>
        </section>

        <!-- Visi & Misi Unit -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Left: Description and Visi -->
                    <div class="space-y-6">
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-sm font-bold rounded-full uppercase tracking-wider">Arah & Tujuan</span>
                        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight font-poppins">
                            Visi & Misi Pendidikan SMP Dharma Ksatria
                        </h2>
                        <div v-if="profil?.profil" class="prose prose-blue text-slate-700 leading-relaxed text-base text-justify whitespace-pre-line" v-html="profil.profil"></div>
                        <p v-else class="text-slate-700 leading-relaxed text-base text-justify">
                            SMP Dharma Ksatria berkomitmen mendidik siswa usia remaja dalam masa transisi kritis menuju kedewasaan, menanamkan pondasi karakter keagamaan yang kokoh sekaligus mengasah kepekaan nalar kritis ilmiah.
                        </p>
                        
                        <div class="p-6 bg-gradient-to-br from-blue-50/50 to-white border border-blue-100 rounded-3xl shadow-sm">
                            <h3 class="text-sm font-black text-blue-900 uppercase tracking-widest mb-3">Visi Unit</h3>
                            <div v-if="profil?.visi" class="prose prose-blue text-slate-805 leading-relaxed text-justify text-base md:text-lg font-bold italic" v-html="profil.visi"></div>
                            <p v-else class="text-slate-805 font-bold italic text-base md:text-lg leading-relaxed text-justify">
                                "Mewujudkan lulusan SMP yang unggul dalam Imtaq, terampil dalam teknologi dasar, berbudaya ilmiah, dan tangguh berakhlak mulia."
                            </p>
                        </div>
                    </div>

                    <!-- Right: Misi Cards -->
                    <div class="space-y-4">
                        <template v-if="profil?.misi">
                            <div class="p-6 bg-gradient-to-br from-blue-50/50 to-white border border-blue-100 rounded-3xl shadow-sm">
                                <h3 class="text-sm font-black text-blue-900 uppercase tracking-widest mb-3">Misi Unit</h3>
                                <div class="prose prose-blue text-slate-700 leading-relaxed text-sm text-justify list-decimal pl-2 prose-ol:list-decimal prose-ol:pl-5" v-html="profil.misi"></div>
                            </div>
                        </template>
                        <template v-else>
                            <div class="flex gap-4 p-5 bg-white border border-slate-100 rounded-2xl shadow-sm hover:border-blue-200 transition-all duration-300">
                                <div class="flex-shrink-0 w-10 h-10 bg-blue-600 text-white font-bold rounded-xl flex items-center justify-center shadow-md shadow-blue-200">1</div>
                                <div>
                                    <h4 class="font-bold text-slate-900 text-base mb-1">Pendidikan Karakter & Adab</h4>
                                    <p class="text-sm text-slate-700 leading-relaxed">Mengedepankan pembelajaran karakter berbasis nilai kepesantrenan dan pembiasaan adab Islami sehari-hari.</p>
                                </div>
                            </div>

                            <div class="flex gap-4 p-5 bg-white border border-slate-100 rounded-2xl shadow-sm hover:border-blue-200 transition-all duration-300">
                                <div class="flex-shrink-0 w-10 h-10 bg-blue-600 text-white font-bold rounded-xl flex items-center justify-center shadow-md shadow-blue-200">2</div>
                                <div>
                                    <h4 class="font-bold text-slate-900 text-base mb-1">Penguasaan Akademik & Literasi</h4>
                                    <p class="text-sm text-slate-700 leading-relaxed">Menyelenggarakan pembelajaran Kurikulum Merdeka yang menantang akal budi dan mengasah literasi-numerasi dasar.</p>
                                </div>
                            </div>

                            <div class="flex gap-4 p-5 bg-white border border-slate-100 rounded-2xl shadow-sm hover:border-blue-200 transition-all duration-300">
                                <div class="flex-shrink-0 w-10 h-10 bg-blue-600 text-white font-bold rounded-xl flex items-center justify-center shadow-md shadow-blue-200">3</div>
                                <div>
                                    <h4 class="font-bold text-slate-900 text-base mb-1">Teknologi & Keterampilan Praktis</h4>
                                    <p class="text-sm text-slate-700 leading-relaxed">Membekali murid dengan keterampilan komputer dasar, logika pemrograman sederhana (coding), dan bahasa asing.</p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </section>

        <!-- Program Unggulan Unit -->
        <section class="py-20 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-sm font-bold rounded-full uppercase tracking-wider mb-3">Keunggulan Kami</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        Program Khusus SMP Dharma Ksatria
                    </h2>
                    <p class="text-slate-650 text-sm font-semibold max-w-xl mx-auto mt-2">
                        Program khas terintegrasi yang disiapkan khusus untuk akselerasi kecerdasan intelektual dan spiritual santri.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Prog 1 -->
                    <div class="bg-white border border-slate-100 p-6 rounded-3xl shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h3 class="text-base font-bold text-slate-900 mb-2">Tahfidz & Tahsin Intensif</h3>
                            <p class="text-sm text-slate-700 leading-relaxed">Penyelarasan bacaan tajwid yang fasih disertai target hafalan Juz 30 dan surat-surat pilihan yang diuji periodik.</p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-50 text-xs font-bold text-blue-700">Target: Hafal & Fasih Juz 30</div>
                    </div>

                    <!-- Prog 2 -->
                    <div class="bg-white border border-slate-100 p-6 rounded-3xl shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-base font-bold text-slate-900 mb-2">IT & Kelas Coding Dasar</h3>
                            <p class="text-sm text-slate-700 leading-relaxed">Pengenalan dasar logika komputer, pemrograman blok, web statis dasar, dan pengoperasian software perkantoran.</p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-50 text-xs font-bold text-blue-700">Keterampilan: Digital Literacy</div>
                    </div>

                    <!-- Prog 3 -->
                    <div class="bg-white border border-slate-100 p-6 rounded-3xl shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 11.37 7.362 16.5 3 19" />
                                </svg>
                            </div>
                            <h3 class="text-base font-bold text-slate-900 mb-2">Bilingual Day</h3>
                            <p class="text-sm text-slate-700 leading-relaxed">Pembiasaan percakapan harian menggunakan Bahasa Arab dan Bahasa Inggris sederhana untuk melatih kepercayaan diri.</p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-50 text-xs font-bold text-blue-700">Lingkungan: Aktif Berbahasa</div>
                    </div>

                    <!-- Prog 4 -->
                    <div class="bg-white border border-slate-100 p-6 rounded-3xl shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-base font-bold text-slate-900 mb-2">Kemandirian & Kewirausahaan</h3>
                            <p class="text-sm text-slate-700 leading-relaxed">Melalui proyek kolaboratif, santri diajarkan manajemen diri, kerapihan asrama, dan dasar kewirausahaan santri (Kopsis).</p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-50 text-xs font-bold text-blue-700">Karakter: Mandiri & Kolaboratif</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kurikulum & Ekstrakurikuler -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row gap-12 items-start">
                    <!-- Left: Kurikulum -->
                    <div class="w-full lg:w-1/2 space-y-6">
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-sm font-bold rounded-full uppercase tracking-wider">Metode Pembelajaran</span>
                        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">Kurikulum Terintegrasi</h2>
                        <p class="text-slate-700 leading-relaxed text-base">
                            Kurikulum kami didesain khusus agar siswa tidak terbebani secara berlebihan, melainkan terangsang untuk aktif belajar melalui keterpaduan dua pilar kurikulum:
                        </p>
                        
                        <div class="space-y-4">
                            <div class="p-6 bg-slate-50 border border-slate-100 rounded-2xl">
                                <h4 class="font-bold text-base text-slate-900 mb-2 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                    Kurikulum Nasional (Kementerian Pendidikan)
                                </h4>
                                <p class="text-sm text-slate-650 leading-relaxed">Fokus pada sains dasar, matematika terapan, ilmu sosial, bahasa Indonesia, dan pendidikan pancasila dengan pendekatan Kurikulum Merdeka yang interaktif.</p>
                            </div>
                            <div class="p-6 bg-slate-50 border border-slate-100 rounded-2xl">
                                <h4 class="font-bold text-base text-slate-900 mb-2 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                                    Kurikulum Diniyah Pesantren
                                    <span class="text-xs bg-blue-100 text-blue-700 font-bold px-2 py-0.5 rounded">Khas</span>
                                </h4>
                                <p class="text-sm text-slate-650 leading-relaxed">Mempelajari fiqih ibadah (Safinah), akhlak dasar (Taisirul Kholaq), nahwu-shorof praktis, hafalan doa-doa harian, dan kajian hadits Arbain Nawawi.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Ekstrakurikuler -->
                    <div class="w-full lg:w-1/2 space-y-6 lg:pl-6">
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-sm font-bold rounded-full uppercase tracking-wider">Kreativitas & Bakat</span>
                        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">Ekstrakurikuler Unggulan</h2>
                        <p class="text-slate-700 leading-relaxed text-base">
                            Untuk menyalurkan minat, bakat, kreativitas, dan kesehatan fisik siswa, kami memfasilitasi berbagai macam kegiatan ekskul yang menyenangkan:
                        </p>

                        <div class="grid grid-cols-2 gap-4">
                            <template v-if="ekstrakurikuler && ekstrakurikuler.length > 0">
                                <div 
                                    v-for="item in ekstrakurikuler" 
                                    :key="item.id"
                                    class="p-5 border border-slate-100 rounded-2xl hover:bg-slate-50/50 transition-colors"
                                >
                                    <div class="font-bold text-sm md:text-base text-slate-900 mb-1">{{ item.nama }}</div>
                                    <p class="text-xs md:text-sm text-slate-600 leading-relaxed">{{ item.deskripsi }}</p>
                                </div>
                            </template>
                            <template v-else>
                                <div class="p-5 border border-slate-100 rounded-2xl hover:bg-slate-50/50 transition-colors">
                                    <div class="font-bold text-sm md:text-base text-slate-900 mb-1">Pramuka & Pasukan Khusus</div>
                                    <p class="text-xs md:text-sm text-slate-600">Melatih kepemimpinan, kepanduan, kedisiplinan, kemandirian fisik mental.</p>
                                </div>
                                <div class="p-5 border border-slate-100 rounded-2xl hover:bg-slate-50/50 transition-colors">
                                    <div class="font-bold text-sm md:text-base text-slate-900 mb-1">Hadroh & Seni Kaligrafi</div>
                                    <p class="text-xs md:text-sm text-slate-600">Mewadahi kecintaan santri pada seni musik religi islami dan tulisan kaligrafi.</p>
                                </div>
                                <div class="p-5 border border-slate-100 rounded-2xl hover:bg-slate-50/50 transition-colors">
                                    <div class="font-bold text-sm md:text-base text-slate-900 mb-1">Klub Olahraga (Futsal & Bulutangkis)</div>
                                    <p class="text-xs md:text-sm text-slate-600">Menjaga kebugaran jasmani serta mengasah jiwa sportifitas kompetitif.</p>
                                </div>
                                <div class="p-5 border border-slate-100 rounded-2xl hover:bg-slate-50/50 transition-colors">
                                    <div class="font-bold text-sm md:text-base text-slate-900 mb-1">English & Arabic Club</div>
                                    <p class="text-xs md:text-sm text-slate-600">Klub asah ketrampilan debat, pidato, dan percakapan bahasa asing.</p>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Fasilitas Sekolah Section -->
        <section v-if="fasilitas && fasilitas.length > 0" class="py-20 bg-slate-50 border-t border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-sm font-bold rounded-full uppercase tracking-wider mb-3">Sarana Pembelajaran</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        Fasilitas Sekolah Kami
                    </h2>
                    <p class="text-slate-600 text-sm font-semibold max-w-xl mx-auto mt-2">
                        Fasilitas penunjang akademik dan non-akademik yang lengkap dan nyaman untuk mendukung kegiatan belajar mengajar di SMP Dharma Ksatria.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div 
                        v-for="item in fasilitas" 
                        :key="item.id"
                        class="bg-white rounded-3xl overflow-hidden border border-slate-100 hover:shadow-xl transition-all duration-300 flex flex-col group"
                    >
                        <!-- Cover Image -->
                        <div class="h-52 w-full bg-slate-100 relative overflow-hidden">
                            <img v-if="item.gambar" :src="`/storage/${item.gambar}`" :alt="item.nama" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                            <div v-else class="w-full h-full bg-blue-50/50 flex items-center justify-center">
                                <svg class="w-16 h-16 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" :d="getIkonPath(item.ikon)" />
                                </svg>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="bg-blue-50 text-blue-600 p-2.5 rounded-2xl">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" :d="getIkonPath(item.ikon)" />
                                        </svg>
                                    </div>
                                    <h3 class="font-bold text-slate-900 text-lg group-hover:text-blue-600 transition-colors">{{ item.nama }}</h3>
                                </div>
                                <p v-if="item.deskripsi" class="text-sm text-slate-600 leading-relaxed">{{ item.deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Alur Pendaftaran Section -->
        <section class="py-20 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-sm font-bold rounded-full uppercase tracking-wider mb-3">Informasi SPMB</span>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">Alur Pendaftaran SMP</h2>
                <p class="text-slate-650 text-sm font-semibold max-w-xl mx-auto mt-2 mb-16">
                    Sistem pendaftaran terintegrasi secara online untuk memudahkan proses admisi santri baru.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-left">
                    <!-- Step 1 -->
                    <div class="bg-white border border-slate-100 p-6 rounded-3xl relative shadow-sm hover:scale-102 transition-transform duration-300">
                        <div class="absolute -top-5 left-6 w-10 h-10 bg-blue-600 text-white font-black rounded-2xl flex items-center justify-center shadow-lg shadow-blue-200">01</div>
                        <h4 class="font-bold text-slate-900 text-base mt-2 mb-2">Pendaftaran Online</h4>
                        <p class="text-sm text-slate-700 leading-relaxed">Membuat akun pendaftaran di portal SPMB online dan mengisi biodata serta tingkat pendaftaran (SMP).</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="bg-white border border-slate-100 p-6 rounded-3xl relative shadow-sm hover:scale-102 transition-transform duration-300">
                        <div class="absolute -top-5 left-6 w-10 h-10 bg-blue-600 text-white font-black rounded-2xl flex items-center justify-center shadow-lg shadow-blue-200">02</div>
                        <h4 class="font-bold text-slate-900 text-base mt-2 mb-2">Unggah Dokumen</h4>
                        <p class="text-sm text-slate-700 leading-relaxed">Melengkapi berkas digital seperti Akta Kelahiran, Kartu Keluarga, dan pas foto melalui dashboard portal.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="bg-white border border-slate-100 p-6 rounded-3xl relative shadow-sm hover:scale-102 transition-transform duration-300">
                        <div class="absolute -top-5 left-6 w-10 h-10 bg-blue-600 text-white font-black rounded-2xl flex items-center justify-center shadow-lg shadow-blue-200">03</div>
                        <h4 class="font-bold text-slate-900 text-base mt-2 mb-2">Ujian Seleksi</h4>
                        <p class="text-sm text-slate-700 leading-relaxed">Mengikuti ujian seleksi yang meliputi tes akademik dasar, tes membaca Al-Qur'an, dan wawancara kepribadian.</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="bg-white border border-slate-100 p-6 rounded-3xl relative shadow-sm hover:scale-102 transition-transform duration-300">
                        <div class="absolute -top-5 left-6 w-10 h-10 bg-emerald-600 text-white font-black rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-200">04</div>
                        <h4 class="font-bold text-slate-900 text-base mt-2 mb-2">Pengumuman & Daftar Ulang</h4>
                        <p class="text-sm text-slate-700 leading-relaxed">Hasil seleksi diumumkan via WhatsApp & portal. Calon santri yang dinyatakan lolos melakukan konfirmasi daftar ulang.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Jadwal & Persyaratan (Side-by-side) -->
        <section class="py-20 bg-white border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                    <!-- Left: Jadwal Pendaftaran (7 cols) -->
                    <div class="lg:col-span-7 space-y-6">
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-sm font-bold rounded-full uppercase tracking-wider">Agenda SPMB</span>
                        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">Jadwal & Gelombang Pendaftaran</h2>
                        <p class="text-slate-650 text-sm font-medium">Timeline gelombang seleksi penerimaan santri baru SMP Dharma Ksatria:</p>

                        <div v-if="agendas.length === 0" class="p-6 bg-slate-50 border border-slate-100 rounded-3xl text-center text-slate-550 text-sm font-medium">
                            Belum ada jadwal gelombang pendaftaran yang dirilis di portal admin.
                        </div>
                        <div v-else class="relative pl-6 border-l-2 border-blue-100 space-y-8">
                            <div 
                                v-for="event in agendas" 
                                :key="event.id"
                                class="relative"
                            >
                                <!-- Dot indicator on timeline -->
                                <div 
                                    class="absolute -left-[31px] top-1.5 w-4 h-4 rounded-full border-4 border-white"
                                    :class="checkAgendaStatus(event) === 'buka' ? 'bg-blue-600 ring-4 ring-blue-100' : 'bg-slate-300'"
                                ></div>
                                <div 
                                    class="bg-slate-50 p-5 rounded-2xl border transition-all"
                                    :class="checkAgendaStatus(event) === 'buka' ? 'border-blue-200 shadow-sm bg-blue-50/10' : 'border-slate-100'"
                                >
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-bold text-sm md:text-base text-slate-900">{{ event.judul }}</h4>
                                        <span 
                                            v-if="checkAgendaStatus(event) === 'buka'"
                                            class="text-xs bg-sky-100 text-sky-750 font-black px-2 py-0.5 rounded-full uppercase tracking-wide"
                                        >
                                            Dibuka
                                        </span>
                                        <span 
                                            v-else
                                            class="text-xs bg-slate-200 text-slate-600 font-black px-2 py-0.5 rounded-full uppercase tracking-wide"
                                        >
                                            Tutup
                                        </span>
                                    </div>
                                    <p class="text-xs md:text-sm text-slate-700 mb-2">
                                        Pendaftaran: {{ formatDateString(event.tgl_mulai, event.tgl_selesai) }}
                                        <span v-if="formatTimeRange(event)" class="text-slate-500 font-normal"> | {{ formatTimeRange(event) }}</span>
                                    </p>
                                    <p v-if="event.deskripsi" class="text-xs md:text-sm text-slate-550 leading-relaxed mt-2 whitespace-pre-line">{{ event.deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Persyaratan Dokumen (5 cols) -->
                    <div class="lg:col-span-5 space-y-6">
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-sm font-bold rounded-full uppercase tracking-wider">Persyaratan</span>
                        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">Dokumen Pendaftaran</h2>
                        <p class="text-slate-650 text-sm font-medium">Berkas administrasi yang wajib disiapkan untuk verifikasi fisik saat daftar ulang:</p>

                        <div class="p-6 bg-gradient-to-br from-blue-900 to-slate-950 text-white rounded-3xl space-y-4 shadow-xl shadow-blue-950/20 border border-blue-800/40">
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-sky-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <p class="text-sm text-blue-100">Formulir Pendaftaran yang sudah diisi - <span class="font-bold text-white">1 Rangkap</span></p>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-sky-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <p class="text-sm text-blue-100">Fotokopi Rapor semester terakhir SD/MI dilegalisir + Lembar Data Siswa - <span class="font-bold text-white">1 Rangkap</span></p>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-sky-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <p class="text-sm text-blue-100">Fotokopi Ijazah SD/MI atau SKHU dilegalisir - <span class="font-bold text-white">3 Lembar</span></p>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-sky-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <p class="text-sm text-blue-100">Fotokopi Akta Kelahiran & Kartu Keluarga (KK) masih berlaku - <span class="font-bold text-white">Masing-masing 3 Lembar</span></p>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-sky-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <p class="text-sm text-blue-100">Fotokopi KTP Kedua Orang Tua (Ayah & Ibu) diperbesar 200% - <span class="font-bold text-white">Masing-masing 3 Lembar</span></p>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-sky-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <p class="text-sm text-blue-100">Pas Foto Berwarna latar belakang merah berseragam SD/MI - <span class="font-bold text-white">Ukuran 2x3 (3 Lembar) & 3x4 (3 Lembar)</span></p>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-sky-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <p class="text-sm text-blue-100">Fotokopi Kartu KKS / PKH / KPS / KIP / KIS / BPJS & NISN (jika ada) - <span class="font-bold text-white">Masing-masing 3 Lembar</span></p>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-sky-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <p class="text-sm text-blue-100">Surat Keterangan Sehat dari Puskesmas/Dokter</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-sky-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <p class="text-sm text-blue-100">Surat Keterangan Kelakuan Baik (SKKB) dari Kepala Sekolah asal - <span class="font-bold text-white">1 Lembar</span></p>
                            </div>
                            <div class="flex items-start gap-3 pt-2 border-t border-blue-800/40">
                                <svg class="w-4 h-4 text-sky-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <div class="text-xs text-sky-200 space-y-1">
                                    <p>Catatan: Semua berkas dimasukkan ke dalam <span class="font-bold text-white">Map Snelhecker Berwarna Biru (SMP)</span> dan diberi nama calon siswa.</p>
                                    <p class="font-bold text-white">• Harap membawa seluruh dokumen fisik asli/fotokopi yang telah diunggah di portal pada saat verifikasi fisik/daftar ulang.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Rincian Biaya Pendidikan -->
        <section class="py-20 bg-slate-50 border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-sm font-bold rounded-full uppercase tracking-wider mb-3">Transparansi</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        Estimasi Biaya Pendidikan SMP
                    </h2>
                    <p class="text-slate-655 text-sm font-semibold max-w-xl mx-auto mt-2">
                        Komitmen kami memberikan rincian biaya yang transparan dan bersahabat untuk kelancaran kegiatan belajar santri.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Biaya Sekali Bayar -->
                    <div class="bg-white border border-slate-100 p-8 rounded-3xl shadow-sm flex flex-col justify-between">
                        <div>
                            <span class="inline-block px-2.5 py-0.5 bg-blue-50 text-blue-700 text-xs font-black rounded uppercase tracking-wider mb-4">Investasi Awal</span>
                            <h4 class="text-lg font-black text-slate-900 mb-2">Uang Pangkal / Pembangunan</h4>
                            <p class="text-sm text-slate-600 leading-relaxed mb-6">Dialokasikan untuk pengembangan fasilitas gedung, pemeliharaan sarana asrama, dan operasional awal.</p>
                            <div class="text-3xl font-extrabold text-blue-900">Rp 3.500.000</div>
                        </div>
                        <div class="mt-6 pt-4 border-t border-slate-50 text-xs font-bold text-slate-450 uppercase">Dibayar 1x selama masa pendidikan</div>
                    </div>

                    <!-- Biaya Tahunan & Perlengkapan -->
                    <div class="bg-white border border-slate-100 p-8 rounded-3xl shadow-sm flex flex-col justify-between">
                        <div>
                            <span class="inline-block px-2.5 py-0.5 bg-blue-50 text-blue-700 text-xs font-black rounded uppercase tracking-wider mb-4">Perlengkapan</span>
                            <h4 class="text-lg font-black text-slate-900 mb-2">Seragam & Buku Paket</h4>
                            <p class="text-sm text-slate-600 leading-relaxed mb-6">Meliputi 5 stel seragam sekolah/pesantren lengkap beserta kelengkapan buku pelajaran/kitab kuning setahun.</p>
                            <div class="space-y-1">
                                <div class="text-3xl font-extrabold text-blue-900">Rp 1.550.000</div>
                                <div class="text-xs text-slate-600 font-semibold">• Seragam: Rp 950.000 (1x bayar) | • Kitab: Rp 600.000 (per tahun)</div>
                            </div>
                        </div>
                        <div class="mt-6 pt-4 border-t border-slate-50 text-xs font-bold text-slate-450 uppercase">Paket Seragam & Kitab Lengkap</div>
                    </div>

                    <!-- SPP Bulanan (Makan, Asrama, dll) -->
                    <div class="bg-gradient-to-br from-blue-900 to-slate-950 text-white p-8 rounded-3xl shadow-xl flex flex-col justify-between border border-blue-800">
                        <div>
                            <span class="inline-block px-2.5 py-0.5 bg-sky-400 text-blue-950 text-xs font-black rounded uppercase tracking-wider mb-4">Bulanan (All-In)</span>
                            <h4 class="text-lg font-black text-white mb-2">Iuran Syahriyah / SPP</h4>
                            <p class="text-sm text-blue-100 leading-relaxed mb-6">Biaya bulanan mencakup makan 3x sehari, sewa asrama, bimbingan ustadz/ustadzah 24 jam, listrik, air, dan kesehatan dasar.</p>
                            <div class="text-3xl font-extrabold text-sky-400">Rp 750.000 <span class="text-xs text-blue-200 font-normal">/ bulan</span></div>
                        </div>
                        <div class="mt-6 pt-4 border-t border-blue-800 text-xs font-bold text-blue-300 uppercase">Makan 3x sehari + Asrama</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tanya Jawab (FAQ Accordion) -->
        <section class="py-20 bg-white border-t border-slate-100">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-sm font-bold rounded-full uppercase tracking-wider mb-3">Tanya Jawab</span>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">FAQ Calon Orang Tua</h2>
                    <p class="text-slate-650 text-sm font-semibold mt-2">
                        Jawaban praktis untuk berbagai pertanyaan umum seputar kehidupan di asrama SMP Dharma Ksatria.
                    </p>
                </div>

                <div class="space-y-4">
                    <div v-for="(faq, idx) in faqs" :key="idx" class="border border-slate-100 rounded-2xl overflow-hidden transition-all">
                        <button 
                            @click="toggleFaq(idx)"
                            class="w-full flex justify-between items-center p-6 text-left font-bold text-base text-slate-900 bg-slate-50/50 hover:bg-slate-50 transition-colors"
                        >
                            <span>{{ faq.q }}</span>
                            <svg 
                                class="w-4 h-4 text-slate-400 transform transition-transform duration-300"
                                :class="{'rotate-180': activeFaq === idx}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div 
                            v-show="activeFaq === idx"
                            class="p-6 bg-slate-50/20 border-t border-slate-100 text-sm text-slate-800 font-medium leading-relaxed transition-all"
                        >
                            {{ faq.a }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Blue Call to Action Section -->
        <section class="py-20 relative bg-gradient-to-br from-blue-950 to-slate-950 overflow-hidden text-center">
            <!-- Decorative Glow Elements -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-500/5 rounded-full blur-3xl -z-0"></div>
            
            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
                <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4 uppercase tracking-tight">
                    Mulai Masa Depan Gemilang di SMP Dharma Ksatria
                </h2>
                <p class="text-blue-100 text-sm md:text-base mb-10 max-w-2xl mx-auto leading-relaxed">
                    Kuota pendaftaran santri baru terbatas untuk menjaga rasio ideal dan kualitas kegiatan belajar mengajar. Amankan kursi pendaftaran putra-putri Anda segera.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a 
                        :href="ppdbUrl"
                        class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white font-bold text-xs uppercase tracking-widest rounded-xl hover:bg-blue-500 transition-all duration-300 shadow-lg shadow-blue-900/30 border border-blue-500"
                    >
                        Mulai Registrasi SPMB
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
import { ref, computed } from 'vue';
import { Link, Head } from '@inertiajs/vue3';

const props = defineProps({
    agendas: {
        type: Array,
        default: () => []
    },
    ekstrakurikuler: {
        type: Array,
        default: () => []
    },
    profil: {
        type: Object,
        default: () => null
    },
    fasilitas: {
        type: Array,
        default: () => []
    }
});

const getIkonPath = (key) => {
    const paths = {
        masjid:       'M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z',
        asrama:       'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25',
        kelas:        'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25',
        perpustakaan: 'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25',
        komputer:     'M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25',
        olahraga:     'M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.25 9.71 2 12 2c2.291 0 4.545.25 6.75.721v1.515m0 0a48.667 48.667 0 00-1.5 1.185M18.75 4.236c.982.143 1.954.317 2.916.52a6.003 6.003 0 01-5.395 5.492m0 0H12',
        kantin:       'M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z',
        klinik:       'M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 110s9-4.78 9-12z',
        lainnya:      'M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21',
    };
    return paths[key] ?? paths.lainnya;
};

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

const combineDateTime = (dateStr, timeStr, defaultTime = '00:00:00') => {
    if (!dateStr) return null;
    const match = dateStr.match(/^(\d{4})-(\d{2})-(\d{2})/);
    if (!match) return null;
    const year = parseInt(match[1], 10);
    const month = parseInt(match[2], 10) - 1; // 0-indexed month
    const day = parseInt(match[3], 10);
    
    let hours = 0;
    let minutes = 0;
    let seconds = 0;
    
    const timeToUse = timeStr || defaultTime;
    const timeMatch = timeToUse.match(/^(\d{2}):(\d{2})(?::(\d{2}))?/);
    if (timeMatch) {
        hours = parseInt(timeMatch[1], 10);
        minutes = parseInt(timeMatch[2], 10);
        if (timeMatch[3]) {
            seconds = parseInt(timeMatch[3], 10);
        }
    }
    
    return new Date(year, month, day, hours, minutes, seconds);
};

const checkAgendaStatus = (event) => {
    const start = combineDateTime(event.tgl_mulai, event.jam_mulai, '00:00:00');
    if (!start) return 'tutup';
    
    let end = null;
    if (event.tgl_selesai) {
        end = combineDateTime(event.tgl_selesai, event.jam_selesai, '23:59:59');
    } else {
        end = combineDateTime(event.tgl_mulai, event.jam_selesai, '23:59:59');
    }
    
    const now = new Date();
    if (now >= start && now <= end) {
        return 'buka';
    }
    return 'tutup';
};

const formatDateString = (startStr, endStr) => {
    const start = parseDateLocal(startStr);
    if (!start) return '';
    const startFormatted = start.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
    
    if (endStr) {
        const end = parseDateLocal(endStr);
        if (end && start.getTime() !== end.getTime()) {
            const endFormatted = end.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
            return `${startFormatted} - ${endFormatted}`;
        }
    }
    return startFormatted;
};

const formatTime = (timeString) => {
    if (!timeString) return '';
    const parts = timeString.split(':');
    if (parts.length >= 2) {
        return `${parts[0]}:${parts[1]}`;
    }
    return timeString;
};

const formatTimeRange = (event) => {
    if (!event.jam_mulai) return '';
    const start = formatTime(event.jam_mulai);
    if (event.jam_selesai) {
        const end = formatTime(event.jam_selesai);
        return `Pukul ${start} - ${end} WIB`;
    }
    return `Mulai Pukul ${start} WIB`;
};

const activeFaq = ref(null);

const toggleFaq = (index) => {
    if (activeFaq.value === index) {
        activeFaq.value = null;
    } else {
        activeFaq.value = index;
    }
};

const faqs = [
    {
        q: 'Apakah santri SMP wajib tinggal di asrama (mukim)?',
        a: 'Ya, seluruh santri SMP wajib tinggal di asrama (mukim) untuk mengikuti seluruh program kepesantrenan terpadu selama 24 jam.'
    },
    {
        q: 'Apakah santri diperbolehkan membawa HP/Gadget pribadi?',
        a: 'Tidak, santri SMP tidak diperkenankan membawa HP/Gadget pribadi. Fasilitas komunikasi terstruktur dengan orang tua disediakan secara berkala melalui layanan telepon kantor asrama.'
    },
    {
        q: 'Bagaimana dengan jadwal kunjungan (sambang) orang tua?',
        a: 'Kunjungan atau sambang santri oleh orang tua dijadwalkan sebulan sekali pada hari Ahad pekan ke-3.'
    },
    {
        q: 'Bagaimana jika santri mengalami sakit di asrama?',
        a: 'Pesantren dilengkapi Pos Kesehatan Pesantren (Poskestren) dengan petugas medis yang siaga. Jika memerlukan pemeriksaan mendalam, santri akan dirujuk ke Klinik/Puskesmas terdekat, dan wali santri akan segera dihubungi oleh pihak asrama.'
    }
];

const ppdbUrl = computed(() => {
    // In local development with IP or localhost, use local port 8001 with tingkat parameter
    if (window.location.hostname.startsWith('192.168.') || window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
        return `http://${window.location.hostname}:8001/register?tingkat=smp`;
    }
    // Default to production URL
    return 'https://ppdb.riyadussalikin.ponpes.id/register?tingkat=smp';
});
</script>

<style scoped>
.bg-dot-pattern {
    background-image: radial-gradient(rgba(255, 255, 255, 0.15) 1px, transparent 1px);
    background-size: 20px 20px;
}
</style>
