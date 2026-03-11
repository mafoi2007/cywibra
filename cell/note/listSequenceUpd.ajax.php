<?php 
    session_start();
	require_once('../../inc/connect.inc.php');
    $config = new Config($db);
    // print_r($_POST);
    if(isset($_POST['subject'])){
        $subject = (int) $_POST['subject'];
        if($subject==0){
            $msg = "Choisir une matière.";
            echo "<h3 class='alert'>".$msg."</h3>";
        }else{
            $listeSequence = $config->noteSaisieSequence($_SESSION['classe'], $subject); 
             ?>
            Séquence : 
            <select name='sequence'>
                <?php for($i=0;$i<count($listeSequence);$i++){
                    $idSequence = $listeSequence[$i]['id_periode'];
                    $nomSequence = utf8_decode($listeSequence[$i]['id_periode']);
                    echo "<option value='".$idSequence."'>Séquence ".$nomSequence."</option>";
                }?>
            </select>
            <input type='submit' name='info' value='Ok' />
<?php 
        }
    }