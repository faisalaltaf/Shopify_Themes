
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet"  href="{{asset('css/app.css')}}" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    
</body>
</html>





@extends('shopify-app::layouts.default')


<button>
                 Chechout
                                
                 </button>

                 <p>show </p>
                
                

@section('content')
        <!-- You are: (shop domain name) -->
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

  
@endsection
 


 
<TABle>
<thead>
<tr>
<th colspan="2"> Product </th>

<th >Action    </th>
</tr>
</thead>
<tbody>
<main>
<section>   
<div class="card">
<?php $shop = Auth::user();
$products = $shop->api()->rest('GET','/admin/api/2021-01/products.json',['limits' =>1]);
$products = $products['body']['container']['products'];
//  echo print_r($products); 



?>
</div>
</section>

</main>




<main>
<section>   
<div class="card">
<?php $shop = Auth::user();
$products = $shop->api()->rest('GET','/admin/api/2021-01/products.json',['limits' =>4]);
$products = $products['body']['container']['products'];



 foreach($products as $product ){

    if(count($product['images']) > 0){
        $image =$product['images'][0]['src'];
    }
?>
<tr>
<td><img width="20" height="20" src="<?php echo $image; ?>" alt="<?php echo $product['title']; ?>"></td>
<td><?php echo $product['title']; ?></td>
<td > <a href="" class="secondery icon-trash"></a></td>



</tr>
<?php
 }

?>
</tbody>
</TABle>
</div>
</section>

</main>


<script>
$(document).ready(function(){
  $("button").click(function(){
    $("p").toggle();
  });
});
</script>
