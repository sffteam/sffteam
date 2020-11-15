<?php
namespace app\controllers;
use \lithium\data\Model;
use app\models\F_items;
use app\models\F_users;
use app\models\F_units;
use app\models\F_vendoritems;
use app\models\F_vendorrates;
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

public function saveLatLon(){
 if($this->request->data){
  $mobile = $this->request->data['mobile'];
  $latitude = $this->request->data['latitude'];
  $longitude = $this->request->data['longitude'];
  $timestamp = $this->request->data['timestamp'];
  $conditions = array('mobile'=>(string)$mobile);
    $user = F_users::find('first',array(
     'conditions'=>$conditions
    ));
  $p_latitude = $user['latitude']?:0;
  $p_longitude = $user['longitude']?:0;
  $p_timestamp = $user['timestamp']?:0;
  
  $data = array(
   'latitude' => $latitude,
   'longitude'=> $longitude,
   'timestamp' => $timestamp,
   'p_latitude' => $p_latitude,
   'p_longitude' => $p_longitude,
   'p_timestamp'=> $p_timestamp
  );
  F_users::update($data,$conditions);
  $user = F_users::find('first',array(
   'conditions'=>$conditions
  ));
  
  return $this->render(array('json' => array("success"=>"Yes",'user'=>$user)));  
 }
 return $this->render(array('json' => array("success"=>"No")));  
}

public function getUsers(){
 if($this->request->data){
  $mobile1 = $this->request->data['mobile1'];
  $mobile2 = $this->request->data['mobile2'];
  $users = F_users::find('all',array(
   'conditions'=>array('mobile'=> array('$in'=>array($mobile1, $mobile2)))
  ));
  return $this->render(array('json' => array("success"=>"Yes",'users'=>$users)));
 }
 return $this->render(array('json' => array("success"=>"No")));
}


public function getVendors(){
  $users = F_users::find('all',array(
   'conditions'=>array('Type'=> 'Vendor')
  ));
 return $this->render(array('json' => array("success"=>"Yes",'users'=>$users)));
}

public function getitemsdata(){
 if($this->request->data){
  $mobile = $this->request->data['mobile'];
  $conditions = array('Mobile'=>$mobile);
  $dosell = F_vendoritems::find('all',array(
   'conditions'=>$conditions
  ));
 }
 $items = F_items::find('all',array(
  'order'=>array('Type'=>'ASC','Code'=>'ASC')
 ));
 $units = F_units::find('all');
 return $this->render(array('json' => array("success"=>"Yes",'dosell'=>$dosell,'items'=>$items,'units'=>$units,)));
}

public function savevendoritems(){
 if($this->request->data){
  $mobile = $this->request->data['mobile'];
  $code = $this->request->data['code'];
  $sell = $this->request->data['sell'];
  $conditions = array('Code'=>$code,'Mobile'=>$mobile);
  $dosell = F_vendoritems::find('first',array(
   'conditions'=>$conditions
  ));
  $data = array(
   'Mobile'=>$mobile,
   'Code'=>$code,
   'Sell'=>$sell
  );
  
  if(count($dosell)==0){
   F_vendoritems::create()->save($data);
  }else{
   F_vendoritems::update($data,$conditions);
  }
  
 }
 return $this->render(array('json' => array("success"=>"Yes")));
}

public function savevendorrates(){
 if($this->request->data){
  $mobile = $this->request->data['mobile'];
  $variety = $this->request->data['variety'];
  $rate = $this->request->data['rate'];
  $unit = $this->request->data['unit'];
  $conditions = array('Variety'=>$variety,'Mobile'=>$mobile);
  $dosell = F_vendorrates::find('first',array(
   'conditions'=>$conditions
  ));
  $data = array(
   'Mobile'=>$mobile,
   'Variety'=>$variety,
   'Rate'=>$rate,
   'Unit'=>$unit
  );
  
  if(count($dosell)==0){
   F_vendorrates::create()->save($data);
  }else{
   F_vendorrates::update($data,$conditions);
  }

 }
 return $this->render(array('json' => array("success"=>"Yes")));
}


}
?>