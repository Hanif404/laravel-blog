<template>
    <h1 class="font-bold text-2xl mb-5">Add Article</h1>
    <form @submit.prevent="create">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Title</label>
                <input type="text" v-model="form.title" placeholder="Enter title" class="input" />
                <div v-if="errors.title" class="error-field">
                {{ errors.title }}
                </div>
            </div>
        </div>
        <div class="grid grid-cols-6 gap-4 mt-2">
            <div class="col-span-2">
                <label class="label">Image</label>
                <input type="file" placeholder="Enter image" @input="addFiles" class="input" />
                <div v-if="errors.image" class="error-field">
                {{ errors.image }}
                </div>
            </div>
        </div>
        <div class="grid grid-cols-6 gap-4 mt-2">
            <div class="col-span-2">
                <label class="label">Content</label>
                <textarea rows="3" v-model="form.content" class="input"></textarea>
                <div v-if="errors.content" class="error-field">
                {{ errors.content }}
                </div>
            </div>
        </div>
        <button type="submit" class="btn-primary mt-3">Submit</button>
    </form>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({ errors: Object })

const form = reactive({
    title: null,
    content: null,
    images: null,
})

const addFiles = (event) => {
    form.images = event.target.files
}

const create = () => router.post('/articles', form)
</script>