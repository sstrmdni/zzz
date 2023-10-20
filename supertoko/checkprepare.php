<div id="desktopTableContainer">
    <div class="row">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 mb-2">
                        <h6>List Prepare</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive">
                            <form method="post">
                                <table class="table align-items-center justify-content-center mb-0" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Resi</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gambar</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Item</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">SKU Toko</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama User</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sku = $_POST['sku'];
                                        $iduser = $_POST['iduser'];
                                        $jum = count($sku);

                                        $n = 1;
                                        for ($i = 0; $i < $jum; $i++) {
                                            $select = mysqli_query($conn, "SELECT image,nama,sku_toko,product_toko_id.id_product FROM toko_id,product_toko_id WHERE toko_id.id_product = product_toko_id.id_product AND sku_toko = '$sku[$i]'");
                                            while ($list = mysqli_fetch_array($select)) {
                                                $gambar = $list['image'];
                                                if ($gambar == null) {
                                                    // jika tidak ada gambar
                                                    $img = '<img src="../../assets/img/noimageavailable.png" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                                } else {
                                                    //jika ada gambar
                                                    $img = '<img src="../../assets/img/' . $gambar . '" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                                }
                                                $k = $n++;

                                        ?>
                                                <tr class="parentRow">
                                                    <td>
                                                        <p class="text-sm font-weight-bold mb-0 text-center"><?= $k; ?></p>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex px-1">
                                                            <div>
                                                                <?= $img; ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-wrap"><?= $list['nama']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $list['sku_toko']; ?>
                                                        <input type="hidden" value="<?= $list['id_product']; ?>" class="form-control ms-2" style="max-width: 200px;" name="idp[]" readonly>
                                                    </td>
                                                    <td><?php
                                                        $user = mysqli_query($conn, "SELECT nama_user FROM login where iduser = '$iduser[$k]'");
                                                        $data = mysqli_fetch_array($user);

                                                        ?><?= $data['nama_user']; ?>
                                                        <input type="hidden" class="form-control ms-2" style="max-width: 200px;" name="iduser[]" value="<?= $iduser[$k]; ?>" required>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="mt-3 text-end m-4">
                                    <button type="submit" class="btn btn-primary" name="prepare">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="mobileCardContainer" class="d-none">
    <div class="col-xl-6">
        <div class="modal-body">
            <div class="card bg-gray-100">
                <div class="card-body">
                    <form method="post">
                        <?php
                        $sku = $_POST['sku'];
                        $iduser = $_POST['iduser'];
                        $jum = count($sku);
                        $n = 1;

                        for ($i = 0; $i < $jum; $i++) {
                            $select = mysqli_query($conn, "SELECT image,nama,sku_toko,product_toko_id.id_product FROM toko_id,product_toko_id WHERE toko_id.id_product = product_toko_id.id_product AND sku_toko = '$sku[$i]'");
                            while ($list = mysqli_fetch_array($select)) {
                                $gambar = $list['image'];
                                if ($gambar == null) {
                                    // jika tidak ada gambar
                                    $img = '<img src="../../assets/img/noimageavailable.png" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                } else {
                                    //jika ada gambar
                                    $img = '<img src="../../assets/img/' . $gambar . '" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                }
                                $k = $n++;
                        ?>
                                <div class="card">
                                    <div class="card-header bg-gradient-primary text-white text-center">
                                        <h6>List Prepare</h6>
                                    </div>
                                    <div class="mt-2">
                                        <div class="d-flex justify-content-between align-items-center text-sm ms-3 me-2">
                                            <div class="ms-auto">
                                                <?= $img; ?>
                                            </div>
                                            <div>
                                                <?= $list['nama']; ?>
                                            </div>
                                        </div>
                                        <?php
                                                        $user = mysqli_query($conn, "SELECT nama_user FROM login where iduser = '$iduser[$k]'");
                                                        $data = mysqli_fetch_array($user);

                                                        ?>
                                        <div class="d-flex justify-space-between text-sm" style="margin-left: 20px;">
                                            <input type="text" value="<?= $list['sku_toko']; ?>" class="form-control ms-2" style="max-width: 200px;" name="skut[]" readonly>
                                            <?= $data['nama_user']; ?>
                                            <input type="hidden" class="form-control ms-2" style="max-width: 200px;" name="iduser[]" value="<?= $iduser[$k]; ?>" required>
                                            <input type="hidden" value="<?= $list['id_product']; ?>" class="form-control ms-2" style="max-width: 200px;" name="idp[]" readonly>
                                        </div>

                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-primary" name="prepare">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function redirectPage(id_request) {
                // Change the destination URL according to your needs
                window.location.href = "index.php?url=ds&idds=" + id_request;
            }
        </script>

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