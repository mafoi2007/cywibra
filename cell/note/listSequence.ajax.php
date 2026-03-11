<?php 
    session_start();
	require_once('../../inc/connect.inc.php');
    $config = new Config($db);
    // print_r($_POST);
    if(isset($_POST['matiere'])){
        $matiere = (int) $_POST['matiere'];
        if($matiere==0){
            $msg = "Choisir une matière.";
            echo "<h3 class='alert'>".$msg."</h3>";
        }else{
            $listeSequence = $config->viewPeriode(); ?>
            Séquence : 
            <select name='sequence'>
                <?php for($i=0;$i<count($listeSequence);$i++){
                    $idSequence = $listeSequence[$i]['id'];
                    $nomSequence = utf8_decode($listeSequence[$i]['nom_periode']);
                    echo "<option value='".$idSequence."'>".$nomSequence."</option>";
                }?>
            </select>
            <input type='submit' name='info' value='Ok' />
<?php 
        }
    }