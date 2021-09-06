<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card">
        <div class="card-body">
            <?= $this->session->flashdata('message'); ?>
            <h5 class="card-title">Isi Pakaian Laundry</h5>
            <form action="<?= base_url('admin/catatlaundry'); ?>" method="POST">
                <div class="form-group">
                    <label>Pelanggan</label>
                    <select name="id_pelanggan" class="form-control">
                        <?php foreach ($users as $user) : ?>
                            <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Masukkan Jumlah Pakaian </label>
                    <input type="number" class="form-control" id="jmlpakaian" name="jmlpakaian" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label>Masukkan Jumlah berat(kg)</label>
                    <input type="number" class="form-control" id="jmlberat" name="jmlberat" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label>Paket Laundry</label>
                    <select name="id_paket" class="form-control">
                        <?php foreach ($paket as $x) : ?>
                            <option value="<?= $x['id_paket'] ?>"><?= $x['nama_paket'] ?> - Rp. <?= number_format($x['harga_paket']) ?>/kg</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status Laundry</label>
                    <select name="status_laundry" class="form-control">
                        <option value="Dalam antrian">Dalam antrian</option>
                        <option value="Diproses">Diproses</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Diambil">Diambil</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status Pembayaran</label>
                    <select name="status_pembayaran" class="form-control">
                        <option value="Belum lunas">Belum lunas</option>
                        <option value="Lunas">Lunas</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-user">
                    Simpan
                </button>
            </form>
        </div>
    </div>