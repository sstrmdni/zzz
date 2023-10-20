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

    if (strlen($namaItem) > 10) {

        $namaItem = substr($namaItem, 0, 27) . '...';
    }

?>
<div class="mobilecardcontainer">
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Approve ♡<span style="font-weight: bolder;" class="ms-2"><?= $data['type_req']; ?></span></p>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Image</label>
                                    <p><?= $img; ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name Item</label>
                                    <p><?= $data['nama']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">SKU TOKO</label>
                                        <input type="text" class="form-control" style="width: 295px;" readonly value="<?= $data['sku_toko']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Resi</label>
                                        <input type="text" class="form-control" readonly style="width: 295px;" value="<?= $data['invoice']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Status</label>
                                <input type="text" class="form-control" readonly value="<?= $data['type_req']; ?>">
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Quantity</label>
                                    <input type="number" pattern="[0-9.]*" class="form-control" value="0" name="displayQuantity[]" onchange="updateHiddenField(this)">
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
<?php
    echo '<br>';
}
?>
<div class="text-end m-1">
    <button class="btn btn-primary" name="edititemsuper">Submit</button>
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