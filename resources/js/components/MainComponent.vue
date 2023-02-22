
<template>
    <div class="container">
        <div class="col-12 col-md-10 col-lg-9 col-xl-8" style="margin:auto">
            <div class="row" style="box-shadow: 2px 2px 4px 4px #888; min-height: 60vh;">
                <nav-bar-component></nav-bar-component>
                <div v-for="element in elements" class="books-content col-3 align-self-start" >
                    <book-author-component :element=element  :comptype=comptype :imgurl=imgurl></book-author-component>
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
        props:{
            elements: {
               type: Object,
               default: {},
           },
           comptype: {
               type: String,
               default: "book",
           },
           imgurl:{
                type: String,
                default: "/images/book.jpg",
           }
        }
    }
</script>

<style scoped>
.books-content{
    margin: 25px;
}

</style>