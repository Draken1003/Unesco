<?php    
session_start();
include('../connexion.inc.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["valider"])){
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
        $_SESSION['u_id'] = $row["id_r"];

        if ($row["id_r"] == 1) {
            header("Location: admin.php"); 
            exit;
        } else if ($row['id_r'] == 2) {
            header("Location: gestionnaire.php"); 
            exit;
        } else {
            header("Location: home.html"); 
            exit;
        }
    } else {
        echo "<p style='color:red; font-size:1rem; font-weight:200;'>L'identifiant ou le mot de passe est incorrect.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="css/color_var.css">
</head>

<body>

    <span class="background"></span>
    <form action="post" id="login-form" method="POST">

        <div class="sign-container">
            <a href="home.html">
                <img src="../img/home.png" id="home">
            </a>

            <img src="../img/user.png" class="default-pfp">
            <p>User Login</p>
            <div class="info-client">
                <div class="input">
                    <input type="text" placeholder="Identifiant" name="email" required>
                    <div class="bot-input">
                        <input type="password" name="mdp" id="pass" placeholder="Mot de passe" required>
                        <img src="../img/closed.png" alt="eye closed" id="eye" onClick="change()" />
                    </div>
                </div>

                <input type="submit" value="Se connecter" name="valider">
                <div class="infos">
                    <a href="inscription.php">Pas de compte ? Inscrivez vous ici</a>
                </div>
            </div>
        </div>
    </form>

    <script>
        let e = true;
        function change() {
            const passInput = document.getElementById("pass");
            const eyeImg = document.getElementById("eye");
            if (e) {
                passInput.setAttribute("type", "text");
                eyeImg.src = "../img/open.png";
                e = false;
            } else {
                passInput.setAttribute("type", "password");
                eyeImg.src = "../img/closed.png";
                e = true;
            }
        }
    </script>
</body>

</html>
