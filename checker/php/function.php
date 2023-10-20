<?php

$conn = mysqli_connect("localhost", "root", "", "mirorim_toko");

// check ds

if (isset($_POST['cekds'])) {
    $idds = $_POST['idds'];
    $qty = $_POST['qty'];
    $inv = $_POST['inv'];
    $jum = count($idds);
    $note = $_POST['note'];
    $nama = $_POST['nama'];

    //gambar
    $allowed_extension = array('png', 'jpg', 'jpeg', 'svg', 'webp');

    $namaimage = $_FILES['file']['name']; //ambil gambar

    if (!empty($namaimage)) {
        $dot = explode('.', $namaimage);
        $ekstensi = strtolower(end($dot)); //ambil ekstensi
        $ukuran = $_FILES['file']['size']; //ambil size
        $file_tmp = $_FILES['file']['tmp_name']; //lokasi

        //nama acak
        $image = md5(uniqid($namaimage, true) . time()) . '.' . $ekstensi; //compile

        // Proses upload
        if (in_array($ekstensi, $allowed_extension) && $ukuran < 5000000) {
            move_uploaded_file($file_tmp, '../checkimg/' . $image);
        } else {
            // File upload error, handle it as needed
            echo "File upload error for image " . ($i + 1);
        }
    } else {
        $image = ''; // No file chosen, set an empty image
    }

    if (empty($note)) {
    } else {
        $gambar = mysqli_query($conn, "INSERT INTO check_id(image,note,invoice) VALUES('$image','$note','$inv')");
    }
    for ($i = 0; $i < $jum; $i++) {
        $count = (int)$qty[$i];
        if ($count !== 0) {
            $insert = mysqli_query($conn, "INSERT INTO check_id(id_ds, quantity,invoice) VALUES('$idds[$i]','$qty[$i]','$inv')");
            if ($insert) {
                $ubah = mysqli_query($conn, "UPDATE ds_id SET checker = '$nama' WHERE id_ds = '$idds[$i]'");
                $select = mysqli_query($conn, "SELECT ds_id.quantity as qty1, check_id.quantity as qty2 FROM ds_id, check_id WHERE ds_id.id_ds = '$idds[$i]' AND check_id.id_ds = '$idds[$i]' order by id_check DESC LIMIT 1;");
                $data = mysqli_fetch_array($select);
                $qty1 = $data['qty1'];
                $qty2 = $data['qty2'];
                if ($qty1 == $qty2) {
                    $update = mysqli_query($conn, "UPDATE ds_id SET status = 'packing' where id_ds = '$idds[$i]'");
                } else {
                    $update = mysqli_query($conn, "UPDATE ds_id SET status = 'failcheck' WHERE id_ds = '$idds[$i]'");
                }
            }
        }
    }
}

// check checeker <3
if (isset($_POST['nayeon'])) {
    $idshop = $_POST['idshop'];
    $qty = $_POST['qty'];
    $note = $_POST['note'];
    $jum = count($idshop);
}
//gambar
$allowed_extension = array('png', 'jpg', 'jpeg', 'svg', 'webp');

$namaimage = $_FILES['file']['name']; //ambil gambar

if (!empty($namaimage)) {
    $dot = explode('.', $namaimage);
    $ekstensi = strtolower(end($dot)); //ambil ekstensi
    $ukuran = $_FILES['file']['size']; //ambil size
    $file_tmp = $_FILES['file']['tmp_name']; //lokasi

    //nama acak
    $image = md5(uniqid($namaimage, true) . time()) . '.' . $ekstensi; //compile

    // Proses upload
    if (in_array($ekstensi, $allowed_extension) && $ukuran < 5000000) {
        move_uploaded_file($file_tmp, '../checkingg/' . $image);
    } else {
        echo "File upload error for image";
    }
} else {
    $image = '';
}

if (empty($note)) {
} else {
    $gambar = mysqli_query($conn, "UPDATE checking_id SET image = '$image', note = '$note' WHERE id_shop = '$idshop'");
}

for ($i = 0; $i < $jum; $i++) {
    $count = (int)$qty[$i];
    if ($count !== 0) {
        // Update quantity di tabel checking_id
        $insert = mysqli_query($conn, "UPDATE checking_id SET quantity = '$qty[$i]' WHERE id_shop = '$idshop[$i]'");
        if ($insert) {
            // Mengecek quantity
            $select = mysqli_query($conn, "SELECT c.quantity as qty1, s.jumlah as qty2
            FROM checking_id c
            JOIN shop_id s ON c.id_shop = s.id_shop
            WHERE c.id_shop = '$idshop[$i]'
            ORDER BY c.id_checking DESC 
            LIMIT 1");
            $data = mysqli_fetch_array($select);
            $qty1 = $data['qty1'];
            $qty2 = $data['qty2'];
            if ($qty1 == $qty2) {
                $update = mysqli_query($conn, "UPDATE checking_id SET status = 'packing' where id_shop = '$idshop[$i]'");
            } else {
                $update = mysqli_query($conn, "UPDATE checking_id SET status = 'failcheck' WHERE id_shop = '$idshop[$i]'");
            }
        }
    }
}
