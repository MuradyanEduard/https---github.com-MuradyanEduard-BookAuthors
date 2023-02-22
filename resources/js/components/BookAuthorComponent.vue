<template>
    <div  style="max-height: 100%;">
        <div class="row" >
            <div class="col-12">
                <p v-if="element.title">{{element.title}}</p>
                <p v-else="element.name">{{element.name}}</p>

                <img :src="`${imgurl}`" style="width:100%;" alt="">
            </div>
        </div>
        <div class = "row">
            <div class="div-input" v-if="buttons.search">
                <form :action="`/${comptype}/${element.id}`" method="GET">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="submit" class="btn-action btn-search" value=" ">
                </form>
            </div>
            <div class="div-input" v-if="buttons.edit">
                <form :action="`/${comptype}/${element.id}/edit`" method="GET">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="submit" class="btn-action btn-edit" value=" ">
                </form>
            </div>
            <div class="div-input" v-if="buttons.remove">
                <form :action="`/${comptype}/${element.id}`" method="POST" onsubmit="return confirm('Are you sure?')">
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
            element: {
               type: Object,
               default: {},
           },
           buttons:{
            type: Object,
               default: {
                search:true,
                edit:true,
                remove:true,
               }
           },
           comptype:{
               type: String,
               default: "",
           },
           imgurl:{
                type: String,
                default: "/images/book.jpg",
           }

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

.div-input{
    max-width: 35px;
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