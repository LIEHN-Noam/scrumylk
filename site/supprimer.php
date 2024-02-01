<?php
$bdd = new PDO("mysql:host=localhost;dbname=creatix;charset=utf8", "root", "");

if(isset($_GET['id']) AND !empty($_GET['id'])) {
    $suppr_id = htmlspecialchars($_GET['id']);
    $suppr = $bdd->prepare('DELETE FROM articles WHERE id = ?');
    $suppr->execute(array($suppr_id));

    // Utilisation de JavaScript pour récupérer l'URL de la page précédente
    echo '<script type="text/javascript">window.location.href = document.referrer;</script>';
    exit();
}
?>
