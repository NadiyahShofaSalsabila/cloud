<?php 
include 'template/header_admin.php'; 
include 'koneksidb.php';
?>

<div class="content-wrapper">
<section class="content-header">
  <h1>Data Pasien
    <small>Sistem Prediksi Diabetes</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Data Pasien</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Data Pasien</h3> 
          <div class="box-tools pull-left">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahpasien"><i class="fa fa-plus"></i> Tambah Pasien</a>
          </div>
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
                  <th>Opsi</th>
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
                    <td>
                    <a href="#" class="btn btn-primary btn-flat btn-xs" data-toggle="modal" data-target="#updatepasien<?php echo $no; ?>"><i class="fa fa-pencil"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deletepasien<?php echo $no; ?>"><i class="fa fa-trash"></i> Hapus</a>                      
                      
                      <!-- modal delete -->
                      <div class="example-modal">
                        <div id="deletepasien<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Konfirmasi Hapus Pasien</h3>
                              </div>
                              <div class="modal-body">
                                <h4 align="center" >Apakah anda yakin ingin menghapus data <?php echo $row['nama']; ?><strong><span class="grt"></span></strong> ?</h4>
                              </div>
                              <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                                <a href="function_pasien.php?act=deletepasien&id_pasien=<?php echo $row['id_pasien']; ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal delete -->

                      <!-- modal update pasien -->
                      <div class="example-modal">
                        <div id="updatepasien<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Edit Data User</h3>
                              </div>
                              <div class="modal-body">
                                <form action="function_pasien.php?act=updatepasien" method="post" role="form">
                                  <?php
                                  $id_pasien = $row['id_pasien'];
                                  $query = "SELECT * FROM tb_pasien WHERE id_pasien='$id_pasien'";
                                  $result = mysqli_query($koneksi, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                  <div class="form-group">
                                  <div class="row">
                                      <div class="col-sm-8"><input type="hidden" class="form-control" name="id_pasien" placeholder="ID Pasien" value="<?php echo $row['id_pasien']; ?>"></div>
                                    </div>
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Nama Pasien <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="nama" placeholder="Nama Pasien" value="<?php echo $row['nama']; ?>" require></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Jumlah Kehamilan <span class="text-red"></span></label>
                      <div class="col-sm-8"><input type="number" class="form-control" name="kehamilan" placeholder="Jumlah Kehamilan" min="0" value="<?php echo $row['kehamilan']; ?>"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Konsentrasi Glukosa <span class="text-red"></span></label>
                      <div class="col-sm-8"><input type="number" class="form-control" name="glukosa" placeholder="Konsentrasi Glukosa" min="0" value="<?php echo $row['glukosa']; ?>"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Tekanan Darah <span class="text-red"></span></label>
                      <div class="col-sm-8"><input type="number" class="form-control" name="tensi" placeholder="Tekanan Darah" min="0" value="<?php echo $row['tensi']; ?>"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Ketebalan Lipatan Kulit <span class="text-red"></span></label>
                      <div class="col-sm-8"><input type="number" class="form-control" name="kulit" placeholder="Ketebalan Kelipatan Kulit" min="0" value="<?php echo $row['kulit']; ?>"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Insulin <span class="text-red"></span></label>
                      <div class="col-sm-8"><input type="number" class="form-control" name="insulin" placeholder="Insulin" min="0" value="<?php echo $row['insulin']; ?>"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">BMI <span class="text-red"></span></label>
                      <div class="col-sm-8"><input type="number" class="form-control" name="bmi" placeholder="BMI" min="0" step=".00001" value="<?php echo $row['bmi']; ?>"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Fungsi Silsilah Diabetes <span class="text-red"></span></label>
                      <div class="col-sm-8"><input type="number" class="form-control" name="silsilah" placeholder="Fungsi Silsilah Diabetes" min="0" step=".00001" value="<?php echo $row['silsilah']; ?>"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Usia <span class="text-red"></span></label>
                      <div class="col-sm-8"><input type="number" class="form-control" name="usia" placeholder="Usia" min="0" value="<?php echo $row['usia']; ?>"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Status<span class="text-red">*</span></label>
                        <div class="col-sm-8"><select name="status" class="form-control select2" style="width: 100%;">
                          <option value="0" <?php echo ($row['status'] == 0) ? 'selected' : ''; ?>>Tidak Diabetes</option>
                          <option value="1" <?php echo ($row['status'] == 1) ? 'selected' : ''; ?>>Diabetes</option>
                        </select>
                        </div>
                      </div>
                    </div>
                                  <div class="modal-footer">
                                    <button id="noedit" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                                    <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                                  </div>
                                  <?php
                                  }
                                  ?>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal update pasien -->
                    </td>
                  </tr>
                  <?php
                    }
                  ?>
              </tbody>
            </table>
          </div> 
        </div>

        <!-- modal insert -->
        <div class="example-modal">
          <div id="tambahpasien" class="modal fade" role="dialog" style="display:none;">
            <div class="modal-dialog"> 
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">Tambah Pasien</h3>
                </div>
                <div class="modal-body">
                  <form action="function_pasien.php?act=tambahpasien" method="post" role="form">
                  <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Nama Pasien <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="nama" placeholder="Nama Pasien" value="" require></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Jumlah Kehamilan <span class="text-red"></span></label>
                      <div class="col-sm-8"><input type="number" class="form-control" name="kehamilan" placeholder="Jumlah Kehamilan" min="0"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Konsentrasi Glukosa <span class="text-red"></span></label>
                      <div class="col-sm-8"><input type="number" class="form-control" name="glukosa" placeholder="Konsentrasi Glukosa" min="0"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Tekanan Darah <span class="text-red"></span></label>
                      <div class="col-sm-8"><input type="number" class="form-control" name="tensi" placeholder="Tekanan Darah" min="0"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Ketebalan Lipatan Kulit <span class="text-red"></span></label>
                      <div class="col-sm-8"><input type="number" class="form-control" name="kulit" placeholder="Ketebalan Kelipatan Kulit" min="0"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Insulin <span class="text-red"></span></label>
                      <div class="col-sm-8"><input type="number" class="form-control" name="insulin" placeholder="Insulin" min="0"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">BMI <span class="text-red"></span></label>
                      <div class="col-sm-8"><input type="number" class="form-control" name="bmi" placeholder="BMI" min="0" step=".00001"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Fungsi Silsilah Diabetes <span class="text-red"></span></label>
                      <div class="col-sm-8"><input type="number" class="form-control" name="silsilah" placeholder="Fungsi Silsilah Diabetes" min="0" step=".00001"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Usia <span class="text-red"></span></label>
                      <div class="col-sm-8"><input type="number" class="form-control" name="usia" placeholder="Usia" min="0"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Status<span class="text-red">*</span></label>
                        <div class="col-sm-8"><select name="status" class="form-control select2" style="width: 100%;">
                          <option value="0">Tidak Diabetes</option>
                          <option value="1">Diabetes</option>
                        </select>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                      <input type="submit" name="submit" class="btn btn-primary" value="Tambah">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div><!-- modal insert close -->
      </div>
    </div>
  </div>
</section><!-- /.content -->
</div>

<?php include 'template/footer.php'; ?>