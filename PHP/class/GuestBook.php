<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Message.php';

class GuestBook{
    
    public $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function addMessage(Message $message)
    {
        return file_put_contents($this->file, $message);
    }

    public function getMessages():array
    {
        $messages = [];
 
        file_get_contents($this->file);
    }

}