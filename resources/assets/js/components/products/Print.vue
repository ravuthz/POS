<template>
    <div class="container-fluid">
        <div class="d-none d-print-block">

            <div class="row">
                <div class="col">
                    <div class="text-center">
                        <h3>Maru POS</h3>
                        <p>Tel: 016 768 778 / 099 768 778</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h5 class="text-center">
                        <b>RECEIPT</b>
                    </h5>
                </div>
            </div>
        </div>

        <div class="d-print-block">
            <table class="table">
                <thead>
                <tr>
                    <th>
                        <span class="khmer">#</span>
                    </th>
                    <th>
                        NAME
                    </th>
                    <th class="text-center">
                        PRICE
                    </th>
                    <th class="text-right">
                        QTY
                    </th>
                    <th class="text-right">
                        Amount
                    </th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in loadItems">
                        <td>
                            {{ index + 1}}
                        </td>
                        <td>{{ item.name }}</td>
                        <td class="text-center">{{ item.sale_price }}</td>
                        <td class="text-right">{{ item.qty }}</td>
                        <td class="text-right">{{ item.subTotal }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-none d-print-block">
            <table class="table table-condensed table-borderless">
                <tr>
                    <td>
                        <span class="khmer">សរុបចុងក្រោយ​</span>
                    </td>
                    <td class="text-right">Grand Total (Riel):</td>
                    <td class="text-right">{{ total }}</td>
                </tr>
            </table>

            <div class="row">
                <div class="col text-center">
                    <p class="khmer">សូមអរគុណ​! សូមអញ្ជើញមកម្តងទៀត​</p>
                    <p>Thank you, Please come again.</p>
                    <a href="https://www.devkh.com">www.devkh.com</a>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: {
            items: {
                type: Array
            },
            total: {
                type: Number
            }
        },
        created() {
            this.$store.dispatch('listItems');
        },
        computed: {
            loadItems() {
                this.items = this.$store.getters.items;
                this.total = this.$store.getters.total;
                return this.items;
            }
        }
    }

</script>

<style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Bree+Serif);

    @media print {
        @page {
            size: 80mm 297mm;
            margin: 3mm;
        }

        .container-fluid {
            min-width: 420px !important;
        }
    }

    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Bree Serif', serif;
    }

    .table > thead > tr > td,
    .table > tbody > tr > td,
    .table > tfoot > tr > td,
    .table > thead > tr > th {
        padding: 0;
    }

    .table-borderless > tbody > tr > td {
        border-top: 0;
    }

    .khmer {
        font-family: 'Khmer OS Battambang', 'Battambang';
    }

</style>
