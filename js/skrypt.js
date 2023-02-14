$(function() {
  $( "#dialog-form" ).dialog({
      title: "Dodaj zadanie!",
      autoOpen: false,
      height: 500,
      width: 350,
      modal: true,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
          effect: "blinde",
          duration: 1000
        },
      buttons: {
      "Zapisz": function(){
        $.ajax({
          url: "http://localhost/skrypty/kalendarz/plan.php",
          method: "POST",
          dataType: "json",
          data: {
            rqt: "dodaj_wpis",
            task: $( "input[name='task']" ).val(),
            time: $( "input[name='time']" ).val(),
            date: $( "input[name='date']" ).val(),
            typzadania: $("div.typzadania select").val(),
          },
          error: function(){alert("Wystąpił błąd")},
          success: function(a, b){
            if (a.wynik == "OK") {
              $( "#dialog-message" ).dialog({
                  modal: true,
                  buttons: {
                    Ok: function() {
                      $( this ).dialog( "close" );
                      window.location.reload();
                    }
                  }
                });
            }
            else if (a.wynik == "error") {
              if (typeof a.errors.e_task != "undefined"){
               document.getElementById("dialog-error1").style.display="";
               $('#dialog-error1').empty().append(a.errors.e_task);
             } else{
               document.getElementById("dialog-error1").style.display="none";
             }
              if (typeof a.errors.e_task_date != "undefined"){
               document.getElementById("dialog-error2").style.display="";
               $('#dialog-error2').empty().append(a.errors.e_task_date);
             } else{
               document.getElementById("dialog-error2").style.display="none";
             }
              if (typeof a.errors.e_task_time != "undefined"){
               document.getElementById("dialog-error3").style.display="";
               $('#dialog-error3').empty().append(a.errors.e_task_time);
             } else{
               document.getElementById("dialog-error3").style.display="none";
             }
             if (typeof a.errors.e_task_type != "undefined"){
              document.getElementById("dialog-error4").style.display="";
              $('#dialog-error4').empty().append(a.errors.e_task_type);
            } else{
              document.getElementById("dialog-error4").style.display="none";
            }
            }
            else {
            }
          }
      });
        },
        Cancel: function() {
          $( "#dialog-form" ).dialog( "close" );
        }
      },
      close: function() {
      }
    });
  $("#nowezadanie").click(function(){
    $('#dialog-form').dialog('option', 'title', 'Dodaj nowe zadanie!');
    $( "input[name='task']" ).val("");
    $( "input[name='time']" ).val("");
    $( "input[name='date']" ).val("");
    document.getElementById("dialog-error1").style.display="none";
    document.getElementById("dialog-error2").style.display="none";
    document.getElementById("dialog-error3").style.display="none";
    document.getElementById("dialog-error4").style.display="none";
    $( "#dialog-form" ).dialog( "open" );
  });
  $(".rozrywka, .praca, .nauka, .sport").click(function(){
    document.getElementById("dialog-error1").style.display="none";
    var id_zadanie = $(this).data("id");
    $.ajax({
      url: "http://localhost/skrypty/kalendarz/plan.php",
      method: "POST",
      dataType: "json",
      data: {
        rqt: "edytuj_zadanie",
        id_zadanie: $(this).data("id"),
      },
      success: function(a, b){
        $( "input[name='task']" ).val(a.zadanie);
        $( "input[name='time']" ).val(a.godzina);
        $( "input[name='date']" ).val(a.data);
        $("div.typzadania select").val(a.typzadania);
      }
  });
    //alert("edycjaaa");
    $('#dialog-form').dialog('option', 'title', 'Edytuj zadanie!');
    $( "#dialog-form" ).dialog({
    buttons: [
      {
        text: "Zapisz",
        click: function() {
        //alert("ezzzzzz");
        $.ajax({
          url: "http://localhost/skrypty/kalendarz/plan.php",
          method: "POST",
          dataType: "json",
          data: {
            rqt: "dodaj_wpis",
            id_zadanie: id_zadanie,
            task: $( "input[name='task']" ).val(),
            time: $( "input[name='time']" ).val(),
            date: $( "input[name='date']" ).val(),
            typzadania: $("div.typzadania select").val(),
          },
          error: function(){alert("Wystąpił błąd")},
          success: function(a, b){
            if (a.wynik == "OK") {
              //$("#" + id_zadanie).css('background-color', 'blue');
              $( "#dialog-message-edycja" ).dialog({
                  modal: true,
                  buttons: {
                    Ok: function() {
                      $( this ).dialog( "close" );
                      window.location.reload();
                    }
                  }
                });
            }
            else if (a.wynik == "error") {
              if (typeof a.errors.e_task != "undefined"){
               document.getElementById("dialog-error1").style.display="";
               $('#dialog-error1').empty().append(a.errors.e_task);
             } else{
               document.getElementById("dialog-error1").style.display="none";
             }
              if (typeof a.errors.e_task_date != "undefined"){
               document.getElementById("dialog-error2").style.display="";
               $('#dialog-error2').empty().append(a.errors.e_task_date);
             } else{
               document.getElementById("dialog-error2").style.display="none";
             }
              if (typeof a.errors.e_task_time != "undefined"){
               document.getElementById("dialog-error3").style.display="";
               $('#dialog-error3').empty().append(a.errors.e_task_time);
             } else{
               document.getElementById("dialog-error3").style.display="none";
             }
            }
            else {
            }
          }
        });
        }
      },
      {
        text: "Cancel",
        click: function() {
          $( "#dialog-form" ).dialog( "close" );
        }
      }
    ]
  });
    $( "#dialog-form" ).dialog( "open" );
  });
  $(".rozrywka, .praca, .nauka, .sport").mousedown(function(event) {
    switch (event.which) {
    case 3:
    var element = $(this);
    var id_zadanie = $(this).data("id");
    $( "#dialog-message-usuwanie" ).dialog({
      title: "Usuń zadanie!",
      height: 300,
      width: 350,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
          effect: "blinde",
          duration: 1000
        },
      buttons : {
        "TAK" : function(){
          $.ajax({
            url: "http://localhost/skrypty/kalendarz/plan.php",
            method: "POST",
            dataType: "json",
            data: {
              rqt: "usun_zadanie",
              id_zadanie: id_zadanie
            },
            });
            element.remove();
            $( "#dialog-message-usuwanie" ).dialog( "close" );
          },
        "NIE" : function(){
          $( "#dialog-message-usuwanie" ).dialog( "close" );
        },
      },
    });
  }
});
$( "#dialog-form-wybierzdate" ).dialog({
    title: "Wybierz datę!",
    autoOpen: false,
    height: 400,
    width: 350,
    modal: true,
    show: {
      effect: "blind",
      duration: 1000
    },
    hide: {
        effect: "blinde",
        duration: 1000
      },
    buttons: {
    "Zapisz": function(){
      if($( "input[name='wybranadata']" ).val() == null || $( "input[name='wybranadata']" ).val() == ""){
        document.getElementById("dialog-error5").style.display="";
    } else{
      document.location.href='plan.php?rqt=kalendarz&data=' + $( "input[name='wybranadata']" ).val();
    }
      },
      Cancel: function() {
        $( "#dialog-form-wybierzdate" ).dialog( "close" );
      }
    },
    close: function() {
    }
  });
  $("#wybierzdate").click(function(){
    document.getElementById("dialog-error5").style.display="none";
    $('#dialog-form-wybierzdate').dialog("open");
    });
$("#wylogowywanie").click(function(){
  window.location.href = "wylogowywanie.php";
  });
  $( "#dialog-form-newuser" ).dialog({
      title: "Zarejestruj się!",
      autoOpen: false,
      height: 400,
      width: 350,
      modal: true,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
          effect: "blinde",
          duration: 1000
        },
      buttons: {
      "Zarejestruj się.": function(){
          if($( "input[name='newuser']" ).val() == null || $( "input[name='newuser']" ).val() == "" || $( "input[name='newpassword']" ).val() == null || $( "input[name='newpassword']" ).val() == ""){
            document.getElementById("dialog-error6").style.display="";
        } else{
          $.ajax({
            url: "http://localhost/skrypty/kalendarz/plan.php",
            method: "POST",
            dataType: "json",
            data: {
              rqt: "dodaj_user",
              newuser: $( "input[name='newuser']" ).val(),
              newpassword: $( "input[name='newpassword']" ).val(),
            },
            });
        }
        $( "#dialog-form-newuser" ).dialog( "close" );
        },
        Cancel: function() {
          $( "#dialog-form-newuser" ).dialog( "close" );
        }
      },
      close: function() {
      }
    });
$('#zarejestruj').click(function(){
  document.getElementById("dialog-error6").style.display="none";
  $( "input[name='newuser']" ).val("");
  $( "input[name='newpassword']" ).val("");
  $("#dialog-form-newuser").dialog("open");
});
});
