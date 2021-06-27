<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
// use Firebase\JWT\JWT;
use session;

class Api extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    function register(Request $request)
    {
       
        $data = json_decode(file_get_contents("php://input"));
        $enocde = base64_encode($request->first_name.$request->last_name.$request->email);
        $exist = DB::table('user')->where(array('mobile' => $request->mobile))->first();
        if($exist != '')
        {
            
                http_response_code(200);
                echo json_encode(array("response" => "failed","message" => "Mobile Number allready exist."));
            
        }else
        {
           
            $info = array(
                            'firstName' => $request->first_name,
                            'lastName' => $request->last_name,
                            'email'    => $request->email,
                            'password' => $request->password,
                            'mobile'   => $request->mobile,
                            'token'    => $enocde, 
                            'usertype' => 'simple',
                            'lat' => $request->lat,
                            'lng' => $request->lng
                           
                        );
                        
                 
            $insert = DB::table('user')->insert($info);
            if($insert == 1)
            {
                http_response_code(200);
                echo json_encode(array("response" => "success","message" => "User registered successfully ."));
            }else
            {
                http_response_code(200);
                echo json_encode(array("response" => "failed","message" => "User registered successfully ."));
            }
        }
        
    }
    function bannerimages()
    {
         $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
        
        $banners = DB::table('banner')->get();
        $info = array();
        foreach($banners as $banner)
        {
            $mobileimage = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$banner->document;
            $webisteimage = $link.'/'.config('global.finalurl').'/public/banner/'.$banner->document;
            $newarray = array(
                        'title' => $banner->title,
                        'mobilebanner' => $mobileimage,
                        'websitebanner' => $webisteimage
                );
            
            array_push($info,$newarray);
        }
        echo json_encode(array("response" => "success","data" => $info));
           
    }
    function checkoutcard(Request $request)
    {
        
        
        $payment = array(
				
				'amount' => $request->amount,
				'currency' => $request->currency,
				'reference' => "ORD-5023-4E89"
			);
            $payment['source'] = array(
                    'type'  => 'token',
                    'token' => $request->token
                 );
            
            // print_r(json_encode($payment));die;
            
             $fields_string = http_build_query($payment);
            $handle2 = curl_init();
                      
            $url2 = "https://api.sandbox.checkout.com/payments";
            
            curl_setopt($handle2, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: sk_test_b3b0c614-4cb0-448d-9533-b872ea5adb69'
            ));
            curl_setopt($handle2, CURLOPT_URL, $url2);
            curl_setopt($handle2,CURLOPT_POST, true);
            curl_setopt($handle2,CURLOPT_POSTFIELDS, json_encode($payment));
            
            curl_setopt($handle2, CURLOPT_RETURNTRANSFER, true);
            
            $output2 = curl_exec($handle2);
            
            // $result2 =  json_decode($output2);
            
            
            curl_close($handle2);
            echo $output2;
    }
    function attributelist()
    {
        $attributes = DB::table('tbl_attribute')->get();
        
        http_response_code(200);
        echo json_encode(array("response" => "success","message" => "Data fetched successfully .","data" =>$attributes));
            
    }
    function termlist(Request $request)
    {
        $terms = DB::table('attribute_terms')->where(['attributeid' => $request->attribute_id])->get();
        
        http_response_code(200);
        echo json_encode(array("response" => "success","message" => "Data fetched successfully .","data" =>$terms));
            
    }
    function singleattribute(Request $request)
    {
         
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
        $implodeval = $request->termid;
        $terms = DB::table('tbl_product_varient')->where(['term_id' => $implodeval])->first();
        if(isset($terms))
        {
            $product = DB::table('tbl_product')->where(['id' => $terms->product_id])->first();
                  
        $info = array(
                        'product_id' => $terms->product_id,
                        'varinet_id' =>  $terms->id,
                        'product_name' => $product->product_name,
                        'attribute_quantity' => $terms->attribute_quantity,
                        'sku' => $terms->sku,
                        'attrprice'=> $terms->attrprice,
                        'attribute_image' =>  $link.'/'.config('global.finalurl').'/public/productimg/'.$terms->attribute_image
            
            );
         echo 
        json_encode(array("response" => "success","message" => "data fetch successfully .","data" => $info));
        }else
        {
            echo 
            json_encode(array("response" => "failed","message" => "data not fetch  .","data" => array()));
        }
       
    }
    function attributeget(Request $request)
    {
        // $termsvalueinputdata = explode(',',$request->termid);
        
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
        $terms = DB::table('tbl_product_varient')->get();
        $productarray = array();
        foreach($terms as $termsval)
        {
            $explodeval = explode(',',$termsval->term_id);
            $termsvalueinputdata = explode(',',$request->termid);
            // print_r($explodeval);print_r($termsvalueinputdata);die;
            foreach($termsvalueinputdata as $termsvalueinput)
            {
                if(in_array($termsvalueinput,$explodeval))
                {
                    $product = DB::table('tbl_product')->where(['id' => $termsval->product_id])->first();
                  
                    $info = array(
                                    'product_id' => $termsval->product_id,
                                    'varinet_id' =>  $termsval->id,
                                    'product_name' => $product->product_name,
                                    'attribute_quantity' => $termsval->attribute_quantity,
                                    'sku' => $termsval->sku,
                                    'attrprice'=> $termsval->attrprice,
                                    'attribute_image' =>  $link.'/'.config('global.finalurl').'/public/productimg/'.$termsval->attribute_image
                        
                        ); 
                if(array_search($termsval->id, array_column($productarray, 'varinet_id')) !== false) {
                            
                        }
                        else {
                             array_push($productarray,$info);
                        }
                   
                       
                    
                    // if(!in_array($productarray['product_id'], ))
                    // {
                        
                    // }
                        
                    
                    
                }else
                {
                  
                }
            }
        }
        
        echo 
        json_encode(array("response" => "success","message" => "data fetch successfully .","data" => $productarray));
    }
    function category()
    {
        $info = DB::table('tbl_categories')->where(array('pid' => 0))->get();
      
        $finalroot = array();
        foreach($info as $infodata)
        {
            $data = DB::table('tbl_categories')->where('pid' ,'=', $infodata->id)->get();
            $subarray = array();
            
            foreach($data as $dataval)
            {
               
                $infotwo = array(
                            'subcategory' => $dataval->name,
                            'subcategoryid' => $dataval->id
                    );
                    array_push($subarray,$infotwo);
            }
            $final = array(
                        'catgory' => $infodata->name,
                        'categoryid' => $infodata->id,
                         'subcategory' => $subarray
                    );
            array_push($finalroot,$final);
        }
         echo json_encode(
                array(
                    "response" => "success",
                    "data" => $finalroot,
                   
                    
                ));
    }
    
  
    function login(Request $request)
    {
        $data = json_decode(file_get_contents("php://input"));
        $info = array(
                        'mobile' => $request->mobile,
                        'password' => $request->password
                    );
                    
        $check = DB::table('user')->where($info)->first();
        
        if($check != '')
        {
            $id = $check->id;
            $firstname = $check->firstName;
            $lastname  = $check->lastName;
            $password  = $check->password;
            
        if($password == $request->password)
        {
            
            echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Successful login.",
                    "token" =>  $check->token,
                    "email" => $check->email,
                    "user_id" => $check->id,
                    "name" => $check->firstName.' '.$check->lastName
                ));
        }else{
    
            http_response_code(401);
            echo json_encode(array("response" => "failed","message" => "Password Not Match."));
            }
        }
        else{
    
            http_response_code(401);
            echo json_encode(array("response" => "failed","message" => "Login failed."));
        }
    }
    function getproduct(Request $request)
    {
         $product = DB::table('tbl_product')->where(array('id' => $request->product))->first();
         $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
        
       
            $newdataarray = array();
                if($product->product_media != '')
                {
                    $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$product->product_media;
                   
                }else
                {
                    $image = '';
                }
                if($product->product_gallery != '')
                {
                    $explodegallery = explode(',',$product->product_gallery);
                    $productgallery = array();
                    foreach($explodegallery as $explodegallery)
                    {
                         $gallery = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$explodegallery;
                         array_push($productgallery,$gallery);
                    }
                   $gallery = implode(',',$productgallery);
                   
                }else
                {
                    $gallery = '';
                }
                 $stock = DB::table('stock')->where(array('productid' => $product->id))->first();
                  if($stock != '')
                {
                    $stockqty = $stock->stockqty;
                }else
                {
                     $stockqty = 0;
                }
                
                $shipping = DB::table('tbl_inventory')->where(array('product_id' => $product->id ))->first();
                if($shipping != '')
                {
                    $minqty = $shipping->minqty;
                    $maxqty = $shipping->maxqty;
                }else
                {
                    $minqty = 0;
                    $maxqty = 0;
                }
                $rating = DB::table('tbl_rating')->where(array('pid' => $product->id ))->get();
                    $totrating = 0;
                    foreach($rating as $ratingfinal)
                    {
                        $totrating +=$ratingfinal->rating;
                    }
                    if(count($rating) === 0)
                    {
                        $ratingdata = 0;
                    }else
                    {
                         $ratingdata = $totrating/count($rating);
                    }
                if($product->sale_start_date < date('Y-m-d') && $product->sale_end_date > date('Y-m-d'))
                {
                    $saleprice =  $product->sale_price;
                }else
                {
                    $saleprice =  0;
                }
                $productattributes = DB::table('tbl_product_attribute')->where(array('product_id' => $product->id ))->get();
                $attributearray = [];
                foreach($productattributes as $productattribute)
                {
                    $attribute =  DB::table('tbl_attribute')->where(array('id' => $productattribute->attribute_id ))->first();
                    $termlists = explode(',',$productattribute->term_id);
                    $termarray = [];
                    foreach($termlists as $termlist)
                    {
                        $termsdetails = DB::table('attribute_terms')->where(array('id' =>$termlist))->first();
                        $infonew = array(
                                    'term_id' => $termlist,
                                    'term' => $termsdetails->name
                                );
                        array_push($termarray,$infonew);
                    }
                    $final = array(
                                'attribute_id' => $productattribute->id, 
                                'attribute' => $attribute->name,
                                'terms' => $termarray
                            );
                    array_push($attributearray,$final);
                }
                $info  = array(
                                "id" => $product->id,
                                "product_name" => $product->product_name,
                                "product_description" => $product->product_description,
                                "product_category"=> $product->product_category,
                                "product_detail_page" => $link."/".config('global.finalurl')."/public/frontend/".$product->product_name,
                                "product_brand" =>  $product->product_brand,
                                "product_media" =>   $image,
                                "product_gallery"=> $gallery,
                                "product_type"=> $product->product_type,
                                "regular_price" =>  $product->regular_price,
                                "sale_price" =>  $saleprice,
                                "seo_title" => $product->seo_title,
                                "seo_description" => $product->seo_description,
                                "seo_url" => $product->seo_url,
                                "seo_key"=> $product->seo_key,
                                "download_limit"=> $product->download_limit,
                                "download_file"=> $product->download_file,
                                "download_url"=> $product->download_url,
                                "sale_start_date"=> $product->sale_start_date,
                                "sale_end_date"=> $product->sale_end_date,
                                "download_expiary"=> $product->download_expiary,
                                "up_sell"=> $product->up_sell,
                                "cross_sell"=> $product->cross_sell,
                                "product_url"=> $product->product_url,
                                "btn_txt"=> $product->btn_txt,
                                "taxstatus"=> $product->taxstatus,
                                "minqty" => $minqty,
                                "maxqty" => $maxqty,
                                "instock" => $stockqty,
                                "rating" => $ratingdata,
                                'specification' => $product->specification,
                                'attribute_details' => $attributearray
                                
                            
                        );
               
                array_push($newdataarray,$info);
        $catgroyproducts = DB::table('tbl_product')->where(array('product_category' => $product->product_category))->get();
        $categoryproductarray = [];
        foreach($catgroyproducts as $catgroyproduct)
        {
            if($catgroyproduct->product_media != '')
                {
                    $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$catgroyproduct->product_media;
                   
                }else
                {
                    $image = '';
                }
                if($catgroyproduct->product_gallery != '')
                {
                    $explodegallery = explode(',',$catgroyproduct->product_gallery);
                    $productgallery = array();
                    foreach($explodegallery as $explodegallery)
                    {
                         $gallery = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$explodegallery;
                         array_push($productgallery,$gallery);
                    }
                  $gallery = implode(',',$productgallery);
                   
                }else
                {
                    $gallery = '';
                }
                 $stock = DB::table('stock')->where(array('productid' => $catgroyproduct->id))->first();
                  if($stock != '')
                {
                    $stockqty = $stock->stockqty;
                }else
                {
                     $stockqty = 0;
                }
                
                $shipping = DB::table('tbl_inventory')->where(array('product_id' => $catgroyproduct->id ))->first();
                if($shipping != '')
                {
                    $minqty = $shipping->minqty;
                    $maxqty = $shipping->maxqty;
                }else
                {
                    $minqty = 0;
                    $maxqty = 0;
                }
                $rating = DB::table('tbl_rating')->where(array('pid' => $catgroyproduct->id ))->get();
                    $totrating = 0;
                    foreach($rating as $ratingfinal)
                    {
                        $totrating +=$ratingfinal->rating;
                    }
                    if(count($rating) === 0)
                    {
                        $ratingdata = 0;
                    }else
                    {
                         $ratingdata = $totrating/count($rating);
                    }
                $infodata  = array(
                                "id" => $catgroyproduct->id,
                                "product_name" => $catgroyproduct->product_name,
                                "product_description" => $catgroyproduct->product_description,
                                "product_category"=> $catgroyproduct->product_category,
                                "product_detail_page" => $link."/".config('global.finalurl')."/public/frontend/".$catgroyproduct->product_name,
                                "product_brand" =>  $catgroyproduct->product_brand,
                                "product_media" =>  $image,
                                "product_gallery"=> $gallery,
                                "product_type"=> $catgroyproduct->product_type,
                                "regular_price" =>  $catgroyproduct->regular_price,
                                "sale_price" =>  $catgroyproduct->sale_price,
                                "seo_title" => $catgroyproduct->seo_title,
                                "seo_description" => $catgroyproduct->seo_description,
                                "seo_url" => $catgroyproduct->seo_url,
                                "seo_key"=> $catgroyproduct->seo_key,
                                "download_limit"=> $catgroyproduct->download_limit,
                                "download_file"=> $catgroyproduct->download_file,
                                "download_url"=> $catgroyproduct->download_url,
                                "sale_start_date"=> $catgroyproduct->sale_start_date,
                                "sale_end_date"=> $catgroyproduct->sale_end_date,
                                "download_expiary"=> $catgroyproduct->download_expiary,
                                "up_sell"=> $catgroyproduct->up_sell,
                                "cross_sell"=> $catgroyproduct->cross_sell,
                                "product_url"=> $catgroyproduct->product_url,
                                "btn_txt"=> $catgroyproduct->btn_txt,
                                "taxstatus"=> $catgroyproduct->taxstatus,
                                "minqty" => $minqty,
                                "maxqty" => $maxqty,
                                "instock" => $stockqty,
                                "rating" => $ratingdata
                                
                            
                        );
                array_push($categoryproductarray,$infodata);
        }
       
            echo json_encode(array("response" => "success","code" => "200","data" => $info,"releted_products" => $categoryproductarray));
        
    }
    function getproductlistwithprice(Request $request)
    {
         
         $productlist = DB::select('select * from `tbl_product` where `regular_price` between '.$request->minprice.' AND '.$request->maxprice.' ');
         $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
        $newdataarray = array();
        foreach($productlist as $product)
        {
            
                if($product->product_media != '')
                {
                    $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$product->product_media;
                   
                }else
                {
                    $image = '';
                }
                if($product->product_gallery != '')
                {
                    $explodegallery = explode(',',$product->product_gallery);
                    $productgallery = array();
                    foreach($explodegallery as $explodegallery)
                    {
                         $gallery = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$explodegallery;
                         array_push($productgallery,$gallery);
                    }
                   $gallery = implode(',',$productgallery);
                   
                }else
                {
                    $gallery = '';
                }
                 $stock = DB::table('stock')->where(array('productid' => $product->id))->first();
                  if($stock != '')
                {
                    $stockqty = $stock->stockqty;
                }else
                {
                     $stockqty = 0;
                }
                
                $shipping = DB::table('tbl_inventory')->where(array('product_id' => $product->id ))->first();
                if($shipping != '')
                {
                    $minqty = $shipping->minqty;
                    $maxqty = $shipping->maxqty;
                }else
                {
                    $minqty = 0;
                    $maxqty = 0;
                }
                $rating = DB::table('tbl_rating')->where(array('pid' => $product->id ))->get();
                    $totrating = 0;
                    foreach($rating as $ratingfinal)
                    {
                        $totrating +=$ratingfinal->rating;
                    }
                    if(count($rating) === 0)
                    {
                        $ratingdata = 0;
                    }else
                    {
                         $ratingdata = $totrating/count($rating);
                    }
                if($product->sale_start_date < date('Y-m-d') && $product->sale_end_date > date('Y-m-d'))
                {
                    $saleprice =  $product->sale_price;
                }else
                {
                    $saleprice =  0;
                }
               
                $info  = array(
                                "id" => $product->id,
                                "product_name" => $product->product_name,
                                "product_description" => $product->product_description,
                                "product_category"=> $product->product_category,
                                "product_detail_page" => $link."/".config('global.finalurl')."/public/frontend/".$product->product_name,
                                "product_brand" =>  $product->product_brand,
                                "product_media" =>   $image,
                                "product_gallery"=> $gallery,
                                "product_type"=> $product->product_type,
                                "regular_price" =>  $product->regular_price,
                                "sale_price" =>  $saleprice,
                                "seo_title" => $product->seo_title,
                                "seo_description" => $product->seo_description,
                                "seo_url" => $product->seo_url,
                                "seo_key"=> $product->seo_key,
                                "download_limit"=> $product->download_limit,
                                "download_file"=> $product->download_file,
                                "download_url"=> $product->download_url,
                                "sale_start_date"=> $product->sale_start_date,
                                "sale_end_date"=> $product->sale_end_date,
                                "download_expiary"=> $product->download_expiary,
                                "up_sell"=> $product->up_sell,
                                "cross_sell"=> $product->cross_sell,
                                "product_url"=> $product->product_url,
                                "btn_txt"=> $product->btn_txt,
                                "taxstatus"=> $product->taxstatus,
                                "minqty" => $minqty,
                                "maxqty" => $maxqty,
                                "instock" => $stockqty,
                                "rating" => $ratingdata,
                                'specification' => $product->specification
                                
                            
                        );
               
                array_push($newdataarray,$info);
        }
        
        echo json_encode(array("response" => "success","code" => "200","data" => $newdataarray));
        
    }
    function verifytoken(Request $request)
    {
        $info = array(
                        'token' => $request->token,
                       
                    );
        $check = DB::table('user')->where($info)->first();
        
        if($check != '')
        {
         echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Access granted",
                    "first_name" =>  $check->firstName,
                    "last_name" => $check->lastName,
                    "email" => $check->email,
                    
                ));
        }else
        {
            echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Access not granted",
                   
                    
                ));
        }
    }
    function forgotpassword(Request $request)
    {
        if($request->mobile != '' && $request->email == '')
        {
            $exist = DB::table('user')->where(array('mobile' => $request->mobile))->first();
            if($exist != '')
            {
                $otp = rand(1000,9999);
                $update = DB::table('user')->where(array('mobile' => $request->mobile))->update(array('otp' => $otp));
                echo json_encode(
                    array(
                        "response" => "Successfully",
                        "message" => "Otp Sent Successfully",
                        "otp"    => $otp
                       
                        
                    ));
                    
            }else
            {
                echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Mobile not regsitered",
                       
                        
                    ));
            }
            
        }else if($request->email != '' && $request->mobile == '')
        {
            $exist = DB::table('user')->where(array('email' => $request->email))->first();
            if($exist != '')
            {
                $otp = rand(1000,9999);
                $update = DB::table('user')->where(array('email' => $request->email))->update(array('otp' => $otp));
                echo json_encode(
                    array(
                        "response" => "Successfully",
                        "message" => "Otp Sent Successfully",
                        "otp"    => $otp
                       
                        
                    ));
            }else
            {
                echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Email not regsitered",
                       
                        
                    ));
            }
        }else
        {
            $exist = DB::table('user')->where(array('mobile' => $request->mobile))->first();
            
            if($exist != '')
            {
                $otp = rand(1000,9999);
                $update = DB::table('user')->where(array('mobile' => $request->mobile))->update(array('otp' => $otp));
                echo json_encode(
                    array(
                        "response" => "Successfully",
                        "message" => "Otp Sent Successfully",
                        "otp"    => $otp
                       
                        
                    ));
            }else
            {
                echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Mobile not regsitered",
                       
                        
                    ));
            }
        }
        
    }
    function updatepassword(Request $request)
    {
        $exist = DB::table('user')->where(array('otp' => $request->otp))->first();
        if($exist != '')
        {
           if($request->password == $request->confirmpassword)
           {
                $update = DB::table('user')->where(array('otp' => $request->otp))->update(array('password' => $request->password));
                $updatedata = DB::table('user')->where(array('otp' => $request->otp))->update(array('otp' => ''));
                 echo json_encode(
                    array(
                        "response" => "success",
                        "message" => "password updated successfully",
                       
                        
                    ));
           }else
           {
               echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Confirm password not match with password",
                       
                        
                    ));
           }
        }
        else
        {
           echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "OTP not match",
                   
                    
                ));
        }
    }
    function orderdata(Request $request)
    {
        $user = DB::table('user')->where(array('mobile' => $request->mobile,'password' =>$request->password))->first();
        if($user != '')
        {
           $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
            $orderdataresult = DB::table('orderdata')->where(array('userid' => $user->id ))->get();
            $orderdataarray = array();
           
            foreach($orderdataresult as $orderdataresultval)
            {
              
            $orderdetaildata = DB::table('order_detail')->where(array('order_id' => $orderdataresultval->id ))->get();
           
            $rating =  DB::table('tbl_rating')->where(array('user_id' => $user->id ))->get();
            if($orderdetaildata != '')
            {
                $productarray = array();
                foreach($orderdetaildata as $orderdata)
                {
                    $productdata = DB::table('tbl_product')->where(array('id' => $orderdata->productid ))->first();
                   
                    if($productdata != '')
                    {
                        $info = array(
                                'product_id' => $productdata->id,
                                'product_image' => $link.'/'.config('global.finalurl').'/public/thumbnail/'.$productdata->product_media,
                                'productname' =>  $productdata->product_name,
                                'qty'        => $orderdata->qty,
                               );
                        array_push($productarray,$info);
                    }else
                    {
                       
                    }
                    
                    
                }
                $final = array(
                                'id' =>  $orderdataresultval->id,
                                'order_id' => $orderdataresultval->order_id,
                                'orderdate'  => $orderdataresultval->orderdate,
                                'billing_address'    => $orderdataresultval->billing_address,
                                'shipping_address'    => $orderdataresultval->shipping_address,
                                'paymentmethod' => $orderdataresultval->paymentmethod,
                                'paymentstatus' => $orderdataresultval->paymentstatus,
                                'orderstatus'  => $orderdataresultval->orderstatus,
                                'total_amount' => $orderdataresultval->total_amount,
                                'product_details' => $productarray
                                
                            );
                array_push($orderdataarray,$final);
                $ratingarray = array();
                foreach($rating as $rating)
                {
                    $info = array(
                                'productid' =>  $rating->pid,
                                'rating' => $rating->rating,
                                'comment' =>  $rating->comment,
                                );
                    array_push($ratingarray,$info);
                }
                    
                  
            }else
            {
                echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Orderdata not found",
                    ));
            }
            }
            echo json_encode(
                        array(
                            "response" => "success",
                            "message" => "Data fetch Successfully",
                            "data" =>  $orderdataarray,
                            "ratingarray" => $ratingarray
                        ));
            
        }else
        {
            echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Something went wrong",
                        
                    ));
        }
    }
    
    function orderdatasingle(Request $request)
    {
        
           $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
            $orderdataresult = DB::table('orderdata')->where(array('id' => $request->orderid ))->first();
            $orderdataarray = array();
           
            
              
            $orderdetaildata = DB::table('order_detail')->where(array('order_id' => $orderdataresult->id ))->get();
           
            
            if($orderdetaildata != '')
            {
                    $productarray = array();
                    foreach($orderdetaildata as $orderdetail){
                        $productdata = DB::table('tbl_product')->where(array('id' => $orderdetail->productid ))->first();
                       
                        if($productdata != '')
                        {
                            $info = array(
                                    'product_id' => $productdata->id,
                                    'product_image' => $link.'/'.config('global.finalurl').'/public/thumbnail/'.$productdata->product_media,
                                    'productname' =>  $productdata->product_name,
                                    'qty'        => $orderdetail->qty,
                                   );
                            array_push($productarray,$info);
                        }else
                        {
                           
                        }
                    }
                
                $final = array(
                                'id' =>  $orderdataresult->id,
                                'order_id' => $orderdataresult->order_id,
                                'orderdate'  => $orderdataresult->orderdate,
                                'billing_address'    => $orderdataresult->billing_address,
                                'shipping_address'    => $orderdataresult->shipping_address,
                                'paymentmethod' => $orderdataresult->paymentmethod,
                                'paymentstatus' => $orderdataresult->paymentstatus,
                                'orderstatus'  => $orderdataresult->orderstatus,
                                'total_amount' => $orderdataresult->total_amount,
                                'product_details' => $productarray
                                
                            );
                
                
                    
                  
            }else
            {
                echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Orderdata not found",
                    ));
            }
           
            echo json_encode(
                        array(
                            "response" => "success",
                            "message" => "Data fetch Successfully",
                            "data" =>  $final,
                        ));
            
        
    }
    function brand(Request $request)
    {
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
        $check = DB::table('tbl_brand')->get();
         $newdataarray = array();
        foreach($check as $checkdata)
        {
            if($checkdata->image != '')
            {
                $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$checkdata->image;
            }else
            {
                $image = '';
            }
            
            $info  = array(
                        'id' => $checkdata->id,
                        'name' => $checkdata->name,
                        'description' =>$checkdata->description,
                        'image'  => $image,
                        
                    );
            array_push($newdataarray,$info);
        }
        if($check != '')
        {
         echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Data fetch Successfully",
                    "data" =>  $newdataarray,
                    
                    
                ));
        }else
        {
            echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Data not fetch Successfully",
                   
                    
                ));
        }
    }
    function addserviceorder(Request $request)
    {
        $user = DB::table('user')->where(array('mobile' => $request->mobile,'password' =>$request->password))->first();
        if($user != '')
        {
       
            $orderid = rand(1000,9000).'00'.$user->id;
            $info =  array(
                        "order_id" => $orderid,
                        "service_id"    => $request->service_id,
                        "employee_id"  => $request->employee_id,
                        "service_date"  => date('Y-m-d',strtotime($request->service_date)),
                        "user_id"  => $user->id,
                        "timeslot"  => $request->timeslot,
                        "payment_id"  => $request->payment_id,
                        "payment_status"  => $request->payment_status,
                        "payment_method"  => $request->payment_method,
                        "total_amount" => $request->total_amount,
                        
                        
            );
            $result = DB::table('service_order')->insertGetId($info);
            if($result != "")
            {
                $info = DB::table('service_order')->where('id','=',$result)->first();
                echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Service Order Place Successfully",
                    "data" =>$info
                    
                    
                    
                ));
            }else
            {
                echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Service Order Not Place Successfully",
                       
                        
                    ));
            }
        }else
        {
                echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Service Order Not Place Successfully",
                       
                        
                ));
        }
    }
    function categories(Request $request)
    {
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
        
        $check = DB::table('tbl_categories')->where(array('pid' => 0))->get();
        $newdataarray = array();
        foreach($check as $checkdata)
        {
            $subategoryone = DB::table('tbl_categories')->where(array('pid' => $checkdata->id))->get();
            if($checkdata->image != '')
            {
                $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$checkdata->image;
            }else
            {
                $image = '';
            }
            if($checkdata->bannerimage != '')
            {
                $bannerimage = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$checkdata->bannerimage;
            }else
            {
                $bannerimage = '';
            }
            if($subategoryone != '')
            {
                $subcatonearray = array();
                foreach($subategoryone as $subategoryone)
                {
                    $subactegorytwoarray = array();
                    $subategorytwo = DB::table('tbl_categories')->where(array('pid' => $subategoryone->id))->get();
                  
                        if(!$subategorytwo->isEmpty())
                        { 
                            
                            foreach($subategorytwo as $subategorytwo)
                            {
                                if($subategorytwo->image != '')
                                {
                                    $image3 = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$subategorytwo->image;
                                }else
                                {
                                    $image3 = '';
                                }
                                if($subategorytwo->bannerimage != '')
                                {
                                    $bannerimage3 = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$subategorytwo->bannerimage;
                                }else
                                {
                                    $bannerimage3 = '';
                                }
                                $info3 =  array(
                                    'id' => $subategorytwo->id,
                                    'pid' => $subategorytwo->pid,
                                    'name' => $subategorytwo->name,
                                    'description' =>$subategorytwo->description,
                                    'image'  => str_replace(' ','',$image3),
                                    'slug'  => $subategorytwo->slug,
                                    'bannerimage' =>$bannerimage3,
                                    'seo_title' => $subategorytwo->seo_title,
                                    'seo_description' => $subategorytwo->seo_description,
                                    'seo_url' =>$subategorytwo->seo_description,
                                    
                                );
                                array_push($subactegorytwoarray,$info2);
                            }
                        }
                    
                    if($subategoryone->image != '')
                    {
                        $image2 = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$subategoryone->image;
                    }else
                    {
                        $image2 = '';
                    }
                    if($subategoryone->bannerimage != '')
                    {
                        $bannerimage2 = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$subategoryone->bannerimage;
                    }else
                    {
                        $bannerimage2 = '';
                    }
                    $info2 =  array(
                        'id' => $subategoryone->id,
                        'pid' => $subategoryone->pid,
                        'name' => $subategoryone->name,
                        'description' =>$subategoryone->description,
                        'image'  => $image2,
                        'slug'  => $subategoryone->slug,
                        'bannerimage' =>$bannerimage2,
                        'seo_title' => $subategoryone->seo_title,
                        'seo_description' => $subategoryone->seo_description,
                        'seo_url' =>$subategoryone->seo_description,
                        'subcategorytwolevel' => $subactegorytwoarray
                        
                    );
                    array_push($subcatonearray,$info2);
                }
            }
            $info  = array(
                        'id' => $checkdata->id,
                        'pid' => $checkdata->pid,
                        'name' => $checkdata->name,
                        'description' =>$checkdata->description,
                        'image'  => $image,
                        'slug'  => $checkdata->slug,
                        'bannerimage' =>$bannerimage,
                        'seo_title' => $checkdata->seo_title,
                        'seo_description' => $checkdata->seo_description,
                        'seo_url' =>$checkdata->seo_description,
                        'subcategoryonelevel' => $subcatonearray
                    );
            array_push($newdataarray,$info);
        }
        
        if($check != '')
        {
         echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Data fetch Successfully",
                    "data" =>  $newdataarray,
                    
                    
                ));
        }else
        {
            echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Data not fetch Successfully",
                   
                    
                ));
        }
    }
    
    function categorywithproduct()
    {
         $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
        
        $check = DB::table('tbl_categories')->where(array('pid' => 0))->get();
        $newdataarray = array();
        foreach($check as $checkdata)
        {
            $subategoryone = DB::table('tbl_categories')->where(array('pid' => $checkdata->id))->get();
            if($checkdata->image != '')
            {
                $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$checkdata->image;
            }else
            {
                $image = '';
            }
            if($checkdata->bannerimage != '')
            {
                $bannerimage = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$checkdata->bannerimage;
            }else
            {
                $bannerimage = '';
            }
            if($subategoryone != '')
            {
                $subcatonearray = array();
                foreach($subategoryone as $subategoryone)
                {
                    $subactegorytwoarray = array();
                    $productarray = array();
                    $subategorytwo = DB::table('tbl_categories')->where(array('pid' => $subategoryone->id))->get();
                  
                        if(!$subategorytwo->isEmpty())
                        { 
                            
                            foreach($subategorytwo as $subategorytwo)
                            {
                                
                                if($subategorytwo->image != '')
                                {
                                    $image3 = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$subategorytwo->image;
                                }else
                                {
                                    $image3 = '';
                                }
                                if($subategorytwo->bannerimage != '')
                                {
                                    $bannerimage3 = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$subategorytwo->bannerimage;
                                }else
                                {
                                    $bannerimage3 = '';
                                }
                                $info3 =  array(
                                    'id' => $subategorytwo->id,
                                    'pid' => $subategorytwo->pid,
                                    'name' => $subategorytwo->name,
                                    'description' =>$subategorytwo->description,
                                    'image'  => str_replace(' ','',$image3),
                                    'slug'  => $subategorytwo->slug,
                                    'bannerimage' =>$bannerimage3,
                                    'seo_title' => $subategorytwo->seo_title,
                                    'seo_description' => $subategorytwo->seo_description,
                                    'seo_url' =>$subategorytwo->seo_description,
                                    
                                );
                                array_push($subactegorytwoarray,$info2);
                            }
                        }
                    // $product = DB::table('tbl_product')->where(array('product_category' => $subategoryone->id))->get();
                    // if($product != '')
                    // {
                        
                    //     $newdataarray = array();
                    //     foreach($product as $productdata)
                    //     {
                    //         if($productdata->product_media != '')
                    //         {
                    //             $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$productdata->product_media;
                               
                    //         }else
                    //         {
                    //             $image = '';
                    //         }
                    //         if($productdata->product_gallery != '')
                    //         {
                    //             $explodegallery = explode(',',$productdata->product_gallery);
                    //             $productgallery = array();
                    //             foreach($explodegallery as $explodegallery)
                    //             {
                    //                  $gallery = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$explodegallery;
                    //                  array_push($productgallery,$gallery);
                    //             }
                    //           $gallery = implode(',',$productgallery);
                               
                    //         }else
                    //         {
                    //             $gallery = '';
                    //         }
                    //          $stock = DB::table('stock')->where(array('productid' => $productdata->id))->first();
                    //           if($stock != '')
                    //         {
                    //             $stockqty = $stock->stockqty;
                    //         }else
                    //         {
                    //              $stockqty = 0;
                    //         }
                            
                    //         $shipping = DB::table('tbl_inventory')->where(array('product_id' => $productdata->id ))->first();
                    //         if($shipping != '')
                    //         {
                    //             $minqty = $shipping->minqty;
                    //             $maxqty = $shipping->maxqty;
                    //         }else
                    //         {
                    //             $minqty = 0;
                    //             $maxqty = 0;
                    //         }
                    //         $rating = DB::table('tbl_rating')->where(array('pid' => $productdata->id ))->get();
                    //             $totrating = 0;
                    //             foreach($rating as $ratingfinal)
                    //             {
                    //                 $totrating +=$ratingfinal->rating;
                    //             }
                    //             if(count($rating) === 0)
                    //             {
                    //                 $ratingdata = 0;
                    //             }else
                    //             {
                    //                  $ratingdata = $totrating/count($rating);
                    //             }
                    //         $info  = array(
                    //                         "id" => $productdata->id,
                    //                         "product_name" => $productdata->product_name,
                    //                         "product_description" => $productdata->product_description,
                    //                         "product_category"=> $productdata->product_category,
                    //                         "product_detail_page" => $link."/".config('global.finalurl')."/public/frontend/".$productdata->product_name,
                    //                         "product_brand" =>  $productdata->product_brand,
                    //                         "product_media" =>  $image,
                    //                         "product_gallery"=> $gallery,
                    //                         "product_type"=> $productdata->product_type,
                    //                         "regular_price" =>  $productdata->regular_price,
                    //                         "sale_price" =>  $productdata->sale_price,
                    //                         "seo_title" => $productdata->seo_title,
                    //                         "seo_description" => $productdata->seo_description,
                    //                         "seo_url" => $productdata->seo_url,
                    //                         "seo_key"=> $productdata->seo_key,
                    //                         "download_limit"=> $productdata->download_limit,
                    //                         "download_file"=> $productdata->download_file,
                    //                         "download_url"=> $productdata->download_url,
                    //                         "sale_start_date"=> $productdata->sale_start_date,
                    //                         "sale_end_date"=> $productdata->sale_end_date,
                    //                         "download_expiary"=> $productdata->download_expiary,
                    //                         "up_sell"=> $productdata->up_sell,
                    //                         "cross_sell"=> $productdata->cross_sell,
                    //                         "product_url"=> $productdata->product_url,
                    //                         "btn_txt"=> $productdata->btn_txt,
                    //                         "taxstatus"=> $productdata->taxstatus,
                    //                         "minqty" => $minqty,
                    //                         "maxqty" => $maxqty,
                    //                         "instock" => $stockqty,
                    //                         "rating" => $ratingdata
                                            
                                        
                    //                 );
                    //         array_push($newdataarray,$info);
                    //     }
                   
                    // }
                    if($subategoryone->image != '')
                    {
                        $image2 = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$subategoryone->image;
                    }else
                    {
                        $image2 = '';
                    }
                    if($subategoryone->bannerimage != '')
                    {
                        $bannerimage2 = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$subategoryone->bannerimage;
                    }else
                    {
                        $bannerimage2 = '';
                    }
                    $info2 =  array(
                        'id' => $subategoryone->id,
                        'pid' => $subategoryone->pid,
                        'name' => $subategoryone->name,
                        'description' =>$subategoryone->description,
                        'image'  => $image2,
                        'slug'  => $subategoryone->slug,
                        'bannerimage' =>$bannerimage2,
                        'seo_title' => $subategoryone->seo_title,
                        'seo_description' => $subategoryone->seo_description,
                        'seo_url' =>$subategoryone->seo_description,
                        'subcategorytwolevel' => $subactegorytwoarray,
                        'product' => $productarray
                        
                    );
                    array_push($subcatonearray,$info2);
                }
            }
            $product = DB::table('tbl_product')->where(array('product_category' => $checkdata->id))->get();
             
            if($product != '')
            {
                
               $productarray = array();
                foreach($product as $productdata)
                {
                    if($productdata->product_media != '')
                    {
                        $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$productdata->product_media;
                       
                    }else
                    {
                        $image = '';
                    }
                    if($productdata->product_gallery != '')
                    {
                        $explodegallery = explode(',',$productdata->product_gallery);
                        $productgallery = array();
                        foreach($explodegallery as $explodegallery)
                        {
                             $gallery = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$explodegallery;
                             array_push($productgallery,$gallery);
                        }
                      $gallery = implode(',',$productgallery);
                       
                    }else
                    {
                        $gallery = '';
                    }
                     $stock = DB::table('stock')->where(array('productid' => $productdata->id))->first();
                      if($stock != '')
                    {
                        $stockqty = $stock->stockqty;
                    }else
                    {
                         $stockqty = 0;
                    }
                    
                    $shipping = DB::table('tbl_inventory')->where(array('product_id' => $productdata->id ))->first();
                    if($shipping != '')
                    {
                        $minqty = $shipping->minqty;
                        $maxqty = $shipping->maxqty;
                    }else
                    {
                        $minqty = 0;
                        $maxqty = 0;
                    }
                    $rating = DB::table('tbl_rating')->where(array('pid' => $productdata->id ))->get();
                        $totrating = 0;
                        foreach($rating as $ratingfinal)
                        {
                            $totrating +=$ratingfinal->rating;
                        }
                        if(count($rating) === 0)
                        {
                            $ratingdata = 0;
                        }else
                        {
                             $ratingdata = $totrating/count($rating);
                        }
                    $info  = array(
                                    "id" => $productdata->id,
                                    "product_name" => $productdata->product_name,
                                    "product_description" => $productdata->product_description,
                                    "product_category"=> $productdata->product_category,
                                    "product_detail_page" => $link."/".config('global.finalurl')."/public/frontend/".$productdata->product_name,
                                    "product_brand" =>  $productdata->product_brand,
                                    "product_media" =>  $image,
                                    "product_gallery"=> $gallery,
                                    "product_type"=> $productdata->product_type,
                                    "regular_price" =>  $productdata->regular_price,
                                    "sale_price" =>  $productdata->sale_price,
                                    "seo_title" => $productdata->seo_title,
                                    "seo_description" => $productdata->seo_description,
                                    "seo_url" => $productdata->seo_url,
                                    "seo_key"=> $productdata->seo_key,
                                    "download_limit"=> $productdata->download_limit,
                                    "download_file"=> $productdata->download_file,
                                    "download_url"=> $productdata->download_url,
                                    "sale_start_date"=> $productdata->sale_start_date,
                                    "sale_end_date"=> $productdata->sale_end_date,
                                    "download_expiary"=> $productdata->download_expiary,
                                    "up_sell"=> $productdata->up_sell,
                                    "cross_sell"=> $productdata->cross_sell,
                                    "product_url"=> $productdata->product_url,
                                    "btn_txt"=> $productdata->btn_txt,
                                    "taxstatus"=> $productdata->taxstatus,
                                    "minqty" => $minqty,
                                    "maxqty" => $maxqty,
                                    "instock" => $stockqty,
                                    "rating" => $ratingdata
                                    
                                
                            );
                    array_push($productarray,$info);
                }
           
            }
            $info  = array(
                        'id' => $checkdata->id,
                        'pid' => $checkdata->pid,
                        'name' => $checkdata->name,
                        'description' =>$checkdata->description,
                        'image'  => $image,
                        'slug'  => $checkdata->slug,
                        'bannerimage' =>$bannerimage,
                        'seo_title' => $checkdata->seo_title,
                        'seo_description' => $checkdata->seo_description,
                        'seo_url' =>$checkdata->seo_description,
                        'subcategoryonelevel' => $subcatonearray,
                        'product' => $productarray
                    );
            array_push($newdataarray,$info);
        }
        
        if($check != '')
        {
         echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Data fetch Successfully",
                    "data" =>  $newdataarray,
                    
                    
                ));
        }else
        {
            echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Data not fetch Successfully",
                   
                    
                ));
        }
    }
    function subcategories(Request $request)
    {
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
        if($request->category != '')
        {
             $check = DB::table('tbl_categories')->where(array('pid' => $request->category))->get();
        }else
        {
             $check = DB::table('tbl_categories')->where('pid','!=','0')->get();
        }
       
        $newdataarray = array();
        foreach($check as $checkdata)
        {
            if($checkdata->image != '')
            {
                $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$checkdata->image;
            }else
            {
                $image = '';
            }
            if($checkdata->bannerimage != '')
            {
                $bannerimage = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$checkdata->bannerimage;
            }else
            {
                $bannerimage = '';
            }
            $info  = array(
                        'id' => $checkdata->id,
                        'pid' => $checkdata->pid,
                        'name' => $checkdata->name,
                        'description' =>$checkdata->description,
                        'image'  => $image,
                        'slug'  => $checkdata->slug,
                        'bannerimage' =>$bannerimage,
                        'seo_title' => $checkdata->seo_title,
                        'seo_description' => $checkdata->seo_description,
                        'seo_url' =>$checkdata->seo_description
                    );
            array_push($newdataarray,$info);
        }
        if($check != '')
        {
         echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Data fetch Successfully",
                    "data" =>  $newdataarray,
                    
                    
                ));
        }else
        {
            echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Data not fetch Successfully",
                   
                    
                ));
        }
    }
    
    function attribute(Request $request)
    {
        $check = DB::table('tbl_attribute')->get();
        if($check != '')
        {
         echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Data fetch Successfully",
                    "data" =>  $check,
                    
                    
                ));
        }else
        {
            echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Data not fetch Successfully",
                   
                    
                ));
        }
    }
    function categorywiseproduct(Request $request)
    {
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
        
        $check = DB::table('tbl_product')->where(array('product_category' => $request->category))->get();
        if($check != '')
        {
            
            $newdataarray = array();
            foreach($check as $checkdata)
            {
                if($checkdata->product_media != '')
                {
                    $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$checkdata->product_media;
                   
                }else
                {
                    $image = '';
                }
                if($checkdata->product_gallery != '')
                {
                    $explodegallery = explode(',',$checkdata->product_gallery);
                    $productgallery = array();
                    foreach($explodegallery as $explodegallery)
                    {
                         $gallery = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$explodegallery;
                         array_push($productgallery,$gallery);
                    }
                   $gallery = implode(',',$productgallery);
                   
                }else
                {
                    $gallery = '';
                }
                 $stock = DB::table('stock')->where(array('productid' => $checkdata->id))->first();
                  if($stock != '')
                {
                    $stockqty = $stock->stockqty;
                }else
                {
                     $stockqty = 0;
                }
                
                $shipping = DB::table('tbl_inventory')->where(array('product_id' => $checkdata->id ))->first();
                if($shipping != '')
                {
                    $minqty = $shipping->minqty;
                    $maxqty = $shipping->maxqty;
                }else
                {
                    $minqty = 0;
                    $maxqty = 0;
                }
                $rating = DB::table('tbl_rating')->where(array('pid' => $checkdata->id ))->get();
                    $totrating = 0;
                    foreach($rating as $ratingfinal)
                    {
                        $totrating +=$ratingfinal->rating;
                    }
                    if(count($rating) === 0)
                    {
                        $ratingdata = 0;
                    }else
                    {
                         $ratingdata = $totrating/count($rating);
                    }
                $info  = array(
                                "id" => $checkdata->id,
                                "product_name" => $checkdata->product_name,
                                "product_description" => $checkdata->product_description,
                                "product_category"=> $checkdata->product_category,
                                "product_detail_page" => $link."/".config('global.finalurl')."/public/frontend/".$checkdata->product_name,
                                "product_brand" =>  $checkdata->product_brand,
                                "product_media" =>  $image,
                                "product_gallery"=> $gallery,
                                "product_type"=> $checkdata->product_type,
                                "regular_price" =>  $checkdata->regular_price,
                                "sale_price" =>  $checkdata->sale_price,
                                "seo_title" => $checkdata->seo_title,
                                "seo_description" => $checkdata->seo_description,
                                "seo_url" => $checkdata->seo_url,
                                "seo_key"=> $checkdata->seo_key,
                                "download_limit"=> $checkdata->download_limit,
                                "download_file"=> $checkdata->download_file,
                                "download_url"=> $checkdata->download_url,
                                "sale_start_date"=> $checkdata->sale_start_date,
                                "sale_end_date"=> $checkdata->sale_end_date,
                                "download_expiary"=> $checkdata->download_expiary,
                                "up_sell"=> $checkdata->up_sell,
                                "cross_sell"=> $checkdata->cross_sell,
                                "product_url"=> $checkdata->product_url,
                                "btn_txt"=> $checkdata->btn_txt,
                                "taxstatus"=> $checkdata->taxstatus,
                                "minqty" => $minqty,
                                "maxqty" => $maxqty,
                                "instock" => $stockqty,
                                "rating" => $ratingdata
                                
                            
                        );
                array_push($newdataarray,$info);
            }
        echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Data fetch Successfully",
                    "data" =>  $newdataarray,
                    
                    
                ));
        }else
        {
            echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Data not fetch Successfully",
                   
                    
                ));
        }
    }
    function product(Request $request)
    {
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
        
        $check = DB::table('tbl_product')->get();
        if($check != '')
        {
            
            $newdataarray = array();
            foreach($check as $checkdata)
            {
                if($checkdata->product_media != '')
                {
                    $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$checkdata->product_media;
                   
                }else
                {
                    $image = '';
                }
                if($checkdata->product_gallery != '')
                {
                    $explodegallery = explode(',',$checkdata->product_gallery);
                    $productgallery = array();
                    foreach($explodegallery as $explodegallery)
                    {
                         $gallery = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$explodegallery;
                         array_push($productgallery,$gallery);
                    }
                   $gallery = implode(',',$productgallery);
                   
                }else
                {
                    $gallery = '';
                }
                 $stock = DB::table('stock')->where(array('productid' => $checkdata->id))->first();
                  if($stock != '')
                {
                    $stockqty = $stock->stockqty;
                }else
                {
                     $stockqty = 0;
                }
                
                $shipping = DB::table('tbl_inventory')->where(array('product_id' => $checkdata->id ))->first();
                if($shipping != '')
                {
                    $minqty = $shipping->minqty;
                    $maxqty = $shipping->maxqty;
                }else
                {
                    $minqty = 0;
                    $maxqty = 0;
                }
                $rating = DB::table('tbl_rating')->where(array('pid' => $checkdata->id ))->get();
                    $totrating = 0;
                    foreach($rating as $ratingfinal)
                    {
                        $totrating +=$ratingfinal->rating;
                    }
                    if(count($rating) === 0)
                    {
                        $ratingdata = 0;
                    }else
                    {
                         $ratingdata = $totrating/count($rating);
                    }
                if($checkdata->sale_start_date < date('Y-m-d') && $checkdata->sale_end_date > date('Y-m-d'))
                {
                    $saleprice =  $checkdata->sale_price;
                }else
                {
                    $saleprice =  0;
                }
                $info  = array(
                                "id" => $checkdata->id,
                                "product_name" => $checkdata->product_name,
                                "product_description" => $checkdata->product_description,
                                "product_category"=> $checkdata->product_category,
                                "product_detail_page" => $link."/".config('global.finalurl')."/public/frontend/".$checkdata->product_name,
                                "product_brand" =>  $checkdata->product_brand,
                                "product_media" =>  $image,
                                "product_gallery"=> $gallery,
                                "product_type"=> $checkdata->product_type,
                                "regular_price" =>  $checkdata->regular_price,
                                "sale_price" =>  $saleprice,
                                "seo_title" => $checkdata->seo_title,
                                "seo_description" => $checkdata->seo_description,
                                "seo_url" => $checkdata->seo_url,
                                "seo_key"=> $checkdata->seo_key,
                                "download_limit"=> $checkdata->download_limit,
                                "download_file"=> $checkdata->download_file,
                                "download_url"=> $checkdata->download_url,
                                "sale_start_date"=> $checkdata->sale_start_date,
                                "sale_end_date"=> $checkdata->sale_end_date,
                                "download_expiary"=> $checkdata->download_expiary,
                                "up_sell"=> $checkdata->up_sell,
                                "cross_sell"=> $checkdata->cross_sell,
                                "product_url"=> $checkdata->product_url,
                                "btn_txt"=> $checkdata->btn_txt,
                                "taxstatus"=> $checkdata->taxstatus,
                                "minqty" => $minqty,
                                "maxqty" => $maxqty,
                                "instock" => $stockqty,
                                "rating" => $ratingdata
                                
                            
                        );
                array_push($newdataarray,$info);
            }
        echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Data fetch Successfully",
                    "data" =>  $newdataarray,
                    
                    
                ));
        }else
        {
            echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Data not fetch Successfully",
                   
                    
                ));
        }
    }
    function paymentdetails(Request $request)
    {
        $payment = DB::table('payment_gateway')->first();
        echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Data  fetch Successfully",
                    "data"  => $payment
                    
                ));
    }
    function terms(Request $request)
    {
        $check = DB::table('attribute_terms')->where(array('attributeid' => $request->attribute_id))->get();
        if($check != '')
        {
         echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Data fetch Successfully",
                    "data" =>  $check,
                    
                    
                ));
        }else
        {
            echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Data not fetch Successfully",
                   
                    
                ));
        }
    }
    function getratingdetails(Request $request)
    {
        if($request->productid != '')
        {
             $data = DB::table('tbl_rating')->where('pid','=',$request->productid)->get();
        }else
        {
             $data = DB::table('tbl_rating')->get();
        }
       
        $info = array();
        $sum = 0;
        foreach($data as $dataval)
        {
            $user = DB::table('user')->where(['id' => $dataval->user_id])->first();
            $sample = array(
                            'rating' => $dataval->rating,
                            'comment' => $dataval->comment,
                            'product_id' =>  $dataval->pid,
                            'user_id' => $dataval->user_id,
                            'user_name' => $user->firstName.' '.$user->lastName
                        );
            array_push($info,$sample);
            // $sum += $dataval->rating;
        }
        // $finalsum = $sum/count($data);
         echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Data  fetch Successfully",
                    "data" => $info,
                    // "total_rating" => $finalsum
                    
                ));
    }
     function addtocart(Request $request)
    {
        
        $user = DB::table('user')->where(array('mobile' => $request->mobile,'password' =>$request->password))->first();
        if($user != '')
        {
            $explodedata = explode(',',$request->product_id);
            $infofinal = array(); 
            $cart_ref = 'CART_0'.$user->id;
            foreach($explodedata as $productid)
            {
                $existproductcart = DB::table('cart')->where(['productid'=> $productid,'cart_ref_id' => $cart_ref])->first();
                $result = 0;
                if($existproductcart != '')
                {
                    $info =  array(
                     "quantity"  => $existproductcart->quantity + 1,
                    ); 
                    $productdata = DB::table('cart')->where(array('id' => $existproductcart->id))->first();
                    $shipping = DB::table('tbl_inventory')->where(array('product_id' => $productdata->productid ))->first();
                    if($shipping != '')
                    {
                        $minqty = $shipping->minqty;
                        $maxqty = $shipping->maxqty;
                    }else
                    {
                        $minqty = 0;
                        $maxqty = 0;
                    }
                    if($existproductcart->quantity < $maxqty)
                    {
                         $result = DB::table('cart')->where('id','=',$existproductcart->id)->update($info);
                    }
                   
                    
                }else
                {
                     $info =  array(
                        "productid" => $productid,
                        "userid"    => $user->id,
                        "quantity"  => $request->qty,
                        "cart_ref_id" => $cart_ref,
                        "varient_id" => $request->varient_id,
                        "note" => $request->varient_text
                       
                    ); 
                    
                    
                    $shipping = DB::table('tbl_inventory')->where(array('product_id' =>$productid ))->first();
                    if($shipping != '')
                    {
                        $minqty = $shipping->minqty;
                        $maxqty = $shipping->maxqty;
                    }else
                    {
                        $minqty = 0;
                        $maxqty = 0;
                    }
                    // if($request->qty < $maxqty)
                    // {
                           $result = DB::table('cart')->insertGetId($info);
                    // }
                    $productdata = DB::table('cart')->where(array('id' => $result))->first();
                }
                
                
               
                
                
                $product = DB::table('tbl_product')->where(array('id' => $productid))->first();
                $stock = DB::table('stock')->where(array('productid' => $productid))->first();
                if($stock != '')
                {
                    $stockqty = $stock->stockqty;
                }else
                {
                     $stockqty = 0;
                }
               
                $infodata = array(
                                'cart_id' => $productid,
                                'cart_ref_id' => $productdata->cart_ref_id,
                                'product_id' => $product->id,
                                'product_name' => $product->product_name,
                                'qty'       => $productdata->quantity,
                                'sale_price' => $product->sale_price,
                                'total'     => $product->sale_price * $productdata->quantity,
                                'instock' => $stockqty,
                                'minqty' => $minqty,
                                'maxqty' => $maxqty,
                                'varient_text' => $productdata->note
                                
                            );
                array_push($infofinal,$infodata);
            }
           
            if($result != 0)
            {
                echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Item Added Successfully",
                    "data"   => $infofinal
                    
                    
                    
                ));
            }else
            {
                echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Item Not added.Out Of Stock ",
                       
                        
                    ));
            }
        }else if(isset($request->userid))
        {
            $productid = $request->product;
            $infofinal = array(); 
            $cart_ref = 'CART_0'.$request->userid;
            
                $existproductcart = DB::table('cart')->where(['productid'=> $productid,'cart_ref_id' => $cart_ref])->first();
               
                if($existproductcart != '')
                {
                    $info =  array(
                     "quantity"  => $existproductcart->quantity + 1,
                    ); 
                    $result = DB::table('cart')->where('id','=',$existproductcart->id)->update($info);
                    $productdata = DB::table('cart')->where(array('id' => $existproductcart->id))->first();
                     echo json_encode(
                            array(
                                "response" => "exists",
                                "message" => "Item Not added. ",
                               
                                
                            ));
                }else
                {
                     $info =  array(
                        "productid" => $productid,
                        "userid"    => $request->userid,
                        "quantity"  => $request->quantity,
                        "cart_ref_id" => $cart_ref,
                        "varient_id" => $request->varient_id,
                         "note" => $request->varient_text
                       
                    ); 
                    $result = DB::table('cart')->insertGetId($info);
                    $productdata = DB::table('cart')->where(array('id' => $result))->first();
                    
                    $product = DB::table('tbl_product')->where(array('id' => $productdata->productid))->first();
                    $stock = DB::table('stock')->where(array('productid' => $productdata->productid))->first();
                    if($stock != '')
                    {
                        $stockqty = $stock->stockqty;
                    }else
                    {
                         $stockqty = 0;
                    }
                     $shipping = DB::table('tbl_inventory')->where(array('product_id' => $productdata->productid ))->first();
                    if($shipping != '')
                    {
                        $minqty = $shipping->minqty;
                        $maxqty = $shipping->maxqty;
                    }else
                    {
                        $minqty = 0;
                        $maxqty = 0;
                    }
                    $infodata = array(
                                    'cart_id' => $productdata->id,
                                    'cart_ref_id' => $productdata->cart_ref_id,
                                    'product_id' => $product->id,
                                    'product_name' => $product->product_name,
                                    'qty'       => $productdata->quantity,
                                    'sale_price' => $product->sale_price,
                                    'total'     => $product->sale_price * $productdata->quantity,
                                    'instock' => $stockqty,
                                    'minqty' => $minqty,
                                    'maxqty' => $maxqty,
                                    'varient_text' => $productdata->note
                                    
                                );
                    array_push($infofinal,$infodata);
                    echo json_encode(
                            array(
                                "response" => "success",
                                "message" => "Item  added. ",
                               
                                
                            ));
                }
               
            
                
                
                
        }
        else
        {
            echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Item Not added.",
                   
                    
                ));
        }
    }
    function showcart(Request $request)
    {
        $user = DB::table('user')->where(array('mobile' => $request->mobile,'password' =>$request->password))->first();
        if($user != '')
        {
            $cartitem = DB::table('cart')->where(array('userid' => $user->id))->get();
           
            $cartitemarray = array();
            foreach($cartitem as $cartitem)
            {
                $product = DB::table('tbl_product')->where(array('id' => $cartitem->productid))->first();
                $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
               
                if($cartitem->varient_id != 0)
                {
                  
                    $varient = DB::table('tbl_product_varient')->where(['id' => $cartitem->varient_id])->first();
                   
                    $regularprice = $varient->attrprice;
                    $product_name = $product->product_name;
                    $saleprice =0;
                    $minqty = 0;
                    $maxqty = $varient->attribute_quantity;
                    $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$varient->attribute_image;
                }else{
                    
                        if($product != '')
                        {
                            $product_name = $product->product_name;
                            $saleprice =$product->sale_price;
                            if($product->regular_price == "")
                            {
                                $regularprice="0";
                            }
                            else
                            {
                                $regularprice = $product->regular_price;
                            }
                            if($product->product_media != '')
                            {
                                $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$product->product_media;
                               
                            }else
                            {
                                $image = '';
                            }
                            
                        }else
                        {
                            $product_name = '';
                            $saleprice =0;
                            $regularprice =0;
                           
                                $image = '';
                            
                        }
                        
                         $stock = DB::table('stock')->where(array('productid' => $cartitem->productid))->first();
                          if($stock != '')
                        {
                            $stockqty = $stock->stockqty;
                        }else
                        {
                             $stockqty = 0;
                        }
                         $shipping = DB::table('tbl_inventory')->where(array('product_id' => $cartitem->productid ))->first();
                        if($shipping != '')
                        {
                            $minqty = $shipping->minqty;
                            $maxqty = $shipping->maxqty;
                        }else
                        {
                            $minqty = 0;
                            $maxqty = 0;
                        }
                }
                
               
                $info = array(
                                'cart_id' => $cartitem->id,
                                'cart_ref_id' => $cartitem->cart_ref_id,
                                'product_id' => $cartitem->productid,
                                'product_name' => $product_name,
                                'qty'       => $cartitem->quantity,
                                'sale_price' => $saleprice,
                                'regular_price' =>$regularprice,
                                'total'     => $saleprice * $cartitem->quantity,
                                'product_image' => $image,
                                'instock' => $stockqty,
                                'minqty' => $minqty,
                                'maxqty' => $maxqty,
                                'varient_text' => $cartitem->note
                               
                            );
                array_push($cartitemarray,$info);
            }
            echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Data fetched Successfully",
                    "data"   => $cartitemarray
                    
                    
                    
                ));
               
        }else if(isset($request->userid))
        {
            $cartitem = DB::table('cart')->where(array('userid' => $request->userid))->get();
           
            $cartitemarray = array();
            foreach($cartitem as $cartitem)
            {
                $product = DB::table('tbl_product')->where(array('id' => $cartitem->productid))->first();
                $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
                if($cartitem->varient_id != 0)
                {
                   
                    $varient = DB::table('tbl_product_varient')->where(['id' => $cartitem->varient_id])->first();
                   
                    $regularprice = $varient->attrprice;
                    $product_name = $product->product_name;
                    $saleprice =0;
                    $minqty = 0;
                    $maxqty = $varient->attribute_quantity;
                    $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$varient->attribute_image;
                }else{
                    if($product != '')
                    {
                        $product_name = $product->product_name;
                        $saleprice =$product->sale_price;
                        if($product->regular_price == "")
                        {
                            $regularprice="0";
                        }
                        else
                        {
                        $regularprice = $product->regular_price;
                        }
                        if($product->product_media != '')
                        {
                            $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$product->product_media;
                           
                        }else
                        {
                            $image = '';
                        }
                        
                    }else
                    {
                        $product_name = '';
                        $saleprice =0;
                        $regularprice =0;
                       
                            $image = '';
                        
                    }
                     $stock = DB::table('stock')->where(array('productid' => $cartitem->productid))->first();
                      if($stock != '')
                    {
                        $stockqty = $stock->stockqty;
                    }else
                    {
                         $stockqty = 0;
                    }
                     $shipping = DB::table('tbl_inventory')->where(array('product_id' => $cartitem->productid ))->first();
                    if($shipping != '')
                    {
                        $minqty = $shipping->minqty;
                        $maxqty = $shipping->maxqty;
                    }else
                    {
                        $minqty = 0;
                        $maxqty = 0;
                    }
                     if($product->sale_start_date < date('Y-m-d') && $product->sale_end_date > date('Y-m-d'))
                    {
                        $saleprice =  $product->sale_price;
                    }else
                    {
                        $saleprice =  0;
                    }
                }
                $info = array(
                                'cart_id' => $cartitem->id,
                                'cart_ref_id' => $cartitem->cart_ref_id,
                                'product_id' => $cartitem->productid,
                                'product_name' => $product_name,
                                'qty'       => $cartitem->quantity,
                                'sale_price' => $saleprice,
                                'regular_price' =>$regularprice,
                                'total'     => $saleprice * $cartitem->quantity,
                                'product_image' => $image,
                                'instock' => $stockqty,
                                'minqty' => $minqty,
                                'maxqty' => $maxqty,
                                'varient_text' => $cartitem->note
                               
                            );
                array_push($cartitemarray,$info);
            }
            echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Data fetched Successfully",
                    "data"   => $cartitemarray
                    
                    
                    
                ));
        }else
        {
            echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Data not fetched",
                       
                        
                    ));
        }
    }
    function updatecart(Request $request)
    {
        $info = array(
                        "quantity" => $request->qty
            );
            $result = DB::table('cart')->where(array(
                "id" => $request->cart_id
                
                ))->update($info);
            if($result == 1)
            {
                echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Cart Updated Successfully",
                    
                    
                ));
            }
            else
            {
                echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Card not Updated Successfully",
                       
                        
                    ));
            }
    }
    function deletecart(Request $request)
    {
        $result = DB::table('cart')->where(array(
                "id" => $request->cart_id))->delete();
            
        if($result == 1)
            {
                echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Cart Deleted Successfully",
                    
                    
                ));
            }
            else
            {
                echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Cart not Deleted Successfully",
                       
                        
                    ));
            }        
    }
    function discountcoupun(Request $request)
    {
        $check = DB::table('tbl_discount')->get();
        
        if($check != '')
        {
         echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Data fetch Successfully",
                    "data" =>  $check,
                    
                    
                ));
        }else
        {
            echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Data not fetch Successfully",
                   
                    
                ));
        }
    }
    function applydiscountcoupen(Request $request)
    {
        $cartdata = DB::table('cart')->where(['cart_ref_id' => $request->cart_ref_id])->first();
        $total = $request->total;
        $coupen = DB::table('tbl_discount')->where(['discountcode' => $request->discount_code])->whereDate('startdate', '<=', date("Y-m-d"))
            ->whereDate('enddate', '>=', date("Y-m-d"))->first();
       
        if(isset($coupen))
        {
            if($coupen->types == 'Percentage')
            {
                $total = ($request->total) * ($coupen->amount/100);
            }else if($coupen->types == 'Fixed Amount')
            {
                $total = $request->total;
            }else
            {
                $total = 0;
            }
            $info = array(
                        'coupen_id' => $coupen->id,
                        'coupen' => $coupen->discountcode,
                        'cart_ref_id' => $request->cart_ref_id,
                        'amount' => $total,
                        'coupen_amount' => $coupen->amount,
                        'total_amount' => $total - $coupen->amount,
                        'user_id' => $cartdata->userid
                );
            $data = DB::table('discount_apply')->insert($info);
            if($data == 1)
            {
                $limit = $coupen->limitdata - 1;
                DB::table('tbl_discount')->where(['discountcode' => $request->discount_code])->update(['limitdata' => $limit]);
                echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Coupen Apply Successfully",
                ));
            }else
            {
                echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Coupen Not Apply.",
                ));
            }
        }else
        {
            echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Coupen Not Apply.",
                ));
        }
        
        
        
    }
    function coupencheck(Request $request)
    {
       $check = DB::table('discount_apply')->where(['cart_ref_id' => $request->cart_ref_id])->first();
       if(isset($check))
       {
            if($check->order_id == '')
           {
               echo json_encode(
                    array(
                        "response" => "success",
                        "total" => $check->coupen_amount,
                    ));
           }else
           {
               echo json_encode(
                    array(
                        "response" => "failed",
                        "total" => 0,
                    ));
           }
       }else
       {
           echo json_encode(
                    array(
                        "response" => "failed",
                        "total" => 0,
                    ));
       }
      
       
    }
    function currency(Request $request)
    {
        $check = DB::table('tbl_currency')->get();
        
        if($check != '')
        {
         echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Data fetch Successfully",
                    "data" =>  $check,
                    
                    
                ));
        }else
        {
            echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Data not fetch Successfully",
                   
                    
                ));
        }
    }
    function addorder(Request $request)
    {
        $user = DB::table('user')->where(array('mobile' => $request->mobile,'password' =>$request->password))->first();
        if($user != '')
        {
        $cart = DB::table('cart')->where(array('cart_ref_id' => $request->cart_ref_id))->get();
        $orderid = rand(1000,9000).'00'.$request->user_id;
        
            $info =  array(
                        "order_id" => $orderid,
                        "userid"    => $user->id,
                        "orderdate"  => date('Y-m-d',strtotime($request->orderdate)),
                        "billing_address"  => $request->billing_address,
                        "shipping_address"  => $request->shipping_address,
                        "paymentmethod"  => $request->payment_method,
                        "paymentstatus"  => $request->payment_status,
                        "orderstatus"  => $request->order_status,
                        "delivery_status" => $request->delivery_status,
                        "shipping_charges" => $request->shipping_charges,
                        "total_amount" => $request->total_amount,
                        "payment_id" => $request->payment_id,
                         "lat" => $request->lat,
                        "lng" => $request->lng
                        
            );
            $result = DB::table('orderdata')->insertGetId($info);
       
        foreach($cart as $key => $explodeproduct)
        {
            $info =  array(
                        "order_id" => $result,
                        "productid" => $explodeproduct->productid,
                        "qty"  => $explodeproduct->quantity,
            );
            $orderresult = DB::table('order_detail')->insertGetId($info);
        }
            if($result != "")
            {
                $info = DB::table('orderdata')->where('id','=',$result)->first();
                echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Order Added Successfully",
                    "data" =>$info
                    
                    
                    
                ));
            }else
            {
                echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Order not added Successfully",
                       
                        
                    ));
            }
        }else if($request->user_id != '')
        {
            $cart = DB::table('cart')->where(array('cart_ref_id' => $request->cart_ref_id))->get();
            $orderid = rand(1000,9000).'00'.$request->user_id;
        
            $info =  array(
                        "order_id" => $orderid,
                        "userid"    => $request->user_id,
                        "orderdate"  => date('Y-m-d',strtotime($request->orderdate)),
                        "billing_address"  => $request->billing_address,
                        "shipping_address"  => $request->shipping_address,
                        "paymentmethod"  => $request->payment_method,
                        "paymentstatus"  => $request->payment_status,
                        "orderstatus"  => $request->order_status,
                        "delivery_status" => $request->delivery_status,
                        "shipping_charges" => $request->shipping_charges,
                        "total_amount" => $request->total_amount,
                        "payment_id" => $request->payment_id,
                         "lat" => $request->lat,
                        "lng" => $request->lng
                        
            );
            $result = DB::table('orderdata')->insertGetId($info);
       
            foreach($cart as $key => $explodeproduct)
            {
                $info =  array(
                            "order_id" => $result,
                            "productid" => $explodeproduct->productid,
                            "qty"  => $explodeproduct->quantity,
                );
                $orderresult = DB::table('order_detail')->insertGetId($info);
            }
            if($result != "")
            {
                $info = DB::table('orderdata')->where('id','=',$result)->first();
                $update = DB::table('discount_apply')->where(['cart_ref_id' => $request->cart_ref_id])->update(['order_id' => $orderid]);
                echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Order Added Successfully",
                    "data" =>$info
                    
                    
                    
                ));
            }else
            {
                echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Order not added Successfully",
                       
                        
                    ));
            }
        }else
        {
             echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Order not added Successfully",
                       
                        
                    ));
        }
    }
    function orderfetch(Request $request)
    {
        $check = DB::table('orderdata')->where(array('userid' => $request->user_id))->get();
        if($check != '')
        {
         echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Data fetch Successfully",
                    "data" =>  $check,
                    
                    
                ));
        }else
        {
            echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Data not fetch Successfully",
                   
                    
                ));
        }
    }
    function wholeproductfilter(Request $request)
    {
        
        // if($request->minprice != '' && $request->maxprice != '' && $request->category != ''  && $request->key != '' && $request->brand){
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
                if($request->brand == '' && $request->category == '')
                {
                    $product = DB::select('select * from `tbl_product` where `sale_price` between '.$request->minprice.' AND '.$request->maxprice.' AND `product_name` LIKE "%'.$request->key.'%" ');
                }else
                if($request->category == '')
                {
                     $product = DB::select('select * from `tbl_product` where `sale_price` between '.$request->minprice.' AND '.$request->maxprice.' AND `product_name` LIKE "%'.$request->key.'%" AND `product_brand` IN('.$request->brand.')');
                }else if($request->brand == '')
                {
                    $product = DB::select('select * from `tbl_product` where `sale_price` between '.$request->minprice.' AND '.$request->maxprice.' AND product_category = '.$request->category.' AND `product_name` LIKE "%'.$request->key.'%" ');
                }else
                {
                    $product = DB::select('select * from `tbl_product` where `sale_price` between '.$request->minprice.' AND '.$request->maxprice.' AND product_category = '.$request->category.' AND `product_name` LIKE "%'.$request->key.'%" AND `product_brand` IN('.$request->brand.')');
                }
           
           
             $newdataarray = array();
            foreach($product as   $productdata)
            {
                if($request->term != '')
                {
                    $attr = DB::select('select * from tbl_product_attribute where `term_id` IN('.$request->term.') AND product_id = '.$productdata->id.'');
                }
                
                
                      if($productdata->product_media != '')
                        {
                            $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$productdata->product_media;
                           
                        }else
                        {
                            $image = '';
                        }
                    if($productdata->product_gallery != '')
                    {
                        $explodegallery = explode(',',$productdata->product_gallery);
                        $productgallery = array();
                        foreach($explodegallery as $explodegallery)
                        {
                             $gallery = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$explodegallery;
                             array_push($productgallery,$gallery);
                        }
                       $gallery = implode(',',$productgallery);
                       
                    }else
                    {
                        $gallery = '';
                    }
                         $shipping = DB::table('tbl_inventory')->where(array('product_id' => $productdata->id ))->first();
                        if($shipping != '')
                        {
                            $minqty = $shipping->minqty;
                            $maxqty = $shipping->maxqty;
                        }else
                        {
                            $minqty = 0;
                            $maxqty = 0;
                        }
                        $taxdata = DB::table('tbl_tax')->where(array('id' => $productdata->tax ))->first();
                        $total_tax = 0;
                        if(isset($taxdata))
                        {
                            $total_tax = $taxdata->total_tax;
                        }
                        $deliverydata = DB::table('tbl_deliverysetting')->where(array('id' => $productdata->deliveryflab ))->first();
                        $deliveryprice = 0;
                        if(isset($deliverydata))
                        {
                            $deliveryprice = $deliverydata->price;
                        }
                        $info  = array(
                                        "id" => $productdata->id,
                                        "product_name" => $productdata->product_name,
                                        "product_description" => $productdata->product_description,
                                        "product_category"=> $productdata->product_category,
                                        "product_detail_page" => $link."/".config('global.finalurl')."/public/frontend/".$productdata->product_name,
                                        "product_brand" =>  $productdata->product_brand,
                                        "product_media" =>  $image,
                                        "product_gallery"=> $gallery,
                                        "product_type"=> $productdata->product_type,
                                        "regular_price" =>  $productdata->regular_price,
                                        "sale_price" =>  $productdata->sale_price,
                                        "seo_title" => $productdata->seo_title,
                                        "seo_description" => $productdata->seo_description,
                                        "seo_url" => $productdata->seo_url,
                                        "seo_key"=> $productdata->seo_key,
                                        "download_limit"=> $productdata->download_limit,
                                        "download_file"=> $productdata->download_file,
                                        "download_url"=> $productdata->download_url,
                                        "sale_start_date"=> $productdata->sale_start_date,
                                        "sale_end_date"=> $productdata->sale_end_date,
                                        "download_expiary"=> $productdata->download_expiary,
                                        "up_sell"=> $productdata->up_sell,
                                        "cross_sell"=> $productdata->cross_sell,
                                        "product_url"=> $productdata->product_url,
                                        "btn_txt"=> $productdata->btn_txt,
                                        "taxstatus"=> $productdata->taxstatus,
                                        "minqty" => $minqty,
                                        "maxqty" => $maxqty,
                                        "tax" => $total_tax,
                                        "delivery_charge" => $deliveryprice
                                    
                                );
                            array_push($newdataarray,$info);
                
            }
           echo json_encode(array("response" => "success","message" => "Data fetched successfully .","data" =>  $newdataarray));
           
            
        // } 
    }
    function productfilter(Request $request)
    {
            $zone_city = '';
            $user = DB::table('user')->where(array('mobile' => $request->mobile,'password' =>$request->password))->first();
            if($user != '')
            {
                if($user->ip_address != '')
                {
                    $PublicIP = $user->ip_address;
                    $json     = file_get_contents("http://ipinfo.io/$PublicIP/geo");
                    $json     = json_decode($json, true);
                    $position = explode(',',$json['loc']);
                   
                    $zone_city =  DB::table('city_list')->where(array('city_name' => $json['city']))->first();
                    
                }
            }
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
        
            if($request->minprice != '' && $request->maxprice != '' && $request->category != '')
            {
               
                
               $product = DB::select('select * from `tbl_product` where `sale_price` between '.$request->minprice.' AND '.$request->maxprice.' AND product_category = '.$request->category.'');
              
                $newdataarray = array();
                foreach($product as $productdata)
                {
                    if($productdata->product_media != '')
                    {
                        $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$productdata->product_media;
                       
                    }else
                    {
                        $image = '';
                    }
                    if($productdata->product_gallery != '')
                    {
                        $explodegallery = explode(',',$productdata->product_gallery);
                        $productgallery = array();
                        foreach($explodegallery as $explodegallery)
                        {
                             $gallery = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$explodegallery;
                             array_push($productgallery,$gallery);
                        }
                       $gallery = implode(',',$productgallery);
                       
                    }else
                    {
                        $gallery = '';
                    }
                     $shipping = DB::table('tbl_inventory')->where(array('product_id' => $productdata->id ))->first();
                    if($shipping != '')
                    {
                        $minqty = $shipping->minqty;
                        $maxqty = $shipping->maxqty;
                    }else
                    {
                        $minqty = 0;
                        $maxqty = 0;
                    }
                    $rating = DB::table('tbl_rating')->where(array('pid' => $productdata->id ))->get();
                    $totrating = 0;
                    foreach($rating as $ratingfinal)
                    {
                        $totrating +=$ratingfinal->rating;
                    }
                    if(count($rating) === 0)
                    {
                        $ratingdata = 0;
                    }else
                    {
                         $ratingdata = $totrating/count($rating);
                    }
                    $taxdata = DB::table('tbl_tax')->where(array('id' => $productdata->tax ))->first();
                    $total_tax = 0;
                    if(isset($taxdata))
                    {
                        $total_tax = $taxdata->total_tax;
                    }
                     $shipping =  DB::table('tbl_product_shipping')->where(array('product_id' => $productdata->id ))->first();
                    $shippingprice = 0;
                    if($zone_city != '' && $shipping != '' && $shipping->weight != '')
                    {
                       
                        $shipping_zone = DB::table('shipping_zone')->where(array('zone_city' => $zone_city->city_id ))->get();
                        foreach($shipping_zone as $shipping_zone_data)
                        {
                            $shipping_method = DB::table('shipping_method')->where('start', '<', $shipping->weight)->where('end', '>', $shipping->weight)->where('unit','=',$shipping->unit)->first();
                           
                            if($shipping_method != '')
                            {
                                $shippingprice = $shipping_method->cost;
                            }else
                            {
                                $shippingprice = 0;
                            }
                        }
                    }else
                    {
                        $shippingprice = 0;
                    }
                    $deliverydata = DB::table('tbl_deliverysetting')->where(array('id' => $productdata->deliveryflab ))->first();
                    $deliveryprice = 0;
                    if(isset($deliverydata))
                    {
                        $deliveryprice = $deliverydata->price;
                    }
                    $info  = array(
                                    "id" => $productdata->id,
                                    "product_name" => $productdata->product_name,
                                    "product_description" => $productdata->product_description,
                                    "product_category"=> $productdata->product_category,
                                    "product_detail_page" => $link."/".config('global.finalurl')."/public/frontend/".$productdata->product_name,
                                    "product_brand" =>  $productdata->product_brand,
                                    "product_media" =>  $image,
                                    "product_gallery"=> $gallery,
                                    "product_type"=> $productdata->product_type,
                                    "regular_price" =>  $productdata->regular_price,
                                    "sale_price" =>  $productdata->sale_price,
                                    "seo_title" => $productdata->seo_title,
                                    "seo_description" => $productdata->seo_description,
                                    "seo_url" => $productdata->seo_url,
                                    "seo_key"=> $productdata->seo_key,
                                    "download_limit"=> $productdata->download_limit,
                                    "download_file"=> $productdata->download_file,
                                    "download_url"=> $productdata->download_url,
                                    "sale_start_date"=> $productdata->sale_start_date,
                                    "sale_end_date"=> $productdata->sale_end_date,
                                    "download_expiary"=> $productdata->download_expiary,
                                    "up_sell"=> $productdata->up_sell,
                                    "cross_sell"=> $productdata->cross_sell,
                                    "product_url"=> $productdata->product_url,
                                    "btn_txt"=> $productdata->btn_txt,
                                    "taxstatus"=> $productdata->taxstatus,
                                    "minqty" => $minqty,
                                    "maxqty" => $maxqty,
                                    "rating" => $ratingdata,
                                    "tax" => $total_tax,
                                    "delivery_charge" => $shippingprice
                                
                            );
                    array_push($newdataarray,$info);
                }
               echo json_encode(array("response" => "success","message" => "Data fetched successfully .","data" =>  $newdataarray));
            } else     
            if($request->category != '')
            {
                
                $category = DB::table('tbl_categories')->where(array('id' => $request->category))->first();
              
                $product = DB::table('tbl_product')->where(array('product_category' => $category->id))->get();
                // $brand = DB::table('tbl_brand')->where(array('category' => $category->id))->get();
               
                $newdataarray = array();
                $newbrand = array();
                foreach($product as $productdata)
                {
                    if($productdata->product_media != '')
                    {
                        $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$productdata->product_media;
                       
                    }else
                    {
                        $image = '';
                    }
                    if($productdata->product_gallery != '')
                    {
                        $explodegallery = explode(',',$productdata->product_gallery);
                        $productgallery = array();
                        foreach($explodegallery as $explodegallery)
                        {
                             $gallery = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$explodegallery;
                             array_push($productgallery,$gallery);
                        }
                       $gallery = implode(',',$productgallery);
                       
                    }else
                    {
                        $gallery = '';
                    }
                    $rating = DB::table('tbl_rating')->where(array('pid' => $productdata->id ))->get();
                    $totrating = 0;
                    foreach($rating as $ratingfinal)
                    {
                        $totrating +=$ratingfinal->rating;
                    }
                    if(count($rating) === 0)
                    {
                        $ratingdata = 0;
                    }else
                    {
                         $ratingdata = $totrating/count($rating);
                    }
                     $shipping = DB::table('tbl_inventory')->where(array('product_id' => $productdata->id ))->first();
                    if($shipping != '')
                    {
                        $minqty = $shipping->minqty;
                        $maxqty = $shipping->maxqty;
                    }else
                    {
                        $minqty = 0;
                        $maxqty = 0;
                    }
                    $stock = DB::table('stock')->where(array('productid' => $productdata->id ))->first();
                    if($stock != '')
                    {
                        $stockqty = $stock->stockqty;
                    }else
                    {
                         $stockqty = 0;
                    }
                    $taxdata = DB::table('tbl_tax')->where(array('id' => $productdata->tax ))->first();
                    $total_tax = 0;
                    if(isset($taxdata))
                    {
                        $total_tax = $taxdata->total_tax;
                    }
                    $shipping =  DB::table('tbl_product_shipping')->where(array('product_id' => $productdata->id ))->first();
                    $shippingprice = 0;
                    if($zone_city != '' && $shipping != '' && $shipping->weight != '')
                    {
                       
                        $shipping_zone = DB::table('shipping_zone')->where(array('zone_city' => $zone_city->city_id ))->get();
                        foreach($shipping_zone as $shipping_zone_data)
                        {
                            $shipping_method = DB::table('shipping_method')->where('start', '<', $shipping->weight)->where('end', '>', $shipping->weight)->where('unit','=',$shipping->unit)->first();
                           
                            if($shipping_method != '')
                            {
                                $shippingprice = $shipping_method->cost;
                            }else
                            {
                                $shippingprice = 0;
                            }
                        }
                    }else
                    {
                        $shippingprice = 0;
                    }
                    
                    
                   
                    $deliverydata = DB::table('tbl_deliverysetting')->where(array('id' => $productdata->deliveryflab ))->first();
                    $deliveryprice = 0;
                    if(isset($deliverydata))
                    {
                        $deliveryprice = $deliverydata->price;
                    }
                    $info  = array(
                                    "id" => $productdata->id,
                                    "product_name" => $productdata->product_name,
                                    "product_description" => $productdata->product_description,
                                    "product_category"=> $productdata->product_category,
                                    "product_detail_page" => $link."/".config('global.finalurl')."/public/frontend/".$productdata->product_name,
                                    "product_brand" =>  $productdata->product_brand,
                                    "product_media" =>  $image,
                                    "product_gallery"=> $gallery,
                                    "product_type"=> $productdata->product_type,
                                    "regular_price" =>  $productdata->regular_price,
                                    "sale_price" =>  $productdata->sale_price,
                                    "seo_title" => $productdata->seo_title,
                                    "seo_description" => $productdata->seo_description,
                                    "seo_url" => $productdata->seo_url,
                                    "seo_key"=> $productdata->seo_key,
                                    "download_limit"=> $productdata->download_limit,
                                    "download_file"=> $productdata->download_file,
                                    "download_url"=> $productdata->download_url,
                                    "sale_start_date"=> $productdata->sale_start_date,
                                    "sale_end_date"=> $productdata->sale_end_date,
                                    "download_expiary"=> $productdata->download_expiary,
                                    "up_sell"=> $productdata->up_sell,
                                    "cross_sell"=> $productdata->cross_sell,
                                    "product_url"=> $productdata->product_url,
                                    "btn_txt"=> $productdata->btn_txt,
                                    "taxstatus"=> $productdata->taxstatus,
                                    "minqty" => $minqty,
                                    "maxqty" => $maxqty,
                                    "instock" => $stockqty,
                                    "rating" => $ratingdata,
                                    "tax" => $total_tax,
                                    "delivery_charge" => $shippingprice
                                    
                            );
                    array_push($newdataarray,$info);
                }
                // foreach($brand as $branddata)
                // {
                //     $category = DB::table('tbl_categories')->where(array('id' => $branddata->category))->first();
                //     if($branddata->image != '')
                //     {
                //         $image = $link.'/shoppingcatnew/public/thumbnail/'.$branddata->image;
                //     }else
                //     {
                //         $image = '';
                //     }
                //   $info = array(
                //                 'id' => $branddata->id,
                //                 'category' => $category->name,
                //                 'name' => $branddata->name,
                //                 'description' => $branddata->description,
                //                 'image' => $image
                       
                //       );
                // }
                
            //   echo json_encode(array("response" => "success","message" => "Data fetched successfully .","data" =>  $newdataarray,"brand" => $info));
              echo json_encode(array("response" => "success","message" => "Data fetched successfully .","data" =>  $newdataarray));
            }else if($request->brand != '')
            {
                $explodebrand = explode(',',$request->brand);
                
                $finalbrand = array();
                foreach($explodebrand as $explodebranddata)
                {
                $brand = DB::table('tbl_brand')->where(array('name' => $explodebranddata))->first();
                $product = DB::table('tbl_product')->where(array('product_brand' => $explodebranddata))->get();
                 $newdataarray = array();
                foreach($product as $productdata)
                {
                    if($productdata->product_media != '')
                    {
                        $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$productdata->product_media;
                       
                    }else
                    {
                        $image = '';
                    }
                    if($productdata->product_gallery != '')
                    {
                        $explodegallery = explode(',',$productdata->product_gallery);
                        $productgallery = array();
                        foreach($explodegallery as $explodegallery)
                        {
                             $gallery = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$explodegallery;
                             array_push($productgallery,$gallery);
                        }
                       $gallery = implode(',',$productgallery);
                       
                    }else
                    {
                        $gallery = '';
                    }
                     $shipping = DB::table('tbl_inventory')->where(array('product_id' => $productdata->id ))->first();
                    if($shipping != '')
                    {
                        $minqty = $shipping->minqty;
                        $maxqty = $shipping->maxqty;
                    }else
                    {
                        $minqty = 0;
                        $maxqty = 0;
                    }
                    $rating = DB::table('tbl_rating')->where(array('pid' => $productdata->id ))->get();
                    $totrating = 0;
                    foreach($rating as $ratingfinal)
                    {
                        $totrating +=$ratingfinal->rating;
                    }
                    if(count($rating) === 0)
                    {
                        $ratingdata = 0;
                    }else
                    {
                         $ratingdata = $totrating/count($rating);
                    }
                     $taxdata = DB::table('tbl_tax')->where(array('id' => $productdata->tax ))->first();
                    $total_tax = 0;
                    if(isset($taxdata))
                    {
                        $total_tax = $taxdata->total_tax;
                    }
                     $shipping =  DB::table('tbl_product_shipping')->where(array('product_id' => $productdata->id ))->first();
                    $shippingprice = 0;
                    if($zone_city != '' && $shipping != '' && $shipping->weight != '')
                    {
                       
                        $shipping_zone = DB::table('shipping_zone')->where(array('zone_city' => $zone_city->city_id ))->get();
                        foreach($shipping_zone as $shipping_zone_data)
                        {
                            $shipping_method = DB::table('shipping_method')->where('start', '<', $shipping->weight)->where('end', '>', $shipping->weight)->where('unit','=',$shipping->unit)->first();
                           
                            if($shipping_method != '')
                            {
                                $shippingprice = $shipping_method->cost;
                            }else
                            {
                                $shippingprice = 0;
                            }
                        }
                    }else
                    {
                        $shippingprice = 0;
                    }
                    
                    $deliverydata = DB::table('tbl_deliverysetting')->where(array('id' => $productdata->deliveryflab ))->first();
                    $deliveryprice = 0;
                    if(isset($deliverydata))
                    {
                        $deliveryprice = $deliverydata->price;
                    }
                    $info  = array(
                                    "id" => $productdata->id,
                                    "product_name" => $productdata->product_name,
                                    "product_description" => $productdata->product_description,
                                    "product_category"=> $productdata->product_category,
                                    "product_detail_page" => $link."/".config('global.finalurl')."/public/frontend/".$productdata->product_name,
                                    "product_brand" =>  $productdata->product_brand,
                                    "product_media" =>  $image,
                                    "product_gallery"=> $gallery,
                                    "product_type"=> $productdata->product_type,
                                    "regular_price" =>  $productdata->regular_price,
                                    "sale_price" =>  $productdata->sale_price,
                                    "seo_title" => $productdata->seo_title,
                                    "seo_description" => $productdata->seo_description,
                                    "seo_url" => $productdata->seo_url,
                                    "seo_key"=> $productdata->seo_key,
                                    "download_limit"=> $productdata->download_limit,
                                    "download_file"=> $productdata->download_file,
                                    "download_url"=> $productdata->download_url,
                                    "sale_start_date"=> $productdata->sale_start_date,
                                    "sale_end_date"=> $productdata->sale_end_date,
                                    "download_expiary"=> $productdata->download_expiary,
                                    "up_sell"=> $productdata->up_sell,
                                    "cross_sell"=> $productdata->cross_sell,
                                    "product_url"=> $productdata->product_url,
                                    "btn_txt"=> $productdata->btn_txt,
                                    "taxstatus"=> $productdata->taxstatus,
                                    "minqty" => $minqty,
                                    "maxqty" => $maxqty,
                                    "rating" => $ratingdata,
                                    "tax" => $total_tax,
                                    "delivery_charge" => $shippingprice
                                
                            );
                    array_push($newdataarray,$info);
                }
                 array_push($finalbrand,$newdataarray);
                }
               
               echo json_encode(array("response" => "success","message" => "Data fetched successfully .","data" =>  $finalbrand));
            }
           
            else if($request->key != '')
            {
                // DB::enableQueryLog();
                $product = DB::table('tbl_product')->where('product_name', 'LIKE', '%'.$request->key.'%')->get();
                $newdataarray = array();
                foreach($product as $productdata)
                {
                    if($productdata->product_media != '')
                    {
                        $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$productdata->product_media;
                       
                    }else
                    {
                        $image = '';
                    }
                    if($productdata->product_gallery != '')
                    {
                        $explodegallery = explode(',',$productdata->product_gallery);
                        $productgallery = array();
                        foreach($explodegallery as $explodegallery)
                        {
                             $gallery = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$explodegallery;
                             array_push($productgallery,$gallery);
                        }
                       $gallery = implode(',',$productgallery);
                       
                    }else
                    {
                        $gallery = '';
                    }
                     $shipping = DB::table('tbl_inventory')->where(array('product_id' => $productdata->id ))->first();
                    if($shipping != '')
                    {
                        $minqty = $shipping->minqty;
                        $maxqty = $shipping->maxqty;
                    }else
                    {
                        $minqty = 0;
                        $maxqty = 0;
                    }
                    $rating = DB::table('tbl_rating')->where(array('pid' => $productdata->id ))->get();
                    $totrating = 0;
                    foreach($rating as $ratingfinal)
                    {
                        $totrating +=$ratingfinal->rating;
                    }
                    if(count($rating) === 0)
                    {
                        $ratingdata = 0;
                    }else
                    {
                         $ratingdata = $totrating/count($rating);
                    }
                     $taxdata = DB::table('tbl_tax')->where(array('id' => $productdata->tax ))->first();
                    $total_tax = 0;
                    if(isset($taxdata))
                    {
                        $total_tax = $taxdata->total_tax;
                    }
                    $shipping =  DB::table('tbl_product_shipping')->where(array('product_id' => $productdata->id ))->first();
                    $shippingprice = 0;
                    if($zone_city != '' && $shipping != '' && $shipping->weight != '')
                    {
                       
                        $shipping_zone = DB::table('shipping_zone')->where(array('zone_city' => $zone_city->city_id ))->get();
                        foreach($shipping_zone as $shipping_zone_data)
                        {
                            $shipping_method = DB::table('shipping_method')->where('start', '<', $shipping->weight)->where('end', '>', $shipping->weight)->where('unit','=',$shipping->unit)->first();
                           
                            if($shipping_method != '')
                            {
                                $shippingprice = $shipping_method->cost;
                            }else
                            {
                                $shippingprice = 0;
                            }
                        }
                    }else
                    {
                        $shippingprice = 0;
                    }
                    
                    $deliverydata = DB::table('tbl_deliverysetting')->where(array('id' => $productdata->deliveryflab ))->first();
                    $deliveryprice = 0;
                    if(isset($deliverydata))
                    {
                        $deliveryprice = $deliverydata->price;
                    }
                    $info  = array(
                                    "id" => $productdata->id,
                                    "product_name" => $productdata->product_name,
                                    "product_description" => $productdata->product_description,
                                    "product_category"=> $productdata->product_category,
                                    "product_detail_page" => $link."/".config('global.finalurl')."/public/frontend/".$productdata->product_name,
                                    "product_brand" =>  $productdata->product_brand,
                                    "product_media" =>  $image,
                                    "product_gallery"=> $gallery,
                                    "product_type"=> $productdata->product_type,
                                    "regular_price" =>  $productdata->regular_price,
                                    "sale_price" =>  $productdata->sale_price,
                                    "seo_title" => $productdata->seo_title,
                                    "seo_description" => $productdata->seo_description,
                                    "seo_url" => $productdata->seo_url,
                                    "seo_key"=> $productdata->seo_key,
                                    "download_limit"=> $productdata->download_limit,
                                    "download_file"=> $productdata->download_file,
                                    "download_url"=> $productdata->download_url,
                                    "sale_start_date"=> $productdata->sale_start_date,
                                    "sale_end_date"=> $productdata->sale_end_date,
                                    "download_expiary"=> $productdata->download_expiary,
                                    "up_sell"=> $productdata->up_sell,
                                    "cross_sell"=> $productdata->cross_sell,
                                    "product_url"=> $productdata->product_url,
                                    "btn_txt"=> $productdata->btn_txt,
                                    "taxstatus"=> $productdata->taxstatus,
                                    "minqty" => $minqty,
                                    "maxqty" => $maxqty,
                                    "rating" => $ratingdata,
                                    "tax" => $total_tax,
                                    "delivery_charge" => $shippingprice
                                
                            );
                    array_push($newdataarray,$info);
                }
               
               echo json_encode(array("response" => "success","message" => "Data fetched successfully .","data" =>  $newdataarray));
            }else if($request->productid != '')
            {
                $product = DB::table('tbl_product')->where(array('id' => $request->productid))->get();
               
                $newdataarray = array();
                foreach($product as $productdata)
                {
                    if($productdata->product_media != '')
                    {
                        $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$productdata->product_media;
                       
                    }else
                    {
                        $image = '';
                    }
                    if($productdata->product_gallery != '')
                    {
                        $explodegallery = explode(',',$productdata->product_gallery);
                        $productgallery = array();
                        foreach($explodegallery as $explodegallery)
                        {
                             $gallery = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$explodegallery;
                             array_push($productgallery,$gallery);
                        }
                       $gallery = implode(',',$productgallery);
                       
                    }else
                    {
                        $gallery = '';
                    }
                     $shipping = DB::table('tbl_inventory')->where(array('product_id' => $productdata->id ))->first();
                    if($shipping != '')
                    {
                        $minqty = $shipping->minqty;
                        $maxqty = $shipping->maxqty;
                    }else
                    {
                        $minqty = 0;
                        $maxqty = 0;
                    }
                     $rating = DB::table('tbl_rating')->where(array('pid' => $productdata->id ))->get();
                    $totrating = 0;
                    foreach($rating as $ratingfinal)
                    {
                        $totrating +=$ratingfinal->rating;
                    }
                    if(count($rating) === 0)
                    {
                        $ratingdata = 0;
                    }else
                    {
                         $ratingdata = $totrating/count($rating);
                    }
                     $taxdata = DB::table('tbl_tax')->where(array('id' => $productdata->tax ))->first();
                    $total_tax = 0;
                    if(isset($taxdata))
                    {
                        $total_tax = $taxdata->total_tax;
                    }
                    $shipping =  DB::table('tbl_product_shipping')->where(array('product_id' => $productdata->id ))->first();
                    $shippingprice = 0;
                    if($zone_city != '' && $shipping != '' && $shipping->weight != '')
                    {
                       
                        $shipping_zone = DB::table('shipping_zone')->where(array('zone_city' => $zone_city->city_id ))->get();
                        foreach($shipping_zone as $shipping_zone_data)
                        {
                            $shipping_method = DB::table('shipping_method')->where('start', '<', $shipping->weight)->where('end', '>', $shipping->weight)->where('unit','=',$shipping->unit)->first();
                           
                            if($shipping_method != '')
                            {
                                $shippingprice = $shipping_method->cost;
                            }else
                            {
                                $shippingprice = 0;
                            }
                        }
                    }else
                    {
                        $shippingprice = 0;
                    }
                    $deliverydata = DB::table('tbl_deliverysetting')->where(array('id' => $productdata->deliveryflab ))->first();
                    $deliveryprice = 0;
                    if(isset($deliverydata))
                    {
                        $deliveryprice = $deliverydata->price;
                    }
                    $info  = array(
                                    "id" => $productdata->id,
                                    "product_name" => $productdata->product_name,
                                    "product_description" => $productdata->product_description,
                                    "product_category"=> $productdata->product_category,
                                    "product_detail_page" => $link."/".config('global.finalurl')."/public/thumbnail/".$productdata->product_name,
                                    "product_brand" =>  $productdata->product_brand,
                                    "product_media" =>  $image,
                                    "product_gallery"=> $gallery,
                                    "product_type"=> $productdata->product_type,
                                    "regular_price" =>  $productdata->regular_price,
                                    "sale_price" =>  $productdata->sale_price,
                                    "seo_title" => $productdata->seo_title,
                                    "seo_description" => $productdata->seo_description,
                                    "seo_url" => $productdata->seo_url,
                                    "seo_key"=> $productdata->seo_key,
                                    "download_limit"=> $productdata->download_limit,
                                    "download_file"=> $productdata->download_file,
                                    "download_url"=> $productdata->download_url,
                                    "sale_start_date"=> $productdata->sale_start_date,
                                    "sale_end_date"=> $productdata->sale_end_date,
                                    "download_expiary"=> $productdata->download_expiary,
                                    "up_sell"=> $productdata->up_sell,
                                    "cross_sell"=> $productdata->cross_sell,
                                    "product_url"=> $productdata->product_url,
                                    "btn_txt"=> $productdata->btn_txt,
                                    "taxstatus"=> $productdata->taxstatus,
                                    "minqty" => $minqty,
                                    "maxqty" => $maxqty,
                                    "rating" => $ratingdata,
                                    "tax" => $total_tax,
                                    "delivery_charge" => $shippingprice
                                
                            );
                    array_push($newdataarray,$info);
                }
               echo json_encode(array("response" => "success","message" => "Data fetched successfully .","data" =>  $newdataarray));
            }else if($request->attribute != '')
            {
                if($request->attribute != '')
                {
                    $explodeattribute = explode(',',$request->attribute);
                    
                    $finalattribute = array();  
                    foreach($explodeattribute as $explodeattributedata)
                    {
                        
                        $productvarient = DB::table('tbl_product_varient')->where(array('term_id' => $explodeattributedata))->get();
                       
                        $newdataarray = array();
                        foreach($productvarient as $productvarient)
                        {
                            $productdata = DB::table('tbl_product')->where(array('id' => $productvarient->product_id))->first();
                           
                             if($productdata->product_media != '')
                            {
                                $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$productdata->product_media;
                               
                            }else
                            {
                                $image = '';
                            }
                            if($productdata->product_gallery != '')
                            {
                                $explodegallery = explode(',',$productdata->product_gallery);
                                $productgallery = array();
                                foreach($explodegallery as $explodegallery)
                                {
                                     $gallery = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$explodegallery;
                                     array_push($productgallery,$gallery);
                                }
                               $gallery = implode(',',$productgallery);
                               
                            }else
                            {
                                $gallery = '';
                            }
                             $shipping = DB::table('tbl_inventory')->where(array('product_id' => $productdata->id ))->first();
                            if($shipping != '')
                            {
                                $minqty = $shipping->minqty;
                                $maxqty = $shipping->maxqty;
                            }else
                            {
                                $minqty = 0;
                                $maxqty = 0;
                            }
                             $rating = DB::table('tbl_rating')->where(array('pid' => $productdata->id ))->get();
                            $totrating = 0;
                            foreach($rating as $ratingfinal)
                            {
                                $totrating +=$ratingfinal->rating;
                            }
                            if(count($rating) === 0)
                            {
                                $ratingdata = 0;
                            }else
                            {
                                 $ratingdata = $totrating/count($rating);
                            }
                             $taxdata = DB::table('tbl_tax')->where(array('id' => $productdata->tax ))->first();
                            $total_tax = 0;
                            if(isset($taxdata))
                            {
                                $total_tax = $taxdata->total_tax;
                            }
                            
                            $shipping =  DB::table('tbl_product_shipping')->where(array('product_id' => $productdata->id ))->first();
                            $shippingprice = 0;
                            if($zone_city != '' && $shipping != '' && $shipping->weight != '')
                            {
                               
                                $shipping_zone = DB::table('shipping_zone')->where(array('zone_city' => $zone_city->city_id ))->get();
                                foreach($shipping_zone as $shipping_zone_data)
                                {
                                    $shipping_method = DB::table('shipping_method')->where('start', '<', $shipping->weight)->where('end', '>', $shipping->weight)->where('unit','=',$shipping->unit)->first();
                                   
                                    if($shipping_method != '')
                                    {
                                        $shippingprice = $shipping_method->cost;
                                    }else
                                    {
                                        $shippingprice = 0;
                                    }
                                }
                            }else
                            {
                                $shippingprice = 0;
                            }
                    
                            $deliverydata = DB::table('tbl_deliverysetting')->where(array('id' => $productdata->deliveryflab ))->first();
                            $deliveryprice = 0;
                            if(isset($deliverydata))
                            {
                                $deliveryprice = $deliverydata->price;
                            }
                            $info  = array(
                                            "id" => $productdata->id,
                                            "product_name" => $productdata->product_name,
                                            "product_description" => $productdata->product_description,
                                            "product_category"=> $productdata->product_category,
                                            "product_detail_page" => $link."/".config('global.finalurl')."/public/frontend/".$productdata->product_name,
                                            "product_brand" =>  $productdata->product_brand,
                                            "product_media" =>  $image,
                                            "product_gallery"=> $gallery,
                                            "product_type"=> $productdata->product_type,
                                            "regular_price" =>  $productdata->regular_price,
                                            "sale_price" =>  $productdata->sale_price,
                                            "seo_title" => $productdata->seo_title,
                                            "seo_description" => $productdata->seo_description,
                                            "seo_url" => $productdata->seo_url,
                                            "seo_key"=> $productdata->seo_key,
                                            "download_limit"=> $productdata->download_limit,
                                            "download_file"=> $productdata->download_file,
                                            "download_url"=> $productdata->download_url,
                                            "sale_start_date"=> $productdata->sale_start_date,
                                            "sale_end_date"=> $productdata->sale_end_date,
                                            "download_expiary"=> $productdata->download_expiary,
                                            "up_sell"=> $productdata->up_sell,
                                            "cross_sell"=> $productdata->cross_sell,
                                            "product_url"=> $productdata->product_url,
                                            "btn_txt"=> $productdata->btn_txt,
                                            "taxstatus"=> $productdata->taxstatus,
                                            "minqty" => $minqty,
                                            "maxqty" => $maxqty,
                                            "rating" => $ratingdata,
                                            "tax" => $total_tax,
                                            "delivery_charge" => $shippingprice
                                        
                                    );
                            array_push($newdataarray,$info);
             
                        }
                         array_push($finalattribute,$newdataarray);
                        }
                   
                    echo json_encode(array("response" => "success","message" => "Data fetched successfully .","data" =>  $finalattribute));
                }
                else
                {
                    echo json_encode(array("response" => "success","message" => "Data not fetched successfully .","data" =>  ''));
                }
                
                
                
                
            }else
            if($request->seokey != '')
            {
                
               
                $seokey = DB::table('tbl_product')->where(array('seo_key' => $request -> seokey))->get();
                $newdataarray = array();
                foreach($seokey as $productdata)
                {
                    if($productdata->product_media != '')
                    {
                        $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$productdata->product_media;
                       
                    }else
                    {
                        $image = '';
                    }
                    if($productdata->product_gallery != '')
                    {
                        $explodegallery = explode(',',$productdata->product_gallery);
                        $productgallery = array();
                        foreach($explodegallery as $explodegallery)
                        {
                             $gallery = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$explodegallery;
                             array_push($productgallery,$gallery);
                        }
                       $gallery = implode(',',$productgallery);
                       
                    }else
                    {
                        $gallery = '';
                    }
                    $rating = DB::table('tbl_rating')->where(array('pid' => $productdata->id ))->get();
                    $totrating = 0;
                    foreach($rating as $ratingfinal)
                    {
                        $totrating +=$ratingfinal->rating;
                    }
                    if(count($rating) === 0)
                    {
                        $ratingdata = 0;
                    }else
                    {
                         $ratingdata = $totrating/count($rating);
                    }
                     $shipping = DB::table('tbl_inventory')->where(array('product_id' => $productdata->id ))->first();
                    if($shipping != '')
                    {
                        $minqty = $shipping->minqty;
                        $maxqty = $shipping->maxqty;
                    }else
                    {
                        $minqty = 0;
                        $maxqty = 0;
                    }
                    $stock = DB::table('stock')->where(array('productid' => $productdata->id ))->first();
                    if($stock != '')
                    {
                        $stockqty = $stock->stockqty;
                    }else
                    {
                         $stockqty = 0;
                    }
                     $taxdata = DB::table('tbl_tax')->where(array('id' => $productdata->tax ))->first();
                    $total_tax = 0;
                    if(isset($taxdata))
                    {
                        $total_tax = $taxdata->total_tax;
                    }
                    
                    $shipping =  DB::table('tbl_product_shipping')->where(array('product_id' => $productdata->id ))->first();
                    $shippingprice = 0;
                    if($zone_city != '' && $shipping != '' && $shipping->weight != '')
                    {
                       
                        $shipping_zone = DB::table('shipping_zone')->where(array('zone_city' => $zone_city->city_id ))->get();
                        foreach($shipping_zone as $shipping_zone_data)
                        {
                            $shipping_method = DB::table('shipping_method')->where('start', '<', $shipping->weight)->where('end', '>', $shipping->weight)->where('unit','=',$shipping->unit)->first();
                           
                            if($shipping_method != '')
                            {
                                $shippingprice = $shipping_method->cost;
                            }else
                            {
                                $shippingprice = 0;
                            }
                        }
                    }else
                    {
                        $shippingprice = 0;
                    }
                            
                    $deliverydata = DB::table('tbl_deliverysetting')->where(array('id' => $productdata->deliveryflab ))->first();
                    $deliveryprice = 0;
                    if(isset($deliverydata))
                    {
                        $deliveryprice = $deliverydata->price;
                    }
                    $info  = array(
                                    "id" => $productdata->id,
                                    "product_name" => $productdata->product_name,
                                    "product_description" => $productdata->product_description,
                                    "product_category"=> $productdata->product_category,
                                    "product_detail_page" => $link."/".config('global.finalurl')."/public/frontend/".$productdata->product_name,
                                    "product_brand" =>  $productdata->product_brand,
                                    "product_media" =>  $image,
                                    "product_gallery"=> $gallery,
                                    "product_type"=> $productdata->product_type,
                                    "regular_price" =>  $productdata->regular_price,
                                    "sale_price" =>  $productdata->sale_price,
                                    "seo_title" => $productdata->seo_title,
                                    "seo_description" => $productdata->seo_description,
                                    "seo_url" => $productdata->seo_url,
                                    "seo_key"=> $productdata->seo_key,
                                    "download_limit"=> $productdata->download_limit,
                                    "download_file"=> $productdata->download_file,
                                    "download_url"=> $productdata->download_url,
                                    "sale_start_date"=> $productdata->sale_start_date,
                                    "sale_end_date"=> $productdata->sale_end_date,
                                    "download_expiary"=> $productdata->download_expiary,
                                    "up_sell"=> $productdata->up_sell,
                                    "cross_sell"=> $productdata->cross_sell,
                                    "product_url"=> $productdata->product_url,
                                    "btn_txt"=> $productdata->btn_txt,
                                    "taxstatus"=> $productdata->taxstatus,
                                    "minqty" => $minqty,
                                    "maxqty" => $maxqty,
                                    "instock" => $stockqty,
                                    "rating" => $ratingdata,
                                    "tax" => $total_tax,
                                    "delivery_charge" => $shippingprice
                                
                            );
                    array_push($newdataarray,$info);
                }
               echo json_encode(array("response" => "success","message" => "Data fetched successfully .","data" =>  $newdataarray));
            }
            else
            {
              
                $product = DB::table('tbl_product')->get();
                $newdataarray = array();
                foreach($product as $productdata)
                {
                    if($productdata->product_media != '')
                    {
                        $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$productdata->product_media;
                       
                    }else
                    {
                        $image = '';
                    }
                    if($productdata->product_gallery != '')
                    {
                        $explodegallery = explode(',',$productdata->product_gallery);
                        $productgallery = array();
                        foreach($explodegallery as $explodegallery)
                        {
                             $gallery = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$explodegallery;
                             array_push($productgallery,$gallery);
                        }
                       $gallery = implode(',',$productgallery);
                       
                    }else
                    {
                        $gallery = '';
                    }
                    $rating = DB::table('tbl_rating')->where(array('pid' => $productdata->id ))->get();
                    $totrating = 0;
                    foreach($rating as $ratingfinal)
                    {
                        $totrating +=$ratingfinal->rating;
                    }
                    if(count($rating) === 0)
                    {
                        $ratingdata = 0;
                    }else
                    {
                         $ratingdata = $totrating/count($rating);
                    }
                     $shipping = DB::table('tbl_inventory')->where(array('product_id' => $productdata->id ))->first();
                    if($shipping != '')
                    {
                        $minqty = $shipping->minqty;
                        $maxqty = $shipping->maxqty;
                    }else
                    {
                        $minqty = 0;
                        $maxqty = 0;
                    }
                    $stock = DB::table('stock')->where(array('productid' => $productdata->id ))->first();
                    if($stock != '')
                    {
                        $stockqty = $stock->stockqty;
                    }else
                    {
                         $stockqty = 0;
                    }
                     $taxdata = DB::table('tbl_tax')->where(array('id' => $productdata->tax ))->first();
                    $total_tax = 0;
                    if(isset($taxdata))
                    {
                        $total_tax = $taxdata->total_tax;
                    }
                    
                    $shipping =  DB::table('tbl_product_shipping')->where(array('product_id' => $productdata->id ))->first();
                    $shippingprice = 0;
                    if($zone_city != '' && $shipping != '' && $shipping->weight != '')
                    {
                       
                        $shipping_zone = DB::table('shipping_zone')->where(array('zone_city' => $zone_city->city_id ))->get();
                        
                        foreach($shipping_zone as $shipping_zone_data)
                        {
                            $shipping_method = DB::table('shipping_method')->where('start', '<', $shipping->weight)->where('end', '>', $shipping->weight)->where('unit','=',$shipping->unit)->first();
                           
                            if($shipping_method != '')
                            {
                                $shippingprice = $shipping_method->cost;
                            }else
                            {
                                $shippingprice = 0;
                            }
                        }
                    }else
                    {
                        $shippingprice = 0;
                    }
                    
                    $deliverydata = DB::table('tbl_deliverysetting')->where(array('id' => $productdata->deliveryflab ))->first();
                    $deliveryprice = 0;
                    if(isset($deliverydata))
                    {
                        $deliveryprice = $deliverydata->price;
                    }
                    $info  = array(
                                    "id" => $productdata->id,
                                    "product_name" => $productdata->product_name,
                                    "product_description" => $productdata->product_description,
                                    "product_category"=> $productdata->product_category,
                                    "product_detail_page" => $link."/".config('global.finalurl')."/public/frontend/".$productdata->product_name,
                                    "product_brand" =>  $productdata->product_brand,
                                    "product_media" =>  $image,
                                    "product_gallery"=> $gallery,
                                    "product_type"=> $productdata->product_type,
                                    "regular_price" =>  $productdata->regular_price,
                                    "sale_price" =>  $productdata->sale_price,
                                    "seo_title" => $productdata->seo_title,
                                    "seo_description" => $productdata->seo_description,
                                    "seo_url" => $productdata->seo_url,
                                    "seo_key"=> $productdata->seo_key,
                                    "download_limit"=> $productdata->download_limit,
                                    "download_file"=> $productdata->download_file,
                                    "download_url"=> $productdata->download_url,
                                    "sale_start_date"=> $productdata->sale_start_date,
                                    "sale_end_date"=> $productdata->sale_end_date,
                                    "download_expiary"=> $productdata->download_expiary,
                                    "up_sell"=> $productdata->up_sell,
                                    "cross_sell"=> $productdata->cross_sell,
                                    "product_url"=> $productdata->product_url,
                                    "btn_txt"=> $productdata->btn_txt,
                                    "taxstatus"=> $productdata->taxstatus,
                                    "minqty" => $minqty,
                                    "maxqty" => $maxqty,
                                    "instock" => $stockqty,
                                    "rating" => $ratingdata,
                                    "tax" => $total_tax,
                                    "delivery_charge" => $shippingprice
                                
                            );
                    array_push($newdataarray,$info);
                }
               echo json_encode(array("response" => "success","message" => "Data fetched successfully .","data" =>  $newdataarray));
            }
    }
    function categorywisebrand(Request $request)
    {
        

         $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
       $brand = DB::select('SELECT * FROM tbl_brand WHERE tbl_brand.id IN ( SELECT DISTINCT  (product_brand ) FROM tbl_product WHERE product_category = '.$request->category.')');
      
       $newbrand = array();
       foreach($brand as $branddata)
            {
              
                if($branddata->image != '')
                {
                    $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$branddata->image;
                }else
                {
                    $image = '';
                }
               $info = array(
                            'id' => $branddata->id,
                            
                            'name' => $branddata->name,
                            'description' => $branddata->description,
                            'image' => $image
                   
                   );
                   array_push($newbrand,$info);
            }
            
           echo json_encode(array("response" => "success","message" => "Data fetched successfully .","brand" => $newbrand));
       
    }
    function poscategorywiseproduct(Request $request)
    {
        $product = DB::table('pos_product')->where(array('cat_id' => $request->category))->get();
        $posproduct = array();
        foreach($product as $product)
        {
            $productdetails = DB::table('tbl_product')->where(array('id' => $product->product_id))->first();
            $info = array(
                        'id' => $product->product_id,
                        'product_name'=>$productdetails->product_name 
                    );
            array_push($posproduct,$info);
        }
         echo json_encode(array("response" => "success","message" => "Data fetched successfully .","data" =>  $posproduct));
        
    }
    function profile(Request $request)
    {
        $user = DB::table('user')->where(array('mobile' => $request->mobile,'password' =>$request->password))->first();
        
        $info = array(
                    'id' => $user->id,
                    'firstName' => $user->firstName,
                    'LastName' => $user->lastName,
                    'email' => $user->email,
                    'mobile' => $user->mobile,
                    'shipping_address' => $user->shipping_address,
                    'billing_address' => $user->billing_address
                ); 
        echo json_encode(array("response" => "success","message" => "Data fetched successfully .","data" =>  $info));        
    }
    function updateprofile(Request $request)
    {
        $user = DB::table('user')->where(array('mobile' => $request->mobile,'password' =>$request->password))->first();
        
        $info = array(
                    
                    'firstName' => $request->firstName,
                    'LastName' => $request->lastName,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'shipping_address' => $request->shipping_address,
                    'billing_address' => $request->billing_address
                );
        $update = DB::table('user')->where(array('id' => $user->id))->update($info);
         $info = array(
                    'id' => $user->id,
                    'firstName' => $user->firstName,
                    'LastName' => $user->lastName,
                    'email' => $user->email,
                    'mobile' => $user->mobile,
                    'shipping_address' => $user->shipping_address,
                    'billing_address' => $user->billing_address
                );
        if($update == 1)
        {
            
            echo json_encode(array("response" => "success","message" => "Profile Updated successfully .","data" =>  $info));
        }else
        {
             echo json_encode(array("response" => "success","message" => "Profile Updated successfully .","data" =>  $info));
        }
    }
    function deletecartwhole(Request $request)
    {
        $result = DB::table('cart')->where(array(
                "cart_ref_id" => $request->cart_ref_id))->delete();
               
        if($result != '')
            {
                echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Cart Deleted Successfully",
                    
                    
                ));
            }
            else
            {
                echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Cart not Deleted Successfully",
                       
                        
                    ));
            }        
    }
    function cancelorder(Request $request)
    {
        $check = DB::table('orderdata')->where(array('id' => $request->order_id))->where('orderstatus','!=','Delivered')->update(array('orderstatus' => 'cancelled'));
        if($check != '')
        {
         echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Order Cancel Successfully.",
                   
                    
                    
                ));
        }else
        {
            echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Order Not Cancelled.",
                   
                    
                ));
        }
    }
    function cancelwholeorder(Request $request)
    {
        $check = DB::table('orderdata')->where(array('order_id' => $request->order_id))->where('orderstatus','!=','Delivered')->update(array('orderstatus' => 'cancelled'));
        if($check != '')
        {
         echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Order Cancel Successfully.",
                    
                    
                    
                ));
        }else
        {
            echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Order Not Cancelled.",
                   
                    
                ));
        }
    }
    function attributegetcategorywise(Request $request)
    {
        $check = DB::table('tbl_attribute')->where(array('category' => $request->category_id))->get();
        $attributearray = array();
        foreach($check as $data)
        {
            $terms = DB::table('attribute_terms')->where(array('attributeid' => $data->id))->get();
            $termarray = array();
            foreach($terms as $term)
            {
                $infoterm = array(
                            'id' => $term->id,
                            'name' => $term->name
                    );
                array_push($termarray,$infoterm);
            }
            $infoattribute = array(
                            'id' => $data->id,
                            'name' => $data->name,
                            'term' => $termarray
                    );
                    array_push($attributearray,$infoattribute);
            
        }
        if($check != '')
        {
         echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Data fetched Successfully.",
                    "data" => $attributearray
                    
                    
                ));
        }else
        {
            echo json_encode(
                array(
                    "response" => "failed",
                    "message" => "Data Not fetched.",
                 
                    
                ));
        }
    }
    
    /* POS API */
    function posregister(Request $request)
    {
       
        $data = json_decode(file_get_contents("php://input"));
        $enocde = base64_encode($request->first_name.$request->last_name.$request->email);
        $info = array(
                        'firstName' => $request->first_name,
                        'lastName' => $request->last_name,
                        'email'    => $request->email,
                        'password' => $request->password,
                        'mobile'   => $request->mobile,
                        'token'    => $enocde,
                        'usertype' => 'pos'    
                    );
                     
             
        $insert = DB::table('user')->insert($info);
        if($insert == 1)
        {
            http_response_code(200);
            echo json_encode(array("response" => "success","message" => "User registered successfully ."));
        }else
        {
            http_response_code(200);
            echo json_encode(array("response" => "failed","message" => "User registered successfully ."));
        }
        
    }
    function poslogin(Request $request)
    {
       
        $data = json_decode(file_get_contents("php://input"));
     
        $info = array(
                        'email' => $request->email,
                        'pin' => $request->pin
                    );
                    
                    
               
        $check = DB::table('user')->where($info)->first();
        if($check != '')
        {
            echo json_encode(array("response" => "success","code" => "200","data" => $check->id,"name" =>$check->firstName.' '.$check->lastName));
        }else
        {
            echo json_encode(array("response" => "failed","code" => "400"));
        }
        
    }
    function searchproductlist(Request $request)
    {
        $product = DB::table('tbl_product')->select('product_name')->get();
        if($product != '')
        {
            echo json_encode(array("response" => "success","code" => "200","data" => $product));
        }else
        {
            echo json_encode(array("response" => "failed","code" => "400"));
        }
    }
    function serchproduct(Request $request)
    {
        $product = DB::table('tbl_product')->where(array('product_name' => $request->product))->first();
        if($product != '')
        {
            echo json_encode(array("response" => "success","code" => "200","data" => $product));
        }else
        {
            echo json_encode(array("response" => "failed","code" => "400"));
        }
    }
    function posorderplace(Request $request)
    {
        $qty        = $request->quantity;
        $price      = $request->price;
        $product    = $request->product;
        $username   = $request->username;
        $discount   = $request->discount;
        $total      = $request->total;
        $changedue  = $request->changedue;
        $paymethod  = $request->paymethod;
        $tax        = $request->tax;
        $info = array(
                    'qty'           =>  $qty,
                    'price'         =>  $price,
                    'product_id'    =>  $product,
                    'username'      =>  $username,
                    'discount'      =>  $discount,
                    'total'         =>  $total,
                    'changedue'     =>  $changedue,
                    'paymethod'     =>  $paymethod,
                    'tax'           =>  $tax,
                    'orderdate'     =>  date('Y-m-d H:i:s')
            );
        $insert = DB::table('posorder')->insertGetId($info);
        $posorderdata = DB::table('posorder')->where(array('id' => $insert))->first();
        if($insert != 0)
        {
            echo  json_encode(array("response" => "success","code" => "200","data" => $insert));
        }else
        {
            echo json_encode(array("response" => "failed","code" => "400"));
        }
        
        
    }
    function posordergetdata(Request $request)
    {
        $getdata = DB::table('posorder')->where(array('id' => $request->product_id))->first();
        $products = explode(',',$getdata->product_id);
        $productnamearray = array();
            foreach($products as $productsdata)
            {
                $productname = DB::table('tbl_product')->where(array('id' => $productsdata))->first();
                array_push($productnamearray,$productname->product_name);
            }
        
        $info = array(
                    'product_name' => implode(',',$productnamearray),
                    'price'         => $getdata->price,
                    'qty'           => $getdata->qty,
                    'username'      => $getdata->username,
                    'discount'      => $getdata->discount,
                    'total'         => $getdata->total,
                    'changedue'     => $getdata->changedue,
                    'paymentmethod' => $getdata->paymethod,
                    'tax'          => $getdata->tax,
                    'orderdate'     => $getdata->orderdate
            );
        if($getdata != '')
        {
            echo  json_encode($info);
        }else
        {
            echo json_encode(array("response" => "failed","code" => "400"));
        }
    }
    function poscategorydata(Request $request)
    {
        $getdata = DB::table('tbl_categories')->get();
        
        
        if($getdata != '')
        {
            echo  json_encode(array("response" => "success","code" => "200","data" => $getdata));
        }else
        {
            echo json_encode(array("response" => "failed","code" => "400"));
        }
    }
    function poscategory(Request $request)
    {
        $getdata = DB::table('pos_category')->get();
        $catarray = array();
        foreach($getdata as $getdata)
        {
            $catgory = DB::table('tbl_categories')->where(array('id' => $getdata->category_id))->first();
            $info = array(
                            'id' => $catgory->id,
                            'name' => $catgory->name
                        );
            array_push($catarray,$info);
        }
        if($getdata != '')
        {
            echo  json_encode(array("response" => "success","code" => "200","data" => $catarray));
        }else
        {
            echo json_encode(array("response" => "failed","code" => "400"));
        }
    }
    function poscatproduct(Request $request)
    {
        $getdata = DB::table('tbl_product')->where(array('product_category' => $request->catid))->get();
        if($getdata != '')
        {
            echo  json_encode(array("response" => "success","code" => "200","data" => $getdata));
        }else
        {
            echo json_encode(array("response" => "failed","code" => "400"));
        }
    }
    function posproductgetid(Request $request)
    {
        $getdata = DB::table('tbl_product')->where(array('id' => $request->productid))->first();
        if($getdata != '')
        {
            $info = array(
                    'response' => "success",
                    'code'         => "200",
                    'id'            =>$getdata->id,
                    'product_name'  => $getdata->product_name,
                    'sale_price'      => $getdata->sale_price,
                  
            );
            echo  json_encode($info);
        }else
        {
            echo json_encode(array("response" => "failed","code" => "400"));
        }
    }
    function posholddata(Request $request)
    {
        $qty        = $request->quantity;
        $price      = $request->price;
        $product    = $request->product;
        $username   = $request->username;
        $discount   = $request->discount;
        $total      = $request->total;
        $changedue  = $request->changedue;
        $paymethod  = $request->paymethod;
        
        $info = array(
                    'qty'           =>  $qty,
                    'price'         =>  $price,
                    'product_id'    =>  $product,
                    'username'      =>  $username,
                    'discount'      =>  $discount,
                    'total'         =>  $total,
                    'changedue'     =>  $changedue,
                    'paymethod'     =>  $paymethod,
                    
            );
        $insert = DB::table('posholddata')->insertGetId($info);
        $posorderdata = DB::table('posholddata')->where(array('id' => $insert))->first();
        if($insert != 0)
        {
            echo  json_encode(array("response" => "success","code" => "200","data" => $insert));
        }else
        {
            echo json_encode(array("response" => "failed","code" => "400"));
        }
    }
    function poscustomer()
    {
        $data = DB::table('tbl_customer')->get();
        echo  json_encode(array("response" => "success","code" => "200","data" => $data));
    }
    function poscustomersearch(Request $request)
    {
         $data = DB::table('tbl_customer')->where('name','like',$request->name)->get();
         echo  json_encode(array("response" => "success","code" => "200","data" => $data));
    }
    function setproductfilter(Request $request)
    {
        // $explodeproducts = explode(',',$request->product);
        foreach($request->product as $explodeproduct)
        {
            $insert = DB::table('pos_product')->insert(['product_id' => $explodeproduct,'cat_id' => $request->category]);
        }
         echo  json_encode(array("response" => "success","code" => "200"));
    }
    function setcategoryfilter(Request $request)
    {
        
        foreach($request->category as $explodecategory)
        {
            $insert = DB::table('pos_category')->insert(['category_id' => $explodecategory]);
        }
         echo  json_encode(array("response" => "success","code" => "200"));
    }
    function getposholddata(Request $request)
    {
        $data = DB::table('posholddata')->first();
        $infodata = array();
        $explodeproduct = explode(',',$data->product_id);
        $explodeqty = explode(',',$data->qty);
        $explodesaleprice = explode(',',$data->price);
        foreach($explodeproduct as $key =>  $explodeproduct)
        {
            $productname = DB::table('tbl_product')->where(array('id' => $explodeproduct))->first();
            $info = array(
                         'id' => $explodeproduct,
                         'product_name' => $productname->product_name,
                         'qty'          => $explodeqty[$key],
                         'sale_price'  => $explodesaleprice[$key]
                    );
            array_push($infodata,$info);
        }
        $delete = DB::table('posholddata')->where(array('id' => $data->id))->delete();
        if($infodata != '')
        {
            echo  json_encode($infodata);
        }else
        {
            echo json_encode(array("response" => "failed","code" => "400"));
        }
    }
    function cod()
    {
        $data = DB::table('settings')->first();
        if($data->cashondelivery == 1)
        {
            echo json_encode(array("response" => "success","code" => "200",'data'=> 'COD'));
        }else
        {
             echo json_encode(array("response" => "failed","code" => "400",'data'=> 'COD'));
        }
    }
    
    public function setting()
    {
        $url = $_SERVER['HTTP_HOST'];
        $currency = DB::table('tbl_currency')->where('status','=','active')->first();
        $setting = DB::table('settings')->first();
        $tax = DB::table('tbl_tax')->get();
        $info = array('currency' => $currency->symbol,'logo' => $url.'/'.config('global.finalurl').'/public/productimg/'.$setting->logo,'logo2' => $url.'/'.config('global.finalurl').'/public/productimg/'.$setting->logo2,'cashondelivery' => $setting->cashondelivery,'delivery_charges' => $setting->deliverycharges,'tax' => $tax);
        echo  json_encode(array("response" => "success","code" => "200","data" => $info));
        
        
    }
    public function geticon()
    {
         $data = DB::table('tbl_icon')->get();
        if($data != '')
        {
            echo json_encode(array("response" => "success","code" => "200",'data'=> $data));
        }else
        {
             echo json_encode(array("response" => "failed","code" => "400",'data'=> $data));
        }
    }
    
    public function addrating(Request $request)
    {   
        $user = DB::table('user')->where(array('mobile' => $request->mobile,'password' =>$request->password))->first();
        if($user != "")
        {
            $info = array(
                    'pid' => $request->productid,
                    'user_id' => $user->id,
                    'rating' => $request->rating,
                    'comment' => $request->comment
            );
            $data = DB::table('tbl_rating')->insert($info);
            if($data != '')
            {
                echo json_encode(array("response" => "success","code" => "200",'message'=> 'rating added succefully'));
            }else
            {
                 echo json_encode(array("response" => "failed","code" => "400",'message'=> 'rating not added'));
            }
        }
        else if($request->user_id != "")
        {
            $info = array(
                        'pid' => $request->productid,
                        'user_id' => $request->user_id,
                        'rating' => $request->rating,
                        'comment' => $request->comment
                );
            $data = DB::table('tbl_rating')->insert($info);
            if($data != '')
            {
                echo json_encode(array("response" => "success","code" => "200",'message'=> 'rating added succefully'));
            }else
            {
                 echo json_encode(array("response" => "failed","code" => "400",'message'=> 'rating not added'));
            }
        }
    }
     public function wishlist(Request $request)
    {
        if(isset($request->userid))
        {
            
            
            $datas = DB::table('wishlist')->where(array('userid' => $request->userid))->get();
            $wishlistarray = array();
            foreach($datas as $data)
            {
                $product = DB::table('tbl_product')->where(array('id' => $data->productid))->first();
                $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
                
                if($product != '')
                {
                    $product_name = $product->product_name;
                    $saleprice =$product->sale_price;
                    if($product->regular_price == "")
                    {
                        $regularprice="0";
                    }
                    else
                    {
                    $regularprice = $product->regular_price;
                    }
                    if($product->product_media != '')
                    {
                        $image = $link.'/'.config('global.finalurl').'/public/thumbnail/'.$product->product_media;
                       
                    }else
                    {
                        $image = '';
                    }
                    
                }else
                {
                    $product_name = '';
                    $saleprice =0;
                    $regularprice =0;
                   
                        $image = '';
                    
                }
                 $stock = DB::table('stock')->where(array('productid' => $data->productid))->first();
                  if($stock != '')
                {
                    $stockqty = $stock->stockqty;
                }else
                {
                     $stockqty = 0;
                }
                 $shipping = DB::table('tbl_inventory')->where(array('product_id' => $data->productid ))->first();
                if($shipping != '')
                {
                    $minqty = $shipping->minqty;
                    $maxqty = $shipping->maxqty;
                }else
                {
                    $minqty = 0;
                    $maxqty = 0;
                }
                 if($product->sale_start_date < date('Y-m-d') && $product->sale_end_date > date('Y-m-d'))
                {
                    $saleprice =  $product->sale_price;
                }else
                {
                    $saleprice =  0;
                }
                $info = array(
                                'wishlist_id' => $data->id,
                                'product_id' => $data->productid,
                                'product_name' => $product_name,
                                'sale_price' => $saleprice,
                                'regular_price' =>$regularprice,
                                'total'     => $saleprice ,
                                'product_image' => $image,
                                'instock' => $stockqty,
                                'minqty' => $minqty,
                                'maxqty' => $maxqty
                               
                            );
                array_push($wishlistarray,$info);
            }
            if($data != '')
            {
                echo json_encode(array("response" => "success","code" => "200",'data'=> $wishlistarray));
            }else
            {
                 echo json_encode(array("response" => "failed","code" => "400",'data'=> $data));
            }
        }else{
            $user = DB::table('user')->where(array('mobile' => $request->mobile,'password' =>$request->password))->first();
        
            $data = DB::table('wishlist')->where(array('userid' => $user->id))->get();
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
            $productarray = [];
            
            foreach($data as $wishlist)
            {
                $product = DB::table('tbl_product')->where(array('id' => $wishlist->productid))->first();
                if( $product->regular_price != '')
                {
                    $regular_price = $product->regular_price;
                }else
                {
                    $regular_price = 0;
                }
                 if( $product->sale_price != '')
                {
                    $sale_price = $product->sale_price;
                }else
                {
                    $sale_price = 0;
                }
                $info = [
                            "id" => $wishlist->id,
                            "productid" => $wishlist->productid,
                            "userid" => $wishlist->userid,
                            "thumbnail" => $link.'/'.config('global.finalurl').'/public/thumbnail/'.$product->product_media,
                            "productname" => $product->product_name,
                            "regular_price" => $regular_price,
                            "sale_price" =>  $sale_price
                        ];
                array_push($productarray,$info);
            }
            if($data != '')
            {
                echo json_encode(array("response" => "success","code" => "200",'data'=> $productarray));
            }else
            {
                 echo json_encode(array("response" => "failed","code" => "400",'data'=> $productarray));
            } 
        }
    }
    public function addwishlist(Request $request)
    {
        if(isset($request->userid))
        {
            
            $existwishlist = DB::table('wishlist')->where(['productid' => $request->product,'userid' => $request->userid])->first();
            if($existwishlist == '')
            {
                $info = array('productid' => $request->product, 'userid' => $request->userid);
                $data = DB::table('wishlist')->insert($info);
           
            
                if($data != '')
                {
                    echo json_encode(array("response" => "success","code" => "200",'message'=> 'Wishlist added succefully'));
                }else
                {
                     echo json_encode(array("response" => "failed","code" => "401",'message'=> 'Wishlist not added'));
                }
            }else{
                  echo json_encode(array("response" => "failed","code" => "400",'message'=> 'Item allready added to wishlist'));
            }
        }else
        {
            $user = DB::table('user')->where(array('mobile' => $request->mobile,'password' =>$request->password))->first();
        
            // $product = explode(',',$request->product);
           
            // foreach($product as $productval)
            // {
            //     $existwishlist = DB::table('wishlist')->where()
            //     $info = array('productid' => $productval, 'userid' => $user->id);
            //     $data = DB::table('wishlist')->insert($info);
            // }
            $existwishlist = DB::table('wishlist')->where(['productid' => $request->product,'userid' => $user->id])->first();
            if($existwishlist == '')
            {
                 $info = array('productid' => $request->product, 'userid' => $user->id);
                $data = DB::table('wishlist')->insert($info);
                if($data != '')
                {
                    echo json_encode(array("response" => "success","code" => "200",'message'=> 'Wishlist added succefully'));
                }else
                {
                     echo json_encode(array("response" => "failed","code" => "400",'message'=> 'Wishlist not added'));
                }
            }else
            {
                 echo json_encode(array("response" => "failed","code" => "400",'message'=> 'Item allready added to wishlist'));
            }
        }
       
    }
    
    public function removeItemFromWishlist(Request $request)
    {
        $data = DB::table('wishlist')->where(array('id' => $request->wishlist_id))->delete();
            
        if($data != '')
        {
            echo json_encode(array("response" => "success","code" => "200","message" => "Item remove from wishlist successfully"));
        }else
        {
            echo json_encode(array("response" => "success","code" => "400","message" => "Item not remove from wishlist "));
        }
      
    }
    public function productwiseattribute(Request $request)
    {
         $attribute = DB::table('tbl_product_attribute')->where(array('product_id' => $request->product_id))->get();
         $attrarray = array();
         foreach($attribute as $attributeval)
         {
             $attr = DB::table('tbl_attribute')->where(array('id' => $attributeval->attribute_id))->first();
             $explodeterm = explode(',',$attributeval->term_id);
             $termarray = array();
             foreach($explodeterm as $explodetermval)
             {
                $term = DB::table('attribute_terms')->where(array('id' => $explodetermval))->first();
                 $infodata = array(
                                'id'  => $explodetermval,
                                'name' => $term->name
                            );
                array_push($termarray,$infodata);           
             }
             
             $infoattr = array(
                        'id' =>  $attributeval->attribute_id,
                        'name' => $attr->name,
                        'terms' => $termarray
                    
                        );
            array_push($attrarray,$infoattr);
             
         }
         if($attrarray != '')
        {
            echo json_encode(array("response" => "success","code" => "200",'data'=> $attrarray));
        }else
        {
             echo json_encode(array("response" => "failed","code" => "400",'data'=> $attrarray));
        }
    }
    
    public function servicecategory()
    {
        $data = DB::table('tbl_service')->where('pid',0)->get();
        $info = array();
        foreach($data as $dataval)
        {
            $subarray = array();
            $sub = DB::table('tbl_service')->where('pid',$dataval->id)->get();
           
            foreach ($sub as $key => $value) {
              $secondarray = array('id' => $value->id,'service_category' => $value->service_category);
              array_push($subarray,  $secondarray);

            }
            $firstarray = array('id' => $dataval->id,'service_category' => $dataval->service_category,'subcategory' => $subarray);
            array_push($info, $firstarray);
        }
        echo json_encode(array("response" => "success","code" => "200",'data'=> $info));
    }
    public function service(Request $request)
    {
        if($request->category != '')
        {
             $data = DB::table('services')->where('service_category','=',$request->category)->get();
        }else
        {
             $data = DB::table('services')->get();
        }
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
        $check = DB::table('services')->get();
        $info = array();
        
        foreach($data as $dataval)
        {
            if($dataval->image != '')
            {
                $image = $link.'/'.config('global.finalurl').'/public/contactimg/'.$dataval->image;
            }else
            {
                $image = '';
            }
           $durationdata = DB::table('duartion')->where('id',$dataval->duration)->first();
        
            $firstarray = array('id' => $dataval->id,'service_category' => $dataval->service_category,'service' => $dataval->service_name,'service_date' => $dataval->service_date,'duration' => $durationdata->duartion,'staff'=> $dataval->staff,'price' => $dataval->price,'image'  => $image,'description' => strip_tags($dataval->description));
            array_push($info, $firstarray);
        }
        echo json_encode(array("response" => "success","code" => "200",'data'=> $info));
    }
    public function staff(Request $request)
    {
        if($request->service != '')
        {
             $data = DB::table('services')->where('id','=',$request->service)->get();
        }else
        {
             $data = DB::table('tbl_staff')->get();
        }
       
        // $data = DB::table('tbl_staff')->get();
         $info = array();
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
        foreach($data as $dataval)
        {
           $staffdata = DB::table('tbl_staff')->where('id','=',$dataval->staff)->first();
            $firstarray = array('id' => $staffdata->id,'name' => $staffdata->name,'phone' => $staffdata->phone,'email' => $staffdata->email,'visibility' => $staffdata->visibility,'profile'=> $link.'/shopping/public/images/'.$staffdata->image);
            array_push($info, $firstarray);
        }
        echo json_encode(array("response" => "success","code" => "200",'data'=> $info));
    }
    public function timeslot(Request $request)
    {
    // DB::enableQueryLog();
        $day = date('D', strtotime($request->date));
        
        $data = DB::table('service_timeslot')->where(array('service_id' => $request->service,'day' => $day))->get();
        // dd(DB::getQueryLog());
        if($request->staff != '')
        {
        $servicedata = DB::table('services')->where(array('id' => $request->service))->first();
        $explodeservicestaff = explode(',', $servicedata->staff);
        
        if(in_array($request->staff, $explodeservicestaff))
        {
        
            $info = array();
            $firstarray = array();
            foreach($data as $dataval)
            {
               $time = explode(" ",$dataval->timeslot);
            
               if(strtotime($request->start_time) <= strtotime($time[0]) && strtotime($request->end_time) >= strtotime($time[2]) )
               {
                  $firstarray = array('id' => $dataval->id,'timeslot' => $dataval->timeslot);
               }else
               {
                    
               }
               if(!in_array($firstarray, $info))
               {
                    array_push($info, $firstarray);
               }
               
            }
        }else
        {
            $info = array();
        }
        }else
        {
             $info = array();
            $firstarray = array();
            foreach($data as $dataval)
            {
               $time = explode(" ",$dataval->timeslot);
            
               if(strtotime($request->start_time) <= strtotime($time[0]) && strtotime($request->end_time) >= strtotime($time[2]) )
               {
                  $firstarray = array('id' => $dataval->id,'timeslot' => $dataval->timeslot);
               }else
               {
                    
               }
               if(!in_array($firstarray, $info))
               {
                    array_push($info, $firstarray);
               }
               
            }
        }
        
        echo json_encode(array("response" => "success","code" => "200",'data'=> $info));
    }

    public function rating()
    {
        $data = DB::table('tbl_rating')->get();
        $info = array();
        foreach($data as $dataval)
        {
           
            $firstarray = array('id' => $dataval->id,'pid' => $dataval->pid,'rating'=>$dataval->rating,'comment' => $dataval->comment);
            array_push($info, $firstarray);
        }
        echo json_encode(array("response" => "success","code" => "200",'data'=> $info));
    }
    
    public function firebasetoken(Request $request)
    {
        if($request->oldtoken != '')
        {
            $info = array('newtoken' => $request->newtoken,'oldtoken' => $request->oldtoken);
            $update = DB::table('firebase_token')->where('oldtoken',$request->oldtoken)->update($info);
            echo json_encode(array("response" => "success","code" => "200",'msg'=> 'token update'));
        }else
        {
            $info = array('newtoken' => $request->newtoken,'oldtoken' => $request->newtoken);
            $insert = DB::table('firebase_token')->insert($info);
            echo json_encode(array("response" => "success","code" => "200",'msg'=> 'token inserted'));
        }
           
        
       
    }
    public function countries()
    {
        $data = DB::table('countries')->get();
        $info = array();
        foreach($data as $dataval)
        {
           
            $firstarray = array('id' => $dataval->id,'name'=>$dataval->name,'phonecode' => $dataval->phonecode);
            array_push($info, $firstarray);
        }
        echo json_encode(array("response" => "success","code" => "200",'data'=> $info));
    }
    public function addaddress(Request $request)
    {
        $user = DB::table('user')->where(array('mobile' => $request->mobile,'password' =>$request->password))->first();
        if($user != '')
        {
        
            $info =  array(
                        "user_id" => $user->id,
                        "shipping_name"  => $request->shippingname,
                        "shipping_flatno"  => $request->shippingflatno,
                        "shipping_landmark"  => $request->shippinglandmark,
                        "shipping_pincode"  => $request->shippingpincode,
                        "shipping_city"  => $request->shippingcity,
                        "shipping_state" => $request->shippingstate,
                        "shipping_country" => $request->shippingcountry,
                        "billing_name" => $request->billingname,
                        "billing_mobile" => $request->billingmobile,
                        "billing_addressline" => $request->billingaddress,
                        "billing_pincode" => $request->billingpincode,
                        "billing_city" => $request->billingcity,
                        "biling_state" => $request->billingstate,
                        "billing_country" => $request->billingcountry,
                        
            );
            $result = DB::table('tbl_address')->insertGetId($info);
       
        
            if($result != "")
            {
                $info = DB::table('tbl_address')->where('id','=',$result)->first();
                echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Address Added Successfully",
                    "data" =>$info
                    
                    
                    
                ));
            }else
            {
                echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Address not added Successfully",
                       
                        
                    ));
            }
        }else if($request->user_id != "")
        {
            $info =  array(
                        "user_id" => $request->user_id,
                        "shipping_name"  => $request->shippingname,
                        "shipping_flatno"  => $request->shippingflatno,
                        "shipping_landmark"  => $request->shippinglandmark,
                        "shipping_pincode"  => $request->shippingpincode,
                        "shipping_city"  => $request->shippingcity,
                        "shipping_state" => $request->shippingstate,
                        "shipping_country" => $request->shippingcountry,
                        "billing_name" => $request->billingname,
                        "billing_mobile" => $request->billingmobile,
                        "billing_addressline" => $request->billingaddress,
                        "billing_pincode" => $request->billingpincode,
                        "billing_city" => $request->billingcity,
                        "biling_state" => $request->billingstate,
                        "billing_country" => $request->billingcountry,
                        
            );
            $result = DB::table('tbl_address')->insertGetId($info);
       
        
            if($result != "")
            {
                $info = DB::table('tbl_address')->where('id','=',$result)->first();
                echo json_encode(
                array(
                    "response" => "success",
                    "message" => "Address Added Successfully",
                    "data" =>$info
                    
                    
                    
                ));
            }else
            {
                echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Address not added Successfully",
                       
                        
                    ));
            }
        }
        else 
        {
             echo json_encode(
                    array(
                        "response" => "failed",
                        "message" => "Address not added Successfully",
                       
                        
                    ));
        }
    }
    
    public function ezpay_initail(Request $request)
    {
        $newarray = array(
                
                'operation'  => $request->operation,
                'bmaster_encode'  => $request->bmaster_encode,
                'name'  => $request->name,
                'email'  => $request->email,
                'phone'  => $request->phone,
                'amount' => $request->amount,
                'title'  => $request->title,
             );
      
        $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = "https://publicapi.ledgers.cloud/m/app/public/public-pay-api";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);
        echo json_encode(array("response" => "success","code" => "200",'data'=> $result));
    }
    
    public function ezpay_payment_details(Request $request)
    {
        $newarray = array(
                
                'operation'  => $request->operation,
                'bmaster_encode'  => $request->bmaster_encode,
                'paymentinfo'  => $request->paymentinfo,
            );
      
        $fields_string = http_build_query($newarray);
        $handle = curl_init();
                  
        $url = "https://publicapi.ledgers.cloud/m/app/public/public-pay-api";
        
  
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle,CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS, $fields_string);
  
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
   
        $output = curl_exec($handle);
     
   
        curl_close($handle);

        $result =  json_decode($output);
        echo json_encode(array("response" => "success","code" => "200",'data'=> $result));
    }
    function countrydata(Request $request)
    {
        $countrydata = DB::table('country_list')->get();
        
        http_response_code(200);
        echo json_encode(array("response" => "success","message" => "Data fetched successfully .","data" =>$countrydata));
            
    }
    function statedata(Request $request)
    {
        $statedata = DB::table('state_list')->where(['country_id' => $request->country_id])->get();
        
        http_response_code(200);
        echo json_encode(array("response" => "success","message" => "Data fetched successfully .","data" =>$statedata));
            
    }
    function citydata(Request $request)
    {
        $citydata = DB::table('city_list')->where(['state_id' => $request->state_id])->get();
        
        http_response_code(200);
        echo json_encode(array("response" => "success","message" => "Data fetched successfully .","data" =>$citydata));
            
    }
    
}
?>