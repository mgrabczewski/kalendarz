<?php
function usun_zadanie($DAT, $conn){
  echo json_encode([ 'usun' => "OK" ]);
  $id_zadanie = $DAT['id_zadanie'];
    return $conn->query("DELETE FROM zadania WHERE id_zadanie = '".$id_zadanie."'");
}
 ?>
