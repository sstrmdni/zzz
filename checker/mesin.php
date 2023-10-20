<div id="tableContainer">
    <div class="col-xl-6">
        <div class="modal-body">
            <div class="card bg-gray-100">
                <div class="card-body">
                    <?php
                    $resi = $_GET['resi'];

                    // Lakukan query untuk mengecek resi
                    $cek_query = "SELECT resi
              FROM shop_id 
              INNER JOIN toko_id ON toko_id.id_product = shop_id.sku_toko 
              WHERE shop_id.resi = '$resi' GROUP BY resi";

                    $cek_result = mysqli_query($conn, $cek_query);

                    if ($cek_result->num_rows > 0) {
                        while ($row = $cek_result->fetch_assoc()) {
                            echo "Resi: " . $row["resi"] . "<br>";
                        }
                    } else {
                        echo "Tidak ada hasil cek.";
                    }

                    // Lakukan query untuk menampilkan data
                    $cek_data_query = "SELECT resi, product_toko_id.image, toko_id.sku_toko, product_toko_id.nama
                   FROM shop_id
                   INNER JOIN toko_id ON toko_id.id_product = shop_id.id_product
                   INNER JOIN product_toko_id ON toko_id.id_product = product_toko_id.id_product
                   WHERE resi = '$resi'";

                    $cek_data_result = mysqli_query($conn, $cek_data_query);

                    if ($cek_data_result->num_rows > 0) {
                        while ($row = $cek_data_result->fetch_assoc()) {
                            echo "Nama Product: " . $row["nama"] . "<br>";
                            echo "SKU Toko: " . $row["sku_toko"] . "<br>";
                        }
                    } else {
                        echo "Tidak ada data untuk resi ini.";
                    }

                    // Perbaikan bagian penanganan gambar
                    while ($data = mysqli_fetch_array($cek_data_result)) {
                        $gambar = $data['image'];
                        if ($gambar == null) {
                            // jika tidak ada gambar
                            $img = '<img src="../../assets/img/noimageavailable.png" class="zoomable avatar avatar-sm rounded-circle me-2">';
                        } else {
                            //jika ada g"ambar
                            $img = '<img src="../../assets/img/' . $gambar . '" class="zoomable avatar avatar-sm rounded-circle me-2">';
                            echo "Image: " . $img;  // Menampilkan gambar dengan label "Image"
                        }
                    }
                    ?>
                    