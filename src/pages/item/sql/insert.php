<?php include_once('../../php/authen.php');
    //print_r($_POST);
    // print_r($_FILES['file']);

    if(isset($_POST['submit'])){

        if($_FILES['file']['name'] != '') { 
            $temp = explode('.', $_FILES['file']['name']);
            $new_name = round(microtime(true)*9999) . '.' . end($temp);
            $url_upload = '../../../../assets/images/item/'.$new_name;
            move_uploaded_file($_FILES['file']['tmp_name'], $url_upload); 
        }
        if($_FILES['file']['name'] == '') { 
            $new_name = 'no.jpg';
        }   

            $sql = "INSERT INTO `item` (`img`, `item_id`, `item_name`, `price`, `item_qty`, `total_qty`) 
            VALUES ('".$new_name."', 
                    '".$_POST['item_id']."', 
                    '".$_POST['item_name']."',
                    '".$_POST['price']."',
                    '".$_POST['item_qty']."',
                    '".$_POST['item_qty']."')";
            $result = $conn->query($sql) or die($conn->error);
            if($result){
                echo '<script>alert("บันทึกสำเร็จ!")</script>';
                header('Refresh:0; url="../index.php"');
            }
       
    } else {
        header('location:../index.php');
    }
?>