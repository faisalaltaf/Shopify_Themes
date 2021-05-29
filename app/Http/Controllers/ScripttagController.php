<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScripttagController extends Controller
{

    function home()
    {

        $shop = auth()->user();
        
        // dd($shop);

        $script_array= array(
            'script_tag'=> array(
                "event" =>'onload',
                "src" => 'https://Shopifythemes.test/public/js/script.js',
            )
            );

      $result =  $shop->api()->rest('POST', '/admin/api/2021-04/script_tags.json' ,$script_array);
      dd($result['body']);
        
    }   
}
