<?php

use App\App;
require '../vendor/autoload.php';

$user = App::getAuth()->requireRole('admin');

?>

Réservé à l'admin