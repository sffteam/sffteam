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
		// print_r($selectDateRange);
		// var_dump(gmdate('Y-m-d',strtotime($selectDateRange[0])));
		// var_dump(gmdate('Y-m-d',strtotime($selectDateRange[1])));
		// print_r($franchise_id);
		// print_r($user_id);
		
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
			 'limit'=>10,
			 'page'=>0
		));
		// $results = array(
			// 'startDate'=>$selectDateRange[0],
			// 'endDate'=>$selectDateRange[1],
			// 'UTCstartDate'=>strtotime($selectDateRange[0]),
			// 'UTCendDate'=>strtotime($selectDateRange[1]),
			// 'franchise'=>$franchise_id,
			// 'conditions'=>$conditions,
		// );
	}
	return $this->render(array('json' => array("success"=>"Yes",'results'=>$results,'count'=>$count)));		
	
}


public function findOrders(){
	if($this->request->data){
		$franchise_id = $this->request->data['franchise_id'];
		
		$user_id = $this->request->data['user_id']	;
		$selectDateRange = split(' - ',$this->request->data['selectDateRange'])	;
		// print_r($selectDateRange);
		// var_dump(gmdate('Y-m-d',strtotime($selectDateRange[0])));
		// var_dump(gmdate('Y-m-d',strtotime($selectDateRange[1])));
		// print_r($franchise_id);
		// print_r($user_id);
		
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
		$count = N_orders::count(array(
			'conditions'=>$conditions,
		));
		
		$results = N_orders::find('all',array(
			'conditions'=>$conditions,
			'order'=>array('DateTime'=>'ASC'),
			 'limit'=>10,
			 'page'=>0
		));
		// $results = array(
			// 'startDate'=>$selectDateRange[0],
			// 'endDate'=>$selectDateRange[1],
			// 'UTCstartDate'=>strtotime($selectDateRange[0]),
			// 'UTCendDate'=>strtotime($selectDateRange[1]),
			// 'franchise'=>$franchise_id,
			// 'conditions'=>$conditions,
		// );
	}
	return $this->render(array('json' => array("success"=>"Yes",'results'=>$results,'count'=>$count)));		
	
}
}
?>