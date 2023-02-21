
<template>
    <div class="container">
        <div class="col-12 col-md-10 col-lg-9 col-xl-8" style="margin:auto">
            <div class="row" style="box-shadow: 2px 2px 4px 4px #888; min-height: 50vh;">
                <book-nav-bar-component></book-nav-bar-component>
                <div v-for="book in books" class="books-content col-3">
                    <book-component :book=book></book-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props:           {
            books: {
               type: Object,
               default: () => ({}),
           }
        }
    }
</script>

<style scoped>
.books-content{
    margin: 25px;
}

.btn-close {
  background-color: red;
}
</style>