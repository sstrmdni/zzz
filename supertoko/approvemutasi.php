<div id="desktopTableContainer">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Approve Mutasi</p>
                                <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success mt-3">Check</a>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Approve Refill</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post" action="">
                                                <table class="table align-items-center justify-content-center mb-0" id="dataModal" width="100%" cellspacing="0">

                                                    <thead style="font-size: 15px;">
                                                        <tr>
                                                            <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">No</th>
                                                            <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">Name Item</th>
                                                            <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">SKU lama</th>
                                                            <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">SKU Baru</th>
                                                            <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">Checklist</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                    <?php
                                    $select = mysqli_query($conn, "SELECT nama, sku_lama, sku_baru, id_mutasi AS idm, mutasitoko_id.id_toko AS idt FROM mutasitoko_id, toko_id, product_toko_id WHERE mutasitoko_id.id_toko=toko_id.id_toko AND toko_id.id_product=product_toko_id.id_product AND status_mutasi='Not Approved'");
                                    $i = 1;
                                    while ($data = mysqli_fetch_array($select)) {
                                        $idt = $data['idt'];
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $data['nama']; ?></td>
                                            <td><?= $data['sku_lama']; ?></td>
                                            <td><?= $data['sku_baru']; ?></td>
                                            <td><input type="checkbox" value="<?= $data['idm']; ?>" name="cek[]" class="form-input"></td>
                                            <input type="hidden" name="idt[]" value="<?= $data['idt']; ?>">
                                            <input type="hidden" name="idm[]" value="<?= $data['idm']; ?>">
                                            <input type="hidden" name="stat" value="Approved">

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                                </table>
                                                <div class="modal-footer">
                                                    <button type="submit" name="mutasiacc" class="btn btn-success">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="fas fa-file-alt text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="smallModalceklist" tabindex="-1">



            <div class="modal-dialog modal-lg">



                <div class="modal-content">



                    <div class="modal-header">



                        <h5 class="modal-title">Approve Refill</h5>



                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>



                    </div>



                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="table-responsive">
                            <table class="table" id="myTable" width="100%" cellspacing="0">

                                <thead style="font-size: 15px;">

                                    <tr>
                                        <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">No</th>
                                        <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">Image</th>
                                        <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">Name Item</th>
                                        <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">SKU</th>
                                        <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">SKU Baru</th>
                                        <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">Time OUt</th>
                                        <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">Status</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    <?php

                                    $select = mysqli_query($conn, "SELECT image, nama, sku_toko, invoice, type_req, id_request FROM request_id, toko_id, product_toko_id WHERE request_id.id_toko=toko_id.id_toko AND toko_id.id_product=product_toko_id.id_product AND status_req='On Process' ORDER BY date DESC");

                                    $i = 1;

                                    while ($data = mysqli_fetch_array($select)) {

                                        $gambar = $data['image'];

                                        if ($gambar == null) {

                                            // jika tidak ada gambar

                                            $img = '<img src="../assets/img/noimageavailable.png" class="zoomable">';
                                        } else {

                                            //jika ada gambar

                                            $img = '<img src="../assets/img/' . $gambar . '" class="zoomable">';
                                        }

                                        $namaItem = $data['nama'];

                                        if (strlen($namaItem) > 30) {

                                            $namaItem = substr($namaItem, 0, 27) . '...';
                                        }

                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $img; ?></td>
                                            <td><?= $namaItem; ?></td>
                                            <td><?= $data['sku_toko']; ?></td>
                                            <td><?= $data['invoice']; ?></td>
                                            <td><?= $data['type_req']; ?></td>
                                            <td>

                                                <!-- Hidden input field to store the quantity -->

                                                <input type="hidden" value="<?= $data['id_request']; ?>" name="idr[]">

                                                <input type="hidden" value="Approved" name="stat[]">

                                                <input type="hidden" value="0" name="quantity[]">

                                                <!-- Display the quantity -->

                                                <input type="number" pattern="[0-9.]*" class="form-control" value="0" name="displayQuantity[]" onchange="updateHiddenField(this)">

                                            </td>

                                        </tr>

                                    <?php

                                    }

                                    ?>

                                </tbody>

                            </table>
                        </div>
                    </form>



                    <script>
                        function updateHiddenField(input) {

                            const displayQuantity = input.value;

                            const parentRow = input.parentElement.parentElement;

                            const hiddenField = parentRow.querySelector('input[name="quantity[]"]');

                            hiddenField.value = displayQuantity;

                        }
                    </script>

                </div>



            </div>



        </div>
        <script>
            // Function untuk menambahkan event listener pada setiap input file
            function setupFileInputs() {
                var fileInputs = document.querySelectorAll('input[type="file"]');
                fileInputs.forEach(function(input) {
                    var fileLabel = input.nextElementSibling;

                    input.addEventListener('change', function() {
                        if (input.files.length > 0) {
                            fileLabel.innerText = 'File dipilih'; // Ubah teks label setelah file dipilih
                            fileLabel.style.backgroundColor = '#2980b9'; // Ubah warna latar belakang setelah file dipilih
                        } else {
                            fileLabel.innerText = 'Pilih File';
                            fileLabel.style.backgroundColor = '#fff'; // Ubah warna latar belakang menjadi putih sebelum memilih file
                        }
                    });
                });
            }

            // Panggil function setupFileInputs saat dokumen selesai dimuat
            document.addEventListener('DOMContentLoaded', setupFileInputs);
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    // Set lengthMenu option to add custom entries to the dropdown
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "Show All"]
                    ],
                    pageLength: 10 // Default number of rows per page
                });
            });
        </script>


        <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>History Refill</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">No</th>
                                        <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">Image</th>
                                        <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">Name Item</th>
                                        <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">SKU</th>
                                        <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">SKU Baru</th>
                                        <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">Time OUt</th>
                                        <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-10 ps-2">Status</th>
                                </thead>



                                <tbody>
                        <?php

                        $select = mysqli_query($conn, "SELECT image, status_mutasi, nama, sku_lama, sku_baru, datetime FROM product_toko_id, toko_id, mutasitoko_id WHERE product_toko_id.id_product=toko_id.id_product AND toko_id.id_toko=mutasitoko_id.id_toko");
                        $i = 1;
                        while ($data = mysqli_fetch_array($select)) {
                            $status = $data['status_mutasi'];

                            //cek data gambar ada apa kagak
                            $gambar = $data['image'];
                            if ($gambar == null) {
                                //jika tidak ada gambar
                                $img = '<img src="../assets/img/noimageavailable.png" class="zoomable">';
                            } else {
                                //jika ada gambar
                                $img = '<img src="../images/' . $gambar . '" class="zoomable">';
                            }
                        ?>
                            <tr>
                                <th><?= $i++; ?></th>
                                <td>Gambar</td>
                                <td><?= $data['nama']; ?></td>
                                <td class="text-uppercase"><?= $data['sku_lama']; ?></td>
                                <td class="text-uppercase"><?= $data['sku_baru']; ?></td>
                                <td><?= $data['datetime']; ?></td>
                                <?php
                                if ($status == 'Approved') {
                                    echo "<td style='color: green;'>$status</td>";
                                } else {
                                    echo "<td style='color: red;'>$status</td>";
                                }
                                ?>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>



                            </table>



                        </div>



                    </div>



                </div>



            </div>