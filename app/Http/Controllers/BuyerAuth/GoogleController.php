<?php

namespace App\Http\Controllers\BuyerAuth;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirectUrl(config('services.google.redirect'))->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $findUser = Buyer::where('google_id', $user->id)->first();

            if($findUser){

                Auth::guard('buyers_web')->login($findUser);

                return redirect()->route('buyer.pages.home');

            }else{
                $newUser = Buyer::create([
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::guard('buyers_web')->login($newUser);

                return redirect()->route('buyer.pages.accountSettings')->withSuccess('You are registered successfully, please update more details for easy communication.');
            }

        } catch (Exception $e) {
            return redirect()->back()->with(['message' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }
}
