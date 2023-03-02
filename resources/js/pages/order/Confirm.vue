<script setup>
import { Link } from '@inertiajs/vue3';
import BookComponent from '../../components/BookComponent.vue';
import NavBarComponent from '../../components/NavBarComponent.vue';
import Pagination from '../../components/Pagination.vue'

const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
components: { BookComponent, NavBarComponent, Pagination }
defineProps(['basket','totalPrice', 'user','messages'])

let totalsum = 0;

</script>


<template>
    <NavBarComponent :user="user" />

    <div class="m-auto max-w-[80%] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="p-10">

            <div v-if="messages" class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <span v-for="message in messages" class="font-medium">{{ message }}</span>
            </div>
            <div v-else class="m-auto mb-10 w-[50%]">
                <div v-for="card in basket">
                    <h5 class="mb-2 text-xl font-bold dark:text-white">Book: <span class="ml-2">
                        {{ card.book['title'] }}</span></h5>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Author Name
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="author in card.book.authors" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td  class="px-6 py-4">
                                {{ author.name}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <Link href="/order/remove" :data="{ id: card.book.id, fromOrder:true }" preserve-state method="POST"
                                    class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Remove <i class="fa fa-trash w-4 h-4 ml-2 -mr-1" aria-hidden="true"></i>
                                </Link>

                                <h5 class="mt-2 text-right text-xl font-bold dark:text-white">
                                    Count: <span class="ml-2">{{ card.basket.count }}</span>
                                    <span class="ml-5">Price:</span>
                                    <span class="ml-2">{{ card.basket.count*card.basket.price }}</span>
                                </h5>
                            </td>
                        </tr>
                    </tbody>
                </table>

                </div>

                <div class=" mt-10">
                    <div class="w-full flex justify-end">
                        <h5 class="mt-2 text-right text-xl font-bold dark:text-white">Total Price: <span class="ml-2">
                        {{ totalPrice }}</span></h5>
                    </div>
                    <div class="w-full flex justify-end">
                        <Link href="/order/store" method="POST"
                    class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Buy <i class="fa fa-shopping-cart w-4 h-4 ml-2 -mr-1" aria-hidden="true"></i>
                </Link>

                    </div>

                </div>
            </div>


        </div>

        <!-- <div class="w-full h-[80px] m-auto mt-3 mb-3 flex justify-center">
            <div class="pagination-block">
                <Pagination :links="orders.links" />
            </div>
        </div> -->
    </div>
</template>

