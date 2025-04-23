<?php
include 'koneksidb.php';

if($_GET['act']== 'tambahuji'){
    $nama = $_POST['nama'];
    $kehamilan = $_POST['kehamilan'];
    $glukosa = $_POST['glukosa'];
    $tensi = $_POST['tensi'];
    $kulit = $_POST['kulit'];
    $insulin = $_POST['insulin'];
    $bmi = $_POST['bmi'];
    $silsilah = $_POST['silsilah'];
    $usia = $_POST['usia'];

    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO tb_uji (nama, kehamilan, glukosa, tensi, kulit, insulin, bmi, silsilah, usia) 
    VALUES('$nama' , '$kehamilan' , '$glukosa', '$tensi', '$kulit', '$insulin', '$bmi', '$silsilah', '$usia')");

    if ($querytambah) {
        header("location:data_uji.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act']=='updateuji'){
    $id_uji= $_POST['id_uji'];
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
    $queryupdate = mysqli_query($koneksi, "UPDATE tb_uji SET status='?', nama='$nama' , kehamilan='$kehamilan' , glukosa='$glukosa',
    tensi='$tensi', kulit='$kulit', insulin='$insulin', bmi='$bmi', silsilah='$silsilah', usia='$usia' WHERE id_uji='$id_uji' ");

    if ($queryupdate) {
        header("location:data_uji.php");    
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deleteuji'){
    $id_uji = $_GET['id_uji'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM tb_uji WHERE id_uji = '$id_uji'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:data_uji.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>