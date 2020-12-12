<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProduct;
use App\Http\Requests;
use App\Models\Product;
use App\Models\Size;
use App\User;
use Illuminate\Support\Facades\Session;
use Request;

class ArticlesController extends Controller
{
    
    public function index()
    {
        $products = Product::with('brands', 'size','category')->get();
        $products = Product::paginate(10);
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data['checkbox'] = Size::all();
        $data['products'] = Product::with('brands', 'size','category')->get();
        return view('product.create', $data);
    }

    /**
     * Store items in database.
     *
     * @param CreateProduct $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateProduct $request)
    {
        $data = $this->proccesData($request);
        $rates='';
        foreach ($data['rate'] as $value){
            if($value !=null){
                $rates .= $value . ",";
            }
        }
        $data['rate'] = $rates;
        $product = Product::create($data);
        $product->size()->attach($data['size_id']);
        Session::flash('flash_message', 'Product successfully added!');
        
        // send notification to all user
        $deviceids = [];
        $users = User::all();
        foreach ($users as $user){
            if($user->deviceid != null){
              $deviceids[] = $user->deviceid;
            }
            
        }


		// send notification here
		
		 $api_key = 'AAAA6lraLoE:APA91bEGIoXMt5BYuvG9zvW6qhxTCIcziGDHQIRi9Ra3nlWcUtY86QHyO2n-jIBv4bFw_pRwKHjLe-LIivmRCzEOoZ18qLqtcMOHPAGlLiRp5L8ShHIQQuD65E3Akxv6a82sv5iaRKUx';
 
         $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
 
         $token='cQcCKoXfTZq2-uJdqHIRFq:APA91bE_399N8cxy8dtupQsbBvKdLmOiGAXLrEQA774zglvn_ekGsW_owYhsHZbecXw6b52K_vw5Px0GFg_YesBd3ylwc-x9LguSdYbTirt63Nqi597rktI3ZT2sAb3go4Ob-gcQ2fLZ'; //testing device id
         $deviceids[] = $token;
         

 
         $title = "FreshFromVypin";
         $message =  "FreshFromVypin just added  " . $data['name'] . " .";
         $customData = "";
         $tokenList = $deviceids;
        
   
  
        $notification = [
            'title' => $title,
            'body' => $message,
            'data' => $customData,
            'vibrate'	=> 1,
	        'sound'		=> 1,
            'icon' =>'https://ecommerce.freshfromvypin.com/images/app_logo.jpg'
        ];
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

       

        $headers = [
            'Authorization: key=' . $api_key,
            'Content-Type: application/json'
        ];
        
        $regIdChunk=array_chunk($tokenList,1000);
        $results = [];

        foreach($regIdChunk as $RegId){
           $fcmNotification = [
            'registration_ids' => $RegId, //multple token array
            // 'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
           ];
           
           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL,$fcmUrl);
           curl_setopt($ch, CURLOPT_POST, true);
           curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
           curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
           $result = curl_exec($ch);
        
            if ($result === FALSE) {
              die('FCM Send Error: ' . curl_error($ch));
            }
        
           curl_close($ch);;
           $results[] = $result;
        }
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $product = Product::with('brands', 'size','category')->find($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */

    public function edit($id)
    {
        $data['checkbox'] = Size::all();
        $data['product'] = Product::with('brands', 'size','category')->find($id);
        return view('product.edit', $data);
    }

    /**
     * Update the specified products.
     *
     * @param $id
     * @param CreateProduct $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, CreateProduct $request)
    {
        $data = $this->proccesData($request);

        $rates='';
        foreach ($data['rate'] as $value){
            if($value !=null){
                $rates .= $value . ",";
            }
        }
        $data['rate'] = $rates;
       
        $product = Product::find($id);
        $product->update($data);
        $product->size()->sync($data['size_id']);
        Session::flash('flash_message', 'Product successfully updated!');
        // send notification to all user
        $deviceids = [];
        $users = User::all();
        foreach ($users as $user){
            if($user->deviceid != null){
              $deviceids[] = $user->deviceid;
            }
            
        }


		// send notification here
		
		 $api_key = 'AAAA6lraLoE:APA91bEGIoXMt5BYuvG9zvW6qhxTCIcziGDHQIRi9Ra3nlWcUtY86QHyO2n-jIBv4bFw_pRwKHjLe-LIivmRCzEOoZ18qLqtcMOHPAGlLiRp5L8ShHIQQuD65E3Akxv6a82sv5iaRKUx';
 
         $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
 
         $token='cQcCKoXfTZq2-uJdqHIRFq:APA91bE_399N8cxy8dtupQsbBvKdLmOiGAXLrEQA774zglvn_ekGsW_owYhsHZbecXw6b52K_vw5Px0GFg_YesBd3ylwc-x9LguSdYbTirt63Nqi597rktI3ZT2sAb3go4Ob-gcQ2fLZ'; //testing device id
         $deviceids[] = $token;
         

 
         $title = "FreshFromVypin";
         $message =  "FreshFromVypin just added Product  " . $data['name'] . " .";
         $customData = "";
         $tokenList = $deviceids;
        
   
  
        $notification = [
            'title' => $title,
            'body' => $message,
            'data' => $customData,
            'vibrate'	=> 1,
	        'sound'		=> 1,
            'icon' =>'https://ecommerce.freshfromvypin.com/images/app_logo.jpg'
        ];
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

       

        $headers = [
            'Authorization: key=' . $api_key,
            'Content-Type: application/json'
        ];
        
        $regIdChunk=array_chunk($tokenList,1000);
        $results = [];

        foreach($regIdChunk as $RegId){
           $fcmNotification = [
            'registration_ids' => $RegId, //multple token array
            // 'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
           ];
           
           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL,$fcmUrl);
           curl_setopt($ch, CURLOPT_POST, true);
           curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
           curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
           $result = curl_exec($ch);
        
            if ($result === FALSE) {
              die('FCM Send Error: ' . curl_error($ch));
            }
        
           curl_close($ch);;
           $results[] = $result;
        }
        
        return redirect()->back();
    }

    /**
     * Delete the specified products.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id)->delete();
        //Without database OnDdelete Cascade
        //$product->size()->detach($id);
        Session::flash('flash_message', 'Product successfully deleted!');
        return redirect()->back();
    }

    /**
     * Process uploaded images and request data.
     *
     * @param $request
     * @return mixed
     */
    public function proccesData($request)
    {
        $data = $request->except('a_img','size');
        $data['size_id'] = $request->input('size');
        if ($request->hasFile('a_img')) {
            $destinationPath = base_path() . '/public/images/products';
            $fileName = $request->file('a_img')->getClientOriginalName();
            $request->file('a_img')->move($destinationPath, $fileName);
            $data['a_img'] = $request->file('a_img')->getClientOriginalName();
        }
        return $data;
    }

    /**
     * Search Form for tables
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        $search = Request::get('search');
        $products = Product::where('name', 'like', '%' . $search . '%')
            ->orderBy('name')
            ->paginate(5);
        return view('product.index', compact('products'));
    }
}