<?php
$isMailSent=false;
echo "<!-- inside php -->";
date_default_timezone_set('Etc/UTC');
if ( isset( $_POST['submit'] ) ) {
  echo "<!-- inside post php -->";
  require './PHPMailer/PHPMailerAutoload.php';
  $mail = new PHPMailer;
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->SMTPSecure = 'tls';
  $mail->SMTPAuth = true;
  $ini = parse_ini_file('config/config.ini');
  $mail->Username = $ini['user'];
  $mail->Password = $ini['password'];
  $mail->setFrom('abhishekverma3210@gmail.com', 'Abhishek Verma');
  $mail->addAddress($_POST['email'], $_POST['name']);
  $mail->addAddress('abhishekverma3210@gmail.com', 'Abhishek Verma');
  $mail->Subject = 'Received Message from ' . $_POST['name'];
  $mail->Body = $_POST['message'];
  if ($mail->send()) {
    echo "<!-- mail sent -->";
    $isMailSent = true;
    http_response_code(200);
  } else {
    echo "<!-- mail not sent -->";
    echo "<!--Mailer Error: " . $mail->ErrorInfo . "-->";
    http_response_code(500);
  }
} else {
  http_response_code(204);
}
?>