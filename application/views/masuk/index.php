<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Barang Masuk</h1>
            <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Stock Barang</li>
                        </ol> -->
            <div class="card mb-4">
                <div class="card-header">
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                        Tambah Barang
                    </button>
                    <a href="<?= base_url("Exports/Masuk") ?>" class="btn btn-info">Export Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($masuk as $data) :
                                    $idb = $data->idbarang;
                                    $idm = $data->idmasuk;
                                    $tanggal = $data->tanggal;
                                    $namabarang = $data->namabarang;
                                    $qty = $data->qty;
                                    $keterangan = $data->keterangan;

                                ?>

                                    <tr>
                                        <td><?= $tanggal; ?></td>
                                        <td><?= $namabarang; ?></td>
                                        <td><?= number_format($qty); ?></td>
                                        <td><?= $keterangan; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $idm; ?>">
                                                Edit
                                            </button>
                                            <input type="hidden" name="idbarangygmaudihapus" value="<?= $idb; ?>">
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idm; ?>">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="edit<?= $idm; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Barang</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="post" action="<?= base_url("Masuk/Update") ?>">
                                                    <div class="modal-body">
                                                        <input type="text" name="keterangan" value="<?= $keterangan; ?>" class="form-control" required><br>
                                                        <input type="number" name="qty" value="<?= $qty; ?>" class="form-control" required><br>
                                                        <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                        <input type="hidden" name="idm" value="<?= $idm; ?>">
                                                        <button type="submit" class="btn btn-primary" name="updatebarangmasuk">Submit</button>
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
                                    <div class="modal fade" id="delete<?= $idm; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Barang</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="post" action="<?= base_url("Masuk/Delete") ?>">
                                                    <div class="modal-body">
                                                        Apakah Anda Yakin Ingin Menghapus <?= $namabarang; ?>?<br><br>
                                                        <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                        <input type="hidden" name="kty" value="<?= $qty; ?>">
                                                        <input type="hidden" name="idm" value="<?= $idm; ?>">
                                                        <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Hapus</button>
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
    </main>
</div>
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang Masuk</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post" action="<?= base_url("Masuk/Insert") ?>">
                <div class="modal-body">

                    <select name="barangnya" class="form-control">
                        <?php
                        foreach ($stock as $fetcharray) :
                            $namabarangnya = $fetcharray->namabarang;
                            $idbarangnya = $fetcharray->idbarang; ?>

                            <option value="<?= $idbarangnya; ?>"><?= $namabarangnya; ?></option>

                        <?php
                        endforeach;
                        ?>

                    </select><br>

                    <input type="number" name="qty" placeholder="Quantity" class="form-control" required><br>
                    <input type="text" name="penerima" placeholder="penerima" class="form-control" required><br>
                    <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button>
                </div>
            </form>

            <!-- Modal footer
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div> -->

        </div>
    </div>
</div>