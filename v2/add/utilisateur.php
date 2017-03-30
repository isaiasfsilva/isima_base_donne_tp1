<?php
include_once '../classes/dbconfig.php';
include_once '../classes/class.utilisateur.php';

$utilisateur = new utilisateur($DB_con);

if(isset($_POST['btn-save']))
{
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$config = $_POST['config'];
	
	if($utilisateur->create($nom,$prenom,$config))
	{
		header("Location: utilisateur.php?inserted");
	}
	else
	{
		header("Location: utilisateur.php?failure");
	}
}
?>
<?php include_once '../general/header.php'; ?>
<div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
	?>
    <div class="container">
	<div class="alert alert-info">
    Vos données sont ajoutées à la base de données avec succès...<a href="<?php url_site;?>utilisateur.php">Retourner</a>!
	</div>
	</div>
    <?php
}
else if(isset($_GET['failure']))
{
	?>
    <div class="container">
	<div class="alert alert-warning">
    <strong>OOPS!</strong> Erreur
	</div>
	</div>
    <?php
}
?>

<div class="clearfix"></div><br />

<div class="container">

 	
	 <form method='post'>
 
    <table class='table table-bordered'>
 
        <tr>
            <td>Nom</td>
            <td><input type='text' name='nom' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Prénom</td>
            <td><input type='text' name='prenom' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Status</td>
            <td>
                <select name="config" class='form-control' required>
                  <option value="0">Inactif</option>
                  <option value="1">Actif</option>
                </select>

            </td>
        </tr>
 
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Enregistrer
			</button>  
            <a href="<?php echo $url_site;?>utilisateur.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Annuler</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once '../general/footer.php'; ?>