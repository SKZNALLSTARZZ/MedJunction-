<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);


            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);


            return response()->json(['user' => $user, 'message' => 'User registered successfully'], 201);
        } catch (ValidationException $e) {

            return response()->json(['errors' => $e->validator->getMessageBag()->toArray()], 422);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Failed to register user: ' . $e->getMessage()], 500);
        }
    }
}
