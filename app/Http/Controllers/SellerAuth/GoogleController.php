<?php

namespace App\Http\Controllers\SellerAuth;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirectUrl(config('services.google.redirect_seller'))->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            
            $findUser = Seller::where('google_id', $user->id)->first();

            if($findUser){

                Auth::guard('sellers_web')->login($findUser);

                return redirect()->route('seller.pages.home');

            }else{
                $newUser = Seller::create([
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::guard('sellers_web')->login($newUser);

                return redirect()->route('seller.pages.accountDetail')->withSuccess('You are registered successfully, please update more details for easy communication.');
            }

        } catch (Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with(['message' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }
}
