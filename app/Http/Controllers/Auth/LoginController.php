<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
                $name = $this->userRepository->getUserName($user->id);
                //$imagePath = storage_path('app/public/uploads/' . basename($user->img_url));
                $imageData = NULL;

                //if (file_exists($imagePath)) {
                 //   $imageData = base64_encode(file_get_contents($imagePath));
                //}

                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'token' => $token,
                    'role' => $user->role,
                    'name' => $name ? $name : 'Admin',
                    'image' => $imageData,

            ], 200);
            }


            return response()->json(['message' => 'Invalid credentials'], 401);
        } catch (ValidationException $e) {

            return response()->json(['errors' => $e->validator->getMessageBag()->toArray()], 422);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Failed to authenticate user: ' . $e->getMessage()], 500);
        }
    }
}
