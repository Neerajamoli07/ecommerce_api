<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;


class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $input = $request->all();
       
        if($input['email']){
           $user = User::where('email',$input['email'])->first();
           if($user){
               $data = ['email' => ["Email already exist."]];
            return $this->sendError('Validation Error.', $data);
           }   
        }
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'mobile_number' => 'required|unique:users',
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        
        $input['password'] = bcrypt($input['password']);
        $input['rember_token'] = str_random(30);
        $input['api_token'] = $input['rember_token'];
        $user = User::create($input);
        $success['api_token'] =   $input['api_token'];
        $success['name'] =  $user->name;


        return $this->sendResponse($success, 'User register successfully.');
    }
}