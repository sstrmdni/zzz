    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Mutasi</p>
                                <a href="?url=komponenlist" class="btn mt-3" style="background-color: purple; color:white">Go</a>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape text-center rounded-circle" style="background-color: purple;">
                                <i class="fas fa-file-alt text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>History Mutasi</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center justify-content-center mb-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name Item</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SKU</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SKU Baru</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Time Out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select = mysqli_query($conn, "SELECT image, nama, sku_lama, sku_baru, datetime FROM product_toko_id, toko_id, mutasitoko_id WHERE product_toko_id.id_product=toko_id.id_product AND toko_id.id_toko=mutasitoko_id.id_toko");
                                    $i = 1;
                                    while ($data = mysqli_fetch_array($select)) {
                                        // Cek data gambar ada apa tidak
                                        $gambar = $data['image'];
                                        if ($gambar == null) {
                                            // Jika tidak ada gambar
                                            $img = '<img src="../assets/img/noimageavailable.png" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                        } else {
                                            // Jika ada gambar
                                            $img = '<img src="../assets/img/' . $gambar . '" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                        }
                                    ?>
                                        <tr>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0"><?= $i++; ?>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2">

                                                    <div>

                                                        <?= $img; ?>

                                                    </div>

                                                </div>
                                                </td>
                                            <td>
                                            <span class="text-xs font-weight-boldn text-wrap">
                                            <?= $data['nama']; ?>
                                            </span></td>
                                            <td class="text-uppercase"><span class="text-xs font-weight-boldn text-wrap"><?= $data['sku_lama']; ?></td>
                                            <td class="text-uppercase"><span class="text-xs font-weight-boldn text-wrap"><?= $data['sku_baru']; ?></td>
                                            <td><span class="text-xs font-weight-boldn text-wrap"><?= $data['datetime']; ?></td>
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
        </div>
    </div>

    <script>
        function toggleTextWrap(element) {
            element.classList.toggle('text-wrap');
        }
    </script>
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