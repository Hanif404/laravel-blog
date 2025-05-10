<template>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full">
        <div class="container mx-auto">
        <nav class="p-4 flex items-center justify-between">
            <div class="text-lg font-medium">
                <Link href="/articles">Home</Link>
            </div>
            <div>
                <div v-if="user">
                    Welcome, <span class="font-bold">{{ user.name }}</span> | <Link href="/user/articles">My Article</Link> | 
                    <Link href="/logout" method="DELETE" as="button">Logout</Link>
                </div>
                <div v-else>
                    <Link href="/login">Login</Link>
                </div>
            </div>
        </nav>
        </div>
    </header>
    <main class="container mx-auto p-4">
        <div v-if="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
        {{ flashSuccess }}
        </div>
        <slot></slot>
    </main>
</template>

<script setup>
    import { computed } from 'vue'
    import { Link, usePage } from "@inertiajs/vue3";
    const page = usePage()
    const flashSuccess = computed(() => {
        return page.props.flash.success
    })
    const user = computed(() => {
        return page.props.auth.user
    })
</script>