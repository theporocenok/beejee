<?php

  include_once(dirname(__FILE__).'/../db.php');


  if(isset($_GET["id"])){
    if(!isset($_COOKIE["admin"]) || $_COOKIE["admin"]!=1){
      echo json_encode(array("status"=>"error","reason"=>"Not enough rights"));
      return;
    }

    $query = "SELECT * from `test`.`tasks` WHERE id='".$_GET["id"]."'";
    //echo $query;
    $tasks=$db->query($query);
    $db->close();
    if($tasks){
      $task=mysqli_fetch_row($tasks);
      $answer=array("id"=>$task[0],
                    "username"=>$task[3],
                    "task"=>$task[2], 
                    "email"=>$task[4],
                    "isPerfomed"=>$task[5]);
      echo json_encode(array("status"=>"success","task"=>$answer));
    }
  }

  if(isset($_POST["editTask"])){
    if(!isset($_COOKIE["admin"]) || $_COOKIE["admin"]!=1){
      echo json_encode(array("status"=>"error","reason"=>"Not enough rights"));
      return;
    }

    $data=array();
    parse_str($_POST["data"], $data);

    $query = "SELECT * from `test`.`tasks` WHERE id='".$data["id"]."'";
    $tasks=$db->query($query);

    if($tasks){
      $task=mysqli_fetch_row($tasks);
      
      if($task[2]==$data["task"] && (($task[5]==0)?"false":"true")==$data["isPerfomed"]){
        echo json_encode(array("status"=>"error", "reason"=>"No Changes"));
        
        $db->close();
        return;
      }
      
      $data["isPerfomed"]=($data["isPerfomed"]==false)?"0":1;
      $query="UPDATE tasks SET text='".$data["task"]."', isPerfomed='".$data["isPerfomed"]."', isEdited='1' WHERE id='".$data["id"]."'";
      $update=$db->query($query);
      $db->close();
      $answer=array('status'=>'success');
      echo json_encode($answer);
      return;
    }

  }
?>