<!-- Page content-->
<div style="margin: 5% 8%;">
    <div class="container-fluid">
        <h1 class="mt-4">Data Penjualan</h1>
        <p>Informasi mengenai keseluruhan pencatatan penjualan yang sudah terjadi, dan disini anda dapat juga melakukan pencatatan(button biru), edit(button kuning), maupun delete(button merah) data.</p>
        <div>
            <a href="<?= base_url('Penjualan/addPenjualan') ?>" class="float-end btn btn-primary mb-2"><i class="fa fa-plus"></i></a>
            <table id="mytable">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Barang</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n=1; foreach($data as $d): ?>
                    <tr>
                        <th scope="row"><?= $n ?></th>
                        <td><?= $d->barang ?></td>
                        <td><?= $d->jumlah ?></td>
                        <td><?php $date=date_create($d->tanggal); echo date_format($date,"d M, Y"); ?></td>
                        <td>
                            <a href="<?= base_url('Penjualan/EditPenjualan/').$d->id ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                            <a href="<?= base_url('Penjualan/DeletePenjualan/').$d->id ?>" class="btn btn-danger"><i class="fa fa-eraser"></i></a>
                        </td>
                    </tr>
                    <?php $n++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

            
