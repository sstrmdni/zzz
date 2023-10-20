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

                <div class="card bg-gray-100">

                    <form action="?url=ds" method="post">

                        <div class="row ms-3 mt-3">

                            <span>Invoice</span>

                            <input type="number" class="form-control" style="max-width: 200px;" name="inv" placeholder="Masukan Invoice">

                            <div class="mt-3">

                                <button type="submit" class="btn btn-primary" name="cekinv">Submit</button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>



<div id="mobileCardContainer" class="d-none">

    <div class="col-xl-6">

        <div class="modal-body">

            <div class="card bg-gray-100">

                <form action="?url=ds" method="post">

                    <div class="row m-2">

                        <span class="ms-3">Invoice</span>

                        <div class="d-flex justify-content-between m-2">

                            <input type="text" class="form-control" name="inv" placeholder="Masukan Invoice">

                            <button type="submit" class="btn btn-primary ms-2" name="cekinv">Submit</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <div class="col-lg-4 mt-3">

            <div class="col-xl-6">

                <div class="modal-body">

                    <div class="card bg-gray-100">

                        <?php

                        $select = mysqli_query($conn, "SELECT invoice, id_ds, date,status FROM ds_id WHERE status='failcheck' or status='checking' GROUP BY invoice, date ORDER BY date DESC");

                        while ($data = mysqli_fetch_array($select)) {

                            $inv = $data['invoice'];

                            $date = $data['date'];

                            $status = $data['status'];

                            $button = "redirectPage('" . urlencode($inv) . "')";

                        ?>

                            <a onclick="<?= $button; ?>">

                                <?php

                                $warna = 'bg-gradient-primary';

                                if ($status == 'failcheck') {

                                    $warna = 'bg-gradient-danger';

                                }

                                ?>

                                <div class="card <?= $warna; ?> m-2">

                                    <div class="card-body text-white text-center">

                                        <?= $inv; ?>

                                    </div>

                                </div>

                            </a>

                        <?php

                        }

                        ?>

                    </div>

                </div>

            </div>

            <script>

                function redirectPage(id_request) {

                    // Change the destination URL according to your needs

                    window.location.href = "index.php?url=ds&inv=" + id_request;

                }

            </script>

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