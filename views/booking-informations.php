<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheraZen</title>

    <link rel="stylesheet" href="/TheraZen/css/style.css?v=999">
</head>

<body>
    <div class="container booking-page">
<?php

$date = $_GET['date'] ?? '';
$type = $_GET['type'] ?? '';
$slot = $_GET['slot'] ?? '';

$months = [
    1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
    5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
    9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
];

$days = [
    'Monday' => 'Lundi',
    'Tuesday' => 'Mardi',
    'Wednesday' => 'Mercredi',
    'Thursday' => 'Jeudi',
    'Friday' => 'Vendredi',
    'Saturday' => 'Samedi',
    'Sunday' => 'Dimanche'
];

$formattedDate = '';

if (!empty($date)) {
    $formattedDate =
        $days[date('l', strtotime($date))] . ' ' .
        date('d', strtotime($date)) . ' ' .
        $months[(int) date('n', strtotime($date))] . ' ' .
        date('Y', strtotime($date));
}

$consultationLabel =
    $type === 'consultation_domicile'
        ? 'Consultation à domicile'
        : 'Consultation vidéo';

?>

<div class="booking__steps">

    <div class="booking__step booking__step--done">
        <div class="booking__step-number">✓</div>
        <p>Type & Date</p>
    </div>

    <div class="booking__step booking__step--done">
        <div class="booking__step-number">✓</div>
        <p>Créneau horaire</p>
    </div>

    <div class="booking__step booking__step--active">
        <div class="booking__step-number">3</div>
        <p>Vos informations</p>
    </div>

    <div class="booking__step">
        <div class="booking__step-number">4</div>
        <p>Confirmation</p>
    </div>

</div>
<div class="booking__information-layout">
<div class="booking__summary-card">

    <h3>Récapitulatif du rendez-vous</h3>

    <div class="booking__summary-item">
        <strong>Consultation :</strong>
        <span><?= htmlspecialchars($consultationLabel) ?></span>
    </div>

    <div class="booking__summary-item">
        <strong>Date :</strong>
        <span><?= htmlspecialchars($formattedDate) ?></span>
    </div>

    <div class="booking__summary-item">
        <strong>Créneau :</strong>
        <span><?= htmlspecialchars($slot) ?></span>
    </div>

</div>

<div class="booking__form-card">

    <h2>Vos informations</h2>

    <p class="booking__subtitle">
        Merci de compléter les informations suivantes afin de confirmer votre rendez-vous.
    </p>

    <form class="booking-form" method="post" action="?page=booking-informations">

        <input type="hidden" name="appointment_date" value="<?= htmlspecialchars($date) ?>">
        <input type="hidden" name="appointment_type" value="<?= htmlspecialchars($type) ?>">
        <input type="hidden" name="appointment_slot" value="<?= htmlspecialchars($slot) ?>">
        <input type="hidden" name="booking_submit" value="1">

        <div class="booking-form__group">
            <label>Nom *</label>
            <input type="text" name="lastname" required>
        </div>

        <div class="booking-form__group">
            <label>Prénom *</label>
            <input type="text" name="firstname" required>
        </div>

        <div class="booking-form__group">
            <label>Date de naissance *</label>
            <input type="date" name="birthdate" required>
        </div>

        <div class="booking-form__group">
            <label>Téléphone *</label>
            <input type="tel" name="phone" placeholder="06 00 00 00 00" required>
        </div>

        <div class="booking-form__group">
            <label>Email *</label>
            <input type="email" name="email" placeholder="email@exemple.fr" required>
        </div>

        <div class="booking-form__group">
            <label>Motif de consultation *</label>
            <textarea name="reason" rows="5" placeholder="Vous pouvez décrire brièvement votre demande ou les raisons qui vous amènent à consulter."></textarea>
        </div>

        <div class="booking-form__account">
            <input type="checkbox" id="create-account">
            <label for="create-account">Créer un compte TheraZen (facultatif)</label>
        </div>

        <p class="booking-form__info">
            Créer un compte vous permettra de retrouver vos rendez-vous, consulter votre historique et gérer facilement vos futures réservations.
        </p>

        <div class="booking-form__passwords">

    <div class="booking-form__group">
        <label>Mot de passe</label>
        <input type="password" name="password" id="password">
    </div>

    <div class="booking-form__group">
        <label>Confirmation du mot de passe</label>
        <input type="password" name="password_confirmation" id="password_confirmation">
    </div>

</div>

<div class="booking-form__options">

    <label class="booking-form__checkbox">
        <input type="checkbox" id="show-passwords">
        Afficher les mots de passe
    </label>

    <label class="booking-form__checkbox">
        <input type="checkbox" id="remember-me">
        Se souvenir de moi
    </label>

</div>

        <button type="submit" class="btn btn--primary">
            Continuer vers la confirmation →
        </button>

    </form>

</div>
</div>
</div>
<script src="/TheraZen/script.js?v=999"></script>

</body>
</html>
```
