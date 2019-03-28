<?php require_once 'zmienne\zmienne_globalne.php'; ?>
<?php require_once 'zmienne\podlaczenie_do_bazy.php'; ?>
<?php require_once 'zmienne\dane_sesji.php'; ?>
<?php require_once 'zmienne\anty_pusta_sesja.php'; ?>
<?php require_once 'funkcje\funkcje.php'; ?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="tabele.css">

<body>
<h1 style='text-align:center;'>ZGŁOSZENIA</h1>
<form method="POST">
  <div>
   </div>

  <button style="width: 170px;margin-left:45%;"type="submit">Odśwież</button>
</form>


  <?php
  Pobierz_Uprawnienia_Uzytkownika();
  $ilosc_wyswietlonych_zgloszen = 0;



  if ($zapytanie = $login->prepare("SELECT * FROM zgloszenia")){
      $zapytanie->execute();// ID     UPR    NAGL TRESC   MIEJS  KUT    WT     KPT    LSTMD
      $zapytanie->bind_result($kolumna1, $kolumna2, $kolumna3, $kolumna4, $kolumna5, $kolumna6, $kolumna7, $kolumna8, $kolumna9);
          while ($zapytanie->fetch()) {

            if($poziom_uprawnien_uzytkownika>=$kolumna2){
              echo "
              <div style='width:100%;height:30%;padding-bottom:20px;'>
              <div class='pojemnik_lewy'>
                </div>
              <div class='pojemnik_lewy'>
              <div class='ticket_lewy_10v5'>Numer incydentu: " . $kolumna1 . "</div>
              <div class='ticket_lewy_10v5'>Uprawnienia: " . $kolumna2 . "</div>
              <div class='ticket_lewy_10v5'>Klient: " . $kolumna7 . " </div>
              <div class='ticket_lewy_10v5'>Przypisany na: " . $kolumna8 . "</div>
              <div class='ticket_lewy_10v5'>Utworzony przez: " . $kolumna6 . "</div>
              <div class='ticket_lewy_10v5'>Miejsce: " . $kolumna5 . "</div>
              <div class='ticket_lewy_10v5'>Data ostatniej modyfikacji: " . $kolumna9 . "</div>
                </div>
              <div class='pojemnik_srodkowy'>
              <div class='ticket_srodkowy_100v10'><b>Nagłówek: " . $kolumna3 . " </b>  </div>
              <div class='ticket_srodkowy_80v25'><b>Treść: " . $kolumna4 . " </b>   </div>
                </div>
                <div class='pojemnik_lewy'>
                <div class='ticket_lewy_10v5'><a href=podglad.php?id=" . $kolumna1 . ">Edytuj</a></div>
                <div class='ticket_lewy_10v5'><a href=usun_ticket.php?id=" . $kolumna1 . ">Usuń</a></div>
                <div class='ticket_lewy_10v5'>Drukuj</div>
                  </div>
                  </div><br>
                  ";
                  $ilosc_wyswietlonych_zgloszen++;
                }


              }
                $zapytanie->close();}
echo "<br /><div style='text-align:center;'><h3>
Wyświetlono " . $ilosc_wyswietlonych_zgloszen . " zgłoszeń. <br />
<a href='dodaj_zgloszenie.php'>Dodaj zgłoszenie</a><br />
<a href='wylogowano.php'>Wyloguj</a></h3>
</div>";
?>
<script>
</script>"
</body>
</html>
