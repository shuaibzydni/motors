<?php

namespace App\Http\Controllers\SellerAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellerRegisterRequest;
use App\Http\Requests\Sellers\ChangePasswordRequest;
use App\Models\Location;
use App\Models\Seller;
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
        return Auth::guard('sellers_web');
    }

    public function showLoginForm()
    {
        if ($this->guard()->check()) {
            return redirect()->route('seller.pages.home');
        }
        return view('sellers.auth.login');
    }

    public function showRegisterForm()
    {
        $states = Location::all();
        return view('sellers.auth.register', compact('states'));
    }

    public function register(SellerRegisterRequest $request)
    {
        $data = $request->all();
        Seller::create($data);

        return redirect()->route('seller.login')->withSuccess('You have registered successfully. Please login to enter dashboard');
    }

    public function dashboard()
    {
        return view('seller.pages.home');
    }


    public function signOut(Request $request) {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('seller.login');
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
            "business_name" => "required|string|min:4|max:50",
            "business_phone" => "required|string|min:4|max:50",
            "business_email" => "required|email|unique:sellers,business_email," . $user->id,
            "abn" => "nullable|alpha_num|min:4|max:50",
            "business_registration_document" =>
                "nullable|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/octet-stream,application/pdf|max:5120",
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
                Storage::disk("sellersPublic")->delete($user->avatar_path);
            }

            $resizeAvatar = ImageService::developImage($avatar);

            $avatarPath = "avatar/" . $avatar->hashName();

            Storage::disk("sellersPublic")->put($avatarPath, $resizeAvatar);

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
