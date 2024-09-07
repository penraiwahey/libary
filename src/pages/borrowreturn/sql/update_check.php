<?php include_once('../../php/authen.php'); 

    if (isset($_GET['id'])){
        if (isset($_GET['qty'])){ $qty = $_GET['qty']; }else{ $qty = '1';};
        $status = '1';

        $sql2 = "SELECT `id` FROM `borrowreturn_dtl` WHERE `user` = '".$_SESSION['id']."' AND `status` = '1' AND `item` =  '".$_GET['id']."'";
        $result2 = $conn->query($sql2);
        $row2 = $result2 ->fetch_assoc();

       if(isset($row2['id'])){
            $sql = "UPDATE `borrowreturn_dtl` 
            SET qty = '".$qty."', remain = '".$qty."'
            WHERE id = '".$row2['id']."'; ";
        }

        $result = $conn->query($sql) or die($conn->error);
        if($result){
            header('Refresh:0; url="../borrow-2.php"');
        } else {
            echo '<script>alert("ผิดพลาด!")</script>';
            header('Refresh:0; url=../borrow-2.php');
        }

    } else {
        header('Refresh:0; url=../borrow-2.php');
    }

?>