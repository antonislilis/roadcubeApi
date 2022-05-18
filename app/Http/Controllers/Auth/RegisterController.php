<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User as User;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function register(RegisterUserRequest $request) {
        $content = $request->json()->all();

        $user = User::create([
            'name' => $content['name'],
            'email' => $content['email'],
            'password' => \Hash::make($content['password']),
            'role_id' => 3
        ]);

        if(!$user) {
            return response('User cannot be saved', Response::HTTP_BAD_REQUEST );
        }
        return response($user, Response::HTTP_OK);
    }
}
