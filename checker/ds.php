<?php

if (empty($_GET['inv'])) {
    $inv =  $_POST['inv'];
} else {
    $inv = $_GET['inv'];
}

?>

<div id="desktopTableContainer">
    <div class="col-xl-6">
        <div class="modal-body">
            <div class="card bg-gray-100">
                <div class="card-body">
                    <form method="post" action="?url=check">
                        <?php

                        $query = mysqli_query($conn, "SELECT invoice,date FROM ds_id WHERE invoice = '$inv' group by invoice");
                        while ($data = mysqli_fetch_array($query)) {
                            $date = $data['date'];
                        ?>

                            <div class="card">

                                <div class="card-header bg-gradient-success text-white text-center">

                                    <?= $data['invoice']; ?>

                                </div>
                                <?php
                                $select = mysqli_query($conn, "SELECT * FROM ds_id, toko_id, product_toko_id where ds_id.id_toko=toko_id.id_toko AND toko_id.id_product=product_toko_id.id_product AND invoice='$inv' AND date = '$date' ORDER BY id_ds ASC");
                                while ($list = mysqli_fetch_array($select)) {
                                    $gambar = $list['image'];
                                    $status = $list['status'];
                                    $idds = $list['id_ds'];
                                    if ($gambar == null) {
                                        // jika tidak ada gambar
                                        $img = '<img src="../../assets/img/noimageavailable.png" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                    } else {
                                        //jika ada gambar
                                        $img = '<img src="../../assets/img/' . $gambar . '" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                    }
                                    $color = "";
                                    if ($status != 'on process') {
                                        $color = 'background-color: #cfcfcf;';
                                    }
                                ?>
                                    <div class="mt-2" style="<?= $color; ?>">



                                        <div class="d-flex justify-space-between text-sm mt-3" style="margin-left: 20px;">
                                            <strong>SKU:</strong> <?php
                                                                    if ($status == 'on process') {
                                                                        echo '<input type="text" name="sku[]" placeholder="SKU" class="form-control ms-1" style="max-width: 200px">';
                                                                    }
                                                                    ?>
                                        </div>
                                        <div class="d-flex justify-space-between text-sm" style="margin-left: 20px;">
                                            <strong>Status: </strong> <?= $status; ?>
                                        </div>
                                        <div class="d-flex justify-space-between text-sm" style="margin-left: 20px;">
                                            <?php
                                            if ($status == 'on process') {
                                                echo '<input type="number" name="qty[]" class="form-control ms-1" style="max-width: 100px;" value="0" placeholder="quantity">';
                                            }
                                            ?>
                                            <?php
                                            if ($status == 'on process') {
                                                echo '<input type="hidden" name="idds[]" value="' . $idds . '">';
                                            }
                                            ?>
                                            <input type="hidden" name="inv" value="<?= $list['invoice']; ?>">
                                        </div>


                                    </div>
                                <?php } ?>
                            </div>

                        <?php

                        }

                        ?>
                        <div class="mt-3 text-end">

                            <button type="submit" class="btn btn-primary" name="cekds">Submit</button>

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

<div id="mobileCardContainer" class="d-none">
    <div class="col-xl-6">
        <div class="modal-body">
            <div class="card bg-gray-100">
                <div class="card-body">
                    <form method="post" action="?url=taskds" enctype="multipart/form-data">
                        <?php

                        $query = mysqli_query($conn, "SELECT invoice,date FROM ds_id WHERE invoice = '$inv' ORDER BY id_ds DESC LIMIT 1");
                        while ($data = mysqli_fetch_array($query)) {
                            $date = $data['date'];

                        ?>

                            <div class="card">

                                <div class="card-header bg-gradient-success text-white text-center">

                                    <?= $data['invoice']; ?>

                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <input type="text" name="note" class="form-control" placeholder="Note Gambar">
                                    </div>
                                </div>


                                <?php
                                $select = mysqli_query($conn, "SELECT * FROM ds_id, toko_id, product_toko_id where ds_id.id_toko=toko_id.id_toko AND toko_id.id_product=product_toko_id.id_product AND invoice='$inv' AND date = '$date' ORDER BY id_ds ASC");
                                while ($list = mysqli_fetch_array($select)) {
                                    $gambar = $list['image'];
                                    $status = $list['status'];
                                    $idds = $list['id_ds'];
                                    if ($gambar == null) {
                                        // jika tidak ada gambar
                                        $img = '<img src="../../assets/img/noimageavailable.png" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                    } else {
                                        //jika ada gambar
                                        $img = '<img src="../../assets/img/' . $gambar . '" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                    }
                                    $color = "background-color: #cfcfcf;";
                                    if ($status == 'checking') {
                                        $color = 'background-color: #ffffff;';
                                    } elseif ($status == 'failcheck') {
                                        $color = 'background-color: #ffffff;';
                                    }
                                ?>
                                    <div class="mt-2" style="<?= $color; ?>">
                                        <div class="d-flex justify-space-between text-sm ms-3 me-2 ">
                                            <?= $img; ?>
                                            <?= $list['nama']; ?>
                                        </div>
                                        <div class="d-flex justify-space-between text-sm mt-3" style="margin-left: 20px;">
                                            <strong class="me-1">SKU:</strong> <?= $list['sku_toko']; ?> &nbsp;&nbsp;&nbsp;
                                            <strong class="me-1">Status: </strong> <?= $status; ?>

                                        </div>
                                        <div class="d-flex justify-space-between text-sm" style="margin-left: 20px;">

                                        </div>
                                        <div class="d-flex justify-space-between text-sm mb-2 ms-3">
                                            <?php
                                            if ($status == 'checking') {
                                                echo '<strong>Quantity: </strong> <input type="number" name="qty[]" class="form-control ms-1" style="max-width: 100px;" value="0" placeholder="quantity">';
                                            } elseif ($status == 'failcheck') {
                                                echo '<strong>Quantity: </strong> <input type="number" name="qty[]" class="form-control ms-1" style="max-width: 100px;" value="0" placeholder="quantity">';
                                            }
                                            ?>
                                            <?php
                                            if ($status == 'checking') {
                                                echo '<input type="hidden" name="idds[]" value="' . $idds . '">';
                                                echo '<input type="hidden" name="nama" value="' . $_SESSION['nama_user'] . '">';
                                            } elseif ($status == 'failcheck') {
                                                echo '<input type="hidden" name="idds[]" value="' . $idds . '">';
                                                echo '<input type="hidden" name="nama" value="' . $_SESSION['nama_user'] . '">';
                                            }
                                            ?>
                                            <input type="hidden" name="inv" value="<?= $list['invoice']; ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                        <?php

                        }

                        ?>
                        <div class="mt-3 text-end m-1">

                            <button type="submit" class="btn btn-primary" name="cekds">Submit</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function redirectPage(id_request) {
        // Change the destination URL according to your needs
        window.location.href = "index.php?url=ds&idds=" + id_request;
    }
</script>




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