<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';
import { Html5QrcodeScanner } from "html5-qrcode";

const scanner = ref(null);
const scanResult = ref(null);
const isScanning = ref(true);

const onScanSuccess = (decodedText, decodedResult) => {
    // Berhenti scan setelah sukses
    isScanning.value = false;
    scanResult.value = decodedText;
    
    // Redirect ke URL verifikasi yang ada di QR
    // URL QR sudah lengkap dengan token: http://192.168.1.8:8000/verifikasi/REG-xxx?token=xxx
    window.location.href = decodedText;
};

const onScanFailure = (error) => {
    // console.warn(`Code scan error = ${error}`);
};

onMounted(() => {
    const config = { 
        fps: 10, 
        qrbox: { width: 250, height: 250 },
        aspectRatio: 1.0
    };
    
    scanner.value = new Html5QrcodeScanner("reader", config, false);
    scanner.value.render(onScanSuccess, onScanFailure);
});

onUnmounted(() => {
    if (scanner.value) {
        scanner.value.clear();
    }
});
</script>

<template>
    <Head title="Scan QR Verifikasi" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-bold leading-tight text-emerald-800 dark:text-emerald-200 uppercase tracking-tight">
                Sistem Scan Verifikasi QR
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-2xl sm:rounded-3xl border border-emerald-50">
                    <div class="p-8">
                        <div class="text-center mb-8">
                            <div class="inline-flex p-3 bg-emerald-50 rounded-2xl mb-4">
                                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-black text-slate-800 uppercase tracking-tighter italic">Pindai Kartu Peserta</h3>
                            <p class="text-sm text-slate-500 font-medium mt-1 uppercase tracking-widest text-[10px]">Arahkan kamera ke QR Code pada kartu</p>
                        </div>

                        <!-- Scanner Area -->
                        <div id="reader" class="overflow-hidden rounded-2xl border-4 border-emerald-100 shadow-inner bg-slate-50"></div>

                        <div v-if="!isScanning" class="mt-8 text-center p-4 bg-emerald-50 rounded-2xl border border-emerald-100">
                            <div class="flex items-center justify-center gap-2 text-emerald-700 font-black text-sm uppercase italic">
                                <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Mengalihkan ke data peserta...
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-slate-100 flex items-center gap-4 text-slate-400">
                            <div class="flex-1 h-px bg-slate-100"></div>
                            <span class="text-[9px] font-black uppercase tracking-[0.3em]">Instruksi Keamanan</span>
                            <div class="flex-1 h-px bg-slate-100"></div>
                        </div>
                        
                        <ul class="mt-4 text-[10px] text-slate-400 font-bold space-y-2 uppercase leading-relaxed italic px-4">
                            <li class="flex items-start gap-2">
                                <span class="text-emerald-500">•</span>
                                Pastikan pencahayaan cukup saat melakukan pemindaian.
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-emerald-500">•</span>
                                Hanya Admin yang memiliki akses ke data hasil pemindaian.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Menghapus branding default dari library scanner agar lebih bersih */
#reader :deep(img) {
    display: none !important;
}
#reader :deep(button) {
    @apply mt-4 px-6 py-2 bg-emerald-600 text-white rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100 border-none cursor-pointer;
}
#reader :deep(select) {
    @apply mt-2 px-3 py-1 bg-white border border-slate-200 rounded-lg text-[10px] font-bold text-slate-600 outline-none;
}
#reader :deep(#html5-qrcode-anchor-scan-type-change) {
    @apply text-emerald-600 font-black text-[10px] uppercase tracking-tighter mt-4 inline-block no-underline;
}
</style>
