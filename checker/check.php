<?php
$inv = $_POST['inv'];
?>
<div id="tableContainer">
    <div class="row">

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">

            <div class="card">

                <div class="card-body p-3">

                    <h6>Hi <?= $_SESSION['nama_user']; ?> ♥</h6>

                </div>

            </div>

        </div>

    </div>

    <div class="row mt-4">

        <div class="col-12">

            <div class="card mb-4">

                <div class="card-header pb-0">

                    <h6>History DS</h6>

                </div>

                <div class="card-body px-0 pt-0 pb-2">

                    <div class="table-responsive p-0">

                        <div style="padding: 10px;">

                            <!-- Update the class name of the parent table -->

                            <table class="table align-items-center justify-content-center mb-0 parentTable" style="width:100%; margin-bottom: 20px;">

                                <thead>

                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap">Invoice</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2text-wrap">SKU Order</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-wrap">Qty Order</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">>>></th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-wrap">SKU Checker</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-wrap">Qty Checker</th>
                                    </tr>

                                </thead>

                                <tbody>
                                    <?php
                                    $i = 1;
                                    $querygudang = mysqli_query($conn, "SELECT * from ds_id,toko_id WHERE toko_id.id_toko = ds_id.id_toko AND invoice = '$inv' ORDER BY id_ds ASC");
                                    while ($list = mysqli_fetch_array($querygudang)) {
                                        $idds = $list['id_ds'];
                                    ?>

                                        <tr class="parentRow"> <!-- Add a class for parent rows -->

                                            <td>

                                                <p class="text-sm font-weight-bold mb-0"><?= $i++; ?></p>

                                            </td>

                                            <td>
                                                <span class="text-xs font-weight-bold"><?= $list['invoice']; ?></span>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold"><?= $list['sku_toko']; ?></span>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold"><?= $list['quantity']; ?></span>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold">>>></span>
                                            </td>
                                            <?php 
                                            $select = mysqli_query($conn, "SELECT * from check_id,toko_id where toko_id.id_toko = check_id.id_toko AND id_ds = '$idds'");
                                            while($data = mysqli_fetch_array($select)){
                                            ?>
                                            <td>
                                                <?php 
                                                $color = "";
                                                if($list['sku_toko'] != $data['sku_toko'] ){
                                                    $color = "text-danger";
                                                }
                                                ?>
                                                <span class="text-xs font-weight-bold <?= $color ;?>"><?= $data['sku_toko']; ?></span>
                                            </td>
                                            <td>
                                            <?php 
                                                $warna = "";
                                                if($list['quantity'] != $data['quantity'] ){
                                                    $warna = "text-danger";
                                                }
                                                ?>
                                                <span class="text-xs font-weight-bold <?= $warna ;?>"><?= $data['quantity']; ?></span>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                    <?php

                                    }

                                    ?>

                                    <!-- Rows for other data -->

                                </tbody>
                                <a class="btn btn-primary" href="?url=taskds">NEXT</a>

                            </table>



                        </div>


                    </div>
                </div>

                <!-- Add this script at the end of your HTML document -->

                <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>



                <script>
                    $(document).ready(function() {

                        // Initialize DataTable for the parent table only

                        $('.parentTable').DataTable({

                            // Add your DataTable options and configurations here

                            // For example:

                            // "paging": false,

                            // "searching": false,

                            // "ordering": false,

                            // "info": false,

                        });

                    });
                </script>

            </div>

        </div>

    </div>

</div>