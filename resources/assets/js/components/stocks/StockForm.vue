<template>
    <div class="container">
        <navbar></navbar>
        <div class="card">
            <div class="card-header">
                <span class="card-title">Stock Detail</span>
                <div>
                     <router-link :to="`/seller/stocks/`" class="btn btn-secondary">
                            Cancel
                    </router-link>
                    <button class="btn btn-primary" @click="onSave">Save</button>
                </div>
            </div>
           <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Amout</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in stock.items">
                            <typeahead :url="productURL" :initialize="item.product" @input="onProduct(index, $event)" />
                            <td>{{ item.price | currency('R ') }}</td>
                            <td><input type="text" class="form-control" v-model="item.quantity"></td>
                            <td>{{ item.amount | currency('R ') }}</td>
                        </tr>
                    </tbody>
                </table>
           </div>
        </div>

    </div>
</template>
<script type="text/javascript">
    import { Typeahead } from '../typeahead'
    import Navbar from '../partials/navbar.vue'
    import { getStock } from '../../api.js'

    function initialize(to) {
        let urls = {
            'create': `/api/stocks/create`,
            'edit': `/api/stocks/${to.params.id}/edit`
        }

        return (urls[to.meta.mode] || urls['create'])
    }

    export default {
        components: {
            Navbar,
            Typeahead
        },
        data() {
                return {
                    stock: {},
                    productURL: '/api/products',
                }
        },
        methods: {
            onSave() {
                alert(1);
            },
            onProduct(index, e){

            }
        },
        created() {
            getStock(`/api/stocks/${this.$route.params.id}`)
                .then((res) => {
                    this.stock = res.data.data
                })
        }
}
</script>

<style scoped>
.card-header{
    background: #fff;
}
.card-title {
    font-size: 18px;
    line-height: 24px;
}
</style>
