<?php include_once('../../php/authen.php'); 

    if (isset($_SESSION['id'])){
        $y = substr((date("Y")+543),-2);
        $m = date("m");

        $sql2 = "SELECT concat(RIGHT((YEAR(NOW())+543),2), MONTH(NOW()),LPAD((`running` + 1),3,'0')) AS `running`, LPAD((`running` + 1),3,'0') AS `no` FROM `borrowreturn_hdr` WHERE `y` = RIGHT((YEAR(NOW())+543),2) AND `m` = MONTH(NOW()) ORDER BY `id` DESC LIMIT 1";
        $result2 = $conn->query($sql2);
        $row2 = $result2 ->fetch_assoc();
        if (isset($row2['running'])){
                $docno = $row2['running'];
                $running = $row2['no'];
        } else {
                $docno = $y.$m.'001';
                $running = '001';
        }

        $sqlT = "SELECT * FROM `line` WHERE `id` = '1'";
        $resultT = $conn->query($sqlT);
        $rowT = $resultT->fetch_assoc();

        $sqlC = "SELECT `line` FROM `user` WHERE `id` = '".$_SESSION['id']."'" ;
        $resultC = $conn->query($sqlC);
        $rowC = $resultC->fetch_assoc(); 
    
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

            $sql_fine = "SELECT `fine` FROM `fine` WHERE `id` = '2' ";
            $result_fine = $conn->query($sql_fine);
            $row_fine = $result_fine->fetch_assoc();
            $exp = date('Y-m-d H:i:s', strtotime('+'.$row_fine['fine'].' days'));
             
        $sql = "INSERT INTO `borrowreturn_hdr` (`user`, `y`, `m`, `running`, `docno`, `status`, `date`, `exp_date`) 
        VALUES ('".$_SESSION['id']."', 
                '".$y."',
                '".$m."',
                '".$running."',
                '".$docno."',
                'ยืม',
                '".date("Y-m-d H:i:s")."',
                '".$exp."')";
        $result = $conn->query($sql) or die($conn->error);
        $lastid = mysqli_insert_id($conn); 

        if($result){

            $sqlb = "UPDATE `borrowreturn_dtl` 
            SET `hdr`  = '".$lastid."',
                `status` = '2',
                `date` = '".date("Y-m-d H:i:s")."'
                WHERE `user` = '".$_SESSION['id']."' AND  `status` = '1';";
            $resultb = $conn->query($sqlb) or die($conn->error);

            if($resultb){
               
                $query = "SELECT `item`,`qty` FROM `borrowreturn_dtl` WHERE `hdr` = '".$lastid."'";
                $resultq = $conn->query($query); 
                while($rowq = mysqli_fetch_array($resultq)) {
                    $names[] = $rowq['item']; 
                    $qty[] = $rowq['qty'];
                }
                
                foreach($names as $key => $value) {
                    $sqlit = "UPDATE `item` 
                    SET `lend_qty`  = `lend_qty` + '".$qty[$key]."',
                        `total_qty`  = `total_qty` - '".$qty[$key]."'
                    WHERE `id` = '".$value."';"; 
                    $resultit = $conn->query($sqlit) or die($conn->error);
                }

                if(!empty($GLOBALS["token"])){
                    include_once('line_for_approve.php');
                } else {
                    echo '<script> alert("ยืมสำเร็จ!")</script>'; 
                    header('Refresh:0; url=../borrow.php');
                }
                   
            }
      
        }
       //header('Refresh:0; url=../borrow-2.php');
    } else {
        header('Refresh:0; url=../borrow-2.php');
    }

?>