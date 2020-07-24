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
        // $this->validateLogin($request);
        // if ($this->attemptLogin($request)) {
        //     return $this->sendResponse("error", json_encode($this->user));
        // } else {
        //     return $this->sendResponse("success", 'User login successfully.');
        // }
        if(User::where('email', $request->get('email'))->exists()){
            $user = User::where('email', $request->get('email'))->first();
            $auth = Hash::check($request->get('password'), $user->password);
            if($user && auth){
         
               $user->rollApiKey(); //Model Function
         
               return response(array(
                  'currentUser' => $user,
                  'message' => 'Authorization Successful!',
               ));
            }
         }
         return response(array(
            'message' => 'Unauthorized, check your credentials.',
         ), 401);
    }

    /**
 * Roll API Key
 */
public function rollApiKey(){
    do{
       $this->api_token = str_random(30);
    }while($this->where('api_token', $this->api_token)->exists());
    $this->save();
 }

    
}
