<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use PDF;
use DB;
use session;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    public function index()
    {
        $adminDetails = DB::table('tbl_admin')->get();
        return view('login',compact('adminDetails'));
    }
    public function admindata()
    {
         return view('adminsignup');
    }
    public function adminregisterdata(Request $request)
    {

        $data = $this->validate($request,[
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
        ]);
        $data['password'] = Hash::make($request->password);
        
        $insert = DB::table('tbl_admin')->insert($data);
        if($insert == 1)
        {
            return redirect('admin')->with('success_message', 'Register successfully');
        }else
        {
            return redirect('admin')->with('error_message', 'Register Failed');
        }
    }
    public function installprocess()
    {
        return view('install');
    }
    public function adminprofile()
    {
        if(session('user_id') != '')
        {
            $admindetails = DB::table('tbl_admin')->first();
            return view('adminprofile',['admindetails' => $admindetails]);
        }else
        {
            return view('login');
        }
        
    }
    public function slidersetting()
    {
        if(session('user_id') != '')
        {
            $banner = DB::table('banner')->get();
         return view('slidersetting',['banner' => $banner]);
        }else
        {
            return view('login');
        }
    }
    public function bannerdelete($id)
    {
         $deletebanner = DB::table('banner')->where('id','=',$id)->delete();
        if($deletebanner == 1)
        {
            return redirect()->back()->with('success_message', 'Banner Deleted Successfully');
        }
    }
    public function addslider(Request $request)
    {
        $image = $request->file('document');
       
        if($image != '')
        {
            $new_name = $image->getclientoriginalname();
     
            $destinationPath = public_path('/thumbnail');
       
            $img = Image::make($image->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$new_name);
       
            $destinationPath = public_path('/banner');
            $image->move($destinationPath, $new_name);
        }
        else
        {
            $new_name = '';
        }
        
        $info = array(
                'document' => $new_name,
                'title' => $request->slidertitle
            );
        $insert = DB::table('banner')->insert($info);
        if($insert == 1)
        {
            return redirect()->back()->with('success_message', 'Banner Image Added');
        }else
        {
            return redirect()->back()->with('success_message', 'Banner Image Not Added');
        }
       
    }
    public function role()
    {   
        if(session('user_id') != '')
        {
            $roles = DB::table('roles')->get();
         return view('role',['roles' => $roles]);
        }else
        {
            return view('login');
        }
    }
    public function accessuser()
    {
        if(session('user_id') != '')
        {
            $roles = DB::table('roles')->get();
            $access_users = DB::table('access_users')->get();
            return view('accessuser',['roles' => $roles,'access_users' => $access_users]);
        }else
        {
            return view('login');
        }
    }
    public function addrole(Request $request)
    {
        $info = array('role' => $request->role);
        $data = DB::table('roles')->insert($info);
        if($data == 1)
        {
            return redirect()->back()->with('success_message', 'Roles Created successfully');
        }
    }
    public function editaccessuser($id)
    {
        if(session('user_id') != '')
        {  
          $roles = DB::table('roles')->get();
          $access_users = DB::table('access_users')->get();
          $editdata =  DB::table('access_users')->where(array('id' => $id))->first();
          return view('accessuser', ['editaccessuser' => $editdata,'access_users' => $access_users,'roles' => $roles]);
        }else
        {
            return view('login');
        }
    }
    public function getstaff(Request $request)
    {
        $service = DB::table('services')->where('id','=',$request->serviceid)->first();
        $html = '<option>Select Staff</option>';
        foreach(explode(',',$service->staff) as $staff)
        {
            $info = DB::table('tbl_staff')->where('id','=',$staff)->first();
            $details = ['id' => $info->id,'name' => $info->name];
            $html .= '<option value="'.$info->id.'">'.$info->name.'</option>';
        }
        echo $html;
    }
    public function updateaccessuser(Request $request)
    {
        $info = $this->validate($request,[
                'name' => 'required',
                'role_id' => 'required',
                'username' => 'required',
                'password' => 'required',
                'email'   => 'required',
        ]);
        $updateaccessuser = DB::table('access_users')->where(array('id' => $request->hiddenid))->update($info);
       
        if($updateaccessuser == 1)
        {
            return redirect('/accessuser')->with('success_message', 'Access User updated successfully');
        }
        else
        {
            return redirect('/accessuser')->with('error_message', 'Access User not updated successfully');
        }
    }
    public function deleteaccessuser($id)
    {
        $deleteuser = DB::table('access_users')->where('id','=',$id)->delete();
        if($deleteuser == 1)
        {
            return redirect()->back()->with('success_message', 'Access User Deleted Successfully');
        }
    }
    public function accesspermission($id)
    {
        if(session('user_id') != '')
        {
            $accessmodule = DB::table('access')->get();
            $access_permission = DB::table('access_permission')->where('user_id','=',$id)->get();
            return view('accesspermission',['accessuserid' => $id,'accessmodule' => $accessmodule]);
        }
        else
        {
            return view('login');
        }
    }
    public function updatepermission(Request $request)
    {
        $delete = DB::table('access_permission')->where('user_id','=',$request->userid)->delete();  
        foreach($request->permission as $permissionval)
        {
          
                $info = array('user_id' => $request->userid,'module_id' => $permissionval,'is_checked' => 1);
                $insert = DB::table('access_permission')->insert($info); 
               
            
             
        }
       
         return redirect()->back()->with('success_message', 'Permission Updated Successfully');
    }
    public function addaccessuser(Request $request)
    {
        
        $info = $this->validate($request,[
                'name' => 'required',
                'role_id' => 'required',
                'username' => 'required',
                'password' => 'required',
        ]);
        $data = DB::table('access_users')->insert($info);
        if($data == 1)
        {
            return redirect()->back()->with('success_message', 'Access Users Created successfully');
        }
    }
    public function createevent(Request $request)
    {
        if(session('user_id') != '')
        {
            $data = DB::table('tbl_events')->where('event_user','=',$request->id)->get();
            $events = array();
            foreach($data as $dataval)
            {
                $info = array(
                                'title' => $dataval->event_title,
                                'start' => $dataval->event_start,
                                 'end'  => $dataval->event_end
                        );
                array_push($events,$info);
            }
            
             return view('events',['events' => $events,'leadid' => $request->id]);
        }else
        {
            return view('login');
        }
    }
    public function addevents(Request $request)
    {
        
         $info = array(
            'event_title' => $request->eventtitle,
            'event_user' => $request->leadid,
            'event_start'   => $request->eventstart,
            'event_end' => $request->eventend,
            'lead_id' => $request->leadeventid
            
        );
        $data = DB::table('tbl_events')->insert($info);
        if($data == 1)
        {
            return redirect()->back()->with('success_message', 'Events Created successfully');
        }
    }
     public function updateprofile(Request $request)
    {
         $info = array(
            'name' => $request->name,
            'email' => $request->email,
           );
        $data = DB::table('tbl_admin')->where('id','=',$request->hiddenid)->update($info);
       
        if($data == 1)
        {
            return redirect()->back()->with('success_message', 'Profile updated successfully');
        }
        else
        {
            return redirect()->back()->with('error_message', 'Profile not updated successfully');
        }
    }
    
    public function dashboard()
    {
        if(session('user_id') != '')
        {
            if(session('user_type') == 'admin')
            {
                    $product = DB::table('tbl_product')->get();
                    $category = DB::table('tbl_categories')->get();
                    $brand = DB::table('tbl_brand')->get();
                    
                    $month  = [1,2,3,4,5,6,7,8,9,10,11,12];
                    $leads = [];
                    $proposalcount = [];
                    $invoicecount = [];
                    foreach($month as $m)
                    {
                        $leadcount = DB::table('tbl_addnewlead')->whereMonth('created_at',$m)->get();
                        $proposals = DB::table('lead_proposal')->whereMonth('proposal_date',$m)->get();
                        $invoice = DB::table('tbl_crminvoice')->whereMonth('invoicedate',$m)->get();
                        
                        array_push($leads,count($leadcount));
                        array_push($proposalcount,count($proposals));
                        array_push($invoicecount,count($invoice));
                    }
                    $leadcountdata = DB::table('tbl_addnewlead')->get();
                    $proposalsdata = DB::table('lead_proposal')->get();
                    $invoicedata = DB::table('tbl_crminvoice')->get();
                    $crm = [count($leadcountdata),count($proposalsdata),count($invoicedata)];
                    $ordertoday = DB::table('orderdata')->whereDate('orderdate', date('Y-m-d'))->get();
                    $monthdata = DB::table('orderdata')->whereMonth('orderdate', Carbon::now()->month)
                    ->get();
                    $weeklydata = DB::table('orderdata')->whereBetween('orderdate', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
                    $orderdata = [count($ordertoday),count($monthdata),count($weeklydata)];
                    $eventtoday = DB::table('tbl_events')->whereDate('event_start', date('Y-m-d'))->get();
                    $eventsall = DB::table('tbl_events')->get();
                    $eventallarray = [];
                    foreach($eventsall as $eventsalldata)
                    {
                        $info = ['id' => $eventsalldata->id,'title' => $eventsalldata->event_title,'start' =>$eventsalldata->event_start,'end' => $eventsalldata->event_end];
                        array_push($eventallarray,$info);
                    }


                    $campagian = [];
                    $leadscampen = [];
                   
                    foreach($month as $m)
                    {
                        $campagiandata =  DB::table('crm_campaign')->whereMonth('created_at',  $m)->get();
                        $leadscampendata =  DB::table('tbl_addnewlead')->whereMonth('created_at', $m)->get();
                       
                        array_push($campagian,count($campagiandata));
                        array_push($leadscampen,count($leadscampendata));
                       
                    }
            }else
            {
                    $product = DB::table('tbl_product')->get();
                    $category = DB::table('tbl_categories')->get();
                    $brand = DB::table('tbl_brand')->get();
                    
                    $month  = [1,2,3,4,5,6,7,8,9,10,11,12];
                    $leads = [];
                    $proposalcount = [];
                    $invoicecount = [];
                    foreach($month as $m)
                    {
                       
                        $leadcount = DB::table('tbl_addnewlead')->whereMonth('created_at',$m)->where('salesuser',session('user_id'))->get();
                       
                        $proposals = DB::table('lead_proposal')->whereMonth('proposal_date',$m)->get();
                        $invoice = DB::table('tbl_crminvoice')->whereMonth('invoicedate',$m)->get();
                        
                        array_push($leads,count($leadcount));
                        array_push($proposalcount,count($proposals));
                        array_push($invoicecount,count($invoice));
                    }

                    $leadcountdata = DB::table('tbl_addnewlead')->where('salesuser',session('user_id'))->get();
                    $proposalsdata = DB::table('lead_proposal')->get();
                    $invoicedata = DB::table('tbl_crminvoice')->get();
                    $crm = [count($leadcountdata),count($proposalsdata),count($invoicedata)];
                    $ordertoday = DB::table('orderdata')->whereDate('orderdate', date('Y-m-d'))->get();
                    $monthdata = DB::table('orderdata')->whereMonth('orderdate', Carbon::now()->month)
                    ->get();
                    $weeklydata = DB::table('orderdata')->whereBetween('orderdate', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
                    $orderdata = [count($ordertoday),count($monthdata),count($weeklydata)];
                    $eventtoday = DB::table('tbl_events')->whereDate('event_start', date('Y-m-d'))->get();
                    $eventsall = DB::table('tbl_events')->get();
                    $eventallarray = [];
                    foreach($eventsall as $eventsalldata)
                    {
                        $info = ['id' => $eventsalldata->id,'title' => $eventsalldata->event_title,'start' =>$eventsalldata->event_start,'end' => $eventsalldata->event_end];
                        array_push($eventallarray,$info);
                    }


                    $campagian = [];
                    $leadscampen = [];
                   
                    foreach($month as $m)
                    {
                        $campagiandata =  DB::table('crm_campaign')->whereMonth('created_at',  $m)->where('sales_user',session('user_id'))->get();
                        $leadscampendata =  DB::table('tbl_addnewlead')->whereMonth('created_at', $m)->where('salesuser',session('user_id'))->get();
                       
                        array_push($campagian,count($campagiandata));
                        array_push($leadscampen,count($leadscampendata));
                       
                    }
            }
           
            return view('dashboard',['product' => $product, 'category' => $category,'brand' => $brand,'leads' => $leads,'proposalcount' => $proposalcount,'invoicecount' => $invoicecount,'crm' => $crm,'orderdata' => $orderdata,'eventtoday' => $eventtoday,'eventallarray' => $eventallarray,'campagian' => $campagian,'leadscampen' => $leadscampen]);
        }
        else
        {
            return view('login');
        }
    }
    
    public function register()
    {
        if(session('user_id') != '')
        {
            return view('register');
        }
        else
        {
            return view('login');
        }
    }
    public function importlead()
    {
        if(session('user_id') != '')
        {
            return view('importleadview');
        }
        else
        {
            return view('login');
        }
    }
    public function campaigns()
    {
        if(session('user_id') != '')
        {
            $category = DB::table('tbl_categories')->get();
            $countries = DB::table('country')->get();
            $customer = DB::table('tbl_customer')->get();
            $campaignsdata = DB::table('crm_campaign')->orderBy('id', 'desc')->get();
            $salesuser = DB::table('tbl_salesgroup')->get();
            $access_users = DB::table('access_users')->get();
            return view('campaigns',['category' => $category,'salesuser' => $salesuser,'access_users' => $access_users,'country' => $countries,'customer' => $customer,'campaignsdata' => $campaignsdata]);
        }
        else
        {
            return view('login');
        }
    }
    function create_time_range($start, $end, $interval = '30 mins', $format = '12') {
        $startTime = strtotime($start); 
        $endTime   = strtotime($end);
        $returnTimeFormat = ($format == '12')?'g:i:s A':'G:i:s';
    
        $current   = time(); 
        $addTime   = strtotime('+'.$interval, $current); 
        $diff      = $addTime - $current;
    
         
        while ($startTime < $endTime) {
             
            $startTime += $diff;
           $endtimedata =  $startTime + $diff;
            $times[] = date($returnTimeFormat, $startTime).' - '.date($returnTimeFormat, $endtimedata); 
        } 
        $times[] = date($returnTimeFormat, $startTime); 
        return $times; 
    }
    public function timeslot()
    {
        if(session('user_id') != '')
        {
            $durationdata = DB::table('duartion')->get();
            $service = DB::table('services')->get();
            $service_timeslot = DB::table('service_timeslot')->get();
            return view('timeslot',['service' => $service,'service_timeslot' => $service_timeslot,'durationdata' => $durationdata]);
        }
        else
        {
            return view('login');
        }
    }
    public function timeslotdelete($id)
    {
        $data = DB::table('service_timeslot')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect()->back()->with('success_message', 'Timeslot deleted successfully');
        }
        else
        {
            return redirect()->back()->with('error_message', 'Timeslot not deleted successfully');
        }
    }
    public function timeslotedit($id)
    {
        $data = DB::table('service_timeslot')->where('id', $id)->get();
    }
    public function gettimeslot(Request $request)
    {
        $times = $this->create_time_range('07:00', '23.00:00', $request->duration);
       
        // $html = '<option>Select Timeslot</option>';
        // foreach($times as $time)
        // {
        //     $html .= '<option value="'.$time.'">'.$time.'</option>';
        // }
        
        $html = '<div class="row"><div class="col-md-6"><label class="switch">
                      <input type="checkbox"   name="timeslot[]" value="OFF" >
                      <span class="slider round"></span>
                    </label>&nbsp;&nbsp;&nbsp;OFF</div><br><br>';
        foreach($times as $time)
        {
            $html .= '<div class="col-md-6"><label class="switch">
                      <input type="checkbox"   name="timeslot[]" value="'.$time.'" checked>
                      <span class="slider round"></span>
                    </label>&nbsp;&nbsp;&nbsp;'.$time.'</div><br><br>';
        }
        $html .= '</div>';
        echo $html;
    }
    public function addtimeslot(Request $request)
    {
       $info = $this->validate($request,[
                'service_id' => 'required',
                'day' => 'required',
                'staff_id' => 'required',
                'duration' => 'required',
                'timeslot' => 'required',
            ]);
        foreach($request->timeslot as $timeslot)
        {
            
            $info['timeslot'] = $timeslot;
            $data = DB::table('service_timeslot')->insert($info);
        }
       
        
       
        if($data == 1)
        {
            return redirect()->back()->with('success_message', 'Timeslot added successfully');
        }
        else
        {
            return redirect()->back()->with('error_message', 'Timeslot not added successfully');
        }
    }
    public function addcampaigns(Request $request)
    {
        $info = $this->validate($request,[
                'campaign_name' => 'required',
                'sales_group' => 'required',
                'sales_user' => 'required',
                'campaign_status' => 'required',
                'campaign_type' => 'required',
                'product' => 'required',
                'target_audience' => 'required',
                'closedate' => 'required',
                'sponsor' => 'required',
                'targetsize' => 'required',
                'num_sent' => 'required',
                'budget_cost' => 'required',
                'actual_cost' => 'required',
                'expeceted_response' => 'required',
                'expected_revenue' => 'required',
                'sales_count' => 'required',
                'actualsales_count' => 'required',
                'response_count' => 'required',
                'actualresponse_count' => 'required',
                'expecetd_roi' => 'required',
                'actual_roi' => 'required',
                'description_campaign' => 'required',
        ]);
        $data = DB::table('crm_campaign')->insert($info);
       
        if($data == 1)
        {
            return redirect('/campaigns')->with('success_message', 'Campaigns added successfully');
        }
        else
        {
            return redirect('/campaigns')->with('error_message', 'Campaigns not added successfully');
        }
    }
    public function editcampaigns($id)
    {
        if(session('user_id') != '')
        {
            $category = DB::table('tbl_categories')->get();
            $salesuser = DB::table('tbl_salesgroup')->get();
            $access_users = DB::table('access_users')->get();
            $campaignsdata = DB::table('crm_campaign')->get();
            $editdata =  DB::table('crm_campaign')->where(array('id' => $id))->first();
            return view('campaigns', ['category' => $category,'salesuser' => $salesuser,'access_users' => $access_users,'editcampaigns' => $editdata,'campaignsdata' => $campaignsdata]);
        }
        else
        {
            return view('login');
        }
            
    }
    public function updatecampaigns(Request $request)
    {
        
      $info = $this->validate($request,[
                'campaign_name' => 'required',
                'sales_group' => 'required',
                'sales_user' => 'required',
                'campaign_status' => 'required',
                'campaign_type' => 'required',
                'product' => 'required',
                'target_audience' => 'required',
                'closedate' => 'required',
                'sponsor' => 'required',
                'targetsize' => 'required',
                'num_sent' => 'required',
                'budget_cost' => 'required',
                'actual_cost' => 'required',
                'expeceted_response' => 'required',
                'expected_revenue' => 'required',
                'sales_count' => 'required',
                'actualsales_count' => 'required',
                'response_count' => 'required',
                'actualresponse_count' => 'required',
                'expecetd_roi' => 'required',
                'actual_roi' => 'required',
                'description_campaign' => 'required',
        ]);
        
       $updatecampaigns = DB::table('crm_campaign')->where(array('id' => $request->hiddenid))->update($info);
        if($updatecampaigns == 1)
        {
            return redirect('/campaigns')->with('success_message', 'Campaigns updated successfully');
        }
        else
        {
            return redirect('/campaigns')->with('error_message', 'Campaigns not updated successfully');
        }
    }
    public function campaignsdelete($id)
    {
        $data = DB::table('crm_campaign')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/campaigns')->with('success_message', 'Campaigns deleted successfully');
        }
        else
        {
            return redirect('/campaigns')->with('error_message', 'Campaigns not deleted successfully');
        }
    }
    public function contact()
    {
        if(session('user_id') != '')
        {
            $countries = DB::table('country')->get();
          $customer = DB::table('tbl_customer')->get();
          $contactdata = DB::table('crm_contacts')->get();
          return view('contact',['country' => $countries,'customer' => $customer,'contactdata' => $contactdata]);
        }
        else
        {
            return view('login');
        }
    }
    public function addcontact(Request $request)
    {
        $image = $request->file('img');
        if($image != '')
        {
        $new_name = $image->getclientoriginalname();
        $destinationPath = 'contactimg';
        $image->move($destinationPath, $new_name);
        }
        else
        {
            $new_name = '';
        }
        
        $info = array(
            'name' => $request->firstname.' '.$request->lname,
            'office_phone' => $request->phone,
            'organization_name'   => $request->oname,
            'mobile_phone'   => $request->mobilehone,
            'lead_src'   => $request->lead,
            'home_phone' => $request->hphone,
            'title' => $request->title,
            'secondary_phone'   => $request->secphone,
            'department'   => $request->department,
            'fax'   => $request->fax,
            'primary_email' => $request->pemail,
            'dob' => $request->dob,
            'assitant'   => $request->assitant,
            'reports_to'   => $request->reports,
            'assitant_phone'   => $request->assitantphone,
            'secondary_email'   => $request->secemail,
            'assigned_to'   => $request->assignedto,
            'support_startdate'   => $request->supportstartdate,
            'support_enddate'   => $request->supportenddate,
            'mailing_street'   => $request->description,
            'other_street'   => $request->otherdescription,
            'mailingpobox'   => $request->mailingbox,
            'otherpobox'   => $request->otherbox,
            'mailing_city'   => $request->mailingcity,
            'other_city'   => $request->othercity,
            'mailing_state'   => $request->mailingstate,
            'other_state'   => $request->otherstate,
            'mailing_zip'   => $request->mailingzip,
            'other_zip'   => $request->otherzip,
            'mailing_country'   => $request->mailingcountry,
            'other_country'   => $request->othercountry,
            'description'   => $request->descriptiondata,
            'image'         => $new_name,

            );
        $data = DB::table('crm_contacts')->insert($info);
       
        if($data == 1)
        {
            return redirect('/contact')->with('success_message', 'Contacts added successfully');
        }
        else
        {
            return redirect('/contact')->with('error_message', 'Contacts not added successfully');
        }
    }
    public function editcontact($id)
    {
        
      $customer = DB::table('tbl_customer')->get();
      $contactdata = DB::table('crm_contacts')->get();
      $editdata =  DB::table('crm_contacts')->where(array('id' => $id))->first();
      return view('contact', ['editcontact' => $editdata,'customer' => $customer,'contactdata' => $contactdata]);
    }
    public function updatecontact(Request $request)
    {
        $image = $request->file('img');
        if($image != '')
        {   
            $new_name = $image->getclientoriginalname();
            $uploadimg = $new_name;
            $destinationPath = 'contactimg';
            $image->move($destinationPath, $new_name);
            
        }else
        {
            $uploadimg = $request->hiddenimage;
        }
        
        $info = array(
            'name' => $request->firstname.' '.$request->lname,
            'office_phone' => $request->phone,
            'organization_name'   => $request->oname,
            'mobile_phone'   => $request->mobilehone,
            'lead_src'   => $request->lead,
            'home_phone' => $request->hphone,
            'title' => $request->title,
            'secondary_phone'   => $request->secphone,
            'department'   => $request->department,
            'fax'   => $request->fax,
            'primary_email' => $request->pemail,
            'dob' => $request->dob,
            'assitant'   => $request->assitant,
            'reports_to'   => $request->reports,
            'assitant_phone'   => $request->assitantphone,
            'secondary_email'   => $request->secemail,
            'assigned_to'   => $request->assignedto,
            'support_startdate'   => $request->supportstartdate,
            'support_enddate'   => $request->supportenddate,
            'mailing_street'   => $request->description,
            'other_street'   => $request->otherdescription,
            'mailingpobox'   => $request->mailingbox,
            'otherpobox'   => $request->otherbox,
            'mailing_city'   => $request->mailingcity,
            'other_city'   => $request->othercity,
            'mailing_state'   => $request->mailingstate,
            'other_state'   => $request->otherstate,
            'mailing_zip'   => $request->mailingzip,
            'other_zip'   => $request->otherzip,
            'mailing_country'   => $request->mailingcountry,
            'other_country'   => $request->othercountry,
            'description'   => $request->descriptiondata,
            'image'   => $uploadimg

            );
        $updatecontact = DB::table('crm_contacts')->where(array('id' => $request->hiddenid))->update($info);
       
        if($updatecontact == 1)
        {
            return redirect('/contact')->with('success_message', 'Contacts updated successfully');
        }
        else
        {
            return redirect('/contact')->with('error_message', 'Contacts not updated successfully');
        }
    }
    public function contactdelete($id)
    {
        $data = DB::table('crm_contacts')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/contact')->with('success_message', 'Contacts deleted successfully');
        }
        else
        {
            return redirect('/contact')->with('error_message', 'Contacts not deleted successfully');
        }
    }
    public function organization()
    {
        $countries = DB::table('country')->get();
      $customer = DB::table('tbl_customer')->get();
      $organizationdata = DB::table('crm_organization')->get();
      return view('organization',['country' => $countries,'customer' => $customer,'organizationdata' => $organizationdata]);
    }
    public function addorganizations(Request $request)
    {
        
        $info = $this->validate($request,[
                'organization_name' => 'required',
                'website' => 'required',
                'primary_phone' => 'required',
                'ticker_symbol' => 'required',
                'fax' => 'required',
                'member_of' => 'required',
                'secondary_phone' => 'required',
                'employees' => 'required',
                'primary_email' => 'required',
                'secondary_email' => 'required',
                'ownership' => 'required',
                'industry' => 'required',
                'rating' => 'required',
                'type' => 'required',
                'sic_code' => 'required',
                'annual_revenue' => 'required',
                'assigned_to' => 'required',
                'billing_address' => 'required',
                'shipping_address' => 'required',
                'billing_pobox' => 'required',
                'shipping_pobox' => 'required',
                'billing_city' => 'required',
                'shipping_city' => 'required',
                'billing_state' => 'required',
                'shipping_state' => 'required',
                'billing_postalcode' => 'required',
                'shipping_postalcode' => 'required',
                'billing_country' => 'required',
                'shipping_country' => 'required',
                'descriptionorg' => 'required',
        ]);
        $data = DB::table('crm_organization')->insert($info);
       
        if($data == 1)
        {
            return redirect('/organization')->with('success_message', 'Organization added successfully');
        }
        else
        {
            return redirect('/organization')->with('error_message', 'Organization not added successfully');
        }
    }
    public function editorganization($id)
    {
        
      $customer = DB::table('tbl_customer')->get();
      $organizationdata = DB::table('crm_organization')->get();
      $editdata =  DB::table('crm_organization')->where(array('id' => $id))->first();
      return view('organization', ['editorganization' => $editdata,'customer' => $customer,'organizationdata' => $organizationdata]);
    }
    public function updateorganizations(Request $request)
    {
        $info = $this->validate($request,[
                'organization_name' => 'required',
                'website' => 'required',
                'primary_phone' => 'required',
                'ticker_symbol' => 'required',
                'fax' => 'required',
                'member_of' => 'required',
                'secondary_phone' => 'required',
                'employees' => 'required',
                'primary_email' => 'required',
                'secondary_email' => 'required',
                'ownership' => 'required',
                'industry' => 'required',
                'rating' => 'required',
                'type' => 'required',
                'sic_code' => 'required',
                'annual_revenue' => 'required',
                'assigned_to' => 'required',
                'billing_address' => 'required',
                'shipping_address' => 'required',
                'billing_pobox' => 'required',
                'shipping_pobox' => 'required',
                'billing_city' => 'required',
                'shipping_city' => 'required',
                'billing_state' => 'required',
                'shipping_state' => 'required',
                'billing_postalcode' => 'required',
                'shipping_postalcode' => 'required',
                'billing_country' => 'required',
                'shipping_country' => 'required',
                'descriptionorg' => 'required',
        ]);
        $updateorganizations = DB::table('crm_organization')->where(array('id' => $request->hiddenid))->update($info);
       
        if($updateorganizations == 1)
        {
            return redirect('/organization')->with('success_message', 'Organization updated successfully');
        }
        else
        {
            return redirect('/organization')->with('error_message', 'Organization not updated successfully');
        }
    }
    public function organizationdelete($id)
    {
        $data = DB::table('crm_organization')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/organization')->with('success_message', 'Organization deleted successfully');
        }
        else
        {
            return redirect('/organization')->with('error_message', 'Organization not deleted successfully');
        }
    }
    public function project()
    {
        $countries = DB::table('country')->get();
      $customer = DB::table('tbl_customer')->get();
      $projectdata = DB::table('crm_project')->get();
      return view('project',['country' => $countries,'customer' => $customer,'projectdata' => $projectdata]);
    }
    public function addproject(Request $request)
    {
        $info = array(
            'prj_name' => $request->prjname,
            'status' => $request->status,
            'related_to'   => $request->releatedto,
            'assignedto'   => $request->assignto,
            'start_date'   => $request->sdate,
            'target_enddate'   => $request->tenddate,
            'actual_enddate'   => $request->aenddate,
            'deal_name'   => $request->dealname,
            'contact_name'   => $request->contactname,
            'target_budget'   => $request->targetbudget,
            'project_url'   => $request->prjurl,
            'priority'   => $request->priority,
            'progress'   => $request->progress,
            'description'   => $request->descriptiondatatype
            );
        $data = DB::table('crm_project')->insert($info);
       
        if($data == 1)
        {
            return redirect('/project')->with('success_message', 'Projects added successfully');
        }
        else
        {
            return redirect('/project')->with('error_message', 'Projects not added successfully');
        }
    }
    public function editproject($id)
    {
        
      $customer = DB::table('tbl_customer')->get();
      $projectdata = DB::table('crm_project')->get();
      $editdata =  DB::table('crm_project')->where(array('id' => $id))->first();
      return view('project', ['editproject' => $editdata,'customer' => $customer,'projectdata' => $projectdata]);
    }
    public function updateproject(Request $request)
    {
        $info = array(
            'prj_name' => $request->prjname,
            'status' => $request->status,
            'related_to'   => $request->releatedto,
            'assignedto'   => $request->assignto,
            'start_date'   => $request->sdate,
            'target_enddate'   => $request->tenddate,
            'actual_enddate'   => $request->aenddate,
            'deal_name'   => $request->dealname,
            'contact_name'   => $request->contactname,
            'target_budget'   => $request->targetbudget,
            'project_url'   => $request->prjurl,
            'priority'   => $request->priority,
            'progress'   => $request->progress,
            'description'   => $request->descriptiondatatype
            );
        $updateproject = DB::table('crm_project')->where(array('id' => $request->hiddenid))->update($info);
       
        if($updateproject == 1)
        {
            return redirect('/project')->with('success_message', 'Project updated successfully');
        }
        else
        {
            return redirect('/project')->with('error_message', 'Project not updated successfully');
        }
    }
    public function projectdelete($id)
    {
        $data = DB::table('crm_project')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/project')->with('success_message', 'Project deleted successfully');
        }
        else
        {
            return redirect('/project')->with('error_message', 'Project not deleted successfully');
        }
    }
    public function task()
    {
        $countries = DB::table('country')->get();
      $customer = DB::table('tbl_customer')->get();
      $taskdata = DB::table('crm_task')->get();
      return view('task',['country' => $countries,'customer' => $customer,'taskdata' => $taskdata]);
    }
    public function addtask(Request $request)
    {
        $info = array(
            'projecttask_name' => $request->taskname,
            'priority' => $request->prioritytask,
            'type'   => $request->tasktype,
            'projecttask_number'   => $request->tasknumber,
            'relatedto_task'   => $request->relateto,
            'assignedto_task'   => $request->assigntotask,
            'status'   => $request->statustask,
            'progress'   => $request->progresstask,
            'workedhour'   => $request->workedhours,
            'startdate'   => $request->startdatetask,
            'duedate'   => $request->duedatetask,
            'description_task'   => $request->descriptiontasktype
            );
        $data = DB::table('crm_task')->insert($info);
       
        if($data == 1)
        {
            return redirect('/task')->with('success_message', 'Task added successfully');
        }
        else
        {
            return redirect('/task')->with('error_message', 'Task not added successfully');
        }
    }
    public function edittask($id)
    {
        
      $customer = DB::table('tbl_customer')->get();
      $taskdata = DB::table('crm_task')->get();
      $editdata =  DB::table('crm_task')->where(array('id' => $id))->first();
      return view('task', ['edittask' => $editdata,'customer' => $customer,'taskdata' => $taskdata]);
    }
    public function updatetask(Request $request)
    {
        
        $info = array(
            'projecttask_name' => $request->taskname,
            'priority' => $request->prioritytask,
            'type'   => $request->tasktype,
            'projecttask_number'   => $request->tasknumber,
            'relatedto_task'   => $request->relateto,
            'assignedto_task'   => $request->assigntotask,
            'status'   => $request->statustask,
            'progress'   => $request->progresstask,
            'workedhour'   => $request->workedhours,
            'startdate'   => $request->startdatetask,
            'duedate'   => $request->duedatetask,
            'description_task'   => $request->descriptiontasktype
            );
        $updatetask = DB::table('crm_task')->where(array('id' => $request->hiddenid))->update($info);
       
        if($updatetask == 1)
        {
            return redirect('/task')->with('success_message', 'Task updated successfully');
        }
        else
        {
            return redirect('/task')->with('error_message', 'Task not updated successfully');
        }
    }
    public function taskdelete($id)
    {
        $data = DB::table('crm_task')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/task')->with('success_message', 'Task deleted successfully');
        }
        else
        {
            return redirect('/task')->with('error_message', 'Task not deleted successfully');
        }
    }
    public function milestone()
    {
        $countries = DB::table('country')->get();
      $customer = DB::table('tbl_customer')->get();
      $milestonedata = DB::table('crm_milestone')->get();
      return view('milestone',['country' => $countries,'customer' => $customer,'milestonedata' => $milestonedata]);
    }
    public function addmilestone(Request $request)
    {
        $info = array(
            'prjmilestone_name' => $request->prjmilstonename,
            'relatedto_mile' => $request->relatemileto,
            'milestonedate'   => $request->milestonedate,
            'assignedto_mile'   => $request->assignmilestone,
            'type'   => $request->tasktypemile,
            'description_milestone'   => $request->descriptionmilestonetype
            );
        $data = DB::table('crm_milestone')->insert($info);
       
        if($data == 1)
        {
            return redirect('/milestone')->with('success_message', 'Milestone added successfully');
        }
        else
        {
            return redirect('/milestone')->with('error_message', 'Milestone not added successfully');
        }
    }
    public function editmilestone($id)
    {
        
      $customer = DB::table('tbl_customer')->get();
      $milestonedata = DB::table('crm_milestone')->get();
      $editdata =  DB::table('crm_milestone')->where(array('id' => $id))->first();
      return view('milestone', ['editmilestone' => $editdata,'customer' => $customer,'milestonedata' => $milestonedata]);
    }
    public function updatemilestone(Request $request)
    {
        
        $info = array(
            'prjmilestone_name' => $request->prjmilstonename,
            'relatedto_mile' => $request->relatemileto,
            'milestonedate'   => $request->milestonedate,
            'assignedto_mile'   => $request->assignmilestone,
            'type'   => $request->tasktypemile,
            'description_milestone'   => $request->descriptionmilestonetype
            );
        $updatemilestone = DB::table('crm_milestone')->where(array('id' => $request->hiddenid))->update($info);
       
        if($updatemilestone == 1)
        {
            return redirect('/milestone')->with('success_message', 'Milestone updated successfully');
        }
        else
        {
            return redirect('/milestone')->with('error_message', 'Milestone not updated successfully');
        }
    }
    public function milestonedelete($id)
    {
        $data = DB::table('crm_milestone')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/milestone')->with('success_message', 'Milestone deleted successfully');
        }
        else
        {
            return redirect('/milestone')->with('error_message', 'Milestone not deleted successfully');
        }
    }
    public function lead()
    {
        $countries = DB::table('country')->get();
      $customer = DB::table('tbl_customer')->get();
     
      return view('lead',['country' => $countries,'customer' => $customer,'leaddata' => $leaddata]);
    }
    public function addlead(Request $request)
    {
        
        $info = array(
            'name' => $request->firstname.' '.$request->lastname,
            'primary_phone' => $request->primaryphone,
            'company'   => $request->company,
            'mobile_phone'   => $request->mobilephone,
            'designation'   => $request->designation,
            'fax' => $request->faxlead,
            'lead_source' => $request->leadsource,
            'primary_email'   => $request->pleademail,
            'industry'   => $request->leadindustry,
            'fax'   => $request->faxlead,
            'website' => $request->leadwebsite,
            'annual_revenue' => $request->leadannualrevenue,
            'lead_status'   => $request->leadstatus,
            'no_employees'   => $request->noofemployee,
            'rating'   => $request->leadrating,
            'secondary_email'   => $request->secoemail,
            'assigned_to'   => $request->assignedto,
            'street'   => $request->streetdescription,
            'po_box'   => $request->poboxleaddescription,
            'postal_code'   => $request->postalcodelead,
            'city'   => $request->citylead,
            'country'   => $request->countrylead,
            'state'   => $request->statelead,
            'lead_description'   => $request->descriptiondatalead
            

            );
        $data = DB::table('crm_leads')->insert($info);
       
        if($data == 1)
        {
            return redirect('/lead')->with('success_message', 'Lead added successfully');
        }
        else
        {
            return redirect('/lead')->with('error_message', 'Lead not added successfully');
        }
    }
    
    public function frontend(Request $request)
    {
        $product_name = $request->segment(2);
        $product = DB::table('tbl_product')->where(array('product_name' => $product_name))->first();
       
        return view('frontend',['product' => $product]);
    }
    public function inventory(Request $request)
    {
        $stock = DB::table('stock')->get();
        return view('inventory',['stock' => $stock]);
    }
    public function transfer(Request $request)
    {   
        $custom_products = ''; 
        $proposalid = '';
        if(isset($request->id))
        {
            $custom_products = DB::table('custom_product')->where('id','=',$request->id)->first();
            $proposalid = $request->proposalid;
        }
        
        $stock = DB::table('stock_detail')->get();
        $suppliers = DB::table('suppliers')->get();
        $tax = DB::table('tbl_tax')->get();
        $products = DB::table('tbl_product')->get();
        return view('transfer',['stock' => $stock,'suppliers' => $suppliers,'tax' => $tax,'products' => $products,'custom_products' =>$custom_products,'proposalid' => $proposalid]);
    }
    public function addtransfer(Request $request)
    {
       
        $rand = rand(1000,9999);
        $transferid = '#T'.$rand;
        $productid =  $request->productid;
        $quantity  = $request->qty;
        $price = $request->price;
        $tax = $request->tax;
        $taxtype = $request->taxtype;
        $taxper = $request->taxpercentage;
        $purchaseprice = $request->purchaseprice;
        foreach($productid as $key =>  $productid)
        {
             $info = array(
                    'transferid' => $transferid,
                    'productid' => $productid,
                    'quantity'  => $quantity[$key],
                    'price'     => $price[$key],
                    'tax'       => $tax[$key],
                    'taxtype'   => $taxtype[$key],
                    'tax_percentage'   => $taxper[$key],
                    'paurchase_price'   => $purchaseprice[$key],
                    'supplierid' => $request->suppliername,
                    'expected_arrival' => $request->expectedarrival,
                    'status'          => 'active',
                    'referencenumber' => $request->refernecenumber,
                    'tag'           =>$request->tags,
                    'product_type' =>$request->product_type,
                    'proposal_id' => $request->proposalid
                );
            $insert = DB::table('transfer')->insert($info);
        }

            $service = $request->service;
            $serviceprice = $request->serviceprice;
                if(!empty($service))
                {

                
                foreach($service as $keyservice => $serviceval)
                {
                    $info = array(
                            'transfer_id' => $transferid,
                            'name' => $serviceval,
                            'price'  => $serviceprice[$keyservice],
                        );
                    $insert = DB::table('purchase_transport_details')->insert($info);
                }
                
                    $info = array(
                            'transfer_id' => $transferid,
                            'itemtotal' => $request->itemtotal,
                            'itemtax'  => $request->itemtax,
                            'itemfinaltotal'     =>$request->itemfinaltotal,
                            'transporttotal'       => $request->transporttotal,
                            'overalldiscount'   => $request->overalldiscount,
                            'grand_total'   => $request->grand_total,
                       );
                    $insert = DB::table('purchase_details')->insert($info);
                }
        if($insert == 1)
        {
             return redirect('transferlist')->with('success_message', 'Transfer Created Successfully');
        }
    }
    public function getproductdata(Request $request)
    {
        $product = DB::table('tbl_product')->where(array('product_name' => $request->product))->first();
        $tax = DB::table('tbl_tax')->get();
        $inventory  = DB::table('tbl_inventory')->where(array('product_id' => $request->product))->first();
                            if($product != '')
                            {
                                if($product->product_media != '')
                                {
                                    $mediadata = explode(',',$product->product_media);
                                    $media = asset('productimg').'/'.$mediadata[0];
                                }else
                                {
                                    $media = asset('images').'/image.png';
                                }
                            }
                            
                          
                           if($inventory != '')
                            {
                                $min = $inventory->minqty;
                                $max = $inventory->maxqty;
                            }else
                            {
                                $min ='';
                                $max = '';
                            }
                       $count = $request->countdata;
                $html = '
                        <tr><td>
                        <input type="checkbox" id="del_'.$product->id.'" ></td>
                        <td style="width:50px;">'.$count.'</td>
                        <td>
                        <img src="'.$media.'" style="height:100px;width:100px;">
                         </td>
                        <td style="width:50px;">'.$product->product_name.'
                       </td>
                        <td><input type="text" name="qty[]" id="qty'.$count.'" class="form-control" style="width:100px;"></td>
                        <td><input type="text" name="price[]" id="price'.$count.'" class="form-control" style="width:100px;"></td>
                       <td style="width:230px;"><select name="tax[]" class="form-control"><option>Select Tax</option>';
                       
                          foreach($tax as $taxdata) {
                           $html .= '<option value="'.$taxdata->id.'">'.$taxdata->tax_name.'</option>';
                            }
                       $html .= '</select></td>
                       <td style="width:200px;"><select name="taxtype[]" class="form-control"><option>Select Tax Type</option><option value="1">Inclusive</option><option value="2">Exclusive</option></select></td>
                        <td style="width:50px;"><i class="fa fa-trash" onclick="getdelete(this)"></i></td>
                        
                        
                        </tr><input type="hidden" name="productid[]" value="'. $product->id.'">';
                echo $html;
       
        
    }
    public function transferlist(Request $request)
    {
        $transfer = DB::table('transfer')->distinct()->orderBy('id','desc')->get();
        $data = array();
        foreach($transfer->unique('transferid') as $transfer){
            $info = array(
                        'id' => $transfer->id,
                        'transferid' => $transfer->transferid,
                        'expected_arrival' => $transfer->expected_arrival,
                        'status'    => $transfer->status
                    );
            array_push($data,$info);
        }
       
        return view('transferlist',['transfer' => $data]);
    }
    public function transferview(Request $request)
    {
        $transfer = DB::table('transfer')->where(array('id' => $request->id))->first();
        $transferdata = DB::table('transfer')->where(array('transferid' => $transfer->transferid))->get();
        $vendor = DB::table('tbl_vendor')->where(array('id' => $transfer->supplierid))->get();
       
        return view('transferview',['transfer' => $transfer,'vendor' => $vendor,'transferdata' => $transferdata]);
    }
    public function reieveitem(Request $request)
    {
         $transfer = DB::table('transfer')->where(array('id' => $request->id))->first();
         $transferdata = DB::table('transfer')->where(array('transferid' => $transfer->transferid))->get();
         return view('transferrecieveitem',['transfer' => $transfer,'transferdata' => $transferdata]);
    }
    public function invoicegenrate(Request $request)
    {
        $transfer = DB::table('transfer')->where(array('id' => $request->id))->first();
        $transferdata = DB::table('transfer')->where(array('transferid' => $transfer->transferid))->where('accept','!=',0)->get();
        $vendor = DB::table('tbl_vendor')->where(array('id' => $transfer->supplierid))->first();
        return view('transferinvoice',['transfer' => $transfer,'vendor' => $vendor,'transferdata' => $transferdata]);
    }
    public function downloadOrderListPDF()
    {
        $orderlist = DB::table('orderdata')->select('orderdata.*','user.*')->join('user','user.id','=','orderdata.userid')->get();
        $pdf = PDF::loadView('orderlistpdf', compact('orderlist'));
        
        return $pdf->download('orderlist.pdf');
    }
    public function downloadLeadListPDF()
    {

        if(session('user_type') == 'admin')
        {
            $addleads = DB::table('tbl_addnewlead')->orderby('id','DESC')->get();
        }else
        {
            $addleads = DB::table('tbl_addnewlead')->where(['created_by' => session('user_id'),'created_by_type' => session('user_type')])->orderby('id','DESC')->get();
        }
      
        $pdf = PDF::loadView('listleadpdf', compact('addleads'));
        
        return $pdf->download('leadlist.pdf');
    }
    public function downloadCampagianListPDF()
    {
        $campaignsdata = DB::table('crm_campaign')->orderBy('id', 'desc')->get();
        $pdf = PDF::loadView('campaignlistpdf', compact('campaignsdata'));
        
        return $pdf->download('campagianlist.pdf');
         
    }
    public function downloadEventListPDF()
    {
        $eventlist = DB::table('tbl_events')->join('tbl_addnewlead','tbl_events.lead_id','tbl_addnewlead.id')->select('tbl_events.*','tbl_addnewlead.*')->get();
         $pdf = PDF::loadView('eventlistpdf', compact('eventlist'));
        
        return $pdf->download('eventlistpdf.pdf');
         
    }
    public function submitrecieve(Request $request)
    {
       
           $transferid = $request->transferid;
           $allquntity = $request->allqunatity;
           $cancel = $request->cancelqunatity;
           $reject = $request->rejectqunatity;
           foreach($transferid as $key=> $transferid)
           {
               $transferdetails = DB::table('transfer')->where(array('id' => $transferid))->first();
                $info = array(
                            'accept' => $allquntity[$key],
                            'cancel' => $cancel[$key],
                            'reject' => $reject[$key],
                            'status' => 'received'
                        );
                $update = DB::table('transfer')->where(array('id' => $transferid))->update($info);
                
                if($allquntity[$key] != '')
                {
                    $stcok=DB::table('stock')->where(array('productid' => $transferdetails->productid))->first();
                    if(!is_null($stcok->stockqty))
                    {
                         $total = $stcok->stockqty + $allquntity[$key];
                     }else
                     {
                         $total = $allquntity[$key];
                     }
                   
                    $existstock = DB::table('stock')->where(array('productid' => $transferdetails->productid))->get();
                    if(!$existstock->isEmpty())
                    {
                        $info = ['productid' => $transferdetails->productid ,'stockqty' => $total,'allowbarcodes' => 'no', 'stockthreshold' => 0];
                        
                        $stcokupdate =DB::table('stock')->where(array('productid' => $transferdetails->productid))->update($info);
                    }else
                    {
                        $info = ['productid' => $transferdetails->productid ,'stockqty' => $total,'allowbarcodes' => 'no', 'stockthreshold' => 0];
                       
                        $stcokupdate =DB::table('stock')->insert($info);
                    }
                    
                }
                
                
           }
            // $transfer = DB::table('transfer')->where(array('id' => $transferid[0]))->first();
            // $transferdata = DB::table('transfer')->where(array('transferid' => $transfer->transferid))->get();
            // $vendor = DB::table('tbl_vendor')->where(array('id' => $transfer->supplierid))->get();
            $transfer = DB::table('transfer')->distinct()->orderBy('id','desc')->get();
            $data = array();
            foreach($transfer->unique('transferid') as $transfer){
                $info = array(
                            'id' => $transfer->id,
                            'transferid' => $transfer->transferid,
                            'expected_arrival' => $transfer->expected_arrival,
                            'status'    => $transfer->status
                        );
            array_push($data,$info);
        }
       
        return view('transferlist',['transfer' => $data]);
           
    }
    public function completetransfer(Request $request)
    {
        $transfer = DB::table('transfer')->where(array('id' => $request->id))->first();
        $transferdata = DB::table('transfer')->where(array('transferid' => $transfer->transferid))->get();
        foreach($transferdata as $key =>  $transerproduct){
            
            $transferdetails = DB::table('transfer')->where(array('id' => $transerproduct->id))->first();
                $info = array(
                            'accept' => $transerproduct->quantity,
                            'status' => 'received'
                        );
                $update = DB::table('transfer')->where(array('id' => $transerproduct->id))->update($info);
           $getqty = DB::table('stock')->where(array('productid' => $transerproduct->productid))->first();
            $updatestock = DB::table('stock')->where(array('productid' => $transerproduct->productid))->update(array('stockqty' => $getqty->stockqty+ $transerproduct->quantity));
            
        }
        return redirect('transferlist')->with('success_message', 'Transfer Completed Successfully');
        
    }
    public function deletemultipleproductdata(Request $request)
    {
        $post_ids = $request->post_id;
        
        foreach($post_ids as $id){ 
         
          $query = DB::table('tbl_product')->where(array('id' => $id))->delete();
         
        }
        echo 1;
    }
    public function login(Request $request)
    {
        
       
           $data =  DB::table('tbl_admin')->where(array('email' => $request->email))->first();
          $vendordata =  DB::table('tbl_vendor')->where(array('email' => $request->email,'password' => $request->password))->first();
           $userdata =  DB::table('user')->where(array('email' => $request->email,'password' => $request->password))->first();
            $accessuserdata =  DB::table('access_users')->where(array('username' => $request->email,'password' => $request->password))->first();
           
            if(!empty($data))
            {
            

            // $credentials = $request->only('email', 'password');
            
            // if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // Authentication passed...
                 
                 $info = array(
                    'user_id' => $data->id,
                    'name'    => $data->name,
                    'email'   => $data->email,
                    'user_type' => 'admin',
                    
                   );
                    $request->session()->put($info);
               
                    return redirect()->action('Controller@dashboard');
            // }else
            // {
               
            // }
           
            }else if(!empty($vendordata))
            {
                $info = array(
                    'user_id' => $vendordata->id,
                    'name'    => $vendordata->name,
                    'email'   => $vendordata->email,
                    'user_type' => 'vendor'
                   
               );
                $request->session()->put($info);
           
                return redirect()->action('Controller@dashboard');
            }else if(!empty($userdata)){
                 $info = array(
                    'user_id' => $userdata->id,
                    'name'    => $userdata->firstName.' '.$userdata->lastName,
                    'email'   => $userdata->email,
                    'user_type' => $userdata->usertype
                   
               );
                $request->session()->put($info);
           
                return redirect()->action('Controller@dashboard');
            }else if(!empty($accessuserdata)){
                 $info = array(
                    'user_id' => $accessuserdata->id,
                    'name'    => $accessuserdata->name,
                   
                    'user_type' => 'accessusers'
                   
               );
                $request->session()->put($info);
           
                return redirect()->action('Controller@dashboard');
            }else
            {
      
                return redirect('/index')->with('error_message', 'Login Failed');
            }
            
            
            
    }
    public function logout(Request $request)
    {
        $info = array(
                    'user_id' =>'',
                    'name'    => '',
                    'email'   => '',
           );
        $request->session()->forget($info); 
      
       Auth::logout();
        return redirect('/admin');
    }
    public function taxes()
    {
        $taxes = DB::table('tbl_tax')->get();
        $taxetype = DB::table('tax_type')->get();
        return view('taxes',['taxes' => $taxes,'taxtype' => $taxetype]);
    }
    public function taxtype()
    {
          $taxes = DB::table('tax_type')->get();
        return view('taxtype',['taxes' => $taxes]);
    }
    public function addtaxtype(Request $request)
    {
        $info = $this->validate($request,[
                'taxtype' => 'required',
        ]);
        $data = DB::table('tax_type')->insert($info);
       
        if($data == 1)
        {
            return redirect('/taxtype')->with('success_message', 'Tax type added successfully');
        }
        else
        {
            return redirect('/taxtype')->with('error_message', 'Tax type not added successfully');
        }
    }
     public function taxtypedelete($id)
    {
        $data = DB::table('tax_type')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/taxtype')->with('success_message', 'Tax type deleted successfully');
        }
        else
        {
            return redirect('/taxtype')->with('error_message', 'Tax type not deleted successfully');
        }
    }
    public function addtax(Request $request)
    {
        $info = $this->validate($request,[
                'tax_name' => 'required',
                'tax_type' => 'required',
                'total_tax' => 'required',
        ]);
        $data = DB::table('tbl_tax')->insert($info);
       
        if($data == 1)
        {
            return redirect('/taxes')->with('success_message', 'Tax added successfully');
        }
        else
        {
            return redirect('/taxes')->with('error_message', 'Tax not added successfully');
        }
    }
    public function leadconvert(Request $request)
    {
        $lead = DB::table('crm_leads')->where('id','=',$request->id)->first();
       
        $info = array(
                    'name' => $lead->name,
                    'office_phone' => $lead->primary_phone,
                    'mobile_phone' => $lead->mobile_phone,
                    'organization_name' =>$lead->company,
                    'primary_email' => $lead->primary_email,
                    'secondary_email' => $lead->secondary_email,
                    'mailing_city' => $lead->city,
                    'mailing_state' =>$lead->state,
                    'mailing_zip' => $lead->postal_code,
                    'title'      => $lead->designation
                );
        $contactinsert = DB::table('crm_contacts')->insert($info);
        if($contactinsert == 1)
        {
            $deletelead = DB::table('crm_leads')->where('id','=',$request->id)->delete();
            if($deletelead == 1)
            {
                 return redirect('/lead')->with('success_message', 'Lead Convert to Customer successfully');
            }
           
        }
    }
    public function taxdelete($id)
    {
        $data = DB::table('tbl_tax')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/taxes')->with('success_message', 'Tax deleted successfully');
        }
        else
        {
            return redirect('/taxes')->with('error_message', 'Tax not deleted successfully');
        }
    }
    public function brand()
    {
        $brand = DB::table('tbl_brand')->orderBy('id','DESC')->get();
        $category = DB::table('tbl_categories')->get();
        return view('brand', ['brand' => $brand,'category' => $category]);
    }
    public function registerdata(Request $request)
    {
        $info = array(
            'name'      => $request->name,
            'mobile'    => $request->mobile,
            'email'     => $request->email,
            'password'  => $request->password,
            'user_type' => 'vendor'
            );
            
        $insert = DB::table('tbl_vendor')->insert($info);
        if($insert == 1)
        {
            return redirect('register')->with('success_message', 'Register successfully');
        }else
        {
            return redirect('register')->with('error_message', 'Register Failed');
        }
    }
    public function vendordata(Request $request)
    {
        $data = DB::table('tbl_vendor')->get();
        return view('vendordata', ['vendor' => $data]);
    }
    public function activatevendor(Request $request)
    {
        $update = DB::table('tbl_vendor')->where(array('id' => $request->vendorid))->update(array('status' => 1));
        if($update == 1)
        {
            echo 1;
        }
    }
    public function deactivatevendor(Request $request)
    {
        $update = DB::table('tbl_vendor')->where(array('id' => $request->vendorid))->update(array('status' => 0));
        if($update == 1)
        {
            echo 1;
        }
    }
    public function vendordelete(Request $request)
    {
        $delete = DB::table('tbl_vendor')->where(array('id' => $request->id))->delete();
        if($delete == 1)
        {
           return redirect('vendordata')->with('success_message', 'Vendor Deleted successfully');
        }else
        {
            return redirect('vendordata')->with('error_message', 'Vendor Not delete');
        }
    }
    public function addbrand(Request $request)
    {
    
        $data = $this->validate($request,[
                'name' => 'required',
                'description' => 'required',
                'image' => 'required',
        ]);
        

        $image = $request->file('image');
       
        if($image != '')
        {
         $new_name = $image->getclientoriginalname();
     
        $destinationPath = public_path('/thumbnail');
       
        $img = Image::make($image->path());
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$new_name);
   
        $destinationPath = public_path('/brandimg');
        $image->move($destinationPath, $new_name);
        }
        else
        {
            $new_name = '';
        }
        
        
        $data['image'] = $new_name;

        $data = DB::table('tbl_brand')->insert($data);
       
        if($data == 1)
        {
            return redirect('/brand')->with('success_message', 'Brand added successfully');
        }
        else
        {
            return redirect('/brand')->with('error_message', 'Brand not added successfully');
        }
    }
    public function editbrand($id)
    {
        $brand = DB::table('tbl_brand')->get();
        $category = DB::table('tbl_categories')->get();
      
        $editdata =  DB::table('tbl_brand')->where(array('id' => $id))->first();
        return view('brand', ['editbrand' => $editdata,'brand' => $brand,'category' => $category]);
    }
    public function updatebrand(Request $request)
    {
        $data = $this->validate($request,[
                'name' => 'required',
                'description' => 'required',
                'image' => 'required',
        ]);
        
        $image = $request->file('image');
        if($image != '')
        {   
            $new_name = $image->getclientoriginalname();
            $uploadimg = $new_name;
            $destinationPath = 'brandimg';
             $destinationPath = public_path('/thumbnail');
            $img = Image::make($image->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$new_name);
       
            $destinationPath = public_path('/brandimg');
            $image->move($destinationPath, $new_name);
            
        }else
        {
            $uploadimg = $request->hiddenimage;
        }
        $data['image'] = $uploadimg;
        $updatebrand = DB::table('tbl_brand')->where(array('id' => $request->hiddenid))->update($data);
        if($updatebrand == 1)
        {
            return redirect('/brand')->with('success_message', 'Brand updated successfully');
        }
        else
        {
            return redirect('/brand')->with('error_message', 'Brand not updated successfully');
        }
    }
    public function branddelete($id)
    {
        $data = DB::table('tbl_brand')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/brand')->with('success_message', 'Brand deleted successfully');
        }
        else
        {
            return redirect('/brand')->with('error_message', 'Brand not deleted successfully');
        }
    }
    public function categories()
    {
        $categories = DB::table('tbl_categories')->where(array('pid' => 0))->get();
        $categoriesdata = DB::table('tbl_categories')->where(array('pid' => 0))->orderBy('id','DESC')->get();
        $productcountdata = array();
        
        foreach($categories as $categories)
        {
            $sum = 0;
            $product = $product =  DB::table('tbl_product')->where(array('product_category' => $categories->id))->get();
            $subcat = DB::table('tbl_categories')->where(array('pid' => $categories->id))->get();
            
                
                 $sum = $sum + count($product);
                foreach($subcat as $subcat)
                {
                    $productone = $product =  DB::table('tbl_product')->where(array('product_category' => $subcat->id))->get();
                    
                    $subcatone = DB::table('tbl_categories')->where(array('pid' => $subcat->id))->get();
                    $sum = $sum + count($productone);
                    foreach($subcatone as $subcatone)
                    {
                        $producttwo = $product =  DB::table('tbl_product')->where(array('product_category' => $subcatone->id))->get();
                        
                        $sum = $sum + count($producttwo);
                    }
                    
                }
                array_push($productcountdata,$sum);
            
        }
        
        return view('categories', ['categories' => $categoriesdata,'productcount' => $productcountdata]);
    }
    public function addcategories(Request $request)
    {
        if($request->pid != '')
        {
            $pid = $request->pid;
        }else
        {
            $pid = 0;
        }
        $info = $this->validate($request,[
                'name' => 'required',
                'description' => 'required',
                'slug' => 'required',
                'seo_title' => 'required',
                'seo_description' => 'required',
                'seo_url' => 'required',
                'image' => 'required',
                'bannerimage' => 'required',
        ]);

        $image = $request->file('image');
        if($image != '')
        {
             $new_name = $image->getclientoriginalname();
            
            $destinationPath = public_path('/thumbnail');
            $img = Image::make($image->path());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$new_name);
       
            $destinationPath = public_path('/categoriesimg');
            $image->move($destinationPath, $new_name);
        }
        else
        {
            $new_name = '';
        }
        $info['image'] = $new_name;
         $image2 = $request->file('bannerimage');
        if($image2 != '')
        {
            $new_name2 = $image2->getclientoriginalname();

            $destinationPath = public_path('/thumbnail');
            $img = Image::make($image2->path());
            $img->resize(300, 250, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$new_name2);
       
            $destinationPath = public_path('/categoriesimg');
            $image2->move($destinationPath, $new_name2);
        }else
        {
            $new_name2 = '';
        }
        $info['bannerimage'] = $new_name2;
        
        
            $info['pid'] = $pid;
       
            
        $data = DB::table('tbl_categories')->insert($info);
        if($pid != 0)
        {
            if($data == 1)
            {   
                // return redirect()->route('/viewcategories',[$pid])->with('success_message', 'Categories added successfully');
                 return redirect('/viewcategories/'.$pid)->with('success_message', 'Categories added successfully');
            }
            else
            {
                return redirect()->route('/viewcategories',[$pid])->with('success_message', 'Categories not added successfully');
                
            }
        }else
        {
            if($data == 1)
            {
                return redirect('/categories')->with('success_message', 'Categories added successfully');
            }
            else
            {
                return redirect('/categories')->with('error_message', 'Categories not added successfully');
            }
        }
    }
    public function editcategories($id)
    {
        $categories = DB::table('tbl_categories')->where(array('pid' => 0))->get();
        $categoriesdata = DB::table('tbl_categories')->where(array('pid' => 0))->get();
        $editdata =  DB::table('tbl_categories')->where(array('id' => $id))->first();
        $productcountdata = array();
        foreach($categories as $categories)
        {
            $sum = 0;
            $product = $product =  DB::table('tbl_product')->where(array('product_category' => $categories->id))->get();
            $subcat = DB::table('tbl_categories')->where(array('pid' => $categories->id))->get();
            
                
                 $sum = $sum + count($product);
                foreach($subcat as $subcat)
                {
                    $productone = $product =  DB::table('tbl_product')->where(array('product_category' => $subcat->id))->get();
                    
                    $subcatone = DB::table('tbl_categories')->where(array('pid' => $subcat->id))->get();
                    $sum = $sum + count($productone);
                    foreach($subcatone as $subcatone)
                    {
                        $producttwo = $product =  DB::table('tbl_product')->where(array('product_category' => $subcatone->id))->get();
                        
                        $sum = $sum + count($producttwo);
                    }
                    
                }
                array_push($productcountdata,$sum);
            
        }
      
        return view('categories', ['editcategories' => $editdata,'categories' => $categoriesdata,'productcount' => $productcountdata]);
    }
    public function vieweditcategories($id,$pid)
    {
        $categories = DB::table('tbl_categories')->where(array('pid' => $pid))->get();
        $editdata =  DB::table('tbl_categories')->where(array('id' => $id))->first();
        return view('viewcategories', ['editcategories' => $editdata,'categories' => $categories,'pid' => $pid]);
    }
    
    public function updatecategories(Request $request)
    {
       $info = $this->validate($request,[
                'name' => 'required',
                'description' => 'required',
                'slug' => 'required',
                'seo_title' => 'required',
                'seo_description' => 'required',
                'seo_url' => 'required',
                'image' => 'required',
                'bannerimage' => 'required',
        ]);
        $image = $request->file('image');
        $image2 = $request->file('bannerimage');
         if($image != '')
        {   
            $new_name = $image->getclientoriginalname();
            $uploadimg = $new_name;

            $destinationPath = public_path('/thumbnail');
            $img = Image::make($image->path());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$new_name);
       
            $destinationPath = public_path('/categoriesimg');
            $image->move($destinationPath, $new_name);

            // $destinationPath = 'categoriesimg';
            // $image->move($destinationPath, $new_name);
            
            $uploadimg2 = $request->bannerimg;
            
        }else if($image2 != '')
        {   
            $new_name2 = $image2->getclientoriginalname();

            $uploadimg2 = $new_name2;

            $destinationPath = public_path('/thumbnail');
            $img = Image::make($image2->path());
            $img->resize(400, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$new_name2);
       
            $destinationPath = public_path('/categoriesimg');
            $image2->move($destinationPath, $new_name2);


            // $destinationPath2 = 'categoriesimg'; 
            // $image2->move($destinationPath2, $new_name2);
            
            $uploadimg = $request->hiddenimage;
            
        }else if($image != '' && $image2 != ''){
            $new_name = $image->getclientoriginalname();
            $uploadimg = $new_name;


             $destinationPath = public_path('/thumbnail');
            $img = Image::make($image->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$new_name);
       
            $destinationPath = public_path('/categoriesimg');
            $image->move($destinationPath, $new_name);

            $new_name2 = $image2->getclientoriginalname();
            $uploadimg2 = $new_name2;

             $destinationPath = public_path('/thumbnail');
            $img = Image::make($image2->path());
            $img->resize(300, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$new_name2);
       
            $destinationPath = public_path('/categoriesimg');
            $image2->move($destinationPath, $new_name2);

            // $destinationPath = 'categoriesimg';
            // $image->move($destinationPath, $new_name);
            
            
            // $destinationPath2 = 'categoriesimg';
            // $image2->move($destinationPath2, $new_name2);
        }else
        {
            $uploadimg = $request->hiddenimage;
            $uploadimg2 = $request->bannerimg;
        }
        $info['image'] = $uploadimg;
        $info['bannerimage'] = $uploadimg2;

        $info['pid'] = 0;
        
        $updatecategories = DB::table('tbl_categories')->where(array('id' => $request->hiddenid))->update($info);
        if($request->pid != 0)
        {   $pid = $request->pid;
            if($updatecategories == 1)
            {
                return redirect('/viewcategories/'.$pid)->with('success_message', 'Categories updated successfully');
            }
            else
            {
                return redirect('/viewcategories/'.$pid)->with('error_message', 'Categories not updated successfully');
            }
        }else
        {
            if($updatecategories == 1)
            {
                return redirect('/categories')->with('success_message', 'Categories updated successfully');
            }
            else
            {
                return redirect('/categories')->with('error_message', 'Categories not updated successfully');
            }
        }
        
    }
    public function categoriesdelete($id)
    {
        $data = DB::table('tbl_categories')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/categories')->with('success_message', 'Categories deleted successfully');
        }
        else
        {
            return redirect('/categories')->with('error_message', 'Categories not deleted successfully');
        }
    }
    public function viewcategories($id)
    {
        
        $categories = DB::table('tbl_categories')->where(array('pid' => $id))->get();
        return view('viewcategories', ['categories' => $categories,'pid' => $id]);
    }
    public function attributes()
    {
          $attributes = DB::table('tbl_attribute')->orderBy('id','DESC')->get();
           $category = DB::table('tbl_categories')->where(array('pid' => 0))->get();
        return view('attributes',['attributes' => $attributes,'category' => $category]);
    }
    public function addattributes(Request $request)
    {
        
        $info = $this->validate($request,[
                'category' => 'required',
                'name' => 'required',
                'description' => 'required',
                'slug' => 'required',
        ]);

        $data = DB::table('tbl_attribute')->insert($info);
            
        if($data == 1)
        {
            return redirect('/attributes')->with('success_message', 'Attributes added successfully');
        }
        else
        {
            return redirect('/attributes')->with('error_message', 'Attributes not added successfully');
        }
    }
    public function attributeedit($id)
    {
         $category = DB::table('tbl_categories')->where(array('pid' => 0))->get();
        $attributes = DB::table('tbl_attribute')->get();
        $editdata =  DB::table('tbl_attribute')->where(array('id' => $id))->first();
        return view('attributes', ['editattributes' => $editdata,'attributes' => $attributes,'category' => $category]);
    }
    public function updateattributes(Request $request)
    {
         
         $info = $this->validate($request,[
                'category' => 'required',
                'name' => 'required',
                'description' => 'required',
                'slug' => 'required',
        ]);
        $updatebrand = DB::table('tbl_attribute')->where(array('id' => $request->hiddenid))->update($info);
        if($updatebrand == 1)
        {
            return redirect('/attributes')->with('success_message', 'Attributes updated successfully');
        }
        else
        {
            return redirect('/attributes')->with('error_message', 'Attributes not updated successfully');
        }
    }
      public function attributedelete($id)
    {
        
       
        $deletedata =  DB::table('tbl_attribute')->where(array('id' => $id))->delete();
        return redirect('/attributes')->with('success_message', 'Attributes deleted successfully');
        
    }
    public function terms($id)
    {
        $attributesterms = DB::table('attribute_terms')->where(array('attributeid' => $id))->get();
        $attributedata =  DB::table('tbl_attribute')->where(array('id' => $id))->first();
        
        $attr = $attributedata->name;
        
        return view('terms', ['attributes' => $attributesterms,'attributeid' => $id,'attr'=> $attr]);
    }
      public function termsdelete(Request $request)
    {
        
        $attributesterms = DB::table('attribute_terms')->where(array('id' => $request->id))->delete();
         return redirect('/terms/'. $request->attributeid)->with('success_message', 'Attributes
            Terms deleted successfully');
        
    }
    public function product()
    {
        $attributdata = DB::table('tbl_attribute')->get();
        $attribute = DB::table('tbl_attribute')->get();
        $countries = DB::table('country')->get();
        $category = DB::table('tbl_categories')->where(array('pid' => 0))->get();
        $brand = DB::table('tbl_brand')->get();
        $product =  DB::table('tbl_product')->orderBy('id','DESC')->get();
        $lastid = DB::table('tbl_product')->latest('id')->first();
        $tax = DB::table('tbl_tax')->get();
        $warehouse = DB::table('warehosue')->get();
        $shippingclass = DB::table('shipping_class')->get();
        $deliverysetting = DB::table('tbl_deliverysetting')->get();
         if($lastid != '')
        {
            $lastupdateid = $lastid->id + 1;
        }else
        {
            $lastupdateid = 0;
        }
        
        return view('product', ['country' => $countries,'attribute' => $attribute,'attr' => $attributdata,'category' => $category,'brand' => $brand,'product' => $product,'lastid' =>$lastupdateid,'tax'=> $tax,'warehouse' => $warehouse,'shippingclass' => $shippingclass,'deliverysetting' =>$deliverysetting]);
    
    }
    public function customproductadd(Request $request)
    {
        $info = array(
                'productname' => $request->productname,
                'height' => $request->unitheight,
                'width' => $request->unitwidth,
                'area' => $request->unitarea,
                'qty' => $request->unitqty,
                'price' => $request->unitprice,
                'total' => $request->totalprice,
                'taxtype' => $request->taxwith,
                'tax' => $request->tax,
                'hsn' => $request->hsn,
                'unit' => $request->unit
                
            );
            
        $insert = DB::table('custom_product')->insert($info);
        if($insert == 1)
        {
            return redirect()->back()->with('success_message', 'Custom Product added successfully');
        }else
        {
            return redirect()->back()->with('error_message', 'Custom Product not added ');
        }
    }
    public function customproductupdate(Request $request)
    {
        $info = array(
                'productname' => $request->productname,
                'height' => $request->unitheight,
                'width' => $request->unitwidth,
                'area' => $request->unitarea,
                'qty' => $request->unitqty,
                'price' => $request->unitprice,
                'total' => $request->totalprice,
                'taxtype' => $request->taxwith,
                'tax' => $request->tax,
                'hsn' => $request->hsn,
                'unit' => $request->unit
                
            );
            
        $insert = DB::table('custom_product')->where('id','=',$request->customhiddenid)->update($info);
        if($insert == 1)
        {
            return redirect('proposallist/'.$request->customhiddenproposalid)->with('success_message', 'Custom Product updated successfully');
        }else
        {
            return redirect('proposallist/'.$request->customhiddenproposalid)->with('error_message', 'Custom Product not updated ');
        }
    }
    public function addterms(Request $request)
    {
        if(isset($request->colordata))
        {
         $info = array(
            'name' => $request->name,
            'description' => $request->description,
            'slug'    => $request->slug,
            'color'   => $request->colordata,
            'attributeid' => $request->attributeid
            );
        }else
        {
            $info = array(
            'name' => $request->name,
            'description' => $request->description,
            'slug'    => $request->slug,
            'attributeid' => $request->attributeid
           
            );
        }
        $data = DB::table('attribute_terms')->insert($info);
            
        if($data == 1)
        {
            return redirect('/terms/'. $request->attributeid)->with('success_message', 'Attributes
            Terms added successfully');
        }
        else
        {
            return redirect('/terms/'. $request->attributeid)->with('error_message', 'Attributes Terms not added successfully');
        }
    }
    
    public function editterms($id)
    {
        $attributesterms = DB::table('attribute_terms')->get();
        
        $editattributedata =  DB::table('attribute_terms')->where(array('id' => $id))->first();
        $attributedata =  DB::table('tbl_attribute')->where(array('id' => $editattributedata->attributeid))->first();
        $attr = $attributedata->name;
        return view('terms', ['attributes' => $attributesterms,'attributeid' => $editattributedata->attributeid,'attr'=> $attr,'editattrterms' => $editattributedata]);
    }
    public function updateterms(Request $request)
    {
        if(isset($request->colordata))
        {
         $info = array(
            'name' => $request->name,
            'description' => $request->description,
            'slug'    => $request->slug,
            'color'   => $request->colordata,
            'attributeid' => $request->attributeid
            );
        }else
        {
            $info = array(
            'name' => $request->name,
            'description' => $request->description,
            'slug'    => $request->slug,
            'attributeid' => $request->attributeid
           
            );
        }
        
     
        $updatedata = DB::update('UPDATE `attribute_terms` set `name` = ? , `description` = ? , `slug` = ? , `attributeid` = ? where `id` = ?',[$request->name,$request->description,$request->slug,$request->attributeid,$request->hiddenid]);
    
        if($updatedata == 1)
        {
            return redirect('/terms/'. $request->attributeid)->with('success_message', 'Attributes
            Terms Updated successfully');
        }
        else
        {
            return redirect('/terms/'. $request->attributeid)->with('error_message', 'Attributes Terms not Updated successfully');
        }
    }
    
    function dropzone()
    {
     return view('dropzone');
    }

    function upload(Request $request)
    { 
     $image = $request->file('file');

     $imageName = time() . '.' . $image->extension();

     $image->move(public_path('images'), $imageName);

     return response()->json(['success' => $imageName]);
    }
    
    public function storeMedia(Request $request)
    {
        $path = 'productimg';
    
    
        $file = $request->file('file');
       
    
        $name = str_replace(' ','',$file->getClientOriginalName());
       
        $destinationPath = public_path('/thumbnail');
        $img = Image::make($file->path());
        $img->resize(400, 400, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$name);
   
        $destinationPath = public_path('/productimg');
        $file->move($destinationPath, $name);
    
        return response()->json([
            'name'          => $name,
            'original_name' => str_replace(' ','',$file->getClientOriginalName()),
        ]);
    }
    public function addproduct(Request $request)
    {
        
        
        $gallaryarray = array();
        if($request->file('productgallery') != '')
        {
            foreach($request->file('productgallery') as $productgallery)
            {
                $path = 'productimg';
        
        
                $file = $productgallery;
            
                $galleryname = $file->getClientOriginalName();

                $destinationPath = public_path('/thumbnail');
                $img = Image::make($file->path());
                $img->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$galleryname);
           
                $destinationPath = public_path('/productimg');
                $file->move($destinationPath, $galleryname);
            
                // $file->move($path, $galleryname);
                 array_push($gallaryarray,$galleryname);
            }
        }else
        {
            
        }
        if($request->document != '')
        {
            $document = implode(',',$request->document);
        }
        else
        {
            $document = '';
        }
       
        
        if($request->virtual != 0)
        {
            $p_type = $request->virtual;
        }else if($request->download != 0)
        {
            $p_type = $request->download;
        }else
        {
             $p_type = $request->producttype;
        }
        if($p_type == 5)
        {
             $info = array(
                    'product_name'          => $request->name,
                    'product_description'   => $request->description,
                    'hsn'                   => $request->hsn,
                    'product_category'      => $request->category,
                    'product_brand'         => $request->brand,
                    'product_media'         => $document,
                    'product_type'          => $p_type,
                    'regular_price'         => $request->regualrprice,
                    'sale_price'            => $request->saleprice,
                    'seo_title'             => $request->title,
                    'seo_description'       => $request->seodescription,
                    'seo_url'               => $request->urlhande,
                    'download_limit'        => $request->downloadlimit,
                    'download_expiary'      => $request->downloadexpairy,
                    'download_file'         => implode(',',$request->downloadfile),
                    'download_url'          => implode(',',$request->downloadurl),
                    'sale_start_date'       => $request->salestart,
                    'sale_end_date'         => $request->saleend,
                    'seo_key'               => $request->seokey,
                    'product_gallery'       => implode(',',$gallaryarray),
                    'up_sell'               => $request->upsell,
                    'cross_sell'            => $request->crosssell,
                    'taxstatus'             => $request->taxstatus,
                    'salestatus'            => $request->sale_status,
                    'purchasestatus'        => $request->purchase_status,
                    'warehouse'             => $request->warehouse,
                    'deliveryflab'          => $request->deliveryflab,
                    'tax'                   => $request->tax,
                    'taxwith'               =>  $request->taxwith, 
                    'shippingclass'         => $request->shippingclass
                );
       
            $insertproduct = DB::table('tbl_product')->insertGetId($info);
        }else if($p_type == 3){
             $info = array(
                    'product_name'          => $request->name,
                    'product_description'   => $request->description,
                    'hsn'                   => $request->hsn,
                    'product_category'      => $request->category,
                    'product_brand'         => $request->brand,
                    'product_media'         => $document,
                    'product_type'          => $p_type,
                    'regular_price'         => $request->regualrprice,
                    'sale_price'            => $request->saleprice,
                    'seo_title'             => $request->title,
                    'seo_description'       => $request->seodescription,
                    'seo_url'               => $request->urlhande,
                    'sale_start_date'       => $request->salestart,
                    'sale_end_date'         => $request->saleend,
                    'seo_key'               => $request->seokey,
                    'product_gallery'       => implode(',',$gallaryarray),
                    'up_sell'               => $request->upsell,
                    'cross_sell'            => $request->crosssell,
                    'product_url'           => $request->producturl,
                    'btn_txt'               => $request->buttontxt,
                    'taxstatus'             => $request->taxstatus,
                    
                    'salestatus'            => $request->sale_status,
                    'purchasestatus'        => $request->purchase_status,
                    'warehouse'             => $request->warehouse,
                    'deliveryflab'          => $request->deliveryflab,
                    'tax'                   => $request->tax,
                    'taxwith'               => $request->taxwith, 
                    'shippingclass'         => $request->shippingclass
                );
       
            $insertproduct = DB::table('tbl_product')->insertGetId($info);
        }else if($p_type == 2){
              $info = array(
                    'product_name'          => $request->name,
                    'product_description'   => $request->description,
                    'hsn'                   => $request->hsn,
                    'group_product_id'      => implode(',',$request->groupproductdata),
                    'product_category'      => $request->category,
                    'product_brand'         => $request->brand,
                    'product_media'         => $document,
                    'product_type'          => $p_type,
                    'regular_price'         => $request->regualrprice,
                    'sale_price'            => $request->saleprice,
                    'seo_title'             => $request->title,
                    'seo_description'       => $request->seodescription,
                    'seo_url'               => $request->urlhande,
                    'sale_start_date'       => $request->salestart,
                    'sale_end_date'         => $request->saleend,
                    'seo_key'               => $request->seokey,
                    'product_gallery'       => implode(',',$gallaryarray),
                    'up_sell'               => $request->upsell,
                    'cross_sell'            => $request->crosssell,
                    'taxstatus'             => $request->taxstatus,
                    
                    'salestatus'            => $request->sale_status,
                    'purchasestatus'        => $request->purchase_status,
                    'warehouse'             => $request->warehouse,
                    'deliveryflab'          => $request->deliveryflab,
                    'tax'                   => $request->tax,
                    'taxwith'               => $request->taxwith, 
                    'shippingclass'         => $request->shippingclass
                );
            $insertproduct = DB::table('tbl_product')->insertGetId($info);
        }else if($p_type == 8){
             $info = array(
                    'product_name'          => $request->name,
                    'product_description'   => $request->description,
                    'hsn'                   => $request->hsn,
                    'product_category'      => $request->category,
                    'product_brand'         => $request->brand,
                    'product_media'         => $document,
                    'product_type'          => $p_type,
                    'regular_price'         => $request->regualrprice,
                    'sale_price'            => $request->saleprice,
                    'seo_title'             => $request->title,
                    'seo_description'       => $request->seodescription,
                    'seo_url'               => $request->urlhande,
                    'sale_start_date'       => $request->salestart,
                    'sale_end_date'         => $request->saleend,
                    'seo_key'               => $request->seokey,
                    'product_gallery'       => implode(',',$gallaryarray),
                    'up_sell'               => $request->upsell,
                    'cross_sell'            => $request->crosssell,
                    'taxstatus'             => $request->taxstatus,
                    'salestatus'            => $request->sale_status,
                    'purchasestatus'        => $request->purchase_status,
                    'warehouse'             => $request->warehouse,
                    'deliveryflab'          => $request->deliveryflab,
                    'tax'                   => $request->tax,
                    'taxwith'               => $request->taxwith, 
                    'shippingclass'         => $request->shippingclass,
                    'group_product_id'      => implode(',',$request->compositproductdata),
                    'compositqty'           => implode(',',$request->compositqty)
                );
       
            $insertproduct = DB::table('tbl_product')->insertGetId($info);
        }
        else if($p_type == 9){
             $info = array(
                    'product_name'          => $request->name,
                    'product_description'   => $request->description,
                    'hsn'                   => $request->hsn,
                    'product_category'      => $request->category,
                    'product_brand'         => $request->brand,
                    'product_media'         => $document,
                    'product_type'          => $p_type,
                    'regular_price'         => $request->regualrprice,
                    'sale_price'            => $request->saleprice,
                    'seo_title'             => $request->title,
                    'seo_description'       => $request->seodescription,
                    'seo_url'               => $request->urlhande,
                    'sale_start_date'       => $request->salestart,
                    'sale_end_date'         => $request->saleend,
                    'seo_key'               => $request->seokey,
                    'product_gallery'       => implode(',',$gallaryarray),
                    'up_sell'               => $request->upsell,
                    'cross_sell'            => $request->crosssell,
                    'taxstatus'             => $request->taxstatus,
                    'salestatus'            => $request->sale_status,
                    'purchasestatus'        => $request->purchase_status,
                    'warehouse'             => $request->warehouse,
                    'deliveryflab'          => $request->deliveryflab,
                    'tax'                   => $request->tax,
                    'taxwith'               => $request->taxwith, 
                    'shippingclass'         => $request->shippingclass,
                    'unitdata'              => $request->unit,
                    'unitheight'            => $request->unitheight,
                    'unitwidth'             => $request->unitwidth,
                    'unitarea'              => $request->unitarea,
                    'unitquantity'          => $request->unitqty,
                    
                );
       
            $insertproduct = DB::table('tbl_product')->insertGetId($info);
        }else
        {
            $info = array(
                    'product_name'          => $request->name,
                    'product_description'   => $request->description,
                    'hsn'                   => $request->hsn,
                    'product_category'      => $request->category,
                    'product_brand'         => $request->brand,
                    'product_media'         => $document,
                    'product_type'          => $p_type,
                    'regular_price'         => $request->regualrprice,
                    'sale_price'            => $request->saleprice,
                    'seo_title'             => $request->title,
                    'seo_description'       => $request->seodescription,
                    'seo_url'               => $request->urlhande,
                    'sale_start_date'       => $request->salestart,
                    'sale_end_date'         => $request->saleend,
                    'seo_key'               => $request->seokey,
                    'product_gallery'       => implode(',',$gallaryarray),
                    'up_sell'               => $request->upsell,
                    'cross_sell'            => $request->crosssell,
                    'taxstatus'             => $request->taxstatus,
                    'salestatus'            => $request->sale_status,
                    'purchasestatus'        => $request->purchase_status,
                    'warehouse'             => $request->warehouse,
                    'deliveryflab'          => $request->deliveryflab,
                    'tax'                   => $request->tax,
                    'taxwith'               => $request->taxwith, 
                    'shippingclass'         => $request->shippingclass
                );
       
            $insertproduct = DB::table('tbl_product')->insertGetId($info);
        }
        $countoption = $request->optiondataidnew;
        $attributetermdata = $request->attributeterm;
        
        if($insertproduct != 0)
        {
                if($request->enablestock == 1)
                {
                    $stockqty = $request->stockquantity;
                    $allowbarcodes = $request->allowbarcodes;
                    $stockthreshold = $request->stockthreshold;
                    
                    $info = array(
                            'productid' => $insertproduct,
                            'stockqty'  => $stockqty,
                            'allowbarcodes' => $allowbarcodes,
                            'stockthreshold' => $stockthreshold
                        
                        );
                        
                    $insertstock = DB::table('stock')->insertGetId($info);
                }
                // $newattrarray = array();
                // $attrimage = $request->varientimage;
                // $attrvarientquantity = $request->varientquantity;
                // if($attributetermdata != '')
                // {
                //      foreach($attributetermdata as $key =>  $attrterm)
                //     {
                //          $info2 = array(
                //                     'product_id' => $insertproduct,
                //                     'term_id'    => $attrterm,
                                    
                //              );
                //         $insertproductvarient = DB::table('tbl_product_varient')->insert($info2);    
                //     }
                // }else
                // {
                //      $insertproductvarient = 1;
                // }
               
                // if($insertproductvarient == 1)
                // {
                $info3 = array(
                                'product_id' => $insertproduct,
                                'sku'        => $request->sku,
                                'barcode'    => $request->barcode,
                                'minqty'        => $request->minquantity,
                                'maxqty'        => $request->maxquantity
                            );
                $insertproductinventory = DB::table('tbl_inventory')->insertGetId($info3); 
                    
                    if($insertproductinventory != 0)
                    {
                        if($p_type != 4)
                        {
                            $info4 = array(
                                'weight'        => $request->weight,
                                'unit'          => $request->weightUnit,
                                'country'       => $request->country,
                                'product_id'    => $insertproduct,
                                'length'        =>  $request->length,
                                'width'         =>  $request->width,
                                'height'        =>  $request->height
                            );
                            $shipping = DB::table('tbl_product_shipping')->insert($info4);
                            if($shipping)
                            {
                                return redirect('productvareint/'.$insertproduct.'');
                            }
                        }else
                        {
                            return redirect('productvareint/'.$insertproduct.'');
                        }
                        
                    // }
                
                }
                
        }
    }
    public function productvareint(Request $request)
    {
        $attributdata = DB::table('tbl_attribute')->get();
        $attribute = DB::table('tbl_attribute')->get();
        $countries = DB::table('country')->get();
        $category = DB::table('tbl_categories')->where(array('pid' => 0))->get();
        $brand = DB::table('tbl_brand')->get();
        $product =  DB::table('tbl_product')->orderBy('id','DESC')->get();
        $lastid = DB::table('tbl_product')->latest('id')->first();
        $tax = DB::table('tbl_tax')->get();
        $warehouse = DB::table('warehosue')->get();
        $shippingclass = DB::table('shipping_class')->get();
        $deliverysetting = DB::table('tbl_deliverysetting')->get();
        $lastupdateid = $lastid->id + 1;
        
        return view('product', ['deliverysetting' => $deliverysetting,'country' => $countries,'attribute' => $attribute,'attr' => $attributdata,'category' => $category,'brand' => $brand,'product' => $product,'lastid' =>$lastupdateid,'tax'=> $tax,'warehouse' => $warehouse,'shippingclass' => $shippingclass,'varientproductidfinal' => $request->id]);
      
    }
    public function productvareintedit(Request $request)
    {
        $attributdata = DB::table('tbl_attribute')->get();
        $attributtermnew = DB::table('attribute_terms')->get();
      
        $attributeedit = DB::table('tbl_attribute')->get();
        
        $countries = DB::table('country')->get();
        $category = DB::table('tbl_categories')->where(array('pid' => 0))->get();
        $brand = DB::table('tbl_brand')->get();
        $inventory = DB::table('tbl_inventory')->get();
        $pshipping = DB::table('tbl_product_shipping')->get();
        $pvarient = DB::table('tbl_product_varient')->get();
        
        
        $editdata =  DB::table('tbl_product')->where(array('id' => $request->id))->first();
        $editinventorydata =  DB::table('tbl_inventory')->where(array('product_id' => $request->id))->first();
        $editshippingdata =  DB::table('tbl_product_shipping')->where(array('product_id' => $request->id))->first();
        $editattributedata =  DB::table('tbl_product_varient')->where(array('product_id' => $request->id))->get();
        $editattributedatavalue =  DB::table('tbl_product_attribute')->where(array('product_id' => $request->id))->get();
        $editproductstock = DB::table('stock')->where(array('productid' => $request->id))->first();
         $tax = DB::table('tbl_tax')->get();
           $warehouse = DB::table('warehosue')->get();
            $deliverysetting = DB::table('tbl_deliverysetting')->get();
        $shippingclass = DB::table('shipping_class')->get();
        $productvarient = DB::table('tbl_product_varient')->where(array('product_id' => $request->id))->get();
        $attributdata = DB::table('tbl_attribute')->get();
        $attribute = DB::table('tbl_attribute')->get();
        
       
        
        $product =  DB::table('tbl_product')->orderBy('id','DESC')->get();
        $lastid = DB::table('tbl_product')->latest('id')->first();
        $tax = DB::table('tbl_tax')->get();
        $warehouse = DB::table('warehosue')->get();
        $shippingclass = DB::table('shipping_class')->get();
        $lastupdateid = $lastid->id + 1;
        
       
      return view('product', ['deliverysetting' => $deliverysetting,'country' => $countries,'attribute' => $attribute,'attributeedit' => $attributeedit,'attr' => $attributdata,'category' => $category,'brand' => $brand,'product' => $product,'lastid' =>$request->id,'tax'=> $tax,'warehouse' => $warehouse,'shippingclass' => $shippingclass,'editvarientproductidfinal' => $request->id,'editproduct' => $editdata,'editinventory' => $editinventorydata,'editshipping' => $editshippingdata,'editattributedata' => $editattributedata,'attributtermnew' => $attributtermnew,'editproductstock' => $editproductstock,'tax' => $tax,'warehouse' => $warehouse,'shippingclass' => $shippingclass,'productvarient' => $productvarient,'editattributedatavalue' => $editattributedatavalue]);
    }
    public function productlist(Request $request)
    {
        $product = DB::table('tbl_product')->orderBy('id','DESC')->get();
        return view('productlist',['product' => $product]);
    }
    public function paymentgatwaykey(Request $request)
    {
        $paymentdata = DB::table('payment_gateway')->first();
         return view('paymentgatewaykey',['paymentdata' => $paymentdata]);
    }
    public function updatepaymentgatewaykeys(Request $request)
    {
        $info = array(
                    'razorpay_api_key' => $request->razorpayapikey,
                    'razorpay_secret_key' => $request->razorpaysecretapikey,
                    'paypal_api_key'    => $request->paypalapikey,
                    'paypal_secret_key'  => $request->paypalsecretapikey
            );
        $update = DB::table('payment_gateway')->where(array('id' => 1))->update($info);
        
            return redirect('paymentgatwaykey')->with('success_message', 'Payment Deatils Updated Successfully');
        
    }
    public function editproduct($id)
    {
        $attributdata = DB::table('tbl_attribute')->get();
        $attributtermnew = DB::table('attribute_terms')->get();
      
        $attributeedit = DB::table('tbl_attribute')->get();
        
        $countries = DB::table('country')->get();
        $category = DB::table('tbl_categories')->where(array('pid' => 0))->get();
        $brand = DB::table('tbl_brand')->get();
        $inventory = DB::table('tbl_inventory')->get();
        $pshipping = DB::table('tbl_product_shipping')->get();
        $pvarient = DB::table('tbl_product_varient')->get();
        $product =  DB::table('tbl_product')->get();
        
        $editdata =  DB::table('tbl_product')->where(array('id' => $id))->first();
        $editinventorydata =  DB::table('tbl_inventory')->where(array('product_id' => $id))->first();
        $editshippingdata =  DB::table('tbl_product_shipping')->where(array('product_id' => $id))->first();
        $editattributedata =  DB::table('tbl_product_varient')->where(array('product_id' => $id))->get();
        $editattributedatavalue =  DB::table('tbl_product_attribute')->where(array('product_id' => $id))->get();
        $editproductstock = DB::table('stock')->where(array('productid' => $id))->first();
         $tax = DB::table('tbl_tax')->get();
           $warehouse = DB::table('warehosue')->get();
        $shippingclass = DB::table('shipping_class')->get();
        $productvarient = DB::table('tbl_product_varient')->where(array('product_id' => $id))->get();
        $deliverysetting = DB::table('tbl_deliverysetting')->get();
        return view('product', ['deliverysetting' => $deliverysetting,'country' => $countries,'attributeedit' => $attributeedit,'attr' => $attributdata,'category' => $category,'brand' => $brand,'product' => $product,'editproduct' => $editdata,'editinventory' => $editinventorydata,'editshipping' => $editshippingdata,'editattributedata' => $editattributedata,'attributtermnew' => $attributtermnew,'editproductstock' => $editproductstock,'tax' => $tax,'warehouse' => $warehouse,'shippingclass' => $shippingclass,'productvarient' => $productvarient,'editattributedatavalue' => $editattributedatavalue]);
        
    }
    public function updateproduct(Request $request)
    {
        
        // $image = $request->document;
        // if($image[0] != '')
        // {  
        //     $uploadimg = array();
        //     foreach($image as $images)
        //     {
        //         array_push($uploadimg,$images);
                
        //     }
        //     $uploadfinalimage = implode(',',$uploadimg);
            
        // }else
        // {
        //     $uploadfinalimage = $request->hiddenimage;
        // }
        //  if($request->virtual != 0)
        // {
        //     $p_type = $request->virtual;
        // }else if($request->download != 0)
        // {
        //     $p_type = $request->download;
        // }else
        // {
        //      $p_type = $request->producttype;
        // }
        // $info = array(
        //             'product_name'          => $request->name,
        //             'product_description'   => $request->description,
        //             'product_category'      => $request->category,
        //             'product_brand'         => $request->brand,
        //             'product_media'         => $uploadfinalimage,
        //             'product_type'          => $p_type,
        //             'regular_price'         => $request->regualrprice,
        //             'sale_price'            => $request->saleprice,
        //             'seo_title'             => $request->title,
        //             'seo_description'       => $request->seodescription,
        //             'seo_url'               => $request->urlhande
        //         );
        // $updateproduct = DB::table('tbl_product')->where(array('id' => $request->hiddenid))->update($info);
        
        // $info2 = array(
        //             'term_id'     => $request->attributeterm,
                
        //     );
        // $updatevarient = DB::table('tbl_product_varient')->where(array('product_id'  => $request->hiddenid))->update($info2);      
            
            
            
        // $info3 = array(
        //              'sku'         => $request->sku,
        //              'barcode'     => $request->barcode,
        //     );
        // $updateinventory = DB::table('tbl_inventory')->where(array('product_id'  => $request->hiddenid))->update($info3);
        
        // $info4 = array(
        //             'weight'       => $request->weight,
        //             'unit'         => $request->weightUnit,
        //             'country'      => $request->country,
        //     );
        // $updateshipping = DB::table('tbl_product_shipping')->where(array('product_id'  => $request->hiddenid))->update($info4);    
        
        
        //  return redirect('product')->with('success_message', 'Product update successfully');   
         
         
        $gallaryarray = array();
        if($request->file('productgallery') != '')
        {
            foreach($request->file('productgallery') as $productgallery)
            {
                $path = 'productimg';
        
        
                $file = $productgallery;
            
                $galleryname = $file->getClientOriginalName();
                $destinationPath = public_path('/thumbnail');
                $img = Image::make($file->path());
                $img->resize(200 , 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$galleryname);
           
                $destinationPath = public_path('/productimg');
                $file->move($destinationPath, $galleryname);
            
                // $file->move($path, $galleryname);
                array_push($gallaryarray,$galleryname);
            }
            $galleryimgdata = implode(',',$gallaryarray);
        }else if($request->hiddenimagegallery != ''){
            $galleryimgdata = $request->hiddenimagegallery;
        }else
        {
             $galleryimgdata = '';
        }
        if($request->document != '')
        {
           
            $document = implode(',',$request->document);
        }else if($request->hiddenimage != '')
        {
            $document = $request->hiddenimage;
        }
        else
        {
            $document = '';
        }
        
        
        if($request->virtual != 0)
        {
            $p_type = $request->virtual;
        }else if($request->download != 0)
        {
            $p_type = $request->download;
        }else
        {
             $p_type = $request->producttype;
        }
        if($p_type == 5)
        {
             $info = array(
                    'product_name'          => $request->name,
                    'product_description'   => $request->description,
                    'hsn'                   => $request->hsn,
                    'product_category'      => $request->category,
                    'product_brand'         => $request->brand,
                    'product_media'         => $document,
                    'product_type'          => $p_type,
                    'regular_price'         => $request->regualrprice,
                    'sale_price'            => $request->saleprice,
                    'seo_title'             => $request->title,
                    'seo_description'       => $request->seodescription,
                    'seo_url'               => $request->urlhande,
                    'download_limit'        => $request->downloadlimit,
                    'download_expiary'      => $request->downloadexpairy,
                    'download_file'         => implode(',',$request->downloadfile),
                    'download_url'          => implode(',',$request->downloadurl),
                    'sale_start_date'       => $request->salestart,
                    'sale_end_date'         => $request->saleend,
                    'seo_key'               => $request->seokey,
                    'product_gallery'       => $galleryimgdata,
                    'up_sell'               => $request->upsell,
                    'cross_sell'            => $request->crosssell,
                    'taxstatus'             => $request->taxstatus,
                    'salestatus'            => $request->sale_status,
                    'purchasestatus'        => $request->purchase_status,
                    'warehouse'             => $request->warehouse,
                    'deliveryflab'          => $request->deliveryflab,
                    'tax'                   => $request->tax,
                    'taxwith'               => $request->taxwith,
                    
                    'shippingclass'         => $request->shippingclass
                );
       
            $insertproduct = DB::table('tbl_product')->where(array('id'  => $request->hiddenid))->update($info);
        }else if($p_type == 3){
             $info = array(
                    'product_name'          => $request->name,
                    'product_description'   => $request->description,
                    'hsn'                   => $request->hsn,
                    'product_category'      => $request->category,
                    'product_brand'         => $request->brand,
                    'product_media'         => $document,
                    'product_type'          => $p_type,
                    'regular_price'         => $request->regualrprice,
                    'sale_price'            => $request->saleprice,
                    'seo_title'             => $request->title,
                    'seo_description'       => $request->seodescription,
                    'seo_url'               => $request->urlhande,
                    'sale_start_date'       => $request->salestart,
                    'sale_end_date'         => $request->saleend,
                    'seo_key'               => $request->seokey,
                    'product_gallery'       => $galleryimgdata,
                    'up_sell'               => $request->upsell,
                    'cross_sell'            => $request->crosssell,
                    'product_url'           => $request->producturl,
                    'btn_txt'               => $request->buttontxt,
                    'taxstatus'             => $request->taxstatus,
                    'salestatus'            => $request->sale_status,
                    'purchasestatus'        => $request->purchase_status,
                    'warehouse'             => $request->warehouse,
                    'deliveryflab'          => $request->deliveryflab,
                    'tax'                   => $request->tax,
                    'taxwith'               => $request->taxwith, 
                    
                    'shippingclass'         => $request->shippingclass
                );
       
            $insertproduct = DB::table('tbl_product')->where(array('id'  => $request->hiddenid))->update($info);
        }else if($p_type == 8){
             $info = array(
                    'product_name'          => $request->name,
                    'product_description'   => $request->description,
                    'hsn'                   => $request->hsn,
                    'product_category'      => $request->category,
                    'product_brand'         => $request->brand,
                    'product_media'         => $document,
                    'product_type'          => $p_type,
                    'regular_price'         => $request->regualrprice,
                    'sale_price'            => $request->saleprice,
                    'seo_title'             => $request->title,
                    'seo_description'       => $request->seodescription,
                    'seo_url'               => $request->urlhande,
                    'sale_start_date'       => $request->salestart,
                    'sale_end_date'         => $request->saleend,
                    'seo_key'               => $request->seokey,
                    'product_gallery'       => implode(',',$gallaryarray),
                    'up_sell'               => $request->upsell,
                    'cross_sell'            => $request->crosssell,
                    'taxstatus'             => $request->taxstatus,
                    'salestatus'            => $request->sale_status,
                    'purchasestatus'        => $request->purchase_status,
                    'warehouse'             => $request->warehouse,
                    'deliveryflab'          => $request->deliveryflab,
                    'tax'                   => $request->tax,
                    'taxwith'               => $request->taxwith, 
                    'shippingclass'         => $request->shippingclass,
                    'group_product_id'      => implode(',',$request->compositproductdata),
                    'compositqty'           => implode(',',$request->compositqty)
                );
       
            $insertproduct = DB::table('tbl_product')->where(array('id'  => $request->hiddenid))->update($info);
        }else
        {
           
            $info = array(
                    'product_name'          => $request->name,
                    'product_description'   => $request->description,
                    'hsn'                   => $request->hsn,
                    'product_category'      => $request->category,
                    'product_brand'         => $request->brand,
                    'product_media'         => $document,
                    'product_type'          => $p_type,
                    'regular_price'         => $request->regualrprice,
                    'sale_price'            => $request->saleprice,
                    'seo_title'             => $request->title,
                    'seo_description'       => $request->seodescription,
                    'seo_url'               => $request->urlhande,
                    'sale_start_date'       => $request->salestart,
                    'sale_end_date'         => $request->saleend,
                    'seo_key'               => $request->seokey,
                    'product_gallery'       => $galleryimgdata,
                    'up_sell'               => $request->upsell,
                    'cross_sell'            => $request->crosssell,
                    'taxstatus'             => $request->taxstatus,
                    'salestatus'            => $request->sale_status,
                    'purchasestatus'        => $request->purchase_status,
                    'warehouse'             => $request->warehouse,
                    'deliveryflab'          => $request->deliveryflab,
                    'tax'                   => $request->tax,
                    'taxwith'               => $request->taxwith, 
                    'shippingclass'         => $request->shippingclass
                );
               
        
            $insertproduct = DB::table('tbl_product')->where(array('id'  => $request->hiddenid))->update($info);
        }
        $countoption = $request->optiondataidnew;
        $attributetermdata = $request->attributeterm;
        
        
                if($request->enablestock == 1)
                {
                    $stockqty = $request->stockquantity;
                    $allowbarcodes = $request->allowbarcodes;
                    $stockthreshold = $request->stockthreshold;
                    $existstock = DB::table('stock')->where(array('productid'  => $request->hiddenid))->first();
                    if($existstock != '')
                    {
                         $info = array(
                            
                            'stockqty'  => $stockqty,
                            'allowbarcodes' => $allowbarcodes,
                            'stockthreshold' => $stockthreshold
                        
                        );
                        $insertstock = DB::table('stock')->where(array('productid'  => $request->hiddenid))->update($info);
                    }else
                    {
                          $info = array(
                            'productid' => $request->hiddenid,
                            'stockqty'  => $stockqty,
                            'allowbarcodes' => $allowbarcodes,
                            'stockthreshold' => $stockthreshold
                        
                        );
                        $insertstock = DB::table('stock')->insert($info);
                    }
                   
                        
                    
                }
                // $newattrarray = array();
                // $attrimage = $request->varientimage;
                // $attrvarientquantity = $request->varientquantity;
                // if($attributetermdata != '')
                // {
                //     foreach($attributetermdata as $key =>  $attrterm)
                //     {
                //         $existattr = DB::table('tbl_product_varient')->where(array('product_id'  => $request->hiddenid))->first();
                //         if($existattr != '')
                //         {
                //             $info2 = array(
                                   
                //                     'term_id'    => $attrterm,
                                    
                //              );
                //             $insertproductvarient = DB::table('tbl_product_varient')->where(array('product_id'  => $request->hiddenid))->update($info2);   
                //         }else
                //         {
                //             $info2 = array(
                //                     'product_id' => $request->hiddenid,
                //                     'term_id'    => $attrterm,
                                    
                //             );
                //             $insertproductvarient = DB::table('tbl_product_varient')->insert($info2); 
                //         }
                         
                //     }
                // }else
                // {
                //      $insertproductvarient = 1;
                // }
               
                // if($insertproductvarient == 1)
                // {
                    $existinventory =  DB::table('tbl_inventory')->where(array('product_id'  => $request->hiddenid))->first();
                    if($existinventory != '')
                    {
                        $info3 = array(
                                
                                'sku'        => $request->sku,
                                'barcode'    => $request->barcode,
                                'minqty'        => $request->minquantity,
                                'maxqty'        => $request->maxquantity
                            );
                        $insertproductinventory = DB::table('tbl_inventory')->where(array('product_id'  => $request->hiddenid))->update($info3); 
                    }else
                    {
                        $info3 = array(
                                'product_id' => $request->hiddenid,
                                'sku'        => $request->sku,
                                'barcode'    => $request->barcode,
                                'minqty'        => $request->minquantity,
                                'maxqty'        => $request->maxquantity
                            );
                        $insertproductinventory = DB::table('tbl_inventory')->insert($info3); 
                    }
                    
                    
                   
                        if($p_type != 4)
                        {
                            $existshipping =  DB::table('tbl_product_shipping')->where(array('product_id'  => $request->hiddenid))->first();
                            if($existshipping != '')
                            {
                                $info4 = array(
                                'weight'        => $request->weight,
                                'unit'          => $request->weightUnit,
                                'country'       => $request->country,
                               
                                'length'        =>  $request->length,
                                'width'         =>  $request->width,
                                'height'        =>  $request->height
                            );
                                $shipping = DB::table('tbl_product_shipping')->where(array('product_id'  => $request->hiddenid))->update($info4);
                                if($shipping)
                                {
                                    return redirect('product')->with('success_message', 'Product updated successfully');
                                }
                            }else
                            {
                                $info4 = array(
                                'weight'        => $request->weight,
                                'unit'          => $request->weightUnit,
                                'country'       => $request->country,
                                'product_id'    => $request->hiddenid,
                                'length'        =>  $request->length,
                                'width'         =>  $request->width,
                                'height'        =>  $request->height
                            );
                                $shipping = DB::table('tbl_product_shipping')->insert($info4);
                                if($shipping)
                                {
                                    return redirect('productvareintedit/'.$request->hiddenid.'');
                                }
                            }
                            
                        }else
                        {
                             return redirect('productvareintedit/'.$request->hiddenid.'');
                        }
                      
                    
                
              return redirect('productvareintedit/'.$request->hiddenid.'');
          
        
        
    }
    public function productdelete($id)
    {
        $data = DB::table('tbl_product')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/product')->with('success_message', 'Product deleted successfully');
        }
        else
        {
            return redirect('/product')->with('error_message', 'Product not deleted successfully');
        }
    }
    public function currency()
    {
        
        $currency = DB::table('tbl_currency')->get();
         $currencydata = DB::table('tbl_currency')->get();
        $icurrency = DB::table('currency')->get();
        $countries = DB::table('country')->get();
        return view('currency', ['currency' => $icurrency,'country' => $countries,'currencydata' => $currencydata]);
        
        
    }
    public function getterms(Request $request)
    {
        $terms = DB::table('attribute_terms')->where(array('attributeid' => $request->attribute))->get();
        $html =  '';
       foreach($terms as $terms)
        {
            $html .= '<option value="'.$terms->id.'">'.$terms->name.'</option>';
        }
     echo $html;
    }
    public function addcurrency(Request $request)
    {
        $info = $this->validate($request,[
                'currency' => 'required',
                'code' => 'required',
                'symbol' => 'required',
                'lastupdate' => 'required',
        ]);
        $info['lastupdate'] = date('Y-m-d');    
        $data = DB::table('tbl_currency')->insert($info);
            
        if($data == 1)
        {
            return redirect('/currency')->with('success_message', 'Currency added successfully');
        }
        else
        {
            return redirect('/currency')->with('error_message', 'Currency not added successfully');
        }
    }
    public function currencydelete($id)
    {
        $data = DB::table('tbl_currency')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/currency')->with('success_message', 'Currency deleted successfully');
        }
        else
        {
            return redirect('/currency')->with('error_message', 'Currency not deleted successfully');
        }
    }
    public function giftcard()
    {
        $giftcard = DB::table('tbl_giftcard')->get();
       return view('giftcard',['giftcard' => $giftcard]);
    }
    public function addgiftcard(Request $request)
    {

        $info = $this->validate($request,[
                'title' => 'required',
                'description' => 'required',
                'seo_title' => 'required',
                'seo_description' => 'required',
                'denomiation' => 'array',
        ]);    

        $info['denomiation'] = implode(',',$request->denomiation);
        $data = DB::table('tbl_giftcard')->insert($info);
            
        if($data == 1)
        {
            return redirect('/giftcard')->with('success_message', 'Gift Card added successfully');
        }
        else
        {
            return redirect('/giftcard')->with('error_message', 'Gift Card not added successfully');
        }
    }
    public function editgiftcard($id)
    {
        $giftcard = DB::table('tbl_giftcard')->get();
        $editdata =  DB::table('tbl_giftcard')->where(array('id' => $id))->first();
        return view('giftcard', ['editgiftcard' => $editdata,'giftcard' => $giftcard]);
    }
    public function updategiftcard(Request $request)
    {
        $info = $this->validate($request,[
                'title' => 'required',
                'description' => 'required',
                'seo_title' => 'required',
                'seo_description' => 'required',
                'denomiation' => 'array',
        ]);    

        $info['denomiation'] = implode(',',$request->denomiation);
        $updategiftcard = DB::table('tbl_giftcard')->where(array('id' => $request->hiddenid))->update($info);
        if($updategiftcard == 1)
        {
            return redirect('/giftcard')->with('success_message', 'Gift Card updated successfully');
        }
        else
        {
            return redirect('/giftcard')->with('error_message', 'Gift Card not updated successfully');
        }
    }
    public function giftcarddelete($id)
    {
        $data = DB::table('tbl_giftcard')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/giftcard')->with('success_message', 'Gift Card deleted successfully');
        }
        else
        {
            return redirect('/giftcard')->with('error_message', 'Gift Card not deleted successfully');
        }
    }
    public function discount()
    {
       $countries = DB::table('country')->get();
       $discount = DB::table('tbl_discount')->get();
       return view('discount',['country' => $countries,'discount' => $discount]);
    }
    public function adddiscount(Request $request)
    {       
            $info = $this->validate($request,[
                'discountcode' => 'required',
                'types' => 'required',
                'countries' => 'required',
                'shippingrate' => 'required',
                'minrequire' => 'required',
                'limitdata' => 'required',
                'startdate' => 'required',
                'enddate' => 'required',
                'seo_title' => 'required',
                'seo_description' => 'required',
            ]);
        $data = DB::table('tbl_discount')->insert($info);
            
        if($data == 1)
        {
            return redirect('/discount')->with('success_message', 'Discount added successfully');
        }
        else
        {
            return redirect('/discount')->with('error_message', 'Discount not added successfully');
        }
    }
    public function editdiscount($id)
    {
        $countries = DB::table('country')->get();
        $discount = DB::table('tbl_discount')->get();
        $editdata =  DB::table('tbl_discount')->where(array('id' => $id))->first();
        return view('discount', ['editdiscount' => $editdata,'discount' => $discount,'country' => $countries]);
    }
     public function updatediscount(Request $request)
    {
        
       $info = $this->validate($request,[
                'discountcode' => 'required',
                'types' => 'required',
                'countries' => 'required',
                'shippingrate' => 'required',
                'minrequire' => 'required',
                'limitdata' => 'required',
                'startdate' => 'required',
                'enddate' => 'required',
                'seo_title' => 'required',
                'seo_description' => 'required',
            ]);
        $updatediscount = DB::table('tbl_discount')->where(array('id' => $request->hiddenid))->update($info);
        if($updatediscount == 1)
        {
            return redirect('/discount')->with('success_message', 'Discount updated successfully');
        }
        else
        {
            return redirect('/discount')->with('error_message', 'Discount not updated successfully');
        }
    }
    public function discountdelete($id)
    {
        $data = DB::table('tbl_discount')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/discount')->with('success_message', 'Discount deleted successfully');
        }
        else
        {
            return redirect('/discount')->with('error_message', 'Discount not deleted successfully');
        }
    }
    public function customer()
    {
      $countries = DB::table('country')->get();
      $customer = DB::table('tbl_customer')->get();
      return view('customer',['country' => $countries,'customer' => $customer]);
    }
    public function addcustomer(Request $request)
    {
        $info = $this->validate($request,[
                'name' => 'required',
                'email' => 'required',
                'mobile' => 'required',
                'company' => 'required',
                'address' => 'required',
                'apartment' => 'required',
                'city' => 'required',
                'country' => 'required',
                'postalcode' => 'required',
                'notes' => 'required',
                'tags' => 'required',
        ]);
        $data = DB::table('tbl_customer')->insert($info);
            
        if($data == 1)
        {
            return redirect('/customer')->with('success_message', 'Customer added successfully');
        }
        else
        {
            return redirect('/customer')->with('error_message', 'Customer not added successfully');
        }
    }
    public function editcustomer($id)
    {
        $countries = DB::table('country')->get();
        $customer = DB::table('tbl_customer')->get();
        $editdata =  DB::table('tbl_customer')->where(array('id' => $id))->first();
        return view('customer', ['editcustomer' => $editdata,'customer' => $customer,'country' => $countries]);
    }
    public function updatecustomer(Request $request)
    {
        
       $info = array(
            'name' => $request->fname.' '.$request->lname,
            'email' => $request->email,
            'mobile' => $request->pnumber,
            'company' => $request->companyname,
            'address' => $request->companyaddress,
            'apartment' => $request->apartment,
            'city' => $request->city,
            'country' => $request->country,
            'postalcode' => $request->pcode,
            'notes' => $request->note, 
            'tags' => $request->tag,
            
            
            );
        $updatecustomer = DB::table('tbl_customer')->where(array('id' => $request->hiddenid))->update($info);
        if($updatecustomer == 1)
        {
            return redirect('/customer')->with('success_message', 'Customer updated successfully');
        }
        else
        {
            return redirect('/customer')->with('error_message', 'Customer not updated successfully');
        }
    }
    public function customerdelete($id)
    {
        $data = DB::table('tbl_customer')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/customer')->with('success_message', 'Customer deleted successfully');
        }
        else
        {
            return redirect('/customer')->with('error_message', 'Customer not deleted successfully');
        }
    }
    public function plugin()
    {
        $data = DB::table('tbl_plugin')->where('id', 1)->first();
        return view('plugin',['data' => $data]);
    }
    
    public function addplugin()
    {
       
        if(isset($_POST['pos']) == 'on' && isset($_POST['crm']) == 'on')
        {
            $info = array( 'pos' => 1,'crm' => 1);
        }else if(isset($_POST['crm']) == 'on')
        {
            $info = array( 'crm' => 1,'pos' => 0);
        }else if(isset($_POST['pos']) == 'on')
        {
             $info = array( 'pos' => 1,'crm' => 0);
        }else
        {
             $info = array( 'pos' => 0,'crm' => 0);
        }
        $exists =  DB::table('tbl_plugin')->get();
        if(!$exists->isEmpty())
        {
            $update = DB::table('tbl_plugin')->update($info);
        }else
        {
            $update = DB::table('tbl_plugin')->insert($info);
        }
        
       return redirect('/plugin')->with('success_message', 'Plugin setting updated successfully');
    }
    public function setting()
    {
        $data = DB::table('settings')->where('id', 1)->first();
        return view('setting',['data' => $data]);
    }
    public function updatelogo(Request $request)
    {
      
        $path =  public_path('/productimg');
        $file = $request->file('logo');
       
        $file2 = $request->file('logo2');
        // $galleryname = $file->getClientOriginalName();
        // $file->move($path, $galleryname);
        // $galleryname2 = $file2->getClientOriginalName();
        // $file2->move($path, $galleryname2);
        if($request->cashondelivery == '')
        {
            $cod = 0;
        }else
        { $cod = 1;}
        if($file == '' && $file2 == '')
        {
             $info = array(
                  
                    'cashondelivery' => $cod,
                    'deliverycharges' => $request->deliverycharges,
                    'invoiceprefix' => $request->invoiceprefix,
                    'proposalprefix' => $request->proposalprefix
                    
                );
        }else if($file2 == '')
        {
          
            $galleryname = $file->getClientOriginalName();
            
           $file->move($path, $galleryname);
            
             $info = array(
                    'logo'=> $galleryname,
                   
                    'cashondelivery' => $cod,
                    'deliverycharges' => $request->deliverycharges,
                    'invoiceprefix' => $request->invoiceprefix,
                    'proposalprefix' => $request->proposalprefix
                    
                );
        }else if($file == '')
        {
            $galleryname2 = $file2->getClientOriginalName();
            $file2->move($path, $galleryname2);
            $info = array(
                  
                    'logo2'=> $galleryname2,
                    'cashondelivery' => $cod,
                    'deliverycharges' => $request->deliverycharges,
                    'invoiceprefix' => $request->invoiceprefix,
                    'proposalprefix' => $request->proposalprefix
                    
                );
        }else
        { 
            $galleryname = $file->getClientOriginalName();
            $galleryname2 = $file2->getClientOriginalName();
            $file->move($path, $galleryname);
            $file2->move($path, $galleryname2);
            $info = array(
                    'logo'=> $galleryname,
                    'logo2'=> $galleryname2,
                    'cashondelivery' => $cod,
                    'deliverycharges' => $request->deliverycharges,
                    'invoiceprefix' => $request->invoiceprefix,
                    'proposalprefix' => $request->proposalprefix
                    
                );
        }
        
        $exists = DB::table('settings')->get();
        
        if(!$exists->isEmpty())
        {dd($exists);
            $updateproduct = DB::table('settings')->where(array('id'  => 1))->update($info);
            $info2 = array('status'=> 1);
            $updatecurrency = DB::table('currency')->where(array('id'  => $request->currency))->update($info2);
        }else
        {
            $updateproduct = DB::table('settings')->where(array('id'  => 1))->insert($info);
            $info2 = array('status'=> 1);
            $updatecurrency = DB::table('currency')->where(array('id'  => $request->currency))->update($info2);
        }
        
      
         return redirect('/setting')->with('success_message', 'Setting updated successfully');
        
    }
    public function saveattributedata(Request $request)
    {
        $deleteexist = DB::table('tbl_product_attribute')->where('product_id','=',$request->productlastid)->delete();
            foreach($request->attributetype as $key => $attrtype)
            {
                $extratype=array();
                foreach($request->attributeterm as $attributeterm)
                {
                    $termdata = DB::table('attribute_terms')->where(array('id' => $attributeterm))->first();
                    $attributetypearray = array();
                    if($termdata->attributeid == $attrtype)
                    {
                        array_push($extratype,$attributeterm);
                    }
                    
                }
               
                $info = array(
                        'product_id' => $request->productlastid,
                        'attribute_id' => $attrtype,
                        'term_id' => implode(',',$extratype),
                        );
                     
                        $insert = DB::table('tbl_product_attribute')->insert($info);    
               
            }
        
        if($insert == 1)
        {
            // $list = DB::table('tbl_product_attribute')->where('product_id','=', $request->productlastid)->first();
            // $explodeattr = explode(',',$list->attribute_id);
            // $explodeterm = explode(',',$list->term_id);
            
            $attributedatas = DB::table('tbl_product_attribute')->where(array('product_id' => $request->productlastid))->get();
       
        $finalarray = array();
        foreach($attributedatas as $key =>  $attributedata)
        {
            array_push($finalarray,explode(',',$attributedata->term_id));
        }
        $inputdata = array_map("unserialize", array_unique(array_map("serialize", $finalarray)));
      
        $finalattribute =$this->combinations($inputdata);
        
     
            $html = '<div class="row"><div class="col-md-1">Sr No</div><div class="col-md-2">Term</div><div class="col-md-2">Qunatity</div><div class="col-md-2">SKU</div><div class="col-md-2">Price</div><div class="col-md-2">Image</div></div>';
            $i = 1;
            foreach($finalattribute as $finalattributedata)
            {
                $termname = array();
                $termid = array();
                $attrid = array();
                foreach($finalattributedata as $value)
                {
                    $termtype = DB::table('attribute_terms')->where('id','=',$value)->first();
                   
              
            
                   
                    array_push($termname, $termtype->name);
                    array_push($termid, $termtype->id);
                    array_push($attrid,$termtype->attributeid);
                
                }
                
                  $html .= '<input type="hidden" name="attributeidvariation[]" value="'.implode(',',$attrid).'"><input type="hidden" name="termidvariation[]" value="'.implode(',',$termid).'"><div class="row"><div class="col-md-1">'.$i.'</div><div class="col-md-2">'. implode(',',$termname).'</div><div class="col-md-2"><input type="number" name="attributeqty[]" class="form-control"></div><div class="col-md-2"><input type="text" name="attributesku[]" class="form-control"></div><div class="col-md-2"><input type="text" name="attrprice[]" class="form-control"></div><div class="col-md-2"><input type="file"  name="attributefinalimage[]"  class=""></div></div>';
                  $i++;
            }
            if(isset($request->hiddenid))
            {
                $html .= '<input type="hidden" name="totcount" id="totcount" value="'.$i.'"><div class="col-md-2"><button type="button" class="btn btn-gradient-primary mr-2" onclick="savevariationdataedit()">Save</button></div>';
            }else
            {
                $html .= '<input type="hidden" name="totcount" id="totcount" value="'.$i.'">';
            }
            
            echo $html;
            
               
        }
        
    }
    public function updatevarients(Request $request)
    {
       
        $gallaryarray = array();
        if($request->file('editattributeimage') != '')
        {
            $hiddenimage = $request->file('editattributeimage');
           
            foreach($hiddenimage as $attributeimage)
            {
                $path = 'productimg';
        
        
                $file = $attributeimage;
            
                $galleryname = $file->getClientOriginalName();
               
                $destinationPath = public_path('/thumbnail');
                $img = Image::make($file->path());
                $img->resize(200 , 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$galleryname);
           
                $destinationPath = public_path('/productimg');
                $file->move($destinationPath, $galleryname);
            
                // $file->move($path, $galleryname);
                 array_push($gallaryarray,$galleryname);
            }
        }else
        {
             $gallaryarray = $request->hiddeneditattributeimage;
        }
      
        $varientid = $request->hiddenvarientid;
        $qty = $request->editvarientqty;
        $sku = $request->editvarientsku;
        $price = $request->editvarientprice;
        
        foreach($varientid as $key =>  $varientidval)
        {
            $info = array(
                    'attribute_quantity' => $qty[$key],
                    'sku' => $sku[$key],
                    'attrprice' => $price[$key],
                    'attribute_image' => $gallaryarray[$key]
                );
            $update = DB::table('tbl_product_varient')->where('id','=',$varientidval)->update($info);
            
        }
        
        return redirect('product')->with('success_message', 'Product updated successfully'); 
    }
    public function saveattributevariationdata(Request $request)
    {
        if($request->attributeidvariation != '')
        {
            $deleteexist = DB::table('tbl_product_varient')->where('product_id','=',$request->productlastid)->delete();
         $attributevaritaions = $request->attributeidvariation;
         $termvaritaions = $request->termidvariation;
         $attributeqty = $request->attributeqty;
         $attributesku = $request->attributesku;
         $attrprice = $request->attrprice;
        
            $gallaryarray = array();
            foreach($request->file('attributefinalimage') as $attributeimage)
            {
                $path = 'productimg';
        
        
                $file = $attributeimage;
            
                $galleryname = $file->getClientOriginalName();
               
                $destinationPath = public_path('/thumbnail');
                $img = Image::make($file->path());
                $img->resize(200 , 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$galleryname);
           
                $destinationPath = public_path('/productimg');
                $file->move($destinationPath, $galleryname);
            
                // $file->move($path, $galleryname);
                 array_push($gallaryarray,$galleryname);
            }
        
         
         foreach($attributevaritaions as $key =>  $attributevaritaion)
         {
               
              
             $info = array(
                        'product_id' => $request->productlastid,
                        'attribute_id' => $attributevaritaion,
                        'term_id' => $termvaritaions[$key],
                        'attribute_quantity' => $attributeqty[$key],
                       
                        'sku' => $attributesku[$key],
                        'attrprice' => $attrprice[$key],
                        'attribute_image' => $gallaryarray[$key]
                 );
            $insert = DB::table('tbl_product_varient')->insert($info);
         }
        }else
        {
            
        }
      return redirect('product')->with('success_message', 'Product added successfully');  
    }
    public function combinations($arrays, $i = 0) {
    if (!isset($arrays[$i])) {
        return array();
    }
    if ($i == count($arrays) - 1) {
        return $arrays[$i];
    }

    // get combinations from subsequent arrays
    $tmp = $this->combinations($arrays, $i + 1);

    $result = array();

    // concat each array from tmp with each element from $arrays[$i]
    foreach ($arrays[$i] as $v) {
        foreach ($tmp as $t) {
            $result[] = is_array($t) ? 
                array_merge(array($v), $t) :
                array($v, $t);
        }
    }

    return $result;
    }
    public function shipping()
    {
        $countriesdata = DB::table('countries')->get();
        $shipmethod = DB::table('shipping_method')->get();
        $shipzone = DB::table('shipping_zone')->get();
        return view('shipping',['shipmethod' => $shipmethod,'countriesdata' => $countriesdata,'shipzone' => $shipzone]);
    }
    public function addshippingzone(Request $request)
    {
        $info = $this->validate($request,[
                'zone_name' => 'required',
                'zone_region' => 'required',
                'shipping_method' => 'required',
        ]);
        $data = DB::table('shipping_zone')->insert($info);
            
        if($data == 1)
        {
            return redirect('/shipping')->with('success_message', 'Shipping Zone added successfully');
        }
        else
        {
            return redirect('/shipping')->with('error_message', 'Shipping Zone not added successfully');
        }
    }
    public function editshippingzone($id)
    {
        $countriesdata = DB::table('countries')->get();
        $shipmethod = DB::table('shipping_method')->get();
        $shipzone = DB::table('shipping_zone')->get();
        $shipmethod = DB::table('shipping_method')->get();
        $editdata =  DB::table('shipping_zone')->where(array('id' => $id))->first();
        return view('shipping',['shipzone' => $shipzone,'shipmethod' => $shipmethod,'countriesdata' => $countriesdata,'editshippingzone' => $editdata]);
    }
    public function updateshippingzone(Request $request)
    {
        
       $info = $this->validate($request,[
                'zone_name' => 'required',
                'zone_region' => 'required',
                'shipping_method' => 'required',
        ]);
        $updateshippingzone = DB::table('shipping_zone')->where(array('id' => $request->hiddenid))->update($info);
        if($updateshippingzone == 1)
        {
            return redirect('/shipping')->with('success_message', 'Shipping Zone update successfully');
        }
        else
        {
            return redirect('/shipping')->with('error_message', 'Shipping Zone not update successfully');
        }
    }
    public function shippingzonedelete($id)
    {
        $data = DB::table('shipping_zone')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/shipping')->with('success_message', 'Shipping Zone deleted successfully');
        }
        else
        {
            return redirect('/shipping')->with('error_message', 'Shipping Zone not deleted successfully');
        }
    }
    public function shippingmethods()
    {
        $shipzone = DB::table('shipping_zone')->get();
        $shipmethod = DB::table('shipping_method')->get();
        return view('shippingmethods',['shipmethod' => $shipmethod,'shipzone' => $shipzone]);
    }
    public function addshippingmethod(Request $request)
    {
        $info = $this->validate($request,[
                'title' => 'required',
                'tax_status' => 'required',
                'cost' => 'required',
                'description' => 'required',
        ]);
        $data = DB::table('shipping_method')->insert($info);
            
        if($data == 1)
        {
            return redirect('/shippingmethods')->with('success_message', 'Shipping Method added successfully');
        }
        else
        {
            return redirect('/shippingmethods')->with('error_message', 'Shipping Method not added successfully');
        }
    }
    public function editshippingmethod($id)
    {
        $shipmethod = DB::table('shipping_method')->get();
        $editdata =  DB::table('shipping_method')->where(array('id' => $id))->first();
        return view('shippingmethods',['shipmethod' => $shipmethod,'editshippingmethod' => $editdata]);
    }
    public function updateshippingmethod(Request $request)
    {
        $info = $this->validate($request,[
                'title' => 'required',
                'tax_status' => 'required',
                'cost' => 'required',
                'description' => 'required',
        ]);
        $updateshippingmethod = DB::table('shipping_method')->where(array('id' => $request->hiddenid))->update($info);
        if($updateshippingmethod == 1)
        {
            return redirect('/shippingmethods')->with('success_message', 'Shipping Method update successfully');
        }
        else
        {
            return redirect('/shippingmethods')->with('error_message', 'Shipping Method not update successfully');
        }
    }
    public function shippingmethoddelete($id)
    {
        $data = DB::table('shipping_method')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/shippingmethods')->with('success_message', 'Shipping method deleted successfully');
        }
        else
        {
            return redirect('/shippingmethods')->with('error_message', 'Shipping method not deleted successfully');
        }
    }
    public function shippingclass()
    {
        $shipclass= DB::table('shipping_class')->get();
        return view('shippingclass',['shipclass' => $shipclass]);
    }
    public function addshippingclass(Request $request)
    {
         $info = $this->validate($request,[
                'title' => 'required',
                'slug' => 'required',
                'description' => 'required',
        ]);
        $data = DB::table('shipping_class')->insert($info);
            
        if($data == 1)
        {
            return redirect('/shippingclass')->with('success_message', 'Shipping Class added successfully');
        }
        else
        {
            return redirect('/shippingclass')->with('error_message', 'Shipping Class not added successfully');
        }
    }
    public function shippingclassedit($id)
    {
        $shipclass = DB::table('shipping_class')->get();
        $editdata =  DB::table('shipping_class')->where(array('id' => $id))->first();
        return view('shippingclass',['shipclass' => $shipclass,'editshippingclass' => $editdata]);
    }
    public function warehouse()
    {
        $warehouse = DB::table('warehosue')->get();
        return view('warehouse',['warehouse' => $warehouse]);
    }
     public function addwarehouse(Request $request)
    {
         $info = $this->validate($request,[
                'name' => 'required',
                'address' => 'required',
        ]);
        $data = DB::table('warehosue')->insert($info);
            
        if($data == 1)
        {
            return redirect('/warehouse')->with('success_message', 'Warehouse added successfully');
        }
        else
        {
            return redirect('/warehouse')->with('error_message', 'Warehouse not added successfully');
        }
    }
    public function warehouseedit($id)
    {
        $warehouse = DB::table('warehosue')->get();
        $editdata =  DB::table('warehosue')->where(array('id' => $id))->first();
        return view('warehouse',['warehouse' => $warehouse,'editwarehosue' => $editdata]);
    }
    public function updatewarehouse(Request $request)
    {
        $info = $this->validate($request,[
                'name' => 'required',
                'address' => 'required',
        ]);
       $updatewarehouse = DB::table('warehosue')->where(array('id' => $request->hiddenid))->update($info);
        if($updatewarehouse == 1)
        {
            return redirect('/warehouse')->with('success_message', 'Warehouse update successfully');
        }
        else
        {
            return redirect('/warehouse')->with('error_message', 'Warehouse not update successfully');
        }
    }
     public function warehousedelete($id)
    {
        $data = DB::table('warehosue')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/warehouse')->with('success_message', 'Warehouse  deleted successfully');
        }
        else
        {
            return redirect('/warehouse')->with('error_message', 'Warehouse not deleted successfully');
        }
    }
    public function updateshippingclass(Request $request)
    {
        $info = $this->validate($request,[
                'title' => 'required',
                'slug' => 'required',
                'description' => 'required',
        ]);
        $updateshippingclass = DB::table('shipping_class')->where(array('id' => $request->hiddenid))->update($info);
        if($updateshippingclass == 1)
        {
            return redirect('/shippingclass')->with('success_message', 'Shipping Class update successfully');
        }
        else
        {
            return redirect('/shippingclass')->with('error_message', 'Shipping Class not update successfully');
        }
    }
    public function shippingclassdelete($id)
    {
        $data = DB::table('shipping_class')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/shippingclass')->with('success_message', 'Shipping Class deleted successfully');
        }
        else
        {
            return redirect('/shippingclass')->with('error_message', 'Shipping Class not deleted successfully');
        }
    }
    /////////////////////Service category ////////////////////////////
        public function servicecategory()
    {
      $servicecat = DB::table('tbl_service')->get();
     
      return view('servicecategory',['servicecat' => $servicecat]);
    }
    public function addservicecategory(Request $request)
    {

        if($request->pid != '')
        {
            $pid = $request->pid;
        }else
        {
            $pid = 0;
        }
        $info = $this->validate($request,[
                'service_category' => 'required',
        ]);
        $info['pid'] = $pid;
        
       
        $data = DB::table('tbl_service')->insert($info);
       if($pid != 0)
       {
            if($data == 1)
            {
                return redirect('/viewservicecat/'.$pid)->with('success_message', 'Service Category added successfully');
            }
            else
            {
                return redirect('/viewservicecat',[$pid])->with('error_message', 'Service Catgeory not added successfully');
            }
       }
       else
       {
          if($data == 1)
            {
                return redirect('/servicecategory')->with('success_message', 'Service Category added successfully');
            }
            else
            {
                return redirect('/servicecategory')->with('error_message', 'Service Catgeory not added successfully');
            } 
       }
    }
    public function editservicecategory($id)
    {
         $servicecat = DB::table('tbl_service')->get();
        $editdata =  DB::table('tbl_service')->where(array('id' => $id))->first();
        return view('servicecategory',['servicecat' => $servicecat,'editservicecategory' => $editdata]);
    }
    public function updateservicecategory(Request $request)
    {
        
        $info = $this->validate($request,[
                'service_category' => 'required',
        ]);
        $info['pid'] = 0;
        $updateservicecategory = DB::table('tbl_service')->where(array('id' => $request->hiddenid))->update($info);
        if($request->pid != 0)
        {   $pid = $request->pid;
            if($updateservicecategory == 1)
            {
                return redirect('/viewservicecat/'.$pid)->with('success_message', 'Service Sub Catgeory updated successfully');
            }
            else
            {
                return redirect('/viewservicecat/',[$pid])->with('error_message', 'Service Sub Catgeory not updated successfully');
            }
        }else
        {
            if($updateservicecategory == 1)
            {
                return redirect('/servicecategory')->with('success_message', 'Service Category update successfully');
            }
            else
            {
                return redirect('/servicecategory')->with('error_message', 'Service Category not update successfully');
            }
            }
    }
    public function servicecatdelete($id)
    {
        $data = DB::table('tbl_service')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/servicecategory')->with('success_message', 'Service Category deleted successfully');
        }
        else
        {
            return redirect('/servicecategory')->with('error_message', 'Service Category not deleted successfully');
        }
    }
    public function viewservicecat($id)
    {
        $servicecat = DB::table('tbl_service')->get();
        $subcategory = DB::table('tbl_service')->where(array('pid' => $id))->get();
        return view('viewservicecat', ['subcategory' => $subcategory,'pid' => $id,'servicecat' => $servicecat]);
    }
    public function viewserviceedit($id,$pid)
    {
        $subcategory = DB::table('tbl_service')->where(array('pid' => $pid))->get();
        $editdata =  DB::table('tbl_service')->where(array('id' => $id))->first();
        $servicecat = DB::table('tbl_service')->get();
        return view('viewservicecat', ['editservicecategory' => $editdata,'subcategory' => $subcategory,'servicecat' => $servicecat,'pid' => $pid]);
    }
    public function services()
    {
      $staffdata = DB::table('tbl_staff')->get();
      $durationdata = DB::table('duartion')->get();
      $servicecat = DB::table('tbl_service')->get();
      $servicedata = DB::table('services')->get();
      return view('services',['servicecat' => $servicecat,'servicedata' => $servicedata,'durationdata' => $durationdata,'staffdata' => $staffdata]);
    }
    public function addservicedata(Request $request)
    {
        $info = $this->validate($request,[
                'service_category' => 'required',
                'service_name' => 'required',
                'service_date' => 'required',
                'duration' => 'required',
                'staff' => 'required',
                'price' => 'required',
                'description' => 'required',
                'image' => 'required',
        ]);
        $info['staff'] = implode(',',$request->staff);

        $image = $request->file('image');
       
        if($image != '')
        { 
         $new_name = $image->getclientoriginalname();
        $destinationPath = public_path('/contactimg');
        $image->move($destinationPath, $new_name);
        }
        else
        {
            $new_name = '';
        }
        $info['image'] = $new_name;
        
        
        $data = DB::table('services')->insert($info);
       
        if($data == 1)
        {
            return redirect('/services')->with('success_message', 'Service added successfully');
        }
        else
        {
            return redirect('/services')->with('error_message', 'Service not added successfully');
        }
    }
    public function editservicedata($id)
    {
        $staffdata = DB::table('tbl_staff')->get();
        $durationdata = DB::table('duartion')->get();
        $servicecat = DB::table('tbl_service')->get();
         $servicedata = DB::table('services')->get();
        $editdata =  DB::table('services')->where(array('id' => $id))->first();
        return view('services',['servicedata' => $servicedata,'servicecat' => $servicecat,'durationdata' => $durationdata,'staffdata' => $staffdata,'editservicedata' => $editdata]);
    }
    public function updateservicedata(Request $request)
    {
        $info = $this->validate($request,[
                'service_category' => 'required',
                'service_name' => 'required',
                'service_date' => 'required',
                'duration' => 'required',
                'staff' => 'required',
                'price' => 'required',
                'description' => 'required',
                'image' => 'required',
        ]);
        $info['staff'] = implode(',',$request->staff);
        $image = $request->file('image');
       
        if($image != '')
        {
         $new_name = $image->getclientoriginalname();
        $destinationPath = public_path('/contactimg');
        $image->move($destinationPath, $new_name);
        }
        else
        {
            $new_name = '';
        }
        $info['image'] = $new_name;
        $updateservicedata = DB::table('services')->where(array('id' => $request->hiddenid))->update($info);
        if($updateservicedata == 1)
        {
            return redirect('/services')->with('success_message', 'Service  update successfully');
        }
        else
        {
            return redirect('/services')->with('error_message', 'Service  not update successfully');
        }
    }
    public function servicedatadelete($id)
    {
        $data = DB::table('services')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/services')->with('success_message', 'Service  deleted successfully');
        }
        else
        {
            return redirect('/services')->with('error_message', 'Service  not deleted successfully');
        }
    }
    public function staff()
    {
      $staffdata = DB::table('tbl_staff')->get();
      return view('staff',['staffdata' => $staffdata]);
    }
    public function addstaff(Request $request)
    {
        
        $info = $this->validate($request,[
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'visibility' => 'required',
                'image' => 'required',
        ]);
        $image = $request->file('image');
       
        if($image != '')
        {
         $staff_name = $image->getclientoriginalname();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $staff_name);
        }
        else
        {
            $staff_name = '';
        }
        $info['image'] = $staff_name;
        
        $data = DB::table('tbl_staff')->insert($info);
       
        if($data == 1)
        {
            return redirect('/staff')->with('success_message', 'Staff added successfully');
        }
        else
        {
            return redirect('/staff')->with('error_message', 'Staff not added successfully');
        }
    }
    public function editstaff($id)
    {
        $staffdata = DB::table('tbl_staff')->get();
        $editdata =  DB::table('tbl_staff')->where(array('id' => $id))->first();
        return view('staff',['staffdata' => $staffdata,'editstaff' => $editdata]);
    }
    public function updatestaff(Request $request)
    {
        $info = $this->validate($request,[
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'visibility' => 'required',
                'image' => 'required',
        ]);
        $image = $request->file('image');
        if($image != '')
        {   
            $staff_name = $image->getclientoriginalname();
            $uploadimg = $staff_name;
            $destinationPath = public_path('images');
            $image->move($destinationPath, $staff_name);
            
        }else
        {
            $uploadimg = $request->hiddenimage;
        }
        $info['image'] = $uploadimg;
       
        $updatestaff = DB::table('tbl_staff')->where(array('id' => $request->hiddenid))->update($info);
        if($updatestaff == 1)
        {
            return redirect('/staff')->with('success_message', 'Staff  update successfully');
        }
        else
        {
            return redirect('/staff')->with('error_message', 'Staff  not update successfully');
        }
    }
    public function staffdelete($id)
    {
        $data = DB::table('tbl_staff')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/staff')->with('success_message', 'Staff  deleted successfully');
        }
        else
        {
            return redirect('/staff')->with('error_message', 'Staff  not deleted successfully');
        }
    }
    public function duration()
    {
      $durationdata = DB::table('duartion')->get();
      return view('duration',['durationdata' => $durationdata]);
    }
    public function addduration(Request $request)
    {
        
        $info = $this->validate($request,[
                'duartion' => 'required',
        ]);
        $data = DB::table('duartion')->insert($info);
       
        if($data == 1)
        {
            return redirect('/duration')->with('success_message', 'Duration added successfully');
        }
        else
        {   
            return redirect('/duration')->with('error_message', 'Duration not added successfully');
        }
    }
    public function editduration($id)
    {
        $durationdata = DB::table('duartion')->get();
        $editdata =  DB::table('duartion')->where(array('id' => $id))->first();
        return view('duration',['durationdata' => $durationdata,'editduration' => $editdata]);
    }
    public function updateduration(Request $request)
    {
        $info = $this->validate($request,[
                'duartion' => 'required',
        ]);
        $updateduration = DB::table('duartion')->where(array('id' => $request->hiddenid))->update($info);
        if($updateduration == 1)
        {
            return redirect('/duration')->with('success_message', 'Duration  update successfully');
        }
        else
        {
            return redirect('/duration')->with('error_message', 'Duration  not update successfully');
        }
    }
    public function durationdelete($id)
    {
        $data = DB::table('duartion')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/duration')->with('success_message', 'Duration  deleted successfully');
        }
        else
        {
            return redirect('/duration')->with('error_message', 'Duration  not deleted successfully');
        }
    }
    public function test()
    {
        $attributedatas = DB::table('tbl_product_attribute')->where(array('product_id' => '222'))->get();
        echo '<pre>';print_r($attributedatas);
        $finalarray = array();
        foreach($attributedatas as $key =>  $attributedata)
        {
            array_push($finalarray,explode(',',$attributedata->term_id));
        }
        $inputdata = array_map("unserialize", array_unique(array_map("serialize", $finalarray)));
      
        $finalattribute =$this->combinations($inputdata);
  
        foreach($finalattribute as $finalattributedata)
        {
            foreach($finalattributedata as $value)
            {
                $termtype = DB::table('attribute_terms')->where('id','=',$value)->first();
                echo '<pre>';echo $termtype->name;
            }
           echo 'xxx';
        }
          
   
        
    }
    
    public function createproposal(Request $request)
    {
         $info = DB::table('tbl_addnewlead')->where(array('id' => $request->id))->first();
        $leadsource = DB::table('crm_leadsource')->get();
        return view('leadproposal',['listlead' => $info , 'leadsource' =>  $leadsource]);
    }
    public function addleadproposal(Request $request)
    {
        $proposallast = DB::table('lead_proposal')->orderBy('id', 'desc')->first();
        if(!is_null($proposallast))
        {
            $proid = $proposallast->id + 1;
        }else
        {
            $proid = 1;
        }
        
        $setting = DB::table('settings')->first();

         if(!is_null($setting))
        {
             $ref = $setting->proposalprefix.$proid;
        }else
        {
             $ref = 'PO'.$proid;
        }

       
        $info = array(
                        'proposal_ref_id' => $ref,
                        'customer_id' => $request->customerid,
                        'customer_name' =>   $request->customername,
                        'proposal_date' => $request->proposaldate,
                        'duration' => $request->validityduration,
                        'payment_term' => $request->paymentterm,
                        'payment_type' => $request->paymenttype,
                        'source' => $request->leadsource,
                        'delay' => $request->delay,
                        'shipping_method' => $request->shippingmethod,
                        'delivery_date' =>$request->deliverydate,
                        'barcode' =>$request->barcodeproposal,
                        'note' =>$request->noteproposal
                        
                        
                );
               
        $data = DB::table('lead_proposal')->insertGetId($info);
       
        if($data != '')
        {
            return redirect('/proposallist/'.$data.'')->with('success_message', 'Proposal added successfully');
        }
        else
        {
            return redirect('/proposallist/'.$data.'')->with('error_message', 'Proposal Not added ');
        }
        
    }
    public function getproductdeatils(Request $request)
    {   
        if($request->producttype == 1)
        {
            
            $product = DB::table('tbl_product')->where(array('id' => $request->productid))->first();
            $tax = '';
            if($product->tax != '')
            {
                $tax = DB::table('tbl_tax')->where(array('id' => $product->tax))->first();
            }
            
             $taxfinaldata = DB::table('tbl_tax')->get();
            if($tax == '')
            {
                $taxdata = 0;
            }else
            {
                 $taxdata = $tax->total_tax;
            }
            $htmltax = '<label for="exampleInputUsername1">Tax type</label>
                        <select class="form-control" name="taxtype"   disabled="disabled">
                            <option>Select Tax Type</option>
                            <option value="including"';
                            if($product->taxwith == 'including'){
                         $htmltax .='selected';
                            }
                         $htmltax .= '>Including Tax</option>
                             <option value="excluding"';
                             if($product->taxwith == 'excluding'){
                          $htmltax .= 'selected ';
                             }
                         $htmltax .= '>Excluding Tax</option>
                        </select><input type="hidden" id="taxtypedata" value="'.$product->taxwith.'">';
            
                $html = '';
            $htmlfinaltax = '<option>Select Tax </option>';
           
            foreach($taxfinaldata as $taxfinaldataval)
            {
                 $htmlfinaltax =  '<option value="'.$taxfinaldataval->id.'" ';
                 if(isset($tax))
                 {
                    if($tax->id == $taxfinaldataval->id)
                     {
                      $htmlfinaltax .= 'selected';   
                     }
                 }
                  $htmlfinaltax .= '>'.$taxfinaldataval->tax_name.'</option>';
            }
            if($product->sale_price != '')
            {
                $price = $product->sale_price;
            }else
            {
                $price = $product->regular_price;
            }
            $array = array('saleprice' => $price,'tax'=> $taxdata,'taxtype' => $htmltax,'taxfinaltype' =>$htmlfinaltax,'htmldata' => $html);
            echo json_encode($array);
        }else
        {
            $product = DB::table('custom_product')->where(array('id' => $request->productid))->first();
            
        
            $tax = DB::table('tbl_tax')->where(array('id' => $product->tax))->first();
            
            
             $taxfinaldata = DB::table('tbl_tax')->get();
            
            $htmltax = '<label for="exampleInputUsername1">Tax type</label><select class="form-control" name="taxtype"    readonly>
                            <option>Select Tax Type</option>
                            <option value="including"';
                            if($product->taxtype == 'including'){
                         $htmltax .='selected';
                            }
                         $htmltax .= '>Including Tax</option>
                             <option value="excluding"';
                             if($product->taxtype == 'excluding'){
                          $htmltax .= 'selected ';
                             }
                         $htmltax .= '>Excluding Tax</option>
                        </select><input type="hidden" id="taxtypedata" value="'.$product->taxtype.'">';
            $htmlfinaltax = '<option>Select Tax </option>';
            foreach($taxfinaldata as $taxfinaldataval)
            {
                 $htmlfinaltax =  '<option value="'.$taxfinaldataval->id.'" ';
                 if(isset($tax))
                 {
                    if($tax->id == $taxfinaldataval->id)
                    {
                      $htmlfinaltax .= 'selected';   
                    } 
                 }
                 
                  $htmlfinaltax .= '>'.$taxfinaldataval->tax_name.'</option>';
            }
            if($product->height != '')
            {
                $html = '<input type="hidden" id="baseprice" value="'.$product->price.'"><div class="col-md-4"><label>Height</label><input type="text" class="form-control" name="height" id="heightid"  value="'.$product->height.'" onchange="customgetheight(this)"></div>
                        <div class="col-md-4"><label>Width</label><input type="text" class="form-control" name="width" id="widthid"  value="'.$product->width.'" onchange="customgetheight(this)"></div>
                        <div  class="col-md-4"><label>Area</label><input type="text" class="form-control" name="area" id="areaid"  value="'.$product->area.'"></div>';
            }else
            {
                $html = '';
            }
            $total_tax = '';
            if(isset($tax->total_tax))
            {
                $total_tax = $tax->total_tax;
            }
            
            $array = array('saleprice' => $product->total,'tax'=> $total_tax,'taxtype' => $htmltax,'taxfinaltype' =>$htmlfinaltax, 'htmldata' => $html);
            echo json_encode($array);
        }
        
    }
    public function additeminproposal(Request $request)
    {
        $product = DB::table('tbl_product')->where('id',$request->productid)->first();
        if($request->tax != '')
        {
            $tax = $request->tax;
        }else
        {
                if($product->tax != 0)
                {
                    $taxdata = DB::table('tbl_tax')->where('id',$product->tax)->first();
                    $taxfinal =  DB::table('tbl_tax')->where('id',$product->tax)->first();
                    $tax = $taxdata->total_tax;
                }else
                {
                    $tax = 0;
                }
        }
        if($request->taxtype == 'including')
        {
            $taxper = $request->total * ($tax/100);
            $taxfinal = $request->total - $taxper;
            $pricedata = ($request->total / $request->qty) - $taxper;
        }else
        {
             $taxfinal = $request->total;
             $pricedata = $request->total/$request->qty;
        }
         $info = array(
                        'product_type' => $request->producttype,
                        'proposal_id' => $request->proposalid,
                        'price' => $pricedata,
                        'discount' =>   $request->discount,
                        'qty' => $request->qty,
                        'total' => $taxfinal,
                        'totaltax' => $request->totaltax,
                        'taxtype' => $request->taxtype,
                        'tax' => $tax,
                        'product_id' => $request->productid,
                );
        $data = DB::table('proposal_item')->insert($info);
       
        if($data == 1)
        {
            return redirect('/proposallist/'.$request->proposalid.'')->with('success_message', 'Proposal Item added successfully');
        }
        else
        {
            return redirect('/proposallist/'.$request->proposalid.'')->with('error_message', 'Proposal Item Not added ');
        }
    }
     public function edititem(Request $request,$id)
    {
        $proposallistdata = DB::table('lead_proposal')->where(array('id' => $request->id))->first();
       $proposallistdatanew = DB::table('lead_proposal')->where(array('proposal_ref_id' => $request->id))->first();
       
       
       if($proposallistdatanew != '')
       {
           $proposallistdatanewfinal = $proposallistdatanew;
           $proposallist = DB::table('proposal_item')->where(array('proposal_id' => $request->id))->get();
            $proposallistnew = DB::table('proposal_item')->where(array('proposal_id' => $proposallistdatanew->proposal_ref_id))->get();
            if(empty($proposallist))
            {
                $proposallistfinal = $proposallist;
            }else
            {
                $proposallistfinal = $proposallistnew;
            }
       }else
       {
           $proposallistdatanewfinal = $proposallistdata;
           $proposallist = DB::table('proposal_item')->where(array('proposal_id' => $request->id))->get();
            $proposallistnew = DB::table('proposal_item')->where(array('proposal_id' => $proposallistdata->proposal_ref_id))->get();
            
             if(empty($proposallist))
            {
                $proposallistfinal = $proposallist;
            }else
            {
                $proposallistfinal = $proposallistnew;
            }
       }
      $product = DB::table('tbl_product')->get();
      $custom_product = DB::table('custom_product')->get();
      $proposalitem = DB::table('proposal_item')->get();
      $editdata =  DB::table('proposal_item')->where(array('id' => $id))->first();
      return view('proposallistitem', ['edititem' => $editdata,'proposallistdata' => $proposallistdatanewfinal,'proposallist' => $proposallistfinal,'product' => $product,'custom_product' => $custom_product,'proposalitem' => $proposalitem]);
    }
    public function proposalitemedit(Request $request)
    {
        $data = DB::table('proposal_item')->where('id','=',$request->id)->first();
        // $proposallistdata = DB::table('lead_proposal')->where(array('id' => $request->id))->first();
       $proposallistdatanew = DB::table('lead_proposal')->where(array('proposal_ref_id' => $data->proposal_id))->first();
      
       
       if($proposallistdatanew != '')
       {
           $proposallistdatanewfinal = $proposallistdatanew;
           $proposallist = DB::table('proposal_item')->where(array('proposal_id' => $data->proposal_id))->get();
            $proposallistnew = DB::table('proposal_item')->where(array('proposal_id' => $proposallistdatanew->proposal_ref_id))->get();
            if(empty($proposallist))
            {
                $proposallistfinal = $proposallist;
            }else
            {
                $proposallistfinal = $proposallistnew;
            }
       }else
       {
           $proposallistdatanewfinal = $proposallistdata;
           $proposallist = DB::table('proposal_item')->where(array('proposal_id' => $request->id))->get();
            $proposallistnew = DB::table('proposal_item')->where(array('proposal_id' => $proposallistdata->proposal_ref_id))->get();
            
             if(empty($proposallist))
            {
                $proposallistfinal = $proposallist;
            }else
            {
                $proposallistfinal = $proposallistnew;
            }
       }
   
        $product = DB::table('tbl_product')->get();
        return view('proposallistitem',['proposallist' => $proposallistfinal,'product' => $product,'proposallistdata' => $proposallistdatanewfinal ,'edititem' => $data]);
        
    }
    public function updateitem(Request $request)
    {
        
         $info = array(
                        'proposal_id' => $request->proposalid,
                        'price' => $request->price,
                        'discount' =>   $request->discount,
                        'qty' => $request->qty,
                        'total' => $request->total,
                        'totaltax' => $request->totaltax,
                        'taxtype' => $request->taxtype,
                        'tax' => $request->tax,
                        'product_id' => $request->productid,
                );
        $data = DB::table('proposal_item')->where('id','=',$request->hiddenid)->update($info);
       
      
       
            return redirect('/proposallist/'.$request->proposalid.'')->with('success_message', 'Proposal Item updated successfully');
        
    }
    public function custcategory()
    {
        $data = DB::table('custcategory')->get();
        return view('custcategory',['data' => $data]);
    }
    public function addcustcategory(Request $request)
    {
        $data = array('category' => $request->custcategory);
        $insert = DB::table('custcategory')->insert($data);
        if($insert == 1)
        {
            return redirect('/custcategory/')->with('success_message', 'Cust category added successfully');
        }
    }
    public function custcategorydelete(Request $request)
    {
         $data = DB::table('custcategory')->where(array('id' => $request->id))->delete();
         if($data == 1)
        {
            return redirect('/custcategory/')->with('success_message', 'Cust category deleted successfully');
        }
        else
        {
            return redirect('/custcategory/')->with('error_message', 'Cust category not deleted successfully');
        }
    }
    public function proposalitemdelete(Request $request)
    {
        $itemdata = DB::table('proposal_item')->where(array('id' => $request->id))->first();
        $data = DB::table('proposal_item')->where(array('id' => $request->id))->delete();
        if($data == 1)
        {
            return redirect('/proposallist/'.$itemdata->proposal_id.'')->with('success_message', 'Proposal Item deleted successfully');
        }
        else
        {
            return redirect('/proposallist/'.$itemdata->proposal_id.'')->with('error_message', 'Proposal Item not deleted successfully');
        }
    }
    public function createPDF(Request $request) {
      // retreive all records from db
      $proposallist=  DB::table('lead_proposal')->where(array('id' => $request->id))->first();
//         $info = DB::table('tbl_addnewlead')->where(array('id' => $proposallist->customer))->first();
      
// 		$proposalitem =  DB::table('proposal_item')->where(array('proposal_id' => $request->id))->get();
    	
      $data['proposallist'] =  DB::table('lead_proposal')->where(array('id' => $request->id))->first();
      $data['info'] = DB::table('tbl_addnewlead')->where(array('id' => $proposallist->customer_id))->first();
		$data['proposalitem'] = DB::table('proposal_item')->where(array('proposal_id' => $proposallist->proposal_ref_id))->get();
		
      // share data to view
      view()->share('proposalview',$data);
      $pdf = PDF::loadView('proposalview', $data);

      // download PDF file with download method
      return $pdf->download('pdf_file.pdf');
    }
    public function samplepdfview(Request $request)
    {
        $info = DB::table('tbl_addnewlead')->where(array('id' => 6))->first();
      $proposallist =  DB::table('lead_proposal')->where(array('id' => 1))->first();
		$proposalitem =  DB::table('proposal_item')->where(array('proposal_id' => 1))->get();
		return view('proposalview',['info' => $info,'proposallist' => $proposallist,'proposalitem' => $proposalitem]);
    }
    public function proposalstatusupdate(Request $request)
    {
        $info = array(
                    'proposal_status' => 'accepted',
                );
        $update = DB::table('lead_proposal')->where('id','=',$request->id)->update($info);
        $data = DB::table('lead_proposal')->where('id','=',$request->id)->first();
        
        return redirect('/leadeview/'.$data->customer_id.'')->with('success_message', 'Proposal Accepted  Successfully');
    }
    public function addleads()
    {
        $categories = DB::table('custcategory')->get();
        $countriesdata = DB::table('countries')->get();
        $leadsource = DB::table('crm_leadsource')->get();
        $industry = DB::table('crm_leadindustry')->get();
        $leadstatus = DB::table('crm_leadstatus')->get();
      $customer = DB::table('tbl_customer')->get();
      $leaddata = DB::table('tbl_addnewlead')->get();
      $salesuser = DB::table('tbl_salesgroup')->get();
      $access_users = DB::table('access_users')->get();
       $crm_campaign = DB::table('crm_campaign')->get();
      
      
      return view('addleads',['crm_campaign' => $crm_campaign,'countriesdata' => $countriesdata,'customer' => $customer,'leaddata' => $leaddata,'leadsource' => $leadsource,'industry' => $industry,'leadstatus' => $leadstatus,'categories' => $categories,'salesuser' => $salesuser,'access_users' => $access_users]);
    }
    public function supplier(Request $request)
    {
        $suppliers = DB::table('suppliers')->get();
        return view('supplierlist',['suppliers' => $suppliers]);
    }
    public function supplierdelete($id)
    {
        $delete = DB::table('suppliers')->where(['id' => $id])->delete();
        if($delete == 1)
        {
             return redirect('/supplier')->with('success_message', 'Supplier deleted successfully');
        }else
        {
             return redirect('/supplier')->with('success_message', 'Supplier not  deleted ');
        }
    }
    public function addnewleads(Request $request)
    {
        
        $path = 'productimg';
        $galleryname = '';
        if($request->file('imgleads') != '')
        {
             $file = $request->file('imgleads');
            $galleryname = $file->getClientOriginalName();
            $file->move($path, $galleryname);
        }
       
        if($request->saleuserleads != '')
        {
            $salesuser = $request->saleuserleads;
        }else
        {
            $salesuser = 0;
        }
        if($request->supplier == 'Yes')
        {
                 $info = array(
                'leadname' => $request->leadnamedata,
                'aliasname' => $request->aliasname,
                'prospect_customer'   => $request->customerprospect,
                'status'   => $request->statusleads,
                'barcode' => $request->barcodeleads,
                'address' => $request->addressleads,
                'zipcode'   => $request->zipcodeleads,
                'city'   => $request->cityleads,
                'country'   => $request->countryleads,
                'email' => $request->emailleads,
                'web' => $request->webleads,
                'countrycode' => $request->countrycode,
                'phone'   => $request->phoneleads,
                'fax'   => $request->faxleads,
                'salteax'   => $request->saletaxleads,
                'vatid'   => $request->vatidleads,
                'thirdparty'   => $request->typeleads,
                'employees'   => $request->employeeleads,
                'categories'   => $request->categoriesleads,
                'vendorstags'   => $request->vendorleads,
                'salesgroup'   => $salesuser,
                'salesuser'   => $request->saleuserleads,
                'image'   => $galleryname,
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
                'accountstatus' => 'activated',
                'created_by' => session('user_id'),
                'created_by_type' => session('user_type'),
                'campaign' => $request->campaign
                
                
            );
            
            $data = DB::table('suppliers')->insertGetId($info);
          
            if($data != '')
            {
                return redirect('/supplier')->with('success_message', 'Supplier added successfully');
            }
            else
            {
                return redirect('/supplier')->with('error_message', 'Supplier not added successfully');
            }
        }else
        {
                $info = array(
                'leadname' => $request->leadnamedata,
                'aliasname' => $request->aliasname,
                'prospect_customer'   => $request->customerprospect,
                'vendor'   => $request->supplier,
                'status'   => $request->statusleads,
                'barcode' => $request->barcodeleads,
                'address' => $request->addressleads,
                'zipcode'   => $request->zipcodeleads,
                'city'   => $request->cityleads,
                'country'   => $request->countryleads,
                'email' => $request->emailleads,
                'web' => $request->webleads,
                'countrycode' => $request->countrycode,
                'phone'   => $request->phoneleads,
                'fax'   => $request->faxleads,
                'salteax'   => $request->saletaxleads,
                'vatid'   => $request->vatidleads,
                'thirdparty'   => $request->typeleads,
                'employees'   => $request->employeeleads,
                'categories'   => $request->categoriesleads,
                'vendorstags'   => $request->vendorleads,
                'salesgroup'   => $salesuser,
                'salesuser'   => $request->saleuserleads,
                'image'   => $galleryname,
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
                'accountstatus' => 'activated',
                'created_by' => session('user_id'),
                'created_by_type' => session('user_type'),
                'campaign' => $request->campaign
                
                
            );
            
            $data = DB::table('tbl_addnewlead')->insertGetId($info);
          
            if($data != '')
            {
                return redirect('/leadeview/'.$data)->with('success_message', 'Lead added successfully');
            }
            else
            {
                return redirect('/leadeview'.$data)->with('error_message', 'Lead not added successfully');
            }
        }
        
    }
    
    public function editlead(Request $request,$id)
    {
        $categories = DB::table('custcategory')->get();
        $countriesdata = DB::table('countries')->get();
        $leadsource = DB::table('crm_leadsource')->get();
        $industry = DB::table('crm_leadindustry')->get();
        $leadstatus = DB::table('crm_leadstatus')->get();
      $customer = DB::table('tbl_customer')->get();
      $leaddata = DB::table('crm_leads')->get();
      $salesuser = DB::table('tbl_salesgroup')->get();
      $access_users = DB::table('access_users')->get();
       $crm_campaign = DB::table('crm_campaign')->get();
       
       $leadnewdata = DB::table('tbl_addnewlead')->get();
        $editdata =  DB::table('tbl_addnewlead')->where(array('id' => $id))->first();
        return view('addleads',['leadnewdata' => $leadnewdata,'editlead' => $editdata,'crm_campaign' => $crm_campaign,'countriesdata' => $countriesdata,'customer' => $customer,'leaddata' => $leaddata,'leadsource' => $leadsource,'industry' => $industry,'leadstatus' => $leadstatus,'categories' => $categories,'salesuser' => $salesuser,'access_users' => $access_users]);
    }
    public function updatedatalead(Request $request)
    {
        $path = 'productimg';
        $galleryname = '';
        if($request->file('imgleads') != '')
        {
             $file = $request->file('imgleads');
            $galleryname = $file->getClientOriginalName();
            $file->move($path, $galleryname);
        }
       
        if($request->saleuserleads != '')
        {
            $salesuser = $request->saleuserleads;
        }else
        {
            $salesuser = 0;
        }
        $info = array(
            'leadname' => $request->leadnamedata,
            'aliasname' => $request->aliasname,
            'prospect_customer'   => $request->customerprospect,
            'vendor'   => $request->vendorleads,
            'status'   => $request->statusleads,
            'barcode' => $request->barcodeleads,
            'address' => $request->addressleads,
            'zipcode'   => $request->zipcodeleads,
            'city'   => $request->cityleads,
            'country'   => $request->countryleads,
            'email' => $request->emailleads,
            'web' => $request->webleads,
            'countrycode' => $request->countrycode,
            'phone'   => $request->phoneleads,
            'fax'   => $request->faxleads,
            'salteax'   => $request->saletaxleads,
            'vatid'   => $request->vatidleads,
            'thirdparty'   => $request->typeleads,
            'employees'   => $request->employeeleads,
            'categories'   => $request->categoriesleads,
            'vendorstags'   => $request->vendorleads,
            'salesgroup'   => $salesuser,
            'salesuser'   => $request->saleuserleads,
            'image'   => $galleryname,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
            'accountstatus' => 'activated',
            'created_by' => session('user_id'),
            'created_by_type' => session('user_type'),
            'campaign' => $request->campaign
            
            
        );
        $updatedatalead = DB::table('tbl_addnewlead')->where(array('id' => $request->hiddenid))->update($info);
        if($updatedatalead == 1)
        {
            return redirect('addleads')->with('success_message', 'Lead  updated successfully');
            
        }else
        {
             return redirect('addleads')->with('success_message', 'Lead  Not updated successfully');
        }
    }
     public function leaddatadelete($id)
    {
        $data = DB::table('tbl_addnewlead')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('listleads')->with('success_message', 'Lead  deleted successfully');
        }
        else
        {
            return redirect('listleads')->with('error_message', 'Lead  not deleted successfully');
        }
    }
    public function listleads()
    {   
        if(session('user_type') == 'admin')
        {
            $addleads = DB::table('tbl_addnewlead')->orderby('id','DESC')->get();
        }else
        {
            $addleads = DB::table('tbl_addnewlead')->where(['created_by' => session('user_id'),'created_by_type' => session('user_type')])->orderby('id','DESC')->get();
        }
        
        return view('listleads',['addleads' => $addleads]);
    }
    public function leadeview(Request $request)
    {
        $info = DB::table('tbl_addnewlead')->where(array('id' => $request->id))->first();
        $proposallist = DB::table('lead_proposal')->where(array('customer_id' => $request->id))->orderBy('id','desc')->get();
        $country = DB::table('countries')->where(array('id' => $info->country))->first();
        $notes =DB::table('leadnotes')->where('lead_id','=',$request->id)->get();
        $saleuser= DB::table('tbl_salesuser')->where(array('id' => $info->salesuser))->first();
        if($saleuser != '')
        {
            $saleusername = $saleuser->user_name;
        }else
        {
            $saleusername = '';
        }
         
        $product = DB::table('tbl_product')->get();
        $eventlist = DB::table('tbl_events')->where('lead_id','=',$request->id)->get();
        return view('leadeview',['listlead' => $info ,'country' => $country ,'saleuser' => $saleusername,'proposallist' => $proposallist,'proposallistnew' => $proposallist,'product' => $product,'eventlist' => $eventlist,'notes' => $notes]);
    }
    public function editnotes($leadid, $id)
    {
        $info = DB::table('tbl_addnewlead')->where(array('id' => $leadid))->first();
        $proposallist = DB::table('lead_proposal')->where(array('customer_id' => $leadid))->orderBy('id','desc')->get();
        $country = DB::table('countries')->where(array('id' => $info->country))->first();
        $notes =DB::table('leadnotes')->where('lead_id','=',$leadid)->get();
        $saleuser= DB::table('tbl_salesuser')->where(array('id' => $info->salesuser))->first();
        if($saleuser != '')
        {
            $saleusername = $saleuser->user_name;
        }else
        {
            $saleusername = '';
        }
         
        $product = DB::table('tbl_product')->get();
        $eventlist = DB::table('tbl_events')->where('lead_id','=',$leadid)->get();
        $editdata =  DB::table('leadnotes')->where(array('id' => $id))->first();
        return view('leadeview',['editdata' => $editdata,'listlead' => $info ,'country' => $country ,'saleuser' => $saleusername,'proposallist' => $proposallist,'proposallistnew' => $proposallist,'product' => $product,'eventlist' => $eventlist,'notes' => $notes]);
    }
    public function updatenotes(Request $request)
    {
        $info = array(
                    'type' => $request->typenote,
                    'notes' => $request->notes,
                    'lead_id' => $request->hiddenleadid
                );
        $updatenotes = DB::table('leadnotes')->where(array('id' => $request->hiddenid))->update($info);
        if($updatenotes == 1)
        {
            return redirect('/leadeview/'.$request->hiddenleadid.'')->with('success_message', 'Lead Notes updated successfully');
            
        }else
        {
             return redirect('/leadeview/'.$request->hiddenleadid.'')->with('success_message', 'Lead Notes Not updated successfully');
        }
    }
    public function deletenote($id)
    {
        $deletenote = DB::table('leadnotes')->where('id','=',$id)->delete();
        if($deletenote == 1)
        {
            return redirect()->back()->with('success_message', 'Notes deleted successfully');
        }
    }
    public function deleteevent(Request $request)
    {
         $eventlist = DB::table('tbl_events')->where('id','=',$request->id)->delete();
          return redirect()->back()->with('success_message', 'Event deleted successfully');
    }
    public function leadstatus()
    {
      $leadstatus = DB::table('crm_leadstatus')->get();
      return view('leadstatus',['leadstatus' => $leadstatus]);
      
    }
    public function addleadstatus(Request $request)
    {
        $info = $this->validate($request,[
                'lead_status' => 'required',
        ]);
        $data = DB::table('crm_leadstatus')->insert($info);
       
        if($data == 1)
        {
            return redirect('/leadstatus')->with('success_message', 'Lead Status added successfully');
        }
        else
        {
            return redirect('/leadstatus')->with('error_message', 'Lead Status not added successfully');
        }
    }
    public function editleadstatus($id)
    {
        $leadstatus = DB::table('crm_leadstatus')->get();
        $editdata =  DB::table('crm_leadstatus')->where(array('id' => $id))->first();
        return view('leadstatus',['leadstatus' => $leadstatus,'editleadstatus' => $editdata]);
    }
    public function updateleadstatus(Request $request)
    {
       $info = $this->validate($request,[
                'lead_status' => 'required',
        ]);
        $updateleadstatus = DB::table('crm_leadstatus')->where(array('id' => $request->hiddenid))->update($info);
        if($updateleadstatus == 1)
        {
            return redirect('/leadstatus')->with('success_message', 'Lead Status update successfully');
        }
        else
        {
            return redirect('/leadstatus')->with('error_message', 'Lead Status not update successfully');
        }
    }
    public function leadstatusdelete($id)
    {
        $data = DB::table('crm_leadstatus')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/leadstatus')->with('success_message', 'Lead Status deleted successfully');
        }
        else
        {
            return redirect('/leadstatus')->with('error_message', 'Lead Status not deleted successfully');
        }
    }
    public function leadsource()
    {
      $leadsource = DB::table('crm_leadsource')->get();
      return view('leadsource',['leadsource' => $leadsource]);
    }
    public function addleadsource(Request $request)
    {
        $info = $this->validate($request,[
                'lead_source' => 'required',
        ]);
        $data = DB::table('crm_leadsource')->insert($info);
       
        if($data == 1)
        {
            return redirect('/leadsource')->with('success_message', 'Lead Source added successfully');
        }
        else
        {
            return redirect('/leadsource')->with('error_message', 'Lead Source not added successfully');
        }
    }
    public function editleadsource($id)
    {
        $leadsource = DB::table('crm_leadsource')->get();
        $editdata =  DB::table('crm_leadsource')->where(array('id' => $id))->first();
        return view('leadsource',['leadsource' => $leadsource,'editleadsource' => $editdata]);
    }
    public function updateleadsource(Request $request)
    {
        $info = $this->validate($request,[
                'lead_source' => 'required',
        ]);
        $updateleadsource = DB::table('crm_leadsource')->where(array('id' => $request->hiddenid))->update($info);
        if($updateleadsource == 1)
        {
            return redirect('/leadsource')->with('success_message', 'Lead Source update successfully');
        }
        else
        {
            return redirect('/leadsource')->with('error_message', 'Lead Source not update successfully');
        }
    }
    public function leadsourcedelete($id)
    {
        $data = DB::table('crm_leadsource')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/leadsource')->with('success_message', 'Lead Source deleted successfully');
        }
        else
        {
            return redirect('/leadsource')->with('error_message', 'Lead Source not deleted successfully');
        }
    }
    public function industry()
    {
      $industry = DB::table('crm_leadindustry')->get();
      return view('industry',['industry' => $industry]);
    }
    public function addindustry(Request $request)
    {
        $info = $this->validate($request,[
                'lead_industry' => 'required',
        ]);
        $data = DB::table('crm_leadindustry')->insert($info);
       
        if($data == 1)
        {
            return redirect('/industry')->with('success_message', 'Lead Industry added successfully');
        }
        else
        {
            return redirect('/industry')->with('error_message', 'Lead Industry not added successfully');
        }
    }
    public function editindustry($id)
    {
         $industry = DB::table('crm_leadindustry')->get();
        $editdata =  DB::table('crm_leadindustry')->where(array('id' => $id))->first();
        return view('industry',['industry' => $industry,'editindustry' => $editdata]);
    }
    public function updateindustry(Request $request)
    {
        $info = $this->validate($request,[
                'lead_industry' => 'required',
        ]);
        $updateindustry = DB::table('crm_leadindustry')->where(array('id' => $request->hiddenid))->update($info);
        if($updateindustry == 1)
        {
            return redirect('/industry')->with('success_message', 'Lead Industry update successfully');
        }
        else
        {
            return redirect('/industry')->with('error_message', 'Lead Industry not update successfully');
        }
    }
    public function industrydelete($id)
    {
        $data = DB::table('crm_leadindustry')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/industry')->with('success_message', 'Lead Industry deleted successfully');
        }
        else
        {
            return redirect('/industry')->with('error_message', 'Lead Industry not deleted successfully');
        }
    }
    public function salesgroup()
    {
        $salesuser = DB::table('tbl_salesuser')->get();
      $salesgroup = DB::table('tbl_salesgroup')->get();
      return view('salesgroup',['salesgroup' => $salesgroup,'$salesuser' => $salesuser]);
    }
    public function addgroupname(Request $request)
    {
        $info = $this->validate($request,[
                'group_name' => 'required',
        ]);
        $data = DB::table('tbl_salesgroup')->insert($info);
       
        if($data == 1)
        {
            return redirect('/salesgroup')->with('success_message', 'Group Name added successfully');
        }
        else
        {
            return redirect('/salesgroup')->with('error_message', 'Group Name not added successfully');
        }
    }
    public function editgroupname($id)
    {
         $salesgroup = DB::table('tbl_salesgroup')->get();
        $editdata =  DB::table('tbl_salesgroup')->where(array('id' => $id))->first();
        return view('salesgroup',['salesgroup' => $salesgroup,'editgroupname' => $editdata]);
    }
    public function updategroupname(Request $request)
    {
       $info = $this->validate($request,[
                'group_name' => 'required',
        ]);
        $updategroupname = DB::table('tbl_salesgroup')->where(array('id' => $request->hiddenid))->update($info);
        if($updategroupname == 1)
        {
            return redirect('/salesgroup')->with('success_message', 'Group Name update successfully');
        }
        else
        {
            return redirect('/salesgroup')->with('error_message', 'Group Name not update successfully');
        }
    }
    public function groupnamedelete($id)
    {
        $data = DB::table('tbl_salesgroup')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/salesgroup')->with('success_message', 'Group Name deleted successfully');
        }
        else
        {
            return redirect('/salesgroup')->with('error_message', 'Group Name not deleted successfully');
        }
    }
    public function salesuser()
    {
        $salesgroup = DB::table('tbl_salesgroup')->get();
      $salesuser = DB::table('tbl_salesuser')->get();
      $access_users = DB::table('access_users')->get();
      return view('salesuser',['salesuser' => $salesuser,'salesgroup' => $salesgroup,'access_users' => $access_users]);
    }
    public function addsaleuser(Request $request)
    {
        foreach($request->useraccess as $access_user)
        {
            
        
        $info = array(
            'grp_name'   => $request->grpname,
            'access_user' => $access_user,
            'user_name'  => $request->salename,
            'user_email'  => $request->saleemail,
            'user_mobile'  => $request->salephone
            );
        $data = DB::table('tbl_salesuser')->insert($info);
        }
        if($data == 1)
        {
            return redirect('/salesuser')->with('success_message', 'Sales User added successfully');
        }
        else
        {
            return redirect('/salesuser')->with('error_message', 'Sales User not added successfully');
        }
    }
    public function editsaleuser($id)
    {
         $salesgroup = DB::table('tbl_salesgroup')->get();
         $salesuser = DB::table('tbl_salesuser')->get();
         $access_users = DB::table('access_users')->get();
        $editdata =  DB::table('tbl_salesuser')->where(array('id' => $id))->first();
        return view('salesuser',['salesgroup' => $salesgroup,'salesuser' => $salesuser,'access_users' => $access_users,'editsaleuser' => $editdata]);
    }
    public function updatesaleuser(Request $request)
    {
        $info = array(
            'grp_name'   => $request->grpname,
            'access_user' => $request->useraccess,
            'user_name'  => $request->salename,
            'user_email'  => $request->saleemail,
            'user_mobile'  => $request->salephone
            );
        $updatesaleuser = DB::table('tbl_salesuser')->where(array('id' => $request->hiddenid))->update($info);
        if($updatesaleuser == 1)
        {
            return redirect('/salesuser')->with('success_message', 'Sales User update successfully');
        }
        else
        {
            return redirect('/salesuser')->with('error_message', 'Sales User not update successfully');
        }
    }
    public function saleuserdelete($id)
    {
        $data = DB::table('tbl_salesuser')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/salesuser')->with('success_message', 'Sales User deleted successfully');
        }
        else
        {
            return redirect('/salesuser')->with('error_message', 'Sales User not deleted successfully');
        }
    }
    public function crminvoice(Request $request)
    {
        
        $invoproposal = DB::table('lead_proposal')->where(array('id' => $request->id))->first();
         $info = DB::table('tbl_addnewlead')->where(array('id' => $request->id))->first();
         $crminvoice = DB::table('tbl_crminvoice')->get();
        return view('crminvoice',['listlead' => $info,'$crminvoice' => $crminvoice,'invoproposal' => $invoproposal]);
    }
    public function leadnotes(Request $request)
    {
        $info = array(
                    'type' => $request->typenote,
                    'notes' => $request->notes,
                    'lead_id' => $request->hiddenleadid
                );
        $data = DB::table('leadnotes')->insert($info);
        if($data == 1)
        {
             return redirect('/leadeview/'.$request->hiddenleadid.'')->with('success_message', 'Lead Notes added successfully');
            
        }else
        {
             return redirect('/leadeview/'.$request->hiddenleadid.'')->with('success_message', 'Lead Notes Not Added ');
        }
    }
    public function addcreateinvoice(Request $request)
    {
        $invoicelast = DB::table('tbl_crminvoice')->orderBy('id', 'desc')->first();
        $invoicelastid = $invoicelast->id + 1;
        $setting = DB::table('settings')->first();
        $ref = $setting->invoiceprefix.$invoicelastid;
        $info = array(
            'propoaslrefid' =>   $request->proposalid,
            'invoice_ref' => $ref,
            'customername' =>   $request->customername,
            'type' =>   $request->aliasname,
            'invoicedate' =>   $request->invoicedate,
            'paymentterms' =>   $request->paymentterm,
            'paymenttype' =>   $request->paymenttype,
            'note_public' =>   $request->notepublic,
            'note_private' =>   $request->noteprivate,
            'barcode' => $request->barcodeinvoice,
            );
        $data = DB::table('tbl_crminvoice')->insert($info);
       
        if($data == 1)
        {
             return redirect('/leadeview/'.$request->customeridnew.'')->with('success_message', 'Invoice added successfully');
            
        }
        else
        {
            return redirect('/leadeview/'.$request->customeridnew.'')->with('error_message', 'Invoice not added successfully');
           
        }
    }
    public function invoicePDF(Request $request)
    {
      // retreive all records from db
      $invoicelist=  DB::table('tbl_crminvoice')->where(array('id' => $request->id))->first();
      $proposallist=  DB::table('lead_proposal')->where(array('id' => $request->id))->first();

    	
      $data['invoicelist'] =  DB::table('tbl_crminvoice')->where(array('id' => $request->id))->first();
      $data['info'] = DB::table('tbl_addnewlead')->where(array('id' => $proposallist->customer_id))->first();

			$data['proposalitem'] = DB::table('proposal_item')->where(array('proposal_id' => $proposallist->proposal_ref_id))->get();
      // share data to view
      view()->share('invoicecreatepdf',$data);
      $pdf = PDF::loadView('invoicecreatepdf', $data);

      // download PDF file with download method
      return $pdf->download('invoice_file.pdf');
    }
    public function invoicepdfview(Request $request)
    {
        $info = DB::table('tbl_addnewlead')->where(array('id' => 6))->first();
      $invoicelist =  DB::table('tbl_crminvoice')->where(array('id' => 1))->first();
		$proposalitem =  DB::table('proposal_item')->where(array('proposal_id' => 1))->get();
		$crminvoice = DB::table('tbl_crminvoice')->get();
		return view('invoicecreatepdf',['info' => $info,'invoicelist' => $invoicelist,'proposalitem' => $proposalitem,'crminvoice' => $crminvoice]);
    }
    public function proposallist(Request $request)
    {
       
        
        $proposallistdata = DB::table('lead_proposal')->where(array('id' => $request->id))->first();
       $proposallistdatanew = DB::table('lead_proposal')->where(array('proposal_ref_id' => $request->id))->first();
       
       
       if($proposallistdatanew != '')
       {
           $proposallistdatanewfinal = $proposallistdatanew;
           $proposallist = DB::table('proposal_item')->where(array('proposal_id' => $request->id))->get();
            $proposallistnew = DB::table('proposal_item')->where(array('proposal_id' => $proposallistdatanew->proposal_ref_id))->get();
            if(empty($proposallist))
            {
                $proposallistfinal = $proposallist;
            }else
            {
                $proposallistfinal = $proposallistnew;
            }
       }else
       {
           $proposallistdatanewfinal = $proposallistdata;
           $proposallist = DB::table('proposal_item')->where(array('proposal_id' => $request->id))->get();
            $proposallistnew = DB::table('proposal_item')->where(array('proposal_id' => $proposallistdata->proposal_ref_id))->get();
            
             if(empty($proposallist))
            {
                $proposallistfinal = $proposallist;
            }else
            {
                $proposallistfinal = $proposallistnew;
            }
       }
   
        $product = DB::table('tbl_product')->get();
        $custom_product = DB::table('custom_product')->get();
        return view('proposallistitem',['proposallist' => $proposallistfinal,'product' => $product,'proposallistdata' => $proposallistdatanewfinal ,'customproduct' => $custom_product,'proposalid' =>  $request->id]);
         
    }
    public function editcustomproduct(Request $request)
    {   
        $proposallistdata = DB::table('lead_proposal')->where(array('id' => $request->id))->first();
       $proposallistdatanew = DB::table('lead_proposal')->where(array('proposal_ref_id' => $request->id))->first();
       
       
       if($proposallistdatanew != '')
       {
           $proposallistdatanewfinal = $proposallistdatanew;
           $proposallist = DB::table('proposal_item')->where(array('proposal_id' => $request->id))->get();
            $proposallistnew = DB::table('proposal_item')->where(array('proposal_id' => $proposallistdatanew->proposal_ref_id))->get();
            if(empty($proposallist))
            {
                $proposallistfinal = $proposallist;
            }else
            {
                $proposallistfinal = $proposallistnew;
            }
       }else
       {
           $proposallistdatanewfinal = $proposallistdata;
           $proposallist = DB::table('proposal_item')->where(array('proposal_id' => $request->id))->get();
            $proposallistnew = DB::table('proposal_item')->where(array('proposal_id' => $proposallistdata->proposal_ref_id))->get();
            
             if(empty($proposallist))
            {
                $proposallistfinal = $proposallist;
            }else
            {
                $proposallistfinal = $proposallistnew;
            }
       }
   
        $product = DB::table('tbl_product')->get();
        $customproduct = DB::table('custom_product')->get();
        $editdata =  DB::table('custom_product')->where(array('id' => $request->id))->first();
        return view('proposallistitem',['customproduct' => $customproduct,'editcustomproduct' => $editdata,'proposallist' => $proposallistfinal,'product' => $product,'proposallistdata' => $proposallistdatanewfinal,'proposalid' => $request->proposalid]);
    }
    public function customproductdelete($id)
    {
        $data = DB::table('custom_product')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect()->back()->with('success_message', 'Custom Product  deleted successfully');
        }
        else
        {
             return redirect()->back()->with('error_message', 'Custom Product not deleted successfully');
        }
    }
    public function getproducttype(Request $request)
    {
        $html = '<option>Select</option>';
        if($request->producttype == 1)
        {
             $product = DB::table('tbl_product')->get();
             foreach($product as $productval)
             {
                 $html .= '<option value="'.$productval->id.'">'.$productval->product_name.'</option>';
             }
        }else
        {
            $product = DB::table('custom_product')->get();
             foreach($product as $productval)
             {
                 $html .= '<option value="'.$productval->id.'">'.$productval->productname.'</option>';
             }
        }
        echo $html;
    }
    public function editleadpropdata(Request $request)
    {
        $info = DB::table('tbl_addnewlead')->where(array('id' => $request->id))->first();
        $proposaldata = DB::table('lead_proposal')->get();
        $editdata =  DB::table('lead_proposal')->where(array('id' => $request->id))->first();
        return view('leadproposal',['proposaldata' => $proposaldata,'editleadpropdata' => $editdata,'listlead' => $info]);
    }
    public function propdatadelete($id)
    {
        $data = DB::table('lead_proposal')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/proposallistdata')->with('success_message', 'Proposal List deleted successfully');
        }
        else
        {
            return redirect('/proposallistdata')->with('error_message', 'Proposal List not deleted successfully');
        }
    }
    public function crmdashboard()
    {
        if(session('user_id') != '')
        {
            $product = DB::table('tbl_product')->get();
            $category = DB::table('tbl_categories')->get();
            $brand = DB::table('tbl_brand')->get();
            $month  = [1,2,3,4,5,6,7,8,9,10,11,12];
            $campagian = [];
            $leads = [];
           
            foreach($month as $m)
            {
                $campagiandata =  DB::table('crm_campaign')->whereMonth('created_at',  $m)->get();
                $leadsdata =  DB::table('tbl_addnewlead')->whereMonth('created_at', $m)->get();
               
                array_push($campagian,count($campagiandata));
                array_push($leads,count($leadsdata));
               
            }
           
           
            return view('crmdashboard',['product' => $product, 'category' => $category,'brand' => $brand,'campagian' => $campagian,'leads' => $leads]);
        }
        else
        {
            return view('login');
        }
        
    }
    public function orderlist()
    {
        if(session('user_id') != '')
        {
            $orderlist = DB::table('orderdata')->select('orderdata.*','user.*')->join('user','user.id','=','orderdata.userid')->get();
            return view('orderlist',['orderlist' => $orderlist]);
        }else
        {
            return view('login');
        }
    }
     public function eventlist()
    {
        if(session('user_id') != '')
        {
             $eventlist = DB::table('tbl_events')->join('tbl_addnewlead','tbl_events.lead_id','tbl_addnewlead.id')->select('tbl_events.*','tbl_addnewlead.*')->get();
            
            return view('eventlist',['eventlist' => $eventlist]);
        }else
        {
            return view('login');
        }
    }
    public function proposallistdata()
    {
        $proposaldata = DB::table('lead_proposal')->get();
        return view('proposallistdata',['proposaldata' => $proposaldata]);
    }
     public function unitwiseprice()
    {
        $unitwisepricedata = DB::table('tbl_unitwiseprice')->get();
        $unitdata = DB::table('tbl_unit')->get();
      return view('unitwiseprice',['unitdata' => $unitdata,'unitwisepricedata' => $unitwisepricedata]);
    }
    public function addunit(Request $request)
    {
        $info = $this->validate($request,[
                'unit_name' => 'required',
        ]);
        $data = DB::table('tbl_unit')->insert($info);
       
        if($data == 1)
        {
            return redirect('/unitwiseprice')->with('success_message', 'Unit added successfully');
        }
        else
        {
            return redirect('/unitwiseprice')->with('error_message', 'Unit not added successfully');
        }
    }
    public function editunit($id)
    {
         $unitdata = DB::table('tbl_unit')->get();
        $editdata =  DB::table('tbl_unit')->where(array('id' => $id))->first();
        return view('unitwiseprice',['unitdata' => $unitdata,'editunit' => $editdata]);
    }
    public function updateunit(Request $request)
    {
        $info = $this->validate($request,[
                'unit_name' => 'required',
        ]);
        $updateunit = DB::table('tbl_unit')->where(array('id' => $request->hiddenid))->update($info);
        if($updateunit == 1)
        {
            return redirect('/unitwiseprice')->with('success_message', 'Unit update successfully');
        }
        else
        {
            return redirect('/unitwiseprice')->with('error_message', 'Unit not update successfully');
        }
    }
    public function unitdelete($id)
    {
        $data = DB::table('tbl_unit')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/unitwiseprice')->with('success_message', 'Unit deleted successfully');
        }
        else
        {
            return redirect('/unitwiseprice')->with('error_message', 'Unit not deleted successfully');
        }
    }
    public function addunitwiseprice(Request $request)
    {
        
        $info = array(
            'unit_name'  => $request->unitwisename,
            'price'  => $request->pricedata
            );
        $data = DB::table('tbl_unitwiseprice')->insert($info);
       
        if($data == 1)
        {
            return redirect('/unitwiseprice')->with('success_message', 'Unit Wise Price added successfully');
        }
        else
        {
            return redirect('/unitwiseprice')->with('error_message', 'Unit Wise Price not added successfully');
        }
    }
    public function editunitwiseprice($id)
    {
         $unitdata = DB::table('tbl_unit')->get();
         $unitwisepricedata = DB::table('tbl_unitwiseprice')->get();
        $editdata =  DB::table('tbl_unitwiseprice')->where(array('id' => $id))->first();
        return view('unitwiseprice',['unitdata' => $unitdata,'unitwisepricedata' => $unitwisepricedata,'editunitwiseprice' => $editdata]);
    }
    public function updateunitwseprice(Request $request)
    {
        $info = array(
            'unit_name'  => $request->unitwisename,
            'price'  => $request->pricedata
            );
        $updateunitwseprice = DB::table('tbl_unitwiseprice')->where(array('id' => $request->hiddenid))->update($info);
        if($updateunitwseprice == 1)
        {
            return redirect('/unitwiseprice')->with('success_message', 'Unit Wise Price update successfully');
        }
        else
        {
            return redirect('/unitwiseprice')->with('error_message', 'Unit Wise Price not update successfully');
        }
    }
    public function unitwisepricedelete($id)
    {
        $data = DB::table('tbl_unitwiseprice')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/unitwiseprice')->with('success_message', 'Unit Wise Price deleted successfully');
        }
        else
        {
            return redirect('/unitwiseprice')->with('error_message', 'Unit Wise Price not deleted successfully');
        }
    }
    public function getunitprice(Request $request)
    {
        $data = DB::table('tbl_unitwiseprice')->where('unit_name','=',$request->unitid)->first();
        if($data != '')
        {
            echo $data->price;
        }else
        {
            echo 0;
        }
        
    }
    public function accessmodule()
    {
        $accessmodule = DB::table('access')->get();
        $access_permission = DB::table('access_permission')->get();
        return view('accessmodule',['accessmodule' => $accessmodule,'access_permission' => $access_permission]);
    }
    public function seeallnotify()
    {
        
        return view('seeallnotify');
    }
    public function deliverysetting()
    {
        $deliverysetting = DB::table('tbl_deliverysetting')->get();
        return view('deliverysetting',['deliverysetting' => $deliverysetting]);
    }
     public function adddeliverysetting(Request $request)
    {
         $info = array(
            'title' => $request->delivertitle,
            'weight' => $request->deliverweight,
            'price' => $request->deliverprice
            );
        $data = DB::table('tbl_deliverysetting')->insert($info);
            
        if($data == 1)
        {
            return redirect('/deliverysetting')->with('success_message', 'Delivery added successfully');
        }
        else
        {
            return redirect('/deliverysetting')->with('error_message', 'Delivery not added successfully');
        }
    }
    public function editdeliverysetting($id)
    {
        $deliverysetting = DB::table('tbl_deliverysetting')->get();
        $editdata =  DB::table('tbl_deliverysetting')->where(array('id' => $id))->first();
        return view('deliverysetting',['deliverysetting' => $deliverysetting,'editdeliverysetting' => $editdata]);
    }
    public function updatedeliverysetting(Request $request)
    {
         $info = array(
            'title' => $request->delivertitle,
            'weight' => $request->deliverweight,
            'price' => $request->deliverprice
            );
       $updatedeliverysetting = DB::table('tbl_deliverysetting')->where(array('id' => $request->hiddenid))->update($info);
        if($updatedeliverysetting == 1)
        {
            return redirect('/deliverysetting')->with('success_message', 'Delivery update successfully');
        }
        else
        {
            return redirect('/deliverysetting')->with('error_message', 'Delivery not update successfully');
        }
    }
     public function deliverydelete($id)
    {
        $data = DB::table('tbl_deliverysetting')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/deliverysetting')->with('success_message', 'Delivery  deleted successfully');
        }
        else
        {
            return redirect('/deliverysetting')->with('error_message', 'Delivery not deleted successfully');
        }
    }
    public function holiday()
    {
        $service = DB::table('services')->get();
        $holiday = DB::table('tbl_holiday')->get();
        return view('holiday',['holiday' => $holiday,'service' => $service]);
    }
    public function addholiday(Request $request)
    {
         $info = array(
            'service' => $request->service,
            'staff' => $request->staff,
            'date' => $request->dateholiday,
            'reason' => $request->reason
            );
        $data = DB::table('tbl_holiday')->insert($info);
            
        if($data == 1)
        {
            return redirect('/holiday')->with('success_message', 'Holiday added successfully');
        }
        else
        {
            return redirect('/holiday')->with('error_message', 'Holiday not added successfully');
        }
    }
    public function editholiday($id)
    {
        $service = DB::table('services')->get();
        $holiday = DB::table('tbl_holiday')->get();
        $editdata =  DB::table('tbl_holiday')->where(array('id' => $id))->first();
        return view('holiday',['service' => $service,'holiday' => $holiday,'editholiday' => $editdata]);
    }
    public function updateholiday(Request $request)
    {
         $info = array(
            'service' => $request->service,
            'staff' => $request->staff,
            'date' => $request->dateholiday,
            'reason' => $request->reason
            );
       $updateholiday = DB::table('tbl_holiday')->where(array('id' => $request->hiddenid))->update($info);
        if($updateholiday == 1)
        {
            return redirect('/holiday')->with('success_message', 'Holiday update successfully');
        }
        else
        {
            return redirect('/holiday')->with('error_message', 'Holiday not update successfully');
        }
    }
     public function holidaydelete($id)
    {
        $data = DB::table('tbl_holiday')->where('id', $id)->delete();
        if($data == 1)
        {
            return redirect('/holiday')->with('success_message', 'Holiday  deleted successfully');
        }
        else
        {
            return redirect('/holiday')->with('error_message', 'Holiday not deleted successfully');
        }
    }
}
