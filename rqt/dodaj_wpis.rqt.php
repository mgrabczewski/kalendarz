<?php
function dodaj_wpis($DAT, $conn){
  $wszystkoOK = true;
  //$id_zadanie = $DAT['id_zadanie'];
  if (isset($DAT['id_zadanie'])) {
        $id_zadanie = $DAT['id_zadanie'];
    } else {
    }
  $task = $DAT['task'];
  $task_date = $DAT['date'];
  $task_time = $DAT['time'];
  $task_type = $DAT['typzadania'];
  $error = [];
  if(strlen($task) < 1)
  {
    $error['e_task'] = "To pole nie moze pozostać puste!";
    $wszystkoOK = false;
  }
  if(strlen($task_time) < 1)
  {
    $error['e_task_time'] = "Godzina musi zostać wprowadzona!";
    $wszystkoOK = false;
  }
  if(strlen($task_type) < 1)
  {
    $error['e_task_type'] = "Typ zadania musi być wprowadzony!";
    $wszystkoOK = false;
  }
  if(validateDate($task_date) == false)
  {
    $error['e_task_date'] = "Nieprawidłowa data!";
    $wszystkoOK = false;
  }

  if($wszystkoOK == true)
  {
    if(isset($id_zadanie)){
      edytujZadanie($id_zadanie, $task_date, $task_time, $task, $task_type, $conn);
    } else {
      dodajWpis($task_date, $task_time, $task, $task_type, $conn);
    }
  }
  if(count($error)>0) echo json_encode([ 'wynik' => "error", 'errors' => $error ]);
  else echo json_encode([ 'wynik' => "OK" ]);
  $conn->close();
}
 ?>
