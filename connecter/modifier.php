
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
 }else{
    header("LOCATION:../connexion.php");}

    if(!empty($_GET['id'])){
        $idTache=$_GET['id'];

       $tache="SELECT * FROM taches WHERE id= '$idTache' AND user_id='$idUtilisateur'"; 
       $query=mysqli_query($connexion,$tache);
       
      if($query){
        $affiche=mysqli_fetch_assoc($query);
        //  var_dump($affiche);
      }

      if(!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['date']) && !empty($_POST['priorite'])){
        $titre=$_POST['titre'];
        $description=$_POST['description'];
        $date=$_POST['date'];
        $priorite=$_POST['priorite'];

        $modif="UPDATE taches SET titre='$titre', description='$description', date='$date', id_categorie='$priorite' WHERE id= $idTache" ;
        $query=mysqli_query($connexion, $modif);
        if($query){
            $tache="SELECT * FROM taches WHERE id= '$idTache' AND user_id='$idUtilisateur'"; 
           $query=mysqli_query($connexion,$tache);
           $affiche=mysqli_fetch_assoc($query);

           header("LOCATION: ./index.php");
            echo "modification validé";  

        }
      }

      $categorie="SELECT * FROM categories";
    $query=mysqli_query($connexion,$categorie);

    if($query){
    $important=mysqli_fetch_all($query, MYSQLI_ASSOC);
    // var_dump($important);
    }
    }

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link type="text/css" rel="stylesheet" href="ajout.css">
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
  <div class="form">
  <div class="contenu">
       <form action="" method="post">

       <div class="group">
            <label for="">Titre</label>
            <input type="text" name="titre" value="<?php echo $affiche ['titre'];?>">
       </div>

       <div class="group">
            <label for="">Description</label>
           <textarea  id="" cols="30" rows="10" name="description"><?php echo $affiche ['description']?></textarea>
       </div>

       <div class="group">
            <label for="">Date d'échéance</label>
            <input type="date" name="date" value="<?php echo $affiche ['date'];?>" >
       </div>

       <div class="group">
            <label for="">Priorité</label>
            <select name="priorite" id="">
                <?php foreach($important as $value) :?>
               <option value="<?php echo $value['id']?>"><?php echo $value['type']?></option>
               <?php endforeach; ?>
            </select>
       </div>

       <input type="submit" value="Enregistrer">
       </form>

    </div>
  </div>
</body>
</html>