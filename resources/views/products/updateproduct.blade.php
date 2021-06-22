@extends('shopify-app::layouts.default')



 {{-- =============== End Page Level CSS Section =================== --}}

 {{-- =============== Start Main Content =================== --}}
@section('main-content')
    <div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Success!</strong> {{ $message }}
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <h3 class="content-heading">Update Product</h3>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" method="POST" novalidate="novalidate" id="add_products" action="{{route('update',['id'=>$product['body']['product']['id']])}}"  enctype="multipart/form-data">
                        @csrf
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom01">Title <span style="color: red;">*</span></label>
                                    <input class="form-control" name="title" id="title" type="text" placeholder="Title" required="required" autofocus="true" value="{{$product['body']['product']['title']}}" />
                                    
                                </div>
                            </div>    
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom03" class="">Description <span style="color: red;">*</span></label>
                                    <div class="col-md-12 mb-3">
                                        <textarea name="product_description" id="product_description" class="form-control" style="margin-top: 0px; margin-bottom: 0px; height: 109px;">{{$product['body']['product']['body_html']}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="Media">Media</label>
                                    <input class="form-control" id="media" name="media" type="file" required="required"/>
                                    <span><img src="{{$product['body']['product']['image']['src']}}" alt="" height="100px" width="100px"></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="vendor">Vendor <span style="color: red;">*</span></label>
                                    <input class="form-control" name="vendor" id="vendor" type="text" placeholder="Vendor" required="required" value="{{$product['body']['product']['vendor']}}" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="compareprice">Tags </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Tags</span></div>
                                        <input class="form-control" id="tags" name="tags" type="text" placeholder="Tags" aria-describedby="inputGroupPrepend" value="{{$product['body']['product']['tags']}}"/>
                                        <div class="input-group-append"><span class="input-group-text">Separate with Commas (<b>,</b>)</span></div>
                                    </div>
                                </div>
                            </div>
                            <span>Varients</span><hr>
                            <table class="col-md-12">
                                <tbody id="variantsResponseData" class="form-row">
                                    @foreach ($product['body']['product']['variants'] as $varKey12 => $varValue)
                                    <tr class="form-row">
                                        <td class="col-md-2 mb-3">
                                            <label for="variant">Variant</label>
                                            <input class="form-control" id="variantOptionData" value="{{$varValue['title']}}" name="variantOptionData" type="text" readonly="true" />
                                        </td>
                                        <td class="col-md-2 mb-3">
                                            <label for="variantprice">Price <span style="color: red;">*</span></label>
                                            <input class="form-control" value="{{$varValue['price']}}" id="variantprice" name="variantprice[]" type="number" required="required" readonly="true" />
                                        </td>
                                        <td class="col-md-2 mb-3">
                                            <label for="variantquantity">Quantity <span style="color: red;">*</span></label>
                                            <input class="form-control" value="{{$varValue['inventory_quantity']}}" id="variantquantity" name="variantquantity[]" type="number" required="required" readonly="true" />
                                        </td>
                                        <td class="col-md-2 mb-3">
                                            <label for="variantsku">SKU <span style="color: red;">*</span></label>
                                            <input class="form-control" value="{{$varValue['sku']}}" id="variantsku" name="variantsku[]" type="text" required="required" readonly="true" />
                                        </td>
                                        <td class="col-md-2 mb-3">
                                            <label for="variantbarcode">Barcode <span style="color: red;">*</span></label>
                                            <input class="form-control" value="{{$varValue['barcode']}}" id="variantbarcode" name="variantbarcode[]" type="text" required="required" readonly="true" />
                                        </td>
                                        <td class="set123">
                                            <a href="{{route('edit_variant',['p_id'=>$product['body']['product']['id'],'v_id'=>$varValue['id']])}}" class="btn removeVariantCombination" id="editVariants" style="margin-top: 28px !important;"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('deleteVariant',['p_id'=>$product['body']['product']['id'],'v_id'=>$varValue['id']])}}" class="btn removeVariantCombination" id="removeVariants" style="margin-top: 28px !important;"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            <div class="form-row">
                                <button class="btn btn-primary" type="submit">Update product</button>
                            </div>
                            <div class="form-row">
                                <button class="btn btn-primary" type="button"><a href="{{route('productview')}}">Veiw Product</a></button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
 {{-- =============== End Main Content =================== --}}

 {{-- =============== Start Page Level Script =================== --}}
@section('page-level-script')
    {{-- ==================== CK EDITOR ============================ --}}
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>



    <script>
        //CK editor id
        CKEDITOR.replace('product_description');
    </script>
@endsection
 {{-- =============== End Page Level Script =================== --}}