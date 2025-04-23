<?php
include 'koneksidb.php';

if($_GET['act']== 'tambahpasien'){
    $nama = $_POST['nama'];
    $kehamilan = $_POST['kehamilan'];
    $glukosa = $_POST['glukosa'];
    $tensi = $_POST['tensi'];
    $kulit = $_POST['kulit'];
    $insulin = $_POST['insulin'];
    $bmi = $_POST['bmi'];
    $silsilah = $_POST['silsilah'];
    $usia = $_POST['usia'];
    $status = $_POST['status'];

    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO tb_pasien (nama, kehamilan, glukosa, tensi, kulit, insulin, bmi, silsilah, usia, status) 
    VALUES('$nama' , '$kehamilan' , '$glukosa', '$tensi', '$kulit', '$insulin', '$bmi', '$silsilah', '$usia', '$status')");

    if ($querytambah) {
        # code redirect setelah insert ke index
        header("location:data_pasien.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act']=='updatepasien'){
    $id_pasien = $_POST['id_pasien'];
    $nama = $_POST['nama'];
    $kehamilan = $_POST['kehamilan'];
    $glukosa = $_POST['glukosa'];
    $tensi = $_POST['tensi'];
    $kulit = $_POST['kulit'];
    $insulin = $_POST['insulin'];
    $bmi = $_POST['bmi'];
    $silsilah = $_POST['silsilah'];
    $usia = $_POST['usia'];
    $status = $_POST['status'];

    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE tb_pasien SET nama='$nama' , kehamilan='$kehamilan' , glukosa='$glukosa',
    tensi='$tensi', kulit='$kulit', insulin='$insulin', bmi='$bmi', silsilah='$silsilah', usia='$usia', status='$status' WHERE id_pasien='$id_pasien' ");

    if ($queryupdate) {
        header("location:data_pasien.php");    
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deletepasien'){
    $id_pasien = $_GET['id_pasien'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM tb_pasien WHERE id_pasien = '$id_pasien'");

    if ($querydelete) {
        header("location:data_pasien.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>