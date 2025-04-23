<?php include 'template/header_admin.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Sistem Prediksi Diabetes</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="callout callout-info">
          <h4>Selamat Datang! Anda Login Sebagai <?php echo $_SESSION['username']?>!</h4>
            <p align="justify">Sistem Prediksi Diabetes adalah sebuah sistem yang digunakan
              untuk menentukan apakah seseorang termasuk penderita diabetes atau tidak.
            </p>
            <p align="justify">Sistem Prediksi Diabetes ini menggunakan metode K-Nearest Neighbors sebagai metode prediksinya.
            </p>
          </div>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include 'template/footer.php'; ?>