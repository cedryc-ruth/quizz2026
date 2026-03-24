<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Quizz</title>
</head>
<body>
<header>
    <p style="float:right;margin-right:100px"><?= $_SESSION["login"] ?? "Anonyme" ?></p>
    <h1><a href="quizz.php">Quizz</a></h1>

    <nav>
        <ul>
            <li><a href="quizz.php">Accueil</a></li>
        <?php if(empty($_SESSION["login"])) { ?>
            <li><a href="login.php">Connexion</a></li>
        <?php } else { ?>
            <li><a href="login.php?logout">Déconnexion</a></li>
        <?php } ?>
            <li><a href="signin.php">Inscription</a></li>
        </ul>
    </nav>
</header>