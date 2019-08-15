<style>


    /* Slideshow container */
    .slideshow-container {
        max-width: 1000px;
        position: relative;
        margin: auto;
    }

    /* Next & previous buttons */
    .prev, .next {
        color:white;
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 5px;
        margin-top: -22px;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        background :  #009900;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover, .next:hover {
        background-color: #00FF40;
        color:white;
    }

    /* Caption text */
    .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* The dots/bullets/indicators */
    .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

   .dot:hover {
        background-color: #717171;
    }

    /* Fading animation */
    .fade {
        opacity: 1 !important;
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        animation-name: fade;
        animation-duration: 1.5s;
    }

    @-webkit-keyframes fade {
        from {opacity: .4}
        to {opacity: 1}
    }

    @keyframes fade {
        from {opacity: .4}
        to {opacity: 1}
    }

    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {
        .prev, .next,.text {font-size: 11px}
    }
</style>
<script>
    var slideIndex = 1;
    $(document).ready(function(){
        showSlides(slideIndex);
    });

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
    }
</script>
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="lineModalLabel">Duplicate Product</h3>
    </div>
    <div class="modal-body ">
        {{ isset($products) ? $products : '' }}
        @foreach($all_products as $all_pro)

        <div class="form-group" >
            <div class="row" >
                <div class="col-xs-4 job-label"style="text-align:right;">
                    <label>Product Job</label>
                </div>
                <div class="col-xs-3">
                    <input type='text'class="form-control" value='{{$all_pro->job}}' name='product_job' id="product_job{{$all_pro->id}}"/>
                </div>
            </div>
        </div>
        <div class="form-group" >
            <div class="row" >
                <div class="col-xs-4 job-label"style="text-align:right;">
                    <label>Product Description</label>
                </div>
                <div class="col-xs-7">
                    <textarea type="text" name="product_desc" class="form-control" id="product_desc{{$all_pro->id}}">{{$all_pro->description}}</textarea>
                </div>
            </div>
        </div>

        <div class="form-group" >
            <div class="row" >
                <div class="col-xs-4 job-label"style="text-align:right;">
                    <label>Product Description2</label>
                </div>
                <div class="col-xs-7">
                    <textarea type="text" name="product_desc2" class="form-control" id="product_desc2{{$all_pro->id}}">{{$all_pro->additionalDescription}}</textarea>
                </div>
            </div>
        </div>

        <div class="form-group" >
            <div class="row" >
                <div class="col-xs-4 job-label"style="text-align:right;">
                    <label>Product PO</label>
                </div>
                <div class="col-xs-7">
                    <input type='text' class="form-control" value='{{$all_pro->U_PO}}' name='product_po' id="product_po{{$all_pro->id}}"/>
                </div>
            </div>
        </div>

        <div class="form-group" >
            <div class="row" >
                <div class="col-xs-4 job-label"style="text-align:right;">
                    <label>Product Due Date</label>
                </div>
                <div class="col-xs-7">
                    <input type='text' class="form-control" value='{{substr($all_pro->U_DueDate, 0, 10)}}' name='product_date' id="product_date{{$all_pro->id}}"/>
                </div>
            </div>
        </div>

        <!--<div class="slick-class">-->

        @endforeach
    </div>
</div>