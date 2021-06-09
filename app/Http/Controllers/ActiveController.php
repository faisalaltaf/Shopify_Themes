<?php

namespace App\Http\Controllers;

use App\Models\Active;
use Facade\FlareClient\View;
use Illuminate\Http\Request;

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
        $active = Active::find($request->id);
        $active->status = $request->status;
        $active->save();
  
        return response()->json(['success'=>'User status change successfully.']);
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
