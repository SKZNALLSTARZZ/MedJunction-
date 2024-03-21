<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;

class LoginController extends Controller
{
     /**
     * Authenticate a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);


            if (Auth::attempt($credentials)) {

                $user = Auth::user();

                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json(['token' => $token], 200);
            }


            return response()->json(['message' => 'Invalid credentials'], 401);
        } catch (ValidationException $e) {

            return response()->json(['errors' => $e->validator->getMessageBag()->toArray()], 422);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Failed to authenticate user: ' . $e->getMessage()], 500);
        }
    }
}
