<?php 
	// $classe = $config->listeClasseProfClasse();
	$classeFr = $config->viewClasseSection('fr', 'actif');
	$classeEn = $config->viewClasseSection('en', 'actif');
	// echo '<pre>'; print_r($classeEn); echo '</pre>';
?>
<h1 class='bien'>saisie des notes</h1>
		<form method='post' action=''>
			Classe : <select name='classe' id='classe' onChange='listMatiereClasse()'>
				<option value='null' selected>-Classe-</option>
				<optgroup label='Section Francophone'>
				<?php for($i=0;$i<count($classeFr);$i++){
					$idClasse = $classeFr[$i]['id'];
					$nomClasse = strtoupper($classeFr[$i]['nom_classe']);
					echo "<option value='".$idClasse."'>".$nomClasse."</option>";
				}?>
				</optgroup>
				<optgroup label='Section Anglophone'>
				<?php for($i=0;$i<count($classeEn);$i++){
					$idClasse = $classeEn[$i]['id'];
					$nomClasse = strtoupper($classeEn[$i]['nom_classe']);
					echo "<option value='".$idClasse."'>".$nomClasse."</option>";
				}?>
				</optgroup>
			</select>
			<div id='sequence' style = 'display:inline'>
			</div>
			
		</form>


<?php 

	if(isset($_POST['info'])){
		// echo '<pre>'; print_r($_POST); echo '</pre>';
		$classe = (int) $_POST['classe'];
		$matiere = (int) $_POST['matiere'];
		$sequence = (int) $_POST['sequence'];
		$nomClasse = $config->getClasse($classe);
		$nomMatiere = $config->getMatiere($matiere);
		$nomSequence = $config->getSequenceCourante($sequence);
		$as = $config->getCurrentYear();
		$listeEleve = $config->listeEleve($nomClasse['id'], 'non_supprime', $as);
		require_once('../forms/ajouterNote.form.php');
		/*		
		
		
		*/
	}