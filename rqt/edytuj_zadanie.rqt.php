<?php
function edytuj_zadanie($DAT, $conn){
  //echo json_encode([ 'edycja' => "OK" ]);
  $id_zadanie = $DAT['id_zadanie'];
  $result = $conn->query("SELECT data, godzina, zadanie, typzadania FROM zadania WHERE id_zadanie = '".$id_zadanie."'");
  while ($row = $result->fetch_assoc()) {
    echo json_encode($row);
  };
};
 ?>
