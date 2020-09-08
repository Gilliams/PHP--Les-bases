<?php

require_once 'connexion.php';

$pdo->beginTransaction();
$pdo->exec('UPDATE blog SET name = "demo", content = "demo" WHERE id = 2');
$post =  $pdo->query('SELECT * FROM blog WHERE id = 2')->fetch();
var_dump($post);
$pdo->rollback();