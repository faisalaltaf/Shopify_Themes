<?php

namespace App\Http\Controllers;

use Session;
use Facade\FlareClient\View;
use Osiset\ShopifyApp\Storage\Observers\Shop;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Array_;
use Illuminate\Support\Arr;


class PruductController extends Controller
{
    //
    public function index(){


        $shop = auth()->user();
$products = $shop->api()->rest('GET' ,'admin/api/2021-04/products.json');
$get_products = $products['body']['container']['products'];

        return View('products.viewproduct',compact('get_products'));
    }


    public function insert_product(){
        return view('products.addproduct');
    }

    public function add_product(Request $req)
    {
        // dd($req);
           $title = $req->title;
        $description = $req->product_description;
        $type = $req->type;
        $quantity = $req->quantity;
        $vendor = $req->vendor;
        $sku = $req->sku;
        $tags = $req->tags;
        $price = $req->price;
        $barcode = $req->barcode;
        $compareprice = $req->compareprice;

        $option1= $req->selectOption;
        $option2= $req->selectOption1;
        $option3= $req->selectOption2;

        $varientprice = $req->variantprice;
        $variantquantity= $req->variantquantity;
        $variantsku  = $req->variantsku;

        $variantOption = explode(", ",$req->variantOption);
        $variantOption1 = explode(", ",$req->variantOption1);
        $variantOption2 = explode(", ",$req->variantOption2);


        $combination = session::get('allVariants');
        // $combination = session::get('allDelVariantCombinations');


        // dd($combination);
        $array1 = [];
        $array2 = [];

    foreach ($combination as $key => $all_variants) {
        $all_variants_1 = str_replace(',', '', $all_variants[0]);
        $all_variants_2 = str_replace(',', '', $all_variants[1]);
        $all_variants_3 = str_replace(',', '', $all_variants[2]);

        $var_price = $varientprice[$key];
        $var_quantity = $variantquantity[$key];
        $var_sku = $variantsku[$key];

        // dd($var_price);


        $array1[$key] = ['option1'=>$all_variants_1,'option2'=>$all_variants_2,'option3'=>$all_variants_3,'price'=>$var_price,'sku'=>$var_sku,'inventory_quantity'=>$var_quantity];
        $output = array_merge($array1, $array2);
    }		

    $variant_option1 = '';
    foreach ($variantOption as $variant_option_1) {
        $variantOption_1 = str_replace(',', '', $variant_option_1);
        $variant_option1 .= '"'.$variantOption_1.'",';
    }
    $first_variant_option = $variant_option1; //variant option 1

    $variant_option2 = '';
    foreach ($variantOption1 as $variant_option_2) {
        $variantOption_2 = str_replace(',', '', $variant_option_2);
        $variant_option2 .= '"'.$variantOption_2.'",';
    }
    $second_variant_option = $variant_option2; //variant option 2

    $variant_option3 = '';
    foreach ($variantOption2 as $variant_option_3) {
        $variantOption_3 = str_replace(',', '', $variant_option_3);
        $variant_option3 .= '"'.$variantOption_3.'",';
    }
    $third_variant_option = $variant_option3; //variant option 3
    

    $arry['name'] = $option1;
    $arry['value'] = $first_variant_option;
    $value1 = $arry;

    $arry['name'] = $option2;
    $arry['value'] = $second_variant_option;
    $value2 = $arry;

    $arry['name'] = $option3;
    $arry['value'] = $third_variant_option;
    $value3 = $arry;

    //To check if the string is empty
    $optionValue_1 = preg_replace('/"",/', '', $value1);
    $optionValue_2 = preg_replace('/"",/', '', $value2);
    $optionValue_3 = preg_replace('/"",/', '', $value3);

    // dd($optionValue_1,$optionValue_2,$optionValue_3);

    if(!empty($optionValue_1['value']) && !empty($optionValue_2['value']) && !empty($optionValue_3['value'])){
        $finalOptionValue = [$value1,$value2,$value3];
    }
    if(!empty($optionValue_1['value']) && !empty($optionValue_2['value']) && empty($optionValue_3['value'])){
        $finalOptionValue = [$value1,$value2];
    }
    if(!empty($optionValue_1['value']) && empty($optionValue_2['value']) && empty($optionValue_3['value'])){
        $finalOptionValue = [$value1];
    }
    //Convert the image in base64 encode
    $image = base64_encode(file_get_contents($req->file('media')->path()));

        //Product image object
        $productImage = [(object)[
            'attachment' => $image
        ]
        ];
        //Add product request data
        $shop = auth()->user();
        $product = (object)[
            "title" => $title,
            "body_html" => $description,
            "vendor" => $vendor,
            "product_type" => $type,
            "tags" => $tags,
            "images" => $productImage,
            "variants" => $output,
            "options" => $finalOptionValue,
        ];

        // dd($product);
        //=========API CALL==========
        $shop = auth()->user();
        $requestAddProduct = $shop->api()->rest('POST','/admin/api/2020-10/products.json',['product'=>$product]);


        
        return back()->with('success','Product added successfully.');
    }



   function edit(Request $request,$id)
  {
      $shop = auth()->user();
      $get_product = $shop->api()->rest('GET','/admin/api/2020-10/products/'.$id.'.json');

       
      return view('products.updateproduct',['product'=>$get_product]);
  }

   function update_product(Request $request, $id)
  {
      // dd($request);
      $product_title = $request->title;
      $product_description = $request->product_description;
      $product_type = $request->producttype;
      $product_vendor = $request->vendor;
      $product_tags = $request->tags;
  
      // dd($id,$product_title,$product_description,$product_type,$product_vendor,$product_tags);
      if($request->media!='')
          {
              $image = base64_encode(file_get_contents($request->file('media')->path()));
              //Product image object
              $productImage = [(object)[
                  'attachment' => $image
              ]
              ];

              $product = (object)[
              "id" => $id,
              "title" => $product_title,
              "body_html" => $product_description,
              "tags" => $product_tags,
              "vendor" =>	$product_vendor,
              "images"=>$productImage,
              
          ];

          }

      else
          {
              $product = (object)[
              "id" => $id,
              "title" => $product_title,
              "body_html" => $product_description,
              "tags" => $product_tags,
              "vendor" =>	$product_vendor,
          
      ];
          }
        
            		
    		//Update product request data
			$shop = auth()->user();

			$requestAddProduct = $shop->api()->rest('PUT','/admin/api/2020-10/products/'.$id.'.json',['product'=>$product]);

			if($requestAddProduct['status']=200)
				{
					return back()->with('success','Product Updated successfully');
				}

        }
    
// ============ Delete Combination =======================
public function deleteCombination(Request $req)
    {
        // dd($req);
            $result = '';
            $variantDelIndex = $req->variantDelIndex;
            $allVariantsSession = Session::get('allVariants');
            $delVariantIndex = $allVariantsSession[$variantDelIndex];

        //Get del variant combination
                if(!empty($delVariantIndex[0])){
                    $value_1 = $delVariantIndex[0];
                    $delCombination = str_replace(',', '', $value_1);
                }
                if(!empty($delVariantIndex[1])){
                    $value_2 = ' / '.$delVariantIndex[1];
                    $delCombination = str_replace(',', '', $value_1.$value_2);
                }
                if(!empty($delVariantIndex[2])){
                    $value_3 = ' / '.$delVariantIndex[2];
                    $delCombination = str_replace(',', '', $value_1.$value_2.$value_3);
                }

        //Put all del variant combinations into session
                /*session()->forget('allDelVariantCombinations');*/
                $getdelCombination = Session::get('allDelVariantCombinations');
                $putdelCombination = $getdelCombination.$delCombination.",";
                session()->put('allDelVariantCombinations', $putdelCombination);

        //delete the request variant and update the session
                unset($allVariantsSession[$variantDelIndex]);
                session()->put('allVariants', $allVariantsSession);


                if(!empty($allVariantsSession)){
                    $result = '<label><h5>Preview</h5></label>';

                    foreach ($allVariantsSession as $key => $value) {

                        if(!empty($value[0])){
                            $value1 = $value[0];
                            $combinations = str_replace(',', '', $value1);
                        }
                        if(!empty($value[1])){
                            $value2 = ' / '.$value[1];
                            $combinations = str_replace(',', '', $value1.$value2);
                        }
                        if(!empty($value[2])){
                            $value3 = ' / '.$value[2];
                            $combinations = str_replace(',', '', $value1.$value2.$value3);
                        }

                        $result .= '
                        <tr class="form-row">
                        <td class="col-md-3 mb-3">
                        <label for="variant">Variant</label>
                        <input class="form-control" id="variantOptionData" value="'.$combinations.'" name="variantOptionData" type="text" readonly="true" />
                        </td>
                        <td class="col-md-2 mb-3">
                        <label for="variantprice">Price <span style="color: red;">*</span></label>
                        <input class="form-control" id="variantprice" name="variantprice" type="number" required="required"/>
                        </td>
                        <td class="col-md-2 mb-3">
                        <label for="variantquantity">Quantity <span style="color: red;">*</span></label>
                        <input class="form-control" id="variantquantity" name="variantquantity" type="number" required="required"/>
                        </td>
                        <td class="col-md-2 mb-3">
                        <label for="variantsku">SKU <span style="color: red;">*</span></label>
                        <input class="form-control" id="variantsku" name="variantsku" type="text" required="required"/>
                        </td>
                        <td class="col-md-2 mb-3">
                        <label for="variantbarcode">Barcode <span style="color: red;">*</span></label>
                        <input class="form-control" id="variantbarcode" name="variantbarcode" type="text" required="required"/>
                        </td>
                        <td class="col-md-1 mb-3">
                        <button class="btn btn-outline-danger m-1 removeVariantCombination" id="removeVariants" value="'.$key.'" type="button" style="margin-top: 28px !important;"><i class="fa fa-trash"></i></button>
                        </td>
                        </tr>';
                    }
                }else{
                    $result = '<tr><td><p style="color: red;text-align: center;font-size: larger;">Sorry, All variants are deleted.</p></td></tr>';
                }
                return response()->json($result);

    }


    public function edit_variant($p_id, $v_id)
    {
        // dd($p_id, $v_id);
        $shop = auth()->user();
        $get_product = $shop->api()->rest('GET','/admin/api/2020-10/products/'.$p_id.'.json');
        // $get_varient = $shop->api()->rest('GET','/admin/api/2020-10/variants/'.$v_id.'.json');
        $get_varient = $shop->api()->rest('GET','/admin/api/unstable/products/'.$p_id.'/variants.json');
        // dd($get_product);
        return view('products.updatevariant',['getProductBy_id'=>$get_product,'getSpecficVariants'=>$v_id,'getProVariants_id'=>$get_varient]);
    }

public function update_variant(Request $request,$p_id,$v_id)
    {
        // dd($request,$p_id,$v_id);
        // dd($request->variantmedia);

        $option1 	  = $request->option1;
        $option2 	  = $request->option2;
        $option3 	  = $request->option3;
        $price 	 	  = $request->variantPrice;
        $sku 	 	  = $request->variantSku;
        $compareprice = $request->variantComparePrice;

        if($compareprice<=$price)
        {
            return back()->with('error','Compare at price needs to be higher than Price.');
        }

// ======================== Media Upload =================================
    $image = base64_encode(file_get_contents($request->file('variantmedia')->path()));
                //Product image object
                $productImage = [(object)[
                    'attachment' => $image
                ]
                ];
    // ($productImage);    		

        if($option1!==null && $option2!=null && $option3!=null){
            $varient = (object)[	
                'id' => $v_id,
                'option1' => $option1,
                'option2' => $option2,
                'option3' => $option3,
                'price'   => $price,
                'sku'     => $sku,
                'compare_at_price'=> $compareprice,

            ];
        }
        elseif($option1!==null && $option2!=null)
        {
            $varient = (object)[

                'id' => $v_id,
                'option1' => $option1,
                'option2' => $option2,
                'price'   => $price,
                'sku'     => $sku,
                'compare_at_price'=> $compareprice,
            ];
        }
        else
        {

            $varient = (object)[

                'id' => $v_id,
                'option1' => $option1,
                'price'   => $price,
                'sku'     => $sku,
                'compare_at_price'=> $compareprice,
            ];
        }


        $shop = auth()->user();
        $updated_variant = $shop->api()->rest('PUT','/admin/api/2020-10/variants/'.$v_id.'.json',['variant'=>$varient]);
        // dd($updated_variant);
        if($updated_variant['status']==200)
        {
            return back()->with('success','Variant Updated Successfully');
        }
        

    }

public function delete_product(Request $request)
{
    $deleteProductID = $request->delProduct;
    $shop = auth()->user();
    $get_products=$shop->api()->rest('delete','/admin/api/unstable/products/'.$deleteProductID.'.json');
    return response()->json($get_products);
}
    // ================= Delete A Product Varient ==========
    public function delete_variant($p_id,$v_id)
    	{
    		$shop = auth()->user();
    		$get_product = $shop->api()->rest('delete','/admin/api/2020-10/products/'.$p_id.'/variants/'.$v_id.'.json');
    		// dd($get_product);

    		if($get_product['status']==200)
    		{
    			return back()->with('success','Varient deleted successfully');
    		}
    		else
    		{
    			return back();
    		}
    	}

          //=============== Combination with Ajax ==================
     function combi(Request $request)
    {

        $selectOption = $request->variantsOption;
        $selectOption1 = $request->variantsOption1;
        $selectOption2 = $request->variantsOption2;
        $variantOption = explode(", ",$request->variantsData);
        $variantOption1 = explode(", ",$request->variantsData1);
        $variantOption2 = explode(", ",$request->variantsData2);

        $allVariants = Arr::crossJoin($variantOption,$variantOption1,$variantOption2);
        $variantsSession = session()->put('allVariants', $allVariants);

        // //delete the request variant and update the session
        //  unset($variantsSession[$allVariants]);
        //  session()->put('allVariants', $variantsSession);


        if(!empty($allVariants)){
            //Variants combination
            $result = '<label><h5>Preview</h5></label>';
            foreach ($allVariants as $key => $value) {
                if(!empty($value[0])){
                    $value1 = $value[0];
                    $combinations = str_replace(',', '', $value1);
                }
                if(!empty($value[1])){
                    $value2 = ' / '.$value[1];
                    $combinations = str_replace(',', '', $value1.$value2);
                }
                if(!empty($value[2])){
                    $value3 = ' / '.$value[2];
                    $combinations = str_replace(',', '', $value1.$value2.$value3);
                }
                $result .= '
                <tr class="form-row">
                <td class="col-md-3 mb-3">
                <label for="variant">Variant</label>
                <input class="form-control" id="variantOptionData" value="'.$combinations.'" name="variantOptionData" type="text" readonly="true" />
                </td>
                <td class="col-md-2 mb-3">
                <label for="variantprice">Price <span style="color: red;">*</span></label>
                <input class="form-control" id="variantprice" name="variantprice[]" type="number" required="required"/>
                </td>
                <td class="col-md-2 mb-3">
                <label for="variantquantity">Quantity <span style="color: red;">*</span></label>
                <input class="form-control" id="variantquantity" name="variantquantity[]" type="number" required="required"/>
                </td>
                <td class="col-md-2 mb-3">
                <label for="variantsku">SKU <span style="color: red;">*</span></label>
                <input class="form-control" id="variantsku" name="variantsku[]" type="text" required="required"/>
                </td>
                <td class="col-md-2 mb-3">
                <label for="variantbarcode">Barcode <span style="color: red;">*</span></label>
                <input class="form-control" id="variantbarcode" name="variantbarcode[]" type="text" required="required"/>
                </td>
                <td class="col-md-1 mb-3">
                <button class="btn btn-outline-danger m-1 removeVariantCombination" id="removeVariants" value="'.$key.'" type="button" style="margin-top: 28px !important;"><i class="fa fa-trash"></i></button>
                </td>
                </tr>';
            }
        }
        else{
            $result = '<tr><td><p style="color: red;text-align: center;font-size: larger;">Sorry, All variants are deleted.</p></td></tr>';
        }
        return response()->json($result);
    }


}


