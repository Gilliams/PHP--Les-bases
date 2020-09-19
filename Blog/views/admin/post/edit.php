<?php

use App\Connection;
use App\ObjectHelper;
use App\HTML\Form;
use App\Table\PostTable;
use App\Validators\PostValidator;

$pdo = Connection::getPdo();
$postTable = new PostTable($pdo);
$post = $postTable->find($params['id']);
$success = false;

$errors = [];

if( !empty($_POST)){
    $v = new PostValidator($_POST, $postTable, $post->getID());
    ObjectHelper::hydrate($post, $_POST, ['name', 'content', 'slug', 'created_at']);
    
    if($v->validate()){
        $postTable->update($post);
        $success = true;
    }else{
        $errors = $v->errors();
    }
}

$form = new Form($post, $errors);
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

<h1>Editer l'article <?=e($post->getName()) ?></h1>

<?php require('_form.php')?>