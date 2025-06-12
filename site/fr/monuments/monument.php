<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link
            href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="../css/all.css">
        <link rel="stylesheet" href="../css/color_var.css">
        <link rel="stylesheet" href="../css/font.css">
        <link rel="stylesheet" href="./fushimi_inari_taisha.css">
        <link rel="stylesheet" href="../css/footer.css">
        <title>Fushimi-Inari Taisha</title>
    </head>
    <body>
        <?php
        session_start();
        include("../../connexion.inc.php");

        if(!isset($_SESSION['id_m'])) {
            header("Location: ./lieux.php");
            exit;
        }

        $id_m = $_SESSION['id_m'];

        // on select d'abord les row selon la langue pour savoir on a cmb de sections.
        // on fait nb de section + 1 pour la main_image derriere le titre
        // on genere les images dans l'array avec une boucle qui va de 1 au nb de section "../../img/monument/" . $nomMonument . "/" . $nomMonument . "$i"
        

        // Traitement du changement de langue
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_language'])) {
            header("Location: ../../fr/monuments/monument.php");
            exit;
        }

        // Récupérer les informations du monument
        $monumentQuery = $cnx->prepare("SELECT * FROM monument WHERE id_m = ? ");
        $monumentQuery->execute([$id_m]);
        $monument = $monumentQuery->fetch(PDO::FETCH_ASSOC);
        $nomMonument = $monument['nom'];

        // Récupérer les sections associées à ce monument
        $sectionsQuery = $cnx->prepare("SELECT * FROM section WHERE id_m = ? and langue_code = ? ORDER BY ordre ASC");
        $sectionsQuery->execute([$id_m, 'fr']);
        $nbSections = $sectionsQuery->rowCount();
        $nbSections++;
        $sections = $sectionsQuery->fetchAll(PDO::FETCH_ASSOC);
        
        $images = [];

        for ($i = 1; $i<=$nbSections; $i++) {
            array_push($images, '../../img/monument/' . $nomMonument . '/' . $nomMonument . $i);
        }
        
        ?>

        

        <span class="background"></span>
        <header class="menu-header" id="menu-header">
            <img src="../../img/logo/logo_mcn.png" width="11%" id="mcn" alt>
            <div class="menu-header-container">
                <ul class="menu-header-container-page">
                    <li><a href="../home.html">Accueil</a></li>
                    <li><a href="lieux.php">Monuments</a></li>
                    <li><a href="../architecture/architecture.html">Architecture</a></li>
                    <li><a href="../histoire/histoire.html">Histoire</a></li>
                </ul>
                <form method="post" class="language-form">
                    <input type="hidden" name="change_language" value="1">
                    <button type="submit" class="translate-button" aria-label="<?= ($_SESSION['language'] ?? 'fr') === 'fr' ? 'Switch to English' : 'Passer en Français' ?>">
                        <img src="../../img/icon/translation.png" alt="Language icon" class="translate-icon">
                    </button>
                </form>
                <button class="bouton">Connexion</button>
            </div>
        </header>

        <div class="container-titre">
            <img src="<?= $images[0] ?>" width="100%" alt>
            <h1 class="titre"><?= htmlspecialchars($monument['nom']) ?></h1>
        </div>

        <?php
        // Affichage dynamique des sections
        $sectionCount = 0;
        foreach ($sections as $section) {
            $sectionCount++;
            $containerClass = 'container';
            
            // Alternance entre les types de containers
            if ($sectionCount % 3 == 2) {
                $containerClass = 'container2';
            } elseif ($sectionCount % 3 == 0) {
                $containerClass = 'container3';
            }
            
            if ($containerClass == 'container') {
        ?>
        <div class="<?= $containerClass ?>">
            <div class="container-left">
                <div class="top">
                    <h1><?= htmlspecialchars($section['titre']) ?></h1>
                </div>
                <div class="bottom">
                    <p><?= htmlspecialchars($section['texte']) ?></p>
                </div>
            </div>
            <img src="<?= $images[$sectionCount % count($images)] ?>" alt>
        </div>
        
        <?php } elseif ($containerClass == 'container2') { ?>
        <div class="<?= $containerClass ?>">
            <h1><?= htmlspecialchars($section['titre']) ?></h1>
            <div class="container2-bottom">
                <div class="left">
                    <img src="<?= $images[$sectionCount % count($images)] ?>" alt>
                </div>
                <div class="right">
                    <p><?= htmlspecialchars($section['texte']) ?></p>
                </div>
            </div>
        </div>
        
        <?php } else { ?>
        <div class="<?= $containerClass ?>">
            <img src="<?= $images[$sectionCount % count($images)] ?>" alt>
            <div class="container3-right">
                <div class="top">
                    <h1><?= htmlspecialchars($section['titre']) ?></h1>
                </div>
                <div class="bottom">
                    <p><?= htmlspecialchars($section['texte']) ?></p>
                </div>
            </div>
        </div>
        <?php } 
        } ?>
        <div class="container-button">
            <a href="http://">Plus d'info</a> 
        </div>

        <div class="map">
            <div class="map-left">
                <div class="top">
                    <p>Adresse : <?= $monument['adresse'] ?></p>
                </div>
                <div class="bottom">
                    <a class="map-left-search-bar" target="_blank" href="<?= htmlspecialchars($monument['google_map']) ?>">
                        Google Map
                    </a>
                </div>
            </div>
            <iframe
                src="<?= $monument['iframe']?>"
                width="600" height="450" style="border:0;" allowfullscreen
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <footer class="footer">
            <hr>
            <div class="logo_footer">
                <span>
                    <a href="https://whc.unesco.org" target="_blank"><img
                            src="../../img/logo/UNESCO_logo.png" width="50px" alt="logo unesco"></a>
                </span>
                <span>
                    <a href="https://whc.unesco.org/en/list/688/"
                        target="_blank"><img src="../../img/logo/kyoto_logo.png"
                            width="50px" alt="logo kyoto"></a>
                </span>
                <span>
                    <a href="https://www.univ-gustave-eiffel.fr"
                        target="_blank"><img class="gustave"
                            src="../../img/logo/logo_gustave.png" width="50px" alt="logo uni eiffel"></a>
                </span>
            </div>
            <div class="rights">
                <p>© 2025 - Tous droits réservés</p>
            </div>
        </footer>

    </body>
    <script src="../js/navbar.js"></script>
</html>