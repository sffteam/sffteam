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
   
    $ga = new GoogleAuthenticator();
    $otp = $ga->getCode($ga->createSecret(64)); 
    $data = array(
     'otp' => $otp,
     'mobile'=>$mobile,
    );
    $conditions = array('mobile'=>(string)$mobile);
    
   if(count($user)==0){ 
    F_users::create()->save($data);
   }else{
    F_users::update($data,$conditions);
   }


    $function = new Functions();
    $msg = "Fal-Sabji OTP is ". $otp . ",  to register.";
//    $returncall = $function->twilio("+91".$mobile,$msg,$otp);  // Testing if it works 
    $returnsms = $function->sendSms("+91".$mobile,$msg);  // Testing if it works 
    $user = F_users::find('first',array(
     'conditions'=>$conditions
    ));
    
    return $this->render(array('json' => array("success"=>"Yes","otp"=>$otp,'user'=>$user)));  
  }
  return $this->render(array('json' => array("success"=>"No")));  
 }

public function saveuser(){
 if($this->request->data){
  $mobile = $this->request->data['mobile'];
  $dob = $this->request->data['dateofbirth'];
  $name = $this->request->data['name'];
  $type = $this->request->data['type'];
  
  $conditions = array('mobile'=>(string)$mobile);
  $data = array(
     'Name' => $name,
     'DOB'=>$dob,
     'Type'=>$type,
    );
  F_users::update($data,$conditions);
  $user = F_users::find('first',array(
     'conditions'=>$conditions
    ));
  return $this->render(array('json' => array("success"=>"Yes",'user'=>$user)));  
 }
 return $this->render(array('json' => array("success"=>"No")));  
}

public function getuser(){
 if($this->request->data){
  $mobile = $this->request->data['mobile'];
  $conditions = array('mobile'=>(string)$mobile);
    $user = F_users::find('first',array(
     'conditions'=>$conditions
    ));
  return $this->render(array('json' => array("success"=>"Yes",'user'=>$user)));  
 }
 return $this->render(array('json' => array("success"=>"No")));  
}

}


?>