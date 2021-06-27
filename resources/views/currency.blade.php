@include('header')




 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Currency
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Currency</li>
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
            <?php if(isset($editcurrency)){
            print_r($editcurrency);
            ?>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card" style="height: 500px;">
                <div class="card-body">
                  <h4 class="card-title">Edit Currency</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updatecurrency')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editcurrency->id;?>">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Currency name</label>
                      <input type="text" class="form-control" id="name" placeholder="" name="cname" value="<?php echo $editcurrency->cname;?>" required="required">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">International currency code</label>
                      <select id="countries" name="country" value="<?php echo $editcurrency->country;?>" class="form-control">
                                <option>Select Currency Code</option>
                                <?php
                                foreach($currency as $currency)
                                { ?>
                                    <option value="<?php echo $currency->country; ?>"><?php echo $currency->currency; ?>
                                    <?php echo $currency->code; ?>
                                    </option>
                                <?php }
                                ?>
                     </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Use as default for users from countries:</label>
                      <select id="currency-country" name="currencycountry" value="<?php echo $editcurrency->currencycountry;?>" class="form-control">
                          <option value="id">Use as default in all countries</option>
                          <option value="include">Use as default in selected countries</option>
                          <option value="except">Use as default in all currencies except selected</option>
                          
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Include countries</label>
                        <select class="js-example-basic-multiple" multiple="multiple" style="width:100%" id="icountries" name="icountries" value="<?php echo $editcurrency->icountries;?>">
                        <?php
                                foreach($country as $country)
                                { ?>
                                    <option value="<?php echo $country->countrycode; ?>"><?php echo $country->countryname; ?></option>
                                <?php }
                                ?>
                        </select>
                       <h6>Please, select countries where you want to use this currency as default.</h6>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">International currency symbol</label>
                      <input type="text" class="form-control" id="csname" placeholder="" name="csname" value="<?php echo $editcurrency->csname;?>">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputUsername1">Currency position</label>
                      <select id="currency-position" name="currencyposition" value="<?php echo $editcurrency->currencyposition;?>">
                          <option value="left">Left</option>
                          <option value="right">Right</option>
                          <option value="left_space">Left with space</option>
                          <option value="right_space">Right with space</option>
                      </select>
                      <h6>This controls the position of the currency symbol.</h6>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Decimal separator</label>
                      <input type="text" class="form-control" id="dseparator" placeholder="" name="dseparator" value="<?php echo $editcurrency->dseparator;?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Thousand separator</label>
                      <input type="text" class="form-control" id="tseparator" placeholder="" name="tseparator" value="<?php echo $editcurrency->tseparator;?>">
                    </div>
                    <div class="form-group" >
                        <label>Number of decimals</label>
                        <br>
                        <input type="number" id="number" name="number" class="form-control" value="<?php echo $editcurrency->number;?>">
                    </div>
                    <div class="form-group">
                        <label for="currency-rate">Exchange rate</label>
                        <input type="number" id="enumber" name="number" class="form-control">
                        <h6>Currency exchange rate relatively to main shop currency.</h6>
                    </div>
                    <div class="form-group">
                        <label for="currency-rate">Inverted exchange rate</label>
                        <input type="number" id="ernumber" name="number" class="form-control">
                        <h6>Inverted currency exchange rate relatively to main shop currency.</h6>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Update rates with:</label>
                      <select id="currency-updater" name="currency-updater">
                          <option value="selected">Don't update</option>
                          <option value="CurrencylayerUpdater">Currencylayer</option>
                          <option value="FreeCurrencyConverterUpdater">Free Currency Converter</option>
                          
                      </select>
                      <h6>This controls the position of the currency symbol.</h6>
                    </div>
                    <input type="submit" name="get-rates" id="get-rates" class="button" value="Get exchange rate" form="">
                    <i class="fa fa-refresh premmerce-get-currency-rate-spinner"></i>
                    <br>
                    <br>
                    <div class="form-field">
                        <label><input name="currency-display-on-front" id="currency-display-on-front" type="checkbox" value="1" checked="checked"> Available for user on frontend</label>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update Currency</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Add New Currency</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/addcurrency')}}"  enctype="multipart/form-data" id="addcurrencyform">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Currency name</label>
                      <input type="text" class="form-control" id="name" placeholder="" name="currency">
                      <span style="color:red;">{{ $errors->first('currency') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">International currency code</label>
                      <select id="countries" name="code" class="form-control">
                                <option value=""></option>
                                <?php
                                foreach($currency as $currency)
                                { ?>
                                    <option value="<?php echo $currency->country; ?>"><?php echo $currency->currency; ?>
                                    <?php echo $currency->code; ?>
                                    </option>
                                <?php }
                                ?>
                     </select>
                     <span style="color:red;">{{ $errors->first('code') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Use as default for users from countries:</label>
                      <select id="currency-country" name="currency-country" class="form-control">
                          <option value="id">Use as default in all countries</option>
                          <option value="include">Use as default in selected countries</option>
                          <option value="except">Use as default in all currencies except selected</option>
                          <span id="currency-countryerr"></span>
                      </select>
                     
                    <div class="form-group">
                        <label for="exampleInputEmail1">Include countries</label>
                        <select class="js-example-basic-multiple" id="icountry" multiple="multiple" style="width:100%">
                             <option></option>
                        <?php
                                foreach($country as $country)
                                { ?>
                                    <option value="<?php echo $country->countrycode; ?>"><?php echo $country->countryname; ?></option>
                                <?php }
                                ?>
                        </select>
                        <span id="icountryerr"></span>
                       <h6>Please, select countries where you want to use this currency as default.</h6>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">International currency symbol</label>
                      <input type="text" class="form-control" id="csname" placeholder="" name="symbol">
                      <span style="color:red;">{{ $errors->first('symbol') }}</span>
                    </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputUsername1">Status</label>
                      <select name="status" class="form-control">
                          <option></option>
                          <option value="active">Active</option>
                          <option value="inactive">Inactive</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Decimal separator</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="dseparator">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Thousand separator</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="tseparator">
                    </div>
                    <div class="form-group" >
                        <label>Number of decimals</label>
                        <br>
                        <input type="number" name="number" class="form-control">
                    </div>
                    <!--<div class="form-group">-->
                    <!--    <label for="currency-rate">Exchange rate</label>-->
                    <!--    <input type="number" name="number" class="form-control">-->
                    <!--    <h6>Currency exchange rate relatively to main shop currency.</h6>-->
                    <!--</div>-->
                    <!--<div class="form-group">-->
                    <!--    <label for="currency-rate">Inverted exchange rate</label>-->
                    <!--    <input type="number" name="number" class="form-control">-->
                    <!--    <h6>Inverted currency exchange rate relatively to main shop currency.</h6>-->
                    <!--</div>-->
                    <!--<div class="form-group">-->
                    <!--  <label for="exampleInputUsername1">Update rates with:</label>-->
                    <!--  <select id="currency-updater" name="currency-updater">-->
                    <!--      <option value="selected">Don't update</option>-->
                    <!--      <option value="CurrencylayerUpdater">Currencylayer</option>-->
                    <!--      <option value="FreeCurrencyConverterUpdater">Free Currency Converter</option>-->
                          
                    <!--  </select>-->
                    <!--  <h6>This controls the position of the currency symbol.</h6>-->
                    <!--</div>-->
                    <!--<input type="submit" name="get-rates" id="get-rates" class="button" value="Get exchange rate" form="">-->
                    <!--<i class="fa fa-refresh premmerce-get-currency-rate-spinner"></i>-->
                    <!--<br>-->
                    <!--<br>-->
                    <!--<div class="form-field">-->
                    <!--    <label><input name="currency-display-on-front" id="currency-display-on-front" type="checkbox" value="1" checked="checked"> Available for user on frontend</label>-->
                    <!--</div>-->
                    <button type="submit" class="btn btn-gradient-primary mr-2" >Add Currency</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }?>
            <div class="col-md-7 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Data table</h4>
                <div class="row">
                  <div class="col-12">
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Currency </th>
                          <th>Code </th>
                          <th>Symbol</th>
                          <th>LastUpdate</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;foreach($currencydata as $currencyval) {?>
                        <tr>
                          <td><?php echo $i;?></td>
                          
                          
                          <td><?php echo $currencyval->currency;?></td>
                          <td><?php echo $currencyval->code;?></td>
                          <td><?php echo $currencyval->symbol;?></td>
                          <td><?php echo $currencyval->lastupdate;?></td>
                          <td>
                          <a href="{{url('/currencydelete/'.$currencyval->id)}}"><i class="fa fa-trash"></i></a>
                          </td>
                          
                        </tr>
                        <?php $i++; }?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            </div>
           
          </div>
        </div>
@include('footer')
<script>
    function validate()
    {
        alert();
        var name = $('#name').val();
        var countries = $('#countries').val();
        var currency-country = $('#currency-country').val();
        var icountry = $('#icountry').val();
        var csname = $('#csname').val();
        var flag = 0;
        if(name == '')
        {
            $('#nameerr').html('Enter Name');
            $('#nameerr').css('color','red');
            flag = 1;
        }else
        {
            $('#nameerr').html();
            flag = 0;
        }
        if(countries == '')
        {
            $('#countrieserr').html('Upload Image');
            $('#countrieserr').css('color','red');
            flag = 1;
        }else
        {
             $('#countrieserr').html();
            flag = 0;
        }
        if(currency-country == '')
        {
            $('#currency-countryerr').html('Upload Image');
            $('#currency-countryerr').css('color','red');
            flag = 1;
        }else
        {
             $('#currency-countryerr').html();
            flag = 0;
        }
        if(icountry == '')
        {
            $('#icountryerr').html('Upload Image');
            $('#icountryerr').css('color','red');
            flag = 1;
        }else
        {
             $('#icountryerr').html();
            flag = 0;
        }
        if(csname == '')
        {
            $('#csnameerr').html('Upload Image');
            $('#csnameerr').css('color','red');
            flag = 1;
        }else
        {
             $('#csnameerr').html();
            flag = 0;
        }
        
        if(flag == 1)
        {
            
        }else
        {
            $('#addcurrencyform').submit();
        }
        
    }
</script>
