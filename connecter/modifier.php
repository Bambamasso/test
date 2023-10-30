
 <?php 
 session_start();
 $connexion=mysqli_connect('localhost', 'root', '', 'gestion');
     if(!$connexion){
     die("erreur");
     }
 
 if(!empty($_SESSION['user_id'])){
    $idUtilisateur=$_SESSION['user_id'];
    $select="SELECT * FROM users WHERE id='$idUtilisateur'";
    $requet=mysqli_query($connexion,$select);
    $user=mysqli_fetch_assoc($requet);
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
        <nav>
            <p>GstTâche</p>
            <ul>
                <li><a href="./index.php">accueil</a></li>
                <li><a href="./deconnexion.php">Deconnexion</a></li>
            </ul>
        </nav>
    </div>
    <div>
       <form action="" method="post">

       <div>
            <label for="">Titre</label>
            <input type="text" name="titre">
       </div>

       <div>
            <label for="">Description</label>
           <textarea  id="" cols="30" rows="10" name="description"></textarea>
       </div>

       <div>
            <label for="">Date d'échéance</label>
            <input type="date" name="date">
       </div>

       <div>
            <label for="">Priorité</label>
            <input type="text" name="priorite">
       </div>

       <input type="submit" value="Enregistrer">
       </form>

    </div>
</body>
</html>