<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-lg-6 py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Nama Laundry</h6>
                </div>

            </div>
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
                            <th scope="col">Jumlah Harga</th>
                            <?php if ($this->session->userdata('role_id') == 1) { ?>
                                <th scope="col">Opsi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <!--<tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                </tr>
                            </tfoot>-->
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($datalaundry as $dl) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $dl['tanggal']; ?></td>
                                <td><?= $dl['nama_pelanggan']; ?></td>
                                <td><?= $dl['jumlah_pakaian']; ?></td>
                                <td><?= $dl['jumlah_berat']; ?> Kg</td>
                                <td><?= $dl['harga']; ?></td>
                                <?php if ($this->session->userdata('role_id') == 1) { ?>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal-<?= $dl['id'] ?>"><i class="fas fa-trash"></i> Hapus</button>
                                    </td>
                                <?php } ?>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Data -->
    <?php if ($this->session->userdata('role_id') == 1) { ?>

        <?php foreach ($datalaundry as $dl) : ?>
            <div class="modal fade" tabindex="-1" id="hapusModal-<?= $dl['id'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Data?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('user/hapusDataLaundry') ?>" method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?= $dl['id'] ?>">
                                <table class="table">
                                    <tr>
                                        <th>
                                            Nama Pelanggan
                                        </th>
                                        <td>
                                            <?= $dl['nama_pelanggan']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Jumlah Pakaian
                                        </th>
                                        <td>
                                            <?= $dl['jumlah_pakaian']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Jumlah Berat
                                        </th>
                                        <td>
                                            <?= $dl['jumlah_berat']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Harga
                                        </th>
                                        <td>
                                            <?= $dl['harga']; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php } ?>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->