<div id="desktopTableContainer">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card" style="width: 270px;">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Cari Data SKU Toko</p>
                                <div class="form-floating mb-3">
                                </div>
                                <form method="post" action="">
                                    <input class="form-control" style="height: 45px; width: 200px;" name="skug" id="skug" type="text" required>
                                    <button class="btn mt-3 text-white" style="background-color: purple;" type="submit" action="" name="ambildata">Ambil data</button>

                            </div>
                        </div>
                        </form>
                        <div class="col-4 text-end">
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
                    <h6>Ambil Data Mutasi</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center justify-content-center mb-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">No</th>
                                    <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">Image</th>
                                    <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">Nama Varian</th>
                                    <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">SKU Lama</th>
                                    <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">=></th>
                                    <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">SKU Baru</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form id="contact-form" action="" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
                                    <?php
                                    if (isset($_POST['ambildata'])) {
                                        $nama = $_POST['skug'];

                                        $select  = mysqli_query($conn, "SELECT nama, sku_toko, image, id_toko AS idt FROM product_toko_id, toko_id WHERE toko_id.id_product=product_toko_id.id_product AND sku_toko LIKE '%$nama%'");
                                        $s = 1;
                                        while ($data = mysqli_fetch_array($select)) {
                                            $name = $data['nama'];
                                            $idt = $data['idt'];
                                            $skug = $data['sku_toko'];

                                            $gambar = $data['image'];
                                            if ($gambar == null) {
                                                // jika tidak ada gambar
                                                $img = '<img src="../assets/img/noimageavailable.png" class="zoomable">';
                                            } else {
                                                //jika ada gambar
                                                $img = '<img src="../assets/img/' . $gambar . '" class="zoomable">';
                                            }
                                    ?>
                                            <tr>
                                                <td><?= $s++; ?></td>
                                                <td><?= $img; ?></td>
                                                <td class="text-wrap" onclick="toggleTextWrap"><?= $name; ?></td>
                                                <td><input type="text" name="sku1[]" class="form-control" value="<?= $skug; ?>" readonly></td>
                                                <th><input type="hidden" name="idt[]" value="<?= $idt; ?>"></th>
                                                <td><input type="text" name="sku[]" class="form-control" required></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary m-4 text-white" style="background-color: purple;" name="mutasi">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="container">
    <div id="mobileCardContainer" class="d-none">
        <div class="col-xl-6">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card mx-auto" style="width: 300px;">
                        <div class="card-body p-3">
                            <div class="row justify-content-center">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Cari data SKU Toko</p>
                                    <div class="form-floating mb-3">
                                    </div>
                                    <form method="post" action="">
                                        <input class="form-control" style="height: 45px; width: 200px;" name="skug" id="nama" type="text" required>
                                        <button class="btn mt-3 text-white" style="background-color: purple;" type="submit" action="" name="ambildata">Ambil Data</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="dataContainer">
            <form id="contact-form" action="" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
                <?php
                if (isset($_POST['ambildata'])) {
                    $nama = $_POST['skug'];

                    $select  = mysqli_query($conn, "SELECT nama, sku_toko, image, id_toko AS idt FROM product_toko_id, toko_id WHERE toko_id.id_product=product_toko_id.id_product AND sku_toko LIKE '%$nama%'");
                    $s = 1;
                    while ($data = mysqli_fetch_array($select)) {
                        $name = $data['nama'];
                        $idt = $data['idt'];
                        $skug = $data['sku_toko'];

                        $gambar = $data['image'];
                        if ($gambar == null) {
                            // jika tidak ada gambar
                            $img = '<img src="../assets/img/noimageavailable.png" class="zoomable text-center border-radius-lg" style="width: 70px; height: 70px;">';
                        } else {
                            //jika ada gambar
                            $img = '<img src="../assets/img/' . $gambar . '" class="zoomable text-center border-radius-lg" style="width: 70px; height: 70px;">';
                        }
                ?>
                        <div class="col-md-6 mb-2">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div class="d-flex justify-content-center">
                                        <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                            <?= $img; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center mt-2">
                                    <h6 class="text-center mb-0"><?= $name; ?></h6>
                                    <div class="d-flex align-items-center mt-3">
                                        <input type="text" name="sku1[]" class="form-control" value="<?= $skug; ?>" readonly>
                                        <span class="ms-2 me-2">=> </span>
                                        <input type="text" name="sku[]" class="form-control" required>
                                        <input type="hidden" name="idt[]" value="<?= $idt; ?>">
                                    </div>

                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary m-4 text-white" style="background-color: purple;" name="mutasi">Submit</button>
        </div>
        </form>
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