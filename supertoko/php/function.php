<?php

$conn = mysqli_connect("localhost", "root", "", "mirorim_toko");

//insert req
if (isset($_POST['tokoinput'])) {
    $jum = $_POST['jum'];
    $sku = $_POST['sku'];
    $inv = $_POST['inv'];
    $status = $_POST['status'];
    $stat = $_POST['stat'];
    $tipe = $_POST['tipe_pesanan'];
    $quantity = $_POST['quantity'];
    $requester = $_POST['requester'];

    for ($i = 0; $i < $jum; $i++) {
        if ($inv[$i] == '0') {
            $select = mysqli_query($conn, "SELECT id_toko FROM toko_id WHERE sku_toko='$sku[$i]'");
            $data = mysqli_fetch_array($select);
            $idt = $data['id_toko'];

            if ($select) {
                $insert = mysqli_query($conn, "INSERT INTO request_id(id_toko, quantity_req, requester, type_req, status_req) VALUES('$idt','$quantity[$i]','$requester','$status','$stat')");
                header('location:?url=product');
            }
        } else {
            $select = mysqli_query($conn, "SELECT id_toko FROM toko_id WHERE sku_toko='$sku[$i]'");
            $data = mysqli_fetch_array($select);
            $idt = $data['id_toko'];

            if ($select) {
                $selectlist = mysqli_query($conn, "SELECT id_komponen FROM list_komponen WHERE id_product_finish='$idt'");
                $list = mysqli_fetch_array($selectlist);

                $id_komp = $list['id_komponen'];
                if ($id_komp > 1999999) {
                    $selectproductgudang = mysqli_query($conn, "SELECT SUM(quantity) AS quantity FROM gudang_id WHERE id_product='$id_komp' GROUP BY id_product");
                    $datagudang = mysqli_fetch_array($selectproductgudang);
                    $quantitytotal = $datagudang['quantity'];

                    if ($quantity[$i] > $quantitytotal) {
                        echo '
                    
                    <script>
                    
                    alert("Quantity yang anda minta melebihi yang ada");
                    
                    window.location.href="?url=product";
                    
                    </script>';
                    } else {
                        $insert = mysqli_query($conn, "INSERT INTO request_id(id_toko, invoice, quantity_req, requester, type_req, status_req, tipe_pesanan) VALUES('$idt','$inv[$i]','$quantity[$i]','$requester','$status','$stat','$tipe[$i]')");
                        header('location:?url=product');
                    }
                } elseif ($id_komp < 1999999) {
                    $selectproductgudang = mysqli_query($conn, "SELECT SUM(quantity) AS quantity FROM mateng_id WHERE id_product='$id_komp' GROUP BY id_product");
                    $datagudang = mysqli_fetch_array($selectproductgudang);
                    $quantitytotal = $datagudang['quantity'];

                    if ($quantity[$i] > $quantitytotal) {
                        echo '
                    
                    <script>
                    
                    alert("Quantity yang anda minta melebihi yang ada");
                    
                    window.location.href="?url=product";
                    
                    </script>';
                    } else {
                        $insert = mysqli_query($conn, "INSERT INTO request_id(id_toko, invoice, quantity_req, requester, type_req, status_req, tipe_pesanan) VALUES('$idt','$inv[$i]','$quantity[$i]','$requester','$status','$stat','$tipe[$i]')");
                        header('location:?url=product');
                    }
                }
            } else {
                echo '
                    
                    <script>
                    
                    alert("Tidak ada Komponen Mentah di Gudang, Harap Lapor Gudang");
                    
                    window.location.href="?url=product";
                    
                    </script>';
            }
        }
    } {
    }
}
//Approve Refill

if (isset($_POST['approverefill'])) {
    $quantity = $_POST['quantity'];
    $stat = $_POST['stat'];
    $idr = $_POST['idr'];
    $displayQuantity = $_POST['displayQuantity'];
    $jum = count($idr);

    for ($i = 0; $i < $jum; $i++) {
        $currQuantity = (int)$displayQuantity[$i];

        //gambar
        $allowed_extension = array('png', 'jpg', 'jpeg', 'svg', 'webp');

        $namaimage = $_FILES['file']['name']; //ambil gambar

        if (!empty($namaimage[$i])) {
            $dot = explode('.', $namaimage[$i]);
            $ekstensi = strtolower(end($dot)); //ambil ekstensi
            $ukuran = $_FILES['file']['size']; //ambil size
            $file_tmp = $_FILES['file']['tmp_name']; //lokasi

            //nama acak
            $image = md5(uniqid($namaimage[$i], true) . time()) . '.' . $ekstensi; //compile

            // Proses upload
            if (in_array($ekstensi, $allowed_extension) && $ukuran[$i] < 5000000) {
                move_uploaded_file($file_tmp[$i], '../assets/tokoimg/' . $image);
            } else {
                // File upload error, handle it as needed
                echo "File upload error for image " . ($i + 1);
                continue; // Skip the current iteration and proceed to the next one
            }
        } else {
            $image = ''; // No file chosen, set an empty image
        }

        if ($currQuantity !== 0) {
            $selectlist = mysqli_query($conn, "SELECT quantity_req FROM request_id WHERE id_request='" . $idr[$i] . "'");
            $datalist = mysqli_fetch_array($selectlist);
            $qtyreq = $datalist['quantity_req'];

            if ($qtyreq == $currQuantity) {
                $select = mysqli_query($conn, "SELECT id_gudang AS idg, jenis_item, quantity_tambah FROM request_total WHERE id_request='" . $idr[$i] . "'");
                while ($data = mysqli_fetch_array($select)) {
                    $jenis = $data['jenis_item'];
                    $idg = $data['idg'];
                    $quantitytotal = $data['quantity_tambah'];

                    if ($jenis == 'mentah') {
                        $selectgudang = mysqli_query($conn, "SELECT id_gudang, quantity FROM gudang_id WHERE id_gudang='$idg'");
                        $datagudang = mysqli_fetch_array($selectgudang);
                        $quantitygudang = $datagudang['quantity'];

                        $kurang = $quantitygudang - $quantitytotal;
                        if ($selectgudang) {
                            $update = mysqli_query($conn, "UPDATE gudang_id SET quantity='$kurang' WHERE id_gudang='$idg'");
                            if ($update) {
                                $updatetotal = mysqli_query($conn, "UPDATE request_total SET status_total='Approved' WHERE id_request='$idr[$i]'");
                                if ($updatetotal) {
                                    $updatereq = mysqli_query($conn, "UPDATE request_id SET image_toko='$image', quantity_count='$currQuantity', status_req='Approved' WHERE id_request='$idr[$i]'");
                                    if (!$updatereq) {
                                        echo "Gagal mengupdate status request";
                                    }
                                } else {
                                    echo "Gagal mengupdate status total";
                                }
                            } else {
                                echo "Gagal mengupdate quantity gudang";
                            }
                        } else {
                            echo "Gagal mendapatkan data gudang";
                        }
                    } elseif ($jenis == 'mateng') {
                        $selectgudang = mysqli_query($conn, "SELECT id_gudang, quantity FROM mateng_id WHERE id_gudang='$idg'");
                        $datagudang = mysqli_fetch_array($selectgudang);
                        $quantitygudang = $datagudang['quantity'];

                        $kurang = $quantitygudang - $quantitytotal;
                        if ($selectgudang) {
                            $update = mysqli_query($conn, "UPDATE mateng_id SET quantity='$kurang' WHERE id_gudang='$idg'");
                            if ($update) {
                                $updatetotal = mysqli_query($conn, "UPDATE request_total SET status_total='Approved' WHERE id_request='$idr[$i]'");
                                if ($updatetotal) {
                                    $updatereq = mysqli_query($conn, "UPDATE request_id SET image_toko='$image', quantity_count='$currQuantity', status_req='Approved' WHERE id_request='$idr[$i]'");
                                    if (!$updatereq) {
                                        echo "Gagal mengupdate status request";
                                    }
                                } else {
                                    echo "Gagal mengupdate status total";
                                }
                            } else {
                                echo "Gagal mengupdate quantity gudang";
                            }
                        } else {
                            echo "Gagal mendapatkan data gudang";
                        }
                    }
                }
            } else {
                $update = mysqli_query($conn, "UPDATE request_id SET image_toko='$image', quantity_count='$currQuantity' WHERE id_request='$idr[$i]'");
                if (!$update) {
                    echo "Gagal mengupdate status request";
                }
            }
        }
    }
    header('location:?url=approve');
    exit;
}


if (isset($_POST['approvereadmin'])) {

    $quantityr = $_POST['quantityr'];

    $quantityc = $_POST['quantityc'];

    $stat = $_POST['stat'];

    $idt = $_POST['idt'];

    $idk = $_POST['idk'];

    $idg = $_POST['idg'];



    $jum = count($idt);

    for ($i = 0; $i < $jum; $i++) {

        $update = mysqli_query($conn, "UPDATE request_id SET quantity_req='$quantityr[$i]', quantity_count='$quantityc[$i]' WHERE id_request='$idt[$i]'");

        if ($quantityc[$i] == $quantityr[$i]) {

            $update = mysqli_query($conn, "UPDATE request_id SET quantity_count='$quantity[$i]', status_req='$stat[$i]' WHERE id_request='$idt[$i]'");

            if ($update) {

                $selecttotal = mysqli_query($conn, "SELECT id_total, id_gudang, quantity_tambah FROM request_total WHERE id_request='$idt[$i]'");

                while ($opsi = mysqli_fetch_array($selecttotal)) {

                    $id = $opsi['id_gudang'];

                    $qty = $opsi['quantity_tambah'];

                    $idtol = $opsi['id_total'];



                    if ($selecttotal) {

                        $selectgudang = mysqli_query($conn, "SELECT quantity FROM gudang_id WHERE id_gudang='$id'");

                        $opsi2 = mysqli_fetch_array($selectgudang);

                        $qtyg = $opsi2['quantity'];



                        $kurang = $qtyg - $qty;

                        if ($selectgudang) {

                            $updateg = mysqli_query($conn, "UPDATE gudang_id SET quantity='$kurang' WHERE id_gudang='$id'");

                            if ($updateg) {

                                $updatetol = mysqli_query($conn, "UPDATE request_total SET status_total='$stat[$i]' WHERE id_total='$idtol'");

                                header('location:?url=approve');
                            }
                        } else {
                        }
                    } else {
                    }
                }
            } else {
            }
        } else {
        }

        header('location:?url=approveadmin');
    } {
    }
}



//Edit SKU

if (isset($_POST['addsku'])) {

    $idp = $_POST['idp'];

    $sku = $_POST['sku'];



    $jum = count($idp);

    for ($i = 0; $i < $jum; $i++) {
        $select = mysqli_query($conn, "SELECT sku_toko FROM toko_id WHERE sku_toko='$sku[$i]'");
        $data = mysqli_fetch_array($select);
        $skutoko = $data['sku_toko'];

        $hitung = mysqli_num_rows($select);
        if ($skutoko == "-") {
            $edit = mysqli_query($conn, "UPDATE toko_id SET sku_toko='$sku[$i]' WHERE id_product='$idp[$i]'");
            header('location?url=product');
        } else {
            if ($hitung > 0) {
                echo '
                    
                    <script>
                    
                    alert("Data SKU sudah ada");
                    
                    window.location.href="?url=product";
                    
                    </script>';
            } else {
                $edit = mysqli_query($conn, "UPDATE toko_id SET sku_toko='$sku[$i]' WHERE id_product='$idp[$i]'");
                header('location?url=product');
            }
        }
    } {
    }
}

if (isset($_POST['edititemsuper'])) {
    $skug = $_POST['skut'];
    $nama = $_POST['nama'];
    $idp = $_POST['idp'];
    $idt = $_POST['idt'];
    $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    //gambar

    $allowed_extensions = array('png', 'jpg', 'jpeg', 'svg', 'webp');

    $namaimage = $_FILES['file']['name']; //ambil gambar

    $dot = explode('.', $namaimage);

    $ekstensi = strtolower(end($dot)); //ambil ekstensi

    $ukuran = $_FILES['file']['size']; //ambil size

    $file_tmp = $_FILES['file']['tmp_name']; //lokasi

    //nama acak

    $image = md5(uniqid($namaimage, true) . time()) . '.' . $ekstensi; //compile

    if ($ukuran == 0) {
        $update = mysqli_query($conn, "UPDATE product_toko_id SET nama='$nama' WHERE id_product='$idp'");

        if ($update) {

            $select = mysqli_query($conn, "SELECT sku_toko FROM toko_id WHERE sku_toko='$skug'");

            $hitung = mysqli_num_rows($select);
            if ($hitung > 1 && $skug !== '-') {
                echo '

            <script>

                alert("SKU Toko Telah ada");

                window.location.href="?url=product";

            </script>';
            } else {
                $update2 = mysqli_query($conn, "UPDATE toko_id SET sku_toko='$skug' WHERE id_toko='$idt'");
                header('location: index.php?url=product&page=' . $page_number);  // Modify this line
            }
        } else {

            echo '

            <script>

                alert("Barang Tidak bisa di update");

                window.location.href="?url=product";

            </script>';
        }
    } else {

        move_uploaded_file($file_tmp, '../assets/img/' . $image);

        $update = mysqli_query($conn, "UPDATE product_toko_id SET nama='$nama', image='$image' WHERE id_product='$idp'");

        if ($update) {
            $select = mysqli_query($conn, "SELECT sku_toko FROM toko_id WHERE sku_toko='$skug'");
            $hitung = mysqli_num_rows($select);
            if ($hitung > 1 && $skug !== '-') {
                echo '

            <script>

                alert("SKU Toko Telah ada");

                window.location.href="?url=product";

            </script>';
            } else {
                $update2 = mysqli_query($conn, "UPDATE toko_id SET sku_toko='$skug' WHERE id_toko='$idt'");
                header('location: index.php?url=product&page=' . $page_number);  // Modify this line
            }
        } else {

            echo '

            <script>

                alert("Barang dan Gambar Tidak bisa di update");

                window.location.href="?url=product";

            </script>';
        }
    }
}

//mutasi
if (isset($_POST['mutasi'])) {
    $sku = $_POST['sku'];
    $idt = $_POST['idt'];
    $sku1 = $_POST['sku1'];

    $jum = count($sku);

    for ($i = 0; $i < $jum; $i++) {
        $select = mysqli_query($conn, "SELECT sku_toko FROM toko_id WHERE sku_toko='$sku[$i]'");
        $hitung = mysqli_num_rows($select);
        if ($hitung > 0) {
            echo '
                  <script>    
                    alert("Data SKU yang dimasukan telah ada");
                    window.location.href="?url=product";
                    </script>';
        } else {
            if ($sku == $sku1) {
                echo '
                  <script>    
                    alert("Data SKU yang dimasukan sama");
                    window.location.href="?url=product";
                    </script>';
            } else {
                $insert = mysqli_query($conn, "INSERT INTO mutasitoko_id(id_toko, sku_lama, sku_baru) VALUES('$idt[$i]','$sku1[$i]','$sku[$i]')");
                if ($insert) {
                    $insert = mysqli_query($conn, "UPDATE toko_id SET sku_toko='$sku[$i]' WHERE id_toko='$idt[$i]'");
                    header('location:?url=product');
                } else {
                }
            }
        }
    } {
    }
}
//MUTASI ACC



if (isset($_POST['mutasiacc'])) {
    $cek = $_POST['cek'];
    $idt = $_POST['idt'];
    $idm = $_POST['idm'];
    $stat = $_POST['stat'];

    $jum = count($cek);

    for ($i = 0; $i < $jum; $i++) {
        $select = mysqli_query($conn, "SELECT sku_lama, sku_baru, id_toko AS idt FROM mutasitoko_id WHERE id_mutasi='$cek[$i]'");
        $data = mysqli_fetch_array($select);
        $skubaru = $data['sku_baru'];
        $skulama = $data['sku_lama'];
        $idtoko = $data['idt'];

        if ($select) {
            $update = mysqli_query($conn, "UPDATE toko_id SET sku_toko='$skubaru' WHERE id_toko='$idtoko'");
            if ($update) {
                $update1 = mysqli_query($conn, "UPDATE mutasitoko_id SET status_mutasi='$stat' WHERE id_mutasi='$cek[$i]'");
            }
        } else {
        }
    } {
    }
}

if (isset($_POST['newtoko'])) {
    $nama = $_POST['nama'];
    $jenis =  $_POST['jenis'];
    $skug = $_POST['skug'];
    $jum = $_POST['jum'];
    $lorong = $_POST['lorong'];
    $toko = $_POST['toko'];

    for ($i = 0; $i < $jum; $i++) {

        //gambar

        $allowed_extension = array('png', 'jpg', 'jpeg', 'svg', 'webp');

        $namaimage = $_FILES['file']['name']; //ambil gambar

        $dot = explode('.', $namaimage[$i]);

        $ekstensi = strtolower(end($dot)); //ambil ekstensi

        $ukuran = $_FILES['file']['size']; //ambil size

        $file_tmp = $_FILES['file']['tmp_name']; //lokasi



        //nama acak

        $image = md5(uniqid($namaimage[$i], true) . time()) . '.' . $ekstensi; //compil

        //proses upload

        if (in_array($ekstensi, $allowed_extension) === true) {

            //validasi ukuran

            if ($ukuran[$i] > 0) {

                move_uploaded_file($file_tmp[$i], '../../assets/img/' . $image);

                $insert = mysqli_query($conn, "INSERT INTO product_toko_id(image, nama, jenis) VALUES('$image','$nama[$i]','$jenis')");
                if ($insert) {
                    $select = mysqli_query($conn, "SELECT id_product FROM product_toko_id WHERE nama='$nama[$i]' LIMIT 1");
                    $data = mysqli_fetch_array($select);
                    $idp = $data['id_product'];
                    if ($select) {
                        $insertgudang = mysqli_query($conn, "INSERT INTO toko_id(id_product, sku_toko, lorong, toko) VALUES('$idp','$skug[$i]', '$lorong[$i]', '$toko[$i]')");
                        header('location:?url=product');
                    }
                } else {
                }
            } else {
                $insert = mysqli_query($conn, "INSERT INTO product_toko_id(image, nama, jenis) VALUES('$image','$nama[$i]','$jenis')");
                if ($insert) {
                    $select = mysqli_query($conn, "SELECT id_product FROM product_toko_id WHERE nama='$nama[$i]' LIMIT 1");
                    $data = mysqli_fetch_array($select);
                    $idp = $data['id_product'];
                    if ($select) {
                        $insertgudang = mysqli_query($conn, "INSERT INTO toko_id(id_product, sku_toko, lorong, toko) VALUES('$idp','$skug[$i]', '$lorong[$i]', '$toko[$i]')");
                        header('location:?url=product');
                    }
                } else {
                }
            }
        }
    } {
    }
}

if (isset($_POST['hapusitemsuper'])) {

    $skug = $_POST['skut'];
    $nama = $_POST['nama'];
    $idp = $_POST['idp'];
    $idt = $_POST['idt'];



    //gambar

    $allowed_extension = array('png', 'jpg', 'jpeg', 'svg', 'webp');

    $namaimage = $_FILES['file']['name']; //ambil gambar

    $dot = explode('.', $namaimage);

    $ekstensi = strtolower(end($dot)); //ambil ekstensi

    $ukuran = $_FILES['file']['size']; //ambil size

    $file_tmp = $_FILES['file']['tmp_name']; //lokasi



    //nama acak

    $image = md5(uniqid($namaimage, true) . time()) . '.' . $ekstensi; //compile

    if ($ukuran == 0) {

        $update = mysqli_query($conn, "DELETE FROM product_toko_id  WHERE id_product='$idp'");

        if ($update) {

            $select = mysqli_query($conn, "SELECT sku_toko FROM toko_id WHERE sku_toko='$skug'");

            $hitung = mysqli_num_rows($select);
            if ($hitung > 1 && $skug !== '-') {
                echo '

            <script>

                alert("SKU Toko Telah ada");

                window.location.href="?url=product";

            </script>';
            } else {
                $update2 = mysqli_query($conn, "DELETE FROM toko_id WHERE id_toko='$idt'");

                header('location:?url=product');
            }
        } else {

            echo '

            <script>

                alert("Barang Tidak bisa di update");

                window.location.href="?url=product";

            </script>';
        }
    } else {

        move_uploaded_file($file_tmp, '../assets/img/' . $image);

        $update = mysqli_query($conn, "DELETE FROM product_toko_id  WHERE id_product='$idp'");

        if ($update) {


            $select = mysqli_query($conn, "SELECT sku_toko FROM toko_id WHERE sku_toko='$skug'");
            $hitung = mysqli_num_rows($select);
            if ($hitung > 1 && $skug !== '-') {
                header('location:?url=product');
            } else {
                $update2 = mysqli_query($conn, "DELETE FROM toko_id WHERE id_toko='$idt'");

                header('location:?url=product');
            }
        } else {

            echo '

            <script>

                alert("Barang dan Gambar Tidak bisa di Hapus");

                window.location.href="?url=product";

            </script>';
        }
    }
}

// prepare
if (isset($_POST['prepare'])) {
    $idp = $_POST['idp'];
    $iduser = $_POST['iduser'];
    $jum = count($idp);

    for ($i = 0; $i < $jum; $i++) {
        $insert = mysqli_query($conn, "INSERT INTO toko_prepare(id_product,id_user,status) VALUES ('$idp[$i]','$iduser[$i]','Unprocessed')");
    }
    header('location:?url=prepare');
}

if(isset($_POST['adminresi'])){
    $resi = $_POST['resi'];
    $insert =  mysqli_query($conn,"INSERT INTO tracking(no_resi,admin) VALUES ('$resi','check')");
}

if (isset($_POST["import"])) {

    // Dapatkan informasi file yang diunggah
    $csv_file = $_FILES["csv_file"]["tmp_name"];
    
    // Buka file CSV untuk dibaca
    $file = fopen($csv_file, "r");
    
    // Loop untuk membaca setiap baris dalam file CSV
    while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
        // Dapatkan data dari baris CSV
        $invoice = $data[1];
        $pembayaran = $data[2];
        $nama_product = $data[8];
        $sku_toko = $data[10];
        $jumlah_dibeli = $data[13];
        $penerima = $data[27];
        $kurir = $data[32];
        $tipe = $data[33];
        $resi = $data[34];
        $tanggal_kirim = $data[35];
        $waktu_kirim = $data[36];
        $tgl_kirim = $tanggal_kirim . ' ' . $waktu_kirim;
        $tanggal_kirim3 = date('Y-m-d H:i:s', strtotime(str_replace('/', ' ', $tgl_kirim)));
    
        // ... tambahkan kolom lainnya sesuai dengan struktur tabel Anda
    
        if (strpos($invoice, 'INV') === 0) {
            // Memeriksa apakah $pembayaran adalah datetime yang valid
            if (strtotime($pembayaran) !== false) {
                $tanggal = new DateTime($pembayaran);
                $tanggal_bayar = $tanggal->format('Y-m-d H:i:s'); // Format tanggal ke dalam bentuk yang sesuai dengan MySQL
    
                $tanggal1 = new DateTime($tanggal_kirim);
                $tanggal_kirim2 = $tanggal1->format('Y-m-d');
    
                $waktu2 = new DateTime($waktu_kirim);
                $waktu_kirim2 = $waktu2->format('H:i:s');
    
                $select = mysqli_query($conn, "SELECT id_product, id_toko,sku_toko FROM toko_id WHERE sku_toko='$sku_toko'");
                $dataselect = mysqli_fetch_array($select);
                $toko =  $dataselect['sku_toko'];
                $id_product = $dataselect['id_product'];
                $id_toko = $dataselect['id_toko'];
    
                $ambil = mysqli_query($conn, "SELECT resi FROM shop_id where resi = '$resi'");
                $list = mysqli_fetch_array($ambil);
                $resibaru = $list['resi'];
                if ($resi == $resibaru) {
                } else {
                    if (empty($resi)) {
                    } else {
    
                        $sql = "INSERT INTO shop_id (invoice, tanggal_bayar, id_product, sku_toko, jumlah,penerima,kurir,tipe,resi,tanggal_pengiriman,waktu_pengiriman,nama_product ) VALUES ('$invoice', '$tanggal_bayar','$id_product','$toko   ','$jumlah_dibeli','$penerima','$kurir','$tipe','$resi','$tanggal_kirim3','$waktu_kirim2','$nama_product')";
                        if ($conn->query($sql) !== TRUE) {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                }
            } else {
                echo "Data pembayaran tidak valid: " . $pembayaran . "<br>";
            }
        }
    }
    
    
    
    // Tutup file CSV
    fclose($file);
    
    // Tutup koneksi ke database
    $conn->close();
    
    echo "Data berhasil diimpor.";
    }
    
    
    if (isset($_POST['adminresi'])) {
    $resi = $_POST['resi'];
    $grup = $_POST['grup'];
    $insert = mysqli_query($conn, "INSERT INTO tracking (no_resi,admin,kelompok) VALUES ('$resi','check','$grup')");
    }
    
    if (isset($_POST['pickingresi'])) {
        $resi = $_POST['resi'];
        $grup = $_POST['grup'];
        $insert = mysqli_query($conn, "INSERT INTO tracking (no_resi,picking,kelompok) VALUES ('$resi','check','$grup')");
        }
    