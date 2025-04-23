<?php 
include 'template/header_admin.php'; 
include 'koneksidb.php';
?>

<div class="content-wrapper">
<section class="content-header">
  <h1>Data User
    <small>Sistem Prediksi Diabetes</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Data User</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Data User</h3> 
          <div class="box-tools pull-left">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahuser"><i class="fa fa-plus"></i> Tambah User</a>
          </div>
        </div>
        <div class="box-body">

          <div class="table-responsive22">
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nomor</th>  
                  <th>Username</th>
                  <th>Password</th>
                  <th>User Role</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $no = 1;
                    $queryview = mysqli_query($koneksi, "SELECT * FROM tb_user");
                    while ($row = mysqli_fetch_assoc($queryview)) {
                      
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['password'];?></td>
                    <td><?php echo $row['user_role']; ?></td>
                    <td>
                      <a href="#" class="btn btn-primary btn-flat btn-xs" data-toggle="modal" data-target="#updateuser<?php echo $no; ?>"><i class="fa fa-pencil"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deleteuser<?php echo $no; ?>"><i class="fa fa-trash"></i> Hapus</a>                      
                      
                      <!-- modal Hapus -->
                      <div class="example-modal">
                        <div id="deleteuser<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Konfirmasi Hapus Data User</h3>
                              </div>
                              <div class="modal-body">
                                <h4 align="center" >Apakah anda yakin ingin menghapus user <?php echo $row['username'];?><strong><span class="grt"></span></strong> ?</h4>
                              </div>
                              <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                                <a href="function_user.php?act=deleteuser&id_user=<?php echo $row['id_user']; ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal Hapus -->

                      <!-- modal update user -->
                      <div class="example-modal">
                        <div id="updateuser<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Edit Data User</h3>
                              </div>
                              <div class="modal-body">
                                <form action="function_user.php?act=updateuser" method="post" role="form">
                                  <?php
                                  $id_user = $row['id_user'];
                                  $query = "SELECT * FROM tb_user WHERE id_user='$id_user'";
                                  $result = mysqli_query($koneksi, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                  <div class="form-group">
                                    <div class="row">
                                      <div class="col-sm-8"><input type="hidden" class="form-control" name="id_user" placeholder="ID User" value="<?php echo $row['id_user']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Username <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $row['username']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Password <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="password" class="form-control" name="password" placeholder="Password" id="myPassword" value="<?php echo $row['password']; ?>">
                                        <input type="checkbox" onclick="myFunction()"> Lihat Password
                                          <script>
                                          function myFunction() {
                                            var x = document.getElementById("myPassword");
                                            if (x.type === "password") {
                                              x.type = "text";
                                            } else {
                                              x.type = "password";
                                            }
                                          }
                                          </script>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">User Role <span class="text-red">*</span></label>
                                        <div class="col-sm-8"><select name="role" class="form-control select2" value="" style="width: 100%;">
                                          <option value="admin" <?php echo ($row['user_role'] == "admin") ? 'selected' : ''; ?>>Administrator</option>
                                          <option value="user" <?php echo ($row['user_role'] == "user") ? 'selected' : ''; ?>>User</option>
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
                      </div><!-- modal update user -->
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
          <div id="tambahuser" class="modal fade" role="dialog" style="display:none;">
            <div class="modal-dialog"> 
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">Registrasi User Baru</h3>
                </div>
                <div class="modal-body">
                  <form action="function_user.php?act=tambahuser" method="post" role="form">
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Username <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="username" placeholder="Username" value=""></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Password <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="password" class="form-control" name="password" placeholder="Password" id="pswd" value="">
                      <input type="checkbox" onclick="myFunction()"> Lihat Password
                      <script>
                      function myFunction() {
                        var x = document.getElementById("pswd");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                      }
                      </script>
                      </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">User Role <span class="text-red">*</span></label>
                        <div class="col-sm-8"><select name="role" class="form-control select2" style="width: 100%;">
                          <option value="admin">Administrator</option>
                          <option value="user">User</option>
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