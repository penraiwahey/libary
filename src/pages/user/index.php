<?php include_once('../php/authen.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php if($_SESSION['role'] == 'admin') { ?>
    <title>ผู้ใช้งาน</title>
  <?php } ?>
   
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
    $sql = "SELECT * FROM `user` ORDER BY id DESC";
    $result = $conn->query($sql);
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ผู้ใช้งาน</h1>
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
          <h3 class="card-title d-inline-block">รายการผู้ใช้งาน</h3>
          <!-- <a href="form-c.php" class="btn btn-info float-right ">Add Person Info  +</a href=""> -->
          <a href="add.php" class="btn btn-info float-right ">เพิ่ม  ผู้ใช้งาน +</a href="">
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
          <table id="dataTable" class="table table-bordered thead-light">
            <thead>
            <tr>
              <th class="text-center">ลำดับ</th>
              <th class="text-center">รหัส</th>
              <th class="text-center">ชื่อ</th>
              <!-- <th class="text-center">แผนก</th>
              <th class="text-center">ตำแหน่ง</th> -->
              <th class="text-center">บทบาท</th>
              <th class="text-center">จัดการ</th>
            </tr>
            </thead>
            <tbody>
            <?php 
              $num = 0;
              while($row = $result->fetch_assoc()) {
              $num++;

            ?>
              <tr>
                <td class="text-center" style="width: 40px;"><?php echo $num; ?></td>
                <td class="text-center" style="width: 150px;"><?php echo $row['emp_id']; ?></td>
                <td><?php echo $row['emp_name']; ?></td>
                <!-- <td style="width: 190px;"><?php //echo $row['department']; ?></td>
                <td style="width: 190px;"><?php //echo $row['position']; ?></td> -->
                <td class="text-center" style="width: 100px;">
                <?php if($row['role'] == 'ผู้ดูแล') { ?> 
                  <span class="badge badge-success"><?php echo $row['role']; ?></span>
                <?php } else if($row['role'] == 'ผู้อนุมัติ') { ?>
                  <span class="badge badge-warning"><?php echo $row['role']; ?></span>
                <?php } else { ?>
                  <span class="badge badge-primary"><?php echo $row['role']; ?></span>
                <?php } ?>
               
              
                </td>
              
                <td class="text-center" style="width: 220px;">
                  <a href="view.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success text-white" style="width: 68px;">
                  <i class="fas fa-glasses"></i> แสดง
                  </a> 
                  <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning text-white" style="width: 68px;">
                  <i class="fas fa-pencil-alt"></i> แก้ไข
                  </a> 

                  <?php if($row['dont_delete'] != 'Yes') { ?> 
                    <a href="#" onclick="deleteItem(<?php echo $row['id']; ?>);" class="btn btn-sm btn-danger" style="width: 68px;">
                    <i class="fas fa-trash"></i> ลบ
                  </a>
                  <?php } ?>

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

  function deleteItem (id) { 
    if( confirm('ต้องการลบข้อมูลนี้ใช่หรือไม่?') == true){
      window.location=`sql/delete.php?id=${id}`;
      // window.location='delete.php?id='+id;
    }
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
