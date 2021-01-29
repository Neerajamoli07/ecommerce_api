<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::paginate(10);
        return view('notifications.index',compact('notifications',$notifications));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notifications.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'notification_title' => 'required',
            'notification_body' => 'required',
        ]);   
        $notification = Notification::create(['notification_title' => $request->notification_title, 'notification_body' => $request->notification_body]);
        
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
         

 
         $title = $request->notification_title;
         $message = $request->notification_body;
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

        Session::flash('flash_message', 'Notification Sent Successfully.');
        return redirect('/backend/notifications/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Postal  $postal
     * @return \Illuminate\Http\Response
     */

    public function show(Notification $notification)
    {
        return view('notifications.show' , compact('notification',$notification));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Postal  $postal
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $notification = Notification::find($id);
        return view('notifications.edit',compact('notification',$notification));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Postal  $postal
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $notification = Notification::find($id);
        $notification->notification_title = $request->notification_title;
        $notification->notification_body = $request->notification_body;
        $notification->save();

        // redirect
        return redirect('/backend/notifications');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Postal  $postal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = Notification::find($id);
        $notification->delete();
        return redirect('/backend/notifications');
    }
}
