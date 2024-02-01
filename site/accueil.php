<?php require 'header.php';
$bdd = new PDO("mysql:host=localhost;dbname=creatix;charset=utf8", "root", ""); 
$articles = $bdd->query('SELECT * FROM articles  ORDER BY date_public DESC');?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
<ul>
  <?php while($a =$articles->fetch()) { ?>
    <li>
      <a href="article.php?id=<?= $a['id'] ?>"><?= $a['titre'] ?></a>
    </li> <?php }  ?>
</ul>
<div data-aos="fade-up">
         <div class="comment-form">
  <h2>Laissez un commentaire</h2>
  
  <form action="#" method="post">
      <label for="comment">Commentaire</label>
      <textarea id="comment" name="comment" rows="4" required></textarea>

      <label for="name">Nom</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <input type="submit" value="Envoyer">
  </form>
</div>
    </div>
<script src="script.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <?php require 'footer.php';?>
</body>
</html>

