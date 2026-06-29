<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Patient - TheraZen</title>
    <link rel="stylesheet" href="../css/style.css?v=<?= time(); ?>">
</head>

<body>

<?php /** @var array|null $nextAppointment */ ?>

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

```
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

        <a href="?page=dashboard" class="dashboard__menu-link dashboard__menu-link--active">
            🏠 Tableau de bord
        </a>

        <a href="?page=dashboard-rendezvous">
            📅 Mes rendez-vous
        </a>

        
            <a href="?page=dashboard-payments">
            💳 Paiements
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
            Bonjour <?= htmlspecialchars($_SESSION['user']['first_name']); ?> 👋
        </h1>

        <p>
            Bienvenue dans votre espace personnel TheraZen.
        </p>

    </div>

    <section class="dashboard__hero">

        <div class="dashboard__hero-left">

            <span class="dashboard__badge">
                📅 Prochain rendez-vous
            </span>

            <?php if ($nextAppointment): ?>

                <h2>
                    <?= $nextAppointment['consultation_type'] === 'consultation_video'
                        ? 'Consultation vidéo'
                        : 'Consultation à domicile'; ?>
                </h2>

                <p class="dashboard__hero-date">
                    <?= date('d/m/Y à H:i', strtotime($nextAppointment['appointment_start'])); ?>
                </p>

                <a href="#" class="btn btn--primary">
                    Voir les détails
                </a>

            <?php else: ?>

                <h2>
                    Aucun rendez-vous programmé
                </h2>

                <p class="dashboard__hero-date">
                    Vous n'avez actuellement aucun rendez-vous prévu.
                </p>

                <a href="?page=booking" class="btn btn--primary">
                    Réserver une consultation
                </a>

            <?php endif; ?>

        </div>

        <div class="dashboard__hero-right">

            <div class="dashboard__hero-illustration">
    <img src="../images/cabinet.png" alt="Cabinet TheraZen">
</div>
        </div>

    </section>

    <section class="dashboard__cards">

        <article class="dashboard__card">

            <div class="dashboard__card-header">
                <h3>👤 Mon profil</h3>
            </div>

                        <div class="dashboard__info">
                <strong>Prénom</strong>
                <span><?= htmlspecialchars($_SESSION['user']['first_name']); ?></span>
            </div>

            <div class="dashboard__info">
                <strong>Nom</strong>
                <span><?= htmlspecialchars($_SESSION['user']['last_name'] ?? '-'); ?></span>
            </div>

            <div class="dashboard__info">
                <strong>Email</strong>
                <span><?= htmlspecialchars($_SESSION['user']['email'] ?? '-'); ?></span>
            </div>

            <div class="dashboard__info">
    <strong>Téléphone</strong>
    <span><?= htmlspecialchars($_SESSION['user']['phone'] ?? '-'); ?></span>
</div>

<a href="#" class="btn btn--primary dashboard__edit-profile">
    Modifier mes informations
</a>
        </article>

        <article class="dashboard__card">

            <div class="dashboard__card-header">
                <h3>📅 Mes rendez-vous</h3>
            </div>

                        <p>
                Retrouvez vos rendez-vous à venir et l'historique de vos consultations.
            </p>

            <?php if ($nextAppointment): ?>

                <div class="dashboard__info">
                    <strong>Prochain rendez-vous</strong>
                    <span>Planifié</span>
                </div>

            <?php else: ?>

                <div class="dashboard__info">
                    <strong>Prochain rendez-vous</strong>
                    <span>Aucun</span>
                </div>

            <?php endif; ?>

            <a href="#" class="dashboard__link">
                Voir mes rendez-vous →
            </a>

        </article>


    </section>

    <section class="dashboard__payments">

        <div class="dashboard__payments-header">

            <h3>
                💳 Paiements
            </h3>

        </div>

                <p>
            Consultez l'historique de vos paiements et les informations liées à vos consultations.
        </p>

        <div class="dashboard__info">
            <strong>Paiements</strong>
            <span>Historique disponible prochainement</span>
        </div>

    </section>

</main>
</div>
</main>

</div>

<div class="dashboard-modal" id="editProfileModal">

    <div class="dashboard-modal__content">

        <button class="dashboard-modal__close" id="closeProfileModal">
            ×
        </button>

        <h2>Modifier mes informations</h2>

        <form method="POST" action="?page=dashboard">

            <div class="dashboard-modal__group">

                <label>Prénom</label>

                <input
     type="text"
    name="first_name"
    value="<?= htmlspecialchars($_SESSION['user']['first_name']); ?>"
    required
>

            </div>

            <div class="dashboard-modal__group">

                <label>Nom</label>

                <input
    type="text"
    name="last_name"
    value="<?= htmlspecialchars($_SESSION['user']['last_name'] ?? ''); ?>"
    required
>

            </div>

            <div class="dashboard-modal__group">

                <label>Email</label>

                <input
    type="email"
    name="email"
    value="<?= htmlspecialchars($_SESSION['user']['email']); ?>"
    required
>

            </div>

            <div class="dashboard-modal__group">

                <label>Téléphone</label>

                <input
    type="text"
    name="phone"
    value="<?= htmlspecialchars($_SESSION['user']['phone'] ?? ''); ?>"
>

            </div>

            <button
                type="submit"
                class="btn btn--primary"
            >
                Enregistrer
            </button>

        </form>

    </div>

</div>

<script>

const editButton = document.querySelector(".dashboard__edit-profile");
const modal = document.getElementById("editProfileModal");
const closeButton = document.getElementById("closeProfileModal");

editButton.addEventListener("click", function(e){

    e.preventDefault();

    modal.classList.add("dashboard-modal--active");

});

closeButton.addEventListener("click", function(){

    modal.classList.remove("dashboard-modal--active");

});

window.addEventListener("click", function(e){

    if(e.target === modal){

        modal.classList.remove("dashboard-modal--active");

    }

});

</script>

</body>
</html>

</body>
</html>
