<?php
// Premiere façon de faire

// $key = 'age';

// $sort = function ($eleve1, $eleve2) use ($key){
//     if($eleve1[$key] == $eleve2[$key]){
//         return 0;
//     }
//     return ($eleve1[$key] > $eleve2[$key]) ? -1 : 1;
// };

// Deuxieme façon de faire
// function sorterByKey($key)
// {
//     return function ($eleve1, $eleve2) use ($key){
//         return $eleve2[$key] -  $eleve1[$key];
//     };
// }

// Troisieme façon de faire 
// function sortByKey(array $array, string $key)
// {
//     usort($array,function ($a, $b) use ($key){
//         return $a[$key] -  $b[$key];
//     });
//     return $array;
// }

// $eleveMoyenne = array_filter($eleves, function($eleve){
//     return $eleve['age'] < 10;
// });

// var_dump($eleveMoyenne);

class FonctionsAnonymes{
    public $eleves = [
        [
            'nom' => "Lucas",
            "age" => 12,
            "moyenne" => 11,
        ],
        [
            'nom' => "Zoe",
            "age" => 12,
            "moyenne" => 18
        ],
        [
            'nom' => "Emma",
            "age" => 10,
            "moyenne" => 15
        ],
        [
            'nom' => "Athenaïs",
            "age" => 0.2,
            "moyenne" => 1
        ]
   ];

   private function filterFonction($eleve)
   {
    return $eleve['moyenne'] > 10;
   }

   public function bonEleves()
   {
       return array_filter($this->eleves, [$this, 'filterFonction']);
   }
}

$fna = new FonctionsAnonymes();
var_dump($fna);


