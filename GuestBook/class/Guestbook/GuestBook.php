<?php
namespace App\GuestBook;
use App\GuestBook\Message;

require_once 'Message.php';
class GuestBook{

    private $file;

    public function __construct($file)
    {   
        // Récupére la route du fichier
        $directory = dirname($file);
        
        // Si ce n'est pas un dossier
        if(!is_dir($directory)){
            // Créer un dossier à cette route avec les permissions qui vont bien
            mkdir($directory, 0777, true);
        }
        // Si le fichier n'existe pas
        if(!file_exists($file)){
            // Créer le fichier
            touch($file);
        }

        $this->file = $file;
    }

    public function addMessage(Message $message): void
    {
        // PHP_EOL = PHP End Of Line = Permet de garder les sauts de lignes.
        // FILE_APPEND = Permet de ne pas écraser du text
        file_put_contents($this->file, $message->toJson() . PHP_EOL, FILE_APPEND);
    }

    public function getMessage(): array
    {
        $content = trim(file_get_contents($this->file));
        $lines = explode(PHP_EOL, $content);
        $messages = [];
        foreach($lines as $line){
            $messages[] = Message::fromJSON($line);
        }
        return array_reverse($messages);
    }

}