<!-- Page content-->
<div style="margin: 5% 8%;">
    <div class="container-fluid">
        <h1 class="mt-4">Data Barang</h1>
        <p>Pada laman ini anda dapat melakukan setting untuk data barang yang anda miliki. Anda dapat melakukan nya dengan cara mengklik tombol biru untuk menuju form tambah, button kuning untuk edit, dan button merah untuk menghapusnya.</p>
        <div>
            <a href="<?= base_url('Barang/addBarang') ?>" class="float-end btn btn-primary mb-3"><i class="fa fa-plus"></i></a>
            <table id="mytable">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Barang</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n=1; foreach($data as $d): ?>
                    <tr>
                        <th scope="row"><?= $n ?></th>
                        <td><?= $d->barang ?></td>
                        <td>Rp. <?= number_format($d->harga,2,",","."); ?></td>
                        <td>
                            <a href="<?= base_url('Barang/EditBarang/').$d->id_brg ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                            <a  onclick="return confirm('Apakah anda yakin ?')" href="<?= base_url('Barang/DeleteBarang/').$d->id_brg ?>" class="btn btn-danger"><i class="fa fa-eraser"></i></a>
                        </td>
                    </tr>
                    <?php $n++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

            
