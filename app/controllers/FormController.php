<?php
namespace app\controllers;
use \lithium\template\View;
use app\models\Questions;
use app\models\;

use app\extensions\action\GoogleAuthenticator;



class FormController extends \lithium\action\Controller {

 protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'form';
 }

 public function index(){}


 public function q($q=null,$user_id=null,$refer_id=null){
  if($q == 0){
    if($refer_id==null){
     $ga = new GoogleAuthenticator();
     $user_id = substr($ga->createSecret(64),0,10);	
     $data = array(
      'user_id' => $user_id,
  				'refer_left' => 0,
      'refer_id' => "",
      'ancestors' => array(""),
      'left'=>1,
      'right'=>2,
     );
     Qusers::create()->save($data); 
    }
  }else{
  }
 $next = $q + 1;
 
 $question = Questions::find('first',array(
  'conditions'=>array('QNumber'=>(integer)$q)
 ));

 $user = Qusers::find('first',array(
    'conditions'=>array('user_id'=>$user_id)
   ));
  return compact('q','next','user_id','question','user');
 }

 public function r($refer_id=null){
  $ga = new GoogleAuthenticator();
  $user_id = substr($ga->createSecret(64),0,10);	

    $refer = Qusers::first(array(
						'fields'=>array('left','user_id','ancestors'),
							'conditions'=>array('user_id'=>$refer_id)
				));
 				$refer_left = (integer)$refer['left'];
     $refer_left_inc = (integer)$refer['left'];
     
     $refer_ancestors = $refer['ancestors'];
     $ancestors = array();

    foreach ($refer_ancestors as $ra){
					array_push($ancestors, $ra);
				}
    
    
				$refer_member = (string) $refer_id;
				array_push($ancestors,$refer_member);
				Qusers::update(
					array(
						'$inc' => array('right' => (integer)2)
					),
					array('right' => array('>'=>(integer)$refer_left_inc)),
					array('multi' => true)
				);
				Qusers::update(
					array(
						'$inc' => array('left' => (integer)2)
					),
					array('left' => array('>'=>(integer)$refer_left_inc)),
					array('multi' => true)
				);
  
  $data = array(
   'user_id' => $user_id,
   'refer_id'=> $refer_id,
			'ancestors'=> $ancestors,
			'DateJoin'=> new \MongoDate,
			'left'=>(integer)($refer_left+1),
			'right'=>(integer)($refer_left+2),

  );
  Qusers::create()->save($data); 
  $next = 1;
  return compact('next','user_id','refer_id');
 }

public function s(){
   $q = $this->request->data['q'];
   $user_id = $this->request->data['user_id'];
   
   switch ($q){
    
    case "1":
    $data = array(
     'name'=>$this->request->data['name'],
    );
    break;
    
    case "2":
    $data = array(
     'email'=>$this->request->data['email'],
    );
    break;
    
    case "3":
    $data = array(
     'mobile'=>$this->request->data['mobile'],
    );
    break;

    case "4":
    $data = array(
     'dob'=>$this->request->data['dob'],
    );
    break;

    case "5":
    $data = array(
     'gender'=>$this->request->data['gender'],
    );
    break;


  }
   $conditions = array(
    'user_id'=>$user_id,
   );
   
   Qusers::update($data,$conditions);
   
   $success = "Yes";
   return $this->render(array('json' => array("success"=>$success, "data"=>$data)));		
} 
}
?>