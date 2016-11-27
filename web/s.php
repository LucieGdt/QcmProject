<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="test.css" />
        <title></title>
    </head>
    <body>
		

<div id="desk-nav">
  <nav>
    <ul>
      <li><a href="ar.php">Home</a></li>
      <li><a href="">Profil</a></li>
      <li><a href="choixd.php">QCM</a></li>
      <li><a href="a.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>

<!-- END NAVIGATION -->
<!-- About  -->

<div id="about-me">

<h2>Statistiques</h2>
  <p>Tu as fini...quel est ton score ?</p>

<?php 
try{
require_once('Connexionbdd.php');
$date=time().'</br>';
$tempspasse=$date-$_POST['temps'];
$score=0;$faux=0;$vrai=0;
if(isset($_POST['reponse'])and trim($_POST['reponse']!=' ')){
	if(isset($_POST['checkboxes'])and trim($_POST['checkboxes']!=' ')){
		echo 'Vos réponses au QCM n° '.$_POST['qcm'].' : </br>';

		$question=$bdd->prepare('Select * from public.qcm natural join public.qcm_question natural join question where id_qcm=:idqcm');//pour chaque question
		$question->bindValue(':idqcm',$_POST['qcm']);
		$question->execute();
		while($quest=$question->fetch(PDO :: FETCH_ASSOC)){
			echo '</br></br></br>Question : '.$quest['question'].'</br>';		//affichage question
			$idquestionn=$quest['id_question'];
			$reponse=$bdd->prepare('Select * from public.reponse natural join public.qcm_question where id_question=:idquestion');//pour chaque réponse de la question
			$reponse->bindValue(':idquestion',$idquestionn);
			$reponse->execute();
			while($rep=$reponse->fetch(PDO::FETCH_ASSOC)){
				foreach($_POST['reponse'] as $c=>$v){
					if($rep['id_reponse']==$v){
						echo '</br>Vous avez répondu : ';		//affichage réponse donnée
						echo ' '.htmlspecialchars($rep['reponse'],ENT_QUOTES).'</br>';
							if ($rep['correct']){
								echo 'Réponse juste</br>';		//si la réponse est juste
								$vrai+=1;
							}else{
								echo 'Réponse fausse : </br>';	//si la réponse est fausse
								echo 'La réponse juste était :' ;
								$repjuste=$bdd->prepare('Select * from public.question natural join public.reponse where correct=TRUE and id_question=:mq');//trouve la réponse juste
								$repjuste->bindValue(':mq',$idquestionn);
								$repjuste->execute();
								while($l=$repjuste->fetch(PDO :: FETCH_ASSOC)){
									echo' '.htmlspecialchars($l['reponse'],ENT_QUOTES);//affichage réponse juste
								}
								$faux=1;
							}
					}
				}
			}
			if($faux==0 && $vrai==1){
				$point=$bdd->prepare('Select * from question where id_question=:mq');
								$point->bindValue(':mq',$idquestionn);
								$point->execute();
								while($ligne=$point->fetch(PDO::FETCH_ASSOC)){
										$score+=$ligne['valeur'];
								}
			}
			$faux=0;
			$vrai=0;
		}
	echo'</br></br></br>';
	
	echo ' Score : '.$score.'</br>Temps passé : '.$tempspasse.' secondes.</br></br>';
	}
}

}catch(PDOException $e){
	die('<p>Votre requête est erronée.</p>');
}
	
?>
</div>

<!-- END ABOUT  -->


<!-- Footer -->


<div id="footer-media">

  <a target="_blank" href="https://www.instagram.com/"><img src="https://raw.githubusercontent.com/atloomer/personal-site-revamp/gh-pages/img/insta-icon.png" alt="instagram icon" /></a>
  
  <a target="_blank" href="https://www.facebook.com/"><img src="https://raw.githubusercontent.com/atloomer/personal-site-revamp/gh-pages/img/facebook-icon.png" alt="facebook icon" /></a>

</div>

<footer>

  <p>&copy;  DUT Informatique  <span class="year">2016</span>. All Rights Reserved. </p>
  
</footer>

<!-- END FOOTER  -->
	
	</body>
	</html>