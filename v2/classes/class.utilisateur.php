<?php

class utilisateur
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
	public function create($nom,$prenom,$config)
	{
		try
		{
			$res = $this->db->prepare("INSERT INTO Utilisateur(nom,prenom,config) VALUES(:nom, :pnom, :config)");
			$res->bindparam(":nom",$nom);
			$res->bindparam(":pnom",$prenom);
			$res->bindparam(":config",$config);
			$res->execute();
			return true;
		}
		catch(PDOException $e)
		{
			
			return false;
		}
		
	}
	
	public function getID($id)
	{
		$res = $this->db->prepare("SELECT * FROM Utilisateur WHERE id=:id");
		$res->execute(array(":id"=>$id));
		$editRow=$res->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($id,$nom,$prenom,$config)
	{
		try
		{
			$res=$this->db->prepare("UPDATE Utilisateur SET nom=:nom, 
		                                               prenom=:prenom, 
													   config=:config
													WHERE id=:id ");
			$res->bindparam(":nom",$nom);
			$res->bindparam(":prenom",$prenom);
			$res->bindparam(":config",$config);
			$res->bindparam(":id",$id);
			$res->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			
			return false;
		}
	}
	
	public function delete($id)
	{
		try{
			$res = $this->db->prepare("DELETE FROM Utilisateur WHERE id=:id");
			$res->bindparam(":id",$id);
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
                <td><?php print($row['id']); ?></td>
                <td><?php print($row['nom']); ?></td>
                <td><?php print($row['prenom']); ?></td>
                <td><?php echo ($row['config']==1)?"Actif":"Inactif"; ?></td>
                <td align="center">
                <a href="<?php echo $url_site; ?>edit/utilisateur.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="<?php echo $url_site; ?>delete/utilisateur.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
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
				echo "<li><a href='".$self."?page_no=1'>First</a></li>";
				echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
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
				echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
				echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
			}
			?></ul><?php
		}
	}
	
	/* paging */
	
}
