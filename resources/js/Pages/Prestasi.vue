<template>
    <MainLayout>
        <!-- Header -->
        <section class="bg-gradient-to-r from-emerald-600 to-emerald-700 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Prestasi</h1>
                <p class="text-xl text-emerald-100">
                    Pencapaian Santri dan Lembaga Pondok Pesantren Riyadussalikin
                </p>
            </div>
        </section>

        <!-- Filter Section -->
        <section class="py-8 bg-white border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row gap-4">
                    <select 
                        v-model="selectedKategori" 
                        @change="filterPrestasi"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    >
                        <option value="semua">Semua Kategori</option>
                        <option value="akademik">Akademik</option>
                        <option value="non_akademik">Non-Akademik</option>
                        <option value="keagamaan">Keagamaan</option>
                    </select>

                    <select 
                        v-model="selectedTahun" 
                        @change="filterPrestasi"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    >
                        <option value="">Semua Tahun</option>
                        <option v-for="tahun in tahunList" :key="tahun" :value="tahun">{{ tahun }}</option>
                    </select>
                </div>
            </div>
        </section>

        <!-- Prestasi List -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div v-if="Object.keys(prestasi).length === 0" class="text-center py-12">
                    <p class="text-gray-500 text-lg">Belum ada data prestasi</p>
                </div>

                <div v-else class="space-y-12">
                    <div v-for="(items, kategori) in prestasi" :key="kategori">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <span 
                                class="w-2 h-8 rounded-full mr-3"
                                :class="{
                                    'bg-green-500': kategori === 'akademik',
                                    'bg-blue-500': kategori === 'non_akademik',
                                    'bg-purple-500': kategori === 'keagamaan'
                                }"
                            ></span>
                            {{ kategori === 'akademik' ? 'Akademik' : kategori === 'non_akademik' ? 'Non-Akademik' : 'Keagamaan' }}
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div v-for="item in items" :key="item.id" class="card hover:shadow-xl transition-shadow">
                                <div class="flex items-start justify-between mb-3">
                                    <span 
                                        class="px-3 py-1 rounded-full text-xs font-semibold"
                                        :class="{
                                            'bg-green-100 text-green-800': kategori === 'akademik',
                                            'bg-blue-100 text-blue-800': kategori === 'non_akademik',
                                            'bg-purple-100 text-purple-800': kategori === 'keagamaan'
                                        }"
                                    >
                                        {{ item.tingkat }}
                                    </span>
                                    <span class="text-sm font-bold text-emerald-600">{{ item.tahun }}</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ item.judul }}</h3>
                                <p v-if="item.deskripsi" class="text-sm text-gray-600">{{ item.deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import MainLayout from '../Layouts/MainLayout.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    prestasi: {
        type: Object,
        default: () => ({})
    },
    tahunList: {
        type: Array,
        default: () => []
    },
    filters: {
        type: Object,
        default: () => ({ kategori: 'semua', tahun: '' })
    }
});

const selectedKategori = ref(props.filters.kategori);
const selectedTahun = ref(props.filters.tahun);

const filterPrestasi = () => {
    router.get(route('prestasi'), {
        kategori: selectedKategori.value,
        tahun: selectedTahun.value
    }, {
        preserveState: true,
        preserveScroll: true
    });
};
</script>
