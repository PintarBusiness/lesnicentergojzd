<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ime = htmlspecialchars($_POST['ime'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefon = htmlspecialchars($_POST['telefon'] ?? '');
    $naslov = htmlspecialchars($_POST['naslov'] ?? '');
    $sporocilo = htmlspecialchars($_POST['sporocilo'] ?? '');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
        alert('Vnesi veljaven email naslov.');
        window.location.href='kontakt.html';
        </script>";
        exit;
    }

    $to = "info@pintsite.si";
    $subject = "Povpraševanje - Lensicenter Gojzd";

    $message = "Ime: $ime\r\n\r\n";
    $message .= "Email: $email\r\n\r\n";
    $message .= "Telefon: $telefon\r\n\r\n";
    $message .= "Naslov: $naslov\r\n\r\n";
    $message .= "---------------------\r\n\r\n";
    $message .= "Sporočilo:\r\n\r\n$sporocilo";

    $headers = "From: Novo povpraševanje/naročilo <info@pintsite.si>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "MIME-Version: 1.0\r\n";

    if (mail($to, $subject, $message, $headers)) {
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