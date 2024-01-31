<?php
$host = 'localhost';
$database = 'creatix';
$user = 'root';
$psw = '';

try {
    $bdd = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $psw);
    $bdd->exec('SET NAMES utf8');

    if (isset($_POST['inscription'])) {
        $username = $_POST['username'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Utilisez des préparations de requêtes pour éviter les attaques par injection SQL
        $requete = $bdd->prepare("INSERT INTO admins (nom, prenom, email, password) VALUES (:nom, :prenom, :email, :password)");
        $requete->bindParam(':nom', $username);
        $requete->bindParam(':prenom', $surname);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':password', $password);

        if ($requete->execute()) {
            echo "Inscription réussie!";
            // Vous pouvez rediriger l'utilisateur ou effectuer d'autres actions ici
        } else {
            echo "Erreur lors de l'inscription.";
        }
    }
} catch (PDOException $error) {
    echo '<h1 align="center">Impossible de se connecter</h1>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Inscription</title>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Inscription</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="username">Nom</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Entrez votre nom">
                        </div>
                        <div class="form-group">
                            <label for="surname">Prénom</label>
                            <input type="text" class="form-control" id="surname" name="surname" placeholder="Entrez votre prénom">
                        </div>
                        <div class="form-group">
                            <label for="email">Adresse e-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre adresse e-mail">
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe">
                        </div>
                        <button name="inscription" type="submit" class="btn btn-primary btn-block">S'inscrire</button>
                    </form>
                </div>
                <center>
                    <p class="mt-3">Vous avez un compte? <a href="connexion.php">Connectez-vous ici</a>.</p>
                </center>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
