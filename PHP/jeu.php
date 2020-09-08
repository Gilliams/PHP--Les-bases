<?php
$title = "Jeu";

$parfums = [
    'Fraise' => 4,
    'Chocolat' => 5,
    'Coco' => 3,
];
$cornets = [
    'Pot' => 2,
    'Cornet' => 3,
];
$supplements = [
    'Pépites de chocolat' => 1,
    'Chantilly' => 0.5,
    'Nappage chocolat' => 1,
];

$ingredients = [];
$total = 0;

foreach (['parfum', 'supplement', 'cornet'] as $name) {
    if (isset($_GET[$name])) {
        $liste = $name . 's';
        $choix = $_GET[$name];
        if (is_array($choix)) {
            foreach ($_GET[$name] as $value) {
                if (isset($$liste[$value])) {
                    $ingredients[] = $value;
                    $total += $$liste[$value];
                }
            }
        } else {
            if (isset($$liste[$value])) {
                $ingredients[] = $value;
                $total += $$liste[$value];
            }
        }
    }
}




?>

<?php require 'elements/header.php'; ?>

<h1>Composer votre glace</h1>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <h2 class="card-header">Votre Glace</h2>
            <div class="card-body">
                <ul>
                    <?php foreach ($ingredients as $ingredient) : ?>
                        <li class="list-unstyled"><?= $ingredient ?></li>
                    <?php endforeach; ?>
                </ul>
                <p><strong>Prix :</strong> <?= $total ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <form action="/jeu.php" method="GET">

            <h2>Choissisez votre parfum</h2>
            <?php foreach ($parfums as $parfum => $prix) : ?>
                <div class="form-group">
                    <label>
                        <?= checkbox('parfum', $parfum, $_GET) ?>
                        <?= $parfum ?> - <?= $prix ?> €
                    </label>
                </div>

            <?php endforeach; ?>
            <h2>Choissisez votre cornet</h2>
            <?php foreach ($cornets as $cornet => $prix) : ?>
                <div class="form-group">
                    <label>
                        <?= radio('cornet', $cornet, $_GET) ?>
                        <?= $cornet ?> - <?= $prix ?> €
                    </label>
                </div>
            <?php endforeach; ?>
            <h2>Choissisez vos supplements</h2>
            <?php foreach ($supplements as $supplement => $prix) : ?>
                <div class="form-group">
                    <label>
                        <?= checkbox('supplement', $supplement, $_GET) ?>
                        <?= $supplement ?> - <?= $prix ?> €
                    </label>
                </div>
            <?php endforeach; ?>
            <button class="btn btn-primary" type="submit">Composer la glace</button>
        </form>
    </div>
</div>
<?php require 'elements/footer.php'; ?>