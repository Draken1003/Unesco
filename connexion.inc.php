<?php

$host = 'localhost';  
$dbname = 'unesco';
$user = 'enzo';
$pass = 'postgres';

try {
    $cnx = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);

    //
    //if ($cnx){
    //    echo "Connexion reussi";
    //}
  
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    
}


?>

