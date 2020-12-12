<?php

namespace App\Http\Controllers;

use App\Services\MainService;
use App\Models\Product;
use App\Models\Category;
use App\Postal;
use App\Models\Size;
use App\Models\OrderItem;

class MainController extends Controller
{

    protected $main;

    /**
     * mainController constructor.
     * @param mainService $mainService
     */
    public function __construct(MainService $mainService)
    {
        $this->main = $mainService;
    }

    /**
     * Show the home page to the user.*
     * @return Response
     */
    public function index()
    {
        $data = $this->main->getHome();
        return view('frontend.body', $data);
    }

    /**
     * Show required page to user
     * @return View
     */
    public function aboutus()
    {
        return view('frontend.aboutus');
    }


    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function autocomplete()
    {
        $results = $this->main->autocomplete();
        if (request()->ajax()) {
            return response()->json($results);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show required page to user
     * @return View
     */
    public function contacts()
    {
        return view('frontend.contacts');
    }

    /**
     * @param $slug
     * @param $parent
     * @return View
     */
    public function filter($crud, $parent)
    {
        $data = $this->main->getFilter($parent);
        if (request()->ajax()) {
            return response()->json(view('frontend.ajax-products', $data)->render());
        } else {
            return view('frontend.filter_view', $data);
        }

    }

    /**
     * @param $slug
     * @param $id
     * @return View
     */
    public function product($slug, $id)
    {
        $data = $this->main->getProductInfo($slug, $id);
        return view('frontend.product_page', $data);
    }

    /**
     * @param $id
     * @return View
     */
    public function frame($id)
    {
        $item = $this->main->getFrameContent($id);
        return view('frontend.frame', compact('item'));
    }

    /**
     * @param $parent
     * @return \Illuminate\Http\JsonResponse|View
     */
    public function search($parent)
    {
        $data = $this->main->prepareSearch($parent);
        if (request()->ajax()) {
            return response()->json(view('frontend.ajax-products', $data)->render());
        } else {
            return view('frontend.filter_view', $data);
        }
    }


    /**
     * @param string $value
     * @return \Illuminate\Http\RedirectResponse
     */
    public function set_Session($value = "")
    {
        $field = request()->segment(1);
        session()->put($field, $value);
        return redirect()->back();
    }

    /**
     * Show login page to user
     * @return View
     */
    public function userLogin()
    {
        return view('frontend.login');
    }

    public function welcome()
    {
        //redirect trait AuthenticatesUsers getLogout()
        $user = auth()->user()->name;
        session()->flash('flash_message', 'You have been successfully Logged In!');
        return view('messages.welcome')->with('user', $user);
    }

    public function products()
    {
        $products = Product::all();
        $products_data = $products->toArray();
        
        $products_format = array();
         foreach($products_data as $index=>$record){
            $data = [];
            $p = product::where('id',$record['id'])->first();
            $data['id'] = $record['id'] ? $record['id'] : 0;
            $data['slug'] = $record['slug'] ? $record['slug'] : "-";
            $data["name"] = $record['name'] ? $record['name'] : "-";
            $data["description"] = $record['description'] ? $record['description'] : "-"; 
            $data["a_img"] = $record['a_img'] ? $record['a_img'] : "-";  
            $data["b_img"] = $record['b_img'] ? $record['b_img'] : "-";  
            $data["c_img"] = $record['c_img'] ? $record['c_img'] : "-";  
            $data["brand_id"] = $record['brand_id'] ? $record['brand_id'] : "-";  
            $data["cat_id"] = $record['cat_id'] ? $record['cat_id'] : "-";  
            $data["parent_id"] = $record['parent_id'] ? $record['parent_id'] : "-";  
            $data["quantity"] = $record['quantity'] ? $record['quantity'] : "-";  
            $data["price"] = $record['price'] ? $record['price'] : "-";
            $data["size"] = implode(",", $p->size->pluck("size")->all()) ;
            $data["rate"] = $record['rate'] ? $record['rate'] : "-"; 
            $data["fresh_product_date"] = $record['fresh_product_date'] ? $record['fresh_product_date'] : "-";         
            $products_format[] = $data;
        }

      // return $this->sendResponse($products_format, 'Products retrieved successfully.');
    
       
        return response()->json(['success' => true,'data' => $products_format], 200);

    }
    
    public function productCategories()
    {
        $categories = Category::all();
        return response()->json(['success' => true,'data' => $categories], 200);
    }

    public function categoryProduct($id)
    {
        // show product on the basis of category id
      $products = Product::where(['cat_id' => $id])->get();
      return response()->json(['success' => true,'data' => $products, 'msg' => 'Products retrieved successfully.']);
    }
    
    //send OTP to mobile 
    public function sendOtp($mobileno)
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $user          = 'prabhath';
        $password      = 'freshfromvypin';
        $mobileNumbers = $mobileno;
        $randomnumber = rand(1111,9999);
        $message       =  urlencode('Your OTP for FreshFromVypin login is '. $randomnumber);
        $senderid      = "FFVYPN";
        $url           = "http://sapteleservices.com/SMS_API/sendsms.php";
        $ch          = curl_init();
        if (!$ch) {
           die("Couldn't initialize a cURL handle");
        }
        $ret = curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$user&password=$password&mobile=$mobileNumbers&message=$message&sendername=$senderid&routetype=1");
        $ret            = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $curlresponse = curl_exec($ch);
        if (empty($ret)) {
           curl_close($ch);
           echo "Message Sent Error";
        } else {
           $info         = curl_getinfo($ch);
           $curlresponse = curl_exec($ch);
           
           curl_close($ch);
          return response()->json(['success' => true,'data' => $curlresponse, 'otp'=>$randomnumber , 'msg' => 'Message sent successfully.']);
  
        }
    }

    public function postals($postal_code){
        $postals = Postal::where(['pin_code' => $postal_code])->get();
        return response()->json(['success' => true,'data' => $postals, 'msg' => 'Postals retrieved successfully.']);

    }

    //get individual order
    public function userOrderItem($id)
    {
      $orderItems = OrderItem::where(['order_id' => $id])->get();
      return response()->json(['success' => true,'data' => $orderItems, 'msg' => 'Order Item retrieved successfully.']);
    }

}