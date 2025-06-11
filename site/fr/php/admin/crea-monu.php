<?php
    include("../connexion.inc.php");  

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["valider"])){

    
       try {
        $cnx->beginTransaction();

        $nom = $_POST["nom"];
        $description = $_POST["description"];
        $descriptionA= $_POST["descriptionA"];
        $lien = $_POST["lien"];
        $iframe= $_POST["iframe"];
        $adresse= $_POST["adresse"];


        $sql = "INSERT INTO monument (nom, description, google_map, description_ang, iframe, adresse) VALUES (:nom, :description,:lien, :descriptionA , :iframe, :adresse) RETURNING id_m";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':lien', $lien);
        $stmt->bindParam(':iframe', $iframe);
        $stmt->bindParam(':descriptionA', $descriptionA);
        $stmt->bindParam(':adresse', $adresse);


        $stmt->execute();

        $id_m = $stmt->fetchColumn();

        foreach ($_POST["sections"] as $section) {
        $langue_code = $section["langue_code"];
        $ordre = $section["ordre"];
        $titre = $section["titre"];
        $texte = $section["texte"];

        $sql_section = "INSERT INTO section (id_m, langue_code, ordre, titre, texte)  VALUES (:id_m, :langue_code, :ordre, :titre, :texte)";
        $stmt_sec = $cnx->prepare($sql_section);
        $stmt_sec->bindParam(':id_m', $id_m);
        $stmt_sec->bindParam(':langue_code', $langue_code);
        $stmt_sec->bindParam(':ordre', $ordre);
        $stmt_sec->bindParam(':titre', $titre);
        $stmt_sec->bindParam(':texte', $texte);
        $stmt_sec->execute();
    }
    
    

        $cnx->commit();
        $_SESSION['message'] = "Monument ajouté avec succès.";
        header("Location: admin.php?section=monument-creation");
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

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" rows="3" required></textarea>


        <label for="descriptionA">Description Anglais :</label>
        <textarea id="descriptionA" name="descriptionA" rows="3" required></textarea>

        <label for="lien">Lien Google Maps :</label>
        <input type="url" id="lien" name="lien" required>

        <label for="iframe">Iframe du lieu :</label>
        <input type="url" id="iframe" name="iframe" required>

         <label for="iframe">Adresse :</label>
        <input type="text" id="adr" name="adresse" required>

        <label for="nb_sections">Sections :</label>
        <div id="error"></div>

        <div class="sections-container" id="sections-container">

            <div class="section-block">

                <h3>Section 1</h3>
                <label for="langue_code_1">Langue :</label>
                <select name="sections[1][langue_code]" id="langue_code_1">
                    <option value="fr">Français</option>
                    <option value="en">Anglais</option>
                </select>
                <label for="ordre_1">Ordre :</label>
                <input type="number" name="sections[1][ordre]" id="ordre_1" min="1" required readonly>
                <label for="titre_1">Titre :</label>
                <input type="text" name="sections[1][titre]" id="titre_1" required>
                <label for="texte_1">Texte :</label>
                <textarea name="sections[1][texte]" id="texte_1" rows="10" required></textarea>


            </div>

            <div class="section-block">

                <h3>Section 2</h3>
                <label for="langue_code_2">Langue :</label>
                <select name="sections[2][langue_code]" id="langue_code_2">
                    <option value="fr">Français</option>
                    <option value="en">Anglais</option>
                </select>
                <label for="ordre_2">Ordre :</label>
                <input type="number" name="sections[2][ordre]" id="ordre_2" min="1" required readonly>
                <label for="titre_2">Titre :</label>
                <input type="text" name="sections[2][titre]" id="titre_2" required>
                <label for="texte_2">Texte :</label>
                <textarea name="sections[2][texte]" id="texte_2" rows="10" required></textarea>


            </div>

            <div class="section-block">

                <h3>Section 3</h3>
                <label for="langue_code_3">Langue :</label>
                <select name="sections[3][langue_code]" id="langue_code_3">
                    <option value="fr">Français</option>
                    <option value="en">Anglais</option>
                </select>
                <label for="ordre_3">Ordre :</label>
                <input type="number" name="sections[3][ordre]" id="ordre_3" min="1" required readonly>
                <label for="titre_3">Titre :</label>
                <input type="text" name="sections[3][titre]" id="titre_3" required>
                <label for="texte_3">Texte :</label>
                <textarea name="sections[3][texte]" id="texte_3" rows="10" required></textarea>


            </div>

        </div>

        <div class="button-container" id="button-container">
            <button type="button" id="add"> Ajouter une section</button>
            <button type="button" id="del"> Supprimer une section</button>

        </div>
        
        <input type="submit" name="valider">
    </form>

    <script>
        let count = 3;
        const sectionContainer = document.getElementById("sections-container");
    
    
        function createSection() {
            console.log("createSection called");
            count++;
            console.log(count);
            const div = document.createElement("div");
            div.classList.add("section-block");
            div.innerHTML = `
                <h3>Section ${count}</h3>
                <label for="langue_code_${count}">Langue :</label>
                <select name="sections[${count}][langue_code]" id="langue_code_${count}">
                    <option value="fr">Français</option>
                    <option value="en">Anglais</option>
                </select>
                <label for="ordre_${count}">Ordre :</label>
                <input type="number" name="sections[${count}][ordre]" id="ordre_${count}" min="1" required readonly>
                <label for="titre_${count}">Titre :</label>
                <input type="text" name="sections[${count}][titre]" id="titre_${count}" required>
                <label for="texte_${count}">Texte :</label>
                <textarea name="sections[${count}][texte]" id="texte_${count}" rows="10" required></textarea>
            `;
            sectionContainer.appendChild(div);
            
            const newSelect = div.querySelector('select');
            newSelect.addEventListener("change", checkEntries);
            checkEntries();
    
        }

        function deleteSection() {
            count--;
            const lastDiv = sectionContainer.lastElementChild;
            sectionContainer.removeChild(lastDiv);  
        }

        function addSection() {
            if (count < 10) {
                createSection();
            }
        }
    
        function removeSection() {
            if (count > 3) {
                deleteSection();
            }
        }
    
        function checkEntries() {
            const sectionContainer = document.getElementById("sections-container");
            if (!sectionContainer) return;

            const sectionCount = sectionContainer.children.length;

            for (let i = 0; i < sectionCount; i++) {
                const child = sectionContainer.children[i];
                const select = child.querySelector('select');
                const ordreInput = child.querySelector(`#ordre_${i + 1}`);

                if (select && ordreInput) {
                    const langueCode = select.value;
                    let ordre = 1;

                    for (let j = 0; j < i; j++) {
                        const previousSection = sectionContainer.children[j];
                        const previousSelect = previousSection.querySelector('select');
                        if (previousSelect && previousSelect.value === langueCode) {
                            ordre++;
                        }
                    }

                    ordreInput.value = ordre;
                }
            }
        }




        const addButton = document.getElementById("add");
        addButton.addEventListener("click", addSection);
    
        const removeButton = document.getElementById("del");
        removeButton.addEventListener("click", removeSection);
    
        checkEntries();
        for (let i = 1; i <= count; i++) {
            const select = document.getElementById(`langue_code_${i}`);
            if (select) {
                select.addEventListener("change", checkEntries);
            }
        }


    </script>
    
</body>
</html>
