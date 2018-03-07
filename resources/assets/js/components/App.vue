<template>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar" v-bind:class="{ active : showRightSidebar }">
            <div class="sidebar-header">
                <h3>Simple POS</h3>
                <b-table striped hover :items="items" :fields="fields" :value.sync="items">
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
                    <span class="float-right">{{ total | currency('R ') }}</span>
                </div>
                <div class="row">
                    <div class="buttonPos">
                      <b-button class="buttonPrint" @click="createSaleProduct">Sale</b-button>
                    </div>
                    <div class="buttonPos">
                      <b-button class="buttonPrint" @click="updateSaleProduct">Update</b-button>
                    </div>
                    <div class="buttonPos" v-if="!items">
                        <b-link class="btn btn-secondary buttonPrint" href="/sales">Sold Products</b-link>
                    </div>
                    <div class="buttonPos">
                      <b-button v-b-modal.modal1 class="buttonPrint">Print</b-button>
                    </div>
                    <div class="buttonPos">
                      <b-link href="/logout" class="btn btn-secondary buttonPrint">Logout</b-link>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <router-view></router-view>

            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <div class="row">
                            <button type="button" id="sidebarCollapse" v-bind:class="{ active : showRightSidebar }" class="navbar-btn col-lg-1 col-md-2"  @click="showRightSidebar = !showRightSidebar">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <div class="col-lg-11 col-md-10 rightSearch">
                                <b-form-input placeholder="Search product here..." v-model="productName" @keyup.native="searchProduct(productName)"></b-form-input>
                            </div>
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

                    <template>
                        <div>
                            <b-pagination size="md" @change="changePage" :total-rows="totalRows" v-model="currentPage" :per-page="perPage"></b-pagination>
                      </div>
                    </template>
                </div>
            </nav>

            <!-- Modal Component -->
            <b-modal id="modal1" title="Invoice">
                <p class="my-4">Hello from modal!</p>
            </b-modal>
        </div>

    </div>
</template>

<script>

    let Vue = require('vue');

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
                total: 0.00,
                currentPage: 1,
                perPage: 12,
                productName: null,
                totalRows: null
            }
        },
        mounted() {
            this.loadProducts({page: 1, size: 12});
            this.loadItemsStorage();
            this.sumItemsPriceTotal();
        },
        methods: {
            setStorage(key, value) {
                var item = JSON.stringify(value);
                window.localStorage.setItem(key, item);
            },
            getStorage(key, defaultValue) {
                var item = window.localStorage.getItem(key);
                if (item) {
                    return JSON.parse(item);
                } else {
                    return defaultValue;
                }
            },
            queryParams(url, query = {}) {
                let params = [];
                for (let q in query) {
                    if (query.hasOwnProperty(q)) {
                        params.push(q + '=' + query[q]);
                        console.log("query params: ", q, query[q]);
                    }
                }
                if (params.length > 0) {
                    url += '?';
                    url += params.join('&');
                }
                return url;
            },
            loadProducts(query = {}) {
                let url = this.queryParams('/api/products', query);

                axios.get(url).then(res => {
                    this.totalRows = res.data.meta.total;
                    this.products = res.data.data;
                });
            },
            loadItemsStorage() {
                let oldItems = this.getStorage('items', []);
                if (oldItems.length > 0 && this.items.length <= 0) {
                    this.items = oldItems;
                }
                this.updateItemsStorage();
            },
            updateItemsStorage() {
                this.setStorage('items', this.items);
            },
            sumItemsPriceTotal() {
                let total = 0;
                this.items.map(item => {
                    item.subTotal = parseInt(item.qty) * parseFloat(item.sale_price);
                    total += item.subTotal;
                });
                this.total = total;
            },

            addItem(product) {
                let found = this.items.find(item => item.id == product.id);

                if (found) {
                    found.qty += 1;
                } else {
                    product.qty = 1;
                    this.items.push(product);
                }
                this.sumItemsPriceTotal();
                this.updateItemsStorage();
            },
            removeItem(product) {
                let found = this.items.findIndex(item => item.id == product.id);
                console.log("found: ", found)
                if (found >= 0) {
                    this.items.splice(found, 1);
                }
                this.sumItemsPriceTotal();
                this.updateItemsStorage();
            },
            changeQty(product) {
                let found = this.items.find(item => item.id == product.id);
                if (found) {
                    found.qty = parseInt(product.qty);
                }
                this.sumItemsPriceTotal();
                this.updateItemsStorage();
            },
            searchProduct: function(name) {
                this.loadProducts({page: 1, size: 12, filter: name});
            },
            changePage (pageNum) {
                this.loadProducts({page: pageNum, size: 12});
            },
            
            createSaleProduct() {
                let data = {
                    items: this.items,
                    total: this.total
                };
                
                axios.post('/api/sales', data).then(res => {
                    console.log("Order: ", res.data);
                });
                
                // this.setStorage('items', []);
                // this.items = [];
            },
            updateSaleProduct() {
                let data = {
                    items: this.items,
                    total: this.total
                };
                
                axios.put('/api/sales/1', data).then(res => {
                    console.log("Order: ", res.data);
                });
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
