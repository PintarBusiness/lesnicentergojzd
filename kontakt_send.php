<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ime = htmlspecialchars($_POST['ime']);
    $email = htmlspecialchars($_POST['email']);
    $telefon = htmlspecialchars($_POST['telefon']);
    $naslov = htmlspecialchars($_POST['naslov']);
    $sporocilo = htmlspecialchars($_POST['sporocilo']);

    $to = "jure.pintar9@gmail.com";
    $subject = "Novo sporočilo s spletne strani";

    $message = "
Ime: $ime

Email: $email

Telefon: $telefon

Naslov: $naslov

---------------------

Sporočilo:

$sporocilo
";

    $headers = "From: no-reply@tvojadomena.si\r\n";
    $headers .= "Reply-To: $email\r\n";

    if(mail($to, $subject, $message, $headers)){
        echo "<script>
        alert('Sporočilo poslano.');
        window.location.href='kontakt.html';
        </script>";
    } else {
        echo "<script>
        alert('Napaka pri pošiljanju.');
        window.location.href='kontakt.html';
        </script>";
    }

}

?>