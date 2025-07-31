<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Pobierz i zabezpiecz dane
    $service = htmlspecialchars(trim($_POST['service'] ?? ''));
    $date = htmlspecialchars(trim($_POST['date'] ?? ''));
    $time = htmlspecialchars(trim($_POST['time'] ?? ''));
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $notes = htmlspecialchars(trim($_POST['notes'] ?? ''));

    // Walidacja prostych warunków
    if (!$service || !$date || !$time || !$name || !$phone || !$email) {
        echo "<p style='color:red; text-align:center;'>Proszę wypełnić wszystkie wymagane pola.</p>";
        exit;
    }

    // Walidacja daty: data nie może być przeszła
    if ($date < date('Y-m-d')) {
        echo "<p style='color:red; text-align:center;'>Wybrano przeszłą datę.</p>";
        exit;
    }

    // Skonstruuj wiadomość
    $to = "igormaciaszek28@gmail.com";
    $subject = "Nowa rezerwacja wizyty w Shine Master";
    $message = "Nowa rezerwacja:\n\n";
    $message .= "Usługa: $service\n";
    $message .= "Data: $date\n";
    $message .= "Godzina: $time\n";
    $message .= "Imię i nazwisko: $name\n";
    $message .= "Telefon: $phone\n";
    $message .= "E-mail: $email\n";
    $message .= "Dodatkowe informacje: $notes\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Wyślij maila
    if (mail($to, $subject, $message, $headers)) {
        echo "<h2 style='color:#22c55e; text-align:center;'>Dziękujemy za rezerwację!</h2>";
        echo "<p style='text-align:center;'>Skontaktujemy się z Tobą wkrótce.</p>";
    } else {
        echo "<p style='color:#ef4444; text-align:center;'>Wystąpił błąd podczas wysyłania maila. Spróbuj ponownie.</p>";
    }
} else {
    header("Location: rezerwacja.html");
    exit;
}
?>
