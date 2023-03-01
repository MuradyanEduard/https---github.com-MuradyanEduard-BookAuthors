<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    book: {
        type: Object,
        default: {},
    },
    ediatable: {
        type: Boolean,
        default: false,
    },
    showable: {
        type: Boolean,
        default: false,
    },
    basketAdable: {
        type: Boolean,
        default: false,
    },
    imgurl: {
        type: String,
        default: 'images/book.jpg',
    }
})

const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

</script>

<template>
    <div class="m-5 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <img class="rounded-t-lg" src='/images/book.jpg' alt="" />
        </a>
        <div class="p-5">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Book: {{ book.title }}
                </h5>
            </a>
            <h2 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Authors:</h2>

            <ol class="mb-3 max-w-md space-y-1 text-gray-500 list-decimal list-inside dark:text-gray-400">
                <li v-for="author in book.authors">
                    <span class="font-semibold text-gray-900 dark:text-white">{{ author.name }} </span>
                </li>
            </ol>
            <h2 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Count:<span class="ml-2">{{ book.count }}
                </span></h2>
            <h2 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Price:<span class="ml-2">{{ book.price }}
                </span></h2>

            <Link v-if="showable" :href="route('book.show', book)"
                class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Show
            <i class="fa fa-eye w-4 h-4 ml-2 -mr-1" aria-hidden="true"></i>
            </Link>

            <Link v-if="ediatable" :href="route('book.edit', book)"
                class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Edit
            <i class="fa fa-edit w-4 h-4 ml-2 -mr-1"></i>
            </Link>

            <Link v-if="ediatable" :href="route('book.destroy', book)" onclick="return confirm('Are you sure?')"
                method="DELETE"
                class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Remove
            <i class="fa fa-trash w-4 h-4 ml-2 -mr-1"></i>
            </Link>

            <div v-if="basket" class="relative w-full">

                <form :id="`form-cart${book.id}`" action="order/add" method="POST">
                    <input type="hidden" name="_token" :value=csrf>
                    <input type="hidden" name="id" :value=book.id>
                    <div class="flex">
                        <div class="m-3">
                            <label for="count" class="block m-auto text-sm font-medium text-gray-900 dark:text-white">
                                Count</label>
                        </div>
                        <div>
                            <input type="number" id="count" name="count"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                :placeholder=$book.count required value=''>
                        </div>
                        <div>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('form-cart${book.id}').submit();"
                                class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Add <i class="fa fa-shopping-cart w-4 h-4 ml-2 -mr-1" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <input type="submit" value=" ">
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
p {
    text-align: center;
}

.div-input {
    max-width: 35px;
}

.btn-search {
    background: url(/images/search.png);
    color: black;
}

.btn-edit {
    background: url(/images/edit.png);
}

.btn-remove {
    background: url(/images/delete.png);
}

.btn-action {
    background-size: 100% 100%;
    border: none;
    background-repeat: no-repeat;
    border: 0;
    margin-top: 7px;
    display: block;
    height: 25px;
    width: 25px;

}
</style>
