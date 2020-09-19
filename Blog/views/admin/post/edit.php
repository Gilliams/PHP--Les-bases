<?php

use App\Auth;
use App\HTML\Form;
use App\Connection;
use App\ObjectHelper;
use App\Table\PostTable;
use App\Validators\PostValidator;

Auth::check();

$pdo = Connection::getPdo();
$table = new PostTable($pdo);
$item = $table->find($params['id']);
$success = false;

$errors = [];

if( !empty($_POST)){
    $v = new PostValidator($_POST, $table, $item->getID());
    ObjectHelper::hydrate($item, $_POST, ['name', 'content', 'slug', 'created_at']);
    
    if($v->validate()){
        $table->updatePost($item);
        $success = true;
    }else{
        $errors = $v->errors();
    }
}

$form = new Form($item, $errors);
?>

<?php if($success): ?>
    <div class="alert alert-success">
        L'article a bien été modifié
    </div>
<?php endif ?>

<?php if(!empty($errors)): ?>
    <div class="alert alert-warning">
        L'article n'a pas pu être modifié
    </div>
<?php endif ?>

<h1>Editer l'article <?=e($item->getName()) ?></h1>

<?php require('_form.php')?>