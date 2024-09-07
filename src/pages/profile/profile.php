<?php 
  include_once('../php/authen.php');
        
  $sql = "SELECT * FROM `user` WHERE `id` = '".$_SESSION['id']."' ";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  //$arr_tag = explode(',', $row['tag']);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>โปรไฟล์</title>
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
            <h1>โปรไฟล์</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="../user">Manage User Info</a></li> -->
              <li class="breadcrumb-item active">โปรไฟล์</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

   
    <!-- Main content -->
    <section class="content">
      <div class="card card-secondary">
        <div class="card-header">
        <h3 class="card-title">แก้ไขโปรไฟล์</h3>
        </div>
        <form action="sql/profile-update.php" method="post" enctype="multipart/form-data">
          <div class="card-body">

            <div class="form-group row">
              <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-2">
                <label for="emp_id">รหัส</label>
                <input type="text" class="form-control" id="emp_id" name="emp_id" placeholder="รหัส" value="<?php echo $row['emp_id']; ?>" required>
              </div>
              <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-2">
                <label for="emp_name">ชื่อ</label>
                <input type="text" class="form-control" id="emp_name" name="emp_name" placeholder="ชื่อ" value="<?php echo $row['emp_name']; ?>" required>
              </div>
              <!-- <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-2">
                <label for="department">แผนก</label>
                <textarea  type="text" class="form-control" id="department" name="department" rows="1" placeholder="แผนก"><?php echo $row['department']; ?></textarea>
              </div>     
              <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-2">
                <label for="position">ตำแหน่ง</label>
                <textarea  type="text" class="form-control" id="position" name="position" rows="1" placeholder="ตำแหน่ง"><?php echo $row['position']; ?></textarea>
              </div>                   -->
            </div>

          </div>
                 
          <div class="card-footer n">
          <center>
            <button type="submit" name="submit" class="btn btn-success">บันทึก</button>
            <a href="profile.php" class="btn btn-danger" type="button">ยกเลิก</a></button>
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
