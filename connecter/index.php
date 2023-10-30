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

}

$select = "SELECT * FROM taches WHERE user_id='$idUtilisateur'";
   $requet= mysqli_query($connexion, $select);

   if($requet){
   $tache= mysqli_fetch_all($requet, MYSQLI_ASSOC);
//  var_dump($tache);
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
       <p>bienvenue sur votre espace</p> 

       <div>
            <a href="ajouter.php">Ajouter une tâche</a>

            <div>
              <table> 
                <thead>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Date d'échéance</th>
                    <th>Priorité</th>
                    <th>action</th>
                </thead>
                <tbody>
                    <?php foreach($tache as $value ): ?>
                    <tr>
                        <td><?php echo $value['titre'];?></td>
                        <td><?php echo $value['description'];?></td>
                        <td><?php echo $value['date'];?></td>
                        <td><?php echo $value['priorite'];?></td>
                        <td><a href="./suprimer.php?id=<?php echo $value['id'];?>">Suprimer</a> <a href="./modifier.php?id=<?php echo $value['id'];?>">Modifier</a></td>
                    </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
            
            </div>
       </div>
    </div>
</body>
</html>