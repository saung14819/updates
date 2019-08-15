@extends('layout_report')
@section('content')

<style>
    .bigger {
        font-size: 18px !important;
        color: #000 !important;
        font-family: 'Segoe UI', Arial, sans-serif;
        -webkit-print-color-adjust: exact;
    }
    .big{
        font-size: 20px !important;
        color: #000 !important;
        font-family: 'Segoe UI', Arial, sans-serif;
        -webkit-print-color-adjust: exact;
    }
    .indent{
        padding-left: 20px;

    }
    .indent_table{
        padding-left: 50px;

    }
    .bg {
            background: #d6d8db !important;
            -webkit-print-color-adjust: exact;
    }
    .table-bordered th{
        background: #d6d8db !important;
        -webkit-print-color-adjust: exact;
    }

    .article{
        text-align: center;
    }

    @media all{
        .page-break{display:none;}
    }

    @media print {
        .page-break{display:block;page-break-before: always;}
    }
    .verticle{
        writing-mode: vertical-rl;
        text-orientation: mixed;
        font-size:18px;
    }
</style>


    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class=" p-0">


                    <!--title section -->
                        <div class="row p-5">
                            <div class="col-md-5">

                                <p class="font-weight-bold"><h2><b>Job Number:</b>{{$jobs->job}}</h2></p>
                                <p class="font-weight-bold"><h3><b>Entered by:</b>{{$csr->name}}</h3></p>
                                <p class="font-weight-bold"><h2><b>Job PO:</b>{{$jobs->poNum}}</h2></p>

                                <!--<p class="font-weight-bold mb-1">PO:</p>-->
                            </div>
                            <div class="col-md-2">
                               &nbsp;
                            </div>
                            <div class="col-md-5 pull-right">


                                <p class="font-weight-bold "><h2><b>Due Date:{{$jobs->promiseDate->toDateString()}}</b></h2></p>
                                <p class="font-weight-bold "><h3><b>Payment Terms:{{$terms->description}}</b></h3></p>
                            </div>

                        </div>
                    <!-- title section end-->


                    <!-- Contact info section-->
                        <div class="row pb-5 p-5">
                            <div class="col-md-5  bigger">
                                @if($billto!==0)
                                    @foreach($billto as $bt)
                                        @php $i=0; @endphp
                                        @if(!empty($jbcontactid))
                                            <p class="font-weight-bold"><h4><b><u>Ordered by:</u></b></h4></p>
                                            <p ><h4><b>Customer:</b>{{$bt->companyName}}</h4></p>
                                            <p ><h4><b>Billed Contact:</b>{{$bt->firstName}} {{$bt->lastName}}</h4></p>
                                            <p ><h4><b>Phone Number:</b>{{$bt->businessPhoneNumber}}</h4></p>
                                            <p >
                                            <h4><b>Billed Address:</b>
                                                {{$bt->address1}}
                                                @if(isset($bt->address2))
                                                    ,{{$bt->address2}}
                                                @endif
                                                @if(isset($bt->city))
                                                    ,{{$bt->city}}
                                                @endif
                                                @if(isset($bt->state))
                                                    ,({{$bt->state}})
                                                @endif
                                                @if(isset($bt->zip))
                                                   ,{{$bt->zip}}
                                                @endif
                                            </h4></p>
                                        @endif
                                    @endforeach
                                @endif

                            </div>
                            <div class="col-md-1">
                                <p>&nbsp;</p>
                            </div>
                            <div class="col-md-4 pull-right">
                                @if($shipto!==0)
                                    @php $i=0; @endphp
                                    @foreach($shipto as $st)
                                        @if(!empty($jscontactid))
                                            <p class="font-weight-bold"><h4><b><u>Shipment Detail:</u></b></h4></p>
                                            <p class="mb-1"><h4><b>Shipped To:</b>{{$st->companyName}}</h4></p>
                                            <p class="mb-1"><h4><b>Attn:</b>{{$st->firstName}} {{$st->lastName}}</h4></p>
                                            <p class="mb-1"><h4><b>Phone Number:</b>{{$st->businessPhoneNumber}}</h4></p>
                                            <p class="mb-1"><h4><b>Shipped Address:</b>
                                                {{$st->address1}}
                                                @if(isset($st->address2))
                                                    ,{{$st->address2}}
                                                @endif
                                                @if(isset($st->city))
                                                    ,{{$st->city}}
                                                @endif
                                                @if(isset($st->state))
                                                 ,({{$st->state}})
                                                @endif
                                                @if(isset($st->zip))
                                                   ,{{$st->zip}}
                                                @endif
                                            </h4></p>



                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-md-2 verticle pull-right">
                               <h3><b>{{$jobs->job}}</b></h3>
                                @if($billto!==0)
                                    @foreach($billto as $bt)
                                        @php $i=0; @endphp
                                        @if(!empty($jbcontactid))
                                           <b> {{$bt->companyName}}</b>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <!--contact info section end-->

                        <!--Department note section-->
                        <div class="row p-0 bigger">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead class="thead-light">

                                    <tr class="bg">
                                        <th class="border-0 text-uppercase  font-weight-bold"> <h5><b>Department</b></h5></th>
                                        <th class="border-0 text-uppercase  font-weight-bold"> <h5><b>Note</b></h5></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($departments as $dept)
                                        @if(!empty($job_notes))
                                            @foreach($job_notes as $jn)
                                                @if($dept->id==$jn->department)


                                    <tr>
                                        <td width="30%">
                                            {{$dept->description}}
                                        </td>
                                        <td> {{$jn->note}}</td>

                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- deparment note section end -->

                        <!-- Products PO section-->
                        <div class="row p-0 bigger">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                   <thead class="thead-light">
                                    <tr class="bg">
                                        <th class="border-0 text-uppercase  font-weight-bold"> <h5><b>Products PO</b></h5></th>
                                        <th class="border-0 text-uppercase  font-weight-bold"> <h5><b>Job Name:</b></h5></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td width="30%">
                                            @foreach($jobproduct as $product)
                                                @if($product->description!='Shipping')
                                                    @if(isset($product->U_PO))
                                                   <h4>{{$product->U_PO}}&nbsp;/</h4>

                                                    @endif
                                                @endif

                                            @endforeach
                                        </td>
                                        <td><h4>{{$jobs->description}}</h4></td>

                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Products PO section end -->

                      <!--product section -->

                        @php $count=1; @endphp
                        @foreach($jobproduct as $product)
                            @if($product->description!='Shipping')

                        <div class="row p-0 bigger">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>No</th>
                                        <th>Product Description</th>
                                        <th>Due Date :  @if(isset($product->U_DueDate))

                                                {{$product->U_DueDate->toDateString()}}

                                            @endif</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            P{{$count++}}
                                        </td>
                                        <td colspan="2">
                                            {{$product->description}}
                                            <br/>
                                            <h4><u>Additional Description</u></h4>
                                            @if(isset($product->additionalDescription))
                                                <span> {{$product->additionalDescription}}</span><br/>
                                            @endif
                                        </td>

                                    </tr>

                                </table>
                            </div>
                        </div>
                        <!-- Product section end-->
                                <!-- Parts section start -->
                            @php $pcount=1; @endphp
                                @foreach($jobparts as $jp)
                                    @if($jp->description!='Shipping' )
                                        @if($jp->jobProduct==$product->id)

                        <div class="row p-0 bigger">
                            <div class="col-md-12 indent_table" >
                                <!-- head part-->
                                <table class="table table-bordered">

                                    <thead >
                                    <!--<tr class="border-top-0">

                                        <td class="border-top-0">Part #</td>
                                        <td class="border-top-0">Part Description</td>
                                        <td class="border-top-0">Quantity</td>
                                    </tr>-->
                                    </thead>

                                    <tbody>
                                    <tr >
                                        <td width="10%">p{{$count-1}}.{{$pcount++}}</td>
                                        <td>{{$jp->description}}@if($product->U_PO!==null) (Product PO#:{{$product->U_PO}}) @endif</td>
                                        <td width="10%">Qty:{{$jp->qtyOrdered}}</td>
                                    </tr>
                                    </tbody>

                                </table>
                                <!-- head part end -->


                                    <table cellspacing="2" cellpadding="3">

                                        <!-- total sqft -->
                                        <tr>
                                            <td class="indent">Total sq ft :&nbsp;</td>
                                            <td class="pull-right">{{$jp->U_total_sqt}} &nbsp;sq ft</td>
                                        </tr>

                                        <!-- final size-->
                                        <tr>
                                            <td class="indent">Final size :&nbsp;</td>
                                            <td>{{$jp->finalSizeW}}&nbsp;in x {{$jp->finalSizeH}} &nbsp;in</td>
                                        </tr>


                                        <!-- Print Mode -->
                                        @if(isset($jp->U_PrintMode))
                                            <tr>
                                                <td class="indent" width="15%">Printer :&nbsp;</td>
                                                <td >
                                                    {{$jp->U_PrintMode}} |
                                                    <!-- Printer -->
                                                    @foreach($printer as $print)
                                                        @if($jp->jobPart==$print->jobPart)

                                                            @foreach($printers as $prt)
                                                                @if($prt->id==$print->press)

                                                                    {{$prt->description}}

                                                                    @if($prt->id==$print->press)
                                                                        @if(isset($prt->note)) | {{$prt->note}}@endif
                                                                        @if($materials!=null)
                                                                            @for($i=0;$i<count($materials);$i++)

                                                                                @foreach($materials[$i] as $mat)

                                                                                    @if($jp->jobPart==$mat->jobPart)


                                                                                        @if($mat->paper==true)

                                                                                            | {{$mat->description}}



                                                                                        @else

                                                                                            {{$mat->description}} / Weight : {{$mat->weight}} / Size: {{$mat->buySize}}


                                                                                        @endif



                                                                                    @endif

                                                                                @endforeach

                                                                            @endfor

                                                                        @endif
                                                                    @endif


                                                                @endif
                                                            @endforeach

                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endif





                                        <!-- finishing -->
                                        @for($i=0;$i<count($finishing);$i++)

                                            @foreach($finishing[$i] as $fin)
                                                @if($fin!==null)
                                                    @if($jp->jobPart==$fin->jobPart)
                                                        @foreach($finishing_operation as $fop)
                                                            @if($fop->id==$fin->finishingOperation)
                                                                <tr>
                                                                    <td class="indent">Finishing :&nbsp;</td>
                                                                    <td>


                                                                        {{$fop->description}}
                                                                        @if(isset($fin->U_Material))
                                                                            | {{$fin->U_Material}}
                                                                        @endif
                                                                        @if(isset($fin->note))
                                                                            |  {{$fin->note}}
                                                                        @endif


                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                @endif
                                            @endforeach
                                        @endfor


                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>

                                    </table>




                            </div>
                        </div>

                                        @endif
                                    @endif
                                @endforeach
                                            <hr/>

                            @endif
                        @endforeach

                    </div>
                    <!-- Parts section end -->
                    <div class="page-break"></div>

                    <!-- Shipping section start-->
                    @if(count($job_shipment)>1)
                    <div class="row p-0 bigger">


                        @if($job_shipment!=='null' && $carton_id!=='null' && $carton_content!=='null' && $carton_products!=='null'  )
                            @foreach($job_shipment as $job_ship)
                                <table class="table table-bordered">
                                    <tr>
                                        <th colspan="4" class="article">Shipment</th>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <b>Address:</b>{{$job_ship->name}}
                                            @if($job_ship->address1!=null),{{$job_ship->address1}}@endif
                                            @if($job_ship->city!=null),{{$job_ship->city}}@endif
                                            @if($job_ship->zip!=null),{{$job_ship->zip}}@endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5><b>Name:</b></h5>{{$job_ship->contactFirstName}}&nbsp;{{$job_ship->contactLastName}}
                                        </td>
                                        <td>
                                            <h5><b>Shipment ID:</b></h5> {{$job_ship->id}}
                                        </td>
                                        <td>
                                            <h5><b>ShipVia:</b></h5>
                                            @foreach( $all_shipvia as $all_ship)

                                                @php


                                                    $provider = array_unique($all_provider);
                                                @endphp
                                                @foreach($provider as $ship_pro)
                                                    @if($all_ship->provider==$ship_pro->id)
                                                        @if($job_ship->shipVia==$all_ship->id)
                                                            {{$ship_pro->name}} - {{$all_ship->description}}
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </td>
                                        <td>
                                            <h5><b>Promise Date:</b></h5>{{$job_ship->promiseDate->toDateString()}}
                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-bordered">
                                    <tr>
                                        <td>
                                            Product
                                        </td>
                                        <td>
                                            PO#
                                        </td>
                                        <td>
                                            Shipped Qty
                                        </td>
                                        <td>
                                            Box#
                                        </td>
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
                                                                    {{$cp->description}} <br/>
                                                                    {{$cp->additonalDescription}}
                                                                </td>
                                                                <td>
                                                                   <b>PO#</b> {{$cp->U_PO}}
                                                                </td>
                                                                <td>
                                                                    {{$cc->quantity}}
                                                                </td>
                                                                <td>

                                                                </td>
                                                            </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endfor
                                </table>
                            @endforeach
                        @endif

                    </div>
                    @endif
                    <!-- Shipping section end -->
                </div>
            </div>
        </div>



    </div>



@endsection