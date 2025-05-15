<?php 
session_start(); 
echo $_SESSION["mot"];
if (!isset($_SESSION["username"])) {
    header("Location: Acceuil.html");
    exit();    
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Page.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Images/Logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
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
            <?php echo $_SESSION["username"]; ?>
            <script>
                const user = <?php echo json_encode($_SESSION['username']); ?>;
            </script>
        </div>
    </div>
    
</body>
</html>

