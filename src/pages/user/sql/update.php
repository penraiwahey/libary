<?php include_once('../../php/authen.php'); 

//print_r($_POST);
    if(isset($_POST['submit'])){

        $role = $_POST['selectBox']; 

        $sql = "UPDATE `user` 
                SET role = '".$role."', 
                    emp_id = '".$_POST['emp_id']."', 
                    emp_name = '".$_POST['emp_name']."', 
                    department = '".$_POST['department']."',
                    position = '".$_POST['position']."'
                    WHERE id = '".$_POST['id']."'; ";

        $result = $conn->query($sql) or die($conn->error);
        if($result){
            echo '<script> alert("บันทึกสำเร็จ!") </script>';
            header('Refresh:0; url=../index.php');
        }

    } else {
        header('Refresh:0; url=../index.php');
    }
?>