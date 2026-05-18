<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheraZen</title>
</head>
<body>
    <h1>Bienvenue sur TheraZen 🚀</h1>

    <?php if (isset($_SESSION['user'])): ?>
        <p>Bonjour <?= $_SESSION['user']['first_name']; ?> 👋</p>
    <?php endif; ?>
</body>
</html>