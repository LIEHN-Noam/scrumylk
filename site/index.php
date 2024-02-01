<?php
$host = 'localhost';
$database = 'creatix';
$user = 'root';
$psw = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $bdd = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $psw);
        $bdd->exec('SET NAMES utf8');

        $email = $_POST['email'];
        $password = $_POST['password'];

        $requete = $bdd->prepare("SELECT * FROM admins WHERE email = :email AND password = :password");
        $requete->bindParam(':email', $email);
        $requete->bindParam(':password', $password);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);

        if ($resultat) {
            header("Location: dashboard.php");
            // Vous pouvez rediriger l'utilisateur ou effectuer d'autres actions ici
        } else {
            $message= "Identifiant ou mot de passe incorrect";
        }
    } catch (PDOException $error) {
        echo '<h1 align="center">Impossible de se connecter</h1>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Connexion</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Connexion</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="email">Adresse e-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre adresse e-mail" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                        </div>
                        <?php
                    if (isset($message)){
                        echo '<p style="color:red;">'.$message.'</p>';
                    }
                    ?>  
                        <br>
                        <center>
                            <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                        </center>
                    </form>
                </div>
                <center>
                    <p class="mt-3">Vous n'avez pas de compte? <a href="inscription.php">Inscrivez-vous ici</a>.</p>
                </center>
            </div>
        </div>
    </div>
</div>
</body>
</html>
