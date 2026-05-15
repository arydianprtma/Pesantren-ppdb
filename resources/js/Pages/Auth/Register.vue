<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Buat Akun PPDB" />

        <div class="mb-8 text-center">
            <h2 class="text-2xl font-black text-gray-900">Buat Akun Baru</h2>
            <p class="text-sm text-gray-500 mt-2">Silakan buat akun pendaftar terlebih dahulu untuk melanjutkan pengisian formulir PPDB.</p>
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Nama Lengkap Orang Tua / Wali" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Contoh: Bpk. Abdullah"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Alamat Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500"
                    v-model="form.email"
                    required
                    autocomplete="username"
                    placeholder="email@contoh.com"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Kata Sandi" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Konfirmasi Kata Sandi"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="mt-8 flex flex-col gap-4 items-center">
                <PrimaryButton
                    class="w-full justify-center py-3 bg-emerald-600 hover:bg-emerald-700 rounded-xl text-base shadow-lg shadow-emerald-100"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Daftar Akun
                </PrimaryButton>

                <div class="text-sm text-gray-600">
                    Sudah punya akun?
                    <Link
                        :href="route('login')"
                        class="font-bold text-emerald-600 hover:text-emerald-700 underline underline-offset-4"
                    >
                        Masuk di sini
                    </Link>
                </div>
            </div>
        </form>
    </GuestLayout>
</template>
