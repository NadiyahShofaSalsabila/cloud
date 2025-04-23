<?php 
$id_uji= $_GET['id_uji'];
$nama = $_GET['nama'];
$kehamilan = $_GET['kehamilan'];
$glukosa = $_GET['glukosa'];
$tensi = $_GET['tensi'];
$kulit = $_GET['kulit'];
$insulin = $_GET['insulin'];
$bmi = $_GET['bmi'];
$silsilah = $_GET['silsilah'];
$usia = $_GET['usia'];

include 'template/header_admin.php'; 
include 'koneksidb.php';

//Set Data Training to Array
$sql = "SELECT * from tb_pasien";
$result = mysqli_query($koneksi, $sql);

$k = 5; //Ganti k disini

$maxkehamilan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MAX(kehamilan) AS maxkehamilan FROM tb_pasien"))["maxkehamilan"];
$minkehamilan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MIN(kehamilan) AS minkehamilan FROM tb_pasien"))["minkehamilan"];
$maxglukosa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MAX(glukosa) AS maxglukosa FROM tb_pasien"))["maxglukosa"];
$minglukosa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MIN(glukosa) AS minglukosa FROM tb_pasien"))["minglukosa"];
$maxtensi = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MAX(tensi) AS maxtensi FROM tb_pasien"))["maxtensi"];
$mintensi = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MIN(tensi) AS mintensi FROM tb_pasien"))["mintensi"];
$maxkulit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MAX(kulit) AS maxkulit FROM tb_pasien"))["maxkulit"];
$minkulit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MIN(kulit) AS minkulit FROM tb_pasien"))["minkulit"];
$maxinsulin = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MAX(insulin) AS maxinsulin FROM tb_pasien"))["maxinsulin"];
$mininsulin = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MIN(insulin) AS mininsulin FROM tb_pasien"))["mininsulin"];
$maxbmi = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MAX(bmi) AS maxbmi FROM tb_pasien"))["maxbmi"];
$minbmi = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MIN(bmi) AS minbmi FROM tb_pasien"))["minbmi"];
$maxsilsilah = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MAX(silsilah) AS maxsilsilah FROM tb_pasien"))["maxsilsilah"];
$minsilsilah = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MIN(silsilah) AS minsilsilah FROM tb_pasien"))["minsilsilah"];
$maxusia = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MAX(usia) AS maxusia FROM tb_pasien"))["maxusia"];
$minusia = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MIN(usia) AS minusia FROM tb_pasien"))["minusia"];

$training_data = array();
while ($row = mysqli_fetch_array($result)) {
  $hamil = ($row['kehamilan'] - $minkehamilan) / ($maxkehamilan - $minkehamilan);
  $glk = ($row['glukosa'] - $minglukosa) / ($maxglukosa - $minglukosa);
  $tns = ($row['tensi'] - $mintensi) / ($maxtensi - $mintensi);
  $klt = ($row['kulit'] - $minkulit) / ($maxkulit - $minkulit);
  $ins = ($row['insulin'] - $mininsulin) / ($maxinsulin - $mininsulin);
  $bmi_ = ($row['bmi'] - $minbmi) / ($maxbmi - $minbmi);
  $sslh = ($row['silsilah'] - $minsilsilah) / ($maxsilsilah - $minsilsilah);
  $umur = ($row['usia'] - $minusia) / ($maxusia - $minusia);

  $training_data[] = array($row['nama'], $hamil, $glk, $tns, $klt, $ins, $bmi_, $sslh, $umur, $row['status']);
} //End Set Data Training to Array

function distance($point1, $point2) {
    $dist = 0;
    for ($i = 0; $i < count($point1) - 1; $i++) {
        $dist += pow(($point1[$i] - $point2[$i+1]), 2);
    }
    return sqrt($dist);
}

$kehamilan = ($kehamilan - $minkehamilan) / ($maxkehamilan - $minkehamilan);
$glukosa = ($glukosa - $minglukosa) / ($maxglukosa - $minglukosa);
$tensi = ($tensi - $mintensi) / ($maxtensi - $mintensi);
$kulit = ($kulit - $minkulit) / ($maxkulit - $minkulit);
$insulin = ($insulin - $mininsulin) / ($maxinsulin - $mininsulin);
$bmi = ($bmi - $minbmi) / ($maxbmi - $minbmi);
$silsilah = ($silsilah - $minsilsilah) / ($maxsilsilah - $minsilsilah);
$usia = ($usia - $minusia) / ($maxusia - $minusia);

$distances = array();
foreach ($training_data as $data) {
  $d = distance(array($kehamilan, $glukosa, $tensi, $kulit, $insulin, $bmi, $silsilah, $usia, null), $data);
  $distances[] = array('nama' => $data[0], 'dist' => number_format($d,5), 'status' => $data[9]);
}

$count = count($distances);
for ($i = 0; $i < $count - 1; $i++) {
  for ($j = $i + 1; $j < $count; $j++) {
    if ($distances[$j]['dist'] < $distances[$i]['dist']) {
      $temp = $distances[$i];
      $distances[$i] = $distances[$j];
      $distances[$j] = $temp;
    }
  }
}


?>


<div class="content-wrapper">
<section class="content-header">
  <h1>Data Uji <?php echo $nama; ?>
    <small>Sistem Prediksi Diabetes</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Data Uji <?php echo $nama; ?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Hasil Data Uji KNN dengan k = <?php echo $k; ?></h3> 
        </div>
        <div class="box-body">

          <div class="table-responsive22">
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nomor</th>
                  <th>Nama Pasien</th>
                  <th>Jarak</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $no = 1;
                    $count = 0;
                    $diabetes = 0;
                    foreach ($distances as $row) {
                      if($count == $k){
                        break;
                      }

                      if($row['status'] == 1){
                        $diabetes++;
                      }
                      $count++;
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['nama']?></td>
                    <td><?php echo $row['dist']; ?></td>
                    <?php
                      $status = "";

                      if ($row['status'] == 1) {
                          $status =  'Diabetes';
                      } else{
                          $status = 'Tidak Diabetes';
                      }
                    ?>
                    <td><?php echo $status; ?></td>
                  </tr>
                  <?php
                    }
                  ?>
              </tbody>
            </table>
          </div> 
          
          <div class="box-header with-border">
          <h3 class="box-title">Kesimpulan</h3> 
        </div>
          
          <div class="table-responsive22">
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                <th>Nomor</th>
                  <th>Nama Pasien</th>
                  <th>Jumlah Kehamilan</th>
                  <th>Konsentrasi Glukosa</th>
                  <th>Tekanan Darah</th>
                  <th>Ketebalan Lipatan Kulit</th>
                  <th>Insulin</th>
                  <th>BMI</th>
                  <th>Fungsi Silsilah Diabetes</th>
                  <th>Usia</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $no = 1;
                  if($diabetes < 3){ //Kalau k=3, ganti menjadi $diabetes < 2
                    $status = 0;
                  }
                  else{
                    $status = 1;
                  }
                  

                  $queryupdate =  mysqli_query($koneksi, "Update tb_uji set status='$status' where id_uji = $id_uji");

                    $queryhasil = mysqli_query($koneksi, "SELECT * from tb_uji where id_uji = $id_uji");
                    while ($row = mysqli_fetch_assoc($queryhasil)) {
                      
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['nama'];?></td>
                    <td><?php echo $row['kehamilan'];?></td>
                    <td><?php echo $row['glukosa']; ?></td>
                    <td><?php echo $row['tensi']; ?></td>
                    <td><?php echo $row['kulit']; ?></td>
                    <td><?php echo $row['insulin']; ?></td>
                    <td><?php echo $row['bmi']; ?></td>
                    <td><?php echo $row['silsilah']; ?></td>
                    <td><?php echo $row['usia']; ?></td>
                    <td>
                      <?php 
                        if($row['status'] == 0){
                            echo "<font color='green'> Tidak Diabetes </font>";
                        }
                        elseif($row['status'] == 1){
                            echo "<font color='red'> Diabetes </font>";
                        }
                      ?>
                    </td>
                  </tr>
                  <?php
                    }
                  ?>
              </tbody>
            </table>
          </div> 

        </div>
      </div>
    </div>
  </div>
</section><!-- /.content -->
</div>

<?php include 'template/footer.php'; ?>