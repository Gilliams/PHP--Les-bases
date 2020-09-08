<?php
require "elements/header.php";
require_once "functions.php";

$title = "Newsletter";

$error = null;
$success = null;
$email = null;

if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $file = __DIR__ . DIRECTORY_SEPARATOR . 'emails' . DIRECTORY_SEPARATOR . date('Y-m-d') . '.txt';
        file_put_contents($file, $email . PHP_EOL, FILE_APPEND);
        $success = "Votre email a bien été enregistré";
        $email = null;
    } else {
        $error = "Email invalide";
    }
}


?>
<h1>S'inscrire à la newsletter</h1>
<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum consequuntur voluptate reiciendis sapiente dolore magni quibusdam, porro dolorum alias corporis inventore molestias tempora soluta, hic expedita beatae adipisci atque modi!</p>

<?php if ($error) : ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
<?php endif; ?>
<?php if ($success) : ?>
    <div class="alert alert-success">
        <?= $success ?>
    </div>
<?php endif; ?>

<form action="newsletter.php" method="POST" class="form-inline">
    <div class="form-group">
        <label for="email">
            <input class="form-control" name="email" type="email" placeholder="Entrer votre email" required value="<?= htmlentities($email); ?>">
        </label>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">S'inscrire</button>
    </div>
</form>

<?php require "elements/footer.php"; ?>