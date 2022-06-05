<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'string|min:2|required',
            'password' => 'string',
        ]);


        if (Auth::attempt(['name' => $request->name, 'password' => $request->password], true)) {
            return response('Connected', 200);
        } else {
            return response('Forbidden', 403);
        }
    }

    public function logout()
    {
        return auth()->logout();
    }
}