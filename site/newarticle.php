<?php
$bdd = new PDO("mysql:host=localhost;dbname=creatix;charset=utf8", "root", "");

if(isset($_POST['article_titre'], $_POST['article_contenu'])){
    if(!empty($_POST['article_titre'])AND !empty($_POST['article_contenu'])) {
        $article_titre = htmlspecialchars($_POST['article_titre']);
        $article_contenu =htmlspecialchars($_POST['article_contenu']);

        $ins = $bdd->prepare('INSERT INTO articles (titre, contenu, date_public) VALUES (?, ?, NOW())');
        $ins->execute(array($article_titre, $article_contenu));

        $message = 'Votre article a bien été posté';
    }else{ 
        $message = 'Veuillez remplir tous les champs'; 
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
    <style>
        body{
            overflow-x : hidden;
        }
    </style>
</head>
<body>
    <div>
        <h1>Ajouter un article</h1>
        <form action="newarticle.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="article_titre" class="form-label">Titre</label>
                <input type="text" id="article_titre" name="article_titre" class="form-control" required>
            </div>  

            <div>
                <label for="article_contenu" class="form-label">Contenu de l'article</label>
                <textarea name="article_contenu" id="article_contenu" cols="60" rows="40" class="form-control"></textarea>
            </div>

            <input type="submit" value="Valider">
        </form>
        <?php if (isset($message)) {
            echo  '<p>' . $message . '.</p>';
        } ?>
    </div>
    <?php require 'footer.php';?>
</body>
</html>