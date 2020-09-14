<?php

use App\Table;
use App\URLHelper;
use App\TableHelper;
use App\NumberHelper;
use App\QueryBuilder;

define('PER_PAGE',20);

require '../vendor/autoload.php';

$pdo = new PDO('mysql:dbname=phpg;host=127.0.0.1','phpG','grafikart', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
$query = (new QueryBuilder($pdo))->from('products');

// Recherche par ville
if(!empty($_GET['q'])){
    $query
        ->where('city LIKE :city')
        ->setParam('city', "%" . $_GET['q'] . "%");
}

// Fouchette de prix
if(!empty($_GET['q-min']) && !empty($_GET['q-max'])){
    if(empty($_GET['q'])){
        $query      .= " WHERE price BETWEEN :min AND :max" ;
        $queryCount .= " WHERE price BETWEEN :min AND :max" ;
    }else{
        $query      .= " AND price BETWEEN :min AND :max" ;
        $queryCount .= " AND price BETWEEN :min AND :max" ;
    }
    $params['min'] = (int)$_GET['q-min'];
    $params['max'] = (int)$_GET['q-max'];
}


$table = (new Table($query, $_GET))
    ->sortable('id', 'city','price')
    ->format('price', function($value){
        return NumberHelper::price($value);
    })
    ->columns([
    'id' => "ID",
    'name' => 'Nom',
    'city' => 'Ville',
    'price' => "Prix"
]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Tableau dynamique' ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body class="p-4">
    <div class="container-fluid ">
        <h1>Les biens immobiliers</h1>
        <form action="" class="mb-4">
            <div class="form-group">
                <input type="text" class="form-control" name="q" placeholder="Rechercher par ville" value="<?= htmlentities($_GET['q'] ?? '') ?>">
            </div>
            <!-- <div class="form-group">
                <input type="number" class="form-control" name="q-min" min="5000"  placeholder="Entrer votre prix minimal" value="<?= htmlentities($_GET['p-min'] ?? '') ?>">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="q-max" min="100000"  placeholder="Entrer votre prix maximal" value="<?= htmlentities($_GET['p-max'] ?? '') ?>">
            </div> -->
            <button class="btn btn-primary">Rechercher</button>
        </form>

        <!-- <h2><?=  $count > 1 ? 'Biens immobiliers trouvés' : 'Bien immobilier trouvé' ?> <?= $count ?></h2> -->

        <?php $table->render() ?>



    </div>
</body>
</html>