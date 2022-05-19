<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SignInController extends Controller
{
    public function __invoke(Request $request) {
        $content = $request->json()->all();
        if(!$token = auth()->attempt($content)) {
            return response(null, Response::HTTP_UNAUTHORIZED);
        }

        return response(compact('token'),200,['Token' => $token]);
    }
}
