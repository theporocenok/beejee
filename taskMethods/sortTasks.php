<?php
if ($_GET["parameter"]!="0"){
  include_once(dirname(__FILE__).'/../db.php');
  include_once("helpMethods.php");
  
  $query=HelpMethods::sortQuery($_GET["parameter"], $_GET["direction"]);
  //return $query;
  $tasks=$db->query($query);
  $db->close();

  if($tasks){
    $i=0;
    $taskFields='';
    for ($i=0; $i<3 && $i<=mysqli_num_rows($tasks); $i++){
      $task=mysqli_fetch_row($tasks);
      $taskFields.=HelpMethods::tasksPage($task);
    }
    
    echo $taskFields;
  }
}


?>