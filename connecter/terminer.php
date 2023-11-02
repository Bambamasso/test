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
//    var_dump($user);

}else{
 header ("LOCATION.:../connexion.php");
}

   $categorie="SELECT * FROM categories";
  $query=mysqli_query($connexion,$categorie);

 if($query){
$important=mysqli_fetch_all($query, MYSQLI_ASSOC);

}

  $select = "SELECT * FROM taches WHERE user_id='$idUtilisateur' AND statut=' terminée'";
    $requete= mysqli_query($connexion, $select);

    $date=date("Y-m-d");
    // echo $date;

   if($requete){
     
    $voir=mysqli_fetch_all($requete, MYSQLI_ASSOC);
   var_dump($voir);
   }
else{
  die("erreur");
}
?>