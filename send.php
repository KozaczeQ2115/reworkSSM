<!-- Backend HTML needs a server-side script like PHP -->
<form action="send.php" method="POST" class="space-y-6">
  <input type="text" name="name" placeholder="Twoje imię" required class="input-style" />
  <input type="email" name="email" placeholder="Twój e-mail" required class="input-style" />
  <textarea name="message" rows="5" placeholder="Wiadomość" required class="input-style"></textarea>
  <button type="submit" class="bg-yellow-500 hover:bg-yellow-400 text-black px-6 py-2 rounded-xl font-bold">Wyślij</button>
</form>

<!-- send.php (must be on a server supporting PHP) -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $message = htmlspecialchars($_POST['message']);

  $to = "igormaciaszek28@gmail.com";
  $subject = "Nowa wiadomość ze strony Shine Master";
  $headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";
  $body = "Imię: $name\nEmail: $email\n\nWiadomość:\n$message";

  if (mail($to, $subject, $body, $headers)) {
    echo "Wiadomość została wysłana.";
  } else {
    echo "Błąd podczas wysyłania wiadomości.";
  }
}
?>
