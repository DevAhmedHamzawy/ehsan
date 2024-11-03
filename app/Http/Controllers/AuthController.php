<?php

namespace App\Http\Controllers;

use App\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $request->validate(['first_name' => 'required|string','email' => 'required|string|email|unique:users','password' => 'required|string|confirmed']);
        $request->merge(['name' => $request->first_name, 'password' => bcrypt($request->password)]);
        $user = User::create($request->except('password_confirmation'));
        Auth::login($user);
        return response()->json(['message' => 'Successfully created user!','token' => $user->createToken('MyApp')->accessToken,'id' => auth()->user()->id,], 200);
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate(['email' => 'required|string|email','password' => 'required|string','remember_me' => 'boolean']);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json(['message' => 'Unauthorized'], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            //$token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json(['id' => auth()->user()->id,'access_token' => $tokenResult->accessToken,'token_type' => 'Bearer']);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out']);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        // Get The User Data
        $user = $request->user();

        // Add The Succeeded Competitions
        $user->succeededCompetitions = Result::whereUserId($user->id)->where('right_answers', '!=' , 0)->where('wrong_answers', '!=' , 10)->where('points' , '!=' , -1)->count();

        // Add The Failed Competitions
        $user->failedCompetitions = Result::whereUserId($user->id)->where('right_answers', '=' , 0)->where('wrong_answers', '=' , 10)->count();

        // Add The Uncompleted Competitions
        $user->uncompletedCompetitions = Result::whereUserId($user->id)->wherePoints(-1)->count();

        // Get The Whole Competitions He Participated In
        $user->Competitions = Result::whereUserId($user->id)->get();

        // Return JSON Response
        return response()->json($request->user());
    }
}