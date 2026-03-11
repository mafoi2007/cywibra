<?php 
	$verification = $config->verifNoteSaisie($classe, $matiere, $sequence);
	// echo '<pre>'; print_r($verification); echo '</pre>';
	if(!empty($verification)){ ?>
<form method='post' action='../traitement.php' target='_blank'>
	<input 
		type='hidden'
		name='classe'
		value='<?php echo $_POST['classe']; ?>' />
	<input 
		type='hidden'
		name='matiere'	
		value='<?php echo $_POST['subject']; ?>' />
	<input 
		type='hidden'
		name='sequence'
		value='<?php echo $_POST['sequence']; ?>' />
	<fieldset>
		<legend><h3 class='bien'>Modification des Notes Séquentielles</h3></legend>
		<p>Classe : <input type='text' value='<?php echo $nomClasse['nom_classe']; ?>' disabled />
			Matière : <input type='text' value='<?php echo $nomMatiere['nom_matiere']; ?>' disabled />
			Séquence : <input type='text' value='<?php echo utf8_decode($nomSequence['nom_periode']); ?>' disabled />
		</p>
	</fieldset>
	<table border='1' width='90%' align='center'>
		<tr>
			<th colspan='5'>
				<textarea name='competence' required><?php echo stripslashes($verification['competence']); ?></textarea>
			</th>
		</tr>
		<tr>
			<th>N°</th>
			<th>Noms et Prénoms</th>
			<th>Note Enregistrée</th>
			<th>Nouvelle Note</th>
			<th>Annuler</th>
		<?php 
		$a = 1;
		for($i=0;$i<count($listeNote);$i++){ ?>
			<tr>
				<td><?php echo $a; ?></td>
				<td>
					<?php echo $listeNote[$i]['nom_complet']; ?>
					<input 
						type='hidden'
						name='eleve[]'
						value='<?php echo $listeNote[$i]['id']; ?>' 
					/>
				</td>
				<td>
					<input 
						type='number'
						value='<?php echo $listeNote[$i]['note']; ?>'
						max ='20'
						min='0.1'
						step='0.01'
						disabled
					/>
				</td>
				<td>
					<input 
						type='number'
						value='<?php echo $listeNote[$i]['note']; ?>'
						max ='20'
						min='0.1'
						step='0.01'
						name='note[]'
					/>
				</td>
				
				
				<td>
					<input 
						type='checkbox'
						name='annuler[]'
						value='<?php echo $listeNote[$i]['id']; ?>'
						/>
			</tr>
<?php 	
			$a++;
		} ?>
			<tr>
				<td colspan='5' align='center'><input type='submit' name='updateNote' value='Enregistrer' /></td>
			</tr>
	</table>
</form>
<?php 
	}else{
		echo "<h3 class='alert'>Vous n'avez pas encore saisi les notes de cette matière pour la classe.";
	}
?>


