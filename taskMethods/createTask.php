<?php
include_once(dirname(__FILE__).'/../db.php');
include_once(dirname(__FILE__).'/../valid.php');

if (isset($_POST['createTask'])){
  if (newTask($_POST["data"])=="success"){
  
    $values = array();
    parse_str($_POST["data"], $values);
    $name = $values['name'];
    $email = $values['email'];
    $task = $values['task'];
    $query = "INSERT into test.tasks (`username`,`email`,`text`) VALUES ('".$name."','".$email."','".$task."')";
    $insert=$db->query($query);
    $db->close();
    $answer=array('status'=>'success');
    echo json_encode($answer);
  }else{
    $answer=array('status' => 'error', 'data' => newTask($_POST["data"]));
    echo json_encode($answer);
  }
}

?>