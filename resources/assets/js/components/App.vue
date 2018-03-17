<template>
    <div class="wrapper">
        <sidebar class="d-print-none"
        ></sidebar>

        <productlist class="d-print-none"
        ></productlist>
        <div class="d-none d-print-block">
            <small-print
                    :items="items"
                    :total="total"
            ></small-print>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                fields: [
                    {
                        key: 'no',
                        label: '#'
                    }
                    ,
                    {
                        key: 'name',
                    },
                    {
                        key: 'sale_price',
                        label: 'Price',
                        class: 'text-right'
                    },
                    {
                        key: 'qty',
                        class: 'text-right'
                    },
                    {
                        key: 'subtotal',
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

    }

</script>

<style type="text/css">
    .card {
        cursor: pointer;
        padding: 15px;
        margin: 15px 0px;
    }

    .badge {
        background-color: white;
        position: absolute;
        right: 5px;
        color: red;
        font-size: 14px;
    }

    .navbar {
        background: #fff;
    }

</style>
