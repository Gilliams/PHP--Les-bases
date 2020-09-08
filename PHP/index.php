<?php
session_start();
$_SESSION['role'] = 'admin';
$title = "Page d'accueil";
require 'elements/header.php';
?>


<?php require 'elements/footer.php'; ?>