<!DOCTYPE html>
<html>
<head>
    <title>T.K. Pace API 2.0</title>



    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.10/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.10/dist/js/bootstrap-select.min.js"></script>
    <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/locales/bootstrap-datepicker.en-GB.min.js" charset="UTF-8"></script>
    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.10/dist/js/i18n/defaults-*.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="stylesheet" href="https://www.jqueryscript.net/demo/transition-pages-fakeloader/fakeloader.css">
    <script src="https://www.jqueryscript.net/demo/transition-pages-fakeloader/fakeloader.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
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

    .info{
        width: 30%;
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
    .modal-backdrop {
        z-index: -1;
    }

    .column_legend SPAN
    {
        display: inline-block;
        width: 160px;
        font-family: 'Segoe UI', Arial, sans-serif;
    }
    .input
    {
        width: 160px;

    }
    .table SELECT
    {
        width: 160px;
        text-align: right;
    }

    .tr {
        display: table-row;
        margin-right: -15px !important;
        margin-left: -15px !important;
        border-color: inherit;
    }

    .bold-option{font-weight: bolder;}
</style>
<div class="navbar-wrapper">
    <div class="container-fluid">
        <nav class="navbar_top navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <img src="http://tkgraphics.ca/wp-content/uploads/2019/04/tklogo_small_2.png"/>
                </div>
                <div id="navbar" class="navbar-collapse collapse.show">

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
<hr/><br/>
<div class="container-fluid">
    @yield('content')
</div>

</body>
</html>