<?php
    session_start();
    if(!$_SESSION['admin']){
        header("Location: index.php");
        exit;
    }
    $bdd=new PDO('mysql:host=localhost;dbname=gestion','root','');
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id_get=$_GET['id'];
        $res=$bdd->prepare("select * from article where id=?");
        $res->execute(array($id_get));
        if($res-> rowcount()>0){
            $supp=$bdd->prepare("delete from article where id=?");
            $supp->execute(array($id_get));
            header("Location:article.php");
        }
        else
            echo 'aucun article est trouvé';

    }
    else
        echo 'aucun article a été recuperé';

?>