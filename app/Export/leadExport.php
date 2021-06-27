<?php
namespace App\Export;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
class leadExport implements FromCollection
{
	public function collection()
	{
	   
       
        $lead = DB::table('tbl_addnewlead')->get();
        $infoarray = array();
         $infodata =  array(
	                
                    'leadname',
                    'aliasname',
                    'prospect',
                    'vendor',
                    'status',
                    'barcode',
                    'address',
                    'zipcode',
                    'city',
                    'country',
                    'email',
                    'web',
                    'phone',
                    'fax',
                    'tax',
                    'vat',
                    'thirdparty',
                    
                    );
        array_push($infoarray,$infodata);
        foreach($lead as $leadval)
	    {
	        if($leadval->country != '')
	        {
	            $country = $leadval->country;
	        }else
	        {
	            $country = '';
	        }
	        $info = array(
            'leadname' => $leadval->leadname,
            'aliasname' => $leadval->aliasname,
            'prospect_customer'   => $leadval->prospect_customer,
            'vendor'   => $leadval->vendor,
            'status'   => $leadval->status,
            'barcode' => $leadval->barcode,
            'address' => $leadval->address,
            'zipcode'   => $leadval->zipcode,
            'city'   => $leadval->city,
            'country'   => $country,
            'email' => $leadval->email,
            'web' => $leadval->web,
            'phone'   => $leadval->phone,
            'fax'   => $leadval->fax,
            'salteax'   => $leadval->salteax,
            'vatid'   => $leadval->vatid,
            'thirdparty'   => $leadval->thirdparty,
            'employees'   => '',
            'categories'   =>'',
            'vendorstags'   => '',
            'salesuser'   => '',
            'image'   => '',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
            'accountstatus' => 'activated'
            
        );
        
	        array_push($infoarray,$info);
	        
	    }
            
            return $infoarray;
	}
}