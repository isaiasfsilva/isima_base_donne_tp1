<?php
include_once 'classes/dbconfig.php';
include_once 'classes/class.Emprunts.php';

$Emprunts = new Emprunts($DB_con);


?>
<?php include_once 'general/header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="<?php echo $url_site; ?>add/Emprunts.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Ajouter</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 <table class='table table-bordered table-responsive'>
     <tr>
     <th>Titre</th>
     <th>Lecteur</th>
     <th>Date Début</th>
     <th>Date_fin</th>
     <th align="center">Actions</th>
     </tr>
     <?php
     //SELECT GROUP_CONCAT(name SEPARATOR ' + ') AS order_summary FROM product WHERE product_id IN (13, 15, 16);
		$query = "SELECT id_doc, id_user,nom, titre, date_debut, date_fin from Emprunt INNER JOIN Documents on (Documents.id=Emprunt.id_doc) INNER JOIN Utilisateur on (Utilisateur.id=Emprunt.id_user)";       
		$records_per_page=3;
		$newquery = $Emprunts->paging($query,$records_per_page);
		$Emprunts->dataview($newquery);
	 ?>
    <tr>
        <td colspan="7" align="center">
 			<div class="pagination-wrap">
            <?php $Emprunts->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
 
</table>
   
       
</div>

<?php include_once 'general/footer.php'; ?>