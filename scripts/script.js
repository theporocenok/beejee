$(document).ready(function () {
  //Обработка нажатия на кнопку переключения страницы
  $('.page-item').click(function(){
    if($(".page-item.active")[0].id!=this.id){
      
      $(".page-item.active").removeClass("active");
      $(".pagination").find("#"+this.id).addClass("active");

      //Проверяем, есть ли сортировка на данный момент
      var parameter="0";
      var direction="";
      if($("th i").hasClass("show")){
        parameter=$("th i.show").parent().attr("id");
        direction=($("th i.show").hasClass("fa-arrow-up"))?"up":"down";
      }

      var toSend= {
        "page":this.id,
        "parameter":parameter,//Найти, есть ли сортировка
        "direction":direction//Найти направление сортировки, если есть
      };
      
      $.ajax({
        type: "GET",
        url: "http://tasks/taskMethods/showTasks.php",
        
        data: toSend,
        success: function(msg){
          $("tbody tr").detach();
          $(msg).appendTo("tbody");
        },
        error: function(e){
          console.log("Ошибка: "+e);
        }
      });
    }
    
  });

  //Обработка сортировки
  $('th').click(function(){
    var direction="down";
    if($("th#"+this.id+" i.fa-arrow-down").hasClass("show")){
      direction="up";
    }
    $("th i").removeClass("show");
    $("th#"+this.id+" i.fa-arrow-"+direction).addClass("show");

    
    var toSend={
      "parameter":this.id,
      "direction":direction
    };
    
    $.ajax({
      type: "GET",
      url: "http://tasks/taskMethods/sortTasks.php",
      data: toSend,
      success: function(msg){
        console.log("Msg: "+msg);
        $("tbody tr").detach();
        $(msg).appendTo("tbody");
        $(".page-item.active").removeClass("active");
        $(".pagination").find("#0").addClass("active");
      },
      error: function(e){
        console.log("Error: "+e);
      }
    });
  });

  //Закрыть всплывающее окно
  $(".close").click(function(){
    $("div").removeClass("overlay");
  });


  //Окно авторизации
  $("#auth").click(function(){
    $(".auth").addClass("overlay");
  });


  //Авторизация
  $("#authForm .btn").click(function(){
    var toSend={
      "data":$(this).parent().serialize()
    };
    $.ajax({
      type: "POST",
      url: "http://tasks/auth.php",
      data: toSend,
      success: function(msg){
        var arr=jQuery.parseJSON(msg);
        if(arr["status"]=="success"){
          alert("Добро пожаловать!")
          window.location.reload();
        }else{
          $(".auth__error").addClass("show");
        }
      },
      error: function(e){
        //console.log(e);
      }
    });

    //console.log(toSend);
  });

  //Выход
  $("#unauth").click(function(){
    //console.log("clicked");
    $.ajax({
      type: "POST",
      url: "http://tasks/unauth.php",
      success: function(msg){
        //console.log(msg);
        window.location.reload();
      },
      error: function(e){
        
      }
    });

  });


  //Окно создания задачи
  $("#createTask").click(function(){
    $(".createTask").addClass("overlay");
  });

  //Отправка задачи
  $("#createTaskForm .btn").click(function(){
    
    var toSend={
      "createTask":true,
      "data":$(this).parent().serialize()
    };

    $.ajax({
      type: "POST",
      url: "http://tasks/taskMethods/createTask.php",
      data: toSend,
      success: function(msg) {
        var arr=jQuery.parseJSON(msg);
        if(arr["status"]=="success"){
          alert("Задача успешно добавлена!")
          //$("div").removeClass("overlay");
          window.location.reload();
        }else{
          $("#createTaskForm div span").removeClass("show");

          if(arr["data"]["username"]){
            $("#createTaskForm div span.name").addClass("show");
          }
          if(arr["data"]["email"]){
            $("#createTaskForm div span.email").addClass("show");
          }
          if(arr["data"]["task"]){
            $("#createTaskForm div span.task").addClass("show");
          }
        }
      },
      error: function(e){
        console.log(e);
      }
    });
  });

  //Открыть окно изменения задачи
  $("tbody").on("click","tr", function(){
    $.ajax({
      type: "GET",
      url: "http://tasks/taskMethods/editTask.php",
      data: {"id":this.id},
      success:function(msg){
        //console.log(msg);
        var arr=jQuery.parseJSON(msg);
        if(arr["status"]=="success"){
          $("#editTaskForm .form-group div").filter(':first').attr("taskID",arr["task"]["id"]);
          $("#editTaskForm #editName1").attr("value",arr["task"]["username"]);
          $("#editTaskForm #editEmail1").attr("value",arr["task"]["email"]);
          $("#editTaskForm #editTask1").attr("value",arr["task"]["task"]);
          $("#editTaskForm #isPerfomed1").attr("checked",(arr["task"]["isPerfomed"]=="1")?true:false);
          $(".editTask").addClass("overlay");
        }else{
          alert("У вас недостаточно прав для данного действия");
        }
      },
      error: function(e){

      }
    });
  });


  //Отправить изменённую задачу
  $("#editTaskForm .btn").click(function(){
    var toSend={
      "editTask":true,
      "data":"id="+$("#editTaskForm .form-group div").filter(':first').attr("taskID")+"&"
      +$("#editTaskForm").serialize()
      +"&isPerfomed="+$("#editTaskForm #isPerfomed1").prop("checked")
    }
    //console.log(toSend);

    $.ajax({
      type: "POST",
      url: "http://tasks/taskMethods/editTask.php",
      data: toSend,
      success: function(msg) {
        //console.log(msg);
        var arr=jQuery.parseJSON(msg);
        if(arr["status"]=="success"){
          alert("Данные успешно обновлены");
          window.location.reload();
        }else{
          alert(arr["reason"]);
        }
      },
      error: function(e){
        console.log(e);
      }
    });
  });
});