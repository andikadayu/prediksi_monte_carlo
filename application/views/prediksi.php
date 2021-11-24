<!-- Page content-->
<div style="margin: 5% 8%;">
	<div class="container-fluid">
		<h1 class="mt-4">Prediksi Penjualan</h1>
		<p>Menampilkan prediksi penjualan untuk beberapa hari kedepan bergantung dengan inputan pengguna,dan prediksi penjualan ini menggunakan metode <b>Monte Carlo</b> sederhana.</p>
		<div class="mt-4 mb-4">
			<form action="<?= base_url('Prediksi/index') ?>" method="get">
				<div class="form-group first last mb-4">
					<label for="hari">Barang </label>
					<select name="barang" id="barang" class="form-control">
						<?php foreach ($barang as $b) : ?>
							<option value="<?= $b->id_brg ?>" <?php if ($b->id_brg == $this->input->get('barang')) {
																	echo 'selected';
																} ?>><?= $b->barang ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group first last mb-4">
					<label for="hari">Prediksi untuk (hari) </label>
					<input type="number" class="form-control mt-3" pattern="[0-9]*" id="hari" name="hari" min='0' placeholder="5 hari" value="<?= $this->input->get('hari') ?>" required>
				</div>
				<div class="d-grid gap-2">
					<button type="submit" class="btn btn-primary">Calculate</button>
				</div>
			</form>
		</div>
		<?php if ($prob != null) : ?>
			<hr>
			<h4>Tabel Probabilitas</h4>
			<p>pada tabel ini , data didapat dari banyaknya transaksi yang telah terjadi di beberapa hari sebelumnya, jadi ketika anda mengetikkan untuk 10 hari, pastikan anda mempunyai data penjualan dalam kurun waktu 10 hari kebelakang</p>
			<small>jika disalah satu hari nya tidak ada catatan maka otomatis tidak ditampilkan di laman website nya dan dianggap akan mendapatkan nilai 0.</small>
			<hr>
			<div style="margin-top: 30px;">
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Barang</th>
							<th scope="col">Tanggal</th>
							<th scope="col">Jumlah</th>
							<th scope="col">Probabilitas</th>
							<th scope="col">Komulatif</th>
							<th scope="col">Min Number</th>
							<th scope="col">Max Number</th>
						</tr>
					</thead>
					<tbody>
						<?php $n = 1;
						foreach ($prob as $p) : ?>
							<tr>
								<th scope="row"><?= $n ?></th>
								<td><?= $p->barang ?></td>
								<td><?= $p->tanggal ?></td>
								<td><?= $p->total ?></td>
								<td><?= $montekarlo['prob'][$n - 1] ?></td>
								<td><?= $montekarlo['komu'][$n - 1] ?></td>
								<td><?= $montekarlo['mini'][$n - 1] ?></td>
								<td><?= $montekarlo['maxi'][$n - 1] ?></td>
							</tr>
						<?php $n++;
						endforeach; ?>
						<tr>
							<td colspan="3">Total</td>
							<td><b><?= $montekarlo['total'] ?></b></td>
							<td><b><?= $montekarlo['komu'][$n - 2] ?></b></td>
						</tr>
					</tbody>
				</table>
			</div>

			<hr>
			<h4>Tabel Prediksi</h4>
			<p>Setelah penghitungan probabilitas dan mendapatkan angka max, maka berlanjut ke tahap prediksi dimana bilangan acak akan di bandingkan dengan angka max. </p>
			<hr>
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th>Periode Permintaan</th>
						<th>Nilai Random</th>
						<th>Prediksi Jumlah Pesanan</th>
					</tr>
				</thead>
				<tbody>
					<?php for ($i = 0; $i < count($prob); $i++) { ?>
						<tr>
							<td><?= $i + 1 ?></td>
							<td><?= $montekarlo['random'][$i]; ?></td>
							<td><?= $montekarlo['monte'][$i]; ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		<?php endif; ?>
	</div>
</div>