<?php
include_once('db.php');

if (isset($_POST)){
  $data=array();
  parse_str($_POST["data"], $data);
  $query="SELECT * from `test`.`users` WHERE name= '".$data["name"]."' AND password= '".$data["password"]."'";
  $users=$db->query($query);
  $db->close();
  //echo $query;

  if($users){
    //echo mysqli_num_rows($users);
    if(mysqli_num_rows($users)==1){
      setcookie("admin",true);
      echo json_encode(array("status"=>"success"));
      return;
    }
  }
  echo json_encode(array("status"=>"error"));
}

?>