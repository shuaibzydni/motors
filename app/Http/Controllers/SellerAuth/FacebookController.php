<?php

namespace App\Http\Controllers\SellerAuth;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirectUrl(config('services.facebook.redirect_seller'))->redirect();
    }

    public function loginWithFacebook()
    {
        try {

            $user = Socialite::driver('facebook')->user();
            $isUser = Seller::where('fb_id', $user->id)->first();

            if($isUser){
                Auth::login($isUser);
                return redirect()->route('seller.pages.home');
            }else{
                $createUser = Seller::create([
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'password' => encrypt('dummy@123')
                ]);

                Auth::login($createUser);
                return redirect()->route('seller.pages.home');
            }

        } catch (Exception $exception) {
            return redirect()->back()->with(['message' => 'Something went wrong: ' . $exception->getMessage()]);
        }
    }
}
