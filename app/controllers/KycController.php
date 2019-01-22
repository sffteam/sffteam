<?php
namespace app\controllers;

use app\extensions\action\GoogleAuthenticator;
use lithium\util\Validator;
use app\extensions\action\Functions;
use \lithium\template\View;


class KycController extends \lithium\action\Controller {

 public function index(){
  if($this->request->data){
   $mobile = "+91".$this->request->data['mobile'];
   $message = urlencode( $this->request->data['message']);
   $function = new Functions();
   $returnvalues = $function->twiliomsg($mobile,$message);	 // Testing if it works 
  }
 }
}
?>