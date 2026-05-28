<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Masuk Akun PPDB" />

        <div class="mb-8 text-center">
            <h2 class="text-2xl font-black text-gray-900">Masuk Akun</h2>
            <p class="text-sm text-gray-500 mt-2">Silakan masuk untuk melanjutkan pendaftaran atau memantau status santri.</p>
        </div>

        <div v-if="status" class="mb-4 text-sm font-medium text-emerald-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Alamat Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500"
                    v-model="form.email"
                    required
                    autofocus
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
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 flex items-center justify-between">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
                </label>

                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="text-sm text-emerald-600 hover:text-emerald-700 font-medium"
                >
                    Lupa Kata Sandi?
                </Link>
            </div>

            <div class="mt-8 flex flex-col gap-4 items-center">
                <PrimaryButton
                    class="w-full justify-center py-3 bg-emerald-600 hover:bg-emerald-700 rounded-xl text-base shadow-lg shadow-emerald-100"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Masuk
                </PrimaryButton>

                <div v-if="canRegister" class="text-sm text-gray-600">
                    Belum punya akun?
                    <Link
                        :href="route('register')"
                        class="font-bold text-emerald-600 hover:text-emerald-700 underline underline-offset-4"
                    >
                        Daftar di sini
                    </Link>
                </div>
            </div>
        </form>
    </GuestLayout>
</template>
