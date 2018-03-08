<template>
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
            loadItemsStorage() {
                let oldItems = this.getStorage('items', []);
                if (oldItems.length > 0 && this.items.length <= 0) {
                    this.items = oldItems;
                }
                this.updateItemsStorage();
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
            searchProduct: function(name) {
                this.loadProducts({page: 1, size: 12, filter: name});
            },
            changePage (pageNum) {
                this.loadProducts({page: pageNum, size: 12});
            },
            sumItemsPriceTotal() {
                let total = 0;
                this.items.map(item => {
                    item.subTotal = parseInt(item.qty) * parseFloat(item.sale_price);
                    total += item.subTotal;
                });
                this.total = total;
            },
            updateItemsStorage() {
                this.setStorage('items', this.items);
            },

        }
    }

</script>
