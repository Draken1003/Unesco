<?php
session_start();
include('../connexion.inc.php');

// si il n'est pas connecté
if (!isset($_SESSION['u_id'])) {
    header("Location: login.php");
    exit;

}

if (isset($_POST['deco'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}


//si il se deco : 
if (isset($_POST['deco'])) {
    session_destroy();
    header('Location : login.php');
    exit;
}

// la section est soit celle selectionnée
$section = $_GET['section'] ?? 'bienvenue';

$validSections = [
    'bienvenue',
    'monument-creation',
    'monuments-gestion',
];

if (!in_array($section, $validSections)) {
    $section = 'bienvenue';
}

function isActive($sec, $current) {
    return $sec === $current ? 'active' : '';
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="css/color_var.css" />
<link rel="stylesheet" href="css/admin.css" />
<title>Dashboard Gestionnaire</title>
    <style>

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        .sidebar ul {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }

        .sidebar li {
            margin: 0;
            padding: 0;
        }

        .sidebar li a {
            display: block;
            padding: 10px 15px;
            color: inherit;
            text-decoration: none;
            cursor: pointer;

        }
        .sidebar li.active a {
            font-weight: bold;
        }

    </style>
</head>

<body>
<div class="admin-container">
    <div class="sidebar">
        <h1>Gestionnaire</h1>

        <div class="menu-section">
            <h2>Gestion des monuments</h2>
            <ul>
                <li class="<?= isActive('monument-creation', $section) ?>">
                    <a href="?section=monument-creation">Créer un monument</a>
                </li>
                <li class="<?= isActive('monuments-gestion', $section) ?>">
                    <a href="?section=monuments-gestion">Gérer les monuments</a>
                </li>
            </ul>
        </div>

      
        <div class="logout-container">
            <form method="post">
                <button type="submit" name="deco">
                    <img src="img/logout.png" alt="Déconnexion" />
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="content-section <?= isActive('bienvenue', $section) ?>">
            <h2>Bonjour Gestionnaire !</h2>
            <p>Bienvenue sur votre tableau de bord.</p>
            <p>Cliquez sur un onglet à gauche pour commencer.</p>
        </div>

        <div class="content-section <?= isActive('monument-creation', $section) ?>">
            <h2>Création d'un monument</h2>
            <?php 

                if (isset($_SESSION['message'])) {
                    echo "<p style='color: green;'>{$_SESSION['message']}</p>";
                    unset($_SESSION['message']);
                }

                include("php/admin/crea-monu.php");

            ?>

        </div>

        <div  class="content-section <?= isActive('monuments-gestion', $section) ?>">
            <h2>Gestion des monuments</h2>
            <?php
            
                if (isset($_SESSION['message'])) {
                    echo '<p style="color: green;">' . $_SESSION['message']. '</p>';
                }
                
                include("php/admin/gerer-monu.php"); 
            
            ?>

        </div>


    </div>
</div>
</body>

</html>
