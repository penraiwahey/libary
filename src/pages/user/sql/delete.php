<?php include_once('../../php/authen.php'); 

    if (isset($_GET['id'])){
        $sql = "DELETE FROM `user` WHERE `id` = '".$_GET['id']."' ";
        $result = $conn->query($sql);

        if( $conn->affected_rows ){
            echo '<script> alert("ลบสำเร็จ!")</script>'; 
            header('Refresh:0; url=../index.php'); 
        } else {
            echo '<script> alert("ไม่มีข้อมูล!")</script>'; 
            header('Refresh:0; url=/index.php');
        }

    } else {
        header('Refresh:0; url=../index.php');
    }

?>