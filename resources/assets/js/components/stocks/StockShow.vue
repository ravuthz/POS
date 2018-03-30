<template>
        <div class="card">
            <div class="card-header">
                <span class="card-title">{{ $t('stocks.show') }}</span>
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
                <p class="card-text">{{ $tc('labels.movementInOut', stock.movement) }}</p>
                <p class="card-text">{{ $t('labels.createdAt') }}: {{ stock.created_at }}</p>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">{{ $t('labels.no') }}</th>
                            <th scope="col">{{ $t('labels.product') }}</th>
                            <th scope="col">{{ $t('labels.price') }}</th>
                            <th scope="col">{{ $t('labels.quantity') }}</th>
                            <th scope="col">{{ $t('labels.amount') }}</th>
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
