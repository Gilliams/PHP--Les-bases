<?php 
// Demare la mise en mémoire
ob_start();
echo "Salut";
// Garde en mémoire le contenu et l'efface
$content = ob_get_clean();
var_dump($content);