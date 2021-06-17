<?php

namespace App\Http\Controllers;

use App\Models\Active;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Osiset\ShopifyApp\Storage\Observers\Shop;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class ActiveController extends Controller
{
  
    
  public function index()
  {
    
    $actives = Active::get();
    // dd($actives);
    return view('welcome',compact('actives'));
    
  }
  
  public function changeUserStatus()
  {
      // return request('id');
    $shop = auth()->user();
    // ($result = $shop->api()->rest('GET' ,'/admin/api/2021-04/script_tags.json'));
    // $result= $shop->api()->rest('DELETE','/admin/api/2021-04/script_tags/176928751765.json');






   




        $active = Active::find(request('id'));
        $active->status = request('status');
        $active->save();
        $active = Active::where('id', request('id'))->update(['status'=>$active['status']]);


// snipped add 

$result = $shop->api()->rest('GET','/admin/api/2021-04/themes.json');
  $activeid = "";

foreach($result['body']->container['themes'] as $theme) {
    
    if($theme['role'] === 'main'){
       $activeid =$theme['id'];
    }
} 
$value = "<script type='text/javascript' src='https://shopifythemes.test/js/frontscript.js'></script>";
$asset_file = array(
    "asset" => array(
"key" => "snippets/status.liquid",
"value" => $value
    )
    );

  
    
    
    
    if(request('status')==1):
       $asset = $shop->api()->rest('PUT', '/admin/api/2021-04/themes/'.$activeid.'/assets.json', $asset_file);

      else:
        $asset = $shop->api()->rest('DELETE', '/admin/api/2021-04/themes/'.$activeid.'/assets.json', $asset_file);

      endif;














       
      // $script_array= array(
      //   "script_tag"=> array(
      //       "event" =>'onload',
      //       "src" => 'https://Shopifythemes.test/js/frontscript.js',
      //   )   
      //   );
      // if(request('status')==1):
        //   $result = $shop->api()->rest('POST','/admin/api/2021-04/script_tags.json',$script_array); 
      //   $active = Active::where('id', request('id'))->update(['script_id'=>$result['body']['script_tag']['id']]);
      // else:
      //   $actives = Active::get();
      //   foreach($actives as $active):
        //     $ids= $active['script_id'];
        //     $result= $shop->api()->rest('DELETE','/admin/api/2021-04/script_tags/'.$ids.'.json');
        //   endforeach;
        // endif;
      
      }
      
    }
    