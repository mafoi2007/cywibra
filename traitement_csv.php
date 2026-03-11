<?php 
	session_start();
	require_once('inc/connect2.inc.php');
	$config = new config($db);
	$source = $_SERVER['HTTP_REFERER'];
	$_SESSION['appName'] = appName;
	$_SESSION['appVersion'] = appVersion;
	$_SESSION['appContact'] = appContact;
	$_SESSION['appSlogan'] = appSlogan;

    if(isset($_POST['to_export'])){
        $export = $_POST['to_export'];
        if($export=='releveNumerique'){
            $classe = (int) $_POST['classe'];
            if($classe==0){
                $_SESSION['message'] = 'Choisir une classe';
                header('Location:'.$source);
            }else{
                $liste = $config->listeEleve($classe,'non_supprime');
                $getClasse = $config->getClasse($classe);
                $nomClasse = str_replace(' ', '_', strtolower($getClasse['nom_classe']));
                $fileName = 'releve_numerique_'.$nomClasse.'.csv';
                // Entêtes pour forcer le téléchargement 
				header('Content-Type: text/csv; charset=utf-8');
				header('Content-Disposition:attachement; filename='.$fileName);
                // Ouverture du flux de sortie
				$output = fopen('php://output', 'w');
                // Ecriture des Entêtes du CSV 
				$headers = ['Num', 'code_eleve', 'nom_eleve', 'note'];
				fputcsv($output, $headers, ';');
                // Ecriture des Données 
				$a = 1;
				for($x=0;$x<count($liste);$x++){
					$num = $a;
					$matricule = $liste[$x]['id'];
					$nomEleve = $liste[$x]['nom_complet'];
					$noteEleve = '';
					$rows = [$num, $matricule, $nomEleve, $noteEleve];
					fputcsv($output, $rows, ';');
					$a++;
				}
                fclose($output);
            }
        }
    }