@include('header')

<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <style type="text/css">
                .autocomplete {
                  /*the container must be positioned relative:*/
                  position: relative;
                  display: inline-block;
                }
                input {
                  border: 1px solid transparent;
                  background-color: #f1f1f1;
                  padding: 10px;
                  font-size: 16px;
                }
                input[type=text] {
                  background-color: #f1f1f1;
                  width: 100%;
                }
                input[type=submit] {
                  background-color: DodgerBlue;
                  color: #fff;
                }
                .autocomplete-items {
                  position: absolute;
                  border: 1px solid #d4d4d4;
                  border-bottom: none;
                  border-top: none;
                  z-index: 99;
                  /*position the autocomplete items to be the same width as the container:*/
                  top: 100%;
                  left: 0;
                  right: 0;
                }
                .autocomplete-items div {
                  padding: 10px;
                  cursor: pointer;
                  background-color: #fff;
                  border-bottom: 1px solid #d4d4d4;
                }
                .autocomplete-items div:hover {
                  /*when hovering an item:*/
                  background-color: #e9e9e9;
                }
                .autocomplete-active {
                  /*when navigating through the items using the arrow keys:*/
                  background-color: DodgerBlue !important;
                  color: #ffffff;
                }
            </style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Purchase Order
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Purchase Order</li>
              </ol>
            </nav>
          </div>
            <div class="row">
               <div class="col-md-12"> 
               @if(session()->has('error_message'))
                <center><div class="alert alert-danger">{{ session('error_message') }}</div></center>
                @endif
                @if(session()->has('success_message'))
                <center><div class="alert alert-success">{{ session('success_message') }}</div></center>
                @endif</div>
            </div>
          
          
            
           
                <form class="" method="POST" action="{{ url('/addtransfer')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                  <input type="hidden" name="count" id="count" value="0">     
                <div class="row">
                    <div class="col-md-10 col-sm-10">
                        <div class=" grid-margin stretch-card">
                        <div class="card">
                        <div class="card-body" style="">
                        <h4 class="card-title"> Purchase Order </h4>
                         <input type='button' value='Delete' id='delete'><br><br>
                        <table id="" class="table">
                            
                          <thead>
                            <tr>
                              <th><input type="checkbox" id="checkAll"></th>
                              
                             
                              <th>Name </th>
                              <th>Qunatity </th>
                              <th>Price</th>
                              <th>Tax Percentage</th>
                              <th>Tax</th>
                              <th>Tax Type</th>
                              <th>Purchase Price</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody id="transferdata">
                              
                           <?php
                          
                           $i = 1;foreach($stock as  $stock){
                                $productdata = DB::table('tbl_product')->where(array('id' => $stock->productid))->first();
                                $media = '';
                                $inventory  = DB::table('tbl_inventory')->where(array('product_id' => $stock->productid))->first();
                                if($productdata != '')
                                {
                                    if($productdata->product_media != '')
                                    {
                                        $mediadata = explode(',',$productdata->product_media);
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
                             
                               
                            ?>
                           
                           
                            <tr>
                            <td><input type='checkbox' id='del_<?php if(isset($product->id)) { echo $product->id;}?>' name="addcheckdata[]"></td>
                         
                            <!--<td>-->
                            <!--<img src="{{ $media }}" style="height:100px;width:100px;" >-->
                            <!-- </td>-->
                            <td style="width:250px;" >
                                @if(isset($custom_products->id))
                                 <input type="hidden" class="form-control" name="productid[]"value="{{$custom_products->id}}">
                                   <input type="hidden" class="form-control" name="product_type"value="custom">
                                    <input type="hidden" class="form-control" name="proposalid"value="{{$proposalid}}">
                                <input type="text" class="form-control" value="{{$custom_products->productname}}">
                                @else
                                 <input type="hidden" class="form-control" name="proposalid"value="0">
                                  <input type="hidden" class="form-control" name="product_type"value="simple">
                                <select name="productid[]" class="form-control" name="selectproductdata[]" onchange="getprice(this,{{$i}});">
                                    <option>Select Product</option>
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->product_name}}</option>
                                    @endforeach
                                </select>
                                @endif
                            </td>
                            <td><input type="text" name="qty[]" id="qty0" class="form-control" style="width:100px;" value="1"></td>
                           <td><input type="text" name="price[]" id="price0" class="form-control" style="width:100px;" onchange="gettotal(this)" value="@if(isset($custom_products->price)){{$custom_products->price}}@endif"></td>
                           <td><input type="text" name="taxpercentage[]" id="taxpercentage0" class="form-control" style="width:100px;"></td>
                           <td style="width:200px;"><select name="tax[]" id="tax0" class="form-control">
                               <option>Select Tax</option>
                               <?php foreach($tax as $taxdata) {?>
                               <option value="{{ $taxdata->id }}" @if(isset($custom_products->tax)) @if($custom_products->tax == $taxdata->id) selected @endif @endif>{{ $taxdata->tax_name }}</option>
                               <?php }?>
                           </select></td>
                           <td style="width:200px;"><select name="taxtype[]" id="taxtype0" class="form-control"><option>Select Tax Type</option><option value="including" @if(isset($custom_products->taxtype))@if($custom_products->taxtype == 'including') selected @endif @endif >Inclusive</option><option value="excluding" @if(isset($custom_products->taxtype))@if($custom_products->taxtype == 'excluding') selected @endif @endif>Exclusive</option></select></td>
                           <td  style="width:200px;"><input type="text" class="form-control" name="purchaseprice[]" id="purchaseprice0"></td>
                            <td style="width:50px;"><i class="fa fa-trash" ></i></td>
                            
                            
                            </tr>
                            <?php $i++;}?>
                            <input type="hidden" name="countdata" id="countadta" value="<?php  echo $i;?>">
                          </tbody>
                        </table>
                      </div>
                      <div class="row" style="margin-bottom: 5px; padding-right: 555px; padding-left: 32px;color:#73aaef">
                          <a class="btn btn-default" onclick="addproducts()" type="button"> <i class="fa fa-plus"></i> Add Product </a>
                          <a class="btn btn-default" onclick="addservices()" type="button"><i class="fa fa-plus"></i>  Add Transport Service </a>
                      </div>
                      <div class="row" style="margin-bottom: 5px; padding-right: 555px; padding-left: 32px;">
                          
                      </div>
                    </div>
                  </div>
                        <div class=" grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body" style="">
                                <h4 class="card-title"> Purchase Order Details </h4>
                                    <div class="row">
                                        <div class="col-md-4">Items Sub Total</div>
                                        <div class="col-md-4" ><input type="text" class="form-control" name="itemtotal" id="itemtotal"></div>
                                        <div class="col-md-4"></div>
                                    </div>
                                    <div class="row" style="padding-top:10px">
                                        <div class="col-md-4" >Items Tax</div>
                                        <div class="col-md-4"><input type="text" class="form-control" name="itemtax" id="itemtax"></div>
                                         <div class="col-md-4"></div>
                                    </div>
                                    <div class="row" style="padding-top:10px">
                                        <div class="col-md-4" >Items Total</div>
                                        <div class="col-md-4"><input type="text" class="form-control" name="itemfinaltotal" id="itemfinaltotal"></div>
                                         <div class="col-md-4"></div>
                                    </div>
                                    <div class="row" style="padding-top:10px">
                                        <div class="col-md-4" >Transport Service total</div>
                                        <div class="col-md-4"><input type="text" class="form-control" name="transporttotal" id="transporttotal" onchange="getgrandtotal()"></div>
                                         <div class="col-md-4"></div>
                                    </div>
                                    <div class="row" style="padding-top:10px">
                                        <div class="col-md-4" >Overall discount %</div>
                                        <div class="col-md-4"><input type="text" class="form-control" name="overalldiscount" id="overalldiscount" onchange="getgrandtotal()" value="0"></div>
                                         <div class="col-md-4"></div><br>
                                    </div>
                                    <div class="row" style="padding-top:10px">
                                         <div class="col-md-4">Grand total</div>
                                        <div class="col-md-4"><input type="text" class="form-control" name="grand_total" id="grand_total"></div>
                                    </div>
                               
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Origin </h4>
                        <h5>Supplier</h5>
                        <select class="form-control" name="suppliername" >
                            <option>Select Supplier</option>
                            <?php foreach($suppliers as $supplier){?>
                            <option value="{{ $supplier->id }}">{{ $supplier->leadname }}</option>
                            <?php }?>
                        </select>
                        </div>
                        </div>
                        <br><br>
                        <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Shipment </h4>
                        <h5>Expected arrival</h5>
                        <input type="date" name="expectedarrival" class="form-control">
                        </div>
                        </div>
                        <br><br>
                        <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Additional details </h4>
                        <h5>Reference number</h5>
                        <input type="text" name="refernecenumber" class="form-control">
                        </div>
                        </div>
                        <br><br>
                        <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Tags </h4>
                        
                        <input type="text" name="tags" class="form-control" placeholder="Urgent,COD">
                        </div>
                        </div>
                    </div> 
                   
            
                </div>
             
                <hr>
                <div class="row">
                    
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                    <button type="button" name="" class="btn-gradient-primary" >Cancel</button>
                    </div>
                    <div class="col-md-2">
                    <button type="submit" name="addtransfer" >Save Transfer</button>
                    </div>
                </div>
                </form>
           
          
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
@include('footer')
<script>
    function addproducts()
    {

      var count = $('#count').val();
      var increment = parseInt(count) + 1;
      alert(increment);
        var arrayFromPHP = <?php echo json_encode($products); ?>;
       
        var html = '<option value="0">Select Product</option>';
        for (var i = 0; i < arrayFromPHP.length; i++) {
           
             html += '<option value="'+arrayFromPHP[i]['id']+'">'+arrayFromPHP[i]['product_name']+'</option>';
        }
       
        var taxdata = <?php echo json_encode($tax);?>;
        var taxhtml = "<option value='0'>Select Tax</option>";
         for (var j = 0; j < taxdata.length; j++) {
           
             taxhtml += '<option value="'+taxdata[j]['id']+'">'+taxdata[j]['tax_name']+'</option>';
        }
        var finalhtml = ' <tr id="compositremovediv"><td><input type="checkbox" name="addcheckdata[]"></td>'+
                           
                            '<td style="width:250px;" ><select name="productid[]" class="form-control" name="selectproductdata[]" onchange="getprice(this,'+increment+')">'+
                               html+
                               
                            '</select>'+
                            '</td> '+
                             '<td><input type="text" name="qty[]" id="qty'+increment+'" class="form-control" style="width:100px;" value="1"></td>'+
                            '<td><input type="text" name="price[]" id="price'+increment+'" class="form-control" style="width:100px;"  onchange="gettotal(this)"></td>'+
                            '<td><input type="text" name="taxpercentage[]" id="taxpercentage'+increment+'" class="form-control" style="width:100px;"></td>'+
                            '<td style="width:230px;"><select name="tax[]"  id="tax'+increment+'" class="form-control">'+ 
                             taxhtml+
                             '</select>'+
                             '</td>'+
                            '<td style="width:200px;"><select name="taxtype[]" id="taxtype'+increment+'" class="form-control"><option>Select Tax Type</option><option value="including">Inclusive</option><option value="excluding">Exclusive</option></select>'+
                             '</td>'+
                                    '   <td  style="width:200px;"><input type="text" class="form-control" name="purchaseprice[]" id="purchaseprice'+increment+'"></td>'+
                                    '<td style="width:50px;" class="remove_button"><i class="fa fa-trash" ></i></td></tr>';

        $('#transferdata').append(finalhtml);
        $('#count').val(increment);
    }
    $(document).on('click', '.remove_button', function () {
      
        $(this).closest('#compositremovediv').remove();
    });
    function getgrandtotal()
    {
        var itemfinaltotal = $('#itemfinaltotal').val();
        var transporttotal = $('#transporttotal').val();
        var overalldiscount = $('#overalldiscount').val();
        var subtotal = parseFloat(itemfinaltotal) + parseFloat(transporttotal) - parseFloat(overalldiscount)/100;
        $('#grand_total').val(subtotal);
    }
</script>
<script>
    function addservices()
    {
        var totqty = 0;
        $('input[name^="qty"]').each(function() {
           var qty = $(this).val();
           totqty += parseInt(qty);
        });
        console.log(totqty);
        var arrayFromPHP = <?php echo json_encode($products); ?>;
       
        var html = '';
        for (var i = 0; i < arrayFromPHP.length; i++) {
           
             html += '<option value="'+arrayFromPHP[i]['id']+'">'+arrayFromPHP[i]['product_name']+'</option>';
        };
        var finalhtml = ' <tr id="servicesremovediv"><td><input type="checkbox" name="addcheckdata[]"></td>'+
                           
                            '<td><input type="text"  class="form-control" name="service[]" style="width:230px;"></td>'+
                             '<td><input type="text" name="quantity" id="quantity" class="form-control" style="width:100px;" value="'+totqty+'"></td>'+
                            '<td><input type="text" name="serviceprice[]" id="serviceprice" class="form-control" style="width:100px;" onchange="getserviceprice()"></td>'+
                            '<td style="width:230px;">'+
                             '</td>'+
                            '<td style="width:200px;">'+
                             '</td>'+
                                    '<td></td><td></td>'+
                                    '<td style="width:50px;" class="remove_button"><i class="fa fa-trash" ></i></td></tr>';

        $('#transferdata').append(finalhtml);
        

    }
    $(document).on('click', '.remove_button', function () {
      
        $(this).closest('#servicesremovediv').remove();
    });
    function gettotal(the)
    {
            var total = 0;
           
            $('input[name^="price"]').each(function() {
               var price = $(this).val();
               total += parseInt(price);
            });
           $('#itemtotal').val(total);
           
           var taxtotal = 0;
           
            $('input[name^="taxpercentage"]').each(function() {
               var taxpercentage = $(this).val();
               taxtotal += parseInt(taxpercentage);
            });
           $('#itemtax').val(taxtotal);
           var itemtotalfinal = parseFloat(total) * parseFloat(taxtotal)/100;
           var finalitemprice = parseFloat(itemtotalfinal) + parseFloat(total);
           $('#itemfinaltotal').val(finalitemprice);
           var transporttotal = $('#transporttotal').val();
        var overalldiscount = $('#overalldiscount').val();
     
        
        var subtotal = parseFloat(finalitemprice)  + parseFloat(transporttotal) - parseFloat(overalldiscount)/100;
        
        $('#grand_total').val(subtotal);
    }
    function getserviceprice()
    {
          var quantity = $('#quantity').val();
          var servicetotal = 0;
           
            $('input[name^="serviceprice"]').each(function() {
               var serviceprice = $(this).val();
               servicetotal += parseInt(serviceprice);
            });
           
           $('#transporttotal').val(servicetotal);
            var taxtotal = 0;
           
            $('input[name^="taxpercentage"]').each(function() {
               var taxpercentage = $(this).val();
               taxtotal += parseInt(taxpercentage);
            });
           $('#itemtax').val(taxtotal);
        var purchaseprice =   parseFloat(servicetotal) / parseFloat(quantity);
       
        var count = $('#count').val();
        var productprice = 0;
        for(i = 0; i <= count; i++)
        {
            var price = $('#price'+i+'').val();
           
            $('#purchaseprice'+i+'').val(parseFloat(purchaseprice) + parseFloat(price));
        }

         $('input[name^="price"]').each(function() {
           
               productprice += parseInt( $(this).val());
            });
         var itemtotalfinal = parseFloat(productprice) * parseFloat(taxtotal)/100;

          $('#itemtotal').val(parseFloat(productprice));
          $('#itemfinaltotal').val(parseFloat(itemtotalfinal) + parseFloat(productprice));

      
       
        var transporttotal = $('#transporttotal').val();
        var overalldiscount = $('#overalldiscount').val();

       
        var subtotal = parseFloat(itemtotalfinal) + parseFloat(productprice) + parseFloat(transporttotal) - parseFloat(overalldiscount)/100;
         alert(subtotal);
        $('#grand_total').val(subtotal);
       
    }
</script>
<script>
    $(document).ready(function(){

  $('#delete').click(function(){

    var post_arr = [];

    // Get checked checkboxes
    $('#order-listing input[type=checkbox]').each(function() {
      if (jQuery(this).is(":checked")) {
        var id = this.id;
        var splitid = id.split('_');
        var postid = splitid[1];

        post_arr.push(postid);
        
      }
    });
$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    if(post_arr.length > 0){

        var isDelete = confirm("Do you really want to delete records?");
        if (isDelete == true) {
           // AJAX Request
           $.ajax({
              url: "{{ route('deletemultipleproductdata') }}",
              type: 'POST',
              data: { post_id: post_arr},
              success: function(response){
                 $.each(post_arr, function( i,l ){
                     $("#tr_"+l).remove();
                 });
              }
           });
        } 
    } 
  });
 
});
$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
        function getproduct() {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            
            var product = $('#tags').val();
            var countdata = $('#countadta').val();
            var sum=0;
            var settings = {
              "url": "{{ route('getproductdata') }}",
              
              "method": "POST",
              "data": {
                "product" : product,
                "countdata": countdata,
               
              },
            };

            $.ajax(settings).done(function (response) {
                $('#transferdata').append(response);
                $('#countdata').val(parseFloat(countdata)+1);
              
             
                // var countdata = $('#countdata').val();
                // var countsmaple = parseInt(countdata)+1;
                // var htmlarray = '';
                // var qty = 1;
                // var image = obj.data['product_media'].split(',');
                // var implodedArray = productarray.join(',');
                // $('#productidarray').val(implodedArray);
                // $('#pricearray').val(pricearray);
                // var previousprice = $('#sum').val();
                // $('#countdata').val(countsmaple)
                //     htmlarray = '<tr><td>1</td><td><img src="https://rasheedmohammed.com/shoppingcat/public/productimg/'+image[0]+'" style="width:200px;height:150px;"></td><td>'+obj.data['product_name']+'</td><td>'+obj.data['sale_price']+'</td><td><input type="text" name="qty" id="qty'+countdata+'" value="1"></td><td><input type="text" class="form-control" value="'+obj.data['sale_price'] * qty+'"></td></tr>';
                //     $('#sum').val(parseInt(previousprice)+parseInt(obj.data['sale_price']));
                //     $('#subtotal').val(parseInt(previousprice)+parseInt(obj.data['sale_price']));
                //     $('#total').val(parseInt(previousprice)+parseInt(obj.data['sale_price']));
                //     $('#completesale').val(parseInt(previousprice)+parseInt(obj.data['sale_price']));
                //     $('#needdata').append(htmlarray);
              
            });
           
        }
</script>
<script type="text/javascript">
    $('.btnRemoveMember').closest('td').remove();
    var sercharray = [];
      var settings = {
          "url": "https://thadathilfarmresort.com/shoppingcat/api/searchproductlist",
          
          "method": "GET",
          "data": {},
        };

        $.ajax(settings).done(function (response) {
          var obj = JSON.parse(response);
          if(obj.code == 200)
          {
            
            
            for(var i = 0; i< obj.data.length; i++)
            {
                sercharray.push(obj.data[i]['product_name']);
            }
            
          }else
          {
            
          }
        });
        autocomplete(document.getElementById("tags"), sercharray);
       function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
              b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}
function getprice(the,countadta)
{
        var count = countadta;
        alert(count);
        var productid = $(the).val();
        var itemtotal = $('#itemtotal').val();
       
        var producttype = 1;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('getproductdeatils') }}", 
            type:"POST",
            data:{productid: productid,producttype:producttype},
            success: function(result){
                var obj = JSON.parse(result);
               
                if(obj.saleprice != null)
                {
                  $('#price'+count+'').val(obj.saleprice);
                }else 
                {
                  $('#price'+count+'').val(0);
                }
            
            $('#purchaseprice'+count+'').val(0);
            var itemtot = 0;
            if(itemtotal == '')
            {
                itemtot = obj.saleprice;
            }
            else
            {
               itemtot = parseFloat(itemtotal) + parseFloat(obj.saleprice);
            }
            
            $('#itemtotal').val(itemtot);
            $('#taxtype'+count+'').html(obj.taxtype);
            $('#taxpercentage'+count+'').val(obj.tax);
            $('#tax'+count+'').html(obj.taxfinaltype);
            $('#transporttotal').val(0);
            
             var taxtotal = 0;
           
            $('input[name^="taxpercentage"]').each(function() {
               var taxpercentage = $(this).val();
               taxtotal += parseInt(taxpercentage);
            });
           $('#itemtax').val(taxtotal);
            // $('#heightcustom').html(obj.htmldata);
            
            var itemtotalfinal = parseFloat(itemtot) * parseFloat(taxtotal)/100;
           var finalitemprice = parseFloat(itemtotalfinal) + parseFloat(itemtot);
           $('#itemfinaltotal').val(finalitemprice);
           $('#grand_total').val(finalitemprice);
           
            
        }
            
        });
   
}
function getdelete(the)
{
    $(the).closest('tr').remove();
  
}
$(function () {
  $("select").select2();
});
  </script>


