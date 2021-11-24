<!-- Page content-->
<div style="margin: 5% 8%;">
    <div class="container-fluid">
        <h1 class="mt-4">Add Data Barang</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quas commodi est beatae facere.</p>
        <div class="mt-4">
            <form action="<?= base_url('Barang/UpdateBarang') ?>" method="post">
            
                <div class="form-group first last mb-4">
                    <input type="text" name="id" value="<?= $this->uri->segment(3) ?>" hidden>
                    <label for="Barang">Barang</label>
                    <input type="text" class="form-control" id="Barang" name="Barang" value="<?= $data->barang ?>" required>
                </div>
                <div class="form-group last mb-4">
                    <label for="Jumlah">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="<?= $data->harga ?>" required>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn text-white btn-block btn-primary" type="submit"> Submit </button>
                    <a class="btn text-white btn-block btn-danger" href="<?= base_url('Barang') ?>">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

            
