<?php

 if(!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['password'])){
    $nom=$_POST['nom'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $connexion=mysqli_connect('localhost', 'root', '', 'gestion');
    if(!$connexion){
    die("erreur");
    }

    $insert = "INSERT INTO users(nom, email, password) ";
$insert .= "VALUES('$nom', '$email', '$password')";

$resultat = mysqli_query($connexion, $insert);

if ($resultat) {
   header ("LOCATION:./connexion.php");
} else {
    // Erreur lors de l'exécution de la requête
    // Vous pouvez gérer l'erreur ou afficher un message d'erreur
    echo "Erreur : " . mysqli_error($connexion);
}


 
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
      <form action="" method="post">
        <div>
            <label for="">Nom</label>
            <input type="text" name="nom">
        </div>

        <div>
            <label for="">Adresse Email</label>
            <input type="email" name="email">
        </div>
        <div>
            <label for="">Mot de passe</label>
            <input type="password" name="password">
        </div>

        <input type="submit" value="S'inscrire">
      </form>

    </div>
</body>
</html>