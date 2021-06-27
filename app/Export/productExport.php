<?php
namespace App\Export;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
class productExport implements FromCollection
{
	public function collection()
	{
	   
       
        $product = DB::table('tbl_product')->get();
        $infoarray = array();
         $infodata =  array(
	               
                    'title',
                    'product_category',
                    'hsn',
                    'subcategoryone',
                     'subcategorytwo',
                    'brand',
                    'description',
                    'media',
                    'product_type',
                    'regular_price',
                    'sale_price',
                    'sale_start_date',
                    'sale_end_date',
                    'sku',
                    'barcode',
                    'taxstatus',
                    'weight',
                    'unit',
                    'country',
                    'attribute',
                    'term',
                    'seo_title',
                    'seo_description' ,
                    'seo_url',
                    'downloadlimit',
                    'downloadexpairy',
                    'downloadfile',
                    
                    'downloadurl',
                    'productgallery',
                    'seokey',
                    'upsell',
                    'crosssell',
                    'producturl',
                    'buttontxt',
                    'length',
                    'width',
                    'height',
                    'minqty',
                    'maxqty'
                    
                    );
        array_push($infoarray,$infodata);
        foreach($product as $product)
	    {
	        $productshipping  = DB::table('tbl_product_shipping')->where(array('product_id' => $product->id))->first();
	        $productvarient = DB::table('tbl_product_varient')->where(array('product_id' => $product->id))->first();
	        $productinventory = DB::table('tbl_inventory')->where(array('product_id' => $product->id))->first();
	        $category =  DB::table('tbl_categories')->where(array('id' => $product->product_category))->first();
	        $brand =  DB::table('tbl_brand')->where(array('id' => $product->product_brand))->first();
	        if($brand != '')
	        {
	            $bradname = $brand->name;
	        }else
	        {
	            $bradname = '';
	        }
	        $categoryname = '';
	        $subone = '';
	        $subtwo = '';
	        if($category != '')
	        {
	            $countlevel =  DB::table('tbl_categories')->where(array('id' => $category->pid))->get();
	            $countdata =  DB::table('tbl_categories')->where(array('id' => $category->pid))->first();
	        }
	       
	        if($category != '')
	        {
	           
	            $subcatone = DB::table('tbl_categories')->where(array('id' => $category->pid))->first();
	           
	            if($subcatone != '')
	            {
	                if($subcatone->pid == 0)
	                {
	                    $categoryname = $subcatone->name;
	                    $subone       = $category->name;
	                    $subtwo       = '';
	                }else
	                {
	                    $subcattwo = DB::table('tbl_categories')->where(array('id' => $subcatone->pid))->first();
	                    $categoryname = $subcattwo->name;
	                    $subone       = $subcatone->name;
	                    $subtwo       = $category->name;
	                    
	                }
	            }
	        }else
	        {
	            $categoryname = '';
	        }
	        
	       
	       
	        
	       if($productinventory != '')
	       {
	           $sku =  $productinventory->sku;
	           $barcode = $productinventory->barcode;
	       }else
	       {
	           $sku = '';
	           $barcode = '';
	       }
	       if($productshipping != '')
	       {
	            $weight = $productshipping->weight;
                $unit = $productshipping->unit;
                $country = $productshipping->country;
                $length = $productshipping->length;
                $width = $productshipping->width;
                $height = $productshipping->height;
	       }else
	       {
	            $weight = '';
                $unit = '';
                $country = '';
                $length = '';
                $width = '';
                $height = '';
	       }
	       
	       if($product->product_type == 1)
	       {
	           $producttype ='simple';
	       }else if($product->product_type == 2)
	       {
	           $producttype ='Group';
	       }else if($product->product_type == 3)
	       {
	           $producttype ='External/Affilate';
	       }else if($product->product_type == 4)
	       {
	           $producttype ='virtual';
	       }else if($product->product_type == 5)
	       {
	           $producttype ='download';
	       }else
	       {
	           $producttype ='';
	       }
	      
	        $info =  array(
	                
                    'title' => $product->product_name,
                    'category' => $categoryname,
                    'hsn'   => $product->hsn,
                    'subcategoryone' => $subone,
                    'subcategorytwo' => $subtwo,
                    
                    'brand' => $bradname,
                    'description' => $product->product_description,
                    'media' => $product->product_media,
                    'product_type' => $producttype,
                    'regular_price' => $product->regular_price,
                    'sale_price' => $product->sale_price,
                    'sale_start_date' => $product->sale_start_date,
                    'sale_end_date' => $product->sale_end_date,
                    'sku' => $sku,
                    'barcode' => $barcode,
                    'taxstatus' => $product->taxstatus,
                    'weight' => $weight,
                    'unit' => $unit,
                    'country' => $country,
                    'attribute' => '',
                    'term' => '',
                    'seo_title' => $product->seo_title,
                    'seo_description' => $product->seo_description,
                    'seo_url' => $product->seo_url,
                    'downloadlimit' => $product->download_limit,
                    'downloadexpairy' => $product->download_expiary,
                    'downloadfile' => $product->download_file,
                    'downloadurl' => $product->download_url,
                    'productgallery' => $product->product_gallery,
                    'seo_key' => $product->seo_key,
                    'upsell' => $product->up_sell,
                    'crosssell' => $product->cross_sell,
                    'producturl' => $product->product_url,
                    'buttontxt' => $product->btn_txt,
                    'length' => $length,
                    'width' => $width,
                    'height' => $height,
                    'minqty' => '',
                    'maxqty' => ''
                    );
	        array_push($infoarray,$info);
	        
	    }
            
            return $infoarray;
	}
}