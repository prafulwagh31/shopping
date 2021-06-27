<?php
   $plugin = DB::table('tbl_plugin')->where('id', 1)->first();
   ?>
<div class="main-menu-wrap" style="padding-top:20px;">
   <button id="main-menu-toggle" class="btn btn-primary btn-lg" onclick="gettoggle()">
   <i id="menu" title="Menu" class="fa fa-list"></i>
   </button>
   <div class="custom-dropdown-menu">
      <div class="menu-bar">
         <div class="menu-bar-inner">
            <div class="menu-bar-content">
               <div id="menu" class="fa fa-close cm-menu-close-icon" onclick="gettoggle()"></div>
               <div class="dropdwon-menu-search">
                  <div class="ainMenuSearchInput">
                     <div class="form-control-feedback">
                        <span title="Search" class="fa fa-search fa-sm form-control-feedback "></span>
                     </div>
                     <div class="menu-search-container">
                        <input type="search" placeholder="Search menu items" class="form-control">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="custom-favourites-box">
         <div class="favourites-box-inner">
            <span class="text-favourites">Favourites</span>
            <span class="text-personalize">Personalize
            <i class="fa-chevron-double-right"></i>
            </span>
         </div>
         <div id="favourites" class="custom-favourites">
            <a href="{{ url('dashboard')}}" class="fav-links">
            <span class="icon-wrap">
            <i class="fa fa-star"></i>
            </span>
            <span title="Contacts" class="fav-text">Dashboard</span>
            </a>
            <a href="{{ url('vendordata')}}" class="fav-links">
            <span class="icon-wrap">
            <i class="fa fa-star"></i>
            </span>
            <span title="Organizations" class="fav-text">Vendor</span>
            </a>

            @if($plugin?->pos == 1)
            <a href="https://thadathilfarmresort.com/posplugindata/" class="fav-links">
            <span class="icon-wrap">
            <i class="fa fa-star"></i>
            </span>
            <span title="Organizations" class="fav-text">POS</span>
            </a>
            @endif
            <a href="{{ url('customer')}}" class="fav-links">
            <span class="icon-wrap">
            <i class="fa fa-star"></i>
            </span>
            <span title="Actions" class="fav-text">Customers</span>
            </a>
            @if($plugin?->crm == 1)
            <a href="{{ url('crmdashboard')}}" class="fav-links">
            <span class="icon-wrap">
            <i class="fa fa-star"></i>
            </span>
            <span title="Actions" class="fav-text">CRM Dashboard</span>
            </a>
            @endif
            <a href="{{ url('plugin')}}" class="fav-links">
            <span class="icon-wrap">
            <i class="fa fa-star"></i>
            </span>
            <span title="Events" class="fav-text">Plugin</span>
            </a>
            <!--<a href="view/list?module=Tasks&amp;app=ESSENTIALS" class="fav-links">-->
            <!--    <span class="icon-wrap">-->
            <!--        <i class="fa-star fas"></i>-->
            <!--    </span>-->
            <!--    <span title="Tasks" class="fav-text">Tasks</span>-->
            <!--</a>-->
            <!--<a href="view/list?module=Import&amp;app=ESSENTIALS" class="fav-links">-->
            <!--    <span class="icon-wrap">-->
            <!--        <i class="fa-star fas"></i>-->
            <!--    </span>-->
            <!--    <span title="Import" class="fav-text">Import</span>-->
            <!--</a>-->
            <!--<a href="view/mailboxtype?module=Inbox&amp;app=ESSENTIALS" class="fav-links">-->
            <!--    <span class="icon-wrap">-->
            <!--        <i class="fa-star fas"></i>-->
            <!--    </span>-->
            <!--    <span title="Inbox" class="fav-text">Inbox</span>-->
            <!--</a>-->
            <!--<a href="view/list?module=Reports&amp;app=ESSENTIALS" class="fav-links">-->
            <!--    <span class="icon-wrap">-->
            <!--        <i class="fa-star fas"></i>-->
            <!--    </span>-->
            <!--    <span title="Reports" class="fav-text">Reports</span>-->
            <!--</a>-->
            <!--<a href="view/list?module=Dashboard&amp;app=ESSENTIALS" class="fav-links">-->
            <!--    <span class="icon-wrap">-->
            <!--        <i class="fa-star fas"></i>-->
            <!--    </span>-->
            <!--    <span title="Dashboard" class="fav-text">Dashboard</span>-->
            <!--</a>-->
         </div>
      </div>
      <div id="app-menu-box">
         <div class="cm-appsContainer" style="height: calc(100vh - 290px);">
            <div class="cm-title"></div>
            <ul class="apps-container-sidebar">
               <?php  if(session('user_type') == 'admin'){?>
               <li id="app_ESSENTIALS" title="Essentials" class="sidebar-link">
                  <div class="sidebar-text activeApp">
                     <a  onclick="gettabactive('product')">
                     <i class="fa fa-plus-square menu-icon" style="color: rgb(38, 198, 218);"></i>
                     <span class="sidebar-text-content">Products</span>
                     </a>
                  </div>
               </li>
               <li id="app_MARKETING" title="Marketing" class="sidebar-link">
                  <div class="sidebar-text inactiveApp">
                     <a  onclick="gettabactive('service')">
                     <i class="fa fa-briefcase menu-icon" style="color: rgb(135, 124, 255);"></i>
                     <span class="sidebar-text-content">Service</span>
                     </a>
                  </div>
               </li>
               <li id="app_SALES" title="Sales" class="sidebar-link">
                  <div class="sidebar-text inactiveApp">
                     <a   onclick="gettabactive('inventory')">
                     <i class="fa fa-arrows menu-icon" style="color: rgb(254, 141, 73);"></i>
                     <span class="sidebar-text-content">Inventory</span>
                     </a>
                  </div>
               </li>
               <li id="app_SUPPORT" title="Help desk" class="sidebar-link">
                  <div class="sidebar-text inactiveApp">
                     <a   onclick="gettabactive('websitesetting')">
                     <i class="fa fa-gear" style="color: rgb(254, 141, 73);"></i>
                     <span class="sidebar-text-content">Website Setting</span>
                     </a>
                  </div>
               </li>
               @if($plugin?->crm == 1)
               <li id="app_PROJECTS" title="Projects" class="sidebar-link">
                  <div class="sidebar-text inactiveApp">
                     <a   onclick="gettabactive('crm')">
                     <i class="fa fa-circle-o" style="color: rgb(244, 114, 208);"></i>
                     <span class="sidebar-text-content">CRM</span>
                     </a>
                  </div>
               </li>
               @endif
               <li id="app_INVENTORY" title="Inventory" class="sidebar-link">
                  <div class="sidebar-text inactiveApp">
                     <a   onclick="gettabactive('access_module')">
                     <i class="fa fa-user-circle-o" style="color: rgb(0, 206, 209);"></i>
                     <span class="sidebar-text-content">Access Module</span>
                     </a>
                  </div>
               </li>
               <?php }?>
               <?php 
                  if(session('user_type') == 'accessusers')
                  {
                     
                  $access_permission = DB::table('access_permission')->where('user_id','=',session('user_id'))->get();
                  
                  foreach($access_permission as $access_permissionval){
                  ?>
               @if($access_permissionval?->module_id == 2)
               <li id="app_ESSENTIALS" title="Essentials" class="sidebar-link">
                  <div class="sidebar-text activeApp">
                     <a  onclick="gettabactive('product')">
                     <i class="fa fa-plus-square menu-icon" style="color: rgb(38, 198, 218);"></i>
                     <span class="sidebar-text-content">Products</span>
                     </a>
                  </div>
               </li>
               @endif
               @if($access_permissionval?->module_id == 3)
               <li id="app_MARKETING" title="Marketing" class="sidebar-link">
                  <div class="sidebar-text inactiveApp">
                     <a  onclick="gettabactive('service')">
                     <i class="fa fa-briefcase menu-icon" style="color: rgb(135, 124, 255);"></i>
                     <span class="sidebar-text-content">Service</span>
                     </a>
                  </div>
               </li>
               @endif
               @if($access_permissionval?->module_id == 4)
               <li id="app_SALES" title="Sales" class="sidebar-link">
                  <div class="sidebar-text inactiveApp">
                     <a   onclick="gettabactive('inventory')">
                     <i class="fa fa-arrows menu-icon" style="color: rgb(254, 141, 73);"></i>
                     <span class="sidebar-text-content">Inventory</span>
                     </a>
                  </div>
               </li>
               @endif
               @if($access_permissionval?->module_id == 5)
               <li id="app_SUPPORT" title="Help desk" class="sidebar-link">
                  <div class="sidebar-text inactiveApp">
                     <a   onclick="gettabactive('websitesetting')">
                     <i class="fa fa-gear" style="color: rgb(254, 141, 73);"></i>
                     <span class="sidebar-text-content">Website Setting</span>
                     </a>
                  </div>
               </li>
               @endif
               @if($access_permissionval?->module_id == 10)
               @if($plugin->crm == 1)
               <li id="app_PROJECTS" title="Projects" class="sidebar-link">
                  <div class="sidebar-text inactiveApp">
                     <a   onclick="gettabactive('crm')">
                     <i class="fa fa-circle-o" style="color: rgb(244, 114, 208);"></i>
                     <span class="sidebar-text-content">CRM</span>
                     </a>
                  </div>
               </li>
               @endif
               @endif
               @if($access_permissionval?->module_id == 15)
               <li id="app_INVENTORY" title="Inventory" class="sidebar-link">
                  <div class="sidebar-text inactiveApp">
                     <a   onclick="gettabactive('access_module')">
                     <i class="fa fa-user-circle-o" style="color: rgb(0, 206, 209);"></i>
                     <span class="sidebar-text-content">Access Module</span>
                     </a>
                  </div>
               </li>
               @endif
               <?php } 
                  }?>
            </ul>
         </div>
         <div class="app-menu-container" id="product-tab" style="height: calc(100vh - 290px);">
            <div class="menu-list-wrap"  style="">
               <div class="menu-list" >
                  <div title="Product Settings Management" class="cm-title">Product Settings Management</div>
                  <div class="link-list-item">
                     <div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('brand')}}" class="menu-link">
                              <div title="Contacts" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-bandcamp"></i>
                                 </div>
                                 <div class="text-truncate">Brand</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('categories')}}" class="menu-link">
                              <div title="Organizations" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-sitemap"></i>
                                 </div>
                                 <div class="text-truncate">Categories</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('attributes')}}" class="menu-link">
                              <div title="Find Duplicates" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-anchor"></i>
                                 </div>
                                 <div class="text-truncate">Attributes</div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="menu-list" >
                  <div title="Product  Management" class="cm-title">Product  Management</div>
                  <div class="link-list-item">
                     <div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('product')}}" modulename="Notifications" class="menu-link">
                              <div title="Actions" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-product-hunt"></i>
                                 </div>
                                 <div class="text-truncate">Product</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('productlist')}}" modulename="Events" class="menu-link">
                              <div title="Events" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-list"></i>
                                 </div>
                                 <div class="text-truncate">Product list</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('importproduct')}}" modulename="Tasks" class="menu-link">
                              <div title="Tasks" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-cloud-upload"></i>
                                 </div>
                                 <div class="text-truncate">Import Product</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('importpriceproduct')}}" modulename="Documents" class="menu-link">
                              <div title="Documents" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-exchange"></i>
                                 </div>
                                 <div class="text-truncate">Update product price</div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="app-menu-container" id="service-tab" style="display:none;height: calc(100vh - 290px);">
            <div class="menu-list-wrap"   style="">
               <div class="menu-list" >
                  <div title="Service Settings Management" class="cm-title">Service Settings Management</div>
                  <div class="link-list-item">
                     <div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('servicecategory')}}" class="menu-link">
                              <div title="Contacts" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-bullseye"></i>
                                 </div>
                                 <div class="text-truncate">Service Category</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('duration')}}" class="menu-link">
                              <div title="Organizations" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-clock-o"></i>
                                 </div>
                                 <div class="text-truncate">Duration</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('timeslot')}}" class="menu-link">
                              <div title="Find Duplicates" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-calendar-o"></i>
                                 </div>
                                 <div class="text-truncate">Time Slot</div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="menu-list" id="service-tab">
                  <div title="Service Management" class="cm-title">Service Management</div>
                  <div class="link-list-item">
                     <div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('services')}}" modulename="Notifications" class="menu-link">
                              <div title="Actions" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-modx"></i>
                                 </div>
                                 <div class="text-truncate">Services</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('staff')}}" modulename="Events" class="menu-link">
                              <div title="Events" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-user-plus"></i>
                                 </div>
                                 <div class="text-truncate">Staff</div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="app-menu-container"id="inventory-tab" style="display:none;height: calc(100vh - 290px);">
            <div class="menu-list-wrap"   style="">
               <div class="menu-list" >
                  <div title="Inventory" class="cm-title">Inventory Management</div>
                  <div class="link-list-item">
                     <div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('inventory')}}" class="menu-link">
                              <div title="Contacts" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-server"></i>
                                 </div>
                                 <div class="text-truncate">Inventory</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('transferlist')}}" class="menu-link">
                              <div title="Organizations" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-indent"></i>
                                 </div>
                                 <div class="text-truncate">Purchase Order List</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('transfer')}}" class="menu-link">
                              <div title="Find Duplicates" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-toggle-up"></i>
                                 </div>
                                 <div class="text-truncate">Purchase Order</div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="app-menu-container" id="websitesetting-tab" style="display:none;height: calc(100vh - 290px);">
            <div class="menu-list-wrap"   >
               <div class="menu-list" >
                  <div title="Website Setting Management" class="cm-title">Website Setting Management</div>
                  <div class="link-list-item">
                     <div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('currency')}}" class="menu-link">
                              <div title="Contacts" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-money"></i>
                                 </div>
                                 <div class="text-truncate">Currency</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('giftcard')}}" class="menu-link">
                              <div title="Organizations" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-gift"></i>
                                 </div>
                                 <div class="text-truncate">Gift Cards</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('discount')}}" class="menu-link">
                              <div title="Find Duplicates" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-percent"></i>
                                 </div>
                                 <div class="text-truncate">Discount Codes</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('setting')}}" class="menu-link">
                              <div title="Find Duplicates" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-cog"></i>
                                 </div>
                                 <div class="text-truncate">Setting</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('taxes')}}" class="menu-link">
                              <div title="Find Duplicates" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-gg-circle"></i>
                                 </div>
                                 <div class="text-truncate">Taxes</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('shipping')}}" class="menu-link">
                              <div title="Find Duplicates" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-opencart"></i>
                                 </div>
                                 <div class="text-truncate">Shipping</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('warehouse')}}" class="menu-link">
                              <div title="Find Duplicates" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-simplybuilt"></i>
                                 </div>
                                 <div class="text-truncate">Warehouse</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('unitwiseprice')}}" class="menu-link">
                              <div title="Find Duplicates" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-chevron-circle-right"></i>
                                 </div>
                                 <div class="text-truncate">Unit Wise Price</div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <?php 
                  if(session('user_type') == 'accessusers')
                  {
                     
                  $access_permission = DB::table('access_permission')->where('user_id','=',session('user_id'))->get();
                  
                  foreach($access_permission as $access_permissionval){
                  ?>
               @if($access_permissionval->module_id == 6)
               <div class="menu-list" >
                  <div title="Payment Setting" class="cm-title">Payment Setting</div>
                  <div class="link-list-item">
                     <div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('paywithpaypal')}}" modulename="Notifications" class="menu-link">
                              <div title="Actions" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-paypal"></i>
                                 </div>
                                 <div class="text-truncate">Paypal</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('paywithrazorpay')}}" modulename="Events" class="menu-link">
                              <div title="Events" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-credit-card"></i>
                                 </div>
                                 <div class="text-truncate">RazorPay</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="https://thadathilfarmresort.com/shoppingcat/ISGPAY/start.php" modulename="Tasks" class="menu-link">
                              <div title="Tasks" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-cc-diners-club"></i>
                                 </div>
                                 <div class="text-truncate">ISGPAY</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('paymentgatwaykey')}}" modulename="Documents" class="menu-link">
                              <div title="Documents" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-file"></i>
                                 </div>
                                 <div class="text-truncate">Payment Gateway Keys</div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               @endif
               <?php } 
                  }else{
                  ?>
               <div class="menu-list" >
                  <div title="Payment Setting" class="cm-title">Payment Setting</div>
                  <div class="link-list-item">
                     <div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('paywithpaypal')}}" modulename="Notifications" class="menu-link">
                              <div title="Actions" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-paypal"></i>
                                 </div>
                                 <div class="text-truncate">Paypal</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('paywithrazorpay')}}" modulename="Events" class="menu-link">
                              <div title="Events" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-credit-card"></i>
                                 </div>
                                 <div class="text-truncate">RazorPay</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="https://thadathilfarmresort.com/shoppingcat/ISGPAY/start.php" modulename="Tasks" class="menu-link">
                              <div title="Tasks" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-cc-diners-club"></i>
                                 </div>
                                 <div class="text-truncate">ISGPAY</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('paymentgatwaykey')}}" modulename="Documents" class="menu-link">
                              <div title="Documents" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-file"></i>
                                 </div>
                                 <div class="text-truncate">Payment Gateway Keys</div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <?php
                  }?>
            </div>
         </div>
         <div class="app-menu-container" id="crm-tab" style="display:none;height: calc(100vh - 290px);">
            <div class="menu-list-wrap"   >
               <?php 
                  if(session('user_type') == 'accessusers')
                  {
                     
                  $access_permission = DB::table('access_permission')->where('user_id','=',session('user_id'))->get();
                  
                  foreach($access_permission as $access_permissionval){
                  ?>
               @if($access_permissionval->module_id == 11)
               <div class="menu-list" >
                  <div title="Marketing Management" class="cm-title">Marketing Management</div>
                  <div class="link-list-item">
                     <div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('campaigns')}}" class="menu-link">
                              <div title="Contacts" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-adjust"></i>
                                 </div>
                                 <div class="text-truncate">Campaigns</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('addleads')}}" class="menu-link">
                              <div title="Organizations" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-ellipsis-h"></i>
                                 </div>
                                 <div class="text-truncate">Add Leads</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('listleads')}}" class="menu-link">
                              <div title="Find Duplicates" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-certificate"></i>
                                 </div>
                                 <div class="text-truncate">List Leads</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('contact')}}" class="menu-link">
                              <div title="Find Duplicates" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-vcard"></i>
                                 </div>
                                 <div class="text-truncate">Contacts</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('organization')}}" class="menu-link">
                              <div title="Find Duplicates" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-building"></i>
                                 </div>
                                 <div class="text-truncate">Organizations</div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               @endif
               @if($access_permissionval->module_id == 12)
               <div class="menu-list" >
                  <div title="CRM Setting" class="cm-title">CRM Setting</div>
                  <div class="link-list-item">
                     <div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('leadstatus')}}" modulename="Notifications" class="menu-link">
                              <div title="Actions" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-dot-circle-o"></i>
                                 </div>
                                 <div class="text-truncate">Lead Status</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('leadsource')}}" modulename="Events" class="menu-link">
                              <div title="Events" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-minus-square"></i>
                                 </div>
                                 <div class="text-truncate">Lead Source</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('industry')}}" modulename="Tasks" class="menu-link">
                              <div title="Tasks" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-building-o"></i>
                                 </div>
                                 <div class="text-truncate">Lead Industry</div>
                              </div>
                           </a>
                        </div>
                       
                         <div class="menu-text-wrap">
                           <a href="{{ url('salesgroup')}}" modulename="Documents" class="menu-link">
                              <div title="Documents" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-object-group"></i>
                                 </div>
                                 <div class="text-truncate">Sales Groups</div>
                              </div>
                           </a>
                        </div>
                         <div class="menu-text-wrap">
                           <a href="{{ url('salesuser')}}" modulename="Documents" class="menu-link">
                              <div title="Documents" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-object-group"></i>
                                 </div>
                                 <div class="text-truncate">Sales User</div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               @endif
               <?php }
                  }else{?>
               <div class="menu-list" >
                  <div title="Marketing Management" class="cm-title">Marketing Management</div>
                  <div class="link-list-item">
                     <div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('campaigns')}}" class="menu-link">
                              <div title="Contacts" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-adjust"></i>
                                 </div>
                                 <div class="text-truncate">Campaigns</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('addleads')}}" class="menu-link">
                              <div title="Organizations" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-ellipsis-h"></i>
                                 </div>
                                 <div class="text-truncate">Add Leads</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('listleads')}}" class="menu-link">
                              <div title="Find Duplicates" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-certificate"></i>
                                 </div>
                                 <div class="text-truncate">List Leads</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('contact')}}" class="menu-link">
                              <div title="Find Duplicates" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-vcard"></i>
                                 </div>
                                 <div class="text-truncate">Contacts</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('organization')}}" class="menu-link">
                              <div title="Find Duplicates" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-building"></i>
                                 </div>
                                 <div class="text-truncate">Organizations</div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="menu-list" >
                  <div title="CRM Setting" class="cm-title">CRM Setting</div>
                  <div class="link-list-item">
                     <div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('leadstatus')}}" modulename="Notifications" class="menu-link">
                              <div title="Actions" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-dot-circle-o"></i>
                                 </div>
                                 <div class="text-truncate">Lead Status</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('leadsource')}}" modulename="Events" class="menu-link">
                              <div title="Events" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-minus-square"></i>
                                 </div>
                                 <div class="text-truncate">Lead Source</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('industry')}}" modulename="Tasks" class="menu-link">
                              <div title="Tasks" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-building-o"></i>
                                 </div>
                                 <div class="text-truncate">Lead Industry</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('salesgroup')}}" modulename="Documents" class="menu-link">
                              <div title="Documents" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-object-group"></i>
                                 </div>
                                 <div class="text-truncate">Sales Groups</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('salesuser')}}" modulename="Documents" class="menu-link">
                              <div title="Documents" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-object-group"></i>
                                 </div>
                                 <div class="text-truncate">Sales User</div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <?php }?>
            </div>
         </div>
         <div class="app-menu-container" id="access_module-tab" style="display:none;height: calc(100vh - 290px);">
            <div class="menu-list-wrap"   >
               <div class="menu-list" >
                  <div title="Access Module Management" class="cm-title">Access Module Management</div>
                  <div class="link-list-item">
                     <div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('role')}}" class="menu-link">
                              <div title="Contacts" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-sliders"></i>
                                 </div>
                                 <div class="text-truncate">Role</div>
                              </div>
                           </a>
                        </div>
                        <div class="menu-text-wrap">
                           <a href="{{ url('accessuser')}}" class="menu-link">
                              <div title="Organizations" class="content-text">
                                 <div class="moduleIcon">
                                    <i class="fa fa-users"></i>
                                 </div>
                                 <div class="text-truncate">Staff User</div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="sidebar-footer">
         <div>
            <button class="btn btn-secondary btn-sm" style="width: 44%;">
            <span>
            <i class="fa-puzzle-piece"></i>
            </span>
            <span class="mr-2">Add-ons</span>
            </button>
            <button class="btn btn-secondary btn-sm"  style="width: 44%;">
            <span>
            <i class="fa-cog"></i>
            </span>
            <span class="mr-2">Settings</span>
            </button>
         </div>
      </div>
   </div>
</div>