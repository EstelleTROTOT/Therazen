<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription TheraZen</title>
</head>
<body>

    <h1>Créer un compte</h1>

    <form method="POST" action="?page=register">
        <input type="text" name="first_name" placeholder="Prénom" required>
        <br><br>

        <input type="text" name="last_name" placeholder="Nom" required>
        <br><br>

        <input type="email" name="email" placeholder="Email" required>
        <br><br>

        <input type="text" name="phone" placeholder="Téléphone" required>
        <br><br>

        <input type="password" name="password" placeholder="Mot de passe" required>
        <br><br>

        <button type="submit">S'inscrire</button>
    </form>

</body>
</html>