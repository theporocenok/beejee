<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <script src="https://kit.fontawesome.com/0ab8a660b3.js" crossorigin="anonymous"></script>

  <title>Document</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="header">
        <?php
          if($_COOKIE["admin"]==1){
            echo '<div class="btn btn-danger" id="unauth">Выход</div>';
          }else{
            echo '<div class="btn btn-dark" id="auth">Вход</div>';
          }
        ?>
        <div class="btn btn-success" id="createTask">Создать задачу</div>
      </div>
    </div>
    <div class="row">
      <?php 
      
      include_once 'taskMethods/showTasks.php';
      echo showAll();
      ?>
    </div>
  </div>
  <div class="createTask">
    <div class="modal__form">
      <a class="close">x</a>
      <form id="createTaskForm">
        <div class="form-group">
          <label for="InputName1">Username</label>
          <input type="text" class="form-control" id="InputName1" name="name">
          <span class="name">Введите какое-либо имя пользователя</span>
        </div>
  
        <div class="form-group">
          <label for="InputEmail1">Email address</label>
          <input type="email" class="form-control" id="InputEmail1" name="email">
          <span class="email">Введите корректный email адрес</span>
        </div>
        <div class="form-group">
          <label for="InputTask1">Text</label>
          <input type="text" class="form-control" id="InputTask1" name="task">
          <span class="task">Введите какой-нибудь текст</span>
        </div>
        <div type="submit" name="createTask" class="btn btn-primary">Submit</div>
      </form>
    </div>
  </div>
  <div class="auth">
    <div class="modal__form">
      <a class="close">x</a>
      <form id="authForm">
        <div class="form-group">
          <label for="exampleInputName1">Name</label>
          <input type="text" class="form-control" id="exampleInputName1" name="name">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <span class="auth__error">Пользователя с такими данными не существует</span>
        <div type="submit" name="auth" class="btn btn-primary">Submit</div>
      </form>
    </div>
  </div>
  <div class="editTask">
    <div class="modal__form">
        <a class="close">x</a>
        <form id="editTaskForm">
          <div class="form-group">
            <div taskID=""></div>
          </div>
          <div class="form-group">
            <label for="editName1">Username</label>
            <input type="text" class="form-control" id="editName1" name="name" readonly>
          </div>
    
          <div class="form-group">
            <label for="editEmail1">Email address</label>
            <input type="email" class="form-control" id="editEmail1" name="email" readonly>
          </div>
          <div class="form-group">
            <label for="editTask1">Text</label>
            <input type="text" class="form-control" id="editTask1" name="task">
            <span class="task">Введите какой-нибудь текст</span>
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="isPerfomed1" name="Perfomed">
            <label class="form-check-label" for="exampleCheck1">Выполнено</label>
          </div>
          <div type="submit" name="editTask" class="btn btn-primary">Submit</div>
        </form>
      </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>