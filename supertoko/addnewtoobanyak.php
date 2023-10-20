<div class="container">
    <div id="mobileCardContainer">
        <div class="col-xl-6">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card mx-auto" style="width: 300px;">
                        <div class="card-body p-3">
                            <div class="row justify-content-center">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Invoice</p>
                                    <div class="form-floating mb-3">
                                    </div>
                                    <form method="post" action="">
                                        <input class="form-control" style="height: 45px; width: 200px;" name="jum" id="nama" type="text" pattern="[0-9.]*" required>
                                        <button class="btn btn-danger mt-3" type="submit" action="" name="qtyvariant">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form id="contact-form" action="" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="container justify-content-center">
                <div class="row">
                    <?php
                    if (isset($_POST['qtyvariant'])) {
                        $jum = $_POST['jum'];
                        $s = 1;
                        $jumlah = $jum + $s;
                        for ($i = 1; $i < $jumlah; $i++) {
                    ?>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4 mx-auto">
                                        <div class="card mx-auto" style="width: 300px;">
                                            <div class="card-body p-3">
                                                <div class="numbers text-center">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">ADD ITEM</p>
                                                    <div class="border-top my-3" style="border-width: 5px;"></div>
                                                    <div class="border-top my-3" style="border-width: 5px; color:black;"></div>
                                                    <div class="col-md-12">
                                                        <div class="form-group text-start">
                                                            <label for="example-text-input" class="form-control-label">Image</label>
                                                            <input type="file" name="file[]" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-6">
                                                            <div class="form-group text-start">
                                                                <label for="example-text-input" class="form-control-label">Nama Item</label>
                                                                <input type="text" name="nama[]" class="form-control" placeholder="Nama" style="width:140px;">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group text-start">
                                                                <label for="example-text-input" class="form-control-label">SKU Toko</label>
                                                                <input type="text" name="sku[]" class="form-control" placeholder="SKU">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="text" readonly name="jenis" class="form-control" value="Toko">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                </div>
            </div>
    </div>
</div>
</div>


<?php
                            echo '<br>';
                        }
                    }
?>

</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="text-end m-4">

    <button type="submit" class="btn btn-danger" name="tokoinput">Submit</button>

</div>
</div>
</div>