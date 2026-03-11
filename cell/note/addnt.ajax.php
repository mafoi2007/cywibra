<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	// $note = new Note($db);
	$config = new Config($db);
	// print_r($_POST);
	if(isset($_POST['classe'])){
		$classe = (int) $_POST['classe'];
		if($classe==0){
			echo "<h3 class='alert'>Choisissez une classe.</h3>";
		}else{
			$listeMatiere = $config->listeMatiereClasse($classe);
			
			// echo '<pre>'; print_r($listeMatiere); echo '</pre>';
			if(empty($listeMatiere)){
				echo "<h3 class='alert'>Cette classe n'a pas de matière enregistrée.</h3>";
			}else{ ?>
				Matière : 
				<select name='matiere' id='matiere' onChange='listSequence()'>
					<?php for($i=0;$i<count($listeMatiere);$i++){
						$idMatiere = $listeMatiere[$i]['id_matiere'];
						$nomMatiere = strtoupper($listeMatiere[$i]['nom_matiere']);
						echo "<option value='".$idMatiere."'>".$nomMatiere."</option>";
					}?>
					<option value='null' selected>-Choisir Matière-</option>
				</select>
				<div id='sekence' style = 'display:inline'>
				</div>
<?php 
			}
		}
	}
?>