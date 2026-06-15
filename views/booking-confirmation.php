<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation - TheraZen</title>

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

        <div class="booking__step booking__step--active">
            <div class="booking__step-number">4</div>
            <p>Confirmation</p>
        </div>

    </div>

    <div class="booking__summary-card">

        <h2>Confirmer votre rendez-vous</h2>

        <div class="booking__summary-item">
            <strong>Consultation :</strong>
            <span><?= htmlspecialchars($_SESSION['booking']['type']) ?></span>
        </div>

        <div class="booking__summary-item">
            <strong>Date :</strong>
            <span><?= htmlspecialchars($_SESSION['booking']['date']) ?></span>
        </div>

        <div class="booking__summary-item">
            <strong>Créneau :</strong>
            <span><?= htmlspecialchars($_SESSION['booking']['slot']) ?></span>
        </div>

        <div class="booking__summary-item">
            <strong>Nom :</strong>
            <span><?= htmlspecialchars($_SESSION['booking']['lastname']) ?></span>
        </div>

        <div class="booking__summary-item">
            <strong>Prénom :</strong>
            <span><?= htmlspecialchars($_SESSION['booking']['firstname']) ?></span>
        </div>

        <div class="booking__summary-item">
            <strong>Email :</strong>
            <span><?= htmlspecialchars($_SESSION['booking']['email']) ?></span>
        </div>

        <div class="booking__summary-item">
            <strong>Téléphone :</strong>
            <span><?= htmlspecialchars($_SESSION['booking']['phone']) ?></span>
        </div>

        <form method="post" action="?page=stripe-checkout">

    <button type="submit" class="btn btn--primary">
        Payer 42 € et confirmer
    </button>

</form>

    </div>

</div>

</body>
</html>