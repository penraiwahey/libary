<?php include_once('../../php/authen.php');
//print_r($_POST);
    if(isset($_POST['submit'])){
        
        $sql = "UPDATE `line` 
        SET `line`  = '".$_POST['line']."'
            WHERE id = '1';";
        $result = $conn->query($sql) or die($conn->error);
        if($result){
           header('location:LINE_API.php');
        }

    } else {
        header('Refresh:0; url=../index.php');
    }
?>