<?php
namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Validator;


class OrdersController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$sql = "SELECT id,slug,name,description,brand_id,cat_id,parent_id,quantity,price, CONCAT(a_img, ', ', b_img, ', ', c_img) AS product_image FROM products";
       // $results = DB::select($sql);
        $orders = Order::all();
        return $this->sendResponse($orders->toArray(), 'Orders retrieved successfully.');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // user_id,order_date, status,product_id,size,
        //img, quantity,amount
        $input = $request->all();
        $validator = Validator::make($input, [
            'user_id' => 'required',
            'product_id' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        // $order = Order::create([
        //     'user_id' => $input['user_id'],
        //     'product_id' => $input[]['product_id'],
        //     'user_id' => $input['user_id'],
        //     'user_id' => $input['user_id'],
        // ]);
        // return $this->sendResponse($order->toArray(), 'Order create successfully.');
    
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $product = Product::find($id);


        // if (is_null($product)) {
        //     return $this->sendError('Product not found.');
        // }


        // return $this->sendResponse($product->toArray(), 'Product retrieved successfully.');
    
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $product->delete();
        // return $this->sendResponse($product->toArray(), 'Product deleted successfully.');
    
    }
}
