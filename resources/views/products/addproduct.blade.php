@extends('shopify-app::layouts.default')

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
            <h3 class="content-heading">Add Product</h3>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" method="POST" novalidate="novalidate" id="add_products" action="{{route('add_product')}}"  enctype="multipart/form-data">
                        @csrf
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom01">Title <span style="color: red;">*</span></label>
                                    <input class="form-control" name="title" id="title" type="text" placeholder="Title" required="required" autofocus="true" />
                                    
                                </div>
                            </div>    
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom03" class="">Description <span style="color: red;">*</span></label>
                                    <div class="col-md-12 mb-3">
                                        <textarea name="product_description" id="product_description" class="form-control" style="margin-top: 0px; margin-bottom: 0px; height: 109px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="Media">Media <span style="color: red;">*</span></label>
                                    <input class="form-control" id="media" name="media" type="file" required="required"/>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="producttype">Product Type <span style="color: red;">*</span></label>
                                    <input class="form-control" id="producttype" name="producttype" type="text" placeholder="Product Type" required="required" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="quantity">Quantity <span style="color: red;">*</span></label>
                                    <input class="form-control" id="quantity" name="quantity" type="number" placeholder="Quantity" required="required" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="vendor">Vendor <span style="color: red;">*</span></label>
                                    <input class="form-control" name="vendor" id="vendor" type="text" placeholder="Vendor" required="required" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="barcode">Barcode (ISBN, UPC, GTIN, etc.) <span style="color: red;">*</span></label>
                                    <input class="form-control" id="barcode" name="barcode" type="text" placeholder="Barcode" required="required" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="sku">SKU (Stock Keeping Unit) <span style="color: red;">*</span></label>
                                    <input class="form-control" id="sku" name="sku" type="text" placeholder="SKU" required="required" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="price">Price <span style="color: red;">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">PKR</span></div>
                                        <input class="form-control" id="price" name="price" type="text" placeholder="Price" aria-describedby="inputGroupPrepend" required="required" />
                                        <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                    </div>
                                    <label id="price-error" class="error" for="price" style="display: none;"></label>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="compareprice">Compare at price </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">PKR</span></div>
                                        <input class="form-control" id="compareprice" name="compareprice" type="text" placeholder="Compare at price" aria-describedby="inputGroupPrepend" />
                                        <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                    </div>
                                    <label id="compareprice-error" class="error" for="compareprice" style="display: none"></label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="compareprice">Tags </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Tags</span></div>
                                        <input class="form-control" id="tags" name="tags" type="text" placeholder="Tags" aria-describedby="inputGroupPrepend"/>
                                        <div class="input-group-append"><span class="input-group-text">Separate with Commas (<b>,</b>)</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="variants">Variants</label><br>
                                    <label class="checkbox checkbox-outline-primary">
                                        <input type="checkbox" class="my_features" data-name="variantOptions">&nbsp;<span>This product has multiple Varients</span><span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <table class="col-md-12" id="variantOptions">
                                <tbody id="optionVariantID">
                                    <tr class="form-row newtr">
                                        <td class="col-md-5 mb-3">
                                            <label for="options">Options <span style="color: red;">*</span></label>
                                            <select class="form-control" name="selectOption" id="selectOption" required="required">
                                                <option value="">Select Option</option>
                                                <option value="size">Size</option>
                                                <option value="color">Color</option>
                                                <option value="material">Material</option>
                                                <option value="style">Style</option>
                                                <option value="title">Title</option>
                                            </select>
                                        </td>
                                        <td class="col-md-5 mb-3">
                                            <input class="form-control" style="margin-top: 28px;" id="variantOption" name="variantOption" type="text" placeholder="Separate options with a comma" onkeyup="variantDataFunction(this.value)"/>
                                        </td>
                                        <td class="col-md-2 mb-3">
                                            <button class="btn btn-outline-primary m-1" id="addVerient" type="button" style="margin-top: 28px !important;">Add another option</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <table class="col-md-12">
                                <tbody id="variantsResponseData">
                                </tbody>
                            </table>
                            <br>
                            <div class="form-row">
                                <button class="btn btn-primary" type="submit">Add product</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('page-level-script')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

</script>

<script src="https://shopifythemes.test/js/tagger.js"></script>



<!-- {{-- =============== Ck Editor =============== --}} -->
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script type="text/javascript">
    //CK editor id
    CKEDITOR.replace('product_description');

    //For Variants to show/hide form
    $(function() {
      $('.my_features').on("change",function() { 
        $('#'+$(this).attr('data-name')).toggle(this.checked); // toggle instead
      }).change(); // trigger the change
  });

    // =========Add Rows For Varients===========
    $('#addVerient').click(function(){
                var count = $('#variantOptions tr').length;
                if(count <= 2){
                    $('#optionVariantID').append(`<tr class="form-row"><td class="col-md-5 mb-3"><label for="options">Options <span style="color: red;">*</span></label><select class="form-control" name="selectOption${count}" id="selectOption${count}" required="required"><option value="">Select Option</option><option value="size">Size</option><option value="color">Color</option><option value="material">Material</option><option value="style">Style</option><option value="title">Title</option></select></td><td class="col-md-5 mb-3"><input class="form-control" style="margin-top: 28px;" id="variantOption${count}" name="variantOption${count}" type="text" placeholder="Separate options with a comma" required="required" onkeyup="variantDataFunction(this.value)" /></td><td class="col-md-2 mb-3"><button class="btn btn-outline-danger m-1 remove" type="button" style="margin-top: 28px !important;">Remove option</button></td></tr>`);
                }
            });

// =========== Remove Varient Row =================
    $(document).on('click','.remove',function(){
        $(this).parents('tr').remove();
    });


 //===============csrf token setup==================
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


   
// =====================Varient Combinantion =======================

var selectedOption  = $("#selectOption").val();
var selectedOption1 = $("#selectOption1").val();
var selectedOption2 = $("#selectOption2").val();
    function variantDataFunction(value_variants) {     
        var checkValue = value_variants.endsWith(",");
        
        if(checkValue){
            var variantOption   = $("#variantOption").val();
            var variantOption1  = $("#variantOption1").val();
            var variantOption2  = $("#variantOption2").val();
           
            

            // alert(value_variants);
            // console.log($);
            $.ajax({
                type: 'POST',
                url: "{{('combi')}}",
            dataType: "json",
            data:{variantOption:selectedOption,variantOption1:selectedOption1,variantOption2:selectedOption2,variantsData:variantOption,variantsData1:variantOption1,variantsData2:variantOption2},
            success:function(data){
                $('#variantsResponseData').html(data);
            }
            
            
        });
    }
        
    }  

/* ----- To Delete Combination Script ----- */
    $(document).on('click','.removeVariantCombination',function(){
        var id = $(this).val();
        var tr=$(this).closest('tr');
       swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          
          if (willDelete) {
            $.ajax({
                url:"{{route('deleteCombination')}}",
                type: 'POST',
                data: {'variantDelIndex':id},
                cache: false,
                success:function(data){
                  tr.remove();
               }
               
             });
            swal("Poof! Your imaginary file has been deleted!", {
              icon: "success",
            });
          } else {
            swal("Your imaginary file is safe!");
          }
        });
    });


</script>

@endsection