<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Thera Zen - Réservation</title>

    <link rel="stylesheet" href="../css/style.css?v=1">

</head>

<body>

    <!-- HEADER -->

    <header class="header">

        <nav class="navbar container">

            <div class="navbar__logo">
                <img src="../images/logo therazen.png" alt="Logo Thera Zen">
                <span>Thera Zen</span>
            </div>

            <ul class="navbar__menu">
                <li><a href="?page=home">Accueil</a></li>
                <li><a href="index.html">Nos thérapies</a></li>
                <li><a href="index.html">Consultations</a></li>
                <li><a href="index.html">À propos</a></li>
                <li><a href="index.html">Contact</a></li>
            </ul>

            <button class="navbar__burger">☰</button>

            <div class="navbar__actions">
                <button class="btn btn--secondary">Se connecter</button>
                <a href="?page=booking" class="btn btn--primary">Prendre rendez-vous</a>
            </div>

        </nav>

        <div class="mobile-menu">
            <a href="?page=home">Accueil</a>
            <a href="#">Nos thérapies</a>
            <a href="#">Consultations</a>
            <a href="#">À propos</a>
            <a href="#">Contact</a>

            <button class="btn btn--secondary">Se connecter</button>
            <a href="?page=booking" class="btn btn--primary">Prendre rendez-vous</a>
        </div>

    </header>

    <!-- BOOKING -->

    <section class="booking">

    <div class="container">

        <div class="booking__wrapper">

            <!-- SIDEBAR -->

            <aside class="booking__sidebar">

                <h1>Réservez votre rendez-vous</h1>

                <p>
                    Choisissez le type de consultation, la date et le créneau qui vous convient.
                    Nous sommes là pour vous accompagner.
                </p>

                <div class="booking__image">
                    <img src="../images/sofa.png" alt="Salon thérapeutique">
                </div>

                <div class="booking__types">

                    <!-- VIDEO -->

                    <div class="booking__type <?= $selectedType === 'consultation_video' ? 'booking__type--active' : '' ?>" data-type="consultation_video">

                        <div class="booking__type-top">

                            <div class="booking__type-left">

                                <div class="booking__type-icon">🎥</div>

                                <div>
                                    <h3>Consultation vidéo</h3>
                                    <p>En visioconférence depuis chez vous</p>
                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- DOMICILE -->

                    <div class="booking__type <?= $selectedType === 'consultation_domicile' ? 'booking__type--active' : '' ?>" data-type="consultation_domicile">

                        <div class="booking__type-top">

                            <div class="booking__type-left">

                                <div class="booking__type-icon">🏠</div>

                                <div>
                                    <h3>Consultation à domicile</h3>
                                    <p>À votre domicile</p>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- SECURITY -->

                <div class="booking__security">
                    <h4>🛡️ Confidentialité & Sécurité</h4>
                    <p>Vos informations sont 100% sécurisées et strictement confidentielles.</p>
                </div>

                        </aside>

            <!-- CONTENT -->
             <?php

$months = [
    1 => 'Janvier',
    2 => 'Février',
    3 => 'Mars',
    4 => 'Avril',
    5 => 'Mai',
    6 => 'Juin',
    7 => 'Juillet',
    8 => 'Août',
    9 => 'Septembre',
    10 => 'Octobre',
    11 => 'Novembre',
    12 => 'Décembre'
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

?>

            <div class="booking__content">

    <!-- STEPS -->

    <div class="booking__steps">

        <div class="booking__step">
            <div class="booking__step-number">1</div>
            <p>Type & Date</p>
        </div>

        <div class="booking__step">
            <div class="booking__step-number">2</div>
            <p>Créneau horaire</p>
        </div>

        <div class="booking__step">
            <div class="booking__step-number">3</div>
            <p>Vos informations</p>
        </div>

        <div class="booking__step">
            <div class="booking__step-number">4</div>
            <p>Confirmation</p>
        </div>

    </div>

    <!-- INFOS -->

    <div class="booking__infos">
        <span>⏰ Europe/Paris (GMT+2)</span>
        <span>🎥 60 minutes</span>
        <span>💳 40€</span>
    </div>

    <!-- CALENDAR -->


<div class="booking__calendar">

    <h2>Sélectionnez une date</h2>

    <div class="booking__calendar-box">

        <div class="booking__month">

            <button>←</button>

            <h3><?= $months[(int) date('n', strtotime($selectedDate))] . ' ' . date('Y', strtotime($selectedDate)) ?></h3>

            <button>→</button>

        </div>

        <!-- WEEKDAYS -->

        <div class="booking__weekdays">

            <span>Lun</span>
            <span>Mar</span>
            <span>Mer</span>
            <span>Jeu</span>
            <span>Ven</span>
        
        </div>

        <!-- DAYS -->

        <div class="booking__days">

            <?php foreach ($dates as $date): ?>

                <?php if ($date === null): ?>

                    <div class="booking__day booking__day--empty"></div>

                <?php else: ?>

                    <button class="booking__day <?= $date === $selectedDate ? 'booking__day--active' : '' ?>" data-date="<?= $date ?>" data-type="<?= $selectedType ?>">
                        <?= date('j', strtotime($date)) ?>
                    </button>

                <?php endif; ?>

            <?php endforeach; ?>

        </div>

    </div>

</div>
    
<!-- SLOTS -->

<div class="booking__slots">

    <h2>Créneaux disponibles</h2>

    <div class="booking__slots-card">

        <div class="booking__slots-top">

            <strong>
    <?= $days[date('l', strtotime($selectedDate))] . ' ' . date('d', strtotime($selectedDate)) . ' ' . $months[(int) date('n', strtotime($selectedDate))] . ' ' . date('Y', strtotime($selectedDate)) ?>
</strong>

            <div class="booking__slots-tags">
    <div class="booking__tag"><?= $selectedType === 'consultation_domicile' ? 'Consultation à domicile' : 'Consultation vidéo' ?></div>
</div>

        </div>

        <div class="booking__hours">

            <?php foreach ($slots as $slot): ?>
                <button class="booking__hour"><?= $slot ?></button>
            <?php endforeach; ?>

        </div>

    </div>

</div>

<!-- NOTICE -->

<p class="booking__notice">
    ℹ️ Le premier créneau disponible tient compte de vos rendez-vous existants, du temps de trajet et du temps de préparation.
</p>

<div class="booking__actions">
    <button class="btn btn--primary booking__continue">Continuer</button>
</div>

</div> <!-- booking__content -->
</div> <!-- booking__wrapper -->
</div> <!-- container -->

</section>      
<!-- FOOTER -->

<footer class="footer">

    <div class="container">

        <div class="footer__brand">
            <h2>Thera Zen</h2>
            <p>Votre bien-être mental est notre priorité.</p>
        </div>

        <div class="footer__line"></div>

        <ul class="footer__links">
            <li>Accueil</li>
            <li>Nos thérapies</li>
            <li>Consultations</li>
            <li>À propos</li>
            <li>Contact</li>
        </ul>

        <div class="footer__line"></div>

        <ul class="footer__legal">
            <li>FAQ</li>
            <li>Mentions légales</li>
            <li>Politique de confidentialité</li>
            <li>Conditions générales d'utilisation</li>
        </ul>

        <div class="footer__line"></div>

        <ul class="footer__contact">
            <li>07 57 49 60 30</li>
            <li>estelletherapies@gmail.com</li>
            <li>Saint-Jean-de-Niost</li>
        </ul>

        <div class="footer__line"></div>

        <p class="footer__copyright">© 2026 Thera Zen - Tous droits réservés.</p>

    </div>

</footer>

<script src="../script.js?v=1"></script>

</body>
</html>
    