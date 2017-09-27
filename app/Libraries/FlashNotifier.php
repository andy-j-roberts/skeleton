<?php

namespace App\Libraries;

use App\Models\Message;
use Illuminate\Session\Store as Session;

class FlashNotifier
{
    protected $session;
    public $messages;

    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->messages = collect();
    }

    public function message($message = null, $level = null)
    {
        if (! $message instanceof Message) {
            $message = new Message($message, $level);
        }
        $this->messages->push($message);
        return $this->flash();
    }

    public function flash()
    {
        $this->session->flash('notifications', $this->messages);
    }
}