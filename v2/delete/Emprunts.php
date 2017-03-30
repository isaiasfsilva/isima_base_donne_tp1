<?php
include_once '../classes/dbconfig.php';
include_once '../classes/class.Emprunts.php';

$Emprunts = new Emprunts($DB_con);


if(isset($_POST['btn-del']))
{
	$id_doc = $_GET['delete_id_doc'];
    $id_user = $_GET['delete_id_user'];
    $id_date_debut = $_GET['delete_date_debut'];
	if($Emprunts->delete($id_doc, $id_user,$id_date_debut)){        
        header("Location: ".$url_site."delete/Emprunts.php?deleted");
    }else{
        header("Location: ".$url_site."delete/Emprunts.php?error");
    }
}

?>

<?php include_once '../general/header.php'; ?>

<div class="clearfix"></div>

<div class="container">

	<?php
	if(isset($_GET['deleted']))
	{
		?>
        <div class="alert alert-success">
    	<strong>Succès!</strong> Vos données sont supprimées de la base de données avec succès.... 
		</div>
        <?php
	}
	else if(isset($_GET['error']))
    {
        ?>
        <div class="alert alert-danger">
        <strong>OOPS!</strong> ERROR... 
        </div>
        <?php
    }
    else
	{
		?>
        <div class="alert alert-danger">
    	<strong>Êtes-vous sûr?</strong>  
		</div>
        <?php
	}
	?>	
</div>

<div class="clearfix"></div>

<div class="container">
 	
	 <?php
	 if(isset($_GET['delete_id_doc']) && isset($_GET['delete_id_user']) && isset($_GET['delete_date_debut']))
	 {
		 ?>
         <table class='table table-bordered'>
         <tr>
         <th>Titre</th>
         <th>Lecteur</th>
         <th>Date Début</th>
         <th>Date_fin</th>
         
         </tr>
         <?php
         $stmt = $DB_con->prepare("SELECT id_doc, id_user, nom, titre, date_debut, date_fin from Emprunt INNER JOIN Documents on (Documents.id=Emprunt.id_doc) INNER JOIN Utilisateur on (Utilisateur.id=Emprunt.id_user) WHERE Emprunt.id_doc=:id_doc AND Emprunt.id_user=:id_user AND Emprunt.date_debut=:date_debut");
         $stmt->execute(array(":id_doc"=>$_GET['delete_id_doc'],":id_user"=>$_GET['delete_id_user'],":date_debut"=>$_GET['delete_date_debut']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
             <td><?php print($row['nom']); ?></td>
             <td><?php print($row['titre']); ?></td>
             <td><?php print($row['date_debut']); ?></td>
             <td><?php print($row['date_fin']); ?></td>
             </tr>
             <?php
         }
         ?>
         </table>
         <?php
	 }
	 ?>
</div>

<div class="container">
<p>
<?php
 if(isset($_GET['delete_id_doc']) && isset($_GET['delete_id_user']) && isset($_GET['delete_date_debut']))
{
	?>
  	<form method="post">
    <input type="hidden" name="delete_id_doc" value="<?php echo $_GET['delete_id_doc']; ?>" />
    <input type="hidden" name="delete_id_user" value="<?php echo $_GET['delete_id_user']; ?>" />
    <input type="hidden" name="delete_date_debut" value="<?php echo $_GET['delete_date_debut']; ?>" />
    
    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; OUI</button>
    <a href="<?php echo $url_site;?>/Emprunts.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NON</a>
    </form>  
	<?php
}
else
{
	?>
    <a href="<?php echo $url_site;?>Emprunts.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Retourner</a>
    <?php
}
?>
</p>
</div>	
<?php include_once '../general/footer.php'; ?>