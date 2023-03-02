<script setup>
import { Link } from '@inertiajs/vue3';
import BookComponent from '../../components/BookComponent.vue';
import NavBarComponent from '../../components/NavBarComponent.vue';
import Pagination from '../../components/Pagination.vue'

const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
components: { BookComponent, NavBarComponent }
defineProps(['books', 'user', 'basket', 'messages'])

</script>


<template>
    <NavBarComponent :user="user" :searchType="0" />


    <div class="m-auto max-w-[80%] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div v-if="errors" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative"
            role="alert">
            <span class="block sm:inline">
                <div class="col-12">
                    <div v-for="error in errors" class="alert alert-danger">
                        {{ error }}
                    </div>
                </div>
            </span>
        </div>

        <div class="flex flex-wrap justify-start">
            <div v-for="book in books.data">
                <BookComponent v-if="user.role == 2" :book="book" :ediatable="false" :showable="true" :basket="true" />
                <BookComponent v-else :book="book" :ediatable="true" :showable="true" :basket="false" />
            </div>
        </div>

        <div class="w-full h-[80px] m-auto mt-3 mb-3 flex justify-center">
            <div class="pagination-block">
                <Pagination :links="books.links" />
            </div>
        </div>

    </div>



    <div v-if="user.role == 2" id="basket-container">
        <button id="basket-button" type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <i class="fa fa-shopping-cart m-auto" aria-hidden="true"></i>
        </button>
        <div id="basket-window">
            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Your Basket:</h2>

            <div v-if="basket">
                <ul v-for="book in basket">
                    <li>
                        <span class="font-semibold text-gray-900 dark:text-white">Book: {{ book['title'] }}</span>
                    </li>
                    <li>
                        <span class="font-semibold text-gray-900 dark:text-white">Count:{{ book['count'] }}</span>
                    </li>
                    <li>
                        <span class="font-semibold text-gray-900 dark:text-white">Price:{{ book['price'] }}</span>
                    </li>

                    <Link href="/order/remove" :data="{ id: book.id }" preserve-state method="POST"
                        class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Remove <i class="fa fa-trash w-4 h-4 ml-2 -mr-1" aria-hidden="true"></i>
                    </Link>
                </ul>
            </div>

            <div class="flex flex-wrap justify-end">
                <Link href="/order/confirm" method="GET"
                    class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Buy <i class="fa fa-shopping-cart w-4 h-4 ml-2 -mr-1" aria-hidden="true"></i>
                </Link>
            </div>
        </div>
    </div>
</template>

