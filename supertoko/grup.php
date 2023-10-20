<div id="tableContainer">
    <div class="col-xl-6">
        <div class="modal-body">
            <div class="card bg-gray-100">
                <div class="card-body">
                    <form action="?url=scan" method="post">
                        <?php
                        if (isset($_GET['resi'])) {
                            $resi = $_GET['resi'];

                            // Lakukan query untuk mendapatkan informasi berdasarkan resi
                            $query = "SELECT *
                                    FROM shop_id
                                    INNER JOIN toko_id ON shop_id.id_product = toko_id.id_product
                                    INNER JOIN product_toko_id ON toko_id.id_product = product_toko_id.id_product
                                    WHERE resi = '$resi' group by resi;
                                    ";
                            $result = mysqli_query($conn, $query);

                            $cek = "SELECT resi,tanggal_bayar,toko FROM shop_id, toko_id WHERE toko_id.id_product = shop_id.id_product AND resi = '$resi'";
                            $tes = mysqli_query($conn, $cek);

                            // Memeriksa apakah query berhasil dijalankan
                            if ($tes) {
                                // Menginisialisasi variabel untuk menghitung jumlah 'A' dan 'B'
                                $countA = 0;
                                $countB = 0;

                                // Mengambil data dari hasil query
                                while ($data = mysqli_fetch_array($tes)) {
                                    $toko = $data['toko'];
                                    $tgl = $data['tanggal_bayar'];
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
                                    echo '<input type="text" class="form-control" name="resi" value="' . htmlspecialchars($resi) . '" readonly>';
                                    echo 'Tangal Bayar: ' . $tgl;
                                    echo '<br>Kelompok : <input type="text" class="form-control" name="grup" value="A" readonly>';
                                } elseif ($countA == 0 && $countB > 0) {
                                    echo '<input type="text" class="form-control" name="resi" value="' . htmlspecialchars($resi) . '" readonly>';
                                    echo 'Tangal Bayar: ' . $tgl;
                                    echo '<br>Kelompok : <input type="text" class="form-control" name="grup" value="B" readonly>';
                                } else {
                                    echo '<input type="text" class="form-control" name="resi" value="' . htmlspecialchars($resi) . '" readonly>';
                                    echo 'Tangal Bayar: ' . $tgl;
                                    echo '<br>Kelompok : <input type="text" class="form-control" name="grup" value="C" readonly>';
                                }
                            } else {
                                echo "Error: " . $cek . "<br>" . mysqli_error($conn);
                            }

                            // Close the connection
                            mysqli_close($conn);
                        } else {
                            echo "Invalid resi.";
                        }
                        ?>
                        <button type="submit" name="adminresi" class="bg-gradient-primary form-control"  >SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>