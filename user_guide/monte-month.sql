select k.qty,
count(k.qty) as jumlah,
(select count(k2.qty) from keluar k2 where k2.idbarang = '44' and k2.qty < 10 and  year(k2.tanggal) = 2020) as total,
concat(month(k.tanggal),'/',year(k.tanggal)) as tanggal,s.namabarang from keluar k
inner join stock s on k.idbarang = s.idbarang
where k.idbarang = 44
and k.qty < 10
and year(k.tanggal) = 2020 
group by k.qty,month(k.tanggal)
order by k.qty asc ,k.tanggal asc