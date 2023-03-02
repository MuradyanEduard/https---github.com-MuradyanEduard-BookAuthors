<script setup>
import AuthorComponent from '../../components/AuthorComponent.vue';
import NavBarComponent from '../../components/NavBarComponent.vue';
import Pagination from '../../components/Pagination.vue'

const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
components: { AuthorComponent, NavBarComponent }
defineProps(['authors', 'user', 'basket', 'messages'])

</script>

<template>
    <NavBarComponent :user="user" :searchType="1" />
    <div class="m-auto max-w-[80%] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-wrap justify-start">
            <div v-for="author in authors.data">
                <AuthorComponent v-if="user.role == 2" :author="author" :ediatable="false" :showable="true"
                    :basketAdable="true" />
                <AuthorComponent v-else :author="author" :ediatable="true" :showable="true" />
            </div>
        </div>

        <div class="w-full h-[80px] m-auto mt-3 mb-3 flex justify-center">
            <div class="pagination-block">
                <Pagination :links="authors.links" />
            </div>
        </div>

    </div>
</template>

