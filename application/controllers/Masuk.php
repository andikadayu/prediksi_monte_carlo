<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_all", "stock");
    }

    public function index()
    {
        if ($this->session->has_userdata('log')) {
            $stock = $this->getStock();
            $all = $this->getAll();

            $data = array(
                'stock' => $stock,
                'masuk' => $all
            );
            $judul = array('judul' => 'Barang Masuk');
            $this->load->view('template/nHeader', $judul);
            $this->load->view('masuk/index', $data);
            $this->load->view('template/nFooter');
            $this->load->view('template/endFooter');
        } else {
            redirect("Login");
        }
    }

    public function getStock()
    {
        $temp = $this->stock->getData("stock", "*")->result();
        return $temp;
    }

    public function getAll()
    {
        $temp = $this->stock->getData("masuk m, stock s", "*", null, "s.idbarang = m.idbarang")->result();
        return $temp;
    }

    public function getQty($table, $select, $where)
    {
        $temp = $this->stock->getData($table, $select, null, $where)->result();
        return $temp;
    }

    public function Insert()
    {
        $barangnya = $this->input->post('barangnya');
        $penerima = $this->input->post('penerima');
        $qty = $this->input->post('qty');

        $datainsert = array(
            'idbarang' => $barangnya,
            'keterangan' => $penerima,
            'qty' => $qty,
        );

        $qtyCheck = $this->getQty("stock", "*", "idbarang='$barangnya'");
        $qtyBefore = $qtyCheck[0]->stock;
        $qtyNow = $qtyBefore + $qty;

        $dataupdate = array(
            "stock" => $qtyNow
        );

        $idbar = array("idbarang" => $barangnya);

        $this->stock->ins("masuk", $datainsert);
        $this->stock->upd("stock", $dataupdate, $idbar);
        redirect('Masuk');
    }

    public function Update()
    {
        $idb = $this->input->post('idb');
        $idm = $this->input->post('idm');
        $deskripsi = $this->input->post('keterangan');
        $qty = $this->input->post('qty');

        $chekstok = $this->getQty("stock", "*",  "idbarang='$idb'");
        $stockskrg = $chekstok[0]->stock;

        $checkqty = $this->getQty("masuk", "*",  "idmasuk='$idm'");
        $qtyskrg = $checkqty[0]->qty;
        if ($qty > $qtyskrg) {
            $selisih = $qty - $qtyskrg;
            $kurangin = $stockskrg - $selisih;
        } else {
            $selisih = $qtyskrg - $qty;
            $kurangin = $stockskrg + $selisih;
        }

        $kur = array("stock" => $kurangin);
        $update = array("qty" => $qty, "keterangan" => $deskripsi);

        $idmas = array('idmasuk' => $idm);
        $idbar = array('idbarang' => $idb);

        $this->stock->upd("stock", $kur, $idbar);
        $this->stock->upd("masuk", $update, $idmas);

        redirect('Masuk');
    }

    public function Delete()
    {
        $idb = $this->input->post('idb');
        $qty = $this->input->post('kty');
        $idm = $this->input->post('idm');

        $checkStock = $this->getQty("stock", "*", "idbarang='$idb'");
        $stock = $checkStock[0]->stock;

        $selisih = $stock - $qty;

        $kur = array("stock" => $selisih);

        $idmas = array('idmasuk' => $idm);
        $idbar = array('idbarang' => $idb);

        $this->stock->upd("stock", $kur, $idbar);
        $this->stock->del("masuk", $idmas);


        redirect('Masuk');
    }
}
