<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes rendez-vous - TheraZen</title>
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

<div class="dashboard">

    <aside class="dashboard__sidebar">

        <div class="dashboard__logo">
            <img src="../images/logo therazen.png" alt="TheraZen">
        </div>

        <div class="dashboard__avatar">
            <img src="../images/moi.jpg" alt="Photo profil">
        </div>

        <div class="dashboard__profile">
            <h3><?= htmlspecialchars($_SESSION['user']['first_name']); ?></h3>
            <p>Espace Patient</p>
        </div>

        <nav class="dashboard__menu">

            <a href="?page=dashboard">
                🏠 Tableau de bord
            </a>

            <a href="?page=dashboard-rendezvous" class="dashboard__menu-link--active">
                📅 Mes rendez-vous
            </a>

            <a href="?page=dashboard-profile">
    👤 Mon profil
</a>

<a href="?page=dashboard-payments">
    💳 Paiements
</a>

            <a href="#">
                📄 Factures
            </a>

            <a href="?page=logout">
                🚪 Déconnexion
            </a>

        </nav>

        <div class="dashboard__help">

            <h4>Besoin d'aide ?</h4>

            <p>
                Notre équipe reste disponible pour vous accompagner.
            </p>

            <a href="mailto:estelletherapies@gmail.com" class="btn btn--secondary">
                Nous contacter
            </a>

        </div>

    </aside>

    <main class="dashboard__content">

        <div class="dashboard__header">

            <h1>
                Mes rendez-vous 📅
            </h1>

            <p>
                Retrouvez l'ensemble de vos consultations passées et à venir.
            </p>

        </div>

        <section class="dashboard__hero">

            <div class="dashboard__hero-left">

                <span class="dashboard__badge">
                    📅 Rendez-vous
                </span>

                <h2>
                    Historique de vos consultations
                </h2>

                <p class="dashboard__hero-date">
                    Cette page affichera vos rendez-vous à venir ainsi que vos consultations passées.
                </p>

            </div>

            <div class="dashboard__hero-right">

                <div class="dashboard__hero-illustration">
                    <img src="../images/cabinet.png" alt="Cabinet TheraZen">
                </div>

            </div>

                </section>

        <section class="dashboard-rdv">

            <div class="dashboard-rdv__card">

                <div class="dashboard-rdv__header">
                    📅 À venir
                </div>

                <table class="dashboard-rdv__table">

                    <thead>

                        <tr>
                            <th>Type de consultation</th>
                            <th>Date et heure</th>
                            <th>Statut</th>
                        </tr>

                    </thead>

                    <tbody>

                        

<?php foreach (($appointments ?? []) as $appointment): ?>

    <?php if (strtotime($appointment['appointment_start']) >= time()): ?>

        <tr>

            <td>
                <?= $appointment['consultation_type'] === 'consultation_video'
                    ? 'Consultation vidéo'
                    : 'Consultation à domicile'; ?>
            </td>

            <td>
                <?= date('d/m/Y à H:i', strtotime($appointment['appointment_start'])); ?>
            </td>

            <td>

                <span class="dashboard-rdv__status dashboard-rdv__status--success">
                    Confirmé
                </span>

            </td>

        </tr>

    <?php endif; ?>

<?php endforeach; ?>

</tbody>

                </table>

            </div>

            <div class="dashboard-rdv__card">

                <div class="dashboard-rdv__header">
                    🕘 Historique
                </div>

                <table class="dashboard-rdv__table">

                    <thead>

                        <tr>
                            <th>Type de consultation</th>
                            <th>Date et heure</th>
                            <th>Statut</th>
                        </tr>

                    </thead>

                    <tbody>

<?php foreach (($appointments ?? []) as $appointment): ?>

    <?php if (strtotime($appointment['appointment_start']) < time()): ?>

        <tr>

            <td>
                <?= $appointment['consultation_type'] === 'consultation_video'
                    ? 'Consultation vidéo'
                    : 'Consultation à domicile'; ?>
            </td>

            <td>
                <?= date('d/m/Y à H:i', strtotime($appointment['appointment_start'])); ?>
            </td>

            <td>

                <span class="dashboard-rdv__status">
                    Terminé
                </span>

            </td>

        </tr>

    <?php endif; ?>

<?php endforeach; ?>

</tbody>
                </table>

            </div>

                </section>

    </main>

</div>

</body>
</html>
