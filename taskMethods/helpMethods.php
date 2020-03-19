<?php
class HelpMethods{

  public static function sortQuery($parameter, $direction){
  
    if($parameter=="0"){
      return "SELECT * from `test`.`tasks`";
    }
    
    if($parameter=="status"){
      $parameter='isPerfomed';
    }
    
    $query="SELECT * from test.tasks ORDER BY $parameter";
    if($direction=='up'){
      $query.=" DESC";
    }

    return $query;
  }

  public static function tasksPage($task){
    $taskFields='';
    $taskFields.='<tr id="'.$task[0].'">';
    $taskFields.='<td>'.$task[3].'</td>';
    $taskFields.='<td>'.$task[4].'</td>';
    $taskFields.='<td>'.htmlspecialchars($task[2],ENT_HTML5).'</td>';
    $taskFields.='<td>';
    if ($task[5] && $task[6]){
      $taskFields.="Выполнено; Отредактировано";
    }elseif ($task[5]){
      $taskFields.="Выполнено";
    }elseif ($task[6]){
      $taskFields.="Отредактировано";
    }
    $taskFields.='</td></tr>';
    return $taskFields;
  }
}
?>