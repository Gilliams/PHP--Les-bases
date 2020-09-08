<?php
// use App\Post;
require 'connexion.php';
require '../vendor/autoload.php';

$title = "Blog";
// $error = null;
try{
    if(isset($_POST['name'],$_POST['content'])){
        $query = $pdo->prepare("INSERT INTO blog (name,content, created_at) VALUES (:name,:content,:created)");
        $query->execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'created' => time()
        ]);
        header('Location: /blog/edit.php?id='.$pdo->lastInsertId());
    }
    // Connexion à la bd depuis un fichier

    // $pdo = new PDO('mysql:dbname=phpg;../blog.sql','phpG','grafikart', [
    //     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    //     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    // ]);
    $query = $pdo->query("SELECT * FROM blog");
    $posts = $query->fetchAll(PDO::FETCH_CLASS, 'App\Post');
}catch(PDOException $e){
    $error =  "Connexion échouée : " . $e->getMessage();
}

require "../elements/header.php"
?>
<?php if($error): ?>
<div class="alert alert-outline-warning">
    <?= $error ?>
</div>
<hr>
<?php endif ?>
<div class="container">
<form action="" method="post" class="mt-4 mb-4">
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Entrez votre nom">
        </div>
        <div class="form-group">
            <textarea name="content" class="form-control" placeholder="Entrez votre contenu"></textarea>
        </div>
        <button class="btn btn-primary">Sauvegarder</button>
    </form>
    <?php foreach($posts as $post): ?>
        <h2>
            <a href="/blog/edit.php?id=<?= $post->id ?>">
                <?= htmlentities($post->name) ?>
            </a>
        </h2>
        <p>
            <?= $post->getBody() ?>
        </p>
        <p class="small text-muted">Ecrit le <?= $post->created_at->format('d/m/Y à H:i') ?></p>
        <button class="btn btn-outline-warning">
            <a href="/blog/suppr.php?id=<?= $post->id ?>">Supprimer</a>
        </button>
    <?php endforeach ?>
   

</div>


<?php require "../elements/footer.php"?>

