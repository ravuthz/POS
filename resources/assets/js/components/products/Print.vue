<template>
    <div class="container-fluid" style="background-color: #0c5460">
        <div class="d-none d-print-block">

            <div class="row">
                <div class="col">
                    <div class="text-center">
                        <p class="khmer">POS</p>
                        <p>Tel: 016 768 778 / 099 768 778</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h5 class="text-center">RECEIPT</h5>
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
                        <!-- <span class="khmer">ចុះថ្លៃ</span> -->
                        <br>NAME
                    </th>
                    <th class="text-center">
                        <!-- <span class="khmer">ចំនួន</span> -->
                        <br>PRICE
                    </th>
                    <th class="text-right">
                        <!-- <span class="khmer">តំលៃ</span> -->
                        <br>QTY
                    </th>
                    <th class="text-right">
                        <!-- <span class="khmer">សរុប</span> -->
                        <br>Amount
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item,index) in items">
                    <td>
                        {{ index }}
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
            <div>{{ reversedMessage }}</div>
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
        computed: {
            reversedMessage: function () {
              // `this` points to the vm instance
              console.log("this.items dfasd", this.items)
            }
        }
    }

</script>

<style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Bree+Serif);

    @media print {
        @page {
            size: 80mm 297mm;
            margin-right: 0;
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

    .border-top {
        border-top: 1px solid #dddddd !important;
    }

    .border-bottom {
        border-bottom: 1px solid #dddddd !important;
    }

    .border-left1 {
        padding-left: 6px !important;
        border-left: 1px solid #dddddd !important;
    }

    .border-right1 {
        padding-right: 6px !important;
        border-right: 1px solid #dddddd !important;
    }

    .big-line {
        border-top: 2px solid #dddddd !important;
        border-bottom: 0px;
    }

    .khmer {
        font-family: 'Khmer OS Battambang', 'Battambang ';
    }

    .container-fluid {
        width: 400px !important;
    }

</style>
