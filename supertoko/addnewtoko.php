<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <p class="mb-0">ADD ITEM <span style="font-weight: bolder;">TOKO</span></p>
                </div>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <p class="text-uppercase text-sm">Item Information</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Image</label>
                                <input type="file" name="file[]" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nama Item</label>
                                <input type="text" class="form-control" name="nama[]" require="">
                                <input type="hidden" name="jum[]" value="<?= $jum; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">SKU Toko</label>
                                <input type="text" name="skug[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Lorong Toko</label>
                                <select id="selectReq" name="lorong[]" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Kelompok Toko</label>
                                <select id="selectReq" name="toko[]" class="form-control">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Jenis</label>
                                <input type="text" readonly name="jenis" class="form-control" value="Toko">
                            </div>
                        </div>
                        <div class="mt-2 text-end">
                            <button class="btn btn-primary" name="newtoko">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>