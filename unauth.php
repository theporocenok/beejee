<?php

  unset($_COOKIE["admin"]);
  setcookie('admin', null, -1, '/');
  //echo $_COOKIE["admin"];
  return;

?>