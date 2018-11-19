<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;
use Hash;
use App\Http\Requests\SmsRequest;
use Session;

class SmsController extends Controller
{


	public function enviarsms(SmsRequest $request){

        $fname=$request->fname;
		$dname=$request->dname;
		$subject=$request->subject;
		$pnumber=$request->pnumber;

				// Configure client
		$config = Configuration::getDefaultConfiguration();
		$config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU0MDI3NjU3NywiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjYyOTk0LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.SpvBVRKgej3mFzDlQduhHN5PhPE92DDZIlSfGmTUUBI');
		$apiClient = new ApiClient($config);
		$messageClient = new MessageApi($apiClient);

		// Sending a SMS Message

		$sendMessageRequest2 = new SendMessageRequest([
		    'phoneNumber' => $pnumber,
		    'message' => 'Sr(a) '.$dname.' '.$subject.' de '.$fname,
		    'deviceId' => 103967
		]);
		$sendMessages = $messageClient->sendMessages([
		        $sendMessageRequest2
		]);

		//$respons=print_r($sendMessages);
		Session::flash('success', 'SMS envida com sucesso de: '.$fname.' para: '.$pnumber.' '.$dname);
		return view('sms');






	}
}
