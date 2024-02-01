<?php
$bdd = new PDO("mysql:host=localhost;dbname=creatix;charset=utf8", "root", "");

if (isset($_GET['id']) AND !empty($_GET['id'])) {
    $category_id = htmlspecialchars($_GET['id']);
    $articles_by_category = $bdd->prepare('SELECT * FROM articles WHERE categorie_id = ? ORDER BY date_public DESC');
    $articles_by_category->execute(array($category_id));
    $category_name_query = $bdd->prepare('SELECT nom FROM categories WHERE id = ?');
    $category_name_query->execute(array($category_id));
    $c = $category_name_query->fetch();
} else {
    die('Erreur : aucune catégorie sélectionnée...');
}
?>

<?php require 'header.php'; ?><link rel="stylesheet" href="css/styles.css">
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles par catégorie</title>
</head>
<body>
<h1 style="text-align: center">Articles de la catégorie « <?php echo $c['nom']; ?> »</h1>
<ul>
    <li class="retour"><a href="categories.php">Retour à la page des catégories</a></li>
  <?php while($a = $articles_by_category->fetch()) { ?>
    <li>
      <a href="article.php?id=<?= $a['id'] ?>"><?= $a['titre'] ?></a> | <a href="newarticle.php?edit=<?= $a['id'] ?>">
        Modifier</a> | <a href="supprimer.php?id=<?= $a['id'] ?>">Supprimer</a>
    </li> <?php }  ?>
</ul>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<?php require 'footer.php'; ?>
</body>
</html>