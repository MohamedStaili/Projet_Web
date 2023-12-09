<?php 
    session_start();
    $bdd=new PDO('mysql:host=localhost;dbname=gestion','root','');
    if(!$_SESSION['admin']){
        header("Location:index.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher les membres</title>
</head>
<body>
    <?php
        $recp=$bdd->query('select * from membre');
        while($user=$recp->fetch()){
           ?>
          <p><?=$user['Nom'];?><a href="baner.php?id=<?=$user['id'];?>">Bnnir le membre</a></p>
           <?php
        }
    ?>
    
</body>
</html>