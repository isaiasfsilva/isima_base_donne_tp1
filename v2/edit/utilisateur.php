<?php
include_once '../classes/dbconfig.php';
include_once '../classes/class.utilisateur.php';

$utilisateur = new utilisateur($DB_con);


if(isset($_POST['btn-update']))
{
	$id = $_GET['edit_id'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$config = $_POST['config'];
	
	if($utilisateur->update($id,$nom,$prenom,$config))
	{
		$msg = "<div class='alert alert-info'>
				Vos données sont mises à jour avec succès. <a href='".$url_site."utilisateur.php'>Retourner à la liste</a>!
				</div>";
	}
	else
	{
		$msg = "<div class='alert alert-warning'>
				<strong>Pardon!</strong> Il y a une erreur !
				</div>";
	}
}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($utilisateur->getID($id));	
}

?>
<?php include_once '../general/header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<?php
if(isset($msg))
{
	echo $msg;
}
?>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 
     <form method='post'>
 
    <table class='table table-bordered'>
 
        <tr>
            <td>Nom</td>
            <td><input type='text' name='nom' class='form-control' value="<?php echo $nom; ?>" required></td>
        </tr>
 
        <tr>
            <td>Prénom</td>
            <td><input type='text' name='prenom' class='form-control' value="<?php echo $prenom; ?>" required></td>
        </tr>
 
        <tr>
            <td>config</td>
            <td>
                <select name="config" class='form-control' required>
                  <option value="0" <?php echo ($config==0)?"selected":""; ?>>Inactif</option>
                  <option value="1" <?php echo ($config==1)?"selected":""; ?>>Actif</option>
                </select>
          </td>
        </tr>
 
       
 
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update
				</button>
                <a href="<?php echo $url_site;?>/utilisateur.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Annuler</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once '../general/footer.php'; ?>