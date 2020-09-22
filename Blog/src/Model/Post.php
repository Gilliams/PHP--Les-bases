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
    private $image;
    private $oldImage;
    private $pendingUpload = false;

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }
    public function getContent(): ?string
    {
        return $this->content;
    }
    
    public function getID(): ?int
    {
        return $this->id;
    }
    public function setID(int $id): self
    {
        $this->id = $id;
        return $this;
    }
    
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }
    public function getSlug(): ?string
    {
        return $this->slug;
    }
    
    public function getFormattedContent(): ? string
    {
        return nl2br(e($this->content));
    }
        
    // Renvoie une partie du contenu de l'article ( 60 chars)
    public function getExcerpt(): ?string
    {
        if($this->content === null){
            return null;
        }
        return nl2br(htmlentities(Text::excerpt($this->content, 60)));
    }

    public function setCreatedAt(string $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

    public function getCategories(): array
    {
        return $this->categories;
    }
    public function setCategories(array $categories): self
    {
        $this->categories = $categories;
        return $this;
    }

    public function addCategory(Category $category): void
    {
        $this->categories[] = $category;
        $category->setPost($this);
    }

    public function getCategoriesIds():array
    {
        $ids = [];
        foreach($this->categories as $category){
            $ids[] = $category->getID();
        }
        return $ids;
    }


    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        if(is_array($image) && !empty($image['tmp_name'])){
            if(!empty($this->image)){
                $this->oldImage = $this->image;
            }
            $this->image = $image['tmp_name'];
            $this->pendingUpload = true;
        }
        if(is_string($image) && !empty($image)){
            $this->image = $image;
        }
        return $this;
    }

    public function getOldImage (): ?string
    {
        return $this->oldImage;
    }
    public function shouldUpload (): bool
    {
        return $this->pendingUpload;
    }

    public function getImageURL(string $format) : ?string
    {
        if(empty($this->image)){
            return null;
        }
        return "/uploads/posts/" . $this->image ."_". $format .".jpg";
    }

}