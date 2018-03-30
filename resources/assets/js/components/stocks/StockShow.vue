<template>
        <div class="card">
            <div class="card-header">
                <span class="card-title">{{ $t('labels.stock_detail') }}</span>
                <div>
                     <router-link :to="{ name: 'stocks.list'}" class="btn btn-secondary">
                            {{ $t('buttons.back') }}
                    </router-link>
                    <router-link :to="{ name: 'stocks.edit', params: {id: stock.id} }" class="btn btn-primary">
                            {{ $t('buttons.modify') }}
                    </router-link>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text" v-if="stock.movement === 0">{{  $t('tables.movement') }}: {{  $t('tables.out') }}</p>
                <p class="card-text" v-else>{{  $t('tables.movement') }}: {{ $t('tables.in') }}</p>
                <p class="card-text">{{ $t('tables.created_at') }}: {{ stock.created_at }}</p>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ $t('tables.product') }}</th>
                            <th scope="col">{{ $t('tables.price') }}</th>
                            <th scope="col">{{ $t('tables.quantity') }}</th>
                            <th scope="col">{{ $t('tables.amount') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in stock.items">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.product.name }}</td>
                            <td>{{ item.price | currency('R ') }}</td>
                            <td>{{ item.quantity }}</td>
                            <td>{{ item.quantity * item.price | currency('R ') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</template>

<script>
    import { get } from '../../api.js'

    export default {
        data() {
            return {
                stock: {
                    id: 0
                },
            }
        },
        beforeCreate() {
            get(`/api/stocks/${this.$route.params.id}`)
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
