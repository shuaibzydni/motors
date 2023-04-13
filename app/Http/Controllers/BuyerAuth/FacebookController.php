<?php

namespace App\Http\Controllers\BuyerAuth;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirectUrl(config('services.facebook.redirect'))->redirect();
    }

    public function loginWithFacebook()
    {
        try {

            $user = Socialite::driver('facebook')->user();
            $isUser = Buyer::where('fb_id', $user->id)->first();

            if($isUser){
                Auth::login($isUser);
                return redirect()->route('buyer.pages.home');
            }else{
                $createUser = Buyer::create([
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'password' => encrypt('dummy@123')
                ]);

                Auth::login($createUser);
                return redirect()->route('buyer.pages.home');
            }

        } catch (Exception $exception) {
            return redirect()->back()->with(['message' => 'Something went wrong: ' . $exception->getMessage()]);
        }
    }
}
