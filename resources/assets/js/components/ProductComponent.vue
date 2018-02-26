<template>

    <div class="container">
        <div class="row text-center text-lg-left">
            <div class="col-md-11">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-xs-6"  v-for="product in products">
                        <div class="card" v-on:click="add(product)">
                            <img class="card-img-top" :src="product.image">
                            <div class="card-block">
                                <p class="card-text">{{ product.name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1" >
                <a href="#" id="sidebar" data-toggle="popover" data-trigger="focus"><<</a>
            </div>
        </div>
    </div>


</template>

<script>
    export default {
        data() {
            return {
                products: []
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.loadProducts();
        },

        methods: {
            loadProducts: function() {
                axios.get('/adminz/products/json').then(res => {
                    console.log("loadProducts: ", res.data);
                    this.products = res.data;
                });
            },
            add: function(product) {
                console.log("maru ", product.name);
            }
        }

    }
</script>
<style type="text/css">
    .card{
        cursor:pointer;
    }
</style>
