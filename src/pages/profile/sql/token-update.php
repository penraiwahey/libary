<?php include_once('../../php/authen.php');
//print_r($_POST);
    if(isset($_POST['submit'])){
        
        $sql = "UPDATE `user` 
        SET `line`  = '".$_POST['line']."'
            WHERE id = '".$_SESSION['id']."';";
        $result = $conn->query($sql) or die($conn->error);
        if($result){
            //echo '<script>alert("เพิ่มข้อมูลสำเร็จ")</script>';
            // header('Refresh:0; url="../line_me.php?id=1"');
           
            header('location:LINE_API.php');
        }

    } else {
        header('Refresh:0; url=../token.php');
    }
?>