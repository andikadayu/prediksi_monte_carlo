<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exports extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_all", "stock");
    }

    public function getAll($table, $where = null)
    {
        $temp = $this->stock->getData($table, "*", null, $where)->result();
        return $temp;
    }

    public function Barang()
    {
        if ($this->session->has_userdata('log')) {
            $barang = $this->getAll("stock");
            $data = array(
                "datas" => $barang
            );

            $this->load->view("exports/export", $data);
        } else {
            redirect("Login");
        }
    }

    public function Keluar()
    {
        if ($this->session->has_userdata('log')) {
            $barang = $this->getAll("keluar k, stock s", "s.idbarang = k.idbarang");
            $data = array(
                "datas" => $barang
            );

            $this->load->view("exports/keluar", $data);
        } else {
            redirect("Login");
        }
    }

    public function Masuk()
    {
        if ($this->session->has_userdata('log')) {
            $barang = $this->getAll("masuk m, stock s", "s.idbarang = m.idbarang");
            $data = array(
                "datas" => $barang
            );

            $this->load->view("exports/masuk", $data);
        } else {
            redirect("Login");
        }
    }
}
