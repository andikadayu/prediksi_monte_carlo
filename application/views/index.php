<?php
	if ($dataa != null) {
		$date = $dataa[0]['tanggal'];
    	$date = strtotime($date);
		$kmrn = strtotime("-1 day", $date);
	}	  

	$long = count($maks);
	$longD = count($data);
?>
<!-- Page content-->
<div style="margin: 5% 8%;">
	<div class="container-fluid">
		<h1 class="mt-4">Dashboard</h1>
		<div>
			<div class="row my-3">				
				<div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
					<div class="card">
						<h5 class="card-header">Penjualan tertinggi</h5>
						<div class="card-body">
							<h5 class="card-title"><?= $maks[0]->total ?></h5>
							<p class="card-text">Pada tanggal <?= date('d M', strtotime($maks[0]->tanggal)) ?>, Indonesia</p>
							<!-- <p class="card-text text-success">4.6% increase since last month</p> -->
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
					<div class="card">
						<h5 class="card-header">Penjualan Terendah</h5>
						<div class="card-body">
							<h5 class="card-title"><?= $maks[$long-1]->total ?></h5>
							<p class="card-text">Pada tanggal <?= date('d M', strtotime($maks[$long-1]->tanggal)) ?>, Indonesia</p>
							
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
					<div class="card">
						<h5 class="card-header">Rerata Penjualan</h5>
						<div class="card-body">
							<h5 class="card-title"><?= round($avg->rerata); ?></h5>
							<p class="card-text">mulai tanggal <?= date('d M', strtotime($data[0]['tanggal'])) ?> - <?= date('d M', strtotime($data[$longD-1]['tanggal'])) ?>, Indonesia</p>
							
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
					<div class="card">
						<h5 class="card-header">Penjualan Hari ini</h5	>
						<div class="card-body">
							<h5 class="card-title"><?php if($dataa != null): echo $dataa[0]['total']; else: echo 0;   endif; ?></h5>
							<p class="card-text">Pada tanggal <?= date('d M'); ?>, Indonesia</p>
							<p class="card-text text-success"><?php if($dataa != null): $i= count($data); echo $dataa[0]['total'] + $data[$i-1]['total']; else: echo 0; endif;  ?>  increase since last Day </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
