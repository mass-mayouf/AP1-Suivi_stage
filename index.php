<?php
session_start();

$message = "";

if (isset($_GET['deco'])) {
    session_destroy();
    $message = "Déconnectée";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUIVI DES STAGES</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Menu de navigation -->
    <header>
        <nav class="menu">
            <div class="logo">SUIVI DES STAGES</div>
            <div class="menu-buttons">
                <button class="btn-menu" onclick="window.location.href='oubli.php'">Mot de passe oublié</button>
            </div>
        </nav>
    </header>

    <main>
        <section id="formulaire" class="form-container">
            <h2>Connexion</h2>

            <!-- Affichage du message de déconnexion -->
            <?php if (!empty($message)) : ?>
                <p style="color:red; font-weight:bold;"><?= $message ?></p>
            <?php endif; ?>

            <form action="acceuil.php" method="post">
                <div class="form-group">
                    <label>Login :</label>
                    <input type="text" name="login" placeholder="Entrez votre login" required>
                </div>

                <div class="form-group">
                    <label>Mot de passe :</label>
                    <input type="password" name="mdp" placeholder="Entrez votre mot de passe" required>
                </div>

                <button type="submit" class="btn-submit" name="envoi" value="1">Envoyer</button>
            </form>
        </section>
    </main>
</body>
</html>
