<?php
include("../connexion.inc.php");


$sqlMonu = "SELECT * FROM monument";
$stmtMonu = $cnx->prepare($sqlMonu);
$stmtMonu->execute();
$monuments = $stmtMonu->fetchAll(PDO::FETCH_ASSOC);

$afficherFormModif = false;
if (isset($_POST['modifier']) && isset($_POST['id_m'])) {
    $_SESSION['id_m'] = $_POST['id_m'];
    $afficherFormModif = true;
}

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

        #form-modif-wrapper {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            min-height: 100%;
            background: white;
            z-index: 10;
            padding: 40px;
            box-sizing: border-box;
            overflow-y: auto;
        }

        #form-modif-wrapper form {
            max-width: 600px;
            margin: auto;
        }


    </style>
</head>
<body>

<?php if (isset($_SESSION['message'])): ?>
    <p style="color: green;"><?= htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); ?></p>
<?php endif; ?>

<table>
    <tr>
        <th>Titre</th>
        <th>Description</th>
        <th>Lien Google Map</th>
        <th>Actions</th>
    </tr>

    <?php 
        foreach ($monuments as $monument){
            echo "<tr>
                    <td>" . $monument['nom'] . "</td>
                    <td>" . $monument['description'] . "</td>
                    <td><a href='" . $monument['google_map'] . "' target='_blank'>Voir</a></td>
                    <td>
                    <form method='post'>
                        <input type='hidden' name='id_m' value=" . $monument['id_m'] . ">
                        <button type='submit' name='modifier'>Modifier</button>
                    </form> 
                                           /
                        <a href='php/admin/suppr-monu.php?id=" . $monument['id_m'] . "' onclick=\"return confirm('Voulez-vous vraiment supprimer ce monument ?');\">Supprimer</a>
                    </td>
                </tr>";
        }
    ?>

</table>

<div id="form-modif-wrapper" style="display: <?= $afficherFormModif ? 'block' : 'none' ?>;">
    <?php
        include("modif-monu.php");
    ?>
</div>

<script>
    function ouvrirFormModif() {
        document.getElementById('form-modif-wrapper').style.display = 'block';
    }

    function fermerFormModif() {
        document.getElementById('form-modif-wrapper').style.display = 'none';
    }
</script>

</body>
</html>
