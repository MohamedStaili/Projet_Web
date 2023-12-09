<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    
</head>
<body>
    <fieldset style="width: 800px;">

    <form action="" method="post">
        <h2>Ctréer un compte:</h2>
        <label for="Email" class="label">Email</label>
        <input type="text" name="Login" id="Email" class="inp"><br>
        <label for="pass" class="label">Password</label>
        <input type="password" name="password" id="pass"  class="inp"><br>
        <label for="Nom" class="label">Nom</label>
        <input type="text" name="Nom" id="Nom"  class="inp"><br>
        <label for="Prenom" class="label">Prenom</label>
        <input type="text" name="Prenom" id="Prenom"  class="inp"><br>
        <label for="Ville" class="label">Ville</label>
        <select name="txt_ville" class="inp">
        <?php
        include ("connexion.php");
        $sql="select * from ville";
        $result=mysqli_query($link,$sql);
        while ($liste_ville=mysqli_fetch_assoc($result))
        {
        echo '<option value='.$liste_ville["id_ville"].'>';
        echo $liste_ville["lib_ville"];
        echo'</option>';
        }
        ?>
        </select><br>
        <label for="date" class="label">Date de Naissance</label>
        <input type="text" name="date" id="date"  class="inp" placeholder="exemple:2000-01-01"><br>
        <input type="submit" name="envoyer" value="S'inscrire">
    </form>
    </fieldset>
</body>
</html>
<?php 
    if(isset($_POST['envoyer'])){
        include("connexion.php");
        $email=$_POST["Login"];
        $pass=$_POST["password"];
        $nom=$_POST["Nom"];
        $prenom=$_POST["Prenom"];
        $ville=$_POST["txt_ville"];
        $date_naissance=$_POST["date"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            exit("Adresse e-mail invalide.");
        }
        $sql="insert into user values('$email','$pass','$nom','$prenom','$ville','$date_naissance')";
        $res=mysqli_query($link,$sql);
        if ($res==true) {
            echo "Félicitation Votre compte a été crée correctement";
            }
        else{
            echo "Erreur lors de la création de votre compte";
            }
    }
?>