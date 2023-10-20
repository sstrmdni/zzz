<?php







'../../gudang/php/function.php';

$idg = $_GET['idt'];



$idp = $_GET['idp'];



$select = mysqli_query($conn, "SELECT image, nama, jenis, sku_toko FROM product_toko_id, toko_id WHERE product_toko_id.id_product=toko_id.id_product AND id_toko='$idg'");

$data = mysqli_fetch_array($select);

$gambar = $data['image'];

if ($gambar == null) {



    // jika tidak ada gambar



    $img = '<img src="../../assets/img/noimageavailable.png" class="zoomable text-center border-radius-lg" style="width: 100px; height: 100px;">';

} else {



    //jika ada gambar



    $img = '<img src="../../assets/img/' . $gambar . '" class="zoomable text-center border-radius-lg" style="width: 150px; height:150px;">';

}

?>



<div class="row">

    <div class="col-md-12">

        <div class="card">

            <div class="card-header pb-0">

                <div class="d-flex align-items-center">

                    <p class="mb-0">Edit Item <span style="font-weight: bolder;"><?= $data['nama']; ?></span></p>

                </div>

            </div>

            <form method="post" enctype="multipart/form-data">

                <div class="card-body">

                    <p class="text-uppercase text-sm">Item Information</p>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <?= $img; ?>

                            </div>

                            <div class="form-group">

                                <label for="example-text-input" class="form-control-label">Image</label>

                                <input class="form-control" name="file" type="file">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="example-text-input" class="form-control-label">Name Item</label>

                                <input class="form-control" name="nama" type="text" value="<?= $data['nama']; ?>">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="example-text-input" class="form-control-label">SKU TOKO</label>

                                <input class="form-control" name="skut" type="text" value="<?= $data['sku_toko']; ?>">

                            </div>

                            <input type="hidden" name="idg" value="<?= $idg; ?>">

                            <input type="hidden" name="idp" value="<?= $idp; ?>">

                            <div class="text-end">

                                <button class="btn btn-primary" name="edititemsuper">Submit</button>

                            </div>

                        </div>

                    </div>

            </form>

        </div>

    </div>

</div>