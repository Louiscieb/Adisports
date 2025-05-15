 <?php 
session_start(); 
if (!isset($_SESSION["username"])) {
    header("Location: Acceuil.html");
    exit();    
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" href="./Images/Logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="Acceuil.js"></script>
    
    <title>Adisport</title>
</head>

<body>
    <div class="entete">
        <div class="titre">
            <h1>Adisport</h1>
            <h4>Devine les tous!</h4>
        </div>
        <div class="photo_prof">
            <img id="photo_p" src="Images/profil1.png" alt="Photo de profil">
            <div class="utilisateur">
                <?php echo $_SESSION["username"]; ?>
            </div>
            
            <script>
                const user = <?php echo json_encode($_SESSION['username']); ?>;
            </script>
        </div>
    </div>
    
    <div class="corp">
        <div class="formulaire-box">
            
            <h2>Connectez-vous </h2>
            <form id="form_serv_connect" method="POST">
                <label for="usr">Nom Serveur</label>
                <input id="usr" type="text" name="nom" required>
                <label for="mdp">Mot de passe</label>
                <input id="mdp" type="password" name="mdp" required>
                <button class="bouton_page" type="submit">Se connecter</button>
            </form>
           

            
            <h2>Créer un Serveur</h2>
            <form id="form_creat_serv" method="POST">
                <label for="serv_nom">Nom Serveur</label>
                <select class="choix" name="nom" id="serv_nom" required>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                </select>
                <label for="serv_mdp">Mot de passe</label>
                <input id="serv_mdp" type="password" name="mdp" required>
                <button class="bouton_page" type="submit">Créer</button>
            </form>
            
        </div>

        <div class="serveur-box">
            <div class="context_serveur">
                <h2 id="titre_S1">Serveur 1</h2>
                <p><strong>Host :</strong> <span id="host1">Aucun</span></p>
                <p><strong>Joueurs :</strong></p>
                <ul id="joueur1_list"></ul>
            </div>

            <div class="context_serveur">
                <h2 id="titre_S2">Serveur 2</h2>
                <p><strong>Host :</strong> <span id="host2">Aucun</span></p>
                <p><strong>Joueurs :</strong></p>
                <ul id="joueur2_list"></ul>
            </div>
        </div>
    </div>
    <script src="serveur.js"></script>
</body>
</html>

