<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

  protected $fillable = ['name', 'email', 'password'];

  /**
   * Login user and return the user if successful.
   *
   * @param LoginRequest $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
      try{
        $secret = env('APP_KEY');
        //$token = JWTAuth::createToken(Auth::user(),['secret'=> 'OFY7Nbh1GZ7B0h4jEAFPZezM24Z4g9Bjw8HF4MKcU5rBtkyTbHdd7uRhXmO8Gtna']);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token', ['*']);
        $token = $tokenResult->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
      //return $credentials;
      }catch(\Exception $ex){
        return response([
          'message' => $ex->getMessage(),
        ],Response::HTTP_BAD_REQUEST);
      }
    }
    return response([
      'message' => "This User doesn't exist."
    ], Response::HTTP_UNAUTHORIZED);
  }

  /**
   * Register a new user and return the user if successful.
   *
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function register(Request $request)
  {
    try {
      $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6',
      ];
      $this->validate($request, $rules);
      $data = $request->all();
      $data['name'] = $request->name;
      $data['email'] = $request->email;
      $data['password'] = Hash::make($request->password);
      $user = User::create($data);

      return [
        "user" => $user,
        "status" => true,
      ];
    } catch (\Exception $e) {
      // Log or handle the exception
      return response()->json([
        'error' => 'User creation failed.',
        'message' => $e->getMessage()
      ], 500);
    }
  }
}
