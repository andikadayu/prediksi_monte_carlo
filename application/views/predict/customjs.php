<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

<?php if ($label != null) : ?>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php foreach ($label as $key => $value) {
                                echo "'Pengeluaran Data " . $value . "',";
                            } ?>],
                datasets: [{
                    label: '# Total Pengeluaran',
                    data: [<?php foreach ($nilai as $key => $value) {
                                echo $value . ",";
                            } ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1.75
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: "Grafik Barang Keluar"
                    },
                    subtitle: {
                        display: true,
                        text: 'Periode <?= $first ?> s/d <?= $last ?>'
                    },
                    legend: {
                        display: false,
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        $('#button_exp_pdf').on('click', function(e) {
            e.preventDefault();
            let canvas = document.querySelector("#myChart");
            // create image
            let canvasimg = canvas.toDataURL("image/jpeg", 1.0);

            // create pdf from image
            let doc = new jsPDF('landscape');
            doc.setFontSize(20);
            doc.text(20, 20, "Diagram Data Barang Keluar");
            doc.addImage(canvasimg, 'JPEG', 10, 10, 280, 150);
            doc.save("diagram periode <?= $first ?> hingga <?= $last ?>.pdf");
        });
    </script>
<?php endif; ?>