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

            <!-- <div class="form-group">
                <label for="name">Name</label>
                <div v-if="errors.name" class="text-danger">{{ errors.name }}</div>
                <input type="name" v-model="form.name" class="form-control" id="name" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <div v-if="errors.email" class="text-danger">{{ errors.email }}</div>
                <input type="email"  v-model="form.email" class="form-control" id="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div v-if="errors.password" class="text-danger">{{ errors.password }}</div>
                <input type="password" v-model="form.password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <div v-if="errors.password" class="text-danger">{{ errors.password_confirmation }}</div>
                <input type="password" v-model="form.password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password">
            </div>

            <button type="submit">Register</button> -->
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