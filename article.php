<?php 
    session_start();
    $bdd=new PDO('mysql:host=localhost;dbname=gestion','root','');
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
    <title>Afficher tous les articles</title>
</head>
<body>
    <?php 
        $res=$bdd->query("select * from article"); /*<? =$var ?> c'est equivalent 
                                                        à écrire <?php echo $var ?> 
                                                        on l'utilise comme short 
                                                        forme de php pour afficher 
                                                        contenu en html*/
        while($article=$res->fetch()){
            $lien=$article['photo'];
            ?>
            <div class="article" style="border:1px solid black; margin-bottom:10px;text-align: center">
                <h1><?=$article['titre'];  ?></h1>
                <p><?=$article['description'];?></p>
                <p><img src="photo/<?=$lien?>" alt="" width="100px" height="100px"></p>
                <a href="supprimer-article.php?id=<?=$article['id']?>">
                <button style=" color:red;padding:4px;margin: 4px;">Supprimer</button>
                </a>
                <br>
                <a href="modifier-article.php?id=<?=$article['id']?>">
                <button style=" color:red;padding:4px;margin: 4px;">Modifier</button>
                </a>
            </div>
            <?php
        }
    ?>
</body>
</html>