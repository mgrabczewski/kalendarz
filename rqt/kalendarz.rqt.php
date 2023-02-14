<?php
function kalendarz($conn){
  $datadzis = date('Y-m-d');
  if (isset($_GET['reset'])) {
    $_GET['data'] = date('Y-m-d');
    list($Y, $m, $d) = explode('-', date('Y-m-d'));
  }
  else if (isset($_GET['data'])) {
    list($Y, $m, $d) = explode('-', $_GET['data']);
  }
  else if(isset($_GET['wybranadata'])) {
    $_GET['data'] = $_GET['wybranadata'];
    list($Y, $m, $d) = explode('-', $_GET['data']);
  }
  else{
    $_GET['data'] = date('Y-m-d');
    list($Y, $m, $d) = explode('-', date('Y-m-d'));
  }
  $dataplus = date('Y-m-d', mktime(0, 0, 0, intval($m, 10), intval($d, 10) + 7, intval($Y, 10)));
  $dataminus = date('Y-m-d', mktime(0, 0, 0, intval($m, 10), intval($d, 10) - 7, intval($Y, 10)));

  getWeekday($_GET['data']);
  $datastart = date('Y-m-d', mktime(0, 0, 0, intval($m, 10), intval($d, 10) - getWeekday($_GET['data']) + 1, intval($Y, 10)));
  $dataend = date('Y-m-d', strtotime($datastart . ' +6 day'));

  //echo "Witaj ". $_SESSION['user'];

  $zapytanie = "SELECT * FROM `zadania` WHERE `id_user` = ('".$_SESSION['id_user']."') AND `data` BETWEEN '".$datastart."' AND '".$dataend."' ORDER BY `data` ASC, `godzina` ASC";
  $result = $conn->query($zapytanie);
  $rekordy = [];
  for($g = 0; $g <= 23; $g++) {
    if($g<=9){
      $rekordy["0". $g] = [];
    }else{
  $rekordy[$g] = [];
  }
}
  while ($row = $result->fetch_assoc()) {
    $rekordy[substr($row['godzina'], 0, 2)][getWeekday($row['data'])][] = $row;
  }
  $conn->close();

  echo "<pre>";
  //print_r ($rekordy);
  echo "</pre>";
  include('html/plan.html.php');
}
?>
