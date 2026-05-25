<template>
    <section class="py-16 md:py-24 bg-gradient-to-br from-emerald-950 via-emerald-900 to-teal-950 relative overflow-hidden">
        <!-- Decorative Background Glows -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-emerald-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-teal-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-emerald-600/5 rounded-full blur-3xl pointer-events-none"></div>
        
        <!-- Subtle Pattern Overlay -->
        <div class="absolute inset-0 bg-[radial-gradient(rgba(16,185,129,0.08)_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Glass Card Container -->
            <div class="relative rounded-3xl border border-white/10 bg-white/[0.03] backdrop-blur-md p-8 md:p-16 text-center shadow-2xl overflow-hidden group">
                <!-- Card Inner Glow -->
                <div class="absolute -inset-x-20 -top-40 h-80 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>

                <!-- Badge -->
                <div class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-emerald-500/10 text-emerald-300 text-xs font-bold uppercase tracking-wider border border-emerald-500/20 mb-6 shadow-xs">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    {{ badgeText }}
                </div>

                <!-- Headline -->
                <h2 class="text-3xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-white via-emerald-100 to-yellow-100 tracking-tight leading-tight mb-4 drop-shadow-md">
                    {{ title }}
                </h2>

                <!-- Description -->
                <p class="text-base md:text-lg text-emerald-100/80 mb-10 max-w-2xl mx-auto leading-relaxed">
                    {{ description }}
                </p>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <!-- Primary Button -->
                    <a 
                        :href="spmbUrl" 
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-400 hover:to-teal-500 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-emerald-500/30 hover:scale-[1.03] hover:-translate-y-0.5 active:scale-[0.98] group/btn"
                    >
                        <span>Daftar Sekarang</span>
                        <svg 
                            class="w-5 h-5 transition-transform duration-300 group-hover/btn:translate-x-1" 
                            fill="none" 
                            stroke="currentColor" 
                            viewBox="0 0 24 24" 
                            stroke-width="2"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>

                    <!-- Secondary Button -->
                    <Link 
                        v-if="showContactBtn"
                        :href="route('kontak')" 
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 border border-white/20 hover:border-white/40 hover:bg-white/[0.05] text-white font-semibold py-4 px-8 rounded-xl transition-all duration-300 backdrop-blur-xs active:scale-[0.98]"
                    >
                        <svg class="w-5 h-5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.28-5.116-3.573-6.397-8.397l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                        <span>Hubungi Kami</span>
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    badgeText: {
        type: String,
        default: 'Penerimaan Santri Baru (SPMB)'
    },
    title: {
        type: String,
        default: 'Bergabunglah Bersama Kami'
    },
    description: {
        type: String,
        default: 'Daftarkan putra-putri Anda untuk menjadi bagian dari keluarga besar Pondok Pesantren Riyadussalikin'
    },
    showContactBtn: {
        type: Boolean,
        default: true
    }
});

const spmbUrl = computed(() => {
    // In local development with IP or localhost, use local port 8001
    if (window.location.hostname.startsWith('192.168.') || window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
        return `http://${window.location.hostname}:8001/login`;
    }
    // Default to production URL
    return 'https://spmb.riyadussalikin.my.id/login';
});
</script>
