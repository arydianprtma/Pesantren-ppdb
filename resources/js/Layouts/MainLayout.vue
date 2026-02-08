<template>
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-white shadow-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <!-- Logo & Name -->
                    <Link :href="route('home')" class="flex items-center space-x-3">
                        <img src="/Logo Riyad.png" alt="Logo Riyadussalikin" class="h-12 w-12" />
                        <div class="hidden md:block">
                            <div class="text-emerald-700 font-bold text-lg">Pondok Pesantren</div>
                            <div class="text-emerald-600 text-sm font-semibold">Riyadussalikin Padaherang</div>
                        </div>
                    </Link>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center space-x-8">
                        <Link 
                            :href="route('home')" 
                            :class="isActive('home') ? 'navbar-link-active' : 'navbar-link'"
                        >
                            Beranda
                        </Link>
                        <Link 
                            :href="route('visi-misi')" 
                            :class="isActive('visi-misi') ? 'navbar-link-active' : 'navbar-link'"
                        >
                            Visi & Misi
                        </Link>

                        <!-- Dropdown Menu -->
                        <div class="relative group">
                            <button 
                                @mouseenter="isDropdownOpen = true"
                                class="navbar-link flex items-center gap-1 focus:outline-none"
                                :class="{'text-emerald-600 font-semibold': isDropdownOpen || isActive('sekolah')}"
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
                                    class="block px-4 py-3 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors"
                                    :class="{'bg-emerald-50 text-emerald-700 font-medium': route().current('sekolah.sma')}"
                                >
                                    SMA Ksatria Nusantara
                                </Link>
                                <Link 
                                    :href="route('sekolah.smp')" 
                                    class="block px-4 py-3 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors"
                                    :class="{'bg-emerald-50 text-emerald-700 font-medium': route().current('sekolah.smp')}"
                                >
                                    SMP Dharma Ksatria
                                </Link>
                            </div>
                        </div>
                        <Link 
                            :href="route('prestasi')" 
                            :class="isActive('prestasi') ? 'navbar-link-active' : 'navbar-link'"
                        >
                            Prestasi
                        </Link>
                        <Link 
                            :href="route('berita')" 
                            :class="isActive('berita') ? 'navbar-link-active' : 'navbar-link'"
                        >
                            Berita
                        </Link>
                        <Link 
                            :href="route('kontak')" 
                            :class="isActive('kontak') ? 'navbar-link-active' : 'navbar-link'"
                        >
                            Kontak
                        </Link>

                        <a 
                            href="https://ppdb.riyadussalikin.sch.id" 
                            target="_blank"
                            class="btn-primary"
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
                        <Link :href="route('home')" :class="isActive('home') ? 'navbar-link-active' : 'navbar-link'">
                            Beranda
                        </Link>
                        <Link :href="route('visi-misi')" :class="isActive('visi-misi') ? 'navbar-link-active' : 'navbar-link'">
                            Visi & Misi
                        </Link>

                        <!-- Mobile Dropdown -->
                        <div class="border-l-2 border-emerald-100 pl-4 space-y-2 py-2">
                            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Lembaga Pendidikan</div>
                            <Link :href="route('sekolah.sma')" class="block text-gray-700 hover:text-emerald-600 font-medium" :class="{'text-emerald-600': route().current('sekolah.sma')}">
                                SMA Ksatria Nusantara
                            </Link>
                            <Link :href="route('sekolah.smp')" class="block text-gray-700 hover:text-emerald-600 font-medium" :class="{'text-emerald-600': route().current('sekolah.smp')}">
                                SMP Dharma Ksatria
                            </Link>
                        </div>
                        <Link :href="route('prestasi')" :class="isActive('prestasi') ? 'navbar-link-active' : 'navbar-link'">
                            Prestasi
                        </Link>
                        <Link :href="route('berita')" :class="isActive('berita') ? 'navbar-link-active' : 'navbar-link'">
                            Berita
                        </Link>
                        <Link :href="route('kontak')" :class="isActive('kontak') ? 'navbar-link-active' : 'navbar-link'">
                            Kontak
                        </Link>
                        <a href="https://ppdb.riyadussalikin.sch.id" target="_blank" class="btn-primary text-center">
                            PPDB
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-emerald-900 text-white mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- About -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">Pondok Pesantren Riyadussalikin</h3>
                        <p class="text-emerald-100 text-sm leading-relaxed">
                            Lembaga pendidikan Islam yang mengedepankan akhlak mulia, keilmuan yang mendalam, dan kemandirian santri.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">Menu</h3>
                        <div class="flex flex-col space-y-2">
                            <Link :href="route('home')" class="text-emerald-100 hover:text-white transition-colors">Beranda</Link>
                            <Link :href="route('visi-misi')" class="text-emerald-100 hover:text-white transition-colors">Visi & Misi</Link>
                            <span class="text-emerald-100/50 text-xs uppercase tracking-wider font-semibold mt-2 mb-1">Pendidikan</span>
                            <Link :href="route('sekolah.sma')" class="text-emerald-100 hover:text-white transition-colors pl-2">SMA Ksatria Nusantara</Link>
                            <Link :href="route('sekolah.smp')" class="text-emerald-100 hover:text-white transition-colors pl-2">SMP Dharma Ksatria</Link>
                            <Link :href="route('prestasi')" class="text-emerald-100 hover:text-white transition-colors">Prestasi</Link>
                            <Link :href="route('berita')" class="text-emerald-100 hover:text-white transition-colors">Berita</Link>
                            <Link :href="route('kontak')" class="text-emerald-100 hover:text-white transition-colors">Kontak</Link>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">Kontak</h3>
                        <div class="text-emerald-100 text-sm space-y-2">
                            <p>Jl. Raya Padaherang, Pangandaran</p>
                            <p>WhatsApp: +62 812-3456-7890</p>
                            <p>Email: info@riyadussalikin.sch.id</p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-emerald-800 mt-8 pt-8 text-center text-emerald-200 text-sm">
                    <p>&copy; {{ new Date().getFullYear() }} Pondok Pesantren Riyadussalikin Padaherang. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const mobileMenuOpen = ref(false);
const isDropdownOpen = ref(false);
const page = usePage();

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
</script>
