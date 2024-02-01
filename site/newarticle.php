<?php
$bdd = new PDO("mysql:host=localhost;dbname=creatix;charset=utf8", "root", "");

$mode_edition = 0;

$sql_categories = "SELECT * FROM categories";
$result_categories = $bdd->query($sql_categories);

if (isset($_GET['edit']) AND !empty($_GET['edit'])) {
    $mode_edition = 1;
    $edit_id = htmlspecialchars($_GET['edit']);
    $edit_article = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
    $edit_article->execute(array($edit_id));
    if ($edit_article->rowCount() == 1) {
        $edit_article = $edit_article->fetch();
    } else {
        die('Erreur : l\'article n\'existe pas...');
    }
}

if (isset($_POST['article_titre'], $_POST['article_contenu'], $_POST['categorie'])) {
    if (!empty($_POST['article_titre']) AND !empty($_POST['article_contenu'])) {
        $article_titre = htmlspecialchars($_POST['article_titre']);
        $article_contenu = htmlspecialchars($_POST['article_contenu']);

        if ($mode_edition == 0) {

            $ins = $bdd->prepare('INSERT INTO articles (titre, contenu, date_public, categorie_id) VALUES (?, ?, NOW(), ?)');
            $ins->execute(array($article_titre, $article_contenu, $_POST['categorie']));
            $lastid = $bdd->lastInsertId();

            if(isset($_FILES['imag']) AND !empty($_FILES['imag']['name'])){
                if(exif_imagetype($_FILES['imag']['tmp_name']) == 2){
                    $chemin = 'img/'.$lastid.'.jpg';
                    move_uploaded_file($_FILES['imag']['tmp_name'], $chemin);
                } else {
                    $message = 'Votre image doit être au format GIF, JPG ou PNG';
                }
            
            }
            $message = 'Votre article a bien été posté';
            

        } else {
            $update = $bdd->prepare('UPDATE articles SET titre = ?, contenu = ?, date_edition = NOW(), categorie_id = ? WHERE id = ?');
            $update->execute(array($article_titre, $article_contenu, $_POST['categorie'], $edit_id));
            header('Location: article.php?id='.$edit_id);
            $message = 'Votre article a bien été mis à jour !';
        }
    } else {
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
    <title>Ajout / édition d'un article</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <div class="form">
        <form method="post" class="formfill" enctype="multipart/form-data">
            <div>
                <label for="article_titre" class="form-label">Titre</label>
                <input type="text" name="article_titre" placeholder="Titre" value="<?php if ($mode_edition == 1) { echo $edit_article['titre']; } ?>" required>
            </div>

            <div>
                <label for="article_contenu" class="form-label">Contenu de l'article</label>
                <textarea name="article_contenu" placeholder="Contenu de l'article" rows="10" cols="30"><?php if ($mode_edition == 1) { echo $edit_article['contenu']; } ?></textarea>
            </div>
            <?php if($mode_edition == 0) {?>
            <div>
                <input type="file" name="imag" />
            </div>
            <?php } ?>
            <div>
                <label for="categorie">Catégorie :</label>
                <select name="categorie" required>
                    <option value="">Choisir une catégorie</option>
                    <?php
                    while ($row = $result_categories->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row["id"] . "'" . ($mode_edition == 1 && $edit_article['categorie_id'] == $row['id'] ? ' selected' : '') . ">" . $row["nom"] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <input type="submit" value="Valider">
        </form>
        <?php if (isset($message)) {
            echo '<p>' . $message . '.</p>';
        } ?>
    </div>
    <?php require 'footer.php';?>
</body>
</html>
