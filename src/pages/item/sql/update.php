<?php include_once('../../php/authen.php');
//print_r($_POST);
    if(isset($_POST['submit'])){
        // $type = $_POST['type']; 

        $image_name = $_POST['data_file'];
        if($_FILES['file']['name'] != ''){
            $temp =  explode('.',$_FILES['file']['name']);
            $image_name = round(microtime(true)*9999) . '.' . end($temp);
            $url_upload = '../../../../assets/images/item/'.$image_name;
            if ( move_uploaded_file($_FILES['file']['tmp_name'], $url_upload) ){
            }else{
                echo '<script> alert("ไม่สามารถอัพโหลดรูปภาพใหม่ได้ โปรดลองอีกครั้ง")</script>'; 
                header('Refresh:0; url=../index.php'); 
            }
        }

            $item_qty = $_POST['item_qty'];
            $lend_qty = $_POST['lend_qty'];
            $use_qty = $_POST['use_qty'];
            $pending_qty = $_POST['pending_qty'];
            $uselend = $lend_qty +  $use_qty + $pending_qty;
            $totalqty = $item_qty -  $uselend; 

        $sql = "UPDATE `item` 
        SET img = '".$image_name."', 
            item_id = '".$_POST['item_id']."', 
            item_name = '".$_POST['item_name']."', 
            price = '".$_POST['price']."', 
            item_qty = '".$item_qty."',
            lend_qty = '".$lend_qty."',
            use_qty = '".$use_qty."',
            total_qty = '". $totalqty."'
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