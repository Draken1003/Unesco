<?php       
    include("../connexion.inc.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["inscription"])) {
        try{

            // pr eviter que les user voient les erreurs
            $email = isset($_POST['email']) ? hash('sha256', $_POST['email']) : '';
            $mdp = isset($_POST['password']) ? hash('sha256', $_POST['password']) : '';
            $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
            $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
            $sexe = isset($_POST['sexe']) ? $_POST['sexe'] : '';
            $age = isset($_POST['age']) ? $_POST['age'] : '';
            $role = 3;

            $cnx->beginTransaction();

            $sql = "INSERT INTO utilisateur (nom, prenom, age, sexe, email, password, id_r) VALUES (:nom, :prenom, :age, :sexe, :email, :password, :role)";
            $stmt = $cnx->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':sexe', $sexe);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $mdp);
            $stmt->bindParam(':role', $role);
            $stmt->execute();

            $cnx->commit();
            $id_u = $cnx->lastInsertId();
            $_SESSION['id_u'] = $id_u;
            header("Location: login.php");
            exit();

            } catch (Exception $e) {
                $cnx->rollBack();
                echo "<p style='color: red;'>Erreur : L'adresse email existe déja.</p>";
            }

                    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="css/color_var.css">
</head>
<body>
    <span class="background"></span>

    <form method="POST" id="login-form">
        <div class="sign-container">
            <img src="../img/user.png" class="default-pfp">
            <p>Create an account</p>

            <div class="info-client">
                <div class="input">
                    <input type="text" name="nom" placeholder="Last name" required>
                </div>
                <div class="input">
                    <input type="text" name="prenom" placeholder="First name" required>
                </div>
                <div class="input">
                    <input type="number" name="age" placeholder="Age" required min=5 max=100>
                </div>
                <div class="input">
                    <select name="sexe" required>
                        <option value="" disabled selected>Gender</option>
                        <option value="Homme" name="homme">Men</option>
                        <option value="Femme" name="femme">Women</option>
                        <option value="Autre" name="autre">Other</option>
                    </select>
                </div>
                <div class="input">
                    <input type="email" name="email" placeholder="E-mail address" required>
                </div>
                <div class="input">
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <input type="submit" name="inscription" value="Sign up">

                <div class="infos">
                    <a href="login.php">Already have an account? Sign in here</a>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
