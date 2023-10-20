<?php
$sku = isset($_GET['sku']) ? $_GET['sku'] : '';
$nama = isset($_GET['nama']) ? $_GET['nama'] : '';
// Buat kondisi untuk memeriksa apakah $sku ada nilai atau kosong
$sku_condition = '';
if (!empty($sku)) {
    $sku_condition = "AND (sku_toko LIKE'%$sku%' or nama LIKE '%$sku%')";
}
?>

<div id="desktopTableContainer">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                <div class="text-center">Hi User Checker ♥</div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 mb-2">
                        <h6>List Product Toko</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center justify-content-center mb-0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gambar</th>
                                        <th data-column="nama" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Item</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">SKU Toko</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Quantity</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $per_page = 10;

                                    $query_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM toko_id, product_toko_id WHERE toko_id.id_product = product_toko_id.id_product $sku_condition");
                                    $row_total = mysqli_fetch_assoc($query_total);
                                    $total_data = $row_total['total'];
                                    $total_pages = ceil($total_data / $per_page);

                                    $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $start = ($page_number - 1) * $per_page;

                                    $ambil = mysqli_query($conn, "SELECT product_toko_id.id_product AS idp, nama, image, jenis, sku_toko, id_toko AS idt
                                    FROM product_toko_id
                                    INNER JOIN toko_id ON toko_id.id_product = product_toko_id.id_product
                                    $sku_condition
                                    ORDER BY 
                                       CAST(SUBSTRING_INDEX(sku_toko, 'a', 1) AS UNSIGNED) ASC,
                                       CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(sku_toko, 'a', -1), '1', 1) AS UNSIGNED) ASC,
                                       sku_toko ASC
                                    LIMIT $start, $per_page");       
                                    $i = ($page_number - 1) * $per_page + 1;

                                    $max_buttons = 5;
                                    $start_page = max(1, $page_number - floor($max_buttons / 2));
                                    $end_page = min($total_pages, $start_page + $max_buttons - 1);


                                    while ($data = mysqli_fetch_array($ambil)) {
                                        $gambar = $data['image'];
                                        if ($gambar == null) {
                                            // jika tidak ada gambar
                                            $img = '<img src="../../assets/img/noimageavailable.png" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                        } else {
                                            //jika ada gambar
                                            $img = '<img src="../../assets/img/' . $gambar . '" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                        }
                                    ?>
                                        <tr class="parentRow">
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0"><?= $i++; ?></p>
                                            </td>
                                            <td>

                                                <div class="d-flex px-1">

                                                    <div>

                                                        <?= $img; ?>

                                                    </div>

                                                </div>

                                            </td>
                                            <td><a href="?url=edit&idt=<?= $data['idt']; ?>&idp=<?= $data['idp']; ?>">
                                                    <span class="text-xs font-weight-boldn text-wrap"><?= $data['nama']; ?></a></span>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold"><?= $data['sku_toko']; ?></span>
                                            </td>
                                            <?php
                                            $idp = $data['idp'];
                                            $gudang_query = "(SELECT id_komponen AS idp FROM list_komponen 
                                        INNER JOIN product_mentah_id ON list_komponen.id_komponen = product_mentah_id.id_product
                                        WHERE id_product_finish = '$idp')
                                        UNION ALL
                                        (SELECT id_komponen AS idp FROM list_komponen 
                                        INNER JOIN product_mateng_id ON list_komponen.id_komponen = product_mateng_id.id_product
                                        WHERE id_product_finish = '$idp')";
                                            $gudang_result = mysqli_query($conn, $gudang_query);
                                            while ($item = mysqli_fetch_array($gudang_result)) {
                                                $idpg = $item['idp'];

                                            ?>
                                            <?php
                                                $persediaan_query = "(SELECT SUM(quantity) AS total FROM gudang_id WHERE id_product='$idpg')
                                                UNION ALL
                                                (SELECT SUM(quantity) AS total FROM mateng_id WHERE id_product='$idpg')";
                                                $persediaan_result = mysqli_query($conn, $persediaan_query);
                                                $persediaan = 0;
                                                while ($datagudang = mysqli_fetch_array($persediaan_result)) {
                                                    $persediaan += $datagudang['total'];
                                                }
                                            }
                                            ?>
                                            <td><span class="text-xs font-weight-bold"><?= $persediaan; ?> Total Persediaan</span></td>
                                            <td>
                                                <span class="text-xs font-weight-bold"><?= $data['jenis']; ?></span>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end m-3">
                            <div class="pagination d-inline-flex">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination mb-0">
                                        <?php if ($page_number > 1) : ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?url=product&page=<?php echo $page_number - 1; ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
                                            <?php if ($page >= $start_page && $page <= $end_page) : ?>
                                                <li class="page-item <?php echo $page == $page_number ? 'active' : ''; ?>">
                                                    <a class="page-link <?php echo $page == $page_number ? 'text-white' : ''; ?>" href="?url=product&page=<?php echo $page; ?>"><?php echo $page; ?></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endfor; ?>

                                        <?php if ($page_number < $total_pages) : ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?url=product&page=<?php echo $page_number + 1; ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                    </div>
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

<div id="mobileCardContainer" class="d-none">
    <div class="col-xl-6">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                    <div class="text-center">Hi User Checker ♥</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="dataContainer">
            <?php
            $per_page = 10;

            $query_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM toko_id, product_toko_id WHERE toko_id.id_product = product_toko_id.id_product $sku_condition");
            $row_total = mysqli_fetch_assoc($query_total);
            $total_data = $row_total['total'];
            $total_pages = ceil($total_data / $per_page);

            $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $start = ($page_number - 1) * $per_page;

            $ambil = mysqli_query($conn, "SELECT 
            product_toko_id.id_product AS idp, 
            nama, 
            image, 
            jenis, 
            sku_toko, 
            id_toko AS idt
            FROM 
                product_toko_id
            INNER JOIN 
                toko_id ON toko_id.id_product = product_toko_id.id_product
            $sku_condition
            WHERE
            sku_toko NOT IN ('-', '--', '---')
            ORDER BY 
                CAST(SUBSTRING_INDEX(sku_toko, 'a', 1) AS UNSIGNED) ASC,
                CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(sku_toko, 'a', -1), '1', 1) AS UNSIGNED) ASC,
                sku_toko ASC
            LIMIT 
            $start, $per_page");
            $i = ($page_number - 1) * $per_page + 1;

            $max_buttons = 3;
            $start_page = max(1, $page_number - floor($max_buttons / 2));
            $end_page = min($total_pages, $start_page + $max_buttons - 1);

            // Tampilkan data dalam markup HTML
            while ($list = mysqli_fetch_array($ambil)) {
                //cek data gambar ada apa kagak
                $gambar = $list['image'];
                if ($gambar == null) {
                    // jika tidak ada gambar
                    $img = '<img src="../../assets/img/noimageavailable.png" class="zoomable text-center border-radius-lg" style="width: 70px; height: 70px;>';
                } else {
                    //jika ada gambar
                    $img = '<img src="../../assets/img/' . $gambar . '" class="zoomable text-center border-radius-lg" style="width: 70px; height: 70px;">';
                }
                $nama = $list['nama'];
                if (strlen($nama) > 10) { // Ubah batas karakter di sini sesuai kebutuhan
                    $nama = substr($nama, 0, 10) . '...';
                }
            ?>
                <div class="col-6 mb-2">
                    <div class="card">
                        <div class="card-header mx-4 p-3 text-center">
                            <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                <?= $img; ?>
                            </div>
                        </div>
                        <?php
                                            $idp = $list['idp'];
                                            $gudang_query = "(SELECT id_komponen AS idp FROM list_komponen 
                                        INNER JOIN product_mentah_id ON list_komponen.id_komponen = product_mentah_id.id_product
                                        WHERE id_product_finish = '$idp')
                                        UNION ALL
                                        (SELECT id_komponen AS idp FROM list_komponen 
                                        INNER JOIN product_mateng_id ON list_komponen.id_komponen = product_mateng_id.id_product
                                        WHERE id_product_finish = '$idp')";
                                            $gudang_result = mysqli_query($conn, $gudang_query);
                                            while ($item = mysqli_fetch_array($gudang_result)) {
                                                $idpg = $item['idp'];

                                            ?>
                                            <?php
                                                $persediaan_query = "(SELECT SUM(quantity) AS total FROM gudang_id WHERE id_product='$idpg')
                                                UNION ALL
                                                (SELECT SUM(quantity) AS total FROM mateng_id WHERE id_product='$idpg')";
                                                $persediaan_result = mysqli_query($conn, $persediaan_query);
                                                $persediaan = 0;
                                                while ($datagudang = mysqli_fetch_array($persediaan_result)) {
                                                    $persediaan += $datagudang['total'];
                                                }
                                            }
                                            ?>
                        <div class="card-body pt-0 p-3 text-center">
                            <h6 class="text-center mb-0"><?= $nama; ?></h6>
                            <p><?= $persediaan; ?></p>
                            <hr class="horizontal dark my-3">
                            <a class="btn btn-primary edit-link" href="#">
                                <h5 class="mb-0"><?= $list['sku_toko']; ?></h5>
                            </a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="text-center mt-3">
                <div class="pagination d-inline-flex">
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0">
                            <?php if ($page_number > 1) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?url=product&page=<?php echo $page_number - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
                                <?php if ($page >= $start_page && $page <= $end_page) : ?>
                                    <li class="page-item <?php echo $page == $page_number ? 'active' : ''; ?>">
                                        <a class="page-link <?php echo $page == $page_number ? 'text-white' : ''; ?>" href="?url=product&page=<?php echo $page; ?>"><?php echo $page; ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <?php if ($page_number < $total_pages) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?url=product&page=<?php echo $page_number + 1; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleNama(index) {
        var nama = document.getElementById('nama' + index);
        var toggler = document.getElementById('toggler' + index);

        if (nama.textContent === nama.dataset.short) {
            nama.textContent = nama.dataset.full;
            toggler.textContent = '<';
        } else {
            nama.textContent = nama.dataset.short;
            toggler.textContent = '>';
        }
    }
</script>
<script>
    // JavaScript code

    // Function to initialize the DataTable
    function initializeDataTable() {
        if (!$.fn.DataTable.isDataTable('#myTable')) {
            const dataTable = $('#myTable').DataTable({
                // Add your DataTable initialization options here
            });

            // Handle pagination events
            dataTable.on('page.dt', function() {
                showMobileCards();
            });
        }
    }

    // Function to handle card clicks
    function handleCardClick(event) {
        event.preventDefault();
        // Add your logic here for card click event
    }

    // Function to show mobile cards based on pagination
    function showMobileCards() {
        const startIndex = (mobileCurrentPage - 1) * mobileItemsPerPage;
        const endIndex = startIndex + mobileItemsPerPage;

        $('#mobileCardContainer .card').hide();
        $('#mobileCardContainer .card').slice(startIndex, endIndex).show();
    }

    // Variables to track pagination state
    let mobileCurrentPage = 1;
    const mobileItemsPerPage = 10; // Number of items to show per page

    // Check the viewport width and show/hide elements based on screen size
    function updateLayout() {
        const desktopTableContainer = document.getElementById('desktopTableContainer');
        const mobileCardContainer = document.getElementById('mobileCardContainer');

        if (window.innerWidth < 1080 && window.innerHeight < 900) {
            desktopTableContainer.style.display = 'none';
            mobileCardContainer.classList.remove('d-none');

            // Initialize DataTable
            initializeDataTable();
            showMobileCards();
        } else {
            desktopTableContainer.style.display = 'block';
            mobileCardContainer.classList.add('d-none');

            // Destroy DataTable
            if ($.fn.DataTable.isDataTable('#myTable')) {
                $('#myTable').DataTable().destroy();
            }
        }
    }

    // Initial layout update on page load
    updateLayout();

    // Listen for window resize events and update layout accordingly
    window.addEventListener('resize', updateLayout);

    // Handle mobile pagination events
    $('#mobilePreviousPage').click(function(event) {
        event.preventDefault();
        if (!$(this).hasClass('disabled')) {
            mobileCurrentPage--;
            showMobileCards();
        }
    });

    $('#mobileNextPage').click(function(event) {
        event.preventDefault();
        if (!$(this).hasClass('disabled')) {
            mobileCurrentPage++;
            showMobileCards();
        }
    });

    // Attach click event listeners to each card
    const cards = document.querySelectorAll('#mobileCardContainer .card');
    cards.forEach(function(card) {
        card.addEventListener('click', handleCardClick);
    });
</script>
<script>
    // JavaScript to hide the data when the user is on a mobile device
    document.addEventListener("DOMContentLoaded", function() {
        var isMobile = <?php echo $_SESSION['is_mobile'] ? 'true' : 'false'; ?>;
        if (isMobile) {
            var dataContainer = document.getElementById("dataContainer");
            dataContainer.style.display = "none";
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
</body>