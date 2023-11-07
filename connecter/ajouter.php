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
   

   if($user){
    #var_dump($user);

      if(!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['date']) && !empty($_POST['priorite'])){
        $titre=$_POST['titre'];
        $description=$_POST['description'];
        $date=$_POST['date'];
        $priorite=$_POST['priorite'];

           

        $insert = "INSERT INTO taches(titre, description, date, id_categorie, user_id) ";
        $insert .= "VALUES(?, ?, ?, ?, ?)";
        $tache = mysqli_prepare($connexion, $insert);
        $requete=mysqli_stmt_bind_param($tache,"ssssi",  $titre, $description, $date, $priorite,$idUtilisateur);
        mysqli_stmt_execute($tache);

            if (mysqli_affected_rows($connexion)>0) {
               header("LOCATION:index.php ");
            } else {
                echo "Erreur : " . mysqli_error($connexion);
            }

        }
   }

}

$categorie="SELECT * FROM categories";
$query=mysqli_query($connexion,$categorie);

if($query){
$important=mysqli_fetch_all($query, MYSQLI_ASSOC);
// var_dump($important);
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

<div class="sidebar">
   <div class="logo"></div>
    <ul class="menu">
      <li class="active">
        <a href="./index.php">
          <img src="../image/dashboard.png" alt="icone">
          <span>Dashboard</span>
        </a>
       
      </li>
      <li>
        <a href="">
          <img src="" alt="icone">
          <span>Profile</span>
       </a>
        
      </li>
      <li>
        <a href="">
          <img src="" alt="icone">
          <span>Tri</span>
       </a>
       
      </li>
      <li>
        <a href=""><img src="" alt="icone">
        <span>Dashboard</span></a>
       
      </li>
      <li class="logout">
        <a href="./deconnexion.php"><img src="../image/exit.png" alt="icone">
        <span >Deconnexion</span>
      </a>
       
      </li>
    </ul>
  </div>
  <div class="main--content">
        <div class="header--wrapper">
        <div class="header--title">
            <span>Primary</span>
            <h2>Dashboard</h2>

            </div>
            <div class="user--info">
            <img src="" alt="profile">
            </div>
        </div>
        <div class="form">
      <div class="contenu">
          <form action="" method="post">

                <div class="group">
                 <label for="">Titre</label>
                 <input type="text" name="titre">
                </div>

                <div class="group">
                    <label for="">Description</label>
                    <textarea  id="" cols="30" rows="10" name="description"></textarea>
                </div>

                <div class="group">
                 <label for="">Date d'échéance</label>
                 <input type="date" name="date">
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
   </div> 

</body>
</html>