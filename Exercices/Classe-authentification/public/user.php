<?php
use App\App;
require '../vendor/autoload.php';

$user = App::getAuth()->requireRole('user', 'admin');
require '../vendor/autoload.php';
?>
Réservé à l'utilisateur