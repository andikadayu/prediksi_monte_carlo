<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prediksi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('M_prediksi', 'prediksi');
		$this->load->model('M_basic', 'b');
	}

	public function index()
	{
		if ($this->input->get('barang') != null) {
			$data['prob'] = $this->prediksi->customProb($this->input->get('hari'), $this->input->get('barang'))->result();
			$data['montekarlo'] = $this->MonteCarlo($this->input->get('hari'), $this->input->get('barang'));
			// print_r(json_encode($data['montekarlo']));
		} else {
			$data['prob'] = null;
			$data['tl'] = 0;
		}
		$data['barang'] = $this->b->getData('barang')->result();
		$this->load->view('template/header');
		$this->load->view('prediksi', $data);
		$this->load->view('template/footer');
	}

	public function MonteCarlo($hari, $barang)
	{
		// get data penjualan
		$data = $this->prediksi->customProb($hari, $barang)->result();
		// cari tau total penjualan 
		$totalBarang = $this->totalProb($data);
		// mencari probabilitas dengan cara jumlah dibagi total
		$probabilitas = $this->probabilitas($data, $totalBarang);
		// mencari komulatif dengan cara menambahkan bilangan probabilitas secara komulatif 
		$komulatif = $this->komulatif($probabilitas);
		// mencari nilai max atau range nya
		$maxi = $this->maxnumber($komulatif);

		$mini = $this->minNumber($komulatif);

		// setalah mendapatkan data diatas maka dilakukan perbandingan dengan angka random
		// pertama dapatkan angka randomnya
		$random = $this->randomAngka($maxi);
		// kemudian dibandingkan dengan nilai $maxi untuk mendapat nilai prediksi yang diambil dari jumlah penjualannya
		$monte = $this->banding($random, $maxi, $data);

		$hasil = array(
			'data' => $data,
			'total' => $totalBarang,
			'prob' => $probabilitas,
			'komu' => $komulatif,
			'maxi' => $maxi,
			'random' => $random,
			'monte' => $monte,
			'mini' => $mini
		);

		return $hasil;
	}

	function totalProb($data)
	{
		$tl = 0;
		foreach ($data as $d) {
			$tl += $d->total;
		}
		return $tl;
	}

	public function probabilitas($data, $tl)
	{
		$probabil = [];
		foreach ($data as $p) {
			$pbl = $p->total / $tl;
			$pro = round($pbl, 2);
			array_push($probabil, $pro);
		}
		return $probabil;
	}

	public function komulatif($data)
	{
		// nilai yang pertama akan bernilai sama dengan probabilitas nya
		// nilai kedua dst akan ditambahkan dengan nilai sebelumnya
		// contoh jika dia di nomor ke 3 brarti nilai probabilitas no 3 akan di tambahkan dengan nilai probabiitas ke 2 dan ke 1

		$nilai = 0;
		$panjang = count($data);
		$temp = [];
		for ($i = 0; $i < $panjang; $i++) {
			$nilai += $data[$i];
			array_push($temp, round($nilai, 2));
		}
		return $temp;
	}

	public function maxNumber($data)
	{
		$nilai = 0;
		$panjang = count($data);
		$temp = [];
		for ($i = 0; $i < $panjang; $i++) {
			$nilai = $data[$i] * 100;
			array_push($temp, round($nilai));
		}
		return $temp;
	}

	public function minNumber($data)
	{
		$nilai = 0;
		$panjang = count($data);
		$temp = [];
		for ($i = 0; $i < $panjang; $i++) {
			if ($i == 0) {
				$nilai = 1;
				array_push($temp, round($nilai));
			} else {
				$nilai = $data[$i - 1] * 100 + 1;
				array_push($temp, round($nilai));
			}
		}
		return $temp;
	}

	public function randomAngka($data)
	{
		$panjang = count($data);
		$temp = [];
		for ($i = 0; $i < $panjang; $i++) {
			$random = rand(0, 100);
			array_push($temp, $random);
		}
		return $temp;
	}

	public function banding($random, $maxi, $data)
	{
		$panjang = count($random);
		$nilai = 0;
		$temp = [];

		for ($i = 0; $i < $panjang; $i++) {
			for ($x = 0; $x < $panjang; $x++) {
				if ($x == 0) {
					if ($random[$i] > 0 && $random[$i] < $maxi[$x]) :
						$nilai =  $data[0]->total;
						array_push($temp, $nilai);
					endif;
				} else {
					if ($random[$i] > $maxi[$x - 1] && $random[$i] <= $maxi[$x] + 1) :
						$nilai = $data[$x]->total;
						array_push($temp, $nilai);
					endif;
				}
			}
		}

		return $temp;
	}
}

/* End of file Prediksi.php */
