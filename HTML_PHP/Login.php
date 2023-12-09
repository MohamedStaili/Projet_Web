<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="post">
        <label for="login">Login</label>
        <input type="text" name="Login" id="login"><br>
        <label for="pass">Mot de passe</label>
        <input type="password" name="pass" id="pass"><br>
        <input type="submit" name="envoyer" value="Envoyer">

    </form>
    <a href="forgot_password.php">Mot de passe oublié</a>
</body>
</html>
<?php 
session_start();
if(isset($_POST['envoyer'])){
    $email = $_POST['Login']; // Utilisation de 'Login' ici
    $pass = $_POST['pass'];
    if ((empty($email) or empty($pass))) {
        $_SESSION['erreur'] = "Veuillez entrer vos informations";
        echo  $_SESSION['erreur'];
        unset( $_SESSION['erreur']);
    } else {
        $link = mysqli_connect("localhost","root","","gestion");
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            exit("Adresse e-mail invalide.");
        }

        if ($link) {
            // Utilisation de 'LOGIN' ici
            $sql = "SELECT * FROM user WHERE LOGIN='$email'";
            $result = mysqli_query($link, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                if ($row && $row['PASSWORD'] == $pass) {
                    session_start();
                    $_SESSION['prenom'] = $row['PRENOM'];
                    $_SESSION['nom'] = $row['NOM'];
                    $_SESSION['id_user'] = $row['LOGIN'];
                    session_write_close();
                    header("Location: HTML.php");
                    exit(); 
                } else {
                    $_SESSION['error1']="Mot de passe ou login incorrect <br>";
                    echo $_SESSION['error1'];
                    unset($_SESSION['error1']);
                }
            } else {
                $_SESSION['error2']="Le Login est incorrecte";
                echo $_SESSION['error2'];
                unset($_SESSION['error2']);
            }

            mysqli_close($link);
        } else {
            die("Echec de la connexion:" .mysqli_connect_error());
        }
    }
}
?>
