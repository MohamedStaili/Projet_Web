<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
</head>
<body>
    <form action="" method="post">
        <label for="email">Entrer votre email</label>
        <input type="text" name="email" id="email"><br>
        <input type="submit" name="envoyer" id="">

    </form>
</body>
</html>
<?php
    include("connexion.php");
    if(isset($_POST['envoyer']) ){
        $email=$_POST['email'];
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
           $sql2="select *from user where LOGIN='$email'";
           $req=mysqli_query($link,$sql2);
           if(mysqli_num_rows($req) > 0){
                $password=uniqid();
                $message="Bonjour votre password est: $password";
                $header ="From: 5254mohamed@gmail.com";
                $subject="Mot de passe";
                if(mail($email,$subject,$message,$header)){
                    $sql="UPDATE user SET PASSWORD='$password' where LOGIN='$email'";
                    $res=mysqli_query($link,$sql);
                    if($res){
                        header("Location: Login.php");
                    }
                    else
                        echo 'veuillez ressayer';
                }
                else
                    echo 'un probleme';
            }
            else
                echo 'veuillez verifier votre email';

        }
        else
            echo 'veuillez saisir un email valide';
        


    }
?>