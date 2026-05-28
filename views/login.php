<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion TheraZen</title>
</head>

<body>

    <h1>Connexion</h1>

    <form method="POST" action="?page=login">
        <input type="email" name="email" placeholder="Email" required>
        <br><br>

        <input type="password" id="password" name="password" placeholder="Mot de passe" required>
        <br>

        <label for="show-password">
            <input type="checkbox" id="show-password">
            Afficher le mot de passe
        </label>

        <br><br>

        <button type="submit">Se connecter</button>
    </form>

    <script src="script.js"></script>

</body>
</html>