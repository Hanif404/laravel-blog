<template>
    <div>
        <Filters :filters="filters"/>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <box v-for="article in articles.data">
            <div>
                <Link :href="`/articles/${article.id}`" >
                    <img :src="article.src" class="h-65 w-150 object-cover rounded-md">
                    <h3 class="font-bold py-2">{{ article.title }}</h3>
                    <span class="text-sm">{{ article.users.name }}</span>
                </Link>
            </div>
        </box>
    </div>
    
    <div v-if="articles.data.length" class="w-full flex justify-center mt-8 mb-8">
        <Pagination :links="articles.links" />
    </div>
</template>

<script setup>
    import Box from '@/Components/UI/Box.vue'
    import { Link } from "@inertiajs/vue3";
    import Pagination from "../../Components/UI/Pagination.vue";
    import Filters from "../../Components/UI/Filters.vue";
    defineProps({
        articles: Object,
        filters: Object,
    })
</script>