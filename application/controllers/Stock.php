<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_all", "stock");
    }

    public function index()
    {
        if ($this->session->has_userdata('log')) {
            $countHabis = $this->getCountHabis();
            $all = $this->getAll();

            $data = array(
                'habis' => $countHabis,
                'stock' => $all
            );
            $judul = array('judul' => 'Stok Barang');
            $this->load->view('template/nHeader', $judul);
            $this->load->view('stock/index', $data);
            $this->load->view('template/nFooter');
            $this->load->view('template/endFooter');
        } else {
            redirect("Login");
        }
    }

    public function getCountHabis()
    {
        $temp = $this->stock->getData("stock", "*", null, "stock < 1")->result();
        return $temp;
    }

    public function getAll()
    {
        $temp = $this->stock->getData("stock", "*")->result();
        return $temp;
    }

    public function Insert()
    {
        $data = array(
            'namabarang' => $this->input->post('namabarang'),
            'deskripsi' => $this->input->post('deskripsi'),
            'stock' => $this->input->post('stock'),
        );

        $this->stock->ins("stock", $data);
        redirect('Stock');
    }

    public function Update()
    {
        $idb = array(
            'idbarang' => $this->input->post('idb'),
        );
        $data = array(
            'namabarang' => $this->input->post('namabarang'),
            'deskripsi' => $this->input->post('deskripsi')
        );

        $this->stock->upd("stock", $data, $idb);
        redirect('Stock');
    }

    public function Delete()
    {
        $idb = array(
            'idbarang' => $this->input->post('idb'),
        );
        $this->stock->del("stock", $idb);
        redirect('Stock');
    }
}
