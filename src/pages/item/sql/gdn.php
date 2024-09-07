<?php include_once('../../php/authen.php');
//print_r($_POST);
    if(isset($_POST['submit'])){
        // $type = $_POST['type']; 
            $gdn = $_POST['gdn'];
  

        $sql = "UPDATE `item` 
        SET item_qty = item_qty - '".$gdn."',total_qty = total_qty - '".$gdn."'
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