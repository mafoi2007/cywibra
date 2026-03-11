<?php 
	
	
	/*************************************************************************
	**************************************************************************
	**************************************************************************
	************   G E N E R A T E U R	 D E	F I C H I E R S 	P D F	**
	**************************************************************************
	**************************************************************************
	*************************************************************************/
	session_start();
	require_once('inc/pdfL.class.php');
	$pdf = new pdf('L', 'mm', 'A4');
	$pdf->SetFillColor(155, 150, 149);
	
	
	if(isset($_SESSION['print'])){
		
		/**********************************************************************
		***********************************************************************
		*******	Impression/Visualisation des  Notes Séquentielles *************
		***********************************************************************
		**********************************************************************/
		
		if($_SESSION['print']=='VisualiserNoteSequentielle'){
			
			$classe = $_SESSION['classe'];
			$eleve = $_SESSION['eleve'];
			$matiere = $_SESSION['matiere'];
			if($classe['section']=='fr'){
				$pdf->addPage();
				$pdf->Entete();
				$titre = 'visualisation des notes sequentielles';
				$pdf->Titre($titre);
				$pdf->Ln(10);
				$pdf->Cell(25);
				$libClasse = 'Classe : '.$classe['nom_classe'];
				$libSequence = 'Sequence : Sequence '.$eleve['sequence'];
				$pdf->Cell(120,6,$libClasse,0,0,'L');
				$pdf->Cell(120,6,$libSequence,0,0,'L');
				$pdf->Ln(10);
				$pdf->setFont('Times', '',11);
				$pdf->Cell(10,5,utf8_decode('N°'),1,0,'C', true);
				$pdf->Cell(60,5,utf8_decode('Noms et Prénoms'),1,0,'C', true);
				$pdf->Cell(10,5,utf8_decode('Sexe'),1,0,'C', true);
				$pdf->Cell(10,5,utf8_decode('Statut'),1,0,'C', true);
				// On liste les matières ici 
				for($i=0;$i<count($matiere); $i++){
					$codeMatiere = strtolower($matiere[$i]['code_matiere']);
					$pdf->Cell(10,5,$codeMatiere,1,0,'C', true);
				}
				$pdf->Ln(5);
				$x = 1;
				for($a=0;$a<count($eleve['eleve']);$a++){
					$infoEleve = $eleve['eleve'];
					$nomComplet = substr($infoEleve[$a]['nom'], 0, 23);
					$sexe = $eleve['eleve'][$a]['sexe'];
					$statut = $eleve['eleve'][$a]['statut'];
					$pdf->Cell(10,5,utf8_decode($x),1,0,'C');
					$pdf->Cell(60,5,utf8_decode($nomComplet),1,0,'L');
					$pdf->Cell(10,5,utf8_decode($sexe),1,0,'C');
					$pdf->Cell(10,5,utf8_decode($statut),1,0,'C');
					$pdf->setFont('Times', '',10);
					// On va lister d'abord les array de matières et ensuite récupérer leurs notes 
					for($b=0;$b<count($matiere);$b++){
						$codeMat = strtolower($matiere[$b]['code_matiere']);
						$noteEleve = $infoEleve[$a][$codeMat];
						$pdf->Cell(10,5,$noteEleve,1,0,'C');
					}
					$pdf->Ln(5);
					$x++;
				}
				$pdf->Ln(10);
				$pdf->setFont('Times', '',11);
				$phrase = utf8_decode('Fait à '.strtoupper($_SESSION['information']['ville']).' le ______________');
				$phrase2 = utf8_decode("L'Administration");
				$pdf->Cell(200);
				$pdf->Cell(60, 5, $phrase, 0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(200);
				$pdf->Cell(60, 5, $phrase2, 0,0,'C');
				$fileName=strtoupper('etat_de_saisie_sequence_'.$eleve['sequence'].'_');
				$fileName .= strtoupper(str_replace(' ','_',$classe['nom_classe']));
				$fileName.= '.pdf';
			}
			elseif($classe['section']=='en'){
				$pdf->addPage();
				$pdf->Entete();
				$titre = 'sequential marks of the class';
				$pdf->Titre($titre);
				$pdf->Ln(10);
				$pdf->Cell(25);
				$libClasse = 'Class : '.$classe['nom_classe'];
				$libSequence = 'Sequence : Sequence '.$eleve['sequence'];
				$pdf->Cell(120,6,$libClasse,0,0,'L');
				$pdf->Cell(120,6,$libSequence,0,0,'L');
				$pdf->Ln(10);
				$pdf->setFont('Times', '',11);
				$pdf->Cell(10,5,utf8_decode('N°'),1,0,'C', true);
				$pdf->Cell(60,5,utf8_decode('Student Name'),1,0,'C', true);
				$pdf->Cell(10,5,utf8_decode('Sex'),1,0,'C', true);
				$pdf->Cell(10,5,utf8_decode('Status'),1,0,'C', true);
				// On liste les matières ici 
				for($i=0;$i<count($matiere); $i++){
					$codeMatiere = strtolower($matiere[$i]['code_matiere']);
					$pdf->Cell(10,5,$codeMatiere,1,0,'C', true);
				}
				$pdf->Ln(5);
				$x = 1;
				for($a=0;$a<count($eleve['eleve']);$a++){
					$infoEleve = $eleve['eleve'];
					$nomComplet = substr($infoEleve[$a]['nom'], 0, 23);
					$sexe = $eleve['eleve'][$a]['sexe'];
					$statut = $eleve['eleve'][$a]['statut'];
					$pdf->Cell(10,5,utf8_decode($x),1,0,'C');
					$pdf->Cell(60,5,utf8_decode($nomComplet),1,0,'L');
					$pdf->Cell(10,5,utf8_decode($sexe),1,0,'C');
					$pdf->Cell(10,5,utf8_decode($statut),1,0,'C');
					$pdf->setFont('Times', '',10);
					// On va lister d'abord les array de matières et ensuite récupérer leurs notes 
					for($b=0;$b<count($matiere);$b++){
						$codeMat = strtolower($matiere[$b]['code_matiere']);
						$noteEleve = $infoEleve[$a][$codeMat];
						$pdf->Cell(10,5,$noteEleve,1,0,'C');
					}
					$pdf->Ln(5);
					$x++;
				}
				$pdf->Ln(10);
				$pdf->setFont('Times', '',11);
				$phrase = utf8_decode('Done at '.strtoupper($_SESSION['information']['ville']).' on the ______________');
				$phrase2 = utf8_decode("The Administration");
				$pdf->Cell(200);
				$pdf->Cell(60, 5, $phrase, 0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(200);
				$pdf->Cell(60, 5, $phrase2, 0,0,'C');
				$fileName=strtoupper('etat_de_saisie_sequence_'.$eleve['sequence'].'_');
				$fileName .= strtoupper(str_replace(' ','_',$classe['nom_classe']));
				$fileName.= '.pdf';
			}
			$pdf->Output($fileName, 'I');
		}
		
		
		
		
		

		if($_SESSION['print']=='ficheAbsence'){
			$pdf->addPage();
			$pdf->Entete();
			$section = $_SESSION['classe']['section'];
			$titre['fr'] = "Fiche hebdomadaire d'absences";
			$titre['en'] = "Weekly Absence Paper";
			$pdf->Titre($titre[$section]);
			$eleve = $_SESSION['classe']['eleve'];
			$className['fr'] = "Classe : ".$eleve[0]['nom_classe'];
			$className['en'] = "Class : ".$eleve[0]['nom_classe'];
			$pdf->Ln(10);
			$pdf->SetFont('Times','B',14);
			$pdf->Cell(20);
			$pdf->Cell(25,6,$className[$section],0,0,'C');
			$pdf->Ln(15);

			$titreNum['fr'] = "N°";
			$titreNum['en'] = "N°";
			$titreNameEleve['fr'] = "Nom de l'élève";
			$titreNameEleve['en'] = "Student's Name";

			

			$pdf->SetFont('Times','B',12);
			$pdf->Cell(12,18,utf8_decode($titreNum[$section]), 1, 0, 'C',true);
			$pdf->Cell(60,18,utf8_decode($titreNameEleve[$section]), 1, 0, 'C',true);
			for($i=1;$i<=4;$i++){
				$titreSemaine['fr'] = "Semaine ";
				$titreSemaine['en'] = "Week ";
				$pdf->Cell(50,6,utf8_decode($titreSemaine[$section]." ".$i), 1, 0, 'C',true);
				
				// $pdf->Cell(50,3,utf8_decode("ddd"), 1, 0, 'C',true);
			}
			$pdf->Ln(6);
			$pdf->Cell(72);
			for($x=1;$x<=4;$x++){
				$texte['fr'] = "Du ........ au ........";
				$texte['en'] = "From ........ to ........";
				$pdf->Cell(50,6,utf8_decode($texte[$section]), 1, 0, 'C',true);
			}			
			$pdf->Ln(6);
			$pdf->Cell(72);
			for($j=1;$j<=4;$j++){
				$days['fr'] = array('L', 'M', 'M', 'J', 'V');
				$days['en'] = array('M', 'T', 'W', 'T', 'F');
				for($k=0;$k<count($days[$section]);$k++){
					$pdf->Cell(10,6,$days[$section][$k],1,0,'C');
				}
			}
			$pdf->Ln(6);
			$x = 1;
			for($a=0;$a<count($eleve);$a++){
				$pdf->SetFont('Times','',10);
				$pdf->Cell(12,6,utf8_decode($x), 1, 0, 'C');
				$pdf->Cell(60,6,substr(utf8_decode($eleve[$a]['nom_complet']),0,30), 1, 0, 'L');
				$x++;
				for($b=0;$b<4;$b++){
					for($c=0;$c<5;$c++){
						$pdf->Cell(10,6,utf8_decode(""), 1, 0, 'C');
					}
				}
				$pdf->Ln(6);
			}

			$fileName='fff.pdf';
			$pdf->Output($fileName, 'I');
		}
		
		
		
		
		
		
		
		
		
		
		
		elseif($_SESSION['print']=='statNoteProf'){
			$pdf->addPage();
			// On met l'entête du document
			$pdf->EnteteDocL($ministere, $pays, $ets, $devise, $contact, $as);
			// On met le titre du document 
			$matiere = $_SESSION['matiere'];
			$titre = "Statistiques des Notes de ";
			$titre .= strtoupper($matiere);
			
			$pdf->TitreL($titre);
			
			
			// Informations diverses
			$pdf->SetFont('Times','B',12);
			// $classe = strtoupper($_SESSION['liste'][0]['nom_classe']);
			$texte_1 = 'Classe : '.$_SESSION['classe'];
			$texte_2 = 'Période : Séquence '.$_SESSION['sequence'];
			$pdf->Cell(20,10,utf8_decode($texte_1), 0,0,'L');
			$pdf->Cell(80,10,utf8_decode($texte_2), 0,0,'R');
			
			$pdf->Ln(15);
			
			$pdf->SetFont('Arial','B',10);
			// Je positionne l'entete du tableau
			$pdf->Cell(20, 14, 'Classe', 1, 0 , 'C');
			$pdf->Cell(30, 7, 'Effectif', 1, 0 , 'C');
			$pdf->Cell(30, 7, utf8_decode('Evalué'), 1, 0 , 'C');
			$pdf->Cell(30, 7, 'Nb Moyennes', 1, 0 , 'C');
			$pdf->Cell(30, 7, utf8_decode('% Réussite'), 1, 0 , 'C');
			$pdf->Cell(30, 7, 'Forte Note', 1, 0 , 'C');
			$pdf->Cell(30, 7, 'Faible Note', 1, 0 , 'C');
			$pdf->Cell(45, 7, utf8_decode('Moyenne Générale'), 1, 0 , 'C');
			
			$pdf->Ln(7);
			$pdf->Cell(20, 7, '', 0, 0 , 'C');
			// Effectif de la classe
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C');
			// Effectif évalué
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C');
			// Nombre de Moyennes
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C');
			// Taux de Réussite
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C');
			// Forte Note
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C');
			// Faible Note
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C');
			// Moyenne Générale
			$pdf->Cell(15, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(15, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(15, 7, 'T', 1, 0 , 'C');
			
			// On insère maintenant les données
			$pdf->Ln(7);
			$pdf->Cell(20, 7, $_SESSION['classe'], 1, 0 , 'C');
			// Effectif de la classe
			$pdf->Cell(10, 7, $_SESSION['stat']['effM'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['effF'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['effT'], 1, 0 , 'C');
			// Effectif évalué
			$pdf->Cell(10, 7, $_SESSION['stat']['evalM'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['evalF'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['evalT'], 1, 0 , 'C');
			// Nombre de Moyennes
			$pdf->Cell(10, 7, $_SESSION['stat']['moyM'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['moyF'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['moyT'], 1, 0 , 'C');
			// Taux de Réussite
			$pdf->Cell(10, 7, $_SESSION['stat']['tauxM'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['tauxF'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['tauxT'], 1, 0 , 'C');
			// Forte Note
			$pdf->Cell(10, 7, $_SESSION['stat']['maxM'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['maxF'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['maxT'], 1, 0 , 'C');
			// Faible Note
			$pdf->Cell(10, 7, $_SESSION['stat']['minM'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['minF'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['minT'], 1, 0 , 'C');
			// Moyenne Générale
			$pdf->Cell(15, 7, $_SESSION['stat']['mgM'], 1, 0 , 'C');
			$pdf->Cell(15, 7, $_SESSION['stat']['mgF'], 1, 0 , 'C');
			$pdf->Cell(15, 7, $_SESSION['stat']['mgT'], 1, 0 , 'C');
			
			
			
			// Boucle des matières ici
			/*for($i=0;$i<$_SESSION['nbCol'];$i++){
				$pdf->Cell(13, 7, $_SESSION['nomCol'][$i], 1, 0 , 'C');
			}*/
			
			// Les notes envoyées par la BD
			$x = 1;
			/*for($a=0;$a<$_SESSION['nbLn'];$a++){
				$pdf->Ln(7);
				$pdf->Cell(10, 6, $x, 1, 0 , 'C');
				$pdf->Cell(70, 6, utf8_decode($_SESSION['ligne'][$a]['nom']), 1, 0 , 'L');
				$pdf->Cell(14, 6, $_SESSION['ligne'][$a]['sexe'], 1, 0 , 'C');
				$pdf->Cell(14, 6, $_SESSION['ligne'][$a]['statut'], 1, 0 , 'C');
				$col = $_SESSION['nbCol'];
				
				for($u=0;$u<$_SESSION['nbCol'];$u++){
					$mat = $_SESSION['nomCol'][$u];
					$pdf->Cell(13, 6, $_SESSION['ligne'][$a][$mat], 1, 0 , 'C');
				}				
				$x++;
			}*/
			
			$pdf->SetFont('Arial','',10);
			$i = 1;
			// Par boucle je récupère la liste envoyée dans une variable de session
			/*for($a=0;$a<count($_SESSION['liste']);$a++){
				$pdf->Ln(7);
				$pdf->Cell(10, 6, $i, 1, 0 , 'C');
				$pdf->Cell(21, 6, $_SESSION['liste'][$a]['matricule'], 1, 0 , 'C');
				$pdf->Cell(12, 6, $_SESSION['liste'][$a]['sexe'], 1, 0 , 'C');
				$nom = strtoupper($_SESSION['liste'][$a]['nom']);
				$nom .= ' '.ucwords($_SESSION['liste'][$a]['prenom']);
				$pdf->Cell(70, 6, $nom, 1, 0 , 'L');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$i++;
			}*/
			$nomFichier = 'Stat_'.$matiere.'_Sequence_'.$_SESSION['sequence'];
			$nomFichier .= '_'.$_SESSION['classe'].'.pdf';
			$pdf->Output($nomFichier, 'I');
		}
		elseif($_SESSION['print']=='statNoteSequence'){
			
		}
		elseif($_SESSION['print']=='statNoteTrimestre'){
			
		}
		elseif($_SESSION['print']=='VisualiserNoteTrimestrielle'){
			$pdf->addPage();
			// On met l'entête du document
			$pdf->EnteteDocL($ministere, $pays, $ets, $devise, $contact, $as);
			// On met le titre du document 
			$titre = strtoupper("Récapitulatif des Notes Trimestrielles");
			
			$pdf->TitreL($titre);
			
			// Informations diverses
			$pdf->SetFont('Times','B',16);
			$texte_1 = 'Classe : ';
			// $pdf->SetTextColor(100,100,255);  // Bleu
			$texte_1 .= strtoupper($_SESSION['nom_classe']);
			// $pdf->SetTextColor(0,0,0);  // Noir
			$texte_2 = 'Période : '.$_SESSION['nom_trimestre'];
			$pdf->Cell(70,10,utf8_decode($texte_1), 0,0,'L');
			$pdf->Cell(80,10,utf8_decode($texte_2), 0,0,'R');
			$pdf->Ln(15);
			
			
			
			$pdf->SetFont('Arial','B',10);
			// Je positionne l'entete du tableau
			$pdf->Cell(10, 7, utf8_decode('N°'), 1, 0 , 'C');
			$pdf->Cell(66, 7, utf8_decode('Noms et Prénoms'), 1, 0 , 'C');
			$pdf->Cell(10, 7, 'Sexe', 1, 0 , 'C');
			$pdf->Cell(11, 7, 'Statut', 1, 0 , 'C');
			for($i=0;$i<count($_SESSION['code_matiere']);$i++){
				$pdf->Cell(12, 7, 
						$_SESSION['code_matiere'][$i],
						1, 0 , 'C');
			}
			$pdf->SetFillColor(200,205,180);
			$pdf->Cell(16, 7, 'MOY.', 1,0,'C',true);
			$pdf->Cell(16, 7, 'Rang.', 1,0,'C',true);
			
			// Les notes envoyées par la BD
			$x = 1;
			for($j=0;$j<count($_SESSION['eleve']);$j++){
				$nomEleve = $_SESSION['eleve'][$j]['nom_eleve'];
				$sexe = $_SESSION['eleve'][$j]['sexe'];
				$statut = $_SESSION['eleve'][$j]['statut'];
				
				$pdf->Ln(7);
				$pdf->Cell(10, 6, $x, 1, 0 , 'C');
				$pdf->Cell(66, 6, $nomEleve, 1, 0 , 'L');
				$pdf->Cell(10,6,$sexe,1,0,'C');
				$pdf->Cell(11,6,$statut,1,0,'C');
				for($k=0;$k<count($_SESSION['code_matiere']);$k++){
					$codeMatiere = $_SESSION['code_matiere'][$k].'_trim';
					$noteObtenue = $_SESSION['eleve'][$j][$codeMatiere];
					// On élimine la présence du Zéro
					if($noteObtenue=='0.00'){
						$pdf->Cell(12,6,'', 1,0,'C');
					}else{
						$pdf->Cell(12,6,$noteObtenue, 1,0,'C');
					}
				}
				$x++;
				// Si l'élève n'est pas classé, on le signale au tableau
				/*$pdf->SetTextColor(255,30,30); */  //Rouge sont les moyennes et les rangs
				$pdf->SetDrawColor(255,30,30);  //Rouge sont les bordures du tableau
				
				if($_SESSION['eleve'][$j]['moyenne']=='0.00'){
					$pdf->SetFillColor(230,230,0);  // Fond Jaune pour les non classés
					$pdf->Cell(16, 6, 'NC', 1,0,'C',true);
					$pdf->Cell(16, 6, 'NC', 1,0,'C',true);
				}else{
					$pdf->SetFillColor(200,205,180);  // Fond Orange ou gris pour les classés
					$pdf->Cell(16, 6, $_SESSION['eleve'][$j]['moyenne'], 1,0,'C',true);
					$pdf->Cell(16, 6, utf8_decode($_SESSION['eleve'][$j]['rang']), 1,0,'C',true);
				}
				$pdf->SetTextColor(0,0,0);
				$pdf->SetDrawColor(0,0,0);
			}
			
			$pdf->SetFont('Arial','',10);
			$i = 1;
			
			$pdf->FooterL();
			$pdf->setAuthor('Nyambi Computer Services');
			$nomFichier = 'Vue_Note_'.str_replace(' ','_',$_SESSION['nom_trimestre']).'_';
			$nomFichier .= $_SESSION['nom_classe'].'.pdf';
			$pdf->Output($nomFichier, 'I');
		}







		elseif($_SESSION['print']=='statMatiere'){
			$pdf->addPage();
			$pdf->Entete();
			$information = $_SESSION['info'];
			$nomMatiere = $information['classe'][0]['nom_matiere'];
			// On met le titre du document 
			$titre = "Statistiques des Notes de ";
			$titre .= strtoupper($nomMatiere);
			
			$pdf->Titre($titre);

			// Informations diverses
			$pdf->SetFont('Times','B',14);
			$texte_1 = 'Période Concernée : Trimestre '.$information['trimestre'];
			$pdf->Cell(20,10,utf8_decode($texte_1), 0,0,'L');
			$pdf->Ln(15);
			// Je positionne l'entete du tableau
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(10, 14, utf8_decode('N°'), 1, 0 , 'C', true);
			$pdf->Cell(40, 14, 'Classe', 1, 0 , 'C', true);
			$pdf->Cell(10, 14, 'Coef', 1, 0 , 'C', true);
			$pdf->Cell(30, 7, 'Effectif', 1, 0 , 'C',true);
			$pdf->Cell(30, 7, utf8_decode('Evalué'), 1, 0 , 'C',true);
			$pdf->Cell(30, 7, 'Nb Moyennes', 1, 0 , 'C',true);
			$pdf->Cell(30, 7, utf8_decode('% Réussite'), 1, 0 , 'C',true);
			$pdf->Cell(30, 7, 'Forte Note', 1, 0 , 'C',true);
			$pdf->Cell(30, 7, 'Faible Note', 1, 0 , 'C',true);
			$pdf->Cell(45, 7, utf8_decode('Moyenne Générale'), 1, 0 , 'C',true);
			$pdf->Ln(7);
			$pdf->Cell(10, 7, '', 0, 0 , 'C');
			$pdf->Cell(40, 7, '', 0, 0 , 'C');
			$pdf->Cell(10, 7, '', 0, 0 , 'C');
			// Effectif de la classe
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C',true);
			// Effectif évalué
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C',true);
			// Nombre de Moyennes
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C',true);
			// Taux de Réussite
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C',true);
			// Forte Note
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C',true);
			// Faible Note
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C',true);
			// Moyenne Générale
			$pdf->Cell(15, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(15, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(15, 7, 'T', 1, 0 , 'C',true);
			// On insère maintenant les données
			$pdf->Ln(7);
			$a = 1;
			$listeClasse = $information['classe'];
			for($i=0;$i<count($listeClasse);$i++){
				// Effectif Normal de la Classe
				$effectifNormal = $information['normal'];
				$effectifEvalue = $information['evalues'];
				$mascNormal[$i] = $effectifNormal[$i]['G'];
				$femNormal[$i] = $effectifNormal[$i]['F'];
				$totNormal[$i] = $effectifNormal[$i]['T'];
				$mascEval[$i] = $effectifEvalue[$i]['evalM'];
				$femEval[$i] = $effectifEvalue[$i]['evalF'];
				$totEval[$i] = $effectifEvalue[$i]['evalT'];
				$mascMoy[$i] = $effectifEvalue[$i]['moyM'];
				$femMoy[$i] = $effectifEvalue[$i]['moyF'];
				$totMoy[$i] = $effectifEvalue[$i]['moyT'];
				// On gère les cas de division par Zéro possible 
				if($mascEval[$i]!=0){
					$tauxMasc[$i] = $mascMoy[$i] * 100 / $mascEval[$i];
				}else{
					$tauxMasc[$i] = NULL;
				}
				if($femEval[$i]!=0){
					$tauxFem[$i] = $femMoy[$i] * 100 / $femEval[$i];
				}else{
					$tauxFem[$i] = NULL;
				}
				if($totEval[$i]!=0){
					$tauxTot[$i] = $totMoy[$i] * 100 / $totEval[$i];
				}else{
					$tauxTot[$i] = NULL;
				}				
				$forteMasc[$i] =  $effectifEvalue[$i]['maxM'];
				$forteFem[$i] = $effectifEvalue[$i]['maxF'];
				$forteTot[$i] = $effectifEvalue[$i]['maxT'];
				$faibleMasc[$i] = $effectifEvalue[$i]['minM'];
				$faibleFem[$i] = $effectifEvalue[$i]['minF'];
				$faibleTot[$i] = $effectifEvalue[$i]['minT'];
				$pdf->Cell(10, 7, $a, 1, 0 , 'C');
				$pdf->Cell(40, 7, $listeClasse[$i]['nom_classe'], 1, 0 , 'L');
				$pdf->Cell(10, 7, $listeClasse[$i]['coef'], 1, 0 , 'C');
				// Effectif de la classe
				$pdf->Cell(10, 7, $effectifNormal[$i]['G'], 1, 0 , 'C');
				$pdf->Cell(10, 7, $effectifNormal[$i]['F'], 1, 0 , 'C');
				$pdf->Cell(10, 7, $effectifNormal[$i]['T'], 1, 0 , 'C',true);
				// Effectif évalué
				$pdf->Cell(10, 7, $effectifEvalue[$i]['evalM'], 1, 0 , 'C');
				$pdf->Cell(10, 7, $effectifEvalue[$i]['evalF'], 1, 0 , 'C');
				$pdf->Cell(10, 7, $effectifEvalue[$i]['evalT'], 1, 0 , 'C',true);
				// Nombre de Moyennes
				$pdf->Cell(10, 7, $effectifEvalue[$i]['moyM'], 1, 0 , 'C');
				$pdf->Cell(10, 7, $effectifEvalue[$i]['moyF'], 1, 0 , 'C');
				$pdf->Cell(10, 7, $effectifEvalue[$i]['moyT'], 1, 0 , 'C',true);
				// Taux de Réussite
				$pdf->Cell(10, 7, round($tauxMasc[$i],2), 1, 0 , 'C');
				$pdf->Cell(10, 7, round($tauxFem[$i],2), 1, 0 , 'C');
				$pdf->Cell(10, 7, round($tauxTot[$i],2), 1, 0 , 'C',true);
				// Forte Note
				$pdf->Cell(10, 7, $effectifEvalue[$i]['maxM'], 1, 0 , 'C');
				$pdf->Cell(10, 7, $effectifEvalue[$i]['maxF'], 1, 0 , 'C');
				$pdf->Cell(10, 7, $effectifEvalue[$i]['maxT'], 1, 0 , 'C',true);
				// Faible Note
				$pdf->Cell(10, 7, $effectifEvalue[$i]['minM'], 1, 0 , 'C');
				$pdf->Cell(10, 7, $effectifEvalue[$i]['minF'], 1, 0 , 'C');
				$pdf->Cell(10, 7, $effectifEvalue[$i]['minT'], 1, 0 , 'C',true);
				// Moyenne Générale
				$pdf->Cell(15, 7, round($effectifEvalue[$i]['moyGenM'],2), 1, 0 , 'C');
				$pdf->Cell(15, 7, round($effectifEvalue[$i]['moyGenF'],2), 1, 0 , 'C');
				$pdf->Cell(15, 7, round($effectifEvalue[$i]['moyGenT'],2), 1, 0 , 'C',true);
				$pdf->Ln(7);
				$a++;
			}
			// La ligne du Total 
			$pdf->Cell(60,7,'Total',1,0,'C', true);
			// Effectif de la classe
			$pdf->Cell(10, 7, array_sum($mascNormal), 1, 0 , 'C');
			$pdf->Cell(10, 7, array_sum($femNormal), 1, 0 , 'C');
			$pdf->Cell(10, 7, array_sum($totNormal), 1, 0 , 'C',true);
			// Effectif évalué
			$pdf->Cell(10, 7, array_sum($mascEval), 1, 0 , 'C');
			$pdf->Cell(10, 7, array_sum($femEval), 1, 0 , 'C');
			$pdf->Cell(10, 7, array_sum($totEval), 1, 0 , 'C',true);
			// Nombre de Moyennes
			$pdf->Cell(10, 7, array_sum($mascMoy), 1, 0 , 'C');
			$pdf->Cell(10, 7, array_sum($femMoy), 1, 0 , 'C');
			$pdf->Cell(10, 7, array_sum($totMoy), 1, 0 , 'C',true);
			// Taux de Réussite
			$tauxMasculin = array_sum($mascMoy) * 100 / array_sum($mascEval);
			$tauxFeminin = array_sum($femMoy) * 100 / array_sum($femEval);
			$tauxTotal = array_sum($totMoy) * 100 / array_sum($totEval);
			$pdf->Cell(10, 7, round($tauxMasculin,2), 1, 0 , 'C');
			$pdf->Cell(10, 7, round($tauxFeminin,2), 1, 0 , 'C');
			$pdf->Cell(10, 7, round($tauxTotal,2), 1, 0 , 'C',true);
			// Forte Note
			$pdf->Cell(10, 7, max($forteMasc), 1, 0 , 'C');
			$pdf->Cell(10, 7, max($forteFem), 1, 0 , 'C');
			$pdf->Cell(10, 7, max($forteTot), 1, 0 , 'C',true);
			// Faible Note
			$pdf->Cell(10, 7, min($faibleMasc), 1, 0 , 'C');
			$pdf->Cell(10, 7, min($faibleFem), 1, 0 , 'C');
			$pdf->Cell(10, 7, min($faibleTot), 1, 0 , 'C',true);
			// Moyenne Générale
			$pdf->Cell(15, 7, '', 1, 0 , 'C');
			$pdf->Cell(15, 7, '', 1, 0 , 'C');
			$pdf->Cell(15, 7, '', 1, 0 , 'C',true);

			
			
			
			$nomFichier = 'Stat_'.str_replace(' ','_',strtoupper($nomMatiere));
			$nomFichier .= '_Trimestre_'.$information['trimestre'].'.pdf';
			$pdf->Output($nomFichier, 'I');
		}
		
		
		
		
		
		
		
		
		
		
		elseif($_SESSION['print']=='VisualiserNoteAnnuelle'){
			$pdf->addPage();
			// On met l'entête du document
			$pdf->EnteteDocL($ministere, $pays, $ets, $devise, $contact, $as);
			// On met le titre du document 
			$titre = strtoupper("Récapitulatif des Notes Annuelles");
			
			$pdf->TitreL($titre);
			
			// Informations diverses
			$pdf->SetFont('Times','B',16);
			$texte_1 = 'Classe : ';
			// $pdf->SetTextColor(100,100,255);  // Bleu
			$texte_1 .= strtoupper($_SESSION['nom_classe']);
			// $pdf->SetTextColor(0,0,0);  // Noir
			$texte_2 = 'Professeur Principal : ';
			$texte_2 .= strtoupper($_SESSION['nom_classe']);
			$pdf->Cell(70,10,utf8_decode($texte_1), 0,0,'L');
			// $pdf->Cell(80,10,utf8_decode($texte_2), 0,0,'R');
			$pdf->Ln(15);
			
			
			
			$pdf->SetFont('Arial','B',10);
			// Je positionne l'entete du tableau
			$pdf->Cell(10, 7, utf8_decode('N°'), 1, 0 , 'C');
			$pdf->Cell(66, 7, utf8_decode('Noms et Prénoms'), 1, 0 , 'C');
			$pdf->Cell(10, 7, 'Sexe', 1, 0 , 'C');
			$pdf->Cell(11, 7, 'Statut', 1, 0 , 'C');
			for($i=0;$i<count($_SESSION['code_matiere']);$i++){
				$pdf->Cell(12, 7, 
						$_SESSION['code_matiere'][$i],
						1, 0 , 'C');
			}
			$pdf->SetFillColor(200,205,180);
			$pdf->Cell(16, 7, 'MOY.', 1,0,'C',true);
			$pdf->Cell(16, 7, 'Rang.', 1,0,'C',true);
			
			// Les notes envoyées par la BD
			$x = 1;
			for($j=0;$j<count($_SESSION['eleve']);$j++){
				$nomEleve = $_SESSION['eleve'][$j]['nom_eleve'];
				$sexe = $_SESSION['eleve'][$j]['sexe'];
				$statut = $_SESSION['eleve'][$j]['statut'];
				
				$pdf->Ln(7);
				$pdf->Cell(10, 6, $x, 1, 0 , 'C');
				$pdf->Cell(66, 6, $nomEleve, 1, 0 , 'L');
				$pdf->Cell(10,6,$sexe,1,0,'C');
				$pdf->Cell(11,6,$statut,1,0,'C');
				for($k=0;$k<count($_SESSION['code_matiere']);$k++){
					$codeMatiere = $_SESSION['code_matiere'][$k].'_ann';
					$noteObtenue = $_SESSION['eleve'][$j][$codeMatiere];
					// On élimine la présence du Zéro
					if($noteObtenue=='0.00'){
						$pdf->Cell(12,6,'', 1,0,'C');
					}else{
						$pdf->Cell(12,6,$noteObtenue, 1,0,'C');
					}
				}
				$x++;
				// Si l'élève n'est pas classé, on le signale au tableau
				/*$pdf->SetTextColor(255,30,30); */  //Rouge sont les moyennes et les rangs
				$pdf->SetDrawColor(255,30,30);  //Rouge sont les bordures du tableau
				
				if($_SESSION['eleve'][$j]['moyenne']=='0.00'){
					$pdf->SetFillColor(230,230,0);  // Fond Jaune pour les non classés
					$pdf->Cell(16, 6, 'NC', 1,0,'C',true);
					$pdf->Cell(16, 6, 'NC', 1,0,'C',true);
				}else{
					$pdf->SetFillColor(200,205,180);  // Fond Orange ou gris pour les classés
					$pdf->Cell(16, 6, $_SESSION['eleve'][$j]['moyenne'], 1,0,'C',true);
					$pdf->Cell(16, 6, utf8_decode($_SESSION['eleve'][$j]['rang']), 1,0,'C',true);
				}
				$pdf->SetTextColor(0,0,0);
				$pdf->SetDrawColor(0,0,0);
			}
			
			$pdf->SetFont('Arial','',10);
			$i = 1;
			
			$pdf->FooterL();
			$pdf->setAuthor('Nyambi Computer Services');
			$nomFichier = 'Vue_Note_Annuelles_';
			$nomFichier .= $_SESSION['nom_classe'].'.pdf';
			$pdf->Output($nomFichier, 'I');
		}
		
		
		
		
		
		
		elseif($_SESSION['print']=='RapportSequentiel'){
			$pdf->addPage();
			$pdf->Entete();
			$classe = $_SESSION['classe'];
			$pdf->RapportSequence($classe, $classe['classe']['section']);
			$pdf->brefSequence($classe, $classe['classe']['section']);
			$fileName = 'Rapport_sequentiel_'.$classe['classe']['nom_classe'].'.pdf';
			$pdf->Output($fileName, 'I');	
		}
		
		
		
		
		
		
		
		elseif($_SESSION['print']=='RapportTrimestriel'){
			$pdf->addPage();
			$pdf->Entete();
			$classe = $_SESSION['classe'];
			$pdf->rapportTrimestre($classe, $classe['classe']['section']);
			$pdf->brefTrimestre($classe, $classe['classe']['section']);
			$fileName='Rapport_trimestriel.pdf';
			$pdf->Output($fileName, 'I');	
		}
		
		
		
		
		
		
		
		
		
		
		/***********************************************************
		************************************************************
		// Génération des tableaux d'Honneur Trimestrels 
		************************************************************
		***********************************************************/
		elseif($_SESSION['print']=='tableauTrimestriel'){
			$eleve = $_SESSION['tableau'];
			$section = $_SESSION['section'];
			$info = $_SESSION['infoTableau'];
			for($i=0;$i<count($eleve);$i++){
				$pdf->addPage();
				$pdf->Entete();
				$pdf->Image($eleve[$i]['photo'], 215, 72, 22, 22);
				$titre['fr'] = "Tableau d'Honneur";
				$titre['en'] = "Honour Holl";
				$pdf->Titre($titre[$section]);

				$texteEleve['fr'] = "Attribué à l'élève : ";
				$texteEleve['en'] = "Attributed to : ";
				$texteNe['fr'] = "Né(e) le : ";
				$texteNe['en'] = "Born on : ";
				$texteA['fr'] = "à : ";
				$texteA['en'] = "at : ";
				$texteClasse['fr'] = "En Classe de : ";
				$texteClasse['en'] = "In : ";
				$texteMatricule['fr'] = "Matricule National : ";
				$texteMatricule['en'] = "National Id : ";
				$texteTrimestre['fr'] = "Pour le trimestre ";
				$texteTrimestre['en'] = "For the end of Term ";
				$texteAnneeScolaire['fr'] = "De l'année Scolaire ";
				$texteAnneeScolaire['en'] = "For the School Year ";
				$texteConseil['fr'] = "Par le Conseil de Classe du _______________________";
				$texteConseil['en'] = "By the Class Council on _______________________";
				$texteMoyenne['fr'] = "Moyenne Obtenue : ";
				$texteMoyenne['en'] = "Average Obtained : ";
				$texteRang['fr'] = "Rang : ";
				$texteRang['en'] = "Rank : ";
				$texteFait['fr'] = "Fait à ".strtoupper($_SESSION['information']['ville'])." le ";
				$texteFait['en'] = "Done at ".strtoupper($_SESSION['information']['ville'])." on the ";
				$signataire['fr'] = $_SESSION['information']['signataire_fr'];
				$signataire['en'] = $_SESSION['information']['signataire_en'];
				if($eleve[$i]['moyenne']>=14){
					$encouragement['fr'] = "Avec Encouragements";
					$encouragement['en'] = "With Encouragements";
				}else{
					$encouragement['fr'] = "";
					$encouragement['en'] = "";
				}
				if($eleve[$i]['moyenne']>=15){
					$felicitation['fr'] = "Avec Félicitations";
					$felicitation['en'] = "With Congratulations";
				}else{
					$felicitation['fr'] = "";
					$felicitation['en'] = "";
				}


				$pdf->setFont('Times', '', 14);
				$pdf->Text(25, 90, $pdf->convert($texteEleve[$section]));
				$pdf->Text(25, 100, $pdf->convert($texteNe[$section]));
				$pdf->Text(125, 100, $pdf->convert($texteA[$section]));
				$pdf->Text(25, 110, $pdf->convert($texteClasse[$section]));
				$pdf->Text(155, 110, $pdf->convert($texteMatricule[$section]));
				$pdf->Text(25, 120, $pdf->convert($texteTrimestre[$section]));
				$pdf->Text(125, 120, $pdf->convert($texteAnneeScolaire[$section]));
				$pdf->Text(25, 130, $pdf->convert($texteConseil[$section]));
				$pdf->setFont('Times', '', 16);
				$pdf->Text(25, 140, $pdf->convert($texteMoyenne[$section]));
				$pdf->Text(155, 140, $pdf->convert($texteRang[$section]));
				$pdf->setFont('Times', '', 14);
				$pdf->Text(200, 160, $pdf->convert($texteFait[$section]));
				$pdf->Text(205, 165, $pdf->convert($signataire[$section]));


				$pdf->setFont('Times', 'BI', 14);
				$pdf->Text(70, 90, $pdf->convert($eleve[$i]['nom_eleve']));
				$pdf->Text(70, 100, $pdf->convert($eleve[$i]['date_fr']));
				$pdf->Text(135, 100, $pdf->convert($eleve[$i]['lieu_naissance']));
				$pdf->Text(70, 110, $pdf->convert($info['classe']));
				$pdf->Text(205, 110, $pdf->convert($eleve[$i]['rne']));
				$pdf->Text(85, 120, $pdf->convert($info['trimestre']));
				$pdf->Text(185, 120, $pdf->convert($_SESSION['information']['annee_scolaire']));
				$pdf->setFont('Times', 'BI', 16);
				$pdf->Text(85,140, $pdf->convert($eleve[$i]['moyenne'].' / 20'));
				$pdf->Text(190, 140, $pdf->convert($eleve[$i]['rang'].' / '.$eleve[$i]['classes']));
				$pdf->setFont('Times', 'BI', 17);
				$pdf->Text(25, 160, $pdf->convert($encouragement[$section]));
				$pdf->Text(25, 170, $pdf->convert($felicitation[$section]));
			}
			$fileName='Tableau_Honneur.pdf';
			$pdf->Output($fileName, 'I');
		}
		
		
	}
	else{
		$pdf->addPage();
		$titre = 'No data Sent';
		$pdf->Titre($titre);
		$pdf->SetFont('Times','B',12);
		// $pdf->Cell(5,20,'No Data Sent');
		$nomFichier = 'NoData.pdf';
		$pdf->Output($nomFichier, 'I');
	}
	
	
	unset($_SESSION['liste']);
	unset($_SESSION['print']);
	unset($_SESSION['sequence']);
	unset($_SESSION['classe']);