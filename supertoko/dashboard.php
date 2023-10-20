<div class="row">

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">

        <div class="card">

            <div class="card-body p-3">

                <div class="row">

                    <div class="col-8">

                        <div class="numbers">

                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Unprocessed</p>

                            <h5 class="font-weight-bolder">

                                Request

                            </h5>

                            <?php

                            $queryRequest = "SELECT COUNT(*) AS jumlah_request

                                FROM request_id r

                                INNER JOIN toko_id t ON r.id_toko = t.id_toko

                                WHERE YEAR(r.date) = YEAR(CURDATE())

                                AND MONTH(r.date) = MONTH(CURDATE())

                                AND DAY(r.date) = DAY(CURDATE())

                                AND r.type_req = 'request'

                                AND r.status_req = 'unprocessed'";



                            $resultRequest = mysqli_query($conn, $queryRequest);



                            if ($resultRequest) {

                                $row = mysqli_fetch_assoc($resultRequest);

                                $jumlahRequestHariIni = $row['jumlah_request'];

                            } else {

                                // Handle error

                                $jumlahRequestHariIni = 0;

                            }

                            ?>

                            <p class="mb-0">

                                <span class="text-danger text-sm font-weight-bolder"><?= $jumlahRequestHariIni; ?> </span><span class="text-sm font-weight-bolder">Request Belum Dikerjakan</span>

                            </p>

                        </div>

                    </div>

                    <div class="col-4 text-end">

                        <div class="icon icon-shape bg-gradient-danger shadow-primary text-center rounded-circle">

                            <i class="ni ni-app text-lg opacity-10" aria-hidden="true"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">

        <div class="card">

            <div class="card-body p-3">

                <div class="row">

                    <div class="col-8">

                        <div class="numbers">

                            <p class="text-sm mb-0 text-uppercase font-weight-bold">UNPROCESSED</p>

                            <h5 class="font-weight-bolder">

                                Refill

                            </h5>

                            <?php

                            $queryRefill = "SELECT COUNT(*) AS jumlah_request

                                FROM request_id r

                                INNER JOIN toko_id t ON r.id_toko = t.id_toko

                                WHERE YEAR(r.date) = YEAR(CURDATE())

                                AND MONTH(r.date) = MONTH(CURDATE())

                                AND DAY(r.date) = DAY(CURDATE())

                                AND r.type_req = 'refill'
AND r.status_req = 'unprocessed'";



                            $resultRefill = mysqli_query($conn, $queryRefill);



                            if ($resultRefill) {

                                $row = mysqli_fetch_assoc($resultRefill);

                                $jumlahRefillHariIni = $row['jumlah_request'];

                            } else {

                                // Handle error

                                $jumlahRefillHariIni = 0;

                            }

                            ?>

                            <p class="mb-0">

                                <span class="text-success text-sm font-weight-bolder"><?= $jumlahRefillHariIni; ?></span>

                                <span class="text-sm font-weight-bolder">Refill Belum Dikerjakan</span>

                            </p>

                        </div>

                    </div>

                    <div class="col-4 text-end">

                        <div class="icon icon-shape bg-gradient-success shadow-danger text-center rounded-circle">

                            <i class="ni ni-email-83 text-lg opacity-10" aria-hidden="true"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">

        <div class="card">

            <div class="card-body p-3">

                <div class="row">

                    <div class="col-8">

                        <div class="numbers">

                            <p class="text-sm mb-0 text-uppercase font-weight-bold">ON PROCESSED</p>

                            <h5 class="font-weight-bolder">

                                Request

                            </h5>

                            <?php

                            $queryOnProcessRequest = "SELECT COUNT(*) AS jumlah_request

    FROM request_id r

    INNER JOIN toko_id t ON r.id_toko = t.id_toko

    WHERE YEAR(r.date) = YEAR(CURDATE())

    AND MONTH(r.date) = MONTH(CURDATE())

    AND DAY(r.date) = DAY(CURDATE())

    AND r.type_req = 'request'

    AND r.status_req = 'On Process'";



                            $resultOnProcessRequest = mysqli_query($conn, $queryOnProcessRequest);



                            if ($resultOnProcessRequest) {

                                $row = mysqli_fetch_assoc($resultOnProcessRequest);

                                $jumlahOnProcessRequestHariIni = $row['jumlah_request'];

                            } else {

                                // Handle error

                                $jumlahOnProcessRequestHariIni = 0;

                            }

                            ?>



                            <p class="mb-0">

                                <span class="text-danger text-sm font-weight-bolder"><?= $jumlahOnProcessRequestHariIni; ?></span>

                                <span class="text-sm font-weight-bolder">Request Sedang Dikerjakan</span>

                            </p>

                        </div>

                    </div>

                    <div class="col-4 text-end">

                        <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">

                            <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-sm-6">

        <div class="card">

            <div class="card-body p-3">

                <div class="row">

                    <div class="col-8">

                        <div class="numbers">

                            <p class="text-sm mb-0 text-uppercase font-weight-bold">ON PROCESSED</p>

                            <h5 class="font-weight-bolder">

                                Refill </h5>

                            <?php

                            $queryOnProcessRefill = "SELECT COUNT(*) AS jumlah_request

    FROM request_id r

    INNER JOIN toko_id t ON r.id_toko = t.id_toko

    WHERE YEAR(r.date) = YEAR(CURDATE())

    AND MONTH(r.date) = MONTH(CURDATE())

    AND DAY(r.date) = DAY(CURDATE())

    AND r.type_req = 'refill'

    AND r.status_req = 'On Process'";



                            $resultOnProcessRefill = mysqli_query($conn, $queryOnProcessRefill);



                            if ($resultOnProcessRefill) {

                                $row = mysqli_fetch_assoc($resultOnProcessRefill);

                                $jumlahOnProcessRefillHariIni = $row['jumlah_request'];

                            } else {

                                // Handle error

                                $jumlahOnProcessRefillHariIni = 0;

                            }

                            ?>



                            <p class="mb-0">

                                <span class="text-success text-sm font-weight-bolder"><?= $jumlahOnProcessRefillHariIni; ?></span> <span class="text-sm font-weight-bolder">Refill Sedang Dikerjakan</span>



                            </p>

                        </div>

                    </div>

                    <div class="col-4 text-end">

                        <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">

                            <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="row mt-4">

    <div class="col-lg-7 mb-lg-0 mb-4">

        <div class="card z-index-2 h-100">

            <div class="card-header pb-0 pt-3 bg-transparent d-flex justify-content-between align-items-center">

                <h6 class="text-capitalize">Pilih Barang Berdasarkan

                    <br> SKU Toko

                </h6>

                <form action="" method="post" class="d-flex">

                    <div class="input-group">



                        <span class="input-group-text text-body"><button style="border: 0px solid;" type="submit" name="caridata"><i class="fas fa-search" aria-hidden="true"></i></button></span>

                        <input type="text" class="form-control" name="sku" placeholder="Type SKU here...">

                    </div>

                </form>

            </div>



            <div class="card-body p-3">

                <div class="chart">

                    <canvas id="chart-line" class="chart-canvas" height="300"></canvas>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-5">

        <div class="card card-carousel overflow-hidden h-100 p-0">

        <div class="card z-index-2 h-100">

            <div class="chart">

                <canvas id="chart-bar" class="graphic-canvas" height="300"></canvas>

            </div>

            </div>

        </div>

    </div>

</div>

<div class="row mt-4">

    <div class="col-lg-7 mb-lg-0 mb-4">

        <div class="card ">

            <div class="card-header pb-0 p-3">

                <div class="d-flex justify-content-between">

                    <h6 class="mb-2">This Month Request</h6>

                </div>

            </div>

            <div class="table-responsive">

                <table class="table align-items-center">

                    <tbody>

                        <?php

                        $queryTop5 = mysqli_query($conn, "SELECT nama, COUNT(nama) AS jumlah_kemunculan

                FROM (

                    SELECT r.invoice, r.date, r.id_request, t.id_product, r.quantity_req, r.type_req, pt.image, pt.nama, t.sku_toko 

                    FROM request_id r

                    INNER JOIN toko_id t ON r.id_toko = t.id_toko

                    INNER JOIN product_toko_id pt ON t.id_product = pt.id_product

                    WHERE MONTH(r.date) = MONTH(CURDATE()) 

                    AND YEAR(r.date) = YEAR(CURDATE()) 

                    AND r.type_req = 'request'

                ) AS subquery

                GROUP BY nama

                ORDER BY jumlah_kemunculan DESC

                LIMIT 5"); // Mengambil 5 data teratas



                        $index = 1; // Inisialisasi indeks



                        while ($row = mysqli_fetch_assoc($queryTop5)) {

                            $namaTerbanyak = $row['nama'];

                            $namaTerbatas = substr($namaTerbanyak, 0, 10); // Batasi nama menjadi 10 karakter



                            $queryGambar = mysqli_query($conn, "SELECT image FROM product_toko_id WHERE nama = '$namaTerbanyak'");

                            $rowGambar = mysqli_fetch_assoc($queryGambar);



                            $gambar = $rowGambar['image'];

                            if ($gambar == null) {

                                // jika tidak ada gambar

                                $img = '<img src="../../assets/img/noimageavailable.png" class="zoomable avatar avatar-sm rounded-circle me-2">';

                            } else {

                                //jika ada gambar

                                $img = '<img src="../../assets/img/' . $gambar . '" class="zoomable text-center border-radius-lg rounded-circle" style="width: 50px; height: 50px;">';

                            }



                            $querySkuToko = mysqli_query($conn, "SELECT t.sku_toko

                    FROM toko_id t

                    INNER JOIN product_toko_id pt ON t.id_product = pt.id_product

                    WHERE pt.nama = '$namaTerbanyak'");



                            // Cek jika query berhasil dieksekusi

                            if ($querySkuToko) {

                                // Mengambil hasil query

                                $rowSkuToko = mysqli_fetch_assoc($querySkuToko);



                                // Mencetak sku_toko

                                $skuToko = $rowSkuToko['sku_toko'];

                            }



                            // Mendapatkan tanggal awal dan akhir untuk bulan ini

                            $bulanIni = date('Y-m-01'); // Tanggal awal bulan ini

                            $bulanIniAkhir = date('Y-m-t'); // Tanggal terakhir bulan ini                                



                            // Menghitung jumlah id_request yang sesuai dengan nama terbanyak untuk bulan ini

                            $queryIdRequest = mysqli_query($conn, "SELECT id_request FROM request_id r

                    INNER JOIN toko_id t ON r.id_toko = t.id_toko

                    INNER JOIN product_toko_id pt ON t.id_product = pt.id_product

                    WHERE pt.nama = '$namaTerbanyak' 

                    AND r.type_req = 'request'

                    AND r.date BETWEEN '$bulanIni' AND '$bulanIniAkhir'");



                            $jumlahIdRequest = mysqli_num_rows($queryIdRequest);



                            // Menghitung total quantity_request untuk bulan ini

                            $queryQtyTotal = mysqli_query($conn, "SELECT SUM(quantity_req) AS total_quantity FROM request_id r

                    INNER JOIN toko_id t ON r.id_toko = t.id_toko

                    INNER JOIN product_toko_id pt ON t.id_product = pt.id_product

                    WHERE pt.nama = '$namaTerbanyak' 

                    AND r.type_req = 'request'

                    AND r.date BETWEEN '$bulanIni' AND '$bulanIniAkhir'");



                            // Mengambil hasil query

                            $row = mysqli_fetch_assoc($queryQtyTotal);



                            // Mendapatkan total quantity_request untuk bulan ini

                            $jumlahQtyTotal = $row['total_quantity'];



                            // Tampilkan data dalam tabel

                            echo '<tr>

                        <td class="w-30">

                            <div class="d-flex px-2 py-1 align-items-center">

                                <div>

                                    ' . $img . '

                                </div>

                                <div class="ms-4">

                                    <p class="text-xs font-weight-bold mb-0">Nama :</p>

                                    <h6 class="text-sm mb-0">

                                        <span id="namaTampil' . $index . '"> ' . $namaTerbatas . '</span>

                                        <span id="namaPenuh' . $index . '" style="display: none;">' . $namaTerbanyak . '</span>

                                    </h6>

                                </div>

                            </div>

                        </td>

                        <td>

                            <div class="text-center">

                                <p class="text-xs font-weight-bold mb-0">SKU Toko:</p>

                                <span class="text-danger text-sm font-weight-bolder">

                                ' . $skuToko . '</span>

                            </div>

                        </td>

                        <td>

                            <div class="text-center">

                                <p class="text-xs font-weight-bold mb-0">Qty Req:</p>

                                <h6 class="text-sm mb-0">' . $jumlahIdRequest . '</h6>

                            </div>

                        </td>

                        <td class="align-middle text-sm">

                            <div class="col text-center">

                                <p class="text-xs font-weight-bold mb-0">Qty Total:</p>

                                <h6 class="text-sm mb-0">' . $jumlahQtyTotal . '</h6>

                            </div>

                        </td>

                    </tr>';



                            $index++; // Tambahkan indeks

                        }

                        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    <div class="col-lg-5">

        <div class="card h-100">

            <div class="card-header pb-0 p-3">

                <div class="row">

                    <div class="col-6 d-flex align-items-center">

                        <h6 class="mb-0">This Month Refill</h6>

                    </div>

                </div>

            </div>

            <div class="card-body p-3 pb-0 mt-1">

                <ul class="list-group">

                    <?php

                    $queryTop5 = mysqli_query($conn, "SELECT nama, COUNT(nama) AS jumlah_kemunculan

                        FROM (

                            SELECT r.invoice, r.date, r.id_request, t.id_product, r.quantity_req, r.type_req, pt.image, pt.nama, t.sku_toko 

                            FROM request_id r

                            INNER JOIN toko_id t ON r.id_toko = t.id_toko

                            INNER JOIN product_toko_id pt ON t.id_product = pt.id_product

                            WHERE MONTH(r.date) = MONTH(CURDATE()) 

                            AND YEAR(r.date) = YEAR(CURDATE()) 

                            AND r.type_req = 'refill'

                        ) AS subquery

                        GROUP BY nama

                        ORDER BY jumlah_kemunculan DESC

                        LIMIT 5"); // Mengambil 5 data teratas



                    $index = 6; // Inisialisasi indeks



                    while ($row = mysqli_fetch_assoc($queryTop5)) {

                        $namaTerbanyak = $row['nama'];

                        $namaTerbatas = substr($namaTerbanyak, 0, 10); // Batasi nama menjadi 10 karakter



                        $queryGambar = mysqli_query($conn, "SELECT image FROM product_toko_id WHERE nama = '$namaTerbanyak'");

                        $rowGambar = mysqli_fetch_assoc($queryGambar);



                        $gambar = $rowGambar['image'];

                        if ($gambar == null) {

                            // jika tidak ada gambar

                            $img = '<img src="../../assets/img/noimageavailable.png" class="zoomable avatar avatar-sm rounded-circle me-2">';

                        } else {

                            //jika ada gambar

                            $img = '<img src="../../assets/img/' . $gambar . '" class="zoomable text-center border-radius-lg rounded-circle" style="width: 40px; height: 40px;">';

                        }



                        $querySkuToko = mysqli_query($conn, "SELECT t.sku_toko

                            FROM toko_id t

                            INNER JOIN product_toko_id pt ON t.id_product = pt.id_product

                            WHERE pt.nama = '$namaTerbanyak'");



                        // Cek jika query berhasil dieksekusi

                        if ($querySkuToko) {

                            // Mengambil hasil query

                            $rowSkuToko = mysqli_fetch_assoc($querySkuToko);



                            // Mencetak sku_toko

                            $skuToko = $rowSkuToko['sku_toko'];

                        }



                        // Mendapatkan tanggal awal dan akhir untuk bulan ini

                        $bulanIni = date('Y-m-01'); // Tanggal awal bulan ini

                        $bulanIniAkhir = date('Y-m-t'); // Tanggal terakhir bulan ini                                



                        // Menghitung jumlah id_request yang sesuai dengan nama terbanyak untuk bulan ini

                        $queryIdRequest = mysqli_query($conn, "SELECT id_request FROM request_id r

                            INNER JOIN toko_id t ON r.id_toko = t.id_toko

                            INNER JOIN product_toko_id pt ON t.id_product = pt.id_product

                            WHERE pt.nama = '$namaTerbanyak' 

                            AND r.type_req = 'refill'

                            AND r.date BETWEEN '$bulanIni' AND '$bulanIniAkhir'");



                        $jumlahIdRequest = mysqli_num_rows($queryIdRequest);

                    ?>

                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg mt-1">

                            <div class="d-flex flex-column">

                                <h6 class="text-sm mb-0">

                                    <?= '

                                    <span id="namaTampil' . $index . '"> ' . $namaTerbatas . '</span>

                                    <span id="namaPenuh' . $index . '" style="display: none;">' . $namaTerbanyak . '</span>'

                                    ?>

                                </h6>

                                <span class="text-xs">

                                    SKU TOKO : <span class="text-success text-sm font-weight-bolder"><?= $skuToko; ?></span>, <span class="text-primary text-sm font-weight-bolder"> <?= $jumlahIdRequest; ?></span> Percobaan Refill

                                </span>

                            </div>

                            <div class="d-flex align-items-center text-sm">

                                <?= $img; ?>

                            </div>

                        </li>

                    <?php

                        $index++;

                    }

                    ?>

                </ul>

            </div>

        </div>

    </div>

</div>

</div>





<!-- ... Kode HTML untuk elemen grafik ... -->



<script>

    // ... Kode grafik JavaScript yang sama seperti sebelumnya ...

</script>



<script src=".././assets/js/core/popper.min.js"></script>

<script src=".././assets/js/core/bootstrap.min.js"></script>

<script src=".././assets/js/plugins/perfect-scrollbar.min.js"></script>

<script src=".././assets/js/plugins/smooth-scrollbar.min.js"></script>

<script src=".././assets/js/plugins/chartjs.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="../assets/DataTables/datatables.min.js"></script>

<script>

    // Fungsi untuk toggle nama

    function toggleNamaTerbanyak(namaTampilId, namaPenuhId) {

        var namaTampil = document.getElementById(namaTampilId);

        var namaPenuh = document.getElementById(namaPenuhId);

        var namaDipendekkan = false;



        namaTampil.addEventListener("click", function() {

            if (namaDipendekkan) {

                namaTampil.innerHTML = namaPenuh.textContent.substr(0, 10);

                namaDipendekkan = false;

            } else {

                namaTampil.innerHTML = namaPenuh.textContent;

                namaDipendekkan = true;

            }

        });

    }



    // Panggil fungsi toggleNamaTerbanyak dengan ID yang berbeda untuk setiap elemen $namaTerbanyak

    toggleNamaTerbanyak("namaTampil1", "namaPenuh1");

    toggleNamaTerbanyak("namaTampil2", "namaPenuh2");

    toggleNamaTerbanyak("namaTampil3", "namaPenuh3");

    toggleNamaTerbanyak("namaTampil4", "namaPenuh4");

    toggleNamaTerbanyak("namaTampil5", "namaPenuh5");

    toggleNamaTerbanyak("namaTampil6", "namaPenuh6");

    toggleNamaTerbanyak("namaTampil7", "namaPenuh7");

    toggleNamaTerbanyak("namaTampil8", "namaPenuh8");

    toggleNamaTerbanyak("namaTampil9", "namaPenuh9");

    toggleNamaTerbanyak("namaTampil10", "namaPenuh10");

    // Dan seterusnya...

</script>

<script>

    var ctx1 = document.getElementById("chart-line").getContext("2d");



    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');

    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');

    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');



    // Data bulan dan penjualan dari PHP

    var dataBulan = <?php echo $dataBulanJson; ?>;

    var dataRequest = <?php echo $dataRequestJson; ?>;

    var dataRefill = <?php echo $dataRefillJson; ?>;

    var dataRequestCount = <?php echo $dataRequestCountJson; ?>;



    // SKU toko dari PHP

    var skuToko = "<?php echo isset($_POST['sku']) ? $_POST['sku'] : ''; ?>";



    new Chart(ctx1, {

        type: "line",

        data: {

            labels: dataBulan,

            datasets: [{

                label: "Quantity Total Request",

                tension: 0.4,

                borderWidth: 0,

                pointRadius: 0,

                borderColor: "#5e72e4",

                backgroundColor: gradientStroke1,

                borderWidth: 3,

                fill: true,

                data: dataRequest,

                maxBarThickness: 6

            }, {

                label: "Jumlah Refill",

                tension: 0.4,

                borderWidth: 0,

                pointRadius: 0,

                borderColor: "#f5365c",

                backgroundColor: gradientStroke1,

                borderWidth: 3,

                fill: true,

                data: dataRefill,

                maxBarThickness: 6

            }, {

                label: "Jumlah Request",

                tension: 0.4,

                borderWidth: 0,

                pointRadius: 0,

                borderColor: "#2dce89",

                backgroundColor: gradientStroke1,

                borderWidth: 3,

                fill: true,

                data: dataRequestCount,

                maxBarThickness: 6

            }],



        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    display: true, // Menampilkan legenda

                }

            },

            interaction: {

                intersect: false,

                mode: 'index',

            },

            scales: {

                y: {

                    grid: {

                        drawBorder: false,

                        display: true,

                        drawOnChartArea: true,

                        drawTicks: false,

                        borderDash: [5, 5]

                    },

                    ticks: {

                        display: true,

                        padding: 10,

                        color: '#fbfbfb',

                        font: {

                            size: 11,

                            family: "Open Sans",

                            style: 'normal',

                            lineHeight: 2

                        },

                    }

                },

                x: {

                    grid: {

                        drawBorder: false,

                        display: false,

                        drawOnChartArea: false,

                        drawTicks: false,

                        borderDash: [5, 5]

                    },

                    ticks: {

                        display: true,

                        color: '#ccc',

                        padding: 20,

                        font: {

                            size: 11,

                            family: "Open Sans",

                            style: 'normal',

                            lineHeight: 2

                        },

                    }

                },

            },

            plugins: {

                title: {

                    display: true,

                    text: 'Grafik Request berdasarkan SKU Toko : ' + skuToko,

                    font: {

                        size: 16

                    }

                }

            }

        },

    });

</script>

<?php

// Get the current year and month

$currentYear = date('Y');

$currentMonth = date('m');



// Get the nama_user from the session

$namaUser = $_SESSION['nama_user'];



// Query to count 'refill' requests for the current month with the same requester as nama_user

$monthlyData = array();



// Loop through the months and retrieve data for each month

for ($month = 1; $month <= 12; $month++) {

    $queryRefill = "SELECT COUNT(id_request) AS total_refill

                  FROM request_id

                  WHERE YEAR(date) = '$currentYear'

                  AND MONTH(date) = '$month'

                  AND type_req = 'refill'

                  AND requester = '$namaUser'";

    

    $resultRefill = mysqli_query($conn, $queryRefill);

    $rowRefill = mysqli_fetch_assoc($resultRefill);

    

    $queryRequestCount = "SELECT COUNT(id_request) AS total_request

                  FROM request_id

                  WHERE YEAR(date) = '$currentYear'

                  AND MONTH(date) = '$month'

                  AND type_req = 'request'

                  AND requester = '$namaUser'";

    

    $resultRequestCount = mysqli_query($conn, $queryRequestCount);

    $rowRequestCount = mysqli_fetch_assoc($resultRequestCount);

    

    $monthlyData[$month] = array(

        'Refill' => (int)$rowRefill['total_refill'],

        'Request' => (int)$rowRequestCount['total_request']

    );

}



// Encode the monthly data as JSON for JavaScript

$monthlyDataJson = json_encode($monthlyData);



?>

<script type="text/javascript">

    // Parse the JSON-encoded monthly data

    var monthlyData = <?php echo $monthlyDataJson; ?>;



    // Extract labels (months) and data for Refill and Request counts

    var months = Object.keys(monthlyData);

    var refillData = months.map(function(month) {

        return monthlyData[month].Refill;

    });

    var requestData = months.map(function(month) {

        return monthlyData[month].Request;

    });



    // Create a bar chart

    var ctx = document.getElementById('chart-bar').getContext('2d');

    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: months,

            datasets: [{

                label: 'Refill',

                data: refillData,

                backgroundColor: 'rgba(54, 162, 235, 0.5)',

                borderColor: 'rgba(54, 162, 235, 1)',

                borderWidth: 1

            }, {

                label: 'Request',

                data: requestData,

                backgroundColor: 'rgba(255, 99, 132, 0.5)',

                borderColor: 'rgba(255, 99, 132, 1)',

                borderWidth: 1

            }]

        },

        options: {

            scales: {

                y: {

                    beginAtZero: true

                }

            },

            plugins: {

                title: {

                    display: true,

                    text: 'Grafik Request oleh ' + <?php echo json_encode($namaUser . ' Untuk Tahun Ini'); ?>,

                    font: {

                        size: 16

                    }

                }

            }

        }

    });

</script>