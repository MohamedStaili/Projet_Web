<?php
    session_start();
    include("connexion.php");
    $id=$_GET['id'];
    $sql="select *from article_proposé where id=$id";
    $res=mysqli_query($link,$sql);
    $ref=mysqli_fetch_assoc($res);
    $tit=$ref['titre'];
    $descr=$ref['description'];
    $sql2="insert into article(titre,description) value('$tit','$descr')";
    $res2=mysqli_query($link,$sql2);
    if($res){
        echo 'l\'article est publiée';
    }
    else
        echo 'il ya un probleme';

    ?>