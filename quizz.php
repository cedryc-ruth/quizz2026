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
$success = 'started';

//Récupérer les données sauvegardées (URL, form POST, Cookie, Session, fichier, base de données, serveur)
/*
if(!empty($_GET['nroQuestion'])) {
	$nroQuestion = $_GET['nroQuestion'];
} elseif(!empty($_POST['nroQuestion'])) {
	$nroQuestion = $_POST['nroQuestion'];
} else {
	$nroQuestion = 0;
}
*/
$nroQuestion = $_SESSION["nroQuestion"] ?? 0;	//Récupération du nro de question
var_dump($nroQuestion);

$score = $_SESSION['score'] ?? 0; // Récupération du score
var_dump($score);

//Traitement des commandes
if(isset($_POST['btSend'])) {
	//Valider les données
	if(!empty($_POST['reponse'])) {	//var_dump('OK');
		//Réponse correcte ?
		//var_dump($reponses[$nroQuestion]);
		if(strtolower(trim($_POST['reponse']))==$reponses[$nroQuestion]) {
			$nroQuestion++;
			$_SESSION["nroQuestion"] = $nroQuestion;

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

		//Sauver le score dans la session
		$_SESSION["score"] = $score;
	} else {	//var_dump('PAS OK');
		$resultat = "Veuillez fournir une réponse.";
	}
}
?>

<?php include("includes/header.php"); ?>

<main>
<?php if(!in_array($success,['good','finished'])) { ?>
	<p><?= $questions[$nroQuestion] ?></p>

		<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
			<fieldset>
				<label for="reponse">Réponse: </label>
				<input type="text" name="reponse" id="reponse" required>
			</fieldset>
			<button name="btSend">Envoyer</button>
	</form>
<?php } ?>

	<div id="resultat">
		<p>
			<?= $resultat ?>
		
		<?php if($success=='good') { ?>
			<a href="<?= $_SERVER["PHP_SELF"] ?>">Question suivante</a>
		<?php } ?>
		</p>

		<!-- Affichage du score -->
	<?php if($success=='finished') { ?>	
		<p>Score final : <?= $score ?> points</p> 
	<?php } ?>
	</div>
</main>

<?php include("includes/footer.php"); ?>