<?php
namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Order;
use App\Models\OrderItem;
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
        $input_data = $request->getContent();
        $input = json_decode($input_data);

        $validation_input = [$input->user_id,$input->cart_items[0]->product_id];
        
        if(!($validation_input[0] && $validation_input[1]) ){
            $validator = [
              "sucess" => false,
              "message" => "user_id and product_id required",
            ];
            return $this->sendError('Validation Error.', $validator);       
        }
        
         $order = Order::create([
            'user_id' => $input->user_id,
            'order_date' => date('Y-m-d H:i:s'),
            'status' => 2,
            'product_id' => $input->cart_items[0]->product_id,
            'size' => 'XL',
            'img' => $input->cart_items[0]->product_image,
            'color' => 'red',
            'quantity' => $input->cart_items[0]->product_quantity,
            'amount' => $input->total_amount
         ]);

         if($order){
          foreach ($input->cart_items as $value){
             OrderItem::create([
             'user_id' => $input -> user_id,
             'order_id' => $order,
             'product_id' => $value -> product_id,
             'product_name' => $value -> product_name,
             'product_image' => $value -> product_image,
             'product_price' => $value -> product_price,
             'product_quantity' => $value -> product_quantity,
             'created_at' => date('Y-m-d H:i:s'),
             'updated_at' => date('Y-m-d H:i:s'),
            ]);
          }
         }else{
            return $this->sendResponse($order->toArray(), 'Something went wrong.');
         }

        return $this->sendResponse($order->toArray(), 'Order create successfully.');
    
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
