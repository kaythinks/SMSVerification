<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Session;
use Redirect;


class SmsController extends Controller
{

    private $SMS_SENDER = "Shula Media";
    private $RESPONSE_TYPE = 'json';
    private $SMS_USERNAME = 'kaythinks@gmail.com';
    private $SMS_PASSWORD = 'shariak0';

    public function start(Request $request)
    {
     $request->validate([
    'phone_number' => 'required|digits:11'
    ]);
     $phone_number = $request->input('phone_number');
     $otp = rand(100000, 999999);

     $message = "Happy New Year from us at Shula Media. Your OTP is : $otp.";
     $this->initiateSmsActivation($phone_number, $message);
     Session::put('OTP', $otp);
     return view('starts',compact('phone_number'));
    }

    public function verifyOtp(Request $request){

    $enteredOtp = $request->input('otp');
     $phone_number = $request->input('phone_number');

    $OTP = $request->session()->get('OTP');
    //dd($OTP);
        if($OTP == $enteredOtp){
            //Removing Session variable
        Session::forget('OTP');
        Session::flash('message', " Congrats !! Your number is verified");
        return view('starts',compact('phone_number'));
        Session::forget('message');
       //return Redirect::back();
       
    }
       // return $enteredOtp;
    Session::flash('message', "Your OTP is incorrect, Pls try again !!!");
    //return view('welcome',compact('phone_number'));
    return Redirect::action('SmsController@new');
       //return view('hope',compact('phone_number'))->with('error','Your number is verified'); 
    }

    public function new(){
        return view('welcome');
    }

    /*public function getUserNumber(Request $request)
    {
        $phone_number = $request->input('phone_number');

        $message = "Happy New Year from us at Shula Media. Let's make money.";

        //$this->initiateSmsActivation($phone_number, $message);
        $this->initiateSmsGuzzle($phone_number, $message);

        return redirect()->back()->with('message', 'Message has been sent successfully');
    }
*/

    public function initiateSmsActivation($phone_number, $message){
        $isError = 0;
        $errorMessage = true;

        //Preparing post parameters
        $postData = array(
            'username' => $this->SMS_USERNAME,
            'password' => $this->SMS_PASSWORD,
            'message' => $message,
            'sender' => $this->SMS_SENDER,
            'mobiles' => $phone_number,
            'response' => $this->RESPONSE_TYPE
        );
        //dd($postData);

        $url = "http://portal.bulksmsnigeria.net/api/";

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));


        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        //get response
        $output = curl_exec($ch);


        //Print error if any
        if (curl_errno($ch)) {
            $isError = true;
            $errorMessage = curl_error($ch);
        }
        curl_close($ch);


        if($isError){
            return array('error' => 1 , 'message' => $errorMessage);
        }else{
            return array('error' => 0 );
        }
    }

    public function initiateSmsGuzzle($phone_number, $message)
    {
        $client = new Client();

        $response = $client->post('http://portal.bulksmsnigeria.net/api/?', [
            'verify'    =>  false,
            'form_params' => [
                'username' => $this->SMS_USERNAME,
                'password' => $this->SMS_PASSWORD,
                'message' => $message,
                'sender' => $this->SMS_SENDER,
                'mobiles' => $phone_number,
            ],
        ]);
        //dd($response);

        $response = json_decode($response->getBody(), true);
    }
}
