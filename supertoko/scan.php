<?php
$id_product = isset($_GET['id_product']) ? intval($_GET['id_product']) : 0;

if ($id_product > 0) {
    $query = "SELECT product_toko_id.id_product AS idp, nama, image, jenis, sku_toko, id_toko AS idt
              FROM product_toko_id
              INNER JOIN toko_id ON toko_id.id_product = product_toko_id.id_product
              WHERE product_toko_id.id_product = $id_product";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $productData = mysqli_fetch_assoc($result);

        if ($productData) {
            $idp = htmlspecialchars($productData['idp']);
            $nama = htmlspecialchars($productData['nama']);
            $jenis = htmlspecialchars($productData['jenis']);
            $sku_toko = htmlspecialchars($productData['sku_toko']);
            $idt = htmlspecialchars($productData['idt']);

            // Display the image
            $image = $productData['image'];
            $img = ($image == null) ? '<img src="../../assets/img/noimageavailable.png" class="zoomable text-center border-radius-lg" style="width: 70px; height: 70px;">' : '<img src="../../assets/img/' . $image . '" class="zoomable text-center border-radius-lg" style="width: 70px; height: 70px;">';
?>

            <div class="card">
                <div class="card-header pb-0">
                <p class="text-uppercase text-sm">Item Information</p>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= $img; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name Item</label>
                                    <p><?= $nama; ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">SKU TOKO</label>
                                    <input class="form-control" name="skut" type="text" value="<?= $sku_toko ?>" readonly>
                                </div>

                            </div>
                        </div>
                </form>


<?php
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid product ID.";
}

// Close the connection
mysqli_close($conn);
?>