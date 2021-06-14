@extends('shopify-app::layouts.default')
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">


@foreach($actives as $active)
                  <tr>
                     <td>{{ $active->id }}</td>
                     <td>
                        <input data-id="{{$active->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $active->status ? 'checked' : '' }}>
                     </td>
                  </tr>
               @endforeach


@section('content')
    <!-- You are: (shop domain name) -->
    <p id="faisal">faisal</p>

<tr>




<!-- 
<form id="formstatus">
<input type="button">
</form> -->

    <p>You are: {{ Auth::user()->name }}</p>
    @endsection
    
@section('scripts')
    @parent
    
    <script type="text/javascript">
        var AppBridge = window['app-bridge'];
        var actions = AppBridge.actions;
        var TitleBar = actions.TitleBar;
        var Button = actions.Button;
        var Redirect = actions.Redirect;
        var titleBarOptions = {
            title: 'Welcome',
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);
        </script>

<script src="{{asset('js/script.js')}}"></script>
@endsection




<TABle id="myDIV">
    <thead>
        <tr>
            <th colspan="2"> Product </th>
        
        <th >Action    </th>
    </tr>
</thead>
<tbody>
    
    <section>   
        
        <?php
//          $shop = Auth::user();
// $products = $shop->api()->rest('GET','/admin/api/2021-01/products.json',['limits' =>1]);
// $products = $products['body']['container']['products'];
//  echo print_r($products); 



?>

 
 <?php $shop = Auth::user();
// $products = $shop->api()->rest('GET','/admin/api/2021-01/products.json',['limits' =>4]);
// $products = $products['body']['container']['products'];


// foreach($products as $product )
// {
    
    
    
    // if(count($product['images']) > 0){
    //     $image =$product['images'][0]['src'];
    // }
    ?>  
    
<tr>
    <!-- <td><img width="20" height="20" src="
    <?php
    //  echo $image;
      ?>
    " alt="<?php 
    // echo 
    // $product['title'];
     ?>"></td> -->
    <!-- <td><?php 
    // echo $product['title'];
     ?></td> -->
    <!-- <td> -->


                                            
                                        </td>
    
    
</tr>
<?php
//  }
 
 ?>
</tbody>
</TABle>




</section>


<script>
  
</script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
<script>

$(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatus',
            data: {'status': status, 'id': id},
            success: function(data){
                if(data.success){
                $("#myDIV").css("display", "none");
                alert(data.success)
              }
              if(data.faild){
                  $("#myDIV").css("display", "block");

              }
              
            }
        });
    })
  })

</script>
</html>

    
    
    
    
    
    