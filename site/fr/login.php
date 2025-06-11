<?php    
session_start();
include('../connexion.inc.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["valider"])) {
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
            header("Location: ../admin.php");
            exit;
        } elseif ($row['id_r'] == 2) {
            header("Location: ../gestionnaire.php");
            exit;
        } else {
            header("Location: ../home.html");
            exit;
        }
    } else {
        $erreur = "Identifiant ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/color_var.css">
    <link rel="stylesheet" href="login.css"> <!-- si ce fichier est bien dans fr/php/ -->
</head>
<body>
    <span class="background"></span>

    <form action="" method="POST" id="login-form">
        <div class="sign-container">
            <a href="../home.html">
                <img src="../img/home.png" id="home">
            </a>

            <img src="../img/user.png" class="default-pfp">
            <p>User Login</p>

            <div class="info-client">
                <?php if (isset($erreur)) echo "<p style='color:red;'>$erreur</p>"; ?>

                <div class="input">
                    <input type="text" name="email" placeholder="Identifiant" required>
                    <div class="bot-input">
                        <input type="password" name="mdp" id="pass" placeholder="Mot de passe" required>
                        <img src="../img/closed.png" alt="eye closed" id="eye" onclick="change()"/>
                    </div>
                </div>

                <input type="submit" value="Se connecter" name="valider">
                <div class="infos">
                    <a href="../inscription.php">Pas de compte ? Inscrivez-vous ici</a>
                </div>
            </div>
        </div>
    </form>

    <script>
        let e = true;
        function change() {
            const passField = document.getElementById("pass");
            const eye = document.getElementById("eye");

            if (e) {
                passField.type = "text";
                eye.src = "../img/open.png";
                e = false;
            } else {
                passField.type = "password";
                eye.src = "../img/closed.png";
                e = true;
            }
        }
    </script>
</body>
</html>
