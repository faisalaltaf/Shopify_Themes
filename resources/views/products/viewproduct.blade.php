@extends('shopify-app::layouts.default')
@section('main-content')
<div style="display: flex; padding:20px; align-items: center; justify-content: center; ">
<link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" rel="stylesheet">

    
               <button type="button" style="align-content: center;" class="btn mb-2 mb-md-0 btn-primary btn-round">
               <a href="{{route('insert_product')}}">
              <i class="ion-ios-heart mr-1"></i> Pruduct Add
               </a>
            </button>
 </div>
<div class="container py-4">
    <div class="row">
        <div class="col-12">
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>image</th>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Vendor</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                            
        
                            @foreach($get_products as $key)
        
                            <?php
                            if(count($key['images']) > 0){
        $image =$key['images'][0]['src'];
    } ?>
                                    <tr>
<td> <img width="50px" height="50px" src="<?php echo $image ?>" alt=""></td>
                                        <td>{{$key['id']}}</td>
                                        <td>{{$key['title']}}</td>
                                        <td>{{$key['vendor']}}</td>
                                        <td>{{$key['status']}}</td> 
                                        <td>{{$key['product_type']}}</td>
                                        
                                        <td>
                                        <a href="{{route('edit',$key['id'])}}"><i class="fas fa-edit" id=""></i></a>&nbsp;

                                        <button class="btn"   id="delete_product" value="{{$key['id']}}" onMouseOver="this.style.color='#828079'" onMouseOut="this.style.color='#00000'"><i class="fas fa-drum"></i></button>
                                        <!-- <td><button id="{{$key['id']}} " value="{{$key['id']}}" onClick="delord()" class="del" style="font-size: 12">delete</button></td> -->
                                        <!-- <button class="btn btn-danger btn-xs" name="delete_product" id="delete_product" data-id="{{$key['id']}}" data-token="{{ csrf_token() }}"> -->
                                        </td>
                                    
                                    </tr>
                            
                                @endforeach
                            </tbody>

@endsection


@section('page-level-script')



<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $(document).on('click','#delete_product',function(){
            var id = $(this).val();
            var tr = $(this).closest('tr');
            swal({
              title: "Are you sure?",
              text: "This will delete your product with all varients!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
                    url:"{{route('delete_product')}}",
                    type: "DELETE",
                    data: {'delProduct':id},
                    
                    success:function(data){
                          tr.remove();
                          swal("Product Deleted Successfully", {
                          icon: "success",
                        });                          
                       }                   
                 });
                
              } else {
                swal("Your imaginary file is safe!");
              }
            });
        });
    </script>
@endsection
