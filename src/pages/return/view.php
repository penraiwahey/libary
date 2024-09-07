<?php 
  include_once('../php/authen.php');
  if(!isset($_GET['id'])){
    header('Location:index.php');
  }
  $sql = "SELECT * FROM `view_borrowreturn_hdr` WHERE `id` = '".$_GET['id']."' ";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  $sql_dtl = "SELECT * FROM `view_borrowreturn_dtl` WHERE `hdr` = '".$_GET['id']."' AND `borrow` = 'true' ORDER BY id DESC";
  $result_dtl = $conn->query($sql_dtl);

  $sql_cdtl = "SELECT COUNT(*) AS c FROM `view_borrowreturn_dtl` WHERE `hdr` = '".$_GET['id']."' AND `borrow` = 'true' ORDER BY id DESC";
  $result_cdtl = $conn->query($sql_cdtl);
  $row_cdtl = $result_cdtl->fetch_assoc();

  $sql_c = "SELECT DATEDIFF(CURDATE(), exp_date) AS Days FROM view_borrowreturn_hdr WHERE id = '".$_GET['id']."' ";
  $result_c = $conn->query($sql_c);
  $row_c = $result_c->fetch_assoc();

  $sql_fine = "SELECT `fine` AS a  FROM `fine` WHERE `id` = '2' ";
  $result_fine = $conn->query($sql_fine);
  $row_fine = $result_fine->fetch_assoc();
 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>แสดง - ขอคืนหนังสือ</title>

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
            <h1>แสดง - ขอคืนหนังสือ</h1>
        
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="../dashboard">Home</a></li> -->
             
              <li class="breadcrumb-item"><a href="../return">ขอคืนหนังสือ</a></li>
              <li class="breadcrumb-item active">แสดง - ขอคืนหนังสือ</li>
           
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">ขอคืนหนังสือ</h3>
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
                <label for="emp_name">ขอยืมโดย</label>
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
          
          $dateEXP = $row['exp_date'];
          $new_startDateEXP = date("Y-m-d", strtotime($dateEXP));
          $dateArrEXP = explode('-', $new_startDateEXP);
          $dateThaiEXP = $dateArrEXP[2] . '/' . $dateArrEXP[1] . '/' . ($dateArrEXP['0'] + 543);
          $timeEXP = date("H:i:s", strtotime($row['exp_date']));

          $d = $row_c['Days'];
          $f = $row_fine['a'];
          $t = $d * $f;
          ?>

          <div class="row">
              <div class="col-12 col-sm-4 col-md-2 col-lg-2 p-2">
                <label for="department">วันที่ขอยืม</label>
              </div>
              <div class="col-12 col-sm-8 col-md-10 col-lg-10 p-2">
                <?php echo $dateThai.' '.$time; ?>
              </div>
          </div>  
          
          <div class="row"> 
              <div class="col-12 col-sm-4 col-md-2 col-lg-2 p-2">
                <label for="department">วันที่ครบกำหนดคืน</label>
              </div>
              <div class="col-12 col-sm-8 col-md-10 col-lg-10 p-2">
                <?php echo $dateThaiEXP.' '.$timeEXP; ?>
              </div>
          </div>  

          <div class="row">
              <div class="col-12 col-sm-4 col-md-2 col-lg-2 p-2">
                <label for="department">ค่าปรับ</label>
              </div>
              <div class="col-12 col-sm-8 col-md-10 col-lg-10 p-2" style="color: red;">
                <?php if($t > 1) { echo $t; } else { echo 0; } ?>
                <?php ?>
              </div>
          </div>  
         
          <div class="card-header" style="background-color: #6c757d61;">
          <h3 class="card-title">รายการหนังสือ</h3>
        </div><br>
     
        
          <table id="dataTable" class="table table-bordered thead-light"> 
            <thead>
            <tr>
              <th class="text-center">ลำดับ</th>
              <th class="text-center">ภาพ</th>
              <th class="text-center">รหัสหนังสือ</th>
              <th class="text-center">ชื่อหนังสือ</th>
              <th class="text-center">จำนวน</th>
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
                <td class="text-center" style="width: 120px;">
                <?php if($row_dtl['remain'] > 0) {?>
                <input type="number" class="form-control" name="qty" id="qty<?php echo $row_dtl['id']; ?>" placeholder="จำนวน" value="<?php echo $row_dtl['remain']; ?>" required min="1" max="<?php echo $row_dtl['remain']; ?>">
                  <a href="#" onclick="UpdateItemNum(<?php echo $row_dtl['id']; ?>, document.getElementById('qty<?php echo $row_dtl['id']; ?>').value,<?php echo $_GET['id']; ?>)" class="btn btn-sm btn-success" style="width: 100px;">
                  รับคืน 
                  </a>
                  <?php } else { ?>
                    <?php echo $row_dtl['qty']; ?>
                  <?php } ?>
                </td>
                <!-- <td class="text-center" style="width: 120px;">
                 <?php //if($row_dtl['borrow'] =='true') { echo 'ยืม'; } else { echo 'ยืม'; }?> 
                </td> -->
              </tr>
            <?php } ?>
            </tbody>
          </table>
      

            <input type="hidden" name="ID" value="<?php echo $_GET['id']; ?>">
            <!-- <input type="hidden" class="form-control" name="fine" value="<?php //if($t > 1) { echo $t; } else { echo 0; } ?>"> -->
            </div>
          <div class="card-footer n">
          <center>
            <a href="#" class="btn btn-success" onclick="ReturnItem(<?php echo $row['id']; ?>,<?php if($t > 1) { echo $t; } else { echo 0; } ?>);">รับคืนทั้งหมด</a>
            <a href="../return" class="btn btn-primary" type="button">ย้อนกลับ</a></button>
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
   function UpdateItemNum(id,qty,doc) { 
      window.location=`sql/update_return.php?id=${id}&qty=${qty}&doc=${doc}`;
  };

  function ReturnItem(id,fd) { 
      window.location=`sql/return.php?id=${id}&fd=${fd}`;
  };
</script>

</body>
</html>
