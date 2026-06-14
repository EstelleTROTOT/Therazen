<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    public function sendBookingConfirmation(array $booking): bool
    {
        $mail = new PHPMailer(true);
        $config = require __DIR__ . '/../config/mail.php';

        try {

            $mail->isSMTP();
            $mail->Host = $config['host'];
$mail->SMTPAuth = true;
$mail->SMTPDebug = 0;
$mail->Username = $config['username'];
$mail->Password = $config['password'];
$mail->Port = $config['port'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $mail->CharSet = 'UTF-8';

            $mail->setFrom(
    $config['from_email'],
    $config['from_name']
);
            $mail->addAddress($booking['email']);

            $consultation = $booking['type'] === 'consultation_video'
                ? 'Consultation vidéo'
                : 'Consultation à domicile';

            $mail->isHTML(true);
            $mail->Subject = 'Confirmation de votre rendez-vous TheraZen';

            $meetingBlock = '';

if (
    $booking['type'] === 'consultation_video'
    && !empty($booking['meeting_link'])
) {
    $meetingBlock = "
        <h3>Votre consultation vidéo</h3>

        <p>
            Merci de vous connecter <strong>5 minutes avant</strong>
            l'heure prévue de votre rendez-vous.
        </p>

        <p>
            <a href='{$booking['meeting_link']}'>
                Rejoindre la consultation vidéo
            </a>
        </p>

        <p>
            En cas de retard, la séance se terminera à l'heure
            initialement prévue afin de respecter les rendez-vous suivants.
        </p>

        <p>
            Pour toute difficulté :
            estelletherapies@gmail.com
        </p>
    ";
}

$mail->Body = "
    <h2>Votre rendez-vous est confirmé 🌿</h2>

    <p>Bonjour {$booking['firstname']} {$booking['lastname']},</p>

    <p>Merci pour votre confiance.</p>

    <ul>
        <li><strong>Consultation :</strong> {$consultation}</li>
        <li><strong>Date :</strong> {$booking['date']}</li>
        <li><strong>Créneau :</strong> {$booking['slot']}</li>
    </ul>

    {$meetingBlock}

    <p>Nous vous remercions pour votre réservation.</p>

    <p>L'équipe TheraZen</p>
";

            return $mail->send();

        } catch (Exception $e) {
    error_log('Erreur MailService : ' . $mail->ErrorInfo);
    return false;
}
    }
}