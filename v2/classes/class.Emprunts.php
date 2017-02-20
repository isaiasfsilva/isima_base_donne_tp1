<?php

class Emprunts
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
	public function create($id_doc,$id_user,$date_debut, $date_fin)
	{
		try
		{

			
			$res = $this->db->prepare("INSERT INTO Emprunt(id_doc,id_user,date_debut, date_fin) VALUES(:id_doc, :id_user, :date_debut, :date_fin)");
			$res->bindparam(":id_doc",$id_doc);
			$res->bindparam(":id_user",$id_user);
			$res->bindparam(":date_debut",$date_debut);
			$res->bindparam(":date_fin",$date_fin);
			$res->execute();

		

			return true;
		}
		catch(PDOException $e)
		{
				
			return false;
		}
		
	}
	
	public function getID($id_doc, $id_user, $date_debut)
	{
		$res = $this->db->prepare("SELECT * FROM Emprunt WHERE id_doc=:id_doc AND id_user=:id_user AND date_debut=:date_debut");
		$res->execute(array(":id_doc"=>$id_doc,":id_user"=>$id_user, ":date_debut"=>$date_debut));
		$editRow=$res->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($id,$id_doc,$id_user,$date_debut, $date_fin)
	{
		try
		{

			$res=$this->db->prepare("UPDATE Emprunt SET 
													   date_fin=:date_fin
													WHERE id_doc=:id_doc AND id_user=:id_user AND date_debut=:date_debut");
			$res->bindparam(":id_doc",$id_doc);
			$res->bindparam(":id_user",$id_user);
			$res->bindparam(":date_debut",$date_debut);
			$res->bindparam(":date_fin",$date_fin);

			$res->execute();
			
		


			return true;	
		}
		catch(PDOException $e)
		{
				
			return false;
		}
	}
	
	public function delete($id_doc, $id_user, $date_debut)
	{
		try{
			$res = $this->db->prepare("DELETE FROM Emprunt WHERE id_doc=:id_doc AND id_user=:id_user AND date_debut=:date_debut");
				$res->bindparam(":id_doc",$id_doc);
			$res->bindparam(":id_user",$id_user);
			$res->bindparam(":date_debut",$date_debut);
			$res->execute();
			return true;
		}
		catch(PDOException $e)
		{
			return false;
		}

	}
	
	/* paging */
	
	public function dataview($query)
	{
		$res = $this->db->prepare($query);
		$res->execute();
	
		if($res->rowCount()>0)
		{
			while($row=$res->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php print($row['titre']); ?></td>
                <td><?php print($row['nom']); ?></td>
                <td><?php print($row['date_debut']); ?></td>
                <td><?php print($row['date_fin']); ?></td>
              

               <td align="center">
                <a href="<?php echo $url_site; ?>delete/Emprunts.php?delete_id_doc=<?php print($row['id_doc']); ?>&delete_id_user=<?php print($row['id_user']); ?>&delete_date_debut=<?php print($row['date_debut']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                </td>
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Rien ici...</td>
            </tr>
            <?php
		}
		
	}
	
	public function paging($query,$records_per_page)
	{
		$starting_position=0;
		if(isset($_GET["page_no"]))
		{
			$starting_position=($_GET["page_no"]-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
	}
	
	public function paginglink($query,$records_per_page)
	{
		
		$self = $_SERVER['PHP_SELF'];
		
		$res = $this->db->prepare($query);
		$res->execute();
		
		$total_no_of_records = $res->rowCount();
		
		if($total_no_of_records > 0)
		{
			?><ul class="pagination"><?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_GET["page_no"]))
			{
				$current_page=$_GET["page_no"];
			}
			if($current_page!=1)
			{
				$previous =$current_page-1;
				echo "<li><a href='".$self."?page_no=1'>Premier</a></li>";
				echo "<li><a href='".$self."?page_no=".$previous."'>Précédent</a></li>";
			}
			for($i=1;$i<=$total_no_of_pages;$i++)
			{
				if($i==$current_page)
				{
					echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
				}
			}
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+1;
				echo "<li><a href='".$self."?page_no=".$next."'>Prochain</a></li>";
				echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Dernier</a></li>";
			}
			?></ul><?php
		}
	}
	
	/* paging */
	
}
