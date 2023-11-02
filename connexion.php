<?php
session_start();

$connexion=mysqli_connect('localhost', 'root', '', 'gestion');
    if(!$connexion){
    die("erreur");
    }

 if(!empty($_POST['email']) && !empty($_POST['password'])){
    
    $email=$_POST['email'];
    $password=$_POST['password'];
    $requet="SELECT * FROM users WHERE email ='$email' &&  password='$password' " ;
    $users=mysqli_query($connexion, $requet);

    if(!$users){
    echo "oups une erreur c'est produit";
    }
    $voir= mysqli_fetch_assoc($users);
    //   var_dump($voir);

   if($voir){
    $_SESSION['user_id'] = $voir['id'];
    echo"validé";
    header("LOCATION:./connecter/index.php");
   }
   else{
    $message="email ou mot de passe incorrecte";
   }
}
else{
    $message2="veillez remplir  tout les champs svp";
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
            <h2>Connectez-vous</h2>
            <?php if(!empty($message2)){
                 echo "<p style='color:red'; >$message2</p>";
            }
            ?> 
            <form action="" method="post">

            <div class="group">
                <label for="">Adresse Email</label>
                <input type="email" name="email">
            </div>
            <div  class="group">
                <label for="">Mot de passe</label>
                <input type="password" name="password">
            </div>
            <?php if(!empty($message)){
                 echo "<p style='color:red'; >$message</p>";
            }
            ?> 
            <input type="submit" value="Se connecter">
            <p>Vous n'avez pas de compte? <a href="./inscription.php">Creer un compte</a></p> 
        </form>
            
        </div>
    </div>
</body>
</html>