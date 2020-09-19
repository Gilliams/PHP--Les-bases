<?php

use App\Auth;
use App\HTML\Form;

use App\Connection;
use App\ObjectHelper;
use App\Model\Category;
use App\Table\CategoryTable;
use App\Validators\CategoryValidator;

Auth::check();

$errors = [];
$item = new Category();


if( !empty($_POST)){
    $pdo = Connection::getPdo();
    $table = new CategoryTable($pdo);
    $v = new CategoryValidator($_POST, $table, $item->getID());
    ObjectHelper::hydrate($item, $_POST, ['name', 'slug']);
    if($v->validate()){
        $table->create([
            'name' => $item->getName(),
            'slug' => $item->getSlug(),
        ]);
        header('Location:' .$router->url('admin_categories', ['id' => $item->getID()]) . "?created=1");
        exit();
    }else{
        $errors = $v->errors();
    }
}

$form = new Form($item, $errors);
?>

<?php if(!empty($errors)): ?>
    <div class="alert alert-warning">
        La catégorie n'a pas pu être enregistré
    </div>
<?php endif ?>

<h1>Créer une catégorie</h1>

<?php require('_form.php')?>