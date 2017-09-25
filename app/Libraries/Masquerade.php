<?php

namespace App\Libraries;

use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Application;
use Illuminate\Session\SessionManager;

class Masquerade
{
    protected $app;
    protected $auth;
    protected $session;
    protected $sessionKey = 'masquerade.original_id';
    protected $usersCached = null;

    public function __construct(Application $app, AuthManager $auth, SessionManager $session)
    {
        $this->app = $app;
        $this->auth = $auth;
        $this->session = $session;
    }

    public function loginAsUser($userId, $currentUserId)
    {
        $this->session->put('masquerade.is_masquerading', true);
        $this->session->put($this->sessionKey, $currentUserId);

        $this->auth->loginUsingId($userId);
    }

    public function return()
    {
        if (!$this->isMasquerading()) {
            return false;
        }

        $this->auth->logout();

        $originalUserId = $this->session->get($this->sessionKey);

        if ($originalUserId) {
            $this->auth->loginUsingId($originalUserId);
        }

        $this->session->forget($this->sessionKey);
        $this->session->forget('masquerade.is_masquerading');

        return true;
    }

    public function getOriginalUser()
    {
        if (!$this->isMasquerading()) {
            return $this->auth->user();
        }

        $userId = $this->session->get($this->sessionKey);

        return User::where('id', $userId)->first();
    }

    public function isMasquerading()
    {
        return $this->session->has('masquerade.is_masquerading');
    }
}