<?php 
   $uri = $_SERVER['REQUEST_URI'];    
   $array = explode('/', $uri);
   $key = array_search("pages", $array);
   $name = $array[$key + 1];
   $name2 = $array[$key + 2];
?>
<nav class="main-header navbar navbar-expand border-bottom navbar-light bg-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
      <a href="#" class="d-block"><b>สวัสดี : </b><?php echo $_SESSION['emp_name']; ?><b> - บทบาท :  </b><?php if($_SESSION['role']=="ผู้ดูแล"){echo "ผู้ดูแล";}?><?php if($_SESSION['role']=="ผู้อนุมัติ"){echo "ผู้อนุมัติ";}?><?php if($_SESSION['role']=="ผู้ใช้งาน"){echo "ผู้ใช้งาน";}?></a>
      </li>
    </ul>
</nav>
  <!-- /.navbar -->
<aside class="main-sidebar sidebar-light-secondary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <center><?php echo $_SESSION['username']; ?></center>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
        <?php if($_SESSION['role'] == 'ผู้ดูแล' || $_SESSION['role'] == 'ผู้อนุมัติ') { ?>
          
          <li class="nav-header">ข้อมูลพื้นฐาน</li>
          <li class="nav-item">
            <a href="../graphs" class="nav-link <?php echo $name == 'graphs' ? 'active': '' ?>">
              <i class="fas fa-chart-line"></i>
                <p style="padding-left: 4px;">แดชบอร์ด</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="../token" class="nav-link <?php echo $name == 'token' ? 'active': '' ?>">
            <i class="fas fa-comments"></i>
                <p>โทเคนไลน์</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../user" class="nav-link <?php echo $name == 'user' ? 'active': '' ?>">
              <i class="fas fa-users"></i>
                <p>ผู้ใช้งาน</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../item" class="nav-link <?php echo $name == 'item' ? 'active': '' ?>">
              <i class="fas fa-store"></i>
                <p>หนังสือ</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../days/index.php" class="nav-link <?php echo $name== 'days' ? 'active': '' ?>">
            <i class="fas fa-hourglass-start"></i>
                <p>จำนวนวันที่ยืม</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../fine/index.php" class="nav-link <?php echo $name == 'fine' ? 'active': '' ?>">
              <i class="fas fa-hand-holding-usd"></i>
                <p>ค่าปรับ</p>
            </a>
          </li>

          <?php } ?>

          <li class="nav-header">ข้อมูลการขอยืม</li>

          <li class="nav-item">
            <a href="../borrowreturn/borrow.php" class="nav-link <?php echo $name2 == 'borrow.php' || $name2 == 'borrow-2.php' ? 'active': '' ?>">
              <i class="far fa-circle"></i>
                <p>ขอยืมหนังสือ</p>
            </a>
          </li>
          
          <!-- <li class="nav-item">
            <a href="../borrow-approve" class="nav-link <?php //echo $name == 'borrow-approve' ? 'active': '' ?>">
              <i class="far fa-check-circle"></i>
                <p>อนุมัติการขอยืม</p>
            </a>
          </li> -->
          <?php if($_SESSION['role'] == 'ผู้ดูแล' || $_SESSION['role'] == 'ผู้อนุมัติ') { ?>
          <li class="nav-item">
            <a href="../return" class="nav-link <?php echo $name == 'return' ? 'active': '' ?>">
            <i class="fas fa-check-circle"></i>
                <p>ขอคืนหนังสือ</p>
            </a>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a href="../history" class="nav-link <?php echo $name == 'history' ? 'active': '' ?>">
              <i class="fa fa-history nav-icon"></i>
                <p>ประวัติการยืม-คืน</p>
            </a>
          </li>

          <li class="nav-header">บัญชี</li>
          <li class="nav-item">
            <a href="../profile/profile.php" class="nav-link <?php echo $name2 == 'profile.php' ? 'active': '' ?>">
              <i class="fas fa-user"></i>
                <p>โปรไฟล์</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../profile/token.php" class="nav-link <?php echo $name2 == 'token.php' ? 'active': '' ?>">
              <i class="fab fa-line"></i>
              <p>เปลี่ยนโทเคนไลน์</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../profile/password.php" class="nav-link <?php echo $name2 == 'password.php' ? 'active': '' ?>">
              <i class="fas fa-key"></i>
              <p>เปลี่ยนรหัสผ่าน</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../../logout.php" class="nav-link">
              <i class="fas fa-sign-out-alt"></i>
              <p>ออกจากระบบ</p>
            </a>
          </li>
         
        </ul>
      </nav>





    </div>
    <!-- /.sidebar -->
</aside>