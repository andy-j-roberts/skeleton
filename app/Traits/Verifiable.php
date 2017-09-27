<?php

namespace App\Traits;

use App\Scopes\SuspendableScope;
use App\Scopes\VerifiableScope;
use Carbon\Carbon;
use Illuminate\Support\Str;

trait Verifiable
{

    public function isVerified()
    {
        return $this->verified;
    }

    public function isNotVerified()
    {
        return !$this->isVerified();
    }

    public function markAsVerified()
    {
        $this->update(['verified' => true]);

        return $this;
    }

    public function generateVerificationToken()
    {
        $this->update(['verified' => false, 'verification_token' => $this->generateToken()]);
    }

    protected function generateToken()
    {
        return hash_hmac('sha256', Str::random(40), config('app.key'));
    }

}