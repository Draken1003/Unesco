<?php
session_start();

include("../connexion.inc.php");
$imgs = ["../img/card/Otagi-Nenbutsu-ji-japon.jpg", "../img/card/arch-kyoto.webp", "../img/card/hist-kyoto.jpg"];

$qry = $cnx->prepare("SELECT * FROM MONUMENT;");
$qry->execute();
$monuments = $qry->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Monuments</title>
    <link rel="stylesheet" href="lieux.css" />
    <link rel="stylesheet" href="../css/all.css" />
    <link rel="stylesheet" href="../css/card.css" />
    <link rel="stylesheet" href="../css/color_var.css" />
    <link rel="stylesheet" href="../css/font.css" />
    <link rel="stylesheet" href="../css/footer.css" />
  </head>
  <body>
    <span class="background"></span>

    <header class="menu-header" id="menu-header">
      <img src="../img/logo/logo_mcn.png" id="mcn" alt="logo" />
      <div class="menu-header-container">
        <div class="nav-links">
          <ul class="menu-header-container-page" id="menu">
            <li><a href>Accueil</a></li>
            <li><a href>Monuments</a></li>
            <li><a href>Architecture</a></li>
            <li><a href>Histoire</a></li>
          </ul>
        </div>
        <a href><img class="translate-icon" src="../img/icon/translation.png" alt /></a>
        <button class="bouton">Sign Up</button>
        <img
          src="../img/icon/menu.png"
          alt="une icone de menu"
          class="menu-icon"
          id="burger-icon"
        />
      </div>
    </header>
    <div class="center-page">
      <h1 id="page-title">Monuments</h1>
      <?php
      $counter = 0;

      foreach ($monuments as $monument) {
        // fait un nouveau card-container si counter est un multiple de 3.
        if ($counter % 3 === 0) {
            echo '<div class="card-container">';
        }
      ?>

       <!-- Card Monument -->
      <div class="card">
          <div class="img" style="background-image: url(<?php echo $imgs[$counter]; ?>);"></div>
          <div class="card-bottom">
              <div class="card-text">
                  <h1><?php echo $monument['nom']; ?></h1>
                  <p><?php echo $monument['description']; ?></p>
              </div>
              <button class="bouton">Voir plus</button>
          </div>
      </div>
      <?php
        $counter++;
        
        // ferme le container au bout de 3 cards
        if ($counter % 3 === 0 || $counter === count($monuments)) {
            echo '</div>'; 
        }
      }
      ?>
    </div>
    <footer class="footer">
      <hr />
      <div class="logo_footer">
        <span>
          <a href="https://whc.unesco.org" target="_blank"
            ><img src="../img/logo/UNESCO_logo.png" width="50px" alt
          /></a>
        </span>
        <span>
          <a href="https://whc.unesco.org/en/list/688/" target="_blank"
            ><img src="../img/logo/kyoto_logo.png" width="50px" alt
          /></a>
        </span>
        <span>
          <a href="https://www.univ-gustave-eiffel.fr" target="_blank"
            ><img
              class="gustave"
              src="../img/logo/logo_gustave.png"
              width="50px"
              alt
          /></a>
        </span>
      </div>

      <div class="rights">
        <p>© 2025 - Tous droits réservés</p>
      </div>
    </footer>
  </body>
  <script src="../js/navbar.js"></script>
  <script>
    const burgerIcon = document.getElementById("burger-icon");
    const menu = document.getElementById("menu");

    burgerIcon.addEventListener("click", () => {
      menu.classList.toggle("active");
    });
  </script>
</html>
