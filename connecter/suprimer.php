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

   if($_GET['id']){
    $id=$_GET['id'];

    $suprimer= "DELETE  FROM taches WHERE id = ' $id'";
    $query= mysqli_query($connexion, $suprimer);
    if($query){
        header("LOCATION:./index.php");
    }
   }

}
?>