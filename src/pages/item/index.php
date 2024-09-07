<?php include_once('../php/authen.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>หนังสือ</title>
 
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
    $sql = "SELECT * FROM `item` ORDER BY id DESC";
    $result = $conn->query($sql);
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>หนังสือ</h1>
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
          <h3 class="card-title d-inline-block">รายการหนังสือ</h3>
          <!-- <a href="form-c.php" class="btn btn-info float-right ">Add Person Info  +</a href=""> -->
         <a href="add.php" class="btn btn-info float-right ">เพิ่ม หนังสือ +</a href="">
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
          <table id="dataTable" class="table table-bordered thead-light">
            <thead>
            <tr>
              <th class="text-center">ลำดับ</th>
              <th class="text-center">ภาพ</th>
              <th class="text-center">รหัสหนังสือ</th>
              <th class="text-center">ชื่อหนังสือ</th>
              <th class="text-center">ราคา</th>
              <th class="text-center">จำนวน</th>
              <th class="text-center">ยืม</th>
              <!-- <th class="text-center">เบิก</th> -->
              <!-- <th class="text-center">จอง</th> -->
              <th class="text-center">คงเหลือ</th>
              <th class="text-center" style="width: 180px;">ปรับสต็อก</th>
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


                <td>
                <figure class="figure text-center d-block mt-2">
                  <input type="hidden" name="data_file" value="<?php echo $row['img']; ?>">
                  <img id="imgUpload" src="../../../assets/images/item/<?php echo $row['img']; ?>" class="figure-img img-fluid rounded" style="width: 100px;">
              </figure>
                </td>
                <td><?php echo $row['item_id']; ?></td>
                <td><?php echo $row['item_name']; ?></td>
                <td class="text-center" style="width: 50px;"><?php echo number_format($row['price']); ?></td>
                <td class="text-center" style="width: 50px;"><?php echo number_format($row['item_qty']); ?></td>
                <td class="text-center" style="width: 50px;"><?php echo number_format($row['lend_qty']); ?></td>
                <!-- <td class="text-center" style="width: 50px;"><?php //echo number_format($row['use_qty']); ?></td> -->
                <!-- <td class="text-center" style="width: 50px;"><?php echo number_format($row['pending_qty']); ?></td> -->
                <td class="text-center" style="width: 50px;"><?php echo number_format($row['total_qty']); ?></td>
                <td class="text-center" style="width: 180;">
                  <a href="grn.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info text-white" style="width: 80px;">
                    <i class="fas fa-plus"></i> รับเข้า
                  </a>           
                  <a href="gdn.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-secondary text-white" style="width: 80px;">
                    <i class="fas fa-minus"></i> จ่ายออก
                  </a>           
                </td>
                <td class="text-center" style="width: 220px;">
                  <a href="view.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success text-white" style="width: 68px;">
                  <i class="fas fa-glasses"></i> แสดง
                  </a> 
                  <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning text-white" style="width: 68px;">
                  <i class="fas fa-pencil-alt"></i> แก้ไข
                  </a>           
                  <a href="#" onclick="deleteItem(<?php echo $row['id']; ?>);" class="btn btn-sm btn-danger" style="width: 68px;">
                  <i class="fas fa-trash"></i> ลบ
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

  function deleteItem (id) { 
    if( confirm('ต้องการลบข้อมูลนี้ใช่หรือไม่?') == true){
      window.location=`sql/delete.php?id=${id}`;
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
