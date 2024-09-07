<?php 
include_once('../../php/authen.php');
header('Content-Type: application/json');
$sql = "UPDATE `borrowreturn_dtl` SET `borrow` = '".$_POST['value']."' WHERE `id` = '".$_POST['id']."' ";
$result = $conn->query($sql);
if($result){
    http_response_code(200);
    $response = array('message' => 'OK');
}else{
    http_response_code(400);
    $response = array('message' => 'ERROR');
}
echo json_encode($response);
?>

