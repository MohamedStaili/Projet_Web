<?php
    session_start();
    $bdd=new PDO('mysql:host=localhost;dbname=gestion','root','');
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $get_id=$_GET['id'];
        $res=$bdd->prepare("select * from membre where id=?");
        $res->execute(array($get_id));
        if($res-> rowcount()>0){
            $banirUser=$bdd->prepare("delete  from membre where id=?");
            $banirUser->execute(array($get_id));
            header("Location:membre.php");

        }
        else
            echo 'aucun membre n\'a été recuperé';

    }
    else{
        echo 'l \'id n\'est pas bien recupere';
    }
?>