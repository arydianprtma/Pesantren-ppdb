<template>
    <Head title="Tentang Pondok Pesantren" />
    <MainLayout>
        <!-- Hero Section -->
        <section class="relative bg-emerald-900 py-24 overflow-hidden">
            <div class="absolute inset-0 bg-dot-pattern opacity-20"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-emerald-800 text-emerald-300 text-sm font-semibold mb-4 border border-emerald-700">
                    Profil Lembaga
                </span>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
                    Tentang Pondok Pesantren
                </h1>
                <p class="text-xl text-emerald-100 max-w-2xl mx-auto leading-relaxed">
                    Mengenal lebih dekat Pondok Pesantren Riyadussalikin Padaherang - perjalanan, komitmen, dan cita-cita kami.
                </p>
            </div>
        </section>

        <!-- Profil Singkat -->
        <section class="py-16 bg-white">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="inline-block bg-emerald-100 text-emerald-700 px-4 py-1 rounded-full text-sm font-semibold mb-4">
                            Profil Pondok
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-4 leading-snug">
                            Pondok Pesantren Riyadussalikin Padaherang
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-4 text-justify">
                            Pondok Pesantren Riyadussalikin adalah lembaga pendidikan Islam yang berdiri di Padaherang, Pangandaran, Jawa Barat. Didirikan dengan semangat untuk mencetak generasi muslim yang berilmu, berakhlak mulia, dan mandiri.
                        </p>
                        <p class="text-gray-600 leading-relaxed text-justify">
                            Pondok ini mengintegrasikan pendidikan agama Islam yang mendalam dengan kurikulum pendidikan formal, menjadikan santri siap menghadapi tantangan zaman tanpa meninggalkan nilai-nilai Islam.
                        </p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="card bg-gradient-to-br from-emerald-50 to-white text-center border border-emerald-100">
                            <div class="text-4xl font-extrabold text-emerald-600 mb-1">{{ stats.santri_aktif }}+</div>
                            <div class="text-sm text-gray-500 font-medium">Santri Aktif</div>
                        </div>
                        <div class="card bg-gradient-to-br from-emerald-50 to-white text-center border border-emerald-100">
                            <div class="text-4xl font-extrabold text-emerald-600 mb-1">{{ stats.unit_sekolah }}</div>
                            <div class="text-sm text-gray-500 font-medium">Unit Sekolah</div>
                        </div>
                        <div class="card bg-gradient-to-br from-emerald-50 to-white text-center border border-emerald-100">
                            <div class="text-4xl font-extrabold text-emerald-600 mb-1">{{ stats.tenaga_pengajar }}+</div>
                            <div class="text-sm text-gray-500 font-medium">Tenaga Pengajar</div>
                        </div>
                        <div class="card bg-gradient-to-br from-emerald-50 to-white text-center border border-emerald-100">
                            <div class="text-4xl font-extrabold text-emerald-600 mb-1">{{ stats.akreditasi }}</div>
                            <div class="text-sm text-gray-500 font-medium">Akreditasi</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sejarah Preview -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-10 text-center">
                    <div class="inline-block bg-emerald-100 text-emerald-700 px-4 py-1 rounded-full text-sm font-semibold mb-2">Sejarah</div>
                    <h2 class="text-3xl font-bold text-gray-900">Perjalanan Pondok Pesantren</h2>
                </div>

                <!-- Data dinamis sejarah -->
                <div v-if="sejarahList && sejarahList.length > 0" class="space-y-6">
                    <div
                        v-for="(item, index) in sejarahList"
                        :key="item.id"
                        class="flex gap-5 items-start"
                    >
                        <div class="flex-shrink-0 bg-emerald-600 text-white w-14 h-14 rounded-full flex items-center justify-center font-bold text-xs text-center z-10 leading-tight p-1">
                            {{ item.periode || (index + 1) }}
                        </div>
                        <div class="card flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ item.judul }}</h3>
                            <div class="text-gray-600 text-sm leading-relaxed prose prose-sm max-w-none text-justify" v-html="item.konten"></div>
                        </div>
                    </div>
                </div>
                <!-- Fallback jika belum ada data -->
                <div v-else class="space-y-6">
                    <div v-for="fase in sejarahFallback" :key="fase.label" class="flex gap-5 items-start">
                        <div class="flex-shrink-0 bg-emerald-600 text-white w-14 h-14 rounded-full flex items-center justify-center font-bold text-xs text-center leading-tight p-1">
                            {{ fase.label }}
                        </div>
                        <div class="card flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ fase.judul }}</h3>
                            <p class="text-gray-600 text-sm leading-relaxed text-justify">{{ fase.konten }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Fasilitas Preview -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-end justify-between mb-10">
                    <div>
                        <div class="inline-block bg-emerald-100 text-emerald-700 px-4 py-1 rounded-full text-sm font-semibold mb-2">Fasilitas</div>
                        <h2 class="text-3xl font-bold text-gray-900">Sarana & Prasarana</h2>
                    </div>
                    <Link :href="route('fasilitas')" class="hidden sm:inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-semibold text-sm transition-colors">
                        Lihat Semua
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </Link>
                </div>

                <!-- Data dinamis fasilitas -->
                <div v-if="fasilitasList && fasilitasList.length > 0"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div
                        v-for="fasilitas in fasilitasList.slice(0, 6)"
                        :key="fasilitas.id"
                        class="card flex items-start gap-4 hover:shadow-xl transition-shadow border border-gray-100"
                    >
                        <div class="flex-shrink-0 bg-emerald-100 text-emerald-700 w-12 h-12 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" :d="getIkonPath(fasilitas.ikon)" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">{{ fasilitas.nama }}</h3>
                            <p v-if="fasilitas.deskripsi" class="text-sm text-gray-500">{{ fasilitas.deskripsi }}</p>
                        </div>
                    </div>
                </div>
                <!-- Fallback jika belum ada data -->
                <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="f in fasilitasFallback" :key="f.nama" class="card flex items-start gap-4 hover:shadow-xl transition-shadow border border-gray-100">
                        <div class="flex-shrink-0 bg-emerald-100 text-emerald-700 w-12 h-12 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" :d="getIkonPath(f.ikon)" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">{{ f.nama }}</h3>
                            <p class="text-sm text-gray-500">{{ f.deskripsi }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-center sm:hidden">
                    <Link :href="route('fasilitas')" class="btn-primary inline-block">Lihat Semua Fasilitas</Link>
                </div>
            </div>
        </section>

        <!-- Lokasi -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="inline-block bg-emerald-100 text-emerald-700 px-6 py-2 rounded-full font-semibold mb-4">
                    Lokasi
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Temukan Kami</h2>
                <p class="text-gray-500 mb-8">{{ $page.props.kontak?.alamat ?? 'Jl. Raya Padaherang, Kec. Padaherang, Kab. Pangandaran, Jawa Barat' }}</p>
                <div class="card overflow-hidden p-0">
                    <!-- Google Maps embed dari database atau default -->
                    <div v-if="$page.props.kontak?.maps_link && $page.props.kontak.maps_link.includes('iframe')"
                        v-html="$page.props.kontak.maps_link">
                    </div>
                    <iframe
                        v-else-if="$page.props.kontak?.maps_link"
                        :src="$page.props.kontak.maps_link"
                        width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" class="w-full"
                    ></iframe>
                    <iframe
                        v-else
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31742.28!2d108.5!3d-7.45!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMjcnMDAuMCJTIDEwOMKwMzAnMDAuMCJF!5e0!3m2!1sid!10sid!4v1"
                        width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" class="w-full"
                    ></iframe>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
                    <div class="card text-center">
                        <div class="text-emerald-600 font-bold mb-1">Alamat</div>
                        <p class="text-sm text-gray-600">{{ $page.props.kontak?.alamat ?? 'Jl. Raya Padaherang, Pangandaran' }}</p>
                    </div>
                    <div class="card text-center">
                        <div class="text-emerald-600 font-bold mb-1">WhatsApp</div>
                        <a v-if="$page.props.kontak?.whatsapp"
                            :href="'https://wa.me/' + $page.props.kontak.whatsapp.replace(/[^0-9]/g, '')"
                            target="_blank"
                            class="text-sm text-emerald-600 hover:text-emerald-700 font-semibold">
                            {{ $page.props.kontak.whatsapp }}
                        </a>
                        <p v-else class="text-sm text-gray-600">+62 812-3456-7890</p>
                    </div>
                    <div class="card text-center">
                        <div class="text-emerald-600 font-bold mb-1">Email</div>
                        <a v-if="$page.props.kontak?.email"
                            :href="'mailto:' + $page.props.kontak.email"
                            class="text-sm text-emerald-600 hover:text-emerald-700 font-semibold">
                            {{ $page.props.kontak.email }}
                        </a>
                        <p v-else class="text-sm text-gray-600">info@riyadussalikin.sch.id</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <CallToAction />
    </MainLayout>
</template>

<script setup>
import MainLayout from '../Layouts/MainLayout.vue';
import CallToAction from '../Components/CallToAction.vue';
import { Link, Head } from '@inertiajs/vue3';

defineProps({
    fasilitasList: { type: Array, default: () => [] },
    sejarahList:   { type: Array, default: () => [] },
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

// Fallback data saat database belum diisi
const sejarahFallback = [
    { label: 'Awal', judul: 'Berdirinya Pondok Pesantren', konten: 'Pondok Pesantren Riyadussalikin didirikan oleh para ulama dan tokoh masyarakat Padaherang dengan visi menjadikan pesantren sebagai pusat pendidikan Islam yang komprehensif di wilayah Pangandaran.' },
    { label: 'Tumbuh', judul: 'Pengembangan Lembaga Pendidikan', konten: 'Seiring waktu, pondok berkembang dengan mendirikan unit-unit pendidikan formal seperti SMP Dharma Ksatria dan SMA Ksatria Nusantara untuk mengintegrasikan pendidikan agama dan umum secara seimbang.' },
    { label: 'Kini', judul: 'Pesantren Modern Berbasis Karakter', konten: 'Saat ini, Pondok Pesantren Riyadussalikin terus bertumbuh sebagai lembaga pendidikan Islam modern yang membekali santri dengan keilmuan agama, akademik, dan keterampilan hidup.' },
];

const fasilitasFallback = [
    { nama: 'Masjid & Musholla',       deskripsi: 'Tempat ibadah yang nyaman sebagai pusat kegiatan spiritual santri.',         ikon: 'masjid' },
    { nama: 'Asrama Putra & Putri',    deskripsi: 'Asrama yang nyaman dan kondusif untuk proses belajar dan istirahat.',          ikon: 'asrama' },
    { nama: 'Ruang Kelas Modern',      deskripsi: 'Kelas yang dilengkapi sarana pembelajaran yang memadai.',                      ikon: 'kelas' },
    { nama: 'Perpustakaan',            deskripsi: 'Koleksi kitab, buku agama, dan buku umum yang lengkap.',                       ikon: 'perpustakaan' },
    { nama: 'Laboratorium Komputer',   deskripsi: 'Fasilitas teknologi informasi untuk mendukung pembelajaran modern.',            ikon: 'komputer' },
    { nama: 'Lapangan Olahraga',       deskripsi: 'Sarana olahraga untuk menjaga kebugaran dan kesehatan santri.',                ikon: 'olahraga' },
];
</script>
