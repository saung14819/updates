@extends('layout')
@section('content')



    <table cellpadding="2" cellspacing="0" border="0" style="width: 50%; margin: 0 auto 2em auto;">
        <tr><td align="center" colspan="6"><h3><u>Search Open Jobs:</u></h3></td></tr>
        <tr>

            <td>
                <table>
                    <tr id="filter_col1" data-column="0">

                        <td align="center"> Job:<input type="text" class="column_filter form-control" id="col0_filter"></td>

                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr id="filter_col2" data-column="1">

                        <td align="center">Status:<input type="text" class="column_filter form-control" id="col1_filter"></td>

                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr id="filter_col3" data-column="4">

                        <td align="center">Customer:<input type="text" class="column_filter form-control" id="col4_filter"></td>

                    </tr>
                </table>
            </td>
           <!-- <td>
                <table>
                    <tr>

                        <td >
                            <h5>Promise Date:</h5>



                            <div id="reportrange2" class="btn btn-primary btn-md">

                                <span></span> <b class="caret"></b>
                            </div>

                        </td>

                    </tr>
                </table>
            </td>-->
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr id="filter_col4" data-column="5">

                        <td align="center">Description:<input type="text" class="column_filter form-control" id="col5_filter"></td>

                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                    <tr id="filter_col5" data-column="6">

                        <td align="center">PO:<input type="text" class="column_filter form-control" id="col6_filter"></td>

                    </tr>
                    </tr>
                </table>
            </td>
            <td>
                <table >
                    <tr id="filter_col6" data-column="9">
                        <td align="center">
                            Entered by:<input type="text" class="column_filter form-control" id="col9_filter">
                        </td>
                    </tr>
                </table>
            </td>
            <!--<td>
                <table>
                    <tr data-column="7">
                        <h5>Date Entered:</h5>
                        <td >
                            <div id="reportrange" class="btn btn-success btn-md">

                                <span></span> <b class="caret"></b>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>-->
        </tr>
    </table>
    <hr/>

    <div class="center"><button data-toggle="modal" data-target="#searchOldJobModal" class="btn btn-lg btn-warning center-block"><i class="fas fa-search-plus"></i> Search Old Jobs:<br/>[Closed/Cancelled/Shipped]</button></div>


    <!-- Search Old jobs modal -->
    <div class="modal fade" id="searchOldJobModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">Search Old Jobs:</h3>
                </div>
                <div class="modal-body">

                    <!-- content goes here -->
                    <form role="form" method="post" action="search">
                        @csrf
                        <div class="form-group">
                            <label for="Job Number">Search by job number:</label>
                            <input type="text" class="form-control" id="job_number" placeholder="Enter Job Number" name="job_number">
                        </div>

                        <div class="form-group">
                            <label for="Customer name">Search by customer name:</label><br/>
                            <!--<input type="text" class="form-control" id="customer_name" placeholder="Enter Customer Name" name="customer_name">-->
                            <select class="selectpicker" data-live-search="true" name="customer_name" title="Choose Customer">
                                @foreach($customerlist as $custlist)
                                    <option value='{{$custlist->id}}'>{{$custlist->custName}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="Description">Search by description:</label>
                            <input type="text" class="form-control" id="description" placeholder="Enter Description" name="description">
                        </div>
                        <div class="form-group">
                            <label for="PO">Search by P.O:</label>
                            <input type="text" class="form-control" id="po" placeholder="Enter P.O Number" name="po">
                        </div>
                        <div class="form-group">
                            <label for="From date">From date</label>
                            <input type="text" class="form-control" id="from_date" placeholder="Enter From Date" name="from_date" value="">
                            <span style="color:red;">**if you don't set the date for the search by Customer,the searching time may be longer due to large records of data**</span>
                        </div>
                        <div class="to-group">
                            <label for="From date">To date</label>
                            <input type="text" class="form-control" id="to_date" placeholder="Enter From Date" name="to_date" value="">
                            <span style="color:red;">**if you don't set the date for the search by Customer,the searching time may be longer due to large records of data**</span>
                        </div>
                        <br/>
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-lg btn-success center-block">Search</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>


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

    <table class="table table-striped table-bordered" id="table">
        <thead>
        <tr>
            <th class="text-center">Job</th>
            <th class="text-center">Status</th>
            <th class="text-center">Term</th>
            <th class="text-center">Promise Date</th>
            <th class="text-center">Customer</th>
            <th class="text-center">Description</th>
            <th class="text-center">PO</th>
            <th class="text-center">Date Entered</th>
            <th class="text-center">Time Entered</th>
            <th class="text-center">Entered by</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($jobs as $item)

            <tr>
                <td>{{$item->job}}</td>
                <td>
                    @if($item->adminStatus=='O')
                        {{'Open'}}
                    @endif
                    @if($item->adminStatus=='$')
                        {{'Credit Hold'}}
                    @endif
                    @if($item->adminStatus=='D')
                        {{'Hold'}}
                    @endif
                    @if($item->adminStatus=='P')
                        {{'PDF Proofing'}}
                    @endif
                    @if($item->adminStatus=='S')
                        {{'Shipped'}}
                    @endif
                    @if($item->adminStatus=='X')
                        {{'Cancelled'}}
                    @endif
                        @if($item->adminStatus=='C')
                            {{'Closed'}}
                        @endif
                </td>
                <td>
                    @if($item->terms=='1')
                        {{'Net 30 Days'}}
                    @endif
                    @if($item->terms=='5002')
                        {{'2% 10,Net 30'}}
                    @endif
                    @if($item->terms=='5003')
                        {{'COD'}}
                    @endif
                    @if($item->terms=='5005')
                        {{'Net 60'}}
                    @endif
                    @if($item->terms=='5006')
                        {{'2% 25,Net 30'}}
                    @endif
                    @if($item->terms=='5008')
                        {{'3% 10,Net 30'}}
                    @endif
                    @if($item->terms=='5009')
                        {{'January 2017'}}
                    @endif
                    @if($item->terms=='5010')
                        {{'1% 15thMF-Net30'}}
                    @endif
                    @if($item->terms=='5012')
                        {{'COD on CC'}}
                    @endif
                    @if($item->terms=='5013')
                        {{'Net 45 Days'}}
                    @endif
                </td>
                <td>
                    @if($item->promiseDate!==null)
                        {{$item->promiseDate->toDateString()}}
                    @endif
                </td>
                <td>
                    @php
                        $i = '';
                    @endphp
                    @foreach($customers as $cust)
                        @if($cust->id==$item->customer && $cust->custName!=$i)
                            {{$cust->custName}}
                            @php
                                $i = $cust->custName;
                            @endphp
                        @endif
                    @endforeach
                </td>
                <td>{{$item->description}}</td>
                <td>{{$item->poNum}}</td>
                <td>{{$item->dateSetup->toDateString()}}</td>
                <td>
                    @php
                        $time=$item->timeSetUp;
                        echo date('h:i:s a',strtotime($time));
                    @endphp
                </td>
                <td>{{$item->enteredBy}}</td>

                <td>
                        <a href="{{ url('/show_detail/'.$item->jobType.'/'.$item->job) }}" class="btn btn-info" target="_blank"><span class="glyphicon glyphicon-edit"></span> View Detail</a>


                </td>
            </tr>

        @endforeach
        </tbody>
    </table>

    <script>
        $(function(){

            window.FakeLoader.init();

        });
        window.FakeLoader.init({
            auto_hide: true
        });

        function filterColumn ( i ) {
            $('#table').DataTable().column( i ).search(
                $('#col'+i+'_filter').val(),

            ).draw();
        }

        $(document).ready(function() {

            $('input.column_filter').on( 'keyup click', function () {
                filterColumn( $(this).parents('tr').attr('data-column') );
            } );

            $('.custname').change(function () {
                var selectedItem = $(this).find("option:selected").val();
                //alert(selectedItem);
                if(selectedItem=='98650'){
                    $('select[name=job_type]').val(5014);
                    $('.jobtype').find('[value="5014"]').prop('disabled', false);
                    $('.jobtype').find('[value="1"]').prop('disabled', true);
                    $('.jobtype').find('[value="5015"]').prop('disabled', true);
                    $('.selectpicker').selectpicker('refresh')

                }
                else{
                    $('.jobtype').find('[value="5014"]').prop('disabled', true);
                    $('.jobtype').find('[value="1"]').prop('disabled', false);
                    $('.jobtype').find('[value="5015"]').prop('disabled', false);
                    $('.selectpicker').selectpicker('refresh')
                }
            }); // Check customer name & job type


            $(function() {
                $('input[name="from_date"]').daterangepicker({

                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,
                    maxYear: parseInt(moment().format('YYYY'),10)
                });
                $('input[name="from_date"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('MM/DD/YYYY'));
                });

            }); // from date picker


            $(function() {
                $('input[name="to_date"]').daterangepicker({

                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,
                    maxYear: parseInt(moment().format('YYYY'),10)
                });
                $('input[name="to_date"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('MM/DD/YYYY'));
                });


            }); //to date picker


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


            }); //promise date picker

            var table = $('#table').DataTable({
                "order": [
                    [7, "desc"]
                ],
                "oLanguage": {

                    "sSearch": "Free Search:"

                }
            });

        } );

    </script>
@endsection