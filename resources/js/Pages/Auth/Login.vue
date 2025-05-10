<template>
    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="email" class="label">E-mail</label>
                <input id="email" v-model="form.email" type="text" class="input" />
                <div v-if="errors.email" class="error-field">{{ errors.email }}</div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input id="password" v-model="form.password" type="password" class="input" />
                <div v-if="errors.password" class="error-field">{{ errors.password }}</div>
            </div>
            <div class="mt-4">
                <button class="btn-primary w-full" type="submit">Login</button>

                <div class="mt-2 text-center">
                <Link href="/registration" class="text-sm text-gray-500">
                    Need an account? Click here
                </Link>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
    import { reactive } from 'vue'
    import { Link, router } from '@inertiajs/vue3'

    defineProps({ errors: Object })

    const form = reactive({
        email: null,
        password: null
    })

    const login = () => router.post('/login', form)
</script>