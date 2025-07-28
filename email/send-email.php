<?php
header('Content-Type: text/plain')

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
   http_response_code(405);
   echo 'Methode Not Allowed';
   exit;
}

// Validasi input
$required_fields = ['email', 'subject', 'message']
foreach ($required_fields as $field) {
  if (empty($_POST[$field])) {
    http_response_code(400);
    echo 'All fields are required';
    exit;
  }
}

$to = 'mrsonicx404@gmail.com'; // ganti dengan email penerima
$from = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
$subject = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

// Header untuk mencegah email masuk ke spam
$header = "From: $from\r\n";
$header .= "Reply-To: $from\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Kirim email
$mailSent = mail($to, $subject, $message, $header);

if ($mailSent) {
  echo 'Message successfully launched to the cosmos!';
} else {
  http_response_code(500);
  echo 'Failed to send message. Please try again later.';
}
?>