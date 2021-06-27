<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class Front extends BaseController
{
   
    public function register(Request $request)
    {
       return view('front.register');
    }
    public function aboutus(Request $request)
    {
       return view('front.aboutus');
    }
    public function registerdata(Request $request)
    {
         $newarray = array(
                
                'first_name'  => $request->fname,
                'last_name'  => $request->lname,
                'email'  => $request->email,
                'password'  => $request->psw,
                'mobile'  => $request->mobile
             );
      
        $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/register";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);
        
        if($result->response == 'success')
        {
            return redirect('login')->with('success_message', 'Register successfully');
        }else
        {
            return redirect('register')->with('error_message', $result->message);
        }
       
    }
    public function login(Request $request)
    {
         return view('front.login');
    }
    public function logindata(Request $request)
    {
        $newarray = array(
                
                'mobile'  => $request->mobiledata,
                'password'  => $request->paasword
             );
      
        $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/login";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);
       
        if($result->response == 'success')
        {
            $info = array(
                    'user_id' => $result->user_id,
                    'name'    => $result->name,
                    'email'   => $result->email
                    
           );
            $request->session()->put($info);
            return redirect('/')->with('success_message', 'Login successfully');
        }else
        {
            return redirect('/')->with('error_message', $result->message);
        }
        
    }
    public function getorderdetail(Request $request)
    {
        $setting = $this->setting();
        $currency = $setting->data->currency;
        $newarray = array(
                
                 'orderid'  => $request->orderid,
              );
      
        $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/orderdatasingle";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);
       
        $html = '';
        
         $html .= '<div class="modal-dialog modalacc_doc" role="document">
                        <div class="modal-content modalacc_content">
                           <div class="modal-header">
                              <h5 class="modal-title modal_head" id="exampleModalLabel"><i class="fa fa-map-marker" style="color: #dc4146;"></i> View Order</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body" style="padding: 30px 20px 20px 40px">
                              <div class="">
                                 <div class="row">
                                     
                                    <div class="col-lg-4 col-md-6">
                                       <p style="font-weight: 500;font-size: 15.5px;"> <i class="fa fa-angle-double-right" style="color: #dc4146;"></i> Delivery Address:</p>
                                       <p class="myaccount_para3">'.$result->data->paymentstatus.'</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                       <p style="font-weight: 500;font-size: 15.5px;"><i class="fa fa-angle-double-right" style="color: #dc4146;"></i>  Payment Info : '.$result->data->paymentmethod.'</p>
                                       <p class="myaccount_para4">Status : <span style="color: #dc4146;">Ready for Dispatch</span></p>
                                       <p class="myaccount_para">Mode :'.$result->data->paymentmethod.'</p>
                                       
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                       <p style="font-weight: 500;font-size: 15.5px;"><i class="fa fa-angle-double-right" style="color: #dc4146;"></i> Order Summary :</p>
                                       <p class="myaccount_para4">Total : <span style="float: right;">'.$currency.'.'.$result->data->total_amount.'</span></p>
                                       <hr style="border-bottom: 8px solid #F6F6F6">
                                    </div>
                                    <div class="col-xl-12">
                                       <button class="myaccount_cancel">Cancel</button>
                                    </div>
                                    
                                 </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-md-1"><b>#</b></div>
                                      <div class="col-md-4"><b>Product Image</b></div>
                                      <div class="col-md-4"><b>Product</b></div>
                                      <div class="col-md-3"><b>Qty</b></div>
                                    </div>
                                    <hr>
                                    <div class="row">';
                                    foreach($result->data->product_details as $key => $product)
                                    {
                                        
                                    $keydata =$key + 1;
                            $html .= '<div class="col-md-1">'.$keydata.'</div>
                                      <div class="col-md-4"><img src="'.$product->product_image.'" style="width:100px;height:100px"></div>
                                      <div class="col-md-4">'.$product->productname.'</div>
                                      <div class="col-md-3">'.$product->qty.'</div>';
                                    }
                        $html .= '</div>
                              </div>
                           </div>
                        </div>
                     </div>';
        
       return response()->json(['html' => $html]);
    }
    public function signout(Request $request)
    {
        $info = array(
                    'user_id' =>'',
                    'mobile'    => '',
                    'password'   => '',
           );
        $request->session()->forget($info); 
        Session()->flush();
        return redirect()->back();
    }
    public function myaccount(Request $request)
    {
       $newarray = array(
                
                 'user_id'  => session('user_id'),
              );
      
        $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/orderfetch";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);
       
        return view('front.myaccount',['orderfetch' => $result->data]);
    }
    public function getsubcategory(Request $request)
    {
         $handle = curl_init();
            $newarray = array(
                
                 'category'  => $request->category_id,
              );
      
        $fields_string = http_build_query($newarray);      
        $url = config('global.fronturl')."api/subcategories";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);
        $html = '';
        
        foreach($result->data as $data)
        {
          $html .=  '<div class="Header__subCategoryDetailsHeader"><i class="fa fa-angle-double-right"></i>  '.$data->name.'</div>';
        }
        echo $html;
    }
    public function home(Request $request)
    {
      
      // $newarray = array(
                
      //           'user_id'  => '5e946a512afb8914634abd61',
      //        );
      
        // $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/categories";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        // curl_setopt($handle,CURLOPT_POST, true);
        // curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);


        // $newarray = array(
                
      //           'user_id'  => '5e946a512afb8914634abd61',
      //        );
      
        // $fields_string = http_build_query($newarray);
        $handle2 = curl_init();
                  
        $url2 = config('global.fronturl')."api/product";
        
  
        curl_setopt($handle2, CURLOPT_URL, $url2);
        // curl_setopt($handle,CURLOPT_POST, true);
        // curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle2, CURLOPT_RETURNTRANSFER, true);
   
        $output2 = curl_exec($handle2);
     
   
        curl_close($handle2);

        $productresult =  json_decode($output2);
        
        
        $handle3 = curl_init();
                  
        $url3 = config('global.fronturl')."api/categorywithproduct";
        
  
        curl_setopt($handle3, CURLOPT_URL, $url3);
        // curl_setopt($handle,CURLOPT_POST, true);
        // curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle3, CURLOPT_RETURNTRANSFER, true);
   
        $output3 = curl_exec($handle3);
     
   
        curl_close($handle3);

        $productcategoryresult =  json_decode($output3);
        $category = null;$product = null;
        if(isset($result->data))
        {
            $category  = $result->data;
        }
        if(isset($productresult->data))
        {
            $product  = $productresult->data;
        }
        if(isset($productcategoryresult->data))
        {
            $productcategory  = $productcategoryresult->data;
        }
       
        return view('front.home',['category' => $category,'product' => $product,'steelproduct' => $product,'productcategory' => $productcategory]);
    }
    public function product(Request $request)
    {
        $newarray = array(
                
                 'category'  => $request->id,
              );
      
        $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/categorywiseproduct";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);
       
        return view('front.product',['productwisecategory' => $result->data,'min' => 0,'max' =>  1000]);
    }
    public function productdetail(Request $request)
    {
       
         $newarray = array(
                
                 'product'  => $request->id,
              );
      
        $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/getproduct";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
       
   
        curl_close($handle);

        $result =  json_decode($output);
    //  echo '<pre>'; print_r($result);die;
        return view('front.productdetail',['productdetails' => $result->data,'releted_products' => $result->releted_products]);
        
    }
    public function addtocart(Request $request)
    {
       
        if(isset($request->quantity))
        {
           $quantity = $request->quantity;
        }else
        {
           $quantity = 1;
        }
        $newarray = array(
                
                 'product'  => $request->id,
                 'userid'  => $request->userid,
                 'quantity' => $quantity,
                 'varient_id' => $request->varient_id
              );
        
        $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/addtocart";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
        
        curl_close($handle);
        
        $result =  json_decode($output);
        
        if($result->response == 'success')
        {
             return redirect()->back()->with('success_message','Product added to cart sucessfully.');
        }else
        {
             return redirect()->back()->with('error_message','Product already added to cart.');
        }
      
    }
    public static function  cartlist($userid)
    {
        $newarray = array(
                 'userid'  => $userid,
              );
    
        $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/showcart";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
       
        curl_close($handle);

        $result =  json_decode($output);
     
        return $result;
    }
    public static function  banner()
    {
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/bannerimages";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);
        if(isset($result->data))
        {
            return $result->data;
        }else
        {
            return array();
        }
        
       
    }
    public function cart()
    {
       return view('front.cart');
    }
    public function checkout()
    {
       // $newarray = array(
                
      //           'user_id'  => '5e946a512afb8914634abd61',
      //        );
      
        // $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/countries";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        // curl_setopt($handle,CURLOPT_POST, true);
        // curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);
       return view('front.checkout',['countries' => $result->data]);
    }
    public function placeorder(Request $request)
    {
        //  $newarray = array(
        //                 "user_id" => session('user_id'),
        //                 "shippingname"  => $request->shippingname,
        //                 "shippingflatno"  => $request->shippingflatno,
        //                 "shippinglandmark"  => $request->shippinglandmark,
        //                 "shippingpincode"  => $request->shippingpincode,
        //                 "shippingcity"  => $request->shippingcity,
        //                 "shippingstate" => $request->shippingstate,
        //                 "shippingcountry" => $request->shippingcountry,
        //                 "billingname" => $request->billingname,
        //                 "billingmobile" => $request->billingmobile,
        //                 "billingaddress" => $request->billingaddress,
        //                 "billingpincode" => $request->billingpincode,
        //                 "billingcity" => $request->billingcity,
        //                 "billingstate" => $request->billingstate,
        //                 "billingcountry" => $request->billingcountry,
        //       );
        $shipping = $request->shippingflatno.''.$request->shippinglandmark.''.$request->shippingcity.''.$request->shippingpincode.''.$request->shippingstate.''.$request->shippingcountry;
        $billing = $request->billingflatno.''.$request->billinglandmark.''.$request->billingcity.''.$request->billingpincode.''.$request->billingstate.''.$request->billingcountry;
        $payemntstatus = '';
        if($request->payment_method == 'cash')
        {
            $payemntstatus = 'pending';
        }
         $newarray = array(
                        "user_id" => session('user_id'),
                        "orderdate"  => date('Y-m-d'),
                        "billing_address"  => $billing,
                        "shipping_address"  => $shipping,
                        "payment_method"  => $request->payment_method,
                        "payment_status"  => $payemntstatus,
                        "order_status" => "pending",
                        "delivery_status" => "pending",
                        "shipping_charges" => "10",
                        "total_amount" => $request->total,
                        "payment_id" =>"",
                        "cart_ref_id" => $request->cart_id
                       
              );
        $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/addorder";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
      
   
        curl_close($handle);

        $result =  json_decode($output);
      
        if($result->response == 'success')
        {
            
            $cartdelete = ['cart_ref_id' => $request->cart_id];
            $fields_string = http_build_query($cartdelete);
            $handle = curl_init();
                      
            $url = config('global.fronturl')."api/deletecartwhole";
            
      
            curl_setopt($handle, CURLOPT_URL, $url);
            curl_setopt($handle,CURLOPT_POST, true);
            curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
      
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
       
            $output = curl_exec($handle);
          
       
            curl_close($handle);
    
            $result =  json_decode($output);
            
            return redirect('/')->with('success_message', 'Order Place Suceesfully');
        }else
        {
            return redirect('/')->with('error_message', 'Order Not Place ');
        }
       
    }
    public function addrating(Request $request)
    {
         $newarray = array(
                "user_id" => session('user_id'),
                'productid' => $request->pid,
                'rating'  => $request->rating,
                'comment'  => $request->comment
             );
      
        $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/addrating";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);
        
       if($result->response == 'success')
        {
            return redirect()->back()->with('success_message', 'Rating added successfully');
        }else
        {
            return redirect()->back()->with('error_message', $result->message);
        }
    }
    public function addtowishlist(Request $request)
    {
         $newarray = array(
                
                 'product'  => $request->id,
                 'userid'  => $request->userid,
              );
      
        $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/addwishlist";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);
        if($result->code == 200)
        {
             return redirect()->back()->with('success_message', 'Item added to wishlist successfully.');
        }else if($result->code == 400)
        {
            return redirect()->back()->with('error_message', 'Item already in wishlist.');
        }else
        {
            return redirect()->back()->with('error_message', 'Something went wrong.');
        }
       
    }
    public static function  wishlist($userid)
    {
        $newarray = array(
                 'userid'  => $userid,
              );
    
        $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/wishlist";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);
    //   echo '<pre>'; print_r($result);die;
        return $result;
    }
    public static function  attributelist()
    {
        
        $handle = curl_init();
         
        $url = config('global.fronturl')."api/attributelist";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);
    //   echo '<pre>'; print_r($result);die;
        return $result;
    }
     public static function termlist($attribute_id)
    {
        
        $handle = curl_init();
        $newarray = array(
                
                 'attribute_id'  => $attribute_id,
        );
        $fields_string = http_build_query($newarray);           
        $url = config('global.fronturl')."api/termlist";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
  
        curl_close($handle);

        $result =  json_decode($output);
    //   echo '<pre>'; print_r($result);die;
        return $result;
    }
    public static function  category()
    {
       
      
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/category";
        
       
        curl_setopt($handle, CURLOPT_URL, $url);
       
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);
        
        
        $result =  json_decode($output);
       
    
       
        if(isset($result))
        {
            return $result;
        }else
        {
            return array();
        }
    }
    public static function  brand()
    {
       
      
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/brand";
        
       
        curl_setopt($handle, CURLOPT_URL, $url);
       
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);
        
        
        $result =  json_decode($output);
       
    
       
        if(isset($result))
        {
            return $result;
        }else
        {
            return array();
        }
    }
    public function wishlistdata()
    {
       return view('front.wishlist');
    }
    public function rmemovecartitem(Request $request)
    {
        
         $newarray = array(
                 'cart_id'  => $request->cart_id,
              );
    
        $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/deletecart";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);
    
        if($result->response == 'success')
        {
             return redirect()->back()->with('success_message', 'Item remove from cart successfully.');
        }else
        {
             return redirect()->back()->with('error_message', 'Item not remove from cart.');
        }
        return $result;
    }
    public function getdetailproduct(Request $request)
    {
        $setting = $this->setting();
        $currency = $setting->data->currency;
        $newarray = array(
                
                 'category'  => $request->subcat_id,
              );
        
        $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/categorywiseproduct";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);
        $html = '';
        if(isset($result->data))
        {
          foreach($result->data as $data)
          {
            $html .= '<div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="product-grid3">
                                <div class="product-image3">
                                    <a href="#">
                                        <img class="pic-1" src="'.$data->product_media.'">
                                        <img class="pic-2" src="'.$data->product_media.'">
                                    </a>
                                    <ul class="social">
                                        <li>';
                                    if(session('user_id') != '')
                                    {
                            $html.=     '<a href="'.route('front.addtowishlist',['id' => $data->id,'userid' => session('user_id')]).'"><i class="fa fa-heart"></i></a>';
                                    }else{
                            $html.= '<a href="#" ><i class="fa fa-heart"></i></a    >';
                                   }
                            $html.= '</li>
                                        <li>';
                                    if(session('user_id') != '')
                                    {
                            $html.=     '<a href="'.route('front.addtocart',['id' => $data->id,'userid' => session('user_id'),'varient_id' => 0]).'"><i class="fa fa-shopping-cart"></i></a>';
                                    }else{
                            $html.= '<a href="#" ><i class="fa fa-shopping-cart"></i></a    >';
                                   }
                            $html.= '</a></li>
                                    </ul>
                                    <span class="product-new-label">New</span>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="#">'.$data->product_name.'</a></h3>';
                                    if(isset($data->regular_price))
                                    {
                            $html.=     '<div class="price">
                                            '.$currency.'.'.$data->sale_price.'
                                        </div>';
                                    }
                                    if(isset($data->sale_price))
                                    {
                            $html.=     '<div class="price"><del>
                                        '.$currency.'.'.$data->sale_price.'
                                        </del></div>'; 
                                    }
                            $html.= '<ul class="rating">
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star disable"></li>
                                        <li class="fa fa-star disable"></li>
                                    </ul>
                                </div>
                            </div>
                       </div>';
            
          }
          
        }
    
        return response()->json(['html' => $html]);
    }
    public static function  setting()
    {
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/setting";
        
       
        curl_setopt($handle, CURLOPT_URL, $url);
       
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
    
        curl_close($handle);
        
        
        $result =  json_decode($output);
       
    
     
        if(isset($result))
        {
            return $result;
        }else
        {
            return array();
        }
    }
    public function getpricerange(Request $request)
    {
        $handle = curl_init();
        $newarray = array(
                
                 'minprice'  => $request->min_price,
                 'maxprice' => $request->max_price
              );
        $fields_string = http_build_query($newarray);
        $url = config('global.fronturl')."api/getproductlistwithprice";
        
       
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
        curl_close($handle);
        
        
        $result =  json_decode($output);
        return view('front.product',['productwisecategory' => $result->data,'min' => $request->min_price,'max' =>  $request->max_price]);
    }
    public function getdetailattribute(Request $request)
    {
        $setting = $this->setting();
        $currency = $setting->data->currency;
        $newarray = array(
                
                 'termid'  => implode(',',$request->termid),
              );
        
        $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = config('global.fronturl')."api/attributeget";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);
        
        $html = '';
        if(isset($result->data))
        {
          foreach($result->data as $data)
          {
            $html .= '<div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="product-grid3">
                                <div class="product-image3">
                                    <a href="#">
                                        <img class="pic-1" src="'.$data->attribute_image.'">
                                        <img class="pic-2" src="'.$data->attribute_image.'">
                                    </a>
                                    <ul class="social">
                                        <li>';
                                    if(session('user_id') != '')
                                    {
                            $html.=     '<a href="'.route('front.addtowishlist',['id' => $data->product_id,'userid' => session('user_id')]).'"><i class="fa fa-heart"></i></a>';
                                    }else{
                            $html.= '<a href="#" ><i class="fa fa-heart"></i></a    >';
                                   }
                            $html.= '</li>
                                        <li>';
                                    if(session('user_id') != '')
                                    {
                            $html.=     '<a href="'.route('front.addtocart',['id' => $data->product_id,'userid' => session('user_id'),'varient_id' => $data->varinet_id]).'"><i class="fa fa-shopping-cart"></i></a>';
                                    }else{
                            $html.= '<a href="#" ><i class="fa fa-shopping-cart"></i></a    >';
                                   }
                            $html.= '</a></li>
                                    </ul>
                                    <span class="product-new-label">New</span>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="#">'.$data->product_name.'</a></h3>';
                                    if(isset($data->attrprice))
                                    {
                            $html.=     '<div class="price">
                                            '.$currency.'.'.$data->attrprice.'
                                        </div>';
                                    }
                                   
                            $html.= '<ul class="rating">
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star disable"></li>
                                        <li class="fa fa-star disable"></li>
                                    </ul>
                                </div>
                            </div>
                       </div>';
            
          }
          
        }
    
        return response()->json(['html' => $html]);
    }
    
    public function coupenapply(Request $request)
    {
        $handle = curl_init();
        $newarray = array(
                
                 'cart_ref_id'  => $request->cart_ref_id,
                 'total' => $request->total,
                 'discount_code' => $request->discount_code,
              );
        $fields_string = http_build_query($newarray);
        $url = config('global.fronturl')."api/applydiscountcoupen";
        
       
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
        curl_close($handle);
        
        
        $result =  json_decode($output);
        if($result->response == 'success')
        {
             return redirect()->back()->with('success_message', 'Coupen apply successfully.');
        }else
        {
            return redirect()->back()->with('error_message', 'Coupen not apply.');
        }
    }
    
    public static function coupencheck($userid)
    {
        $cart_ref = 'CART_0'.$userid;
        $handle = curl_init();
        $newarray = array(
                'cart_ref_id'  =>$cart_ref,
             );
        $fields_string = http_build_query($newarray);          
        $url = config('global.fronturl')."api/coupencheck";
        
       
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);
        
        
        $result =  json_decode($output);
       
    
      
        if(isset($result))
        {
            return $result;
        }else
        {
            return array();
        }  
    }
    
    public function getsingleattribute()
    {
        $handle = curl_init();
        $newarray = array(
                
                 'termid'  => $request->terms,
               );
        $fields_string = http_build_query($newarray);
        $url = config('global.fronturl')."api/singleattribute";
        
       
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
        curl_close($handle);
        
        
        $result =  json_decode($output);
        print_r($result);die;
    }
}
