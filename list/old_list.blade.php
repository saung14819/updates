@extends('layout')
@section('content')



    <table cellpadding="2" cellspacing="0" border="0" style="width: 50%; margin: 0 auto 2em auto;">
        <tr>
            <td align="center" colspan="6"><div class="center">
                    @php
                        $count=count($jobs);
                        if($count!==0){
                        echo "<h2><u>Found ".$count." jobs for your search</u></h2>";
                        }
                       else{
                       echo "<h2><span style='color:red;'>The job that you've searched can't be found,please recheck your keywords</span></h2>";
                       }
                    @endphp
                </div>
            </td>
        </tr>
       <!-- <tr><td align="center" colspan="6"><h3><u>More Search Options:</u></h3></td></tr>

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
             <td>
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
             </td>
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
          <td>
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
            </td>
        </tr>-->
    </table>
    <hr/>

    <div class="center">
        <button onclick="window.location.href='javascript:history.back()'"  class="btn btn-lg btn-success center-block">Back to Open jobs List</button>
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

                <td><button class="edit-modal btn btn-info"
                            data-info="{{$item->id}},{{$item->first_name}},{{$item->last_name}},{{$item->email}},{{$item->gender}},{{$item->country}},{{$item->salary}}">
                        <a href="{{ url('/show_detail/'.$item->jobType.'/'.$item->job) }}" class="btn btn-info" target="_blank"><span class="glyphicon glyphicon-edit"></span> View Detail</a>
                    </button>
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
            });


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
                $('input[name="to_date"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

            });

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