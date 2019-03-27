<?php require_once 'zmienne\zmienne_globalne.php'; ?>
<?php require_once 'zmienne\podlaczenie_do_bazy.php'; ?>
<?php require_once 'zmienne\dane_sesji.php'; ?>
<?php require_once 'zmienne\anty_pusta_sesja.php'; ?>
<?php require_once 'funkcje\funkcje.php'; ?>
<!DOCTYPE html>
 <html>
 <link rel="stylesheet" type="text/css" href="tabele.css">
 <body>
<?php
if(isset($_POST['klient']) || isset($_POST['przypisany_na']) || isset($_POST['miejsce']) || isset($_POST['naglowek']) || isset($_POST['tresc'])){
  Pobierz_Uprawnienia_Uzytkownika();
  Pobierz_Uprawnienia_Zgloszenia($_GET["id"]);
  Sprawdz_Uprawnienia($poziom_uprawnien_zgloszenia, $poziom_uprawnien_uzytkownika);
  $zapytanie = $login->prepare("UPDATE zgloszenia SET naglowek = ?, tresc = ?, miejsce = ?, kto_pracuje_nad_ticketem = ?, klient = ?, WHERE nazwa_uzytkownika = ?");
      $zapytanie->bind_param("ssss", $wygenerowany_token, $data, $ip_uzytkownika, $wpisany_login);
      $zapytanie->execute();
      $zapytanie->close();
}

if(isset($_GET["id"])){
  Pobierz_Uprawnienia_Uzytkownika();
  Pobierz_Uprawnienia_Zgloszenia($_GET["id"]);
  Sprawdz_Uprawnienia($poziom_uprawnien_zgloszenia, $poziom_uprawnien_uzytkownika);
  $zapytanie = $login->prepare("SELECT * FROM zgloszenia WHERE ID_inc = ?");
      $zapytanie->bind_param("s", $_GET['id']);
      $zapytanie->execute();// ID     UPR    NAGL TRESC   MIEJS  KUT    WT     KPT    LSTMD
      $zapytanie->bind_result($kolumna1, $poziom_uprawnien_zgloszenia, $kolumna3, $kolumna4, $kolumna5, $kolumna6, $kolumna7, $kolumna8, $kolumna9);
      $zapytanie->fetch();
            if($poziom_uprawnien_uzytkownika>=$poziom_uprawnien_zgloszenia){
              echo "
              <div style='width:100%;height:30%;padding-bottom:20px;'>
              <div class='pojemnik_lewy'>
              <div style='background-color:#85C1E9;' class='ticket_lewy_10v5'>Nagłówek: </div>
              <div style='background-color:#85C1E9;' class='ticket_lewy_10v5'>Treść: </div>
                </div>
              <div class='pojemnik_srodkowy'>
              <b><div style='background-color:#AED6F1;' id='tresc_wpisana' class='ticket_srodkowy_100v10' contentEditable=true>" . $kolumna3 . "</div>
              <div style='background-color:#AED6F1;' id='naglowek_wpisany' class='ticket_srodkowy_80v25' contentEditable=true>" . $kolumna4 . "</div></b>
                </div>
                <div class='pojemnik_lewy'>
                <div style='background-color:#85C1E9;' class='ticket_lewy_10v5'>Numer incydentu:</div>
                <div style='background-color:#85C1E9;' class='ticket_lewy_10v5'>Uprawnienia:</div>
                <div style='background-color:#85C1E9;' class='ticket_lewy_10v5'>Klient:</div>
                <div style='background-color:#85C1E9;' class='ticket_lewy_10v5'>Przypisany na:</div>
                <div style='background-color:#85C1E9;' class='ticket_lewy_10v5'>Utworzony przez:</div>
                <div style='background-color:#85C1E9;' class='ticket_lewy_10v5'>Miejsce:</div>
                <div style='background-color:#85C1E9;' class='ticket_lewy_10v5'>Data ostatniej modyfikacji:</div>
                  </div>
                <div class='pojemnik_lewy'>
                <div class='ticket_lewy_10v5' style='background-color:silver;'>" . $kolumna1 . "</div>
                <div class='ticket_lewy_10v5' style='background-color:silver;'>" . $poziom_uprawnien_zgloszenia . "</div>
                <div class='ticket_lewy_10v5' id='klient_wpisany' style='background-color:#AED6F1;' contentEditable=true>" . $kolumna7 . " </div>
                <div class='ticket_lewy_10v5' id='przypisany_wpisany' style='background-color:#AED6F1;' contentEditable=true>" . $kolumna8 . "</div>
                <div class='ticket_lewy_10v5' style='background-color:silver;'>" . $kolumna6 . "</div>
                <div class='ticket_lewy_10v5' id='miejsce_wpisany' style='background-color:#AED6F1;' contentEditable=true>" . $kolumna5 . "</div>
                <div class='ticket_lewy_10v5' style='background-color:silver;'>" . $kolumna9 . "</div>
                  </div>
                  </div><br>
                  ";
                $zapytanie->close();
                }
              }else {
                  echo "Nie wybrano ticketu.<br>";
                  exit();
                }
?>
<script>
function Przeladuj_dane(){
document.getElementById('klient').value = document.getElementById('klient_wpisany').innerHTML;
document.getElementById('przypisany_na').value = document.getElementById('przypisany_wpisany').innerHTML;
document.getElementById('miejsce').value = document.getElementById('miejsce_wpisany').innerHTML;
document.getElementById('naglowek').value = document.getElementById('naglowek_wpisany').innerHTML;
document.getElementById('tresc').value = document.getElementById('tresc_wpisana').innerHTML;
}



</script>
                <form style="margin-left:35%;" method='POST'>
                  <input type='hidden' id='klient' name='Klient'>
                  <input type='hidden' id='przypisany_na' name='Przypisany_na'>
                  <input type='hidden' id='miejsce' name='Miejsce'>
                  <input type='hidden' id='data_modyfikacji' name='Data_modyfikacji'>
                  <input type='hidden' id='naglowek' name='Naglowek'>
                  <input type='hidden' id='tresc' name='Tresc'>
                  <h3>Zatwierdź modyfikacje</h3>
                  <button style='width: 170px;'type='submit'>Zatwierdź</button>
                </form>
                  <br />
                  <a style="margin-left:35%;" href='../zalogowano.php'>Powrót</a>
