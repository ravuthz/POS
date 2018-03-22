<template>
    <div id="content">
        <router-view></router-view>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button type="button" id="sidebarCollapse" v-bind:class="{ active : showRightSidebar }"
                    class="navbar-btn col-lg-1 col-md-2" @click="topCloseClick">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            MARU
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/logout">Logout</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <b-form-input aria-label="Search" placeholder="Search product here..." v-model="productName"
                                  @keyup.native="searchProduct(productName)"></b-form-input>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-6" v-for="product in getAllProductsFromStore">
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
                <b-pagination size="md" @change="changePage" :total-rows="totalRows" :per-page="perPage"></b-pagination>
            </div>
        </template>


    </div>
</template>
<script>

    export default {
        props: {
            items: {
                type: Array
            }
        },
        data() {
            return {
                showRightSidebar: false,
                perPage: 12,
                productName: null,
                totalRows: null,
            }
        },
        created() {
            this.$store.dispatch('listProduct', {size: this.perPage});
        },
        computed: {
            getAllProductsFromStore() {
                this.products = this.$store.getters.products;
                this.totalRows = this.$store.getters.totalRows;
                return this.products;
            }
        },
        methods: {
            searchProduct: function (name) {
                this.$store.dispatch('listProduct', {size: this.perPage, filter: name});
            },
            changePage(pageNum, productName) {
                this.$store.dispatch('listProduct', {page: pageNum, size: this.perPage, filter: this.productName});
            },
            topCloseClick() {
                this.showRightSidebar = !this.showRightSidebar;
                this.$emit('onTopCloseClick', this.showRightSidebar);
                console.log("ProductList.topCloseClick: $emit.onTopCloseClick");
            },
            addItem(product) {
                this.$store.dispatch('addItem', product);
            },
        }
    }

</script>
