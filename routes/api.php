<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('ezpay_payment_details','Api@ezpay_payment_details')->name('ezpay_payment_details');
Route::post('ezpay_initail','Api@ezpay_initail')->name('ezpay_initail');
Route::post('removeItemFromWishlist','Api@removeItemFromWishlist')->name('removeItemFromWishlist');
Route::post('termlist','Api@termlist')->name('termlist');
Route::get('attributelist','Api@attributelist')->name('attributelist');
Route::get('bannerimages','Api@bannerimages')->name('bannerimages');
Route::post('addserviceorder','Api@addserviceorder')->name('addserviceorder');
Route::post('singleattribute','Api@singleattribute')->name('singleattribute');
Route::post('getproductlistwithprice','Api@getproductlistwithprice')->name('getproductlistwithprice');
Route::post('orderdatasingle','Api@orderdatasingle')->name('orderdatasingle');
Route::post('applydiscountcoupen','Api@applydiscountcoupen')->name('applydiscountcoupen');
Route::post('coupencheck','Api@coupencheck')->name('coupencheck');
Route::post('setproductfilter','Api@setproductfilter')->name('setproductfilter');
Route::post('setcategoryfilter','Api@setcategoryfilter')->name('setcategoryfilter');

Route::post('getproduct','Api@getproduct')->name('getproduct');
Route::post('checkoutcard','Api@checkoutcard')->name('checkoutcard');
Route::post('firebasetoken','Api@firebasetoken')->name('firebasetoken');
Route::get('rating','Api@rating')->name('rating');
Route::post('getratingdetails','Api@getratingdetails')->name('getratingdetails');
Route::post('timeslot','Api@timeslot')->name('timeslot');
Route::post('staff','Api@staff')->name('staff');
Route::post('service','Api@service')->name('service');
Route::get('servicecategory','Api@servicecategory')->name('servicecategory');
Route::post('wholeproductfilter','Api@wholeproductfilter')->name('wholeproductfilter');
Route::post('productwiseattribute','Api@productwiseattribute')->name('productwiseattribute');
Route::post('categorywisebrand','Api@categorywisebrand')->name('categorywisebrand');
Route::post('addwishlist','Api@addwishlist')->name('addwishlist');

Route::get('category','Api@category')->name('category');
Route::post('wishlist','Api@wishlist')->name('wishlist');
// Route::post('register', 'Api@register')->name('register');
Route::post('login', 'Api@login')->name('login');
Route::post('poslogin', 'Api@poslogin')->name('poslogin');
Route::get('searchproductlist', 'Api@searchproductlist')->name('searchproductlist');
Route::post('serchproduct','Api@serchproduct')->name('serchproduct');
Route::post('verifytoken', 'Api@verifytoken')->name('verifytoken');
Route::get('brand', 'Api@brand')->name('brand');
Route::get('categories', 'Api@categories')->name('categories');
Route::get('categorywithproduct', 'Api@categorywithproduct')->name('categorywithproduct');
Route::post('subcategories', 'Api@subcategories')->name('subcategories');
Route::get('attribute', 'Api@attribute')->name('attribute');
Route::get('product', 'Api@product')->name('product');
Route::post('terms', 'Api@terms')->name('terms'); 
Route::post('addtocart', 'Api@addtocart')->name('addtocart');
Route::post('showcart', 'Api@showcart')->name('showcart');
Route::post('profile', 'Api@profile')->name('profile');
Route::post('updateprofile', 'Api@updateprofile')->name('updateprofile');
Route::get('cod', 'Api@cod')->name('cod');
Route::get('icon', 'Api@geticon')->name('icon');
Route::post('addrating', 'Api@addrating')->name('addrating'); 
Route::post('updatecart', 'Api@updatecart')->name('updatecart');
Route::post('deletecart', 'Api@deletecart')->name('deletecart');
Route::post('deletecartwhole', 'Api@deletecartwhole')->name('deletecartwhole');
Route::post('cancelorder', 'Api@cancelorder')->name('cancelorder');
Route::post('cancelwholeorder', 'Api@cancelwholeorder')->name('cancelwholeorder');
Route::post('attributegetcategorywise', 'Api@attributegetcategorywise')->name('attributegetcategorywise');

Route::get('discountcoupun', 'Api@discountcoupun')->name('discountcoupun');
Route::get('currency', 'Api@currency')->name('currency');
Route::post('addorder', 'Api@addorder')->name('addorder');
Route::post('orderfetch', 'Api@orderfetch')->name('orderfetch');
Route::post('posregister', 'Api@posregister')->name('posregister'); 
Route::post('posorderplace', 'Api@posorderplace')->name('posorderplace'); 
Route::post('posordergetdata', 'Api@posordergetdata')->name('posordergetdata'); 
Route::post('poscategory', 'Api@poscategory')->name('poscategory'); 
Route::post('poscategorydata', 'Api@poscategorydata')->name('poscategorydata'); 
Route::post('productfilter','Api@productfilter')->name('productfilter');
Route::post('poscatproduct','Api@poscatproduct')->name('poscatproduct');
Route::post('posproductgetid','Api@posproductgetid')->name('posproductgetid');
Route::post('posholddata','Api@posholddata')->name('posholddata');
Route::post('poscategorywiseproduct','Api@poscategorywiseproduct')->name('poscategorywiseproduct');
Route::post('categorywiseproduct','Api@categorywiseproduct')->name('categorywiseproduct');

Route::post('getposholddata','Api@getposholddata')->name('getposholddata');
Route::post('forgotpassword','Api@forgotpassword')->name('forgotpassword');
Route::post('updatepassword','Api@updatepassword')->name('updatepassword');
Route::get('paymentdetails','Api@paymentdetails')->name('paymentdetails');
Route::get('setting','Api@setting')->name('setting');
Route::post('attributeget','Api@attributeget')->name('attributeget');
Route::post('orderdata','Api@orderdata')->name('orderdata');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('countries','Api@countries')->name('countries');
Route::post('addaddress', 'Api@addaddress')->name('addaddress');
Route::get('countrydata','Api@countrydata')->name('countrydata');
Route::post('statedata','Api@statedata')->name('statedata');
Route::post('citydata','Api@citydata')->name('citydata');