@extends('layout')
@section('content')



    <div style="font-size:25px;text-align: center"><button type="button" class="btn-lg btn-warning" data-toggle="modal" data-target="#add_shipment_modal" onclick="add_shipment()"  style="font-size:20px;padding-top:0px;">Add New Shipment</button></div>
    <br/>
    <hr/>
    <div class="container">
        <div class="row">
            @if($job_shipment!=='null' && $carton_id!=='null' && $carton_content!=='null' && $carton_products!=='null'  )
            @foreach($job_shipment as $job_ship)
                <form id="shipment{{$job_ship->id}}">
                <input type="hidden" name="shipment_id" value="{{$job_ship->id}}" id="shipment_id"/>
                <h4><u>Shipment ID:{{$job_ship->id}}</u></h4>
                <table class="table table-bordered">
                    <tr>
                        <td colspan="4" >
                            <b>Address:</b>{{$job_ship->name}}
                            @if($job_ship->address1!=null)/,{{$job_ship->address1}}@endif
                            @if($job_ship->city!=null)/,{{$job_ship->city}}@endif
                            @if($job_ship->zip!=null)/,{{$job_ship->zip}}@endif
                            <button type='button' class='btn btn-link' style="font-size:14px;padding-top:5px;"  data-toggle="modal" data-target="#search_and_update_contact_modal" onclick="search_and_update_contact('{{$job_ship->id}}')"><b>[&nbsp;..<i class="fas fa-search-plus"></i>&nbsp;<u>Search and update contact</u>..&nbsp;]</b></button>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:5%;">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <label>Name:</label>
                                    </div>
                                    <div class="col-xs-12">
                                        <span style="text-align: center;margin-top:5px;">{{$job_ship->contactFirstName}}&nbsp;{{$job_ship->contactLastName}}</span>
                                    </div>
                                </div>
                            </div>

                        </td>
                        <td style="width:15%;">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-2 job-label" style="text-align: left">
                                        <label>ShipVia:</label>
                                    </div>
                                    <div class="col-xs-12">
                                        <select name="shipVia" style="width:100%" class="form-control selectpicker" data-live-search="true" data-dropup-auto="false">

                                                @foreach( $all_shipvia as $all_ship)

                                                    @php


                                                          $provider = array_unique($all_provider);
                                                    @endphp
                                                    @foreach($provider as $ship_pro)

                                                     @if($all_ship->provider==$ship_pro->id)
                                                        @if($job_ship->shipVia==$all_ship->id)
                                                            <option value="{{$all_ship->id}}" selected>{{$ship_pro->name}} - {{$all_ship->description}} </option>
                                                        @else
                                                            <option value="{{$all_ship->id}}"> {{$ship_pro->name}} - {{$all_ship->description}}  </option>
                                                        @endif
                                                    @endif
                                                    @endforeach

                                            @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td colspan="2" style="width:10%;">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-4 job-label" style="text-align: left;">
                                            <label>Promise Date:</label>
                                        </div>
                                        <div class="col-xs-12">
                                            <input type="hidden" name="promise_date_id[]" value="{{$job_ship->id}}"/>
                                            <input type='text' class="form-control" id="promise_date{{$job_ship->id}}" placeholder="Enter Promise Date" name="promise_date" value='{{$job_ship->promiseDate->toDateString()}}'>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-1 job-label" style="text-align: left">
                                            <label>Note:</label>
                                        </div>
                                        <div class="col-xs-6">
                                            <textarea type="text" name="note" class="form-control">{{$job_ship->notes}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div style="float: right;">
                                    <button type='button' class='btn btn-link' style="font-size:14px;padding-top:0px;" data-toggle="modal" data-target="#assign_shipment_product_modal" onclick="assign_shipment_product('{{$job_ship->id}}')"><b>[&nbsp;..<i class="far fa-plus-square"></i>&nbsp;<u>Assign products to this shipment</u>..&nbsp;]</b></button></div>
                                <table class="table table-bordered">
                                    <tr style="background-color:#e3e3e3;font-size:14px;font-weight: bold;">
                                        <td>Product</td>
                                        <td>Remaining Qty</td>
                                        <td>Shipped Qty</td>
                                        <td>-</td>
                                    </tr>

                                        @for($i=0;$i<count($carton_id);$i++)
                                        @foreach($carton_id[$i] as $cid)
                                            @if($cid->shipment==$job_ship->id)
                                                @foreach($carton_content as $cc)
                                                    @if($cid->id == $cc->carton)
                                                        @php $carton_product = array_unique($carton_products); @endphp
                                                        @foreach($carton_product as $cp)
                                                            @if($cc->jobProduct == $cp->id )

                                        <tr>
                                            <td>
                                                    {{$cp->description}}
                                            </td>
                                            <td>
                                                {{$cp->qtyRemaining}}
                                            </td>
                                            <td>
                                                     {{$cc->quantity}}

                                            </td>
                                            <td><button type="button" class="btn btn-danger" onclick="delete_carton_content('{{$cc->id}}','{{$job_ship->id}}')">Delete</button></td>
                                        </tr>
                                                            @endif

                                                        @endforeach
                                                    @endif
                                                 @endforeach
                                            @endif
                                        @endforeach
                                        @endfor

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="form-group">
                                    <div class="row" style="text-align: center;">
                                        <button type='button' onclick='update_shipment({{$job_ship->id}})' class='btn btn-primary'>Update Shipment</button>
                                        <button type='button' onclick="delete_shipment({{$job_ship->id}})" class='btn btn-danger'>Delete Shipment</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    </form>
                    <hr/>

                @endforeach
                @endif
            </div>

        </div>


        <!-- Create job modal -->
        <div class="modal fade" id="create_job_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title" id="lineModalLabel">Create new job</h3>
                    </div>
                    <div class="modal-body">

                        <!-- content goes here -->
                        <form role="form" method="post" action="create_job">
                            @csrf

                            <div class="form-group">
                                <label for="Customer name">Customer:</label><br/>
                                <!--<input type="text" class="form-control" id="customer_name" placeholder="Enter Customer Name" name="customer_name">-->
                                <select class="selectpicker custname" data-live-search="true" name="customer_name" title="Choose Customer">
                                    @foreach($customerlist as $custlist)
                                        <option value='{{$custlist->id}}'>{{$custlist->custName}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="Job Type">Job Type:</label><br/>
                                <select class="selectpicker jobtype" data-live-search="true" name="job_type">
                                    @foreach($jobtypes as $type)
                                        <option value='{{$type->id}}'>{{$type->description}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="Job Description">Job Descriptioin:</label>
                                <textarea class="form-control" id="job_description" rows="3" name="job_description"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="Job Additional Description">Job Additional Descriptioin:</label>
                                <textarea class="form-control" id="job_additional_description" rows="3" name="job_additional_description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="PO Number">PO Number:</label>
                                <input type="text" class="form-control" id="po_number" placeholder="Enter PO" name="po_number">

                            </div>
                            <div class="form-group">
                                <label for="Quote Number">Quote Number:</label>
                                <input type="text" class="form-control" id="quote_number" placeholder="Enter Quote Number" name="quote_number">

                            </div>
                            <div class="to-group">
                                <label for="Promise Date">Promise Date:</label>
                                <input type="text" class="form-control" id="promise_date" placeholder="Enter Promise Date" name="promise_date" value="">

                            </div>
                            <br/>
                            <div class="btn-group align-middle" role="group">
                                <button type="submit" class="btn btn-lg btn-success center-block">Create Job <i class="fas fa-plus"></i></button>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
       <!-- Create job modal ends -->

        <!--Add Shipment modal-->
        <div class="modal" id="add_shipment_modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <form  id="add_shipment_form" >
                @csrf
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="add_contact_formTitle">Add Shipment</h3>
                            <button type="button" style="margin-top:-40px;" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group" >
                                <div class="row" >
                                    <div class="col-xs-3 job-label text-left" >
                                        <label>Location: </label>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="location" id="location" class="form-control selectpicker" data-live-search="true">
                                        @if($contact_list !=='null')
                                        @foreach($contact_list as $cl)

                                                  <option value='{{$cl->id}}'}}>{{$cl->companyName}}-{{$cl->firstName}}-{{$cl->lastName}}-{{$cl->address1}}-{{$cl->city}}</option>

                                        @endforeach
                                        @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" >
                                <div class="row" >
                                    <div class="col-xs-3 job-label text-left" >
                                        <label>ShipVia: </label>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="shipvia"  id="shipvia" class="form-control selectpicker" data-live-search="true" data-dropup-auto="false">

                                            @foreach($all_shipvia as $all_ship)
                                                @php

                                                   $provider = array_unique($all_provider);

                                                @endphp

                                               @foreach($provider as $ship_pro)
                                                   @if($all_ship->provider==$ship_pro->id)

                                                        <option value="{{$all_ship->id}}" selected> {{$ship_pro->name}}-{{$all_ship->description}} </option>

                                                   @endif
                                                @endforeach

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" >
                                <div class="row" >
                                    <div class="col-xs-3 job-label text-left" >
                                        <label>Promise Date: </label>
                                    </div>
                                    <div class="col-xs-8">
                                        <input type='text' class="form-control" id="add_shipment_promise_date" placeholder="Enter Promise Date" name="add_shipment_promise_date" value=''>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" >
                                <div class="row" >
                                    <div class="col-xs-3 job-label text-left">
                                        <label>Note:</label>
                                    </div>
                                    <div class="col-xs-8">
                                        <textarea type="text" name="note"  class="form-control" id="note"></textarea>
                                    </div>
                                </div>
                            </div>

                            <table class="table" id="shipTable">
                                <tr style="background-color:#5bc0de">
                                    <td scope="col" class="table-head"><b>Line</b></td>
                                    <td scope="col" class="table-head"><b>Product</b></td>
                                    <td scope="col" class="table-head"><b>Remaining Qty</b></td>
                                    <td scope="col" class="table-head"><b>Ship Qty</b></td>
                                    <td></td>
                                </tr>

                                @foreach($job_product as $jp)
                                    @php
                                        $counter=1;
                                        $qtyremaining=$jp->qtyOrdered-$jp->qtyShipped;
                                    @endphp
                                @if($jp->description!='Shipping' && $qtyremaining>0)
                                <tr>
                                    <td style='background-color:#e3e3e3;color:#4b5257;'>{{$counter++}}</td>
                                    <td style='display:none;'>
                                        <input type="hidden" name='product_id[]' value='{{$jp->id}}' />
                                    </td>
                                    <td style='background-color:#e3e3e3;color:#4b5257;'>
                                        <input style='background-color:#e3e3e3;' name='product[]' readonly value='{{$jp->description}}'/>
                                    </td>
                                    <td style='background-color:#e3e3e3;color:#4b5257;'>
                                        <input style='background-color:#e3e3e3;' name='qtyordered[]' readonly id='qtyordered' value='{{$jp->qtyOrdered}}'/>
                                    </td>
                                    <td>
                                        <input name='qtyshipped[]' id='qtyshipped' value='{{$qtyremaining}}'/>
                                    </td>
                                    <td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="x"></td>
                                </tr>
                                @endif
                                @endforeach
                            </table>



                        </div>
                        @if($job_shipment!=='null')
                        <input type='hidden' name='job' value='{{$job_ship->job}}'  id="job"/>
                        @else
                            <input type='hidden' name='job' value='{{$jp->job}}'  id="job" />
                        @endif
                        <div class="modal-footer">
                            <button  id="submit"  class="btn btn-info" style="width:70px;" onclick="submit_add_shipment_form()">Add</button>
                            <button type="button"  data-dismiss="modal" class="btn btn-danger">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!--Update Job Contact modal-->
        <div class="modal" id="search_and_update_contact_modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <form  id="add_contact_form">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="add_contact_formTitle">Update Job Contact</h3>
                            <button type="button" style="margin-top:-40px;" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="false">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group" >
                                <div class="row" >
                                    <div class="col-xs-3 job-label text-left">
                                        <label>Contact:</label>
                                    </div>
                                    <div class="col-xs-12">

                                            <select name="contact" id="contact" class="form-control selectpicker" data-live-search="true">
                                                @if($contact_list !=='null')
                                                    @foreach($contact_list as $cl)

                                                        <option value='{{$cl->id}}'}}>{{$cl->companyName}}-{{$cl->firstName}}-{{$cl->lastName}}-{{$cl->address1}}-{{$cl->city}}</option>

                                                    @endforeach
                                                @endif
                                            </select>


                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($job_shipment!=='null')
                            <input type='hidden' name='job' value='{{$job_ship->job}}'  id="job"/>
                            <input type='hidden' name='contact_ship_id' id='contact_ship_id' />
                        @endif
                        <div class="modal-footer">
                            <button type="button" onclick="submit_add_contact_form()" class="btn btn-info">Update Shipment Contact</button>
                            <button type="button"  data-dismiss="modal" class="btn btn-danger">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!--assign_shipment_product_modal-->
        <div class="modal" id="assign_shipment_product_modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <form  id="assign_product_to_shipment">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" style="margin-top:-40px;" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group" >
                                <div class="row" >
                                    <div class="col-xs-3 job-label text-left">
                                        <label>Product:</label>
                                    </div>
                                    <div class="col-xs-8">


                                        <select name="product" id="assign_product_to_shipment_select_product" class="form-control product" onchange="update_assoc_product_quantity(this.value)">
                                            <option value='None'>Choose A Product</option>
                                            @foreach($job_product as $jp)


                                                @php
                                                    $counter=1;
                                                    $qtyremaining=$jp->qtyOrdered-$jp->qtyShipped;
                                                @endphp
                                                @if($jp->description!='Shipping' && $qtyremaining>0)

                                                      <option value='{{$jp->id}}'>{{$jp->description}}</option>
                                                @endif


                                            @endforeach
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" >
                                <div class="row" >
                                    <div class="col-xs-3 job-label text-left">
                                        Remaining Qty:
                                    </div>
                                    <div class="col-xs-8">
                                        <input type='text' class="form-control" id="assign_product_to_shipment_remaining_quantity" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" >
                                <div class="row" >
                                    <div class="col-xs-3 job-label text-left">
                                        Quantity:
                                    </div>
                                    <div class="col-xs-2">
                                        <input type='text'  class="form-control qty" name='quantity' id="assign_product_to_shipment_shipped_quantity" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type='hidden' id='assign_product_to_shipment_carton' name='carton' >
                        @if($job_shipment!=='null')
                            <input type='hidden' name='job' value='{{$job_ship->job}}'  id="job"/>
                            <input type='hidden' name='shipment_id' id='assign_ship_id'/>
                        @endif
                        <div class="modal-footer">
                            <button type="button" onclick="submit_add_product_to_shipment()" id="submit" class="btn btn-info">Add</button>
                            <button type="button"  data-dismiss="modal" class="btn btn-danger">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script>

            $(function(){

                window.FakeLoader.init();

            });
            window.FakeLoader.init({
                auto_hide: true
            });







            function submit_add_shipment_form(){
                var product=$("input[name='product[]']");
                var qtyordered=$("input[name='qtyordered[]']");
                var qtyshipped=$("input[name='qtyshipped[]']");
                var job=$('#job').val();
                var location=$('#location').val();
                var shipvia=$('#shipvia').val();
                var promise_date=$('#add_shipment_promise_date').val();
                var note=$('#note').val();

                console.log(shipvia,promise_date,note);

                var list = $("input[name='product_id[]']").map(function(index) {
                    return {
                        product_id: $(this).val(),
                        product: product.eq(index).val(),
                        qtyordered: qtyordered.eq(index).val(),
                        qtyshipped:qtyshipped.eq(index).val()
                    };
                }).get()
                list1 = JSON.stringify(list);
                console.log(list1);
                if(location!=null){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type:'POST',
                        url: '/add_shipment',
                        //data:$("#add_shipment_form").serialize(),
                        data:{items:list1,'job':job,'location':location,'shipvia':shipvia,'promise_date':promise_date,'note':note},

                        async: false,
                        success: function(response) {
                         setTimeout(function(){// wait for 5 secs(2)
                                location.reload(); // then reload the page.(3)
                            },1000);
                          //console.log('success');
                        },
                        error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                           console.log(JSON.stringify(jqXHR));
                             console.log("AJAX error: " + textStatus + ' : ' + errorThrown);

                        }
                    });
                }else{
                    alert("Location can't be empty.")
                }
            }

            $("#shipTable").on("click",".ibtnDel",function(event){
                $(this).closest("tr").remove();
            });

            function submit_add_contact_form(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url: '/update_ship_contact',
                    data:$("#add_contact_form").serialize(),
                    async: false,
                    success: function(response) {
                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        },1000);
                        alert('Updated');
                        //console.log('success');
                    },
                    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);

                    }
                });
            }

            function update_assoc_product_quantity(id){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                    $.ajax({
                        type:'POST',
                        url: '/get_product_quantity',
                        data:{product:id},
                        async: false,
                        success: function(data) {
                            //console.log(data);
                            $.each(data, function (index, value) {
                             // console.log(value.qtyRemaining);
                                $("#assign_product_to_shipment_remaining_quantity").val(value.qtyRemaining);
                                $("#assign_product_to_shipment_shipped_quantity").val(value.qtyShipped);
                            })
                            //$("#assign_product_to_shipment_remaining_quantity").val(data.qtyRemaining);
                            //$("#assign_product_to_shipment_shipped_quantity").val(data.qtyshipped);
                        },
                        error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);

                        }
                    });

            }
            function assign_shipment_product(shipment_id){
                //console.log(shipment_id);
                $("#assign_ship_id").val(shipment_id);
            }

            function submit_add_product_to_shipment(){
                var job=$('#job').val();
                var shipment_id=$('#assign_ship_id').val();
                var qty=$('.qty').val();
                var product=$('.product').val();

                console.log(job,shipment_id,qty);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url: '/assign_shipment_product',
                    data:{job:job,shipment_id:shipment_id,qty:qty,product:product},
                    async: false,
                    success: function(response) {
                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        },1000);
                        //console.log('success');

                    },
                    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);

                    }
                });
            }

            function search_and_update_contact(contact_shipment_id){
                $("#contact_ship_id").val(contact_shipment_id);
            }

            function delete_carton_content(id,ship_id){
                var content_id=id;
                var carton_shipment_id=ship_id;
                //console.log(content_id,carton_shipment_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url: '/delete_carton_content',
                    data:{content_id:content_id},
                    async: false,
                    success: function(response) {
                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        },1000);
                        //console.log('success');

                    },
                    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);

                    }
                });
            }

            function delete_shipment(id){
                var shipment_id=id;
                //alert('Please delete the products first!!');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url: '/delete_shipment',
                    data:{shipment_id:shipment_id},
                    async: false,
                    success: function(response) {
                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        },1000);
                        //console.log('success');

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Please delete the products first!!');// What to do if we fail
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);

                    }
                });
            }

            function update_shipment(id){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url: '/update_shipment',
                    data:$("#shipment"+id).serialize(),
                    async: false,
                    success: function(response) {
                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        },1000);
                        //console.log('success');

                    },
                    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);

                    }
                });
            }


            $(function() {
                var els = document.getElementsByName("promise_date_id[]");

                for (var i = 0; i < els.length; i++){

                    var date=$("#promise_date"+els[i].value).val();
                    var Datee =date;
                    var Date =moment(Datee).format('MM/DD/YYYY');

                    $("#promise_date"+els[i].value).daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        minYear: 2018,
                        maxYear: parseInt(moment().format('YYYY'),10)
                    })


                    $("#promise_date"+els[i].value).data('daterangepicker').setStartDate(Date);

                }


            });
            $(function() {
                $('input[name="add_shipment_promise_date"]').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,
                    maxYear: parseInt(moment().format('YYYY'),10)
                });
            });

        </script>
    @endsection