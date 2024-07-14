<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\User\resources\UserResource;
use Modules\User\Repositories\UserRepository;

class LoginController extends Controller
{
     /**
     * Authenticate a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

     private $userRepository;
     public function __construct(UserRepository $userRepository) {
         $this->userRepository = $userRepository;
     }

     public function login(Request $request)
     {
         try {
             $credentials = $request->validate([
                 'email' => 'required|string|email',
                 'password' => 'required|string',

             ]);
             $remember = $request->has('remember');

             if (Auth::attempt($credentials, $remember)) {
                 $user = Auth::user();
                 $userData = $this->userRepository->getUserData($user->id);
                 $token = $user->createToken('auth_token')->plainTextToken;
                 $userData['token'] = $token;

                 return response()->json(new UserResource((object) $userData), 200);
             }

             return response()->json(['message' => 'Invalid credentials'], 401);
         } catch (ValidationException $e) {
             return response()->json(['errors' => $e->validator->getMessageBag()->toArray()], 422);
         } catch (\Exception $e) {
             return response()->json(['message' => 'Failed to authenticate user: ' . $e->getMessage()], 500);
         }
     }
}
