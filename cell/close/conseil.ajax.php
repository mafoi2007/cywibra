<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
    if(isset($_POST['niveau'])){
        $niveau = (int) $_POST['niveau'];
        if($niveau==0){
            $msg = "<h3 class='alert'>Choisir une classe.</h3>";
            echo $msg;
        }else{ 
            $classe = $config->getClasseByNiveau($niveau); 
            echo '<pre>'; print_r($classe); echo '</pre>';
            ?>
            <select name='classe' id='classe' onChange='showEleveClasse()'>
                
            </select>
       <?php 
        }
        echo $niveau;
    }
    echo "eee";
	print_r($_POST);
	
?>
