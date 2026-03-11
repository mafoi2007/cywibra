<?php 
	$classe = $config->verifNoteSaisieClasse();
	// $classeFr = $config->viewClasseSection('fr', 'actif');
	// $classeEn = $config->viewClasseSection('en', 'actif');
	// echo '<pre>'; print_r($classe); echo '</pre>';
?>
<h1 class='bien'>modification des notes</h1>
		<form method='post' action=''>
			Classe : <select name='classe' id='classe' onChange='listMatiereClasseUpd()'>
				<option value='null' selected>-Classe-</option>
				<?php for($i=0;$i<count($classe);$i++){
					$idClasse = $classe[$i]['id_classe'];
					$nomClasse = strtoupper($classe[$i]['nom_classe']);
					echo "<option value='".$idClasse."'>".$nomClasse."</option>";
				}?>
			</select>
			<div id='sequence' style = 'display:inline'>
			</div>
			
		</form>


<?php 

	if(isset($_POST['info'])){
		// echo '<pre>'; print_r($_POST); echo '</pre>';
		$classe = (int) $_POST['classe'];
		$matiere = (int) $_POST['subject'];
		$sequence = (int) $_POST['sequence'];
		$nomClasse = $config->getClasse($classe);
		$nomMatiere = $config->getMatiere($matiere);
		$nomSequence = $config->getSequenceCourante($sequence);
		$as = $config->getCurrentYear();
		$listeEleve = $config->listeEleve($nomClasse['id'], 'non_supprime', $as);
		$listeNote = $config->listeNote($classe, $matiere, $sequence);
		// echo "<pre>"; print_r($listeNote); echo "</pre>";
		require_once('../forms/modifierNote.form.php');
	}