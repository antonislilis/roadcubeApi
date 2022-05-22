<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Repositories\UserRepository;
use DB;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function __construct(protected UserRepository $userRepository)
    { }

    public function register(RegisterUserRequest $request) {

        $content = $request->json()->all();

        DB::select( DB::raw("SELECT setval(pg_get_serial_sequence('users', 'id'), max(id)) FROM users;"));

        $user = $this->userRepository->create([
            'name' => $content['name'],
            'email' => $content['email'],
            'password' => \Hash::make($content['password']),
            'role_id' => 2
        ]);

        return $user
            ? response($user, Response::HTTP_OK)
            : response('User cannot be saved', Response::HTTP_BAD_REQUEST );
    }
}
