<?php
namespace app\controllers;
use \lithium\data\Model;
use app\models\F_items;
use app\models\F_users;
use app\extensions\action\Functions;
use app\extensions\action\GoogleAuthenticator;


class FalsabjiController extends \lithium\action\Controller {


 protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'framework7';
 }

 public function index(){
  $items = F_items::find('all',array()); 
  return $this->render(array('json' => array("success"=>"Yes",'items'=>$items)));  
 }

 public function sendotp(){
  if($this->request->data){
   $mobile = $this->request->data['mobile'];
   $user = F_users::find('first',array(
    'conditions'=>array(
     'mobile'=>(string)$mobile,
     )
   ));
   if(count($user)==0){
    $ga = new GoogleAuthenticator();
    $otp = $ga->getCode($ga->createSecret(64)); 
    $data = array(
     'otp' => $otp,
     'mobile'=>$mobile,
    );
    
    F_users::create()->save($data);
    $function = new Functions();
    $msg = "Fal-Sabji OTP is ". $otp . ",  to register.";
//    $returncall = $function->twilio($mobile,$msg,$otp);  // Testing if it works 
    $returnsms = $function->sendSms($mobile,$msg);  // Testing if it works 
    $user = Users::find('first',array(
    'conditions'=>array(
     'mobile'=>(string)$mobile,
     )
    ));
    return $this->render(array('json' => array("success"=>"Yes","otp"=>$otp,'user'=>$user)));  
   }else{
    return $this->render(array('json' => array("success"=>"No")));  
   }
   
  }
  return $this->render(array('json' => array("success"=>"No")));  
 }




}


?>