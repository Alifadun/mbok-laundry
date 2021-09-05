<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-lg-6 py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Nama Pelanggan Laundry</h6>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel-data-laundry" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">email</th>
                                    <th scope="col">dibuat</th>
                                    <th scope="col">akses pengguna</th>
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
                                <?php foreach ($tampilan as $t) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $t['name']; ?></td>
                                        <td><?= $t['email']; ?></td>
                                        <td><?= date('d F Y', ($t['date_created'])); ?></td>
                                        <td>
                                            <?php if ($t['role_id'] == 1) : ?>
                                                <p>Admin</p>
                                            <?php else : ?>
                                                <p>user</p>
                                            <?php endif; ?>
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
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->