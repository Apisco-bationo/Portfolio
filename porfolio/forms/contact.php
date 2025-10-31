<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';


header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $subject === '' || $message === '') {
        echo json_encode(['type' => 'error', 'message' => 'Tous les champs sont obligatoires.']);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bationoapisco5@gmail.com'; 
        $mail->Password = 'lemc zrhj xgbq acjj'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Expéditeur et destinataire
        $mail->setFrom($email, $name);
        $mail->addAddress('bationoapisco5@gmail.com', 'Bationo Epiphane');

        // Contenu du mail
        $mail->isHTML(true);
        $mail->Subject = "Nouveau message depuis le portfolio : $subject";
        $mail->Body = "
            <h3>Nouveau message depuis le formulaire de contact</h3>
            <p><strong>Nom :</strong> $name</p>
            <p><strong>Email :</strong> $email</p>
            <p><strong>Message :</strong><br>$message</p>
        ";

        $mail->AltBody = "Nom: $name\nEmail: $email\nMessage:\n$message";

        $mail->send();
        echo json_encode([
            'type' => 'success',
            'message' => 'Merci pour votre message !',
            'details' => 'Nous avons bien reçu votre message et nous vous répondrons dans les plus brefs délais.'
        ]);
          } catch (Exception $e) {
        echo json_encode([
            'type' => 'error',
            'message' => 'Oops ! Une erreur est survenue lors de l\'envoi du message.',
            'details' => "Nous n'avons pas pu envoyer votre message. Veuillez réessayer plus tard."
        ]);
          }
      } else {
          echo json_encode([
        'type' => 'error',
        'message' => 'Action non autorisée ⚠️',
        'details' => 'La méthode utilisée n\'est pas valide.'
          ]);
      }
      ?>
