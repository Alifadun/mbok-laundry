<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message'); ?>
    <div class="card shadow mb-4">
        <?php if ($this->session->userdata('role_id') != 1) { ?>
            <div class="card-header py-3">
                <div class="row">
                    <div class="float-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">Tambah Data</button>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tabel-data-laundry" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Isi Pesan</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
                            <th scope="col">Opsi</th>
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
                        <?php foreach ($pesan as $p) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $p['isi_pesan']; ?></td>
                                <td><?= $p['tanggal']; ?></td>
                                <td><?= $p['status']; ?></td>
                                <td>
                                    <a href="<?= base_url('user/detailPesan/' . $p['id']) ?>" class="btn btn-primary">Rincian</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tambah Pesan -->
    <div class="modal fade" tabindex="-1" id="tambahModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pesan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user/tambahPesan') ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Isi Pesan</label>
                            <textarea name="isi_pesan" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->