<html lang="pl">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible"content="IE=edge,chrome=1"/>
  <title>Plan tygodnia</title>
  <link rel="stylesheet" href="http://localhost/skrypty/kalendarz/jquery/jquery-ui.min.css">
  <script src="http://localhost/skrypty/kalendarz/js/jquery-3.6.0.js"></script>
  <script src="http://localhost/skrypty/kalendarz/js/skrypt.js"></script>
  <script src="http://localhost/skrypty/kalendarz/jquery/jquery-ui.min.js"></script>
  <script src="http://localhost/skrypty/kalendarz/js/jquery-ui.js"></script>
  <link href="css/style.css" rel="stylesheet" type="text/css" />

</head>

<body>

<style type="text/css">

</style>

<button class = "button-59" id = "zarejestruj"> Zarejestruj się! </button>
<div id = "dialog-form-newuser">
  <input type="text" name="newuser">   <input type="password" name="newpassword">
  <div id="dialog-error6" style="color:red; display: none">
    <p>
      To pole nie może zostać puste!
    </p>
  </div>
</div>

<button class = "button-59" id = "wylogowywanie" style = "position: absolute; right: 10px;"> Wyloguj się!</button>
<div style = "padding-top: 50px;">
<table class="tg">
<thead>
  <tr>
    <th colspan="2">
    <button class = "button-59" value="dataend" onclick="javascript:document.location.href='plan.php?rqt=kalendarz&data=<?=$dataminus?>';">Poprzedni tydzien!</button>
    </th>
    <th colspan="2">
      <button class = "button-59" id = "nowezadanie"> Dodaj zadanie!</button>
    </th>
    <th colspan="2">
      <button class = "button-59" id = "wybierzdate"> Wybierz datę!</button>
      <button class = "button-59" value="reset" onclick="javascript:document.location.href='plan.php?rqt=kalendarz&reset';">Obecny tydzień!</button>
    </th>
    <th colspan="2">
      <button class = "button-59" value="datastart" onclick="javascript:document.location.href='plan.php?rqt=kalendarz&data=<?=$dataplus?>';">Następny tydzien!</button>
    </th>
  </tr>
  <tr>
    <th colspan="0"></th>
    <?php
    $k = 0;
    $currentmonth = date("F",strtotime($datastart));
    list($Y, $m, $d) = explode('-', $datastart);
    for($i = 0; $i < 7; $i++){
      $datax = date('Y-m-d', mktime(0, 0, 0, intval($m, 10), intval($d, 10) + $i, intval($Y, 10)));
      $checkmonth = date("F",strtotime($datax));
      if($checkmonth == $currentmonth){
        $k = $k + 1;
        if($k == 7){
          echo "<th class = 'tg-0pky' colspan = ".$k.">". $currentmonth ."</th>";
        }
      }
      else
      {
        //echo $checkmonth;
        echo "<th class = 'tg-0pky' colspan = ".$k.">". $currentmonth ."</th>";
        $currentmonth = $checkmonth;
        $k = 1;
        $stan = true;
      }
      //echo $currentmonth, $i;
    }
    if(isset($stan)) echo "<th class = 'tg-0pky' colspan = ".$k.">". $currentmonth ."</th>";
     ?>
  </tr>
<tr>
  <th class="tg-0lax">Godzina</th>
  <?php
  list($Y, $m, $d) = explode('-', $datastart);
  for($i = 0; $i < 7; $i++){
    $data = date('Y-m-d', mktime(0, 0, 0, intval($m, 10), intval($d, 10) + $i, intval($Y, 10)));
    if ($data == $datadzis){
      $style = 'style="color: red"';
    } else{
      $style = "";
    }
  ?>
  <th class="tg-84g4" <?=$style?>> <?=getnameoftheday($data)."</br>".$data ?></th>
  <?php
  }
  ?>
</tr>
</thead>
<tbody>
<?php
foreach ($rekordy as $godzina => $dni) {
?>
<tr>
  <td><?=$godzina?></td>
<?php
for($i = 1; $i <=7; $i++){
  //error_log();
?>
  <td> <?php if(isset($dni[$i])){?><?=pokazzadanie($dni[$i])?><?php } ?></td>
<?php
}
?>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
<div id="dialog-message-usuwanie" style = "display:none">
  <p>
    Czy jesteś pewny/pewna, że chcesz usunąć to zadanie?
  </p>
</div>
<div id="dialog-message-edycja" style = "display:none">
  <p>
    Edycja zakończona.
  </p>
</div>
<div id="dialog-message" title="Status" style = "display:none">
  <p>
    <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
    Dodawanie zakończone.
  </p>
</div>
  <div id = "dialog-form">

      <input type="hidden" name="rqt" value="dodaj_wpis">
      <br /><input type="text"name="task"/><br/>
      <div id = "dialog-error1" style="color:red" style="display:none"></div>
      <input type="date" name="date">   <input type="time" name="time">
      <div id = "dialog-error2" style="color:red" style="display:none"></div>
      <div id = "dialog-error3" style="color:red" style="display:none"></div>
      <div class = "typzadania">
        <select name="typzadania">
        <option disabled selected>---</option>
        <option value = "sport">Sport</option>
        <option value = "praca">Praca</option>
        <option value = "nauka">Nauka</option>
        <option value = "rozrywka">Rozrywka</option>
        </select>
        <div id = "dialog-error4" style="color:red" style="display:none"></div>
      </div>

  </div>
  <div id = "dialog-form-wybierzdate">

    <input type="date" name="wybranadata">
    <div id="dialog-error5" style="color:red; display: none">
      <p>
        Data musi zostać podana!
      </p>
    </div>
  </div>
</body>
</html>
