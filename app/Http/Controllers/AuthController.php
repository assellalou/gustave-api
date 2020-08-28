<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|between:4,100',
                'email' => 'required|email|unique:users|max:50',
                'phone' => 'sometimes|digits:10',
                'username' => 'required|string|unique:users|between:4,50',
                'password' => 'required|confirmed|string|min:6',
                'adresse' => 'sometimes|string|max:100',
                'city' => 'sometimes|string|max:25',
                'classe' => 'sometimes|integer|exists:classes,id'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = User::create(array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)]
            ));

            return response()->json([
                'message' => 'Successfully registered',
                'user' => $user
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            if (isset($request['username']) && $request['username'] != null)
                $credentials = $request->only('username', 'password');
            else
                $credentials = $request->only('email', 'password');

            if ($token = $this->guard()->attempt($credentials)) {
                return $this->respondWithToken($token);
            }

            return response()->json(['error' => 'Unauthorized'], 401);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        try {
            return response()->json($this->guard()->user());
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            $this->guard()->logout();

            return response()->json(['message' => 'Successfully logged out']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            return $this->respondWithToken($this->guard()->refresh());
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }

    /**
     * Edit User Profile
     *
     * @param Illuminate\Http\Request $request
     *
     * @return illuminate\Http\JsonResponse
     */
    public function editProfile(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|between:4,100',
                'email' => 'sometimes|email|unique:users|max:50',
                'phone' => 'sometimes|digits:10',
                'adresse' => 'sometimes|string|max:100',
                'city' => 'sometimes|string|max:25',
                'classe' => 'sometimes|integer|exists:classes,id'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $id = User::where('id', $this->guard()->user()->id)->update($validator->validated());
            $user = User::where('id', $id)->get();
            return response()->json([
                'message' => 'Successfully updated',
                'user' => $user
            ], 201);
            return response()->json($this->guard()->user());
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'error' => 'Something went wrong!',
            ], 500);
        }
    }

    /**
     * Reset User's password
     *
     * @param illuminate\Http\Request $request
     *
     * @return illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|string|min:6'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            User::where('id', $this->guard()->user()->id)->update(
                ['password' => bcrypt($request->password)]
            );

            return $this->respondWithToken($this->guard()->refresh());
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'error' => 'Something went wrong!',
            ], 500);
        }
    }
}
