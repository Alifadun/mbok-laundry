<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('admin/catatlaundry') ?>" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tabel-data-laundry" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Pesanan</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Jumlah Pakaian</th>
                            <th scope="col">Jumlah Berat</th>
                            <th scope="col">Nama Paket</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Status</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($datalaundry as $dl) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $dl['tanggal']; ?></td>
                                <td><?= $dl['name']; ?></td>
                                <td><?= $dl['jumlah_pakaian']; ?></td>
                                <td><?= $dl['jumlah_berat']; ?> kg</td>
                                <td><?= $dl['nama_paket']; ?></td>
                                <td>Rp. <?= number_format($dl['harga_paket'] * $dl['jumlah_berat']) ?></td>
                                <td>
                                    <?php
                                    if ($dl['status_laundry'] == "Dalam antrian") {
                                        echo "<span class='badge badge-pill badge-warning'>" . $dl['status_laundry'] . " </span>";
                                    } else if ($dl['status_laundry'] == "Diproses") {
                                        echo "<span class='badge badge-pill badge-info'>" . $dl['status_laundry'] . " </span>";
                                    } else if ($dl['status_laundry'] == "Selesai") {
                                        echo "<span class='badge badge-pill badge-success'>" . $dl['status_laundry'] . " </span>";
                                    } else if ($dl['status_laundry'] == "Diambil") {
                                        echo "<span class='badge badge-pill badge-primary'>" . $dl['status_laundry'] . " </span>";
                                    } else {
                                        echo "<span class='badge badge-pill badge-danger'>" . $dl['status_laundry'] . " </span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/laundry/') . $dl['id'] ?>" class="btn btn-dark"><i class="fas fa-fw fa-info"></i> Detil</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->