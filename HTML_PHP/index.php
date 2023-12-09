<?php 
session_start();
    if(isset($_POST['valider'])){
        if(!empty($_POST['name']) && !empty($_POST['mdp'])){
            include("connexion.php");
            $sql="select * from admin";
            $res=mysqli_query($link,$sql);
            $ref=mysqli_fetch_assoc($res);
            if($_POST['name']==$ref['LOGIN'] && $_POST['mdp']==$ref['MDP']){
                $_SESSION['admin']=$ref['MDP'];
                header("Location:espace_admin.php");
                exit;

            }
            else{
                echo 'Login ou mot de passe est incorrect';
            }


        }
        else{
            echo 'veuillez entrer vos informationd de connection';
        }
    }
    else
        echo 'veuillez entrer vos information de connetion';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace admoinistrateur</title>
</head>
<body>
    <form action="" method="post" align="center">
        <input type="text" name="name"><br>
        <input type="password" name="mdp"><br>
        <input type="submit" name="valider">
    </form>
</body>
</html>