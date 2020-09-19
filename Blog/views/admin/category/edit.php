<?php

use App\Auth;
use App\HTML\Form;
use App\Connection;
use App\ObjectHelper;
use App\Table\CategoryTable;
use App\Validators\CategoryValidator;

Auth::check();

$pdo = Connection::getPdo();
$table = new CategoryTable($pdo);
$item = $table->find($params['id']);
$errors = [] ;
$fields = ['name', 'slug'];

if( !empty($_POST)){
    $v = new CategoryValidator($_POST, $table, $item->getID());
    ObjectHelper::hydrate($item, $_POST, $fields);
    
    if($v->validate()){
        $table->update([
            'name' => $item->getName(),
            'slug' => $item->getSlug(),
        ], $item->getID());
        header('Location:' . $router->url('admin_categories') . "?edited=1");
        exit();
    }else{
        $errors = $v->errors();
    }
}

$form = new Form($item, $errors);
?>

<?php if(!empty($errors)): ?>
    <div class="alert alert-warning">
        La catégorie n'a pas pu être modifiée
    </div>
<?php endif ?>

<h1>Editer la catégorie <?=e($item->getName()) ?></h1>

<?php require('_form.php')?>