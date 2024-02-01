<?php
$bdd = new PDO("mysql:host=localhost;dbname=creatix;charset=utf8", "root", "");
$categories = $bdd->query('SELECT * FROM categories ORDER BY date_creation DESC');
?>

<?php require 'header.php'; ?><link rel="stylesheet" href="css/styles.css">
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories</title>
</head>
<body>
<h1 style="text-align: center">Catégories</h1>
<ul>
  <?php while($c =$categories->fetch()) { ?>
    <li>
      <a href="articles_par_categorie.php?id=<?= $c['id'] ?>"><?= $c['nom'] ?></a>
    </li> <?php }  ?>
</ul>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<?php require 'footer.php'; ?><?php