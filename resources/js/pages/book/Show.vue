<script setup>
import BookAuthorComponent from '../../components/BookAuthorComponent.vue';

const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
components: { BookAuthorComponent }
defineProps(['user', 'book', 'messages', 'errors'])


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
        <BookAuthorComponent class="m-auto mt-5 mb-5" :book="book" :ediatable="true" :showable="false"
            :basketAdable="false" />
    </div>
</template>


