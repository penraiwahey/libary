<?php include_once('../../php/authen.php'); 

    if (isset($_GET['id'])){
        if (isset($_GET['qty'])){ $qty = $_GET['qty']; }else{ $qty = '1';};
        $sql2 = "SELECT `item` FROM `borrowreturn_dtl` WHERE `id` =  '".$_GET['id']."'";
        $result2 = $conn->query($sql2);
        $row2 = $result2 ->fetch_assoc();
      
        $sql = "UPDATE `borrowreturn_dtl` 
        SET remain = remain - '".$qty."'
        WHERE id = '".$_GET['id']."'; ";

        $result = $conn->query($sql) or die($conn->error);
        if($result){

            $sqlit = "UPDATE `item` 
            SET `lend_qty`  = `lend_qty` - '".$qty."',
                `total_qty`  = `total_qty` + '".$qty."'
            WHERE `id` = '".$row2['item']."';"; 
            $resultit = $conn->query($sqlit) or die($conn->error);
            if($resultit){

                 
            $sqlD = "SELECT `docno` FROM `borrowreturn_hdr` WHERE `id` = '".$_GET['doc']."'";
            $resultD = $conn->query($sqlD);
            $rowD = $resultD->fetch_assoc();
    
            $sqlT = "SELECT * FROM `line` WHERE `id` = '1'";
            $resultT = $conn->query($sqlT);
            $rowT = $resultT->fetch_assoc();
    
            $sqlC = "SELECT `line` FROM `user` WHERE `id` = '".$_SESSION['id']."'" ;
            $resultC = $conn->query($sqlC);
            $rowC = $resultC->fetch_assoc(); 
    
            $docno = $rowD['docno'];
            $GLOBALS["docno"] = $docno;
            $GLOBALS["docid"] = $_GET['doc'];
    
                if(!empty($rowT))
                {
                    $GLOBALS["token"] = $rowT['line'];
                } else {
                    $GLOBALS["token"] = '';
                }
    
                if(!empty($rowC))
                {
                    $GLOBALS["tokenMe"] = $rowC['line'];
                } else {
                    $GLOBALS["tokenMe"] = '';
                }

                if(!empty($GLOBALS["token"])){
                    include_once('line_return_some.php');
                } else {
                    echo '<script> alert("รับคืนบางส่วนแล้ว!")</script>'; 
                    header('Refresh:0; url=../view.php?id='.$_GET['doc']);
                }
                //header('Refresh:0; url=../view.php?id='.$_GET['doc']);
            }


        } else {
            echo '<script>alert("ผิดพลาด!")</script>';
            header('Refresh:0; url=../view.php?id='.$_GET['doc']);
        }

    } else {
        header('Refresh:0; url=../view.php?id='.$_GET['doc']);
    }

?>