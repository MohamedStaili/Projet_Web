<?php 
    session_start();
    $bdd=new PDO('mysql:host=localhost;dbname=gestion','root','');
    if(!$_SESSION['admin']){
        header("Location: index.php");
    }
    if(isset($_POST['envoyer'])){
        if(!empty($_POST['titre']) && !empty($_POST['description'])){
            $titre=htmlspecialchars($_POST['titre']); //cettre fct est juste pour eviter de code html dans titer//
            $contenu=nl2br(htmlspecialchars($_POST['description'])); //cette fct est utilise pour n'est pas suprime les saut de lignes lorsque on le recupere au niveau de vbase de donnée//
            if(isset($_FILES['photo']) && $_FILES['photo']['error']==0){   //je verifie si le fichier est bien choisie sabs aucun probleme
                $dossier='photo/';
                $temp_name=$_FILES['photo']['tmp_name'];
                if(!is_uploaded_file($temp_name)){           //je verifie si le fichier est bien recupere
                    exit("le fichier est introuvable");
                }
                if($_FILES['photo']['size']>=1000000){
                    exit("le fichier est volumineaux");
                }
                $infosfichier=pathinfo($_FILES['photo']['name']);
                $extension_upl=$infosfichier['extension'];
                $extension_upl=strtolower($extension_upl);
                $ext_autori=array('png','jpg','jpeg');
                if(!in_array($extension_upl,$ext_autori)){
                    exit("veuillez insere une svp(extension non autorisé)");
                }
                $nom_photo=$titre.".".$extension_upl;
                if(!move_uploaded_file($temp_name,$dossier.$nom_photo)){
                    exit("probleme dans le telechargement de l'image,Ressayer");
                }
                $ph_name=$nom_photo;
            }
            else    
                $ph_name="inconnu.jpg";
            $res=$bdd->prepare("insert into article(titre,description,photo) value (?,?,?)");
            $res->execute(array($titre,$contenu,$nom_photo));
            echo 'l\'article a bien été envoyer';
        }
        else
            echo 'veullez remplir tous les champs';

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier un article</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="titre" id=""><br>
       <textarea name="description" id="" cols="30" rows="10"></textarea><br>
       <input type="file" name="photo" id="image"><br><br>
       <input type="submit" name="envoyer">
    </form>
    
</body>
</html>