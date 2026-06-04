<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription TheraZen</title>
</head>

<body>

<h1>Créer un compte TheraZen</h1>

<form method="POST" action="?page=register">

    <input type="text" name="first_name" placeholder="Prénom" required><br><br>

    <input type="text" name="last_name" placeholder="Nom" required><br><br>

    <input type="text" name="address" placeholder="Adresse complète" required><br><br>

    <input type="text" name="postal_code" placeholder="Code postal" required><br><br>

    <input type="text" name="city" placeholder="Ville" required><br><br>

    <input type="email" name="email" placeholder="Adresse e-mail" required><br><br>

    <input type="text" name="phone" placeholder="Téléphone" required><br><br>

    <input type="password" id="password" name="password" placeholder="Mot de passe" required><br>

    <label><input type="checkbox" id="show-password"> Afficher le mot de passe</label>

    <br><br>

    <button type="submit">Créer mon compte</button>

</form>

<script src="../script.js"></script>

</body>
</html>