<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">

        <div class="col-sm-7 offset-md-1">
            <div class="card">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <h5 class="card-title">Catatan Hutang Baru</h5>
                    <form action="<?= base_url('admin/catatlaundry'); ?>" method="POST">
                        <div class="form-group">
                            <label for="nama">Masukkan Nama Pelanggan</label>
                            <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp">

                        </div>
                        <div class="form-group">
                            <label for="nama">Masukkan Jumlah Pakaian </label>
                            <input type="number" class="form-control" id="jmlpakaian" name="jmlpakaian" aria-describedby="emailHelp">

                        </div>
                        <div class="form-group">
                            <label for="hutang">Masukkan Jumlah berat(kg)</label>
                            <input type="number" class="form-control" id="jmlberat" name="jmlberat" aria-describedby="emailHelp">
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Buat Catatan Baru
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>