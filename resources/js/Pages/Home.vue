<template>
    <Head title="Beranda" />
    <MainLayout>
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-emerald-50 via-white to-emerald-50/30 overflow-hidden">
            <div class="absolute inset-0 bg-dot-pattern opacity-40"></div>
            
            <!-- Registration Period Banner -->
            <div v-if="spmbSetting && spmbSetting.is_active" 
                 :class="spmbSetting.is_open ? 'bg-emerald-600' : 'bg-amber-500'" 
                 class="text-white py-3 relative z-20 transition-colors duration-500">
                <div class="container mx-auto px-4 text-center relative">
                    <!-- Case 1: Registration is Open (Counting down to closing) -->
                    <p v-if="spmbSetting.is_open" class="text-sm md:text-base font-bold flex flex-wrap items-center justify-center gap-2">
                        <span class="inline-block w-2 h-2 bg-white rounded-full animate-pulse"></span>
                        Pendaftaran Santri Baru Tahun Ajaran {{ spmbSetting.tahun_ajaran }} Dibuka!
                        <span class="hidden md:inline-block mx-2 text-emerald-300">|</span>
                        <span class="flex items-center gap-2">
                            <span class="text-xs md:text-sm font-normal text-emerald-100 uppercase tracking-tighter">Berakhir dalam:</span>
                            <span class="font-mono bg-black/20 px-3 py-1 rounded text-xs md:text-sm shadow-inner border border-white/10">
                                {{ countdown }}
                            </span>
                        </span>
                    </p>
                    
                    <!-- Case 2: Registration not yet open (Counting down to opening) -->
                    <p v-else-if="!spmbSetting.is_open && isFutureOpen" class="text-sm md:text-base font-bold flex flex-wrap items-center justify-center gap-2">
                        <svg class="w-5 h-5 text-amber-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Pendaftaran Tahun Ajaran {{ spmbSetting.tahun_ajaran }} Segera Dibuka
                        <span class="hidden md:inline-block mx-2 text-amber-200">|</span>
                        <span class="flex items-center gap-2">
                            <span class="text-xs md:text-sm font-normal text-amber-100 uppercase tracking-tighter">Dibuka dalam:</span>
                            <span class="font-mono bg-black/20 px-3 py-1 rounded text-xs md:text-sm shadow-inner border border-white/10">
                                {{ countdown }}
                            </span>
                        </span>
                    </p>

                    <!-- Case 3: Registration Closed (Already passed closing date) -->
                    <p v-else class="text-sm md:text-base font-bold flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 text-amber-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Pendaftaran Tahun Ajaran {{ spmbSetting.tahun_ajaran }} Sudah Ditutup
                    </p>
                </div>
            </div>

            <div class="container mx-auto px-4 pt-24 pb-12 relative z-10">
                <div class="text-center">
                    <div class="mb-6">
                        <img src="/Logo Riyad.png" alt="Logo Riyadussalikin" class="h-24 w-24 mx-auto mb-4" />
                    </div>
                    <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-6 leading-tight tracking-tight">
                        Pondok Pesantren <span class="text-gradient">Riyadussalikin</span>
                    </h1>
                    <p class="text-xl md:text-2xl font-arabic text-emerald-700 mb-4">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                    <p class="text-lg md:text-xl text-gray-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                        Membentuk Generasi Qur'ani yang Berakhlak Mulia, Berilmu, dan Mandiri
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <a 
                                :href="spmbUrl" 
                                class="btn-primary w-full sm:w-auto text-center"
                            >
                                Daftar Sekarang
                            </a>
                        <Link 
                            :href="route('kontak')" 
                            class="btn-secondary w-full sm:w-auto text-center"
                        >
                            Hubungi Kami
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Stats Counter Section -->
            <div class="container mx-auto px-4 pb-16 relative z-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 max-w-6xl mx-auto">
                    <div class="bg-white p-6 md:p-8 rounded-3xl shadow-xl shadow-emerald-900/5 border border-emerald-50 text-center transform hover:scale-105 transition-all duration-300 flex flex-col justify-center min-h-[160px]">
                        <div class="text-3xl md:text-4xl font-black text-emerald-600 mb-2">{{ stats.santri_aktif }}+</div>
                        <div class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-[0.2em] leading-relaxed">Santri Aktif</div>
                    </div>
                    <div class="bg-white p-6 md:p-8 rounded-3xl shadow-xl shadow-emerald-900/5 border border-emerald-50 text-center transform hover:scale-105 transition-all duration-300 flex flex-col justify-center min-h-[160px]">
                        <div class="text-3xl md:text-4xl font-black text-emerald-600 mb-2">{{ stats.ekstrakurikuler }}+</div>
                        <div class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-[0.2em] leading-relaxed">Ekstrakurikuler</div>
                    </div>
                    <div class="bg-white p-6 md:p-8 rounded-3xl shadow-xl shadow-emerald-900/5 border border-emerald-50 text-center transform hover:scale-105 transition-all duration-300 flex flex-col justify-center min-h-[160px]">
                        <div class="text-3xl md:text-4xl font-black text-emerald-600 mb-1 leading-tight">Akreditasi <span class="text-emerald-500">{{ stats.akreditasi }}</span></div>
                        <div class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-[0.2em] leading-relaxed">Kualitas Terjamin</div>
                    </div>
                    <div class="bg-white p-6 md:p-8 rounded-3xl shadow-xl shadow-emerald-900/5 border border-emerald-50 text-center transform hover:scale-105 transition-all duration-300 flex flex-col justify-center min-h-[160px]">
                        <div class="text-3xl md:text-4xl font-black text-emerald-600 mb-2">{{ stats.kelulusan }}</div>
                        <div class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-[0.2em] leading-relaxed">Lulus Tepat Waktu</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Alur Pendaftaran Section -->
        <section class="py-24 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-20">
                    <span class="text-emerald-600 font-bold uppercase tracking-widest text-sm mb-3 block">Prosedur Penerimaan</span>
                    <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-6">Alur Pendaftaran Santri Baru</h2>
                    <div class="w-24 h-1.5 bg-emerald-500 mx-auto rounded-full"></div>
                </div>

                <div class="relative">
                    <!-- Progress Line (Desktop) -->
                    <div class="hidden md:block absolute top-1/2 left-0 w-full h-1 bg-emerald-50 -translate-y-1/2"></div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                        <!-- Step 1 -->
                        <div class="relative group">
                            <div class="bg-white rounded-full w-20 h-20 flex items-center justify-center border-4 border-emerald-500 mx-auto mb-8 relative z-20 group-hover:bg-emerald-500 transition-all duration-300 shadow-xl shadow-emerald-500/20">
                                <span class="text-2xl font-black text-emerald-600 group-hover:text-white">01</span>
                            </div>
                            <div class="text-center">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Daftar Akun</h3>
                                <p class="text-gray-500 text-sm leading-relaxed px-4">Buat akun calon santri di portal SPMB untuk memulai proses pendaftaran awal.</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative group">
                            <div class="bg-white rounded-full w-20 h-20 flex items-center justify-center border-4 border-emerald-500 mx-auto mb-8 relative z-20 group-hover:bg-emerald-500 transition-all duration-300 shadow-xl shadow-emerald-500/20">
                                <span class="text-2xl font-black text-emerald-600 group-hover:text-white">02</span>
                            </div>
                            <div class="text-center">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Lengkapi Berkas</h3>
                                <p class="text-gray-500 text-sm leading-relaxed px-4">Unggah dokumen persyaratan digital (Ijazah, KK, Akte) melalui dashboard pendaftaran.</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative group">
                            <div class="bg-white rounded-full w-20 h-20 flex items-center justify-center border-4 border-emerald-500 mx-auto mb-8 relative z-20 group-hover:bg-emerald-500 transition-all duration-300 shadow-xl shadow-emerald-500/20">
                                <span class="text-2xl font-black text-emerald-600 group-hover:text-white">03</span>
                            </div>
                            <div class="text-center">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Tes Seleksi</h3>
                                <p class="text-gray-500 text-sm leading-relaxed px-4">Ikuti rangkaian tes seleksi (akademik & wawancara) sesuai jadwal yang ditentukan.</p>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="relative group">
                            <div class="bg-white rounded-full w-20 h-20 flex items-center justify-center border-4 border-emerald-500 mx-auto mb-8 relative z-20 group-hover:bg-emerald-500 transition-all duration-300 shadow-xl shadow-emerald-500/20">
                                <span class="text-2xl font-black text-emerald-600 group-hover:text-white">04</span>
                            </div>
                            <div class="text-center">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Pengumuman</h3>
                                <p class="text-gray-500 text-sm leading-relaxed px-4">Hasil kelulusan akan diumumkan secara real-time melalui dashboard pendaftaran.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="section-title">Tentang Kami</h2>
                    <div v-if="visiMisi" class="section-subtitle max-w-3xl mx-auto prose prose-emerald" v-html="visiMisi.visi"></div>
                    <p v-else class="section-subtitle max-w-3xl mx-auto">
                        Pondok Pesantren Riyadussalikin Padaherang adalah lembaga pendidikan Islam yang berkomitmen untuk mencetak generasi yang beriman, berilmu, dan berakhlak mulia.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Keunggulan 1 -->
                    <div class="card text-center group hover:border-emerald-500 border-2 border-transparent">
                        <div class="bg-emerald-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-600 transition-colors">
                            <svg class="w-8 h-8 text-emerald-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Pendidikan Berkualitas</h3>
                        <p class="text-gray-600">
                            Kurikulum terpadu yang menggabungkan pendidikan agama dan umum dengan metode pembelajaran modern.
                        </p>
                    </div>

                    <!-- Keunggulan 2 -->
                    <div class="card text-center group hover:border-emerald-500 border-2 border-transparent">
                        <div class="bg-emerald-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-600 transition-colors">
                            <svg class="w-8 h-8 text-emerald-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Pembinaan Akhlak</h3>
                        <p class="text-gray-600">
                            Fokus pada pembentukan karakter islami yang kuat melalui bimbingan ustadz dan ustadzah yang berpengalaman.
                        </p>
                    </div>

                    <!-- Keunggulan 3 -->
                    <div class="card text-center group hover:border-emerald-500 border-2 border-transparent">
                        <div class="bg-emerald-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-600 transition-colors">
                            <svg class="w-8 h-8 text-emerald-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Fasilitas Lengkap</h3>
                        <p class="text-gray-600">
                            Asrama nyaman, masjid luas, perpustakaan, laboratorium, dan fasilitas olahraga yang memadai.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Prestasi Section -->
        <section v-if="prestasi.length > 0" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                    <div class="text-left">
                        <h2 class="section-title !text-left !mb-2">Prestasi Terbaru</h2>
                        <p class="section-subtitle !text-left !mx-0">
                            Pencapaian santri dan lembaga yang membanggakan
                        </p>
                    </div>
                    <Link :href="route('prestasi')" class="text-emerald-600 font-bold hover:text-emerald-700 flex items-center gap-2 transition-colors">
                        Lihat Semua Prestasi
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </Link>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="item in prestasi" :key="item.id" class="card overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col">
                        <!-- Image -->
                        <div class="aspect-video overflow-hidden bg-gray-100 -mx-6 -mt-6 mb-4">
                            <img 
                                v-if="item.gambar"
                                :src="'/storage/' + item.gambar" 
                                :alt="item.judul"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            />
                            <div v-else class="w-full h-full flex items-center justify-center bg-emerald-50">
                                <svg class="w-12 h-12 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex items-start justify-between mb-3">
                            <span 
                                class="px-3 py-1 rounded-full text-xs font-semibold"
                                :class="{
                                    'bg-green-100 text-green-800': item.kategori === 'akademik',
                                    'bg-blue-100 text-blue-800': item.kategori === 'non_akademik',
                                    'bg-purple-100 text-purple-800': item.kategori === 'keagamaan'
                                }"
                            >
                                {{ item.kategori === 'akademik' ? 'Akademik' : item.kategori === 'non_akademik' ? 'Non-Akademik' : 'Keagamaan' }}
                            </span>
                            <span class="text-sm text-gray-500">{{ item.tahun }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight">{{ item.judul }}</h3>
                        <div class="mt-auto">
                            <p class="text-sm text-emerald-600 font-semibold mb-2">{{ item.tingkat }}</p>
                            <p v-if="item.deskripsi" class="text-sm text-gray-600 line-clamp-2">{{ item.deskripsi }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Berita Section -->
        <section v-if="beritaTerbaru.length > 0" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                    <div class="text-left">
                        <h2 class="section-title !text-left !mb-2">Berita & Kegiatan</h2>
                        <p class="section-subtitle !text-left !mx-0">
                            Ikuti terus kabar terbaru dan aktivitas di Pondok Pesantren
                        </p>
                    </div>
                    <Link :href="route('berita')" class="text-emerald-600 font-bold hover:text-emerald-700 flex items-center gap-2 transition-colors">
                        Lihat Semua Berita
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </Link>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <Link 
                        v-for="berita in beritaTerbaru" 
                        :key="berita.id"
                        :href="route('berita.show', berita.slug)"
                        class="group"
                    >
                        <article class="card overflow-hidden hover:shadow-xl transition-all duration-300 h-full flex flex-col">
                            <!-- Image -->
                            <div class="aspect-video overflow-hidden bg-gray-100 -mx-6 -mt-6 mb-4">
                                <img 
                                    v-if="berita.gambar"
                                    :src="'/storage/' + berita.gambar" 
                                    :alt="berita.judul"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                />
                                <div v-else class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="flex-grow">
                                <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                                    <span>{{ formatDate(berita.published_at) }}</span>
                                    <span>•</span>
                                    <span class="text-emerald-600 font-semibold uppercase tracking-wider text-xs">
                                        {{ berita.kategori }}
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-emerald-600 transition-colors line-clamp-2 leading-tight">
                                    {{ berita.judul }}
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-2 leading-relaxed mb-4">
                                    {{ stripHtml(berita.konten) }}
                                </p>
                            </div>
                            
                            <div class="pt-4 border-t border-gray-100 mt-auto">
                                <span class="text-sm font-bold text-emerald-600 flex items-center gap-1 group-hover:gap-2 transition-all">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                        </article>
                    </Link>
                </div>
            </div>
        </section>

        <!-- Ekstrakurikuler Section -->
        <section v-if="ekstrakurikuler.length > 0" class="py-24 bg-gray-50 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-16">
                    <span class="text-emerald-600 font-bold uppercase tracking-widest text-sm mb-3 block">Pengembangan Diri</span>
                    <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-6">Kegiatan Ekstrakurikuler</h2>
                    <div class="w-24 h-1.5 bg-emerald-500 mx-auto rounded-full mb-8"></div>
                    <p class="text-gray-500 max-w-2xl mx-auto">
                        Wadah bagi santri untuk menggali potensi, bakat, dan minat di luar bidang akademik untuk membentuk pribadi yang multitalenta.
                    </p>
                </div>

                <div 
                    class="relative group/slider"
                    @mouseenter="isHovering = true"
                    @mouseleave="isHovering = false"
                >
                    <!-- Navigation Buttons (Desktop) -->
                    <button 
                        v-if="ekstrakurikuler.length > 3"
                        @click="scrollPrev"
                        class="hidden md:flex absolute -left-6 top-1/2 -translate-y-1/2 z-30 w-14 h-14 bg-white rounded-2xl shadow-xl border border-emerald-100 items-center justify-center text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all duration-500 opacity-0 group-hover/slider:opacity-100 hover:scale-110 active:scale-95 group/btn"
                    >
                        <svg class="w-6 h-6 transition-transform group-hover/btn:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <button 
                        v-if="ekstrakurikuler.length > 3"
                        @click="scrollNext"
                        class="hidden md:flex absolute -right-6 top-1/2 -translate-y-1/2 z-30 w-14 h-14 bg-white rounded-2xl shadow-xl border border-emerald-100 items-center justify-center text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all duration-500 opacity-0 group-hover/slider:opacity-100 hover:scale-110 active:scale-95 group/btn"
                    >
                        <svg class="w-6 h-6 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Slider Wrapper -->
                    <div 
                        ref="ekskulContainer"
                        @scroll="handleScroll"
                        :class="ekstrakurikuler.length > 3 
                            ? 'flex overflow-x-auto gap-8 pb-12 snap-x snap-mandatory no-scrollbar scroll-smooth' 
                            : 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8'"
                    >
                        <div v-for="item in ekstrakurikuler" :key="item.id" 
                            :class="ekstrakurikuler.length > 3 ? 'flex-shrink-0 w-full sm:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.35rem)] snap-start' : ''"
                            class="group bg-white rounded-[2rem] p-5 shadow-lg shadow-emerald-900/5 border border-emerald-100 hover:border-emerald-300 transition-all duration-300 transform hover:-translate-y-1"
                        >
                            <div class="aspect-[4/3] rounded-3xl overflow-hidden mb-8 bg-emerald-50 relative">
                                <img v-if="item.gambar" :src="'/storage/' + item.gambar" :alt="item.nama" 
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                                <div v-else class="w-full h-full flex items-center justify-center">
                                    <svg class="w-20 h-20 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="px-2">
                                <h3 class="text-2xl font-black text-gray-900 mb-4 group-hover:text-emerald-600 transition-colors duration-300 leading-tight">{{ item.nama }}</h3>
                                <p class="text-gray-500 text-sm leading-relaxed line-clamp-3">
                                    {{ item.deskripsi }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination Dots -->
                    <div v-if="ekstrakurikuler.length > 3" class="flex justify-center gap-3 mt-4">
                        <button 
                            v-for="(_, idx) in Math.ceil(ekstrakurikuler.length / 3)" 
                            :key="idx"
                            @click="scrollToIndex(idx * 3)"
                            class="group relative h-2 transition-all duration-500 ease-out focus:outline-none"
                            :class="activeIndex === idx ? 'w-12' : 'w-3'"
                        >
                            <div 
                                class="absolute inset-0 rounded-full transition-all duration-500"
                                :class="activeIndex === idx ? 'bg-emerald-500' : 'bg-emerald-200 group-hover:bg-emerald-300'"
                            ></div>
                            <div 
                                v-if="activeIndex === idx"
                                class="absolute inset-0 bg-white/40 rounded-full animate-progress"
                            ></div>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 bg-emerald-700 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white"></path>
                </svg>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Bergabunglah Bersama Kami
                </h2>
                <p class="text-xl text-emerald-100 mb-8 max-w-2xl mx-auto">
                    Daftarkan putra-putri Anda untuk menjadi bagian dari keluarga besar Pondok Pesantren Riyadussalikin
                </p>
                <a :href="spmbUrl" class="bg-white text-emerald-600 hover:bg-gray-50 font-bold py-4 px-8 rounded-lg inline-block transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    Daftar Sekarang
                </a>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-4">Pertanyaan Umum (FAQ)</h2>
                    <p class="text-gray-500">Temukan jawaban cepat untuk pertanyaan yang sering diajukan</p>
                </div>
                <div class="space-y-4">
                    <div v-for="(faq, index) in faqs" :key="index" class="bg-white rounded-2xl border border-gray-100 overflow-hidden transition-all duration-300 shadow-sm hover:shadow-md">
                        <button 
                            @click="activeFaq = activeFaq === index ? null : index"
                            class="w-full px-6 py-5 text-left flex items-center justify-between focus:outline-none"
                        >
                            <span class="font-bold text-gray-800">{{ faq.question }}</span>
                            <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500 transition-transform duration-300" :class="{'rotate-180 bg-emerald-500 text-white': activeFaq === index}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>
                        <div 
                            v-show="activeFaq === index"
                            class="px-6 pb-6 text-gray-600 leading-relaxed border-t border-gray-50 pt-4"
                        >
                            {{ faq.answer }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import MainLayout from '../Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted, computed } from 'vue';

const activeFaq = ref(null);
const currentTime = ref(new Date());
const ekskulContainer = ref(null);
const activeIndex = ref(0);
const isHovering = ref(false);

const props = defineProps({
    prestasi: {
        type: Array,
        default: () => []
    },
    visiMisi: {
        type: Object,
        default: null
    },
    beritaTerbaru: {
        type: Array,
        default: () => []
    },
    spmbSetting: {
        type: Object,
        default: null
    },
    ekstrakurikuler: {
        type: Array,
        default: () => []
    },
    stats: {
        type: Object,
        default: () => ({
            santri_aktif: 0,
            ekstrakurikuler: 0,
            akreditasi: 'A',
            kelulusan: '100%',
            tenaga_pengajar: 0,
            unit_sekolah: 0,
        })
    }
});

const spmbUrl = computed(() => {
    // In local development with IP, use the local IP for SPMB
    if (window.location.hostname.startsWith('192.168.') || window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
        return `http://${window.location.hostname}:8081/login`;
    }
    // Default to production URL
    return 'https://spmb.riyadussalikin.my.id/login';
});

const isFutureOpen = computed(() => {
    if (!props.spmbSetting) return false;
    return new Date() < new Date(props.spmbSetting.tgl_buka);
});

const countdown = computed(() => {
    if (!props.spmbSetting) return '';
    
    // Gunakan parsing yang lebih aman untuk string tanggal
    const parseDate = (dateStr, timeStr) => {
        if (!dateStr) return null;
        // Tangani jika dateStr sudah berupa objek Date atau string ISO
        const d = new Date(dateStr);
        if (isNaN(d.getTime())) return null;
        
        // Ambil bagian YYYY-MM-DD
        const year = d.getFullYear();
        const month = (d.getMonth() + 1).toString().padStart(2, '0');
        const day = d.getDate().toString().padStart(2, '0');
        
        return new Date(`${year}-${month}-${day}T${timeStr}`);
    };

    const targetDate = props.spmbSetting.is_open 
        ? parseDate(props.spmbSetting.tgl_tutup, '23:59:59') 
        : parseDate(props.spmbSetting.tgl_buka, '00:00:00');
        
    if (!targetDate || isNaN(targetDate.getTime())) return '00h 00j 00m 00d';
        
    const diff = targetDate.getTime() - currentTime.value.getTime();
    
    if (diff <= 0) return '00h 00j 00m 00d';
    
    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((diff % (1000 * 60)) / 1000);
    
    return `${days}h ${hours.toString().padStart(2, '0')}j ${minutes.toString().padStart(2, '0')}m ${seconds.toString().padStart(2, '0')}d`;
});

let timer;
let scrollInterval;

const handleScroll = () => {
    if (!ekskulContainer.value) return;
    const container = ekskulContainer.value;
    const scrollPosition = container.scrollLeft;
    const itemWidth = container.clientWidth;
    activeIndex.value = Math.round(scrollPosition / itemWidth);
};

const scrollNext = () => {
    if (!ekskulContainer.value) return;
    const container = ekskulContainer.value;
    const scrollAmount = container.clientWidth;
    
    if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
        container.scrollTo({ left: 0, behavior: 'smooth' });
    } else {
        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }
};

const scrollPrev = () => {
    if (!ekskulContainer.value) return;
    const container = ekskulContainer.value;
    const scrollAmount = container.clientWidth;
    
    if (container.scrollLeft <= 0) {
        container.scrollTo({ left: container.scrollWidth, behavior: 'smooth' });
    } else {
        container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    }
};

const scrollToIndex = (index) => {
    if (!ekskulContainer.value) return;
    const container = ekskulContainer.value;
    const itemWidth = container.clientWidth;
    container.scrollTo({ left: index * itemWidth, behavior: 'smooth' });
};

const startAutoScroll = () => {
    if (props.ekstrakurikuler.length > 3) {
        stopAutoScroll();
        scrollInterval = setInterval(() => {
            if (!isHovering.value) {
                scrollNext();
            }
        }, 5000);
    }
};

const stopAutoScroll = () => {
    if (scrollInterval) clearInterval(scrollInterval);
};

onMounted(() => {
    timer = setInterval(() => {
        currentTime.value = new Date();
    }, 1000);

    startAutoScroll();
});

onUnmounted(() => {
    clearInterval(timer);
    stopAutoScroll();
});

const faqs = [
    {
        question: "Berapa biaya pendaftaran santri baru?",
        answer: "Biaya pendaftaran awal meliputi biaya formulir dan tes seleksi. Rincian lengkap biaya pendidikan dapat dilihat pada dashboard pendaftaran setelah Anda membuat akun."
    },
    {
        question: "Kapan jadwal tes seleksi dilaksanakan?",
        answer: "Jadwal tes seleksi akan diinformasikan melalui akun pendaftaran masing-masing santri setelah semua berkas persyaratan diverifikasi oleh panitia."
    },
    {
        question: "Apa saja perlengkapan yang harus dibawa saat mulai mondok?",
        answer: "Perlengkapan wajib meliputi pakaian ibadah, seragam, perlengkapan tidur mandiri, dan peralatan mandi. Daftar detail akan diberikan saat daftar ulang."
    }
];

const testimonials = [
    {
        name: "H. Ahmad Jaelani",
        role: "Wali Santri",
        text: "Alhamdulillah, sejak anak saya mondok di Riyadussalikin, perubahan akhlaknya sangat terasa. Menjadi lebih mandiri dan hafalannya meningkat pesat."
    },
    {
        name: "Siti Maryam",
        role: "Alumni 2022",
        text: "Pengalaman belajar di sini sangat berkesan. Tidak hanya ilmu agama, tapi kami juga diajarkan kemandirian dan keterampilan hidup yang sangat berguna di bangku kuliah."
    }
];

const formatDate = (dateString) => {
    if (!dateString) return '';
    return new Date(dateString).toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });
};

const stripHtml = (html) => {
    if (!html) return '';
    return html.replace(/<[^>]*>?/gm, '').replace(/&nbsp;/g, ' ');
};
</script>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.text-gradient {
    background: linear-gradient(to right, #059669, #10b981);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.bg-dot-pattern {
    background-image: radial-gradient(#10b981 1px, transparent 1px);
    background-size: 24px 24px;
}

@keyframes progress {
    0% { transform: scaleX(0); transform-origin: left; }
    100% { transform: scaleX(1); transform-origin: left; }
}

.animate-progress {
    animation: progress 5s linear infinite;
}
</style>
