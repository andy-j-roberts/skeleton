<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Libraries\Masquerade;

class MasqueradeAsUserController extends Controller
{
    public function __construct(Masquerade $masquerade)
    {
        $this->masquerade = $masquerade;
    }

    public function update()
    {
        $this->masquerade->loginAsUser(request('user_id'), auth()->id());

        return redirect('/');
    }

    public function destroy()
    {
        $this->masquerade->return();

        return redirect('/');
    }

}