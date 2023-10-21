<?php
$time = $_GET['time'];
$resi = $_GET['resi'];

$cek = mysqli_query($conn, "SELECT resi, date_start FROM checking_id WHERE resi = '$resi'");

if (mysqli_num_rows($cek) > 0) {
    $row = mysqli_fetch_assoc($cek);
    $date_start = $row['date_start'];

    if (!empty($date_start)) {
        $update = mysqli_query($conn, "UPDATE checking_id SET date_second = '$time' WHERE resi = '$resi'");
    }
} else {
    $ambil = mysqli_query($conn, "SELECT invoice, resi, id_shop, id_product FROM shop_id WHERE resi = '$resi'");
    while ($data = mysqli_fetch_assoc($ambil)) {
        $inv = $data['invoice'];
        $idp = $data['id_product'];
        $resi = $data['resi'];
        $ids = $data['id_shop'];
        $insert = mysqli_query($conn, "INSERT INTO checking_id (id_shop, invoice, resi, date_start, id_toko) VALUES ('$ids', '$inv', '$resi', '$time', '$idp')");
    }
}
?>

<div class="col-xl-6">
    <div class="modal-body">
        <div class="card bg-gray-100">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <?php
                    $cek_query = "SELECT resi
                                      FROM shop_id 
                                      INNER JOIN toko_id ON toko_id.id_product = shop_id.sku_toko 
                                      WHERE shop_id.resi = '$resi' GROUP BY resi";
                    $cek_result = mysqli_query($conn, $cek_query);

                    if ($cek_result->num_rows > 0) {
                        while ($row = $cek_result->fetch_assoc()) {
                            echo "<b class='text-center'>" . $row["resi"] . "</b><br>";
                        }
                    } else {
                        echo "Tidak ada hasil cek.";
                    }

                    // Lakukan query untuk menampilkan data
                    $cek_data_query = "SELECT shop_id.resi, product_toko_id.image, toko_id.sku_toko, product_toko_id.nama, shop_id.id_shop, shop_id.invoice, checking_id.status
                    FROM shop_id
                    INNER JOIN toko_id ON toko_id.id_product = shop_id.id_product
                    INNER JOIN checking_id ON checking_id.id_shop = shop_id.id_shop
                    INNER JOIN product_toko_id ON toko_id.id_product = product_toko_id.id_product
                    WHERE shop_id.resi = '$resi'";
                    $cek_data_result = mysqli_query($conn, $cek_data_query);

                    if ($cek_data_result->num_rows > 0) {
                        while ($row = $cek_data_result->fetch_assoc()) {
                            $idshop = $row['id_shop'];
                            $status = $row['status'];
                            $invoice = $row['invoice'];
                            $gambar = $row['image'];
                            if ($gambar == null) {
                                // jika tidak ada gambar
                                $img = '<img src="../../assets/img/noimageavailable.png" class="zoomable avatar avatar-sm me-2">';
                            } else {
                                // jika ada gambar
                                $img = '<img src="../../assets/img/' . $gambar . '" class="zoomable avatar avatar-sm me-2">';
                            }
                            $color = "background-color: #cfcfcf; color: #000;"; 
                            if ($status == '') {
                                $color = 'background-color: #ffffff; color: #000;';
                            } elseif ($status == 'failcheck') {
                                $color = 'background-color: #ff0000; color: #fff;'; 
                            } elseif ($status == 'packing') {
                                $color = 'background-color: #333; color: #fff;';
                            }
                            ?>
                            <div class="body-card mt-3" style="<?= $color; ?>">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <?= $img; ?>
                                    </div>
                                    <div class="col-lg-4">
                                        <span class="text-xs font-weight-bold"><?= $row['nama']; ?></span>
                                    </div>
                                    <div class="col-lg-2 mt-2">
                                        <span class="text-md font-weight-bold" name="sku[]"><?= $row['sku_toko']; ?></span>
                                    </div>
                                    <div class="col-lg-2">
                                        <?php
                                        if ($status == '' || $status == 'failcheck') {
                                            echo '<input type="text" name="qty[]" class="form-control ms-1" style="max-width: 100px;" value="0" placeholder="quantity">';
                                        }
                                        ?>
                                        <?php
                                        if ($status == '' || $status == 'failcheck') {
                                            echo '<input type="text" name="idshop[]" value="' . $idshop . '">';
                                            echo '<input type="text" name="invoice[]" value="' . $invoice . '">';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                    <?php
                        }
                    }
                    ?>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="flex-grow-1 m-2">
                        <input type="text" name="note" class="form-control" placeholder="Note Barang">
                        </div>
                        <div class="ml-3 mt-2">
                            <button name="cekchecker" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>