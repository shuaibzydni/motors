<?php

namespace App\Http\Controllers;

use App\Models\Bidding;
use App\Models\Buyer;
use App\Models\Product;
use App\Models\Seller;
use App\Rules\CheckSubscriptionExpiryRule;
use App\Traits\HasApiResponse;

class ApiBiddingController extends Controller
{
    use HasApiResponse;

    public function requestBid($productId)
    {
        $product = Product::findOrFail($productId);

        $buyer = request()->user();

        $bidding = Bidding::where('product_id', $product->id)->where('buyer_id', $buyer->id)->desc()->first();

        if (!empty($bidding) && $bidding->count() > 0) {
            request()->validate([
                'bid_price' => [new CheckSubscriptionExpiryRule('buyers'), 'required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'gt:' . $bidding->bid_price]
            ]);
        }
        else {
            request()->validate([
                'bid_price' => [new CheckSubscriptionExpiryRule('buyers'), 'required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'gt:' . $product->vehicle_price]
            ]);
        }

        $seller = Seller::findOrFail($product->seller_id);

        Bidding::create([
            'product_id'    => $product->id,
            'buyer_id'      => $buyer->id,
            'seller_id'     => $product->seller_id,
            'bidding_type'  => Bidding::BID_STATUS['REQUESTED'],
            'bid_price'     => request()->bid_price
        ]);

        $seller->notifications()->create([
            'title' => 'New Bidding Request',
            'notification_message'  => 'New bidding request for your vehicle: ' . $product->name,
            'notification_redirect' => route('seller.pages.vehicleDetail', ['id' => $product->id]),
            'car_id' => $product->id,
        ]);

        return $this->apiCreated('true');
    }

    public function updateBid($bidId)
    {
        $bid = Bidding::findOrFail($bidId);

        $product = Product::findOrFail($bid->product_id);

        request()->validate([
            'bid_price' => "required|regex:/^\d+(\.\d{1,2})?$/|numeric|gt:" . $product->vehicle_price
        ]);

        $bid = Bidding::findOrFail($bidId);

        $bid->update([
            'bid_price' => request()->bid_price
        ]);

        return $this->apiUpdated('true');
    }

    public function deleteBid($productId)
    {
        $bid = Bidding::where('product_id', $productId)->where('buyer_id', request()->user()->id)->firstOrFail();
        $bid->delete();
        return $this->apiDeleted();
    }

    public function acceptBid($bidId)
    {
        $bid = Bidding::findOrFail($bidId);
        $product = Product::findOrFail($bid->product_id);

        $buyer = Buyer::findOrFail($bid->buyer_id);

        $bid->update([
            'bidding_type' => Bidding::BID_STATUS['ACCEPTED']
        ]);
        $product->update([
            'vehicle_status' => Product::VEHICLE_STATUS['UNAVAILABLE']
        ]);
        Bidding::where('product_id', $product->id)->where('id', '!=', $bidId)->update([
            'bidding_type' => Bidding::BID_STATUS['DECLINED']
        ]);

        $buyer->notifications()->create([
            'title' => 'Bidding Accepted',
            'notification_message'  => 'Your bid has been accepted by vendor for vehicle: ' . $product->name,
            'notification_redirect' => route('buyer.pages.vehicleDetail', ['id' => $product->id]),
            'car_id' => $product->id,
        ]);

        return $this->apiCreated(true);
    }

    public function soldBid($bidId)
    {
        $bid = Bidding::findOrFail($bidId);
        $product = Product::findOrFail($bid->product_id);

        $buyer = Buyer::findOrFail($bid->buyer_id);

        Bidding::where('product_id', $bid->product_id)->update(['bidding_type' => Bidding::BID_STATUS['DECLINED']]);

        $bid->update([
            'bidding_type' => Bidding::BID_STATUS['SOLD']
        ]);
        $product->update([
            'vehicle_status' => Product::VEHICLE_STATUS['SOLD']
        ]);

        $buyer->notifications()->create([
            'title' => 'Bidding Sold',
            'notification_message'  => 'Your accepted bid has been marked as sold for vehicle: ' . $product->name,
            'notification_redirect' => route('buyer.pages.vehicleDetail', ['id' => $product->id]),
            'car_id' => $product->id,
        ]);

        return $this->apiCreated(true);
    }

    public function biddings()
    {
        $currentBids = Bidding::with(['product', 'seller'])->where('buyer_id', request()->user()->id)
            ->where('bidding_type', Bidding::BID_STATUS['REQUESTED'])->get();
        $successfulBids = Bidding::with(['product', 'seller'])->where('buyer_id', request()->user()->id)
            ->where(function ($query) {
                $query->where('bidding_type', Bidding::BIDDING_TYPE['ACCEPTED'])
                    ->orWhere('bidding_type', Bidding::BIDDING_TYPE['SOLD']);
            })->get();
        $declinedBids = Bidding::with(['product', 'seller'])->where('buyer_id', request()->user()->id)
            ->where('bidding_type', Bidding::BID_STATUS['DECLINED'])->get();

        $data = [
            'currentBids' => $currentBids,
            'successfulBids' => $successfulBids,
            'declinedBids' => $declinedBids,
        ];

        return $this->apiSuccess($data);
    }
}
