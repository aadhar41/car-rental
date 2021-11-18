<?php

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

// Route::get('/', function () {
//     return view('front.home');
// })->name('home');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

Route::get('/', [App\Http\Controllers\Front\FrontController::class, 'index'])->name('home');

Route::get('/services/', [App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('services');

Route::get('/brand/{slug}/', [App\Http\Controllers\Front\CarBrandController::class, 'index'])->name('brand');

Route::get('/vehicle/{slug}/', [App\Http\Controllers\Front\VehicleDetailController::class, 'index'])->name('vehicle');

Route::get('/contact-us', [App\Http\Controllers\Front\ContactController::class, 'index'])->name('contactus');

Route::post('/contact-us', [App\Http\Controllers\Front\ContactController::class, 'store'])->name('contactus.send');

// Route::get('/car-brand', [App\Http\Controllers\CarBrandController::class, 'index'])->name('carbrand');

// Route::prefix('admin')->middleware(['Admin'])->group(function () {
//     Route::get('/front/{id}', [App\Http\Controllers\FrontController::class, 'edit'])->name('services')->where('id', '[0-9]+');;
// });

Route::get('/admin', function () {
    return redirect()->route('login');
});

Route::redirect('/logout', '/admin');


Route::prefix('admin')->group(function () {

    /** 
     * Authentication routes
     */

    // Login route
    Route::get(
        'login',
        [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']
    )->name('login');
    Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

    // Registeration route
    Route::get(
        'register',
        [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm']
    )->name('register');
    Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

    // Logout Route
    Route::post(
        'logout',
        [App\Http\Controllers\Auth\LoginController::class, 'logout']
    )->name('logout');

    // Register the typical reset password routes for an application.
    Route::get(
        'password/reset',
        [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm']
    )->name('password.request');
    Route::post(
        'password/email',
        [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail']
    )->name('password.email');
    Route::get(
        'password/reset/{token}',
        [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm']
    )->name('password.reset');
    Route::post(
        'password/reset',
        [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset']
    )->name('password.update');


    // Register the typical confirm password routes for an application.
    Route::get(
        'password/confirm',
        [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'showConfirmForm']
    )->name('password.confirm');
    Route::post(
        'password/confirm',
        [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'confirm']
    )->name('password.update');

    // Register the typical email verification routes for an application.
    Route::get(
        'email/verify',
        [App\Http\Controllers\Auth\VerificationController::class, 'show']
    )->name('verification.notice');
    Route::get(
        'email/verify/{id}/{hash}',
        [App\Http\Controllers\Auth\VerificationController::class, 'verify']
    )->name('verification.verify');
    Route::post(
        'email/resend',
        [App\Http\Controllers\Auth\VerificationController::class, 'resend']
    )->name('verification.resend');




    /**
     * Admin Panel Routes
     */

    // Admin route for dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.dashboard');

    // Admin routes for Front / Home page
    Route::get('/front', [App\Http\Controllers\Front\FrontController::class, 'edit'])->name('admin.front.edit');
    Route::put('/front/update/{id}', [App\Http\Controllers\Front\FrontController::class, 'update'])->name('admin.front.update');


    // Admin route for user profile.
    Route::get('/profile', [App\Http\Controllers\Admin\UserProfileController::class, 'edit'])->name('admin.userprofile.edit');
    Route::put('/profile-update/{id}', [App\Http\Controllers\Admin\UserProfileController::class, 'update'])->name('admin.userprofile.update');


    // Admin routes for service page
    Route::get('/service', [App\Http\Controllers\Admin\ServiceController::class, 'create'])->name('admin.service.create');
    Route::post('/service-store', [App\Http\Controllers\Admin\ServiceController::class, 'store'])->name('admin.service.store');
    Route::get('/service/list', [App\Http\Controllers\Admin\ServiceController::class, 'lists'])->name('admin.service.list');

    Route::get('/service/enable/{id}', [App\Http\Controllers\Admin\ServiceController::class, 'enable'])->name('admin.service.enable');
    Route::get('/service/disable/{id}', [App\Http\Controllers\Admin\ServiceController::class, 'disable'])->name('admin.service.disable');

    Route::get(
        '/service/datatable',
        [App\Http\Controllers\Admin\ServiceController::class, 'datatable']
    )->name('service.datatables');

    Route::get(
        '/service/delete/{id}',
        [App\Http\Controllers\Admin\ServiceController::class, 'destroy']
    )->name('service.delete');



    // Admin route for brands
    Route::get('/brand', [App\Http\Controllers\Admin\BrandController::class, 'create'])->name('admin.brand.create');
    Route::post('/brand-store', [App\Http\Controllers\Admin\BrandController::class, 'store'])->name('admin.brand.store');
    Route::get('/brand/list', [App\Http\Controllers\Admin\BrandController::class, 'lists'])->name('admin.brand.list');

    Route::get('/brand/edit/{id}', [App\Http\Controllers\Admin\BrandController::class, 'edit'])->name('admin.brand.edit');
    Route::put('/brand/update/{id}', [App\Http\Controllers\Admin\BrandController::class, 'update'])->name('admin.brand.update');

    Route::get('/brand/enable/{id}', [App\Http\Controllers\Admin\BrandController::class, 'enable'])->name('admin.brand.enable');
    Route::get('/brand/disable/{id}', [App\Http\Controllers\Admin\BrandController::class, 'disable'])->name('admin.brand.disable');

    Route::get(
        '/brand/datatable',
        [App\Http\Controllers\Admin\BrandController::class, 'datatable']
    )->name('brand.datatables');

    Route::get(
        '/brand/delete/{id}',
        [App\Http\Controllers\Admin\BrandController::class, 'destroy']
    )->name('brand.delete');



    // Admin route for vehicles
    Route::get('/vehicle', [App\Http\Controllers\Admin\VehicleController::class, 'create'])->name('admin.vehicle.create');
    Route::post('/vehicle-store', [App\Http\Controllers\Admin\VehicleController::class, 'store'])->name('admin.vehicle.store');
    Route::get('/vehicle/list', [App\Http\Controllers\Admin\VehicleController::class, 'lists'])->name('admin.vehicle.list');
    Route::get('/vehicle-show/{id}', [App\Http\Controllers\Admin\VehicleController::class, 'show'])->name('admin.vehicle.show');

    Route::get('/vehicle/edit/{id}', [App\Http\Controllers\Admin\VehicleController::class, 'edit'])->name('admin.vehicle.edit');
    Route::put('/vehicle/update/{id}', [App\Http\Controllers\Admin\VehicleController::class, 'update'])->name('admin.vehicle.update');

    Route::get('/vehicle/enable/{id}', [App\Http\Controllers\Admin\VehicleController::class, 'enable'])->name('admin.vehicle.enable');
    Route::get('/vehicle/disable/{id}', [App\Http\Controllers\Admin\VehicleController::class, 'disable'])->name('admin.vehicle.disable');

    Route::get(
        '/vehicle/datatable',
        [App\Http\Controllers\Admin\VehicleController::class, 'datatable']
    )->name('vehicle.datatables');

    Route::get(
        '/vehicle/delete/{id}',
        [App\Http\Controllers\Admin\VehicleController::class, 'destroy']
    )->name('vehicle.delete');




    // Admin route for units
    Route::get('/unit', [App\Http\Controllers\Admin\UnitController::class, 'create'])->name('admin.unit.create');
    Route::post('/unit-store', [App\Http\Controllers\Admin\UnitController::class, 'store'])->name('admin.unit.store');
    Route::get('/unit/list', [App\Http\Controllers\Admin\UnitController::class, 'lists'])->name('admin.unit.list');

    Route::get('/unit/enable/{id}', [App\Http\Controllers\Admin\UnitController::class, 'enable'])->name('admin.unit.enable');
    Route::get('/unit/disable/{id}', [App\Http\Controllers\Admin\UnitController::class, 'disable'])->name('admin.unit.disable');

    Route::get(
        '/unit/datatable',
        [App\Http\Controllers\Admin\UnitController::class, 'datatable']
    )->name('unit.datatables');

    Route::get(
        '/unit/delete/{id}',
        [App\Http\Controllers\Admin\UnitController::class, 'destroy']
    )->name('unit.delete');



    // Admin route for vehicle stats
    Route::get('/vehiclestat', [App\Http\Controllers\Admin\VehicleStatController::class, 'create'])->name('admin.vehiclestat.create');

    Route::post('/vehiclestat-store', [App\Http\Controllers\Admin\VehicleStatController::class, 'store'])->name('admin.vehiclestat.store');

    Route::get('/vehiclestat/list/{id}', [App\Http\Controllers\Admin\VehicleStatController::class, 'lists'])->name('admin.vehiclestat.stats');

    Route::get('/vehiclestat/enable/{id}', [App\Http\Controllers\Admin\VehicleStatController::class, 'enable'])->name('admin.vehiclestat.enable');
    Route::get('/vehiclestat/disable/{id}', [App\Http\Controllers\Admin\VehicleStatController::class, 'disable'])->name('admin.vehiclestat.disable');

    Route::get(
        '/vehiclestat/datatable',
        [App\Http\Controllers\Admin\VehicleStatController::class, 'datatable']
    )->name('vehiclestat.datatables');

    Route::get(
        '/vehiclestat/delete/{id}',
        [App\Http\Controllers\Admin\VehicleStatController::class, 'destroy']
    )->name('vehiclestat.delete');

    // ajax route
    Route::post('getbrandvehicles', [App\Http\Controllers\Admin\VehicleStatController::class, 'getbrandvehicles'])->name('getbrandvehicles');




    // Admin route for vehicle feature
    Route::get('/vehiclefeature', [App\Http\Controllers\Admin\VehicleFeatureController::class, 'create'])->name('admin.vehiclefeature.create');

    Route::post('/vehiclefeature-store', [App\Http\Controllers\Admin\VehicleFeatureController::class, 'store'])->name('admin.vehiclefeature.store');
    Route::get('/vehiclefeature/list/{id}', [App\Http\Controllers\Admin\VehicleFeatureController::class, 'lists'])->name('admin.vehiclefeature.stats');

    Route::get('/vehiclefeature/enable/{id}', [App\Http\Controllers\Admin\VehicleFeatureController::class, 'enable'])->name('admin.vehiclefeature.enable');
    Route::get('/vehiclefeature/disable/{id}', [App\Http\Controllers\Admin\VehicleFeatureController::class, 'disable'])->name('admin.vehiclefeature.disable');

    Route::get(
        '/vehiclefeature/datatable',
        [App\Http\Controllers\Admin\VehicleFeatureController::class, 'datatable']
    )->name('vehiclefeature.datatables');

    Route::get(
        '/vehiclefeature/delete/{id}',
        [App\Http\Controllers\Admin\VehicleFeatureController::class, 'destroy']
    )->name('vehiclefeature.delete');



    // Admin route for vehicle VehiclePricingDays
    Route::get('/vehiclepricing', [App\Http\Controllers\Admin\VehiclePricingDayController::class, 'create'])->name('admin.vehiclepricing.create');

    Route::post('/vehiclepricing-store', [App\Http\Controllers\Admin\VehiclePricingDayController::class, 'store'])->name('admin.vehiclepricing.store');
    Route::get('/vehiclepricing/list', [App\Http\Controllers\Admin\VehiclePricingDayController::class, 'lists'])->name('admin.vehiclepricing.list');

    Route::get('/vehiclepricing/enable/{id}', [App\Http\Controllers\Admin\VehiclePricingDayController::class, 'enable'])->name('admin.vehiclepricing.enable');
    Route::get('/vehiclepricing/disable/{id}', [App\Http\Controllers\Admin\VehiclePricingDayController::class, 'disable'])->name('admin.vehiclepricing.disable');

    Route::get(
        '/vehiclepricing/datatable',
        [App\Http\Controllers\Admin\VehiclePricingDayController::class, 'datatable']
    )->name('vehiclepricing.datatables');

    Route::get(
        '/vehiclepricing/delete/{id}',
        [App\Http\Controllers\Admin\VehiclePricingDayController::class, 'destroy']
    )->name('vehiclepricing.delete');



    // Admin route for buckets
    Route::get('/bucket', [App\Http\Controllers\Admin\BucketController::class, 'create'])->name('admin.bucket.create');
    Route::post('/bucket-store', [App\Http\Controllers\Admin\BucketController::class, 'store'])->name('admin.bucket.store');
    // Route::get('/bucket/list', [App\Http\Controllers\Admin\BucketController::class, 'lists'])->name('admin.bucket.list');

    Route::get('/bucket/enable/{id}', [App\Http\Controllers\Admin\BucketController::class, 'enable'])->name('admin.bucket.enable');
    Route::get('/bucket/disable/{id}', [App\Http\Controllers\Admin\BucketController::class, 'disable'])->name('admin.bucket.disable');

    Route::get(
        '/bucket/datatable',
        [App\Http\Controllers\Admin\BucketController::class, 'datatable']
    )->name('bucket.datatables');

    Route::get(
        '/bucket/delete/{id}',
        [App\Http\Controllers\Admin\BucketController::class, 'destroy']
    )->name('bucket.delete');



    // Admin route for vehicle VehiclePricingBuckets
    Route::get('/vehiclepricingbucket', [App\Http\Controllers\Admin\VehiclePricingBucketController::class, 'create'])->name('admin.vehiclepricingbucket.create');

    Route::post('/vehiclepricingbucket-store', [App\Http\Controllers\Admin\VehiclePricingBucketController::class, 'store'])->name('admin.vehiclepricingbucket.store');
    Route::get('/vehiclepricingbucket/list', [App\Http\Controllers\Admin\VehiclePricingBucketController::class, 'lists'])->name('admin.vehiclepricingbucket.list');

    Route::get('/vehiclepricingbucket/enable/{id}', [App\Http\Controllers\Admin\VehiclePricingBucketController::class, 'enable'])->name('admin.vehiclepricingbucket.enable');
    Route::get('/vehiclepricingbucket/disable/{id}', [App\Http\Controllers\Admin\VehiclePricingBucketController::class, 'disable'])->name('admin.vehiclepricingbucket.disable');

    Route::get(
        '/vehiclepricingbucket/datatable',
        [App\Http\Controllers\Admin\VehiclePricingBucketController::class, 'datatable']
    )->name('vehiclepricingbucket.datatables');

    Route::get(
        '/vehiclepricing/delete/{id}',
        [App\Http\Controllers\Admin\VehiclePricingBucketController::class, 'destroy']
    )->name('vehiclepricingbucket.delete');

    // Ajax route
    Route::post('getavailablebuckets', [App\Http\Controllers\Admin\VehiclePricingBucketController::class, 'getavailablebuckets'])->name('getavailablebuckets');



    // Admin route for membership
    Route::get('/membership', [App\Http\Controllers\Admin\MembershipController::class, 'create'])->name('admin.membership.create');
    Route::post('/membership-store', [App\Http\Controllers\Admin\MembershipController::class, 'store'])->name('admin.membership.store');
    Route::get('/membership/list', [App\Http\Controllers\Admin\MembershipController::class, 'lists'])->name('admin.membership.list');

    Route::get('/membership/enable/{id}', [App\Http\Controllers\Admin\MembershipController::class, 'enable'])->name('admin.membership.enable');
    Route::get('/membership/disable/{id}', [App\Http\Controllers\Admin\MembershipController::class, 'disable'])->name('admin.membership.disable');

    Route::get(
        '/membership/datatable',
        [App\Http\Controllers\Admin\MembershipController::class, 'datatable']
    )->name('membership.datatables');

    Route::get(
        '/membership/delete/{id}',
        [App\Http\Controllers\Admin\MembershipController::class, 'destroy']
    )->name('membership.delete');
});
