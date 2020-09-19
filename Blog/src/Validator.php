<?php

namespace App;

use Valitron\Validator as ValidatorValitron;

class Validator extends ValidatorValitron{
    
    protected static $_lang = "fr";

    protected function checkAndSetLabel($field, $message, $params)
    {
        return str_replace('{field}', '', $message);
    }
}