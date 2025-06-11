<?php
    session_start();
    include("../../connexion.inc.php");  

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["valider"])){
        $email = hash('sha256', $_POST['email']);
        $mdp = hash('sha256', $_POST['mdp']);

        $sql= "SELECT id_u, id_r FROM utilisateur WHERE email = :email AND password = :mdp";
        $verif = $cnx->prepare($sql);
        $verif->bindParam(':email', $email);
        $verif->bindParam(':mdp', $mdp);
        $verif->execute();
        
        if ($verif->rowCount() > 0) {
            $row = $verif->fetch();
            $_SESSION['u_id'] = $row['id_u'];
            $_SESSION['u_id']= $row["id_r"];

            if ($row["id_r"]==1){
                header("Location: ../admin.php"); 
                exit;
            }else if($row['id_r']==2){
                header("Location: ../gestionnaire.php"); 
                exit;
            }  

            else{
                header("Location: ../home.html"); 
                exit;
            }

        } else {
            echo "<p style='color:red; font-size:1rem; font-weight:200;'>L'identifiant ou le mot de passe est incorrect.</p>";
        }
    }
?>
