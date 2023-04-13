<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SellerRequest;
use App\Http\Requests\Common\AvatarRequest;
use Facades\App\Services\ImageService;
use App\Traits\HasApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    use HasApiResponse;

    public function editAccountDetails(SellerRequest $request)
    {
        $user = $request->user();
        $user->update($request->validated());

        return $this->apiUpdated($user);
    }

    public function updateAvatar(AvatarRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = $request->user();
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
            return $this->apiUpdated(true);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->apiError($exception->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            "first_name" => "required|string|min:4|max:50",
            "last_name" => "nullable|string|min:4|max:50",
            "email" => "required|email|unique:buyers,email," . $request->user('buyers_web')->id,
            "business_name" => "nullable|string|min:4|max:50",
            "business_phone" => "nullable|string|min:4|max:50",
            "business_email" => "nullable|email|unique:buyers,business_email",
            "abn" => "nullable|alpha_num|min:4|max:50",
            "buyer_license_no" => "nullable|string|min:4|max:50",
            "business_registration_document" =>
                "nullable|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/octet-stream,application/pdf|max:5120",
            "address_line" => "required|string|max:200",
            "location_id" => "required|exists:locations,id",
            "postal_code" => "required|string|min:5|max:10",
        ]);

        $buyer = Buyer::findOrFail($request->user('buyers_web')->id);
        $buyer->update($request->validated());

        return $this->apiUpdated($buyer);
    }
}
