<?php 
  include_once('../php/authen.php');
  if(!isset($_GET['id'])){
    header('Location:index.php');
  }
  $sql = "SELECT * FROM `view_borrowreturn_hdr` WHERE `id` = '".$_GET['id']."' ";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  $sql_dtl = "SELECT * FROM `view_borrowreturn_dtl` WHERE `hdr` = '".$_GET['id']."' ORDER BY id DESC";
  $result_dtl = $conn->query($sql_dtl);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>แสดง - อนุมัติการขอเบิก</title>

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
            <h1>แสดง - อนุมัติการขอเบิก</h1>
        
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="../dashboard">Home</a></li> -->
             
              <li class="breadcrumb-item"><a href="../borrow-approve">อนุมัติการขอเบิก</a></li>
              <li class="breadcrumb-item active">แสดง - อนุมัติการขอเบิก</li>
           
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">อนุมัติการขอเบิก</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="" method="post">
          <div class="card-body">

          <div class="row">
              <div class="col-12 col-sm-4 col-md-2 col-lg-2 p-2">
                <label for="emp_id">เลขที่เอกสาร</label>
              </div>
              <div class="col-12 col-sm-8 col-md-10 col-lg-10 p-2">
                <?php echo $row['docno']; ?>
              </div>
          </div>  

          <div class="row">
              <div class="col-12 col-sm-4 col-md-2 col-lg-2 p-2">
                <label for="emp_name">ขอเบิกโดย</label>
              </div>
              <div class="col-12 col-sm-8 col-md-10 col-lg-10 p-2">
                <?php echo $row['by_name']; ?>
              </div>
          </div>   

          <?php 
          $date = $row['date'];
          $new_startDate = date("Y-m-d", strtotime($date));
          $dateArr = explode('-', $new_startDate);
          $dateThai = $dateArr[2] . '/' . $dateArr[1] . '/' . ($dateArr['0'] + 543);
          $time = date("H:i:s", strtotime($row['date']));
          ?>
          <div class="row">
              <div class="col-12 col-sm-4 col-md-2 col-lg-2 p-2">
                <label for="department">วันที่ขอเบิก</label>
              </div>
              <div class="col-12 col-sm-8 col-md-10 col-lg-10 p-2">
                <?php echo $dateThai.' '.$time; ?>
              </div>
          </div>   
        
          <div class="card-header" style="background-color: #6c757d61;">
          <h3 class="card-title">รายการอุปกรณ์</h3>
        </div><br>
     
        
          <table id="dataTable" class="table table-bordered thead-light"> 
            <thead>
            <tr>
              <th class="text-center">ลำดับ</th>
              <th class="text-center">ภาพ</th>
              <th class="text-center">รหัสสินค้า</th>
              <th class="text-center">ชื่อสินค้า</th>
              <!-- <th class="text-center">ประเภท </th> -->
            </tr>
            </thead>
            <tbody>
            <?php 
              $num = 0;
              while($row_dtl = $result_dtl->fetch_assoc()) {
                $num++;

            ?>
              <tr>
                <td class="text-center" style="width: 40px;"><?php echo $num; ?></td>


                <td>
                <figure class="figure text-center d-block mt-2">
                  <input type="hidden" name="data_file" value="<?php echo $row_dtl['img']; ?>">
                  <img id="imgUpload" src="../../../assets/images/item/<?php echo $row_dtl['img']; ?>" class="figure-img img-fluid rounded" style="width: 100px;">
              </figure>
                </td>
                <td><?php echo $row_dtl['item_id']; ?></td>
                <td><?php echo $row_dtl['item_name']; ?></td>
                <!-- <td class="text-center" style="width: 120px;">
                 <?php //if($row_dtl['borrow'] =='true') { echo 'ยืม'; } else { echo 'เบิก'; }?> 
                </td> -->
              </tr>
            <?php } ?>
            </tbody>
          </table>
      

            <input type="hidden" name="ID" value="<?php echo $_GET['id']; ?>">

            </div>
          <div class="card-footer n">
          <center>
            <a href="#" class="btn btn-success" onclick="AppItem(<?php echo $row['id']; ?>);">อนุมัติ</a>
            <a href="#" class="btn btn-danger" onclick="RejItem(<?php echo $row['id']; ?>);">ไม่อนุมัติ</a>
            <a href="../borrow-approve" class="btn btn-primary" type="button">ย้อนกลับ</a></button>
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

<script>
    function AppItem(id) { 
      window.location=`sql/approve.php?id=${id}`;
  };

  function RejItem(id) { 
      window.location=`sql/reject.php?id=${id}`;
  };
</script>

</body>
</html>
