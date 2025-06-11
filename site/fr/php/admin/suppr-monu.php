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

    $stmt1 = $cnx->prepare("DELETE FROM MONUMENT WHERE id_m = '$id'");
    $stmt2 = $cnx->prepare("DELETE FROM SECTION WHERE id_m = '$id'");

    $stmt2->execute();
    $stmt1->execute();

    $cnx->commit();
    $_SESSION['message'] = "Monument supprimé avec succès.";
    header("Location: ../../admin.php?section=monuments-gestion");
    exit;

} catch (Exception $e) {
    $cnx->rollback();
    echo "<p style='color: red;'>Erreur : " . $e->getMessage() . "</p>";

}

?>



