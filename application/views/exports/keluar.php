<html>

<head>
    <title>DATA BARANG KELUAR</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
    <div class="container">
        <!-- <h2>Stock Bahan</h2> -->
        <a href="#"><img src="<?= base_url('assets/templete/') ?>logo/pegadaian-logo.png" height="75px" width="300px"></a><br><br><br><br>
        <div class="data-tables datatable-dark">

            <!-- Masukkan table nya disini, dimulai dari tag TABLE -->
            <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Penerima</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($datas as $data) :
                        $idk = $data->idkeluar;
                        $idb = $data->idbarang;
                        $tanggal = $data->tanggal;
                        $namabarang = $data->namabarang;
                        $qty = $data->qty;
                        $penerima = $data->penerima;

                    ?>

                        <tr>
                            <td><?= $tanggal; ?></td>
                            <td><?= $namabarang; ?></td>
                            <td><?= $qty; ?></td>
                            <td><?= $penerima; ?></td>
                        </tr>

                    <?php
                    endforeach;
                    ?>

                </tbody>
            </table>
            <a href="<?= base_url("Keluar") ?>" class="btn btn-info">BACK</a>
        </div>
    </div>

    <script defer>
        $(document).ready(function() {
            $('#mauexport').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>



</body>

</html>