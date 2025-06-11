<?php
session_start();
include('../connexion.inc.php');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["valider"])) {
    $email = hash('sha256', $_POST['email']);
    $mdp = hash('sha256', $_POST['mdp']);

    $sql = "SELECT id_u, id_r FROM utilisateur WHERE email = :email AND password = :mdp";
    $verif = $cnx->prepare($sql);
    $verif->bindParam(':email', $email);
    $verif->bindParam(':mdp', $mdp);
    $verif->execute();

    if ($verif->rowCount() > 0) {
        $row = $verif->fetch();
        $_SESSION['u_id'] = $row['id_u'];
        $_SESSION['u_role'] = $row['id_r'];

        if ($row['id_r'] == 1) {
            header("Location: admin.php");
        } elseif ($row['id_r'] == 2) {
            header("Location: gestionnaire.php");
        } else {
            header("Location: home.html");
        }
        exit;
    } else {
        $erreur = "Identifiant ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>

<?php if (isset($erreur)) echo "<p style='color:red;'>$erreur</p>"; ?>

<form method="POST" action="">
    <input type="text" name="email" placeholder="Email" required>
    <input type="password" name="mdp" placeholder="Mot de passe" required>
    <input type="submit" name="valider" value="Se connecter">
</form>

</body>
</html>
