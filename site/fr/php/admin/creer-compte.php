<?php
    include("../connexion.inc.php");  

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Creer"])){

    
       try {
        $cnx->beginTransaction();
        $email = hash('sha256', $_POST["email"]);
        $password =  hash('sha256', $_POST["password"]);
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $age= $_POST["age"];
        $sexe = $_POST['sexe'];
        $role = $_POST['role'];


        $stmt2 = $cnx->prepare("SELECT id_r FROM role WHERE _nom_r = :role");
        $stmt2->bindParam(':role', $role);
        $stmt2->execute();

        $id_r = $stmt2->fetchColumn();

        $sql = "INSERT INTO utilisateur (email, password, nom, prenom, age, sexe,id_r) VALUES (:email, :password, :nom, :prenom, :age, :sexe, :role) RETURNING id_u";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':sexe', $sexe);
        $stmt->bindParam(':role', $id_r);

        $stmt->execute();
        $cnx->commit();

    } catch (Exception $e) {
        $cnx->rollBack();
        echo "<p style='color: red;'>Erreur : Email déja utilisé </p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
      
        form {
            max-width: 700px;
            margin: 40px auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            font-weight: bold;
        }

        input, textarea, select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
        }

        .section-block {
            border: 1px solid #888;
            padding: 15px;
            border-radius: 10px;
            background-color: #f8f8f8;
            display: flex;
            flex-direction:column;
            gap:10px;


        }


        input[type="submit"] {
            background-color:rgba(249, 74, 39, 0.25);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom:1rem;
        }

        input[type="submit"]:hover {

            background-color:rgb(235, 114, 90);
        }

        .button-container {
            display: flex;
            flex-direction: row;
            align-items: center;       
            justify-content: center;    
            gap: 2rem;
        }

        .button-container button {
            display: flex;
            flex-direction: row;
            align-items: center;       
            justify-content: center;    
            gap: 2rem;
            padding: 0.7rem;
        }

        .sections-container{
            display: flex;
            flex-direction:column;
            gap:30px;
        }


        .error{
            padding-top:5px;
            padding-bottom:5px;
            padding-left:25px;
            border-radius:10px;
            background-color:rgba(255, 181, 181);
            border: 1px solid red;
            color: black;
        }


    </style>
</head>

<body>
    <form method="POST" action="">

        <label for="email">Email :</label>
        <input type="email" name="email" required>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required>

        <label for="nom">Nom :</label>
        <input type="text" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" required>

        <label for="age">Âge :</label>
        <input type="number" name="age" min="10" max="100" required>

        <label for="sexe">Sexe :</label>
        <select name="sexe" required>
            <option value="">-- Sélectionner --</option>
            <option value="homme">Homme</option>
            <option value="femme">Femme</option>
        </select>

        <label for="role">Rôle :</label>
        <select name="role" required>
            <option value="">-- Sélectionner --</option>
            <option value="gestionnaire">Gestionnaire</option>
            <option value="visiteur">Visiteur</option>
        </select>

        <input type="submit" name="Creer" value="Creer">
    </form>
    
</body>
</html>
