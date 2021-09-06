<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card">
        <div class="card-header text-right">
            <form action="<?= base_url('user/invoice') ?>" method="POST" target="_blank">
                <input type="hidden" name="id_laundry" value="<?= $datalaundry['id'] ?>">
                <button type="submit" class="btn btn-info">Invoice</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th width="30%">Nama</th>
                    <td><?= $datalaundry['name'] ?></td>
                </tr>
                <tr>
                    <th width="30%">Email</th>
                    <td><?= $datalaundry['email'] ?></td>
                </tr>
                <tr>
                    <th width="30%">Jumlah Pakaian</th>
                    <td><?= $datalaundry['jumlah_pakaian'] ?></td>
                </tr>
                <tr>
                    <th width="30%">Berat</th>
                    <td><?= $datalaundry['jumlah_berat'] ?> kg</td>
                </tr>
                <tr>
                    <th width="30%">Paket Laundry</th>
                    <td><?= $datalaundry['nama_paket'] ?></td>
                </tr>
                <tr>
                    <th width="30%">Harga Paket</th>
                    <td>Rp. <?= number_format($datalaundry['harga_paket']) ?>/kg</td>
                </tr>
                <tr>
                    <th width="30%">Status Laundry</th>
                    <td> <?= $datalaundry['status_laundry'] ?> </td>
                </tr>
                <tr>
                    <th width="30%">Status Pembayaran</th>
                    <td> <?= $datalaundry['status_pembayaran'] ?></td>
                </tr>
                <tr>
                    <th width="30%">Tanggal</th>
                    <td><?= $datalaundry['tanggal'] ?></td>
                </tr>
            </table>
        </div>

    </div>

</div>