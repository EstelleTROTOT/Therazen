<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiements - TheraZen</title>
    <link rel="stylesheet" href="../css/style.css?v=<?= time(); ?>">
</head>

<body>

<header class="header">

    <nav class="navbar container">

        <div class="navbar__logo">
            <img src="../images/logo therazen.png" alt="Logo Thera Zen">
            <span>Thera Zen</span>
        </div>

        <ul class="navbar__menu">
            <li><a href="?page=home">Accueil</a></li>
            <li><a href="#">Nos thérapies</a></li>
            <li><a href="#">Consultations</a></li>
            <li><a href="#">À propos</a></li>
            <li><a href="#">Contact</a></li>
        </ul>

        <div class="navbar__actions">
            <a href="?page=home" class="btn btn--secondary">
                Retour au site
            </a>

            <a href="?page=logout" class="btn btn--primary">
                Déconnexion
            </a>
        </div>

    </nav>

</header>

<body>

<div class="dashboard-content">

    <div class="dashboard-header">

        <div>

            <h1>💳 Paiements</h1>

            <p>
                Consultez l'historique de vos paiements.
            </p>

        </div>

        <a href="?page=booking" class="btn-primary">
            Prendre rendez-vous
        </a>

    </div>

    <div class="payment-card">

        <table class="payment-table">

            <thead>

                <tr>

                    <th>Date de paiement</th>
                    <th>Montant</th>
                    

                </tr>

            </thead>

            <tbody>

                <?php if (!empty($payments)) : ?>

                    <?php foreach ($payments as $payment) : ?>

                        <tr>

                            <td>
                                <?= date('d/m/Y à H:i', strtotime($payment->getPaidAt())); ?>
                            </td>

                            <td>
                                <?= number_format($payment->getAmount(), 2, ',', ' '); ?> €
                            </td>

                            <td>

                                <a href="?page=invoice&id=<?= $payment->getId(); ?>" class="btn-download">

                                    Télécharger

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else : ?>

                    <tr>

                        <td colspan="3" class="empty-payment">

                            Aucun paiement enregistré.

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

</body>

</html>