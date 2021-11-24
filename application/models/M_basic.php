<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_basic extends CI_Model
{

    public function getData($t, $w = null)
    {
        if ($t == 'penjualan') {
            $this->db->join('barang', 'barang.id_brg = penjualan.id_barang');
        }

        if ($w != null) {
            $this->db->where($w);
        }
        return $this->db->get($t);
    }

    public function ins($t, $object)
    {
        $this->db->insert($t, $object);
    }

    public function upd($t, $object, $w)
    {
        $this->db->update($t, $object, $w);
    }

    public function del($t, $w)
    {
        $this->db->delete($t, $w);
    }

    public function dashboard()
    {
        return $this->db->query("SELECT tanggal, sum(jumlah) as total FROM `penjualan` GROUP BY tanggal ORDER BY tanggal");
    }

    public function max()
    {
        return $this->db->query("SELECT tanggal, sum(jumlah) as total FROM `penjualan` GROUP BY tanggal ORDER BY total desc");
    }

    public function avg()
    {
        return $this->db->query("SELECT AVG(jumlah) as rerata FROM `penjualan` JOIN barang on barang.id_brg = penjualan.id_barang");
    }

    public function total()
    {
        return $this->db->query("SELECT sum(jumlah) as total FROM `penjualan`");
    }

    public function dashboardd()
    {
        return $this->db->query("SELECT tanggal, sum(jumlah) as total FROM `penjualan` where DATE(tanggal) = CURDATE() GROUP BY tanggal");
    }


    public function login($email, $password)
    {
        return $this->db->query("SELECT COUNT(*) as jumlah FROM `login` WHERE email = '$email' AND password = '$password'");
    }
}

/* End of file M_basic.php */
