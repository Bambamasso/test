<?php

 if(!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['password'])){
    $nom=trim(strip_tags($_POST['nom']))  ;
    $email=trim(strip_tags($_POST['email']));
    $password=trim(strip_tags($_POST['password']));

       if(empty($nom)|| strlen($nom)<3){
        $message_nom="veillez revoir le nom svp";
       }

       if(empty($email) || strlen($email)<3){
       $message_email="Ceci n'est pas une adresse email correcte";
       }

       if(empty($password)|| strlen($password)<3){
        $message_password="veillez revoir le mot de passe svp";
       }  
     
        if(!isset($message_nom) && !isset($message_email) && isset($message_password)){
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

 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link type="text/css" rel="stylesheet" href="connexion.css">

</head>
<body>
   <div class="inscription">
   
   <div class="contenu">
   <h2>Bienvenue sur la page de D'inscription</h2>
      <form action="" method="post">
        <div class="group">
            <label for="">Nom</label>
            <input type="text" name="nom">
            <?php if(!empty($message_nom)){
                echo "<p style='color:red'; >$message_nom</p>";
            }?>
        </div>

        <div class="group">
            <label for="">Adresse Email</label>
            <input type="email" name="email">
            <?php if(!empty($message_email)){
                echo "<p style='color:red'; >$message_email</p>";
            }?>
        </div>
        <div class="group">
            <label for="">Mot de passe</label>
            <input type="password" name="password">
            <?php if(!empty($message_password)){
                echo "<p style='color:red'; >$message_password</p>";
            }?>
        </div>

        <input type="submit" value="S'inscrire">
        <p>Vous avez un compte? <a href="./connexion.php">connectez-vous</a></p> 
      </form>

    </div>
   </div>
</body>
</html>