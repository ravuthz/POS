<template>
    <div class="wrapper">

        <!-- Page Content Holder -->
        <div id="content">
            
            <router-view></router-view>

            <nav class="navbar navbar-default">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <button type="button" id="sidebarCollapse" class="navbar-btn"  @click="showRightSidebar = !showRightSidebar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-xs-6"  v-for="product in products">
                            <div class="card" @click="addItem(product)">
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
        <nav id="sidebar" v-bind:class="{ active : showRightSidebar }">
            <div class="sidebar-header">
                <h3>Simple POS</h3>
                <b-table striped hover :items="items" :fields="fields">
                    <template slot="no" slot-scope="data">
                        {{ data.index + 1 }}
                    </template>
                    <template slot="qty" slot-scope="data">
                        {{ data.item.qty }}
                    </template>
                </b-table>
            </div>
        </nav>

    </div>
</template>

<script>

    export default{
        data () {
            return {
                fields: [
                    'no',
                    {
                        key:'name'
                    },
                    {
                        key:'sale_price',
                        label: 'Price'
                    },
                    'qty'
                ],
                showRightSidebar: false,
                products: [],
                items: [],
            }
        },
        mounted() {
            this.loadProducts();
        },

        methods: {
            loadProducts: function() {
                axios.get('/api/products').then(res => {
                    this.products = res.data.data;
                });
            },
            addItem: function(product) {
                product.qty = product.qty || 1;

                this.items.map((item, index) => {
                    if (item == product) {
                        this.items.splice(index, 1);
                        product.qty += 1;
                    }
                });

                this.items.push(product);
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

    #sidebar, #content {
        height: 100vh;
        overflow: auto;
    }
</style>
