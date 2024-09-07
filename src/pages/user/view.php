<?php 
  include_once('../php/authen.php');
  if(!isset($_GET['id'])){
    header('Location:index.php');
  }
  $sql = "SELECT * FROM `user` WHERE `id` = '".$_GET['id']."' ";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  $sqlC = "SELECT * FROM `item_borrowreturn` WHERE `user` = '".$_GET['id']."' ";
  // $sqlC = "SELECT * FROM training_course WHERE ID IN(SELECT Couse FROM course WHERE Emp = '".$_GET['id']."')";
  $resultC = $conn->query($sqlC);
  //$rowC = $resultC->fetch_assoc();
  //$arr_tag = explode(',', $row['tag']);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php if($_SESSION['role'] == 'ผู้ดูแล') { ?>
    <title>แสดง - ผู้ใช้งาน</title>
  <?php } ?>

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
          <?php if($_SESSION['role'] == 'ผู้ดูแล') { ?>
            <h1>แสดง - ผู้ใช้งาน</h1>
          <?php } ?>
        
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="../dashboard">Home</a></li> -->
              <?php if($_SESSION['role'] == 'ผู้ดูแล') { ?>
              <li class="breadcrumb-item"><a href="../user">ผู้ใช้งาน</a></li>
              <li class="breadcrumb-item active">แสดง - ผู้ใช้งาน</li>
              <?php } ?>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card card-secondary">
        <div class="card-header">
        <?php if($_SESSION['role'] == 'ผู้ดูแล') { ?>
          <h3 class="card-title">ผู้ใช้งาน</h3>
        <?php } ?>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="" method="post">
          <div class="card-body">

          <div class="row">
              <div class="col-12 col-sm-4 col-md-2 col-lg-2 p-2">
                <label for="emp_id">รหัส</label>
              </div>
              <div class="col-12 col-sm-8 col-md-10 col-lg-10 p-2">
                <?php echo $row['emp_id']; ?>
              </div>
          </div>  

          <div class="row">
              <div class="col-12 col-sm-4 col-md-2 col-lg-2 p-2">
                <label for="emp_name">ชื่อ</label>
              </div>
              <div class="col-12 col-sm-8 col-md-10 col-lg-10 p-2">
                <?php echo $row['emp_name']; ?>
              </div>
          </div>   
<!-- 
          <div class="row">
              <div class="col-12 col-sm-4 col-md-2 col-lg-2 p-2">
                <label for="department">แผนก</label>
              </div>
              <div class="col-12 col-sm-8 col-md-10 col-lg-10 p-2">
                <?php //echo $row['department']; ?>
              </div>
          </div>   

          <div class="row">
              <div class="col-12 col-sm-4 col-md-2 col-lg-2 p-2">
                <label for="position">ตำแหน่ง</label>
              </div>
              <div class="col-12 col-sm-8 col-md-10 col-lg-10 p-2">
                <?php //echo $row['position']; ?>
              </div>
          </div>   -->

          <div class="row">
              <div class="col-12 col-sm-4 col-md-2 col-lg-2 p-2">
                <label for="role">บทบาท</label>
              </div>
              <div class="col-12 col-sm-8 col-md-10 col-lg-10 p-2">
                <?php if($row['role']=="ผู้ดูแล"){echo "ผู้ดูแล";}?>
                <?php if($row['role']=="ผู้ใช้งาน"){echo "ผู้ใช้งาน";}?>
                <?php if($row['role']=="ผู้อนุมัติ"){echo "ผู้อนุมัติ";}?>
              </div>
          </div>  

          </div>

            <input type="hidden" name="ID" value="<?php echo $_GET['id']; ?>">

            </div>
          <div class="card-footer n">
            <!-- <button type="submit" name="submit" class="btn btn-success">บันทึก</button> -->
            <center>
            <a href="../user" class="btn btn-primary" type="button">ตกลง</a></button>
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
