<template>
    <form @submit.prevent="login">
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
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <Link href="/registration">Need an account? Click Here</Link> 
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