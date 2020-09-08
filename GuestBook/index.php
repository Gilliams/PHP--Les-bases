<?php

require 'vendor/autoload.php';

use App\GuestBook\Message;
use App\GuestBook\GuestBook;


$errors = null;
$success = false;
$guestbook = new GuestBook(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages');
if (isset($_POST['username'], $_POST['message'])){
    $message = new Message($_POST['username'], $_POST['message']);
    if($message->isValid()){
        $guestbook->addMessage($message);
        $success = true;
        $_POST = [];
    }else{
        $errors = $message->getErrors();
    }
}
$messages = $guestbook->getMessage();
$title = "Livre d'or";
require "elements/header.php"?>

    <div class="container">
        <h1>Livre d'or</h1>

    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            Formulaire invalide
        </div>
    <?php endif; ?>
    <?php if($success): ?>
        <div class="alert alert-success">
            Votre message a bien été envoyé
        </div>
    <?php endif; ?>

        <form action="" method="post">
            <div class="form-group">
                <input 
                type="text" 
                name="username" 
                class="form-control  <?= isset($errors['username']) ? 'is-invalid' :'' ;?>" 
                placeholder="Votre pseudo" 
                value="<?= htmlentities($_POST['username'] ?? '') ?>"
                >

                <?php if(isset($errors['username'])): ?>
                    <div class="invalid-feedback"><?= $errors['username'];?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <textarea 
                name="message" 
                placeholder="Votre message" 
                class="form-control  <?= isset($errors['message']) ? 'is-invalid' :'' ;?>" 
                ><?= htmlentities($_POST['message'] ?? '') ?></textarea>
                
                <?php if(isset($errors['message'])): ?>
                    <div class="invalid-feedback"><?= $errors['message'];?></div>
                <?php endif; ?>
            </div>
            <button class="btn btn-primary">Envoyer</button>
        </form>

        <?php if(!empty($messages)): ?>
            <h1 class="mt-4">Vos messages</h1>

            <?php foreach($messages as $message): ?>
                <?= $message->toHTML() ?>
            <?php endforeach ?>

        <?php endif; ?>

    </div>

<?php require "elements/footer.php"?>