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
        'email'=>'required|email',
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
        $user = User::where('email',$request->email)->first();
        if($user) {
          // Verify the password
          if( password_verify($request->password, $user->password) ) {
            // Update Token
            $updated_token = str_random(30);
            $tokenArray = ['api_token' => $updated_token];
            $login = User::where('email',$request->email)->update($tokenArray);
            
            if($login) {
              return response()->json([
                'status'       => "sucess",
                'name'         => $user->name,
                'email'        => $user->email,
                'api_token' => $updated_token,
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
    
}
