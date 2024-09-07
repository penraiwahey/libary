<?php include_once('../php/authen.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ขอคืนหนังสือ</title>
 
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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

  <?php 

$sql2 = "SELECT count(`id`) AS `sum` FROM `view_borrowreturn_hdr` WHERE STATUS = 'ยืม'";
$result2 = $conn->query($sql2);
$row2 = $result2 ->fetch_assoc();

if($_SESSION['role'] == 'ผู้อนุมัติ' || $_SESSION['role'] == 'ผู้ดูแล') { 
    $sql = "SELECT * FROM `view_borrowreturn_hdr` WHERE `STATUS` = 'ยืม' AND `id` IN (SELECT `hdr` FROM `borrowreturn_dtl` WHERE `borrow` = 'true')  ORDER BY `id` ASC";
    $result = $conn->query($sql);
} else {
  $sql = "SELECT * FROM `view_borrowreturn_hdr` WHERE `STATUS` = 'ยืม' AND `user` =  '".$_SESSION['id']."' AND `id` IN (SELECT `hdr` FROM `borrowreturn_dtl` WHERE `borrow` = 'true') ORDER BY `id` ASC";
  $result = $conn->query($sql);
}
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ขอคืนหนังสือ</h1>
         </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title d-inline-block">รายการขอคืนหนังสือ</h3>
         <a href="" class="btn btn-info float-right btn-lg disabled">รอคืน <span class="badge badge-warning"> <?php echo $row2['sum']; ?> เอกสาร </span> </a>
        
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
          <table id="dataTable" class="table table-bordered thead-light">
            <thead>
            <tr>
              <th class="text-center">ลำดับ</th>
              <th class="text-center">เลขที่เอกสาร</th>
              <th class="text-center">ขอยืมโดย</th>
              <th class="text-center">วันที่ขอยืม</th>
              <th class="text-center">วันที่ครบกำหนดคืน</th>
              <?php if($_SESSION['role'] == 'ผู้อนุมัติ' || $_SESSION['role'] == 'ผู้ดูแล') { ?>
              <th class="text-center">จัดการ</th>
              <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php 
              $num = 0;
              while($row = $result->fetch_assoc()) {
                $num++;

            ?>
              <tr>
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
?>
                <td class="text-center" style="width: 40px;"><?php echo $num; ?></td>
                <td class="text-center"><?php echo $row['docno']; ?></td>
                <td class="text-center"><?php echo $row['by_name']; ?></td>
                <td class="text-center"><?php echo $dateThai.' '.$time; ?></td>
                <td class="text-center"><?php echo $dateThaiEXP.' '.$timeEXP; ?></td>
                <?php if($_SESSION['role'] == 'ผู้อนุมัติ' || $_SESSION['role'] == 'ผู้ดูแล') { ?>
                <td class="text-center" style="width: 150px;">
                  <a href="view.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success text-white" style="width: 100px;">
                    <i class="fas fa-glasses"></i> แสดงข้อมูล
                  </a>   
                </td>
                <?php } ?>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

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
<!-- bootstrap-toggle -->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
  $(function () {
    $('#dataTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });

  function AddItem(id) { 
    //if( confirm('ต้องการลบข้อมูลนี้ใช่หรือไม่?') == true){
      window.location=`sql/insert1.php?id=${id}`;
    //}
  };
  $.extend(true, $.fn.dataTable.defaults, {
            "language": {
                    "sProcessing": "กำลังดำเนินการ...",
                    "sLengthMenu": "แสดง  _MENU_ แถว",
                    "sZeroRecords": "ไม่พบข้อมูล",
                    "sInfo": "แสดง  _START_  ถึง _END_  จาก _TOTAL_  แถว",
                    "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                    "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                    "sInfoPostFix": "",
                    "sSearch": "ค้นหา:",
                    "sUrl": "",
                    "oPaginate": {
                                    "sFirst": "เริ่มต้น",
                                    "sPrevious": "ก่อนหน้า",
                                    "sNext": "ถัดไป",
                                    "sLast": "สุดท้าย"
                    }
            }
        });

		$('#datatable1').dataTable();

</script>

</body>
</html>
