<form action="" method="Post" enctype="multipart/form-data">
    <?= $form->input('name', "Titre") ?>
    <?= $form->input('slug', "URL") ?>
   
    <div class="row">
        <div class="col-md-8">
            <?= $form->file('image', "Image à la une") ?>
        </div>
        <div class="col-md-4">
            <?php if($post->getImage()): ?>
                <img src="<?= $post->getImageURL('small') ?>" alt="" style="width:250px;">
            <?php endif ?>
        </div>
    </div>

    <?= $form->textarea('content', "Contenu") ?>
    <?= $form->select('categories_ids', "Catégories", $categories) ?>
    <?= $form->input('created_at', "Date de création") ?>
    
    <button class="btn btn-primary">
        <?php if($post->getID() !== null): ?>
            Modififer
        <?php else: ?>
            Créer
        <?php endif ?>
    </button>
</form>