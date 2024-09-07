<?php
  include_once('../php/authen.php'); 

  $sql1 = "SELECT count(id) as id FROM user";
  $result1 = $conn->query($sql1);
  $row1 = $result1 ->fetch_assoc();

  $sql2 = "SELECT count(id) as id FROM item";
  $result2 = $conn->query($sql2);
  $row2 = $result2 ->fetch_assoc();

  $sql3 = "SELECT count(id) as id FROM view_borrowreturn_dtl WHERE borrow = 'true'";
  $result3 = $conn->query($sql3);
  $row3 = $result3 ->fetch_assoc();

  $sql4 = "SELECT SUM(fine) as id FROM borrowreturn_hdr";
  $result4 = $conn->query($sql4);
  $row4 = $result4 ->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>แดชบอร์ด</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.min.css">

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
            <h1>แดชบอร์ด</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<section class="content">    
    <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">ผู้ใช้งาน</span>
                <span class="info-box-number"><?php echo $row1['id']; ?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: <?php echo $row1['id']; ?>%"></div>
                </div>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="fas fa-toolbox"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">หนังสือ</span>
                <span class="info-box-number"><?php echo $row2['id']; ?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: <?php echo $row2['id']; ?>%"></div>
                </div>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
              <span class="info-box-icon"><i class="fas fa-undo-alt" style="color: white;"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" style="color: white;">ยืม-คืน</span>
                <span class="info-box-number" style="color: white;"><?php echo $row3['id']; ?></span>

                <div class="progress">
                  <div class="progress-bar" style="background-color: white; width: <?php echo $row3['id']; ?>%"></div>
                </div>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger">
              <span class="info-box-icon"><i class="fas fa-share-square"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">ค่าปรับทั้งหมด</span>
                <span class="info-box-number"><?php echo $row4['id']; ?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: <?php echo $row4['id']; ?>%"></div>
                </div>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">   

            <div class="col-lg-12 col-12">
                <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="fa fa-bar-chart-o"></i>
                   ประวัติการยืม-คืน
                    </h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove">
                        <i class="fa fa-times"></i>
                    </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="bar-chart-page" style="height: 300px; padding: 0px; position: relative;">
                    </div>
                </div>
                <!-- /.card-body-->
                </div>
            </div>
            </div>



<div class="row">

            <div class="col-lg-6 col-6">
                <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="fa fa-bar-chart-o"></i>
                      ผู้ใช้งานที่มีการยืม-คืน
                    </h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove">
                        <i class="fa fa-times"></i>
                    </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="bar-chart-os" style="height: 300px; padding: 0px; position: relative;"></div>
                </div>
                <!-- /.card-body-->
                </div>
            </div>
            <div class="col-lg-6 col-6">
                <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="fa fa-bar-chart-o"></i>
                    สถานะการยืม-คืน (ต่อเล่ม)
                    </h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove">
                        <i class="fa fa-times"></i>
                    </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="bar-chart-browser" style="height: 300px; padding: 0px; position: relative;"></div>
                </div>
                <!-- /.card-body-->
                </div>
            </div>
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
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- FLOT CHARTS -->
<script src="../../plugins/flot/jquery.flot.min.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="../../plugins/flot/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="../../plugins/flot/jquery.flot.pie.min.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="../../plugins/flot/jquery.flot.categories.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.13.1/lodash.min.js"></script>

<script>
  $(function () {
    $('#dataTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
  });
  function getUserLogs () {
        $.get("item.php").done(function( resp ) {
            
            function mapsLogs (keyLog){
                return _.chain(resp.data).groupBy(keyLog).map(function(value, key) {
                    var count = _.values(_.countBy(value, keyLog))[0];
                    return [key +`(${count})` ,_.values(_.countBy(value, keyLog))[0]]
                }).value();
            }

            getPlot({
                data : mapsLogs('item_name'),
                color: '#3c8dbc'
            }, 'bar-chart-page')

            getPlot({
                data : mapsLogs('device'),
                color: '#3c8dbc'
            }, 'bar-chart-device')

            getPlot({
                data : mapsLogs('emp_name'),
                color: '#3c8dbc'
            }, 'bar-chart-os')

            getPlot({
                data : mapsLogs('status_hdr'),
                color: '#3c8dbc'
            }, 'bar-chart-browser')
        })
    }
    getUserLogs()
    setInterval(function(){
        getUserLogs()
    },10000)

    function getPlot (data, key){
        $setKey = '#' + key
        $.plot($setKey, [data], {
            grid  : {
                borderWidth: 1,
                borderColor: '#f3f3f3',
                tickColor  : '#f3f3f3'
            },
            series: {
                bars: {
                show    : true,
                barWidth: 0.5,
                align   : 'center'
                }
            },
            xaxis : {
                mode      : 'categories',
                tickLength: 0
            }
        })
    }

    
</script>

</body>
</html>
