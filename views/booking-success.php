<?php


$successBooking = $_SESSION['successBooking'] ?? null;
unset($_SESSION['successBooking']);

if (!$successBooking) {
    header('Location: ?page=home');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous confirmé - TheraZen</title>

    <link rel="stylesheet" href="/TheraZen/css/style.css?v=1000">
</head>

<body>

<div class="container booking-page">

    <div class="booking__steps">

        <div class="booking__step booking__step--done">
            <div class="booking__step-number">✓</div>
            <p>Type & Date</p>
        </div>

        <div class="booking__step booking__step--done">
            <div class="booking__step-number">✓</div>
            <p>Créneau horaire</p>
        </div>

        <div class="booking__step booking__step--done">
            <div class="booking__step-number">✓</div>
            <p>Vos informations</p>
        </div>

        <div class="booking__step booking__step--done">
            <div class="booking__step-number">✓</div>
            <p>Confirmation</p>
        </div>

    </div>

    <div class="booking__summary-card">

        <h2>Votre rendez-vous est confirmé 🌿</h2>

        <p class="booking__subtitle">
    Merci pour votre confiance.
    Votre rendez-vous a bien été enregistré et une confirmation vous sera envoyée par email.
</p>

        <div class="booking__summary-item">
            <strong>Consultation :</strong>
            <span>
    <?= isset($successBooking['type']) && $successBooking['type'] === 'consultation_video'
        ? 'Consultation vidéo'
        : 'Consultation à domicile'; ?>
</span>
        </div>

        <div class="booking__summary-item">
            <strong>Date :</strong>
            <span><?= htmlspecialchars($successBooking['date'] ?? '') ?></span>
        </div>

        <div class="booking__summary-item">
            <strong>Créneau :</strong>
            <span><?= htmlspecialchars($successBooking['slot'] ?? '') ?></span>
        </div>

        <div class="booking__summary-item">
            <strong>Nom :</strong>
            <span><?= htmlspecialchars($successBooking['lastname'] ?? '') ?></span>
        </div>

        <div class="booking__summary-item">
            <strong>Prénom :</strong>
            <span><?= htmlspecialchars($successBooking['firstname'] ?? '') ?></span>
        </div>

        <div class="booking__summary-item">
            <strong>Email :</strong>
            <span><?= htmlspecialchars($successBooking['email'] ?? '') ?></span>
        </div>

        <div class="booking__summary-item">
            <strong>Téléphone :</strong>
            <span><?= htmlspecialchars($successBooking['phone'] ?? '') ?></span>
        </div>

        <div class="booking__success-message">

            <h3>📧 Email de confirmation</h3>

            <p>
                Un email de confirmation vous sera envoyé avec le récapitulatif
                de votre rendez-vous.
            </p>

            <p>
                Un email de confirmation vous a été envoyé avec toutes les informations de votre rendez-vous.
            </p>
            

    <h3>📅 Prochaines étapes</h3>

    <p>
        Conservez cet email de confirmation.
    </p>

    <?php if (
    isset($successBooking['type'])
    && $successBooking['type'] === 'consultation_video'
    && !empty($successBooking['meeting_link'])
) : ?>

<p>
    Connectez-vous 5 minutes avant le début de votre séance.
</p>

<div style="margin:20px 0;">
    <a
        href="<?= htmlspecialchars($successBooking['meeting_link']) ?>"
        target="_blank"
        class="btn btn--primary"
    >
        Rejoindre ma consultation vidéo
    </a>
</div>

<p>
    En cas de retard, la séance se terminera à l'heure initialement prévue.
</p>

<p>
    Pour toute question :
    estelletherapies@gmail.com
</p>

<?php else : ?>

<p>
    Pour les consultations vidéo, le lien sécurisé de connexion vous sera transmis avant votre rendez-vous.
</p>

<?php endif; ?>

    <p>
        Si vous avez besoin de modifier ou reporter votre rendez-vous, vous pourrez le faire depuis votre espace patient.
    </p>

</div>

        </div>

        <div style="margin-top:30px;">
            <a href="?page=home" class="btn btn--primary">
                Retour à l'accueil
            </a>
        </div>

    </div>

</div>

</body>
</html>