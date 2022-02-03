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


require __DIR__.'/auth.php';

Route::get('/', ['as' => 'home','uses' => 'HomeController@landingPage',])->middleware(['XSS']);
Route::get('/home', ['as' => 'home','uses' => 'HomeController@index',])->middleware(['auth','XSS','CheckPlan']);
Route::get('/dashboard', ['as' => 'home','uses' => 'HomeController@index',])->middleware(['auth','XSS','CheckPlan']);
Route::get('/appointment-calendar/{id?}', ['as' => 'appointment.calendar','uses' => 'AppointmentDeatailController@getCalenderAllData',])->middleware(['auth','XSS']);
Route::get('get-appointment-detail/{id}', ['as' => 'appointment.details','uses' => 'AppointmentDeatailController@getAppointmentDetails',])->middleware(['auth','XSS']);
Route::resource('business', 'BusinessController')->middleware(['auth','CheckPlan']);
Route::group(['middleware' => ['auth','XSS','CheckPlan'],], function (){
  
    Route::get('business/edit/{id}', ['as' => 'business.edit', 'uses' => 'BusinessController@edit']);
    Route::get('business/theme-edit/{id}', ['as' => 'business.edit2', 'uses' => 'BusinessController@edit2']);
    Route::get('business/analytics/{id}', ['as' => 'business.analytics', 'uses' => 'BusinessController@analytics']);
    Route::post('business/edit-theme/{id}', ['as' => 'business.edit-theme', 'uses' => 'BusinessController@editTheme']);
    Route::resource('appointments', 'AppointmentDeatailController');
    // Route::get('appoinments/', ['as' => 'appointments.index', 'uses' => 'AppointmentDeatailController@index']);
    Route::resource('users', 'UserController');
    Route::get('user/{id}/plan', 'UserController@upgradePlan')->name('plan.upgrade');
    Route::get('user/{id}/plan/{pid}', 'UserController@activePlan')->name('plan.active');
    Route::get('business/preview/card/{id}', ['as' => 'business.template', 'uses' => 'BusinessController@gettemplate']);
    Route::delete('business/destroy/{id}', ['as' => 'business.destroy', 'uses' => 'BusinessController@destroy']);
    Route::get('profile', 'UserController@profile')->name('profile');
    Route::post('edit-profile', 'UserController@editprofile')->name('update.account');
    Route::resource('systems', 'SystemController');
    Route::post('email-settings', 'SystemController@saveEmailSettings')->name('email.settings');
    Route::post('company-settings-store', 'SystemController@storeCompanySetting')->name('company.settings.store');
    Route::get('test-mail', 'SystemController@testMail')->name('test.mail');
    Route::post('test-mail', 'SystemController@testSendMail')->name('test.send.mail');
    Route::get('change-language/{lang}', 'UserController@changeLanquage')->name('change.language');
    Route::get('manage-language/{lang}', 'LanguageController@manageLanguage')->name('manage.language');
    Route::post('store-language-data/{lang}', 'LanguageController@storeLanguageData')->name('store.language.data');
    Route::get('create-language', 'LanguageController@createLanguage')->name('create.language');
    Route::post('store-language', 'LanguageController@storeLanguage')->name('store.language');

    Route::delete('/lang/{lang}', 'LanguageController@destroyLang')->name('lang.destroy');
    Route::resource('coupons', 'CouponController');
});

Route::post('stripe-settings', 'SystemController@savePaymentSettings')->name('payment.settings')->middleware(['auth','XSS']);
Route::get('/stripe/{code}', 'StripePaymentController@stripe')->name('stripe')->middleware(['auth','XSS']);
Route::post('/stripe', 'StripePaymentController@stripePost')->name('stripe.post')->middleware(['auth','XSS']);
Route::get('order', 'StripePaymentController@index')->name('order.index')->middleware(['auth','XSS']);
Route::resource('plans', 'PlanController');
//================================= Custom Landing Page ====================================//

Route::get('/landingpage', 'LandingPageSectionController@index')->name('custom_landing_page.index')->middleware(['auth','XSS','CheckPlan']);
Route::get('/LandingPage/show/{id}', 'LandingPageSectionController@show');
Route::post('/LandingPage/setConetent', 'LandingPageSectionController@setConetent')->middleware(['auth','XSS','CheckPlan']);
Route::get('/get_landing_page_section/{name}', function($name) {
    $plans = \DB::table('plans')->get();
    return view('custom_landing_page.'.$name,compact('plans'));
});
Route::post('/LandingPage/removeSection/{id}', 'LandingPageSectionController@removeSection')->middleware(['auth','XSS']);
Route::post('/LandingPage/setOrder', 'LandingPageSectionController@setOrder')->middleware(['auth','XSS']);
Route::post('/LandingPage/copySection', 'LandingPageSectionController@copySection')->middleware(['auth','XSS']);



Route::get('/{slug}', 'BusinessController@getcard');
Route::post('appoinment/make-appointment', ['as' => 'appoinment.store', 'uses' => 'AppointmentDeatailController@store'])->middleware('XSS');

Route::post('change-password', 'UserController@updatePassword')->name('update.password');
Route::get('/download/{slug}', 'BusinessController@getVcardDownload')->name('bussiness.save');

Route::get('/apply-coupon', ['as' => 'apply.coupon','uses' => 'CouponController@applyCoupon',])->middleware(['auth','XSS']);


Route::post('prepare-payment', ['as' => 'prepare.payment','uses' => 'PlanController@preparePayment',])->middleware(['auth','XSS',]);
Route::get('/payment/{code}', ['as' => 'payment','uses' => 'PlanController@payment',])->middleware(['auth','XSS',]);

Route::post('plan-pay-with-paypal', 'PaypalController@planPayWithPaypal')->name('plan.pay.with.paypal')->middleware(['auth','XSS',]);


//================================= Plan Payment Gateways  ====================================//

Route::post('/plan-pay-with-paystack',['as' => 'plan.pay.with.paystack','uses' =>'PaystackPaymentController@planPayWithPaystack'])->middleware(['auth','XSS']);
Route::get('/plan/paystack/{pay_id}/{plan_id}', ['as' => 'plan.paystack','uses' => 'PaystackPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-flaterwave',['as' => 'plan.pay.with.flaterwave','uses' =>'FlutterwavePaymentController@planPayWithFlutterwave'])->middleware(['auth','XSS']);
Route::get('/plan/flaterwave/{txref}/{plan_id}', ['as' => 'plan.flaterwave','uses' => 'FlutterwavePaymentController@coingatePlanGetPayment']);

Route::post('/plan-pay-with-razorpay',['as' => 'plan.pay.with.razorpay','uses' =>'RazorpayPaymentController@planPayWithRazorpay'])->middleware(['auth','XSS']);
Route::get('/plan/razorpay/{txref}/{plan_id}', ['as' => 'plan.razorpay','uses' => 'RazorpayPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-paytm',['as' => 'plan.pay.with.paytm','uses' =>'PaytmPaymentController@planPayWithPaytm'])->middleware(['auth','XSS']);
Route::post('/plan/paytm/{plan}', ['as' => 'plan.paytm','uses' => 'PaytmPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-mercado',['as' => 'plan.pay.with.mercado','uses' =>'MercadoPaymentController@planPayWithMercado'])->middleware(['auth','XSS']);
Route::post('/plan/mercado', ['as' => 'plan.mercado','uses' => 'MercadoPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-mollie',['as' => 'plan.pay.with.mollie','uses' =>'MolliePaymentController@planPayWithMollie'])->middleware(['auth','XSS']);
Route::get('/plan/mollie/{plan}', ['as' => 'plan.mollie','uses' => 'MolliePaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-skrill',['as' => 'plan.pay.with.skrill','uses' =>'SkrillPaymentController@planPayWithSkrill'])->middleware(['auth','XSS']);
Route::get('/plan/skrill/{plan}', ['as' => 'plan.skrill','uses' => 'SkrillPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-coingate',['as' => 'plan.pay.with.coingate','uses' =>'CoingatePaymentController@planPayWithCoingate'])->middleware(['auth','XSS']);
Route::get('/plan/coingate/{plan}', ['as' => 'plan.coingate','uses' => 'CoingatePaymentController@getPaymentStatus']);


Route::get('{id}/plan-get-payment-status', 'PaypalController@planGetPaymentStatus')->name('plan.get.payment.status')->middleware(
    [
        'auth',
        'XSS',
    ]
);
