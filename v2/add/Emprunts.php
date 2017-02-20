<?php
include_once '../classes/dbconfig.php';
include_once '../classes/class.Emprunts.php';

$Emprunts = new Emprunts($DB_con);

if(isset($_POST['btn-save']))
{
    $id_doc = $_POST['id_doc'];
    $id_user = $_POST['id_user'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];

   
	if($Emprunts->create($id_doc,$id_user,$date_debut, $date_fin))
	{
		header("Location: Emprunts.php?inserted");
	}
	else
	{
		header("Location: Emprunts.php?failure");
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
    Vos données sont ajoutées à la base de données avec succès...<a href="<?php url_site;?>Emprunts.php">Retourner</a>!
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
            <td>Document</td>
            <td>
                
                <select id='id_doc' name='id_doc' class='form-control'>
                <?php 
                    $res = $DB_con->prepare("select id, titre from Documents");
                    $res->execute();
                
                    if($res->rowCount()>0){
                        while($row=$res->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <option value='<?php print($row['id']); ?>'><?php print($row['titre']); ?></option>
                            <?php
                        }
                    }
                ?>
                 
                </select>

               
            </td>

        </tr>
 
        <tr>
            <td>Lecteur</td>
            <td>
                
                <select id='id_user' name='id_user' class='form-control'>
                <?php 
                    $res = $DB_con->prepare("select id, nom from Utilisateur");
                    $res->execute();
                
                    if($res->rowCount()>0){
                        while($row=$res->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <option value='<?php print($row['id']); ?>'><?php print($row['nom']); ?></option>
                            <?php
                        }
                    }
                ?>
                 
                </select>

               
            </td>

        </tr>

        <tr>
        <td>Date Début</td>
            <td><input type='date' name='date_debut' class='form-control' required></td>
        </tr>

                <tr>
            <td>Date Fin</td>
            <td><input type='date' name='date_fin' class='form-control' required></td>
        </tr>


        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Enregistrer
			</button>  
            <a href="<?php echo $url_site;?>Emprunts.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Annuler</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once '../general/footer.php'; ?>
