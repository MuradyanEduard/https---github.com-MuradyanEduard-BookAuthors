<template>

    <div>
        <p>{{book.title}}</p>
        <img src="/images/book.jpg" style="width:100%;" alt="">
        <div class = "row">
            <div class="col-2">
                <form :action="`/book/${book.id}`" method="GET">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="submit" class="btn-action btn-search" value=" ">
                </form>
            </div>
            <div class="col-2">
                <form :action="`/book/${book.id}/edit`" method="GET">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="submit" class="btn-action btn-edit" value=" ">
                </form>
            </div>
            <div class="col-2">
                <form :action="`/book/${book.id}`" method="POST" onsubmit="return confirm('Are you sure?')">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="submit" class="btn-action btn-remove" value=" ">
                </form>
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
            book: {
               type: String,
               default: () => ({}),
           },
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }   
        }
    }
</script>

<style scoped>

p{
    text-align: center;
}


.btn-search{
    background: url(/images/search.png);
    color: black;
}
.btn-edit{
    background: url(/images/edit.png);
}

.btn-remove{
    background: url(/images/delete.png);
}

.btn-action{
    background-size:100% 100%;
    border:none; 
    background-repeat:no-repeat;
    border: 0;
    margin-top:7px;
    display: block;
    height: 25px;
    width: 25px;

}

</style>