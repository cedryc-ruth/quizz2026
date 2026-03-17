<?php
session_start();

//Sécurisation (Authorization)

//Déclaration des variables, constantes et fonctions
$questions = [
	"Quel est la couleur du cheval blanc de Napoléon?",
	"Quel est votre jour préféré?",
	"Quel est votre cusine préférée?",
];
$reponses = [
	"blanc",
	"vendredi",
	"thaï",
];
$resultat = "";

if(!empty($_GET['nroQuestion'])) {
	$nroQuestion = $_GET['nroQuestion'];
} elseif(!empty($_POST['nroQuestion'])) {
	$nroQuestion = $_POST['nroQuestion'];
} else {
	$nroQuestion = 0;
}
//var_dump($nroQuestion);

$success = 'started';

$score = $_POST['score'] ?? $_GET['score'] ?? 0; // Récupération du score

//Traitement des commandes
if(isset($_POST['btSend'])) {
	//Valider les données
	if(!empty($_POST['reponse'])) {	//var_dump('OK');
		//Réponse correcte ?
		//var_dump($reponses[$nroQuestion]);
		if(strtolower(trim($_POST['reponse']))==$reponses[$nroQuestion]) {
			$nroQuestion++;
            $score += 2; // Ajouter 2 points
			
			if($nroQuestion<sizeof($questions)) {
				$resultat = "Bravo!";
				$success = 'good';
			} else {
				$resultat = "Félicitations!";
				$success = 'finished';
			}
		} else {
			$success = 'wrong';
            $score -= 1; // Retirer 1 points
			
			$resultat = "Dommage...";
		}
	} else {	//var_dump('PAS OK');
		$resultat = "Veuillez fournir une réponse.";
	}
}
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Quizz</title>
</head>
<body>
<p style="float:right;margin-right:100px"><?= $_SESSION["login"] ?></p>
<h1>Quizz</h1>

<?php if(!in_array($success,['good','finished'])) { ?>
	<p><?= $questions[$nroQuestion] ?></p>

	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
		<fieldset>
			<label for="reponse">Réponse: </label>
			<input type="text" name="reponse" id="reponse" required>
			<input type="hidden" name="nroQuestion" id="nroQuestion" value="<?= $nroQuestion ?>">
		</fieldset>
		<button name="btSend">Envoyer</button>
	</form>
<?php } ?>

<div id="resultat">
	<p>
		<?= $resultat ?>
	
	<?php if($success=='good') { ?>
		<a href="<?= $_SERVER['PHP_SELF'] ?>?nroQuestion=<?= $nroQuestion ?>">Question suivante</a>
	<?php } ?>
	</p>

    <!-- Affichage du score -->
<?php if($success=='finished') { ?>	
    <p>Score final : <?= $score ?> points</p> 
<?php } ?>
</div>
</body>
</html>