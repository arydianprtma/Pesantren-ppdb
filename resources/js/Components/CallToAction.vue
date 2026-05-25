<template>
    <section class="py-16 text-center relative" :class="bgClass">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Headline -->
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ title }}
            </h2>

            <!-- Description -->
            <p class="text-gray-600 text-base md:text-lg mb-8 max-w-2xl mx-auto leading-relaxed">
                {{ description }}
            </p>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <!-- Primary Button -->
                <a 
                    :href="spmbUrl" 
                    class="w-full sm:w-auto bg-emerald-750 text-white hover:bg-emerald-850 font-bold py-3.5 px-8 rounded-lg inline-block transition-colors duration-300 shadow-sm"
                    style="background-color: #047857;"
                    onmouseover="this.style.backgroundColor='#065f46'"
                    onmouseout="this.style.backgroundColor='#047857'"
                >
                    Daftar Sekarang
                </a>

                <!-- Secondary Button -->
                <Link 
                    v-if="showContactBtn"
                    :href="route('kontak')" 
                    class="w-full sm:w-auto border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold py-3.5 px-8 rounded-lg inline-block transition-colors duration-300"
                >
                    Hubungi Kami
                </Link>
            </div>
        </div>
    </section>
</template>

<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
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
    },
    bgClass: {
        type: String,
        default: 'bg-transparent'
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
