<template>
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-white shadow-md sticky top-0 z-50">
            <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-12">
                <div class="flex justify-between items-center h-20">
                    <!-- Logo & Name -->
                    <Link :href="route('home')" class="flex items-center space-x-3 flex-shrink-0 font-poppins">
                        <img :src="isSmpPage ? '/assets/Logo_Sekolah/smp_dharma_ksatria.png' : logoUrl" :alt="isSmpPage ? 'Logo SMP Dharma Ksatria' : 'Logo Riyadussalikin'" class="h-12 w-12 object-contain" />
                        <!-- Mobile: Nama Pondok / Sekolah -->
                        <div class="block lg:hidden">
                            <template v-if="isSmpPage">
                                <div class="text-blue-900 font-extrabold text-base leading-tight">SMP Dharma Ksatria</div>
                                <div class="text-blue-600 text-xs font-semibold">Formal Unit</div>
                            </template>
                            <template v-else>
                                <div class="text-emerald-700 font-bold text-base leading-tight">Riyadussalikin</div>
                                <div class="text-emerald-600 text-xs font-semibold">Padaherang</div>
                            </template>
                        </div>
                        <!-- Desktop: Nama lengkap -->
                        <div class="hidden lg:block">
                            <template v-if="isSmpPage">
                                <div class="text-blue-900 font-bold text-lg leading-tight">SMP Dharma Ksatria</div>
                                <div class="text-blue-600 text-sm font-semibold">Riyadussalikin Padaherang</div>
                            </template>
                            <template v-else>
                                <div class="text-emerald-700 font-bold text-lg leading-tight">Pondok Pesantren</div>
                                <div class="text-emerald-600 text-sm font-semibold">Riyadussalikin Padaherang</div>
                            </template>
                        </div>
                    </Link>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center space-x-3 lg:space-x-6 xl:space-x-8">
                        <Link 
                            :href="route('home')" 
                            :class="navbarLinkClass('home')"
                        >
                            Beranda
                        </Link>
                        <!-- Tentang Kami Dropdown -->
                        <div class="relative group">
                            <button 
                                @mouseenter="isTentangOpen = true"
                                class="flex items-center gap-1 focus:outline-none"
                                :class="getDropdownTriggerClass(['visi-misi', 'tentang-pondok', 'fasilitas'], isTentangOpen)"
                            >
                                Tentang Kami
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': isTentangOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown Content -->
                            <div 
                                v-show="isTentangOpen" 
                                @mouseleave="isTentangOpen = false"
                                class="absolute left-0 mt-0 w-64 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden transform transition-all duration-200 origin-top-left z-50 py-2"
                            >
                                <Link 
                                    :href="route('tentang-pondok')" 
                                    class="block px-4 py-3 text-sm text-gray-700 transition-colors"
                                    :class="dropdownItemClass('tentang-pondok')"
                                >
                                    Tentang Pondok Pesantren
                                </Link>
                                <Link 
                                    :href="route('fasilitas')" 
                                    class="block px-4 py-3 text-sm text-gray-700 transition-colors"
                                    :class="dropdownItemClass('fasilitas')"
                                >
                                    Fasilitas
                                </Link>
                                <div class="border-t border-gray-100 my-1"></div>
                                <Link 
                                    :href="route('visi-misi')" 
                                    class="block px-4 py-3 text-sm text-gray-700 transition-colors"
                                    :class="dropdownItemClass('visi-misi')"
                                >
                                    Visi &amp; Misi
                                </Link>
                            </div>
                        </div>

                        <Link 
                            :href="route('prestasi')" 
                            :class="navbarLinkClass('prestasi')"
                        >
                            Prestasi
                        </Link>
                        <Link 
                            :href="route('jadwal')" 
                            :class="navbarLinkClass('jadwal')"
                        >
                            Jadwal
                        </Link>
                        <Link 
                            :href="route('berita')" 
                            :class="navbarLinkClass('berita')"
                        >
                            Berita
                        </Link>
                        <Link 
                            :href="route('kontak')" 
                            :class="navbarLinkClass('kontak')"
                        >
                            Kontak
                        </Link>
                        <!-- Dropdown Menu -->
                        <div class="relative group">
                            <button 
                                @mouseenter="isDropdownOpen = true"
                                class="flex items-center gap-1 focus:outline-none"
                                :class="getDropdownTriggerClass(['sekolah.sma', 'sekolah.smp'], isDropdownOpen)"
                            >
                                Lembaga Pendidikan
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': isDropdownOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            <!-- Dropdown Content -->
                            <div 
                                v-show="isDropdownOpen" 
                                @mouseleave="isDropdownOpen = false"
                                class="absolute left-0 mt-0 w-60 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden transform transition-all duration-200 origin-top-left z-50 py-2"
                            >
                                <Link 
                                    :href="route('sekolah.sma')" 
                                    class="block px-4 py-3 text-sm text-gray-700 transition-colors"
                                    :class="dropdownItemClass('sekolah.sma')"
                                >
                                    SMA Ksatria Nusantara
                                </Link>
                                <Link 
                                    :href="route('sekolah.smp')" 
                                    class="block px-4 py-3 text-sm text-gray-700 transition-colors"
                                    :class="dropdownItemClass('sekolah.smp')"
                                >
                                    SMP Dharma Ksatria
                                </Link>
                            </div>
                        </div>

                        <a 
                            href="https://ppdb.riyadussalikin.my.id/login"
                            :class="isSmpPage ? 'bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition-all shadow-md hover:shadow-lg' : 'btn-primary'"
                        >
                            PPDB
                        </a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2">
                        <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path v-if="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Mobile Menu -->
                <div v-show="mobileMenuOpen" class="md:hidden pb-4">
                    <div class="flex flex-col space-y-3">
                        <Link :href="route('home')" :class="isActive('home') ? (isSmpPage ? 'text-blue-600 font-bold' : 'navbar-link-active') : (isSmpPage ? 'text-gray-650 hover:text-blue-600 font-medium' : 'navbar-link')">
                            Beranda
                        </Link>
                        <!-- Mobile Tentang Kami -->
                        <div class="border-l-2 pl-4 space-y-2 py-2" :class="isSmpPage ? 'border-blue-100' : 'border-emerald-100'">
                            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Tentang Kami</div>
                            <Link :href="route('tentang-pondok')" class="block text-gray-700 font-medium" :class="[route().current('tentang-pondok') ? (isSmpPage ? 'text-blue-600' : 'text-emerald-600') : (isSmpPage ? 'hover:text-blue-600' : 'hover:text-emerald-600')]">
                                Tentang Pondok
                            </Link>
                            <Link :href="route('fasilitas')" class="block text-gray-700 font-medium" :class="[route().current('fasilitas') ? (isSmpPage ? 'text-blue-600' : 'text-emerald-600') : (isSmpPage ? 'hover:text-blue-600' : 'hover:text-emerald-600')]">
                                Fasilitas
                            </Link>
                            <Link :href="route('visi-misi')" class="block text-gray-700 font-medium" :class="[route().current('visi-misi') ? (isSmpPage ? 'text-blue-600' : 'text-emerald-600') : (isSmpPage ? 'hover:text-blue-600' : 'hover:text-emerald-650')]">
                                Visi &amp; Misi
                            </Link>
                        </div>

                        <!-- Mobile Dropdown -->
                        <div class="border-l-2 pl-4 space-y-2 py-2" :class="isSmpPage ? 'border-blue-100' : 'border-emerald-100'">
                            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Lembaga Pendidikan</div>
                            <Link :href="route('sekolah.sma')" class="block text-gray-700 font-medium" :class="[route().current('sekolah.sma') ? (isSmpPage ? 'text-blue-600' : 'text-emerald-600') : (isSmpPage ? 'hover:text-blue-600' : 'hover:text-emerald-600')]">
                                SMA Ksatria Nusantara
                            </Link>
                            <Link :href="route('sekolah.smp')" class="block text-gray-700 font-medium" :class="[route().current('sekolah.smp') ? (isSmpPage ? 'text-blue-600' : 'text-emerald-600') : (isSmpPage ? 'hover:text-blue-600' : 'hover:text-emerald-600')]">
                                SMP Dharma Ksatria
                            </Link>
                        </div>
                        <Link :href="route('prestasi')" :class="isActive('prestasi') ? (isSmpPage ? 'text-blue-600 font-bold' : 'navbar-link-active') : (isSmpPage ? 'text-gray-650 hover:text-blue-600 font-medium' : 'navbar-link')">
                            Prestasi
                        </Link>
                        <Link :href="route('jadwal')" :class="isActive('jadwal') ? (isSmpPage ? 'text-blue-600 font-bold' : 'navbar-link-active') : (isSmpPage ? 'text-gray-650 hover:text-blue-600 font-medium' : 'navbar-link')">
                            Jadwal
                        </Link>
                        <Link :href="route('berita')" :class="isActive('berita') ? (isSmpPage ? 'text-blue-600 font-bold' : 'navbar-link-active') : (isSmpPage ? 'text-gray-650 hover:text-blue-600 font-medium' : 'navbar-link')">
                            Berita
                        </Link>
                        <Link :href="route('kontak')" :class="isActive('kontak') ? (isSmpPage ? 'text-blue-600 font-bold' : 'navbar-link-active') : (isSmpPage ? 'text-gray-650 hover:text-blue-600 font-medium' : 'navbar-link')">
                            Kontak
                        </Link>
                        <a href="https://ppdb.riyadussalikin.my.id/login" :class="isSmpPage ? 'bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition-all text-center shadow-md' : 'btn-primary text-center'">
                            PPDB
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="grow">
            <slot />
        </main>

        <!-- Footer -->
        <footer 
            :class="isSmpPage ? 'bg-blue-950 text-white' : 'bg-emerald-900 text-white'"
            style="box-shadow: 0 -8px 24px -4px rgba(0,0,0,0.25);"
        >
            <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-12 py-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- About -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">
                            {{ isSmpPage ? 'SMP Dharma Ksatria' : 'Pondok Pesantren Riyadussalikin' }}
                        </h3>
                        <p 
                            :class="isSmpPage ? 'text-blue-100' : 'text-emerald-100'"
                            class="text-sm leading-relaxed"
                        >
                            {{ isSmpPage 
                                ? 'Mengintegrasikan Kurikulum Nasional (Merdeka) dengan Pendidikan Kepesantrenan Klasik untuk Membentuk Generasi Berkarakter, Cerdas, dan Berakhlakul Karimah.' 
                                : 'Lembaga pendidikan Islam yang mengedepankan akhlak mulia, keilmuan yang mendalam, dan kemandirian santri.' 
                            }}
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">Menu</h3>
                        <div class="flex flex-col space-y-2">
                            <Link :href="route('home')" :class="isSmpPage ? 'text-blue-100 hover:text-white' : 'text-emerald-100 hover:text-white'" class="transition-colors">Beranda</Link>
                            <Link :href="route('tentang-pondok')" :class="isSmpPage ? 'text-blue-100 hover:text-white' : 'text-emerald-100 hover:text-white'" class="transition-colors">Tentang Pondok</Link>
                            <Link :href="route('visi-misi')" :class="isSmpPage ? 'text-blue-100 hover:text-white' : 'text-emerald-100 hover:text-white'" class="transition-colors">Visi &amp; Misi</Link>
                            <span :class="isSmpPage ? 'text-blue-100/50' : 'text-emerald-100/50'" class="text-xs uppercase tracking-wider font-semibold mt-2 mb-1">Pendidikan</span>
                            <Link :href="route('sekolah.sma')" :class="isSmpPage ? 'text-blue-100 hover:text-white' : 'text-emerald-100 hover:text-white'" class="transition-colors pl-2">SMA Ksatria Nusantara</Link>
                            <Link :href="route('sekolah.smp')" :class="isSmpPage ? 'text-blue-100 hover:text-white' : 'text-emerald-100 hover:text-white'" class="transition-colors pl-2">SMP Dharma Ksatria</Link>
                            <Link :href="route('prestasi')" :class="isSmpPage ? 'text-blue-100 hover:text-white' : 'text-emerald-100 hover:text-white'" class="transition-colors">Prestasi</Link>
                            <Link :href="route('jadwal')" :class="isSmpPage ? 'text-blue-100 hover:text-white' : 'text-emerald-100 hover:text-white'" class="transition-colors">Jadwal &amp; Agenda</Link>
                            <Link :href="route('berita')" :class="isSmpPage ? 'text-blue-100 hover:text-white' : 'text-emerald-100 hover:text-white'" class="transition-colors">Berita</Link>
                            <Link :href="route('kontak')" :class="isSmpPage ? 'text-blue-100 hover:text-white' : 'text-emerald-100 hover:text-white'" class="transition-colors">Kontak</Link>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">Kontak</h3>
                        <div 
                            :class="isSmpPage ? 'text-blue-100' : 'text-emerald-100'"
                            class="text-sm space-y-2"
                        >
                            <p v-if="$page.props.kontak?.alamat">{{ $page.props.kontak.alamat }}</p>
                            <p v-else>Jl. Raya Padaherang, Pangandaran</p>
                            
                            <p v-if="$page.props.kontak?.whatsapp">WhatsApp: {{ $page.props.kontak.whatsapp }}</p>
                            <p v-else-if="$page.props.kontak?.telepon">Telepon: {{ $page.props.kontak.telepon }}</p>
                            <p v-else>WhatsApp: +62 812-3456-7890</p>
                            
                            <p v-if="$page.props.kontak?.email">Email: {{ $page.props.kontak.email }}</p>
                            <p v-else>Email: info@riyadussalikin.sch.id</p>
                        </div>
                    </div>
                </div>

                <div 
                    :class="isSmpPage ? 'border-blue-900 text-blue-200' : 'border-emerald-800 text-emerald-200'"
                    class="border-t mt-8 pt-8 text-center text-sm"
                >
                    <p>&copy; {{ new Date().getFullYear() }} {{ isSmpPage ? 'SMP Dharma Ksatria' : 'Pondok Pesantren Riyadussalikin Padaherang' }}. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import logoUrl from '../../assets/logo/logo_pondok.png';

const mobileMenuOpen = ref(false);
const isDropdownOpen = ref(false);
const isTentangOpen = ref(false);
const page = usePage();

const isSmpPage = computed(() => {
    // Cek berdasarkan nama rute Ziggy jika tersedia
    try {
        if (typeof route !== 'undefined' && route().current('sekolah.smp')) {
            return true;
        }
    } catch (e) {
        // Abaikan jika helper route tidak terdefinisi
    }

    const currentUrl = page.url;
    return currentUrl === '/smp' || 
           currentUrl.startsWith('/smp/') || 
           currentUrl.startsWith('/smp?') ||
           currentUrl === '/smp-dharma-ksatria' || 
           currentUrl.startsWith('/smp-dharma-ksatria/') ||
           currentUrl.startsWith('/smp-dharma-ksatria?');
});

const updateFavicon = (url) => {
    let link = document.querySelector("link[rel~='icon']");
    if (!link) {
        link = document.createElement('link');
        link.rel = 'icon';
        document.getElementsByTagName('head')[0].appendChild(link);
    }
    link.href = url;
    
    let shortcutLink = document.querySelector("link[rel~='shortcut']");
    if (shortcutLink) {
        shortcutLink.href = url;
    }
};

watch(isSmpPage, (newVal) => {
    if (newVal) {
        updateFavicon('/assets/Logo_Sekolah/smp_dharma_ksatria.png');
    } else {
        updateFavicon('/favicon.ico');
    }
}, { immediate: true });

onMounted(() => {
    if (isSmpPage.value) {
        updateFavicon('/assets/Logo_Sekolah/smp_dharma_ksatria.png');
    } else {
        updateFavicon('/favicon.ico');
    }
});

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};

const isActive = (routeName) => {
    const currentUrl = page.url;
    
    // Home page
    if (routeName === 'home') {
        return currentUrl === '/' || currentUrl === '';
    }
    
    // Other pages
    const routePath = '/' + routeName;
    return currentUrl === routePath || currentUrl.startsWith(routePath + '/') || currentUrl.startsWith(routePath + '?');
};

const navbarLinkClass = (routeName) => {
    if (isActive(routeName)) {
        return isSmpPage.value ? 'text-blue-600 font-bold' : 'navbar-link-active';
    }
    return isSmpPage.value 
        ? 'text-gray-650 hover:text-blue-600 font-medium transition-colors' 
        : 'navbar-link';
};

const isTabActive = (routes) => {
    return routes.some(r => isActive(r) || route().current(r));
};

const getDropdownTriggerClass = (routes, isOpen) => {
    const isActiveTab = isTabActive(routes) || isOpen;
    if (isActiveTab) {
        return isSmpPage.value ? 'text-blue-600 font-semibold' : 'text-emerald-600 font-semibold';
    }
    return isSmpPage.value 
        ? 'text-gray-650 hover:text-blue-600 font-medium transition-colors' 
        : 'navbar-link';
};

const dropdownItemClass = (routeName) => {
    const active = route().current(routeName);
    if (active) {
        return isSmpPage.value ? 'bg-blue-50 text-blue-700 font-medium' : 'bg-emerald-50 text-emerald-700 font-medium';
    }
    return isSmpPage.value 
        ? 'hover:bg-blue-50 hover:text-blue-700 transition-colors' 
        : 'hover:bg-emerald-50 hover:text-emerald-700 transition-colors';
};
</script>
