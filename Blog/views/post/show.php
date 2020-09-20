<?php

use App\Connection;
use App\Table\PostTable;
use App\Table\CategoryTable;

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPdo();
$post = (new PostTable($pdo))->find($id);
(new CategoryTable($pdo))->hydratePosts([$post]);


if($post->getSlug() !== $slug){
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
}

$title = $post->getName();

?>

<h1><?= e($title ) ?></h1>
<p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?></p>
<?php foreach($post->getCategories() as $k => $category): ?>
    <?php if($k > 0): ?>
        -
    <?php endif ?>
    <?php $category_url = $router->url('category', ['id' =>$category->getID(), 'slug' => $category->getSlug()]); ?>
    <a class="text-info" href="<?= $category_url ?>"><?= e($category->getName()) ?></a>
<?php endforeach ?>
<p><?= $post->getFormattedContent() ?></p>