<?php

namespace App\Model;

use \DateTime;
use App\Helpers\Text;

class Post{

    private $id;

    private $name;

    private $slug;

    private $content;

    private $created_at;

    private $categories = [];

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getID(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
    
    public function getFormattedContent(): ? string
    {
        return nl2br(e($this->content));
    }
        
    /**
     * Renvoie une partie du contenu de l'article ( 60 chars)
     *
     * @return string
     */
    public function getExcerpt(): ?string
    {
        if($this->content === null){
            return null;
        }
        return nl2br(htmlentities(Text::excerpt($this->content, 60)));
    }

    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

    /**
     * @return Category[]
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    public function addCategory(Category $category): void
    {
        $this->categories[] = $category;
        $category->setPost($this);
    }


}