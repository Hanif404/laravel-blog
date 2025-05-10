<template>
    <h1 class="font-bold text-2xl mb-5">Edit Article</h1>
    <form @submit.prevent="update">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Title</label>
                <input type="text" v-model="form.title" placeholder="Enter title" class="input"/>
                <div v-if="props.errors.title" class="error-field">
                    {{ props.errors.title }}
                </div>
            </div>
        </div>
        <div class="grid grid-cols-6 gap-4 mt-2">
            <div class="col-span-2">
                <label class="label">Content</label>
                <textarea rows="3" v-model="form.content" class="input"></textarea>
                <div v-if="props.errors.content" class="error-field">
                    {{ props.errors.content }}
                </div>
            </div>
        </div>
        <button type="submit" class="btn-primary mt-3">Submit</button>
    </form>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({ errors: Object, article: Object })

const form = reactive({
    title: props.article.title,
    content: props.article.content
})

const update = () => router.put(`/articles/${props.article.id}`, form)
</script>