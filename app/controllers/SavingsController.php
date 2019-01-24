<?php
namespace app\controllers;
use lithium\storage\Session;
use app\extensions\action\GoogleAuthenticator;

use app\extensions\action\Functions;
use app\models\Notifications;
use app\controllers\DashboardController;
use app\models\Banks;
use app\models\Events;
use app\models\Settings;
use app\models\Savings;
use app\models\Users;
use app\models\Products;
use app\models\Admins;
use app\models\Logins;
use app\models\Plans;


class SavingsController extends \lithium\action\Controller {


 protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'savings';
 }
 public function index($name=null,$password=null) {
		Session::delete('default');		
  
  if($name!=null){
    $admin = Admins::find('first',array(
     'conditions'=>array(
      "name"=>$name,
      "password"=>$password
      )
    ));
    if(count($admin)!=0){
						Session::write('default',$admin);
						$data = array(
								'name' => $name,
								'IP' => $_SERVER['REMOTE_ADDR'],
									'DateTime' => new \MongoDate(),
								);
						Logins::create()->save($data);
      return $this->render(array('json' => array("success"=>"Yes")));		      
//      return $this->redirect('/dashboard');
    }
  }

 }
 public function information() {
  
 }
 public function info($amount=null) {
  return compact('amount');
 }
 public function sff() {
  
 }
 public function pdf($name=null){
  return compact('name');
 }
 public function register(){
  $firstName = $this->request->data['firstName'];
  $lastName = $this->request->data['lastName'];
  $dateofbirth = $this->request->data['dateofbirth'];
  $gender = $this->request->data['gender'];
  $email = $this->request->data['email'];
  $mobile = $this->request->data['mobile'];
  $address = $this->request->data['address'];
  $street = $this->request->data['street'];
  $city = $this->request->data['city'];
  $pin = $this->request->data['pin'];
  $state = $this->request->data['state'];
  $mcaNumber = $this->request->data['mcaNumber'];
  $mcaPassword = $this->request->data['mcaPassword'];
  $agree = $this->request->data['agree'];
  $reason = $this->request->data['reason'];
  $approved = $this->request->data['approved'];
  $signpin = $this->request->data['signpin'];
  $user = Savings::find('first',array(
   'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
  $save = "No";
  if(count($user)==0){
   Savings::create()->save($this->request->data);
   $function = new Functions();
   $function->addnotify($this->request->data['mcaNumber'],"Waiting for Approval","You application to join SFF is waiting for approval. The approval process may take 1 to 2 days depending on your KYC documents.");
   $save = "Yes";
  }
  				return $this->render(array('json' => array("success"=>$save)));		
 }
 public function signin(){
  $mcaNumber = $this->request->data['mcaNumber'];
  $signpin = $this->request->data['signpin'];
   $user = Savings::find('first',array(
   'conditions'=>array(
    'mcaNumber'=>$mcaNumber,
    'signpin'=>$signpin
   )
  ));
  if(count($user)==0){
   $success = "No";
  }else{
   $success = "Yes";
  }
  return $this->render(array('json' => array("success"=>$success,"user"=>$user)));		
 }
 public function savecorrect(){
  $firstName = $this->request->data['firstName'];
  $lastName = $this->request->data['lastName'];
  $dateofbirth = $this->request->data['dateofbirth'];
  $gender = $this->request->data['gender'];
  $email = $this->request->data['email'];
  $mobile = $this->request->data['mobile'];
  $address = $this->request->data['address'];
  $street = $this->request->data['street'];
  $city = $this->request->data['city'];
  $pin = $this->request->data['pin'];
  $state = $this->request->data['state'];
  $mcaNumber = $this->request->data['mcaNumber'];
  $o_mcaNumber = $this->request->data['o_mcaNumber'];
  $mcaPassword = $this->request->data['mcaPassword'];
  $agree = $this->request->data['agree'];
  $reason = $this->request->data['reason'];
  $approved = $this->request->data['approved'];
  $signpin = $this->request->data['signpin'];
  $user = Savings::find('first',array(
   'conditions'=>array('mcaNumber'=>$o_mcaNumber)
  ));
  $save = "No";
  
  if(count($user)==0){
   $save = "No";
  }else{
   $save = "Yes";
   $conditions = array('mcaNumber'=>$o_mcaNumber);
   $data = array(
     'firstName' => $this->request->data['firstName'],
     'lastName' => $this->request->data['lastName'],
     'dateofbirth' => $this->request->data['dateofbirth'],
     'gender' => $this->request->data['gender'],
     'email' => $this->request->data['email'],
     'mobile' => $this->request->data['mobile'],
     'address' => $this->request->data['address'],
     'street' => $this->request->data['street'],
     'city' => $this->request->data['city'],
     'pin' => $this->request->data['pin'],
     'state' => $this->request->data['state'],
     'mcaNumber' => $this->request->data['mcaNumber'],
     'mcaPassword' => $this->request->data['mcaPassword'],
     'agree' => $this->request->data['agree'],
     'approved' => $this->request->data['approved'],
     'reason' => $this->request->data['reason'],
     'signpin' => $this->request->data['signpin'],
    );
    
    
   Savings::update($data,$conditions);
      $function = new Functions();
      $function->addnotify($this->request->data['mcaNumber'],"Waiting for Approval","You application to join SFF is waiting for approval. The approval process may take 1 to 2 days depending on your KYC documents.");
  }
  				return $this->render(array('json' => array("success"=>$save)));		
 }
 public function payment($encodeURI=null){
   $this->_render['layout'] = null;
   $data = json_decode(urldecode($encodeURI));
   if($encodeURI==null){
    return $this->render(array('json' => array("success"=>"No")));		
   }
   
  $conditions = array(
   'mcaNumber'=>(string)$data->mcaNumber,
  );
  $user = Savings::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$data->mcaNumber,)
  ));
 $paymentArray = []; 
 $paymentCount = count($user['payment']);
 
 if($user['payment']){
   foreach($user['payment'] as $p){
    $previousPayment = array(
     'mcaNumber'=>$p['mcaNumber'],
     'email'=>$p['email'],
     'mobile'=>$p['mobile'],
     'month'=>$p['month'],
     'datetime'=>$p['datetime'],
     'shopping'=>$p['shopping'],
     'approved'=>$p['approved'],
    );
     array_push($paymentArray,$previousPayment);
    
   }
 }
 
 $summaryArray = array();
 if((integer)substr($data->shopping,1)>10000){
   for ($i = 0; $i <= 11; $i++) {
     $months[] = date("Y-m", strtotime( date( 'Y-m-01' )." +$i months"));
   }
   foreach($months as $m){
    $summaryArray["summary.".$m] = array(
     'mcaNumber'=>$data->mcaNumber,
     'shopping'=>(integer)substr($data->shopping,1),
     'totalValue'=>(integer)0,
     'dateTime'=>null,
     'pending'=>(float)substr($data->shopping,1)/12*1.5,
     'monthly'=>(float)substr($data->shopping,1)/12*1.5,
     'delivery'=>'',
     'delStatus'=>(integer)0,
    ); 
   }
  }
  
  $paymentA = array(
   'mcaNumber'=>$data->mcaNumber,
   'email'=>$data->email,
   'mobile'=>$data->mobile,
   'month'=>date('Y-m-d',strtotime($data->month)),
   'datetime'=>gmdate('Y-m-d',time()),
   'shopping'=>(integer)substr($data->shopping,1),
   'approved'=>'No'
  );
   array_push($paymentArray,$paymentA);
  $pm = array('payment'=>$paymentArray);
  $conditions = array(
   'mcaNumber'=>$data->mcaNumber,
  );
  if((integer)substr($data->shopping,1)>10000){
   Savings::update($summaryArray,$conditions);
  }
   Savings::update($pm,$conditions);
   
  return compact('data','paymentCount');
 }
 public function products(){
  $products = Products::find('all');
  return compact('products');
  
 }
	public function productcategories(){
		$categories = Products::find('all',array(
			'fields'=>array('category','code'),
			'order'=>array('category'=>'ASC')
		));
		$category = '';
		$allcategories = array();
		
		foreach($categories as $c){
			$count = Products::count(array(
				'category'=>$c['category']
			));
			$oldcategory = $c['category'];
				if($category != $c['category']){
					array_push($allcategories,array('Name'=>$c['category'],'count'=>$count));
				}
				$category = $c['category'];
		}
		return $this->render(array('json' => array("categories"=>$allcategories)));		
	}
 public function product($category){
  $allproducts = array();
 		$products = Products::find('all',array(
			'conditions'=>array('category'=>rawurldecode(urldecode($category))),
			'order'=>array('code'=>'ASC')
		));
		$product = array();
		$allproducts = array();
		foreach($products as $p){
			$product = array(
				'_id' => (string)$p['_id'],
				'category' => (string)$p['category'],
				'code' => (string)$p['code'],
				'name' => (string)$p['name'],
				'size' => (string)$p['size'],
				'mrp' => (string)$p['mrp'],
				'dp' => (string)$p['dp'],
				'bv' => (string)$p['bv'],
    'discount'=>(string)$p['discount'],
    'discountType'=>(string)$p['discountType'],
    'stock'=>(string)$p['stock'],
				'description' => (string)$p['description'],
				'video' => (string)$p['video'],
			);
			array_push($allproducts,$product);
		}
  
  return $this->render(array('json' => array("products"=>$allproducts,"category"=>$category)));		
 }
 public function surl (){
  $success = "Yes";
  return $this->render(array('json' => array("success"=>$success)));		
 }
 public function furl (){
  $success = "No";
  return $this->render(array('json' => array("success"=>$success)));		
 }
 public function plans(){
  $plans = Plans::find('all',array(
   'order'=>array('cashback'=>'ASC')
  ));
  return $this->render(array('json' => array("plans"=>$plans)));		
 }
 public function getprice(){
  $cart = $this->request->data;
  //print_r($this->request->post);
  $value = 0;
  
  foreach ($cart as $code => $quantity){
   
   $product = Products::find('first',array(
    'conditions'=>array('code'=>(string)$code)
   ));

   // print_r("Code: ".$code);
    // print_r("code: ".$product['code']);
    // print_r("Name: ".$product['name']);
    // print_r("DiscountType: ".$product['discountType']);
    // print_r("Discount: ".$product['discount']);
    // print_r("MRP: ".$product['MRP']);

    if($product['discountType']=="Rs"){
     $totalvalue = floatval(($product['mrp'] - $product['discount'])*$quantity);
    }else if($product['discountType']=="Percent"){
     $totalvalue = floatval(($product['mrp']-$product['mrp']*$product['discount']/100)*$quantity); 
    }else{
     $totalvalue = floatval($product['mrp']*$quantity); 
    }
    
    $value = $value + $totalvalue;
   }
   
  return $this->render(array('json' => array("success"=>"Yes","value"=>$value)));		
 }
 public function getcartdetails(){
  $cart = $this->request->data;
  $cartArray = array();
  foreach ($cart as $code => $quantity){
   if($quantity!=0){
    array_push($cartArray,(string)$code);
   }
  }
  $products = Products::find('all',array(
   'conditions'=>array('code'=>array('$in'=>$cartArray))
  ));
  $cartProducts = array();
  $finalcode = "X:0";
  foreach ($cart as $code => $quantity){
   if($quantity!=0)
   {
    foreach ($products as $p)
    {
      if($p['code']==(string)$code)
      {
       $finalcode = $finalcode.','.(string)$code.':'.$quantity;
      }
    }
   }
  }
  return $this->render(array('json' => array("success"=>"Yes","products"=>$products,"cart"=>$finalcode)));		
 }
 public function saveorder(){
  $cart = $this->request->data;
//  print_r($cart);
//  $payments = $this->request->data['payments'];
  $ProductData = array();
  
  $dateTime = new \MongoDate;
  $dateTime = date('Y-m',$dateTime->sec);
  //array_push($data,$dateTime);
  $totalValue= 0;
  foreach ($cart as $code => $quantity){
   if($quantity!=0){
    $product = Products::find('first',array(
     'conditions'=>array('code'=>(string)$code))
    );
   if(count($product)>0){
    
    
    $value = 0;
    $mrp = (float)$product['mrp'];
    $discount = (float)$product['discount'];
    
    if($product['discountType']=='Rs'){
     $value = (float)($mrp-$discount)*$quantity;
    }else 
    if($product['discountType']=='Percent'){
     $value = (float)($mrp-($mrp*$discount/100))*$quantity;
    }else
    if($product['discountType']=='-' || $product['discountType']== null){
     $value = (float)$mrp*$quantity;
    }
    $totalValue = $totalValue + $value;
    $cartArray = array(
     'code'=>$product['code'],
     'category'=>$product['category'],
     'name'=>$product['name'],
     'mrp'=>(integer)$product['mrp'],
     'bv'=>(integer)$product['bv'],
     'dp'=>(integer)$product['dp'],
     'discount'=>(integer)$product['discount'],
     'discountType'=>$product['discountType'],
     'stock'=>(integer)$product['stock'],
     'quantity'=>(integer)$quantity,
     'value'=>(float)$value,
     'dateTime'=> new \MongoDate,
    );
     array_push($ProductData,$cartArray);
    }
   }
   
   if($code == 'mcaNumber'){
    $conditions = array('mcaNumber'=>$quantity);
    $mcaNumber = $quantity;
   }
   if($code == 'shopping'){
    $shopping = $quantity;
   }
  }
  $OldData = array();
  $saving = Savings::find('first',array($conditions));
  if(count($saving)>0){
   if($saving['summary']){
    foreach($saving['summary'] as $key=>$val){
     $odate = $key;
     foreach([$val] as $v){
      $omcaNumber=$v['mcaNumber'];
      $oshopping=$v['shopping'];
      $ototalValue=$v['totalValue'];
      $opending=$v['pending'];
      $omonthly=$v['monthly'];
      $odateTime=$v['dateTime'];
      $odelivery=$v['delivery'];
      $odelStatus=$v['delStatus'];
     }
    
      $old = array(
       'mcaNumber'=>$omcaNumber,
       'shopping'=>$oshopping,
       'totalValue'=>$ototalValue,
       'pending'=>$opending,
       'monthly'=>$omonthly,
       'dateTime'=>$odateTime,
       'delivery'=>$odelivery,
       'delStatus'=>$odelStatus,
      );
      $OldData = array(
       'summary.'.$odate => $old
      );
    }
   }
  }
  
  $data = array(
   $dateTime => $ProductData,
   'summary.'.$dateTime=>array(
   'mcaNumber'=>$mcaNumber,
   'shopping'=>$shopping,
   'totalValue'=>$totalValue,
   'dateTime'=>$dateTime,
   'pending'=>(float)$shopping/12*1.5 - $totalValue,
   'monthly'=>(float)$shopping/12*1.5,
   'delivery'=>'Accepted',
   'delStatus'=>(integer)0,
   ),
  );
  array_push($OldData,$data);
  Savings::update($data,$conditions);

   $function = new Functions();
   $function->addnotify($mcaNumber,"Order received for Rs. ".$totalValue,"We have received your order, we will be dispatching within 24 to 48 hours to the address you registered.");

  
  return $this->render(array('json' => array("success"=>"Yes","data"=>$OldData)));		
 }
 public function sendotp(){
  $mcaNumber = $this->request->data['mcaNumber'];
//  print_r($mcaNumber);
  $user = Savings::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
  ));
  $mobile = "+91".$user['mobile'];
		$ga = new GoogleAuthenticator();
		$otp = $ga->getCode($ga->createSecret(64));	
  
 		$data = array(
				'otp' => $otp,
			);
   
		$conditions = array("mcaNumber"=>(string)$mcaNumber);
		Savings::update($data,$conditions);

  $function = new Functions();
  $msg = "SFF - Savings OTP is ". $otp . ",  to place order.";
  $returnvalues = $function->twilio($mobile,$msg,$otp);	 // Testing if it works 
  $returnvalues = $function->sendSms($mobile,$msg);	 // Testing if it works 
  
  return $this->render(array('json' => array("success"=>"Yes","otp"=>$otp)));		

  }
 public function searchproducts($code = null){
  
  if($code==null){
   $products = Products::find('all',array(
   'order'=>array(
    'code'=>'ASC',
   )
  ));
  }else{
   $products = Products::find('all',array(
    'conditions'=>array(
     'code'=>(string)$code),
   ));
  }
  $allproducts = array();
  foreach($products as $p){
   $allproducts[] = array(
    'code'=>$p['code'],
    'name'=>$p['name'],
    'category'=>$p['category'],
    'quantity'=>$p['quantity'],
    'discount'=>$p['discount'],
    'size'=>$p['size'],
    'discountType'=>$p['quantityType'],
    'mrp'=>$p['mrp'],
   );
  }
  
  return $this->render(array('json' => array("success"=>"Yes","products"=>$allproducts)));		
 }
 public function emioptions(){
  $emis = Banks::find('all',array(
   'order'=>array('Bank'=>'ASC','Principal'=>'ASC','Tenure'=>'ASC')
  ));
  $banks = Banks::connection()->connection->command(array(
    'distinct' => 'banks',
    'key' => 'Bank',
  ));   
  return $this->render(array('json' => array("success"=>"Yes","banks"=>$banks,"emis"=>$emis,)));		
 }
 public function testmode(){
  $testMode = Settings::find('first');
  return $this->render(array('json' => array("success"=>"Yes","testMode"=>$testMode)));		
 }
 public function received(){
  $yyyymm = $this->request->data['yyyymm'];
  $mcaNumber = $this->request->data['mcaNumber'];
   $data = array(
   'summary.'.$yyyymm.'.delivery'=>'Received',
   'summary.'.$yyyymm.'.delStatus'=>'100',
  );
  $conditions = array(
   'mcaNumber'=>$mcaNumber
  );
  Savings::update($data,$conditions);
  return $this->render(array('json' => array("success"=>"Yes")));		
}
 public function getevent($date){
  $event = Events::find('first',array(
   'conditions'=>array('date'=>$date)
  ));
  if(count($event)==0){
   $event = array(
    'date'=>$date,
    'event'=>''
   );
  }
  return $this->render(array('json' => array("success"=>"Yes",'event'=>$event)));		
}
 public function postevent($date){
 $eventToday = $this->request->data['event'];
 if($eventToday==""){
  Events::remove( array(
  'date'=>$date
 ));
  return $this->render(array('json' => array("success"=>"Yes",'event'=>$eventToday)));		
 }
 $data = array(
  'date'=>$date,
  'event'=>$eventToday
 );
 
 $conditions = array(
  'date'=>$date
 );
  $event = Events::find('first',array(
   'conditions'=>array('date'=>$date)
  ));
  if(count($event)==0){
    Events::create()->save($data); 
  }else{
    Events::update($data,$conditions);  
  }
 
  return $this->render(array('json' => array("success"=>"Yes",'event'=>$eventToday)));		
}
 public function getevents(){
  $events = Events::find('all',array(
   'fields'=>array('date')
  ));
  $eventDates = array();
  foreach($events as $e){
   $date = explode("-",$e['date']);
   

   
   array_push($eventDates,array(
    'Y'=>$date[0],
    'M'=>$date[1],
    'D'=>$date[2],
    'color'=>'#ff0000'
   ));
  }
 
  return $this->render(array('json' => array("success"=>"Yes",'events'=>$eventDates)));		
}
 public function notification($mcaNumber=null){
 $notification = Notifications::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
 ));
 
 Notifications::remove(array('_id'=>(string)$notification['_id']));
 
 return $this->render(array('json' => array("success"=>"Yes",'notification'=>$notification)));		
 
}

public function tree($mcaNumber = null,$yyyymm=null){
 
 $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>(string)$mcaNumber),
  'order'=>array('mcaName'=>'ASC')
 ));
 
 $ancestors = array();
 if($user['ancestors']){
  foreach($user['ancestors'] as $a){
   if($a!=""){
    array_push($ancestors,$a);
   }
  }
 }
// print_r($ancestors);
 
 $names = Users::find('all',array(
  'conditions'=>array('mcaNumber'=>array('$in'=>$ancestors)),
  'order'=>array('_id'=>'ASC')
 ));
 $namesFound = array();
 foreach($names as $n){
  array_push($namesFound, array(
    'mcaName'=>$n['mcaName'],
    'mcaNumber'=>$n['mcaNumber']
  ));
 }
// print_r($namesFound);
 $users = Users::find('all',array(
  'conditions'=>array('refer'=>(string)$mcaNumber),
  'order'=>array('mcaName'=>'ASC')
 ));
 
 $downline = array();
 
 
  array_push(
   $downline,
   array(
    'mcaNumber'=>$user['mcaNumber'],
    'mcaName'=>$user['mcaName'],
    'refer'=>$user['refer'],
    'PBV'=>$user['PBV']?:0,
//    'ancestors'=>$user['ancestors'],
    'GBV'=>$user['GBV']?:0,
    'DP'=>$user['DP']?:0,
    $yyyymm=>
     array(
     'PBV'=>$user[$yyyymm]['PBV']?:0,
     'PGBV'=>$user[$yyyymm]['PGBV']?:0,
     'PaidTitle'=>$user[$yyyymm]['PaidTitle']?:0,
     'ValidTitle'=>$user[$yyyymm]['ValidTitle']?:0,
     'Percent'=>$user[$yyyymm]['Percent']?:0,
     'GBV'=>$user[$yyyymm]['GBV']?:0,
     'TGBV'=>$user[$yyyymm]['TGBV']?:0,
     'TCGBV'=>$user[$yyyymm]['TCGBV']?:0,
     'RollUp'=>$user[$yyyymm]['RollUp']?:0,
     'QDLegs'=>$user[$yyyymm]['QDLegs']?:0
     ),
    'ancestors'=>$namesFound
    )
  );
 
 foreach($users as $u){
  array_push(
   $downline,
   array(
    'mcaNumber'=>$u['mcaNumber'],
    'mcaName'=>$u['mcaName'],
    'refer'=>$u['refer'],
    'PBV'=>$u['PBV']?:0,
    'GBV'=>$u['GBV']?:0,
    'DP'=>$u['DP']?:0,
    $yyyymm=>
     array(
     'PBV'=>$u[$yyyymm]['PBV']?:0,
     'PGBV'=>$u[$yyyymm]['PGBV']?:0,
     'PaidTitle'=>$u[$yyyymm]['PaidTitle']?:0,
     'ValidTitle'=>$u[$yyyymm]['ValidTitle']?:0,
     'Percent'=>$u[$yyyymm]['Percent']?:0,
     'GBV'=>$u[$yyyymm]['GBV']?:0,
     'TGBV'=>$u[$yyyymm]['TGBV']?:0,
     'TCGBV'=>$u[$yyyymm]['TCGBV']?:0,
     'RollUp'=>$u[$yyyymm]['RollUp']?:0,
     'QDLegs'=>$u[$yyyymm]['QDLegs']?:0
     )
    )
  );
 }
  return $this->render(array('json' => array("success"=>"Yes",'downline'=>$downline)));		
}
 function changepin(){
  $mcaNumber = $this->request->data['mcaNumber'];
  $signpin = $this->request->data['signpin'];
  
  $data = array(
   'signpin'=>$signpin
  );
  $conditions = array(
   'mcaNumber'=>$mcaNumber
  );
  Savings::update($data,$conditions);
  return $this->render(array('json' => array("success"=>"Yes")));		
 }
function searchmca($mcaNumber){
  $dashboard = new DashboardController();
  $Nodes = $dashboard->getChilds($mcaNumber);
  
  $users = array();
  foreach($Nodes as $n){
   array_push($users,
    array(
     'mcaNumber'=>$n['mcaNumber'],
     'mcaName'=>$n['mcaName']
    )
   );
   
  }
  
  return $this->render(array('json' => array("success"=>"Yes","users"=>$users)));		
}
}
?>