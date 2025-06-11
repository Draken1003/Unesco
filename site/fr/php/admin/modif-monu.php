<?php
include("../connexion.inc.php");

if (!isset($_SESSION['u_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['u_id'] != 1) {
    header("Location: home.html");
    exit;
}

$id_m = $_SESSION['id_m'];

$stmt = $cnx->prepare("SELECT * FROM monument WHERE id_m = :id_m");
$stmt->bindParam(':id_m', $id_m);
$stmt->execute();
$monument = $stmt->fetch(PDO::FETCH_ASSOC);

$stmtSections = $cnx->prepare("SELECT * FROM section WHERE id_m = :id_m ORDER BY langue_code, ordre");
$stmtSections->bindParam(':id_m', $id_m);
$stmtSections->execute();
$sections = $stmtSections->fetchAll(PDO::FETCH_ASSOC);

$count2 = count($sections);
$initialcount = $count2;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Modifier"])) {
    echo "caca";
    $postSectionsCount = count($_POST["sections"]);
    $sectionadded = $postSectionsCount - $initialcount;

    try {
        $cnx->beginTransaction();

        $id_m = $_SESSION['id_m'];

        $nom = $_POST["nom"];
        $description = $_POST["description"];
        $lien = $_POST["lien"];
        $descriptionA= $_POST["descriptionA"];
        $iframe= $_POST["iframe2"];
         $adresse= $_POST["adresse2"];

        $sql = "UPDATE monument SET nom = :nom, description = :description, google_map = :lien, iframe= :iframe, description_ang= :descriptionA, adresse= :adresse WHERE id_m = :id_m";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':lien', $lien);
        $stmt->bindParam(':iframe', $iframe);
        $stmt->bindParam(':descriptionA', $descriptionA);
        $stmt->bindParam(':adresse', $adresse);

        $stmt->bindParam(':id_m', $id_m);
        $stmt->execute();

        foreach ($_POST["sections"] as $section) {
            $id_s = $section["id_s"];
            $langue_code = $section["langue_code"];
            $ordre = $section["ordre"];
            $titre = $section["titre"];
            $texte = $section["texte"];

            $sql_section = "UPDATE section SET langue_code = :langue_code, ordre = :ordre, titre = :titre, texte = :texte WHERE id_s = :id_s AND id_m = :id_m";
            $stmt_sec = $cnx->prepare($sql_section);
            $stmt_sec->bindParam(':langue_code', $langue_code);
            $stmt_sec->bindParam(':ordre', $ordre);
            $stmt_sec->bindParam(':titre', $titre);
            $stmt_sec->bindParam(':texte', $texte);
            $stmt_sec->bindParam(':id_s', $id_s);
            $stmt_sec->bindParam(':id_m', $id_m);
            $stmt_sec->execute();
        }
        

        $cnx->commit();
        header("Location: admin.php?section=monument-modification");
        exit();

    } catch (Exception $e) {
        $cnx->rollBack();
        echo "<p style='color: red;'>Erreur : " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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

    .section-block2 {
        border: 1px solid #888;
        padding: 15px;
        border-radius: 10px;
        background-color: #f8f8f8;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    input[type="submit"] {
        background-color: rgba(249, 74, 39, 0.25);
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 1rem;
    }

    input[type="submit"]:hover {
        background-color: rgb(235, 114, 90);
    }

    .button-container2 {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        gap: 2rem;
    }

    .button-container2 button {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        gap: 2rem;
        padding: 0.7rem;
    }

    .sections-container2 {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .error2 {
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 25px;
        border-radius: 10px;
        background-color: rgba(255, 181, 181);
        border: 1px solid red;
        color: black;
    }
    </style>

</head>
<body>
    <form method="POST" action="">
        <h2>Modifier monument</h2>

        <label for="nom2">Nom :</label>
        <input type="text" id="nom2" name="nom" value="<?= $monument['nom'] ?>" required />

        <label for="description2">Description :</label>
        <textarea id="description2" name="description" rows="3" required><?= $monument['description'] ?></textarea>

         <label for="descriptionA">Description Anglais :</label>
        <textarea id="descriptionA" name="descriptionA" rows="3" required><?= $monument['description_ang']?></textarea>

        <label for="lien2">Lien Google Maps :</label>
        <input type="url" id="lien2" name="lien" value="<?= $monument['google_map'] ?>" required />

        <label for="iframe2"> Iframe du lieu :</label>
        <input type="url" id="iframe2" name="iframe2" value="<?= $monument['iframe'] ?>" required />

        <label for="adresse2"> Adresse :</label>
        <input type="text" id="adresse2" name="adresse2" value="<?= $monument['adresse'] ?>" required />

        <label>Sections :</label>
        <div id="error2"></div>

        <div class="sections-container2" id="sections-container2">
            <?php
            $i = 1;
            foreach ($sections as $s):
            ?>

            <div class="section-block2">
                <h3>Section <?= $i ?></h3>
                <input type="hidden" name="sections[<?= $i ?>][id_s]" value="<?= $s['id_s'] ?>" />
                <label for="langue_code_<?= $i ?>2">Langue :</label>
                <select name="sections[<?= $i ?>][langue_code]" id="langue_code_<?= $i ?>2">
                    <option value="fr" <?= $s['langue_code'] === 'fr' ? 'selected' : '' ?>>Français</option>
                    <option value="en" <?= $s['langue_code'] === 'en' ? 'selected' : '' ?>>Anglais</option>
                </select>

                <label for="ordre_<?= $i ?>2">Ordre :</label>
                <input type="number" name="sections[<?= $i ?>][ordre]" id="ordre_<?= $i ?>2" value="<?= $s['ordre'] ?>" min="1" required readonly />

                <label for="titre_<?= $i ?>2">Titre :</label>
                <input type="text" name="sections[<?= $i ?>][titre]" id="titre_<?= $i ?>2" value="<?= $s['titre'] ?>" required />

                <label for="texte_<?= $i ?>2">Texte :</label>
                <textarea name="sections[<?= $i ?>][texte]" id="texte_<?= $i ?>2" rows="10" required><?= $s['texte'] ?></textarea>
            </div>
            
            <?php
                $i++;
            endforeach;
            ?>
        </div>  

        <input type="submit" name="Modifier" value="Modifier" />
    </form>

    <script>
        let count2 = <?= $count2 ?>;
        const sectionContainer2 = document.getElementById("sections-container2");

        function createSection2() {
            count2++;
            const div = document.createElement("div");
            div.classList.add("section-block2");
            div.innerHTML = `
                <h3>Section ${count2}</h3>
                <label for="langue_code_${count2}2">Langue :</label>
                <select name="sections[${count2}][langue_code]" id="langue_code_${count2}2">
                    <option value="fr">Français</option>
                    <option value="en">Anglais</option>
                </select>
                <label for="ordre_${count2}2">Ordre :</label>
                <input type="number" name="sections[${count2}][ordre]" id="ordre_${count2}2" min="1" required readonly />
                <label for="titre_${count2}2">Titre :</label>
                <input type="text" name="sections[${count2}][titre]" id="titre_${count2}2" required />
                <label for="texte_${count2}2">Texte :</label>
                <textarea name="sections[${count2}][texte]" id="texte_${count2}2" rows="10" required></textarea>
            `;
            sectionContainer2.appendChild(div);

            const newSelect = div.querySelector("select");
            newSelect.addEventListener("change", checkEntries2);
            checkEntries2();
        }

        function checkEntries2() {
            const sections = sectionContainer2.children;
            for (let i = 0; i < sections.length; i++) {
                const child = sections[i];
                const select = child.querySelector("select");
                const ordreInput = child.querySelector(`#ordre_${i + 1}2`);

                if (select && ordreInput) {
                    const langueCode = select.value;
                    let ordre = 1;

                    for (let j = 0; j < i; j++) {
                        const prevSection = sections[j];
                        const prevSelect = prevSection.querySelector("select");
                        if (prevSelect && prevSelect.value === langueCode) {
                            ordre++;
                        }
                    }

                    ordreInput.value = ordre;
                }
            }
        }

        checkEntries2();

        for (let i = 1; i <= count2; i++) {
            const select = document.getElementById(`langue_code_${i}2`);
            if (select) {
                select.addEventListener("change", checkEntries2);
            }
        }
    </script>
</body>
</html>
