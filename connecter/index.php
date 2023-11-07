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

 $select = "SELECT * FROM taches WHERE user_id='$idUtilisateur'";
    $requete= mysqli_query($connexion, $select);

    $date=date("Y-m-d");
    // echo $date;

   if($requete){
     
    $voir=mysqli_fetch_all($requete, MYSQLI_ASSOC);
   
    if(!empty($_GET['statut_id'])){
      $idStatur=$_GET['statut_id'];

     $modifie="UPDATE taches SET statut='terminée' WHERE id=$idStatur AND user_id='$idUtilisateur' " ;
     $stat=mysqli_query($connexion, $modifie);
     if(!$stat){
      die("erreur");
     }
    }
  
   };
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
    <link type="text/css" rel="stylesheet" href="./accueil.css">
</head>
<body>
<div class="sidebar">
   <div class="logo"></div>
    <ul class="menu">
      <li class="active">
        <a href="">
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
    <p>Bienvenue <?php echo $user['nom'];?> sur votre dashbord ou vous allez renseigné vos differents tâche quotidienne</p>
    <div class="inter">
     
      <div class="contenus">
        <div class="table">
        
          <table> 
            <thead>
              <th>Titre</th>
              <th>Description</th>
              <th>Date d'échéance</th>
              <th>Priorité</th>
              <th>statut</th>
              <th colspan="2">action</th>
            
            </thead>
            <tbody>
              <?php foreach( $voir as $value):?>
              <tr>
                <td> <?php echo $value['titre']?></td> 
                <td><?php echo $value['description']?></td> 
                <td>
                <?php echo  date( 'd F Y', strtotime($value["date"]));
                        
                if($value['date'] < $date){
                  echo "tache en retard";
                  }
                ?>
                </td> 
                <td><?php $value['id_categorie']?>
                <?php foreach($important as $values) :?>
                  <?php
                    if($values['id']==$value['id_categorie'] ):?>
                    <?php echo $values['type'];?>
                    <?php endif;?>
                <?php endforeach; ?>
              </td> 
              <td> <button class="active<?php if($value['statut'] == "terminée"){echo " terminer";}?>" id="<?php echo $value['id']?>" onclick="statut(<?php echo $value['id']?>)"> <?php if($value['statut'] == "terminée"){echo " terminer";}else{echo "validé";}?></button></td>
                <td><a style="text-decoration:none;" href="./suprimer.php?id=<?php echo $value['id']?>">Suprimer</a> </td>
                <td><a href="modifier.php?id=<?php echo $value['id']?>">Modifier</a></td> 
              </tr>
              <?php endforeach?>
            </tbody> 
          </table>    
        </div>

      </div>
       
      <div class="a">
       <a href="./ajouter.php">Ajouter une tâche</a>
      </div>
    </div>
  </div>  

  
</body>
<script>
  
  const statut = ( id)=>{
    // id.style.background="blue";
    window.location.href="http://localhost/test/connecter/index.php?statut_id="+id;

  }
  // function satut{
  //     let button = Document.getElementbyId('id');
  //     id.style.background="blue";
  //    }

</script>
</html>