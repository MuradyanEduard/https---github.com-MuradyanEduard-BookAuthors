<script setup>
import AuthorComponent from '../../components/AuthorComponent.vue';
import NavBarComponent from '../../components/NavBarComponent.vue';

const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
components: { AuthorComponent, NavBarComponent }
defineProps(['user', 'author', 'messages', 'errors'])


$(document).ready(function () {
    $('.js-example-basic-multiple').select2({
        width: '100%'
    });

    $(".js-example-basic-multiple option").each(function () {
        $(this).siblings('[value="' + this.value + '"]').remove();
    });
});


</script>

<template>
    <NavBarComponent :user="user" />
    <div class="m-auto max-w-[80%] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-wrap justify-center">
            <AuthorComponent v-if="user.role == 2" :author="author" :ediatable="false" :showable="false" />
            <AuthorComponent v-else :author="author" :ediatable="true" :showable="false" />
        </div>

    </div>
</template>


