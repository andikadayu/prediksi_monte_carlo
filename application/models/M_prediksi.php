<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_prediksi extends CI_Model {

    public function makshari()
    {
         $query = $this->db->query("SELECT * from penjualan GROUP BY tanggal");
         return $query;
    }

    public function probabilitas($day, $brg)
    {
        return $this->db->query("SELECT barang, CONCAT(DAY(tanggal), '/', Month(tanggal)) as tanggal, sum(jumlah) as total
        FROM `penjualan` 
        JOIN barang on barang.id_brg = penjualan.id_barang 
        where tanggal between date_sub(now(),INTERVAL ".$day." day) and now()  and id_brg = ".$brg."
        GROUP BY CONCAT(Day(tanggal)), id_barang;");
    }

	public function customProb($day, $brg)
	{
		return $this->db->query("SELECT barang, CONCAT(DAY(tanggal), '/', Month(tanggal)) as tanggal, sum(jumlah) as total 
		FROM `penjualan` 
		JOIN barang on barang.id_brg = penjualan.id_barang 
		where id_brg = ".$brg." 
		GROUP BY CONCAT(Day(tanggal)), id_barang 
		ORDER BY id DESC 
		LIMIT ".$day."");
	}
	
}

/* End of file M_prediksi.php */
