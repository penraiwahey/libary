<?php 
  session_start();
  require_once('pages/php/connect.php');
  if (isset($_POST['submit'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $sql = "SELECT * FROM `user` WHERE `username` = '".$username."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
   
    if(!empty($row) && password_verify($password, $row['password'] ))
    {
      
      $_SESSION['id'] = $row['id'];
      $_SESSION['username'] = $row['username'];
      $_SESSION['emp_id'] = $row['emp_id'];
      $_SESSION['emp_name'] = $row['emp_name'];
      $_SESSION['department'] = $row['department'];
      $_SESSION['position'] = $row['position'];
      $_SESSION['role'] = $row['role'];
   
        header('Location: pages/borrowreturn/borrow.php');

    } else {
      echo '<script> alert("ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง") </script>';
    }

  }


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>เข้าสู่ระบบ</title>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>ระบบยืมคืน</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">ยินดีต้อนรับ</p>

    <form class="form-horizontal" action="" method="post">
          <div class="form-group ">
              <div class="col-xs-12">
                  <input class="form-control" type="text" name="username" required="" placeholder="Username">
              </div>
          </div>

          <div class="form-group">
              <div class="col-xs-12">
                  <input class="form-control" type="password" name="password" required="" placeholder="Password">
              </div>
          </div>

          <div class="form-group account-btn text-center m-t-10">
              <div class="col-xs-12">
                  <button class="btn w-md btn-bordered btn-secondary waves-effect waves-light" type="submit" name="submit">เข้าสู่ระบบ</button>
              </div>
          </div>

      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
