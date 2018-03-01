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
                        <b-button size="sm" @click.stop="removeItem(data.index)" class="mr-1">
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
                let length = this.items.length;
                this.items.map(item => {
                    item.subTotal = parseInt(item.qty) * parseFloat(item.sale_price);
                    total += item.subTotal;
                });
                this.total = total;
                return this.total;
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
                console.log(this.items);
            },
            removeItem: function(index) {
                this.items[index].qty = 1;
                this.items.splice(index, 1);
            },
            changeQty: function(newItem){
                this.items.map((item, index) => {
                    if (item == newItem) {
                        this.items.splice(index, 1);
                    }
                });
                this.items.push(newItem);
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
