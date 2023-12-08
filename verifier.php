<?php
$Login = $_POST['Login'];
$pass = $_POST['pass'];

if (empty($Login) or empty($pass)) {
    print 'Veuillez entrer votre login et mot de passe';
    print "<a href='javascript: history.go(-1)'>Retour</a>";
} else {
    $link = mysqli_connect("localhost","root","","gestion");

    if ($link) {
        $sql = "SELECT * FROM user WHERE LOGIN='$Login'";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result)>0) {
            $row = mysqli_fetch_assoc($result);
            if ($row && $row['PASSWORD'] == $pass) {
                session_start();
                $_SESSION['prenom']=$row['PRENOM'];
                $_SESSION['nom']=$row['NOM'];
                $_SESSION['id_user'] = $row['LOGIN'];
                header("Location: HTML.php");
            } else {
                print "Mot de passe ou login incorrect<br>";
                print "<a href='javascript: history.go(-1)'>Retour</a>";
            }
        } else {
            print "Login est incorrect";
        }

        mysqli_close($link);
    } else {
        die("Ehec de la connetion:" .mysqli_connect_error());
    }
}
