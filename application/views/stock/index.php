<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Stok Barang</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                        Tambah Barang
                    </button>
                    <a href="<?= base_url("Exports/Barang") ?>" class="btn btn-info">Export Data</a>
                </div>
                <div class="card-body">
                    <!-- Notofikasi Barang Habis -->
                    <?php
                    $no = 0;
                    foreach ($habis as $h) :
                    ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>PERHATIAN!</strong>Stock <?= $h->namabarang ?> Telah Habis
                        </div>
                    <?php
                    endforeach;
                    ?>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Deskripsi</th>
                                    <th>Stock</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($stock as $st) :
                                    $idb = $st->idbarang;
                                    $namabarang = $st->namabarang;
                                    $deskripsi = $st->deskripsi;
                                    $stock = $st->stock;
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $namabarang ?></td>
                                        <td><?= $deskripsi ?></td>
                                        <td><?= $stock ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $idb; ?>">
                                                Edit
                                            </button>
                                            <input type="hidden" name="idbarangygmaudihapus" value="<?= $idb; ?>">
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idb; ?>">
                                                Delete
                                            </button>
                                        </td>

                                    </tr>
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="edit<?= $idb; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Barang</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="post" action="<?= base_url("Stock/Update") ?>">
                                                    <div class="modal-body">
                                                        <input type="text" name="namabarang" value="<?= $namabarang; ?>" class="form-control" required><br>
                                                        <input type="text" name="deskripsi" value="<?= $deskripsi; ?>" class="form-control" required><br>
                                                        <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                        <button type="submit" class="btn btn-primary" name="updatebarang">Submit</button>
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
                                    <div class="modal fade" id="delete<?= $idb; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Barang</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="post" action="<?= base_url("Stock/Delete") ?>">
                                                    <div class="modal-body">
                                                        Apakah Anda Yakin Ingin Menghapus <?= $namabarang; ?>?<br><br>
                                                        <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                        <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
                                                    </div>
                                                </form>

                                                <!-- Modal footer
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div> -->

                                            </div>
                                        </div>
                                    </div>


                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post" action="<?= base_url("Stock/Insert") ?>">
                <div class="modal-body">
                    <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required><br>
                    <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required><br>
                    <input type="number" name="stock" placeholder="Stock" class="form-control" required><br>
                    <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
                </div>
            </form>

            <!-- Modal footer
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div> -->

        </div>
    </div>
</div>