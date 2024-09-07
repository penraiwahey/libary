<?php include_once('../../php/authen.php'); 

    //print_r($_POST);
    if (isset($_POST['submit'])) {
        if($_POST['password'] == $_POST['confirm_password']) {
        $role = $_POST['selectBox']; 
    
        $sql_check_username = "SELECT * FROM `user` WHERE `username` = '" . $_POST['username'] . "' ";
        $check_username = $conn->query($sql_check_username);

            if (!$check_username->num_rows) {
                $hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
              
                    $sql = "INSERT INTO `user` (`username`, `password`, `role`, `emp_id`, `emp_name`, `department`, `position`) 
                    VALUES ('".$_POST['username']."', 
                            '".$hashed."', 
                            '".$role."', 
                            '".$_POST['emp_id']."',
                            '".$_POST['emp_name']."',
                            '".$_POST['department']."',
                            '".$_POST['position']."')";
    
                    $result = $conn->query($sql);
                    if ($result) {
                        echo '<script> alert("บันทึกสำเร็จ!")</script>';
                        header('Refresh:0; url=../index.php');
                    } else {
                        echo '<script> alert("บันทึกไม่สำเร็จ!")</script>';
                        header('Refresh:0; url=../add.php');
                    }
    
            } else {
                echo '<script> alert("ชื่อผู้ใช้งานนี้มีอยู่แล้ว!")</script>';
                header('Refresh:0; url=../add.php');
            }
    
        } else { 
            echo '<script> alert("เกิดข้อผิดพลาด!")</script>';
            header('Refresh:0; url=../add.php');
        }
       
    } else {    
        header('Refresh:0; url=../add.php');
    }
?>