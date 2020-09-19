<?php

use App\Auth;
use App\Connection;
use App\Table\CategoryTable;

Auth::check();

$title = "Administration categories";
$pdo = Connection::getPdo();

$table = new CategoryTable($pdo);
$link = $router->url('admin_categories');
$items = (new CategoryTable($pdo))->all();
?>
<h1>Administration des catégories</h1>

<?php if( isset($_GET['delete'])): ?>
    <div class="alert alert-success">
        La catégorie a bien été supprimée
    </div>
<?php endif ?>

<?php if(isset($_GET['created'])): ?>
    <div class="alert alert-success">
        La catégorie a bien été ajoutée
    </div>
<?php endif ?>
<?php if(isset($_GET['edited'])): ?>
    <div class="alert alert-success">
        La catégorie a bien été modifiée
    </div>
<?php endif ?>

<div class="row">
    <table class="table table-hover">
        <thead>
            <th scope="col">ID</th>
            <th scope="col">Titre</th>
            <th scope="col">Slug</th>
            <th scope="col">
                <a href="<?= $router->url('admin_category_new')?>" class="btn btn-primary">Nouveau</a>
            </th>
        </thead>
        <tbody>
            <?php foreach($items as $item) :?>
                <tr class="table-secondary">
                    <td>#<?= $item->getID() ?></td>
                    <td>
                        <a href="<?= $router->url('admin_category', ['id' => $item->getID()]) ?>"><?= e($item->getName()) ?></a>
                    </td>
                    <td><?= $item->getSlug() ?></td>
                    <td>
                        <a href="<?= $router->url('admin_category', ['id' => $item->getID()]) ?>" class="btn btn-primary">Editer</a>
                        <form 
                            action="<?= $router->url('admin_category_delete', ['id' => $item->getID()]) ?>" 
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
