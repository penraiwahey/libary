<?php include_once('../php/authen.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ประวัติการยืม-คืน</title>
 
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

<!--  -->


<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
	<link rel="stylesheet" type="text/css" href="/media/css/site-examples.css?_=aadaa7a732793b5fe2d64919b0c6763c1">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
	<style type="text/css" class="init">
	
	</style>
	<script type="text/javascript" src="/media/js/site.js?_=6093ce51057f043716aadf9628fff069"></script>
	<script type="text/javascript" src="/media/js/dynamic.php?comments-page=extensions%2Fbuttons%2Fexamples%2Finitialisation%2Fexport.html" async></script>
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
	<script type="text/javascript" language="javascript" src="../../../../examples/resources/demo.js"></script>


<!--  -->


  	<script type="text/javascript" class="init">
$(document).ready(function() {
	$('#dataTable2').DataTable( {
		dom: 'Bfrtip',
		buttons: [
			'copy', 'excel', 'print',
		]
	} );
} );
	</script>


</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar & Main Sidebar Container -->
  <?php include_once('../includes/sidebar.php') ?>

  <?php 

if($_SESSION['role'] == 'ผู้อนุมัติ' || $_SESSION['role'] == 'ผู้ดูแล') { 
    $sql = "SELECT * FROM `view_borrowreturn_hdr`  ORDER BY `id` DESC";
    $result = $conn->query($sql);
} else {
  $sql = "SELECT * FROM `view_borrowreturn_hdr` WHERE `user` =  '".$_SESSION['id']."' ORDER BY `id` DESC";
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
            <h1>ประวัติการยืม-คืน</h1>
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
          <h3 class="card-title d-inline-block">รายการประวัติการยืม-คืน</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
          <table id="dataTable2" class="table table-bordered thead-light">
            <thead>
            <tr>
              <th class="text-center">ลำดับ</th>
              <th class="text-center">เลขที่เอกสาร</th>
              <th class="text-center">ขอยืมโดย</th>
              <th class="text-center">วันที่ขอยืม</th>
              <!-- <th class="text-center">อนุมัติ/ปฏิเสธโดย</th>
              <th class="text-center">วันที่อนุมัติ/ปฏิเสธ</th> -->
              <th class="text-center">รับคืนโดย</th>
              <th class="text-center">วันที่รับคืน</th>
              <th class="text-center">สถานะ</th>
              <th class="text-center">แสดง</th>
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

if(isset($row['action_date'])) {
  $date_ac = $row['action_date'];
  $new_startDate_ac = date("Y-m-d", strtotime($date_ac));
  $dateArr_ac = explode('-', $new_startDate_ac);
  $dateThai_ac = $dateArr_ac[2] . '/' . $dateArr_ac[1] . '/' . ($dateArr_ac['0'] + 543);
  $time_ac = date("H:i:s", strtotime($row['action_date']));
}

if(isset($row['returned_date'])) {
  $date_rt = $row['returned_date'];
  $new_startDate_rt = date("Y-m-d", strtotime($date_rt));
  $dateArr_rt = explode('-', $new_startDate_rt);
  $dateThai_rt = $dateArr_rt[2] . '/' . $dateArr_rt[1] . '/' . ($dateArr_rt['0'] + 543);
  $time_rt = date("H:i:s", strtotime($row['returned_date']));
}
?>
                <td class="text-center" style="width: 40px;"><?php echo $num; ?></td>
                <td class="text-center"><?php echo $row['docno']; ?></td>
                <td class="text-center"><?php echo $row['by_name']; ?></td>
                <td class="text-center"><?php echo $dateThai.' '.$time; ?></td>
                <!-- <td class="text-center"><?php //echo $row['action_by_name']; ?></td>
                <td class="text-center"><?php //if(isset($row['action_date'])) { echo $dateThai_ac.' '.$time_ac; }?></td> -->
                <td class="text-center"><?php echo $row['return_name']; ?></td>
                <td class="text-center"><?php if(isset($row['returned_date'])) { echo $dateThai_rt.' '.$time_rt; }?></td>
                <td class="text-center"><?php echo $row['status']; ?></td>
                <td class="text-center" style="width: 150px;">
                  <a href="view.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success text-white" style="width: 100px;">
                    <i class="fas fa-glasses"></i> แสดงข้อมูล
                  </a>   
                </td>
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

		$('#datatable').dataTable();

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

</body>
</html>
