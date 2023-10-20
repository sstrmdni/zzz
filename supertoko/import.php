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
            <form method="post" enctype="multipart/form-data">
        <label for="csv_file">Pilih File CSV:</label>
        <input type="file" name="csv_file" id="csv_file" accept=".csv">
        <br><br>
        <input type="submit" name="import" value="Import Data">
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
