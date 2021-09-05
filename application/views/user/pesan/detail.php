<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= $pesan[0]['name']; ?>
        </div>
        <div class="card-body">
            <?= $pesan[0]['isi_pesan']; ?>
        </div>
    </div>

    <h1 class="h3 mb-4 text-gray-800">Percakapan</h1>
    <?php foreach ($detailPesan as $dp) : ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <?= $dp['name']; ?>
            </div>
            <div class="card-body">
                <?= $dp['isi_balasan']; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <?php if ($pesan[0]['status'] == 'Open') { ?>
        <div class="card shadow mb-4">
            <form action="<?= base_url('user/balasPesan') ?>" method="POST">
                <input type="hidden" name="pesan_id" value="<?= $this->uri->segment('3') ?>">
                <div class="card-body">
                    <div class="form-group">
                        <textarea name="isi_balasan" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tutupModal">
                        Tutup Pesan
                    </button>
                    <button type="submit" class="btn btn-success">
                        Balas
                    </button>
                </div>
            </form>
        </div>
    <?php } ?>

    <!-- Selesai Modal -->
    <div class="modal fade" tabindex="-1" id="tutupModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tutup Pesan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user/tutupPesan') ?>" method="POST">
                    <input type="hidden" name="pesan_id" value="<?= $this->uri->segment('3') ?>">
                    <div class="modal-body">
                        Tutup pesan jika Anda merasa pesan ini sudah selesai.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Selesai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->