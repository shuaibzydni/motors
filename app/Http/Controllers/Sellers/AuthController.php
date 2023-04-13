<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Sellers\LoginRequest;
use App\Http\Requests\Sellers\RegisterRequest;
use App\Http\Requests\Sellers\VerifyPasswordRequest;
use App\Http\Requests\SocialLoginRequest;
use App\Mail\ForgotPasswordOtpMail;
use App\Models\Seller;
use Facades\App\Services\SellerAuthService;
use App\Traits\HasApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    use HasApiResponse;

    public function register(RegisterRequest $request)
    {
        $seller = Seller::create($request->validated());

        return $this->apiCreated($seller);
    }

    public function login(LoginRequest $request)
    {
        $credentials = request(["email", "password"]);

        $authData = SellerAuthService::login($credentials, $request);

        return $authData
            ? $this->apiSuccess($authData)
            : $this->loginError(
                'password',
                __("Password entered is wrong.")
            );
    }

    public function socialLogin(SocialLoginRequest $request)
    {
        Seller::updateOrcreate(
            [
                'email'   => $request->email,
            ],
            [
                'first_name' => $request->first_name,
                'google_id'=> $request->google_id,
                'fb_id'=> $request->fb_id,
                'password' => encrypt('123456dummy')
            ]
        );

        $user = Seller::where('email', $request->email)->firstOrFail();

        $tokenResult = $user->createToken(config("app.name"));
        $token = $tokenResult->plainTextToken;

        return [
            "access_token" => $token,
            "token_type" => "Bearer",
            "user" => $user,
        ];
    }

    public function logout()
    {
        request()
            ->user()
            ->currentAccessToken()
            ->delete();
        return $this->apiSuccess([
            "message" => __("Logout Successful."),
        ]);
    }

    public function authUser()
    {
        return $this->apiSuccess(\request()->user());
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $request->user();
        $user->update([
            "password" => $request->password,
        ]);

        return $this->apiUpdated(true);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:sellers,email',
        ]);

        $seller = Seller::where('email', $request->email)->firstOrFail();

        $otp = rand(1000,9999);
        Log::info("otp = ".$otp);
        $seller->update(['otp' => $otp]);

        Mail::to($seller)->send(new ForgotPasswordOtpMail($otp));

//        return $this->apiCreated('An email with otp has been sent to your email.');
        return $this->apiUpdated(true);
    }

    public function verifyPassword(VerifyPasswordRequest $request)
    {
        $seller = Seller::where('email', $request->email)->firstOrFail();
        $seller->update([
            'otp' => null,
            'password' => $request->password,
        ]);

//        return $this->apiUpdated('Your password has been changed successfully');
        return $this->apiUpdated(true);
    }
}
