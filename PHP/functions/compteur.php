<?php

function ajouter_vue()
{
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur';
    $fichierJournalier = $fichier . '-' . date('Y-m-d');
    incrementer_compteur($fichier);
    incrementer_compteur($fichierJournalier);
}

function incrementer_compteur(string $fichier)
{
    $compteur = 1;
    if (file_exists($fichier)) {
        $compteur = (int)file_get_contents($fichier);
        $compteur++;
    }
    file_put_contents($fichier, $compteur);
}

function nombre_vues(): string
{
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur';
    return file_get_contents($fichier);
}

function nombre_vue_mois(int $year, int $mois): int
{
    $mois = str_pad($mois, 2, '0', STR_PAD_LEFT);
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur-' . $year . '-' . $mois . '-' . '*';
    $fichiers = glob($fichier);
    $total = 0;
    foreach ($fichiers as $fichier) {
        $total += (int)file_get_contents($fichier);
    }
    return $total;
}

function nombre_vue_detail_mois(int $year, int $mois): array
{
    $mois = str_pad($mois, 2, '0', STR_PAD_LEFT);
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur-' . $year . '-' . $mois . '-' . '*';
    $fichiers = glob($fichier);
    $visites = [];
    foreach ($fichiers as $fichier) {
        $parties = explode('-', basename($fichier));
        $visites[] = [
            'annee' => $parties[1],
            'mois' => $parties[2],
            'jour' => $parties[3],
            'visites' => file_get_contents($fichier),
        ];
    }
    return $visites;
}
