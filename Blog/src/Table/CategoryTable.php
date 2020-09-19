<?php

namespace App\Table;

use PDO;
use Exception;
use App\Model\Category;
use App\PaginatedQuery;

final class CategoryTable extends Table{

    protected $table = "category";
    protected $class = Category::class;

    /**
     * @param App\Model\Post[] $posts
     */
    public function hydratePosts(array $posts): void
    {
        $postsByID = [];
        foreach($posts as $post){
            $postsByID[$post->getID()] = $post;
        }
        
        $categories = $this->pdo
            ->query("
                SELECT c.*, pc.post_id
                FROM post_category pc
                JOIN category c ON c.id = pc.category_id
                WHERE pc.post_id IN (" . implode(',', array_keys($postsByID)) . ")"
            )->fetchAll(PDO::FETCH_CLASS, Category::class);
        
        foreach($categories as $category){
            $postsByID[$category->getPostID()]->addCategory($category);
        }
    }

    public function findPaginated()
    {
        $paginatedQuery = new PaginatedQuery(
            "SELECT * FROM {$this->table} ORDER BY name DESC",
            "SELECT COUNT(id) FROM {$this->table}",
        );
        $categories = $paginatedQuery->getItems(Category::class);
        return [$categories, $paginatedQuery];
    }

    public function all (): array
    {
       return $this->queryAndFetchAll("SELECT * FROM {$this->table} ORDER BY id DESC");
    }

}