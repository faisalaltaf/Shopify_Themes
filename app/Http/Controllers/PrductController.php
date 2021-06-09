<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrductController extends Controller
{
    public function delete(Request $request)
    	{
    		$deleteProductID = $request->delProduct;
    		$shop = Auth::user();
			$get_products=$shop->api()->rest('delete','/admin/api/unstable/products/'.$deleteProductID.'.json');
			return response()->json($get_products);
    	}
}
