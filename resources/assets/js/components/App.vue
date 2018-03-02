<template>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar" v-bind:class="{ active : showRightSidebar }">
            <div class="sidebar-header">
                <h3>Simple POS</h3>
                <b-table striped hover :items="items" :fields="fields">
                    <template slot="no" slot-scope="data">
                        {{ data.index + 1 }}
                    </template>
                    <template slot="sale_price" slot-scope="data">
                        {{ data.item.sale_price | currency('R ') }}
                    </template>
                    <template slot="qty" slot-scope="data">
                        <b-form-input v-model="data.item.qty" type="text" @change="changeQty(data.item)"></b-form-input>
                    </template>
                    <template slot="subtotal" slot-scope="data">
                        {{ data.item.subTotal | currency('R ') }}
                    </template>
                    <template slot="actions" slot-scope="data">
                        <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
                        <b-button size="sm" @click.stop="removeItem(data.item)" class="mr-1 btn-danger">
                          x
                        </b-button>
                    </template>
                </b-table>
                <div class="clearfix total">
                    <span class="float-left">Total</span>
                    <span class="float-right">{{ sumItemsTotal | currency('R ') }}</span>
                </div>
                <div class="buttonPos">
                  <b-button class="buttonPrint">Print</b-button>
                </div>

            </div>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <router-view></router-view>

            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header row">
                        <button type="button" id="sidebarCollapse" v-bind:class="{ active : showRightSidebar }" class="navbar-btn col-lg-1 col-md-2"  @click="showRightSidebar = !showRightSidebar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <div class="col-lg-11 col-md-10 rightSearch row">
                            <b-form-input class="col-md-9" placeholder="Search product here..."></b-form-input>
                            <b-btn variant="outline-success" class="col-md-3">Search</b-btn>
                        </div>
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

    </div>
</template>

<script>

    export default{
        data () {
            return {
                fields: [
                    {
                        key: 'no',
                        label: '#'
                    }
                    ,
                    {
                        key:'name',
                    },
                    {
                        key:'sale_price',
                        label: 'Price',
                        class: 'text-right'
                    },
                    {
                        key:'qty',
                        class: 'text-right'
                    },
                    {
                        key:'subtotal',
                        class: 'text-right'
                    },
                    {
                        key: 'actions',
                        label: ' ',
                        class: 'text-right'
                    }
                ],
                showRightSidebar: false,
                products: [],
                items: [],
                total: 0.00
            }
        },
        mounted() {
            this.loadProducts();
        },

        computed: {
            sumItemsTotal () {
                let total = 0;
                this.items.map(item => {
                    item.subTotal = parseInt(item.qty) * parseFloat(item.sale_price);
                    total += item.subTotal;
                });
                return (this.total = total);
            }
        },
        // watch: {
        //     items: function (oldQty, newQty) {
        //         // this.items.map(item => {
        //             console.log("====", oldQty);
        //         // })
        //     }
        // },
        methods: {
            loadProducts() {
                axios.get('/api/products').then(res => {
                    this.products = res.data.data;
                    this.products.map(product => product.qty = 0);
                });
            },
            loadItems() {
                this.items = this.products.filter(product => product.qty > 0);
            },
            addItem(product) {
                this.products.map(item => {
                    if (item == product) {
                        item.qty += 1;
                    }
                })
                console.log("Add product to carts: ", this.products);
                this.loadItems();
            },
            removeItem(product) {
                this.products.map(item => {
                    if (item == product) {
                        item.qty = 0;
                    }
                })
                console.log("Remove product from carts: ", this.products);
                this.loadItems();
            },
            changeQty(product){
                this.products.map(item => {
                    if (item == product) {
                        item.qty = parseInt(product.qty);
                    }
                })
                console.log("Update product 's quantity: ", this.products);
                this.loadItems();
            }
        }
    }

</script>

<style type="text/css">
    .card{
        cursor:pointer;
        padding: 15px;
        margin: 15px 0px;
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
