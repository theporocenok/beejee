<?php
 
//Информация о базе данных
 
include_once 'authDBData.php';

$dbHost='localhost';
 
$dbUsername=$sqlUsername;
 
$dbPassword=$sqlPassword;
 
$dbName='test';
 
$db=new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
 
if($db->connect_error){
 
   die("Unable to connect database: ".$db->connect_error);
 
}

?>