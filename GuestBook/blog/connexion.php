<?php
$error = null;
try{
    $pdo = new PDO('mysql:dbname=phpg;host=127.0.0.1','phpG','grafikart', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);
    
}catch(PDOException $e){
    $error =  "Connexion échouée : " . $e->getMessage();
}
