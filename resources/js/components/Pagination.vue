<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import Pagination from './Pagination.vue';
import { InertiaLink } from '@inertiajs/inertia-vue3';

components: { Pagination }
defineProps(['links'])

</script>
<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap mt-8">
            <template v-for="(link, key) in links" :key="key">
                <div v-if="link.url === null"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 hover:bg-blue  text-gray-400 border rounded"
                    :v-html="link.label">
                </div>
                <Link v-else
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded focus:border-primary focus:text-primary"
                    :class="{ 'bg-blue-700 text-white': link.active }" :href="link.url" v-html="link.label">
                </Link>

            </template>
        </div>
    </div>
</template>
