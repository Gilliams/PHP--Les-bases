<?php

use App\URLHelper;
use App\NumberHelper;
use App\TableHelper;

define('PER_PAGE',20);

require '../vendor/autoload.php';

$pdo = new PDO('mysql:dbname=phpg;host=127.0.0.1','phpG','grafikart', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);


$query      = 'SELECT * FROM products';
$queryCount = "SELECT COUNT(id) as count FROM products";
$params = [];
$sortable = ["id", "name", "city", "price", "address"];

// Recherche par ville
if(!empty($_GET['q'])){
    $query      .= " WHERE city LIKE :city" ;
    $queryCount .= " WHERE city LIKE :city" ;
    $params['city'] = "%" . $_GET['q'] . "%";
}

// // Fouchette de prix
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

// Organisation
if(!empty($_GET['sort']) && in_array($_GET['sort'], $sortable)){
    $direction = $_GET['dir'] ?? 'asc';
    if(!in_array($direction, ['asc', 'desc'])){
        $direction = 'asc';
    }
    $query .= " ORDER BY " . $_GET['sort'] . " $direction";
}

// Pagination
$page = (int)($_GET['p'] ?? 1);
$offset = ($page-1) * PER_PAGE;

$query .= " LIMIT " . PER_PAGE . " OFFSET $offset";
$statement = $pdo->prepare($query);
$statement->execute($params);
$products = $statement->fetchAll();
$statement = $pdo->prepare($queryCount);
$statement->execute($params);
$count = (int)$statement->fetch()['count'];
$pages = ceil($count / PER_PAGE);



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
            <div class="form-group">
                <input type="number" class="form-control" name="q-min" min="5000"  placeholder="Entrer votre prix minimal" value="<?= htmlentities($_GET['p-min'] ?? '') ?>">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="q-max" min="100000"  placeholder="Entrer votre prix maximal" value="<?= htmlentities($_GET['p-max'] ?? '') ?>">
            </div>
            <button class="btn btn-primary">Rechercher</button>
        </form>

        <h2><?=  $count > 1 ? 'Biens immobiliers trouvés' : 'Bien immobilier trouvé' ?> <?= $count ?></h2>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"><?= TableHelper::sort('id', 'ID', $_GET) ?></th>
                    <th scope="col"><?= TableHelper::sort('name', 'Nom', $_GET) ?></th>
                    <th scope="col"><?= TableHelper::sort('price', 'Prix', $_GET) ?></th>
                    <th scope="col"><?= TableHelper::sort('city', 'Ville', $_GET) ?></th>
                    <th scope="col"><?= TableHelper::sort('address', 'Adresse', $_GET) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product): ?>
                    <tr>
                        <th scope="row"># <?= $product['id'] ?></th>
                        <th scope="row"><?= $product['name'] ?></th>
                        <th scope="row"><?= NumberHelper::price($product['price']) ?></th>
                        <th scope="row"><?= $product['city'] ?></th>
                        <th scope="row"><?= $product['address'] ?></th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if($pages > 1 && $page > 1) :?>
            <a href="?<?= URLHelper::withParam($_GET,"p",$page -1) ?>" class="btn btn-primary">Page précédente</a>
        <?php endif ?>
        <?php if($pages > 1 && $page < $pages) :?>
            <a href="?<?= URLHelper::withParam($_GET,"p",$page +1) ?>" class="btn btn-primary">Page suivante</a>
        <?php endif ?>


    </div>
</body>
</html>