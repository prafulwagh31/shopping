<div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
         <?php 
        
            $plugin = DB::table('tbl_plugin')->where('id', 1)->first();
             if(session('user_type') == 'admin') {?>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard')}}">
              <span class="menu-title">Dashboard</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>
         <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#productdata" aria-expanded="false" aria-controls="productdata">
              <span class="menu-title">Products</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-plus-square menu-icon"></i>
            </a>
            <div class="collapse" id="productdata">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link" href="{{ url('brand')}}">Brand</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('categories')}}">Categories</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('attributes')}}">Attributes</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('product')}}">Product</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('productlist')}}">Product list</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('importproduct')}}">Import Product</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('importpriceproduct')}}">Update product price</a></li>
                  
              </ul>
            </div>
         </li>
          <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#servicedata" aria-expanded="false" aria-controls="servicedata">
              <span class="menu-title">Service</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-briefcase menu-icon"></i>
            </a>
            <div class="collapse" id="servicedata">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link" href="{{ url('servicecategory')}}">Service Category</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('services')}}">Services</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('staff')}}">Staff</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('duration')}}">Duration</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('timeslot')}}">Time Slot</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('holiday')}}">Holiday</a></li>
              </ul>
            </div>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#inventorydata" aria-expanded="false" aria-controls="inventorydata">
              <span class="menu-title">Inventory</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-arrows menu-icon"></i>
            </a>
           
             <div class="collapse" id="inventorydata">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link" href="{{ url('inventory')}}">Inventory</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('transferlist')}}">Transfer</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('transfer')}}">Add  Purchase Order</a></li>
              </ul>
             </div> 
         </li> 
         <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#websitesetting" aria-expanded="false" aria-controls="websitesetting">
              <span class="menu-title">Website Setting</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-settings menu-icon"></i>
            </a>
            <div class="collapse" id="websitesetting">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link" href="{{ url('currency')}}">Currency</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('giftcard')}}">Gift Cards</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('discount')}}">Discount Codes</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('setting')}}">Setting</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('taxes')}}">Taxes</a></li>
                   <li class="nav-item"><a class="nav-link" href="{{ url('shipping')}}">Shipping</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('warehouse')}}">Warehouse</a></li>
                   <li class="nav-item"><a class="nav-link" href="{{ url('unitwiseprice')}}">Unit Wise Price</a></li>
                   <li class="nav-item"><a class="nav-link" href="{{ url('deliverysetting')}}">Delivery Setting</a></li>
                   <li class="nav-item"><a class="nav-link" href="{{ url('slidersetting')}}">Slider Setting</a></li>
              </ul>
            </div>  
         </li>
         <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#paymentgateway" aria-expanded="false" aria-controls="paymentgateway">
              <span class="menu-title">Payment Gateway</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-cc-mastercard menu-icon"></i>
            </a>
            <div class="collapse" id="paymentgateway">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link" href="{{ url('paywithpaypal')}}">Paypal</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('paywithrazorpay')}}">RazorPay</a></li>
                  <li class="nav-item"><a class="nav-link" href="https://thadathilfarmresort.com/shoppingcat/ISGPAY/start.php">ISGPAY</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('paymentgatwaykey')}}">Payment Gateway Keys</a></li>
              </ul>
            </div>
         </li>    
            <?php if(session('user_type') == 'vendor') {?>
            <?php } else {?>
            <li class="nav-item">
               
            <a class="nav-link"  href="{{ url('vendordata')}}" >
              <span class="menu-title"> Vendor</span>
              <i class="fa fa-user menu-icon"></i>
            </a>
            </li>
            <?php } }?>
             <?php 
             
             if(session('user_type') == 'pos') {?>
            <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-title">Marketing</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-user menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ url('campaigns')}}">Campaigns</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('lead')}}">Leads</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('contact')}}">Contacts</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('organization')}}">Organizations</a></li>
              </ul>
            </div>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general" aria-expanded="false" aria-controls="general">
              <span class="menu-title">Projects</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-briefcase menu-icon"></i>
            </a>
            <div class="collapse" id="general">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ url('project')}}">Projects</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('task')}}">Projects Task</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('milestone')}}">Projects Milestone</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('contactproject')}}">Project Contacts</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('organization')}}">Organizations</a></li>
              </ul>
            </div>
            </li>
            <?php }?>
            <?php 
             
             if(session('user_type') == 'admin') {?>
            <li class="nav-item">
            <a class="nav-link" href="{{ url('customer')}}">
              <span class="menu-title">Customers</span>
              <i class="fa fa-user-circle-o menu-icon"></i>
            </a>
            </li>
             
            
            <?php if($plugin->pos == 1) {?>
            <li class="nav-item">
            <a class="nav-link" href="https://thadathilfarmresort.com/posplugindata/">
              <span class="menu-title">POS</span>
              <i class="mdi mdi-pause-octagon menu-icon"></i>
            </a>
            </li>
            <?php }
            
            ?>
            <?php if($plugin->crm == 1) {?>
            <span style="padding-left: 35px;">------------CRM--------------------</span>
            <li class="nav-item">
            <a class="nav-link" href="{{ url('crmdashboard')}}" target="_blank">
              <span class="menu-title">CRM Dashboard</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-title">Marketing</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-user menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ url('campaigns')}}">Campaigns</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('addleads')}}">Add Leads</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('listleads')}}">List Leads</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('contact')}}">Contacts</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('organization')}}">Organizations</a></li>
              </ul>
            </div>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#crmsetting" aria-expanded="false" aria-controls="crmsetting">
              <span class="menu-title">CRM Setting</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-settings menu-icon"></i>
            </a>
            <div class="collapse" id="crmsetting">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ url('leadstatus')}}">Lead Status</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('leadsource')}}">Lead Source</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('industry')}}">Lead Industry</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('salesgroup')}}">Sales Group</a></li>
                
              </ul>
            </div>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general" aria-expanded="false" aria-controls="general">
              <span class="menu-title">Projects</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-briefcase menu-icon"></i>
            </a>
            <div class="collapse" id="general">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ url('project')}}">Projects</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('task')}}">Projects Task</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('milestone')}}">Projects Milestone</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('contactproject')}}">Project Contacts</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('organization')}}">Organizations</a></li>
              </ul>
            </div>
            </li>
            <?php }
            ?>
             <li class="nav-item">
            <a class="nav-link" href="{{ url('plugin')}}">
              <span class="menu-title">Plugin</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
            </li>
            
             <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#access" aria-expanded="false" aria-controls="access">
              <span class="menu-title">Access Module</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-briefcase menu-icon"></i>
            </a>
            <div class="collapse" id="access">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ url('role')}}">Role</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('accessuser')}}">Staff User</a></li>
                
               
              </ul>
            </div>
            </li>
            
            <?php }?>
            
            <?php 
            if(session('user_type') == 'accessusers')
            {
               
            $access_permission = DB::table('access_permission')->where('user_id','=',session('user_id'))->get();
            
            foreach($access_permission as $access_permissionval){
            ?>
            @if($access_permissionval->module_id == 1)
                 <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard')}}">
              <span class="menu-title">Dashboard</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>
          @endif
           @if($access_permissionval->module_id == 2)
         <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#productdata" aria-expanded="false" aria-controls="productdata">
              <span class="menu-title">Products</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-plus-square menu-icon"></i>
            </a>
            <div class="collapse" id="productdata">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link" href="{{ url('brand')}}">Brand</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('categories')}}">Categories</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('attributes')}}">Attributes</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('product')}}">Product</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('productlist')}}">Product list</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('importproduct')}}">Import Product</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('importpriceproduct')}}">Update product price</a></li>
                  
              </ul>
            </div>
         </li>
         @endif
          @if($access_permissionval->module_id == 3)
          <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#servicedata" aria-expanded="false" aria-controls="servicedata">
              <span class="menu-title">Service</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-briefcase menu-icon"></i>
            </a>
            <div class="collapse" id="servicedata">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link" href="{{ url('servicecategory')}}">Service Category</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('services')}}">Services</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('staff')}}">Staff</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('duration')}}">Duration</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('timeslot')}}">Time Slot</a></li>
                  
              </ul>
            </div>
         </li>
         @endif
          @if($access_permissionval->module_id == 4)
         <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#inventorydata" aria-expanded="false" aria-controls="inventorydata">
              <span class="menu-title">Inventory</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-arrows menu-icon"></i>
            </a>
           
             <div class="collapse" id="inventorydata">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link" href="{{ url('inventory')}}">Inventory</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('transferlist')}}">Transfer</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('transfer')}}">Add Transfer</a></li>
              </ul>
             </div> 
         </li> 
         @endif
          @if($access_permissionval->module_id == 5)
         <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#websitesetting" aria-expanded="false" aria-controls="websitesetting">
              <span class="menu-title">Website Setting</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-settings menu-icon"></i>
            </a>
            <div class="collapse" id="websitesetting">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link" href="{{ url('currency')}}">Currency</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('giftcard')}}">Gift Cards</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('discount')}}">Discount Codes</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('setting')}}">Setting</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('taxes')}}">Taxes</a></li>
                   <li class="nav-item"><a class="nav-link" href="{{ url('shipping')}}">Shipping</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('warehouse')}}">Warehouse</a></li>
                   <li class="nav-item"><a class="nav-link" href="{{ url('unitwiseprice')}}">Unit Wise Price</a></li>
              </ul>
            </div>  
         </li>
         @endif
          @if($access_permissionval->module_id == 6)
         <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#paymentgateway" aria-expanded="false" aria-controls="paymentgateway">
              <span class="menu-title">Payment Gateway</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-cc-mastercard menu-icon"></i>
            </a>
            <div class="collapse" id="paymentgateway">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link" href="{{ url('paywithpaypal')}}">Paypal</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('paywithrazorpay')}}">RazorPay</a></li>
                  <li class="nav-item"><a class="nav-link" href="https://thadathilfarmresort.com/shoppingcat/ISGPAY/start.php">ISGPAY</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('paymentgatwaykey')}}">Payment Gateway Keys</a></li>
              </ul>
            </div>
         </li>
         @endif
          @if($access_permissionval->module_id == 7)
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="{{ url('vendordata')}}">
              <span class="menu-title">Vendor</span>
              <i class="fa fa-user menu-icon"></i>
            </a>
            </li>
        @endif
          @if($access_permissionval->module_id == 8)
          <li class="nav-item">
            <a class="nav-link" href="{{ url('customer')}}">
              <span class="menu-title">Customers</span>
              <i class="fa fa-user-circle-o menu-icon"></i>
            </a>
            </li>
             @endif
            @if($access_permissionval->module_id == 9)
            <?php if($plugin->pos == 1) {?>
            <li class="nav-item">
            <a class="nav-link" href="https://thadathilfarmresort.com/posplugindata/">
              <span class="menu-title">POS</span>
              <i class="mdi mdi-pause-octagon menu-icon"></i>
            </a>
            </li>
            <?php }
            
            ?>
            @endif
           
            <?php if($plugin->crm == 1) {?>
             @if($access_permissionval->module_id == 10)
            <span style="padding-left: 35px;">------------CRM--------------------</span>
            <li class="nav-item">
            <a class="nav-link" href="{{ url('crmdashboard')}}" target="_blank">
              <span class="menu-title">CRM Dashboard</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>
          @endif
          @if($access_permissionval->module_id == 11)
            <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-title">Marketing</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-user menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ url('campaigns')}}">Campaigns</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('addleads')}}">Add Leads</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('listleads')}}">List Leads</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('contact')}}">Contacts</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('organization')}}">Organizations</a></li>
              </ul>
            </div>
            </li>
            @endif
            @if($access_permissionval->module_id == 12)
            <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#crmsetting" aria-expanded="false" aria-controls="crmsetting">
              <span class="menu-title">CRM Setting</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-settings menu-icon"></i>
            </a>
            <div class="collapse" id="crmsetting">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ url('leadstatus')}}">Lead Status</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('leadsource')}}">Lead Source</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('industry')}}">Lead Industry</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('salesgroup')}}">Sales Group</a></li>
                
              </ul>
            </div>
            </li>
            @endif
            @if($access_permissionval->module_id == 13)
            <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general" aria-expanded="false" aria-controls="general">
              <span class="menu-title">Projects</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-briefcase menu-icon"></i>
            </a>
            <div class="collapse" id="general">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ url('project')}}">Projects</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('task')}}">Projects Task</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('milestone')}}">Projects Milestone</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('contactproject')}}">Project Contacts</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('organization')}}">Organizations</a></li>
              </ul>
            </div>
            </li>
            @endif
            <?php }
            ?>
            @if($access_permissionval->module_id == 14)
             <li class="nav-item">
            <a class="nav-link" href="{{ url('plugin')}}">
              <span class="menu-title">Plugin</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
            </li>
            @endif
            @if($access_permissionval->module_id == 15)
             <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#access" aria-expanded="false" aria-controls="access">
              <span class="menu-title">Access Module</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-briefcase menu-icon"></i>
            </a>
            <div class="collapse" id="access">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ url('role')}}">Role</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('accessuser')}}">Staff User</a></li>
                
               
              </ul>
            </div>
            </li>
            @endif
            <?php  } }
            ?>
        
        </ul>
      </nav>