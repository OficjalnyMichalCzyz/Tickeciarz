<?php
echo "Zalogowano z tokenem: " . $_SESSION["wygenerowany_token"] . ".<br />";
echo "Zalogowano z IP: " . $_SESSION["ip"] . ".<br />";
echo "Zalogowano jako " . $_SESSION["nick"] . ".<br />";
echo "ID użytkownika to " . $_SESSION["id"] . "<br />";
echo "ID sesji to: " . session_id() . ".<br />";
echo "<hr />";

 ?>
