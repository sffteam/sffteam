<?php
namespace app\controllers;
use \lithium\template\View;
use app\extensions\action\Functions;
use app\extensions\action\GoogleAuthenticator;
use app\controllers\DashboardController;
use Twilio\Rest\Client;

use app\models\Malls;
use app\models\Invoices;
use app\models\Users;
use app\models\Settings;
use app\models\Messages;
use app\models\Points;
class TwilioController extends \lithium\action\Controller {

	protected function _init() {
  parent::_init();
  $this->_render['layout'] = null;
 }
	
	public function index(){
		return $this->render(array('json' => array("success"=>"Yes","result","index")));		
	}
	
	public function pre(){
		return $this->render(array('json' => array("success"=>"Yes","result","pre")));		
		
	}
	public function post($mobile,$message){
			$sid = TWILIO_ACCOUNT_SID;
			$token = TWILIO_AUTH_TOKEN;
			$whatapp = TWILIO_WHATSAPP;
			$client = new Client($sid, $token);
				$client->messages->create(
						// the number you'd like to send the message to
						'whatsapp:'.$mobile,
						array(
										// A Twilio phone number you purchased at twilio.com/console
										'from' => "whatsapp:".TWILIO_WHATSAPP,
										// the body of the text message you'd like to send
										'body' => urldecode($message)
						)
				);

		return $this->render(array('json' => array("success"=>"Yes","result","post")));		
	}
	public function callback(){
		return $this->render(array('json' => array("success"=>"Yes","result","post")));		
	}
	
	private function call(){
			$sid = TWILIO_ACCOUNT_SID;
			$token = TWILIO_AUTH_TOKEN;
			$whatapp = TWILIO_WHATSAPP;
			$client = new Client($sid, $token);
		
			$client->calls->create(
    "+919879578255", "+917597219319",
    array("url" => "http://demo.twilio.com/docs/voice.xml")
			);
	}
public function welcome(){
		return $this->render(array('json' => array("success"=>"Yes","result","post")));		
	} 
 
}