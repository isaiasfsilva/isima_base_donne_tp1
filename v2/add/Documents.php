<?php
include_once '../classes/dbconfig.php';
include_once '../classes/class.Documents.php';

$Documents = new Documents($DB_con);

if(isset($_POST['btn-save']))
{
	$anee = $_POST['anee'];
	$titre = $_POST['titre'];
	$niv_config = $_POST['niv_config'];
    $type = $_POST['type'];
    $auteurs = explode(",",$_POST['multiple_value_auteurs']);
	
   
	if($Documents->create($anee,$titre,$niv_config,$type,$auteurs))
	{
		header("Location: Documents.php?inserted");
	}
	else
	{
		header("Location: Documents.php?failure");
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
    Vos données sont ajoutées à la base de données avec succès...<a href="<?php url_site;?>Documents.php">Retourner</a>!
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
            <td>Titre</td>
            <td><input type='text' name='titre' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Anée</td>
            <td><input type='number' name='anee' class='form-control' min="2005" max="2017" required value="2017"></td>
        </tr>
 
        <tr>
            <td>Confidentialité</td>
            <td>
                <select name="niv_config" class='form-control' required>
                  <option value="0">Inactif</option>
                  <option value="1">Actif</option>
                </select>

            </td>
        </tr>
        
        <tr>
            <td>Type</td>
            <td>
                <select name="type" class='form-control' required>
                  <option value="Rapport">Rapport</option>
                  <option value="Lettre">Lettre</option>
                  <option value="Plan">Plan</option>
                  <option value="Note">Note</option>
                  <option value="Contrat">Contrat</option>
                </select>
                 <input type="hidden" name="multiple_value_auteurs" id="multiple_value_auteurs"  />
            </td>
        </tr>
 
        <tr>
            <td>Auteurs</td>
            <td>
                
                <select id='auteurs' name='auteurs[]'  multiple='multiple'>
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
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Enregistrer
			</button>  
            <a href="<?php echo $url_site;?>Documents.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Annuler</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once '../general/footer.php'; ?>
 <script type="text/javascript">
   
    $(function(){
        $('#auteurs').multiSelect({
          keepOrder:true,
          afterSelect: function(value, text){
            var get_val = $("#multiple_value_auteurs").val();
            var hidden_val = (get_val != "") ? get_val+"," : get_val;
            $("#multiple_value_auteurs").val(hidden_val+""+value);
          },
          afterDeselect: function(value, text){
            var get_val = $("#multiple_value_auteurs").val();
            var new_val = get_val.replace(value, "");
            $("#multiple_value_auteurs").val(new_val);
          }
        });
    });   
</script>