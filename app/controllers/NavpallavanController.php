<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use lithium\data\Connections;
use app\extensions\action\Functions;
use app\extensions\action\GoogleAuthenticator;
use app\models\N_users;
use app\models\N_prices;
use app\models\N_recipes;
use app\models\N_products;
use app\models\N_sales;
use app\models\N_orders;
use app\models\N_customers;
use app\models\N_messages;
use app\models\N_smses;
use \MongoDate;

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
				'user_id'=>(string)($this->request->data['user_id']),
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
				'conditions'=>array('user_id'=>(string)$this->request->data['user_id']),
				'order'=>array('Name'=>'ASC')
			));
			$raw = N_prices::find('all',array(
				'conditions'=>array('user_id'=>(string)$this->request->data['user_id']),
				'order'=>array('Name'=>'ASC')
			));
			
			
			return $this->render(array('json' => array("success"=>"Yes",'count'=>count($products),'products'=>$products,'raw'=>$raw)));		
		}
		
		if($this->request->data['post']=="add"){
			$data = array(
				'user_id'=>(string)($this->request->data['user_id']),
				"Name"=>(string)ucfirst($this->request->data['prodName']),
				"Ingrediants"=>array(),
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
				'user_id'=>(string)($this->request->data['user_id']),
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

public function updateProduct(){
	
	$recipe = N_recipes::find('first',array(
		'conditions'=>array(
				'_id'=>(string)$this->request->data['recipe_id'],
				'user_id'=>(string)$this->request->data['user_id'],
		)
	));
$ingrediants = array();
$data = array();
$i = 0;
foreach($recipe['Ingrediants'] as $k=>$v){
	 if($k==(string)ucfirst($this->request->data['Ingrediant'])){
			$ingrediants = array(
					(string)ucfirst($this->request->data['Ingrediant'])=> (integer)$this->request->data['Quantity']
			);
	 }else{
			$ingrediants = array(
					(string)ucfirst($k)=> (integer)$v
			);
		}
		$data = array_merge( $data,$ingrediants);
		
		$i++;
}
	$conditions = array(
				'_id'=>(string)$this->request->data['recipe_id'],
				'user_id'=>(string)$this->request->data['user_id'],
	);
 N_recipes::update(array('Ingrediants'=>$data),$conditions);
	
	
	return $this->render(array('json' => array("success"=>"Yes",'recipe'=>$recipe,'Ingrediants'=>$data)));		
}

public function addProduct(){

	$recipe = N_recipes::find('first',array(
		'conditions'=>array(
				'_id'=>(string)$this->request->data['recipe_id'],
				'user_id'=>(string)$this->request->data['user_id'],
		)
	));
$ingrediants = array();
$data = array();
$i = 0;
foreach($recipe['Ingrediants'] as $k=>$v){
			$ingrediants = array(
					(string)ucfirst($k)=> (integer)$v
			);
		$data = array_merge( $data,$ingrediants);
		$i++;
}
			$ingrediants = array(
					(string)ucfirst($this->request->data['Ingrediant'])=> (integer)$this->request->data['Quantity']
			);
			$data = array_merge( $data,$ingrediants);

	$conditions = array(
				'_id'=>(string)$this->request->data['recipe_id'],
				'user_id'=>(string)$this->request->data['user_id'],
	);
 N_recipes::update(array('Ingrediants'=>$data),$conditions);
	
	
	return $this->render(array('json' => array("success"=>"Yes",'recipe'=>$recipe,'Ingrediants'=>$data)));		
	
}

public function addRecipeProduct(){
	if($this->request->data){
		$raw = N_prices::find('first',array(
			'conditions'=>array(
					'_id'=> (string)$this->request->data['recipe_id'],
					'user_id'=>(string)$this->request->data['user_id'],
			)
		));
		
		$recipe = N_recipes::find('first',array(
			'conditions'=>array(
					'_id'=> (string)$this->request->data['product_id'],
					'user_id'=>(string)$this->request->data['user_id'],
			)		
		));
		
		
				$ingrediants = array();
				$data = array();
				$i = 0;
				foreach($recipe['Ingrediants'] as $k=>$v){
							$ingrediants = array(
									(string)ucfirst($k)=> (integer)$v
							);
						$data = array_merge( $data,$ingrediants);
						$i++;
				}
			$ingrediants = array(
					(string)ucfirst($raw['Name'])=> 0
			);
			$data = array_merge( $data,$ingrediants);
		$conditions = array(
				'_id'=>(string)$this->request->data['product_id'],
				'user_id'=>(string)$this->request->data['user_id'],
	);
 N_recipes::update(array('Ingrediants'=>$data),$conditions);
	
	}
	
	return $this->render(array('json' => array("success"=>"Yes",'raw'=>$raw,"recipe"=>$recipe)));		
}



public function deleteRecipeProduct(){
	if($this->request->data){
		
		$recipe = N_recipes::find('first',array(
			'conditions'=>array(
					'_id'=> (string)$this->request->data['product_id'],
					'user_id'=>(string)$this->request->data['user_id'],
			)		
		));
		
		
				$ingrediants = array();
				$data = array();
				$i = 0;
				foreach($recipe['Ingrediants'] as $k=>$v){
					if($k!=$this->request->data['recipe']){
							$ingrediants = array(
									(string)ucfirst($k)=> (integer)$v
							);
						$data = array_merge( $data,$ingrediants);
					}
						$i++;
				}
			
		$conditions = array(
				'_id'=>(string)$this->request->data['product_id'],
				'user_id'=>(string)$this->request->data['user_id'],
	);
 N_recipes::update(array('Ingrediants'=>$data),$conditions);
	
	}
	
	return $this->render(array('json' => array("success"=>"Yes",'raw'=>$raw,"recipe"=>$recipe)));		
}



public function skulist(){
	$skus = N_products::find('all'
		,array('order'=>array('Product Description'=>'ASC'))
	);
	
	return $this->render(array('json' => array("success"=>"Yes",'products'=>$skus)));		
}

public function franchises(){
	if($this->request->data){
			$user = N_users::find('first',array(
				'conditions'=>array('_id'=>(string)$this->request->data['user_id'])
			));
		$franchises = N_users::find('all',array(
		'conditions'=>array('refer'=>$user['mobile'])
	));
	}
	return $this->render(array('json' => array("success"=>"Yes",'franchises'=>$franchises)));		
}

public function getfranchise(){
	if($this->request->data){
			$user = N_users::find('first',array(
				'conditions'=>array('_id'=>(string)$this->request->data['franchise_id'])
			));
	}
	return $this->render(array('json' => array("success"=>"Yes",'user'=>$user)));		
}

public function getproduct(){
	if($this->request->data){
		$product = N_products::find('all'
			, array('conditions'=>array('_id'=>(string)$this->request->data['id']) 	)
		);
	$user = N_users::find('first',array(
		'conditions'=>array('_id'=>(string)$this->request->data['user_id'])
	));
	
	$franchises = N_users::find('all',array(
		'conditions'=>array('refer'=>$user['mobile'])
	));
	
	}
	
	return $this->render(array('json' => array("success"=>"Yes",'product'=>$product,'franchises'=>$franchises)));		
}

public function saveSales(){
	$timestamp = strtotime($this->request->data['saleDate']);
	
	if($this->request->data){
		$data = array(
			'user_id'=>$this->request->data['user_id'],
			'product_id'=>$this->request->data['product_id'],
			'product_name'=>$this->request->data['product_name'],
			'product_description'=>$this->request->data['product_description'],
			'product_netweight'=>$this->request->data['product_netweight'],
			'product_unit'=>$this->request->data['product_unit'],
			'product_mrp'=>$this->request->data['product_mrp'],
			'product_fran_mrp'=>$this->request->data['product_fran_mrp'],
			'franchise_id'=>$this->request->data['franchise_id'],
			'saleDate'=>date("Y-m-d", $timestamp),
			'DateTime'=>new MongoDate($timestamp),
			'product_quantity'=>$this->request->data['product_quantity'],
			'product_value'=>$this->request->data['product_value'],
			'product_fran_value'=>$this->request->data['product_quantity']*$this->request->data['product_fran_mrp'],
		);
			N_sales::create()->save($data);
	}
	return $this->render(array('json' => array("success"=>"Yes")));		
}


public function saveOrders(){
	$timestamp = strtotime($this->request->data['saleDate']);
	
	if($this->request->data){
		$data = array(
			'user_id'=>$this->request->data['user_id'],
			'product_id'=>$this->request->data['product_id'],
			'product_name'=>$this->request->data['product_name'],
			'product_description'=>$this->request->data['product_description'],
			'product_netweight'=>$this->request->data['product_netweight'],
			'product_unit'=>$this->request->data['product_unit'],
			'product_mrp'=>$this->request->data['product_mrp'],
			'product_fran_mrp'=>$this->request->data['product_fran_mrp'],
			'franchise_id'=>$this->request->data['franchise_id'],
			'orderDate'=>date("Y-m-d", $timestamp),
			'DateTime'=>new MongoDate($timestamp),
			'product_quantity'=>$this->request->data['product_quantity'],
			'product_value'=>$this->request->data['product_value'],
			'product_fran_value'=>$this->request->data['product_quantity']*$this->request->data['product_fran_mrp'],
		);
			N_orders::create()->save($data);
	}
	return $this->render(array('json' => array("success"=>"Yes")));		
}

public function getSales(){
	  $mongodb = Connections::get('default_Navpallavan');
			var_dump($mongodb);

		$results = $mongodb->command(array(
 'aggregate' => 'n_sales',
 'pipeline' => array( 
        array( 
       '$group' => array( 
        '_id' => array(
            'year'=>'$year($DateTime)',
        'month'=>'$month($DateTime)',
        'day'=>'$dayOfMonth($DateTime)',
    ),
            'sum' => array( '$sum' => '$product_quantity') ,
                ),                      
              ))));
														
			return $this->render(array('json' => array("success"=>"Yes",'results'=>$results)));		
}

public function findSales(){
	if($this->request->data){
		$franchise_id = $this->request->data['franchise_id'];
		
		$user_id = $this->request->data['user_id']	;
		$selectDateRange = split(' - ',$this->request->data['selectDateRange'])	;
		
		if($franchise_id=="All"){
			$conditions = array(
				'DateTime' => array('$gte'=>new MongoDate(strtotime($selectDateRange[0])),'$lte'=>new MongoDate(strtotime($selectDateRange[1]))),
				'user_id'=>(string)$user_id
			);
		}else{
			$conditions = array(
				'DateTime' => array('$gte'=>new MongoDate(strtotime($selectDateRange[0])),'$lte'=>new MongoDate(strtotime($selectDateRange[1]))),
				'franchise_id'=>(string)$franchise_id,
				'user_id'=>(string)$user_id
			);
		}
		$count = N_sales::count(array(
			'conditions'=>$conditions,
		));
		
		$results = N_sales::find('all',array(
			'conditions'=>$conditions,
			'order'=>array('DateTime'=>'ASC'),
//			 'limit'=>10,
//			 'page'=>0
		));
		
				$allresults = array();
		foreach($results as $r){
			$franchise_id = $r['franchise_id'];
			$franchise = N_users::find('first',array(
				'conditions'=>array('_id'=>(string)$franchise_id)
			));
			
			$data = array(
				'franchise_Name'=>$franchise['name']?:"Customer",
				'product_description'=>$r['product_description'],
				'product_quantity'=>$r['product_quantity'],
				'saleDate'=>$r['saleDate'],
				'product_value'=>$r['product_value'],
				'_id'=>$r['_id'],
				'franchise_id'=>$r['franchise_id']
			);
			array_push($allresults,$data);
		}
	}
	return $this->render(array('json' => array("success"=>"Yes",'results'=>$allresults,'count'=>$count)));		
	
}


public function findOrders(){
	if($this->request->data){
		$franchise_id = $this->request->data['franchise_id'];
		
		$user_id = $this->request->data['user_id']	;
		$selectDateRange = split(' - ',$this->request->data['selectDateRange'])	;
		
		if($franchise_id=="All"){
			$conditions = array(
				'DateTime' => array('$gte'=>new MongoDate(strtotime($selectDateRange[0])),'$lte'=>new MongoDate(strtotime($selectDateRange[1]))),
				'user_id'=>(string)$user_id,
				'fulfilled'=>null
			);
		}else{
			$conditions = array(
				'DateTime' => array('$gte'=>new MongoDate(strtotime($selectDateRange[0])),'$lte'=>new MongoDate(strtotime($selectDateRange[1]))),
				'franchise_id'=>(string)$franchise_id,
				'user_id'=>(string)$user_id,
				'fulfilled'=>null
			);
		}
		$count = N_orders::count(array(
			'conditions'=>$conditions,
		));
		
		$results = N_orders::find('all',array(
			'conditions'=>$conditions,
			'order'=>array('DateTime'=>'ASC'),
//			 'limit'=>10,
//			 'page'=>0
		));
		$allresults = array();
		foreach($results as $r){
			$franchise_id = $r['franchise_id'];
			$franchise = N_users::find('first',array(
				'conditions'=>array('_id'=>(string)$franchise_id)
			));
			
			$data = array(
				'franchise_Name'=>$franchise['name'],
				'product_description'=>$r['product_description'],
				'product_quantity'=>$r['product_quantity'],
				'orderDate'=>$r['orderDate'],
				'product_value'=>$r['product_value'],
				'_id'=>$r['_id'],
				'franchise_id'=>$r['franchise_id']
			);
			array_push($allresults,$data);
		}
	}
	return $this->render(array('json' => array("success"=>"Yes",'results'=>$allresults,'count'=>$count)));		
	
}


public function converttoSales(){
	if($this->request->data){
		$user_id = $this->request->data['user_id']	;
		$_id = $this->request->data['_id']	;
		$conditions = array(
				'_id' => (string)$_id,
				'user_id'=>(string)$user_id,
				'fulfilled'=>null
			);
		$order = N_orders::find('first',array(
			'conditions'=>$conditions
		));
		
		$data = array(
			'user_id'=>$order['user_id'],
			'product_id'=>$order['product_id'],
			'product_name'=>$order['product_name'],
			'product_description'=>$order['product_description'],
			'product_netweight'=>$order['product_netweight'],
			'product_unit'=>$order['product_unit'],
			'product_mrp'=>$order['product_mrp'],
			'product_fran_mrp'=>$order['product_fran_mrp'],
			'franchise_id'=>$order['franchise_id'],
			'saleDate'=>$order['orderDate'],
			'DateTime'=>new MongoDate(),
			'product_quantity'=>$order['product_quantity'],
			'product_value'=>$order['product_value'],
			'product_fran_value'=>$order['product_quantity']*$order['product_fran_mrp'],
		);
			N_sales::create()->save($data);
		
		$data = array(
			'fulfilled'=>'Yes'
		);
		
		N_orders::update($data,$conditions);
		
		return $this->render(array('json' => array("success"=>"Yes",'results'=>$order,'count'=>$conditions)));		
		
		
	}
}

public function franchise(){
	if($this->request->data){
		$user_id = $this->request->data['user_id']	;
		$user = N_users::find('first',array(
			'conditions'=>array('_id'=>(string)$user_id)
		));
		$Mobile = $user['mobile'];
		
		$users = N_users::find('all',array(
			'conditions'=>array('refer'=>$Mobile)
		));
		
	}
	
	return $this->render(array('json' => array("success"=>"Yes",'users'=>$users)));		
}

public function getcsv(){
	$data = $this->getstock('Y');
$mainUser = N_users::find('first',array(
'conditions'=>array('_id'=>$data[0]['user_id']))
);
$franUser = N_users::find('first',array(
'conditions'=>array('_id'=>$data[0]['franchise_id']))
);



$datanew = array();
$opening = 0;
foreach($data as $d){
	if($d['Type']=='sale'){
		$closing = $opening - $d['product_quantity'];
	}else{
		$closing = $opening + $d['product_quantity'];
	}
	$xd = array(
		'UserName'=>$mainUser['name'],
		'UserCompany'=>$mainUser['company'],
		'FranName'=>$franUser['name'],
		'FranCompany'=>$franUser['company'],
		'product_name'=>$d['product_name'],
		'product_description'=>$d['product_description'],
		'product_netweight'=>$d['product_netweight'],
		'product_unit'=>$d['product_unit'],
		'product_mrp'=>$d['product_mrp'],
		'product_fran_mrp'=>$d['product_fran_mrp'],
		'Date'=>$d['Date'],
		'Type'=>$d['Type'],
		'DateTime'=>$d['DateTime'],
		'Opening'=>$opening,
		'product_quantity'=>$d['product_quantity'],
		'Closing'=>$closing,
		'product_value'=>$d['product_value'],
		'product_fran_value'=>$d['product_fran_value'],
	);
	$opening = $closing;
	array_push($datanew,$xd);
	
}

	$filename = $data[0]['franchise_id'].$d['product_name']."UserData.csv";
	
	$pathFile = LITHIUM_APP_PATH . "/webroot/documents/" . $filename;

	$fp = fopen($pathFile, 'w+');
	$header = array_keys($datanew[0]);
	fputcsv($fp,$header);
	foreach ( $datanew as $line ) {
    fputcsv($fp, $line);
		}
	fclose($fp);
	
	return $this->render(array('json' => array("success"=>"Yes",'os'=>$filename)));		
}

public function getcsvall(){
	$data = $this->getstockall('Y');
	$mainUser = N_users::find('first',array(
		'conditions'=>array('_id'=>$data[0]['user_id']))
	);
	$franUser = N_users::find('first',array(
		'conditions'=>array('_id'=>$data[0]['franchise_id']))
	);

$datanew = array();
$opening = 0;
foreach($data as $d){
	if($d['Type']=='sale'){
		$closing = $opening - $d['product_quantity'];
	}else{
		$closing = $opening + $d['product_quantity'];
	}
	$xd = array(
		'UserName'=>$mainUser['name'],
		'UserCompany'=>$mainUser['company'],
		'FranName'=>$franUser['name'],
		'FranCompany'=>$franUser['company'],
		'product_name'=>$d['product_name'],
		'product_description'=>$d['product_description'],
		'product_netweight'=>$d['product_netweight'],
		'product_unit'=>$d['product_unit'],
		'product_mrp'=>$d['product_mrp'],
		'product_fran_mrp'=>$d['product_fran_mrp'],
		'Date'=>$d['Date'],
		'Type'=>$d['Type'],
		'DateTime'=>$d['DateTime'],
		'Opening'=>$opening,
		'product_quantity'=>$d['product_quantity'],
		'Closing'=>$closing,
		'product_value'=>$d['product_value'],
		'product_fran_value'=>$d['product_fran_value'],
	);
	$opening = $closing;
	array_push($datanew,$xd);
	
}

	$filename = $data[0]['franchise_id'].$d['product_name']."UserData.csv";
	
	$pathFile = LITHIUM_APP_PATH . "/webroot/documents/" . $filename;

	$fp = fopen($pathFile, 'w+');
	$header = array_keys($datanew[0]);
	fputcsv($fp,$header);
	foreach ( $datanew as $line ) {
    fputcsv($fp, $line);
		}
	fclose($fp);
	
	return $this->render(array('json' => array("success"=>"Yes",'os'=>$filename)));		
}



public function getstock($csv=null){
	$startDate = '2020-05-01';
	$endDate = $this->request->data['selectDateRange']	;
				$conditions = array(
				'DateTime' => array('$gte'=>new MongoDate(strtotime($startDate)),'$lte'=>new MongoDate(strtotime($endDate))),
				'franchise_id'=>(string)$this->request->data['franchise_id'],
				'product_id'=>(string)$this->request->data['product_id'],
				'user_id'=>(string)$this->request->data['user_id']
			);
			$orders = N_orders::find('all',array(
				'conditions'=>$conditions,
				'order'=>array('DateTime'=>'ASC'),
			));
			$sales = N_sales::find('all',array(
				'conditions'=>$conditions,
				'order'=>array('DateTime'=>'ASC'),
			));			
			
			$os = array();
			
			foreach($orders as $o){
				$order = array(
						"user_id"=>$o['user_id'],
						"product_id"=>$o['product_id'],
						"product_name"=>$o['product_name'],
						"product_description"=>$o['product_description'],
						"product_netweight"=>$o['product_netweight'],
						"product_unit"=>$o['product_unit'],
						"product_mrp"=>$o['product_mrp'],
						"product_fran_mrp"=>$o['product_fran_mrp'],
						"franchise_id"=>$o['franchise_id'],
						"Date"=>$o['orderDate'],
						'Type'=>'order',
						"DateTime"=>$o['DateTime'],
						"product_quantity"=>$o['product_quantity'],
						"product_value"=>$o['product_value'],
						"product_fran_value"=>$o['product_fran_value'],
				);
				array_push($os,$order);
			}
			foreach($sales as $s){
				$sale = array(
						"user_id"=>$s['user_id'],
						"product_id"=>$s['product_id'],
						"product_name"=>$s['product_name'],
						"product_description"=>$s['product_description'],
						"product_netweight"=>$s['product_netweight'],
						"product_unit"=>$s['product_unit'],
						"product_mrp"=>$s['product_mrp'],
						"product_fran_mrp"=>$s['product_fran_mrp'],
						"franchise_id"=>$s['franchise_id'],
						"Date"=>$s['saleDate'],
						'Type'=>'sale',
						"DateTime"=>$s['DateTime'],
						"product_quantity"=>$s['product_quantity'],
						"product_value"=>$s['product_value'],
						"product_fran_value"=>$s['product_fran_value'],
				);
				array_push($os,$sale);
			}								
//			usort($os, 'product_name');
//			usort($os, 'date_compare'); 
			
			
			
			//$os = $this->sortmulti ($os, 'product_name', 'asc', FALSE, true);
			
			$sort = array();
				foreach($os as $k=>$v) {
					$sort['product_name'][$k] = $v['product_name'];
					$sort['Date'][$k] = $v['Date'];
				}
			
			array_multisort($sort['product_name'], SORT_ASC, $sort['Date'], SORT_ASC,$os);
			if($csv == null){
		return $this->render(array('json' => array("success"=>"Yes",'orders'=>$os)));		
			}else{
				return $os;
			}
}


public function getstockall($csv=null){
	$startDate = '2020-05-01';
	$endDate = $this->request->data['selectDateRange']	;
	
			
		
		$products = N_products::find('all',array(
				'order'=>array('ProductName'=>ASC)
		));
	
		$os = array();
	
		foreach($products as $p){
			
			
			$conditions = array(
				'DateTime' => array('$gte'=>new MongoDate(strtotime($startDate)),'$lte'=>new MongoDate(strtotime($endDate))),
				'franchise_id'=>(string)$this->request->data['franchise_id'],
				'user_id'=>(string)$this->request->data['user_id'],
				'product_id'=>(string)$p['_id'],
			);
		
			$orders = N_orders::find('all',array(
				'conditions'=>$conditions,
				'order'=>array('product_id'=>'ASC','DateTime'=>'ASC'),
			));
				foreach($orders as $o){
				$order = array(
						"user_id"=>$o['user_id'],
						"product_id"=>$o['product_id'],
						"product_name"=>$o['product_name'],
						"product_description"=>$o['product_description'],
						"product_netweight"=>$o['product_netweight'],
						"product_unit"=>$o['product_unit'],
						"product_mrp"=>$o['product_mrp'],
						"product_fran_mrp"=>$o['product_fran_mrp'],
						"franchise_id"=>$o['franchise_id'],
						"Date"=>$o['orderDate'],
						'Type'=>'order',
						"DateTime"=>$o['DateTime'],
						"product_quantity"=>$o['product_quantity'],
						"product_value"=>$o['product_value'],
						"product_fran_value"=>$o['product_fran_value'],
				);
				array_push($os,$order);
			}
			
			$sales = N_sales::find('all',array(
				'conditions'=>$conditions,
				'order'=>array('product_id'=>'ASC','DateTime'=>'ASC'),
			));			
			foreach($sales as $s){
				$sale = array(
						"user_id"=>$s['user_id'],
						"product_id"=>$s['product_id'],
						"product_name"=>$s['product_name'],
						"product_description"=>$s['product_description'],
						"product_netweight"=>$s['product_netweight'],
						"product_unit"=>$s['product_unit'],
						"product_mrp"=>$s['product_mrp'],
						"product_fran_mrp"=>$s['product_fran_mrp'],
						"franchise_id"=>$s['franchise_id'],
						"Date"=>$s['saleDate'],
						'Type'=>'sale',
						"DateTime"=>$s['DateTime'],
						"product_quantity"=>$s['product_quantity'],
						"product_value"=>$s['product_value'],
						"product_fran_value"=>$s['product_fran_value'],
				);
				array_push($os,$sale);
			}								
		}
			
			$sort = array();
				foreach($os as $k=>$v) {
					$sort['product_name'][$k] = $v['product_name'];
					$sort['Date'][$k] = $v['Date'];
				}
			
			array_multisort($sort['product_name'], SORT_ASC, $sort['Date'], SORT_ASC,$os);
		
		// create last date stock
		$product_name = "";
		$opening = 0;
		$dataallOS = array();
		foreach ($os as $o){
			if($product_name!=$o['product_name']){
					$product_name = $o['product_name'];
					if($o['Type']=='sale'){
							$closing = $opening - $o['product_quantity'];
							$dataos = array(
								'product_name'=>$o['product_name'],
								'Date'=>$o['Date'],
								'Type'=>$o['Type'],
								'Quantity'=>$o['product_quantity'],
								'Closing'=>$closing,
							);
							
					}else{
							$closing = $opening + $o['product_quantity'];
							$dataos = array(
								'product_name'=>$o['product_name'],
								'Date'=>$o['Date'],
								'Type'=>$o['Type'],
								'Quantity'=>$o['product_quantity'],
								'Closing'=>$closing,
							);
							
					}
			}else{
					if($o['Type']=='sale'){
							$closing = $opening - $o['product_quantity'];
							$dataos = array(
								'product_name'=>$o['product_name'],
								'Date'=>$o['Date'],
								'Type'=>$o['Type'],
								'Quantity'=>$o['product_quantity'],
								'Closing'=>$closing,
							);							
							
					}else{
							$closing = $opening + $o['product_quantity'];
							$dataos = array(
								'product_name'=>$o['product_name'],
								'Date'=>$o['Date'],
								'Type'=>$o['Type'],
								'Quantity'=>$o['product_quantity'],
								'Closing'=>$closing,
							);							
							
					}
			}
			$opening = $closing;
			
			array_push($dataallOS,$dataos);
			
		}
			
		// create end
			
			if($csv == null){
				return $this->render(array('json' => array("success"=>"Yes",'orders'=>$dataallOS)));		
			}else{
				return $os;
			}
}




function sortmulti ($array, $index, $order, $natsort=FALSE, $case_sensitive=FALSE) {
         if(is_array($array) && count($array)>0) {
             foreach(array_keys($array) as $key) { 
                $temp[$key]=$array[$key][$index];
             }
             if(!$natsort) {
                 if ($order=='asc') {
                     asort($temp);
                 } else {    
                     arsort($temp);
                 }
             }
             else 
             {
                 if ($case_sensitive===true) {
                     natsort($temp);
                 } else {
                     natcasesort($temp);
                 }
                if($order!='asc') { 
                 $temp=array_reverse($temp,TRUE);
                }
             }
             foreach(array_keys($temp) as $key) { 
                 if (is_numeric($key)) {
                     $sorted[]=$array[$key];
                 } else {    
                     $sorted[$key]=$array[$key];
                 }
             }
             return $sorted;
         }
     return $sorted;
 }


public function customers(){
	$customers = N_customers::find('all',array(
		'order'=>array('dateBirth'=>'ASC','name'=>'ASC')
	));
		return $this->render(array('json' => array("success"=>"Yes",'customers'=>$customers)));		
}

public function addcustomer(){

	if($this->request->data){
				$data = array(
									'mobile' => $this->request->data['mobile'],
									'name' => ucwords($this->request->data['name']),
									'DateJoin' => new \MongoDate(),
									'dateBirth' => $this->request->data['dateBirth'],
									'user_id' => $this->request->data['user_id'],
        );
				$conditions = array("mobile"=>(string)$this->request->data['mobile']);
				$user = N_customers::find('first',array(
					'conditions'=>$conditions
				));
				
				if(count($user)==0){
					if($this->addCustomerNow($data)==true){
						$conditions = array("mobile"=>(string)$this->request->data['mobile']);
						$customer = N_customers::find('first',array(
							'conditions'=>$conditions
						));
						return $this->render(array('json' => array("success"=>"Yes",'customer'=>$customer)));		
					}else{
						return $this->render(array('json' => array("success"=>"No")));		
					}
				}else{
						return $this->render(array('json' => array("success"=>"No")));		
				}
	}

}
	public function addCustomerNow($data){
		if($data){
			N_customers::create()->save($data);
		}
		return true;
	}

public function messages(){
	$messages = N_messages::find('all',array(
		'order'=>array('title'=>'ASC')
	));
	$customer = N_customers::find('first',array(
		'conditions'=>array(
			'_id'=>(string)$this->request->data['customer_id'],
			'user_id'=>(string)$this->request->data['user_id'],
			)
	));
	
		return $this->render(array('json' => array("success"=>"Yes",'messages'=>$messages,'customer'=>$customer)));		
}

public function getmessage(){
	$message = N_messages::find('first',array(
		'conditions'=>array(
			'_id'=>(string)$this->request->data['message_id'],
			'user_id'=>(string)$this->request->data['user_id'],
			)
	));	
	$customer = N_customers::find('first',array(
		'conditions'=>array(
			'_id'=>(string)$this->request->data['customer_id'],
			'user_id'=>(string)$this->request->data['user_id'],
			)
	));	
		return $this->render(array('json' => array("success"=>"Yes",'message'=>$message,'customer'=>$customer)));		
}

public function getcustomer(){
	$customer = N_customers::find('first',array(
		'conditions'=>array(
			'_id'=>(string)$this->request->data['customer_id'],
			'user_id'=>(string)$this->request->data['user_id'],
			)
	));	
		return $this->render(array('json' => array("success"=>"Yes",'customer'=>$customer)));		
}

public function sendsms(){
	
		$message = N_messages::find('first',array(
		'conditions'=>array(
			'_id'=>(string)$this->request->data['message_id'],
			'user_id'=>(string)$this->request->data['user_id'],
			)
	));	
	$customer = N_customers::find('first',array(
		'conditions'=>array(
			'_id'=>(string)$this->request->data['customer_id'],
			'user_id'=>(string)$this->request->data['user_id'],
			)
	));	
	$mobile = "+91".$customer['mobile'];
	

	$msg = "Hi, " . $customer['name'] . " ".$message['message'] ;
	
	
	$data = array(
		'msg'=> $msg,
		'mobile'=>$mobile,
		'DateSent' => new \MongoDate(),
	);
	N_smses::create()->save($data);
	
	
	$function = new Functions();
	$returnsms = $function->sendSms($mobile,$msg);	 // Testing if it works 
	return $this->render(array('json' => array("success"=>"Yes",'mobile'=>$mobile,'msg'=>$msg)));		
	
	
}

public function savemessage(){
	$data = array(
		'message' =>$this->request->data['message'],
		'user_id' =>$this->request->data['user_id'],
	);
	N_messages::create()->save($data);
	return $this->render(array('json' => array("success"=>"Yes")));		
	
}


public function savefranchisesales(){
	
	$timestamp = strtotime($this->request->data['saleDateFranchaise']);
	
	if($this->request->data){
			$franchise_id = $this->request->data['franchise_id'];
			$franchise = N_users::find('first',array(
				'conditions'=>array('_id'=>(string)$franchise_id_id)
			));
		foreach($this->request->data as $k=>$v){
				if(substr($k,0,1)=="x"){
					if($v==""){}else{
					$productcode = substr($k,1);
					
						$product = N_products::find('first',array(
							'conditions'=>array('_id'=>(string)$productcode)
						));
							$data = array(
							'user_id'=>$this->request->data['user_id'],
							'product_id'=>$product['_id'],
							'product_name'=>$product['Product Name'],
							'product_description'=>$product['Product Description'],
							'product_netweight'=>$product['Net Weight'],
							'product_unit'=>$product['Measurement Unit of Dimension'],
							'product_mrp'=>$product['MRP:Pan India'],
							'product_fran_mrp'=>$product['FranchiseMRP'],
							'franchise_id'=>$franchise_id,
							'saleDate'=>date("Y-m-d", $timestamp),
							'DateTime'=>new MongoDate($timestamp),
							'product_quantity'=>$v,
							'product_value'=> ($v*$product['FranchiseMRP']),
							'product_fran_value'=>0,
						);		
						
						N_sales::create()->save($data);			
					}
				}
		}
	}
	return $this->render(array('json' => array("success"=>"Yes")));		
}
public function savecustomersales(){
	
	$timestamp = strtotime($this->request->data['saleDateCustomer']);
	
	if($this->request->data){
			$customer_id = $this->request->data['customer_id'];
			$customer = N_customers::find('first',array(
				'conditions'=>array('_id'=>(string)$customer_id)
			));
		foreach($this->request->data as $k=>$v){
				if(substr($k,0,1)=="x"){
					if($v==""){}else{
					$productcode = substr($k,1);
					
						$product = N_products::find('first',array(
							'conditions'=>array('_id'=>(string)$productcode)
						));
							$data = array(
							'user_id'=>$this->request->data['user_id'],
							'product_id'=>(string)$product['_id'],
							'product_name'=>$product['Product Name'],
							'product_description'=>$product['Product Description'],
							'product_netweight'=>$product['Net Weight'],
							'product_unit'=>$product['Measurement Unit of Dimension'],
							'product_mrp'=>$product['MRP:Pan India'],
							'product_fran_mrp'=>$product['FranchiseMRP'],
							'customer_id'=>$customer_id,
							'saleDate'=>date("Y-m-d", $timestamp),
							'DateTime'=>new MongoDate($timestamp),
							'product_quantity'=>$v,
							'product_value'=> ($v*$product['MRP:Pan India']),
							'product_fran_value'=>0,
						);		
						
						N_sales::create()->save($data);			
					}
				}
		}
	}
	return $this->render(array('json' => array("success"=>"Yes")));		
}

public function m_getproducts(){
	
	if($this->request->data){
	$products = N_products::find('all',array(
		'conditions'=>array(
			'MarwarCategory'=>$this->request->data['category'],
			'user_id'=>(string)$this->request->data['user_id']
			)
	));
	
	return $this->render(array('json' => array("success"=>"Yes","count"=>count($products),"products"=>$products)));		
	}
	return $this->render(array('json' => array("success"=>"No")));		
}

public function m_getprice(){
	if($this->request->data){
		$cart = $this->request->data;
  $value = 0;
  $totalvalue = 0;
		$totalquantity = 0;
  foreach ($cart as $code => $quantity){
			
   $product = N_products::find('first',array(
    'conditions'=>array('GTIN'=>(string)$code)
   ));
				$totalquantity = $totalquantity + $quantity;
    $totalvalue = floatval($product['MRP:Pan India']*$quantity); 
				$value = $value + $totalvalue;
			}
   
  
   
  return $this->render(array('json' => array("success"=>"Yes","value"=>$value,"quantity"=>$totalquantity)));		
		
	}
	return $this->render(array('json' => array("success"=>"No")));		
}

public function m_cartproducts(){
	 $cart = $this->request->data;
  $CartProducts = array();
		foreach ($cart as $code => $quantity){
			if($code!="X"){
				$product = N_products::find('first',array(
					'conditions'=>array('GTIN'=>(string)$code)
				));
			}
			if(count($product)>0){
				array_push($CartProducts,array(
				'Product Description' => $product['Product Description'],
				'GTIN' => $product['GTIN'],
				'FSSAI' => $product['Regulatory Data Fssai Lic No'],
				'HS Code' => $product['HS Code'],
				'MRP:Pan India' => $product['MRP:Pan India'],
    'MarwarCategory' => $product['MarwarCategory'],
				'Quantity'=> (integer)$quantity,
				'Value'=>$quantity*$product['MRP:Pan India'],
    
				));
			}
				$totalquantity = $totalquantity + $quantity;
    $totalvalue = floatval($product['MRP:Pan India']*$quantity); 
				$value = $value + $totalvalue;

		}
	 return $this->render(array('json' => array("success"=>"Yes","value"=>$value,"quantity"=>$totalquantity,"CartProducts"=>$CartProducts)));
 
}

public function listProducts(){
 			$products = N_products::find('all',array(
					
				));
  return compact('products');
}

public function customersInfo(){
 if($this->request->data){
  $customer = N_customers::find('first',array(
		'conditions'=>array('_id'=>$this->request->data['customer_id'])
	));
  $invoice = N_sales::count() + 1;
  return $this->render(array('json' => array("success"=>"Yes","customer"=>$customer,'invoice'=>$invoice)));		
 }
 return $this->render(array('json' => array("success"=>"No")));		
}


public function m_savecustomersalesMarwar(){
	
	
	if($this->request->data){
  
  
			$customer_id = $this->request->data['customer_id'];
   $invoice_no = $this->request->data['invoice_no'];
			$customer = N_customers::find('first',array(
				'conditions'=>array('_id'=>(string)$customer_id)
			));
   $cart = split(",",$this->request->data['cart']);
   
		foreach($cart as $k=>$v){
     $productx = split(":",$v);
     
     if($productx[0]!="X"){
      
						$product = N_products::find('first',array(
							'conditions'=>array('GTIN'=>(string)$productx[0])
						));
        $data = array(
        'user_id'=>$this->request->data['user_id'],
        'invoice_no'=>$invoice_no,
        'product_id'=>(string)$product['_id'],
        'product_name'=>$product['Product Name'],
        'product_description'=>$product['Product Description'],
        'product_netweight'=>$product['Net Weight'],
        'product_unit'=>$product['Measurement Unit of Dimension'],
        'product_mrp'=>$product['MRP:Pan India'],
        'product_fran_mrp'=>$product['FranchiseMRP'],
        'customer_id'=>$customer_id,
        'saleDate'=>date("Y-m-d", time()),
        'DateTime'=>new MongoDate(),
        'product_quantity'=>$productx[1],
        'product_value'=> ($productx[1]*$product['MRP:Pan India']),
        'product_fran_value'=>0,
        'Payment'=>$this->request->data['paymentMode'],
       );
       N_sales::create()->save($data);			
     }
		}
	}
	return $this->render(array('json' => array("success"=>"Yes")));		
}

public function m_getdisplay(){
 
 $dir   = LITHIUM_APP_PATH .'/webroot/img/navpallavan/screen';
 
 $files = scandir($dir);
 
 return $this->render(array('json' => array("success"=>"Yes","files"=>$files)));		
}

}
?>