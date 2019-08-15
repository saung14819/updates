@extends('layout')
@section('content')



    <div class="container">
        <div class="row">
            <div style="float:left;width:15%;">
                <h4>Department Note</h4>
            </div>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#add_depnote_form_modal">Add Department Note</button>
            <div class="row" style="margin-top:10px;margin-left:2px;">
                <table class="table success" id='depnote_table'>
                    <thead style="background-color: #1b4b72;color:white;">
                    <tr>
                        <th width="30%">Department</th>
                        <th width="50%">Note</th>
                        <th width="10%">Update</th>
                        <th width="10%">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="depnote_table_body" >
                    @foreach($departments as $dept)
                        @if(!empty($job_notes))
                            @foreach($job_notes as $jn)
                                @if($dept->id==$jn->department)
                                    <tr>
                                        <td>
                                            <select name="department" id="dep" class="form-control">

                                                <option value="{{$dept->id}}" selected>{{$dept->description}}</option>


                                            </select>
                                        </td>
                                        <td>

                                            {{$jn->note}}

                                        </td>
                                        <td>

                                            <button class='btn btn-warning' data-toggle="modal" data-target="#update_depnote_form_modal" onclick="update_depnote('{{$jn->id}}','{{$dept->id}}')">Update</button>


                                        </td>
                                        <td>


                                            <a href="{{ url('/del_dept_note_mul/'.$jn->id.'/'.$job) }}" class='btn btn-danger' role="button" > Delete</a>

                                        </td>
                                        @endif
                                        @endforeach

                                        @endif
                                        @endforeach
                                    </tr>
                    </tbody>
                </table>
            </div>
            <hr/>
        </div>
        <h3><u>Total Products: {{count($all_products)-1}} </u> </h3>
        <h3 class="pull-right"><u><a href="#" id="expand_all"> Total Parts:  {{count($all_parts)-1}} <i class="far fa-folder-open">-Expand all</i></a></u> </h3>

        @foreach($all_products as $all_pro)
         @if($all_pro->description !== 'Shipping')
        <div class="row">

            <div class="col-md-4">

                <h4>Product Name:<b>{{$all_pro->description}}</b></h4>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <table class="table success">

                                <tr >
                                    <th class="info">Job Number:</th>
                                    <td><b>{{$all_pro->job}}</b></td>
                                </tr>
                                <tr>
                                    <th class="info">Product Description:</th>
                                    <td><input type="text" class="form-control" value="{{$all_pro->description}}" disabled/> </td>
                                </tr>
                                <tr>
                                    <th class="info">Product Additional Description:</th>
                                    <td><input type="text" class="form-control" value="{{$all_pro->additionalDescription}}" disabled/> </td>
                                </tr>
                                <tr>
                                    <th class="info">Product PO:</th>
                                    <td><input type="text" class="form-control" value="{{$all_pro->U_PO}}" disabled/> </td>
                                </tr>
                                <tr>
                                    <th class="info">Product Qty:</th>
                                    <td><input type="text" class="form-control" value="{{$all_pro->qtyOrdered}}" disabled/> </td>
                                </tr>
                                <tr>
                                    <th class="info">Promise Date:</th>
                                    <td><input type="text" class="form-control" value="{{$all_pro->U_DueDate}}" disabled/> </td>
                                </tr>
                            </table>
                            <div class="pull-right">
                                <!--<a data-target="#add_product_modal" data-toggle="modal"href="#add_product_modal"  role="button" aria-haspopup="true" ><i class="far fa-edit"></i> Edit product</a>&nbsp;/&nbsp;
                                <a data-target="#duplicate_product_modal" data-toggle="modal" href="{{ url('/dup_sin_all_product/'.$all_pro->id ) }}"  role="button" aria-haspopup="true" ><i class="far fa-clone"></i> Duplicate product</a>-->
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">



                <br/>
                <div class="panel-group" id="parts">
                    @php $part_count=1 @endphp
                    @foreach($all_parts as $job_part)
                        @if($job_part->description!=='Shipping')
                            @if($job_part->jobProduct==$all_pro->id)
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h4 class="panel-title">

                                        <a href="#{{$job_part->jobPart}}" data-toggle="collapse" data-parent="#posts">- Part {{$part_count++}}:<b>{{$job_part->description}}</b></a>
                                    </h4>
                                </div>
                                <div id="{{$job_part->jobPart}}" class="panel-collapse collapse.show">
                                    <div class="panel-body">
                                        <h4><b><u>Part Detail</u></b></h4>
                                        <form action= "{{ action('PaceController@edit_part') }}" method="post" >
                                            @csrf
                                            <table class="table success">

                                                <tr >
                                                    <th>Description:</th>
                                                    <td><textarea rows="2" cols="70" type="text" name="desc" class="form-control" maxlength="50" id="desc{{$job_part->jobPart}}" readonly>{{$job_part->description}}</textarea></td>
                                                    <td>&nbsp;-&nbsp;</td>
                                                    <td>
                                                        <select class="form-control" id="sales{{$job_part->jobPart}}" readonly>
                                                            @foreach($sales as $sp)
                                                                @if($sp->id==$job_part->salesCategory)

                                                                    <option value="{{$sp->id}}" selected>
                                                                        {{$sp->name}}
                                                                    </option>

                                                                @else
                                                                    <option value="{{$sp->id}}">
                                                                        {{$sp->name}}
                                                                    </option>
                                                                @endif

                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th >Additional Description:</th>
                                                    <td><textarea rows="2" cols="70" type="text" name="desc2{{$job_part->jobPart}}" class="form-control" maxlength="50" readonly>{{$job_part->additionalDescription}}</textarea></td>
                                                </tr>
                                                <tr>
                                                    <th> Quantity:</th>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{$job_part->qtyOrdered}}" name="qty" id="qty{{$job_part->jobPart}}" readonly/>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Final Size:</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <input type="text" class="form-control" value="{{$job_part->finalSizeW}}" name="finalw" id="finalw{{$job_part->jobPart}}" readonly/>
                                                            </div>
                                                            <div class="col-md-1">
                                                                x
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" class="form-control" value="{{$job_part->finalSizeH}}" name="finalh" id="finalh{{$job_part->jobPart}}" readonly/>
                                                            </div>

                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Total Sqft:</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <input type="text" class="form-control" value="{{$job_part->U_total_sqt}}" name="total_sqft" id="total_sqft{{$job_part->jobPart}}" readonly/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th >Unit Price:</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" value="{{$job_part->totalHours}}" name="unit_price" id="unit_price{{$job_part->jobPart}}" readonly/>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-6">Sqft price:</div>
                                                                    <div class="col-md-6"> <input type="text" class="form-control" name="sqft_price" value="{{$job_part->sheetsToPress}}" id="sqft_price{{$job_part->jobPart}}" readonly/></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Final Price:</th>

                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" name="total_price" value="{{number_format((float)$job_part->quotedPrice, 2, '.', '')}}" id="total_price{{$job_part->jobPart}}" readonly />
                                                            </div>


                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <th>Price list:</th>

                                                    <td>
                                                        <div class="row">


                                                            <div class="col-md-12">
                                                                @if($job_part->statusComment!==null)
                                                                    <table>
                                                                        <tr>
                                                                            <td>
                                                                                <textarea rows="3" cols="25" type="text" name="price_list" class="price_list form-control" maxlength="50" id="price_list{{$job_part->jobPart}}" readonly>{{$job_part->statusComment}}</textarea>
                                                                            </td>
                                                                            <td>&nbsp;</td>
                                                                            <td> <a data-target="#myList" data-id="{{$job_part->jobPart}}" data-toggle="modal" href="#myList"  role="button" aria-haspopup="true" id="add_list{{$job_part->jobPart}}" class="open-AddListDialog">+ Change Price list</a></td>
                                                                        </tr>
                                                                    </table>


                                                                @else
                                                                    <table>
                                                                        <tr>
                                                                            <td>
                                                                                <input type="text" class="price_list form-control" name="price_list" value="" id="price_list{{$job_part->jobPart}}" readonly/>
                                                                                <input type="hidden" class="price_list form-control" name="price_list_id" value="" id="price_list_id{{$job_part->jobPart}}" />
                                                                            </td>
                                                                            <td>&nbsp;</td>
                                                                            <td> <a data-target="#myList" data-id="{{$job_part->jobPart}}" data-toggle="modal" href="#myList"  role="button" aria-haspopup="true" id="add_list{{$job_part->jobPart}}" class="open-AddListDialog">+ Add Price list</a></td>
                                                                        </tr>
                                                                    </table>

                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                            </table>
                                            <input type="hidden" name="job" value="{{ $all_pro->job}}"/>
                                            <input type="hidden" name="part" value="{{$job_part->jobPart}}"/>
                                            <input type="hidden" name="product" value="{{$job_part->jobProduct}}"/>
                                            <button style="display:none;" class="btn btn-group btn-md btn-info center-block" id="btn-save{{$job_part->jobPart}}"> <i class="fas fa-save"></i> Save changes</button>
                                            <button type="button" class="btn btn-group btn-md btn-success center-block"  onclick="calculate({{$job_part->jobPart}})" id="btn-edit{{$job_part->jobPart}}"><i class="far fa-edit"></i> Edit Part Details</button>
                                            <br/>
                                        </form>
                                        <table class="table success">

                                            <tr >
                                                <td>
                                                    <h4><u><b>Prepress</b></u></h4>

                                                </td>
                                                <td>
                                                    <a data-target="#PrepModal" data-toggle="modal" href="#PrepModal"  role="button" aria-haspopup="true" class="pull-right" onclick="add_prepress('{{ $all_pro->job}}','{{$job_part->jobPart}}','{{$job_part->jobProduct}}')">
                                                        + Add Prepress
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                        <ul>
                                            @foreach($prepress_list as $prep)
                                                @if($prep->id==$job_part->prepressWorkflow)
                                                    <li><h5><b>{{$prep->description}}</b>&nbsp;- <span class="text-right"><a data-target="#PrepModal" data-toggle="modal" href="#PrepModal"  role="button" aria-haspopup="true" onclick="add_prepress('{{ $all_pro->job}}','{{$job_part->jobPart}}','{{$job_part->jobProduct}}')"><i class="fas fa-edit"></i> Change Prepress Mode</a></span></h5> </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <table class="table success">
                                            <tr >
                                                <td>
                                                    <h4><u><b>Printer</b></u></h4>

                                                </td>
                                                <td>
                                                    <a data-target="#PrintModal" data-toggle="modal" href="#PrintModal"  role="button" aria-haspopup="true" class="pull-right" onclick="add_printer('{{ $all_pro->job}}','{{$job_part->jobPart}}','{{$job_part->jobProduct}}')">
                                                        + Add Printer
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                        <ul>
                                            @foreach($printer as $print)
                                                @if($job_part->jobPart==$print->jobPart)
                                                    <li>
                                                        @foreach($printers as $prt)
                                                            @if($prt->id==$print->press)


                                                                <h5><b>{{$prt->description}}</b> | Note: {{$prt->note}}&nbsp;- <span class="text-right"><a href="{{ url('/delete_printer_multiple/'.$print->id.'/'. $all_pro->job.'/'.$job_part->jobProduct) }}"><i class="far fa-trash-alt"></i> Remove Printer</a></span></h5>

                                                            @endif
                                                        @endforeach
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <table class="table success">
                                            <tr >
                                                <td>
                                                    <h4><u><b>Print Mode</b></u></h4>

                                                </td>
                                                <td>
                                                    <a data-target="#PrintModeModal" data-toggle="modal" href="#PrintModeModal"  role="button" aria-haspopup="true" class="pull-right" onclick="add_print_mode('{{ $all_pro->job}}','{{$job_part->jobPart}}','{{$job_part->jobProduct}}')">
                                                        + Add Print Mode
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                        <ul>
                                            <li><b>{{$job_part->U_PrintMode}}</b></li>
                                        </ul>
                                        <table class="table success">

                                            <tr >
                                                <td>
                                                    <h4><u><b>Printing Material</b></u></h4>

                                                </td>
                                                <td>
                                                    <a href="#" class="pull-right">
                                                        <a data-target="#PrintMaterialModal" data-toggle="modal" href="#PrintMaterialModal"  role="button" aria-haspopup="true" class="pull-right" onclick="add_print_material('{{ $all_pro->job}}','{{$job_part->jobPart}}','{{$job_part->jobProduct}}')"> + Add Printing Material </a>
                                                    </a>
                                                </td>
                                            </tr>


                                        </table>
                                        @if($materials!=null)
                                            @for($i=0;$i<count($materials);$i++)

                                                @foreach($materials[$i] as $mat)

                                                    @if($job_part->jobPart==$mat->jobPart)

                                                        <p>
                                                            @if($mat->paper==true)
                                                                <b>

                                                                    Inventory Item - {{$mat->description}}  -  <span class="text-right"><a href="{{ url('/delete_job_material_multiple/'.$mat->id.'/'. $all_pro->job.'/'.$job_part->jobProduct.'/'.$job_part->jobPart) }}"><i class="far fa-trash-alt"></i> Remove Material</a></span>

                                                                </b>


                                                            @else
                                                                <b>

                                                                    Standard Paper - {{$mat->description}} / Weight : {{$mat->weight}} / Size: {{$mat->buySize}}- <span class="text-right"><a href="{{ url('/delete_job_material_multiple/'.$mat->id.'/'. $all_pro->job.'/'.$job_part->jobProduct.'/'.$job_part->jobPart) }}"><i class="far fa-trash-alt"></i> Remove Material</a></span>

                                                                </b>
                                                            @endif

                                                        </p>

                                                    @endif

                                                @endforeach

                                            @endfor

                                        @endif

                                        <table class="table success">

                                            <tr >
                                                <td>
                                                    <h4><u><b>Finishing</b></u></h4>

                                                </td>
                                                <td>
                                                    <a data-target="#FinishingOpModal" data-toggle="modal" href="#FinishingOpModal"  role="button" aria-haspopup="true" class="pull-right" onclick="add_finish_op('{{ $all_pro->job}}','{{$job_part->jobPart}}','{{$job_part->jobProduct}}')">
                                                        + Add Finishing
                                                    </a>
                                                </td>
                                            </tr>


                                        </table>
                                        <form action= "{{ action('PaceController@sort_fin_mat') }}" method="post" >
                                            @csrf
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Sequence</th>
                                                    <th scope="col">Finishing operation</th>
                                                    <th scope="col">Finishing Material</th>
                                                    <th scope="col">Note</th>
                                                    <th></th>

                                                </tr>
                                                </thead>
                                                <tbody>

                                                @if($finishing!==null)
                                                    @for($i=0;$i<count($finishing);$i++)
                                                        @php $count=0; @endphp
                                                        @foreach($finishing[$i] as $fin)
                                                            @if($fin!==null)
                                                                @if($job_part->jobPart==$fin->jobPart)

                                                                    <tr>
                                                                        @foreach($finishing_operation as $fop)
                                                                            @if($fop->id==$fin->finishingOperation)
                                                                                <td style="width:50px;"><input type="text" value="{{$fin->sequence}}"  class="form-control" name="seq.{{$job_part->jobPart}}.[]" id="seq"/> </td>
                                                                                <input type="hidden" value="{{$fin->id}}" class="form-control" name="fin.{{$job_part->jobPart}}.[]"/>
                                                                                <input type="hidden" value="{{$fop->description}}"  class="form-control" name="fin_seq[]" />
                                                                                <input type="hidden" value="{{$job_part->jobProduct}}" class="form-control" name="product"/>
                                                                                <td > {{$fop->description}}</td>
                                                                                <td style="width:300px;">
                                                                                    @if($fin->U_Material!==null)
                                                                                        {{$fin->U_Material}}
                                                                                    @else
                                                                                        <a data-target="#FinishingMaterialModal" data-toggle="modal" href="#FinishingMaterialModal"  role="button" aria-haspopup="true" onclick="add_finishing_material('{{ $all_pro->job}}','{{$job_part->jobPart}}','{{$fin->id}}','{{$job_part->jobProduct}}')"> + Add Finishing Material </a>
                                                                                    @endif
                                                                                </td>
                                                                                <td>@if ($fin->note!==null){{$fin->note}} @else - @endif</td>
                                                                                <td><a href="{{ url('/del_fin_multiple/'.$job_part->jobPart.'/'.$fin->id.'/'. $all_pro->job.'/'.$job_part->jobProduct) }}"><i class="far fa-trash-alt"></i> Remove </a></td>
                                                                            @endif
                                                                        @endforeach
                                                                    </tr>

                                                                @endif
                                                            @endif
                                                            @php $count=1; @endphp
                                                        @endforeach

                                                    @endfor
                                                    <tr>
                                                        <td>
                                                            @if($count!==0) <button class="btn btn-group btn-sm btn-info center-block" type="button" id="arrange_btn" onclick="arrange_sort('{{$fin->id}}','{{ $all_pro->job}}','{{$job_part->jobPart}}','{{$job_part->jobProduct}}')">Re-arrange</button>
                                                                @endif

                                                        </td>
                                                    </tr>
                                                @endif

                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            @endif
                        @endif
                    @endforeach
                </div>
                <a data-target="#add_product_modal" data-toggle="modal" href="#add_product_modal"  role="button" aria-haspopup="true" class="btn btn-group btn-lg btn-success center-block"><span>+ Add Parts</span></a>

            </div>
        </div>
        <hr/>
         @endif
        @endforeach

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

    <!--add parts modal-->
    <div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:1920px;">
            <div class="modal-content" style="overflow-x: scroll;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">Add Parts</h3>
                </div>
                <div class="modal-body ">

                    <!-- content goes here -->
                    <form role="form" method="get" action="{{ action('PaceController@add_product') }}">
                        @csrf

                        <div class="pull-right">
                            <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" class="add_field_button btn btn-sm btn-primary">
                                + Add new line
                            </a>
                        </div>
                        <div >

                            <table class="table ">

                                <tr>
                                    <td>&nbsp</td>
                                    <td>
                                        <h4><b>Sales</b></h4>
                                    </td>
                                    <td>
                                        <h4><b>Product</b></h4>
                                    </td>
                                    <td>
                                        <h4><b>Desc:</b></h4>
                                    </td>
                                    <td>
                                        <h4><b>Additional Desc:</b></h4>
                                    </td>
                                    <td>
                                        <h4><b>Qty</b></h4>
                                    </td>
                                    <td>
                                        <h4><b>Width</b></h4>
                                    </td>
                                    <td>
                                        <h4><b> Height</b></h4>
                                    </td>
                                    <td>
                                        <h4><b>Unit Price</b></h4>
                                    </td>
                                    <td>
                                        <h4><b>Sqft Price</b></h4>
                                    </td>
                                    <td>
                                        <h4><b>Subtotal Price</b></h4>
                                    </td>
                                    <td>
                                        <h4><b>Price List</b></h4>
                                    </td>
                                </tr>

                                @if(isset($all_parts))
                                    <tbody class="input_fields_wrap">
                                    @foreach($all_parts as $jobpart)
                                        @if($jobpart->description!='Shipping')
                                            <tr class='row'>
                                                <td>
                                                    <select class="form-control" name="sales" disabled>
                                                        @foreach($sales as $sp)
                                                            @if($sp->id==$jobpart->salesCategory)

                                                                <option selected value="{{$sp->id}}">
                                                                    {{$sp->name}}
                                                                </option>

                                                            @else
                                                                <option  value="{{$sp->id}}">
                                                                    {{$sp->name}}
                                                                </option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="product" disabled>
                                                        @foreach($all_products as $all_product)
                                                            @if($all_product->id==$jobpart->jobProduct)
                                                                <option selected value="{{$all_product->id}}">
                                                                    {{$all_product->description}}
                                                                </option>
                                                            @else
                                                                <option value="{{$all_product->id}}">
                                                                    {{$all_product->description}}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea rows="2" cols="70" type="text" name="desc" class="form-control" maxlength="50" disabled >{{$jobpart->description}}</textarea>
                                                </td>
                                                <td>
                                                    <textarea rows="2" cols="70" type="text" name="desc2" class="form-control" maxlength="50" disabled>{{$jobpart->additionalDescription}}</textarea>
                                                </td>
                                                <td><input type="text" value="{{$jobpart->qtyOrdered}}" name="qty" id="qty" class="qty form-control" disabled/></td>
                                                <td><input type="text" value="{{$jobpart->finalSizeW}}" name="width" id="finalWidth" class="width form-control" disabled/></td>
                                                <td><input type="text" value="{{$jobpart->finalSizeH}}" name="height" id="finalHeight" class="height form-control" disabled/></td>
                                                <td><input type="text" value="{{$jobpart->totalHours}}" name="unit_price" id="unit_price" class="unit_price form-control" disabled/></td>
                                                <td><input type="text" value="{{$jobpart->sheetsToPress}}" name="sft_price" id="sft_price" class="sft_price form-control" disabled/></td>
                                                <td><input type="text" value="{{number_format((float)$jobpart->quotedPrice, 2, '.', '')}}" name="total_price" class="total_price form-control" disabled/></td>
                                                <td>
                                                    <textarea rows="2" cols="70" type="text" name="price_list" id="price_list" class="price_list form-control" maxlength="50" disabled>{{$jobpart->statusComment}}</textarea>
                                                    <input type="hidden" value="{{$jobpart->prep}}" name="price_list_id" disabled/>
                                                </td>
                                            </tr>

                                        @endif
                                        <input type="hidden" value="{{$jobpart->job}}" name="job" id="job"/>
                                        <input type="hidden" value="{{$jobpart->jobPart}}" name="part" id="part"/>
                                        <input type="hidden" value="{{$jobpart->jobProduct}}" name="product" id="product"/>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>

                        </div>
                        <br/>


                        <a href="#"  class="btn btn-lg btn-success pull-right" onclick="add_all_parts()">+ Add Parts</a>


                    </form>

                </div>

            </div>
        </div>
    </div>
    <!--add parts modal ends-->

    <!-- Edit Price list modal -->
    <div class="modal fade" id="myList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Search Price List</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-2">Search:</div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="price_list" id="price_list_search">

                        </div>
                        <div class="col-md-4">


                            <button type="button" class="btn btn-sm btn-success" id="btnsearch">Search List</button>
                        </div>
                    </div>
                    <div class="clearfix"><br/></div>
                    <div class="row">
                        <div >
                            <div class="col-md-2"> Select the Price List: </div>
                            <div class="col-md-8">
                                <select id="select_price_data" class='form-control'>
                                    <option value="select" class='form-control'><b>Enter the keyword in the above search ...</b></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary center-block" data-dismiss="modal" id="choose_list">Choose Price List</button>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Prepress Modal -->
    <div class="modal fade" id="PrepModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <form action= "{{ action('PaceController@change_prepress_multiple') }}" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Prepress</h4>
                    </div>
                    <div class="modal-body">
                        <div id="div_source1">
                            <label id="slabel"> Select the Prepress method: </label>
                            <select id="select_data" class='form-control' name="prep">
                                {{$i=0}}
                                @foreach($prepress_list as $prep)

                                    <option value="{{$prep->id}}" class='form-control'>

                                        {{$prep->description}}

                                    </option>
                                    {{$i++}}
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="text" name="job" id="add_prepress_job" hidden/><br/>
                    <input type="text" name="product" id="add_prepress_product_id" hidden/><br/>
                    <input type="text" name="part" id="add_prepress_part_id" hidden/><br/>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-sm btn-success center-block">Choose Price List</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Printer Modal -->
    <div class="modal fade" id="PrintModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action= "{{ action('PaceController@set_printer_multiple') }}" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Printer</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-2" style="text-align: right;">
                                    <label>Printer:</label>
                                </div>
                                <div class="col-xs-9">
                                    <select id="select_data" class='form-control' name="printer_id">

                                        @foreach($printers as $printer)

                                            <option value="{{$printer->id}}" class='form-control'>

                                                {{$printer->description}}

                                            </option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-xs-2" style="text-align: right;">
                                    <label>Note:</label>
                                </div>
                                <div class="col-xs-9">
                                    <textarea class="form-control" type="text" name="note" id="note" maxlength="255"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="text" name="job" id="add_printer_job" hidden/><br/>
                    <input type="text" name="product" id="add_printer_product_id" hidden/><br/>
                    <input type="text" name="part" id="add_printer_part_id" hidden/><br/>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-sm btn-success center-block">Add Printer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!-- Print Mode Modal -->
    <div class="modal fade" id="PrintModeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action= "{{ action('PaceController@add_print_mode_multiple') }}" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Print Mode</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-2" style="text-align: right;">
                                    <label>Print Mode:</label>
                                </div>
                                <div class="col-xs-9">
                                    <select name="print_mode" class="form-control">
                                        <option value="1.None">1.None</option>
                                        <option value="CMYK 3 Layers">CMYK 3 Layers</option>
                                        <option value="D/S Different Positive ">D/S Different Positive </option>
                                        <option value="D/S Mirror+Blockout Vinyl+Positive">D/S Mirror+Blockout Vinyl+Positive</option>
                                        <option value="D/S Mirror+WHT+BLK+WHT Positive">D/S Mirror+WHT+BLK+WHT Positive</option>
                                        <option value="D/S Same Positive">D/S Same Positive</option>
                                        <option value="Double Hit">Double Hit</option>
                                        <option value="Double Sided">Double Sided</option>
                                        <option value="S/S 3 Layers with color enhance">S/S 3 Layers with color enhance</option>
                                        <option value="S/S Mirror">S/S Mirror</option>
                                        <option value="S/S Mirror+WHT">S/S Mirror+WHT</option>
                                        <option value="S/S Mirror+WHT+Double Hit">S/S Mirror+WHT+Double Hit</option>
                                        <option value="S/S Positive">S/S Positive</option>
                                        <option value="S/S Positive+WHT">S/S Positive+WHT</option>
                                        <option value="S/S Positive+WHT+Double Hit">S/S Positive+WHT+Double Hit</option>
                                        <option value="Single Sided">Single Sided</option>
                                        <option value="Day and Night Movie Backdrop [ CWCCC ]">Day and Night Movie Backdrop [ CWCCC ]</option>
                                    </select>
                                </div>
                            </div>
                            <br/>
                            <!--<div class="row">
                                <div class="col-xs-2" style="text-align: right;">
                                    <label>Note:</label>
                                </div>
                                <div class="col-xs-9">
                                    <textarea class="form-control" type="text" name="note" id="note" maxlength="255"></textarea>
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <input type="text" name="job" id="add_print_mode_job" hidden/><br/>
                    <input type="text" name="product" id="add_print_mode_product_id" hidden/><br/>
                    <input type="text" name="part" id="add_print_mode_part_id" hidden/><br/>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-sm btn-success center-block">Add Print Mode</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!-- Print Material Modal -->
    <div class="modal fade" id="PrintMaterialModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action= "{{ action('PaceController@set_job_material_multiple') }}" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Print Material</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row" id="inventory_item">
                                <div class="col-xs-4" style="text-align: right;">
                                    <label>Search Inventory Item:</label>

                                </div>
                                <div class="col-xs-8" >
                                    <input type="text" name="description" id="add_inventory_description" class="form-control int_input"/>

                                </div>
                            </div>
                            <br/>
                            <div class="row" id="std_paper">
                                <div class="col-xs-4" style="text-align: right;">
                                    <label>Standard Paper:</label>

                                </div>
                                <div class="col-xs-8" >
                                    <input type="text" name="paper" id="search_paper" class="form-control int_input"/>

                                </div>
                            </div>

                            <div class="row" id="inventory_list">
                                <div class="col-xs-3" style="text-align: right;">
                                    <label>Invnt Item:</label>

                                </div>
                                <div class="col-xs-9">
                                    <select id="select_data_inventory" class='form-control' name="inventory_item">
                                        <option value="select" class='form-control'>......</option>
                                    </select>


                                </div>
                            </div>
                            <br/>
                            <div class="row" id="std_paper_list">
                                <div class="col-xs-2" style="text-align: right;">
                                    <label>Paper Type:</label>

                                </div>
                                <div class="col-xs-9">
                                    <select id="select_data_std_paper" class='form-control' onchange="std_paper_weight(this.value)" name="std_paper">

                                    </select>
                                </div>
                            </div>
                            <br/>

                            <div class="row" id="weight">
                                <div class="col-xs-2" style="text-align: right;">
                                    <label>Weight:</label>

                                </div>
                                <div class="col-xs-4">

                                    <select id="select_paper_weight" class='form-control' onclick="std_paper_size(this.value)" name="weight">
                                        <option value="select" class='form-control' selected>None</option>
                                    </select>
                                </div>
                            </div>
                            <br/>
                            <div class="row" id="size">
                                <div class="col-xs-2" style="text-align: right;">
                                    <label>Size:</label>

                                </div>
                                <div class="col-xs-4">

                                    <select id="select_paper_size" class='form-control' name="size">
                                        <option value="select" class='form-control' selected>None</option>
                                    </select>
                                </div>
                            </div>
                            <br/>
                        </div>
                    </div>
                    <input type="text" name="job" id="add_print_mate_job" hidden/><br/>
                    <input type="text" name="product" id="add_print_mate_product_id" hidden/><br/>
                    <input type="text" name="part" id="add_print_mate_part_id" hidden/><br/>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-md btn-success " id="int_button">Add Inventory Item</button>
                        <button type="submit" class="btn btn-md btn-info" id="std_button">Add Standard Paper</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Finishing Material Modal -->
    <div class="modal fade" id="FinishingMaterialModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action= "{{ action('PaceController@set_fin_mat_multiple') }}" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Finishing Material</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row" id="finishing_inventory_item">
                                <div class="col-xs-4" style="text-align: right;">
                                    <label>Search Inventory Item:</label>

                                </div>
                                <div class="col-xs-8" >
                                    <input type="text" name="description" id="finishing_inventory" class="form-control int_input"/>

                                </div>
                            </div>
                            <br/>
                            <div class="row" id="finishing_std_paper">
                                <div class="col-xs-4" style="text-align: right;">
                                    <label>Standard Paper:</label>

                                </div>
                                <div class="col-xs-8" >
                                    <input type="text" name="paper" id="search_finishing_paper" class="form-control int_input"/>

                                </div>
                            </div>

                            <div class="row" id="finishing_inventory_list">
                                <div class="col-xs-3" style="text-align: right;">
                                    <label>Invnt Item:</label>

                                </div>
                                <div class="col-xs-9">
                                    <select id="select_finishing_inventory" class='form-control' name="finishing_inventory" >
                                        <option value="" class='form-control'>......</option>
                                    </select>


                                </div>
                            </div>
                            <br/>
                            <div class="row" id="finishing_std_paper_list">
                                <div class="col-xs-2" style="text-align: right;">
                                    <label>Paper Type:</label>

                                </div>
                                <div class="col-xs-9">
                                    <select id="select_finishing_std_paper" class='form-control' onchange="finishing_std_paper_weight(this.value)" name="finishing_std_paper">

                                    </select>
                                </div>
                            </div>
                            <br/>

                            <div class="row" id="fweight">
                                <div class="col-xs-2" style="text-align: right;">
                                    <label>Weight:</label>

                                </div>
                                <div class="col-xs-4">

                                    <select id="select_finishing_paper_weight" class='form-control' onclick="finishing_std_paper_size(this.value)" name="finishing_weight">
                                        <option value="select" class='form-control' selected>None</option>
                                    </select>
                                </div>
                            </div>
                            <br/>
                            <div class="row" id="fsize">
                                <div class="col-xs-2" style="text-align: right;">
                                    <label>Size:</label>

                                </div>
                                <div class="col-xs-4">

                                    <select id="select_finishing_paper_size" class='form-control' name="finishing_size">
                                        <option value="select" class='form-control' selected>None</option>
                                    </select>
                                </div>
                            </div>
                            <br/>
                        </div>
                    </div>
                    <input type="text" name="job" id="add_finishing_mate_job" hidden/><br/>
                    <input type="text" name="product" id="add_finishing_mate_product_id" hidden/><br/>
                    <input type="text" name="fin_id" id="add_finishing_mate_fin_id" hidden/><br/>
                    <input type="text" name="fin_id" id="add_finishing_mate_part_id" hidden/><br/>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-md btn-success " id="finishing_int_button">Add Inventory Item</button>
                        <button type="submit" class="btn btn-md btn-info" id="finishing_std_button">Add Standard Paper</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Finishing Operation Modal -->
    <div class="modal fade" id="FinishingOpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action= "{{ action('PaceController@set_finish_op_multiple') }}" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Finishing Operation</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row" id="search_fin">
                                <div class="col-xs-2" style="text-align: right;">
                                    <label>Search Finishing Operation:</label>

                                </div>
                                <div class="col-xs-9" >
                                    <input type="text" name="fin_description" id="search_fin_ope" class="form-control"/>

                                </div>
                            </div>
                            <br/>

                            <div class="row" id="finishing_op_list">
                                <div class="col-xs-2" style="text-align: right;">
                                    <label>Operation:</label>

                                </div>
                                <div class="col-xs-9">
                                    <select id="select_data_fin_op" class='form-control' name="operation">
                                        <option value="select" class='form-control'>......</option>
                                    </select>


                                </div>
                            </div>
                            <br/>
                            <div class="row" id="note">
                                <div class="row">
                                    <div class="col-xs-2" style="text-align: right;">
                                        <label>Note:</label>
                                    </div>
                                    <div class="col-xs-9">
                                        <textarea class="form-control" type="text" name="fin_op_note" id="fin_op_note" maxlength="255"></textarea>
                                    </div>
                                </div>
                            </div>
                            <br/>


                        </div>
                    </div>
                    <input type="text" name="job" id="fin_op_job" hidden/><br/>
                    <input type="text" name="product" id="fin_op_product_id" hidden/><br/>
                    <input type="text" name="part" id="fin_op_part_id" hidden/><br/>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-md btn-success " id="int_button">Add Finishing Operation</button>

                    </div>
                </div>
            </div>
        </form>
    </div>


    <!--Add Department Note Pop up-->
    <div class="modal" id="add_depnote_form_modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <form  id="add_depnote_form">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="add_contact_formTitle">Add Department Note</h3>
                        <button type="button" style="margin-top:-40px;" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" >
                            <div class="row" >
                                <div class="col-xs-2 job-label text-left" >
                                    <label>Prepress: </label>
                                </div>
                                <div class="col-xs-9">
                                    <select name="department" class="form-control">
                                        @foreach ($departments as $dep)
                                            <option value='{{$dep->id}}'>{{$dep->description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="row" >
                                <div class="col-xs-2 job-label text-left" >
                                    <label>Note: </label>
                                </div>
                                <div class="col-xs-9">
                                    <textarea class="form-control" name="note"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" data-dismiss="modal" onclick='submit_add_dep_form()' id="submit" value="Add" class="btn btn-success">
                        <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                        <input type='hidden' name='job' value={{$job}} />
                    </div>
                </div>
            </div>
        </form>

    </div>

    <!--Update Department Note Pop up-->
    <div class="modal" id="update_depnote_form_modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <form  id="update_depnote_form">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="add_contact_formTitle">Update Department Note</h3>
                        <button type="button" style="margin-top:-40px;" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" >
                            <div class="row" >
                                <div class="col-xs-2 job-label text-left" >
                                    <label>Department: </label>
                                </div>
                                <div class="col-xs-9 ">
                                    <select name="department" class="form-control" id="department">
                                        @foreach ($departments as $depp)

                                            <option value="{{$depp->id}}">{{$depp->description}}</option>


                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="row" >
                                <div class="col-xs-2 job-label text-left" >
                                    <label>Note: </label>
                                </div>
                                <div class="col-xs-9">

                                    <textarea class="form-control" name="updat_note" id="up_note"></textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" data-dismiss="modal" onclick='submit_update_dep_form()' id="submit" value="Update" class="btn btn-success">
                        <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>

                        <input type="hidden" name='dept' value='' id="udept"/>
                        <input type="hidden" name="note" value="" id="unote"/>
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

        $(document).ready(function() {
            $('#slabel').hide();

            $('#select_data').hide();
            $('#inventory_list').hide();
            $('#std_paper_list').hide();

            $("#std_paper").hide();
            $("#std_button").hide();
            $("#weight").hide();

            $("#select_paper_weight").hide();
            $("#size").hide();

            $("#select_paper_size").hide();
            $("#finishing_op_list").hide();

            $('#finishing_inventory_list').hide();
            $('#finishing_std_paper_list').hide();
            $("#finishing_std_paper").hide();
            $("#finishing_std_button").hide();
            $("#fweight").hide();
            $("#fsize").hide();

            var max_fields = 10; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID
            var x = 1;//initlal text box count

            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(

                        ' <tr class="row">' +
                        '<td>'+
                        ' <select class="form-control" name="add_sales[]">'+

                        '@foreach($sales as $sp)'+

                        ' <option value="{{$sp->id}}">{{$sp->name}}</option>'+


                        '@endforeach'+
                        '<option selected value="{{$sp->id}}">{{$sp->name}}</option>'+'</select>'+'</td>'
                        +'<td>'+
                        '<select class="form-control" name="add_product[]">'+
                        '@foreach($all_products as $all_product)'+

                        '<option value="{{$all_product->id}}">{{$all_product->description}}</option>'+

                        '@endforeach'+
                        '</select>'+

                        "</td>"+

                        '<td>'+
                        '<textarea rows="2" cols="70" type="text" name="add_desc[]" class="form-control" maxlength="50" required></textarea>'+
                        '</td>'+
                        '<td>'+
                        '<textarea rows="2" cols="70" type="text" name="add_desc2[]" class="form-control" maxlength="50" required></textarea>'+
                        '</td>'+
                        '<td><input type="text" value="1" name="add_qty[]" id="qty" class="qty form-control"/></td>'+
                        '<td><input type="text" value="1" name="add_width[]" id="finalWidth" class="width form-control"/></td>'+
                        '<td><input type="text" value="1" name="add_height[]" id="finalHeight" class="height form-control"/></td>'+
                        '<td><input type="text" value="1" name="add_unit_price[]" id="unit_price" class="unit_price form-control"/></td>'+
                        '<td><input type="text" value="1" name="add_sft_price[]" id="sft_price" class="sft_price form-control"/></td>'+
                        '<td><input type="text" value="1" name="add_total_price[]" class="total_price form-control"/></td>'+
                        '<td>'+
                        '<textarea rows="2" cols="70" type="text" name="add_price_list[]" id="price_list" class="price_list form-control" maxlength="50" ></textarea>'+
                        '<input type="hidden" name="add_price_list_id[]" id="price_list_id[]" class="price_list_id" value=""/>'+
                        '</td>' +
                        '<td>'+ '<a href="#" type="button" class="btn btn-small btn-danger remove_field">Delete</a>'+'</td>'+

                        +'</tr>'


                    ); //add input box
                }
            });

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text

                e.preventDefault(); $(this).closest("tr").remove(); x--;
            })
        })

        $(document).on("click", ".open-AddListDialog", function () {
            var myListId = $(this).data('id');
            console.log(myListId);
            //$(".modal-body #listId").val( myListId );
            document.getElementById('btnsearch').setAttribute("onclick", "search_list ( '" + myListId + "');");


            //$('#myList').modal('show');
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



        function calculate(part_id){
            $("#btn-edit"+0+part_id).hide();
            $("#btn-save"+0+part_id).show();
            $("#desc"+0+part_id).attr("readonly",false);
            $("#desc2"+0+part_id).attr("readonly",false);
            $("#sales"+0+part_id).attr("readonly",false);
            $("#qty"+0+part_id).attr("readonly", false); ;
            $("#finalw"+0+part_id).attr("readonly", false);
            $("#finalh"+0+part_id).attr("readonly", false);

            $("#unit_price"+0+part_id).attr("readonly", false);
            $("#sqft_price"+0+part_id).attr("readonly", false);

            $('textarea#price_list').val(" ");
            $("#price_list_id"+0+part_id).val('');
            $("#change_list"+0+part_id).text('+ Add price list');

            var qty=$("#qty"+0+part_id).val();
            var finalw=$("#finalw"+0+part_id).val();
            var finalh=$("#finalh"+0+part_id).val();
            var total_sqft=$("#total_sqft"+0+part_id).val();
            var unit_price=$("#unit_price"+0+part_id).val();

            var sqft_price=$("#sqft_price"+0+part_id).val();
            var total_price=$("#total_price"+0+part_id).val();


            $("#unit_price"+0+part_id).on("change", function() {

                //console.log("Change to " + this.value);
                var new_uprice=$(this).val();
                var subtotal=qty*new_uprice;
                var sfprice=(new_uprice/qty).toFixed(2)
                $("#total_price"+0+part_id).val(subtotal);
                $("#sqft_price"+0+part_id).val(sfprice);
            });

            $("#sqft_price"+0+part_id).on("change", function() {

                //console.log("Change to " + this.value);
                var new_sfprice=$(this).val();
                var subtotal=total_sqft*new_sfprice;
                var uprice=(subtotal/qty).toFixed(2);
                $("#total_price"+0+part_id).val(subtotal);
                $("#unit_price"+0+part_id).val(uprice);
            });

            $("#qty"+0+part_id).on("change", function() {

                //console.log("Change to " + this.value);
                var new_qty=$(this).val();
                var subtotal=unit_price*new_qty;

                $("#total_price"+0+part_id).val(subtotal);

            });

            $("#finalw"+0+part_id).on("change", function() {

                //console.log("Change to " + this.value);
                var new_width= $(this).val();
                $("#finalh"+0+part_id).on("change", function() {
                    var new_height = $("#finalh" + 0 + part_id).val();

                    var sqft=Math.ceil(new_width*new_height/144);
                    var total_sqft=sqft*qty;

                    var sfprice=(total_price/total_sqft).toFixed(2);

                    var subtotal=(sfprice*total_sqft).toFixed(2);


                    $("#total_sqft"+0+part_id).val(total_sqft);
                    $("#sqft_price"+0+part_id).val(sfprice);
                    $("#total_price"+0+part_id).val(subtotal);
                });

            });

            $("#finalh"+0+part_id).on("change", function() {

                //console.log("Change to " + this.value);
                var new_height= $(this).val();
                $("#finalw"+0+part_id).on("change", function() {
                    var new_width = $("#finalw" + 0 + part_id).val();

                    var sqft=Math.ceil(new_width*new_height/144);
                    var total_sqft=sqft*qty;

                    var sfprice=(total_price/total_sqft).toFixed(2);

                    var subtotal=(sfprice*total_sqft).toFixed(2);


                    $("#total_sqft"+0+part_id).val(total_sqft);
                    $("#sqft_price"+0+part_id).val(sfprice);
                    $("#total_price"+0+part_id).val(subtotal);
                });

            });


        }

        function search_list(part_id) {
            //console.log(part_id);
            var keyword = $('#price_list_search').val();
            //console.log(keyword);
            var qty = $("#qty" + part_id).val();
            //console.log(qty);
            var finalw = $("#finalw" + part_id).val();
            var finalh = $("#finalh" + part_id).val();
            var total_sqft = $("#total_sqft" + part_id).val();
            var unit_price = $("#unit_price" + part_id).val();
            var sqft=Math.ceil(finalw*finalh/144);
            //console.log(sqft);
            var sqft_price = $("#sqft_price" + part_id).val();
            var total_price = $("#total_price" + part_id).val();
            //console.log(keyword);
            $('#select_price_data')
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
                data: {'value': keyword}, // a JSON object to send back

                success: function (data) { // What to do if we succeed

                    var lg = data.msg.length;

                    $.each(data, function (index, value) {
                        if (lg !== 1) {
                            for (var x = 0; x < lg; x++) {
                                var div_data = "<option value=" + value[x].id + " selected>" + value[x].name + "</option>";
                                $(div_data).appendTo('#select_price_data');

                                $("#price_list"+part_id).val(value[x].name);
                                $("#price_list_id"+part_id).val(value[x].id);
                                $("#change_list"+part_id).text('+ Change price list');

                                //$row.find('.price_list').val(value[x].name);
                            }
                        } else {
                            var div_data = "<option value=" + value[0].id + " selected>" + value[0].name + "</option>";
                            $(div_data).appendTo('#select_price_data');
                            $("#price_list"+part_id).val(value[0].name);
                            $("#price_list_id"+part_id).val(value[0].id);
                            $("#change_list"+part_id).text('+ Change price list');


                            //$row.find('.price_list').val(value[0].name);
                        }

                        //alert(value["uom"]);
                    });


                    $(function ()  {
                        $("#myList").on("hidden.bs.modal", function() {
                            $(this)
                                .find("input,textarea,select")
                                .val('')
                                .end()
                                .find("input[type=checkbox], input[type=radio]")
                                .prop("checked", "")
                                .end();
                        });
                    });

                    $('#choose_list').unbind().click(function () {

                        var quote_id = parseInt($('#select_price_data').val());
                        console.log(quote_id);
                        //$row.find('#unit_price').val(quote_id);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            method: 'POST', // Type of response and matches what we said in the route
                            url: '/get_price', // This is the url we gave in the route
                            data: {'quote_id': quote_id, 'sqft': sqft, 'qty': qty}, // a JSON object to send back

                            success: function (data) {
                                $.each(data, function (index, value) {
                                    //console.log(data);
                                    var unit_price = value[0].unitPrice;


                                    var subtotal = (qty * unit_price).toFixed(2);
                                    //console.log($("#total_price"+0+part_id).val());
                                    //console.log($("#total_price"+0+part_id));
                                    $("#total_price"+part_id).val(subtotal);
                                    var sprice = (subtotal / total_sqft).toFixed(2)
                                    $("#sqft_price"+part_id).val(sprice);



                                });
                            },
                            error: function (jqXHR, textStatus, errorThrown) { // What to do if we fail
                                console.log(JSON.stringify(jqXHR));
                                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                            }
                        });


                    });
                    lg = 1;
                },
                error: function (jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });



        }


        function add_prepress(job,part_id,product_id) {
            $('#add_prepress_job').val(job);
            $('#add_prepress_part_id').val(part_id);
            $('#add_prepress_product_id').val(product_id);
        }
        function add_printer(job,part_id,product_id) {
            $('#add_printer_job').val(job);
            $('#add_printer_part_id').val(part_id);
            $('#add_printer_product_id').val(product_id);
        }

        function add_print_mode(job,part_id,product_id) {
            $('#add_print_mode_job').val(job);
            $('#add_print_mode_part_id').val(part_id);
            $('#add_print_mode_product_id').val(product_id);
        }

        function add_print_material(job,part_id,product_id){
            $('#add_print_mate_job').val(job);
            $('#add_print_mate_part_id').val(part_id);
            $('#add_print_mate_product_id').val(product_id);
        }

        function add_finish_op(job,part_id,product_id){
            $('#fin_op_job').val(job);
            $('#fin_op_part_id').val(part_id);
            $('#fin_op_product_id').val(product_id);
        }

        /* printing material functions start */
        $('#add_inventory_description').blur(function(){

            var keyword=$("#add_inventory_description").val();
            var job=$("#add_print_mate_job").val();
            var part=$("#add_print_mate_part_id").val();
            var product=$("#add_print_mate_product_id").val();


            /*$('#select_data_inventory')
                .find('option')
                .remove()
                .end();*/

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: '/search_inventory_item', // This is the url we gave in the route
                data: {'value': keyword, 'job':job, 'part': part, 'product':product}, // a JSON object to send back

                success: function(data){ // What to do if we succeed

                    var lg=data.msgg.length;
                    //var lgg=data.msg.length;
                    //console.log(data);
                    //console.log(lg);
                    // console.log(lgg);

                    $.each(data, function (index, value) {
                        if (lg !== 1) {
                            for (var x = 0; x < lg; x++) {
                                var div_data = "<option value=" + value[x].id + " class='bold-option' selected>" + "Qty in hand:" + "[" + value[x].qtyOnHand + "]" + "&nbsp;&nbsp;-&nbsp;&nbsp;" + value[x].description + "</option>";
                                //$('.int_input').hide();
                                //$('#inventory_item').hide();
                                $('#inventory_list').show();

                                $(div_data).appendTo('#select_data_inventory');
                                //$('#select_data_inventory').append(div_data);

                            }
                        } else {
                            var div_data = "<option value=" + value[0].id + " selected>" + value[0].description + "</option>";
                            // $('#inventory_item').hide();
                            $('#inventory_list').show();

                            $(div_data).appendTo('#select_data_inventory');
                        }


                    });

                    lg=1;

                    $(function ()  {
                        $("#PrintMaterialModal").on("hidden.bs.modal", function() {
                            $("#inventory_list").hide();
                            $("#inventory_item").show();
                        });
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    //console.log(JSON.stringify(jqXHR));
                    // console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    alert ('There is no such inventory item, you can search material from standard paper temporarily. If the material is often used, please add it to inventory.');
                    $("#inventory_item").hide();
                    $("#inventory_list").hide();
                    $("#int_button").hide();
                    $("#std_paper").show();
                    $("#std_button").show();
                    //var div_data = "No inventory Item";
                    //$(div_data).appendTo('#error');
                }
            });
        });

        $('#search_paper').blur(function(){
            var keyword=$("#search_paper").val();
            var job=$("#add_print_mate_job").val();
            var part=$("#add_print_mate_part_id").val();
            var product=$("#add_print_mate_product_id").val();
           /* $('#select_data_std_paper')
                .find('option')
                .remove()
                .end();*/

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: '/search_std_paper', // This is the url we gave in the route
                data: {'value': keyword, 'job':job, 'part': part, 'product':product}, // a JSON object to send back

                success: function(data){ // What to do if we succeed
                    // alert("Success");
                    var lg=data.std_paper.length;
                    //var lgg=data.msg.length;
                    //console.log(data);
                    //console.log(lg);
                    // console.log(lgg);

                    $.each(data, function (index, value) {
                        if (lg !== 1) {
                            for (var x = 0; x < lg; x++) {
                                var div_data = "<option value=" + value[x].code + " class='bold-option' selected>" +  value[x].description + "</option>";
                                $('#inventory_item').hide();
                                $('#std_paper').show();
                                $('#std_paper_list').show();

                                $(div_data).appendTo('#select_data_std_paper');

                            }
                        } else {
                            var div_data = "<option value=" + value[0].code + " selected>" + value[0].description + "</option>";
                            $('#inventory_item').hide();
                            $('#std_paper').show();
                            $('#std_paper_list').show();

                            $(div_data).appendTo('#select_data_std_paper');
                        }


                    });

                    lg=1;

                    $(function ()  {
                        $("#PrintMaterialModal").on("hidden.bs.modal", function() {
                            $("#std_paper_list").hide();
                            $('#weight').hide();
                            $('#size').hide();
                            $('#std_paper').hide();
                            $("#inventory_item").show();
                            $("#int_button").show();
                            $("#std_button").hide();
                        });
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    //console.log(JSON.stringify(jqXHR));
                    // console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    alert ('There is no such standard paper, please add it.');
                    /* alert ('There is no such inventory item, you can search material from standard paper instead.');
                     $("#inventory_item").hide();
                     $("#int_button").hide();
                     $("#std_paper").show();
                     $("#std_button").show();*/
                    //var div_data = "No inventory Item";
                    //$(div_data).appendTo('#error');
                }
            });
        });

        function std_paper_weight(value){

            /*$('#select_paper_weight,#select_paper_size')
                .find('option')
                .remove()
                .end();*/

            //alert(value);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:'/paper_weight',
                data:{value:value},
                success:function (data) {
                    var lg=data.paper_weight.length;
                    $.each(data, function (index, value) {
                        if (lg !== 1) {
                            for (var x = 0; x < lg; x++) {
                                var div_data = "<option value=" + value[x].id + " class='bold-option' >" +  value[x].weight + "</option>";
                                //$('.int_input').hide();
                                $('#weight').show();
                                $('#select_paper_weight').show();
                                $(div_data).appendTo('#select_paper_weight');

                            }
                        } else {
                            var div_data = "<option value=" + value[0].id + " >" + value[0].weight + "</option>";
                            $('#weight').show();
                            $('#select_paper_weight').show();
                            $(div_data).appendTo('#select_paper_weight');
                        }
                    })
                },
                error: function () {

                }

            });

        }

        function std_paper_size(value){

           /* $('#select_paper_size')
                .find('option')
                .remove()
                .end();
            // alert(value);*/

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:'/paper_size',
                data:{value:value},
                success:function (data) {
                    var lg=data.paper_size.length;
                    console.log(lg);
                    console.log(data);
                    $.each(data, function (index, value) {

                        for (var x = 0; x <lg; x++) {
                            //var width=value[x].width;
                            //var height=value[x].height;

                            //console.log(width);
                            // console.log(height);
                            if(jQuery.isEmptyObject(value[x].height)){ var div_data = "<option value=" + value[x].id + " class='bold-option' >" + value[x].width  + "</option>";}
                            else{ var div_data = "<option value=" + value[x].id + " class='bold-option' >" +  value[x].width +"x"+ value[x].height + "</option>";}

                            //$('.int_input').hide();
                            $('#size').show();
                            $('#select_paper_size').show();
                            $(div_data).appendTo('#select_paper_size');



                        }

                        lg=1;
                    })
                },
                error: function () {
                    //alert ('error');
                }

            });

        }

        /*printing material functions end */

        /*finishing material functions start */
        function add_finishing_material(job,fin_id,part_id,product_id){
            $('#add_finishing_mate_job').val(job);
            $('#add_finishing_mate_fin_id').val(fin_id);
            $('#add_finishing_mate_part_id').val(part_id);
            $('#add_finishing_mate_product_id').val(product_id);
        }
        $('#finishing_inventory').blur(function(){

            var keyword=$("#finishing_inventory").val();
            var job=$("#add_finishing_mate_job").val();
            var part=$("#add_finishing_mate_part_id").val();
            var product=$("#add_finishing_mate_product_id").val();


            /*$('#finishing_inventory')
                .find('option')
                .remove()
                .end();*/

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: '/search_inventory_item', // This is the url we gave in the route
                data: {'value': keyword, 'job':job, 'part': part, 'product':product}, // a JSON object to send back

                success: function(data){ // What to do if we succeed

                    var lg=data.msgg.length;
                    //var lgg=data.msg.length;
                    //console.log(data);
                    //console.log(lg);
                    // console.log(lgg);

                    $.each(data, function (index, value) {
                        if (lg !== 1) {
                            for (var x = 0; x < lg; x++) {
                                var div_data = "<option value=" + value[x].id + " class='bold-option' selected>" + "Qty in hand:" + "[" + value[x].qtyOnHand + "]" + "&nbsp;&nbsp;-&nbsp;&nbsp;" + value[x].description + "</option>";
                                //$('.int_input').hide();
                                //$('#inventory_item').hide();
                                $('#finishing_inventory_list').show();

                                $(div_data).appendTo('#select_finishing_inventory');
                                //$('#select_data_inventory').append(div_data);


                            }
                        } else {
                            var div_data = "<option value=" + value[0].id + " selected>" + value[0].description + "</option>";
                            // $('#inventory_item').hide();
                            $('#finishing_inventory_list').show();

                            $(div_data).appendTo('#select_finishing_inventory');

                        }


                    });

                    lg=1;

                    $(function ()  {
                        $("#FinishingMaterialModal").on("hidden.bs.modal", function() {
                            $("#finishing_inventory_list").hide();
                            $("#select_finishing_inventory").show();
                        });
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    //console.log(JSON.stringify(jqXHR));
                    // console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    alert ('There is no such inventory item, you can search material from standard paper temporarily. If the material is often used, please add it to inventory.');
                    $("#finishing_inventory_item").hide();
                    $("#finishing_inventory_list").hide();
                    $("#finishing_int_button").hide();
                    $("#finishing_std_paper").show();
                    $("#finishing_std_button").show();
                    //var div_data = "No inventory Item";
                    //$(div_data).appendTo('#error');
                }
            });
        });

        $('#search_finishing_paper').blur(function(){
            var keyword=$("#search_finishing_paper").val();
            var job=$("#add_finishing_mate_job").val();
            var part=$("#add_finishing_mate_part_id").val();
            var product=$("#add_finishing_mate_product_id").val();
            /*$('#select_finishing_std_paper')
                .find('option')
                .remove()
                .end();*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: '/search_std_paper', // This is the url we gave in the route
                data: {'value': keyword, 'job':job, 'part': part, 'product':product}, // a JSON object to send back

                success: function(data){ // What to do if we succeed
                    // alert("Success");
                    var lg=data.std_paper.length;
                    //var lgg=data.msg.length;
                    //console.log(data);
                    //console.log(lg);
                    // console.log(lgg);

                    $.each(data, function (index, value) {
                        if (lg !== 1) {
                            for (var x = 0; x < lg; x++) {
                                var div_data = "<option value=" + value[x].code + " class='bold-option' selected>" +  value[x].description + "</option>";
                                $('#finishing_inventory_item').hide();
                                $('#finishing_std_paper').show();
                                $('#finishing_std_paper_list').show();

                                $(div_data).appendTo('#select_finishing_std_paper');

                            }
                        } else {
                            var div_data = "<option value=" + value[0].code + " selected>" + value[0].description + "</option>";
                            $('#finishing_inventory_item').hide();
                            $('#finishing_std_paper').show();
                            $('#finishing_std_paper_list').show();

                            $(div_data).appendTo('#select_finishing_std_paper');
                        }


                    });

                    lg=1;

                    $(function ()  {
                        $("#FinishingMaterialModal").on("hidden.bs.modal", function() {
                            $("#finishing_std_paper_list").hide();
                            $('#fweight').hide();
                            $('#fsize').hide();
                            $('#finishing_std_paper').hide();
                            $("#finishing_inventory_item").show();
                            $("#finishing_int_button").show();
                            $("#finishing_std_button").hide();
                        });
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    //console.log(JSON.stringify(jqXHR));
                    // console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    alert ('There is no such standard paper, please add it.');
                    /* alert ('There is no such inventory item, you can search material from standard paper instead.');
                     $("#inventory_item").hide();
                     $("#int_button").hide();
                     $("#std_paper").show();
                     $("#std_button").show();*/
                    //var div_data = "No inventory Item";
                    //$(div_data).appendTo('#error');
                }
            });
        });

        function finishing_std_paper_weight(value){

            $('#select_finishing_paper_weight,#select_finishing_paper_size')
                .find('option')
                .remove()
                .end();
            //alert(value);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:'/paper_weight',
                data:{value:value},
                success:function (data) {
                    var lg=data.paper_weight.length;
                    $.each(data, function (index, value) {
                        if (lg !== 1) {
                            for (var x = 0; x < lg; x++) {
                                var div_data = "<option value=" + value[x].id + " class='bold-option' >" +  value[x].weight + "</option>";
                                //$('.int_input').hide();
                                $('#fweight').show();
                                $('#select_finishing_paper_weight').show();
                                $(div_data).appendTo('#select_finishing_paper_weight');

                            }
                        } else {
                            var div_data = "<option value=" + value[0].id + " >" + value[0].weight + "</option>";
                            $('#fweight').show();
                            $('#select_finishing_paper_weight').show();
                            $(div_data).appendTo('#select_finishing_paper_weight');
                        }
                    })
                },
                error: function () {

                }

            });

        }

        function finishing_std_paper_size(value){

            $('#select_finishing_paper_size')
                .find('option')
                .remove()
                .end();
            // alert(value);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:'/paper_size',
                data:{value:value},
                success:function (data) {
                    var lg=data.paper_size.length;
                    console.log(lg);
                    console.log(data);
                    $.each(data, function (index, value) {

                        for (var x = 0; x <lg; x++) {
                            //var width=value[x].width;
                            //var height=value[x].height;

                            //console.log(width);
                            // console.log(height);
                            if(jQuery.isEmptyObject(value[x].height)){ var div_data = "<option value=" + value[x].id + " class='bold-option' >" + value[x].width  + "</option>";}
                            else{ var div_data = "<option value=" + value[x].id + " class='bold-option' >" +  value[x].width +"x"+ value[x].height + "</option>";}

                            //$('.int_input').hide();
                            $('#fsize').show();
                            $('#select_finishing_paper_size').show();
                            $(div_data).appendTo('#select_finishing_paper_size');



                        }

                        lg=1;
                    })
                },
                error: function () {
                    //alert ('error');
                }

            });

        }
        /*finishing material functions end */

        $('#search_fin_ope').blur(function(){
            //alert ('ahhhhhhhh');
            var keyword=$("#search_fin_ope").val();
            var job=$("#fin_op_job").val();
            var part=$("#fin_op_part_id").val();
            var product=$("#fin_op_product_id").val();


            $('#select_data_fin_op')
                .find('option')
                .remove()
                .end();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: '/search_fin_op', // This is the url we gave in the route
                data: {'value': keyword, 'job':job, 'part': part, 'product':product}, // a JSON object to send back

                success: function(data){ // What to do if we succeed
                    //console.log('success');
                    //console.log(data);
                    //alert('ahhh');
                    var lg=data.fin_op.length;
                    //var lgg=data.msg.length;
                    //console.log(data);
                    //console.log(lg);
                    // console.log(lgg);


                    $.each(data, function (index, value) {

                        for (var x = 0; x < lg; x++) {
                            var div_data = "<option value=" + value[x].id + " class='bold-option' selected>" +  value[x].description + "</option>";
                            //$('.int_input').hide();

                            $('#search_fin').hide();
                            $('#finishing_op_list').show();
                            $(div_data).appendTo('#select_data_fin_op');
                            //$('#select_data_inventory').append(div_data);

                        }
                    });

                    lg=1;

                    $(function ()  {
                        $("#FinishingOpModal").on("hidden.bs.modal", function() {
                            $("#finishing_op_list").hide();
                            $("#search_fin").show();
                        });
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail

                    //console.log("fail");
                    alert ('There is no such finish operation');
                    $("#finishing_op_list").hide();
                    $("#search_fin").show();

                }
            });
        });

        function arrange_sort(fid,job,part_id,product_id){
            var sort_fid=$("input[name='seq."+part_id+".[]']")
            //console.log(sort_fid);
            var temp=[];
            var list=$("input[name='fin."+part_id+".[]']").map(function(index){
                temp.push(sort_fid.eq(index).val());
                return{
                    finishing:$(this).val(),
                    seq:sort_fid.eq(index).val(),
                };
            }).get();
            //console.log(list);
            list1=JSON.stringify(list);
            //console.log(list1);
            temp.sort();
            if(temp.length==new Set(temp).size){
                console.log(list1);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url:'/sort_fin_mat',
                    data:{item:list1,part:part_id,job:job,product:product_id},
                    async:true,
                    success: function(response){


                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        },1000);
                        alert("Finishing sequence has been rearranged");
                    }
                })
            }
            else{
                alert ("Sequence must be unique");
            }
        }

        function add_all_parts(){
            var sales=$("select[name='add_sales[]']");
            var products=$("select[name='add_product[]']");
            var desc2=$("textarea[name='add_desc2[]']");
            var qty=$("input[name='add_qty[]']");
            var width=$("input[name='add_width[]']");
            var height=$("input[name='add_height[]']");
            var uprice=$("input[name='add_unit_price[]']");
            var sftprice=$("input[name='add_sft_price[]']");
            var total_price=$("input[name='add_total_price[]']");
            var price_list=$("textarea[name='add_price_list[]']");
            var price_list_id=$("input[name='add_price_list_id[]']");

            var job=$("#job").val();
            var product=$("#product").val();
            var part=$("#part").val();
            console.log(desc2);
            var list=$("textarea[name='add_desc[]']").map(function(index){
                return{
                    sales:sales.eq(index).val(),
                    products:products.eq(index).val(),
                    desc: $(this).val(),
                    desc2: desc2.eq(index).val(),
                    qty:qty.eq(index).val(),
                    width:width.eq(index).val(),
                    height:height.eq(index).val(),
                    uprice:uprice.eq(index).val(),
                    sftprice:sftprice.eq(index).val(),
                    total_price:total_price.eq(index).val(),
                    price_list:price_list.eq(index).val(),
                    price_list_id:price_list_id.eq(index).val(),
                }
            }).get()

            all_part_list=JSON.stringify(list);
            var counter_list=0;
            $.each(list,function(key,value){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url:'/add_part',
                    data:{job:job,product:product,part:part,products:value.products,description:value.desc,add_desc:value.desc2,quantity:value.qty,width:value.width,height:value.height,unitprice:value.uprice,sqftprice:value.sftprice,sales:value.sales,price_list:value.price_list,price_list_id:value.price_list_id,total_price:value.total_price},
                    async:false,
                    success: function(response){


                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        },1000);

                    }
                })
            });

        }


        $('#expand_all').on('click', function () {
            $('#parts .panel-collapse').collapse('toggle');
        });

        function submit_add_dep_form(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url: '/add_dept_note',
                data:$("#add_depnote_form").serialize(),
                async: false,
                success: function(response){
                    //$("#depnote_table").html(response);
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        }
        function update_depnote(jn_id,dep_id){
            $('#dept').val(dep_id);
            $('#unote').val(jn_id);
            //console.log(jn_id,dep_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url: '/get_dept_note',
                data:{jid:jn_id,did:dep_id},
                async: false,
                success: function(data){
                    console.log(data);
                    $.each(data, function (index, value) {

                        //$("#depnote_table").html(response);
                        $('textarea#up_note').val(value.note);
                        //console.log(value.department);
                        //$(".id_100 select").val(value.department);

                        $("#department option[value="+value.department+"]").attr('selected', 'selected');
                        /* $('.id_100 option').each(function() {
                             if($(this).val() == value.department) {
                                 $(this).prop("selected", true);
                             }
                         });*/
                        //$("div.id_100 > select > option[value=" + value.department + "]").attr("selected",true);

                        $(function ()  {
                            $("#update_depnote_form_modal").on("hidden.bs.modal", function() {
                                $("#department option[value="+value.department+"]").removeAttr('selected', 'selected');

                                ;
                            });
                        });
                    })

                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });

        }
        function submit_update_dep_form(){
            var job_id=$('#ujob').val();
            var dept_id=$('#udept').val();
            var note_id=$('#unote').val();
            var dept=$('#department').val();
            var note=$('textarea#up_note').val();

            console.log(note_id,dept,note);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url: '/update_depnote',
                data: {job_id:job_id,dept_id:dept_id,note_id:note_id,dept:dept,note:note},
                async: false,
                success: function(response) {
                    setTimeout(function(){// wait for 5 secs(2)
                        location.reload(); // then reload the page.(3)
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }

            });
        }
    </script>
@endsection