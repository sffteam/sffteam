<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use \lithium\data\Model;
use app\controllers\DashboardController;
use app\models\Participants;
use app\models\Mobiles;
use app\models\Users;

class M2L21Controller extends \lithium\action\Controller {
 
 
 protected function _init() {
  parent::_init();
//  $user = Session::read('default');
  // if($user==null){
   // return $this->redirect('/savings');
  // }
  $this->_render['layout'] = 'sale';
 }
 public function index( $mcaNumber = ""){
 }
 public function event( $mcaNumber = ""){
  $user = Users::find('first',array(
   'conditions'=>array("mcaNumber"=>$mcaNumber)
  ));
  $amount = Participants::find('first',array(
   'conditions'=>array("mcaNumber"=>$mcaNumber)
  ));
  return compact('user','amount');
 }

public function create(){
 return compact('users');
}

public function getusers(){
  $chars = $this->request->data['chars'];
  $dashboard = new DashboardController();
  if(is_numeric($chars)){
   $Nodes = $dashboard->getChildsNumber($this->request->data['mcaNumber'],$chars);
  }else{
   $Nodes = $dashboard->getChilds($this->request->data['mcaNumber'],$chars);
  }
 
  
  
  $yyyymm = date('Y-m');  
  $users = array();
  foreach($Nodes as $n){
   if($n["Enable"]=="Yes"){
    array_push($users,
     array(
      'mcaNumber'=>$n['mcaNumber'],
      'mcaName'=>$n['mcaName'],
//      'Level'=>$n[$yyyymm]['Level']
     )
    );
   }
   
  }
  
  return $this->render(array('json' => array("success"=>"Yes","users"=>$users)));  

}

}

