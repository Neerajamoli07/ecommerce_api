<?php
namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Validator;


class ProductController extends BaseController
{
   
    public function index()
    {
        //$sql = "SELECT id,slug,name,description,brand_id,cat_id,parent_id,quantity,price, CONCAT(a_img, ', ', b_img, ', ', c_img) AS product_image FROM products";
       // $results = DB::select($sql);
        $products = Product::all();
        return $this->sendResponse($products->toArray(), 'Products retrieved successfully.');
    }

    public function store(Request $request)
    {
        // $input = $request->all();
        // $validator = Validator::make($input, [
        //     'name' => 'required',
        //     'detail' => 'required'
        // ]);


        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors());       
        // }


        // $product = Product::create($input);
        // return $this->sendResponse($product->toArray(), 'Product created successfully.');
    
    }

    public function show($id)
    {
        // $product = Product::find($id);


        // if (is_null($product)) {
        //     return $this->sendError('Product not found.');
        // }


        // return $this->sendResponse($product->toArray(), 'Product retrieved successfully.');
    
    }
    public function update(Request $request)
    {
        // $input = $request->all();


        // $validator = Validator::make($input, [
        //     'name' => 'required',
        //     'detail' => 'required'
        // ]);


        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors());       
        // }


        // $product->name = $input['name'];
        // $product->detail = $input['detail'];
        // $product->save();


        // return $this->sendResponse($product->toArray(), 'Product updated successfully.');
   
    }

    public function destroy($id)
    {
        // $product->delete();
        // return $this->sendResponse($product->toArray(), 'Product deleted successfully.');
    }

    // serach product
    public function searchProduct($data){
      $products = Product::where('name', 'like', '%' . $data . '%')
            ->orderBy('name')->get();
     return $this->sendResponse($products->toArray(), 'Product retrieve successfully.');
    }
}
