<?php



$sku = isset($_GET['sku']) ? $_GET['sku'] : '';

// Buat kondisi untuk memeriksa apakah $sku ada nilai atau kosong
$sku_condition = '';
if (!empty($sku)) {
    $sku_condition = "AND invoice LIKE '%$sku%'";
}


?>

<div id="tableContainer">

    <div class="row" hidden>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">

            <div class="card">

                <div class="card-body p-3">

                    <div class="row justify-content-center">

                        <div class="col-auto">

                            <div class="icon icon-shape bg-gradient-danger shadow-primary text-center rounded-circle">

                                <a href="index.php?action=failds" id="failDS"><i class="fas fa-exclamation text-lg opacity-10" aria-hidden="true"></i></a>

                                <script>
                                    document.getElementById('failDS').addEventListener('click', handlefailDSClick);



                                    function handlefailDSClick(event) {

                                        event.preventDefault();

                                        // Add your logic here for the box link click event

                                        // For example:

                                        window.location.href = 'index.php?url=failds';

                                    }
                                </script>

                            </div>

                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-secondary shadow-primary text-center rounded-circle">
                                <a href="downloadds.php" id="downloadDS"><i class="fas fa-download text-lg opacity-10" aria-hidden="true"></i></a>
                                <script>
                                    document.getElementById('downloadDS').addEventListener('click', handledownloadDSClick);

                                    function handledownloadDSClick(event) {
                                        event.preventDefault();
                                        // Add your logic here for the box link click event
                                        // For example:
                                        window.location.href = 'downloadds.php';
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">

        <div class="col-12">

            <div class="card mb-4">

                <div class="card-header pb-0">

                    <h6>Kelompok inv</h6>

                </div>

                <div class="card-body px-0 pt-0 pb-2">

                    <div class="table-responsive p-0">

                        <div style="padding: 10px;">

                            <!-- Update the class name of the parent table -->

                            <table class="table align-items-center justify-content-center mb-0 parentTable" style="width:100%; margin-bottom: 20px;">

                                <thead>

                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No. Invoice</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Admin</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Picking</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Box</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Checking</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Packing</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kurir</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                        <th></th>

                                    </tr>

                                </thead>

                                <tbody>
                                    <?php
                                    // Fungsi untuk mengubah urutan pengurutan
                                    $per_page = 10;
                                    $query_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM shop_id,toko_id WHERE toko_id.id_product = shop_id.id_product $sku_condition GROUP BY resi,tanggal_bayar ORDER BY tanggal_bayar ASC ");
                                    $row_total = mysqli_num_rows($query_total);

                                    $total_pages = ceil($row_total / $per_page);
                                    $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $start = ($page_number - 1) * $per_page;
                                    $querygudang = mysqli_query($conn, "SELECT resi,invoice,tanggal_bayar,tipe FROM shop_id,toko_id WHERE toko_id.id_product = shop_id.id_product $sku_condition GROUP BY resi,tanggal_bayar ORDER BY resi DESC LIMIT $start, $per_page");
                                    $i = ($page_number - 1) * $per_page + 1;
                                    while ($list = mysqli_fetch_array($querygudang)) {
                                        $resi = $list['resi'];
                                        $inv = $list['invoice'];
                                        $date = $list['tanggal_bayar'];
                                        $status = $list['tipe'];
                                    ?>

                                        <tr class="parentRow"> <!-- Add a class for parent rows -->
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0"><?= $i++; ?></p>
                                            </td>

                                            <td>

                                                <span class="text-xs font-weight-bold text-wrap"><?= $resi; ?></span>

                                            </td>

                                            <td>
                                                <span class="text-xs font-weight-bold text-wrap"><?= $date; ?></span>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold"><?= $status; ?></span>
                                            </td>
                                            <?php
                                            $ambil = mysqli_query($conn,"SELECT admin,picking,box,checking,packing,dikurir,refaund FROM tracking WHERE no_resi = '$resi'");
                                            $track = mysqli_fetch_array($ambil);
                                            ?>
                                            <td>
                                                <span class="text-xs font-weight-bold text-wrap"><?= $track['admin']; ?></span>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold text-wrap"><?= $track['picking']; ?></span>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold text-wrap"><?= $track['box']; ?></span>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold text-wrap"><?= $track['checking']; ?></span>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold text-wrap"><?= $track['packing']; ?></span>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold text-wrap"><?= $track['dikurir']; ?></span>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold text-wrap"><?= $track['refaund']; ?></span>
                                            </td>
                                            <td class="align-middle">
                                                <button class="btn btn-link text-secondary mb-0" id="toggler<?= $i; ?>" onclick="toggleNestedTable(<?= $i; ?>)">

                                                    <i class="fa fa-caret-down text-xs"></i>

                                                </button>
                                            </td>

                                        </tr>

                                        <tr class="nested-table-row" id="nestedTable<?= $i; ?>" style="display: none;">
                                            <!-- Add a new row for the nested table -->
                                            <td colspan="7" style="background-color: #DFD7BF;">
                                                <!-- Nested table to display additional information below the row -->

                                                <table style="width: 100%;">
                                                    <thead>

                                                        <tr>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image</th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama </th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">SKU Toko</th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah Order</th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">status</th>
                                                        </tr>

                                                    </thead>
                                                    
                                                    <?php

                                                    $selectlist = mysqli_query($conn, "SELECT nama,image,toko_id.sku_toko,jumlah,shop_id.id_product,tipe,lorong,toko FROM shop_id,toko_id,product_toko_id WHERE toko_id.id_product = shop_id.id_product AND product_toko_id.id_product = shop_id.id_product AND invoice = '$inv'");

                                                    $k = 1;

                                                    while ($datalist = mysqli_fetch_array($selectlist)) {


                                                        $gambar = $datalist['image'];
                                                        if ($gambar == null) {
                                                            // jika tidak ada gambar
                                                            $img = '<img src="../../assets/img/noimageavailable.png" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                                        } else {
                                                            //jika ada gamba
                                                            $img = '<img src="../../assets/img/' . $gambar . '" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                                        }

                                                        $namaFulllist = $datalist['nama'];

                                                        if (strlen($namaFulllist) > 40) {

                                                            $namaShortlist = substr($namaFulllist, 0, 40) . '...';
                                                        } else {

                                                            $namaShortlist = substr($namaFulllist, 0, 40) . '';
                                                        }

                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <p class="text-sm font-weight-bold mb-0">#</p>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex px-1">
                                                                    <div>
                                                                        <?= $img; ?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p class="text-sm font-weight-bold mb-0 text-wrap" style="font-size: 5px;">
                                                                    <?= $datalist['nama'];?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <span class="text-xs font-weight-bold"><?= $datalist['sku_toko']; ?></span>
                                                            </td>
                                                            <td>
                                                                <span class="text-xs font-weight-bold"><?= $datalist['jumlah']; ?></span>
                                                            </td>
                                                            <td>
                                                                <span class="text-xs font-weight-bold"><?= $datalist['tipe']; ?></span>
                                                            </td>
                                                            <td>

                                                            </td>
                                                            
                                                        </tr>
                                                    <?php

                                                    }

                                                    ?>
                                                     <span class="text-xs font-weight-bold">Kelompok </span>
                                                    <?php
                                                    $query = "SELECT toko FROM shop_id, toko_id WHERE toko_id.id_product = shop_id.id_product AND invoice = '$inv'";
                                                    $result = mysqli_query($conn, $query);

                                                    // Memeriksa apakah query berhasil dijalankan
                                                    if ($result) {
                                                        // Menginisialisasi variabel untuk menghitung jumlah 'A' dan 'B'
                                                        $countA = 0;
                                                        $countB = 0;

                                                        // Mengambil data dari hasil query
                                                        while ($data = mysqli_fetch_array($result)) {
                                                            $toko = $data['toko'];

                                                            if ($toko == 'A') {
                                                                $countA++;
                                                            } elseif ($toko == 'B') {
                                                                $countB++;
                                                            }
                                                        }

                                                        // Memeriksa hasil berdasarkan jumlah 'A' dan 'B'
                                                        if ($countA == 0 && $countB == 0) {
                                                            echo '<span class="text-xs font-weight-bold">No Data</span>';
                                                        } elseif ($countA > 0 && $countB == 0) {
                                                            echo '<span class="text-xs font-weight-bold">A</span>';
                                                        } elseif ($countA == 0 && $countB > 0) {
                                                            echo '<span class="text-xs font-weight-bold">B</span>';
                                                        } else {
                                                            echo '<span class="text-xs font-weight-bold">C</span>';
                                                        }
                                                    } else {
                                                        echo "Error: " . $query . "<br>" . mysqli_error($conn);
                                                    }

                                                    ?>
                                                </table>
                                            </td>
                                        </tr>

                                    <?php

                                    }

                                    ?>

                                    <!-- Rows for other data -->

                                </tbody>

                            </table>

                            <script>
                                function toggleSort(columnName) {
                                    var currentUrl = window.location.href;
                                    var url = new URL(currentUrl);
                                    var sortParam = url.searchParams.get('sort');
                                    var orderParam = url.searchParams.get('order');

                                    if (sortParam === columnName) {
                                        // Jika kolom yang sama di-klik lagi, toggle arah pengurutan
                                        url.searchParams.set('order', orderParam === 'asc' ? 'desc' : 'asc');
                                    } else {
                                        // Jika kolom yang berbeda di-klik, atur ulang parameter 'sort' dan arah pengurutan
                                        url.searchParams.set('sort', columnName);
                                        url.searchParams.set('order', 'asc'); // atau 'desc' sesuai preferensi awal
                                    }

                                    // Ganti URL tanpa me-refresh halaman
                                    window.history.replaceState({}, '', url.toString());

                                    // Redirect ke URL yang baru
                                    window.location.href = url.toString();
                                }
                            </script>

                        </div>

                        <div class="text-center">
                            <div class="col-md-12 mt-3">
                                <ul class="pagination justify-content-center p-0">
                                    <?php
                                    $currentUrl = strtok($_SERVER['REQUEST_URI'], '?');
                                    $paginationUrl = $currentUrl . '?';

                                    // Mengambil semua parameter yang ada dalam URL saat ini
                                    $params = $_GET;

                                    // Menghapus parameter 'page' agar tidak ditambahkan dua kali
                                    unset($params['page']);

                                    // Membangun ulang URL pagination dengan parameter yang ada
                                    $paginationUrl .= http_build_query($params) . '&';

                                    // Menampilkan tombol ke halaman pertama
                                    if ($page_number > 2) {
                                        echo '<li class="page-item"><a class="page-link" href="' . $paginationUrl . 'page=1">1</a></li>';
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }

                                    // Menampilkan 2 halaman sebelum dan sesudah halaman saat ini
                                    $start_page = max(1, $page_number - 2);
                                    $end_page = min($total_pages, $page_number + 2);

                                    for ($page = $start_page; $page <= $end_page; $page++) {
                                        echo '<li class="page-item ' . ($page == $page_number ? 'active' : '') . '">';
                                        echo '<a class="page-link" href="' . $paginationUrl . 'page=' . $page . '">' . $page . '</a>';
                                        echo '</li>';
                                    }

                                    // Menampilkan tombol ke halaman terakhir
                                    if ($page_number < $total_pages - 2) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                        echo '<li class="page-item"><a class="page-link" href="' . $paginationUrl . 'page=' . $total_pages . '">' . $total_pages . '</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function toggleNestedTable(id) {
                        const nestedTable = document.getElementById('nestedTable' + id);
                        const toggler = document.getElementById('toggler' + id);
                        if (nestedTable.style.display === 'none') {
                            nestedTable.style.display = 'table-row';
                            toggler.innerHTML = '<i class="fa fa-caret-up text-xs"></i>';
                        } else {
                            nestedTable.style.display = 'none';
                            toggler.innerHTML = '<i class="fa fa-caret-down text-xs"></i>';
                        }
                    }
                </script>

                <!-- Add this script at the end of your HTML document -->

                <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>



                <script>
                    $(document).ready(function() {

                        // Initialize DataTable for the parent table only

                        $('.parentTable').DataTable({

                            // Add your DataTable options and configurations here

                            // For example:

                            // "paging": false,

                            // "searching": false,

                            // "ordering": false,

                            // "info": false,

                        });

                    });
                </script>

            </div>

        </div>

    </div>

</div>



<?php

// Check if a specific link is clicked

if (isset($_GET['action'])) {

    $action = $_GET['action'];



    // Handle the box link click

    if ($action === 'box') {

        // Add your logic here for the box link click event

        // For example:

        echo "Box List clicked";
    }



    // Handle the add item link click

    if ($action === 'new') {

        // Add your logic here for the add item link click event

        // For example:

        echo "Add item link clicked";
    }



    // Handle the mutasi link click

    if ($action === 'mutasi') {

        // Add your logic here for the mutasi link click event

        // For example:

        echo "Mutasi link clicked";
    }

    if ($action === 'Edit') {

        // Add your logic here for the mutasi link click event

        // For example:

        echo "Edit Php";
    }



    // Redirect back to the main page

    header("Location: index.php");

    exit();
}

?>