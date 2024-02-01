<?php
$bdd = new PDO("mysql:host=localhost;dbname=creatix;charset=utf8", "root", "");

if(isset($_POST['categorie_titre'])){
    if(!empty($_POST['categorie_titre'])) {
        $categorie_titre = htmlspecialchars($_POST['categorie_titre']);

        $ins = $bdd->prepare('INSERT INTO categories (nom, date_creation) VALUES (?, NOW())');
        $ins->execute(array($categorie_titre));

        $message = 'la categorie a bien été ajoutée';
    }else{ 
        $message = 'Veuillez remplir le champ'; 
    }
}
?>
<?php require 'header.php';?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'une catégorie</title>    
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <div class="form">
        <h1>Ajouter une catégorie</h1>
        <form action="newcategorie.php" method="post" enctype="multipart/form-data">
            <div class="form-fill">
                <label for="categorie_titre" class="form-label">Titre</label>
                <input type="text" id="categorie_titre" name="categorie_titre" class="form-control" required>
            </div>
            <div>
                <input type="submit" value="Valider">
            </div>
        </form>
        <?php if (isset($message)) {
            echo  '<p>' . $message . '.</p>';
        } ?>
    </div>
    <?php require 'footer.php';?>
</body>
</html>