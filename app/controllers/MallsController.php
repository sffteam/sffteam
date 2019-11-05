<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use app\extensions\action\Functions;
use app\extensions\action\GoogleAuthenticator;
use app\controllers\DashboardController;
use app\models\Malls;
use app\models\Modicare_products; // Only for Transfer of products.. Not required
use app\models\Users;
use app\models\Settings;
use app\models\Points;

class MallsController extends \lithium\action\Controller {


 protected function _init() {
  parent::_init();
//  $user = Session::read('default');
  // if($user==null){
   // return $this->redirect('/savings');
  // }
  $this->_render['layout'] = 'savings';
 }
	public function index(){
		$products = Malls::find('all',array(
//			'order'=>array('Code'=>array('ASC'=>1))
		));
		$AllProducts = array();
		
		foreach($products as $p){
			array_push($AllProducts,array(
				'Code'=>$p['Code'],
				'Name'=>$p['Name'],
				'MRP'=>$p['MRP'],
				'DP'=>$p['DP'],
				'BV'=>$p['BV'],
				'PV'=>$p['PV'],
			));
		}
		$CategoriesArray = array(
		  'FS' => 'Food Supplement',
				'PC' => 'Personal Care',
    'HL' => 'Wellness',
				'HC' => 'Home Care',
    'LC' => 'Laundry Care',
				'FP' => 'Food & Beverages',
				'SC' => 'Skin Care',
    'BC' => 'Baby Care',
				'UC' => 'Urban Color',
    'AG' => 'Agriculture',
    'AC' => 'Auto Care',
    'MJ' => 'Jewelery',
				'00' => 'Others',
    '60' => 'Extra',
				);
				
		return $this->render(array('json' => array("success"=>"Yes",'products'=>$AllProducts,'Category'=>$CategoriesArray)));		
		
	}
	
	public function getcategory($Code){
		$products = Malls::find('all',array(
			'conditions'=>array('Code'=> array('like'=>'/^'.$Code.'/'))
		));
		$AllProducts = array();
		
		foreach($products as $p){
			array_push($AllProducts,array(
				'Code'=>$p['Code'],
				'Name'=>$p['Name'],
				'MRP'=>$p['MRP'],
				'DP'=>$p['DP'],
				'BV'=>$p['BV'],
				'PV'=>$p['PV'],
			));
		}
		
		return $this->render(array('json' => array("success"=>"Yes",'products'=>$AllProducts,'Category'=>$Code)));		
	}
	public function upload(){
		ini_set('memory_limit','-1');

		if($this->request->data){
			$file = $this->request->data['file'];	
			
			if($_FILES['file']['tmp_name'] == 0){	
				$name = $_FILES['file']['tmp_name'];
//    $ext = strtolower(end(explode('.', $_FILES['file']['tmp_name'])));
    $type = $_FILES['file']['tmp_name'];
    $tmpName = $_FILES['file']['tmp_name'];
			}
			$row = 0;

			if (($handle = fopen($tmpName, "r")) !== FALSE) {
						while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
							$num = count($data);
							$row++;
							$Code = substr((string)$data[1],0,6);
							$Name = substr((string)$data[1],7);
							$MRP = (float)$data[2];
							$DP = (float)$data[3];
							$BV = (float)$data[4];
							$PV = (float)$data[5];
								$conditions = array(
									'Code' => $Code
								);
								$product = array(
									'Code'=>$Code,
									'Name'=>$Name,
									'MRP'=>$MRP,
									'DP'=>$DP,
									'BV'=>$BV,
									'PV'=>$PV,
								);
								
							$find = Malls::find('first',array(
								'conditions'=>$conditions
							));
							if(count($find)==0){
								Malls::create()->save($product);
							}else{
								Malls::update($product,$conditions);
							}

						}

			}
		fclose($handle);
		
	}

}

 public function getprice(){
  $cart = $this->request->data;
  //print_r($this->request->post);
  $value = 0;
  $totalvalue = 0;
  $wp = 0;
  $walletpoints = 0;
  foreach ($cart as $code => $quantity){
   
   $product = Malls::find('first',array(
    'conditions'=>array('Code'=>(string)$code)
   ));

   $settings = Settings::find('first');
   // print_r("Code: ".$code);
    // print_r("code: ".$product['code']);
    // print_r("Name: ".$product['name']);
    // print_r("DiscountType: ".$product['discountType']);
    // print_r("Discount: ".$product['discount']);
    // print_r("MRP: ".$product['MRP']);
    $walletpoints = round($product['BV']*$quantity*$settings['WalletPoints']/100,0);
    if($product['discountType']=="Rs"){
					$totalPV = floatval(($product['PV']));
					$totalBV = floatval(($product['BV']));
					$totalDP = floatval(($product['DP']));
     $totalvalue = floatval(($product['MRP'] - $product['discount'])*$quantity);
    }else if($product['discountType']=="Percent"){
					$totalPV = floatval(($product['PV'])); 
					$totalBV = floatval(($product['BV']));
					$totalDP = floatval(($product['DP']));
     $totalvalue = floatval(($product['MRP']-$product['MRP']*$product['discount']/100)*$quantity); 
    }else{
     $totalPV = floatval($product['PV']*$quantity); 
     $totalBV = floatval($product['BV']*$quantity); 
					$totalDP = floatval($product['DP']*$quantity); 
					$totalvalue = floatval($product['MRP']*$quantity); 
    }
    $wp = $wp + $walletpoints;
    $value = $value + $totalvalue;
				$valueBV = $valueBV + $totalBV;
				$valuePV = $valuePV + $totalPV;
				$valueDP = $valueDP + $totalDP;
   }
   
  return $this->render(array('json' => array("success"=>"Yes","value"=>$value,"valueBV"=>$valueBV,"valuePV"=>$valuePV,"valueDP"=>$valueDP,"walletpoints"=>$wp)));		
 }


public function cartproducts(){
	 $cart = $this->request->data;
  $CartProducts = array();
		foreach ($cart as $code => $quantity){
			if($code!="X"){
				$product = Malls::find('first',array(
					'conditions'=>array('Code'=>(string)$code)
				));
			}
			if(count($product)>0){
			array_push($CartProducts,array(
				'Code' => $product['Code'],
				'Name' => $product['Name'],
				'MRP' => $product['MRP'],
				'DP' => $product['DP'],
				'BV' => $product['BV'],
				'PV' => $product['PV'],
				'Quantity'=> (integer)$quantity
			));
			}
			
   $settings = Settings::find('first');
   // print_r("Code: ".$code);
    // print_r("code: ".$product['code']);
    // print_r("Name: ".$product['name']);
    // print_r("DiscountType: ".$product['discountType']);
    // print_r("Discount: ".$product['discount']);
    // print_r("MRP: ".$product['MRP']);
    $walletpoints = round($product['BV']*$quantity*$settings['WalletPoints']/100,0);
    if($product['discountType']=="Rs"){
					$totalPV = floatval(($product['PV']));
					$totalBV = floatval(($product['BV']));
					$totalDP = floatval(($product['DP']));
     $totalvalue = floatval(($product['MRP'] - $product['discount'])*$quantity);
    }else if($product['discountType']=="Percent"){
					$totalPV = floatval(($product['PV'])); 
					$totalBV = floatval(($product['BV']));
					$totalDP = floatval(($product['DP']));
     $totalvalue = floatval(($product['MRP']-$product['MRP']*$product['discount']/100)*$quantity); 
    }else{
     $totalPV = floatval($product['PV']*$quantity); 
     $totalBV = floatval($product['BV']*$quantity); 
					$totalDP = floatval($product['DP']*$quantity); 
					$totalvalue = floatval($product['MRP']*$quantity); 
    }
    $wp = $wp + $walletpoints;
    $value = $value + $totalvalue;
				$valueBV = $valueBV + $totalBV;
				$valuePV = $valuePV + $totalPV;
				$valueDP = $valueDP + $totalDP;
		}
	 return $this->render(array('json' => array("success"=>"Yes","value"=>$value,"valueBV"=>$valueBV,"valuePV"=>$valuePV,"valueDP"=>$valueDP,"CartProducts"=>$CartProducts)));		
 
}

public function points(){
	$points = Points::find('all');
	$AllPoints = array();
	foreach ($points as $p){
	array_push($AllPoints,array(
				'_id'=>$p['_id'],
				'Name'=>$p['name'],
				'Address'=>$p['address'],
				'Street'=>$p['street'],
				'City'=>$p['city'],
				'PIN'=>$p['pin'],
				'State'=>$p['state'],
				'Person'=>$p['person'],
				'Mobile'=>$p['mobile'],
				'Email'=>$p['email'],
			));	
	}
	return $this->render(array('json' => array("success"=>"Yes","points"=>$AllPoints)));		
}

 public function register(){
  $firstName = $this->request->data['firstName'];
  $lastName = $this->request->data['lastName'];
  $email = $this->request->data['email'];
  $mobile = $this->request->data['mobile'];
  $address = $this->request->data['address'];
  $street = $this->request->data['street'];
  $city = $this->request->data['city'];
  $pin = $this->request->data['pin'];
  $state = $this->request->data['state'];
  $mcaNumber = $this->request->data['mcaNumber'];
  $agree = $this->request->data['agree'];

  $user = M_users::find('first',array(
   'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));


  $save = "No";
  if(count($user)==0){
   M_users::create()->save($this->request->data);
   $function = new Functions();
   $function->addnotify($this->request->data['mcaNumber'],"Waiting for Approval","You application to join SFF is waiting for approval. The approval process may take 1 to 2 days depending on your KYC documents.");
   $save = "Yes";
  }
		return $this->render(array('json' => array("success"=>$save)));		
 }


public function product($Code){
		$product = Malls::find('first',array(
			'conditions'=>array('Code'=> $Code)
		));
	return $this->render(array('json' => array("success"=>"Yes","product"=>$product)));		
}

public function transfer(){
$products = Modicare_products::find('all');
$product = array();

foreach($products as $p){
	array_push($product,$p['Code']);
	$conditions = array('Code'=>$p['Code']);
	$data = array(
		'Description'=> $p['Description'],
		'g_Description'=>"",
		'h_Description'=>"",
	);
	Malls::update($data,$conditions);
}	
 
		return $this->render(array('json' => array("success"=>"Yes","product"=>$product)));		
}

public function show($Code){
	
	if($this->request->data){
		$conditions = array('Code'=>$this->request->data['Code']);
		$data = array(
		'Description'=> $this->request->data['Description'],
		'g_Description'=>$this->request->data['g_Description'],
		'h_Description'=>$this->request->data['h_Description'],
		'Video'=>$this->request->data['Video'],
		);
		Malls::update($data,$conditions);
	}
	$products = Malls::find('all', array(
		'conditions' =>array(
//			'g_Description'=>"",
		//		'Code'=>$Codesearchmca
			),
		'order'=>array('Code'=>'ASC')
	));
	$product = Malls::find('first', array(
		'conditions'=>array('Code'=>$Code)
	));
	return compact('products','product');
}

public function searchmca(){
	if($this->request->data){
		$user = Users::find('first',array(
			'conditions'=>array('mcaNumber'=>$this->request->data['mcaNumber'])
		));
		if(count($user)==1){
			return $this->render(array('json' => array("success"=>"Yes","user"=>$user)));				
		}else{
			return $this->render(array('json' => array("success"=>"No")));				
		}
	}
	
}

public function sendotp(){
	if($this->request->data){
		
		$mcaNumber = $this->request->data['mcaNumber'];
		$date = date_create($this->request->data['dateofjoin']);
		
	 $user = Users::find('first',array(
   'conditions'=>array(
				'mcaNumber'=>(string)$mcaNumber,
				'DateJoin'=>date_format($date,"d M Y"),
				)
		));
		if(count($user)==1){
			$mobile = "+91".$this->request->data['mobile'];
			$ga = new GoogleAuthenticator();
			$otp = $ga->getCode($ga->createSecret(64));	
			$data = array(
				'otp' => $otp,
				'mobile'=>$mobile,
			);
			$conditions = array("mcaNumber"=>(string)$mcaNumber);

			Users::update($data,$conditions);
			$function = new Functions();
			$msg = "SFF-Mall OTP is ". $otp . ",  to register.";
			$returncall = $function->twilio($mobile,$msg,$otp);	 // Testing if it works 
			$returnsms = $function->sendSms($mobile,$msg);	 // Testing if it works 
			$user = Users::find('first',array(
   'conditions'=>array(
				'mcaNumber'=>(string)$mcaNumber,
				)
			));
			
			return $this->render(array('json' => array("success"=>"Yes","otp"=>$otp,'user'=>$user)));		
		}else{
			return $this->render(array('json' => array("success"=>"No")));		
		}
		
	}
	return $this->render(array('json' => array("success"=>"No")));		
}

public function searchdown(){
	$dashboard = new DashboardController();	
	if($this->request->data){
		$users = Users::find('all',array(
			'conditions'=>array('refer'=>$this->request->data['mcaNumber'])
			));
		if(count($users)>0){
			$allusers = array();
			foreach($users as $u){
				$count = Users::count(array(
					'conditions'=>array('refer'=>$u['mcaNumber'])
				));
				$yyyymm = date('Y-m');
				$pyyyymm = date('Y-m', strtotime('last month'));
				
				array_push($allusers,array(
				'mcaNumber'=>$u['mcaNumber'],
				'mcaName'=>$u['mcaName'],
				'refer'=>$u['refer'],
					$yyyymm=>array(
					'PV'=>$u[$yyyymm]['PV'],
					'BV'=>$u[$yyyymm]['BV'],
					'GBV'=>$u[$yyyymm]['GBV'],
					'GrossPV'=>$u[$yyyymm]['GrossPV'],
					'PGPV'=>$u[$yyyymm]['PGPV'],
					'PGBV'=>$u[$yyyymm]['PGBV'],
					'RollUpBV'=>$u[$yyyymm]['RollUpBV'],
					'RollUpPV'=>$u[$yyyymm]['RollUpPV'],
					'Legs'=>$u[$yyyymm]['Legs'],
					'QDLegs'=>$u[$yyyymm]['QDLegs'],
					'ValidTitle'=>$u[$yyyymm]['ValidTitle'],
				),
				$pyyyymm => array(
					'PV'=>$u[$pyyyymm]['PV'],
					'BV'=>$u[$pyyyymm]['BV'],
					'GBV'=>$u[$pyyyymm]['GBV'],
					'GrossPV'=>$u[$pyyyymm]['GrossPV'],
					'PGPV'=>$u[$pyyyymm]['PGPV'],
					'PGBV'=>$u[$pyyyymm]['PGBV'],
					'RollUpBV'=>$u[$pyyyymm]['RollUpBV'],
					'RollUpPV'=>$u[$pyyyymm]['RollUpPV'],
					'Legs'=>$u[$pyyyymm]['Legs'],
					'QDLegs'=>$u[$pyyyymm]['QDLegs'],
					'ValidTitle'=>$u[$pyyyymm]['ValidTitle'],
					),
				'count'=>$count
				));
			}
			return $this->render(array('json' => array("success"=>"Yes","otp"=>$otp,'users'=>$allusers,'allusers'=>$allusers)));		
		}else{
			return $this->render(array('json' => array("success"=>"No")));		
		}
	}
	return $this->render(array('json' => array("success"=>"No")));		
}




public function uploadbuilders(){
set_time_limit(0);
		if($this->request->data){
			$file = $this->request->data['file'];	
			
			if($_FILES['file']['tmp_name'] == 0){	
				$name = $_FILES['file']['tmp_name'];
    $ext = strtolower(end(explode('.', $_FILES['file']['tmp_name'])));
    $type = $_FILES['file']['tmp_name'];
    $tmpName = $_FILES['file']['tmp_name'];
			}
			$row = 1;

			if (($handle = fopen($tmpName, "r")) !== FALSE) {
						while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
							$num = count($data);
							$row++;
								$data = array(
									'mcaNumber' => (string)$data[1],
									'mcaName' => ucwords(strtolower((string)$data[2])),
									'DateJoin' => (string)$data[4],
									'refer' => (integer)$data[5],
         'ValidTitle'=>(string)$data[6],
         'PaidTitle'=>(string)$data[7],
         'Percent'=>(integer)$data[8],
         'PrevCummPV'=>(integer)$data[9],
         'PV'=>(integer)$data[10],
         'BV'=>(integer)$data[11],
         'GPV'=>(integer)$data[12],
         'GBV'=>(integer)$data[13],
         'GrossPV'=>(integer)$data[14],
         'PGPV'=>(integer)$data[15],
         'PGBV'=>(integer)$data[16],
         'RollUpBV'=>(integer)$data[17],
         'Level'=>(integer)$data[18],
									'Legs'=>(integer)$data[19],
         'QDLegs'=>(integer)$data[20],
         'APB'=>(integer)$data[21],
         'DB'=>(integer)$data[22],
         'LPB'=>(integer)$data[23],
         'TF'=>(integer)$data[24],
         'CF'=>(integer)$data[25],
									'HF'=>(integer)$data[26],
									'Gross'=>(integer)$data[27],
         
         
								);
								
//								print_r($data);exit;
								$user = Users::find("first",array(
								"conditions"=>array('mcaNumber'=>$data['mcaNumber'])
								));
								if(count($user)!=1){
									if($data['mcaNumber']!=""){
										if((int)$data['mcaNumber']>0){
           $yyyymm = $this->request->data['yyyymm'];
											$this->addUserBuilders($data,$yyyymm);
											//print_r($data);
										}
									}
								}else{
           $yyyymm = $this->request->data['yyyymm'];
											$this->updateUserBuilders($data,$yyyymm);
        }
						}
						fclose($handle);
			}
	}
}

	public function updateUserBuilders($data,$yyyymm){
			$data = array(
				'mcaName'=>(string)$data["mcaName"],
				'mcaNumber'=>(string)$data["mcaNumber"],
				'refer'=>(string)$data["refer"],
				'DateJoin'=>(string)$data["DateJoin"],
     $yyyymm.'.ValidTitle'=>(string)$data['ValidTitle'],
     $yyyymm.'.PaidTitle'=>(string)$data['PaidTitle'],
     $yyyymm.'.Percent'=>(integer)$data['Percent'],
					$yyyymm.'.PrevCummPV'=>(integer)$data['PrevCummPV'],
     $yyyymm.'.PV'=>(integer)$data['PV'],
     $yyyymm.'.BV'=>(integer)$data['BV'],
     $yyyymm.'.GPV'=>(integer)$data['GPV'],
     $yyyymm.'.GBV'=>(integer)$data['GBV'],
					$yyyymm.'.GrossPV'=>(integer)$data['GrossPV'],
					$yyyymm.'.PGPV'=>(integer)$data['PGPV'],
					$yyyymm.'.PGBV'=>(integer)$data['PGBV'],
     $yyyymm.'.RollUpBV'=>(integer)$data['RollUpBV'],
     $yyyymm.'.Level'=>(integer)$data['Level'],
     $yyyymm.'.Legs'=>(integer)$data['Legs'],
     $yyyymm.'.QDLegs'=>(integer)$data['QDLegs'],
     $yyyymm.'.APB'=>(integer)$data['APB'],
     $yyyymm.'.DB'=>(integer)$data['DB'],
     $yyyymm.'.LPB'=>(integer)$data['LPB'],
     $yyyymm.'.TF'=>(integer)$data['TF'],
     $yyyymm.'.CF'=>(integer)$data['CF'],
     $yyyymm.'.HF'=>(integer)$data['HF'],
     $yyyymm.'.Gross'=>(integer)$data['Gross'],

			);
   $conditions = array('mcaNumber'=>(string)$data["mcaNumber"]);
			Users::update($data,$conditions);
  
 }

	public function adduserBuilders($data,$yyyymm){
		
			if($data){
			if($data['mcaNumber']!="" && $data["mcaName"]!=""){
//				print_r($data['refer']);
				$refer = Users::first(array(
						'fields'=>array('left','mcaNumber','ancestors','mcaName'),
							'conditions'=>array('mcaNumber'=>(string)$data['refer'])
						));
				$refer_ancestors = $refer['ancestors'];
				
				$ancestors = array();
    if(count($refer_ancestors)>0){
     foreach ($refer_ancestors as $ra){
      array_push($ancestors, $ra);
     }
    }
				$refer_mcanumber = (string) $refer['mcaNumber'];

				array_push($ancestors,$refer_mcanumber);

				$refer_id = $refer_mcanumber;
				$refer_left = (integer)$refer['left'];
				$refer_left_inc = (integer)$refer['left'];
				$refername = Users::find('first',array(
						'fields'=>array('mcaName','mcaNumber'),
						'conditions'=>array('mcaNumber'=>(string)$data['refer'])
				));
				
				$refer_name = $refername['mcaName'];
				$refer_id = $refername['mcaNumber']; 

				
			}else{
				$refer_left = 0;
				$refer_name = "";
				$refer_id = "";
				$ancestors = array();
			}
				Users::update(
					array(
						'$inc' => array('right' => (integer)2)
					),
					array('right' => array('>'=>(integer)$refer_left_inc)),
					array('multi' => true)
				);
				Users::update(
					array(
						'$inc' => array('left' => (integer)2)
					),
					array('left' => array('>'=>(integer)$refer_left_inc)),
					array('multi' => true)
				);
			
			$data = array(
				'mcaName'=>(string)$data["mcaName"],
				'mcaNumber'=>(string)$data["mcaNumber"],
				'refer'=>(string)$data["refer"],
				'refer_name'=>$refer_name,
				'refer_id'=>(string)$refer_id,
				'ancestors'=> $ancestors,
				'DateJoin'=>(string)$data["DateJoin"],
				'left'=>(integer)($refer_left+1),
				'right'=>(integer)($refer_left+2),
     $yyyymm.'.ValidTitle'=>(string)$data['ValidTitle'],
     $yyyymm.'.PaidTitle'=>(string)$data['PaidTitle'],
     $yyyymm.'.Percent'=>(integer)$data['Percent'],
					$yyyymm.'.PrevCummPV'=>(integer)$data['PrevCummPV'],
     $yyyymm.'.PV'=>(integer)$data['PV'],
     $yyyymm.'.BV'=>(integer)$data['BV'],
     $yyyymm.'.GPV'=>(integer)$data['GPV'],
     $yyyymm.'.GBV'=>(integer)$data['GBV'],
					$yyyymm.'.GrossPV'=>(integer)$data['GrossPV'],
					$yyyymm.'.PGPV'=>(integer)$data['PGPV'],
					$yyyymm.'.PGBV'=>(integer)$data['PGBV'],
					$yyyymm.'.RollUpBV'=>(integer)$data['RollUpBV'],
     $yyyymm.'.Level'=>(integer)$data['Level'],
     $yyyymm.'.Legs'=>(integer)$data['Legs'],
     $yyyymm.'.QDLegs'=>(integer)$data['QDLegs'],
     $yyyymm.'.APB'=>(integer)$data['APB'],
     $yyyymm.'.DB'=>(integer)$data['DB'],
     $yyyymm.'.LPB'=>(integer)$data['LPB'],
     $yyyymm.'.TF'=>(integer)$data['TF'],
     $yyyymm.'.CF'=>(integer)$data['CF'],
     $yyyymm.'.HF'=>(integer)$data['HF'],
     $yyyymm.'.Gross'=>(integer)$data['Gross'],

			);

			Users::create()->save($data);
			
		}

	}


// {
  // "DateJoin": "2015-12-13",
  // "ancestors": [""],
  // "left": 1,
  // "mcaName": "Ruchi Nilam Doctor",
  // "mcaNumber": "92143138",
  // "otp": "403362",
  // "refer": "92000000",
  // "refer_id": "",
  // "right": 2
// }

public function addUser(){
	if($this->request->data){	
		$data = array(
			'mcaNumber' => (string)$this->request->data['mcaNumber'],
			'mcaName' => ucwords(strtolower((string)$this->request->data['mcaName'])),
			'DateJoin' => (string)$this->request->data['DateJoin'],
			'refer' => (integer)$this->request->data['refer'],
			'refer_id'=>(integer)$this->request->data['refer'],
			'refer_name'=>ucwords(strtolower((string)$this->request->data['referName'])),
		);
		
		$yyyymm = date("Y-m" ,strtotime('first day of last month'));
		$this->addUserBuilders($data,$yyyymm);
	}
	$user = Users::find('first',array(
		'conditions'=>array('mcaNumber'=>(string)$this->request->data['mcaNumber'])
	));
	return $this->render(array('json' => array("success"=>"Yes",'user'=>$user)));		
	
}

public function getusers(){
		$dashboard = new DashboardController();
  $Nodes = $dashboard->getChilds($this->request->data['mcaNumber']);
  
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

public function uploadEnrolment(){
set_time_limit(0);
		if($this->request->data){
			$file = $this->request->data['file'];	
			
			if($_FILES['file']['tmp_name'] == 0){	
				$name = $_FILES['file']['tmp_name'];
    $ext = strtolower(end(explode('.', $_FILES['file']['tmp_name'])));
    $type = $_FILES['file']['tmp_name'];
    $tmpName = $_FILES['file']['tmp_name'];
			}
			$row = 1;

			if (($handle = fopen($tmpName, "r")) !== FALSE) {
						while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
							$num = count($data);
							$row++;
								$data = array(
									'mcaNumber' => (string)$data[1],
									'mcaName' => ucwords(strtolower((string)$data[2])),
									'DateJoin' => (string)$data[4],
									'refer' => (integer)$data[6],
         'ValidTitle'=>(string)$data[7],
         'PaidTitle'=>(string)$data[8],
									'KYC'=>(string)$data[9],
									'InActive'=>(integer)$data[10],
									'PrevCummPV'=>(integer)$data[11],
         'PV'=>(integer)$data[12],
         'BV'=>(integer)$data[13],
         'GPV'=>(integer)$data[14],
         'GBV'=>(integer)$data[15],
         'GrossPV'=>(integer)$data[16],
         'PGPV'=>(integer)$data[17],
         'PGBV'=>(integer)$data[18],
									'RollUpPV'=>(integer)$data[19],
         'RollUpBV'=>(integer)$data[20],
         'Level'=>(integer)$data[21],
									'Legs'=>(integer)$data[22],
         'QDLegs'=>(integer)$data[23],
         'APB'=>(integer)$data[24],
         'DB'=>(integer)$data[26],
         'LPB'=>(integer)$data[28],
         'TF'=>(integer)$data[29],
         'CF'=>(integer)$data[30],
									'HF'=>(integer)$data[31],
									'Gross'=>(integer)$data[32],
									'NEFT'=>(string)$data[33],
									'Aadhar'=>(string)$data[34],
									'State'=>(string)$data[36],
									'Zone'=>(string)$data[37],
									'City'=>(string)$data[38],
								);
								
		//						print_r($data);
								$user = Users::find("first",array(
								"conditions"=>array('mcaNumber'=>$data['mcaNumber'])
								));
								if(count($user)!=1){
									if($data['mcaNumber']!=""){
										if((int)$data['mcaNumber']>0){
           $yyyymm = $this->request->data['yyyymm'];
											$this->addUserEnrolment($data,$yyyymm);
											//print_r($data);
										}
									}
								}else{
           $yyyymm = $this->request->data['yyyymm'];
											$this->updateUserEnrolment($data,$yyyymm);
        }
						}
						fclose($handle);
			}
	}
}

	public function adduserEnrolment($data,$yyyymm){
		
			if($data){
			if($data['mcaNumber']!="" && $data["mcaName"]!=""){
//				print_r($data['refer']);
				$refer = Users::first(array(
						'fields'=>array('left','mcaNumber','ancestors','mcaName'),
							'conditions'=>array('mcaNumber'=>(string)$data['refer'])
						));
				$refer_ancestors = $refer['ancestors'];
				
				$ancestors = array();
    if(count($refer_ancestors)>0){
     foreach ($refer_ancestors as $ra){
      array_push($ancestors, $ra);
     }
    }
				$refer_mcanumber = (string) $refer['mcaNumber'];

				array_push($ancestors,$refer_mcanumber);

				$refer_id = $refer_mcanumber;
				$refer_left = (integer)$refer['left'];
				$refer_left_inc = (integer)$refer['left'];
				$refername = Users::find('first',array(
						'fields'=>array('mcaName','mcaNumber'),
						'conditions'=>array('mcaNumber'=>(string)$data['refer'])
				));
				
				$refer_name = $refername['mcaName'];
				$refer_id = $refername['mcaNumber']; 

				
			}else{
				$refer_left = 0;
				$refer_name = "";
				$refer_id = "";
				$ancestors = array();
			}
				Users::update(
					array(
						'$inc' => array('right' => (integer)2)
					),
					array('right' => array('>'=>(integer)$refer_left_inc)),
					array('multi' => true)
				);
				Users::update(
					array(
						'$inc' => array('left' => (integer)2)
					),
					array('left' => array('>'=>(integer)$refer_left_inc)),
					array('multi' => true)
				);
			
			$data = array(
				'mcaName'=>(string)$data["mcaName"],
				'mcaNumber'=>(string)$data["mcaNumber"],
				'refer'=>(string)$data["refer"],
				'refer_name'=>$refer_name,
				'refer_id'=>(string)$refer_id,
				'ancestors'=> $ancestors,
				'DateJoin'=>(string)$data["DateJoin"],
				'left'=>(integer)($refer_left+1),
				'right'=>(integer)($refer_left+2),
     $yyyymm.'.ValidTitle'=>(string)$data['ValidTitle'],
     $yyyymm.'.PaidTitle'=>(string)$data['PaidTitle'],
					$yyyymm.'.KYC'=>(string)$data['KYC'],
					$yyyymm.'.InActive'=>(integer)$data['InActive'],
     $yyyymm.'.Percent'=>(integer)$data['Percent'],
					$yyyymm.'.PrevCummPV'=>(integer)$data['PrevCummPV'],
     $yyyymm.'.PV'=>(integer)$data['PV'],
     $yyyymm.'.BV'=>(integer)$data['BV'],
     $yyyymm.'.GPV'=>(integer)$data['GPV'],
     $yyyymm.'.GBV'=>(integer)$data['GBV'],
					$yyyymm.'.GrossPV'=>(integer)$data['GrossPV'],
					$yyyymm.'.PGPV'=>(integer)$data['PGPV'],
					$yyyymm.'.PGBV'=>(integer)$data['PGBV'],
					$yyyymm.'.RollUpPV'=>(integer)$data['RollUpPV'],
					$yyyymm.'.RollUpBV'=>(integer)$data['RollUpBV'],
     $yyyymm.'.Level'=>(integer)$data['Level'],
     $yyyymm.'.Legs'=>(integer)$data['Legs'],
     $yyyymm.'.QDLegs'=>(integer)$data['QDLegs'],
     $yyyymm.'.APB'=>(integer)$data['APB'],
     $yyyymm.'.DB'=>(integer)$data['DB'],
     $yyyymm.'.LPB'=>(integer)$data['LPB'],
     $yyyymm.'.TF'=>(integer)$data['TF'],
     $yyyymm.'.CF'=>(integer)$data['CF'],
     $yyyymm.'.HF'=>(integer)$data['HF'],
     $yyyymm.'.Gross'=>(integer)$data['Gross'],
					'NEFT'=>$data['NEFT'],
					'Aadhar'=>$data['Aadhar'],
					'State'=>$data['State'],
					'Zone'=>$data['Zone'],
					'City'=>$data['City'],

			);
//print_r($data);
			Users::create()->save($data);
			
		}

	}


	public function updateUserEnrolment($data,$yyyymm){
			$data = array(
				'mcaName'=>(string)$data["mcaName"],
				'mcaNumber'=>(string)$data["mcaNumber"],
     $yyyymm.'.ValidTitle'=>(string)$data['ValidTitle'],
     $yyyymm.'.PaidTitle'=>(string)$data['PaidTitle'],
					$yyyymm.'.KYC'=>(string)$data['KYC'],
					$yyyymm.'.InActive'=>(integer)$data['InActive'],
     $yyyymm.'.Percent'=>(integer)$data['Percent'],
					$yyyymm.'.PrevCummPV'=>(integer)$data['PrevCummPV'],
     $yyyymm.'.PV'=>(integer)$data['PV'],
     $yyyymm.'.BV'=>(integer)$data['BV'],
     $yyyymm.'.GPV'=>(integer)$data['GPV'],
     $yyyymm.'.GBV'=>(integer)$data['GBV'],
					$yyyymm.'.GrossPV'=>(integer)$data['GrossPV'],
					$yyyymm.'.PGPV'=>(integer)$data['PGPV'],
					$yyyymm.'.PGBV'=>(integer)$data['PGBV'],
					$yyyymm.'.RollUpPV'=>(integer)$data['RollUpPV'],
					$yyyymm.'.RollUpBV'=>(integer)$data['RollUpBV'],
     $yyyymm.'.Level'=>(integer)$data['Level'],
     $yyyymm.'.Legs'=>(integer)$data['Legs'],
     $yyyymm.'.QDLegs'=>(integer)$data['QDLegs'],
     $yyyymm.'.APB'=>(integer)$data['APB'],
     $yyyymm.'.DB'=>(integer)$data['DB'],
     $yyyymm.'.LPB'=>(integer)$data['LPB'],
     $yyyymm.'.TF'=>(integer)$data['TF'],
     $yyyymm.'.CF'=>(integer)$data['CF'],
     $yyyymm.'.HF'=>(integer)$data['HF'],
     $yyyymm.'.Gross'=>(integer)$data['Gross'],
					'NEFT'=>$data['NEFT'],
					'Aadhar'=>$data['Aadhar'],
					'State'=>$data['State'],
					'Zone'=>$data['Zone'],
					'City'=>$data['City'],
			);
   $conditions = array('mcaNumber'=>(string)$data["mcaNumber"]);
			Users::update($data,$conditions);
  
 }

//end of class
}


