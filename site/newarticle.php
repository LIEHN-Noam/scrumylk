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
        <form action="saveArticle.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="title" class="form-label">Titre</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>  

            <div>
                <label for="image" class="form-label">Image pour l'article</label>
                <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png" class="form-control" required>
            </div>

            <div>
                <label for="contenu" class="form-label">Contenu de l'article</label>
                <textarea name="contenu" id="contenu" cols="60" rows="40" class="form-control"></textarea>
            </div>

            <input type="submit" value="Valider">
        </form>
        
    </div>
    <?php require 'footer.php';?>
</body>
</html>