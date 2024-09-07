<?php include_once('../php/authen.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>เพิ่ม - ผู้ใช้งาน</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- style CSS-->
    <link rel="stylesheet" href="../../dist/css/style.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.min.css">
  <!-- bootstrap-toggle -->
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar & Main Sidebar Container -->
  <?php include_once('../includes/sidebar.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>เพิ่ม - ผู้ใช้งาน</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../user">ผู้ใช้งาน</a></li>
              <li class="breadcrumb-item active">เพิ่ม - ผู้ใช้งาน</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card card-secondary">
        <div class="card-header">
        <h3 class="card-title">ข้อมูลทั่วไป</h3>
        </div>
        <form action="sql/insert.php" method="post" enctype="multipart/form-data">
          <div class="card-body">

            <div class="form-group row">
              <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-2">
                <label for="emp_id">รหัส</label>
                <input type="text" class="form-control" id="emp_id" name="emp_id" placeholder="รหัส" required>
              </div>
              <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-2">
                <label for="emp_name">ชื่อ</label>
                <input type="text" class="form-control" id="emp_name" name="emp_name" placeholder="ชื่อ" required>
              </div>      
              <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-2">
                <!-- <label for="department">แผนก</label>
                <input type="text" class="form-control" id="department" name="department" placeholder="แผนก" required>
              </div> 
              <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-2">
                <label for="position">ตำแหน่ง</label>
                <input type="text" class="form-control" id="position" name="position" placeholder="ตำแหน่ง" required>
              </div>             -->
            </div>

          </div>
         
        <div class="card card-secondary">
        <div class="card-header">
        <h3 class="card-title">การเข้าใช้งาน</h3>
        </div>
       
          <div class="card-body">

            <div class="form-group row">
              <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-2">
                <label for="username">ผู้ใช้งาน</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="ผู้ใช้งาน" required>
              </div>
              <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-2">
                <label for="role">บทบาท</label>
                <select id="role" name='selectBox' class="form-control">
                  <option value='ผู้ใช้งาน'>ผู้ใช้งาน</option>
                  <!-- <option value='ผู้อนุมัติ'>ผู้อนุมัติ</option> -->
                  <option value='ผู้ดูแล'>ผู้ดูแล</option>
                </select>
              </div>   
            </div>

            <div class="form-group row">
              <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-2">
                <label for="password">รหัสผ่าน</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน" required>
              </div>
              <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-2">
                <label for="password">ยืนยันรหัสผ่าน</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="ยืนยันรหัสผ่าน" required>
              </div>
            </div>

          <div class="card-footer">
            <center>
              <button type="submit" name="submit" class="btn btn-success">บันทึก</button>
              <a href="../user" class="btn btn-danger" type="button">ยกเลิก</a></button>
            </center>
          </div>
        </form>
      </div>    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- footer -->
  <?php include_once('../includes/footer.php') ?>
  
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- DataTables -->
<script src="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- CK Editor -->
<script src="../../plugins/ckeditor/ckeditor.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/select2.full.min.js"></script>
<!-- bootstrap-toggle -->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

</body>
</html>
