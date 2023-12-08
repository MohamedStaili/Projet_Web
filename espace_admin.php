<?php 
    session_start();
    if(!$_SESSION['admin']){
        header("Location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <a href="membre.php">Afficher les membres</a><br>
    <a href="publier-article.php">Publier des nouvaux Articles</a><br>
    <a href="article.php">Afficher tous les articles</a><br>
    <a href="contenu_proposer.php">Proposition des Clubs</a><br>
    <a href="HTML.php">Voir en tant que utilisateurs</a>
    
</body>
</html>