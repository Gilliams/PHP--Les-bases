 <?php
    require_once 'functions/auth.php';
    forcer_utilisateur_connecte();
    require_once 'functions/compteur.php';

    $total = nombre_vues();
    $annee = (int)date('Y');
    $anne_selection = empty($_GET['annee']) ? null : (int)$_GET['annee'];
    $mois_selection = empty($_GET['mois']) ? null : (int)$_GET['mois'];

    if ($anne_selection && $mois_selection) {
        $total = nombre_vue_mois($anne_selection, $mois_selection);
        $detail = nombre_vue_detail_mois($anne_selection, $mois_selection);
    } else {
        $total = nombre_vues();
    }


    $mois = [
        '1' => 'Janvier',
        '2' => 'Fevrier',
        '3' => 'Mars',
        '4' => 'Avril',
        '5' => 'Mai',
        '6' => 'Juin',
        '7' => 'Juillet',
        '8' => 'Aout',
        '9' => 'Septembre',
        '10' => 'Octobre',
        '11' => 'Novembre',
        '12' => 'Decembre'
    ];
    require_once "elements/header.php"
    ?>

 <div class="row">
     <div class="col-md-4">
         <div class="list-group">
             <?php for ($i = 0; $i < 5; $i++) : ?>
                 <a class="list-group-item <?= $annee - $i === $anne_selection ? 'active' : ''; ?>" href="dashboard.php?annee=<?= $annee - $i ?>"><?= $annee - $i ?></a>
                 <?php if ($annee - $i === $anne_selection) : ?>
                     <?php foreach ($mois as $j => $nom) : ?>
                         <a href="dashboard.php?annee=<?= $anne_selection ?>&mois=<?= $j ?>" class="list-group-item <?= $j === $mois_selection ? 'active' : ''; ?>">
                             <?= $nom ?>
                         </a>
                     <?php endforeach; ?>
                 <?php endif; ?>
             <?php endfor; ?>
         </div>
     </div>
     <div class="col-md-8">
         <div class="card mb-4">
             <div class="card-body">
                 <strong style="font-size: 3em;"><?= $total ?></strong>
                 Visite<?= $total > 1 ? 's' : '' ?> Total
             </div>
         </div>
         <?php if (isset($detail)) : ?>
             <h2>Details des visites pour le mois</h2>
             <table class="table table-striped">
                 <thead>
                     <tr>
                         <th>Jour</th>
                         <th>Nombre de visite</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php foreach ($detail as $ligne) : ?>
                         <tr>
                             <td><?= $ligne['jour'] ?></td>
                             <td><?= $ligne['visites'] ?>visite<?= $ligne['visites'] > 1 ? 's' : ''; ?></td>
                         </tr>
                     <?php endforeach; ?>
                 </tbody>
             </table>
         <?php endif ?>
     </div>
 </div>




 <?php require_once "elements/footer.php" ?>