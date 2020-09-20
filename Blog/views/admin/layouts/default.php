<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? e($title) : 'Mon Blog' ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css">
</head>
<body class="d-flex flex-column h-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?= $router->url('home') ?>">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $router->url('admin_posts') ?>">Article</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $router->url('admin_categories') ?>">Categories</a>
            </li>
            <li class="nav-item">
                <form action="<?= $router->url('logout')?>" method="POST" style="display:inline">
                <button class="nav-link" type="submit" style="background:transparent;border:none" >Se déconnecter</button></form>
            </li>
        </ul>
        
    </nav>
    <div class="container mt-4">

    <?= $content ?>

    </div>

    <footer class="bg-light py-4 footer  mt-auto">
        <div class="container">
            <?php if(defined('DEBUG_TIME')) : ?>
            Page générée en <?= round(1000 * (microtime(true) - DEBUG_TIME)) ?> ms
            <?php endif ?>
        </div>
    </footer>

</body>
</html>