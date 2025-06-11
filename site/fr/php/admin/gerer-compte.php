<?php
include("../connexion.inc.php");


$sqlUser = "SELECT * FROM utilisateur";
$stmtUser = $cnx->prepare($sqlUser);
$stmtUser->execute();
$users = $stmtUser->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestion des monuments</title>
    <style>
        table {
            margin-left:-5rem;
            margin-top: 2rem;
            border-collapse: collapse;
            width: 125%;
            max-width: 900px;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            table-layout: fixed;
        }

        th, td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        th {
            background-color: #f3f4f6;
            font-weight: 600;
        }

        td {
            max-width: 30rem;
        }

        a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

      

        .actions a {
            margin-right: 10px;
        }

        td form {
            display: inline;
            margin: 0;
        }

        td form button {
        color: #2563eb;
        background: none;
        border: none;
        padding: 0;
        font: inherit;
        cursor: pointer;
        text-decoration: none;
        }

        td a {
        margin-left: 5px;
        text-decoration: none;
        }

        td a:hover, button:hover {
        text-decoration: underline;
        }

    </style>
</head>
<body>
    <table>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>

        <?php 
            foreach ($users as $user){
                $id_r = $user['id_r'];
                $sqlRole = "SELECT _nom_r FROM role WHERE id_r = '$id_r'";
                $stmtRole = $cnx->prepare($sqlRole);
                $stmtRole->execute();
                $role = $stmtRole->fetch(PDO::FETCH_ASSOC);
                $nom_role = $role['_nom_r'];
              
                echo "<tr>
                    <td>" . $user['nom'] . "</td>
                    <td>" . $user['prenom'] . "</td>
                    <td>" . $nom_role . "</td>
                    <td>
                        <a href='php/admin/suppr-user.php?id=" . $user['id_u'] . "' onclick=\"return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');\">Supprimer</a>                    </td>
                </tr>";

            }
        ?>

    </table>
</body>
</html>
