<?php include_once('../../php/authen.php'); 

    if (isset($_GET['id'])){
        if (isset($_GET['qty'])){ $qty = $_GET['qty']; }else{ $qty = '1';};
        $status = '1';

        $sql2 = "SELECT `id` FROM `borrowreturn_dtl` WHERE `user` = '".$_SESSION['id']."' AND `status` = '1' AND `item` =  '".$_GET['id']."'";
        $result2 = $conn->query($sql2);
        $row2 = $result2 ->fetch_assoc();

       if(isset($row2['id'])){
            $sql = "UPDATE `borrowreturn_dtl` 
            SET qty =  qty + '".$qty."'
                WHERE id = '".$row2['id']."'; ";
        } else {
            $sql = "INSERT INTO `borrowreturn_dtl` (`user`, `qty`, `remain` , `status` , `item`, `borrow`) 
            VALUES ('".$_SESSION['id']."', 
                    '".$qty."', 
                    '".$qty."', 
                    '".$status."',
                    '".$_GET['id']."',
                    'true')";
        }

        $result = $conn->query($sql) or die($conn->error);
        if($result){
            //echo '<script>alert("เพิ่มแล้ว!")</script>';
            header('Refresh:0; url="../borrow.php"');
        } else {
            echo '<script>alert("ผิดพลาด!")</script>';
            header('Refresh:0; url=../borrow.php');
        }

    } else {
        header('Refresh:0; url=../borrow.php');
    }

?>