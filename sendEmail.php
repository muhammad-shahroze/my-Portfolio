<?php

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['name']) && isset($_POST['email'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $body = $_POST['body'];

  require_once "PHPMailer/PHPMailer.php";
  require_once "PHPMailer/SMTP";
  require_once "PHPMailer/Exception";

  $email = new PHPMailer();

  //smtp settings 
  $mail->isSMTP();
  $mail->Host = "smtp.gmail.com";
  $mail->SMTPAuth = true;
  $mail->username = "youremail@gmail.com";
  $mail->Password = "yourpassword";
  $mail->Port = 465;
  $mail->SMTPSecure = "ssl";

  //email settings 
  $mail->isHTML(true);
  $mail->setFrom($email, $name);
  $mail->addAddress("youremail@gmail.com");
  $mail->Subject = ("$email ($subject)");
  $mail->Body = $body;

  if ($mail->send()) {
    $status = "success";
    $response = "Email is sent!";
  } else {
    $status = "failed";
    $response = "Something is wrong: <br>" . $mail->ErrorInfo;
  }

  exit(json_encode(array("status" => $status, "response" => $response)));
}