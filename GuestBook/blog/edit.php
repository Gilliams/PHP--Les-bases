<?php
require_once 'connexion.php';
$title = "Blog";
// $error = null;
$success = null;

try{
    if(isset($_POST['name'],$_POST['content'])){
        $query = $pdo->prepare("UPDATE blog SET name = :name, content = :content WHERE id = :id");
        $query->execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'id' => $_GET['id']
        ]);
        $success = "Votre article a bien été modifié";
    }
   
    $query = $pdo->prepare("SELECT * FROM blog WHERE id = :id ");
    $query->execute([
        'id' => $_GET['id']
    ]);
    $post = $query->fetch();
}catch(PDOException $e){
    $error =  "Connexion échouée : " . $e->getMessage();
}

require "../elements/header.php"
?>

<?php if($error): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
    <hr>
<?php endif ?>
<?php if($success): ?>
    <div class="alert alert-success">
        <?= $success ?>
    </div>
    <hr>
<?php endif ?>
<div class="container">
    <form action="" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="name" value="<?= htmlentities($post->name) ?>">
        </div>
        <div class="form-group">
            <textarea name="content" class="form-control"><?= htmlentities($post->content) ?></textarea>
        </div>
        <button class="btn btn-primary">Modifier</button>
    </form>

    <p><a href="/blog">Revenir au blog</a></p>

</div>


<?php require "../elements/footer.php"?>