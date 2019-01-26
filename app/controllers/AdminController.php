<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use app\extensions\action\Functions;

use app\models\Notifications;
use app\models\Users;
use app\models\Points;
use app\models\Plans;
use app\models\Savings;
use app\models\Products;
use app\models\Admins;
use app\models\Logins;
use app\models\Reasons;

class AdminController extends \lithium\action\Controller {


 protected function _init() {
  parent::_init();
 }
 public function approve(){
  $users = Savings::find('all',array(
   'conditions'=>array('approved'=>'No')
  ));
  $reasons = Reasons::find('all');
  $points = Points::find('all');

  return $this->render(array('json' => array("success"=>"Yes","users"=>$users,"reasons"=>$reasons,"points"=>$points)));
 }
  public function doapprove(){
   $reason = $this->request->data['reason'];
   $mcaNumber = $this->request->data['mcaNumber'];
   $point = $this->request->data['dpaddress'];
  if($reason=="" || $mcaNumber=="" || $point==""){
    $success = "No";
    return $this->render(array('json' => array("success"=>$success)));		
  }else{
   $reason = Reasons::find('first',array(
    'conditions'=>array('reason'=>urldecode($reason))
   ));
   $points = Points::find('first',array(
    'conditions'=>array('name'=>urldecode($point))
   ));
   
   $pointfound = array(
    'name'=>$points['name'],
    'address'=>$points['address'],
    'street'=>$points['street'],
    'city'=>$points['city'],
    'pin'=>$points['pin'],
    'state'=>$points['state'],
    'person'=>$points['person'],
    'mobile'=>$points['mobile'],
    'email'=>$points['email']
   );
   
   $data = array(
    'approved'=>$reason['approve'],
    'point'=>$pointfound,
    'reason'=>$reason['reason'],
   );
   $conditions = array(
    'mcaNumber'=>(string)$mcaNumber
   );
   $success = "Yes";
   Savings::update($data,$conditions);
   
   if($reason['approve']=="Yes"){

    $function = new Functions();
    $function->addnotify($mcaNumber,"Your application is Approved!","Your application is approved. Please make an initial payment of Rs. 1110 towards training and literature.");


   }else{
    $function = new Functions();
    $function->addnotify($mcaNumber,"Your application is waiting for approval","Please correct the application and resubmit again!");
   } 
   
   return $this->render(array('json' => array("success"=>$reason['approve'])));		
  }
 }

 public function approved(){
  $users = Savings::find('all',array(
   'conditions'=>array('approved'=>'Yes')
  ));
  $reasons = Reasons::find('all');
  $points = Points::find('all');

  return $this->render(array('json' => array("success"=>"Yes","users"=>$users,"reasons"=>$reasons,"points"=>$points)));
 }
 public function search(){
  $usersFound = Savings::find('all');
  
  $users = array();
  foreach($usersFound as $u){
   array_push($users, 
    array(
     'mcaNumber'=>$u['mcaNumber'],
     'mcaName'=>$u['firstName'].' '.$u['lastName'],
     'mobile'=>$u['mobile']
    )
   );  
  }
  return $this->render(array('json' => array("success"=>"Yes","users"=>$users)));
 }
 
 public function user($mcaNumber){
  $userFound = Savings::find('first',
   array(
    'conditions'=>array(
     'mcaNumber'=>(string)$mcaNumber
    )
   )
  );
  return $this->render(array('json' => array("success"=>"Yes","user"=>$userFound)));
  
 }
 
}
?>