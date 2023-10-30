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
            <label for="">Adresse Email</label>
            <input type="email" name="email">
        </div>
        <div>
            <label for="">Mot de passe</label>
            <input type="password" name="password">
        </div>

        <input type="submit" value="Se connecter">
      </form>
        
     </div>
</body>
</html>