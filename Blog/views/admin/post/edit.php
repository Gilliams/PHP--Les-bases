<?php

use App\Connection;
use App\Validator;
use App\Table\PostTable;

$pdo = Connection::getPdo();
$postTable = new PostTable($pdo);
$post = $postTable->find($params['id']);
$success = false;

if( !empty($_POST)){
    Validator::lang('fr');
    $validator = new Validator($_POST);

    $validator->rule('required', 'name');
    $validator->rule('lengthBetween', 'name', 3, 200);

    $post->setName($_POST['name']);
    if($validator->validate()){
        $postTable->update($post);
        $success = true;
    }else{
        $errors = $validator->errors();
    }
}

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

<form action="" method="Post">

    <div class="form-group">
        <label for="name">Titre</label>
        <input type="text" class="form-control <?= $errors['name'] ? 'is-invalid' : '' ?>" name="name" value="<?= e($post->getName()) ?>" required>
        <?php if(isset($errors['name'])) : ?>
            <div class="invalid-feedback">
                <?= implode('<br>', $errors['name']) ?>
            </div>
        <?php endif ?>
    </div>
    <button class="btn btn-primary">Modifier</button>

</form>