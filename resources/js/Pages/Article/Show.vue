<template>
<div class="grid grid-cols-1">
    <img :src="article.src" class="h-150 w-full rounded-md object-cover">
    <h2 class="font-bold text-2xl text-center my-6">{{ article.title }}</h2>
    <span>{{ article.users.name }}<br/>{{ article.updated_at }}</span>
    <p class="my-6 text-lg">{{ article.content }}</p>

    <div v-if="user">
        <hr/>
        <h3 class="font-bold text-lg py-3 mt-2">Comments</h3>
        <div v-if="refReplyContent" class="grid grid-cols-3 gap-4">
            <div class="col-span-2 text-sm border p-2 bg-green-200 rounded-md border-0 shadow-sm">
                <span class="font-bold">Reply to: </span><span class="italic">{{ refReplyContent }}</span>
            </div>
            <button @click="refReply = null; refReplyContent = null" class="btn-danger w-15">Clear</button>
        </div>
        <form @submit.prevent="create" class="mb-8">
            <div class="grid grid-cols-3 gap-4 mt-2">
                <div class="col-span-2">
                    <textarea class="input" rows="6" v-model="form.content"></textarea>
                </div>
            </div>
            <button type="submit" class="btn-primary mt-2">Add Comment</button>
        </form>
        <div v-for="comment in comments.data">
            <div>
                <b>{{ comment.users.name }}</b>
                <p>{{ comment.content }}</p>
                <span class="text-xs">{{ comment.updated_at }}</span>
                <br/>
                <button @click="toggleReply(comment)" class="btn-primary mt-2">Reply</button>
                <div v-if="comment.replies.length" class="pl-8">
                    <div v-for="commentReply in comment.replies" class="pt-2">
                        <b>{{ commentReply.name }}</b>
                        <p>{{ commentReply.content }}</p>
                        <span class="text-xs">{{ commentReply.updated_at }}</span>
                    </div>
                </div>
            </div>
            <br/>
        </div>
        <div v-if="comments.data.length">
            <Pagination :links="comments.links" />
        </div>
    </div>
</div>
</template>

<script setup>
import Pagination from "../../Components/UI/Pagination.vue";
import { reactive, computed, ref } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
let refReply = ref(null)
let refReplyContent = ref(null)
const page = usePage()

const props = defineProps({
    errors: Object,
    article: {
        type: Object,
        default: () => {}
    },
    comments: {
        type: Object,
        default: () => {}
    }
})

const form = reactive({
    content: null,
    article_id: props.article.id,
    comment_reply_id: refReply,
})

const user = computed(() => {
    return page.props.auth.user
})
const create = () => {
    router.post('/comments', form)
    form.content = null
}

function toggleReply(value){
    refReply.value = value.id
    refReplyContent.value = `${value.users.name} - ${value.content}`
}
</script>