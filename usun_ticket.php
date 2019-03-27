<?php require_once 'zmienne\zmienne_globalne.php'; ?>
<?php require_once 'zmienne\podlaczenie_do_bazy.php'; ?>
<?php require_once 'zmienne\dane_sesji.php'; ?>
<?php require_once 'zmienne\anty_pusta_sesja.php'; ?>
<?php require_once 'funkcje\funkcje.php'; ?>
<?php
if(isset($_POST["usunac"])){
  Pobierz_Uprawnienia_Zgloszenia($_GET['id']);
  Pobierz_Uprawnienia_Uzytkownika();
  Sprawdz_Uprawnienia($poziom_uprawnien_zgloszenia, $poziom_uprawnien_uzytkownika);
  $zapytanie = $login->prepare("DELETE FROM zgloszenia WHERE ID_inc = ?");
      $zapytanie->bind_param("s", $_GET["id"]);
      $sukces = $zapytanie->execute();
      $zapytanie->close();
        if($sukces == true){
            echo "<script>
            alert('Usunięto pomyślnie');
            </script>";
          }else{
            echo "<script>
            alert('Błąd podczas usuwania.')
            </script>";
          }
      echo "<script>window.location.href = '/zalogowano.php';</script>";
  exit();
}

if(isset($_GET["id"])){
  Pobierz_Uprawnienia_Uzytkownika();
  Pobierz_Uprawnienia_Zgloszenia($_GET["id"]);
  Sprawdz_Uprawnienia($poziom_uprawnien_zgloszenia, $poziom_uprawnien_uzytkownika);
echo "
<!DOCTYPE html> <html> <body> <form method='POST'> <h2>Usuwanie zgłoszenia.</h2> <div>
<input id='usunac' type='checkbox' name='usunac' placeholder='Czy usunąć?' disabled required>
<button style='width: 170px;'type='submit'>Usuń</button></form></body></html>";
echo "<script>var zgoda = confirm('Czy napewno chcesz usunąć to zgłoszenie?');
if(zgoda == true){document.getElementById('usunac').disabled = false;} else {
window.location.href = '/zalogowano.php';}</script>";
}else {
  echo "Nie wybrano ticketu.<br>";
  exit();
}
 ?>
