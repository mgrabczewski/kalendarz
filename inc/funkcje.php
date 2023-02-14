<?php
function dodajWpis($task_date = null, $task_time = null, $task = null, $task_type = null,  $conn = null){
  return $conn->query("INSERT INTO zadania (id_user, data, godzina, zadanie, typzadania) VALUES ('". $_SESSION['id_user'] ."', '". $task_date . "', '". $task_time ."', '" .$conn->real_escape_string($task). "', '".$task_type."')");
}
function validateDate($task_date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $task_date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $task_date;
}
function getWeekday($date) {
    return date('N', strtotime($date));
}
function getnameoftheday($date){
  $wynik = "";
  getWeekday($date);
  if(getWeekday($date) == 7) $wynik = "Niedziela";
  if(getWeekday($date) == 6) $wynik = "Sobota";
  if(getWeekday($date) == 5) $wynik = "Piątek";
  if(getWeekday($date) == 4) $wynik = "Czwartek";
  if(getWeekday($date) == 3) $wynik = "Środa";
  if(getWeekday($date) == 2) $wynik = "Wtorek";
  if(getWeekday($date) == 1) $wynik = "Poniedziałek";

  return $wynik;
}
function pokazzadanie($zadania){
  $wynik = "";
  foreach ($zadania as $key => $value) {
    $wynik.='<div data-id = "'.$zadania[$key]['id_zadanie'].'" class = "'.$zadania[$key]['typzadania'].'" style = "border: 1px solid #999; margin-top: 5px;">'.substr($zadania[$key]['godzina'], 0, 5)."  [ ".$zadania[$key]['zadanie']." ]". "</br></div>";
  }
  return $wynik;
}
function edytujZadanie($id_zadanie = null, $task_date = null, $task_time = null, $task = null, $task_type = null,  $conn = null){
  return $conn->query("UPDATE zadania SET data = ('".$task_date."'), godzina = ('".$task_time."'), zadanie = ('".$task."'), typzadania = ('".$task_type."') WHERE id_zadanie = ('".$id_zadanie."') AND id_user = ('". $_SESSION['id_user'] ."')");
}
 ?>
