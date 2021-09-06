<style>
    body {
        margin-top: 20px;
        background: #eee;
    }

    .invoice {
        background: #fff;
        padding: 20px
    }

    .invoice-company {
        font-size: 20px
    }

    .invoice-header {
        margin: 0 -20px;
        background: #f0f3f4;
        padding: 20px
    }

    .invoice-date,
    .invoice-from,
    .invoice-to {
        display: table-cell;
        width: 1%
    }

    .invoice-from,
    .invoice-to {
        padding-right: 20px
    }

    .invoice-date .date,
    .invoice-from strong,
    .invoice-to strong {
        font-size: 16px;
        font-weight: 600
    }

    .invoice-date {
        text-align: right;
        padding-left: 20px
    }

    .invoice-price {
        background: #f0f3f4;
        display: table;
        width: 100%
    }

    .invoice-price .invoice-price-left,
    .invoice-price .invoice-price-right {
        display: table-cell;
        padding: 20px;
        font-size: 20px;
        font-weight: 600;
        width: 75%;
        position: relative;
        vertical-align: middle
    }

    .invoice-price .invoice-price-left .sub-price {
        display: table-cell;
        vertical-align: middle;
        padding: 0 20px
    }

    .invoice-price small {
        font-size: 12px;
        font-weight: 400;
        display: block
    }

    .invoice-price .invoice-price-row {
        display: table;
        float: left
    }

    .invoice-price .invoice-price-right {
        width: 25%;
        background: #2d353c;
        color: #fff;
        font-size: 28px;
        text-align: right;
        vertical-align: bottom;
        font-weight: 300
    }

    .invoice-price .invoice-price-right small {
        display: block;
        opacity: .6;
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 12px
    }

    .invoice-footer {
        border-top: 1px solid #ddd;
        padding-top: 10px;
        font-size: 10px
    }

    .invoice-note {
        color: #999;
        margin-top: 80px;
        font-size: 85%
    }

    .invoice>div:not(.invoice-footer) {
        margin-bottom: 20px
    }

    .btn.btn-white,
    .btn.btn-white.disabled,
    .btn.btn-white.disabled:focus,
    .btn.btn-white.disabled:hover,
    .btn.btn-white[disabled],
    .btn.btn-white[disabled]:focus,
    .btn.btn-white[disabled]:hover {
        color: #2d353c;
        background: #fff;
        border-color: #d9dfe3;
    }
</style>

<div class="container">
    <div class="col-md-12">
        <div class="invoice">
            <div class="invoice-company text-inverse f-w-600">
                Mbok Laundry
                <span class="float-right">
                    <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Cetak</a>
                </span>
            </div>
            <div class="invoice-header">
                <div class="invoice-from">
                    <small>dari</small>
                    <address class="m-t-5 m-b-5">
                        <strong class="text-inverse">Mbok Laundry</strong><br>
                        Poris no 17<br>
                        Tangerang Selatan, 12345<br>
                        Phone: (085) 1234-456
                    </address>
                </div>
                <div class="invoice-to">
                    <small>untuk</small>
                    <address class="m-t-5 m-b-5">
                        <strong class="text-inverse"><?= $datalaundry['name'] ?></strong><br>
                        <?= $datalaundry['email'] ?>
                    </address>
                </div>
                <div class="invoice-date">
                    <small>Invoice</small>
                    <div class="date text-inverse m-t-5"><?= $datalaundry['tanggal'] ?></div>
                    <div class="invoice-detail">
                        <?php
                        if ($datalaundry['status_laundry'] == "Dalam antrian") {
                            echo "<span class='badge badge-pill badge-warning'>" . $datalaundry['status_laundry'] . " </span>";
                        } else if ($datalaundry['status_laundry'] == "Diproses") {
                            echo "<span class='badge badge-pill badge-info'>" . $datalaundry['status_laundry'] . " </span>";
                        } else if ($datalaundry['status_laundry'] == "Selesai") {
                            echo "<span class='badge badge-pill badge-success'>" . $datalaundry['status_laundry'] . " </span>";
                        } else if ($datalaundry['status_laundry'] == "Diambil") {
                            echo "<span class='badge badge-pill badge-primary'>" . $datalaundry['status_laundry'] . " </span>";
                        } else {
                            echo "<span class='badge badge-pill badge-danger'>" . $datalaundry['status_laundry'] . " </span>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="invoice-content">
                <div class="table-responsive">
                    <table class="table table-invoice">
                        <thead>
                            <tr>
                                <th>PAKET</th>
                                <th class="text-center" width="20%">HARGA</th>
                                <th class="text-center" width="20%">JUMLAH PAKAIAN</th>
                                <th class="text-center" width="10%">BERAT</th>
                                <th class="text-right" width="20%">TOTAL HARGA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <span class="text-inverse"><?= $datalaundry['nama_paket'] ?></span><br>
                                    <small><?= $datalaundry['keterangan_paket'] ?></small>
                                </td>
                                <td class="text-center">Rp. <?= number_format($datalaundry['harga_paket']) ?>/kg</td>
                                <td class="text-center"><?= $datalaundry['jumlah_pakaian'] ?></td>
                                <td class="text-center"><?= $datalaundry['jumlah_berat'] ?> kg</td>
                                <td class="text-right">Rp. <?= number_format($datalaundry['harga_paket'] * $datalaundry['jumlah_berat']) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="invoice-price">
                    <div class="invoice-price-left">
                        <div class="invoice-price-row">
                            <div class="sub-price">
                                <small>SUBTOTAL</small>
                                <span class="text-inverse">Rp. <?= number_format($datalaundry['harga_paket'] * $datalaundry['jumlah_berat']) ?></span>
                            </div>
                            <div class="sub-price">
                                <i class="fa fa-plus text-muted"></i>
                            </div>
                            <div class="sub-price">
                                <small>PAJAK (10%)</small>
                                <span class="text-inverse">Rp. <?= number_format(($datalaundry['harga_paket'] * $datalaundry['jumlah_berat']) * 0.10) ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-price-right">
                        <small>TOTAL</small> <span class="f-w-600">Rp. <?= number_format($datalaundry['harga_paket'] * $datalaundry['jumlah_berat'] + ($datalaundry['harga_paket'] * $datalaundry['jumlah_berat']) * 0.10) ?></span>
                    </div>
                </div>
            </div>
            <div class="invoice-note">
                * Sebelum mengambil, pastikan jumlah pakaian sudah sesuai.<br>
                * Harap jangan ngutang (seperti yang punya PI)<br>
                * Jika ada pertanyaan, silakan ditanyakan melalui email, telp, atau datang langsung aja
            </div>
            <div class="invoice-footer">
                <p class="text-center m-b-5 f-w-600">
                    Terima kasih sudah mempercayai jasa Laundry anda dengan kami.
                </p>
                <p class="text-center">
                    <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> mboklaundry.com</span>
                    <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> berug@mboklaundry.com</span>
                </p>
            </div>
        </div>
    </div>
</div>