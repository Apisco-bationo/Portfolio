<?php

  $receiving_email_address = 'bationoapisco5@gmail.com';

  $status = array(
    'type' => 'success',
    'message' => 'Message sent successfully'
  );

  if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
    $status = array(
      'type' => 'error',
      'message' => 'All fields are required'
    );
  } else {
    $message = "Name: " . $_POST['name'] . "\n";
    $message .= "Email: " . $_POST['email'] . "\n";
    if (isset($_POST['phone'])) {
      $message .= "Phone: " . $_POST['phone'] . "\n";
    }
    $message .= "Message:\n" . $_POST['message'];

    $headers = 'From: ' . $_POST['email'] . "\r\n" .
      'Reply-To: ' . $_POST['email'] . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

    if (!mail($receiving_email_address, $_POST['subject'], $message, $headers)) {
      $status = array(
        'type' => 'error',
        'message' => 'Email could not be sent'
      );
    }
  }

  echo json_encode($status);
?>
