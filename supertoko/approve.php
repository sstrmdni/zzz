<?php
$sku = isset($_GET['sku']) ? $_GET['sku'] : '';
// Buat kondisi untuk memeriksa apakah $sku ada nilai atau kosong
$sku_condition = '';
if (!empty($sku)) {
    $sku_condition = "AND sku_toko LIKE'%$sku%'";
}
?>
<div id="desktopTableContainer">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">

            <div class="card">

                <div class="card-body p-3">

                    <div class="row">

                        <div class="col-8">

                            <div class="numbers">

                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Check List</p>

                                <a data-bs-toggle="modal" data-bs-target="#finishModal" class="btn btn-primary mt-3">Check</a>

                            </div>

                        </div>

                        <div class="col-4 text-end">

                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">

                                <i class="fas fa-clipboard-list text-lg opacity-10" aria-hidden="true"></i>

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

                    <h6>Request Order</h6>

                </div>

                <div class="card-body px-0 pt-0 pb-2">

                    <div class="table-responsive p-0">

                        <div style="padding: 10px;">

                            <!-- Update the class name of the parent table -->

                            <table class="table align-items-center justify-content-center mb-0" style="width:100%; margin-bottom: 20px;">

                                <thead>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Invoice</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Item</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">SKU Toko</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Picker</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Quantity</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Approval</th>

                                </thead>

                                <tbody>

                                    <?php
                                    $per_page = 10;

                                    $query_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM request_id, product_toko_id, toko_id WHERE request_id.id_toko=toko_id.id_toko AND toko_id.id_product=product_toko_id.id_product $sku_condition");
                                    $row_total = mysqli_fetch_assoc($query_total);
                                    $total_data = $row_total['total'];
                                    $total_pages = ceil($total_data / $per_page);

                                    $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $start = ($page_number - 1) * $per_page;

                                    $select = mysqli_query($conn, "SELECT quantity_count, status_req, image, image_toko, date, nama, invoice, sku_toko, picker, type_req FROM request_id, toko_id, product_toko_id WHERE request_id.id_toko=toko_id.id_toko AND toko_id.id_product=product_toko_id.id_product $sku_condition ORDER BY date DESC LIMIT $start, $per_page");
                                    $i = ($page_number - 1) * $per_page + 1;

                                    $max_buttons = 5;
                                    $start_page = max(1, $page_number - floor($max_buttons / 2));
                                    $end_page = min($total_pages, $start_page + $max_buttons - 1);

                                    while ($data = mysqli_fetch_array($select)) {
                                        $quantity = $data['quantity_count'];
                                        $stat = $data['status_req'];
                                        $gambar = $data['image'];

                                        if ($gambar == null) {

                                            // jika tidak ada gambar

                                            $img = '<img src="../assets/img/noimageavailable.png" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                        } else {

                                            //jika ada gambar

                                            $img = '<img src="../assets/img/' . $gambar . '" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                        }


                                    ?>

                                        <tr>

                                            <td>

                                                <p class="text-sm font-weight-bold mb-0"><?= $i++ ?></p>

                                            </td>

                                            <td>

                                                <div class="d-flex px-1">
                                                    <div>
                                                        <?= $img; ?>
                                                    </div>
                                                </div>

                                            </td>

                                            <td class="text-wrap">

                                                <p class="text-sm font-weight-bold mb-0" style="font-size: 5px;">

                                                    <?= $data['date']; ?>

                                                </p>

                                                </a>

                                            </td>

                                            <td>

                                                <span class="text-xs font-weight-bold"><?= $data['invoice']; ?></span>

                                            </td>

                                            <td>

                                                <span class="text-xs font-weight-bold text-wrap"><?= $data['nama']; ?></span>

                                            </td>

                                            <td>

                                                <span class="text-xs font-weight-bold"><?= $data['sku_toko']; ?></span>

                                            </td>

                                            <td>

                                                <span class="text-xs font-weight-bold"><?= $data['picker']; ?></span>

                                            </td>

                                            <?php



                                            if ($quantity == 0) {



                                                echo "<td style='color: red;'>
                                <span class='text-xs font-weight-bold'>$quantity</span></td>";
                                            } else {

                                                echo "<td style='color: green;'>
                                <span class='text-xs font-weight-bold'>$quantity</span></td>";
                                            }
                                            ?>
                                            <td>
                                                <span class="text-xs font-weight-bold"><?= $data['type_req']; ?></span>
                                            </td>
                                            <?php
                                            if ($stat == 'Approved') {
                                                echo "<td style='color: green;'>
                                                <span class='text-xs font-weight-bold'>$stat</span></td>";
                                            } elseif ($stat == 'unprocessed') {
                                                echo "<td style='color: red;'>
                                                <span class='text-xs font-weight-bold'>$stat</span></td>";
                                            } else {
                                                echo "<td style='color: orange;'>
                                                <span class='text-xs font-weight-bold'>$stat</span></td>";
                                            }
                                            ?>
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
                                                <a class="page-link" href="?url=approve&page=<?php echo $page_number - 1; ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
                                            <?php if ($page >= $start_page && $page <= $end_page) : ?>
                                                <li class="page-item <?php echo $page == $page_number ? 'active' : ''; ?>">
                                                    <a class="page-link <?php echo $page == $page_number ? 'text-white' : ''; ?>" href="?url=approve&page=<?php echo $page; ?>"><?php echo $page; ?></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endfor; ?>

                                        <?php if ($page_number < $total_pages) : ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?url=approve&page=<?php echo $page_number + 1; ?>" aria-label="Next">
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
        </div>
    </div>
</div>
<div id="mobileCardContainer" class="d-none">
    <div class="col-xl-6">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <a data-bs-toggle="modal" data-bs-target="#finishModal"><i class="fas fa-clipboard-list text-lg opacity-10" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="dataContainer">

            <?php
            $per_page = 10;

            $query_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM request_id, product_toko_id, toko_id WHERE request_id.id_toko=toko_id.id_toko AND toko_id.id_product=product_toko_id.id_product $sku_condition");
            $row_total = mysqli_fetch_assoc($query_total);
            $total_data = $row_total['total'];
            $total_pages = ceil($total_data / $per_page);

            $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $start = ($page_number - 1) * $per_page;

            $select = mysqli_query($conn, "SELECT id_request, quantity_count, status_req, image, image_toko, date, nama, invoice, sku_toko, picker, type_req FROM request_id, toko_id, product_toko_id WHERE request_id.id_toko=toko_id.id_toko AND toko_id.id_product=product_toko_id.id_product $sku_condition ORDER BY date DESC LIMIT $start, $per_page");
            $i = ($page_number - 1) * $per_page + 1;

            $max_buttons = 3;
            $start_page = max(1, $page_number - floor($max_buttons / 2));
            $end_page = min($total_pages, $start_page + $max_buttons - 1);

            // Tampilkan data dalam markup HTML

            while ($data = mysqli_fetch_array($select)) {

                $gambar = $data['image'];

                if ($gambar == null) {

                    // jika tidak ada gambar

                    $img = '<img src="../assets/img/noimageavailable.png" class="zoomable text-center border-radius-lg" style="width: 70px; height: 70px;>';
                } else {
                    //jika ada gambar
                    $img = '<img src="../assets/img/' . $gambar . '" class="zoomable text-center border-radius-lg" style="width: 70px; height: 70px;">';
                }

                $nama = $data['nama'];

                if (strlen($nama) > 10) {

                    $namaParts = explode(" - ", $nama); // Memisahkan nama menjadi bagian sebelum dan sesudah " - "

                    $nama = end($namaParts); // Mengambil bagian belakangnya

                    if (strlen($nama) > 10) { // Jika masih panjang, potong menjadi 10 karakter

                        $nama = substr($nama, 0, 10) . '...';
                    }
                }

            ?>

                <div class="col-6 mb-2">
                    <div class="card">
                        <div class="card-header mx-4 p-3 text-center">
                            <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                <?= $img; ?>

                            </div>

                        </div>

                        <div class="card-body pt-0 p-3 text-center">

                            <h6 class="text-center mb-0"><?= $nama; ?></h6>

                            <span class="text-xs"><?= $data['type_req']; ?> <b><?= $data['invoice']; ?></b></span>
                            <br>
                            <span class="text-xs"><?= $data['date']; ?></span>

                            <hr class="horizontal dark my-3">
                            <?php
                            $stat = $data['status_req'];

                            $buttonClass = '';
                            if ($stat == 'Approved') {
                                $buttonClass = 'btn-success';
                            } elseif ($stat == 'unprocessed') {
                                $buttonClass = 'btn-danger';
                            } else {
                                $buttonClass = 'btn-warning';
                            }
                            ?>
                            <a class="btn btn-primary <?= $buttonClass; ?>" data-bs-toggle="modal" data-bs-target="#modal<?= $data['id_request']; ?>">
                                <h5 class="mb-0"><?= $data['sku_toko']; ?></h5>
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
                                    <a class="page-link" href="?url=approve&page=<?php echo $page_number - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
                                <?php if ($page >= $start_page && $page <= $end_page) : ?>
                                    <li class="page-item <?php echo $page == $page_number ? 'active' : ''; ?>">
                                        <a class="page-link <?php echo $page == $page_number ? 'text-white' : ''; ?>" href="?url=approve&page=<?php echo $page; ?>"><?php echo $page; ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <?php if ($page_number < $total_pages) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?url=approve&page=<?php echo $page_number + 1; ?>" aria-label="Next">
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

<div class="modal fade" id="modal<?= $data['id_request']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-7 mt-4">
                        <div class="card">
                            <div class="card-header pb-0 px-3">
                                <h6 class="mb-0">Item Information</h6>
                            </div>
                            <div class="card-body pt-4 p-3">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-3 text-sm">Nama Item</h6>
                                            <span class="mb-2 text-xs">Date: <span class="text-dark font-weight-bold ms-sm-2">AAAA</span></span>
                                            <span class="mb-2 text-xs">Invoice: <span class="text-dark ms-sm-2 font-weight-bold">BBB</span></span>
                                            <span class="mb-2 text-xs">SKU Toko: <span class="text-dark ms-sm-2 font-weight-bold">BBB</span></span>
                                            <span class="text-xs">Picker: <span class="text-dark ms-sm-2 font-weight-bold">CCC</span></span>
                                            <span class="text-xs">Quantity: <span class="text-dark ms-sm-2 font-weight-bold">CCC</span></span>
                                            <span class="text-xs">Status: <span class="text-dark ms-sm-2 font-weight-bold">CCC</span></span>
                                            <span class="text-xs">Approval: <span class="text-dark ms-sm-2 font-weight-bold">CCC</span></span>
                                        </div>
                                        <div class="ms-auto text-end">
                                            <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                            <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="finishModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approve Refill & Request</h5>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-5 mt-2">
                    <div class="d-flex justify-content-end mb-3">
                        <input type="text" id="searchInput" class="form-control" style="width: 200px;" placeholder="Search...">
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <?php
                        $select = mysqli_query($conn, "SELECT * FROM request_id, toko_id, product_toko_id WHERE request_id.id_toko=toko_id.id_toko AND toko_id.id_product=product_toko_id.id_product AND status_req='On Process'");
                        $i = 1;
                        while ($data = mysqli_fetch_array($select)) {
                            $gambar = $data['image'];
                            if ($gambar == null) {
                                // jika tidak ada gambar
                                $img = '<img src="../assets/img/noimageavailable.png" class="zoomable avatar avatar-sm rounded-circle me-2">';
                            } else {
                                //jika ada gambar
                                $img = '<img src="../assets/img/' . $gambar . '" class="zoomable avatar avatar-sm me-2">';
                            }
                        ?>
                            <div class="d-flex mb-4 searchable">
                                <div class="card h-100 bg-primary text-white">
                                    <div class="card-header pb-0 px-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="mb-0"><?= $data['nama']; ?></h6>
                                            </div>
                                            <div class="img-fluid text-end"><?= $img; ?></div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-4 d-flex justify-content-between">
                                        <div class="col-md-6 mb-0">
                                            <div class="text-start text-sm font-weight-bold"><?= $data['sku_toko']; ?><b> (<?= $data['type_req']; ?>)</b></div>
                                            <div class="text-start">
                                                <p>Invoice: <span><?= $data['invoice']; ?></span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="d-flex justify-content-end align-items-center">
                                                <input type="number" pattern="[0-9.]*" style="height: 45px; width:150px" class="form-control" value="0" name="displayQuantity[]" onchange="updateHiddenField(this)">
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <input type="hidden" value="Approved" name="stat[]">
                                        <input type="hidden" value="0" name="quantity[]">
                                        <input type="hidden" value="<?= $data['id_request']; ?>" name="idr[]">
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="text-end m-4">
                            <button type="submit" name="approverefill" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function updateHiddenField(input) {
        const displayQuantity = input.value;
        const parentRow = input.parentElement.parentElement;
        const hiddenField = parentRow.querySelector('input[name="quantity[]"]');
        hiddenField.value = displayQuantity;
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
<script>
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var searchText = $(this).val().toLowerCase();
            $(".card").each(function() {
                var cardText = $(this).text().toLowerCase();
                if (cardText.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>