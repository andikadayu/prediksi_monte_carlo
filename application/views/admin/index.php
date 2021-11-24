<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Kelola Admin</h1>
            <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Stock Barang</li>
                        </ol> -->
            <div class="card mb-4">
                <div class="card-header">
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                        Tambah Admin
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Admin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($login as $data) :
                                    $i = $data->iduser;
                                    $email = $data->email;
                                    $iduser = $data->iduser;
                                    $password = $data->password;

                                ?>

                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $email; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $iduser; ?>">
                                                Edit
                                            </button>
                                            <input type="hidden" name="iduserygmaudihapus" value="<?= $iduser; ?>">
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $iduser; ?>">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="edit<?= $iduser; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Admin</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="post" action="<?= base_url('Admin/Update') ?>">
                                                    <div class="modal-body">
                                                        <input type="email" name="email" value="<?= $email; ?>" class="form-control" placeholder="Email" required><br>
                                                        <input type="password" name="password" value="<?= $password; ?>" class="form-control" placeholder="Masukan Password baru"><br>
                                                        <input type="hidden" name="iduser" value="<?= $iduser; ?>">
                                                        <button type="submit" class="btn btn-primary" name="updateadmin">Submit</button>
                                                    </div>
                                                </form>

                                                <!-- Modal footer
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div> -->

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="delete<?= $iduser; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Barang</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="post" action="<?= base_url('Admin/Delete') ?>">
                                                    <div class="modal-body">
                                                        Apakah Anda Yakin Ingin Menghapus User <?= $email; ?>?<br><br>
                                                        <input type="hidden" name="iduser" value="<?= $iduser; ?>">
                                                        <button type="submit" class="btn btn-danger" name="hapusadmin">Hapus</button>
                                                    </div>
                                                </form>

                                                <!-- Modal footer
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div> -->

                                            </div>
                                        </div>
                                    </div>

                                <?php
                                endforeach;
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Admin</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post" action="<?= base_url('Admin/Insert') ?>">
                <div class="modal-body">
                    <input type="email" name="email" placeholder="Masukan Email Admin Baru" class="form-control" required><br>
                    <input type="password" name="password" placeholder="Password" class="form-control" required><br>
                    <button type="submit" class="btn btn-primary" name="addnewadmin">Submit</button>
                </div>
            </form>

            <!-- Modal footer
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div> -->

        </div>
    </div>
</div>