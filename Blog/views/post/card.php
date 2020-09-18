<?php
$categories = array_map(function($category) use ($router){
    $category_url = $router->url('category', ['id' =>$category->getID(), 'slug' => $category->getSlug()]);
    return "<a class='text-info' href=".$category_url.">".e($category->getName())."</a>";
}, $post->getCategories());

?>
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><?= htmlentities($post->getName()) ?></h5>
        <p class="text-muted">
            <?= $post->getCreatedAt()->format('d F Y') ?>
            <?php if(!empty($post->getCategories())): ?>
                -
                <?= implode(' - ', $categories); ?>
            <?php endif ?>
        </p>
        <p><?= $post->getExcerpt() ?></p>
        <p><a href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>" class="btn btn-primary">Voir plus</a></p>
    </div>
</div>

