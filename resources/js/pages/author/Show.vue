<script setup>
import AuthorComponent from '../../components/AuthorComponent.vue';

const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
components: { AuthorComponent }
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
    <div
        class="m-auto  max-w-[80%] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <AuthorComponent class="m-auto mt-5 mb-5" :author="author" :ediatable="true" :showable="false" />
    </div>
</template>


