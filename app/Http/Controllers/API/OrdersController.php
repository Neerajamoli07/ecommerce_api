<?php
namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
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
        $order_status = '';
        $payment_status = '';
        if($input->pay_status){
            $payStatus = $input->pay_status;
            if($payStatus == 1){
                $payment_status = "Pending";
            }
            if($payStatus == 2){
                $payment_status = "waiting";
            }
            if($payStatus == 3){
                $payment_status = "success";
            }
        }

        if($input->order_status){
            $orderStatus = $input->order_status;
            if($orderStatus == 1){
                $order_status= "Order Pending";
            }
            if($orderStatus == 2){
                $order_status= "Order Complete";
            }
            if($orderStatus == 3){
                $order_status= "Order Cancel";
            }
        }
        
         $order = Order::create([
            'user_id' => $input->user_id,
            'order_date' => $input->order_date,
            'status' => 2,
            'order_status' => $order_status,
            'pay_status' => $payment_status,
            'pay_type' => $input->pay_type,
            'product_id' => $input->cart_items[0]->product_id,
            'size' => 'XL',
            'img' => $input->cart_items[0]->product_image,
            'color' => 'red',
            'quantity' => $input->total_quantity,
            'amount' => $input->total_amount,
            'delivery_time' => $input->delivery_time,
            'delivery_date' => $input->delivery_date,
            'delivery_address' => $input->delivery_address
         ]);

         if($order){
          foreach ($input->cart_items as $value){
            $updatedProduct = Product::find($value -> product_id);
            if($updatedProduct->quantity >= $value -> product_quantity) { 
                $additionals = $value->additionals;
                $additonal_info = '';
                $length = count($additionals);
                foreach($additionals as $index => $additional){
                  if($index = $length-1){
                    $additonal_info .= "Name :".$additional->name.","."Price :".$additional->price;
                  }else{
                    $additonal_info .= "Name :".$additional->name.","."Price :".$additional->price .",";
                  }
                }
                
                OrderItem::create([
                'user_id' => $input -> user_id,
                'order_id' => $order -> id,
                'product_id' => $value -> product_id,
                'product_name' => $value -> product_name,
                'product_image' => $value -> product_image,
                'product_price' => $value -> product_price,
                'product_quantity' => $value -> product_quantity,
                'additional_info' =>$additonal_info
                ]);
               $updatedQuantity =  $updatedProduct->quantity - $value -> product_quantity;
               $updatedProduct->save(["quantity" => $updatedQuantity]);
            }

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
        $orders = OrderItem::where('user_id',$id)->get()->groupBy('order_id');
       
        if (is_null($orders)) {
           return $this->sendError('Order not found.');
        }
        $orders_data = $orders->toArray();
        
        $orders_format = array();
         foreach($orders_data as $index=>$record){
            $order = [];
            $order_placed_data = Order::find($record[0]['order_id']);
            $order['total_amount'] = $order_placed_data ? $order_placed_data->amount : 0;
            $order['order_date'] = $order_placed_data ? $order_placed_data->order_date : "-";
            $order["order_id"] = $order_placed_data ? $record[0]['order_id'] : "-";
            $order["cart_items"] = $record;         
            $orders_format[] = $order;
        }

       return $this->sendResponse($orders_format, 'Order retrieved successfully.');
    
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

    //order paid status
    public function paidStatus($order_id,$pay_status){
        $order = Order::find($order_id);
        $payment_status = '';
        if($pay_status){
            if($pay_status == 1){
                $payment_status = "Pending";
            }
            if($pay_status == 2){
                $payment_status = "waiting";
            }
            if($pay_status == 3){
                $payment_status = "success";
            }
        }
        
        if($order) {
            $order->pay_status = $payment_status;
            $order->save();
            return $this->sendResponse($order, 'Order pay status update successfully.');
        }else{
            return $this->sendError('Order not found.'); 
        }
    }
}
