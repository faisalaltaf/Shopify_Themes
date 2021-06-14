<?php

namespace App\Http\Controllers;

use App\Models\Active;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Osiset\ShopifyApp\Storage\Observers\Shop;

class ActiveController extends Controller
{

    
    public function index()
    {



      $actives = Active::get();
      // dd($actives);
      return view('welcome',compact('actives'));

    }
  
    public function changeUserStatus(Request $request)
    {

      $shop = auth()->user();


      $script_array= array(
        "script_tag"=> array(
            "event" =>'onload',
            "src" => 'https://Shopifythemes.test/js/frontscript.js',
        )   
        );


      


        $active = Active::find($request->id);
        $active->status = $request->status;
        $active->save();


  if($request->status == 1){
    // return response()->json(['success'=>'User status change successfully.']);




      $result =  $shop->api()->rest('POST', '/admin/api/2021-04/script_tags.json' ,$script_array);
      // dd($result['body']['script_tag']['id']);
      $active = Active::where('id',$request->id)->update(['status'=>1, 'script_id' => $result['body']['script_tag']['id']]);
      


    

  }else{
    // return response()->json(['faild'=>'User status change successfully.']);
    $actives = Active::get();
    foreach($actives as $active){
    $id= $active['script_id'];

 $result1= $shop->api()->rest('DELETE','/admin/api/2021-04/script_tags/'.$id.'.json');
// $active = Active::where('id',$request->id)->delete([ 'script_id' => $result['body']['script_tag']['id']]);
// $active = Active::where('id',$request->id)->create(['status'=>0,]);

    }

  }
    }
  //   public function changeUserStatus(Request $request)
  //   {
  //       $active = Active::all(['id' => $request->id], [
  //           'status' => $request->status,
              
    //         ]);

  // return response()->json(['code'=>200, 'message'=>'Post Created successfully','data' => $post], 200);
  //   }

  //   public function show($id)
  //   {
  //       $actives = Active::find($id);
  
  //       return response()->json($active);
  //   }

}
