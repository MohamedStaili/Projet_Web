<?php
    session_start();
    include("connexion.php");
    $sql="select *from article_proposé";
    $trou=mysqli_query($link,$sql);
    while($article=mysqli_fetch_assoc($trou)){
        ?>
        <div class="article" style="border:1px solid black; margin-bottom:10px;text-align: center">
            <h1><?=$article['titre'];  ?></h1>
            <p><?=$article['description'];?></p>
            <a href="publier-article-propose.php?id=<?=$article['id'];?>">
            <button style=" color:red;padding:4px;margin: 4px;">Publier</button>
            </a>
        </div>
        <?php
    }
?>