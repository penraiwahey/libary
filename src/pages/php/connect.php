<?php 
    error_reporting(E_ALL); 
    $conn = new mysqli('localhost','root','','br');
    $conn->set_charset('utf8mb4_general_ci'); 
    if ($conn->connect_errno) {
        echo "Connect Error :".$conn->connect_error;
        exit(); 
    }
    date_default_timezone_set('Asia/Bangkok');
    $base_path_item = 'assets/images/item/';

?>