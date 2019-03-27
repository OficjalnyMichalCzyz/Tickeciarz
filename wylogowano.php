<?php
session_start();
session_unset();
session_destroy();
If(session_status() == "1"){
echo "Wylogowano pomyślnie.";
} else {
  echo "Wystąpił błąd podczas wylogowywania.<br />";
}
 ?>
 <a href="index.php">Strona główna</a>
