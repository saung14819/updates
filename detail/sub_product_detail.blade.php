

<div class="modal-content" style="overflow-x: scroll;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="lineModalLabel">Duplicate Product</h3>
    </div>
    <div class="modal-body ">
         <div class="form-group" >
             <div class="row" >
                 <div class="col-xs-4 job-label"style="text-align:right;">
                     <label>Product Job</label>
                 </div>
                 <div class="col-xs-3">
                     <input type='text'class="form-control" value='{{$products->job}}' name='product_job' id="product_job"/>
                 </div>
             </div>
         </div>
         <div class="form-group" >
             <div class="row" >
                 <div class="col-xs-4 job-label"style="text-align:right;">
                     <label>Product Description</label>
                 </div>
                 <div class="col-xs-7">
                     <textarea type="text" name="product_desc" class="form-control" id="product_desc">{{$products->description}}</textarea>
                 </div>
             </div>
         </div>

         <div class="form-group" >
             <div class="row" >
                 <div class="col-xs-4 job-label"style="text-align:right;">
                     <label>Product Description2</label>
                 </div>
                 <div class="col-xs-7">
                     <textarea type="text" name="product_desc2" class="form-control" id="product_desc2">{{$products->additionalDescription}}</textarea>
                 </div>
             </div>
         </div>

         <div class="form-group" >
             <div class="row" >
                 <div class="col-xs-4 job-label"style="text-align:right;">
                     <label>Product PO</label>
                 </div>
                 <div class="col-xs-7">
                     <input type='text' class="form-control" value='{{$products->U_PO}}' name='product_po' id="product_po"/>
                 </div>
             </div>
         </div>

         <div class="form-group" >
             <div class="row" >
                 <div class="col-xs-4 job-label"style="text-align:right;">
                     <label>Product Due Date</label>
                 </div>
                 <div class="col-xs-7">
                     <input type='text' class="form-control" value='{{substr($products->U_DueDate, 0, 10)}}' name='product_date' id="product_date"/>
                 </div>
             </div>
         </div>

         <!--<div class="slick-class">-->
        <div>

            @foreach($jobparts as $part)
            <div >

                <div class="col-md-12">
                    <h3><u>Job Parts of {{$products->description}}</u></h3>


                    <table class="table success" >
                        <tr>
                            <td>&nbsp</td>

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
                                @foreach($jobparts as $job_part)


                                        <tr class="row">


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
                                        <input type="hidden" value="{{$job_part->job}}"
                                               name="parts_product[]"/>
                                        <input type="hidden" value="{{$job_part->jobPart}}" name="parts_id[]"/>
                                        <input type="hidden" value="{{$job_part->job}}" name="old_job"/>

                                @endforeach


                    </table>


                </div>
                <input type="hidden" name='dup_parts_pricelist[]'  class="form-control"  value='' id='pl_value'/>
                <input type="hidden" name='dup_parts_job[]' value=''/>
                <input type="hidden" name='dup_parts_part[]' value=''/>



            </div>

            @endforeach
            <br>

            <br>
            <form id="dup_all_parts_form">
                <center>
                    <button  type="button" class="btn btn-danger" onclick="submit_product_dup()">Duplicate</button>
                    <button type="button" onclick="closeModal('search_pl_modal', 'true')" data-dismiss="modal" aria-label="Close" class="btn btn-success">Close</button>
                </center>
            </form>


    </div>
    </div>
</div>

<script>




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


    function submit_product_dup()
    {
        //alert('Job Duplicating Process has started, please wait a moment');
        var pro_job=$("input[name='product_job']").val();
        var pro_desc=$("textarea[name='product_desc']").val();
        var pro_desc2=$("textarea[name='product_desc2']").val();
        var po=$("input[name='product_po']").val();
        var date=$("input[name='produt_date']").val();

        //var product_id=$("input[name='product_id[]']").val();


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
            url: '/product_duplicate',
            data:{pdescription:pro_desc,add_pdescription:pro_desc2,po:po,job:pro_job,date:date},
            async: false,
            success: function(data){
                alert("One new product has been added to job number:"+pro_job);
                $.each(data, function (index, value) {
                    $.each(JSON.parse(part_list_result), function (index, part) {

                        if (part.option == "Yes") {


                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                                type: 'POST',
                                url: '/part_duplicate',
                                data: {
                                    job: value.job,
                                    old_job: part.old_job,
                                    part: part.pid,
                                    products: value.id,
                                    description: part.parts_desc,
                                    add_desc: part.parts_desc2,
                                    quantity: part.qty,
                                    width: part.width,
                                    height: part.height,
                                    total_price: part.total_price,
                                    total_sqft: part.total_sqft,
                                    unitprice: part.unitprice,
                                    sqftprice: part.sqftprice,
                                    price_list: part.pricelist,
                                    price_list_id: part.pricelist_id
                                },
                                async: false,
                                success: function (response) {

                                    console.log('success');

                                    /*$.ajax({
                                        type:'POST',
                                        url: 'UpdateInvoiceAmount.php',
                                        data:{job:response},
                                        async: false
                                    });
                                    $(".job_dup_content").css("display","none");*/

                                    //window.location.replace("/show_detail/" + part.jobtype + "/" + value.job);

                                },
                                error: function (jqXHR, textStatus, errorThrown) { // What to do if we fail
                                    console.log(JSON.stringify(jqXHR));
                                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                                }
                            });


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
</script>