<?php

namespace App\Traits;

use App\Notifications\VerifyYourAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

trait VerifiesUsers
{

    public function verifyAccount(Request $request, $token)
    {
        if ( ! $this->validateRequest($request)) {
            return redirect($this->redirectIfVerificationFails());
        }
        try {
            $user = $this->verify($request->email, $token);
        } catch (\Exception $exception) {
            return redirect($this->redirectIfVerificationFails());
        }
        auth()->loginUsingId($user->id);

        return redirect($this->redirectAfterVerification());
    }

    protected function verify($email, $token)
    {
        $user = $this->findUserByEmail($email);
        $this->verifyToken($user->verification_token, $token);
        $this->updateUser($user);

        return $user;
    }

    protected function findUserByEmail($email)
    {
        $user = DB::table('users')
                  ->where('email', $email)
                  ->first();
        if ( ! $user) {
            throw new \Exception('User not found');
        }

        return $user;
    }

    protected function verifyToken($userToken, $requestToken)
    {
        if ($requestToken != $userToken) {
            throw new \Exception('Tokens do not match');
        }
    }

    protected function updateUser($user)
    {
        DB::table('users')->where('email', $user->email)->update(['verified' => true, 'verification_token' => null]);
    }

    protected function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        return $validator->passes();
    }

    public function resendVerificationEmail()
    {
        $user = auth()->user();
        $user->generateVerificationToken();
        $user->notify((new VerifyYourAccount())->onQueue('email'));
        confirm('Verification email has been successfully sent.');

        return redirect()->back();
    }

    public function redirectIfVerificationFails()
    {
        return '/email-verification/error';
    }

    public function redirectAfterVerification()
    {
        confirm('Your account has successfully been verified.');
        return '/';
    }

    public function getVerificationError()
    {
        return view('errors.verification');
    }

    public function getVerificationAccountPage()
    {
        return view('auth.verify_account');
    }
}