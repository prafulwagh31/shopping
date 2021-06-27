<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Export\productExport;
use App\Export\leadExport;
use App\Imports\BulkImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Image;
class ImportExportController extends Controller
{
    /**
    * 
    */
    public function importExportView()
    {
       return view('importexport');
    }
    public function storeMedia(Request $request)
    {
        $path = 'productimg';
    
    
        $file = $request->file('file');
        $name = str_replace(' ','',$file->getClientOriginalName());
         
    
       
        $destinationPath = public_path('/thumbnail');
        $img = Image::make($file->path());
        $img->resize(336, 223, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$name);
   
        $destinationPath = public_path('/productimg');
        $file->move($destinationPath, $name);
      
    
        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
    public function import(Request $request) 
    {
    	$data = Excel::toArray(new BulkImport,request()->file('file'));
        $final = $data[0];
       
    
        foreach($final as $finalkey =>  $dataval)
        {
            $cat_id = 0;
            if(isset($dataval['category']))
            {
         	$category = DB::table('tbl_categories')->where(array('name' => $dataval['category']))->first();
            
          
          
            
            if($category != '')
            {
                $cat_id = $category->id;
                $subcategoryonedata = DB::table('tbl_categories')->where(array('name' => $dataval['subcategoryone']))->first();
                $subcategorytwodata = DB::table('tbl_categories')->where(array('name' => $dataval['subcategorytwo']))->first();
                
                if($subcategoryonedata != '')
                {
                    if($subcategorytwodata != '')
                    {
                        $cat_id = $subcategorytwodata->id;
                    }else
                    {
                         $cat_id = $subcategoryonedata->id;
                    }
                   
                }else if($subcategoryonedata == '')
                {
                    $subcat_arr = array(
                                'name' => $dataval['subcategoryone'],
                                'pid' => $category->id,
                               
                            );
                            $subcatonedata = DB::table('tbl_categories')->insertGetId($subcat_arr);
                     
                     $cat_id = $category->id;
                    
                }else if($subcategorytwodata == '' && $subcategoryonedata == '')
                {
                    
                }
             
            }else
            {    
               
                        
                        
                           
                        if($dataval['subcategoryone'] != '')
                        {
                            $cat_arr = array(
                                'name' => $dataval['category'],
                                'pid' => 0,
                               
                            );
                            $cat_iddata = DB::table('tbl_categories')->insertGetId($cat_arr); 
                           
                            $subcat_arr = array(
                                'name' => $dataval['subcategoryone'],
                                'pid' => $cat_iddata,
                               
                            );
                            $subcatonedata = DB::table('tbl_categories')->insertGetId($subcat_arr);
                            $cat_id = $subcatonedata;
                                if($dataval['subcategorytwo'] != '')
                                { 
                                    $subcattwo_arr = array(
                                        'name' => $dataval['subcategorytwo'],
                                        'pid' => $subcatonedata,
                                       
                                    );
                                   
                                    $cat_id = DB::table('tbl_categories')->insertGetId($subcattwo_arr);
                                }
                        }else
                        {
                             $cat_arr = array(
                                'name' => $dataval['category'],
                                'pid' => 0,
                               
                            );
                            $cat_id = DB::table('tbl_categories')->insertGetId($cat_arr); 
                        }
                    
               
            }
            }

            $brand = DB::table('tbl_brand')->where(array('name' => $dataval['brand']))->first();
            if($brand != '')
            {
                $brand_id = $brand->id;
            }else
            {
                $brand_arr = array(
                                'name' => $dataval['brand'],
                                
                               
                            );
                $brand_id = DB::table('tbl_brand')->insertGetId($brand_arr);
            }

            if($dataval['product_type'] == 'simple')
            {
                $product_type_id = 1;
            }else if($dataval['product_type'] == 'Group')
            {
                $product_type_id = 2;
            }else if($dataval['product_type'] == 'External/Affilate')
            {
                $product_type_id = 3;
            }else if($dataval['product_type'] == 'virtual')
            {
                $product_type_id = 4;
            }
            else if($dataval['product_type'] == 'download')
            {
                $product_type_id = 5;
            }
            else
            {
                $product_type_id = 0;
            }

            $explodeattribute  = explode(',',$dataval['attribute']);

            foreach ($explodeattribute as $key => $explodeattributevalue) {
                $attribute = DB::table('tbl_attribute')->where(array('name' => $explodeattributevalue))->first();
                if($attribute != '')
                {
                    $attribute_id = $attribute->id;
                }else
                {
                    $attr_arr = array('name' => $explodeattributevalue,
                        
                        'description' => $explodeattributevalue,
                        'slug' => $explodeattributevalue,
                        );
                    $attribute_id = DB::table('tbl_attribute')->insertGetId($attr_arr);
                }
            }

            $explodeterms  = explode(',',$dataval['term']);
            foreach ($explodeterms as $key => $explodetermsvalue) {
                $terms = DB::table('attribute_terms')->where(array('name' => $explodetermsvalue))->first();
                $attributenewterm = DB::table('tbl_attribute')->where(array('name' => $explodeattribute[$key]))->first();
                if($terms != '')
                {
                    $terms_id = $terms->id;
                }else
                {
                    $attr_arr = array('name' => $explodetermsvalue,
                        'color' => '',
                        'attributeid' => $attributenewterm->id,
                        'description' => $explodetermsvalue,
                        'slug' => $explodetermsvalue,
                        );
                     $terms_id = DB::table('attribute_terms')->insertGetId($attr_arr);
                }
            }
                if($dataval['title'] != '')
                {
                    if($product_type_id == 5)
                    {
                         $info = array(
                                'product_name'        => $dataval['title'],
                                'product_description' => $dataval['description'],
                                'hsn'                 => $dataval['hsn'],
                                'product_category'    => $cat_id,
                                'product_brand'       => $brand_id,
                                'product_media'       => str_replace(' ','',$dataval['media']),
                                
                                'product_type'        => $product_type_id,
                                'regular_price'       => $dataval['regular_price'],
                                'sale_price'          => $dataval['sale_price'],
                                'seo_title'           => $dataval['seo_title'],
                                'seo_description'     => $dataval['seo_description'],
                                'seo_url'             => $dataval['seo_url'],
                                'sale_start_date'       => $dataval['sale_start_date'],
                                'sale_end_date'         => $dataval['sale_end_date'],
                                'download_limit'        => $dataval['downloadlimit'],
                                'download_expiary'      => $dataval['downloadexpairy'],
                                'download_file'         => $dataval['downloadfile'],
                                'download_url'          => $dataval['downloadurl'],
                                'seo_key'               => $dataval['seokey'],
                                'product_gallery'       => $dataval['productgallery'],
                                'up_sell'               => $dataval['upsell'],
                                'cross_sell'            => $dataval['crosssell'],
                                'taxstatus'             => $dataval['taxstatus'],
                                'specification'     => $dataval['specification'],
                            );
                    $insertproduct = DB::table('tbl_product')->insertGetId($info);
                    }else if($product_type_id == 3){
                         $info = array(
                                'product_name'        => $dataval['title'],
                                'product_description' => $dataval['description'],
                                'hsn'                 => $dataval['hsn'],
                                'product_category'    => $cat_id,
                                'product_brand'       => $brand_id,
                                'product_media'       => str_replace(' ','',$dataval['media']),
                                'product_type'        => $product_type_id,
                                'regular_price'       => $dataval['regular_price'],
                                'sale_price'          => $dataval['sale_price'],
                                'seo_title'           => $dataval['seo_title'],
                                'seo_description'     => $dataval['seo_description'],
                                'seo_url'             => $dataval['seo_url'],
                                'sale_start_date'       => $dataval['sale_start_date'],
                                'sale_end_date'         => $dataval['sale_end_date'],
                                'download_limit'        => $dataval['downloadlimit'],
                                'download_expiary'      => $dataval['downloadexpairy'],
                                'download_file'         => $dataval['downloadfile'],
                                'download_url'          => $dataval['downloadurl'],
                                'seo_key'               => $dataval['seokey'],
                                'product_gallery'       => $dataval['productgallery'],
                                'up_sell'               => $dataval['upsell'],
                                'cross_sell'            => $dataval['crosssell'],
                                'product_url'           => $dataval['producturl'],
                                'btn_txt'               => $dataval['buttontxt'],
                                'taxstatus'             => $dataval['taxstatus'],
                                'specification'     => $dataval['specification'],
                            );
                        $insertproduct = DB::table('tbl_product')->insertGetId($info);
                    }else
                    {
                        $info = array(
                                'product_name'        => $dataval['title'],
                                'product_description' => $dataval['description'],
                                'hsn'                 => $dataval['hsn'],
                                'product_category'    => $cat_id,
                                'product_brand'       => $brand_id,
                                'product_media'       => str_replace(' ','',$dataval['media']),
                                'product_type'        => $product_type_id,
                                'regular_price'       => $dataval['regular_price'],
                                'sale_price'          => $dataval['sale_price'],
                                'seo_title'           => $dataval['seo_title'],
                                'seo_description'     => $dataval['seo_description'],
                                'seo_url'             => $dataval['seo_url'],
                                'sale_start_date'       => $dataval['sale_start_date'],
                                'sale_end_date'         => $dataval['sale_end_date'],
                                'seo_key'               => $dataval['seokey'],
                                'product_gallery'       => $dataval['productgallery'],
                                'up_sell'               => $dataval['upsell'],
                                'cross_sell'            => $dataval['crosssell'],
                                'taxstatus'             => $dataval['taxstatus'],
                                'specification'     => $dataval['specification'],
                            );
                    $insertproduct = DB::table('tbl_product')->insertGetId($info);
                    }
                    
                    if($insertproduct != 0)
                    {
                        $info2 = array(
                                    'product_id' => $insertproduct,
                                    'term_id'    => $terms_id,
                                    
                             );
                        $insertproductvarient = DB::table('tbl_product_varient')->insert($info2);
                        if($insertproductvarient == 1)
                        {
                             $info3 = array(
                                    'product_id' => $insertproduct,
                                    'sku'        => $dataval['sku'],
                                    'barcode'    => $dataval['barcode'],
                                    'minqty'        => $request->minquantity,
                                    'maxqty'        => $request->maxquantity
                                );
                             $insertproductinventory = DB::table('tbl_inventory')->insertGetId($info3);
                             if($insertproductinventory != '')
                             {
                                if($product_type_id != 4)
                                {
                                        $info4 = array(
                                        'weight'        => $dataval['weight'],
                                        'unit'          => $dataval['unit'],
                                        'country'       => $dataval['country'],
                                        'product_id'    => $insertproduct,
                                        'length'        =>  $request->length,
                                        'width'         =>  $request->width,
                                        'height'        =>  $request->height
                                    );
                                    $shipping = DB::table('tbl_product_shipping')->insert($info4);
                                        if($shipping)
                                        {
                                            
    
                                        }
                                }else
                                {
    
                                }
                                
                             } 
                        }
                    }
                }
            
        }

        return redirect('importproduct')->with('success_message', 'Product added successfully');
        
	}
	public function updateimport(Request $request)
	{
	    	$data = Excel::toArray(new BulkImport,request()->file('file'));
        $final = $data[0];
       
    
        foreach($final as $finalkey =>  $dataval)
        {
          
         
         	$category = DB::table('tbl_categories')->where(array('name' => $dataval['category']))->first();
            
          
           
            
            // if($category != '')
            // {
               
            //     $subcategoryonedata = DB::table('tbl_categories')->where(array('name' => $dataval['subcategoryone']))->first();
            //     $subcategorytwodata = DB::table('tbl_categories')->where(array('name' => $dataval['subcategorytwo']))->first();
                
            //     if($subcategoryonedata != '')
            //     {
            //         if($subcategorytwodata != '')
            //         {
            //             $cat_id = $subcategorytwodata->id;
            //         }else
            //         {
            //              $cat_id = $subcategoryonedata->id;
            //         }
                   
            //     }else if($subcategoryonedata == '')
            //     {
                   
            //          $subcat_arr = array(
            //                     'name' => $dataval['subcategoryone'],
            //                     'pid' => $category->id,
                               
            //                 );
            //                 $subcatonedata = DB::table('tbl_categories')->insertGetId($subcat_arr);
            //          $cat_id = $subcatonedata;
            //     }else if($subcategorytwodata == '' && $subcategoryonedata == '')
            //     {
                    
            //     }
                 
            // }else
            // {    
               
                        
                        
                           
            //             if($dataval['subcategoryone'] != '')
            //             {
            //                 $cat_arr = array(
            //                     'name' => $dataval['category'],
            //                     'pid' => 0,
                               
            //                 );
            //                 $cat_iddata = DB::table('tbl_categories')->insertGetId($cat_arr); 
                           
            //                 $subcat_arr = array(
            //                     'name' => $dataval['subcategoryone'],
            //                     'pid' => $cat_iddata,
                               
            //                 );
            //                 $subcatonedata = DB::table('tbl_categories')->insertGetId($subcat_arr);
            //                 $cat_id = $subcatonedata;
            //                     if($dataval['subcategorytwo'] != '')
            //                     { 
            //                         $subcattwo_arr = array(
            //                             'name' => $dataval['subcategorytwo'],
            //                             'pid' => $subcatonedata,
                                       
            //                         );
                                   
            //                         $cat_id = DB::table('tbl_categories')->insertGetId($subcattwo_arr);
            //                     }
            //             }else
            //             {
            //                  $cat_arr = array(
            //                     'name' => $dataval['category'],
            //                     'pid' => 0,
                               
            //                 );
            //                 $cat_iddata = DB::table('tbl_categories')->insertGetId($cat_arr); 
            //             }
                    
               
            // }
            
               
            if($category != '')
            {
                $cat_id = $category->id;
              
             
            }else
            {    
               
                             $cat_arr = array(
                                'name' => $dataval['category'],
                                'pid' => 0,
                               
                            );
                            $cat_id = DB::table('tbl_categories')->insertGetId($cat_arr); 
                      
                    
               
            }
            

            $brand = DB::table('tbl_brand')->where(array('name' => $dataval['brand']))->first();
            if($brand != '')
            {
                $brand_id = $brand->id;
            }else
            {
                $brand_arr = array(
                                'name' => $dataval['brand'],
                                
                               
                            );
                $brand_id = DB::table('tbl_brand')->insertGetId($brand_arr);
            }

            if($dataval['product_type'] == 'simple')
            {
                $product_type_id = 1;
            }else if($dataval['product_type'] == 'Group')
            {
                $product_type_id = 2;
            }else if($dataval['product_type'] == 'External/Affilate')
            {
                $product_type_id = 3;
            }else if($dataval['product_type'] == 'virtual')
            {
                $product_type_id = 4;
            }
            else if($dataval['product_type'] == 'download')
            {
                $product_type_id = 5;
            }
            else
            {
                $product_type_id = 0;
            }

            $explodeattribute  = explode(',',$dataval['attribute']);

            foreach ($explodeattribute as $key => $explodeattributevalue) {
                $attribute = DB::table('tbl_attribute')->where(array('name' => $explodeattributevalue))->first();
                if($attribute != '')
                {
                    $attribute_id = $attribute->id;
                }else
                {
                    $attr_arr = array('name' => $explodeattributevalue,
                        
                        'description' => $explodeattributevalue,
                        'slug' => $explodeattributevalue,
                        );
                    $attribute_id = DB::table('tbl_attribute')->insertGetId($attr_arr);
                }
            }

            $explodeterms  = explode(',',$dataval['term']);
            foreach ($explodeterms as $key => $explodetermsvalue) {
                $terms = DB::table('attribute_terms')->where(array('name' => $explodetermsvalue))->first();
                $attributenewterm = DB::table('tbl_attribute')->where(array('name' => $explodeattribute[$key]))->first();
                if($terms != '')
                {
                    $terms_id = $terms->id;
                }else
                {
                    $attr_arr = array('name' => $explodetermsvalue,
                        'color' => '',
                        'attributeid' => $attributenewterm->id,
                        'description' => $explodetermsvalue,
                        'slug' => $explodetermsvalue,
                        );
                     $terms_id = DB::table('attribute_terms')->insertGetId($attr_arr);
                }
            }
            
            $productdata = DB::table('tbl_product')->where(array('product_name' =>  $dataval['title']))->first();
                if($product_type_id == 5)
                {
                     $info = array(
                            'product_name'        => $dataval['title'],
                            'product_description' => $dataval['description'],
                            'hsn'                 => $dataval['hsn'],
                            'product_category'    => $category->id,
                            'product_brand'       => $brand_id,
                            'product_media'       => str_replace(' ','',$dataval['media']),
                            
                            'product_type'        => $product_type_id,
                            'regular_price'       => $dataval['regular_price'],
                            'sale_price'          => $dataval['sale_price'],
                            'seo_title'           => $dataval['seo_title'],
                            'seo_description'     => $dataval['seo_description'],
                            'seo_url'             => $dataval['seo_url'],
                            'sale_start_date'       => $dataval['sale_start_date'],
                            'sale_end_date'         => $dataval['sale_end_date'],
                            'download_limit'        => $dataval['downloadlimit'],
                            'download_expiary'      => $dataval['downloadexpairy'],
                            'download_file'         => $dataval['downloadfile'],
                            'download_url'          => $dataval['downloadurl'],
                            'seo_key'               => $dataval['seokey'],
                            'product_gallery'       => $dataval['productgallery'],
                            'up_sell'               => $dataval['upsell'],
                            'cross_sell'            => $dataval['crosssell'],
                            'taxstatus'             => $dataval['taxstatus'],
                        );
                $insertproduct = DB::table('tbl_product')->where(array('id' =>  $productdata->id))->update($info);
                }else if($product_type_id == 3){
                     $info = array(
                            'product_name'        => $dataval['title'],
                            'product_description' => $dataval['description'],
                            'hsn'                 => $dataval['hsn'],
                            'product_category'    => $category->id,
                            'product_brand'       => $brand_id,
                            'product_media'       => str_replace(' ','',$dataval['media']),
                            'product_type'        => $product_type_id,
                            'regular_price'       => $dataval['regular_price'],
                            'sale_price'          => $dataval['sale_price'],
                            'seo_title'           => $dataval['seo_title'],
                            'seo_description'     => $dataval['seo_description'],
                            'seo_url'             => $dataval['seo_url'],
                            'sale_start_date'       => $dataval['sale_start_date'],
                            'sale_end_date'         => $dataval['sale_end_date'],
                            'download_limit'        => $dataval['downloadlimit'],
                            'download_expiary'      => $dataval['downloadexpairy'],
                            'download_file'         => $dataval['downloadfile'],
                            'download_url'          => $dataval['downloadurl'],
                            'seo_key'               => $dataval['seokey'],
                            'product_gallery'       => $dataval['productgallery'],
                            'up_sell'               => $dataval['upsell'],
                            'cross_sell'            => $dataval['crosssell'],
                            'product_url'           => $dataval['producturl'],
                            'btn_txt'               => $dataval['buttontxt'],
                            'taxstatus'             => $dataval['taxstatus'],
                        );
                    $insertproduct = DB::table('tbl_product')->where(array('id' =>  $productdata->id))->update($info);
                }else
                {
                    $info = array(
                            'product_name'        => $dataval['title'],
                            'product_description' => $dataval['description'],
                            'hsn'                 => $dataval['hsn'],
                            'product_category'    => $category->id,
                            'product_brand'       => $brand_id,
                            'product_media'       => str_replace(' ','',$dataval['media']),
                            'product_type'        => $product_type_id,
                            'regular_price'       => $dataval['regular_price'],
                            'sale_price'          => $dataval['sale_price'],
                            'seo_title'           => $dataval['seo_title'],
                            'seo_description'     => $dataval['seo_description'],
                            'seo_url'             => $dataval['seo_url'],
                            'sale_start_date'       => $dataval['sale_start_date'],
                            'sale_end_date'         => $dataval['sale_end_date'],
                            'seo_key'               => $dataval['seokey'],
                            'product_gallery'       => $dataval['productgallery'],
                            'up_sell'               => $dataval['upsell'],
                            'cross_sell'            => $dataval['crosssell'],
                            'taxstatus'             => $dataval['taxstatus'],
                        );
                $insertproduct = DB::table('tbl_product')->where(array('id' =>  $productdata->id))->update($info);
                }
                
                $productvarient = DB::table('tbl_product_varient')->where(array('product_id' =>  $productdata->id))->first();
                    $info2 = array(
                                
                                'term_id'    => $terms_id,
                                
                         );
                    $insertproductvarient = DB::table('tbl_product_varient')->where(array('product_id' =>  $productvarient->product_id))->update($info2);
                    
                $productinventorydata = DB::table('tbl_inventory')->where(array('product_id' =>  $productdata->id))->first();   
                         $info3 = array(
                                'product_id' => $insertproduct,
                                'sku'        => $dataval['sku'],
                                'barcode'    => $dataval['barcode'],
                                'minqty'        => $request->minquantity,
                                'maxqty'        => $request->maxquantity
                            );
                         $insertproductinventory = DB::table('tbl_inventory')->where(array('product_id' =>  $productdata->id))->update($info3);
                        
                            if($product_type_id != 4)
                            {
                                $productshippingdata = DB::table('tbl_product_shipping')->where(array('product_id' =>  $productdata->id))->first(); 
                                    $info4 = array(
                                    'weight'        => $dataval['weight'],
                                    'unit'          => $dataval['unit'],
                                    'country'       => $dataval['country'],
                                    'product_id'    => $insertproduct,
                                    'length'        =>  $request->length,
                                    'width'         =>  $request->width,
                                    'height'        =>  $request->height
                                );
                                $shipping = DB::table('tbl_product_shipping')->where(array('product_id' =>  $productdata->id))->update($info4);
                                    if($shipping)
                                    {
                                        

                                    }
                            }else
                            {

                            }
                            
                         
                    
                
            
        }

        return redirect('importproduct')->with('success_message', 'Product Updated successfully');
	}
    public function export(Request $request)
    {
        
           return Excel::download(new productExport,'product.xlsx');
    }
    public function importproductpriceview(Request $request)
    {
        return view('importproduct');
    }
    public function importproductpricedata(Request $request)
    {
        $data = Excel::toArray(new BulkImport,request()->file('file'));
        $final = $data[0];
       
        
        foreach($final as $finalkey =>  $dataval)
        {
            
            $update = DB::table('tbl_product')->where(array('product_name' => $dataval['producttitle']))->update(array('regular_price' => $dataval['regularprice'], 'sale_price' => $dataval['sellingprice']));
            
        }
        if($update == 1)
        {
              return redirect('importproductprice')->with('success_message', 'Product  price updated successfully');
        }else
        {
       
              return redirect('importproductprice')->with('success_message', 'Allready  same price  present');
      
        }
        
    }
    public function importleaddata()
    {
        $data = Excel::toArray(new BulkImport,request()->file('file'));
        $final = $data[0]; 
        foreach($final as $finaldata)
        {
            
        $info = array(
            'leadname' => $finaldata['leadname'],
            'aliasname' => $finaldata['aliasname'],
            'prospect_customer'   => $finaldata['prospect'],
            'vendor'   => $finaldata['vendor'],
            'status'   => $finaldata['status'],
            'barcode' => $finaldata['barcode'],
            'address' => $finaldata['address'],
            'zipcode'   => $finaldata['zipcode'],
            'city'   => $finaldata['city'],
            'country'   => $finaldata['country'],
            'email' => $finaldata['email'],
            'web' => $finaldata['web'],
            'phone'   => $finaldata['phone'],
            'fax'   => $finaldata['fax'],
            'salteax'   => $finaldata['tax'],
            'vatid'   => $finaldata['vat'],
            'thirdparty'   => $finaldata['thirdparty'],
            'employees'   => '',
            'categories'   =>'',
            'vendorstags'   => '',
            'salesuser'   => '',
            'image'   => '',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
            'accountstatus' => 'activated'
            
        );
        
        $data = DB::table('tbl_addnewlead')->insertGetId($info);
       
        
        }
       
            return redirect()->back()->with('success_message', 'Lead added successfully');
        
    }
    
    public function exportlead()
    {
        return Excel::download(new leadExport,'lead.xlsx');
    }
}
