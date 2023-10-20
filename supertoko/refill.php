<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Quantity Output</p>
                            <div class="form-floating mb-3">
                            </div>
                            <form method="post" action="">
                                <input class="form-control" style="height: 45px; width: 200px;" name="jum" id="nama" type="text" pattern="[0-9.]*" required>
                                <button class="btn btn-success mt-3" type="submit" action="" name="qtyvariant">Submit</button>
                        </div>
                    </div>
                    </form>
                    <div class="col-4 text-end">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="numbers">
    <form id="contact-form" action="" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
        <table class="table align-items-center justify-content-center mb-0" style="width:100%">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">SKU</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">User</th>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php

                if (isset($_POST['qtyvariant'])) {

                    $jum = $_POST['jum'];

                    $s = 1;

                    $jumlah = $jum + $s;



                    for ($i = 1; $i < $jumlah; $i++) {

                ?>

                        <tr>

                            <th><?= $s++; ?></th>

                            <td>
                                <span class="text-sm font-weight-bold">
                                    <input type="text" name="sku[]" class="form-control">
                                </span>
                            </td>

                            <td>

                                <select id="selectReq" name="status" class="form-control">

                                    <option value="refill">Refill</option>

                                </select>

                            </td>

                            <td>
                                <span class="text-sm font-weight-bold">
                                    <input readonly type="text" name="requester" value="<?= $_SESSION['nama_user']; ?>" class="form-control"> </span>
                            </td>


                            <td>
                                <input type="hidden" value="quantity" name="quantity[]">
                                <input type="hidden" value="unprocessed" name="stat">
                                <input type="hidden" value="0" name="inv[]">
                                <input type="hidden" name="jum" value="<?= $jum; ?>">
                            </td>

                        </tr>

                <?php

                    }
                }



                ?>

            </tbody>

        </table>
</div>
<br>
<div class="text-end m-2">

    <button type="submit" class="btn btn-success" name="tokoinput">Submit</button>

</div>
