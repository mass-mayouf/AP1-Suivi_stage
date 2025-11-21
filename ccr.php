<?php
session_start(); 
include '_con_web.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des Stages</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php

// L'utilisateur est connecté ?
if (isset($_SESSION["login"])) {

    if ($_SESSION["type"] == 0) {
        include '_menuEleve.php';

        // ==========================
        // MODE : MODIFIER UN CR
        // ==========================
        if (isset($_GET["id"])) {

            $idCR = $_GET["id"];
            $iduser = $_SESSION["id"];

            $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);

            $requete = "SELECT * FROM cr WHERE num = '$idCR' AND num_utilisateur = $iduser";
            $resultat = mysqli_query($connexion, $requete);

            if ($donnees = mysqli_fetch_assoc($resultat)) {

                $date = $donnees['date'];
                $description = $donnees['description'];
                ?>

                <section id="formulaire" class="form-container">
                    <h2>Modifier un CR</h2>
                    <form action="cr.php" method="post">

                        <div class="form-group">
                            <label>Date du CR :</label>
                            <input type="date" name="date" value="<?php echo $date ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Contenu :</label>
                            <textarea name="contenu" rows="10" required><?php echo $description ?></textarea>
                        </div>

                        <input type="hidden" name="idCR" value="<?php echo $idCR ?>">

                        <button type="submit" class="btn-submit" name="update">Modifier</button>
                    </form>
                </section>

                <?php
            } else {
                echo "<div class='message-erreur'>CR introuvable ou non autorisé.</div>";
            }

        } 
        else {
            // ==========================
            // MODE : CREER UN CR
            // ==========================
            ?>

            <section id="formulaire" class="form-container">
                <h2>Créer un CR</h2>
                <form action="cr.php" method="post">

                    <div class="form-group">
                        <label>Date du CR :</label>
                        <input type="date" name="date" required>
                    </div>

                    <div class="form-group">
                        <label>Contenu :</label>
                        <textarea name="contenu" rows="10" required placeholder="Entrez votre CR ici"></textarea>
                    </div>

                    <button type="submit" class="btn-submit" name="insertion">Confirmer</button>
                </form>
            </section>

            <?php
        }

    } else {
        include '_menuProf.php';
    }
}
?>

</body>
</html>
