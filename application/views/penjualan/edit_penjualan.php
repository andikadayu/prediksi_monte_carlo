<!-- Page content-->
<div style="margin: 5% 8%;">
    <div class="container-fluid">
        <h1 class="mt-4">Add Data Penjualan</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quas commodi est beatae facere.</p>
        <div class="mt-4">
            <form action="<?= base_url('Penjualan/UpdatePenjualan') ?>" method="post">
            
                <div class="form-group first last mb-4">
                    <input type="text" name="id" value="<?= $this->uri->segment(3) ?>" hidden>
                    <label for="Barang">Barang</label>
                    <select class="form-control" id="Barang" name="Barang">
                        <?php foreach($barang as $d): ?>
                            <option value="<?= $d->id_brg ?>" <?php if($data->id_barang == $d->id_brg): echo 'selected';  endif; ?>><?= $d->barang ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group last mb-4">
                    <label for="Jumlah">Jumlah</label>
                    <input type="number" class="form-control" id="Jumlah" name="Jumlah" value="<?= $data->jumlah ?>" min="0" required>
                </div>
                <div class="form-group last mb-4">
                    <label for="tanggal">tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $data->tanggal ?>" required>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn text-white btn-block btn-primary" type="submit"> Submit </button>
                    <a class="btn text-white btn-block btn-danger" href="<?= base_url('Penjualan') ?>">Kembali</a>

                </div>
            </form>
        </div>
    </div>
</div>

            
