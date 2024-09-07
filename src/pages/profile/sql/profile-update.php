<?php include_once('../../php/authen.php');
//print_r($_POST);
    if(isset($_POST['submit'])){

        $sql = "UPDATE `user` 
                SET emp_id = '".$_POST['emp_id']."', 
                    emp_name = '".$_POST['emp_name']."', 
                    department = '".$_POST['department']."',
                    position = '".$_POST['position']."'
                    WHERE id = '".$_SESSION['id']."'; ";

        $result = $conn->query($sql) or die($conn->error);
        if($result){
            echo '<script> alert("บันทึกสำเร็จ!") </script>';
            header('Refresh:0; url=../profile.php');
        }

    } else {
        header('Refresh:0; url=../profile.php');
    }
?>