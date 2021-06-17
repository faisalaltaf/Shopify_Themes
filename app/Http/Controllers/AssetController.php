<?php

namespace App\Http\Controllers;


use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Osiset\ShopifyApp\Storage\Observers\Shop;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;


class AssetController extends Controller
{
    //
//     public function assetapi(){
       
       
//         $shop = auth()->user();

//  $result = $shop->api()->rest('GET','/admin/api/2021-04/themes.json');
//   $activeid = "";

// foreach($result['body']->container['themes'] as $theme) {
    
//     if($theme['role'] === 'main'){
//        $activeid =$theme['id'];
//     }
// } 
// $value = "<script type='text/javascript' src='https://shopifythemes.test/js/frontscript.js'></script>";
// $asset_file = array(
//     "asset" => array(
// "key" => "snippets/status.liquid",
// "value" => $value
//     )
//     );

//     $asset = $shop->api()->rest('PUT', '/admin/api/2021-04/themes/'.$activeid.'/assets.json', $asset_file);
//    echo print_r($asset);
//     }


//     }

}