<h1>Home page</h1>


<a href="<?= $router->generate('contact') ?>">Nous contacter</a>
<a href="<?= $router->generate('article', ['id' => 60, 'slug' => "Coucou"]); ?>">Article</a>

<?php ob_start(); ?>
<script>alert('Test de bufferisation')</script>
<?php $pageJavescripts = ob_get_clean(); ?>