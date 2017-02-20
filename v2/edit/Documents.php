<?php
include_once '../classes/dbconfig.php';
include_once '../classes/class.Documents.php';

$Documents = new Documents($DB_con);


if(isset($_POST['btn-update']))
{
	$id = $_GET['edit_id'];
	$anee = $_POST['anee'];
    $titre = $_POST['titre'];
    $niv_config = $_POST['niv_config'];
    $type = $_POST['type'];
    $auteurs = explode(",",$_POST['multiple_value_auteurs']);
    
   
	
	if($Documents->update($id,$anee,$titre,$niv_config,$type,$auteurs))
	{
		$msg = "<div class='alert alert-info'>
				Vos données sont mises à jour avec succès. <a href='".$url_site."Documents.php'>Retourner à la liste</a>!
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
	extract($Documents->getID($id));	
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
            <td>Titre</td>
            <td><input type='text' name='titre' class='form-control' value="<?php echo $titre; ?>" required></td>
        </tr>
 
        <tr>
            <td>Anée</td>
            <td><input type='number' name='anee' class='form-control' min="2005" max="2017" value="<?php echo $anee; ?>" required></td>
        </tr>
 

        <tr>
            <td>Confidentialité</td>
            <td>
                <select name="niv_config" class='form-control' required>
                  <option value="0" <?php echo ($niv_config==0)?"selected":""; ?>>Inactif</option>
                  <option value="1" <?php echo ($niv_config==1)?"selected":""; ?>>Actif</option>
                </select>
          </td>
        </tr>
        <tr>
            <td>Type</td>
            <td>
                <select name="type" class='form-control' required>
                  <option value="Rapport" <?php echo ($type=="Rapport")?"selected":""; ?>>Rapport</option>
                  <option value="Lettre" <?php echo ($type=="Lettre")?"selected":""; ?>>Lettre</option>
                  <option value="Plan" <?php echo ($type=="Plan")?"selected":""; ?>>Plan</option>
                  <option value="Note" <?php echo ($type=="Note")?"selected":""; ?>>Note</option>
                  <option value="Contrat" <?php echo ($type=="Contrat")?"selected":""; ?>>Contrat</option>
                </select>
                 
            </td>
        </tr>
       
        <tr>
            <td>Auteurs</td>
            <td>
                
                <select id='auteurs' name='auteurs[]'  multiple='multiple'>
                <?php 



                    $res = $DB_con->prepare("select id, nom from Utilisateur");
                    $res->execute();
                    $vac='';
                    if($res->rowCount()>0){
                        while($row=$res->fetch(PDO::FETCH_ASSOC)){
                           
                            ?>
                                <option id="item_<?php print($row['id']); ?>" value='<?php print($row['id']); ?>' ><?php print($row['nom']); ?></option>
                            <?php
                        }
                    
                    }

                ?>
                 
                </select>
                <input type="hidden" name="multiple_value_auteurs" id="multiple_value_auteurs" />
               
            </td>

        </tr>




        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update
				</button>
                <a href="<?php echo $url_site;?>/Documents.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Annuler</a>
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