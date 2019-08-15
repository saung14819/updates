@extends('layout')
@section('content')

    <style>
        .navbar_top{
            background:#636b6f;
            border: none;

        }

        .nav>li>a, .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover, .dropdown-menu>li>a, .dropdown-menu>li{
            border-bottom: 3px solid transparent;
        }
        .nav>li>a:focus, .nav>li>a:hover,.nav .open>a, .nav .open>a:focus, .nav .open>a:hover, .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover{
            border-bottom: 3px solid transparent;
            background: rgba(154, 154, 154, 0.27);
        }
        .navbar_top a {
            color: #fff;
        }


        .navbar_top li:hover:nth-child(8n+1), .navbar_top li.active:nth-child(8n+1){
            border-bottom: #b6f423 4px solid;
        }
        .navbar_top li:hover:nth-child(8n+2), .navbar_top li.active:nth-child(8n+2){
            border-bottom: #761b18 4px solid;
        }
        .navbar_top li:hover:nth-child(8n+3), .navbar_top li.active:nth-child(8n+3){
            border-bottom: #f8b42c 4px solid;
        }
        .navbar_top li:hover:nth-child(8n+4), .navbar_top li.active:nth-child(8n+4){
            border-bottom: #fd594a 4px solid;
        }
        .navbar_top li:hover:nth-child(8n+5), .navbar_top li.active:nth-child(8n+5){
            border-bottom: #e8479d 4px solid;
        }
        .navbar_top li:hover:nth-child(8n+6), .navbar_top li.active:nth-child(8n+6){
            border-bottom: #a12eeb 4px solid;
        }
        .navbar_top li:hover:nth-child(8n+7), .navbar_top li.active:nth-child(8n+7){
            border-bottom: #4785d9 4px solid;
        }
        .navbar_top li:hover:nth-child(8n+8), .navbar_top li.active:nth-child(8n+8){
            border-bottom: #761b18 4px solid;
        }

        .navbar_top-toggle .icon-bar{
            color: #fff;
            background: #000000;
        }


        .modal-footer .btn-group button {
            height:40px;
            border-top-left-radius : 0;
            border-top-right-radius : 0;
            border: none;
            border-right: 1px solid #ddd;
        }

        .modal-footer .btn-group:last-child > button {
            border-right: 0;
        }

        #exTab1 .tab-content {
            color : white;
            background-color: #428bca;
            padding : 5px 15px;
        }

        #exTab2 h3 {
            color : #0d0d0d;
            /*background-color: #428bca;*/
            padding : 5px 15px;
        }

        /* remove border radius for the tab */

        #exTab1 .nav-pills > li > a {
            border-radius: 0;
        }

        /* change border radius for the tab , apply corners on top*/

        #exTab3 .nav-pills > li > a {
            border-radius: 4px 4px 0 0 ;
        }

        #exTab3 .tab-content {
            color : white;
            background-color: #428bca;
            padding : 5px 15px;
        }

        th{
            width: 15%;
        }
        .smalltd{
            width:2%;
        }
        .modal-backdrop {
            z-index: -1;
        }
        .modal-header {
            padding-bottom: 5px;
        }

        .modal-footer {
            padding: 0;
        }

        .modal-footer .btn-group button {
            height:40px;
            border-top-left-radius : 0;
            border-top-right-radius : 0;
            border: none;
            border-right: 1px solid #ddd;
        }

        .modal-footer .btn-group:last-child > button {
            border-right: 0;
        }
        .stepwizard-step p {
            margin-top: 10px;
        }
        .stepwizard-row {
            display: table-row;
        }
        .stepwizard {
            display: table;
            width: 50%;
            position: relative;
        }
        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }
        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #428bca;
            z-order: 0;
        }
        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }
        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }


    </style>
    <div class="navbar-wrapper">
        <div class="container-fluid">
            <nav class="navbar_top navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">

                        <img src="http://tkgraphics.ca/wp-content/uploads/2019/04/tklogo_small_2.png"/>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">

                        <ul class="nav navbar-nav pull-right">
                            <li><a data-target="#create_job_modal" data-toggle="modal" class="active" id="MainNavHelp"
                                   href="#create_job_modal"  role="button" aria-haspopup="true" ><i class="fas fa-plus"></i> Create new job </a></li>
                            <li><a href="{{route('pace.show_list')}}" class="active"  role="button" aria-haspopup="true" ><i class="fas fa-th-list"></i> Open Job List</a></li>

                            <li>
                                <a href="#"><b>CSR <i class="far fa-user"></i> :</b>  @php echo $username=session()->get('user_name'); @endphp </a>

                            </li>

                            <li class=""><a href='{{route('pace.logout')}}'>Logout <i class="fas fa-sign-out-alt"></i></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h2><u>Job Detail</u></h2>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <!--<h2 class="text-danger">Approve User</h2>-->


                            <table class="table success">

                                <tr >
                                    <th class="info">Job Number</th>
                                    <td><b>{{$jobs->job}}</b>&nbsp;<button data-toggle="modal" data-target="#dup_job_modal" class="btn btn-md btn-success ">Duplicate Job</button></td>
                                </tr>
                                <tr>
                                    <th class="info">Customer</th>
                                    @foreach($customers as $cus)
                                        <td>{{$cus->custName}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th class="info">Job Type</th>
                                    <td>
                                        @foreach($jobtype as $type)
                                            {{$type->description}}
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th class="info">Job Status</th>

                                    <td>@foreach($jobstatus as $status){{$status->description}}@endforeach</td>
                                </tr>

                                <tr>
                                    <th class="info">CSR</th>
                                    <td>@foreach($csr as $c){{$c->name}}@endforeach</td>
                                </tr>
                                <tr>
                                    <th class="info">Job Description</th>
                                    <td>{{$jobs->description}}</td>
                                </tr>
                                <tr >
                                    <th  class="info">Job Additional Description</th>
                                    <td>{{$jobs->description2}}</td>
                                </tr>
                                <tr>
                                    <th valign="top" class="info">PO Number</th>
                                    <td>{{$jobs->poNum}}</td>
                                </tr>
                                <tr>
                                    <th class="info">Quote Number</th>
                                    <td>{{$jobs->reference}}</td>
                                </tr>
                                <tr>
                                    <th class="info">Promise Date</th>
                                    <td>@if($jobs->promiseDate!==null){{$jobs->promiseDate->toDateString()}}@endif</td>
                                </tr>

                                <tr>
                                    <th class="info">Amount to Invoice</th>
                                    <td><b>{{number_format((float)$jobs->amountToInvoice, 2, '.', '')}}</b></td>
                                </tr>
                                <tr >
                                    <th colspan="1"></th>
                                    <td>
                                        <input type="hidden" name="hidden_id" id="hidden_id" value="">
                                        <!--<input type="button" id="approve_btn" class="btn btn-info" name="approve_btn" value="Edit Job Detail">-->
                                        <button data-toggle="modal" data-target="#update_job_modal" class="btn btn-lg btn-primary center-block"><i class="far fa-edit"></i> Edit Job Detail</button>

                                    </td>

                                </tr>




                            </table>

                        </div>


                    </div>

                </div>

            </div>

            <!--Job Contact Block Start-->
            <div class="col-md-6">
                <h3><u>Job Contact</u></h3>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">

                            <form  method="post" action="{{ action('PaceController@add_contact') }}">
                                @csrf
                                <input type="hidden" name="job_number" value="{{$jobs->job}}"/>
                                <input type="hidden" name="job_type" value="{{$jobs->jobType}}"/>
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="info"><h5><b>Bill to:</b></h5></td>
                                        <td>



                                            <div class="input_fields_wrap2">

                                                @if($billto!==0)
                                                    @foreach($billto as $bt)
                                                        @php $i=0; @endphp
                                                        @if(!empty($jbcontactid))

                                                            <div>

                                                                <div class="row"><div class="col-md-8">

                                                                        <ul><li><b>First Name:</b>{{$bt->firstName}}<br/><b>Last Name:</b>{{$bt->lastName}}<br/><b>Address:</b>{{$bt->address1}}</li></ul>
                                                                    </div>



                                                                    <a href="{{ url('/destroy/'.$jbcontactid[$i].'/'.$jobs->job) }}" ><i class="far fa-trash-alt"></i> Remove Contact</a>

                                                                </div>

                                                            </div>


                                                        @endif
                                                        @php $i++ @endphp
                                                    @endforeach

                                                @endif

                                            </div>

                                            <p>
                                                <a data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample" class="add_field_button2 btn btn-info">
                                                    +Add New Bill To Contact
                                                </a>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="info"><h5><b>Ship to :</b></h5></td>
                                        <td> <div class="input_fields_wrap">
                                                @if($shipto!==0)
                                                    @php $i=0; @endphp
                                                    @foreach($shipto as $st)
                                                        @if(!empty($jscontactid))

                                                            <div >
                                                                <div class="row">
                                                                    <div class="col-md-8">

                                                                        <ul><li><b>First Name:</b>{{$st->firstName}}<br/><b>Last Name:</b>{{$st->lastName}}<br/><b>Address:</b>{{$st->address1}}</li></ul>
                                                                    </div><a href="{{ url('/destroy/'.$jscontactid[$i].'/'.$jobs->job) }}" ><i class="far fa-trash-alt"></i> Remove Contact</a>

                                                                </div>
                                                            </div>


                                                        @endif
                                                        @php $i++ @endphp
                                                    @endforeach



                                                @endif
                                            </div>



                                            <p>
                                                <a data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample" class="add_field_button btn btn-info">
                                                    +Add New Ship To Contact
                                                </a>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Job Contact Block End-->

        <!--Products Block Start-->
        <h2><u>Products</u></h2>
        <h5><strong>Total number of products:{{count($jobproduct)}}</strong></h5>
        <div class="pull-right">
            <a data-target="#add_product_modal" data-toggle="modal"href="#add_product_modal"  role="button" aria-haspopup="true" >+ Add new product</a>&nbsp;/&nbsp;
            <a data-target="#update_product_modal_2" data-toggle="modal" href="#add_product_modal"  role="button" aria-haspopup="true" ><i class="far fa-edit"></i> Edit products</a>
        </div>
        <table class="table table-bordered">
            @if($jobproduct)
                @php $i=0 @endphp
                @foreach($jobproduct as $jpd)
                    <tr>

                        <td>Product {{$i}} : {{$jpd->description}}</td>
                        <td>
                            @if($jpd->description=='Shipping')
                                <button class="btn btn-md btn-default" disabled><i class="far fa-times-circle"></i> View Product Detail</button>
                            @else
                                <a href="{{ url('/view_product/'.$jpd->id) }}" class="btn btn-md btn-info" target="_blank"><i class="fas fa-external-link-alt"></i> View Product Detail</a>
                            @endif
                        </td>
                    </tr>
                    @php $i++ @endphp
                @endforeach
            @endif
            <tr>
                <td colspan="2" align="center">
                    <a href="{{ url('/view_all_product/'.$jpd->job) }}" class="btn btn-md btn-primary" target="_blank"><i class="fas fa-external-link-alt"></i> View All Products Details</a>
                </td>
            </tr>
        </table>



        <hr>

    </div>
    <a href="{{ url('/view_shipment/'.$jpd->job) }}" class="btn btn-md btn-success center-block" target="_blank"><i class="fas fa-truck"></i> Go to job shipment section >></a>
    <br/>

    <div class="col-md-5">&nbsp;</div>
    <div class="col-md-2">
        <a href="{{url('/job_report/'.$jpd->job)}}" class="btn btn-lg btn-warning center-block" role="button" target="_blank"><i class="fas fa-print"></i> Print Job Report</a>
    </div>
    <div class="col-md-5">&nbsp;</div>

    <!--Products Block End-->

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
                                @foreach($custlist as $customerlist)
                                    <option value='{{$customerlist->id}}'>{{$customerlist->custName}}</option>
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


    <!--update job modal-->
    <div class="modal fade" id="update_job_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">Update Job Details</h3>
                </div>
                <div class="modal-body">

                    <!-- content goes here -->
                    <form method="POST" action= "{{ action('PaceController@update_job') }}">
                        @csrf
                        <input type="hidden" name="job_number" value="{{$jobs->job}}"/>
                        <table class="table success">

                            <tr >
                                <th class="info">Job Number</th>
                                <td><b>{{$jobs->job}}</b></td>
                            </tr>
                            <tr>
                                <th class="info">Customer</th>
                                <td>
                                    <select class="selectpicker" data-live-search="true" name="customer_name" title=" @foreach    ($customers as $cus)
                                    {{$cus->custName}}
                                    @endforeach">


                                        @foreach($custlist as $clist)

                                            <option value='{{$clist->id}}'>{{$clist->custName}}</option>\

                                        @endforeach
                                    </select>
                                </td>


                            </tr>
                            <tr>
                                <th class="info">Job Type</th>
                                <td>

                                    <select class="selectpicker" data-live-search="true" name="job_type" title=" @foreach($jobtype as $type)
                                    {{$type->description}}
                                    @endforeach">
                                        @foreach($jobtypes as $jt)
                                            <option value='{{ isset($jt->id)?$jt->id:''}}'>{{ isset($jt->description)?$jt->description:''}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th class="info">Job Status</th>

                                <td>

                                    <select class="selectpicker" data-live-search="true" name="job_status" title="  @foreach($jobstatus as $status){{$status->description}}@endforeach">
                                        @foreach($statuslist as $sl)
                                            <option value='{{$sl->id}}'>{{$sl->description}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th class="info">CSR</th>
                                <td>

                                    <select class="selectpicker" data-live-search="true" name="csr" title="   @foreach($csr as $c){{$c->name}}@endforeach">
                                        @foreach($csrlist as $cl)
                                            <option value='{{$cl->id}}'>{{$cl->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th class="info">Job Description</th>
                                <td>
                                    <textarea class="form-control" id="exampleFormControlTextarea5" rows="3" name="description">{{$jobs->description}}</textarea>


                                </td>
                            </tr>
                            <tr >
                                <th  class="info">Job Additional Description</th>
                                <td>
                                    <textarea class="form-control" id="exampleFormControlTextarea5" rows="3" name="description2">{{$jobs->description2}}</textarea>

                                </td>
                            </tr>
                            <tr>
                                <th valign="top" class="info">PO Number</th>
                                <td><input type="text" name="po_number" value="{{$jobs->poNum}}" class="form-control"/></td>
                            </tr>
                            <tr>
                                <th class="info">Quote Number</th>
                                <td><input type="text" name="quote_number" value="{{$jobs->reference}}" class="form-control"/></td>
                            </tr>
                            <tr>
                                <th class="info">Promise Date</th>

                                <td>
                                    <input type="text" class="form-control" id="promise_date" placeholder="Enter Promise Date" name="promise_date" value="">
                                </td>
                            </tr>




                        </table>

                        <br/>
                        <div class="btn-group align-middle" role="group">
                            <button type="submit" class="btn btn-lg btn-success center-block">Update Job Details</button>

                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
    <!--update job modal ends-->

    <!--add product modal-->
    <div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">Add Products</h3>
                </div>
                <div class="modal-body ">

                    <!-- content goes here -->
                    <form role="form" method="get" action="{{ action('PaceController@add_product') }}">
                        @csrf
                        <input type="hidden" name="job_number" value="{{$jobs->job}}"/>
                        <div class="pull-right">
                            <a data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample" class="add_field_button3 btn btn-sm btn-primary">
                                +Add Grid
                            </a>
                        </div>
                        <div class="input_fields_wrap3">
                            <table class="table success">
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Additional Description
                                    </th>
                                    <th>
                                        PO
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                                @php $c=1;@endphp

                                @foreach($jobproduct as $count => $jpd)
                                    @if ($jpd->description !=='Shipping')
                                        <tr >

                                            <td><b><input type="text" class="form-control" value="{{$c++}}"  disabled/></b></td>
                                            <td><textarea class="form-group" rows="2" cols="30" disabled> {{$jpd->description}}</textarea></td>
                                            <td><textarea class="form-group" rows="2" cols="30" disabled>{{$jpd->additionalDescription}}</textarea></td>
                                            <td><textarea class="form-group" rows="2" cols="30" disabled>{{$jpd->U_PO}}</textarea></td>
                                            <td></td>
                                        </tr>

                                    @endif

                                @endforeach
                                <input type="hidden" class="form-control" id="count" value="{{$c}}" />
                            </table>
                        </div>
                        <br/>
                        <div class="btn-group align-middle" role="group">
                            <input type="hidden" name="job_number" value="{{$jobs->job}}"/>
                            <input type="hidden" name="job_type" value="{{$jobs->jobType}}"/>
                            <button type="submit" class="btn btn-md btn-success center-block">+ Add Products</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
    <!--add product modal ends-->

    <!--update product modal-->
    <div class="modal fade" id="update_product_modal_2" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">Update Products</h3>
                </div>
                <div class="modal-body ">

                    <!-- content goes here -->
                    <form role="form" method="get" action="{{ action('PaceController@update_product') }}">
                        @csrf
                        <div>
                            <table class="table success">
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Additional Description
                                    </th>
                                    <th>
                                        PO
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                                @php $c=1;@endphp

                                @foreach($jobproduct as $count => $jpd)
                                    @if ($jpd->description !=='Shipping')
                                        <tr >
                                            <input type="hidden" class="form-control" value="{{$jpd->id}}" name="product_id[]"/>
                                            <td><b><input type="text" class="form-control" value="{{$c++}}"  disabled/></b></td>
                                            <td>
                                                <textarea class="form-group" rows="2" cols="30" name="description[]"> {{$jpd->description}}</textarea>
                                            </td>
                                            <td><textarea class="form-group" rows="2" cols="30" name="description2[]">{{$jpd->additionalDescription}}</textarea></td>
                                            <td><textarea class="form-group" rows="2" cols="30" name="po[]">{{$jpd->U_PO}}</textarea></td>
                                            <td></td>
                                        </tr>

                                    @endif

                                @endforeach
                                <input type="hidden" class="form-control" id="count" value="{{$c}}" />
                            </table>
                        </div>
                        <br/>
                        <div class="btn-group align-middle" role="group">
                            <input type="hidden" name="job_number" value="{{$jobs->job}}"/>
                            <input type="hidden" name="job_type" value="{{$jobs->jobType}}"/>
                            <button type="submit" class="btn btn-md btn-success center-block">Update Products</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
    <!--update product modal ends-->


    <!--dup job modal-->
    <div class="modal fade" id="dup_job_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:1900px;">
            <div class="modal-content" style="overflow-x: scroll;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">Duplicate Job</h3>
                </div>
                <div class="modal-body">

                    <!-- content goes here -->
                    <div class="container-fluid">

                        <div class="stepwizard col-md-offset-3">
                            <div class="stepwizard-row setup-panel">
                                <div class="stepwizard-step">
                                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                    <h3><b>Job Detail </b></h3>
                                </div>
                                <div class="stepwizard-step">
                                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                    <h3><b>Job Products </b></h3>
                                </div>
                                <div class="stepwizard-step">
                                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                    <h3><b>Job Parts</b></h3>
                                </div>
                            </div>
                        </div>


                            <div class="row setup-content" id="step-1">
                                <div class="col-xs-6 col-md-offset-3">
                                    <div class="col-md-12">
                                        <h3><u>Job Detail</u></h3>
                                        <table class="table success">


                                            <tr>
                                                <th class="info">Customer</th>
                                                @foreach($customers as $cus)
                                                    <td>
                                                        <input type="hidden" value="{{$cus->id}}" class="form-control" id="cust_id" name="cust_id" />
                                                        <input type="text" value="{{$cus->custName}}" class="form-control" id="cust_name" name="cust_name" disabled/>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th class="info">Job Type</th>
                                                <td>
                                                    <select class="form-control" name="job_type" id="job_type" title=" @foreach($jobtype as $type)
                                                    {{$type->description}}
                                                    @endforeach" id="jobtype">
                                                        @foreach($jobtypes as $jt)
                                                            <option value='{{ isset($jt->id)?$jt->id:''}}' >{{ isset($jt->description)?$jt->description:''}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>


                                            <tr>
                                                <th class="info">CSR</th>
                                                <td>

                                                    <select class="selectpicker" data-live-search="true" name="csr" title="   @foreach($csr as $c){{$c->name}}@endforeach" id="csr">
                                                        @foreach($csrlist as $cl)
                                                            <option value='{{$cl->id}}'>{{$cl->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="info">Job Description</th>
                                                <td>
                                                    <textarea class="form-control" id="job_desc" rows="3" name="description">{{$jobs->description}}</textarea>


                                                </td>
                                            </tr>
                                            <tr >
                                                <th  class="info">Job Additional Description</th>
                                                <td>
                                                    <textarea class="form-control" id="job_desc2" rows="3" name="description2">{{$jobs->description2}}</textarea>

                                                </td>
                                            </tr>
                                            <tr>
                                                <th valign="top" class="info">PO Number</th>
                                                <td><input type="text" name="po_number" value="{{$jobs->poNum}}" class="form-control" id="job_po"/></td>
                                            </tr>
                                            <tr>
                                                <th class="info">Quote Number</th>
                                                <td><input type="text" name="quote_number" value="{{$jobs->reference}}" class="form-control" id="quote_number"/></td>
                                            </tr>
                                            <tr>
                                                <th class="info">Promise Date</th>

                                                <td>
                                                    <input type="text" class="form-control" id="job_promise_date" placeholder="Enter Promise Date" name="promise_date2" value="">
                                                </td>
                                            </tr>


                                            <tr >
                                                <th colspan="1"></th>
                                                <td>
                                                    <input type="hidden" name="hidden_id" id="hidden_id" value="">
                                                    <!--<input type="button" id="approve_btn" class="btn btn-info" name="approve_btn" value="Edit Job Detail">-->


                                                </td>

                                            </tr>




                                        </table>
                                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row setup-content" id="step-2">
                                <div class="col-xs-6  col-md-12">
                                    <div class="col-md-12">
                                        <h3><u>Job Products</u></h3>
                                        <div>
                                            <table class="table success">
                                                <tr>
                                                    <th>
                                                        Description
                                                    </th>
                                                    <th>
                                                        Additional Description
                                                    </th>
                                                    <th>
                                                        PO
                                                    </th>
                                                    <th>
                                                        Due Date
                                                    </th>
                                                    <th>
                                                        Duplicate
                                                    </th>
                                                </tr>
                                                @php $c=1;@endphp

                                                @foreach($jobproduct as $count => $jpd)
                                                    @if ($jpd->description !=='Shipping')
                                                        <tr >
                                                            <input type="hidden" class="form-control" value="{{$jpd->id}}" name="product_id[]"/>
                                                            <td><textarea class="form-control" rows="2" cols="30" name="product_desc[]"> {{$jpd->description}}</textarea></td>
                                                            <td>
                                                                <textarea class="form-control" rows="2" cols="30" name="product_desc2[]">{{$jpd->additionalDescription}}</textarea>
                                                            </td>
                                                            <td><textarea class="form-control" rows="2" cols="30" name="pro_po[]">{{$jpd->U_PO}}</textarea></td>
                                                            <td>
                                                                @if($jpd->U_DueDate !== null)
                                                                    <input type="text" class="form-control" id="due_date" name="product_due_date[]" value="{{$jpd->U_DueDate->toDateString()}}">
                                                                @else
                                                                    <input type="text" class="form-control" id="due_date" name="product_due_date[]" value="">
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <select name="dup_products_option[]" class="form-control">
                                                                    <option value="Yes">Y</option>
                                                                    <option value="No">N</option>
                                                                </select>

                                                            </td>
                                                        </tr>

                                                    @endif

                                                @endforeach
                                                <input type="hidden" class="form-control" id="count" value="{{$c}}" />
                                            </table>
                                        </div>
                                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row setup-content" id="step-3">
                                <div class="col-xs-6 col-md-12">
                                    <div class="col-md-12">
                                        <h3><u>Job Parts</u></h3>


                                        <table class="table success" >
                                            <tr>
                                                <td>&nbsp</td>
                                                <th>
                                                    <b>Product</b>
                                                </th>
                                                <th>
                                                    <b>Description</b>
                                                </th>
                                                <th>
                                                    <b>Additional Description</b>
                                                </th>
                                                <th>
                                                    <b>Qty</b>
                                                </th>
                                                <th>
                                                    <b>Width</b>
                                                </th>
                                                <th>
                                                    <b>Height</b>
                                                </th>

                                                <th>
                                                    <b>Unit Price</b>
                                                </th>
                                                <th>
                                                    <b>Sqft Price</b>
                                                </th>
                                                <th>
                                                    <b>Total Price</b>
                                                </th>
                                                <th>
                                                    <b>Price List</b>
                                                </th>
                                                <th>
                                                    <b>Duplicate</b>
                                                </th>
                                            </tr>
                                            @foreach ($jobproduct as $job_product)
                                                @if($job_product->description!="Shipping")
                                                    @foreach($jobparts as $job_part)
                                                        @if($job_part->jobProduct==$job_product->id)

                                                            <tr class="row">

                                                                <td>

                                                                    <textarea rows="2" cols="20" type="text" name="product[]"  maxlength="30"  style="font-weight: bold;" disabled>  {{$job_product->description}}</textarea>
                                                                </td>
                                                                <td>
                                                                    <textarea rows="2" cols="20" type="text" name="parts_desc[]"  maxlength="50" >{{$job_part->description}}</textarea>
                                                                </td>
                                                                <td>
                                                                    <textarea rows="2" cols="20" type="text" name="parts_desc2[]"  maxlength="50" >{{$job_part->additionalDescription}}</textarea>
                                                                </td>
                                                                <td><input type="text" value="{{$job_part->qtyOrdered}}" name="parts_qty[]" id="qty" class="qty " /></td>
                                                                <td><input type="text" value="{{$job_part->finalSizeW}}" name="parts_width[]" id="finalWidth" class="width " /></td>
                                                                <td><input type="text" value="{{$job_part->finalSizeH}}" name="parts_height[]" id="finalHeight" class="height "/></td>

                                                                <td>

                                                                    <input type="text" value="{{$job_part->totalHours}}" name="parts_unitprice[]" id="unit_price" class="unit_price" />
                                                                </td>
                                                                <td>
                                                                    <input type="text" value="{{$job_part->sheetsToPress}}" name="parts_sqftprice[]" id="sft_price" class="sft_price" />
                                                                    <input type="hidden" value="{{$job_part->U_total_sqt}}" name="parts_total_sqft[]" id="total_sqft" class="total_sqft"/>
                                                                </td>
                                                                <td><input type="text" value="{{number_format((float)$job_part->quotedPrice, 2, '.', '')}}" name="parts_total_price[]" class="total_price" /></td>
                                                                <td>
                                                                    <textarea rows="2" cols="20" type="text" name="parts_price_list[]" id="price_list" class="price_list" maxlength="50">{{$job_part->statusComment}}</textarea>
                                                                    <input type="hidden" class="price_list_id form-control" name="price_list_id[]" value="{{$job_part->prep}}" />

                                                                </td>
                                                                <td>
                                                                    <select name="dup_parts_option[]" class="form-control">
                                                                        <option value="Yes">Y</option>
                                                                        <option value="No">N</option>
                                                                    </select>

                                                                </td>

                                                            </tr>
                                                            <input type="hidden" value="{{$job_product->id}}"
name="parts_product[]"/>
                                                            <input type="hidden" value="{{$job_part->jobPart}}" name="parts_id[]"/>
                                                            <input type="hidden" value="{{$job_part->job}}" name="old_job"/>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </table>

                                        <button class="btn btn-success btn-lg center-block" type="" onclick="submit_dup_detail({{$jobs->id}})">Start Duplicate Job <i class="far fa-clone"></i></button>
                                    </div>
                                </div>
                            </div>


                    </div>

                </div>

            </div>
        </div>
    </div>
    <!--update job modal ends-->
    <!-- Price List Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Price List</h4>
                </div>
                <div class="modal-body">

                    <div id="div_source1">
                        <label id="slabel"> Select the Price List: </label>
                        <select id="select_data" class='form-control'>
                            <option value="select" class='form-control'>Select Price List...</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                    <!--<button type="button" class="hapus_krs" onclick="hapus_krs(this.value)" value="1">x</button>-->
                    <button type="button" class="btn btn-primary center-block" data-dismiss="modal" id="choose">Choose Price List</button>
                </div>
            </div>
        </div>
    </div>


    </div>


    <script>
        $(function(){

            window.FakeLoader.init();

        });
        window.FakeLoader.init({
            auto_hide: true
        });


        $(document).ready(function() {
            var max_fields      = 10; //maximum input boxes allowed
            var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID
            var wrapper2   		= $(".input_fields_wrap2"); //Fields wrapper
            var add_button2      = $(".add_field_button2"); //Add button ID
            var wrapper3   		= $(".input_fields_wrap3"); //multiple product wrapper
            var add_button3      = $(".add_field_button3"); //Add multiple product button


            var x = 1;//initlal text box count
            var y=$("#count").val();
            var i=y;
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div><div class="row"><div class="col-md-8"> <select class="form-control" name="ship_to[]" title=" Choose Contact" onchange="myFunction(event)" id="ship_to[]"></div><\n' +
                        '                                                @foreach($custcon as $cc)\n' +
                        '                                                    <option value=\'{{$cc->id}}\'>{{$cc->firstName}}-{{$cc->lastName}}-{{$cc->address1}}</option>\n' +
                        '                                                @endforeach\n' +
                        '                                            </select></div><button type="submit" class="btn btn-small btn-success">+ Add Job Contact</button>&nbsp;<a href="#" type="button" class="btn btn-small btn-warning remove_field">Cancel</a></div></div> <br/>'); //add input box
                }
            });

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text

                e.preventDefault(); $(this).parent('div').remove(); x--;
            })

            $(add_button2).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper2).append('<div><div class="row"><div class="col-md-8"> <select class="form-control" name="bill_to[]" title=" Choose Contact" onchange="myFunction(event)" id="ship_to[]"></div><\n' +
                        '                                                @foreach($custcon as $cc)\n' +
                        '                                                    <option value=\'{{$cc->id}}\'>{{$cc->firstName}}-{{$cc->lastName}}-{{$cc->address1}}</option>\n' +
                        '                                                @endforeach\n' +
                        '                                            </select></div><button type="submit" class="btn btn-small btn-success">+ Add Job Contact</button>&nbsp;<a href="#" type="button" class="btn btn-small btn-warning remove_field">Cancel</a></div></div> <br/>'); //add input box
                }
            });

            $(wrapper2).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })


            /*add multiple product*/
            $(add_button3).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment

                    //

                    $(wrapper3).append(
                        '<table class="table success"><tr>'+'<td>' +

                        '<input type="text" class="form-control" value='+i+' disabled/>' +

                        '</td>'+'<td>' +

                        '<textarea rows="2" cols="30" type="text" name="description[]" class="form-control" maxlength="50" required></textarea>'+

                        '</td>'+'<td>' +

                        '<textarea rows="2" cols="30" type="text" name="description2[]" class="form-control" maxlength="50" ></textarea>' +

                        '</td>'+'<td>' +

                        '<textarea rows="2" cols="30" type="text" name="po[]" class="form-control" maxlength="50" ></textarea>' +

                        '</td>'+'<td>'+'<button class="btn btn-sm btn-danger remove_field"> delete row</button> '+'</td>'+'</tr></table>' +
                        ''

                    );
                    //add input box
                    i++;
                }
            });

            $(wrapper3).on("click",".remove_field", function(e){ //user click on remove text
                $(this).closest("table").remove();
                x--;
                i--;
            })
        });

        $(function() {

            $('input[name="promise_date"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'),10)
            });
            $('input[name="promise_date"]').on('apply.daterangepicker', function(ev, picker) {

                $(this).val(picker.startDate.format('MM/DD/YYYY'));
            });
            var Datee ="{{$jobs->promiseDate}}";
            var Date =moment(Datee).format('MM/DD/YYYY');

            //console.log(Date);
            $('input[name="promise_date"]').data('daterangepicker').setStartDate(Date);


            $('input[name="promise_date2"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'),10)
            });
            $('input[name="promise_date2"]').on('apply.daterangepicker', function(ev, picker) {

                $(this).val(picker.startDate.format('MM/DD/YYYY'));
            });
            var Datee2 ="{{$jobs->promiseDate}}";
            var Date2 =moment(Datee2).format('MM/DD/YYYY');

            //console.log(Date);
            $('input[name="promise_date2"]').data('daterangepicker').setStartDate(Date2);

        }); //promise date picker


        $(document).ready(function () {
            var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn');

            allWells.hide();

            navListItems.click(function (e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-primary').addClass('btn-default');
                    $item.addClass('btn-primary');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allNextBtn.click(function(){
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;

                $(".form-group").removeClass("has-error");
                for(var i=0; i<curInputs.length; i++){
                    if (!curInputs[i].validity.valid){
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }

                if (isValid)
                    nextStepWizard.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel div a.btn-primary').trigger('click');
        });


        $(document).on("change", ".unit_price", function()
        {
            var $row = $(this).closest(".row");
            var qty = parseInt($row.find('.qty').val()) || 0;
            var width = parseInt($row.find('.width').val()) || 0;
            var height = parseInt($row.find('.height').val()) || 0;
            var unit_price = parseInt($row.find('.unit_price').val()) || 0;
            var sqft=Math.ceil(width*height/144);
            var total_sqft=sqft*qty;
            console.log(qty,width,height,unit_price,total_sqft);
            //alert(sqft);
            //console.log(qty*width);

            var subtotal = (qty * unit_price).toFixed(2);

            $row.find('.total_price').val(subtotal);
           var sprice=(subtotal/total_sqft).toFixed(2)
           $row.find('.sft_price').val(sprice);


        });
        $(document).on("change", ".sft_price", function()
        {
            var $row = $(this).closest(".row");
            var qty = parseInt($row.find('.qty').val()) || 0;
            var width = parseInt($row.find('.width').val()) || 0;
            var height = parseInt($row.find('.height').val()) || 0;
            var sft_price = $row.find('.sft_price').val() || 0;
            var sqft=Math.ceil(width*height/144);
            var total_sqft=sqft*qty;
            //alert(total_sqft);
            //console.log(qty*width);

            var subtotal = sft_price*total_sqft;
            $row.find('.total_price').val((subtotal).toFixed(2));
            $row.find('.unit_price').val((subtotal/qty).toFixed(2));

        });

        $(document).on("change", ".total_price", function()
        {
            var $row = $(this).closest(".row");
            var qty = parseInt($row.find('.qty').val()) || 0;
            var width = parseInt($row.find('.width').val()) || 0;
            var height = parseInt($row.find('.height').val()) || 0;
            var total_price= parseInt($row.find('.total_price').val())||0;
            var sqft=Math.ceil(width*height/144);
            var total_sqft=sqft*qty;


            var uprice=(total_price/qty).toFixed(2);
            var sfprice=(total_price/total_sqft).toFixed(2);
            $row.find('.unit_price').val(uprice);
            $row.find('.sft_price').val(sfprice);

        });

        $(document).on("change", ".qty", function()
        {
            var $row = $(this).closest(".row");
            var qty = parseInt($row.find('.qty').val()) || 0;
            var width = parseInt($row.find('.width').val()) || 0;
            var height = parseInt($row.find('.height').val()) || 0;
            var sqft=Math.ceil(width*height/144);
            var unit_price = $row.find('.unit_price').val() || 0;
            $row.find('.total_price').val(qty*unit_price);

        });

        $(document).on("change", ".width,.height", function()
        {   //var total_sqft=0;
            var $row = $(this).closest(".row");
            var qty = parseInt($row.find('.qty').val()) || 0;
            var width = parseInt($row.find('.width').val()) || 0;
            var height = parseInt($row.find('.height').val()) || 0;
            var unit_price=$row.find('.unit_price').val()||0;
            var total_price= parseInt($row.find('.total_price').val())||0;
            var sqft=Math.ceil(width*height/144);
            var total_sqft=sqft*qty;

            var sfprice=(total_price/total_sqft).toFixed(2);

            var subtotal=(sfprice*total_sqft).toFixed(2);
            var uprice=(subtotal/qty).toFixed(2);
            //$row.find('.unit_price').val(total_price/qty);
            $row.find('.sft_price').val(sfprice);
            $row.find('.total_price').val(subtotal);
            $row.find('.unit_price').val(uprice);


        });

        $(document).on("change", ".price_list", function()
        {
            var $row = $(this).closest(".row");
            var qty = $row.find('.qty').val() || 0;
            var width = parseInt($row.find('.width').val()) || 0;
            var height = parseInt($row.find('.height').val()) || 0;
            var total_price= parseInt($row.find('.total_price').val())||0;
            var sqft=Math.ceil(width*height/144);
            var total_sqft=sqft*qty;
            var zero_value=0;
            var keyword=$row.find('.price_list').val();
            $row.find('.total_price').val(zero_value);
            $row.find('.unit_price').val(zero_value);
            $row.find('.sft_price').val(zero_value);
            //console.log(keyword);
            $('#select_data')
                .find('option')
                .remove()
                .end();

            // $row.find('.total_price').val(zero_value);

            //console.log(keyword);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: '/search_price_list', // This is the url we gave in the route
                data: {'value' : keyword}, // a JSON object to send back

                success: function(data){ // What to do if we succeed

                    $row.find('.unit_price').val(zero_value);
                    $row.find('.sft_price').val(zero_value);
                    $row.find('.price_list').val('');

                    var lg=data.msg.length;

                    $.each(data, function (index, value) {
                        if(lg!==1) {
                            for (var x = 0; x < lg; x++) {
                                var div_data = "<option value=" + value[x].id + " selected>" + value[x].name + "</option>";
                                $('#pricelist').hide();
                                $('#div_source1,#select_data').show();
                                $('#slabel').show();
                                $(div_data).appendTo('#select_data');
                                $row.find('.price_list').val(value[x].name);
                                $row.find('.price_list_id').val(value[x].id);

                            }
                        }
                        else{
                            var div_data = "<option value=" + value[0].id + " selected>" + value[0].name + "</option>";
                            $('#pricelist').hide();
                            $('#div_source1,#select_data').show();
                            $('#slabel').show();
                            $(div_data).appendTo('#select_data');
                            $row.find('.price_list').val(value[0].name);
                            $row.find('.price_list_id').val(value[0].id);
                        }

                        //alert(value["uom"]);
                    });

                    $('#myModal').modal('show');

                    $(function ()  {
                        $("#myModal").on("hidden.bs.modal", function() {
                            $("#div_source1").hide();
                            $("#pricelist,.price_list").show();
                        });
                    });
                    $('#choose').unbind().click(function () {

                        var quote_id=parseInt($('#select_data').val());

                        //$row.find('#unit_price').val(quote_id);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            method: 'POST', // Type of response and matches what we said in the route
                            url: '/get_price', // This is the url we gave in the route
                            data: {'quote_id': quote_id, 'sqft':sqft, 'qty': qty}, // a JSON object to send back

                            success: function(data)
                            {
                                $.each(data, function (index, value) {
                                    //console.log(data);
                                    var unit_price=value[0].unitPrice;
                                    var uprice=(unit_price*1).toFixed(2);
                                    $row.find('.unit_price').val(uprice);
                                    var subtotal = (qty * unit_price).toFixed(2);

                                    $row.find('.total_price').val(subtotal);
                                    var sprice=(subtotal/total_sqft).toFixed(2)
                                    $row.find('.sft_price').val(sprice);


                                });
                            },
                            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                                console.log(JSON.stringify(jqXHR));
                                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                            }
                        });


                    });
                    lg=1;
                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });





        });

        function submit_dup_detail(job)
        {
            alert('Job Duplicating Process has started, please wait a moment');
            var job_cust_id=$("#cust_id").val();
            var job_type=$("#job_type").val();
            var job_status=$("#job_status").val();
            var job_csr=$("#csr").val();
            var job_desc=$("#job_desc").val();
            var job_desc2=$("#job_desc2").val();
            var job_po=$("#job_po").val();
            var job_quote_number=$("#quote_number").val();
            var job_date=$("#job_promise_date").val();
            console.log(job_type);
            var pro_desc2=$("textarea[name='product_desc2[]']");
            var po=$("textarea[name='pro_po[]']");
            var date=$("input[name='product_due_date[]']");
            var option=$("select[name='dup_products_option[]']");
            var product_id=$("input[name='product_id[]']");
            var products = $("textarea[name='product_desc[]']").map(function(index) {
                return {
                    product_desc: $(this).val(),
                    product_desc2:pro_desc2.eq(index).val(),
                    po:po.eq(index).val(),
                    date:date.eq(index).val(),
                    option:option.eq(index).val(),
                    id:product_id.eq(index).val()
                };
            }).get()

            product_list_result = JSON.stringify(products);

            var desc2=$("textarea[name='parts_desc2[]']");
            var qty=$("input[name='parts_qty[]']");
            var width=$("input[name='parts_width[]']");
            var height=$("input[name='parts_height[]']");
            var unitprice=$("input[name='parts_unitprice[]']");
            var sqftprice=$("input[name='parts_sqftprice[]']");
            var total_sqft=$("input[name='parts_total_sqft[]']");
            var total_price=$("input[name='parts_total_price[]']");
            var pricelist=$("textarea[name='parts_price_list[]']");
            var pricelist_id=$("input[name='price_list_id[]']");
            var option=$("select[name='dup_parts_option[]']");
            var part=$("input[name='parts_id[]']");
            var product=$("input[name='parts_product[]']");
            var old_job=$("input[name='old_job']");


            var part_list = $("textarea[name='parts_desc[]']").map(function(index) {
                return {
                    pid:part.eq(index).val(),
                    product:product.eq(index).val(),
                    old_job:old_job.eq(index).val(),
                    parts_desc: $(this).val(),
                    parts_desc2:desc2.eq(index).val(),
                    qty: qty.eq(index).val(),
                    width:width.eq(index).val(),
                    height:height.eq(index).val(),
                    total_sqft:total_sqft.eq(index).val(),
                    unitprice:unitprice.eq(index).val(),
                    sqftprice:sqftprice.eq(index).val(),
                    total_price:total_price.eq(index).val(),
                    option:option.eq(index).val(),
                    pricelist:pricelist.eq(index).val(),
                    pricelist_id:pricelist_id.eq(index).val(),
                };
            }).get()

            part_list_result = JSON.stringify(part_list);



            var numofpart=0;
            $.each(JSON.parse(part_list_result), function(index, part2) {
                if(part2.option=="Yes")
                {
                    console.log(part2.option)
                    numofpart++;
                    //console.log(numofpart)
                }
            });

            //var current_job=$("#curjob").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url: '/job_duplicate',
                data:{customer_id:job_cust_id,jobtype:job_type,description:job_desc,add_description:job_desc2,po:job_po,quote_number:job_quote_number,promise_date:job_date,csr:job_csr},
                async: false,
                success: function(data){


                    $.each(data, function (index, value) {
                        //console.log(value.job);
                        $.each(JSON.parse(product_list_result), function(index, element) {
                        if(element.option=="Yes")
                        {
                            //console.log(element);
                            //console.log(element.id);
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                                type:'POST',
                                url: '/product_duplicate',
                                data:{pdescription:element.product_desc,add_pdescription:element.product_desc2,po:element.po,job:value.job,date:element.date,id:element.id},
                                async: false,
                                success: function(data) {
                                   // var result = jQuery.parseJSON(data);
                                    //console.log(result)
                                    var total_part_dup=0;

                                    $.each(data, function (index, value) {
                                       //console.log(value.U_Old_Pid);
                                        alert("A new job "+value.job+" has been created and the page will redirected to "+value.job+"soon");
                                        $.each(JSON.parse(part_list_result), function(index, part) {

                                            if(part.option=="Yes")
                                            {
                                                total_part_dup++;
                                                if(value.U_Old_Pid==part.product){
                                                    $.ajaxSetup({
                                                        headers: {
                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                        }
                                                    });

                                                    $.ajax({
                                                        type:'POST',
                                                        url: '/part_duplicate',
                                                        data: {job:value.job,old_job:part.old_job,part:part.pid,products:value.id,description:part.parts_desc,add_desc:part.parts_desc2,quantity:part.qty,width:part.width,height:part.height,total_price:part.total_price,total_sqft:part.total_sqft,unitprice:part.unitprice,sqftprice:part.sqftprice,price_list:part.pricelist,price_list_id:part.pricelist_id},
                                                        async: false,
                                                        success: function(response) {

                                                                console.log('success');
                                                                /*$.ajax({
                                                                    type:'POST',
                                                                    url: 'UpdateInvoiceAmount.php',
                                                                    data:{job:response},
                                                                    async: false
                                                                });
                                                                $(".job_dup_content").css("display","none");*/

                                                                window.location.replace("/show_detail/"+part.jobtype+"/"+value.job);

                                                        },
                                                        error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                                                            console.log(JSON.stringify(jqXHR));
                                                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                                                        }
                                                    });
                                                }


                                            }
                                        });
                                    })



                                },
                                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                                    console.log(JSON.stringify(jqXHR));
                                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                                }
                            });
                        }
                    })
                    })

                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        }

    </script>
@endsection