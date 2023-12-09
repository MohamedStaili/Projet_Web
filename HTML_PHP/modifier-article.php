<?php
    session_start();
    $bdd=new PDO('mysql:host=localhost;dbname=gestion','root','');
    if(!$_SESSION['admin']){
        header("Location: index.php");
        exit;
    }
    else{
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $get=$_GET['id'];
                $sql=$bdd->prepare("select * from article where id=?");
                $sql->execute(array($get));
                if($sql->rowcount()>0){
                    $article=$sql->fetch();
                    $_titre=$article['titre'];
                    $_desc=$article['description'];
                    $image=$article['photo'];
                }
                else
                    exit;
                if(isset($_POST['envoyer'])){
                    $tit=$_POST['titre'];
                    $des=$_POST['description'];
                    if(isset($_FILES['image']) && $_FILES['image']['error']==0){
                        $dossier='photo/';
                        $temp_name=$_FILES['image']['tmp_name'];
                        if(!is_uploaded_file($temp_name)){
                            exit("le fichier est introuvable");
                        }
                        if($_FILES['image']['size']>=1000000){
                            exit("le fichier est trés volumineaux");
                        }
                        $info=pathinfo($_FILES['image']['name']);
                        $extension=$info['extension'];
                        $extension=strtolower($extension);
                        $ext=array('jpg','jpeg','png');
                        if(!in_array($extension,$ext)){
                            exit("l'extension doit etre jpg jpeg ou png");
                        }
                        $nom_photo=$get.".".$extension;
                        if(!move_uploaded_file($temp_name,$dossier.$nom_photo)){
                            exit("probleme dans le telechargement de l'image,Ressayer");
                        }
                        $photo_name=$nom_photo;

                    }
                    else{
                        $photo_name="$image";
                    }
                    $res=$bdd->prepare("select * from article where id=?");
                    $res->execute(array($get));
                    if($res-> rowcount()>0){
                        $modi = $bdd->prepare("UPDATE article SET titre=?, description=?,photo=? WHERE id=?");

                        // Assurez-vous que $tit et $des contiennent les valeurs que vous souhaitez mettre à jour
                        $modi->execute(array($tit,$des,$photo_name,$get));
                        header("Location:article.php");
                    }
                    else
                        echo 'aucun article est trouvé';

                }
            }
            else
                echo 'aucun article a été recuperé';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="titre" id="" value="<?=$_titre;?>"><br>
        <textarea name="description" id="" cols="30" rows="10"><?=$_desc;?></textarea><br>
        <input type="file" name="image"><br>
        <input type="submit" name="envoyer" value="Modifier">
    </form>
</body>
</html>