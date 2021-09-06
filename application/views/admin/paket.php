<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPaket"><i class="fas fa-plus"></i> Tambah Paket</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tabel-data-laundry" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Paket</th>
                            <th scope="col">Harga / Kg</th>
                            <th scope="col">Keterangan Paket</th>
                            <th scope="col" class="text-right">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($paket as $x) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $x['nama_paket']; ?></td>
                                <td><?= $x['harga_paket']; ?></td>
                                <td><?= $x['keterangan_paket']; ?></td>
                                <td class="text-right">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ubahPaket-<?= $x['id_paket'] ?>"><i class="fas fa-pencil-alt"></i> Ubah</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal-<?= $x['id_paket'] ?>"><i class="fas fa-trash"></i> Hapus</button>
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


<!-- Modal -->
<div class="modal fade" id="tambahPaket" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/tambahPaket') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Paket</label>
                        <input type="text" class="form-control" name="nama_paket">
                    </div>
                    <div class="form-group">
                        <label>Harga Paket</label>
                        <input type="number" class="form-control" name="harga_paket">
                    </div>
                    <div class="form-group">
                        <label>Keterangan Paket</label>
                        <textarea name="keterangan_paket" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($paket as $x) : ?>
    <div class="modal fade" id="ubahPaket-<?= $x['id_paket']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Paket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/ubahPaket') ?>" method="POST">
                <input type="hidden" name="id_paket" value="<?= $x['id_paket']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Paket</label>
                            <input type="text" class="form-control" name="nama_paket" value="<?= $x['nama_paket']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Harga Paket</label>
                            <input type="number" class="form-control" name="harga_paket" value="<?= $x['harga_paket'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Keterangan Paket</label>
                            <textarea name="keterangan_paket" cols="30" rows="10" class="form-control"><?= $x['keterangan_paket'] ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>