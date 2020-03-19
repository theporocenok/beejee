<?php
  function newTask($post) {
    $values = array();
    parse_str($post, $values);
    $post=$values;

    $answer=array();
    if ((empty($post['name'])) 
      || !preg_match('/^[a-zA-Z]+$/ui',$post['name'])) {
        $answer["username"]=true;
    }
    if ((empty($post['email'])) 
      || !filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
        $answer["email"]=true;
    }
    if ((empty($post['task']) 
      || strlen($post['task'])==0)) {
        $answer["task"]=true;
    }
    /*if(!$array['username'] && !$array["email"] && !$array["task"]){
      return "success";
    }*/
    if(empty($answer)){
      return "success";
    }
    return $answer;
  }
?>