<?php
include_once 'classes/dbconfig.php';
include_once 'classes/class.utilisateur.php';

$utilisateur = new utilisateur($DB_con);


?>
<?php include_once 'general/header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="<?php echo $url_site; ?>add/utilisateur.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Ajouter</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 <table class='table table-bordered table-responsive'>
     <tr>
     <th>#</th>
     <th>Nom</th>
     <th>Prénom</th>
     <th>Privilèges d'administrateur</th>
     <th colspan="2" align="center">Actions</th>
     </tr>
     <?php
		$query = "SELECT * FROM Utilisateur";       
		$records_per_page=3;
		$newquery = $utilisateur->paging($query,$records_per_page);
		$utilisateur->dataview($newquery);
	 ?>
    <tr>
        <td colspan="7" align="center">
 			<div class="pagination-wrap">
            <?php $utilisateur->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
 
</table>
   
       
</div>

<?php include_once 'general/footer.php'; ?>