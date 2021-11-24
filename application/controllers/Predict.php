<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Predict extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_all', 'predict');
    }

    public function index()
    {
        if ($this->session->has_userdata('log')) {
            if ($this->input->get('idbarang') != null && $this->input->get('ranges') != null) {
                $dr = explode(" - ", $this->input->get('ranges'));
                $from = date_create($dr[0]);
                $until = date_create($dr[1]);
                $idbarang = $this->input->get('idbarang');

                // get data barang keluar
                $data = $this->predict->customPredict($idbarang, date_format($from, 'Y-m-d'), date_format($until, 'Y-m-d'))->result();

                // cari tau total barang keluar
                $totalBarang = $this->totalProb($data);
                // mencari probabilitas dengan cara jumlah dibagi total
                $probabilitas = $this->probabilitas($data, $totalBarang);
                // mencari komulatif dengan cara menambahkan bilangan probabilitas secara komulatif 
                $komulatif = $this->komulatif($probabilitas);
                // mencari nilai max atau range nya
                $maxi = $this->maxnumber($komulatif);
                // mencari nilai min atau range nya
                $mini = $this->minNumber($komulatif);

                // setalah mendapatkan data diatas maka dilakukan perbandingan dengan angka random
                // pertama dapatkan angka randomnya

                $random = $this->randomAngka($maxi);

                // kemudian dibandingkan dengan nilai $maxi untuk mendapat nilai prediksi yang diambil dari jumlah penjualannya
                $monte = $this->banding($random, $mini, $maxi, $data);
                // mendapatkan total probabilatas akhir
                $cprob = $this->jumlahProb($probabilitas);
                // menghitung persentase
                $persen = $this->getPercentage($data, $monte);


                // Mendapatkan Data Chart Pengeluaran
                $labelchart = $this->getLabelChart($data);
                $valuechart = $this->getValueChart($data);

                $chart = array(
                    "label" => $labelchart,
                    "nilai" => $valuechart,
                    "first" => date_format($from, "d-m-Y"),
                    "last" => date_format($until, "d-m-Y"),
                );


                $data = array(
                    'prob' => $data,
                    'total' => $totalBarang,
                    'proba' => $probabilitas,
                    'komu' => $komulatif,
                    'maxi' => $maxi,
                    'random' => $random,
                    'monte' => $monte,
                    'mini' => $mini,
                    'cprob' => $cprob,
                    'persen' => $persen
                );
            } else {
                $data['prob'] = null;
                $data['tl'] = 0;
                $chart = array(
                    "label" => null,
                    "nilai" => null,
                    "first" => null,
                    "last" => null,
                );
            }

            // mendapatkan semua data barang
            $barang = $this->getAll("stock", "*");
            $data['stock'] = $barang;
            $judul = array('judul' => 'Prediksi Barang');
            $this->load->view('template/nHeader', $judul);
            $this->load->view('predict/index', $data);
            $this->load->view('template/nFooter');
            $this->load->view('predict/customjs', $chart);
            $this->load->view('template/endFooter');
        } else {
            redirect("Login");
        }
    }

    public function getAll($table, $select, $join = null, $where = null)
    {
        $temp = $this->predict->getData($table, $select, $join, $where)->result();
        return $temp;
    }

    function totalProb($data)
    {
        $tl = 0;
        foreach ($data as $d) {
            $tl += $d->jumlah;
        }
        return $tl;
    }

    public function probabilitas($data, $tl)
    {
        $probabil = [];
        foreach ($data as $p) {
            $pbl = $p->jumlah / $tl;
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

        // mendapatkan nilai bilangan acak dari tabel bacak
        $rand = $this->getAll("bacak", "*");
        $getPanjang = $this->getAll("bacak", "COUNT(*) as jumlah_bacak");
        $panjangRand = $getPanjang[0]->jumlah_bacak - 1;

        for ($i = 0; $i < $panjang; $i++) {
            $random = $rand[rand(0, $panjangRand)]->bilangan_acak;
            array_push($temp, $random);
        }

        return $temp;
    }

    public function banding($random, $mini, $maxi, $data)
    {
        $panjang = count($random);
        $nilai = 0;
        $temp = [];
        $maxip = count($maxi);

        for ($i = 0; $i < $panjang; $i++) {
            for ($x = 0; $x < $maxip; $x++) {
                if ($random[$i] >= $mini[$x] && $random[$i] <= $maxi[$x]) {
                    $nilai = $data[$x]->qty;
                    array_push($temp, $nilai);
                }
            }
        }

        return $temp;
    }

    public function jumlahProb($probabilitass)
    {
        $temp = 0;

        for ($i = 0; $i < count($probabilitass); $i++) {
            $temp += $probabilitass[$i];
        }

        return $temp;
    }

    public function getPercentage($data, $monte)
    {
        $panjang = count($data);
        $temp = [];

        for ($i = 0; $i < $panjang; $i++) {
            $real = $data[$i]->jumlah;
            $fre = $monte[$i];

            if ($real < $fre) {
                $persen = $real * 100 / $fre;
            } else {
                $persen = $fre * 100 / $real;
            }
            array_push($temp, $persen);
        }

        return $temp;
    }

    public function getLabelChart($data)
    {
        $temp = [];
        $panjang = count($data);
        for ($i = 0; $i < $panjang; $i++) {
            $label = $data[$i]->qty;
            array_push($temp, $label);
        }

        return $temp;
    }

    public function getValueChart($data)
    {
        $temp = [];
        $panjang = count($data);
        for ($i = 0; $i < $panjang; $i++) {
            $value = $data[$i]->jumlah;
            array_push($temp, $value);
        }
        return $temp;
    }
}
