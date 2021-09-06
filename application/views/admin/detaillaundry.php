<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card">
        <div class="card-header text-right">
            <form action="<?= base_url('admin/invoice') ?>" method="POST" target="_blank">
                <input type="hidden" name="id_laundry" value="<?= $datalaundry['id'] ?>">
                <button type="submit" class="btn btn-info">Invoice</button>
            </form>
        </div>
        <form action="<?= base_url('admin/updateLaundry') ?>" method="POST">
            <input type="hidden" name="id_laundry" value="<?= $datalaundry['id'] ?>">
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
                        <td>
                            <select name="status_laundry" class="form-control">
                                <option <?php if ($datalaundry['status_laundry'] == "Dalam antrian") {
                                            echo "selected";
                                        } ?> value="Dalam antrian">Dalam antrian</option>
                                <option <?php if ($datalaundry['status_laundry'] == "Diproses") {
                                            echo "selected";
                                        } ?> value="Diproses">Diproses</option>
                                <option <?php if ($datalaundry['status_laundry'] == "Selesai") {
                                            echo "selected";
                                        } ?> value="Selesai">Selesai</option>
                                <option <?php if ($datalaundry['status_laundry'] == "Diambil") {
                                            echo "selected";
                                        } ?> value="Diambil">Diambil</option>
                                <option <?php if ($datalaundry['status_laundry'] == "Dibatalkan") {
                                            echo "selected";
                                        } ?> value="Dibatalkan">Dibatalkan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="30%">Status Pembayaran</th>
                        <td>
                            <select name="status_pembayaran" class="form-control">
                                <option <?php if ($datalaundry['status_pembayaran'] == "Belum lunas") {
                                            echo "selected";
                                        } ?> value="Belum lunas">Belum lunas</option>
                                <option <?php if ($datalaundry['status_pembayaran'] == "Lunas") {
                                            echo "selected";
                                        } ?> value="Lunas">Lunas</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="30%">Tanggal</th>
                        <td><?= $datalaundry['tanggal'] ?></td>
                    </tr>
                </table>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>

    </div>

</div>