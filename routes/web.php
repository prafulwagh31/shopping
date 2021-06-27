<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportExportController;
use App\Http\Controllers\PaymentController;
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


    // ...
Route::get('admin/signup','Controller@admindata')->name('admindata');
Route::post('admin-signup','Controller@adminregisterdata')->name('adminregisterdata');
Route::get('admin', 'Controller@index')->name('login');
Route::post('/login', 'Controller@login');



// Route::group(['middleware' => ['auth']], function () {
	Route::get('dashboard', 'Controller@dashboard')->name('dashboard');
Route::post('customproductupdate','Controller@customproductupdate')->name('customproductupdate');
Route::get('bannerdelete/{id}','Controller@bannerdelete')->name('bannerdelete');
Route::post('addslider','Controller@addslider')->name('addslider');
Route::get('slidersetting','Controller@slidersetting')->name('slidersetting');
Route::post('getstaff','Controller@getstaff')->name('getstaff');
Route::post('gettimeslot','Controller@gettimeslot')->name('gettimeslot');
Route::get('timeslotedit/{id}','Controller@timeslotedit')->name('timeslotedit');

Route::get('seeallnotify','Controller@seeallnotify')->name('seeallnotify');
Route::get('role','Controller@role')->name('role');
Route::post('addrole','Controller@addrole')->name('addrole');
Route::get('accessuser','Controller@accessuser')->name('accessuser');
Route::post('addaccessuser','Controller@addaccessuser')->name('addaccessuser');
Route::get('/accessuseredit/{id}','Controller@editaccessuser');
Route::post('/updateaccessuser','Controller@updateaccessuser');
Route::get('deleteaccessuser/{id}','Controller@deleteaccessuser')->name('deleteaccessuser');
Route::get('accesspermission/{id}','Controller@accesspermission')->name('accesspermission');

Route::post('updatepermission','Controller@updatepermission')->name('updatepermission');
Route::post('leadnotes','Controller@leadnotes')->name('leadnotes');
Route::get('/termsdelete/{attributeid}/{id}','Controller@termsdelete')->name('termsdelete');
Route::get('/attributedelete/{id}','Controller@attributedelete');
Route::get('adminprofile','Controller@adminprofile')->name('adminprofile');
Route::post('updateprofile','Controller@updateprofile')->name('updateprofile');
Route::post('updatevarients','Controller@updatevarients')->name('updatevarients');
Route::post('/addcustcategory', 'Controller@addcustcategory');
Route::get('custcategory','Controller@custcategory')->name('custcategory');
Route::get('timeslot','Controller@timeslot')->name('timeslot');
Route::post('/addtimeslot', 'Controller@addtimeslot');

Route::get('productvareint/{id}','Controller@productvareint')->name('productvareint');
Route::get('productvareintedit/{id}','Controller@productvareintedit')->name('productvareintedit');
Route::get('timeslotdelete/{id}','Controller@timeslotdelete')->name('timeslotdelete');
Route::post('/updateitem', 'Controller@updateitem');
Route::get('proposalitemedit/{id}','Controller@proposalitemedit')->name('proposalitemedit');
Route::get('custcategorydelete/{id}','Controller@custcategorydelete')->name('custcategorydelete');

Route::post('addevents', 'Controller@addevents')->name('addevents');
Route::get('event/{id}', 'Controller@createevent')->name('createevent');


Route::get('admin/signout','Controller@logout');
Route::get('admin/register', 'Controller@register')->name('admin.register');
Route::post('admin/registerdata', 'Controller@registerdata')->name('registerdata');
Route::get('vendordata','Controller@vendordata')->name('vendordata');
Route::get('frontend/{id}','Controller@frontend')->name('frontend');
Route::post('activatevendor','Controller@activatevendor')->name('activatevendor');
Route::post('getproductdata','Controller@getproductdata')->name('getproductdata');
Route::get('proposallist/{id}','Controller@proposallist')->name('proposallist');
Route::get('crmdashboard','Controller@crmdashboard')->name('crmdashboard');
Route::post('deactivatevendor','Controller@deactivatevendor')->name('deactivatevendor');
Route::get('vendordelete/{id}','Controller@vendordelete')->name('vendordelete');
Route::get('productlist','Controller@productlist')->name('productlist');
Route::post('deletemultipleproductdata','Controller@deletemultipleproductdata')->name('deletemultipleproductdata');
Route::get('paymentgatwaykey','Controller@paymentgatwaykey')->name('paymentgatwaykey');
Route::get('reieveitem/{id}','Controller@reieveitem')->name('reieveitem');
Route::post('submitrecieve','Controller@submitrecieve')->name('submitrecieve');

Route::get('inventory','Controller@inventory')->name('inventory');
Route::get('transfer','Controller@transfer')->name('transfer');
Route::get('transfer/{id}/{proposalid}','Controller@transfer')->name('transferproposal');

Route::post('addtransfer','Controller@addtransfer')->name('addtransfer');
Route::get('transferlist','Controller@transferlist')->name('transferlist');
Route::get('transferview/{id}','Controller@transferview')->name('transferview');
Route::get('completetransfer/{id}','Controller@completetransfer')->name('completetransfer');
Route::get('invoicegenrate/{id}','Controller@invoicegenrate')->name('invoicegenrate');
Route::get('createproposal/{id}','Controller@createproposal')->name('createproposal');
Route::post('addleadproposal','Controller@addleadproposal')->name('addleadproposal');
Route::post('getproductdeatils','Controller@getproductdeatils')->name('getproductdeatils');
Route::post('additeminproposal','Controller@additeminproposal')->name('additeminproposal');
Route::get('/itemedit/{id}','Controller@edititem');
Route::post('/updateitem','Controller@updateitem');
Route::get('/proposalitemdelete/{id}','Controller@proposalitemdelete');
Route::get('createPDF/{id}','Controller@createPDF')->name('createPDF');
Route::get('proposalstatusupdate/{id}','Controller@proposalstatusupdate')->name('proposalstatusupdate');

Route::get('samplepdfview','Controller@samplepdfview')->name('samplepdfview');

Route::get('taxes','Controller@taxes');
Route::post('/addtax','Controller@addtax');
Route::get('/taxdelete/{id}','Controller@taxdelete');
Route::get('taxtype','Controller@taxtype')->name('taxtype');
Route::post('/addtaxtype','Controller@addtaxtype');
Route::get('/taxtypedelete/{id}','Controller@taxtypedelete');
Route::get('test','Controller@test');
Route::post('storemedia', 'ImportExportController@storeMedia')->name('import.storeMedianew');
Route::get('campaigns','Controller@campaigns');
Route::post('/addcampaigns','Controller@addcampaigns');
Route::get('/campaignsedit/{id}','Controller@editcampaigns');
Route::post('/updatecampaigns','Controller@updatecampaigns');
Route::get('/campaignsdelete/{id}','Controller@campaignsdelete');
Route::get('contact','Controller@contact');
Route::get('contactproject','Controller@contact');
Route::post('/addcontact','Controller@addcontact');
Route::get('/contactedit/{id}','Controller@editcontact');
Route::post('/updatecontact','Controller@updatecontact');
Route::get('/contactdelete/{id}','Controller@contactdelete');
Route::get('organization','Controller@organization');
Route::post('/addorganizations','Controller@addorganizations');
Route::get('/organizationedit/{id}','Controller@editorganization');
Route::post('/updateorganizations','Controller@updateorganizations');
Route::get('/organizationdelete/{id}','Controller@organizationdelete');
Route::get('project','Controller@project');
Route::post('/addproject','Controller@addproject');
Route::get('/projectedit/{id}','Controller@editproject');
Route::post('/updateproject','Controller@updateproject');
Route::get('/projectdelete/{id}','Controller@projectdelete');
Route::get('task','Controller@task');
Route::post('/addtask','Controller@addtask');
Route::get('/taskedit/{id}','Controller@edittask');
Route::post('/updatetask','Controller@updatetask');
Route::get('/taskdelete/{id}','Controller@taskdelete');
Route::get('milestone','Controller@milestone');
Route::post('/addmilestone','Controller@addmilestone');
Route::get('/milestoneedit/{id}','Controller@editmilestone');
Route::post('/updatemilestone','Controller@updatemilestone');
Route::get('/milestonedelete/{id}','Controller@milestonedelete');

Route::get('addleads','Controller@addleads');
Route::post('/addnewleads','Controller@addnewleads')->name('addnewleads');
Route::get('/leaddataedit/{id}','Controller@editlead');
Route::post('/updatedatalead','Controller@updatedatalead');
Route::get('/leaddatadelete/{id}','Controller@leaddatadelete');
Route::get('/leadconvert/{id}','Controller@leadconvert');
Route::get('listleads','Controller@listleads');

Route::get('/editnotes/{leadid}/{id}','Controller@editnotes')->name('editnotes');
Route::post('/updatenotes','Controller@updatenotes');
Route::get('deletenote/{id}','Controller@deletenote')->name('deletenote');
Route::get('leadeview/{id}','Controller@leadeview')->name('leadeview');
Route::get('supplier','Controller@supplier')->name('supplier');
Route::get('supplierdelete/{id}','Controller@supplierdelete')->name('supplierdelete');

Route::get('deleteevent/{id}','Controller@deleteevent')->name('deleteevent');

Route::get('leadstatus','Controller@leadstatus');
Route::post('/addleadstatus','Controller@addleadstatus');
Route::get('/leadstatusedit/{id}','Controller@editleadstatus');
Route::post('/updateleadstatus','Controller@updateleadstatus');
Route::get('/leadstatusdelete/{id}','Controller@leadstatusdelete');
Route::get('leadsource','Controller@leadsource');
Route::post('/addleadsource','Controller@addleadsource');
Route::get('/leadsourceedit/{id}','Controller@editleadsource');
Route::post('/updateleadsource','Controller@updateleadsource');
Route::get('/leadsourcedelete/{id}','Controller@leadsourcedelete');
Route::get('industry','Controller@industry');
Route::post('/addindustry','Controller@addindustry');
Route::get('/industryedit/{id}','Controller@editindustry');
Route::post('/updateindustry','Controller@updateindustry');
Route::get('/industrydelete/{id}','Controller@industrydelete');
Route::get('brand','Controller@brand');
Route::post('/addbrand','Controller@addbrand');
Route::get('/brandedit/{id}','Controller@editbrand');
Route::post('/updatebrand','Controller@updatebrand');
Route::get('/branddelete/{id}','Controller@branddelete');
Route::get('categories','Controller@categories');
Route::post('/addcategories','Controller@addcategories');
Route::get('/categoriesedit/{id}','Controller@editcategories');
Route::post('/updatecategories','Controller@updatecategories');
Route::get('/categoriesdelete/{id}','Controller@categoriesdelete');
Route::get('/viewcategories/{id}','Controller@viewcategories');
Route::get('attributes','Controller@attributes');
Route::post('/addattributes','Controller@addattributes');
Route::get('/attributeedit/{id}','Controller@attributeedit');
Route::post('/updateattributes','Controller@updateattributes');
Route::get('/vieweditcategories/{id}/{pid}','Controller@vieweditcategories');
Route::get('/terms/{id}','Controller@terms');
Route::post('/addterms','Controller@addterms');
Route::get('product','Controller@product');
Route::get('/termsedit/{id}','Controller@editterms');
Route::post('/updateterms','Controller@updateterms');


Route::get('dropzone', 'Controller@dropzone');

Route::post('upload', 'Controller@upload')->name('dropzone.upload');

Route::post('media', 'Controller@storeMedia')
  ->name('projects.storeMedia');
Route::post('/addproduct','Controller@addproduct');
Route::get('/productedit/{id}','Controller@editproduct');
Route::post('/updateproduct','Controller@updateproduct');
Route::get('/productdelete/{id}','Controller@productdelete');
Route::get('currency','Controller@currency');
Route::post('/addcurrency','Controller@addcurrency');
Route::get('/currencydelete/{id}','Controller@currencydelete');
Route::post('/getterms','Controller@getterms')->name('getterms');
Route::get('giftcard','Controller@giftcard');
Route::post('/addgiftcard','Controller@addgiftcard');
Route::get('/giftcardedit/{id}','Controller@editgiftcard');
Route::post('/updategiftcard','Controller@updategiftcard');
Route::get('/giftcarddelete/{id}','Controller@giftcarddelete');
Route::get('discount','Controller@discount');
Route::post('/adddiscount','Controller@adddiscount');
Route::get('/discountedit/{id}','Controller@editdiscount');
Route::post('/updatediscount','Controller@updatediscount');
Route::get('/discountdelete/{id}','Controller@discountdelete');
Route::get('customer','Controller@customer');
Route::post('/addcustomer','Controller@addcustomer');
Route::get('/customeredit/{id}','Controller@editcustomer');
Route::post('/updatecustomer','Controller@updatecustomer');
Route::get('/customerdelete/{id}','Controller@customerdelete');

Route::get('importproduct','ImportExportController@importExportView')->name('importproduct');
Route::post('import','ImportExportController@import')->name('import');
Route::post('updateimport','ImportExportController@updateimport')->name('updateimport');

Route::post('export','ImportExportController@export')->name('export');
Route::get('importpriceproduct','ImportExportController@importproductpriceview')->name('importpriceproduct');
Route::post('importproductpricedata','ImportExportController@importproductpricedata')->name('importproductpricedata');



Route::get('paywithpaypal', 'PaymentController@index');
Route::post('updatepaymentgatewaykeys', 'Controller@updatepaymentgatewaykeys');


// route for processing payment
Route::post('paypal', 'PaymentController@payWithpaypal');

// route for check status of the payment
Route::get('status', 'PaymentController@getPaymentStatus');

Route::get('paywithrazorpay', 'RazorpayController@create')->name('paywithrazorpay');
Route::post('payment', 'RazorpayController@payment')->name('payment');
Route::get('plugin', 'Controller@plugin')->name('plugin');
Route::post('addplugin', 'Controller@addplugin')->name('addplugin');
Route::get('setting', 'Controller@setting')->name('setting');
Route::post('updatelogo', 'Controller@updatelogo')->name('updatelogo');
Route::post('saveattributedata', 'Controller@saveattributedata')->name('saveattributedata');
Route::post('saveattributevariationdata', 'Controller@saveattributevariationdata')->name('saveattributevariationdata');

Route::get('shipping', 'Controller@shipping')->name('shipping');
Route::get('shippingmethods', 'Controller@shippingmethods')->name('shippingmethods');
Route::post('/addshippingmethod','Controller@addshippingmethod');
Route::get('/shippingmethodedit/{id}','Controller@editshippingmethod');
Route::post('/updateshippingmethod','Controller@updateshippingmethod');
Route::get('/shippingmethoddelete/{id}','Controller@shippingmethoddelete');
Route::post('/addshippingzone','Controller@addshippingzone');
Route::get('/shippingzoneedit/{id}','Controller@editshippingzone');
Route::post('/updateshippingzone','Controller@updateshippingzone');
Route::get('/shippingzonedelete/{id}','Controller@shippingzonedelete');

Route::get('shippingclass', 'Controller@shippingclass')->name('shippingclass');
 Route::post('/addshippingclass','Controller@addshippingclass');
Route::get('/shippingclassedit/{id}','Controller@shippingclassedit');
Route::post('/updateshippingclass','Controller@updateshippingclass');
Route::get('/shippingclassdelete/{id}','Controller@shippingclassdelete');

Route::get('warehouse', 'Controller@warehouse')->name('warehouse');
Route::post('addwarehouse', 'Controller@addwarehouse')->name('addwarehouse');
Route::get('/warehouseedit/{id}','Controller@warehouseedit');
Route::post('/updatewarehouse','Controller@updatewarehouse');
Route::get('/warehousedelete/{id}','Controller@warehousedelete');

Route::get('salesgroup','Controller@salesgroup');
Route::post('/addgroupname','Controller@addgroupname');
Route::get('/groupnameeedit/{id}','Controller@editgroupname');
Route::post('/updategroupname','Controller@updategroupname');
Route::get('/groupnamedelete/{id}','Controller@groupnamedelete');

Route::get('salesuser','Controller@salesuser')->name('salesuser');
Route::post('/addsaleuser','Controller@addsaleuser');
Route::get('/saleuseredit/{id}','Controller@editsaleuser');
Route::post('/updatesaleuser','Controller@updatesaleuser');
Route::get('/saleuserdelete/{id}','Controller@saleuserdelete');


Route::get('crminvoice/{id}','Controller@crminvoice')->name('crminvoice');
Route::post('addcreateinvoice','Controller@addcreateinvoice')->name('addcreateinvoice');

Route::get('invoicePDF/{id}','Controller@invoicePDF')->name('invoicePDF');
Route::get('invoicepdfview','Controller@invoicepdfview')->name('invoicepdfview');
Route::get('proposallistdata','Controller@proposallistdata');
Route::get('/propdatadelete/{id}','Controller@propdatadelete');
Route::get('/propdataedit/{id}','Controller@editleadpropdata');

Route::get('servicecategory','Controller@servicecategory');
Route::post('/addservicecategory','Controller@addservicecategory');
Route::get('/servicecatedit/{id}','Controller@editservicecategory');
Route::post('/updateservicecategory','Controller@updateservicecategory');
Route::get('/servicecatdelete/{id}','Controller@servicecatdelete');
Route::get('/viewservicecat/{id}','Controller@viewservicecat');
Route::get('/viewserviceedit/{id}/{pid}','Controller@viewserviceedit');
Route::get('services','Controller@services');
Route::post('/addservicedata','Controller@addservicedata');
Route::get('/servicedataedit/{id}','Controller@editservicedata');
Route::post('/updateservicedata','Controller@updateservicedata');
Route::get('staff','Controller@staff');
Route::post('/addstaff','Controller@addstaff');
Route::get('/staffedit/{id}','Controller@editstaff');
Route::post('/updatestaff','Controller@updatestaff');
Route::get('/staffdelete/{id}','Controller@staffdelete');
Route::get('duration','Controller@duration');
Route::post('/addduration','Controller@addduration');
Route::get('/durationedit/{id}','Controller@editduration');
Route::post('/updateduration','Controller@updateduration');
Route::get('/durationdelete/{id}','Controller@durationdelete');
Route::get('unitwiseprice','Controller@unitwiseprice')->name('unitwiseprice');

Route::post('/addunit','Controller@addunit');
Route::get('/unitedit/{id}','Controller@editunit');
Route::post('/updateunit','Controller@updateunit');
Route::get('/unitdelete/{id}','Controller@unitdelete');

Route::post('/addunitwiseprice','Controller@addunitwiseprice');
Route::get('/unitwisepriceedit/{id}','Controller@editunitwiseprice');
Route::post('/updateunitwseprice','Controller@updateunitwseprice');
Route::get('/unitwisepricedelete/{id}','Controller@unitwisepricedelete');
Route::post('/getunitprice','Controller@getunitprice')->name('getunitprice');

Route::get('/importlead','Controller@importlead')->name('importlead');
Route::post('/importleaddata','ImportExportController@importleaddata')->name('importleaddata');
Route::post('/exportlead','ImportExportController@exportlead')->name('exportlead');
Route::post('/customproductadd','Controller@customproductadd')->name('customproductadd');
Route::get('/customproductdelete/{id}','Controller@customproductdelete')->name('customproductdelete');
Route::get('/customproductedit/{id}/{proposalid}','Controller@editcustomproduct');
Route::post('/getproducttype','Controller@getproducttype')->name('getproducttype');

Route::get('accessmodule','Controller@accessmodule')->name('accessmodule');

Route::get('deliverysetting', 'Controller@deliverysetting')->name('deliverysetting');
Route::post('adddeliverysetting', 'Controller@adddeliverysetting')->name('adddeliverysetting');
Route::get('/deliveryedit/{id}','Controller@editdeliverysetting');
Route::post('/updatedeliverysetting','Controller@updatedeliverysetting');
Route::get('/deliverydelete/{id}','Controller@deliverydelete');

Route::get('holiday', 'Controller@holiday')->name('holiday');
Route::post('addholiday', 'Controller@addholiday')->name('addholiday');
Route::get('/holidayedit/{id}','Controller@editholiday');
Route::post('/updateholiday','Controller@updateholiday');
Route::get('/holidaydelete/{id}','Controller@holidaydelete');
// });



/////////////website route////////////////////////////

Route::get('register', 'Front@register')->name('front.register');
Route::post('registerdata', 'Front@registerdata')->name('front.registerdata');
Route::get('login', 'Front@login')->name('front.login');
Route::post('logindata', 'Front@logindata')->name('front.logindata');
Route::get('signout','Front@signout')->name('front.signout');
Route::get('myaccount','Front@myaccount')->name('front.myaccount');

Route::get('/', 'Front@home')->name('front.home');
Route::get('/product/{id}', 'Front@product')->name('front.product');
Route::get('productdetail/{id}', 'Front@productdetail')->name('front.productdetail');
Route::get('addtocart/{id}/{userid}/{varient_id}', 'Front@addtocart')->name('front.addtocart');
Route::get('cartlist/{userid}', 'Front@cartlist')->name('front.cartlist');
Route::get('cart', 'Front@cart')->name('front.cart');
Route::get('checkout', 'Front@checkout')->name('front.checkout');
Route::get('addtowishlist/{id}/{userid}', 'Front@addtowishlist')->name('front.addtowishlist');
Route::get('wishlist/{userid}', 'Front@wishlist')->name('front.wishlist');
Route::get('wishlistdata', 'Front@wishlistdata')->name('front.wishlistdata');
Route::post('placeorder', 'Front@placeorder')->name('front.placeorder');
Route::post('addrating', 'Front@addrating')->name('front.addrating');
Route::get('getsubcategory', 'Front@getsubcategory')->name('front.getsubcategory');

Route::get('rmemovecartitem/{cart_id}', 'Front@rmemovecartitem')->name('front.rmemovecartitem');
Route::post('getdetailproduct', 'Front@getdetailproduct')->name('front.getdetailproduct');

Route::post('getpricerange','Front@getpricerange')->name('front.getpricerange');
Route::post('getdetailattribute','Front@getdetailattribute')->name('front.getdetailattribute');
Route::post('coupenapply','Front@coupenapply')->name('front.coupenapply');
Route::post('coupencheck/{userid}','Front@coupencheck')->name('front.coupencheck');

Route::get('getorderdetail','Front@getorderdetail')->name('front.getorderdetail');
Route::post('getsingleattribute','Front@getsingleattribute')->name('front.getsingleattribute');
Route::get('aboutus','Front@aboutus')->name('front.aboutus');
