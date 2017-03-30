<?php
include_once '../classes/dbconfig.php';
include_once '../classes/class.utilisateur.php';

$utilisateur = new utilisateur($DB_con);


if(isset($_POST['btn-del']))
{
	$id = $_GET['delete_id'];
	if($utilisateur->delete($id)){        
        header("Location: ".$url_site."delete/utilisateur.php?deleted");
    }else{
        header("Location: ".$url_site."delete/utilisateur.php?error");
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
	 if(isset($_GET['delete_id']))
	 {
		 ?>
         <table class='table table-bordered'>
         <tr>
         <th>#</th>
         <th>Nom</th>
         <th>Prénom</th>
         <th>Privilèges d'administrateur</th>
         
         </tr>
         <?php
         $stmt = $DB_con->prepare("SELECT * FROM Utilisateur WHERE id=:id");
         $stmt->execute(array(":id"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
             <td><?php print($row['id']); ?></td>
             <td><?php print($row['nom']); ?></td>
             <td><?php print($row['prenom']); ?></td>
             <td><?php echo ($row['config']==1)?"Actif":"Inactif"; ?></td>
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
if(isset($_GET['delete_id']))
{
	?>
  	<form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; OUI</button>
    <a href="<?php echo $url_site;?>/utilisateur.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NON</a>
    </form>  
	<?php
}
else
{
	?>
    <a href="<?php echo $url_site;?>utilisateur.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Retourner</a>
    <?php
}
?>
</p>
</div>	
<?php include_once '../general/footer.php'; ?>