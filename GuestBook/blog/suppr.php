<?php

require_once 'connexion.php';


$success = null;
try{
    $query = $pdo->prepare('DELETE FROM blog WHERE id = :id')->execute([
        'id' => $_GET['id']
    ]);
    header('Location: /blog/index.php');
}catch(PDOException $e){
    $error =  "Connexion échouée : " . $e->getMessage();
}

require "../elements/header.php"
?>

<?= $success ?>

<?php
require "../elements/footer.php"
?>