
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Acceuil.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=cinzia">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
  <div class="container">
    <nav class="sidebar">
      <div class="sidebar-header">
      </div>
    </nav>
    <main class="Millieu">
      <div class="Titre">
        <div class="Cont-titre">
          <h1>Le Quiz des Cités</h1>
          <h5>Énigmes urbaines captivantes</h5>
        </div>
        <div class="header-actions">
          <button class="btn-connect" onclick="Conect()">Se connecter</button>
          <button class="btn-connect" onclick="window.location.href = '../php/reation.php';">Créer un compte</button>
        </div>
      </div>
      <div class="unesco-section">
        <div class="unesco-content">
          <h3>Ce site est en partenariat avec l'Unesco et la ville de Nice</h3>
          <div class="unesco-marquee" id="unesco-marquee">
            <div class="marquee-content" id="marquee-content"></div>
          </div>
        </div>
      </div>
      <div class="grandbas">
  <div class="row">
    <div class="col">
      <img src="../image/Unesco.jpg" alt="Unesco" class="image-gauche">
    </div>
    <div class="bas">
      <div class="cont">
        <p>Bienvenue dans "Le Quiz des Cités", un passionnant jeu de culture générale sur les monuments historiques de la ville de Nice ! L'objectif est simple : testez votre culture en equipe et découvrez plus du riche patrimoine architectural de la Cité des Anges.<br> 
        Tout au long de la partie, vous allez entrer dans l'histoire et l'architecture de Nice, découvrant ou redécouvrant les trésors de cette ville méditerranéenne.Mais vous allez surtout faire de nombreuse rencontre </p>
        <h3>Alors, prêts à relever le défi et à devenir de véritables experts de la cité ?<br> Que la meuilleure equipe gagne!</h3>
        <h5><u>Conectez-vous et commencez a jouer!</u></h5>
      </div>
    </div>
    <div class="col">
      <img src="../image/Nice.jpg" alt="Photo_Nice" class="image-droite">
    </div>
  </div>
</div>
  </main>
  </div>

  <script src="../js/Acceuil.js"></script>
</body>
</html>