<?php

use App\Connection;

require dirname(__DIR__) . DIRECTORY_SEPARATOR .'vendor/autoload.php';

$faker = Faker\Factory::create('fr_FR');

$pdo = Connection::getPdo();

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

$posts = [];
$categories = [];

for($i=0; $i< 50; $i++){
    $article = $faker->sentence($nbWords = 6);
    $slug = $faker->slug;
    $content = $faker->paragraphs(rand(3,15), true);
    $pdo->exec("INSERT INTO post SET name='{$article}', slug='{$slug}', created_at='{$faker->date} {$faker->time}', content='{$content}' ");
    $posts[] = $pdo->lastInsertId();
}
for($i=0; $i< 10; $i++){
    $article = $faker->sentence(rand(1,3));
    $slug = $faker->slug;
    $content = $faker->paragraphs(rand(3,15), true);
    $pdo->exec("INSERT INTO category SET name='{$article}', slug='{$slug}'");
    $categories[] = $pdo->lastInsertId();
}

foreach($posts as $post){
    $randomCategories = $faker->randomElements($categories, rand(0, count($categories)));
    foreach($randomCategories as $category){
        $pdo->exec("INSERT INTO post_category SET post_id=$post, category_id=$category");
    }
}
$password = password_hash('admin', PASSWORD_BCRYPT);
$pdo->exec("INSERT INTO user SET username='admin', password='$password'");