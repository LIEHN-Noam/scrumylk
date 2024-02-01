<?php 
$bdd = new PDO("mysql:host=localhost;dbname=creatix;charset=utf8", "root", ""); 

if (isset($_GET['id']) AND !empty($_GET['id'])){
    $get_id = htmlspecialchars($_GET['id']);
    $article = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
    $article->execute(array($get_id));

    if($article->rowCount() == 1){
        $article = $article->fetch();
        $id = $article['id'];
        $titre = $article['titre'];
        $contenu = $article['contenu'];
    } else {
        die('Cet article n\'existe pas');
    }
}else{
    die('Erreur');
}
?>
<?php require 'header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
</head>
<link rel="stylesheet" href="css/article.css">

<center>
    <h1><?= $titre ?></h1>
    <img src="img/<?= $id ?>.jpg" width="600px"/>
    <p><?= $contenu ?></p>
</center>



    
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
   
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
<?php require 'footer.php'; ?>
</body>
</html>