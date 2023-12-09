<?php 
    if(isset($_POST['envoyer'])){
        include("connexion.php");
        $email=$_GET["Login"];
        $pass=$_GET["password"];
        $nom=$_GET["Nom"];
        $prenom=$_GET["Prenom"];
        $ville=$_GET["txt_ville"];
        $date_naissance=$_GET["date"];
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