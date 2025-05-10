<template>
    <div>
        <form @submit.prevent="registration">
            <div class="w-1/2 mx-auto">
                <div>
                    <label for="name" class="label">Name</label>
                    <input
                    id="name" v-model="form.name" type="text"
                    class="input"
                    />
                    <div v-if="errors.name" class="error-field">
                    {{ errors.name }}
                    </div>
                </div>
                <div class="mt-4">
                    <label for="email" class="label">E-mail</label>
                    <input
                    id="email" v-model="form.email" type="text"
                    class="input"
                    />
                    <div v-if="errors.email" class="error-field">
                    {{ errors.email }}
                    </div>
                </div>
                <div class="mt-4">
                    <label for="password" class="label">Password</label>
                    <input
                    id="password" v-model="form.password"
                    type="password" class="input"
                    />
                    <div
                    v-if="errors.password"
                    class="error-field"
                    >
                    {{ errors.password }}
                    </div>
                </div>
                <div class="mt-4">
                    <label for="password_confirmation" class="label">Confirm Password</label>
                    <input
                    id="password_confirmation" v-model="form.password_confirmation"
                    type="password" class="input"
                    />
                </div>
                <div class="mt-4">
                    <button
                    class="btn-primary w-full"
                    type="submit"
                    >
                    Create Account
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
    import { reactive } from 'vue'
    import { Link, router } from '@inertiajs/vue3'

    defineProps({ errors: Object })

    const form = reactive({
        name: null,
        email: null,
        password: null,
        password_confirmation: null
    })

    const registration = () => router.post('/registration', form)
</script>