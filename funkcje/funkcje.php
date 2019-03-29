<?php
function Pobierz_Uprawnienia_Uzytkownika(){
  Global $login, $poziom_uprawnien_uzytkownika;
  $zapytanie = $login->prepare("SELECT poziom_uprawnien FROM uzytkownicy WHERE token_sesji = ?");
      $zapytanie->bind_param("s", $_SESSION["wygenerowany_token"]);
      $zapytanie->execute();
      $zapytanie->bind_result($poziom_uprawnien_uzytkownika);
      $zapytanie->fetch();
      $zapytanie->close();
      //echo "Pobrane uprawnienia użytkownika to: " . $poziom_uprawnien_uzytkownika . ". <br>";
}
function Pobierz_Uprawnienia_Zgloszenia($ID_zgloszenia_Wew){
  Global $login, $poziom_uprawnien_zgloszenia;
  $zapytanie = $login->prepare("SELECT uprawnienia FROM zgloszenia WHERE ID_inc = ?");
      $zapytanie->bind_param("s", $ID_zgloszenia_Wew);
      $zapytanie->execute();
      $zapytanie->bind_result($poziom_uprawnien_zgloszenia);
      $zapytanie->fetch();
      $zapytanie->close();
      //echo "Pobrane uprawnienia zgłoszenia to: " . $poziom_uprawnien_zgloszenia . ". <br>";
}
function Sprawdz_Uprawnienia($poziom_uprawnien_zgloszenia, $poziom_uprawnien_uzytkownika){
  if($poziom_uprawnien_zgloszenia == null || $poziom_uprawnien_zgloszenia == ""){
  echo "Błąd krytyczny. Ticket nie ma przypisanych żadnych uprawnień lub nastąpiła awaria podczas ich pobierania.";
  exit();
  }
  if($poziom_uprawnien_uzytkownika == null || $poziom_uprawnien_uzytkownika == ""){
  echo "Błąd krytyczny. Użytkownik nie ma przypisanych żadnych uprawnień lub nastąpiła awaria podczas ich pobierania.";
  exit();
  }
  if($poziom_uprawnien_zgloszenia > $poziom_uprawnien_uzytkownika){
    echo "Brak dostępu. Skontaktuj się z administratorem.<br>";
    echo "<a href='zalogowano.php'>Powrót</a>";
    exit();
  } else {
  konsola("Wystarczające uprawnienia.", $tl = __LINE__, $tl . "/funkcje.php");
  konsola("Pobrane uprawnienia użytkownika to: " . $poziom_uprawnien_uzytkownika, $tl = __LINE__, $tl . "/funkcje.php");
  konsola("Pobrane uprawnienia zgłoszenia to: " . $poziom_uprawnien_zgloszenia, $tl = __LINE__, $tl . "/funkcje.php");
}}
 ?>
