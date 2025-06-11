<?php    
session_start();
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

    
    <?php
        include('php/verif_log.php');
    ?>

    <span class="background"></span>
    <form action="post" id="login-form">

        <div class="sign-container">
            <a href="home.html">
                <img src="img/home.png" id="home">
            </a>

            <img src="img/user.png" class="default-pfp">
            <p>User Login</p>
            <div class="info-client">
                <div class="input">
                    <input type="text" placeholder="Identifiant" required>
                    <div class="bot-input">
                        <input type="password" name="" id="pass" placeholder="Mot de passe" required>
                        <img src="img/closed.png" alt="eye closed" id="eye" onClick="change()" />
                    </div>

                </div>

                <input type="submit" value="Se connecter">
                <div class="infos">
                    <a href="inscription.php">Pas de compte ? Inscrivez vous ici</a>
                </div>
            </div>
        </div>
    </form>

    <script>
        e = true;

        function change() {
            if (e) {
                document.getElementById("pass").setAttribute("type", "text");
                document.getElementById("eye").src = "img/open.png";
                e = false;
            } else {
                document.getElementById("pass").setAttribute("type", "password");
                document.getElementById("eye").src = "img/closed.png";
                e = true;
            }
        }
    </script>
</body>

</html>
