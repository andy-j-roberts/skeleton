<?php

namespace App\Models;

class Message
{
    public $message;
    public $level;

    public function __construct($message, $level)
    {
        $this->message = $message;
        $this->level = $level;
    }
}