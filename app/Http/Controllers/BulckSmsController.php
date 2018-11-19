<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;
use Hash;
use Session;
use App\Http\Requests\BulckSmsRequest;
use App\Bulcksms;
use App\Http\Requests\MessageBulckSmsRequest;
use App\Messagebulcksms;
use App\Http\Requests\SendBulckSmsRequest;

class BulckSmsController extends Controller
{




	public function saveclient(BulckSmsRequest $request){
		$data=$request->all();

		Bulcksms::create($data);
		Session::flash('success', 'Contacto adicionado com successo');
		return view('bulcksms');
	}
	public function savemessagen(MessageBulckSmsRequest $request){
		$data=$request->all();

		Messagebulcksms::create($data);
		Session::flash('success', 'Messagem adicionada com successo');
		return view('bulcksms');
	}

	public function sendbulcksms(){
		$messege=Messagebulcksms::get();
		$contact=Bulcksms::get();

		return view('sendbulcksms',compact('contact','messege'));

	}

	public function sendsmsfinal(SendBulckSmsRequest $request){
		$messege=Messagebulcksms::find($request->title);
		
		$contact=Bulcksms::get();
		$output="";
		$cout=0;

		foreach ($contact as $key => $cil) {//vamos contruir o bulck dos numeros
     	//$numeros.=$cil->pnumber.',';

			//$this->enviarsms($cil->dname,$messege->subject,$cil->pnumber);
			$cout=1+$cout;

     	}


		Session::flash('success', 'Foi enviado um total de '.$cout);
		return back();



	}

	public function enviarsms($dname,$subject,$pnumber){
		$dname=$dname;
		$subject=$subject;
		$pnumber=$pnumber;
				// Configure client
		$config = Configuration::getDefaultConfiguration();
		$config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU0MDI3NjU3NywiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjYyOTk0LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.SpvBVRKgej3mFzDlQduhHN5PhPE92DDZIlSfGmTUUBI');
		$apiClient = new ApiClient($config);
		$messageClient = new MessageApi($apiClient);

		// Sending a SMS Message

		$sendMessageRequest2 = new SendMessageRequest([
			'from'=>'Bayport',
		    'phoneNumber' => $pnumber,
		    'message' => $dname.' '.$subject,
		    'deviceId' => 103967
		]);

		$sendMessages = $messageClient->sendMessages([
		        $sendMessageRequest2
		]);

		//$respons=print_r($sendMessages);
		//Session::flash('success', 'SMS envida com sucesso de: '.$fname.' para: '.$pnumber.' '.$dname);
		//return view($respons);

		$output = new Symfony\Component\Console\Output\ConsoleOutput();//escrevendo na consol do navegador
		$output->writeln($sendMessages);






	}





	
}
