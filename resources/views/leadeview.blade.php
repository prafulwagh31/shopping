@include('header')

<style>
    .tabdata
    {
        padding:20px;
    }
    .tab-pane
    {
        padding-top:30px;
    }

.modal-content {
   
    width: 60% !important;
}
</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Lead Detail
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                 <li class="breadcrumb-item"><a href="{{ url('crmdashboard')}}">CRM Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lead Detail</li>
              </ol>
            </nav>
          </div>
            <div class="row">
               <div class="col-md-4"> 
               @if(session()->has('error_message'))
                <center><div class="alert alert-danger">{{ session('error_message') }}</div></center>
                @endif
                @if(session()->has('success_message'))
                <center><div class="alert alert-success">{{ session('success_message') }}</div></center>
                @endif</div>
            </div>
          
          <div class="row">
            
            <div class="col-md-12 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Lead Detail</h4>
                <div class="row">
                  <div class="col-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">Card</a></li>
                       
                        <li><a class="tabdata" data-toggle="tab" href="#menu2">Customer</a></li>
                        <!--<li><a class="tabdata" data-toggle="tab" href="#menu3">Linked Files</a></li>-->
                         <li><a class="tabdata" data-toggle="tab" href="#menu3">Events</a></li>
                          <li><a class="tabdata" data-toggle="tab" href="#menu1">Notes</a></li>
                    </ul>
                    
                      <div class="tab-content">
                        <div id="home" class="tab-pane fade in active show" >
                          <h3></h3>
                          <div class="row">
                                <div class="col-md-2">
                                  <img src="{{asset('productimg')}}<?php echo '/'.$listlead->image;?>" style="width:170px;height:100px">
                                </div>
                                <div class="col-md-5">
                                  <p style="line-height: 0.5;">{{ $listlead->leadname}}</p>
                                   <p style="line-height: 0.5;"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;{{ $listlead->address}} {{ $listlead->city}} {{ $listlead->zipcode}}, <?php if(isset($country->name)){echo $country->name;}?></p>
                                  
                                   <p style="line-height: 0.5;"><i class="fa fa-phone"></i>&nbsp;&nbsp;<?php if(isset($listlead->countrycode)){?><a href="https://wa.me/{{$listlead->countrycode}}{{$listlead->phone}}?text=Hello%2C+I+want+to+Enquire+about+your+services" target="_blank"><?php echo $listlead->phone;?></a><?php }else{ echo $listlead->phone;}?></p>
                                     <p style="line-height: 0.5;"><i class="fa fa-envelope"></i>&nbsp;&nbsp;{{ $listlead->email}}</p>
                                </div>
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <hr>
                                  <div class="row">
                                  <div class="col-md-6">Prospect / Customer</div>
                                  <div class="col-md-4">@if(isset($listlead->prospect_customer)){{ $listlead->prospect_customer}}@endif</div>
                                  </div>
                                  <hr>
                                   <div class="row">
                                  <div class="col-md-6">Vendor</div>
                                  <div class="col-md-4">@if(isset($listlead->vendor))@if($listlead->vendor == 1) Yes @else No  @endif @endif</div>
                                  </div>
                                  <hr>
                                   <div class="row">
                                  <div class="col-md-6">Vendor Code</div>
                                  <div class="col-md-4"></div>
                                  </div>
                                  <hr>
                                   <div class="row">
                                  <div class="col-md-6">Customer Code</div>
                                  <div class="col-md-4"></div>
                                  </div>
                                   <hr>
                              </div>
                              
                              <div class="col-md-6">
                                    <hr>
                                     <div class="row">
                                  <div class="col-md-6">Customers tags/categories</div>
                                  <div class="col-md-4">@if(isset($catgory)){{$catgory}}@endif</div></div>
                                  <hr>
                                   <div class="row">
                                  <div class="col-md-6">Sales representatives</div>
                                  <div class="col-md-4">@if(isset($saleuser)){{ $saleuser }}@endif</div>
                                  </div>
                                  <hr>
                                   <div class="row">
                                  <div class="col-md-6">Sales tax used</div>
                                  <div class="col-md-4">@if(isset($listlead->salteax))@if($listlead->salteax == 1) Yes @else No  @endif @endif</div>
                                  </div>
                                  <hr>
                                   <div class="row">
                                  <div class="col-md-6">Third-party type</div>
                                  <div class="col-md-4">@if(isset($listlead->thirdparty)){{ $listlead->thirdparty }}@endif</div>
                                  </div>
                                   <hr>
                              </div>
                          </div>
                         
                              
                           <div class="row p-0">
                               <div class="col-md-10" > <h3>Proposal list</h3></div>
                                <div class="col-md-2" ><a href="{{ route('createproposal',$listlead->id)}}" style="float:right;"><button class="btn btn-gradient-primary" >Create Proposal</button></a></div>
                              <div class="col-md-12">
                                 
                             
                               
                              <hr>
                              <table class="table tbl-responsive">
                                  
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                         </tr> 
                                    </thead>
                                    <tbody>
                                       
                                        <?php $i = 1; foreach($proposallistnew as $proposallistval) {?>
                                        <tr>
                                         <td><a href="{{ route('proposallist',$proposallistval->id)}}"><?php echo $proposallistval->proposal_ref_id;?></a></td>
                                        <td><?php echo $proposallistval->proposal_date;?></td>
                                        
                                        <td><?php if($proposallistval->proposal_status == 'accepted'){?>
                                        <span style="color:green">Accepted</span>
                                        
                                        <?php } else {?><a href="{{ route('proposalstatusupdate',$proposallistval->id)}}" style="float:left;"><button class="btn btn-default"  >Accept Proposal</button></a><?php } ?></td>
                                        
                                        
                                        
                                         <td> <a href="{{ route('createPDF',$proposallistval->id)}}" style="float:left;"><button class="btn btn-default">Export PDF</button></a>
                                         
                                         <td><?php if($proposallistval->proposal_status == 'accepted'){?>
                                        <a href="{{ route('crminvoice',$proposallistval->id)}}" style="float:left;"><button class="btn btn-default">Create Invoice</button></a>
                                        <td><a href="{{ route('invoicePDF',$proposallistval->id)}}" style="float:left;"><button class="btn btn-default">Export Invoice</button></a></td>
                                        
                                        <?php } else {?>
                                         
                                        <?php } ?></td>
                                         
                                        </td>
                                        </tr>
                                        <?php $i++; }?>
                                    </tbody>
                              </table>
                              </div>
                          </div>
                        </div>
                        
                        <div id="menu2" class="tab-pane fade">
                         
                           <div class="row">
                                <div class="col-md-2">
                                  <img src="{{asset('productimg')}}<?php echo '/'.$listlead->image;?>" style="width:170px;height:100px">
                                </div>
                                <div class="col-md-5">
                                  <p style="line-height: 0.5;">{{ $listlead->leadname}}</p>
                                   <p style="line-height: 0.5;"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;{{ $listlead->address}} {{ $listlead->city}} {{ $listlead->zipcode}}, <?php if(isset($country->name)){echo $country->name;}?></p>
                                  
                                   <p style="line-height: 0.5;"><i class="fa fa-phone"></i>&nbsp;&nbsp;<?php if(isset($listlead->countrycode)){?><a href="https://wa.me/{{$listlead->countrycode}}{{$listlead->phone}}?text=Hello%2C+I+want+to+Enquire+about+your+services" target="_blank"><?php echo $listlead->phone;?></a><?php }else{ echo $listlead->phone;}?></p>
                                     <p style="line-height: 0.5;"><i class="fa fa-envelope"></i>&nbsp;&nbsp;{{ $listlead->email}}</p>
                                </div>
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <hr>
                                  <div class="row">
                                  <div class="col-md-6">Prospect / Customer</div>
                                  <div class="col-md-4">@if(isset($listlead->prospect_customer)){{ $listlead->prospect_customer}}@endif</div>
                                  </div>
                                  <hr>
                                   <div class="row">
                                  <div class="col-md-6">Vendor</div>
                                  <div class="col-md-4">@if(isset($listlead->vendor))@if($listlead->vendor == 1) Yes @else No  @endif @endif</div>
                                  </div>
                                  <hr>
                                   <div class="row">
                                  <div class="col-md-6">Vendor Code</div>
                                  <div class="col-md-4"></div>
                                  </div>
                                  <hr>
                                   <div class="row">
                                  <div class="col-md-6">Customer Code</div>
                                  <div class="col-md-4"></div>
                                  </div>
                                  
                                    <hr>
                                     <div class="row">
                                  <div class="col-md-6">Customers tags/categories</div>
                                  <div class="col-md-4">@if(isset($catgory)){{$catgory}}@endif</div></div>
                                  <hr>
                                   <div class="row">
                                  <div class="col-md-6">Sales representatives</div>
                                  <div class="col-md-4">@if(isset($saleuser)){{ $saleuser }}@endif</div>
                                  </div>
                                  <hr>
                                   <div class="row">
                                  <div class="col-md-6">Sales tax used</div>
                                  <div class="col-md-4">@if(isset($listlead->salteax))@if($listlead->salteax == 1) Yes @else No  @endif @endif</div>
                                  </div>
                                  <hr>
                                   <div class="row">
                                  <div class="col-md-6">Third-party type</div>
                                  <div class="col-md-4">@if(isset($listlead->thirdparty)){{ $listlead->thirdparty }}@endif</div>
                                  </div>
                                   <hr>
                              </div>
                              
                              <div class="col-md-6">
                                   
                              </div>
                          </div>
                          <div class="row">
                            
                              
                               
                               
                              
                          </div>
                          
                         
                        </div>
                        <div id="menu3" class="tab-pane fade">
                          <h3>Add Events</h3>
                            <div class="col-md-8">
                            <form method="POST" action="{{ route('addevents') }}">
                                 {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label >Event Title</label>
                                        <input type="text" name="eventtitle" placeholder="Event Title" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Event User</label>
                                        <input type="text" name="eventuser" placeholder="Event Title" class="form-control" value="{{$listlead->leadname}}" readonly>
                                        <input type="hidden" name="leadid" value="{{ $listlead->id}}">
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label >Event Start Date</label>
                                        <input type="date" name="eventstart"  class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Event End Date</label>
                                        <input type="date" name="eventend"  class="form-control">
                                    </div>
                                </div>
                                
                                <input type="hidden" name="leadeventid" value="{{ $listlead->id}}">
                                <br><br>
                                <input type="submit" class="btn btn-success">
                            </form>
                            <br><br>
                            <div class="col-md-3" style="margin-left:550px;:">
                             <a href="{{ route('createevent',$listlead->id)}}"><button  class="btn btn-success">View Event</button></a>
                             </div>
                            </div>
                            <div class="col-md-8">
                                <table class="table tbl-responsive">
                                    <thead>
                                        <tr>
                                        <th>Title</th>
                                        <th>Start Date</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($eventlist as $eventlistval){?>
                                        <tr>
                                            <td>{{$eventlistval->event_title}}</td>
                                             <td>{{$eventlistval->event_start}}</td>
                                         <td><a href="{{ route('deleteevent',$eventlistval->id)}}"><i class="fa fa-trash" ></i></a></td> 
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                           <div class="row">
                               <?php if(isset($editdata)){  ?>
                               <div class="col-md-8 ">
                                   <h4>Edit Notes</h4>
                            <form method="POST" action="{{ url('/updatenotes')}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="hiddenleadid" value="{{ $listlead->id}}">
                                <input type="hidden" name="hiddenid" value="<?php echo $editdata->id;?>">
                                <div class="form-group col-md-6">
                               <label for="exampleInputUsername1">Type</label>
                               <select class="form-control" name="typenote" id="source">
                                	<option value="">Select an Option</option>
                                	<option value="Private" <?php if($editdata->type == 'Private'){echo 'selected';}?>>Private</option>
                                	<option value="Public" <?php if($editdata->type == 'Public'){echo 'selected';}?>>Public</option>
                            </select>
                               </div>
                                <div class="form-group col-md-6">
                               <label for="exampleInputUsername1">Notes </label>
                               <textarea class="form-control" id="exampleTextarea1" rows="4" name="notes"><?php echo $editdata->notes;?></textarea>
                               </div>
                               <div class="col-md-3">
                               <button type="submit" class="btn btn-info">Submit</button>
                               </button>
                               </div>
                            </form>
                            </div>
                            <?php }else {?>
                            <div class="col-md-8">
                                   <h4>Add Notes</h4>
                            <form method="POST" action="{{ route('leadnotes')}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="hiddenleadid" value="{{ $listlead->id}}">
                                <div class="form-group col-md-6">
                               <label for="exampleInputUsername1">Type</label>
                               <select class="form-control" name="typenote" id="source">
                                	<option value="">Select an Option</option>
                                	<option value="Private">Private</option>
                                	<option value="Public">Public</option>
                            </select>
                               </div>
                                <div class="form-group col-md-6">
                               <label for="exampleInputUsername1">Notes </label>
                               <textarea class="form-control" id="exampleTextarea1" rows="4" name="notes"></textarea>
                               </div>
                               <div class="col-md-3">
                               <button type="submit" class="btn btn-info">Submit</button>
                               </button>
                               </div>
                            </form>
                            </div>
                            <?php }?>
                             <div class="col-md-12" >
                                <table class="table tbl-responsive" style="width: 825px;">
                                    <thead>
                                        <tr>
                                        <th>Notes</th>
                                       
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($notes as $note){?>
                                        <tr>
                                            <td><?php echo strip_tags($note->notes)?></td>
                                           <td><a href="{{ route('editnotes',['leadid' =>$listlead->id,'id' => $note->id])}}"><i class="fa fa-edit" ></i></a>
                                         <a href="{{ route('deletenote',$note->id)}}"><i class="fa fa-trash" ></i></a></td> 
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
           
          </div>
        </div>
        <div id="myModal" class="modal">

          <!-- Modal content -->
          <div class="modal-content">
              <span class="close">&times;</span>
              <form method="POST" action="#" >
            <div class="row">
                <div class="col-md-3">Select Status</div>
                <div class="col-md-3">
                <select class="form-control" name="status" id="proposalstatus">
                    <option >Select Status</option>
                    <option value="Signed">Signed</option>
                    <option value="Unsigned">Unsigned</option>
                </select></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3"></div>
            <div class="col-md-3">
            <button type="button" class="btn btn-default" onclick="getdatasatsus()">Submit</button></div>
            </div>
            </form>
          </div>

        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

@include('footer')
<script>
    CKEDITOR.replace( 'notes' );
</script>
<script>
function getdataid(proposalid)
{
    alert(proposalid);
}

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script>
  
    function getproductdeatils(the)
    {
        var productid = $(the).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('getproductdeatils') }}", 
            type:"POST",
            data:{productid: productid},
            success: function(result){
            $('#productpriceid').val(result);
        }});
    }
    function gettotal(the)
    {
        var discount = $(the).val();
        var price =$('#productpriceid').val();
        var qty = $('#qty').val();
        
        var subtot = parseFloat(price) * parseFloat(qty);
        var dis = parseFloat(subtot) * parseFloat(discount)/100;
        var tot = parseFloat(subtot) - parseFloat(dis);
        $('#total').val(tot);
    }
    
    
</script>
