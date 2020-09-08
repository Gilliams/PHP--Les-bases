<?php
$title = "Méteo";
require 'vendor/autoload.php';
use App\OpenWeather;
$weather = new OpenWeather("b2b8d725db702a9773f57ce7aa5b240d");
$error = null;
try{
    $forecast = $weather->getForecast('Reims,fr');
    $today = $weather->getToday('Reims,fr');
}catch(Exception | Error $e){
    $error = $e->getMessage();
}
require_once "./elements/header.php"
?>

    <?php if($error): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
    <?php else: ?>
   

    <div class="container">
        <ul class="list-group">
            <li class="list-group-item list-group-item-primary">En ce moment : <?= $today['date']->format('d/m/Y H\hi')?> : <?= $today['description'] ?> <?=$today['temp']?>°C </li>
        <?php foreach($forecast as $day): ?>
            <li class="list-group-item">Le : <?= $day['date']->format('d/m/Y H\hi')?> : <?= $day['description'] ?> <?=$day['temp']?>°C </li>
        <?php endforeach ?>
        </ul>
    
    </div>
    <?php endif; ?>




<?php    require_once "./elements/footer.php" ?>
use App\OpenWeather;
