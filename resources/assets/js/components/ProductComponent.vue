<template>
    <div class="wrapper">

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-default">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <button type="button" id="sidebarCollapse" class="navbar-btn">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-xs-6"  v-for="product in products">
                            <div class="card" v-on:click="add(product)">
                                <span class="badge">{{ product.sale_price }}</span>
                                <img class="card-img-top" :src="product.image">
                                <div class="card-block">
                                    <p class="card-text">{{ product.name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

        </div>

        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Simple POS</h3>
                <b-table striped hover :items="items"></b-table>
            </div>
        </nav>

    </div>
</template>

<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });
    });

    export default {
        data () {
            return {
                products: [],
                items: []
            }
        },
        mounted() {
            this.loadProducts();
        },

        methods: {
            loadProducts: function() {
                axios.get('/adminz/products/json').then(res => {
                    console.log("loadProducts: ", res.data);
                    this.products = res.data.data;
                });
            },
            add: function(product) {
                console.log("add: ", product);

                let length = this.items.length;

                if (length) {
                    for (let i=0; i<length; i++) {
                        let item = this.items[i];
                        console.log(product.id, item.id);
                        if (product.id !== item.id) {
                            this.items.push(product);
                        }
                    }
                } else {
                    this.items.push(product);
                }



            }
        }

    }
</script>
<style type="text/css">
    .card{
        cursor:pointer;
        padding: 5px;
        margin: 5px;
    }
    .badge{
        background-color: white;
        position: absolute;
        right: 5px;
        color: red;
        font-size: 14px;
    }
    .navbar{
        background: #e5e5e5;
    }
</style>
