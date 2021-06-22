{{-- @dd($getSpecficVariants) --}}
@extends('shopify-app::layouts.default')

@section('main-content')
{{-- @dd($getProductBy_id['body']['product']) --}}
<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Success!</strong> {{ $message }}
    </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>error.!</strong> {{ $message }}
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form class="needs-validation" novalidate="novalidate" id="add_product_variant_new" method="POST" enctype="multipart/form-data" action="{{route('update_variant',['p_id'=>$getProductBy_id['body']['product']['id'],'v_id'=>$getSpecficVariants])}}">
                @csrf
                <div class="row">
                 <div class="col-md-3">
                    <div class="card mb-4 o-hidden">
                        @if(!empty($getProductBy_id['body']['product']['image']['src']))
                        <img class="card-img-top" src="{{$getProductBy_id['body']['product']['image']['src']}}" alt="{{$getProductBy_id['body']['product']['title']}}">
                        @endif
                        @if(empty($getProductBy_id['body']['product']['image']['src']))
                        <img class="card-img-top" src="{{asset('assets/dist-assets/images/no_image.png')}}" alt="No Image">
                        @endif
                        <div class="card-body">
                            <h5>{{$getProductBy_id['body']['product']['title']}}</h5>
                            @if($getProductBy_id['body']['product']['status'] == 'active')
                            <span class="badge badge-pill badge-outline-success p-2 m-1" style="font-weight: bolder; font-size: 13px;">Active</span>
                            @endif
                            @if($getProductBy_id['body']['product']['status'] == 'draft')
                            <span class="badge badge-pill badge-outline-danger p-2 m-1" style="font-weight: bolder; font-size: 13px;">Draft</span>
                            @endif

                            <span class="badge badge-pill badge-outline-primary p-2 m-1" style="font-weight: bolder; font-size: 13px;">{{count($getProductBy_id['body']['product']['variants'])}} Variants</span>
                        </div>
                    </div>
                    <div class="card mb-4 o-hidden">
                        <div class="card-body" >
                            <h5 class="card-title">Variants</h5>
                        </div>
                        <div class="card-body">
                            <ul class="">
                                @foreach($getProductBy_id['body']['product']['variants'] as $key=>$value)
                                <a href="" style="font-size: 15px;"><li class="list-group-item setHover"><img height="50px" width="50px" src="{{asset('assets/images/preview.png')}}" alt="">  {{$value['title']}}</li></a>
                                @endforeach
                            </ul> 
                        </div>  
                    </div>
                </div>
                @php
                if(!empty($getSpecficVariants)){
                    $var_sku       = '';
                    $var_price    = '';
                    $var_barcode   = '';
                    $var_comPrice  = '';
                    $var_img       = $var_img = asset('assets/images/preview.png');

                    foreach ($getProductBy_id['body']['product']['variants'] as $key101 => $value101) {
                        if($value101['id'] == $getSpecficVariants){
                            $var_sku       = $value101['sku'];
                            $var_price     = $value101['price'];
                            $var_barcode   = $value101['barcode'];
                            $var_comPrice  = $value101['compare_at_price'];
                            $var_image     = $value101['id'];
                        }
                    }
                    foreach ($getProductBy_id['body']['product']['images'] as $key_img => $value_img) {
                        foreach($value_img['variant_ids'] as $varimgs){
                            if($varimgs == $var_image){
                                $var_img = $value_img['src'];
                            }
                        }
                    }
                    if(empty($var_img)){
                        $var_img = asset('assets/images/preview.png');
                    }
                }else{
                    $var_sku       = '';
                    $var_price     = '';
                    $var_barcode   = '';
                    $var_comPrice  = '';
                    $var_img       = asset('assets/images/preview.png');
                }
                @endphp
                <div class="card card-body" >
                    <div class="row">
                        <div class="d-flex flex-column col-md-9">
                            <h4>Options</h4>
                            @foreach($getProductBy_id['body']['product']['options'] as $key12=>$value12)
                            @php
                            if(!empty($getSpecficVariants)){
                                $arrayIndx = $key12+1;
                                foreach($getProVariants_id['body']['variants'] as $key112=>$value112){
                                    if($value112['id']==$getSpecficVariants){
                                        $var_options = $value112['option'.$arrayIndx];
                                    }
                                }
                            }else{
                                $var_options = '';
                            }
                            @endphp
                            <div class="form-group m-1">
                                <lable>{{ucfirst($value12['name'])}}<span style="color: red;">*</span></lable>
                                <input class="form-control mb-2" placeholder="{{ucfirst($value12['name'])}}" id="option{{$key12+1}}" type="text" value="{{$var_options}}" name="option{{$key12+1}}">
                            </div>
                            @endforeach
                        </div>
                        <div class="col-md-3">
                            <div class="varSet" id="dvPreview">
                                <span class="imgPreview"><img style="height: 170px;width: 170px;outline:none;" src="{{$var_img}}"></span>
                            </div>
                            <div class="changeImage">
                                <input type="file" id="fileupload" name="variantmedia" hidden/>
                                <label for="fileupload" name='newVarImage' class="fileupload_set btn btn-outline-primary">Choose Image</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex flex-column col-md-9">
                            <h4 class="mb-3">Pricing</h4>
                            <div class="mb-3">
                                <label for="variantPrice">Price <span style="color: red;">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">PKR</span></div>
                                    <input class="form-control" value="{{$var_price}}" id="variantPrice" name="variantPrice" type="text" placeholder="Price" aria-describedby="inputGroupPrepend" />
                                    <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="variantComparePrice">Compare at Price </label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">PKR</span></div>
                                    <input class="form-control" value="{{$var_comPrice}}" id="variantComparePrice" name="variantComparePrice" type="text" placeholder="Compare at price" aria-describedby="inputGroupPrepend" />
                                    <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex flex-column col-md-9">
                            <br><h4 class="mb-3">Inventory</h4>
                            <div class="form-group m-1">
                                <lable>SKU (Stock Keeping Unit)<span style="color: red;">*</span></lable>
                                <input class="form-control mb-2 mt-1" value="{{$var_sku}}" type="text" placeholder="SKU" name="variantSku">
                            </div>
                            <div class="form-group m-1">
                                <lable>Barcode (ISBN, UPC, GTIN, etc.)<span style="color: red;">*</span></lable>
                                <input class="form-control mb-2 mt-1" value="{{$var_barcode}}" type="text" placeholder="Barcode" name="variantBarcode">
                            </div>
                        </div>
                    </div>
                    @php
                    if(!empty($getSpecficVariants)){
                        @endphp
                        <div class="row">
                            <div class="col-md-3 ml-1 mt-2">
                                <button class="btn btn-primary" type="submit">Update Variant</button>
                            </div>
                        </div>
                        @php
                    } if(empty($getSpecficVariants)){
                        @endphp
                        <div class="row ml-1 mt-2">
                            <button class="btn btn-primary" type="submit">Save Variant</button>
                        </div>
                        @php
                    }
                    @endphp
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('page-level-script')
    
    {{-- ==================== CK EDITOR ============================ --}}
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

    <script src= ></script>
    <script>
        //CK editor id
        CKEDITOR.replace('product_description');
    </script>


    <script type="text/javascript">

            //Ajax call csrf token setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(function () {
                $("#fileupload").change(function () {
                    if (typeof (FileReader) != "undefined") {
                        var dvPreview = $("#dvPreview");
                        dvPreview.html("");
                        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                        $($(this)[0].files).each(function () {
                            var file = $(this);
                            if (regex.test(file[0].name.toLowerCase())) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    var img = $("<img />");
                                    img.attr("style", "height: 170px;width: 210px;");
                                    img.attr("src", e.target.result);
                                    dvPreview.append(img);
                                }
                                reader.readAsDataURL(file[0]);
                            } else {
                                alert(file[0].name + " is not a valid image file.");
                                dvPreview.html("");
                                return false;
                            }
                        });
                    } else {
                        alert("This browser does not support HTML5 FileReader.");
                    }
                });
            });

            /* ----- To Delete Variant Script ----- */
            function VariantDeleteSwal(){
                alert('This');
                /*var proId  = $(this).data('proId');
                var proVar = $(this).data('proVar');
                alert(proId"------"proVar);*/
                   
            }

        </script>
@endsection