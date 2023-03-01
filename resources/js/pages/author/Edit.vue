<script setup>
import NavBarComponent from '../../components/NavBarComponent.vue';

const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
components: { NavBarComponent }
defineProps(['author', 'books', 'user', 'messages', 'errors'])

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

    <div class="m-auto max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div v-for="m in messages"
            class="p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium"> {{ m }} </span>
        </div>
        <a href="#">
            <img class="rounded-t-lg" src="/images/author.jpeg" alt="" />
        </a>
        <div class="p-5">
            <form id="form-edit" :action="route('author.update', author)" method="POST">
                <input type="hidden" name="_token" :value=csrf>
                <input type="hidden" name="_method" value="PUT">
                <div class="mb-3">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Author
                        Name</label>
                    <input type="text" id="name" name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" required :value="author.name">
                </div>

                <div v-if="errors.name"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative" role="alert">
                    <span class="block sm:inline">
                        <div class="col-12">
                            <div class="alert alert-danger">
                                {{ errors.name }}
                            </div>
                        </div>
                    </span>
                </div>
                <h2 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Books:</h2>
                <select class="js-example-basic-multiple" name="books[]" multiple="multiple">
                    <option v-for="book in author.books" :value="book.id" selected>{{ book.title }}</option>
                    <option v-for="book in books" :value=book.id>{{ book.title }}</option>
                </select>
                <div v-if="errors.books"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative" role="alert">
                    <span class="block sm:inline">
                        <div class="col-12">
                            <div class="alert alert-danger">
                                {{ errors.books }}
                            </div>
                        </div>
                    </span>
                </div>

                <a href="#" onclick="event.preventDefault(); document.getElementById('form-edit').submit();"
                    class="mt-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Edit
                    <i class="fa fa-edit w-4 h-4 ml-2 -mr-1"></i>
                    <input type="submit" value=" ">
                </a>
            </form>

        </div>
    </div>
</template>


