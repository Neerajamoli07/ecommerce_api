<?php

namespace App\Http\Controllers\API;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\User; 
use App\UserAddress;
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   

    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->user = $user;
    }

   

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validations
    $rules = [
        'mobile_number'=>'required',
        'password'=>'required'
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        // Validation failed
        return response()->json([
          'message' => $validator->messages(),
        ]);
      } else {
        // Fetch User
        $user = User::where('mobile_number',$request->mobile_number)->first();
        if($user) {
          // Verify the password
          if( password_verify($request->password, $user->password) ) {
            // Update Token
            $updated_token = str_random(30);
            $tokenArray = ['api_token' => $updated_token];
            $login = User::where('mobile_number',$request->mobile_number)->update($tokenArray);
            
            try {
              $user->deviceid = $request->deviceid;
              $user->save();
            }catch(\Exception $e) {
                 //echo 'Message: ' .$e->getMessage();
            }
            if($login) {
              return response()->json([
                'status'       => "sucess",
                'user_id'      => $user->id,
                'name'         => $user->name,
                'mobile_number'=> $user->mobile_number,
                'api_token' => $updated_token,
                'email'        => $user->email,
                'address'      => $user->address,
                'deviceid'     => $login->deviceid,
                'default_address'      => $user->address2,
              ]);
            }
          } else {
            return response()->json([
              'status'       => "error",
              'message' => 'Invalid Password',
            ]);
          }
        } else {
          return response()->json([
            'status'       => "Invaild",
            'message' => 'User not found',
          ]);
        }
      }
    }

  public function updateProfile(Request $request){
      $rules = [
        'user_id'=>'required'
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        // Validation failed
        return response()->json([
          'message' => $validator->messages(),
        ]);
      } else {
        // Fetch User
        $user = User::where('id',$request->get('user_id'))->first();
      
        if($user) {
          $user ->name  = $request->get('name');
          $user ->email = $request->get('email');
          $user ->mobile_number = $request->get('mobile_number');
          $user ->address = $request->get('address');
          $user->current_address = "address1";

          if($user->save()) {
            return response()->json([
              'status'       => "sucess",
              'address'         => $user->address,
            ]);
          }
        } else {
          return response()->json([
            'status'       => "Invaild",
            'message' => 'User not found',
          ]);
        }
      }

  }

  public function updateSecondAddress(Request $request){
    $rules = [
      'address'=>'required',
      'user_id'=>'required',
      'title' => 'required',
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return response()->json([
        'message' => $validator->messages(),
      ]);
    } else {
      $user = UserAddress::where('id',$request->get('id'))->first();
    
      if($user) {
        $user ->address  = $request->get('address');
        $user ->title  = $request->get('title');
        $user ->pin_code  = $request->get('pin_code');
        $user ->line1_address  = $request->get('line1_address');
        $user ->line2_address  = $request->get('line2_address');
        $user ->landmark  = $request->get('landmark');

        if($user->save()) {
          return response()->json([
            'status'       => true,
            'address'         => $user,
          ]);
        }
      } else {
        $user_address = UserAddress::create([
          'user_id' => $request->get('user_id'),
          'address' => $request->get('address'),
          'pin_code' => $request->get('pin_code'),
          'title' => $request->get('title'),
          'line1_address'=> $request->get('line1_address'),
          'line2_address'=> $request->get('line2_address'),
          'landmark'=> $request->get('landmark'),
        ]);
        if($user_address){
          return response()->json([
            'status'       => true,
            'address'         => $user_address,
          ]);
        }else{
          return response()->json([
            'status'       => true,
            'address'         => "Something went wrong! please try again!",
          ]);
        }

      }
    }
  }

  public function userAdresses($user_id){
    if (!$user_id) {
      return response()->json([
        'message' => "user id is required",
      ]);
    } else {
      $address = UserAddress::where('user_id',$user_id)->get();
      return $this->sendResponse($address, 'User Address retrieved successfully.');
    }
  }

  public function deleteAddress($address_id){
       $user_address = UserAddress::find($address_id);
       $user_address->delete();
       return $this->sendResponse($user_address->toArray(), 'Address deleted successfully.');

  }

  public function currentAddress(Request $request){
    $rules = [
      'id' => 'required',
      'user_id'=>'required'
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      // Validation failed
      return response()->json([
        'message' => $validator->messages(),
      ]);
    } else {
      // Fetch User
      $user_address = UserAddress::find($request->get('id'));

      $user = User::where('id',$request->get('user_id'))->first();
    
      if($user) {
        $user ->address2 = $user_address->address;

        if($user->save()) {
          return response()->json([
            'status'       => true,
            'user_id'      => $user->id,
            'name'         => $user->name,
            'mobile_number'=> $user->mobile_number,
            'api_token' => $user->api_token,
            'email'        => $user->email,
            'address'      => $user->address,
            'default_address' => $user->address2,
          ]);
        }
      } else {
        return response()->json([
          'status'       => "Invaild",
          'message' => 'User not found',
        ]);
      }
    }
  }

  public function userInfo($user_id){
    //return $user_id;
    if (!$user_id) {
      return response()->json([
        'message' => "user id is required",
      ]);
    } else {
      $user = User::find($user_id);
      $user_address = UserAddress::where('user_id',$user_id)->get();
      $default_address = UserAddress::where('address',$user->address2)->get();
      if($user){
        return response()->json([
          'status'       => true,
          'user_id'      => $user->id,
          'name'         => $user->name,
          'mobile_number'=> $user->mobile_number,
          'api_token' => $user->api_token,
          'email'        => $user->email,
          'address'      => $user->address,
          'default_address' => $default_address,
          'multiple_address' => $user_address
        ]);
      }else{
        return response()->json([
          'status'       => true,
          'message' => 'User not found',
        ]);
      }
    }
  }
    
}
