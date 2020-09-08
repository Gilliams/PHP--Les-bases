<?php

require_once 'data/config.php';

function nav_item(string $lien, string $titre, string $linkClass = ''): string
{
    $classe = 'nav-item';
    if ($_SERVER['SCRIPT_NAME'] === $lien) {
        $classe .= ' active';
    }
    return <<<HTML
    <li class="$classe">
        <a class="$linkClass" href="$lien">$titre</a>
    </li>
    HTML;
}

function nav_menu(string $linkClass = ''): string
{
    return
        nav_item('/index.php', 'Accueil', $linkClass) .
        nav_item('/contact.php', 'Contact', $linkClass) .
        nav_item('/jeu.php', 'Jeu', $linkClass) .
        nav_item('/menu.php', 'Menu', $linkClass) .
        nav_item('/newsletter.php', 'Newsletter', $linkClass) .
        nav_item('/nsfw.php', 'NSFW', $linkClass).
        nav_item('/livreDor.php', 'Livre d\'or', $linkClass);
}


function dump($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
}

function creneaux_html(array $creneaux)
{
    if (empty($creneaux)) {
        return 'Fermé';
    }
    $phrases = [];
    foreach ($creneaux as $creneau) {
        $phrases[] = "de <strong>{$creneau[0]}h</strong> - <strong>{$creneau[1]}h</strong>";
    }
    return 'Ouvert ' . implode(' et ', $phrases);
}

function in_creneaux(int $heure, array $creneaux): bool
{
    foreach ($creneaux as $creneau) {
        $debut = $creneau[0];
        $fin = $creneau[1];
        if ($heure >= $debut && $heure <= $fin) {
            return true;
        }
    }
    return false;
}
