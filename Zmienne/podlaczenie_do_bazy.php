<?php
$login = new mysqli($server_ip, $admin_login, $admin_haslo, $admin_baza);
$login;
session_start();
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. <br />";
    echo "Debugging errno: " . mysqli_connect_errno() . "<br />";
    echo "Debugging error: " . mysqli_connect_error() . "<br />";
    exit(1);
}
echo "Zalogowano oraz podłączono do " . $admin_baza . "<br />";
echo mysqli_get_host_info($login) . "<br />";
if (!$login->set_charset("utf8mb4")){
    echo "Błąd podczas ładowania tablicy kodowej utf8mb4: " . $login->error;
    exit();
} else {
    echo "Aktualna strona kodowa: " . $login->character_set_name() . "<br />";
}
$zapytanie = $login->prepare("SELECT token_sesji, adres_ip_uzytkownika FROM uzytkownicy WHERE token_sesji = ?");
    $zapytanie->bind_param("s", $_SESSION["wygenerowany_token"]);
    $zapytanie->execute();
    $zapytanie->bind_result($porownawczy_token, $porownawcze_ip);
    $zapytanie->fetch();
    $zapytanie->close();
    //echo $_SESSION["wygenerowany_token"] . $porownawczy_token . $_SESSION["ip"] . $porownawcze_ip;
    if(isset($_SESSION["wygenerowany_token"]) && isset($_SESSION["ip"])){
    if($porownawcze_ip != $_SESSION["ip"]){echo "Sesja wygasła"; exit();}
    if($porownawczy_token != $_SESSION["wygenerowany_token"]){echo "Sesja wygasła"; exit();}
    if($porownawcze_ip == "brak"){echo "Sesja wygasła"; exit();}
    if($porownawczy_token == "brak"){echo "Sesja wygasła"; exit();}
  }

?>
<?php require_once 'konsola\konsola.php'; ?>
