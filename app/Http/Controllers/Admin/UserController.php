<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::desc()->paginate(
            config("motorTraders.paginate.perPage")
        );

        return view("users.index", compact("users"));
    }

    public function create()
    {
        return view("users.create");
    }

    public function store(UserRequest $request)
    {
        User::create($request->validated());

        return redirect()
            ->route("users.index")
            ->with("success", "Admin created successfully.");
    }

    public function edit(User $user)
    {
        return view("users.edit", compact("user"));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()
            ->route("users.index")
            ->with("success", "Admin updated successfully");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()
            ->route("users.index")
            ->with("success", "Admin deleted successfully");
    }

    public function showChangePasswordForm()
    {
        $user = Auth::getUser();
        return view("users.change_password", compact("user"));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::getUser();
        $user->update([
            "password" => $request->password,
        ]);

        return redirect()
            ->route("changePasswordForm")
            ->with(["success" => "Password changed successfully!"]);
    }
}
