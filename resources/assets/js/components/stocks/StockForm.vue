<template>
    <div class="container">
        <navbar></navbar>

        <div class="card">
            <div class="card-header">
                <span class="card-title">{{ action }} Stock</span>
                <div>
                     <router-link :to="`/stocks/`" class="btn btn-secondary">
                            Back
                    </router-link>
                    <button class="btn btn-primary" :disabled="stock.items < 1"  @click="onSave">Save</button>
                </div>
            </div>
           <div class="card-body">
                <div v-if="action === 'Update'">
                <div class="form-group row">
                    <label for="example-date-input" class="col-2 col-form-label">Movement</label>
                    <div class="col-10">
                        <p class="form-control" >{{ stock.movement === 0 ? 'OUT' : 'IN'}}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-date-input" class="col-2 col-form-label">Created At</label>
                    <div class="col-10">
                        <input class="form-control" type="text" v-model="stock.created_at" disabled="disabled">
                    </div>
                </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Amout</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in stock.items">
                            <td>
                                <typeahead :initialize="item.product" @input="onProduct(index, $event)" />
                                <small class="error-control" v-if="errors[`items.${index}.product_id`]">
                                    {{errors[`items.${index}.product_id`][0] }}
                                </small>
                            </td>
                            <td>{{ item.price | currency('R ') }}</td>
                            <td><input type="text" class="typeahead-input" v-model="item.quantity"></td>
                            <td>{{ Number(item.quantity) * Number(item.price) | currency('R ') }}</td>
                            <td>
                                <b-button size="sm" v-b-modal.removeItem @click="removeItem(index)" class="mr-1 btn-danger">
                                    <i class="fa fa-trash"></i>
                                </b-button>
                            </td>
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
    import { get, post } from '../../api.js'
    import Flash from '../../helpers/flash'

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
                    initialLizeURL: `/api/stocks/create`,
                    action: 'Create',
                    store: '/api/stocks',
                    errors: {},
                }
        },
        created() {
            if(this.$route.meta.mode ==='edit') {
                this.initialLizeURL = `/api/stocks/${this.$route.params.id}/edit`
                this.store = `/api/stocks/${this.$route.params.id}?_method=PUT`
                this.action = 'Update'

            }
            get(this.initialLizeURL)
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
                this.errors = {}
                post(this.store, this.stock)
                    .then((res) => {
                        if(res.data.saved) {
                            console.log(res.data.message)
                            Flash.setSuccess(res.data.message)
                            this.$router.push(`/stocks/${res.data.id}`)
                        }
                    })
                    .catch((err) => {
                        if(err.response.status === 422) {
                            this.errors = err.response.data.errors
                            console.log(this.errors)
                        }
                    })
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
                    price: 0,
                    quantity: 1
                })
            },
            removeItem(index) {
                this.stock.items.splice(index, 1)
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
.error-control{
    color: red;
}
</style>
