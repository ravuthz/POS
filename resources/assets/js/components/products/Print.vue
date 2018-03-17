<template>
    <div class="container-fluid" style="background-color: #0c5460">
        <div class="d-none d-print-block">
            <div class="row">
                <div class="col">
                    <h1 class="text-center">
                        <a href="https://twitter.com/tahirtaous">
                            <img src="logo.png"> Logo here
                        </a>
                    </h1>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="text-center">
                        <p class="khmer">ផ្ទះ 16C​​ ផ្លូវ 105 កែង 198 សង្កាត់បឹងព្រលឹត</p>
                        <p class="khmer">ខណ្ឌ៧មករា ភ្នំពេញ</p>
                        <p>Tel: 016 768 778 / 099 768 778</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h5 class="text-center">RECEIPT</h5>
                </div>
            </div>

            <table class="table table-borderless">
                <tr>
                    <td width="50%">Cashier : Someaka</td>
                    <td class="text-right">Date :</td>
                    <td class="text-right">09/03/2018 18:27</td>
                </tr>
                <tr>
                    <td width="50%">Table : 33</td>
                    <td class="text-right">N<sup>o</sup> :</td>
                    <td class="text-right">000067</td>
                </tr>
            </table>

        </div>

        <div class="d-print-block">
            <table class="table">
                <thead>
                <tr>
                    <th>
                        <span class="khmer">មុខម្ហូប</span>
                        <br>Food
                    </th>
                    <th>
                        <span class="khmer">ចុះថ្លៃ</span>
                        <br>Dis.
                    </th>
                    <th class="text-center">
                        <span class="khmer">ចំនួន</span>
                        <br>Qty
                    </th>
                    <th class="text-right">
                        <span class="khmer">តំលៃ</span>
                        <br>Price
                    </th>
                    <th class="text-right">
                        <span class="khmer">សរុប</span>
                        <br>Amount
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <a href="#">Mix Juice Frappe</a>
                    </td>
                    <td>20%</td>
                    <td class="text-center">1</td>
                    <td class="text-right">2.30</td>
                    <td class="text-right">$1.84</td>
                </tr>
                <tr>
                    <td>
                        <a href="#">Mix Juice Frappe</a>
                    </td>
                    <td>20%</td>
                    <td class="text-center">1</td>
                    <td class="text-right">2.30</td>
                    <td class="text-right">$1.84</td>
                </tr>
                <tr>
                    <td>
                        <a href="#">Mix Juice Frappe</a>
                    </td>
                    <td>20%</td>
                    <td class="text-center">1</td>
                    <td class="text-right">2.30</td>
                    <td class="text-right">$1.84</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="d-none d-print-block">
            <table class="table table-condensed table-borderless">
                <tr>
                    <th class="big-line" colspan="3"></th>
                </tr>
                <tr>
                    <td>
                        <span class="khmer">ចុះថ្លៃតាមមុខ</span>
                    </td>
                    <td class="text-right">Dis. by item (USD):</td>
                    <td class="text-right">($0.46)</td>
                </tr>
                <tr>
                    <td>
                        <span class="khmer">សរុបចុងក្រោយ​</span>
                    </td>
                    <td class="text-right">Grand Total (USD):</td>
                    <td class="text-right">$1.84</td>
                </tr>
                <tr>
                    <td>
                        <span class="khmer">សរុបចុងក្រោយ​</span>
                    </td>
                    <td class="text-right">Grand Total (Riel):</td>
                    <td class="text-right">‎៛7,600</td>
                </tr>
                <tr>
                    <td class="border-top border-left"><span class="khmer"><strong>ប្រាក់ទទួល</strong></span></td>
                    <td class="border-top text-right"><strong>(USD):</strong></td>
                    <td class="border-top border-right text-right"><strong>$0.00</strong></td>
                </tr>
                <tr>
                    <td class="border-bottom border-left"><span class="khmer"><strong>ប្រាក់ទទួល</strong></span></td>
                    <td class="border-bottom text-right"><strong>Recieved (Riel):</strong></td>
                    <td class="border-bottom border-right text-right"><strong>‎៛20,000</strong></td>
                </tr>
                <tr>
                    <td>
                        <span class="khmer">ប្រាក់អាប់</span>
                    </td>
                    <td class="text-right">Change (Reil):</td>
                    <td class="text-right">‎៛12,400</td>
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
        methods: {
            createSaleProduct() {
                var printContents = document.getElementById("printPlace").innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
                /*let data = {
                    items: this.items,
                    total: this.total
                };

                axios.post('/api/sales', data).then(res => {
                    console.log("Order: ", res.data);
                });*/
                this.clearSaleProduct();
                window.location.href = "/seller";
                // this.setStorage('items', []);
                // this.items = [];
            },
            clearSaleProduct: function () {
                this.$store.dispatch('clearAllItems');
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
