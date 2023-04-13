<?php

namespace App\Http\Controllers\BuyerAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuyerRegisterRequest;
use App\Http\Requests\Buyers\ChangePasswordRequest;
use App\Models\Buyer;
use App\Models\Location;
use App\Providers\RouteServiceProvider;
use Facades\App\Services\ImageService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('buyers_web');
    }

    public function showLoginForm()
    {
        if ($this->guard()->check()) {
            return redirect()->route('buyer.pages.home');
        }
        return view('buyers.auth.login');
    }

    public function showRegisterForm()
    {
        if ($this->guard()->check()) {
            return redirect()->route('buyer.pages.home');
        }
        $states = Location::all();
        return view('buyers.auth.register', compact('states'));
    }

    public function register(BuyerRegisterRequest $request)
    {
        $data = $request->all();
        Buyer::create($data);

        return redirect()->route('buyer.login')->withSuccess('You have registered successfully. Please login to enter dashboard');
    }

    public function signOut(Request $request) {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('buyer.login');
    }


    public function changePassword(ChangePasswordRequest $request) {
        $user = $this->guard()->user();
        $user->update([
            'password' => $request->password
        ]);

        return redirect()->back()->withSuccess('Password has been changed successfully');
    }

    public function updateAccountDetail(Request $request)
    {
        $user = $this->guard()->user();
        $request->validate([
            "first_name" => "required|string|min:4|max:50",
            "business_phone" => "required|string|min:4|max:50",
            "email" => "required|email|unique:sellers,email," . $user->id,
            "address_line" => "required|string|max:200",
            "location_id" => "required|exists:locations,id",
            "postal_code" => "required|string|min:5|max:10",
        ]);

        $data = $request->all();

        $user->update($data);

        return redirect()->back()->withSuccess('Profile setting updated successfully');
    }

    public function changeAvatar(Request $request)
    {
        $request->validate([
            "avatar" => "required|image|mimes:jpeg,png,jpg|max:6000",
        ]);

        DB::beginTransaction();
        try {
            $user = $this->guard()->user();
            $avatar = $request->file("avatar");

            if ($user->avatar_path) {
                Storage::disk("buyersPublic")->delete($user->avatar_path);
            }

            $resizeAvatar = ImageService::developImage($avatar);

            $avatarPath = "avatar/" . $avatar->hashName();

            Storage::disk("buyersPublic")->put($avatarPath, $resizeAvatar);

            $user->update([
                "avatar_path" => $avatarPath,
            ]);

            DB::commit();

            return redirect()->back()->withSuccess('Avatar updated successfully');
        } catch (\Exception $exception) {
            DB::rollBack();

            return redirect()->back()->withErrors('Something went wrong');
        }
    }
}
