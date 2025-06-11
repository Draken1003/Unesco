<?php

$host = 'dpg-d14u13odl3ps73a189e0-a.frankfurt-postgres.render.com';
$port = 5432;
$dbname = 'unescodatabase';
$user = 'unescodatabase_user';
$pass = '5n1R7KPsU4OaFzFUPlwlbNaJn1j0QzIg';

try {
    $cnx = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

?>
