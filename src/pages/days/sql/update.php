<?php include_once('../../php/authen.php');
//print_r($_POST);
    if(isset($_POST['submit'])){
        
        $sql = "UPDATE `fine` 
        SET `fine`  = '".$_POST['fine']."'
            WHERE id = '2';";
        $result = $conn->query($sql) or die($conn->error);
        if($result){
            echo '<script> alert("บันทึกสำเร็จ!")</script>'; 
            header('Refresh:0; url=../index.php');
        }

    } else {
        header('Refresh:0; url=../index.php');
    }
?>