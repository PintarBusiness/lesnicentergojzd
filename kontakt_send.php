<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = htmlspecialchars($_POST['ime']);
    $email = htmlspecialchars($_POST['email']);
    $telefon = htmlspecialchars($_POST['telefon']);
    $naslov = htmlspecialchars($_POST['naslov']);
    $sporocilo = htmlspecialchars($_POST['sporocilo']);

    $mail = new PHPMailer(true);

    try {
        // SMTP nastavitve
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tvoj.gmail@gmail.com'; // Gmail
        $mail->Password = 'APLIKACIJSKO_GMAIL_PASSWORD'; // ne tvoj običajni password, ampak app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Prejemnik in pošiljatelj
        $mail->setFrom($email, $ime);
        $mail->addAddress('jure.pintar9@gmail.com', 'Jure Pintar');

        $mail->Subject = 'Novo sporočilo s spletne strani';
        $mail->Body = "Ime: $ime\nE-mail: $email\nTelefon: $telefon\nNaslov: $naslov\n\nSporočilo:\n$sporocilo";

        $mail->send();
        echo "<script>alert('Vaše sporočilo je bilo poslano. Hvala!'); window.location.href='kontakt.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Prišlo je do napake: {$mail->ErrorInfo}'); window.location.href='kontakt.html';</script>";
    }
} else {
    header("Location: kontakt.html");
    exit();
}
?>