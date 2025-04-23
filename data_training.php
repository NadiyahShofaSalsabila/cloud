<?php 
include 'template/header_admin.php'; 
include 'koneksidb.php';
?>

<div class="content-wrapper">
<section class="content-header">
  <h1>Data Training
    <small>Sistem Prediksi Diabetes</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Data Training</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Data Training diambil dari Data Pasien</h3> 
        </div>
        <div class="box-body">

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
                    $queryview = mysqli_query($koneksi, "SELECT * from tb_pasien");
                    while ($row = mysqli_fetch_assoc($queryview)) {
                      
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
                    
                    <?php
                      $status = $row['status'];

                      if ($status == 1) {
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
        </div>
      </div>
    </div>
  </div>
</section><!-- /.content -->
</div>

<?php include 'template/footer.php'; ?>