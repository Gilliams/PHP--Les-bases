<?php

require_once "./elements/header.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Message.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'GuestBook.php';
$title = "Livre d'or";
$errors = null;
$valid = null;

if(!empty($_POST['pseudo']) && !empty($_POST['message'])){
    $message = new Message($_POST['pseudo'], $_POST['message']);
    $errors = $message->getErrors();
    $valid = $message->isValid();
}

$guestBook = new GuestBook(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages')

?>


<div class="container-fluid">
<h2>Livre d'or</h2>

<?php if ($errors) : ?>
    <?php foreach($errors as $error): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php endforeach; ?>
<?php endif ?>

<?php if ($valid) : ?>
    <div class="alert alert-success">
        <p>Votre message à bien été envoyé</p>
    </div>
<?php endif ?>

<form action="" method="post">
    <div class="form-group">
        <input type="text" name="pseudo" class="form-control" label="Votre pseudo">
    </div>
    <div class="form-group">
        <textarea name="message" class="form-control" label="Votre message"></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Envoyer</button>
</form>
<h2>Vos messages :</h2>
</div>  

<?php require_once "./elements/footer.php";?>