<template>
    <form @submit.prevent="filter">
        <div class="mb-8 mt-4 flex flex-wrap gap-2">
            

            <div class="flex flex-nowrap items-center">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="label">Search</label>
                        <input type="text" placeholder="Search" class="input w-100" v-model="filterForm.search"/>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 ml-2">
                    <div class="col-span-2">
                        <label class="label">Sort</label>
                        <select class="input w-28 pr-2" v-model="filterForm.sort">
                            <option value="desc">Terbaru</option>
                            <option value="asc">Terlama</option>
                        </select>
                    </div>
                </div>
                <div class="pt-7 ml-4">
                    <button type="submit" class="btn-primary mr-4">Filter</button>
                    <button type="reset" @click="clear">Reset</button>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  filters: Object,
})

const filterForm = reactive({
    search: props.filters.search ?? null,
    sort: props.filters.sort ?? 'desc'
})

const filter = () => router.get('/articles', filterForm)
const clear = () => {
  filterForm.search = null
  filterForm.sort = 'desc'
  filter()
}
</script>