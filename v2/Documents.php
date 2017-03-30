<?php
include_once 'classes/dbconfig.php';
include_once 'classes/class.Documents.php';

$Documents = new Documents($DB_con);


?>
<?php include_once 'general/header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="<?php echo $url_site; ?>add/Documents.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Ajouter</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 <table class='table table-bordered table-responsive'>
     <tr>
     <th>#</th>
     <th>Anée</th>
     <th>Titre</th>
     <th>Privilèges d'administrateur</th>
     <th>Type</th>
     <th>Auteurs</th>
     <th colspan="2" align="center">Actions</th>
     </tr>
     <?php
     	$query = "SELECT Documents.id, Documents.anee, Documents.titre, Documents.type, Documents.niv_config, GROUP_CONCAT(Utilisateur.nom ORDER BY Livres_auteurs.ordre SEPARATOR ', ') auteurs FROM Documents LEFT JOIN Livres_auteurs ON Documents.id = Livres_auteurs.id_doc INNER JOIN Utilisateur ON Livres_auteurs.id_user = Utilisateur.id GROUP BY Documents.id";       
		$records_per_page=50;

		$newquery = $Documents->paging($query,$records_per_page);
		$Documents->dataview($newquery);
	 ?>
    <tr>
        <td colspan="7" align="center">
 			<div class="pagination-wrap">
            <?php $Documents->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
 
</table>
   
       
</div>

<?php include_once 'general/footer.php'; ?>
