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

if(!empty ($_GET['idprio'])){

   $prorite=$_GET['idprio'];
  $select = "SELECT * FROM taches WHERE user_id='$idUtilisateur' AND id_categorie=' $prorite'";
    $requete= mysqli_query($connexion, $select);

    $date=date("Y-m-d");
    // echo $date;

   if($requete){
     
    $voir=mysqli_fetch_all($requete, MYSQLI_ASSOC);
  //  var_dump($voir);
   }
}else{
  die("erreur");
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
 <div>
        <nav>
            <p>GstTâche</p>
            <ul>
                <li><a href="./index.php">accueil</a></li>
                <li><a href="./deconnexion.php">Deconnexion</a></li>
            </ul>
        </nav>
    </div>

    <section>
    <!-- <p>Bienvenue <?php echo $user['nom'];?> sur votre dashborde ou vous allez renseigné vos differents tâche quotidienne</p>
    <div class="a"><a href="./ajouter.php">Ajouter une tâche</a></div> -->
    <div class="contenus">
      <div class="table">
      
        <table> 
          <thead>
            <th>Titre</th>
            <th>Description</th>
            <th>Date d'échéance</th>
            <th>Priorité</th>
            <th colspan="3">action</th>
           
          </thead>
          <tbody>
          <?php foreach( $voir as $value):?>
            <tr>
              <td> <?php echo $value['titre']?></td> 
              <td><?php echo $value['description']?></td> 
              <td>
              <?php echo $value['date'];
                        
               if($value['date'] < $date){
                echo "tache en retard";
                }
              ?>
              </td> 
                <td><?php echo $value['id_categorie']?></td>
                <td><a href="modifier.php?id=<?php echo $value['id']?>">Modifier</a></td> 
                <td><a href="./suprimer.php?id=<?php echo $value['id']?>">Suprimer</a> </td> 
                <td> <button id="<?php echo $value['id']?>" onclick="statut(<?php echo $value['id']?>)">terminée</button></td>
                
              </tr>
           <?php endforeach?>
          </tbody>
  
        </table>
            
             
      </div>
    </div>
 </section>
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