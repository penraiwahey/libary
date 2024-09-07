<?php 
   session_start();
   require_once('connect.php');

   $uri = $_SERVER['REQUEST_URI'];  
   $array = explode('/', $uri);
   //print_r($array);
   $key = array_search("pages", $array);
   $name = $array[$key + 1];

   if( !isset($_SESSION['id'] ) ){
      header('Location: ../../login.php');  
   }
?>