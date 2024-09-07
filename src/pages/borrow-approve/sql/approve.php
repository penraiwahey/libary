<?php include_once('../../php/authen.php'); 

    if (isset($_GET['id'])){

        $sqlb = "UPDATE `borrowreturn_hdr` 
        SET `action_by`  = '".$_SESSION['id']."',
            `status` = 'อนุมัติ',
            `action_date` = '".date("Y-m-d H:i:s")."'
            WHERE `id` = '".$_GET['id']."';";
        $resultb = $conn->query($sqlb) or die($conn->error);

        if($resultb){
           
            $query = "SELECT `item`,`borrow` FROM `borrowreturn_dtl` WHERE `hdr` = '".$_GET['id']."'";
            $resultq = $conn->query($query); 
            while($rowq = mysqli_fetch_array($resultq)) {
                $names[] = $rowq['item']; 
                $br[] = $rowq['borrow']; 
            }
            

            foreach($names as $key => $value) {
                if ($br[$key] == 'true') {
                   //print_r($names[$key]);
                    $sqlit = "UPDATE `item` 
                    SET `pending_qty`  = `pending_qty` - '1',
                        `lend_qty`  = `lend_qty` + '1'
                    WHERE `id` = '".$value."';"; 
                } else {
                    //print_r($br[$key]);
                    $sqlit = "UPDATE `item` 
                    SET `pending_qty`  = `pending_qty` - '1',
                        `use_qty`  = `use_qty` + '1'
                    WHERE `id` = '".$value."';"; 
                }
                $resultit = $conn->query($sqlit) or die($conn->error);
            }

        $sqlD = "SELECT `docno` FROM `borrowreturn_hdr` WHERE `id` = '".$_GET['id']."'";
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
                include_once('line_approve.php');
            } else {
                echo '<script> alert("อนุมัติแล้ว!")</script>'; 
                header('Refresh:0; url="../index.php"');
            }
                //include_once('line_approve.php');
                //header('Refresh:0; url=../index.php');
        }

    } else {
        header('Refresh:0; url=../index.php');
    }

?>