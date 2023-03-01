<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <!-- Navbar -->
    <Link :href="route('book.index')"
        class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Book
    <i class="fa fa-eye w-4 h-4 ml-2 -mr-1" aria-hidden="true"></i>
    </Link>
    <Link :href="route('book.create')"
        class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Book create
    <i class="fa fa-eye w-4 h-4 ml-2 -mr-1" aria-hidden="true"></i>
    </Link>
    <Link :href="route('author.index')"
        class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Author
    <i class="fa fa-eye w-4 h-4 ml-2 -mr-1" aria-hidden="true"></i>
    </Link>
    <Link :href="route('author.create')"
        class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Author create
    <i class="fa fa-eye w-4 h-4 ml-2 -mr-1" aria-hidden="true"></i>
    </Link>
    <!-- Navbar -->
</template>


<style scoped>
.btn-close {
    background-color: red;
}
</style>
