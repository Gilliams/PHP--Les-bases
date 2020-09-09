<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Mon site' ?></title>
    <meta name="description" content="<?= $pageDescription ?? '' ?>">
</head>
<body>

<div class="container">
<?= $pageContent ?>

</div>
<?= $pageJavescripts ?? '' ?>
</body>
</html>