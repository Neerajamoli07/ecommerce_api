<?php

namespace App\Http\Controllers\API;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\User; 
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
            
            if($login) {
              return response()->json([
                'status'       => "sucess",
                'user_id'      => $user->id,
                'name'         => $user->name,
                'mobile_number'=> $user->mobile_number,
                'api_token' => $updated_token,
                'email'        => $user->email,
                'address'      => $user->address,
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
        'address'=>'required',
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
      'address2'=>'required',
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
        $user ->address2 = $request->get('address2');
        $user->current_address = "address2";

        if($user->save()) {
          return response()->json([
            'status'       => true,
            'address'         => $user->address2,
          ]);
        }
      } else {
        return response()->json([
          'status'       => false,
          'message' => 'User not found',
        ]);
      }
    }

}
    
}
