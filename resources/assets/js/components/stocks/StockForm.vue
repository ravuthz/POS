<template>
    <div class="card">
        <div class="card-header">
            <span class="card-title" v-if="action === 'Update'">{{ $t('stocks.update') }}</span>
            <span class="card-title" v-else>{{ $t('stocks.create') }}</span>
            <div>
                 <router-link :to="{ name:'stocks.list' }" class="btn btn-secondary">
                         {{ $t('buttons.back') }}
                </router-link>
                <button class="btn btn-primary" :disabled="stock.items < 1"  @click="onSave">{{ $t('buttons.save') }}</button>
            </div>
        </div>
        <div class="card-body">
            <div v-if="action === 'Update'">
                <div class="form-group row">
                    <label class="col-2 col-form-label">{{ $t('labels.movement') }}</label>
                    <div class="col-10">
                        <p class="form-control">{{ $tc('labels.movementInOut', stock.movement) }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stockCreatedAt" class="col-2 col-form-label">{{ $t('labels.createdAt') }}</label>
                    <div class="col-10">
                        <input class="form-control" id="stockCreatedAt" type="text" v-model="stock.created_at" disabled="disabled">
                    </div>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">{{ $t('labels.product') }}</th>
                        <th scope="col">{{ $t('labels.price') }}</th>
                        <th scope="col">{{ $t('labels.quantity') }}</th>
                        <th scope="col">{{ $t('labels.amount') }}</th>
                        <th scope="col">{{ $t('labels.actions') }}</th>
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
                    <tr class="table-success">
                        <td colspan="3">
                            <button class="btn btn-secondary"
                             @click="addNewLine">{{ $t('labels.addProduct') }}</button>
                        </td>
                        <td class="form-summary">{{ $t('labels.subTotal') }}</td>
                        <td class="form-summary">{{ subTotal | currency('R ')}}</td>
                    </tr>

                </tfoot>
            </table>
        </div>
    </div>
</template>
<script type="text/javascript">
    import Vue from 'vue'
    import { Typeahead } from '../typeahead'
    import { get, post } from '../../api.js'
    import Flash from '../../helpers/flash'

    export default {
        components: {
            Typeahead
        },
        data() {
                return {
                    form: {},
                    stock: {
                        items: []
                    },
                    action: 'Create',
                    store: '/api/stocks',
                    errors: {},
                }
        },
        beforeCreate() {
            if(this.$route.meta.mode ==='edit') {
                this.initialLizeURL = `/api/stocks/${this.$route.params.id}/edit`
            }else {
                this.initialLizeURL= '/api/stocks/create'
            }

            get(this.initialLizeURL)
                .then((res) => {
                    this.stock = res.data.data
                })
        },
        created(){
            if(this.$route.meta.mode ==='edit') {
                this.store = `/api/stocks/${this.$route.params.id}?_method=PUT`
                this.action = 'Update'
            }
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
                            Flash.setSuccess(res.data.message)
                            this.$router.push(`/stocks/${res.data.id}`)
                        }
                    })
                    .catch((err) => {
                        if(err.response.status === 422) {
                            this.errors = err.response.data.errors
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
.form-summary {
    text-align: right;
    vertical-align: middle !important;
    font-weight: bold;
}
</style>
