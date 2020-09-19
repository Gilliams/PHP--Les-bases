<form action="" method="Post">
    <?= $form->input('name', "Titre") ?>
    <?= $form->input('slug', "URL") ?>
    
    <button class="btn btn-primary">
        <?php if($item->getID() !== null): ?>
            Modififer
        <?php else: ?>
            Créer
        <?php endif ?>
    </button>
</form>