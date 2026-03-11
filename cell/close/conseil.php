<h1 class='bien'>Conseil de classe annuel</h1>
<?php 
$niveau = $config->listeNiveaux();
// echo '<pre>'; print_r($niveau); echo '</pre>';

/*echo '<pre>'; print_r($_SERVER); */
	// $bullPret = $note->bulletinAnnuelPret();
	// echo '<pre>';print_r($bullPret);
?>

<form method='post' action='../traitement.php' target = _blank>
	<p>Niveau : 
		<select name='niveau' id ='niveau' onChange='showClasseNiveau()'>
			<option value='null'>-Choisir-</option>
			<?php 
			for($i=0;$i<count($niveau);$i++){
				echo "<option value = '";
				echo $niveau[$i]['id'];
				echo "'>";
				echo ucwords($niveau[$i]['nom_niveau']);
				echo "</option>";
			}
			?>
		</select>
        <div id='class' style='display:inline'>
        </div>
		
		
		
		<input type='hidden' name='to_print' value='BulletinAnnuel' />
		<input type='submit' name='print' value='Générer' />
	</p>
</form>




<?php 
	/*if(isset($_POST['print'])){
		$resultat = $note->showRangEleve();
		echo '<pre>';
			// print_r($_POST);
			print_r($resultat);
		echo '</pre>';
		
	}*/