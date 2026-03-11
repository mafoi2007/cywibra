<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	// $note = new Note($db);
	$config = new Config($db);
	// print_r($_POST);
	if(isset($_POST['matiere'])){
		$matiere = (int) $_POST['matiere'];
		if($matiere==0){
			$msg = "Choisissez une matière.";
			echo "<h3 class='alert'>".$msg."</h3>";
		}else{
			$trimestre = $config->getTrimestre($matiere);
			if(empty($trimestre)){
				$msg = "Aucun Trimestre correspondant.";
				echo "<h3 class='alert'>".$msg."</h3>";
			}else{ ?>
				Trimestre : 
				<select name='trimestre'>
					<?php for($i=0;$i<count($trimestre);$i++){
						echo "<option value='".$trimestre[$i]."'>Trimestre ".$trimestre[$i]."</option>";
					} ?>
				</select>
				<input type='hidden' name='to_print' value='RecapMatiere' />
				<input type='submit' name='print' value='Générer' />
<?php 				
			}
		}
	}
?>