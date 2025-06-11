<?php    
session_start();
include("../../../connexion.inc.php"); 

if (!isset($_SESSION['u_id']) || $_SESSION['u_id'] != 1) {
    header("Location: ../../login.php");
    exit;
}

try {
    $cnx->beginTransaction();
    $id = $_GET['id'];

    $stmt1 = $cnx->prepare("DELETE FROM UTILISATEUR WHERE id_u = '$id'");
    $stmt1->execute();

    $cnx->commit();
    header("Location: ../../admin.php?section=utilisateur-gestion");
    exit;

} catch (Exception $e) {
    $cnx->rollback();
    echo "<p style='color: red;'>Erreur : " . $e->getMessage() . "</p>";

}

?>



