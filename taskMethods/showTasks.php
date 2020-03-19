<?php

if (isset($_GET["page"])){
  include_once(dirname(__FILE__).'/../db.php');
  include_once("helpMethods.php");

  $parameter=$_GET["parameter"];
  $direction=$_GET["direction"];
  
  $query=HelpMethods::sortQuery($parameter, $direction);

  $tasks=$db->query($query);
  $db->close();

  if($tasks){
    $i=0;
    $taskFields='';
    for($j=0; $task=mysqli_fetch_row($tasks); $j++){
      if($_GET["page"]*3<=$j && $i<3){
        $taskFields.=HelpMethods::tasksPage($task);
        $i++;
      }
    }
    
    echo $taskFields;
  }
}

function showAll(){
  include_once(dirname(__FILE__).'/../db.php');
  include_once(dirname(__FILE__).'/../valid.php');
  include_once("helpMethods.php");

  $tasks=$db->query("SELECT * from test.tasks");
  $db->close();

  if ($tasks){
    $taskFields='';
    for ($i=0; $i<3 && $i<=mysqli_num_rows($tasks); $i++){
      $task=mysqli_fetch_row($tasks);
      $taskFields.=HelpMethods::tasksPage($task);
    }
  
    
    $num='';
    if(mysqli_num_rows($tasks)>3){
      $num.='<ul class="pagination">';

      for ($i=0; $i<intdiv(mysqli_num_rows($tasks),3); $i++){
        $num.='<li class="page-item '.(($i=="0")?'active':'').'" id="'.$i.'"><a class="page-link" href="#">'.($i+1).'</a></li>';
      }

      if(mysqli_num_rows($tasks)%3>0){
        $num.='<li class="page-item" id="'.intdiv(mysqli_num_rows($tasks),3).'"><a class="page-link" href="#">'.(intdiv(mysqli_num_rows($tasks),3)+1).'</a></li>';
      }

      $num.='</ul>';
    }
    
    mysqli_free_result($tasks);

    return 
    '<table class="table">
    <thead>
      <tr>
        <th scope="col" id="username">Имя пользователя <i class="fas fa-arrow-down"></i><i class="fas fa-arrow-up"></i></th>
        <th scope="col" id="email">Email <i class="fas fa-arrow-down"></i><i class="fas fa-arrow-up"></i></th>
        <th scope="col" id="text">Задача <i class="fas fa-arrow-down"></i><i class="fas fa-arrow-up"></i></th>
        <th scope="col" id="status">Статус <i class="fas fa-arrow-down"></i><i class="fas fa-arrow-up"></i></th>
      </tr>
    </thead>
    <tbody>'
    .$taskFields.
    '</tbody>
    </table>'
    .$num;
  }
}

?>