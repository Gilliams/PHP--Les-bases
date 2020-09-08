<?php

class Message{

    public $username;
    public $message;
    public $date;
    public $errors;


    public function __construct(string $username, string $message, DateTime $date=null)
    {
        $this->username = $username;
        $this->message = $message;
        $this->date = date('Y-m-d');
    }

    public function isValid(): bool
    {
        if((int)$this->username > 3 && (int)$this->message > 10){
            return true;
        }
        return false;
    }

    public function getErrors(): array
    {
        if(empty($this->username) && empty($this->message)){
            $this->errors[] = "Veuillez remplir votre nom d'utilisateur ou votre message";
        }
        if($_POST['pseudo'] < 3){
            $this->errors[] = "Votre pseudo doit contenir plus que 3 caractéres";
        }
        if($_POST['message'] < 10){
            $this->errors[] = "Votre message doit contenir plus que 10 caractéres";
        }
        return $this->errors;
    }

    public function toHTML(): string
    {
        return <<<HTML
            <p>
                <strong>{$this->username}</strong> 
                <em>le {$this->date}</em> <br>
                {$this->message}
            </p>
        HTML;
    }

    public function toJSON(): string
    {
        $data = [
            'username' => $this->username,
            'message' => $this->message,
            'date' => $this->date
        ];
        return json_encode($data);
    }

    public static function fromJSON($string): string
    {
        return json_decode($string, true);

    }

}