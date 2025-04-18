<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Firebase\JWT\JWT;
use Firebase\JWT\JWK;

class SocialAuthController extends Controller
{
    //login with gmail
    public function loginWithGmailToken(Request $request){

        //get access token
        $accessToken = $request->input('access_token');

        if(!$accessToken){
            return response()->json(['error'=>'Access token is required']);
        }

        //connect with Gmail Api
        $googleResponse = Http::withHeaders(
            ['Authorization'=>'Bearer '.$accessToken,])
            ->get('https://www.googleapis.com/oauth2/v3/userinfo');

            if(!$googleResponse->ok()){
                return response()->json([
                    'error'=>'invalid Google token',
                    'details'=>$googleResponse->json(),
                ],401);
            }

            //if every thing is fine
            $googleUser = $googleResponse->json();

            //update or create user data

            $user = User::updateOrCreate(
                ['email'=>$googleUser['email']],
                [
                    'name'=>$googleUser['name'],
                    'google_id'=>$googleUser['sub'],
                    'password'=>bcrypt(Str::random(16)),
                ]
            );

            //login the user to create session
            Auth::login($user);

            //generate token
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'message' => '  successfully login with Google ✅',
                'user' => $user,
                'token' => $token,
            ]);

    }




    //login with facebook
    public function loginWithFacebookToken(Request $request)
    {
        //get access token
        $accessToken = $request->input('access_token');

        if (!$accessToken) {
            return response()->json(['error' => 'Access token is required'], 422);
        }

        try {
            // 1. connect with Facebook Graph API
            $fbResponse = Http::get('https://graph.facebook.com/me', [
                'fields' => 'id,name,email',
                'access_token' => $accessToken,
            ]);

            if (!$fbResponse->ok()) {
                return response()->json([
                    'error' => 'Invalid Facebook token',
                    'facebook_response' => $fbResponse->json(),
                ], 401);
            }

            $fbUser = $fbResponse->json();

                //update or create user data
            $user = User::updateOrCreate(
                ['email' => $fbUser['email'] ?? $fbUser['id'].'@facebook.com'], // fallback if email hidden
                [
                    'name' => $fbUser['name'],
                    'facebook_id' => $fbUser['id'],
                    'password' => bcrypt(Str::random(16)),
                ]
            );

            //user logon and generate token
            Auth::login($user);
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'message' => 'login successfully',
                'user' => $user,
                'token' => $token,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Login failed',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    //login with Apple
    public function loginWithAppleToken(Request $request)
{
    $idToken = $request->input('id_token');

    if (!$idToken) {
        return response()->json(['error' => 'id_token is required'], 422);
    }

    try {

        $appleKeys = Http::get('https://appleid.apple.com/auth/keys')->json();


        $appleUser = (array) JWT::decode($idToken, new \Firebase\JWT\Key('', 'RS256'));
        // $decoded = JWT::decode($idToken, JWK::parseKeySet($appleKeys), ['RS256']);
        // $appleUser = (array) $decoded;


        $appleEmail = $appleUser['email'] ?? ($appleUser['sub'] . '@apple.com');
        $appleId = $appleUser['sub'];


        $user = User::updateOrCreate(
            ['email' => $appleEmail],
            [
                'apple_id' => $appleId,
                'name' => 'Apple User',
                'password' => bcrypt(Str::random(16)),
            ]
        );

        Auth::login($user);
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'successfully login with Apple 🍎',
            'user' => $user,
            'token' => $token,
        ]);

    } catch (Exception $e) {
        return response()->json(['error' => 'Invalid Apple token', 'details' => $e->getMessage()], 401);
    }
}
}
