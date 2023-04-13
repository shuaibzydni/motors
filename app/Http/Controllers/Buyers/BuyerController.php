<?php

namespace App\Http\Controllers\Buyers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BuyerRequest;
use App\Http\Requests\Common\AvatarRequest;
use App\Models\Buyer;
use App\Traits\HasApiResponse;
use Facades\App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BuyerController extends Controller
{
    use HasApiResponse;

    public function editAccountDetails(BuyerRequest $request)
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
                Storage::disk("buyersPublic")->delete($user->avatar_path);
            }

            $resizeAvatar = ImageService::developImage($avatar);

            $avatarPath = "avatar/" . $avatar->hashName();

            Storage::disk("buyersPublic")->put($avatarPath, $resizeAvatar);

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
}
