<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteSettingsRequest;
use App\Models\SiteSetting;
use App\Services\BuyerService;
use App\Services\SellerService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use DB;
use Log;

class SiteSettingsController extends Controller
{
    protected $type;

    public function __construct()
    {
        $this->type = Route::current()->parameter('model');
    }

    public function index()
    {
        $model = $this->type;

        $siteSettings = SiteSetting::where('type', $model)->get();

        $siteSettings = $siteSettings->mapWithKeys(function ($item) {
            return [$item->slug => $item->data];
        });

        return view("site_settings.index", compact("model", "siteSettings"));
    }

    public function update(SiteSettingsRequest $request)
    {
        DB::beginTransaction();
        try
        {
            foreach ($request->validated() as $slug => $data) {
                $ss = SiteSetting::where('slug', $slug)
                    ->where('type', $this->type)
                    ->update([
                    'data' => $data
                    ]);

            }

            Cache::forget('buyerSettings');
            Cache::forget('sellerSettings');
            $buyerService = new BuyerService();
            $sellerService = new SellerService();
            $buyerService->cacheBuyerSettings();
            $sellerService->cacheSellerSettings();

            DB::commit();
            return redirect()
                ->route("siteSettings.index", ['model' => $this->type])
                ->with("success", "Settings updated successfully");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->route("siteSettings.index", ['model' => $this->type])
                ->with("danger", $e->getMessage());
        }
    }
}
