<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion TheraZen</title>
    <link rel="stylesheet" href="/TheraZen/css/style.css?v=<?= time() ?>">
</head>

<body>

<section class="login">

    <div class="login__card">

        <h1 class="login__title">Connexion</h1>

        <p class="login__subtitle">
            Accédez à votre espace patient.
        </p>

        <form class="login__form" method="POST" action="?page=login">

            <input type="email" name="email" placeholder="Email" required>

            <input type="password" id="password" name="password" placeholder="Mot de passe" required>

            <label class="login__checkbox" for="show-password">
                <input type="checkbox" id="show-password">
                Afficher le mot de passe
            </label>

            <button type="submit" class="login__button">
                Se connecter
            </button>

        </form>

    </div>

</section>

<script src="/TheraZen/script.js?v=999"></script>

</body>

</html>