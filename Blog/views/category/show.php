<?php


use App\Connection;
use App\Model\Post;
use App\Model\Category;
use App\PaginatedQuery;
use App\Table\CateogryTable;
use App\Table\PostTable;

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPdo();
$category = (new CateogryTable($pdo))->find($id);


if($category->getSlug() !== $slug){
    $url = $router->url('category', ['slug' => $category->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
}

$title = "Categories {$category->getName()}";

[$posts, $paginatedQuery] = (new PostTable($pdo))->findPaginatedForCategory($category->getID());

$link = $router->url('category', ['id' =>$category->getID(), 'slug' => $category->getSlug()]);
?>

<h1><?= e($title) ?></h1>

<div class="row">
    <?php foreach($posts as $post) :?>
    <div class="col-md-3">
       <?php require dirname(__DIR__) . '/post/card.php' ?>
    </div>
    <?php endforeach ?>
</div>

<div class="d-flex justify-content-between my-4">
    <?= $paginatedQuery->previousLink($link) ?>
    <?= $paginatedQuery->nextLink($link) ?>
</div>