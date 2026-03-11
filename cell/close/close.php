<h1 class='bien'>Cloturer l'année Scolaire</h1>
<?php /*echo '<pre>'; print_r($_SERVER); */
	// $bullPret = $note->bulletinAnnuelPret();
	// echo '<pre>';print_r($bullPret);
?>

<form method='post' action='../traitement.php' target = _blank>
	<p>Voulez - vous cloturer l'année scolaire 
        <b><font class='alert'><?php echo $_SESSION['information']['annee_scolaire']; ?></font></b>
        <input 
            type='hidden' 
            name='endYear' 
            value='<?php echo $_SESSION['information']['annee_scolaire'];?>' 
        />
        et ouvrir l'année scolaire
        <select name='newYear'>
            <?php 
            $date = DATE('Y');
            $cls = $date + 1;
             echo '<option value="'.$date.'/'.$cls.'">'.$date.'/'.$cls.'</option>';
            ?>
        </select>
        pour le compte du 
        <b><font 
            class='alert'>
        <?php echo strtoupper($_SESSION['information']['nom_etablissement_fr']); ?>
        </font></b> ? 
        <input type='submit' name='closeYear' value='Oui' />
        <input type='submit' name='closeYear' value='Non' /></p>
</form>