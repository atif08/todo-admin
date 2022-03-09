<?php

namespace App\Http\Controllers;


use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use ApiResponseTrait;
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        //dd($request->email);
        $user = User::where('email', $request->email)->whereIn('type', [1, 2])->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials)) {
            Auth::login($user);
            $data['token'] = $user->createToken(($request->device_name) ? $request->device_name : 'todotask')->plainTextToken;
            $data['type']=$user->type;
            $data['code']=200;
        }
        return response()->json($data);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $this->guard()->logout();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

}
