<?php

use App\Auth;
use App\Connection;
use App\Table\PostTable;

Auth::check();

$title = "Administration";
$pdo = Connection::getPdo();

$table = new PostTable($pdo);
[$posts, $pagination] = (new PostTable($pdo))->findPaginated();

$link = $router->url('admin_posts');
?>
<h1>Administration</h1>

<?php if( isset($_GET['delete'])): ?>
    <div class="alert alert-success">
        L'enregistrement a bien été supprimé
    </div>
<?php endif ?>

<div class="row">
    <table class="table table-hover">
        <thead>
            <th scope="col">ID</th>
            <th scope="col">Titre</th>
            <th scope="col">Actions</th>
        </thead>
        <tbody>
            <?php foreach($posts as $post) :?>
                <tr class="table-secondary">
                    <td>#<?= $post->getID() ?></td>
                    <td>
                        <a href="<?= $router->url('admin_post', ['id' => $post->getID()]) ?>"><?= e($post->getName()) ?></a>
                    </td>
                    <td>
                        <a href="<?= $router->url('admin_post', ['id' => $post->getID()]) ?>" class="btn btn-primary">Editer</a>
                        <form 
                            action="<?= $router->url('admin_post_delete', ['id' => $post->getID()]) ?>" 
                            method="post" 
                            onsubmit="return confirm('Voulez vous vraiment effectuer cette action ?')"
                            style="display:inline"
                        >
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>    
</div>

<div class="d-flex justify-content-between my-4">
    <?= $pagination->previousLink($link) ?>
    <?= $pagination->nextLink($link) ?>
</div>