<div id="cardContainer">
    <style>
        .fa-plus,
        .fa-minus {
            color: white;
            border: none;
        }

        .btn-icon {
            margin-right: 10px;
            /* Menambah jarak antara tombol */
        }
    </style>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Request DS</h6>
                    <span>Tolong Isi Sesuai Urutan di Invoice!</span>
                </div>
                <div class="row">
                    <div class="text-start m-2">
                        <button class="fa fa-plus text-lg icon icon-shape bg-gradient-success shadow-success text-center rounded-circle btn-icon" id="addRowsBtn" aria-hidden="true"></button>
                        <button class="fa fa-minus text-lg icon icon-shape bg-gradient-danger shadow-success text-center rounded-circle btn-icon" id="dropRowsBtn" aria-hidden="true"></button>
                    </div>
                </div>
                <form id="contact-form" action="?url=checkds" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
                    <div class="card-body px-0 pt-0 pb-0">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0 parentTable">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 p-1">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Invoice</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">SKU</th>
                                    </tr>
                                </thead>
                                <tbody id="rowContainer">
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between m-4">

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addRowsBtn = document.getElementById("addRowsBtn");
        const rowContainer = document.getElementById("rowContainer");

        let rowCount = 0;

        addRowsBtn.addEventListener("click", function(event) {
            event.preventDefault();

            rowCount++;

            const newRow = `
                <tr>
                <td class="text-xs font-weight-bold text-center ">${rowCount}</td>
                                                                <td><input type="text" name="inv[]" class="form-control"></td>
                                                                <td><input type="text" name="sku[]" class="form-control" required>
                                                                </td>
                </tr>
            `;

            rowContainer.insertAdjacentHTML("beforeend", newRow);
        });
        dropRowsBtn.addEventListener("click", function(event) {
            event.preventDefault();

            if (rowCount > 0) {
                rowCount--;
                rowContainer.removeChild(rowContainer.lastElementChild);
            }
        });
    });
</script>