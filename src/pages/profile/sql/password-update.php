<?php 
 include_once('../../php/authen.php');

//print_r($_POST);
if(isset($_POST['submit']) && ($_POST['password'] == $_POST['password_confirm']) ){
    $hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
  
    $sql = "UPDATE `user` 
    SET `password` = '".$hashed."' 
    WHERE `id` = '".$_SESSION['id']."';";

    $result = $conn->query($sql) or die($conn->error);
    if($result){
        echo '<script> alert("บันทึกสำเร็จ!") </script>';
        header('Refresh:0; url=../password.php');
    } else {
        echo '<script> alert("บันทึกไม่สำเร็จ!")</script>';
        header('Refresh:0; url=../password.php');
    }

} else {
    echo '<script> alert("รหัสผ่านไม่ตรงกัน!")</script>';
    header('Refresh:0; url=../password.php');
}

?>