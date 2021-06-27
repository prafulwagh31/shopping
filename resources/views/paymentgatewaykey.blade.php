@include('header')



    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                  Categories
                </h3>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payment Gateway Keys</li>
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
           
                <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Update Payment Gatway Details</h4>
                  
                    
                  <form class="" method="POST" action="{{ url('/updatepaymentgatewaykeys')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     
                    <div class="form-group">
                      <label for="exampleInputUsername1">Pyapal Api  Key</label>
                      <input type="text" class="form-control" id="exampleInputUsername1"  name="paypalapikey" value="<?php echo $paymentdata->paypal_api_key;?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Pyapal Api Secret Key</label>
                      <input type="text" class="form-control" id="exampleInputUsername1"  name="paypalsecretapikey" value="<?php echo $paymentdata->paypal_secret_key;?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Razorpay Api  Key</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="razorpayapikey" value="<?php echo $paymentdata->razorpay_api_key;?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Razorpay Api Secret Key</label>
                      <input type="text" class="form-control" id="exampleInputUsername1"  name="razorpaysecretapikey" value="<?php echo $paymentdata->razorpay_secret_key;?>">
                    </div>
                 
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update Payment Details</button>
                    
                  </form>
                </div>
              </div>
            </div>
            </div>
        </div>
    </div>