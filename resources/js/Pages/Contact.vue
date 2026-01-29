<template>
    <Head title="Hubungi Kami" />
    <MainLayout>
        <!-- Hero Section -->
        <section class="relative bg-emerald-900 py-24 overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
                </svg>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-emerald-800 text-emerald-300 text-sm font-semibold mb-4 border border-emerald-700">
                    Layanan Informasi
                </span>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
                    Hubungi Kami
                </h1>
                <p class="text-xl text-emerald-100 max-w-2xl mx-auto leading-relaxed">
                    Kami siap mendengarkan dan membantu Anda dengan segala informasi yang dibutuhkan mengenai pesantren.
                </p>
            </div>
        </section>

        <!-- Contact Info & Form -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Contact Info -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Kontak</h2>
                        
                        <div class="space-y-6">
                            <div class="card flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-emerald-100 w-12 h-12 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-1">Alamat</h3>
                                    <p class="text-gray-600">Jl. Raya Padaherang No. 123<br>Padaherang, Pangandaran<br>Jawa Barat 46396</p>
                                </div>
                            </div>

                            <div class="card flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-emerald-100 w-12 h-12 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-1">WhatsApp</h3>
                                    <a href="https://wa.me/6281234567890" target="_blank" class="text-emerald-600 hover:text-emerald-700 font-semibold">
                                        +62 812-3456-7890
                                    </a>
                                </div>
                            </div>

                            <div class="card flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-emerald-100 w-12 h-12 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-1">Email</h3>
                                    <a href="mailto:info@riyadussalikin.sch.id" class="text-emerald-600 hover:text-emerald-700 font-semibold">
                                        info@riyadussalikin.sch.id
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Google Maps -->
                        <div class="mt-8 card p-0 overflow-hidden">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.56211042117!2d108.48967!3d-7.7145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e659c7a1e0f8b8d%3A0x5027a76e356a0!2sPadaherang%2C%20Pangandaran%20Regency%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1234567890"
                                width="100%" 
                                height="300" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                            ></iframe>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>
                        
                        <div v-if="$page.props.flash?.success" class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                            {{ $page.props.flash.success }}
                        </div>

                        <form @submit.prevent="submitForm" class="card">
                            <div class="space-y-6">
                                <div>
                                    <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        v-model="form.nama"
                                        type="text" 
                                        id="nama" 
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                                        placeholder="Masukkan nama lengkap Anda"
                                    />
                                    <p v-if="form.errors.nama" class="mt-1 text-sm text-red-600">{{ form.errors.nama }}</p>
                                </div>

                                <div>
                                    <label for="whatsapp" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nomor WhatsApp <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        v-model="form.whatsapp"
                                        type="tel" 
                                        id="whatsapp" 
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                                        placeholder="Contoh: 081234567890"
                                    />
                                    <p v-if="form.errors.whatsapp" class="mt-1 text-sm text-red-600">{{ form.errors.whatsapp }}</p>
                                </div>

                                <div>
                                    <label for="pesan" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Pesan <span class="text-red-500">*</span>
                                    </label>
                                    <textarea 
                                        v-model="form.pesan"
                                        id="pesan" 
                                        rows="5" 
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                                        placeholder="Tuliskan pesan atau pertanyaan Anda"
                                    ></textarea>
                                    <p v-if="form.errors.pesan" class="mt-1 text-sm text-red-600">{{ form.errors.pesan }}</p>
                                </div>

                                <button 
                                    type="submit" 
                                    :disabled="form.processing"
                                    class="w-full btn-primary disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    <span v-if="form.processing">Mengirim...</span>
                                    <span v-else>Kirim Pesan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import MainLayout from '../Layouts/MainLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';

const form = useForm({
    nama: '',
    whatsapp: '',
    pesan: ''
});

const submitForm = () => {
    form.post(route('kontak.store'), {
        onSuccess: () => {
            form.reset();
        }
    });
};
</script>
