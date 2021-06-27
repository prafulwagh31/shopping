<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!-- Custom CSS -->

<link rel="stylesheet" href="{{ asset('assets/css/product.css') }}">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,500&display=swap" rel="stylesheet">
<!-- Fancy Box -->
<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen"> -->

  </head>
  <style>
      .dashboard-wraper {
    position: relative;
    width: 100%;
    padding: 2em;
    box-shadow: 0 0 20px 0 rgba(62,28,131,0.1);
    border-radius:10px;
	background: #ffffff;
}
.modalacc_content {
  width: 895px;
  border-radius: 20px;
}

@media only screen and (max-width: 1024px) {
      .modalacc_doc
      {
      top: 70px;
      }
}
.modal_head {
  position: relative;
  left: 375px;
  font-weight: 500;
}
.myaccount_cancel {
  float: right;
  background-color: #dc4146;
  color: white;
  height: 40px;
  width: 120px;
  border-radius: 5px;
  border: 0;
  font-weight: 500;
  margin-top: 15px;
}
  </style>
  <body>
   
@include('front.header')
 <!-- End -->
@php
    $setting = \app\Http\Controllers\Front::setting();
    $currency = $setting->data->currency;
@endphp
 <section>
     
     <div class="container" style="padding-top: 30px; margin-top: 10px; padding-bottom: 30px;">
         
        <div class="row">
         <div class="col-lg-4 col-md-4 col-sm-4">
             <div class="card shadow">
                     <h3 style="margin: 15px 0px 35px 18px;font-size: 20px;"><b>My Account</b></h3>
                     <style type="text/css">
                        .myaccount_side
                        {
                        height: 60px;padding-top: 15px;cursor: pointer;
                        }
                        .myaccount_side_p
                        {
                        font-size: 17.5px;margin-left: 20px;font-weight: 500; 
                        }
                     </style>
                     <div id="side1" class="myaccount_side" style="background-color: #dc3545;">
                        <p class="myaccount_side_p" id="para1" style="color: white;"><i class="fa fa-shopping-basket"></i> &nbsp;My Orders<span style="float: right;"><i class="fa fa-angle-double-right" style="margin-right: 20px;"></i></span></p>
                     </div>
                     <div id="side2" style="background-color: white;" class="myaccount_side">
                        <p class="myaccount_side_p" id="para2" style="color: black;"><i class="fa fa-user-circle"></i> &nbsp;Personal Details<span style="float: right;"><i class="fa fa-angle-double-right" style="margin-right: 20px;"></i></span></p>
                     </div>
                     <div id="side3" style="background-color: white;" class="myaccount_side">
                        <p class="myaccount_side_p" id="para3" style="color: black;"><i class="fa fa-address-card"></i> &nbsp;Gift Card<span style="float: right;"><i class="fa fa-angle-double-right" style="margin-right: 20px;"></i></span></p>
                     </div>
                     <div id="side4" style="background-color: white;" class="myaccount_side">
                        <p class="myaccount_side_p" id="para4" style="color: black;"><i class="fa fa-university"></i> &nbsp;Customer Service<span style="float: right;"><i class="fa fa-angle-double-right" style="margin-right: 20px;"></i></span></p>
                     </div>
                     <br><br>
                  </div>
         </div>
         <div class="col-lg-8 col-md-8 col-sm-8" id="div1">
                    <div class="card shadow" >
                     <h3 style="margin: 13px 0px 30px 22px;font-size: 22px;"> <i class="fas fa-box" style="color: #4BA345;"></i>&nbsp;My Orders</h3>
                     <center class="saved_mob">
                        <table class="table saved_mob2" style="width: 95%;border: 5px solid #DEE2E6;margin-bottom: 30px;">
                           <thead>
                              <tr >
                                 <th scope="col" style="width: 30%;">Order Placed On:</th>
                                 <th scope="col" style="width: 20%;">Order Amount:</th>
                                 <th scope="col" style="width: 10%;">Payment Method:</th>
                                 <th scope="col" style="width: 20%;">Status:</th>
                                 <th scope="col" style="width: 22%;">Action:</th>
                              </tr>
                           </thead>
                           <?php foreach($orderfetch as $orderfetchval) { ?>
                           <tbody>
                              <tr style="line-height: 40px;">
                                 <th scope="row">{{  $orderfetchval->orderdate }}</th>
                                 <td>{{$currency}}. {{  $orderfetchval->total_amount }}</td>
                                 <td>{{  $orderfetchval->paymentmethod }}</td>
                                 <td style="color: #dc4146;">{{  $orderfetchval->paymentstatus }}</td>
                                 <td style="color: #4BA345;cursor: pointer;" onclick="getorderdetail({{  $orderfetchval->id }})"><i class="fa fa-map-marker" ></i> <span style="font-weight: 500">View Order</span></td>
                              </tr>
                           </tbody>
                           <?php } ?>
                        </table>
                     </center>
                    </div>
                  <div class="modal fade" id="orderdetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                     <div class="modal-dialog modalacc_doc" role="document">
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
                                       <p class="myaccount_para3">Nashik,Maharsahtra-422012 India</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                       <p style="font-weight: 500;font-size: 15.5px;"><i class="fa fa-angle-double-right" style="color: #dc4146;"></i>  Payment Info :</p>
                                       <p class="myaccount_para4">Status : <span style="color: #dc4146;">Ready for Dispatch</span></p>
                                       <p class="myaccount_para">Mode : COD</p>
                                       
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                       <p style="font-weight: 500;font-size: 15.5px;"><i class="fa fa-angle-double-right" style="color: #dc4146;"></i> Order Summary :</p>
                                       <p class="myaccount_para4">Sub-Total : <span style="float: right;">{{$currency}}.1,693</span></p>
                                       <p class="myaccount_para4">Delivery Fee <span style="float: right;">{{$currency}}.16</span></p>
                                       <p class="myaccount_para4">Express Delivery <span style="float: right;">{{$currency}}.0</span></p>
                                       <hr style="border-bottom: 8px solid #F6F6F6">
                                       <p class="myaccount_total">Total <span style="float: right;">{{$currency}}.1,712</span></p>
                                       <hr style="border-bottom: 8px solid #F6F6F6">
                                    </div>
                                    <div class="col-xl-12">
                                       <button class="myaccount_cancel">Cancel</button>
                                    </div>
                                    
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
        </div>
         
        <div class="col-lg-8 col-md-8 col-sm-8" id="div2" style="display:none;">
	    
	        
            
	        <div class="form-submit" >	
	        
					<h4>My Account</h4>
						<div class="submit-section">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>First Name</label>
									<input type="text" class="form-control" name="firstname">
								</div>
											
								<div class="form-group col-md-6">
								    <label>Last Name</label>
									<input type="text" class="form-control" name="lastname">
								</div>
											
								<div class="form-group col-md-6">
									<label>Email</label>
									<input type="text" class="form-control" name="email">
								</div>
											
								<div class="form-group col-md-6">
									<label>Mobile</label>
									<input type="mobile" class="form-control" name="mobile">
								</div>
											
								<div class="form-group col-md-6">
								    <label>Address</label>
									<input type="text" class="form-control" name="address">
								</div>
											
								
								
								<div class="form-group col-lg-12 col-md-12">
									<button class="btn btn-danger" type="submit">Save</button>
								</div>			
							</div>
							
						</div>
				    </div>
		</div>
        <div class="col-lg-8 col-md-8 col-sm-8" id="div3" style="display:none;">
             <div class="card shadow" style="padding-bottom: 30px;">
                     <h3 style="margin: 13px 0px 30px 22px;font-size: 22px;"> <i class="far fa-address-card" style="color: #4BA345;"></i>&nbsp;Gift Card <span class="addnew_acc"><a href="edit_address.php"><i class="fas fa-plus"></i> Add New Address</a></span></h3>
                     <div class="container-fluid" style="margin-left: 8px;width: 98.6%;">
                        <div class="row" >
                           <div class="col-xl-6">
                              <div class="card">
                                 <div class="card-header">
                                    <b> Kuwar Raman Singh</b>
                                 </div>
                                 <div class="card-body">
                                    <p style="    font-weight: 400;font-size: 15px;color: #666;margin-top: -10px;">Kuwar Raman Singh</p>
                                    <p class="myaccount_para56">Your Local Address</p>
                                    <p class="myaccount_para56">Your Pincode</p>
                                    <p class="myaccount_para56">Your State,Your Country</p>
                                    <p style="font-weight: 400;font-size: 15px;color: #666;margin-top: 1px;">Your Phone Number</p>
                                    <p class="myaccount_para99">Home</p>
                                 </div>
                              </div>
                              <p class="myaccount_add">Set As Default Address <span style="float: right;"><a href="edit_address.php">Edit Address</a></span> </p>
                           </div>
                           <div class="col-xl-6">
                              <div class="card">
                                 <div class="card-header">
                                    <b> Kuwar Raman Singh</b>
                                 </div>
                                 <div class="card-body">
                                    <p style="    font-weight: 400;font-size: 15px;color: #666;margin-top: -10px;">Kuwar Raman Singh</p>
                                    <p class="myaccount_para56">Your Local Address</p>
                                    <p class="myaccount_para56">Your Pincode</p>
                                    <p class="myaccount_para56">Your State,Your Country</p>
                                    <p style="font-weight: 400;font-size: 15px;color: #666;margin-top: 1px;">Your Phone Number</p>
                                    <p class="myaccount_para99">Home</p>
                                 </div>
                              </div>
                              <p class="myaccount_add">Set As Default Address <span style="float: right;"><a href="edit_address.php">Edit Address</a></span> </p>
                           </div>
                        </div>
                     </div>
                  </div>
                </div>
        <div class="col-lg-8 col-md-8 col-sm-8" id="div4" style="display:none;">
             <div class="card shadow" >
                     <h3 style="margin: 13px 0px 30px 22px;font-size: 22px;"> <i class="fa fa-users" style="color: #dc4146;"></i>&nbsp;Customer Service</h3>
                     <div class="container-fluid" style="width: 98%;">
                        <div class="row">
                           <div class="col-xl-3" style="border-right: 1px solid #D4D4D4;margin-bottom: 20px;">
                              <p style="font-size: 17px;font-weight: 500;margin-top: 60px;"><i class="fa fa-envelope-square"></i> Email / Call</p>
                           </div>
                           <div class="col-xl-9">
                              <center>
                                 <p style="font-size: 19px;font-weight: 500;margin-bottom: 30px;"><i class="fa fa-envelope-square"></i> Email</p>
                                 <p style="font-size: 18px;font-weight: 500;">In case of any query, Please contact us to below details</p>
                                 <p style="font-size: 19px;font-weight: 500;">Email will be send to:</p>
                                 <p style="font-size: 19px;font-weight: 500;color: #dc4146;margin-top: -16px;">customercare@xyz.com</p>
                                 <p style="font-size: 19px;font-weight: 500;">OR</p>
                                 <p style="font-size: 19px;font-weight: 500;">Call us at:</p>
                                 <p style="font-size: 19px;font-weight: 500;margin-bottom: 30px;color: #dc4146;margin-top: -16px;">18000800000</p>
                              </center>
                           </div>
                        </div>
                     </div>
                  </div>
            </div>        
    </div>
 </div>
 
 </section>
 
<!-- Footer -->

   @include('front.footer')
   <!-- End -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script>
    function getminus(key)
    {
        var qty = $('#setqty'+key).val();
        var total = parseInt(qty) - 1;
        $('#setqty'+key).val(total);
    }
    function getplus(key)
    {
        var qty = $('#setqty'+key).val();
        var total = parseInt(qty) + 1;
        $('#setqty'+key).val(total);
    }
    function getremoveitem(productid)
    {
        alert(productid);
    }
   

    </script>
<script>
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
    
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
    </script>
    <script>
   $(document).ready(function(){
    
       $('#side1').click(function(){     
           $('#div1').show();  
           $('#div2').hide();  
           $('#div3').hide();  
           $('#div4').hide();  
           $('#side1').css('background-color','#dc3545');    
           $('#side2').css('background-color','white');    
           $('#side3').css('background-color','white');    
           $('#side4').css('background-color','white');    
   
           $('#para1').css('color','white');    
           $('#para2').css('color','black');    
           $('#para3').css('color','black');    
           $('#para4').css('color','black');    
           $('#para5').css('color','black');    
         
       });
   
        $('#side2').click(function(){     
           $('#div1').hide();  
           $('#div2').show();  
           $('#div3').hide();  
           $('#div4').hide();  
           $('#side2').css('background-color','#dc3545');    
           $('#side1').css('background-color','white');    
           $('#side3').css('background-color','white');    
           $('#side4').css('background-color','white');    
           
   
           $('#para2').css('color','white');    
           $('#para1').css('color','black');    
           $('#para3').css('color','black');    
           $('#para4').css('color','black');    
           $('#para5').css('color','black');    
         
       });
   
         $('#side3').click(function(){     
           $('#div1').hide();  
           $('#div2').hide();  
           $('#div3').show();  
           $('#div4').hide();  
           $('#side3').css('background-color','#dc3545');    
           $('#side2').css('background-color','white');    
           $('#side1').css('background-color','white');    
           $('#side4').css('background-color','white');    
   
               $('#para3').css('color','white');    
           $('#para2').css('color','black');    
           $('#para1').css('color','black');    
           $('#para4').css('color','black');    
           $('#para5').css('color','black');    
         
       });
   
          $('#side4').click(function(){     
           $('#div1').hide();  
           $('#div2').hide();  
           $('#div3').hide();  
           $('#div4').show();  
           $('#side4').css('background-color','#dc3545');    
           $('#side2').css('background-color','white');    
           $('#side3').css('background-color','white');    
           $('#side1').css('background-color','white');    
   
               $('#para4').css('color','white');    
           $('#para2').css('color','black');    
           $('#para3').css('color','black');    
           $('#para1').css('color','black');    
           $('#para5').css('color','black');   
         
       });
   
           
     
   });
   function getorderdetail(orderid)
   {
        $.ajax({    
         url: "{{route('front.getorderdetail')}}",
         data:{orderid:orderid},
         success: function(result){
            $("#orderdetails").html(result.html);
            $('#orderdetails').modal('show');
        }
        });
   }
</script>
   
  </body>
</html>