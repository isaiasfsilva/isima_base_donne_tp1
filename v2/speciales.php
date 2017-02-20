<?php
include_once 'classes/dbconfig.php';




?>
<?php include_once 'general/header.php'; ?>

<div class="clearfix"></div>

<div class="container">
    <?php 
        $res = $DB_con->prepare('call number_users');
        $res->execute();
        $row =$res->fetch(PDO::FETCH_ASSOC);
        
    ?>
    <h4>Nombre des Utilisateurs dans le système: <?php echo "<b>".$row['nusers']."</b>"; ?></h4>
    
    Usage <i>(Procedure)</i>: <code>call number_users;</code>

    <?php 
        $res = $DB_con->prepare('call number_docs');
        $res->execute();
        $row =$res->fetch(PDO::FETCH_ASSOC);
        
    ?>
    <h4>Nombre des Documents dans le système: <?php echo "<b>".$row['ndocs']."</b>"; ?></h4>
    
    Usage <i>(Procedure)</i>: <code>call number_docs;</code>


    <?php 
        $res = $DB_con->prepare('call number_emprunt');
        $res->execute();
        $row =$res->fetch(PDO::FETCH_ASSOC);
        
    ?>
    <h4>Nombre des Emprunts dans le système: <?php echo "<b>".$row['nemp']."</b>"; ?></h4>
    
    Usage <i>(Procedure)</i>: <code>call number_emprunt;</code>

    <?php 
        $res = $DB_con->prepare('SELECT emprunts_today() AS nemp');
        $res->execute();
        if($res->rowCount()>0){
            $row =$res->fetch(PDO::FETCH_ASSOC);
        }else{
            $row['nemp']=0;
        }
    ?>
    <h4>Nombre des Emprunts qui la date_debut est aujoutd'hui <b>aujourd'hui</b>: <?php echo "<b>".$row['nemp']."</b>"; ?></h4>
    
    Usage <i>(FUNCTION)</i>: <code>SELECT emprunts_today() AS nb_emp;</code>
</div>

<div class="clearfix"></div><br />



<?php include_once 'general/footer.php'; ?>