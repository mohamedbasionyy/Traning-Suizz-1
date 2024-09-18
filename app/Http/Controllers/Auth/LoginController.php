<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request){

        $user=User::whereEmail('email',$request->email)->first();

        if(!$user)
            return response('Credentials not matched',Response::HTTP_UNAUTHORIZED);

        return response(['token'=>'hello']);
    }
}
