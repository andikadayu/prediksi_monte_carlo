<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_all extends CI_Model
{

    public function getData($table, $select = null, $join = null, $where = null)
    {
        $sel = "*";
        if ($select != null) {
            $sel = $select;
        }
        $sql = "SELECT $sel FROM $table";

        if ($join != null) {
            $sql .= " $join";
        }

        if ($where != null) {
            $sql .= " Where $where";
        }

        return $this->db->query($sql);
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

    public function customPredict($idbarang, $from, $until)
    {
        return $this->db->query("
        select 
        k.qty,
        count(k.qty) as jumlah,
        (select count(k2.qty) from keluar k2 where k2.idbarang = '$idbarang' and k2.qty < 10 and  k2.tanggal between '$from' and '$until') as total,
        k.tanggal,s.namabarang from keluar k
        inner join stock s on k.idbarang = s.idbarang
        where k.idbarang = '$idbarang'
        and k.qty < 10
        and k.tanggal between '$from' and '$until'
        group by qty
        ");
    }
}
