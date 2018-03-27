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
                <table class="table">
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
                            <td>
                                <typeahead :url="productURL" :initialize="item.product" @input="onProduct(index, $event)" />
                            </td>
                            <td>{{ item.price | currency('R ') }}</td>
                            <td><input type="text" class="typeahead-input" v-model="item.quantity"></td>
                            <td>{{ Number(item.quantity) * Number(item.price) | currency('R ') }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2">
                            <button class="btn btn-sm"
                             @click="addNewLine">Add New Item</button>
                        </td>
                        <td class="form-summary">Sub Total</td>
                        <td>{{ subTotal | currency('R ')}}</td>
                    </tr>

                </tfoot>
                </table>
           </div>
        </div>
        </div>

    </div>
</template>
<script type="text/javascript">
    import Vue from 'vue'
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
                    form: {},
                    stock: {
                        items: []
                    },
                    productURL: '/api/products'
                }
        },
        created() {
            getStock(`/api/stocks/${this.$route.params.id}`)
                .then((res) => {
                    this.stock = res.data.data
                })
        },
        computed: {
            subTotal() {
               return this.stock.items.reduce((carry, item) => {
                    return carry + (Number(item.price) * Number(item.quantity))
                }, 0)
            }
        },
        methods: {
            onSave() {
                alert(1);
            },
            onProduct(index, e){

                const product = e.target.value
                Vue.set(this.stock.items[index], 'product', product)
                Vue.set(this.stock.items[index], 'product_id', product.id)
                Vue.set(this.stock.items[index], 'price', product.sale_price)
            },
            addNewLine() {
                this.stock.items.push({
                    product_id: null,
                    product: null,
                    unit_price: 0,
                    quantity: 1
                })
                console.log(this.stock.items);
            }
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
