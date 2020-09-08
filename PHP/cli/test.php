<?php
//------------------- Code concernant les fichiers

// $fichier = __DIR__ . DIRECTORY_SEPARATOR . 'demo.txt';
// file_put_contents($fichier, 'Salut les potes');
// echo file_get_contents($fichier);

//------------------- Code concernant DateTime

// $date = '2014-01-20';
// $date2 = '2019-04-01';

// $d1 = new DateTime($date);
// $d2 = new DateTime($date2);
// $diff = $d1->diff($d2, true);

// echo " Il y a {$diff->y} années, {$diff->m} mois et {$diff->d} jours et {$diff->h} heures de différence";

// $date = new DateTime('2020-09-03');
// $interval = new DateInterval('P1M5DT10M');
// $date->add($interval);
// var_dump($date);

// require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Creneau.php';

// $creneau = new Creneau(9, 12);
// $creneau2 = new Creneau(14, 17);

// var_dump($creneau->intersect($creneau2));

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Form.php';
echo Form::checkbox('demo', 'Demo', []);
echo Form::$class;
