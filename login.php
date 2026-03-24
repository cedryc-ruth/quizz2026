<?php
session_start();    //Démarrer ou reprendre une session

if(isset($_GET["logout"])) {
    //Déconnexion
    unset($_SESSION["login"]);

    session_destroy();  //Supprimer le fichier de session (facultatif)

    //Redirection
    /*
    header("Status: 302 Temporary");
    header("Location: quizz.php");
    */

    header("Location: quizz.php", null, 302);
}

var_dump($_POST);

$message = "";

if(isset($_POST["btLogin"])) {
    if(!empty($_POST["login"]) && !empty($_POST["password"])) {
        if($_POST["login"]=="bob" && $_POST["password"]=="epfc") {
            //Sauver son login dans la session
            $_SESSION["login"] = $_POST["login"];

            //Rediriger vers le quizz
            header("Location: quizz.php", false, 302);
            exit();
        } else {
            $message = "Identifiants incorrects!";
        }
    } else {
        $message = "Veuillez remplir tous les champs obligatoires!";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Se connecter</h1>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" class="form-control" id="login" name="login" placeholder="Votre login">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Votre password">
                    </div>
                    <button type="submit" name="btLogin" class="btn btn-primary">Se connecter</button>
                </form>

                <div><?= $message ?></div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>


