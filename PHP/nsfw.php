<?php
$age = null;

if (!empty($_POST['birthday'])) {
    setcookie('birthday', $_POST['birthday']);
    // Façon de s'assurer que le cookie reste ! 
    // Pose problème si on supprime le cookie et que l'on veut changer de valeur
    // $_COOKIE['birthday'] = $_POST['birthday'];
}
if (!empty($_COOKIE['birthday'])) {
    $birthday = (int)$_COOKIE['birthday'];
    $age = (int)date('Y') - $birthday;
}



require "elements/header.php";
require_once "functions.php";
$title = "Profil";
?>
<?php if ($age >= 18) : ?>
    <h2>Amuse toi</h2>
    <iframe src="https://giphy.com/embed/wrBURfbZmqqXu" width="480" height="319" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
<?php elseif ($age !== null && $age < 18) : ?>
    <iframe src="https://giphy.com/embed/cQtlhD48EG0SY" width="480" height="456" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
<?php else : ?>
    <form action="" method="POST" class="form-inline">
        <div class="form-group">
            <label for="birthday"> Section réservée aux adultes</label>
            <select name="birthday" class="form-control">
                <?php for ($i = 2010; $i > 1920; $i--) : ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Go</button>
        </div>
    </form>
<?php endif; ?>


<?php require "elements/footer.php"; ?>