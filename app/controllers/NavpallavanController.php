<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use app\extensions\action\Functions;
use app\extensions\action\GoogleAuthenticator;
use app\models\N_users;
use app\models\N_prices;
use app\models\N_recipes;

class NavpallavanController extends \lithium\action\Controller {

	 protected function _init() {
  parent::_init();
//  $user = Session::read('default');
  // if($user==null){
   // return $this->redirect('/savings');
  // }
  $this->_render['layout'] = 'default';
 }
	public function index(){
		return $this->render(array('json' => array("success"=>"Yes")));		
	}
	
	public function sendotp(){
		if($this->request->data){
		
		$mobile = $this->request->data['mobile'];
		
	 $user = N_users::find('first',array(
   'conditions'=>array(
				'mobile'=>(string)$mobile,
				)
		));
		if(count($user)==1){
			$mobile = "+91".$this->request->data['mobile'];
			$ga = new GoogleAuthenticator();
			$otp = $ga->getCode($ga->createSecret(64));	
			$data = array(
				'otp' => $otp,
				);
			
			$conditions = array("mobile"=>(string)$this->request->data['mobile']);
			
			N_users::update($data,$conditions);
			$function = new Functions();
			$msg = "". $otp . " is the OTP for Navpallavan to register in the app";
			$returncall = $function->twilio($mobile,$msg,$otp);	 // Testing if it works 
			$returnsms = $function->sendSms($mobile,$msg);	 // Testing if it works 
			$user = N_users::find('first',array(
   'conditions'=>$conditions
			));
				return $this->render(array('json' => array("success"=>"Yes","otp"=>$otp,'user'=>$user)));		
		}else{
				return $this->render(array('json' => array("success"=>"No")));		
		}
	}
	return $this->render(array('json' => array("success"=>"No")));		
	}
	
	public function verifyotp(){
		if($this->request->data){
		
			$mobile = $this->request->data['mobile'];
			$otp = $this->request->data['otp'];
			$conditions = array("mobile"=>(string)$this->request->data['mobile'],'otp'=>(string)$this->request->data['otp']);

			
			$user = N_users::find('first',array(
   'conditions'=>$conditions
		));
		
		if(count($user)==1){
			return $this->render(array('json' => array("success"=>"Yes","otp"=>$otp,'user'=>$user)));		
		}else{
			return $this->render(array('json' => array("success"=>"No")));		
		}
		return $this->render(array('json' => array("success"=>"No")));		
	}
}

public function getinfo(){
		if($this->request->data){
			$mobile = $this->request->data['mobile'];
			
			$conditions = array("mobile"=>(string)$this->request->data['mobile']);
			$user = N_users::find('first',array(
				'conditions'=>$conditions
			));
	if(count($user)==1){
			return $this->render(array('json' => array("success"=>"Yes",'user'=>$user)));		
		}else{
			return $this->render(array('json' => array("success"=>"No")));		
		}
		return $this->render(array('json' => array("success"=>"No")));		

		}
}

public function adduser(){
	if($this->request->data){
				$data = array(
									'mobile' => $this->request->data['mobile'],
									'email' => strtolower($this->request->data['email']),
									'name' => ucwords($this->request->data['name']),
									'DateJoin' => new \MongoDate(),
									'refer' => $this->request->data['refer_mobile'],
									'role'=>$this->request->data['role'],
									'company'=>$this->request->data['company'],
        );
				$conditions = array("mobile"=>(string)$this->request->data['mobile']);
				$user = N_users::find('first',array(
					'conditions'=>$conditions
				));
				
				if(count($user)==0){
					if($this->addUserJoin($data)==true){
						$conditions = array("mobile"=>(string)$this->request->data['mobile']);
						$user = N_users::find('first',array(
							'conditions'=>$conditions
						));
						return $this->render(array('json' => array("success"=>"Yes",'user'=>$user)));		
					}else{
						return $this->render(array('json' => array("success"=>"No")));		
					}
				}else{
						return $this->render(array('json' => array("success"=>"No")));		
				}
	}
}

function addUserJoin($data){
	if($data){
			if($data['mobile']!="" && $data["name"]!=""){
					$refer = N_users::first(array(
						'conditions'=>array('mobile'=>(string)$data['refer'])
					));
				if(count($refer)>0){
						$refer_ancestors = $refer['ancestors'];
							$ancestors = array();
							if(count($refer_ancestors)>0){
								foreach ($refer_ancestors as $ra){
									array_push($ancestors, $ra);
								}
							}
					$refer_mobile = (string) $refer['mobile'];

					array_push($ancestors,$refer_mobile);
					
					$refer_left = (integer)$refer['left'];
					$refer_left_inc = (integer)$refer['left'];
					
					N_users::update(
						array(
							'$inc' => array('right' => (integer)2)
						),
						array('right' => array('>'=>(integer)$refer_left_inc)),
						array('multi' => true)
					);
					N_users::update(
						array(
							'$inc' => array('left' => (integer)2)
						),
						array('left' => array('>'=>(integer)$refer_left_inc)),
						array('multi' => true)
					);
					
					$newData = array(
							'mobile' => (string)$data['mobile'],
							'email' => strtolower($data['email']),
							'name' => ucwords($data['name']),
							'DateJoin' => $data['DateJoin'],
							'refer' => (string)$data['refer'],
							'role'=>$data['role'],
							'company'=>$data['company'],
							'left'=>(integer)($refer_left+1),
							'right'=>(integer)($refer_left+2),
							'ancestors'=> $ancestors,
					);
					
					N_users::create()->save($newData);
					return true;
				}else{
					return false;
				}
			}
	}	
}

public function findteam(){
	if($this->request->data){
		$mobile = $this->request->data['mobile'];
		$user = N_users::find('first',array(
			'conditions'=>array('mobile'=>(string)$mobile)
		));
		$left = $user['left'];
		$right = $user['right'];
		$MyUsers = array();
		$ListUsers = N_users::find('all',array(
		'conditions'=>array(
			'left'=>array('$gt'=>$left),
			'right'=>array('$lt'=>$right),
		),
		'order'=>array('name'=>'ASC')
	));
	
		foreach($ListUsers as $lu){
			array_push($MyUsers,array(
				'mobile'=>$lu['mobile'],
				'name'=>$lu['name'],
				'_id'=>(string)$lu['_id'],
				'company'=>$lu['company'],
				));
		}
			array_push($MyUsers,array(
				'mobile'=>$user['mobile'],
				'name'=>$user['name'],
				'_id'=>(string)$user['_id'],
				'company'=>$user['company'],
				));
		return $this->render(array('json' => array("success"=>"Yes",'users'=>$MyUsers)));		
	}
	return $this->render(array('json' => array("success"=>"No")));		
}

public function rawmaterials(){
	if($this->request->data){
		
		if($this->request->data['post']=="get"){
			$raw = N_prices::find('all',array(
				'conditions'=>array('user_id'=>(string)$this->request->data['user_id']),
				'order'=>array('Name'=>'ASC')
			));
			return $this->render(array('json' => array("success"=>"Yes",'count'=>count($raw),'raw'=>$raw)));		
		}
		
		if($this->request->data['post']=="add"){
			$data = array(
				'user_id'=>(string($this->request->data['user_id'])),
				"Name"=>(string)ucfirst($this->request->data['rawName']),
				"Price"=>(integer)$this->request->data['rawPrice']
			);
			N_prices::create()->save($data);
			$raw = N_prices::find('all',array(
				'conditions'=>array('user_id'=>(string)$this->request->data['user_id']),
				'order'=>array('Name'=>'ASC')
			));
			return $this->render(array('json' => array("success"=>"Yes",'count'=>count($raw),'raw'=>$raw)));		
		}
		
		if($this->request->data['post']=="edit"){
			$data = array(
				'user_id'=>(string)$this->request->data['user_id'],
				"Name"=>(string)ucfirst($this->request->data['rawName']),
				"Price"=>(integer)$this->request->data['rawPrice']
			);
			$conditions = array(
				'_id'=>(string)$this->request->data['_id'],
			);
			N_prices::update($data,$conditions);
			$raw = N_prices::find('all',array(
				'conditions'=>array('user_id'=>(string)$this->request->data['user_id']),
				'order'=>array('Name'=>'ASC')
			));
			return $this->render(array('json' => array("success"=>"Yes",'count'=>count($raw),'raw'=>$raw)));		
		}
		
		if($this->request->data['post']=='single'){
			$raw = N_prices::find('first',array(
					'conditions'=>array(
					'_id'=>(string)$this->request->data['_id'],
					'user_id'=>(string)$this->request->data['user_id'],
					)
			));
			return $this->render(array('json' => array("success"=>"Yes",'count'=>count($raw),'raw'=>$raw)));		
		}
		
		if($this->request->data['post']=='delete'){
			
			$conditions = array(
				'_id'=>(string)$this->request->data['_id'],
			);
			N_prices::remove($conditions);
			
			return $this->render(array('json' => array("success"=>"Yes")));		
		}
	}	
	
	return $this->render(array('json' => array("success"=>"No")));		
}

public function products(){
	if($this->request->data){
		
		if($this->request->data['post']=="get"){
			$products = N_recipes::find('all',array(
				'order'=>array('Name'=>'ASC')
			));
			return $this->render(array('json' => array("success"=>"Yes",'count'=>count($products),'products'=>$products)));		
		}
		
		if($this->request->data['post']=="add"){
			$data = array(
				"Name"=>(string)ucfirst($this->request->data['prodName']),
				"Price"=>(integer)$this->request->data['prodPrice']
			);
			N_recipes::create()->save($data);
			$products = N_recipes::find('all',array(
				'order'=>array('Name'=>'ASC')
			));
			return $this->render(array('json' => array("success"=>"Yes",'count'=>count($products),'products'=>$products)));		
		}
		
		if($this->request->data['post']=="edit"){
			$data = array(
				"Name"=>(string)ucfirst($this->request->data['prodName']),
				"Price"=>(integer)$this->request->data['prodPrice']
			);
			$conditions = array(
				'_id'=>(string)$this->request->data['_id'],
			);
			N_recipes::update($data,$conditions);
			$products = N_recipes::find('all',array(
				'order'=>array('Name'=>'ASC')
			));
			return $this->render(array('json' => array("success"=>"Yes",'count'=>count($products),'products'=>$products)));		
		}
		
		if($this->request->data['post']=='single'){
			$product = N_recipes::find('first',array(
					'conditions'=>array('_id'=>(string)$this->request->data['_id'])
			));
			return $this->render(array('json' => array("success"=>"Yes",'count'=>count($product),'product'=>$product)));		
		}
		
		if($this->request->data['post']=='delete'){
			
			$conditions = array(
				'_id'=>(string)$this->request->data['_id'],
			);
			N_recipes::remove($conditions);
			
			return $this->render(array('json' => array("success"=>"Yes")));		
		}
	}	
	
	return $this->render(array('json' => array("success"=>"No")));		
}


}
?>