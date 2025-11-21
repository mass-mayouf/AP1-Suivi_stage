<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

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
// Connexion via formulaire (POST)
if (isset($_POST['envoi'])) 
{
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];

    $connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);

    $requete="SELECT * FROM utilisateur WHERE login='$login' AND motdepasse='$mdp'";
    $resultat = mysqli_query($connexion, $requete);

    $trouve = 0;

    while ($donnees = mysqli_fetch_assoc($resultat)) {
        $trouve = 1;
        $_SESSION["id"] = $donnees['num']; 
        $_SESSION["login"] = $donnees['login'];
        $_SESSION["type"] = $donnees['type'];
    }

    if ($trouve == 0) {
        echo "Erreur : login/mot de passe incorrect.<br>";
        echo "<a href='index.php'>Retourner à l'index</a>";
    }
}

// Si l’utilisateur est connecté
if (isset($_SESSION["login"])) {

    // Menu
    if ($_SESSION["type"] == 0) {
        include '_menuEleve.php';
        $role = "Élève";
        $message = "Bienvenue sur votre espace élève !";
    } else {
        include '_menuProf.php';
        $role = "Professeur";
        $message = "Bienvenue dans votre espace personnel de professeur !";
    }

    // Tableau d'informations
    echo "
    <div class='table-container'>
        <table border='1' class='info-table'>
            <thead>
                <tr>
                    <th colspan='2'>Informations du compte</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Login :</strong></td>
                    <td>".$_SESSION['login']."</td>
                </tr>
                <tr>
                    <td><strong>Rôle :</strong></td>
                    <td>$role</td>
                </tr>
                <tr>
                    <td><strong>Message :</strong></td>
                    <td>$message</td>
                </tr>
            </tbody>
        </table>
    </div>
    ";
}
?>

</body>
</html>
