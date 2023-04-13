<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::domain(config('portal.admin'))->group(function () {
    Auth::routes(['register' => false]);

    Route::middleware(['auth'])->group(function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::group(['prefix' => 'file-manager'], function () {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });

        Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
        Route::post('users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
        Route::get('users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

        Route::get('vehicles', [\App\Http\Controllers\Admin\VehicleController::class, 'index'])->name('vehicle.index');
        Route::get('vehicles/{id}', [\App\Http\Controllers\Admin\VehicleController::class, 'show'])->name('vehicle.show');
        Route::delete('vehicles/{id}', [\App\Http\Controllers\Admin\VehicleController::class, 'delete'])->name('vehicle.destroy');

        Route::get('users/change-password', [\App\Http\Controllers\Admin\UserController::class, 'showChangePasswordForm'])->name('changePasswordForm');
        Route::post('users/change-password', [\App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('changePassword');

        Route::get('sellers', [\App\Http\Controllers\Admin\SellerController::class, 'index'])->name('sellers.index');
        Route::get('sellers/create', [\App\Http\Controllers\Admin\SellerController::class, 'create'])->name('sellers.create');
        Route::post('sellers', [\App\Http\Controllers\Admin\SellerController::class, 'store'])->name('sellers.store');
        Route::get('sellers/{seller}/edit', [\App\Http\Controllers\Admin\SellerController::class, 'edit'])->name('sellers.edit');
        Route::put('sellers/{seller}', [\App\Http\Controllers\Admin\SellerController::class, 'update'])->name('sellers.update');
        Route::get('sellers/{seller}', [\App\Http\Controllers\Admin\SellerController::class, 'show'])->name('sellers.show');
        Route::delete('sellers/{seller}', [\App\Http\Controllers\Admin\SellerController::class, 'destroy'])->name('sellers.destroy');
        Route::get('sellers-download-document', [\App\Http\Controllers\Admin\BuyerController::class, 'downloadDocument'])->name('sellers.documentDownload');

        Route::get('buyers', [\App\Http\Controllers\Admin\BuyerController::class, 'index'])->name('buyers.index');
        Route::get('buyers/create', [\App\Http\Controllers\Admin\BuyerController::class, 'create'])->name('buyers.create');
        Route::post('buyers', [\App\Http\Controllers\Admin\BuyerController::class, 'store'])->name('buyers.store');
        Route::get('buyers/{buyer}/edit', [\App\Http\Controllers\Admin\BuyerController::class, 'edit'])->name('buyers.edit');
        Route::put('buyers/{buyer}', [\App\Http\Controllers\Admin\BuyerController::class, 'update'])->name('buyers.update');
        Route::get('buyers/{buyer}', [\App\Http\Controllers\Admin\BuyerController::class, 'show'])->name('buyers.show');
        Route::delete('buyers/{buyer}', [\App\Http\Controllers\Admin\BuyerController::class, 'destroy'])->name('buyers.destroy');
        Route::get('buyers-download-document', [\App\Http\Controllers\Admin\BuyerController::class, 'downloadDocument'])->name('buyers.documentDownload');

//        Route::resource('master/{model}', \App\Http\Controllers\Common\CrudController::class);
        Route::get('master/{model}', [\App\Http\Controllers\Common\CrudController::class, 'index']);
        Route::post('master/{model}', [\App\Http\Controllers\Common\CrudController::class, 'store']);
        Route::put('master/{model}/{id}', [\App\Http\Controllers\Common\CrudController::class, 'update']);
        Route::delete('master/{model}/{id}', [\App\Http\Controllers\Common\CrudController::class, 'destroy']);
        Route::get('master/{model}/list', [\App\Http\Controllers\Common\CrudController::class, 'list']);

        // Product Make
        Route::get('product-makes', [\App\Http\Controllers\Admin\ProductMakeController::class, 'index'])->name('productMakes.index');
        Route::get('product-makes/create', [\App\Http\Controllers\Admin\ProductMakeController::class, 'create'])->name('productMakes.create');
        Route::post('product-makes', [\App\Http\Controllers\Admin\ProductMakeController::class, 'store'])->name('productMakes.store');
        Route::get('product-makes/{productMake}/edit', [\App\Http\Controllers\Admin\ProductMakeController::class, 'edit'])->name('productMakes.edit');
        Route::put('product-makes/{productMake}', [\App\Http\Controllers\Admin\ProductMakeController::class, 'update'])->name('productMakes.update');
        Route::delete('product-makes/{productMake}', [\App\Http\Controllers\Admin\ProductMakeController::class, 'destroy'])->name('productMakes.destroy');

        Route::get('subscription/{model}', [\App\Http\Controllers\Common\SubscriptionController::class, 'index'])->name('subscription.index');
        Route::get('subscription/{model}/create', [\App\Http\Controllers\Common\SubscriptionController::class, 'create'])->name('subscription.create');
        Route::post('subscription/{model}', [\App\Http\Controllers\Common\SubscriptionController::class, 'store'])->name('subscription.store');
        Route::get('subscription/{model}/edit/{id}', [\App\Http\Controllers\Common\SubscriptionController::class, 'edit'])->name('subscription.edit');
        Route::put('subscription/{model}/edit/{id}', [\App\Http\Controllers\Common\SubscriptionController::class, 'update'])->name('subscription.update');
        Route::delete('subscription/{model}/{id}', [\App\Http\Controllers\Common\SubscriptionController::class, 'destroy'])->name('subscription.destroy');

        Route::get('faqs/{model}', [\App\Http\Controllers\Admin\FaqController::class, 'index'])->name('faqs.index');
        Route::get('faqs/{model}/create', [\App\Http\Controllers\Admin\FaqController::class, 'create'])->name('faqs.create');
        Route::post('faqs/{model}/store', [\App\Http\Controllers\Admin\FaqController::class, 'store'])->name('faqs.store');
        Route::get('faqs/{model}/edit/{id}', [\App\Http\Controllers\Admin\FaqController::class, 'edit'])->name('faqs.edit');
        Route::put('faqs/{model}/update/{id}', [\App\Http\Controllers\Admin\FaqController::class, 'update'])->name('faqs.update');
        Route::delete('faqs/{model}/delete/{id}', [\App\Http\Controllers\Admin\FaqController::class, 'destroy'])->name('faqs.destroy');

        Route::get('site-settings/{model}', [\App\Http\Controllers\Admin\SiteSettingsController::class, 'index'])->name('siteSettings.index');
        Route::put('site-settings/{model}', [\App\Http\Controllers\Admin\SiteSettingsController::class, 'update'])->name('siteSettings.update');
    });
});

Route::domain(config('portal.seller'))->name('seller.')->group(function () {
    Route::middleware(['auth.seller'])->group(function () {
        Route::post('logout', [\App\Http\Controllers\SellerAuth\LoginController::class, 'signOut'])->name('logout');
        Route::get('/my-vehicles', [\App\Http\Controllers\Sellers\PageController::class, 'myVehicles'])->name('pages.myVehicles');
        Route::get('/vehicle-detail/{id}', [\App\Http\Controllers\Sellers\PageController::class, 'vehicleDetail'])->name('pages.vehicleDetail');
        Route::get('/account-detail', [\App\Http\Controllers\Sellers\PageController::class, 'accountDetail'])->name('pages.accountDetail');

        Route::get('/payment-methods/{slug}', [\App\Http\Controllers\Sellers\PageController::class, 'paymentMethods'])->name('pages.paymentMethods');
        Route::post('/subscription/{plan}', [\App\Http\Controllers\Sellers\PaymentController::class, 'subscriptionCreate'])->name('subscription.create');

        Route::post('change-password', [\App\Http\Controllers\SellerAuth\LoginController::class, 'changePassword'])->name('changePassword');
        Route::post('update-account-detail', [\App\Http\Controllers\SellerAuth\LoginController::class, 'updateAccountDetail'])->name('updateAccountDetail');
        Route::post('change-avatar', [\App\Http\Controllers\SellerAuth\LoginController::class, 'changeAvatar'])->name('changeAvatar');

        Route::get('/car-resources', [\App\Http\Controllers\Buyers\CarController::class, 'carResources'])->name('car.resources');
        Route::get('/car-models', [\App\Http\Controllers\Buyers\CarController::class, 'carModels'])->name('car.models');
        Route::post('/car-store', [\App\Http\Controllers\Buyers\CarController::class, 'carStore'])->name('car.store');
        Route::get('/car-list', [\App\Http\Controllers\Buyers\CarController::class, 'carList'])->name('car.list');
        Route::get('/car-detail/{id}', [\App\Http\Controllers\Buyers\CarController::class, 'vehicleDetail'])->name('car.vehicleDetail');
        Route::delete('/car-delete/{id}', [\App\Http\Controllers\Buyers\CarController::class, 'carDelete'])->name('car.delete');
        Route::put('/car-update/{id}', [\App\Http\Controllers\Buyers\CarController::class, 'carUpdate'])->name('car.update');

        Route::get('/notifications', [\App\Http\Controllers\Sellers\PageController::class, 'notification'])->name('notification');
        Route::get('/notifications/{notificationId}', [\App\Http\Controllers\NotificationController::class, 'notificationRedirect'])->name('notification.redirect');
        Route::get('/notification-read/{notificationId}', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notification.markAsRead');
        Route::get('/notification-allread', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notification.markAllAsRead');

        Route::post('/accept/bid/{bidId}', [\App\Http\Controllers\BiddingController::class, 'acceptBid'])->name('bid.accept');
        Route::post('/sold/bid/{bidId}', [\App\Http\Controllers\BiddingController::class, 'soldBid'])->name('bid.sold');

        Route::post('/stripe/webhook', [\App\Http\Controllers\SellerWebhookController::class, 'handleWebhook']);
    });

    Route::get('/', [\App\Http\Controllers\Sellers\PageController::class, 'index'])->name('pages.home');
    Route::get('/about-us', [\App\Http\Controllers\Sellers\PageController::class, 'aboutUs'])->name('pages.aboutUs');
    Route::get('/contact-us', [\App\Http\Controllers\Sellers\PageController::class, 'contactUs'])->name('pages.contactUs');
    Route::get('/help-center', [\App\Http\Controllers\Sellers\PageController::class, 'helpCenter'])->name('pages.helpCenter');
    Route::get('/terms-and-policy', [\App\Http\Controllers\Sellers\PageController::class, 'termsAndPolicy'])->name('pages.termsAndPolicy');
    Route::get('/pricing-plan', [\App\Http\Controllers\Sellers\PageController::class, 'pricingPlan'])->name('pages.pricingPlan');

    Route::get('login', [\App\Http\Controllers\SellerAuth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\SellerAuth\LoginController::class, 'login'])->name('login.post');
    Route::get('register', [\App\Http\Controllers\SellerAuth\LoginController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [\App\Http\Controllers\SellerAuth\LoginController::class, 'register'])->name('register.post');

    Route::get('password/reset', [\App\Http\Controllers\SellerAuth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [\App\Http\Controllers\SellerAuth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [\App\Http\Controllers\SellerAuth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [\App\Http\Controllers\SellerAuth\ResetPasswordController::class, 'reset'])->name('password.update');

    Route::get('auth/seller/google', [\App\Http\Controllers\SellerAuth\GoogleController::class, 'redirectToGoogle'])->name('redirect.google');
    Route::get('auth/seller/google/callback', [\App\Http\Controllers\SellerAuth\GoogleController::class, 'handleGoogleCallback'])->name('handle.google');

    Route::get('auth/seller/facebook', [\App\Http\Controllers\SellerAuth\FacebookController::class, 'facebookRedirect'])->name('redirect.facebook');
    Route::get('auth/seller/facebook/callback', [\App\Http\Controllers\SellerAuth\FacebookController::class, 'loginWithFacebook'])->name('handle.facebook');
});

Route::domain(config('portal.buyer'))->name('buyer.')->group(function () {
    Route::middleware(['auth.buyer'])->group(function () {
        Route::post('logout', [\App\Http\Controllers\BuyerAuth\LoginController::class, 'signOut'])->name('logout');
        Route::get('/change-password', [\App\Http\Controllers\Buyers\PageController::class, 'changePassword'])->name('pages.changePassword');
        Route::post('change-password', [\App\Http\Controllers\BuyerAuth\LoginController::class, 'changePassword'])->name('changePassword');
        Route::post('update-account-detail', [\App\Http\Controllers\BuyerAuth\LoginController::class, 'updateAccountDetail'])->name('updateAccountDetail');
        Route::post('change-avatar', [\App\Http\Controllers\BuyerAuth\LoginController::class, 'changeAvatar'])->name('changeAvatar');

        Route::get('/payment-methods/{slug}', [\App\Http\Controllers\Buyers\PageController::class, 'paymentMethods'])->name('pages.paymentMethods');
        Route::post('/subscription/{plan}', [\App\Http\Controllers\Sellers\PaymentController::class, 'subscriptionCreate'])->name('subscription.create');

        Route::get('/favourites', [\App\Http\Controllers\Buyers\PageController::class, 'favourites'])->name('pages.favourites');
        Route::post('/favourites/{productId}', [\App\Http\Controllers\Common\FavouriteController::class, 'addFavourite'])->name('favourites.add');

        Route::post('/request/bid/{productId}', [\App\Http\Controllers\BiddingController::class, 'requestBid'])->name('bid.request');

        Route::get('/account-settings', [\App\Http\Controllers\Buyers\PageController::class, 'accountSettings'])->name('pages.accountSettings');
        Route::get('/manage-bids', [\App\Http\Controllers\Buyers\PageController::class, 'manageBids'])->name('pages.manageBids');

        Route::get('/notifications', [\App\Http\Controllers\Buyers\PageController::class, 'notification'])->name('notification');
        Route::get('/notifications/{notificationId}', [\App\Http\Controllers\NotificationController::class, 'notificationRedirect'])->name('notification.redirect');
        Route::get('/notification-read/{notificationId}', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notification.markAsRead');
        Route::get('/notification-allread', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notification.markAllAsRead');

        Route::post('/stripe/webhook', [\App\Http\Controllers\BuyerWebhookController::class, 'handleWebhook']);
    });

    Route::get('/', [\App\Http\Controllers\Buyers\PageController::class, 'index'])->name('pages.home');
    Route::get('/about-us', [\App\Http\Controllers\Buyers\PageController::class, 'aboutUs'])->name('pages.aboutUs');
    Route::get('/contact-us', [\App\Http\Controllers\Buyers\PageController::class, 'contactUs'])->name('pages.contactUs');
    Route::get('/discover-vehicle', [\App\Http\Controllers\Buyers\PageController::class, 'discoverVehicle'])->name('pages.discoverVehicle');
    Route::get('/help-center', [\App\Http\Controllers\Buyers\PageController::class, 'helpCenter'])->name('pages.helpCenter');
    Route::get('/terms-and-condition', [\App\Http\Controllers\Buyers\PageController::class, 'termsAndConditions'])->name('pages.termsAndConditions');
    Route::get('/vehicle-detail/{id}', [\App\Http\Controllers\Buyers\PageController::class, 'vehicleDetail'])->name('pages.vehicleDetail');
    Route::get('/pricing-plan', [\App\Http\Controllers\Buyers\PageController::class, 'pricingPlan'])->name('pages.pricingPlan');

    Route::get('/model-by-brand', [\App\Http\Controllers\AjaxController::class, 'getModelByBrand'])->name('ajax.modelByBrand');

    Route::get('login', [\App\Http\Controllers\BuyerAuth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\BuyerAuth\LoginController::class, 'login'])->name('login.post');
    Route::get('register', [\App\Http\Controllers\BuyerAuth\LoginController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [\App\Http\Controllers\BuyerAuth\LoginController::class, 'register'])->name('register.post');

    Route::get('password/reset', [\App\Http\Controllers\BuyerAuth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [\App\Http\Controllers\BuyerAuth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [\App\Http\Controllers\BuyerAuth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [\App\Http\Controllers\BuyerAuth\ResetPasswordController::class, 'reset'])->name('password.update');

    Route::get('auth/buyer/google', [\App\Http\Controllers\BuyerAuth\GoogleController::class, 'redirectToGoogle'])->name('redirect.google');
    Route::get('auth/buyer/google/callback', [\App\Http\Controllers\BuyerAuth\GoogleController::class, 'handleGoogleCallback'])->name('handle.google');

    Route::get('auth/buyer/facebook', [\App\Http\Controllers\BuyerAuth\FacebookController::class, 'facebookRedirect'])->name('redirect.facebook');
    Route::get('auth/buyer/facebook/callback', [\App\Http\Controllers\BuyerAuth\FacebookController::class, 'loginWithFacebook'])->name('handle.facebook');
});

Route::get('test', [\App\Http\Controllers\TestController::class, 'image']);
Route::get('fcm', [\App\Http\Controllers\TestController::class, 'fcm']);
