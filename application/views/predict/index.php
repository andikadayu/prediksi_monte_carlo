<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Prediksi Barang</h1>
            <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Stock Barang</li>
                        </ol> -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="get" action="<?= base_url("Predict") ?>">
                        <div class="form-group">
                            <label for="idbarang">Select List</label>
                            <select name="idbarang" id="idbarang" class="form-control" required aria-required="true">
                                <option value="" selected disabled>--Pilih Barang---</option>
                                <?php foreach ($stock as $st) : ?>
                                    <option value="<?= $st->idbarang ?>" <?php if (!empty($_GET['ranges'])) {
                                                                                if ($st->idbarang == $_GET['idbarang']) {
                                                                                    echo 'selected';
                                                                                }
                                                                            } ?>><?= $st->namabarang ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ranges">Jangka Waktu</label>
                            <input type="text" name="ranges" id="ranges" class="form-control" value="<?php if (!empty($_GET['ranges'])) {
                                                                                                            echo $_GET['ranges'];
                                                                                                        } ?>">
                        </div>
                        <button type="submit" class="btn btn-info btn-md">Prediksi</button>
                    </form>
                </div>
            </div>
            <?php if ($prob != null) : ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Diagram Data Barang Keluar</h5>
                        <button class="btn btn-sm btn-info" id="button_exp_pdf">
                            <i class="fa fa-file-pdf"></i> Export Pdf
                        </button>
                        <canvas style="background-color: white;" id="myChart" width="auto" height="110" title="Diagram Data"></canvas>
                    </div>
                </div>


                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Hasil Prediksi</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm" id="mauexport" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                    <tr>
                                        <th rowspan="2"> # </th>
                                        <th rowspan="2"> Pengeluaran/Bulan </th>
                                        <th rowspan="2">Frekuensi</th>
                                        <th rowspan="2">Probabilitas</th>
                                        <th rowspan="2">probabilitas Kumulatif</th>
                                        <th colspan="2">
                                            <center>Interval</center>
                                        </th>
                                        <th colspan="4">
                                            <center>Hasil Prediksi</center>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Awal</th>
                                        <th>Akhir</th>
                                        <th>Angka Acak</th>
                                        <th>Hari</th>
                                        <th>Jumlah Barang</th>
                                        <th>Persentase</th>
                                    </tr>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    $akhir = [];
                                    foreach ($prob as $data) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $data->qty ?></td>
                                            <td><?= $data->jumlah ?></td>
                                            <td><?= $proba[$no - 1] ?></td>
                                            <td><?= $komu[$no - 1]  ?></td>
                                            <td>
                                                <?= $mini[$no - 1] ?>
                                            </td>
                                            <td><?= $maxi[$no - 1] ?></td>
                                            <td><?= $random[$no - 1] ?></td>
                                            <td>Hari Ke-<?= $no ?></td>
                                            <td>
                                                <?= $monte[$no - 1] ?>
                                            </td>
                                            <td>
                                                <?= round($persen[$no - 1], 0) ?> %
                                            </td>

                                        </tr>
                                    <?php $no++;
                                    endforeach; ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Jumlah</td>
                                        <td><?= number_format($total) ?></td>
                                        <td><?= $cprob ?></td>
                                        <td> - </td>
                                        <td> - </td>
                                        <td> - </td>
                                        <td> - </td>
                                        <td> - </td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
    </main>
</div>