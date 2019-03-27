<?php
if($_SESSION["wygenerowany_token"]==""){
  echo "Błąd sesji.<br>";
  exit();
}
if($_SESSION["ip"]==""){
  echo "Błąd sesji.<br>";
  exit();
}
?>
