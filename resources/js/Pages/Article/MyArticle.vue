<template>
    <h1 class="font-bold text-2xl">My Article List</h1>
    <div v-if="user" class="my-6">
        <Link :href="`/articles/create`" class="bg-indigo-600 hover:bg-indigo-500 text-white font-medium p-2 rounded-md">Add Article</Link>
    </div>

    <div>
        <Filters :filters="filters"/>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <box v-for="article in articles.data">
            <div>
                <Link :href="`/articles/${article.id}`" >
                    <img :src="article.src" class="h-65 w-full object-cover rounded-md">
                    <h3 class="font-bold py-2">{{ article.title }}</h3>
                </Link>
                <div v-if="user">
                    <Link :href="`/articles/${article.id}/edit`" class="btn-primary mr-2">Edit</Link> 
                    <Link :href="`/articles/${article.id}`" method="DELETE" as="button" class="btn-danger">Delete</Link>
                </div>
            </div>
        </box>
    </div>

    <div v-if="articles.data.length" class="w-full flex justify-center mt-8 mb-8">
        <Pagination :links="articles.links" />
    </div>
</template>

<script setup>
    import Box from '@/Components/UI/Box.vue';
    import Pagination from "../../Components/UI/Pagination.vue";
    import Filters from "../../Components/UI/Filters.vue";
    import { computed } from 'vue'
    import { Link, usePage } from "@inertiajs/vue3";
    
    defineProps({
        articles: Array,
        filters: Object,
    })
    const page = usePage()
    const user = computed(() => {
        return page.props.auth.user
    })
</script>