<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
            // Validate the incoming request data
            $credentials = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            // Attempt to authenticate the user
            if (Auth::attempt($credentials)) {
                // Authentication successful, get the authenticated user
                $user = Auth::user();

                // Generate and return a token for the authenticated session
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json(['token' => $token], 200);
            }

            // Authentication failed, return an error response
            return response()->json(['message' => 'Invalid credentials'], 401);
        } catch (ValidationException $e) {
            // Validation error occurred, return error response with validation messages
            return response()->json(['errors' => $e->validator->getMessageBag()->toArray()], 422);
        } catch (\Exception $e) {
            // Other error occurred, return error response with error message
            return response()->json(['message' => 'Failed to authenticate user: ' . $e->getMessage()], 500);
        }
    }
}
