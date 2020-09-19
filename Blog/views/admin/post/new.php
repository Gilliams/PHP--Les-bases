<?php

use App\Auth;
use App\HTML\Form;
use App\Connection;
use App\Model\Post;
use App\ObjectHelper;
use App\Table\PostTable;
use App\Table\CategoryTable;
use App\Validators\PostValidator;

Auth::check();

$success = false;
$errors = [];
$post = new Post();
$pdo = Connection::getPdo();
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();
$post->setCreatedAt(date('Y-m-d H:i:s'));

if( !empty($_POST)){
    $postTable = new PostTable($pdo);
    $v = new PostValidator($_POST, $postTable, $post->getID(), $categories);
    ObjectHelper::hydrate($post, $_POST, ['name', 'content', 'slug', 'created_at']);
    if($v->validate()){
        $pdo->beginTransaction();
        $postTable->createPost($post);
        $postTable->attachCategories($post->getID(), $_POST['categories_ids']);
        $pdo->commit();
        header('Location:' .$router->url('admin_posts', ['id' => $post->getID()]) . "?created=1");
        exit();
    }else{
        $errors = $v->errors();
    }
}

$form = new Form($post, $errors);
?>

<?php if($success): ?>
    <div class="alert alert-success">
        L'article a bien été enregistré
    </div>
<?php endif ?>

<?php if(!empty($errors)): ?>
    <div class="alert alert-warning">
        L'article n'a pas pu être enregistré
    </div>
<?php endif ?>

<h1>Créer un nouvel article</h1>

<?php require('_form.php')?>