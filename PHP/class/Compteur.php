<?php 
class Compteur{

    const INCREMENT = 1;
    protected $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function incrementer(): void
    {
        
        $compteur = 1;
        if (file_exists($this->file)) {
            $compteur = (int)file_get_contents($this->file);
            $compteur += self::INCREMENT;
        }
        file_put_contents($this->file, $compteur);
    }
    
    public function recuperer(): int
    {
        if (!file_exists($this->file)) {
           return 0; 
        }

        return file_get_contents($this->file);
    }
    
    
}