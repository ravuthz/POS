<template>
    <div class="wrapper">

        <!-- Sidebar Holder -->
        <sidebar
            :items="items"
            v-model="showSideBar"
            @clearAllItems="clearAllItems"
        ></sidebar>

        <!-- Page Content Holder -->
        <productlist
            @onTopCloseClick="onTopCloseClick"
            @onItemClick="addItemToSideBar"
        ></productlist>
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
                showSideBar: false,
                items: [],
                item: null,
                total: 0.00
            }
        },
        mounted() {
            this.loadItemsStorage();
            // this.sumItemsPriceTotal();
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
            updateItemsStorage() {
                this.setStorage('items', this.items);
            },
            onTopCloseClick(value) {
                this.showSideBar = value;
            },
            addItemToSideBar(value) {
                this.addItem(value);
            },
            clearAllItems() {
                this.items = [];
                localStorage.clear();
                // this.sumItemsPriceTotal();
            },
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
        background: #fff;
    }
</style>
