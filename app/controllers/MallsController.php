<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use \lithium\data\Model;
use app\extensions\action\Functions;
use app\extensions\action\GoogleAuthenticator;
use app\controllers\DashboardController;
use lithium\data\Connections;
use app\models\Malls;
use app\models\Contacts;
use app\models\Distributors;
use app\models\Notifications;
use app\models\Tools;
use app\models\Audios;
use app\models\Baselines;
use app\models\Invitees;
use app\models\Swipers;
use app\models\Rewards;
use app\models\Templates;
use app\models\Pdfs;
use app\models\Invoices;
use app\models\Outlines;
use app\models\Logs;
use app\models\Lists;
use app\models\Modicare_products; // Only for Transfer of products.. Not required
use app\models\Users;
use app\models\Orders;
use app\models\Events;
use app\models\Versions;
use app\models\Mobiles;
use app\models\Settings;
use app\models\Seminars;
use app\models\Prospects;
use app\models\Messages;
use app\models\Points;
use app\models\Urls;
use app\models\Posts;
use app\models\Zooms;
use app\models\Objections;

use app\models\X_pages;
use app\models\X_page_hits;
use app\models\X_leads;
use app\models\X_stages;

use \MongoRegex;

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
   'order'=>array('DP'=>'ASC','Name'=>'ASC')
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
    'Weight'=>$p['Weight'],
    'Available'=>$p['Available'],
    'Percent'=>$p['Percent'],
    'Saving'=>$p['Saving'],
    'SavingPercent'=>$p['SavingPercent'],
    'InDemand'=>$p['InDemand'],
    'BuyInLoyalty'=>$p['BuyInLoyalty'],
    'TUYName'=>$p['TUYName'],
    'Video'=>$p['Video'],
   ));
  }
  $CategoriesArray = array(
    'HC' => 'Home Care',
    'LC' => 'Laundry Care',
    'PC' => 'Personal Care',
    'FP' => 'Food & Beverages',
    'SC' => 'Skin Care',
    'FS' => 'Food Supplement',
    'MJ' => 'Jewelery',
    'UC' => 'Cosmetics - Urban Color',
    'BC' => 'Baby Care',
    'AG' => 'Agriculture',
    'AC' => 'Auto Care',
    'HL' => 'Wellness',
    'WA' => 'Watches',    
    'MG' => 'Technology',
    '00' => 'Others',
    '60' => 'Extra',
    );
  $CategoriesSwiperArray = array(
    'HC' => array('Name'=>'HOME','color'=>'#e53935'),
    'LC' => array('Name'=>'LAUNDRY','color'=>'#303f9f'),
    'PC' => array('Name'=>'PERSONAL','color'=>'#8e24aa'),
    'FP' => array('Name'=>'FOOD','color'=>'#00796b'),
    'SC' => array('Name'=>'SKINCARE','color'=>'#0288d1'),
    'MJ' => array('Name'=>'JEWELERY','color'=>'#455a64'),
    'UC' => array('Name'=>'COSMETICS','color'=>'#388e3c'),
    'BC' => array('Name'=>'BABYCARE','color'=>'#afb42b'),
    'AG' => array('Name'=>'AGRICULTURE','color'=>'#fbc02d'),
    'AC' => array('Name'=>'AUTOCARE','color'=>'#e64a19'),
    'HL' => array('Name'=>'WELLNESS','color'=>'#6d4c41'),
    'WA' => array('Name'=>'WATCHES','color'=>'#0097a7'),
    'MG' => array('Name'=>'TECHNOLOGY','color'=>'#01579b'),
    );

  return $this->render(array('json' => array("success"=>"Yes",'products'=>$AllProducts,'Category'=>$CategoriesArray,'CategorySwiper'=>$CategoriesSwiperArray)));  
  
 }
 
 public function getcategory($Code){
  $products = Malls::find('all',array(
   'conditions'=>array('Code'=> array('like'=>'/^'.$Code.'/')),
   'order'=>array('DP'=>'ASC')
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
  $value = 0;
  $totalvalue = 0;
  $wp = 0;
  $walletpoints = 0;
  foreach ($cart as $code => $quantity){
   
   $product = Malls::find('first',array(
    'conditions'=>array('Code'=>(string)$code)
   ));

   $settings = Settings::find('first');
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
     $totalWeight = floatval($product['Weight']*$quantity); 
    }
    $wp = $wp + $walletpoints;
    $value = $value + $totalvalue;
    $valueBV = $valueBV + $totalBV;
    $valuePV = $valuePV + $totalPV;
    $valueDP = $valueDP + $totalDP;
    $valueWeight = $valueWeight + $totalWeight;
   }
   
  return $this->render(array('json' => array("success"=>"Yes","value"=>$value,"valueBV"=>$valueBV,"valuePV"=>$valuePV,"valueDP"=>$valueDP,"walletpoints"=>$wp,"weight"=>$valueWeight)));  
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

public function getcartproducts(){
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
    'Quantity'=> (integer)$quantity,
    'Percent'=>$product['Percent'],
    'Saving'=>$product['Saving'],
    'SavingPercent'=>$product['SavingPercent'],
    'InDemand'=>$product['InDemand'],
    'BuyInLoyalty'=>$product['BuyInLoyalty'],
    'TUYName'=>$product['TUYName'],
    'Video'=>$product['Video'],
    ));
   }
    $totalPV = floatval($product['PV']*$quantity); 
    $totalBV = floatval($product['BV']*$quantity); 
    $totalDP = floatval($product['DP']*$quantity); 
    $totalvalue = floatval($product['MRP']*$quantity); 
   
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

 public function payment(){
  $this->_render['layout'] = null;
 $cart = split(",",$this->request->data['cart']);
  
  $ProductData = array();
  
  $dateTime = new \MongoDate;
  $dateTime = date('Y-m',$dateTime->sec);
  //array_push($data,$dateTime);
  $totalValue= 0;
  foreach ($cart as $key => $val){
   $item = split(":",$val);
   if($item[1]!=0){
    $product = Malls::find('first',array(
     'conditions'=>array('Code'=>(string)$item[0]))
    );
    
   if(count($product)>0){
    $value = 0;
    $DP = (float)$product['DP'];
    $value = (float)$DP*$item[1];
    $totalValue = $totalValue + $value;
    $cartArray = array(
     'Code'=>$product['Code'],
     'Name'=>$product['Name'],
     'MRP'=>(integer)$product['MRP'],
     'BV'=>(integer)$product['BV'],
     'DP'=>(integer)$product['DP'],
     'PV'=>(integer)$product['PV'],
     'Quantity'=>(integer)$item[1],
     'Value'=>(float)$value,
     
    );
     array_push($ProductData,$cartArray);
    }
   }
  }
  $data = array(
   'Name'=>(string)$this->request->data['Name'],
   'Email'=>$this->request->data['Email'],
   'Mobile'=>$this->request->data['Mobile'],
   'Address'=>$this->request->data['Address'],
   'Street'=>$this->request->data['Street'],
   'City'=>$this->request->data['City'],
   'Pin'=>$this->request->data['Pin'],
   'State'=>$this->request->data['State'],
   'mcaNumber'=>$this->request->data['mcaNumber'],
   'Mode'=>$this->request->data['Mode'],
   'PaymentMode'=>$this->request->data['PaymentMode'],
   'shopping'=>(integer)$totalValue,
   'TotalValue'=>(integer)$totalValue,
   'Products'=>$ProductData,
   'dateTime'=> new \MongoDate,
  );

  $order = Orders::create();
  $id = $order->save($data);

  if($this->request->data['PaymentMode']=="UPI"){
   return $this->render(array('json' => array("success"=>"Yes","data"=>$data)));  
  }
  
$key = PAYUMONEY_KEY;
$txnid = "TXN-" . rand(10000,99999999);
$amount = $data['shopping'];
$productinfo = $data['mcaNumber'].'#'.$data['shopping'];
$firstname = urldecode($data['Name']);
$email = $data['Email'];
$mobile = $data['Mobile'];
$udf1 = (string)$order;
$udf5 = "BOLT_KIT_PHP7";
$salt = PAYUMONEY_SALT;

//$PAYU_BASE_URL = "https://sandboxsecure.payu.in";  // For Sandbox Mode
$PAYU_BASE_URL = "https://secure.payu.in";   // For Production Mode
$action = $PAYU_BASE_URL . '/_payment';

 $hash=strtolower(hash('sha512', $key.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|'.$udf1.'||||'.$udf5.'||||||'.$salt));
 return compact('data','paymentCount','success','amount','action','key','hash','txnid','udf1','udf5','productinfo','firstname','email','mobile'); 
//  return $this->render(array('json' => array("success"=>"Yes","data"=>$data)));  
 }

 public function getprevorder(){
  if($this->request->data){
   $mcaNumber = $this->request->data['mcaNumber'];
   $user = Orders::find('first',array(
    'conditions'=>array('mcaNumber'=>$mcaNumber)
   ));
   if($user==null){
    return $this->render(array('json' => array("success"=>"No")));  
   }
  }
  return $this->render(array('json' => array("success"=>"Yes","user"=>$user)));  
 }


public function getpreviousorders(){
  if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  
  $cart = split(",",$this->request->data['cart']);
  $conditions = array('mcaNumber'=>$mcaNumber);
  foreach ($cart as $key => $val){
   $item = split(":",$val);
   if($item[1]!=0){
   $conditions = array_merge($conditions, array('Products.Code'=> (string)$item[0]));
   $conditions = array_merge($conditions, array('Products.Quantity'=> (integer)$item[1]));
   }
  }
  
  $user = Orders::find('first',array(
   'conditions'=> $conditions
  ));
  if(count($user)==1){
   $cart = "Yes";
  }else{
   $cart = "No";
  }

  $previousOrders = Orders::find('all',array(
   'conditions'=> array('mcaNumber'=>$mcaNumber)
  ));
  
  }
  return $this->render(array('json' => array("success"=>"Yes","previousOrders"=>$previousOrders,"Cart"=>$cart)));  
 
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

  $user = Orders::find('first',array(
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


public function product($Code,$format=null){
  $product = Malls::find('first',array(
   'conditions'=>array('Code'=> $Code)
  ));
  if($format=="jpg"){
   return compact('product');
  }
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
   'conditions'=>array(
    'mcaNumber'=>$this->request->data['mcaNumber'],
//    'percent'=>array('$ne'=>null)
    )
  ));
  $findmobile = Mobiles::find('first',array(
   'conditions'=>array('mcaNumber'=>$this->request->data['mcaNumber'])
  ));
  if(count($findmobile)==0){
   $mobile = array('Mobile'=>"");
  }else{
   $mobile = array('Mobile'=>$findmobile['Mobile']);
  }
 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
 $p0yyyymm = date("Y-m", strtotime("0 month", strtotime(date("F") . "1")) );
  $tree=array();
  foreach($user['ancestors'] as $key=>$val){
    $upline = Users::find('first',array(
     'conditions'=>array('mcaNumber'=>$val,
     $p1yyyymm.'.Percent'=>array('$ne'=>null)
     )
    ));
    if($upline['mcaNumber']!=null){
     $findUserMobile = Mobiles::find('first',array(
      'conditions'=>array('mcaNumber'=>$upline['mcaNumber'])
     ));
   if(count($findUserMobile)==0){
    $UserMobile = array('Mobile'=>"");
   }else{
    $UserMobile = array('Mobile'=>$findUserMobile['Mobile']);
   }  
     array_push($tree,array(
      'mcaName'=>$upline['mcaName'],
      'mcaNumber'=>$upline['mcaNumber'],
      'Percent'=>$upline[$p1yyyymm]['Percent'],
      'ValidTitle'=>$upline[$p1yyyymm]['ValidTitle'],
      'PaidTitle'=>$upline[$p1yyyymm]['PaidTitle'],
      'PPV'=>$upline[$p1yyyymm]['PV'],
      'PV'=>$upline[$p0yyyymm]['PV'],
      'Mobile'=>$UserMobile,
     ));
    }

  }
  
//  $tree = $this->findTree($this->request->data['mcaNumber'],4);
   $joinee = $this->findJoinee($this->request->data['mcaNumber']);
   foreach($joinee as $j){
    $joineePV = $joineePV + $j['PV'];
   }
   
   $team = $this->findTeam($this->request->data['mcaNumber']);
   $pteam = $this->findPTeam($this->request->data['mcaNumber']);
   $active = $this->findActive($this->request->data['mcaNumber']);
   $activePVBV = $this->findActivePV($this->request->data['mcaNumber']);
   $activePPVBV = $this->findActivePPV($this->request->data['mcaNumber']);
   $activePV = $activePVBV['PV'];
   $activeBV = $activePVBV['BV'];
   $activePPV = $activePPVBV['PV'];
   $activePBV = $activePPVBV['BV'];

   $pactive = $this->findPActive($this->request->data['mcaNumber']);
   $findzero = $this->findZero($this->request->data['mcaNumber']);
   
   $lists = Lists::find('all',array(
    'conditions'=>array('whoami'=>$this->request->data['mcaNumber'])
   ));
   
   $dataLists = array();
   foreach($lists as $l){
    array_push($dataLists,array(
     (string)$l['mcaNumber']=>(string)$l['list'].":".(string)$l['member']
     ));
   }
   
   
  if(count($user)==1){
   return $this->render(array('json' => array("success"=>"Yes",'team'=>$team,'pteam'=>$pteam,'active'=>$active,'activePV'=>$activePV,'activePPV'=>$activePPV,'activeBV'=>$activeBV,'activePBV'=>$activePBV,'pactive'=>$pactive,'lists'=>$dataLists,"tree"=>$tree,"user"=>$user,"mobile"=>$mobile,'joinee'=>count($joinee),'findzero'=>$findzero,'joineePV'=>$joineePV)));    
  }else{
   return $this->render(array('json' => array("success"=>"No")));    
  }
 }
 return $this->render(array('json' => array("success"=>"No")));    
}

public function findTeam($mcaNumber){
  $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
  $yyyymm = date('Y-m');
  $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
   $left = $user['left'];
   $right = $user['right'];
   $team = Users::count('all',array('conditions'=>
   array(
      'left'=>array('$gt'=>$left),
      'right'=>array('$lt'=>$right),
       $yyyymm=>array('$exists'=>true),
       $p1yyyymm.'.Percent'=>array('$ne'=>null),
      'Enable'=>'Yes'
   )
   )
 );
 return $team;
}

public function findActive($mcaNumber){
  $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
  $yyyymm = date('Y-m');
   $left = $user['left'];
   $right = $user['right'];
   $active = Users::count('all',array('conditions'=>
   array(
      'left'=>array('$gt'=>$left),
      'right'=>array('$lt'=>$right),
       $yyyymm.'.PV'=>array('$gt'=>0),
      'Enable'=>'Yes'
   )
   )
 );
 
 return $active;
}

public function findActivePV($mcaNumber){
  $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
  $yyyymm = date('Y-m');
   $left = $user['left'];
   $right = $user['right'];
   $active = Users::all('all',array('conditions'=>
   array(
      'left'=>array('$gt'=>$left),
      'right'=>array('$lt'=>$right),
       $yyyymm.'.PV'=>array('$gt'=>0),
      'Enable'=>'Yes'
   )
   )
 );
 $activePV = 0;
 $activeBV = 0;
 foreach($active as $a){
  $activePV = $activePV + $a[$yyyymm]['PV'];
  $activeBV = $activeBV + $a[$yyyymm]['BV'];
 }
 return array('PV'=>$activePV,'BV'=>$activeBV);
}
public function findActivePPV($mcaNumber){
  $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
  $pyyyymm = date('Y-m', strtotime('first day of last month'));
   $left = $user['left'];
   $right = $user['right'];
   $active = Users::all('all',array('conditions'=>
   array(
      'left'=>array('$gt'=>$left),
      'right'=>array('$lt'=>$right),
       $pyyyymm.'.PV'=>array('$gt'=>0),
      'Enable'=>'Yes'
   )
   )
 );
 $activePV = 0;
 $activeBV = 0;
 foreach($active as $a){
  $activePV = $activePV + $a[$pyyyymm]['PV'];
  $activeBV = $activeBV + $a[$pyyyymm]['BV'];
 }
 return array('PV'=>$activePV,'BV'=>$activeBV);
}

public function findPActive($mcaNumber){
  $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
  $pyyyymm = date('Y-m', strtotime('first day of last month'));
   $left = $user['left'];
   $right = $user['right'];
   $active = Users::count('all',array('conditions'=>
   array(
      'left'=>array('$gt'=>$left),
      'right'=>array('$lt'=>$right),
       $pyyyymm.'.PV'=>array('$gt'=>0),
      'Enable'=>'Yes'
   )
   )
 );
 return $active;
}


public function findPTeam($mcaNumber){
  $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
  
  $pyyyymm = date('Y-m', strtotime('first day of last month'));
   $left = $user['left'];
   $right = $user['right'];
   $team = Users::count('all',array('conditions'=>
   array(
      'left'=>array('$gt'=>$left),
      'right'=>array('$lt'=>$right),
       $pyyyymm=>array('$exists'=>true),
      'Enable'=>'Yes'
   )
   )
 );
 return $team;
}
public function findJoinee($mcaNumber){
 $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
 ));
 $yyyymm = date('Y-m');
 $pyyyymm = date('Y-m', strtotime('first day of last month'));
 $dateJoin = date('M Y');
 $left = $user['left'];
 $right = $user['right'];
 $joinee = Users::find('all',array('conditions'=>
   array(
      'DateJoin'=>array('like'=>'/'.$dateJoin.'/'),
      'left'=>array('$gt'=>$left),
      'right'=>array('$lt'=>$right),
      'Enable'=>'Yes'
   ),
   'fields'=>array('mcaNumber','mcaName','DateJoin',$yyyymm.'.PV'),
   'order'=>array('DateJoin'=>'ASC')
   )
 );
 
 $DetailJoinee = array();
 foreach($joinee as $j){
  array_push($DetailJoinee,
    array(
     'mcaNumber'=>$j['mcaNumber'],
     'mcaName'=>$j['mcaName'],
     'DateJoin'=>$j['DateJoin'],
     'PV'=>$j[$yyyymm]['PV'],
    )
  );
  
 }
 
// return $this->render(array('json' => array("success"=>"Yes","joinee"=>count($joinee),'joinee'=>$DetailJoinee)));    
 return $DetailJoinee;
}

public function findTree($mcaNumber,$level){
 $tree = array();
 $yyyymm = date('Y-m');
 $pyyyymm = date('Y-m', strtotime('first day of last month'));
 $downlines = Users::find('all',array(
  'conditions'=>array('refer_id'=>$mcaNumber)
 ));
 
 foreach($downlines as $d){
  if($d['Level']!=null && $d[$yyyymm]['Percent']==16){
   array_push($tree,array(
    'mcaNumber'=>$d['mcaNumber'],
    'mcaName'=>$d['mcaName'],
    'ValidTitle'=>$d[$pyyyymm]['ValidTitle'],
    'Level'=>$d['Level']?:""
    ));
    $downlines1 = Users::find('all',array(
     'conditions'=>array('refer_id'=>$d['mcaNumber'])
    ));
    foreach($downlines1 as $d1){
     if($d1['Level']!=null && $d1[$yyyymm]['Percent']==16){
      array_push($tree,array(
       'mcaNumber'=>$d1['mcaNumber'],
       'mcaName'=>$d1['mcaName'],
       'ValidTitle'=>$d1[$pyyyymm]['ValidTitle'],
       'Level'=>$d1['Level']?:""
       ));
     }
     $downlines2 = Users::find('all',array(
     'conditions'=>array('refer_id'=>$d1['mcaNumber'])
    ));
    foreach($downlines2 as $d2){
     if($d2['Level']!=null && $d2[$yyyymm]['Percent']==16){
      array_push($tree,array(
       'mcaNumber'=>$d2['mcaNumber'],
       'mcaName'=>$d2['mcaName'],
       'ValidTitle'=>$d2[$pyyyymm]['ValidTitle'],
       'Level'=>$d2['Level']?:""
       ));
     }
     $downlines3 = Users::find('all',array(
     'conditions'=>array('refer_id'=>$d2['mcaNumber'])
    ));
    foreach($downlines3 as $d3){
     if($d3['Level']!=null && $d3[$yyyymm]['Percent']==16){
      array_push($tree,array(
       'mcaNumber'=>$d3['mcaNumber'],
       'mcaName'=>$d3['mcaName'],
       'ValidTitle'=>$d3[$pyyyymm]['ValidTitle'],
       'Level'=>$d3['Level']?:""
       ));
     }
    }
    }
     
     
    }
    
    
   }
 }
// return $this->render(array('json' => array("success"=>"Yes","tree"=>$tree)));    
 return $tree;
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
   $returncall = $function->twilio($mobile,$msg,$otp);  // Testing if it works 
   $returnsms = $function->sendSms($mobile,$msg);  // Testing if it works 
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
 ini_set('memory_limit', '-1');
 $yyyymm = date('Y-m');
 $pyyyymm = date('Y-m', strtotime('first day of last month'));
 
 if($this->request->data){
  $users = Users::find('all',array(
   'conditions'=>array(
    'refer'=>$this->request->data['mcaNumber'],
     $yyyymm=>array('$exists'=>true),
     $pyyyymm.'.Percent'=>array('$ne'=>null)
     ),
   'order'=>array($yyyymm.'.GPV'=>'DESC',$pyyyymm.'.GPV'=>'DESC')
   ));
  if(count($users)>0){
   $allusers = array();
   foreach($users as $u){
    $count = Users::count(array(
     'conditions'=>array('refer'=>$u['mcaNumber'])
    ));
    $mobile = Mobiles::find('first',array(
     'conditions'=>array('mcaNumber'=>$u['mcaNumber'])
    ));
    $yyyymm = date('Y-m');
    $pyyyymm = date('Y-m', strtotime('first day of last month'));
    
    $joinee = $this->findJoinee($u['mcaNumber']);
    $joineePV = 0;
    foreach($joinee as $j){
     $joineePV = $joineePV + $j['PV'];
    }
    
    $team = $this->findTeam($u['mcaNumber']);
    $pteam = $this->findPTeam($u['mcaNumber']);
    $active = $this->findActive($u['mcaNumber']);
    $activePVBV = $this->findActivePV($u['mcaNumber']);
    $activePPVBV = $this->findActivePPV($u['mcaNumber']);
    $activePV = $activePVBV['PV'];
    $activeBV = $activePVBV['BV'];
    $activePPV = $activePPVBV['PV'];
    $activePBV = $activePPVBV['BV'];
    
    $pactive = $this->findPActive($u['mcaNumber']);    
    $findzero = $this->findZero($u['mcaNumber']);
    
   $lists = Lists::find('all',array(
    'conditions'=>array('whoami'=>$this->request->data['whoami'])
   ));
   
   $dataLists = array();
   foreach($lists as $l){
    if($u['mcaNumber']==$l['mcaNumber']){
    array_push($dataLists,array(
     (string)$l['mcaNumber']=>(string)$l['list'].":".(string)$l['member']
     ));
    }
   }

    
    array_push($allusers,array(
    'mcaNumber'=>$u['mcaNumber'],
    'mcaName'=>$u['mcaName'],
    'refer'=>$u['refer'],
    'Mobile'=>$mobile['Mobile']?:"",
    'Enable'=>$u['Enable'],
    'Level'=>$u['Level'],
    'KYC'=>$u['KYC']?:"",
    'NEFT'=>$u['NEFT']?:"",
    'DateJoin'=>$u['DateJoin'],
    'State'=>$u['State'],
    'Zone'=>$u['Zone'],
    'City'=>$u['City'],
    'lists'=>$dataLists,
    'team'=>$team,
    'pteam'=>$pteam,    
    'active'=>$active,    
    'pactive'=>$pactive,    
    'activepv'=>$activePV,    
    'activeppv'=>$activePPV,    
    'activebv'=>$activeBV,
    'activepbv'=>$activePBV,        
     $yyyymm=>array(
     'PV'=>$u[$yyyymm]['PV']?:0,
     'ExtraPV'=>$u[$yyyymm]['ExtraPV']?:0,
     'BV'=>$u[$yyyymm]['BV']?:0,
     'GBV'=>$u[$yyyymm]['GBV']?:0,
     'GPV'=>$u[$yyyymm]['GPV']?:0,
     'GrossPV'=>$u[$yyyymm]['GrossPV']?:0,
     'PGPV'=>$u[$yyyymm]['PGPV']?:0,
     'PGBV'=>$u[$yyyymm]['PGBV']?:0,
     'RollUpBV'=>$u[$yyyymm]['RollUpBV']?:0,
     'RollUpPV'=>$u[$yyyymm]['RollUpPV']?:0,
     'Legs'=>$u[$yyyymm]['Legs']?:0,
     'QDLegs'=>$u[$yyyymm]['QDLegs']?:0,
     'Percent'=>$u[$yyyymm]['Percent']?:"",
     'ValidTitle'=>$u[$yyyymm]['ValidTitle']?:"",
     'Joinee'=>count($joinee),
     'joineePV'=>$joineePV,
     'FindZero'=>$findzero,
     'InActive' => (integer)$u[$yyyymm]['InActive']?:"",
    ),
    $pyyyymm => array(
     'PV'=>$u[$pyyyymm]['PV']?:0,
     'ExtraPV'=>$u[$pyyyymm]['ExtraPV']?:0,
     'BV'=>$u[$pyyyymm]['BV']?:0,
     'GBV'=>$u[$pyyyymm]['GBV']?:0,
     'GPV'=>$u[$pyyyymm]['GPV']?:0,
     'GrossPV'=>$u[$pyyyymm]['GrossPV']?:0,
     'PGPV'=>$u[$pyyyymm]['PGPV']?:0,
     'PGBV'=>$u[$pyyyymm]['PGBV']?:0,
     'RollUpBV'=>$u[$pyyyymm]['RollUpBV']?:0,
     'RollUpPV'=>$u[$pyyyymm]['RollUpPV']?:0,
     'Legs'=>$u[$pyyyymm]['Legs']?:0,
     'QDLegs'=>$u[$pyyyymm]['QDLegs']?:0,
     'Percent'=>$u[$pyyyymm]['Percent']?:0,
     'ValidTitle'=>$u[$pyyyymm]['ValidTitle']?:"",
     'InActive' => (integer)$u[$pyyyymm]['InActive']?:0,
     'Gross' => $u[$pyyyymm]['Gross']?:0,     
     'APB' => $u[$pyyyymm]['APB']?:0,     
     'TBB' => $u[$pyyyymm]['TBB']?:0,     
     'ABB' => $u[$pyyyymm]['ABB']?:0,     
     'DB' => $u[$pyyyymm]['DB']?:0,     
     'LPB' => $u[$pyyyymm]['LPB']?:0,     
     'TF' => $u[$pyyyymm]['TF']?:0,     
     'CF' => $u[$pyyyymm]['CF']?:0,     
     'HF' => $u[$pyyyymm]['HF']?:0,     
     ),
    'count'=>$count
    ));
   }
   return $this->render(array('json' => array("success"=>"Yes","otp"=>$otp,'users'=>$allusers)));  
  }else{
   return $this->render(array('json' => array("success"=>"No")));  
  }
 }
 return $this->render(array('json' => array("success"=>"No")));  
}


// Upload Builders
// Upload Joinee

// Upload Enrolment
// Upload Active

public function uploadbuilders(){
ini_set('memory_limit','-1');
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
         'refer' => (string)$data[5],
         'ValidTitle'=>trim((string)$data[6]),
         'PaidTitle'=>trim((string)$data[7]),
         'Percent'=>(integer)$data[8],
         'ExtraPV'=>(integer)$data[9],
         'PrevCummPV'=>(integer)$data[10],
         'PV'=>(integer)$data[11],
         'BV'=>(integer)$data[12],
         'GPV'=>(integer)$data[13],
         'GBV'=>(integer)$data[14],
         'GrossPV'=>(integer)$data[15],
         'PGPV'=>(integer)$data[16],
         'PGBV'=>(integer)$data[17],
         'Level'=>(integer)$data[18],
         'Legs'=>(integer)$data[19],
         'QDLegs'=>(integer)$data[20],
         'APB'=>(integer)$data[21],
         'DB'=>(integer)$data[22],
         'TBBP'=>(integer)$data[23],
         'TBB'=>(integer)$data[24],
         'LPB'=>(integer)$data[25],
         'TF'=>(integer)$data[26],
         'CF'=>(integer)$data[27],
         'HF'=>(integer)$data[28],
         'ABB'=>(integer)$data[29],
         'Gross'=>(integer)$data[30],
         'Enable'=>(string)$data[31],
        );
        

        $user = Users::find("first",array(
        "conditions"=>array('mcaNumber'=>$data['mcaNumber'])
        ));
        if(count($user)!=1){
         if($data['mcaNumber']!=""){
          if((int)$data['mcaNumber']>0){
           $yyyymm = $this->request->data['yyyymm'];
           $this->addUserBuilders($data,$yyyymm);
           
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
    'Enable'=>$data['Enable'],
     $yyyymm.'.ValidTitle'=>(string)$data['ValidTitle'],
     $yyyymm.'.PaidTitle'=>(string)$data['PaidTitle'],
     $yyyymm.'.Percent'=>(integer)$data['Percent'],
     $yyyymm.'.PrevCummPV'=>(integer)$data['PrevCummPV'],
     $yyyymm.'.ExtraPV'=>(integer)$data['ExtraPV'],
     $yyyymm.'.PV'=>(integer)$data['PV'],
     $yyyymm.'.BV'=>(integer)$data['BV'],
     $yyyymm.'.GPV'=>(integer)$data['GPV'],
     $yyyymm.'.GBV'=>(integer)$data['GBV'],
     $yyyymm.'.GrossPV'=>(integer)$data['GrossPV'],
     $yyyymm.'.PGPV'=>(integer)$data['PGPV'],
     $yyyymm.'.PGBV'=>(integer)$data['PGBV'],
     $yyyymm.'.RollUpBV'=>(integer)$data['RollUpBV'],
    'Level'=>(integer)$data['Level'],
     $yyyymm.'.Legs'=>(integer)$data['Legs'],
     $yyyymm.'.QDLegs'=>(integer)$data['QDLegs'],
     $yyyymm.'.APB'=>(integer)$data['APB'],
     $yyyymm.'.DB'=>(integer)$data['DB'],
     $yyyymm.'.TBBP'=>(integer)$data['TBBP'],
     $yyyymm.'.TBB'=>(integer)$data['TBB'],
     $yyyymm.'.LPB'=>(integer)$data['LPB'],
     $yyyymm.'.TF'=>(integer)$data['TF'],
     $yyyymm.'.CF'=>(integer)$data['CF'],
     $yyyymm.'.HF'=>(integer)$data['HF'],
     $yyyymm.'.ABB'=>(integer)$data['ABB'],
     $yyyymm.'.Gross'=>(integer)$data['Gross'],
     $yyyymm.'.InActive'=>(integer)0,

   );
   
   $conditions = array('mcaNumber'=>(string)$data["mcaNumber"]);
   Users::update($data,$conditions);
  
 }

 public function adduserBuilders($data,$yyyymm){
  
   if($data){
   if($data['mcaNumber']!="" && $data["mcaName"]!=""){

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
    'Enable'=>$data['Enable'],
     $yyyymm.'.ValidTitle'=>(string)$data['ValidTitle'],
     $yyyymm.'.PaidTitle'=>(string)$data['PaidTitle'],
     $yyyymm.'.Percent'=>(integer)$data['Percent'],
     $yyyymm.'.PrevCummPV'=>(integer)$data['PrevCummPV'],
     $yyyymm.'.ExtraPV'=>(integer)$data['ExtraPV'],     
     $yyyymm.'.PV'=>(integer)$data['PV'],
     $yyyymm.'.BV'=>(integer)$data['BV'],
     $yyyymm.'.GPV'=>(integer)$data['GPV'],
     $yyyymm.'.GBV'=>(integer)$data['GBV'],
     $yyyymm.'.GrossPV'=>(integer)$data['GrossPV'],
     $yyyymm.'.PGPV'=>(integer)$data['PGPV'],
     $yyyymm.'.PGBV'=>(integer)$data['PGBV'],
     $yyyymm.'.RollUpBV'=>(integer)$data['RollUpBV'],
     'Level'=>(integer)$data['Level'],
     $yyyymm.'.Legs'=>(integer)$data['Legs'],
     $yyyymm.'.QDLegs'=>(integer)$data['QDLegs'],
     $yyyymm.'.APB'=>(integer)$data['APB'],
     $yyyymm.'.DB'=>(integer)$data['DB'],
     $yyyymm.'.TBBP'=>(integer)$data['TBBP'],
     $yyyymm.'.TBB'=>(integer)$data['TBB'],
     $yyyymm.'.LPB'=>(integer)$data['LPB'],
     $yyyymm.'.TF'=>(integer)$data['TF'],
     $yyyymm.'.CF'=>(integer)$data['CF'],
     $yyyymm.'.HF'=>(integer)$data['HF'],
     $yyyymm.'.ABB'=>(integer)$data['ABB'],
     $yyyymm.'.Gross'=>(integer)$data['Gross'],

   );

   Users::create()->save($data);
   
  }

 }


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

public function getactive(){
 ini_set('memory_limit', '-1');
 $mcaNumber = $this->request->data['mcaNumber'];
 $yyyymm = date('Y-m');  
 $pyyyymm = date('Y-m', strtotime('first day of last month'));  
 $dashboard = new DashboardController();
 $Nodes = $dashboard->getChilds($this->request->data['mcaNumber'],"");
  $users = array();
  foreach($Nodes as $n){
   $mobile = Mobiles::find('first',array(
    'conditions'=>array('mcaNumber'=>(string)$n['mcaNumber'])
   ));
   if($n[$pyyyymm]["PV"]){
    array_push($users,
     array(
      'mcaNumber'=>$n['mcaNumber'],
      'mcaName'=>$n['mcaName'],
      $yyyymm.'.PV'=>$n[$yyyymm]['PV']?:0,
      $yyyymm.'.GPV'=>$n[$yyyymm]['GPV']?:0,
      $yyyymm.'.PGPV'=>$n[$yyyymm]['PGPV']?:0,
      $yyyymm.'.RollUpPV'=>$n[$yyyymm]['RollUpPV']?:0,
      $yyyymm.'.PaidTitle'=>$n[$yyyymm]['PaidTitle']?:"",
      $yyyymm.'.Region'=>$n['Zone'].'-'.$n['City']?:"",
      $yyyymm.'.Mobile'=>$mobile['Mobile']?:"",
      $yyyymm.'.Level'=>$n['Level']?:"",

      $pyyyymm.'.PV'=>$n[$pyyyymm]['PV']?:0,
      $pyyyymm.'.GPV'=>$n[$pyyyymm]['GPV']?:0,
      $pyyyymm.'.PGPV'=>$n[$pyyyymm]['PGPV']?:0,
      $pyyyymm.'.RollUpPV'=>$n[$pyyyymm]['RollUpPV']?:0,
      $pyyyymm.'.PaidTitle'=>$n[$pyyyymm]['PaidTitle']?:"",
      $pyyyymm.'.Region'=>$n['Zone'].'-'.$n['City']?:"",
      $pyyyymm.'.Mobile'=>$mobile['Mobile']?:"",
      $pyyyymm.'.Level'=>$n['Level']?:"",
     )
    );
   }
  }
  return $this->render(array('json' => array("success"=>"Yes","users"=>$users)));  
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


public function uploadjoinee(){
   ini_set('memory_limit','-1');
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
         'Level'=>(integer)$data[5],
         'refer' => (integer)$data[6],
         'ValidTitle'=>trim((string)$data[7]),
         'PaidTitle'=>((string)$data[8]),
          'ExtraPV'=>(integer)$data[9],
         'PrevCummPV'=>(integer)$data[10],
         'PV'=>(integer)$data[11],
         'BV'=>(integer)$data[12],
         'GPV'=>(integer)$data[13],
         'GBV'=>(integer)$data[14],
         'GrossPV'=>(integer)$data[15],
         'PGPV'=>(integer)$data[16],
         'PGBV'=>(integer)$data[17],
         'RollUpPV'=>(integer)$data[18],
         'Percent'=>(integer)$data[19],
         'Legs'=>(integer)$data[20],
         'QDLegs'=>(integer)$data[21],
         'Enable'=>"Yes"
        );
        
  
        $user = Users::find("first",array(
        "conditions"=>array('mcaNumber'=>$data['mcaNumber'])
        ));
        if(count($user)!=1){
         if($data['mcaNumber']!=""){
          if((int)$data['mcaNumber']>0){
           $yyyymm = $this->request->data['yyyymm'];
           $this->adduserjoinee($data,$yyyymm);
  
          }
         }
        }else{
        }
      }
      fclose($handle);
   }
 }
}

public function uploadinner(){
   ini_set('memory_limit','-1');
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
      while (($datax = fgetcsv($handle, 1000, ",")) !== FALSE) {
       $num = count($datax);
       $row++;
        $data = array(
         'Inner'=>array(
         'email' => (string)$datax[0],
         'mobile'=>(string)$datax[1],
         'mcaBusinessName'=>(string)$datax[2],
         'mcaNumber'=>(string)$datax[3],
         'Enabled'=>(string)$datax[4],
         'DateJoin'=> new \MongoDate
         ),
        );
        
        
        $user = Users::find('first',array(
        'conditions'=>array('mcaNumber'=>(string)$datax[3])
        ));
        
        if(count($user)==1){

          $conditions = array('mcaNumber'=>(string)$data['Inner']['mcaNumber']);
          Users::update($data,$conditions);
         $name = $user['mcaName'];
        }
        
        $data = array(
         'mcaNumber' => (string)$data['Inner']['mcaNumber'],
         'Mobile' => (string)(string)$data['Inner']['mobile'],
         'mcaName' => $name
        );
        
        $mobileUser = Mobiles::find('first',array(
          'conditions'=>array('mcaNumber'=>(string)$data[3])
        ));
        
        if(count($mobileUser)==1){
         $conditions = array('mcaNumber'=>(string)$data['Inner']['mcaNumber']);
         Mobiles::update($data,$conditions);
        }else{
         Mobiles::create()->save($data);
        }
        
        
      }
      fclose($handle);
   }
 }
}

public function uploadactive(){
   ini_set('memory_limit','-1');
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
         'refer' => (string)$data[6],
         'PaidTitle'=>trim((string)$data[7]),
         'ValidTitle'=>trim((string)$data[8]),
         'PrevCummPV'=>(integer)$data[9],
         'ExtraPV'=>(integer)$data[10],
         'PV'=>(integer)$data[11],
         'BV'=>(integer)$data[12],
         'GPV'=>(integer)$data[13],
         'GBV'=>(integer)$data[14],
         'GrossPV'=>(integer)$data[15],
         'PGPV'=>(integer)$data[16],
         'PGBV'=>(integer)$data[17],
         'RollUpPV'=>(integer)$data[18],
         'Level'=>(integer)$data[19],
         'Legs'=>(integer)$data[20],
         'QDLegs'=>(integer)$data[21],
         'Enable'=>'Yes'
        );
        
        $user = Users::find("first",array(
        "conditions"=>array('mcaNumber'=>$data['mcaNumber'])
        ));
        if(count($user)==1){
         if($data['mcaNumber']!=""){
          if((int)$data['mcaNumber']>0){
           $yyyymm = $this->request->data['yyyymm'];
           $this->addUserActive($data,$yyyymm);


          }
         }
        }else{

        }
      }
      fclose($handle);
   }
 }
}


public function checkTerminated(){
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
   $allmca = array();
   if (($handle = fopen($tmpName, "r")) !== FALSE) {
      while (($datax = fgetcsv($handle, 1000, ",")) !== FALSE) {
       $num = count($datax);
       $row++;
        array_push($allmca,$datax[1]);
      }
   }
   $terminated  = Users::find('all',array(
  'conditions'=>array(
   'mcaNumber'=>array('$nin'=>$allmca),
   'Enable'=>'Yes',
  )
 ));
   return $this->render(array('json' => array("success"=>"Yes",'count'=>count($terminated),'data'=>$terminated)));   
  }

  return compact('data');
}

public function list100pv(){
 $yyyymm = date('Y-m');
 
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
  ));
   $left = $user['left'];
   $right = $user['right'];
   $conditions = array(
   'left'=>array('$gt'=>$left),
   'right'=>array('$lt'=>$right),
   'Inner.Enabled'=>'Yes',
  );
 $users = Users::find('all',array(
  'conditions'=>$conditions,
 ));
 
 $inner = array($this->request->data['mcaNumber']);
 foreach($users as $u){
  array_push($inner,$u['mcaNumber']);
 }
// print_r($inner);
 
 $list  = Users::find('all',array(
  'conditions'=>array(
   $yyyymm.'.PV'=>array('$gte'=>100),
   'mcaNumber'=>array('$nin'=>$inner),
   'Enable'=>'Yes',
  ),
  'fields'=>array('mcaNumber','mcaName','DateJoin',$yyyymm.'.PV'),
 ));

 $allusers = array();
 foreach($list as $l){
    $mobile = Mobiles::find('first',array(
     'conditions'=>array('mcaNumber'=>$l['mcaNumber'])
    ));
  array_push($allusers,array(
   'mcaNumber'=>$l['mcaNumber'],
   'mcaName'=>$l['mcaName'],
   'DateJoin'=>$l['DateJoin'],
   'PV'=>$l[$yyyymm]['PV'],
   'mobile'=>$mobile['Mobile'],
  ));
  
 }

 }
   return $this->render(array('json' => array("success"=>"Yes",'count'=>count($allusers),'data'=>$allusers)));   
}


public function uploadEnrolment(){
   ini_set('memory_limit','-1');
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
         'Level' => (string)$data[5],
         'refer' => (string)$data[6],
         'ValidTitle'=>trim((string)$data[7]?:""),
         'PaidTitle'=>trim((string)$data[8]?:""),
         'KYC'=>(string)$data[9],
         'InActive'=>(integer)$data[10],
         'ExtraPV'=>(integer)$data[11],
         'PrevCummPV'=>(integer)$data[12],
         'PV'=>(integer)$data[13],
         'BV'=>(integer)$data[14],
         'GPV'=>(integer)$data[15],
         'GBV'=>(integer)$data[16],
         'GrossPV'=>(integer)$data[17],
         'PGPV'=>(integer)$data[18],
         'PGBV'=>(integer)$data[19],
         'RollUpPV'=>(integer)$data[20],
         'Level'=>(integer)$data[21],
         'Legs'=>(integer)$data[22],
         'QDLegs'=>(integer)$data[23],
         'APB'=>(integer)$data[24],
         'DBP'=>(integer)$data[25],
         'TBBP'=>(integer)$data[26],
         'DB'=>(integer)$data[27],
         'TBB'=>(integer)$data[28],
         'LPBP'=>(integer)$data[29],
         'LPB'=>(integer)$data[30],
         'TF'=>(integer)$data[31],
         'CF'=>(integer)$data[32],
         'HF'=>(integer)$data[33],
         'ABB'=>(integer)$data[34],
         'Gross'=>(integer)$data[35],
         'NEFT'=>(string)$data[36],
         'Aadhar'=>(string)$data[37],
         'DaysLeft'=>(integer)$data[38],
         'State'=>(string)$data[39],
         'Zone'=>(string)$data[40],
         'City'=>(string)$data[41],
         'Enable'=>(string)$data[42],
        );
        
  //      print_r($data);
        $user = Users::find("first",array(
        "conditions"=>array('mcaNumber'=>$data['mcaNumber'])
        ));
        if(count($user)!=1){
         if($data['mcaNumber']!=""){
          if((int)$data['mcaNumber']>0){
           $yyyymm = $this->request->data['yyyymm'];
           $this->addUserEnrolment($data,$yyyymm);
           
           $function = new Functions();
           $function->addnotify(
            $data['mcaNumber'],  // $mcaNumber
            "New Joinee", // $subtitle
            $mcaName . "MCA No: <a href='/user/".$data['mcaNumber']."/' class='link'>". $data['mcaNumber'] . "</a><br> <strong>".$data['mcaName']."</strong> has joined your network on ".$data['DateJoin'] , // $title
            "Click to follow up",// $text,
            "<i class='icons f7-icons'>share</i>", // $icon,
            $data['DateJoin'], // $titleRightText,
            $data['mcaName'] // new Name
           );
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

 public function adduserjoinee($data,$yyyymm){
   if($data){
  
    if($data['mcaNumber']!="" && $data["mcaName"]!=""){
//    print_r($data['refer']);
     $refer = Users::first(array(
      'fields'=>array('left','mcaNumber','ancestors','mcaName','Enable'),
       'conditions'=>array('mcaNumber'=>(string)$data['refer'])
      ));
      
     
   if(count($refer)>0){ 
   $refer_ancestors = $refer['ancestors'];
   $refer_enable = $refer['Enable'];
   
   print_r($refer['Enable']);
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
     $yyyymm.'.RollUpPV'=>(integer)$data['RollUpPV'],
     $yyyymm.'.RollUpBV'=>(integer)$data['RollUpBV'],
     'Level'=>(integer)$data['Level'],
     $yyyymm.'.Legs'=>(integer)$data['Legs'],
     $yyyymm.'.QDLegs'=>(integer)$data['QDLegs'],
     'Enable'=>$refer_enable

   );
//print_r($data);
   Users::create()->save($data);
   }
   }else{
    $refer_left = 0;
    $refer_name = "";
    $refer_id = "";
    $ancestors = array();
   }
    
   }
 }


 public function adduserActive($data,$yyyymm){
   if($data){
  
   $userActive = Users::find('first',array(
    'conditions'=>array('mcaNumber'=>(string)$data['mcaNumber'])
   ));
   
   if(count($userActive)>0){
    
    if($data['PV']>$userActive[$yyyymm]['PV']){
     $today = array(
      'PV'=>((int)$data['PV']-(int)$userActive[$yyyymm]['PV']),
      'Date'=> new \MongoDate()
     );
     print_r($data['mcaName'].': PV'.((int)$data['PV']-(int)$userActive[$yyyymm]['PV']).'<br>');
          if($userActive['Enable']=="Yes"){
           $function = new Functions();
           $function->addnotify(
            $data['mcaNumber'],  // $mcaNumber
            "DP Purchase", // $subtitle
            $mcaName . "MCA No: <a href='/user/".$data['mcaNumber']."/' class='link'>". $data['mcaNumber'] . "</a><br> <strong>".$data['mcaName']."</strong> has made a purchased of PV ". ((int)$data['PV']-(int)$userActive[$yyyymm]['PV']) , // $title
            "Click to follow up",// $text,
            "<i class='icons f7-icons'>share</i>", // $icon,
            $data['DateJoin'], // $titleRightText,
            $data['mcaName'] // new Name
           );
          }
     
    }else{
     $today = array(
      'PV'=>$userActive[$yyyymm]['today']['PV']?:0,
      'Date'=>$userActive[$yyyymm]['today']['Date']?:"",
     );
    }
   $data = array(
    'mcaName'=>(string)$data["mcaName"],
    'mcaNumber'=>(string)$data["mcaNumber"],
    'refer'=>(string)$data["refer"],
     $yyyymm.'.ValidTitle'=>(string)$data['ValidTitle'],
     $yyyymm.'.PaidTitle'=>(string)$data['PaidTitle'],
     $yyyymm.'.Percent'=>(integer)$data['Percent'],
     $yyyymm.'.PrevCummPV'=>(integer)$data['PrevCummPV'],
     $yyyymm.'.ExtraPV'=>(integer)$data['ExtraPV'],
     $yyyymm.'.PV'=>(integer)$data['PV'],
     $yyyymm.'.BV'=>(integer)$data['BV'],
     $yyyymm.'.GPV'=>(integer)$data['GPV'],
     $yyyymm.'.GBV'=>(integer)$data['GBV'],
     $yyyymm.'.GrossPV'=>(integer)$data['GrossPV'],
     $yyyymm.'.PGPV'=>(integer)$data['PGPV'],
     $yyyymm.'.PGBV'=>(integer)$data['PGBV'],
     $yyyymm.'.RollUpPV'=>(integer)$data['RollUpPV'],
     $yyyymm.'.RollUpBV'=>(integer)$data['RollUpBV'],
     'Level'=>(integer)$data['Level'],
     $yyyymm.'.Legs'=>(integer)$data['Legs'],
     $yyyymm.'.QDLegs'=>(integer)$data['QDLegs'],
     $yyyymm.'.today'=>$today,
  );
    $conditions = array('mcaNumber'=>(string)$data["mcaNumber"]);
    Users::update($data,$conditions);
    //*********************************************************************
    //*********************************************************************
   }else{
    
   }
   }
 }


 public function adduserEnrolment($data,$yyyymm){
  
   if($data){
   if($data['mcaNumber']!="" && $data["mcaName"]!=""){
//    print_r($data['refer']);
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
     $yyyymm.'.InActive'=>(integer)$data['InActive'],
     $yyyymm.'.Percent'=>(integer)$data['Percent'],
     $yyyymm.'.PrevCummPV'=>(integer)$data['PrevCummPV'],
     $yyyymm.'.ExtraPV'=>(integer)$data['ExtraPV'],
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
     $yyyymm.'.DaysLeft'=>(integer)$data['DaysLeft'],
     $yyyymm.'.APB'=>(integer)$data['APB'],
     $yyyymm.'.DB'=>(integer)$data['DB'],
     $yyyymm.'.LPB'=>(integer)$data['LPB'],
     $yyyymm.'.TF'=>(integer)$data['TF'],
     $yyyymm.'.CF'=>(integer)$data['CF'],
     $yyyymm.'.HF'=>(integer)$data['HF'],
     $yyyymm.'.Gross'=>(integer)$data['Gross'],
     'KYC'=>(string)$data['KYC'],
     'NEFT'=>$data['NEFT'],
     'Aadhar'=>$data['Aadhar'],
     'State'=>$data['State'],
     'Zone'=>$data['Zone'],
     'City'=>$data['City'],
     'Enable'=>$data['Enable'],

   );
   print_r($data['mcaName'].": ".$data[$yyyymm.'.PV']."<br>\n");
   Users::create()->save($data);
   
  }

 }


 public function updateUserEnrolment($data,$yyyymm){
   $data = array(
    'mcaName'=>(string)$data["mcaName"],
    'mcaNumber'=>(string)$data["mcaNumber"],
    'refer'=>(string)$data["refer"],
     $yyyymm.'.ValidTitle'=>(string)$data['ValidTitle'],
     $yyyymm.'.PaidTitle'=>(string)$data['PaidTitle'],
     $yyyymm.'.InActive'=>(integer)$data['InActive'],
     $yyyymm.'.Percent'=>(integer)$data['Percent'],
     $yyyymm.'.PrevCummPV'=>(integer)$data['PrevCummPV'],
     $yyyymm.'.ExtraPV'=>(integer)$data['ExtraPV'],
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
     $yyyymm.'.DaysLeft'=>(integer)$data['DaysLeft'],
     $yyyymm.'.APB'=>(integer)$data['APB'],
     $yyyymm.'.DBP'=>(integer)$data['DPB'],
     $yyyymm.'.DB'=>(integer)$data['DB'],
     $yyyymm.'.TBBP'=>(integer)$data['TBBP'],
     $yyyymm.'.TBB'=>(integer)$data['TBB'],
     $yyyymm.'.LPBP'=>(integer)$data['LPBP'],
     $yyyymm.'.LPB'=>(integer)$data['LPB'],
     $yyyymm.'.TF'=>(integer)$data['TF'],
     $yyyymm.'.CF'=>(integer)$data['CF'],
     $yyyymm.'.HF'=>(integer)$data['HF'],
     $yyyymm.'.ABB'=>(integer)$data['ABB'],
     $yyyymm.'.Gross'=>(integer)$data['Gross'],
     'KYC'=>(string)$data['KYC'],
     'NEFT'=>$data['NEFT'],
     'Aadhar'=>$data['Aadhar'],
     'State'=>$data['State'],
     'Zone'=>$data['Zone'],
     'City'=>$data['City'],
     'Enable'=>$data['Enable'],
   );
   $conditions = array('mcaNumber'=>(string)$data["mcaNumber"]);
   Users::update($data,$conditions);
 }

public function saveMessage(){
 if($this->request->data){
  $group = $this->request->data['group'];
  $touser = $this->request->data['user'];
  $mcaNumber = $this->request->data['mcaNumber'];
  $message = $this->request->data['message'];
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
  $data = array(
   'group'=>$group,
   'toUser'=>$touser,
   'mcaNumber'=>$mcaNumber,
   'mcaName'=>$user['mcaName'],
   'message'=>$message,
   'DateTime'=>new \MongoDate()
  );
  
  Messages::create()->save($data);
 }
 $allmessages = $this->getmessages($group,$mcaNumber);
 return $this->render(array('json' => array("success"=>"Yes",'messages'=>$allmessages)));   
}

public function getmessagesgroup(){
 if($this->request->data){
  $allmessages = $this->getmessages($this->request->data['group'],$this->request->data['mcaNumber']);
 }
 return $this->render(array('json' => array("success"=>"Yes",'messages'=>$allmessages)));
}

public function getmessages($group,$mcaNumber){
  $messages = Messages::find('all',array(
  'conditions'=>array('group'=>$group),
  'order'=>array('DateTime'=>'ASC')
 ));
 
 $allmessages = array();
 foreach($messages as $m){
  if($m['mcaNumber']==$mcaNumber){
    array_push($allmessages, array(
     'mcaNumber'=>$m['mcaNumber'],
     'mcaName'=>$m['mcaName'],
     'toUser'=>$m['toUser'],
     'group'=>$m['group'],
     'DateTime'=>gmdate("Y-M-d h:i:s",$m['DateTime']->sec),
     'message'=>$m['message'],
     'Type'=>'send'
     ));
  }else{
    array_push($allmessages, array(
     'mcaNumber'=>$m['mcaNumber'],
     'mcaName'=>$m['mcaName'],
     'toUser'=>$m['toUser'],
     'group'=>$m['group'],
     'DateTime'=>gmdate("Y-M-d h:i:s",$m['DateTime']->sec),
     'message'=>$m['message'],
     'Type'=>'received'
     ));   
  }
 }
 return $allmessages;
}

public function groupinfo(){
 if($this->request->data){
  $group = $this->request->data['group'];
  $pyyyymm = date('Y-m', strtotime('first day of last month'));  
  switch ($group) {
   case "0PV":
    $conditions = array($pyyyymm.'.PV'=>array('$gte'=>0),'Enable'=>'Yes');
       break;
   case "25PV":
    $conditions = array($pyyyymm.'.PV'=>array('$gte'=>25),'Enable'=>'Yes');
       break;
   case "50PV":
    $conditions = array($pyyyymm.'.PV'=>array('$gte'=>50),'Enable'=>'Yes');
       break;
   case "100PV":
    $conditions = array($pyyyymm.'.PV'=>array('$gte'=>100),'Enable'=>'Yes');
       break;
   case "200PV":
    $conditions = array($pyyyymm.'.PV'=>array('$gte'=>200),'Enable'=>'Yes');
       break;
   case "Offers":
    $conditions = array($pyyyymm.'.PV'=>array('$gte'=>0),'Enable'=>'Yes');
       break;
  } 
  $users = Users::find('all',array(
   'conditions'=>$conditions,
   'order'=>array($pyyyymm.'.PV'=>'DESC')
  ));
  $allusers = array();
  foreach ($users as $u){
   array_push($allusers,array(
    'mcaNumber'=>$u['mcaNumber'],
    'mcaName'=>$u['mcaName'],
    'PV' => $u[$pyyyymm]['PV']
   ));
   
  }
  
 }  
 return $this->render(array('json' => array("success"=>"Yes","users"=>$allusers)));   
}


public function groupinfosend(){
 if($this->request->data){
  $group = $this->request->data['group'];
  $mcaNumber = $this->request->data['mcaNumber'];
  $pyyyymm = date('Y-m', strtotime('first day of last month'));
  switch ($group) {
   case "General":
    $conditions = array($pyyyymm.'.PV'=>array('$gte'=>0),'mcaNumber'=>$mcaNumber);
       break;
   case "0PV":
    $conditions = array($pyyyymm.'.PV'=>array('$gte'=>0),'mcaNumber'=>$mcaNumber);
       break;
   case "25PV":
    $conditions = array($pyyyymm.'.PV'=>array('$gte'=>25),'mcaNumber'=>$mcaNumber);
       break;
   case "50PV":
    $conditions = array($pyyyymm.'.PV'=>array('$gte'=>50),'mcaNumber'=>$mcaNumber);
       break;
   case "100PV":
    $conditions = array($pyyyymm.'.PV'=>array('$gte'=>100),'mcaNumber'=>$mcaNumber);
       break;
   case "200PV":
    $conditions = array($pyyyymm.'.PV'=>array('$gte'=>200),'mcaNumber'=>$mcaNumber);
       break;
   case "Offers":
    $conditions = array($pyyyymm.'.PV'=>array('$gte'=>0),'mcaNumber'=>$mcaNumber);
       break;
  } 
  
  $user = Users::find('first',array(
   'conditions'=>$conditions,
  ));
  if(count($user)==0){
   return $this->render(array('json' => array("success"=>"No")));     
  }else{
   return $this->render(array('json' => array("success"=>"Yes",'group'=>$group)));     
  }
  return $this->render(array('json' => array("success"=>"No")));     
 }  
}

public function saveInvoice(){
 if($this->request->data){
  Invoices::create()->save($this->request->data);
 }
 return $this->render(array('json' => array("success"=>"Yes")));   
}

public function seminar($date=null){
 $today = date('Y-m-d');
 if($this->request->data){
  if($this->request->data['Name']==""){
  $seminar = Seminars::find('first',array(
   'conditions'=>array('Date'=>$this->request->data['date'])
  ));
  }else{
   Prospects::create()->save($this->request->data);   
   $seminar = Seminars::find('first',array(
    'conditions'=>array('Date'=>$this->request->data['date'])
   ));
   $registered = 'Yes';
   return compact('seminar','registered');
  }
 return compact('seminar');
 } 
 
 if($date==null){
  $dates = Seminars::find('all',array(
   'conditions'=>array('Date'=>array('$gte'=>$today)),
   'order'=>array('Date'=>'ASC')
  ));
  return compact('dates');
 }
 
  
}

public function getproducts(){
 $products = Malls::find('all',array(
  'order'=>array('Code'=>'ASC','Name'=>'ASC')
 ));
 
 $allproducts = array();
 foreach ($products as $p){
  array_push($allproducts,array(
   'Code'=>$p['Code'],
   'Name'=>$p['Name']
  ));
 }
 
 return $this->render(array('json' => array("success"=>"Yes",'products'=>$allproducts)));   
}

public function uploadmobile(){
  ini_set('memory_limit','-1');
set_time_limit(0);
  if($this->request->data){
   $file = $this->request->data['file']; 
   
   if($_FILES['file']['tmp_name'] == 0){ 
    $name = $_FILES['file']['tmp_name'];
    $ext = strtolower(end(explode('.', $_FILES['file']['tmp_name'])));
    $type = $_FILES['file']['tmp_name'];
    $tmpName = $_FILES['file']['tmp_name'];
   }
   $row = 0;

   if (($handle = fopen($tmpName, "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
       $num = count($data);
       $row++;
        $data = array(
         'mcaNumber' => (string)$data[0],
         'mcaName' => ucwords(strtolower((string)$data[1])),
         'Mobile'=> (string)$data[2],
         );
       $user = Mobiles::find("first",array(
        "conditions"=>array('mcaNumber'=>$data['mcaNumber'])
       ));
       if(count($user)!=1){
         if($data['mcaNumber']!=""){
          if((int)$data['mcaNumber']>0){
           Mobiles::create()->save($data);
          }
         }
        }else{
         $conditions = array('mcaNumber'=>$data['mcaNumber']);
          Mobiles::update($data,$conditions);
        }
   
       }
      }
      
      fclose($handle);      
   }
 }

public function uploadprodstates(){
  ini_set('memory_limit','-1');
  set_time_limit(0);
  if($this->request->data){
   $file = $this->request->data['file']; 
   
   if($_FILES['file']['tmp_name'] == 0){ 
    $name = $_FILES['file']['tmp_name'];
    $ext = strtolower(end(explode('.', $_FILES['file']['tmp_name'])));
    $type = $_FILES['file']['tmp_name'];
    $tmpName = $_FILES['file']['tmp_name'];
   }
   $row = 0;

   $state = substr($this->request->data['State'],0,strpos($this->request->data['State'],"."));
   Malls::update($data);

   if (($handle = fopen($tmpName, "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
       $num = count($data);
       $row++;
         $CodeProduct = (string)$data[0];
         $Code = trim(substr($CodeProduct,0,6));
         
         $conditions = array(
          'Code'=>(string)$Code
         );
   //      print_r($state);
         $product = Malls::find('first',array(
          'conditions'=>$conditions
         ));
         
         
         $available = $product['Available'] . ", ".$state ;
         
         
         

         $data = array(
          'Available'=>$available
         );

         print_r($data);

         Malls::update($data,$conditions);
      }
      
   }
   
  }
  $states = array("Gujarat","TamilNadu","Punjab","Maharashtra","Kerala");
  
  return compact('states');
}

public function uploadproducts(){
   ini_set('memory_limit','-1');
set_time_limit(0);
  if($this->request->data){
   $file = $this->request->data['file']; 
   
   if($_FILES['file']['tmp_name'] == 0){ 
    $name = $_FILES['file']['tmp_name'];
    $ext = strtolower(end(explode('.', $_FILES['file']['tmp_name'])));
    $type = $_FILES['file']['tmp_name'];
    $tmpName = $_FILES['file']['tmp_name'];
   }
   $row = 0;

   if (($handle = fopen($tmpName, "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
       $num = count($data);
       $row++;
       if($data[0]==$data[8]){
        $Available = "Yes";
       }else{
        $Available = "No";
       }
        $data = array(
         'Code' => (string)$data[0],
         'Name' => ucwords(strtolower((string)$data[1])),
         'Loyalty'=>(string)$data[2],
         'Weight'=> (string)$data[3],
         'MRP'=> (float)$data[4],
         'DP'=> (float)$data[5],
         'BV'=> (float)$data[6],
         'PV'=> (float)$data[7],
         'Available'=>$Available,
         );
         print_r($data);
       $product = Malls::find("first",array(
        "conditions"=>array('Code'=>(string)$data['Code'])
       ));
       if(count($product)!=1){
          Malls::create()->save($data);
        }else{
         $conditions = array('Code'=>(string)$data['Code']);
          Malls::update($data,$conditions);
          print_r("Update");
        }
   
       }
      }
      fclose($handle);
   }
}

public function clubmembers(){
 ini_set('memory_limit', '-1');
 if($this->request->data){ 
 $club = split("-",$this->request->data['club']);
 
 $yyyymm = date('Y-m');
 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
 $p2yyyymm = date("Y-m", strtotime("-2 month", strtotime(date("F") . "1")) );
 $p3yyyymm = date("Y-m", strtotime("-3 month", strtotime(date("F") . "1")) );
 $p4yyyymm = date("Y-m", strtotime("-4 month", strtotime(date("F") . "1")) );
 $p5yyyymm = date("Y-m", strtotime("-5 month", strtotime(date("F") . "1")) );
 $p6yyyymm = date("Y-m", strtotime("-6 month", strtotime(date("F") . "1")) );
 $p7yyyymm = date("Y-m", strtotime("-7 month", strtotime(date("F") . "1")) );
 $p8yyyymm = date("Y-m", strtotime("-8 month", strtotime(date("F") . "1")) );
 $p9yyyymm = date("Y-m", strtotime("-9 month", strtotime(date("F") . "1")) );
 $p10yyyymm = date("Y-m", strtotime("-10 month", strtotime(date("F") . "1")) );
 $p11yyyymm = date("Y-m", strtotime("-11 month", strtotime(date("F") . "1")) );
 
  if($club[0]=="x"){
  $conditions = array(
    $yyyymm.'.PV'=>null,
    'Enable'=>'Yes'
  );
 }else if($club[1]==0){
  $conditions = array(
    $yyyymm.'.PV'=>0,
    'Enable'=>'Yes'
  );
 }else{
  $conditions = array(
    $yyyymm.'.PV'=>array('$gte'=>(integer)$club[0], '$lt'=>(integer)$club[1]),
    'Enable'=>'Yes'
  );
 } 
// print_r($conditions);


 $mcaNumber = $this->request->data['mcaNumber'];
 $dashboard = new DashboardController();
 $Nodes = $dashboard->getChildsClub($mcaNumber,$club[0],$club[1],$yyyymm);
 
 
 
 $allusers = array();
 foreach($Nodes as $n){
  
  $mobile = Mobiles::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$n['mcaNumber'])
  ));


 $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$n['mcaNumber'])
 ));
 
 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
  
  $number = 0;
  foreach($user['ancestors'] as $key=>$val){
   // print_r($val.":".$mcaNumber."\n");
   if($val!=$mcaNumber){
    $number = $number + 1;
    
   }else{
    break;
    $number = 0;
    
   }
  }
  $number = $number + 1;
   $upline = Users::find('first',array(
    'conditions'=>array('mcaNumber'=>(string)$user['ancestors'][$number])
   ));


  
  array_push($allusers,array(
    'mcaName'=>$n['mcaName'],
    'mcaNumber'=>$n['mcaNumber'],
    'mobile'=>$mobile['Mobile']?:"",
    'Region'=>$n['Zone'].'-'.$n['City'],
    $yyyymm => array('PV'=>$n[$yyyymm]['PV']?:0,'GPV'=>$n[$yyyymm]['GPV']?:0),
    $p1yyyymm => array('PV'=>$n[$p1yyyymm]['PV']?:0,'GPV'=>$n[$p1yyyymm]['GPV']?:0),
    $p2yyyymm => array('PV'=>$n[$p2yyyymm]['PV']?:0,'GPV'=>$n[$p2yyyymm]['GPV']?:0),
    $p3yyyymm => array('PV'=>$n[$p3yyyymm]['PV']?:0,'GPV'=>$n[$p3yyyymm]['GPV']?:0),    
    $p4yyyymm => array('PV'=>$n[$p4yyyymm]['PV']?:0,'GPV'=>$n[$p3yyyymm]['GPV']?:0),    
    $p5yyyymm => array('PV'=>$n[$p5yyyymm]['PV']?:0,'GPV'=>$n[$p5yyyymm]['GPV']?:0),    
    $p6yyyymm => array('PV'=>$n[$p6yyyymm]['PV']?:0,'GPV'=>$n[$p6yyyymm]['GPV']?:0),    
    $p7yyyymm => array('PV'=>$n[$p7yyyymm]['PV']?:0,'GPV'=>$n[$p7yyyymm]['GPV']?:0),    
    $p8yyyymm => array('PV'=>$n[$p8yyyymm]['PV']?:0,'GPV'=>$n[$p8yyyymm]['GPV']?:0),    
    $p9yyyymm => array('PV'=>$n[$p9yyyymm]['PV']?:0,'GPV'=>$n[$p9yyyymm]['GPV']?:0),    
    $p10yyyymm => array('PV'=>$n[$p10yyyymm]['PV']?:0,'GPV'=>$n[$p10yyyymm]['GPV']?:0),    
    $p11yyyymm => array('PV'=>$n[$p11yyyymm]['PV']?:0,'GPV'=>$n[$p11yyyymm]['GPV']?:0),    
    'upline'=>$upline['mcaName']?:"self",
   )
  );
  }
 }
 return $this->render(array('json' => array("success"=>"Yes",'users'=>$allusers,'count'=>count($allusers))));    
}

public function getversion(){
 if($this->request->data){
   $version = Versions::find('first');
   if($version['Version']!=$this->request->data['version']){
    return $this->render(array('json' => array("success"=>"Yes",'version'=>$version['Version'])));       
   }
 }
 return $this->render(array('json' => array("success"=>"No",'version'=>$version['Version'],'data'=>$this->request->data['version'])));       
}

public function getbuilders(){

 ini_set('memory_limit', '-1');
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $yyyymm = date('Y-m');  
  $dashboard = new DashboardController();
  $Nodes = $dashboard->getChilds($this->request->data['mcaNumber'],"");
  $users = array();
  foreach($Nodes as $n){
   $mobile = Mobiles::find('first',array(
    'conditions'=>array('mcaNumber'=>(string)$n['mcaNumber'])
   ));
   if($n[$yyyymm]["GrossPV"]>4000){
    array_push($users,
     array(
      'mcaNumber'=>$n['mcaNumber'],
      'mcaName'=>$n['mcaName'],
      'PV'=>$n[$yyyymm]['PV']?:0,
      'GPV'=>$n[$yyyymm]['GPV']?:0,
      'PGPV'=>$n[$yyyymm]['PGPV']?:0,
      'RollUpPV'=>$n[$yyyymm]['RollUpPV']?:0,
      'PaidTitle'=>$n[$yyyymm]['PaidTitle']?:"",
      'ValidTitle'=>$n[$yyyymm]['ValidTitle']?:"",      
      'Region'=>$n['Zone'].'-'.$n['City']?:"",
      'Mobile'=>$mobile['Mobile']?:"",
      'Level'=>$n[$yyyymm]['Level']?:"",
      'Legs'=>$n[$yyyymm]['Legs']?:0,
      'QDLegs'=>$n[$yyyymm]['QDLegs']?:0,
     )
    );
   }
  }
  return $this->render(array('json' => array("success"=>"Yes","users"=>$users)));  

 }
 
}

public function getqualified(){

 ini_set('memory_limit', '-1');
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $yyyymm = date('Y-m');  
  $dashboard = new DashboardController();
  $Nodes = $dashboard->getChilds($this->request->data['mcaNumber'],"");
  $users = array();
  foreach($Nodes as $n){
   $mobile = Mobiles::find('first',array(
    'conditions'=>array('mcaNumber'=>(string)$n['mcaNumber'])
   ));
   if($n[$yyyymm]["PGPV"]>1){
    if(strpos($n[$yyyymm]["PaidTitle"],"Non")!==false){}else{
    array_push($users,
     array(
      'mcaNumber'=>$n['mcaNumber'],
      'mcaName'=>$n['mcaName'],
      'PV'=>$n[$yyyymm]['PV']?:0,
      'GPV'=>$n[$yyyymm]['GPV']?:0,
      'PGPV'=>$n[$yyyymm]['PGPV']?:0,
      'RollUpPV'=>$n[$yyyymm]['RollUpPV']?:0,
      'PaidTitle'=>$n[$yyyymm]['PaidTitle']?:"",
      'Region'=>$n['Zone'].'-'.$n['City']?:"",
      'Mobile'=>$mobile['Mobile']?:"",
      'Level'=>$n[$yyyymm]['Level']?:"",
      'Legs'=>$n[$yyyymm]['Legs']?:0,
      'QDLegs'=>$n[$yyyymm]['QDLegs']?:0,
     )
    );
    }
   }
  }
  return $this->render(array('json' => array("success"=>"Yes","users"=>$users)));  

 }
 
}


public function blankmobile(){
 $mobiles = Mobiles::find('all',array(
  'conditions' => array('Mobile'=>array('$ne'=>null))
 ));
 
 $mob = array();
 foreach ($mobiles as $m){
  array_push($mob,$m['mcaNumber']);
 }
 //print_r($mob);
 $yyyymm = date('Y-m');  
 $pyyyymm = date('Y-m', strtotime('first day of last month'));
 $pendingmobiles = Users::find('all',array(
  'conditions'=>array(
   'mcaNumber'=>array('$nin'=>$mob),
   'Enable'=>'Yes',
//   $pyyyymm.'.PV'=>array('$gt'=>0)
  )
 ));
 
 return compact('pendingmobiles');
 
 
 
}

public function getgroups(){
ini_set('memory_limit', '-1');
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
  $left = $user['left'];
  $right = $user['right'];
  // print_r('left'.$left);
  // print_r('right'.$right);
  $yyyymm = date('Y-m');  
  $pyyyymm = date('Y-m', strtotime('first day of last month'));
   
 
   $groups = array(
    'Consultant'=>array('GPV'=>0,'Level'=>7),
    'Senior Consultant'=>array('GPV'=>300,'Level'=>10),
    'Deputy Supervisor'=>array('GPV'=>1200,'Level'=>13),
    'Supervisor'=>array('GPV'=>2700,'Level'=>15),
    'Director'=>array('GPV'=>4000,'Level'=>16,'PGBV'=>1250,'Legs'=>0),
    'Senior Director'=>array('GPV'=>4000,'Level'=>16,'PGBV'=>1100,'Legs'=>1),
    'Execuive Director'=>array('GPV'=>4000,'Level'=>16,'PGBV'=>900,'Legs'=>2),
    'Senior Executive Direc'=>array('GPV'=>4000,'Level'=>16,'PGBV'=>600,'Legs'=>3),
    'Platinum Director'=>array('GPV'=>4000,'Level'=>16,'PGBV'=>300,'Legs'=>4),
    'Presidential Director'=>array('GPV'=>4000,'Level'=>16,'PGBV'=>0,'Legs'=>6),
    'Crown Diamond Director'=>array('GPV'=>4000,'Level'=>16,'PGBV'=>0,'Legs'=>8),
    'Royal Black Diamond Director'=>array('GPV'=>4000,'Level'=>16,'PGBV'=>0,'Legs'=>11),
    'Global Black Diamong Director'=>array('GPV'=>4000,'Level'=>16,'PGBV'=>0,'Legs'=>14),
   );

  foreach ($groups as $key=>$val){
   $countUser = Users::count(
    array(
     $yyyymm.'.ValidTitle'=>$key,
     'left'=>array('$gt'=>$left),
     'right'=>array('$lt'=>$right),
     'Enable'=>'Yes'
    ));

    $MyUsers = array();    
    $ListUsers = Users::find('all',array(
     'conditions'=>array(
       $yyyymm.'.ValidTitle'=>$key,
      'left'=>array('$gt'=>$left),
      'right'=>array('$lt'=>$right),
      'Enable'=>'Yes'
     ),
     'order'=>array('mcaName'=>'ASC')
    ));
    foreach($ListUsers as $lu){
      array_push($MyUsers,array(
       'mcaNumber'=>$lu['mcaNumber'],
       'mcaName'=>$lu['mcaName'],
       'PV'=>$lu[$yyyymm]['PV']?:0,
       'PPV'=>$lu[$pyyyymm]['PV']?:0,
       'Level'=>$lu['Level']?:""
       ));
     
    }
   
   array_push($groups[$key], array('Count'=>$countUser,'users'=>$MyUsers));
  }
  

 }
  return $this->render(array('json' => array("success"=>"Yes","groups"=>$groups)));  

}


public function countGroups($mcaNumber){
 return true;
}

public function getkyc(){
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
  
  $left = $user['left'];
  $right = $user['right'];
  $yyyymm = date('Y-m');
  
  $kycUsers = array();
     $conditions=array(
      'left'=>array('$gt'=>$left),
      'right'=>array('$lt'=>$right),
      'Enable'=>'Yes',
      'KYC'=>array('$ne'=>'Approved'),
//      $yyyymm.'.DaysLeft'=>array('$exists'=>true),
      $yyyymm.'.DaysLeft'=>array('$gt'=>0),
     );
//     print_r($conditions);
  $ListUsers = Users::find('all',array(
      'conditions'=>$conditions,
     'order'=>array('DaysLeft'=>'DESC','KYC'=>'DESC','mcaName'=>'ASC')
    ));
//    print_r($ListUsers);
    foreach($ListUsers as $lu){
     $mobile = Mobiles::find('first',array(
      'conditions'=>array('mcaNumber'=>$lu['mcaNumber'])
     ));
      array_push($kycUsers,array(
       'mcaNumber'=>$lu['mcaNumber'],
       'mcaName'=>$lu['mcaName'],
       'PV'=>$lu[$yyyymm]['PV'],
       'DaysLeft'=>$lu[$yyyymm]['DaysLeft'],
       'DateJoin'=>$lu['DateJoin'],
       'KYC'=>$lu['KYC']?:'',
       'Mobile'=>$mobile['Mobile']?:""
       ));
    }
  
  return $this->render(array('json' => array("success"=>"Yes",'count'=>count($kycUsers),'users'=>$kycUsers)));  
 }
 return $this->render(array('json' => array("success"=>"No")));  
}

public function getjoinee(){
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
  
  $left = $user['left'];
  $right = $user['right'];
  $yyyymm = date('Y-m');
  $dateJoin = date('M Y');
  
  $pyyyymm = date('Y-m', strtotime('first day of last month'));
  $joineeUsers = array();
  $joinee = Users::find('all',array('conditions'=>
   array(
      'DateJoin'=>array('like'=>'/'.$dateJoin.'/'),
      'left'=>array('$gt'=>$left),
      'right'=>array('$lt'=>$right),
      'Enable'=>'Yes'
   ),
   'fields'=>array('mcaNumber','mcaName','DateJoin',$yyyymm.'.PV',$yyyymm.'.GPV','KYC','NEFT','ancestors'),
   'order'=>array('DateJoin'=>'ASC')
   )
 );  
  foreach($joinee as $lu){
     $mobile = Mobiles::find('first',array(
      'conditions'=>array('mcaNumber'=>$lu['mcaNumber'])
     ));
  $number = 0;
  
  foreach($lu['ancestors'] as $key=>$val){
   //print_r($val.":".$mcaNumber."\n");
   if($val!=$mcaNumber){
    $number = $number + 1;
    
   }else{
    break;
    $number = 0;
    
   }
  }
  $number = $number + 1;

   //print_r($number."\n");
  // print_r($number);
   $upline = Users::find('first',array(
    'conditions'=>array('mcaNumber'=>(string)$lu['ancestors'][$number])
   ));
//   print_r($upline['mcaName']);

      array_push($joineeUsers,array(
       'mcaNumber'=>$lu['mcaNumber'],
       'mcaName'=>$lu['mcaName'],
       'DateJoin'=>$lu['DateJoin'],
       'KYC'=>$lu['KYC'],
       'NEFT'=>$lu['NEFT'],
       'PV'=>$lu[$yyyymm]['PV']?:'',
       'GPV'=>$lu[$yyyymm]['GPV']?:'',
       'Mobile'=>$mobile['Mobile']?:"",
       'upline'=>$upline['mcaName']?:"self",
       ));
    }
 
  return $this->render(array('json' => array("success"=>"Yes",'yyyymm'=>$yyyymm,'count'=>count($joineeUsers),'users'=>$joineeUsers)));  
 }
 return $this->render(array('json' => array("success"=>"No")));  
}
public function newjoinee($mcaNumber){
 $user = Users::find('first',array(
 'conditions'=>array('mcaNumber'=>$mcaNumber)
 ));
 $template = Templates::find('first',array(
 'conditions'=>array('Title'=>'New Joinee')
 ));
 return $this->render(array('json' => array("success"=>"Yes","user"=>$user,'template'=>$template)));  
 
}


public function savecontacts(){
 if($this->request->data){
  $data = array(
   'mcaNumber'=>$this->request->data['mcaNumber'],
   'mcaName'=>$this->request->data['mcaName'],
   'contacts'=>json_decode(str_replace("undefined","O",$this->request->data['contacts']))
  );
  $user = Contacts::find('first',array(
   'conditions'=>array('mcaNumber'=>$this->request->data['mcaNumber'])
  ));
  if(count($user)==0){
    Contacts::create()->save($data);
  }
 }
 return $this->render(array('json' => array("success"=>"Yes")));  
}

public function getTools(){
 ini_set('memory_limit','-1');
 $tools = Tools::find('all', array(
   'order'=>array(
    'Category'=>'ASC',
   // 'URL'=>'DESC'
   )
 ));
 
 $alltools = array();
 foreach($tools as $t){
  $data = array(
   'category'=>$t['Category'],
   'category_'=> str_replace("-","_",str_replace(" ","_",$t['Category'])),
  );
  $allparams = array();
  foreach($t['Params'] as $p){
   if($p['Type']=='url'){
    $dataParam = array(
     'url'=>$p['URL'],
     'caption'=>$p['Caption']
    );
   }elseif($p['Type']=='html'){
    $dataParam = array(
     'html'=>'<iframe src="'.$p['URL'].'" frameborder="0" allowfullscreen></iframe>',
     'caption'=>$p['Caption']
    );
   }
   array_push($allparams,$dataParam);
  }
  array_push($alltools,array(
   'category'=>$data,
   'photos'=>$allparams
  ));
 }
 return $this->render(array('json' => array("success"=>"Yes",'tools'=>$alltools)));  
}

public function getproductsimages(){
  $CategoriesArray = array(
    'HC' => 'Home Care',
    'LC' => 'Laundry Care',
    'PC' => 'Personal Care',
    'FP' => 'Food & Beverages',
    'SC' => 'Skin Care',
    'FS' => 'Food Supplement',
    'MJ' => 'Jewelery',
    'UC' => 'Cosmetics - Urban Color',
    'BC' => 'Baby Care',
    'AG' => 'Agriculture',
    'AC' => 'Auto Care',
    'HL' => 'Wellness',
    '00' => 'Others',
    '60' => 'Extra',
    );
 
 $allproducts = array();
 foreach($CategoriesArray as $key=>$val){
  $Code = $key;
  //print_r($Code);
  $data = array(
   'category'=>$val,
   'category_'=> str_replace("-","_",str_replace(" ","_",$val)),
  );
  
  
  $products = Malls::find('all',array(
   'conditions'=>array('Code'=> array('like'=>'/^'.$Code.'/')),
  ));
  $allparams = array();
    foreach($products as $p){
      $dataParam = array(
       'url'=>'https://sff.team/img/products/'. $p['Code'].'.jpg',
       'caption'=> ' <span class="text-color-yellow"> &nbsp;'.$val.'&nbsp; </span><br>'.$p['Name'].' <br>['.$p['Code'].'] <span class="text-color-red">MRP: <strike>'.number_format($p['MRP'],2).'</strike></span> <span class="text-color-green">DP: '.number_format($p['DP'],2).' PV: '.number_format($p['PV'],2).'</span> <span class="text-color-blue">'.number_format($p['BV']/$p['DP']*100,0).'%</span>',
      );
     array_push($allparams,$dataParam);
    
    }
  
  array_push($allproducts,array(
   'category'=>$data,
   'photos'=>$allparams
  ));
  
 }
 
 return $this->render(array('json' => array("success"=>"Yes",'products'=>$allproducts)));  
}

function getnotactive(){
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
  
  $left = $user['left'];
  $right = $user['right'];
  $pyyyymm = date('Y-m', strtotime('first day of last month'));

  $conditions = array(
   'left'=>array('$gt'=>$left),
   'right'=>array('$lt'=>$right),
   $pyyyymm.'.InActive'=>null,
   'Enable'=>'Yes'
  ); 

  
  $notactive = Users::find('all',array(
   'conditions'=>$conditions,
   'fields'=>array('mcaNumber','mcaName','DateJoin',$pyyyymm.'.InActive','KYC'),
   'order'=>array($pyyyymm.'.InActive'=>'ASC')
   )
  );
  $allusers = array();
  $month = "6";
  $alldata = array();
  
  foreach($notactive as $na){
   $mobile = Mobiles::find('first',array(
     'conditions'=>array('mcaNumber'=>$na['mcaNumber']),
     'fields'=>array('Mobile','mcaNumber'),
   ));
    $users = array(
      'DateJoin'=>$na['DateJoin'],
      'mcaName'=>$na['mcaName'],
      'mcaNumber'=>$na['mcaNumber'],
      'InActive'=>$na[$pyyyymm]['InActive'],
      'KYC'=>$na['KYC'],
      'Mobile'=>$mobile['Mobile']?:"",
    );
    array_push($alldata,$users);
     if($month!=$na[$pyyyymm]['InActive']){
      array_push ($allusers ,array($month=>$alldata));
      $month = $na[$pyyyymm]['InActive'];
      $alldata = array();  
     }
    
  }
  array_push($allusers,$alldata);
 }
 return $this->render(array('json' => array("success"=>"Yes",'allusers'=>$allusers)));  
}

public function uploadevents(){
 
// "Event Date","Event Time","Category","Venue & Address","City","State","Contact No","Event Presenter"
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
         'EventDate' => (string)$data[0],
         'Date'=>strtotime((string)$data[0]),
         'EventTime' => (string)$data[1],        
         'EventCategories' => (string)$data[2],
         'Venue' => (string)$data[3],        
         'City' => (string)$data[4], 
         'State' => (string)$data[5],
         'Contact' => (string)$data[6],
         'Presenter' => (string)$data[7],        
        );
//        print_r($data);
       Events::create()->save($data);
      }
   }
  }
 //return $this->render(array('json' => array("success"=>"Yes")));  
}


public function getevents(){
 $order = $this->request->data['order'];
 $today =  strtotime(gmdate('Y-M-d',time()-84600));

 $conditions = array('Date'=>array('$gte'=>$today));
 if($order=="Date"){
   $orderCondition = array('Date'=>'ASC');
 }else if($order=="City"){
   $orderCondition = array('City'=>'ASC');
 }else if($order == "Leader"){
   $orderCondition = array('Presenter'=>'ASC');
 }else{
  $orderCondition = array('Date'=>'ASC','EventTime'=>'ASC','City'=>'ASC');
 }
 
 $events = Events::find('all',array(
  'conditions'=>$conditions,
  'order'=>$orderCondition
 ));
 
 return $this->render(array('json' => array("success"=>"Yes",'events'=>$events,'order'=>$order,'con'=>$orderCondition)));  
}


public function getdistributors(){
 $chars = $this->request->data['chars'] ;
 $distributorsAddress = Distributors::find('all',array(
  'conditions'=> array(
    'Address'=> array('like'=>'/'.$chars.'/i'),
    ),
  'order'=>array('Name'=>'ASC')
 ));
  return $this->render(array('json' => array("success"=>"Yes",'distributors'=>$distributorsAddress)));  
}


public function getp2p($code=null){
  $audios = Audios::find('first',array(
   'order'=>array('Params.Code'=>'ASC')
  ));
  $allaudios = array();
//  print_r($audios);
  foreach($audios['Params'] as $a){
   
   $Code = $a['Code'];
   $product = Malls::find('first',array(
    'conditions'=>array('Code'=>$Code)
   ));
   array_push($allaudios , array(
    'Code'=>$a['Code'],
    'MRP'=>$product['MRP'],
    'DP'=>$product['DP'],
    'BV'=>$product['BV'],
    'PV'=>$product['PV'],
    'Name'=>$product['Name'],
    'Caption'=>$a['Caption'],
    'Image'=>$a['Image'],
    'URL'=>$a['URL'],
   ));
  }
  if($code==null){
   return $this->render(array('json' => array("success"=>"Yes",'audios'=>$allaudios)));  
  }else{  
   return compact('allaudios','code');
  }
}

public function getpdfs(){
 $pdfs = Pdfs::find('all',array(
  'order'=>array('Language'=>'ASC','Name'=>'ASC')
 ));
 
  return $this->render(array('json' => array("success"=>"Yes",'pdfs'=>$pdfs)));  
}

public function pdf($Code,$format=null){
  $pdf = Pdfs::find('first',array(
   'conditions'=>array('_id'=> (string)$Code)
  ));
  if($format=="pdf"){
   
   return compact('pdf');
  }
 return $this->render(array('json' => array("success"=>"Yes","pdf"=>$pdf)));  
}

public function gettemplates(){
 $templates = Templates::find('all',array(
  'order'=>array('Title'=>'ASC')
 ));
 
  return $this->render(array('json' => array("success"=>"Yes",'templates'=>$templates)));  
}

public function template($format=null){
  $Code = $this->request->data['code'];
  $mcaNumber = $this->request->data['mcaNumber'];
  $template = Templates::find('first',array(
   'conditions'=>array('_id'=> (string)$Code)
  ));
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=> (string)$mcaNumber)
  ));
  
 return $this->render(array('json' => array("success"=>"Yes","template"=>$template,'user'=>$user)));  
}

public function getdown(){
 ini_set('memory_limit', '-1');
 $mcaNumber = $this->request->data['mcaNumber'] ; 
 $dashboard = new DashboardController();
 $Nodes = $dashboard->getChilds($this->request->data['mcaNumber'],""); 
 
 $yyyymm = date('Y-m');
 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
 $p2yyyymm = date("Y-m", strtotime("-2 month", strtotime(date("F") . "1")) );
 $p3yyyymm = date("Y-m", strtotime("-3 month", strtotime(date("F") . "1")) );
 $p4yyyymm = date("Y-m", strtotime("-4 month", strtotime(date("F") . "1")) );
 $p5yyyymm = date("Y-m", strtotime("-5 month", strtotime(date("F") . "1")) );
 $p6yyyymm = date("Y-m", strtotime("-6 month", strtotime(date("F") . "1")) );
 $p7yyyymm = date("Y-m", strtotime("-7 month", strtotime(date("F") . "1")) );
 $p8yyyymm = date("Y-m", strtotime("-8 month", strtotime(date("F") . "1")) );
 $p9yyyymm = date("Y-m", strtotime("-9 month", strtotime(date("F") . "1")) );
 $p10yyyymm = date("Y-m", strtotime("-10 month", strtotime(date("F") . "1")) );
 $p11yyyymm = date("Y-m", strtotime("-11 month", strtotime(date("F") . "1")) );

 $allusers = array();

 foreach ($Nodes as $n){
   if($n[$yyyymm]['PV'] < $n[$p1yyyymm]['PV']){
    $mobile = Mobiles::find('first',array(
     'conditions'=>array('mcaNumber'=>$n['mcaNumber'])
    ));

  $number = 0;
  foreach($n['ancestors'] as $key=>$val){
     // print_r($val.":".$mcaNumber."\n");
   if($val!=$mcaNumber){
    $number = $number + 1;
    
   }else{
    break;
    $number = 0;
    
   }
  }
  $number = $number + 1;

  // print_r($number."\n");
  // print_r($number);
   $upline = Users::find('first',array(
    'conditions'=>array('mcaNumber'=>(string)$n['ancestors'][$number])
   ));


    array_push($allusers,array(
     'mcaNumber'=>$n['mcaNumber'],
     'mcaName'=>$n['mcaName'],
     'mobile'=>$mobile['Mobile']?:"",
     $yyyymm."" => array('PV'=>$n[$yyyymm]['PV']?:0,'GPV'=>$n[$yyyymm]['GPV']?:0),
     $p1yyyymm."" => array('PV'=>$n[$p1yyyymm]['PV']?:0,'GPV'=>$n[$p1yyyymm]['GPV']?:0),
     $p2yyyymm."" => array('PV'=>$n[$p2yyyymm]['PV']?:0,'GPV'=>$n[$p2yyyymm]['GPV']?:0),
     $p3yyyymm."" => array('PV'=>$n[$p3yyyymm]['PV']?:0,'GPV'=>$n[$p3yyyymm]['GPV']?:0),
     $p4yyyymm."" => array('PV'=>$n[$p4yyyymm]['PV']?:0,'GPV'=>$n[$p4yyyymm]['GPV']?:0),
     $p5yyyymm."" => array('PV'=>$n[$p5yyyymm]['PV']?:0,'GPV'=>$n[$p5yyyymm]['GPV']?:0),
     $p6yyyymm."" => array('PV'=>$n[$p6yyyymm]['PV']?:0,'GPV'=>$n[$p6yyyymm]['GPV']?:0),
     $p7yyyymm."" => array('PV'=>$n[$p7yyyymm]['PV']?:0,'GPV'=>$n[$p7yyyymm]['GPV']?:0),
     $p8yyyymm."" => array('PV'=>$n[$p8yyyymm]['PV']?:0,'GPV'=>$n[$p8yyyymm]['GPV']?:0),
     $p9yyyymm."" => array('PV'=>$n[$p9yyyymm]['PV']?:0,'GPV'=>$n[$p9yyyymm]['GPV']?:0),
     $p10yyyymm."" => array('PV'=>$n[$p10yyyymm]['PV']?:0,'GPV'=>$n[$p10yyyymm]['GPV']?:0),
     $p11yyyymm."" => array('PV'=>$n[$p11yyyymm]['PV']?:0,'GPV'=>$n[$p11yyyymm]['GPV']?:0),
     'upline'=>$upline['mcaName']?:"self",
    ));
   }
 }
 return $this->render(array('json' => array("success"=>"Yes",'count'=>count($allusers),"users"=>$allusers)));  
}

public function findzero($mcaNumber){
 ini_set('memory_limit', '-1');
 $dashboard = new DashboardController();
 $Nodes = $dashboard->getChildsZero($mcaNumber); 
 return $Nodes;  
}


public function getzero(){
 ini_set('memory_limit', '-1');
 $mcaNumber = $this->request->data['mcaNumber'] ; 
 $dashboard = new DashboardController();
 $Nodes = $dashboard->getChilds($this->request->data['mcaNumber'],""); 
 
 $yyyymm = date('Y-m');
 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
 $p2yyyymm = date("Y-m", strtotime("-2 month", strtotime(date("F") . "1")) );
 $p3yyyymm = date("Y-m", strtotime("-3 month", strtotime(date("F") . "1")) );
 $p4yyyymm = date("Y-m", strtotime("-4 month", strtotime(date("F") . "1")) );
 $p5yyyymm = date("Y-m", strtotime("-5 month", strtotime(date("F") . "1")) );
 $p6yyyymm = date("Y-m", strtotime("-6 month", strtotime(date("F") . "1")) );
 $p7yyyymm = date("Y-m", strtotime("-7 month", strtotime(date("F") . "1")) );
 $p8yyyymm = date("Y-m", strtotime("-8 month", strtotime(date("F") . "1")) );
 $p9yyyymm = date("Y-m", strtotime("-9 month", strtotime(date("F") . "1")) );
 $p10yyyymm = date("Y-m", strtotime("-10 month", strtotime(date("F") . "1")) );
 $p11yyyymm = date("Y-m", strtotime("-11 month", strtotime(date("F") . "1")) );

 $allusers = array();

 foreach ($Nodes as $n){
   if($n[$yyyymm]['PV'] == 0 && $n[$p1yyyymm]['PV'] > 0){
    $mobile = Mobiles::find('first',array(
     'conditions'=>array('mcaNumber'=>$n['mcaNumber'])
    ));

  $number = 0;
  foreach($n['ancestors'] as $key=>$val){
     // print_r($val.":".$mcaNumber."\n");
   if($val!=$mcaNumber){
    $number = $number + 1;
    
   }else{
    break;
    $number = 0;
    
   }
  }
  $number = $number + 1;

  // print_r($number."\n");
  // print_r($number);
   $upline = Users::find('first',array(
    'conditions'=>array('mcaNumber'=>(string)$n['ancestors'][$number])
   ));



    array_push($allusers,array(
     'mcaNumber'=>$n['mcaNumber'],
     'mcaName'=>$n['mcaName'],
     'mobile'=>$mobile['Mobile']?:"",
     $yyyymm."" => array('PV'=>$n[$yyyymm]['PV']?:0,'GPV'=>$n[$yyyymm]['GPV']?:0),
     $p1yyyymm."" => array('PV'=>$n[$p1yyyymm]['PV']?:0,'GPV'=>$n[$p1yyyymm]['GPV']?:0),
     $p2yyyymm."" => array('PV'=>$n[$p2yyyymm]['PV']?:0,'GPV'=>$n[$p2yyyymm]['GPV']?:0),
     $p3yyyymm."" => array('PV'=>$n[$p3yyyymm]['PV']?:0,'GPV'=>$n[$p3yyyymm]['GPV']?:0),
     $p4yyyymm."" => array('PV'=>$n[$p4yyyymm]['PV']?:0,'GPV'=>$n[$p4yyyymm]['GPV']?:0),
     $p5yyyymm."" => array('PV'=>$n[$p5yyyymm]['PV']?:0,'GPV'=>$n[$p5yyyymm]['GPV']?:0),
     $p6yyyymm."" => array('PV'=>$n[$p6yyyymm]['PV']?:0,'GPV'=>$n[$p6yyyymm]['GPV']?:0),
     $p7yyyymm."" => array('PV'=>$n[$p7yyyymm]['PV']?:0,'GPV'=>$n[$p7yyyymm]['GPV']?:0),
     $p8yyyymm."" => array('PV'=>$n[$p8yyyymm]['PV']?:0,'GPV'=>$n[$p8yyyymm]['GPV']?:0),
     $p9yyyymm."" => array('PV'=>$n[$p9yyyymm]['PV']?:0,'GPV'=>$n[$p9yyyymm]['GPV']?:0),
     $p10yyyymm."" => array('PV'=>$n[$p10yyyymm]['PV']?:0,'GPV'=>$n[$p10yyyymm]['GPV']?:0),
     $p11yyyymm."" => array('PV'=>$n[$p11yyyymm]['PV']?:0,'GPV'=>$n[$p11yyyymm]['GPV']?:0),
     'upline'=>$upline['mcaName']?:"self",
    ));
   }
 }
 return $this->render(array('json' => array("success"=>"Yes",'count'=>count($allusers),"users"=>$allusers)));  
}


public function getup(){
 ini_set('memory_limit', '-1');
 $mcaNumber = $this->request->data['mcaNumber'] ; 
 $dashboard = new DashboardController();
 $Nodes = $dashboard->getChilds($this->request->data['mcaNumber'],""); 
 
 $yyyymm = date('Y-m');
 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
 $p2yyyymm = date("Y-m", strtotime("-2 month", strtotime(date("F") . "1")) );
 $p3yyyymm = date("Y-m", strtotime("-3 month", strtotime(date("F") . "1")) );
 $p4yyyymm = date("Y-m", strtotime("-4 month", strtotime(date("F") . "1")) );
 $p5yyyymm = date("Y-m", strtotime("-5 month", strtotime(date("F") . "1")) );
 $p6yyyymm = date("Y-m", strtotime("-6 month", strtotime(date("F") . "1")) );
 $p7yyyymm = date("Y-m", strtotime("-7 month", strtotime(date("F") . "1")) );
 $p8yyyymm = date("Y-m", strtotime("-8 month", strtotime(date("F") . "1")) );
 $p9yyyymm = date("Y-m", strtotime("-9 month", strtotime(date("F") . "1")) );
 $p10yyyymm = date("Y-m", strtotime("-10 month", strtotime(date("F") . "1")) );
 $p11yyyymm = date("Y-m", strtotime("-11 month", strtotime(date("F") . "1")) );

 $allusers = array();

 foreach ($Nodes as $n){
  if($n[$yyyymm]['PV'] > 0 || $n[$p1yyyymm]['PV'] >0 ){
   if($n[$yyyymm]['PV'] >= $n[$p1yyyymm]['PV'] ){
    $mobile = Mobiles::find('first',array(
     'conditions'=>array('mcaNumber'=>$n['mcaNumber'])
    ));
  $number = 0;
  foreach($n['ancestors'] as $key=>$val){
     // print_r($val.":".$mcaNumber."\n");
   if($val!=$mcaNumber){
    $number = $number + 1;
    
   }else{
    break;
    $number = 0;
    
   }
  }
  $number = $number + 1;

  // print_r($number."\n");
  // print_r($number);
   $upline = Users::find('first',array(
    'conditions'=>array('mcaNumber'=>(string)$n['ancestors'][$number])
   ));


    array_push($allusers,array(
     'mcaNumber'=>$n['mcaNumber'],
     'mcaName'=>$n['mcaName'],
     'mobile'=>$mobile['Mobile']?:"",
     $yyyymm."" => array('PV'=>$n[$yyyymm]['PV']?:0,'GPV'=>$n[$yyyymm]['GPV']?:0),
     $p1yyyymm."" => array('PV'=>$n[$p1yyyymm]['PV']?:0,'GPV'=>$n[$p1yyyymm]['GPV']?:0),
     $p2yyyymm."" => array('PV'=>$n[$p2yyyymm]['PV']?:0,'GPV'=>$n[$p2yyyymm]['GPV']?:0),
     $p3yyyymm."" => array('PV'=>$n[$p3yyyymm]['PV']?:0,'GPV'=>$n[$p3yyyymm]['GPV']?:0),
     $p4yyyymm."" => array('PV'=>$n[$p4yyyymm]['PV']?:0,'GPV'=>$n[$p4yyyymm]['GPV']?:0),
     $p5yyyymm."" => array('PV'=>$n[$p5yyyymm]['PV']?:0,'GPV'=>$n[$p5yyyymm]['GPV']?:0),
     $p6yyyymm."" => array('PV'=>$n[$p6yyyymm]['PV']?:0,'GPV'=>$n[$p6yyyymm]['GPV']?:0),
     $p7yyyymm."" => array('PV'=>$n[$p7yyyymm]['PV']?:0,'GPV'=>$n[$p7yyyymm]['GPV']?:0),
     $p8yyyymm."" => array('PV'=>$n[$p8yyyymm]['PV']?:0,'GPV'=>$n[$p8yyyymm]['GPV']?:0),
     $p9yyyymm."" => array('PV'=>$n[$p9yyyymm]['PV']?:0,'GPV'=>$n[$p9yyyymm]['GPV']?:0),
     $p10yyyymm."" => array('PV'=>$n[$p10yyyymm]['PV']?:0,'GPV'=>$n[$p10yyyymm]['GPV']?:0),
     $p11yyyymm."" => array('PV'=>$n[$p11yyyymm]['PV']?:0,'GPV'=>$n[$p11yyyymm]['GPV']?:0),
     'upline'=>$upline['mcaName']?:"self",
    ));
   }
  }
 }
 
 return $this->render(array('json' => array("success"=>"Yes",'count'=>count($allusers),"users"=>$allusers)));  
}

public function pvdown($mcaNumber){
 $user = Users::find('first',array(
 'conditions'=>array('mcaNumber'=>$mcaNumber)
 ));
 $template = Templates::find('first',array(
 'conditions'=>array('Title'=>'PV Down')
 ));
 return $this->render(array('json' => array("success"=>"Yes","user"=>$user,'template'=>$template)));  
}
public function pvup($mcaNumber){
 $user = Users::find('first',array(
 'conditions'=>array('mcaNumber'=>$mcaNumber)
 ));
 $template = Templates::find('first',array(
  'conditions'=>array('Title'=>'PV Up')
 ));
 return $this->render(array('json' => array("success"=>"Yes","user"=>$user,'template'=>$template)));  
}


public function setlist(){
 $mcaNumber = $this->request->data['mcaNumber']; ;
 $list = $this->request->data['list'];
 $whoami = $this->request->data['whoami'];

 $conditions = array(
  'mcaNumber'=>(string)$mcaNumber,
  'list'=>(string)$list,
  'whoami'=>(string)$whoami
 );
 
 $users = Lists::find('first',array(
  'conditions'=>$conditions
 ));
 
 if(count($users)==0){
  $data = array(
  'mcaNumber'=>(string)$mcaNumber,
  'list'=>(string)$list,
  'whoami'=>(string)$whoami,
  'member'=>"Yes"
 );
  Lists::create()->save($data);
 }else{
   if($users['member']=="Yes"){
    $data = array('member'=>"No");
   }else{
    $data = array('member'=>"Yes");
   }
  Lists::update($data,$conditions);
 }
 return $this->render(array('json' => array("success"=>"Yes","user"=>$data)));  
}


public function loguser(){
  $mcaName = $this->request->data['mcaName'];
  $mcaNumber = $this->request->data['mcaNumber'];
 
 $data = array(
  'mcaName'=>$mcaName,
  'mcaNumber'=>$mcaNumber,
  'DateTime'=> new \MongoDate
 );
 Logs::create()->save($data);
 return $this->render(array('json' => array("success"=>"Yes")));  
}


function array2csv(array &$array)
{
   if (count($array) == 0) {
     return null;
   }
   ob_start();
   $df = fopen("php://output", 'w');
   fputcsv($df, array_keys(reset($array)));
   foreach ($array as $row) {
      fputcsv($df, $row);
   }
   fclose($df);
   return ob_get_clean();
}


public function getlevel(){
 ini_set('memory_limit','-1');
 $mcaNumber = $this->request->data['mcaNumber'];
 $gpv =  $this->request->data['gpv'];
 $lpv =  $this->request->data['lpv'];
 $yyyymm = date('Y-m'); 
 $pyyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );

 $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
 ));
 
 $left = $user['left'];
 $right = $user['right'];
 $conditions = array(
   'left'=>array('$gt'=>$left),
   'right'=>array('$lt'=>$right),
   'Enable'=>'Yes',
   $yyyymm.'.GrossPV'=>array('$gte'=>(integer)$gpv,'$lt'=>(integer)$lpv),
   $yyyymm.'.Percent'=>array('$lt'=>(integer)16),
 );

 $users = Users::find('all',array(
  'conditions'=>$conditions,
  'order'=>array($yyyymm.'.GrossPV'=>'DESC',$pyyyymm.'.GrossPV'=>'DESC')
 ));
 $allusers = array();

 foreach($users as $u){
  $mobile = Mobiles::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$u['mcaNumber'])
 ));

 $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$u['mcaNumber'])
 ));
 
 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
  
  $number = 0;
  foreach($user['ancestors'] as $key=>$val){
   // print_r($val.":".$mcaNumber."\n");
   if($val!=$mcaNumber){
    $number = $number + 1;
    
   }else{
    break;
    $number = 0;
    
   }
  }
  $number = $number + 1;

  // print_r($number."\n");
  // print_r($number);
   $upline = Users::find('first',array(
    'conditions'=>array('mcaNumber'=>(string)$user['ancestors'][$number])
   ));

 
  array_push($allusers, array(
   'mcaNumber' => $u['mcaNumber'],
   'mcaName' => $u['mcaName'],
   'GrossPV'=>$u[$yyyymm]['GrossPV'],
   'PV'=>$u[$pyyyymm]['PV'],
   'mobile'=>$mobile['Mobile']?:"",
   'LevelUp'=>((integer)$lpv-(integer)$u[$yyyymm]['GrossPV']),
   'yyyymm'=>$yyyymm,
   'upline'=>$upline['mcaName']?:"self",
   ));
  }
  
  
 
 
 
  
  
 return $this->render(array('json' => array("success"=>"Yes","count"=>count($users),"users"=>$allusers,'tree'=>$tree[1])));
}

public function levelup($mcaNumber){
 $user = Users::find('first',array(
 'conditions'=>array('mcaNumber'=>$mcaNumber)
 ));
 $template = Templates::find('first',array(
 'conditions'=>array('Title'=>'Level Up')
 ));
 return $this->render(array('json' => array("success"=>"Yes","user"=>$user,'template'=>$template)));  
 
}

public function getswipers(){
 ini_set('memory_limit','-1');
 $dir    = LITHIUM_APP_PATH . '/webroot/img/swiper';
 $files = scandir($dir);
 $mcaNumber = $this->request->data['mcaNumber'];
 $yyyymm = date('Y-m'); 
 $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
 ));
 $left = $user['left'];
 $right = $user['right'];
 
 
 $conditions = array(
   'left'=>array('$gt'=>$left),
   'right'=>array('$lt'=>$right),
   'Enable'=>'Yes',
   $yyyymm.'.PV'=>array('$gte'=>0),
  );
 $users = Users::find('all',array(
  'conditions'=>$conditions,
  'order'=>array($yyyymm.'.PV'=>'DESC')
 ));
 
 $allusers = array();
 // array_push($allusers,array(
  // 'mcaNumber'=>'00000000',
  // 'image'=>'00000000.jpg',
  // 'mcaName'=>'Buy Save Earn, More',
  // 'ValidTitle'=>'Buy Save Earn, More'
 // ));
 if(in_array($user['mcaNumber'].'.jpg',$files)){
  array_push($allusers,array(
   'mcaNumber'=>$user['mcaNumber'],
   'image'=>$user['mcaNumber'].'.jpg',
   'mcaName'=>$user['mcaName'],
   'ValidTitle'=>$user[$yyyymm]['ValidTitle']
  ));
 }
 $ancestors = $user['ancestors'];
 foreach($ancestors as $a){
  if(in_array($a.'.jpg',$files)){
   $upline = Users::find('first',array(
    'conditions'=>array('mcaNumber'=>$a)
   ));
  array_push($allusers,array(
   'mcaNumber'=>$upline['mcaNumber'],
   'image'=>$upline['mcaNumber'].'.jpg',
   'mcaName'=>$upline['mcaName'],
   'ValidTitle'=>$upline[$yyyymm]['ValidTitle']
  ));
  }
 }
 
 foreach($users as $u){
  if(in_array($u['mcaNumber'].'.jpg',$files)){
  array_push($allusers,array(
   'mcaNumber'=>$u['mcaNumber'],
   'image'=>$u['mcaNumber'].'.jpg',
   'mcaName'=>$u['mcaName'],
   'ValidTitle'=>$u[$yyyymm]['ValidTitle']
  ));
  }
 }
 
 return $this->render(array('json' => array("success"=>"Yes",'users'=>$allusers)));  
}


function yyyymmpv(){
ini_set('memory_limit','-1'); 
 
 $mcaNumber = $this->request->data['mcaNumber'];
 $yyyymm = date('Y-m'); 
 $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
 ));
 $left = $user['left'];
 $right = $user['right'];
 
 $conditions = array(
   'left'=>array('$gt'=>$left),
   'right'=>array('$lt'=>$right),
   'Enable'=>'Yes',
  );
 $users = Users::find('all',array(
  'conditions'=>$conditions,
 ));
 
 $joinMonth = array();
foreach ($users as $u){
 
 
  if(!in_array(substr($u['DateJoin'],-8),$joinMonth )){
   array_push($joinMonth, 
    substr($u['DateJoin'],-8));
  }
}
foreach ($users as $u){
 
}


 
 return $this->render(array('json' => array("success"=>"Yes",'users'=>$joinMonth)));  
}

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}


public function getregion(){
 ini_set('memory_limit','-1'); 

 $mcaNumber = $this->request->data['mcaNumber'];
 $region = $this->request->data['region'];
 $yyyymm = date('Y-m'); 
 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
 $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
 ));
 $left = $user['left'];
 $right = $user['right'];
 
 $conditions = array(
 'left'=>array('$gt'=>$left),
 'right'=>array('$lt'=>$right),
 'Enable'=>'Yes',
  );
 
 $users = Users::find('all',array(
  'conditions'=>$conditions,
 ));


 $r = "";
 $down = array();
 foreach ($users as $u){
    array_push($down,array(
     'Zone'=>$u['Zone'],
     $u['Zone'].'PBV'=>$u[$p1yyyymm]['BV']?:0,
     $u['Zone'].'BV'=>$u[$yyyymm]['BV']?:0,
     $u['Zone'].'PPV'=>$u[$p1yyyymm]['PV']?:0,
     $u['Zone'].'PV'=>$u[$yyyymm]['PV']?:0,
     $u['Zone'].'ExtraPV'=>$u[$yyyymm]['ExtraPV']?:0,
     $u['Zone'].'PExtraPV'=>$u[$p1yyyymm]['ExtraPV']?:0,
    ));
 }
 
  $u = array_unique(array_column($down, 'Zone'));
  $a = array_count_values(array_column($down,'Zone'));
  
  $Zones = array();
  foreach($a as $key=>$val){
   $bv = array_sum(array_column($down,$key.'BV'));
   $pbv = array_sum(array_column($down,$key.'PBV'));
   $pv = array_sum(array_column($down,$key.'PV'));
   $ppv = array_sum(array_column($down,$key.'PPV'));
   $epv = array_sum(array_column($down,$key.'ExtraPV'));
   $pepv = array_sum(array_column($down,$key.'PExtraPV'));
   array_push($Zones, array(
     $key => array('BV' => $bv, 'PBV' => $pbv,'PV' => $pv, 'PPV' => $ppv,'EPV' => $epv, 'PEPV' => $pepv, 'users'=>$val)
   ));
  }

   $sort = array();
    foreach($Zones as $k=>$v) {
     foreach($v as $kk=>$vv){
      $sort['BV'][$kk] = $vv['BV'];
     }
    }

   array_multisort($sort['BV'], SORT_DESC, $Zones);

 return $this->render(array('json' => array("success"=>"Yes",'param'=>$Zones)));    
}

public function getstate(){
 ini_set('memory_limit','-1'); 

 $mcaNumber = $this->request->data['mcaNumber'];
 $region = $this->request->data['region'];
 $yyyymm = date('Y-m'); 
 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
 $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
 ));
 $left = $user['left'];
 $right = $user['right'];
 $conditions = array(
   'left'=>array('$gt'=>$left),
   'right'=>array('$lt'=>$right),
   'Enable'=>'Yes',
  ) ;
 $users = Users::find('all',array(
  'conditions'=>$conditions,
 ));



 $r = "";
 $down = array();
 foreach ($users as $u){
    array_push($down,array(
     'State'=>$u['State'],
     $u['State'].'PBV'=>$u[$p1yyyymm]['BV'],
     $u['State'].'BV'=>$u[$yyyymm]['BV'],
     $u['State'].'PPV'=>$u[$p1yyyymm]['PV'],
     $u['State'].'PV'=>$u[$yyyymm]['PV'],
     $u['State'].'ExtraPV'=>$u[$yyyymm]['ExtraPV'],
     $u['State'].'PExtraPV'=>$u[$p1yyyymm]['ExtraPV'],
    ));
 }
 

 
  $u = array_unique(array_column($down, 'State'));
  $a = array_count_values(array_column($down,'State'));
  
  
  $Zones = array();
  foreach($a as $key=>$val){
   $bv = array_sum(array_column($down,$key.'BV'));
   $pbv = array_sum(array_column($down,$key.'PBV'));
   $pv = array_sum(array_column($down,$key.'PV'));
   $ppv = array_sum(array_column($down,$key.'PPV'));
   $epv = array_sum(array_column($down,$key.'ExtraPV'));
   $pepv = array_sum(array_column($down,$key.'PExtraPV'));
   array_push($Zones, array(
     $key => array('BV' => $bv, 'PBV' => $pbv, 'PV' => $pv, 'PPV' => $ppv, 'EPV' => $epv, 'PEPV' => $pepv, 'users'=>$val)
   ));
  }

   $sort = array();
    foreach($Zones as $k=>$v) {
     foreach($v as $kk=>$vv){
      $sort['BV'][$kk] = $vv['BV'];
     }
    }
   array_multisort($sort['BV'], SORT_DESC, $Zones);


 return $this->render(array('json' => array("success"=>"Yes",'param'=>$Zones)));    
}


public function getCity(){
 ini_set('memory_limit','-1'); 

 $mcaNumber = $this->request->data['mcaNumber'];
 $region = $this->request->data['region'];
 $yyyymm = date('Y-m'); 
 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
 $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
 ));
 $left = $user['left'];
 $right = $user['right'];
 $conditions = array(
   'left'=>array('$gt'=>$left),
   'right'=>array('$lt'=>$right),
   'Enable'=>'Yes',
  ) ;
  $users = Users::find('all',array(
  'conditions'=>$conditions,
 ));

 $r = "";
 $down = array();
 foreach ($users as $u){
   if($u['State']=="Gujarat" && $u['City']=="Allahabad"){
    array_push($down,array(
     'City'=>'Ahmedabad',
     $u['Ahmedabad'].'PBV'=>$u[$p1yyyymm]['BV'],
     $u['Ahmedabad'].'BV'=>$u[$yyyymm]['BV'],
     $u['Ahmedabad'].'PPV'=>$u[$p1yyyymm]['PV'],
     $u['Ahmedabad'].'PV'=>$u[$yyyymm]['PV'],
     $u['Ahmedabad'].'ExtraPV'=>$u[$yyyymm]['ExtraPV'],
     $u['Ahmedabad'].'PExtraPV'=>$u[$p1yyyymm]['ExtraPV'],
     ));
   }else{
    array_push($down,array(
     'City'=>$u['City'],
     $u['City'].'PBV'=>$u[$p1yyyymm]['BV'],
     $u['City'].'BV'=>$u[$yyyymm]['BV'],
     $u['City'].'PPV'=>$u[$p1yyyymm]['PV'],
     $u['City'].'PV'=>$u[$yyyymm]['PV'],
     $u['City'].'ExtraPV'=>$u[$yyyymm]['ExtraPV'],
     $u['City'].'PExtraPV'=>$u[$p1yyyymm]['ExtraPV'],
    ));
   }
 }
 

 
  $u = array_unique(array_column($down, 'City'));
  $a = array_count_values(array_column($down,'City'));
  
  
  $Zones = array();
  foreach($a as $key=>$val){
   $bv = array_sum(array_column($down,$key.'BV'));
   $pbv = array_sum(array_column($down,$key.'PBV'));
   $pv = array_sum(array_column($down,$key.'PV'));
   $ppv = array_sum(array_column($down,$key.'PPV'));
   $epv = array_sum(array_column($down,$key.'ExtraPV'));
   $pepv = array_sum(array_column($down,$key.'PExtraPV'));
   array_push($Zones, array(
     $key => array('BV' => $bv, 'PBV' => $pbv, 'PV' => $pv, 'PPV' => $ppv, 'EPV' => $epv, 'PEPV' => $pepv, 'users'=>$val)
   ));
  }
   $sort = array();
    foreach($Zones as $k=>$v) {
     foreach($v as $kk=>$vv){
      $sort['BV'][$kk] = $vv['BV'];
     }
    }
   array_multisort($sort['BV'], SORT_DESC, $Zones);

 return $this->render(array('json' => array("success"=>"Yes",'param'=>$Zones)));    
}


public function finduser(){
 ini_set('memory_limit','-1'); 
 $mcaNumber = $this->request->data['mcaNumber'];
 $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
 ));
 $left = $user['left'];
 $right = $user['right'];
 
 $params = split("-",$this->request->data['ZoneStateCity']);
 $yyyymm = date('Y-m'); 

 
 $users = Users::find('all',array(
  'conditions'=>array(
   'Zone'=>$params[0],
   'State'=>$params[1],
   'City'=>$params[2],
   'left'=>array('$gt'=>$left),
   'right'=>array('$lt'=>$right),
   'Enable'=>'Yes',
  ),
  'order'=>array('mcaName'=>'ASC')
 ));
 $allusers = array();
  foreach ($users as $u){
    $mobile = Mobiles::find('first',array(
     'conditions'=>array('mcaNumber'=>$u['mcaNumber'])
    ));
   array_push($allusers,array(
    'mcaNumber'=>$u['mcaNumber'],
    'mcaName'=>$u['mcaName'],
    'refer'=>$u['refer'],
    'Mobile'=>$mobile['Mobile']?:"",
    'Enable'=>$u['Enable'],
    'Level'=>$u['Level'],
    'KYC'=>$u['KYC']?:"",
    'NEFT'=>$u['NEFT']?:"",
    'DateJoin'=>$u['DateJoin'],
    'State'=>$u['State'],
    'Zone'=>$u['Zone'],
    'City'=>$u['City'],
    
     $yyyymm=>array(
     'PV'=>$u[$yyyymm]['PV']?:0,
     'BV'=>$u[$yyyymm]['BV']?:0,
     'GBV'=>$u[$yyyymm]['GBV']?:0,
     'GPV'=>$u[$yyyymm]['GPV']?:0,
     'GrossPV'=>$u[$yyyymm]['GrossPV']?:0,
     'PGPV'=>$u[$yyyymm]['PGPV']?:0,
     'PGBV'=>$u[$yyyymm]['PGBV']?:0,
     'RollUpBV'=>$u[$yyyymm]['RollUpBV']?:0,
     'RollUpPV'=>$u[$yyyymm]['RollUpPV']?:0,
     'Legs'=>$u[$yyyymm]['Legs']?:0,
     'QDLegs'=>$u[$yyyymm]['QDLegs']?:0,
     'ValidTitle'=>$u[$yyyymm]['ValidTitle']?:"",
     'InActive' => $u[$yyyymm]['InActive']?:"",
    )
    ));
  }
 
 return $this->render(array('json' => array("success"=>"Yes",'count'=>count($users),'users'=>$allusers)));  
}

public function findRewards(){
 $rewards = Rewards::find('all',array(
  'order'=>array('Type.Points'=>'DESC')
 ));
 return $this->render(array('json' => array("success"=>"Yes",'count'=>count($rewards),'rewards'=>$rewards)));  
}



public function todayjoinee(){
 ini_set('memory_limit','-1'); 
 $mcaNumber = $this->request->data['mcaNumber'];
 $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
 ));
 $left = $user['left'];
 $right = $user['right']; 
$yyyymm = date('Y-m'); 

 
 $users = Users::find('all',array(
  'conditions'=>array(
   $yyyymm.'.today.PV'=>array('$gt'=>0),
   'left'=>array('$gt'=>$left),
   'right'=>array('$lt'=>$right),
   'Enable'=>'Yes',
  ),
  'order'=>array($yyyymm.'.today.Date'=>'DESC','mcaName'=>'ASC')
 ));
 $allusers = array();
  foreach ($users as $u){
    $mobile = Mobiles::find('first',array(
     'conditions'=>array('mcaNumber'=>$u['mcaNumber'])
    ));
      array_push($allusers,array(
    'mcaNumber'=>$u['mcaNumber'],
    'mcaName'=>$u['mcaName'],
    'refer'=>$u['refer'],
    'Mobile'=>$mobile['Mobile']?:"",
    'Enable'=>$u['Enable'],
    'Level'=>$u['Level'],
    'KYC'=>$u['KYC']?:"",
    'NEFT'=>$u['NEFT']?:"",
    'DateJoin'=>$u['DateJoin'],
    'State'=>$u['State'],
    'Zone'=>$u['Zone'],
    'City'=>$u['City'],
    
     $yyyymm=>array(
     'PV'=>$u[$yyyymm]['PV']?:0,
     'BV'=>$u[$yyyymm]['BV']?:0,
     'GBV'=>$u[$yyyymm]['GBV']?:0,
     'GPV'=>$u[$yyyymm]['GPV']?:0,
     'GrossPV'=>$u[$yyyymm]['GrossPV']?:0,
     'PGPV'=>$u[$yyyymm]['PGPV']?:0,
     'PGBV'=>$u[$yyyymm]['PGBV']?:0,
     'RollUpBV'=>$u[$yyyymm]['RollUpBV']?:0,
     'RollUpPV'=>$u[$yyyymm]['RollUpPV']?:0,
     'Legs'=>$u[$yyyymm]['Legs']?:0,
     'QDLegs'=>$u[$yyyymm]['QDLegs']?:0,
     'ValidTitle'=>$u[$yyyymm]['ValidTitle']?:"",
     'InActive' => $u[$yyyymm]['InActive']?:"",
     'ShoppingDate'=>gmdate('Y-m-d',$u[$yyyymm]['today']['Date']->sec)
    )
    ));
 
  } 
  return $this->render(array('json' => array("success"=>"Yes",'count'=>count($allusers),'users'=>$allusers)));  
}

public function prevmonths($mcaNumber = null){
 ini_set('memory_limit','-1'); 
 if($mcaNumber == null){
  return compact('mcaNumber'); 
 }
  $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
 ));
 $left = $user['left'];
 $right = $user['right'];
 $yyyymm = date('Y-m'); 
 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
 
 $users = Users::find('all',array(
  'conditions'=>array(
   $p1yyyymm.'.PV'=>array('$gt'=>0),
   'left'=>array('$gt'=>$left),
   'right'=>array('$lt'=>$right),
   'Enable'=>'Yes',
  ),
  'order'=>array('mcaName'=>'ASC')
 ));
$allusers = array();
  foreach ($users as $u){
    $mobile = Mobiles::find('first',array(
     'conditions'=>array('mcaNumber'=>$u['mcaNumber'])
    ));
      array_push($allusers,array(
    'mcaNumber'=>$u['mcaNumber'],
    'mcaName'=>$u['mcaName'],
    'refer'=>$u['refer'],
    'Mobile'=>$mobile['Mobile']?:"",
    'Enable'=>$u['Enable'],
    'Level'=>$u['Level'],
    'KYC'=>$u['KYC']?:"",
    'NEFT'=>$u['NEFT']?:"",
    'DateJoin'=>$u['DateJoin'],
    'State'=>$u['State'],
    'Zone'=>$u['Zone'],
    'City'=>$u['City'],
    
     $yyyymm=>array(
     'PV'=>$u[$yyyymm]['PV']?:0,
     'BV'=>$u[$yyyymm]['BV']?:0,
     'GBV'=>$u[$yyyymm]['GBV']?:0,
     'GPV'=>$u[$yyyymm]['GPV']?:0,
     'GrossPV'=>$u[$yyyymm]['GrossPV']?:0,
     'PGPV'=>$u[$yyyymm]['PGPV']?:0,
     'PGBV'=>$u[$yyyymm]['PGBV']?:0,
     'RollUpBV'=>$u[$yyyymm]['RollUpBV']?:0,
     'RollUpPV'=>$u[$yyyymm]['RollUpPV']?:0,
     'Legs'=>$u[$yyyymm]['Legs']?:0,
     'QDLegs'=>$u[$yyyymm]['QDLegs']?:0,
     'ValidTitle'=>$u[$yyyymm]['ValidTitle']?:"",
     'InActive' => $u[$yyyymm]['InActive']?:"",
     'ShoppingDate'=>gmdate('Y-m-d',$u[$yyyymm]['today']['Date']->sec)
    ),
    
     $p1yyyymm=>array(
     'PV'=>$u[$p1yyyymm]['PV']?:0,
     'BV'=>$u[$p1yyyymm]['BV']?:0,
     'GBV'=>$u[$p1yyyymm]['GBV']?:0,
     'GPV'=>$u[$p1yyyymm]['GPV']?:0,
     'GrossPV'=>$u[$p1yyyymm]['GrossPV']?:0,
     'PGPV'=>$u[$p1yyyymm]['PGPV']?:0,
     'PGBV'=>$u[$p1yyyymm]['PGBV']?:0,
     'RollUpBV'=>$u[$p1yyyymm]['RollUpBV']?:0,
     'RollUpPV'=>$u[$p1yyyymm]['RollUpPV']?:0,
     'Legs'=>$u[$p1yyyymm]['Legs']?:0,
     'QDLegs'=>$u[$p1yyyymm]['QDLegs']?:0,
     'ValidTitle'=>$u[$p1yyyymm]['ValidTitle']?:"",
     'InActive' => $u[$p1yyyymm]['InActive']?:"",
     'ShoppingDate'=>gmdate('Y-m-d',$u[$p1yyyymm]['today']['Date']->sec)
    ),
    ));
 
  } 
  
 
 return compact('allusers'); 
}

public function sendsms(){
 $play = "bit.ly/35m2Wwx";
 $zoom = "bit.ly/2QRyLYO";
 $function = new Functions();
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  foreach($mcaNumber as $m){
   $user = Users::find('first',array(
    'conditions'=>array('mcaNumber'=>(string)$m)
   ));
   $sms = "Hi ".$user['mcaName'].", Join Zoom meeting today @ 9:30pm ".$zoom." Download SFF-Mall App for Modicare ".$play;
   $mobile = Mobiles::find('first',array(
     'conditions'=>array('mcaNumber'=>(string)$m)
   ));
   $mo = "+91".$mobile['Mobile'];
   $returnsms = $function->sendSms($mo,$sms);  // Testing if it works 
  }
 }
 return $this->redirect('/malls/prevmonths');  
}


public function thismonths($mcaNumber = null,$date = null){
  ini_set('memory_limit','-1'); 
 if($mcaNumber == null || $date == null){
  return compact('mcaNumber'); 
 }
 $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
 ));
 $left = $user['left'];
 $right = $user['right'];
 $yyyymm = date('Y-m'); 
 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );

 $users = Users::find('all',array(
  'conditions'=>array(
   $yyyymm.'.today.PV'=>array('$gt'=>0),
   'left'=>array('$gt'=>$left),
   'right'=>array('$lt'=>$right),
   'Enable'=>'Yes',
  ),
  'order'=>array('mcaName'=>'ASC')
 ));
$allusers = array();
  foreach ($users as $u){
    $mobile = Mobiles::find('first',array(
     'conditions'=>array('mcaNumber'=>$u['mcaNumber'])
    ));
      array_push($allusers,array(
    'mcaNumber'=>$u['mcaNumber'],
    'mcaName'=>$u['mcaName'],
    'refer'=>$u['refer'],
    'Mobile'=>$mobile['Mobile']?:"",
    'Enable'=>$u['Enable'],
    'Level'=>$u['Level'],
    'KYC'=>$u['KYC']?:"",
    'NEFT'=>$u['NEFT']?:"",
    'DateJoin'=>$u['DateJoin'],
    'State'=>$u['State'],
    'Zone'=>$u['Zone'],
    'City'=>$u['City'],
    
     $yyyymm=>array(
     'PV'=>$u[$yyyymm]['PV']?:0,
     'BV'=>$u[$yyyymm]['BV']?:0,
     'GBV'=>$u[$yyyymm]['GBV']?:0,
     'GPV'=>$u[$yyyymm]['GPV']?:0,
     'GrossPV'=>$u[$yyyymm]['GrossPV']?:0,
     'PGPV'=>$u[$yyyymm]['PGPV']?:0,
     'PGBV'=>$u[$yyyymm]['PGBV']?:0,
     'RollUpBV'=>$u[$yyyymm]['RollUpBV']?:0,
     'RollUpPV'=>$u[$yyyymm]['RollUpPV']?:0,
     'Legs'=>$u[$yyyymm]['Legs']?:0,
     'QDLegs'=>$u[$yyyymm]['QDLegs']?:0,
     'ValidTitle'=>$u[$yyyymm]['ValidTitle']?:"",
     'InActive' => $u[$yyyymm]['InActive']?:"",
     'ShoppingDate'=>gmdate('Y-m-d',$u[$yyyymm]['today']['Date']->sec)
    ),
    
     $p1yyyymm=>array(
     'PV'=>$u[$p1yyyymm]['PV']?:0,
     'BV'=>$u[$p1yyyymm]['BV']?:0,
     'GBV'=>$u[$p1yyyymm]['GBV']?:0,
     'GPV'=>$u[$p1yyyymm]['GPV']?:0,
     'GrossPV'=>$u[$p1yyyymm]['GrossPV']?:0,
     'PGPV'=>$u[$p1yyyymm]['PGPV']?:0,
     'PGBV'=>$u[$p1yyyymm]['PGBV']?:0,
     'RollUpBV'=>$u[$p1yyyymm]['RollUpBV']?:0,
     'RollUpPV'=>$u[$p1yyyymm]['RollUpPV']?:0,
     'Legs'=>$u[$p1yyyymm]['Legs']?:0,
     'QDLegs'=>$u[$p1yyyymm]['QDLegs']?:0,
     'ValidTitle'=>$u[$p1yyyymm]['ValidTitle']?:"",
     'InActive' => $u[$p1yyyymm]['InActive']?:"",
     'ShoppingDate'=>gmdate('Y-m-d',$u[$p1yyyymm]['today']['Date']->sec)
    ),
    ));
 
  } 
 return compact('allusers'); 
 
}


public function sendsmsdaily(){
 $play = "bit.ly/35m2Wwx";
 $zoom = "bit.ly/2QRyLYO";
 $function = new Functions();
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  foreach($mcaNumber as $m){
   $user = Users::find('first',array(
    'conditions'=>array('mcaNumber'=>(string)$m)
   ));
   $sms = "Hi ".$user['mcaName'].", Download SFF-Mall App for Modicare ".$play ." to check your and team progress";
   $mobile = Mobiles::find('first',array(
     'conditions'=>array('mcaNumber'=>(string)$m)
   ));
   $mo = "+91".$mobile['Mobile'];
   $returnsms = $function->sendSms($mo,$sms);  // Testing if it works 
  }
 }
 return $this->redirect('/malls/thismonths');  
}


public function cityuser(){
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $city = $this->request->data['city'];
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
  $left = $user['left'];
  $right = $user['right'];
 
 $conditions = array(
 'left'=>array('$gt'=>$left),
 'right'=>array('$lt'=>$right),
 'Enable'=>'Yes',
 'City'=>$city
  );

 $users = Users::find('all',array(
  'conditions'=>$conditions,
  'order'=>array('mcaName'=>'ASC')
 ));
 }
 return $this->render(array('json' => array("success"=>"Yes",'count'=>count($users),'users'=>$users)));     
}

public function findterminated(){
ini_set('memory_limit', '-1');
 if($this->request->data){
   $mcaNumber = $this->request->data['mcaNumber'];
   $user = Users::find('first',array(
    'conditions'=>array('mcaNumber'=>$mcaNumber)
   ));
   $left = $user['left'];
   $right = $user['right'];
   $yyyymm = date('Y-m');
   
   $users = Users::find('all',array('conditions'=>
   array(
      'left'=>array('$gt'=>$left),
      'right'=>array('$lt'=>$right),
       $yyyymm=>array('$exists'=>false),
      'Enable'=>'Yes'
   ),
   'fields'=>array('mcaNumber','mcaName','DateJoin'),
   'order'=>array('mcaName'=>'ASC')
   )
 );  
 }
 return $this->render(array('json' => array("success"=>"Yes",'count'=>count($users),'users'=>$users)));     
}

public function getinner(){
 ini_set('memory_limit', '-1');
 $yyyymm = date('Y-m');
 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
 $p2yyyymm = date("Y-m", strtotime("-2 month", strtotime(date("F") . "1")) );
 $p3yyyymm = date("Y-m", strtotime("-3 month", strtotime(date("F") . "1")) );
 $p4yyyymm = date("Y-m", strtotime("-4 month", strtotime(date("F") . "1")) );
 $p5yyyymm = date("Y-m", strtotime("-5 month", strtotime(date("F") . "1")) );
 $p6yyyymm = date("Y-m", strtotime("-6 month", strtotime(date("F") . "1")) );
 $p7yyyymm = date("Y-m", strtotime("-7 month", strtotime(date("F") . "1")) );
 $p8yyyymm = date("Y-m", strtotime("-8 month", strtotime(date("F") . "1")) );
 $p9yyyymm = date("Y-m", strtotime("-9 month", strtotime(date("F") . "1")) );
 $p10yyyymm = date("Y-m", strtotime("-10 month", strtotime(date("F") . "1")) );
 $p11yyyymm = date("Y-m", strtotime("-11 month", strtotime(date("F") . "1")) );

 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
  ));
   $left = $user['left'];
   $right = $user['right'];
   $conditions = array(
   'left'=>array('$gt'=>$left),
   'right'=>array('$lt'=>$right),
   'Inner.Enabled'=>'Yes',
  );
 $users = Users::find('all',array(
  'conditions'=>$conditions,
//  'order'=>array('mcaName'=>'ASC')
 ));
 $joineeInner = $this->findJoineeInner($mcaNumber); 
 
 $allusers = array();
  array_push($allusers,array(
    'mcaName'=>$user['mcaName'],
    'mcaNumber'=>$user['mcaNumber'],
    'DateJoin'=>$user['DateJoin'],
    'Mobile'=>$user['Inner']['mobile'],
    'Email'=>$user['Inner']['email'],
    'KYC'=>$user['KYC']?:"",
    'NEFT'=>$user['NEFT']?:"",
    'Aadhar'=>$user['Aadhar']?:"",

    $yyyymm => array('PV'=>$user[$yyyymm]['PV']?:0,'GPV'=>$user[$yyyymm]['GPV']?:0,'PGPV'=>$user[$yyyymm]['PGPV']?:0),
    $p1yyyymm => array('PV'=>$user[$p1yyyymm]['PV']?:0,'GPV'=>$user[$p1yyyymm]['GPV']?:0,'PGPV'=>$user[$p1yyyymm]['PGPV']?:0),
    $p2yyyymm => array('PV'=>$user[$p2yyyymm]['PV']?:0,'GPV'=>$user[$p2yyyymm]['GPV']?:0,'PGPV'=>$user[$p2yyyymm]['PGPV']?:0),
    $p3yyyymm => array('PV'=>$user[$p3yyyymm]['PV']?:0,'GPV'=>$user[$p3yyyymm]['GPV']?:0,'PGPV'=>$user[$p3yyyymm]['PGPV']?:0),    
    $p4yyyymm => array('PV'=>$user[$p4yyyymm]['PV']?:0,'GPV'=>$user[$p3yyyymm]['GPV']?:0,'PGPV'=>$user[$p4yyyymm]['PGPV']?:0),    
    $p5yyyymm => array('PV'=>$user[$p5yyyymm]['PV']?:0,'GPV'=>$user[$p5yyyymm]['GPV']?:0,'PGPV'=>$user[$p5yyyymm]['PGPV']?:0),    
    $p6yyyymm => array('PV'=>$user[$p6yyyymm]['PV']?:0,'GPV'=>$user[$p6yyyymm]['GPV']?:0,'PGPV'=>$user[$p6yyyymm]['PGPV']?:0),    
    $p7yyyymm => array('PV'=>$user[$p7yyyymm]['PV']?:0,'GPV'=>$user[$p7yyyymm]['GPV']?:0,'PGPV'=>$user[$p7yyyymm]['PGPV']?:0),    
    $p8yyyymm => array('PV'=>$user[$p8yyyymm]['PV']?:0,'GPV'=>$user[$p8yyyymm]['GPV']?:0,'PGPV'=>$user[$p8yyyymm]['PGPV']?:0),    
    $p9yyyymm => array('PV'=>$user[$p9yyyymm]['PV']?:0,'GPV'=>$user[$p9yyyymm]['GPV']?:0,'PGPV'=>$user[$p9yyyymm]['PGPV']?:0),    
    $p10yyyymm => array('PV'=>$user[$p10yyyymm]['PV']?:0,'GPV'=>$user[$p10yyyymm]['GPV']?:0,'PGPV'=>$user[$p10yyyymm]['PGPV']?:0),    
    $p11yyyymm => array('PV'=>$user[$p11yyyymm]['PV']?:0,'GPV'=>$user[$p11yyyymm]['GPV']?:0,'PGPV'=>$user[$p11yyyymm]['PGPV']?:0),    
    'countjoinee'=>count($joineeInner),
   )
  ); 
 foreach($users as $n){
  
  $joineeInner = $this->findJoineeInner($n['mcaNumber']); 
  array_push($allusers,array(
    'mcaName'=>$n['mcaName'],
    'mcaNumber'=>$n['mcaNumber'],
    'DateJoin'=>$n['DateJoin'],
    'Mobile'=>$n['Inner']['mobile'],
    'Email'=>$n['Inner']['email'],
    'KYC'=>$n['KYC']?:"",
    'NEFT'=>$n['NEFT']?:"",
    'Aadhar'=>$n['Aadhar']?:"",
    $yyyymm => array('PV'=>$n[$yyyymm]['PV']?:0,'GPV'=>$n[$yyyymm]['GPV']?:0,'PGPV'=>$n[$yyyymm]['PGPV']?:0),
    $p1yyyymm => array('PV'=>$n[$p1yyyymm]['PV']?:0,'GPV'=>$n[$p1yyyymm]['GPV']?:0,'PGPV'=>$n[$p1yyyymm]['PGPV']?:0),
    $p2yyyymm => array('PV'=>$n[$p2yyyymm]['PV']?:0,'GPV'=>$n[$p2yyyymm]['GPV']?:0,'PGPV'=>$n[$p2yyyymm]['PGPV']?:0),
    $p3yyyymm => array('PV'=>$n[$p3yyyymm]['PV']?:0,'GPV'=>$n[$p3yyyymm]['GPV']?:0,'PGPV'=>$n[$p3yyyymm]['PGPV']?:0),    
    $p4yyyymm => array('PV'=>$n[$p4yyyymm]['PV']?:0,'GPV'=>$n[$p3yyyymm]['GPV']?:0,'PGPV'=>$n[$p4yyyymm]['PGPV']?:0),    
    $p5yyyymm => array('PV'=>$n[$p5yyyymm]['PV']?:0,'GPV'=>$n[$p5yyyymm]['GPV']?:0,'PGPV'=>$n[$p5yyyymm]['PGPV']?:0),    
    $p6yyyymm => array('PV'=>$n[$p6yyyymm]['PV']?:0,'GPV'=>$n[$p6yyyymm]['GPV']?:0,'PGPV'=>$n[$p6yyyymm]['PGPV']?:0),    
    $p7yyyymm => array('PV'=>$n[$p7yyyymm]['PV']?:0,'GPV'=>$n[$p7yyyymm]['GPV']?:0,'PGPV'=>$n[$p7yyyymm]['PGPV']?:0),    
    $p8yyyymm => array('PV'=>$n[$p8yyyymm]['PV']?:0,'GPV'=>$n[$p8yyyymm]['GPV']?:0,'PGPV'=>$n[$p8yyyymm]['PGPV']?:0),    
    $p9yyyymm => array('PV'=>$n[$p9yyyymm]['PV']?:0,'GPV'=>$n[$p9yyyymm]['GPV']?:0,'PGPV'=>$n[$p9yyyymm]['PGPV']?:0),    
    $p10yyyymm => array('PV'=>$n[$p10yyyymm]['PV']?:0,'GPV'=>$n[$p10yyyymm]['GPV']?:0,'PGPV'=>$n[$p10yyyymm]['PGPV']?:0),    
    $p11yyyymm => array('PV'=>$n[$p11yyyymm]['PV']?:0,'GPV'=>$n[$p11yyyymm]['GPV']?:0,'PGPV'=>$n[$p11yyyymm]['PGPV']?:0),    
    'countjoinee'=>count($joineeInner),
   )
  ); 
 }
 
 }
  
 return $this->render(array('json' => array("success"=>"Yes",'count'=>count($users), 'users'=>$allusers)));     
}

public function findJoineeInner($mcaNumber){
 $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
 ));
 $yyyymm = date('Y-m');
 $pyyyymm = date('Y-m', strtotime('first day of last month'));
 $dateJoin = date('M Y');
 $left = $user['left'];
 $right = $user['right'];
 $joinee = Users::find('all',array('conditions'=>
   array(
      'DateJoin'=>array('like'=>'/'.$dateJoin.'/'),
      'left'=>array('$gt'=>$left),
      'right'=>array('$lt'=>$right),
      'Enable'=>'Yes',
      'Inner.Enabled'=>'Yes',
      $yyyymm.'.PV'=>array('$gte'=>80)
      
   ),
   'fields'=>array('mcaNumber','mcaName','DateJoin',$yyyymm.'.PV'),
   'order'=>array('DateJoin'=>'ASC')
   )
 );
 
 $DetailJoinee = array();
 foreach($joinee as $j){
  array_push($DetailJoinee,
    array(
     'mcaNumber'=>$j['mcaNumber'],
     'mcaName'=>$j['mcaName'],
     'DateJoin'=>$j['DateJoin'],
     'PV'=>$j[$yyyymm]['PV'],
    )
  );
  
 }
 
// return $this->render(array('json' => array("success"=>"Yes","joinee"=>count($joinee),'Detail'=>$joinee)));    
 return $DetailJoinee;
}


public function sendsmsall(){
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $message = $this->request->data['message'];
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
  ));
   $left = $user['left'];
   $right = $user['right'];
   $conditions = array(
   'left'=>array('$gt'=>$left),
   'right'=>array('$lt'=>$right),
   'Inner.Enabled'=>'Yes',
  );
 $users = Users::find('all',array(
  'conditions'=>$conditions,
//  'order'=>array('mcaName'=>'ASC')
 ));
 $function = new Functions();
 foreach($users as $u){
  $mobile = "+91".$u['Inner']['mobile'];
  $function->twilio_api($mobile,$message);
 }
 }
 return $this->render(array('json' => array("success"=>"Yes",'count'=>count($users)))); 
}


public function sendsmsonly(){
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $message = $this->request->data['message'];
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
  ));
 $function = new Functions();
  $message = $message . "\n--".$user['mcaName']. "\n+91".$user['Inner']['mobile'];
  $mobile = "+91".$this->request->data['mobile'];
  $function->twilio_api($mobile,$message);
 }
 return $this->render(array('json' => array("success"=>"Yes",'count'=>count($users)))); 
}

public function sendwhatsapponly(){
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $message = $this->request->data['message'];
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
  ));
 $function = new Functions();
  $message = $message . "\n--".$user['mcaName']. "\n+91".$user['Inner']['mobile'];
  $mobile = "+919913722372";//.$this->request->data['mobile'];
  $function->twilio_wa($mobile,$message);
 }
 return $this->render(array('json' => array("success"=>"Yes",'count'=>count($users)))); 
}



public function sendemailall(){
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $message = $this->request->data['message'];
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
  ));
   $left = $user['left'];
   $right = $user['right'];
   $conditions = array(
   'left'=>array('$gt'=>$left),
   'right'=>array('$lt'=>$right),
   'Inner.Enabled'=>'Yes',
  );
 $users = Users::find('all',array(
  'conditions'=>$conditions,
//  'order'=>array('mcaName'=>'ASC')
 ));
 $function = new Functions();
  foreach($users as $u){
   $email = $u['Inner']['email'];
   $message = compact('message');
   $function->sendEmailTo($email,$message,'malls','email','TheUnstoppableYou','schooloffinancialfreedom@gmail.com',null,null,null,null);
  }
 }
 return $this->render(array('json' => array("success"=>"Yes",'count'=>count($users)))); 
}

public function sendemailonly(){
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $email = $this->request->data['email'];
  $message = $this->request->data['message'];
  $function = new Functions();
  $function->sendEmailTo($email,$message,'malls','email','TheUnstoppableYou','schooloffinancialfreedom@gmail.com',null,null,null,null);
 }
 return $this->render(array('json' => array("success"=>"Yes",'count'=>count($users)))); 
}

public function sendsmsprospect(){
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $message = $this->request->data['message'];
  $mobile = $this->request->data['mobile'];
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
  ));
 $function = new Functions();
  $message = $message . "\n--".$user['mcaName']. "\n+91".$user['Inner']['mobile'];
  $mobile = "+91".$mobile;
  $function->twilio_api($mobile,$message);
 }
 return $this->render(array('json' => array("success"=>"Yes",'count'=>count($users)))); 
}

public function innermethod(){
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $method = $this->request->data['method'];

  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
  ));
   $left = $user['left'];
   $right = $user['right'];
   $conditions = array(
   'left'=>array('$gte'=>$left),
   'right'=>array('$lte'=>$right),
   'Inner.Enabled'=>'Yes',
  );
  $fields = array($method,'mcaName','mcaNumber','DateJoin','Inner.mobile');
  $users = Users::find('all',array(
  'conditions'=>$conditions,
  'fields' =>$fields,
  'order'=>array('mcaName'=>'ASC')
 ));
  
  return $this->render(array('json' => array("success"=>"Yes",'count'=>count($users),'users'=>$users))); 
 }
}


public function createpage(){

 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
  ));
  $pages = X_pages::find('all',array(
   'conditions'=>array('category_id'=>33,'no_index'=>1)
  ));
  
  $x = new XController();
  $short = array();
  foreach($pages as $p){
   $data = array(
    "category_id" =>$p->category_id, 
    "translation_parent_id"=>$p->translation_parent_id, 
    "variant_parent_id"=>$p->variant_parent_id, 
    "is_published"=>$p->is_published, 
    "date_added"=>gmdate('Y-m-d h:i:s'), 
    "created_by"=>$p->created_by, 
    "created_by_user"=>$p->created_by_user, 
    "date_modified"=>gmdate('Y-m-d h:i:s'),
    "modified_by"=>$p->modified_by, 
    "modified_by_user"=>$p->modified_by_user, 
    "checked_out"=>$p->checked_out, 
    "checked_out_by"=>$p->checked_out_by, 
    "checked_out_by_user"=>$p->checked_out_by_user, 
    "title"=>$p->title, 
    "alias"=>str_replace(" ","-",strtolower($p->title).'-'.strtolower($user['mcaName'])), 
    "template"=>$p->template, 
    "custom_html"=>$p->custom_html, 
    "content"=>$p->content, 
    "publish_up"=>$p->publish_up, 
    "publish_down"=>$p->publish_down, 
    "hits"=>0, 
    "unique_hits"=>0, 
    "variant_hits"=>0, 
    "revision"=>1, 
    "meta_description"=>$p->meta_description, 
    "redirect_type"=>$p->redirect_type, 
    "redirect_url"=>$p->redirect_url, 
    "is_preference_center"=>0, 
    "no_index"=>0, 
    "lang"=>$p->lang, 
    "variant_settings"=>$p->variant_settings, 
    "variant_start_date"=>$p->variant_start_date,
   );
   
   $page = X_pages::find('first',array(
    'conditions'=>array('alias'=>str_replace(" ","-",strtolower($p->title).'-'.strtolower($user['mcaName'])))
   ));
   
   if(count($page)==0){
     X_pages::create()->save($data);
   }else{
    $conditions = array('alias'=>str_replace(" ","-",strtolower($p->title).'-'.strtolower($user['mcaName'])));
     X_pages::update($data,$conditions);
   }
   $shortURL = $x->shorturl(str_replace(" ","-",strtolower($p->title).'-'.strtolower($user['mcaName'])),str_replace(" ","-",strtolower($p->title)));
   array_push($short,array('shortURL'=>"https://sff.team/x/go/".$shortURL,'longURL'=>"https://circle.sff.team/".str_replace(" ","-",strtolower($p->title))."/".str_replace(" ","-",strtolower($p->title).'-'.strtolower($user['mcaName']))));
  }
  return $this->render(array('json' => array("success"=>"Yes",'count'=>count($user),'data'=>$short))); 
  }
 }

public function loyaltyPriceImages($mcaNumber,$mrp){
 $products = Malls::find('all');
 foreach($products as $p){
  $this->loyaltyPriceImage($p['Code'],$mcaNumber,$mrp);
 }
 return $this->render(array('json' => array("success"=>"Yes"))); 
}

public function loyaltyPriceImage($code,$mcaNumber,$mrp){
 ini_set('memory_limit','-1');
 set_time_limit(0);
 $product = Malls::find('first',array(
  'conditions'=>array('Code'=>$code)
 ));
// print_r($mcaNumber);
 $file = $this->createLoyaltyimageinstantly($product,$mcaNumber,$mrp);
 return true;
 //return $this->render(array('json' => array("success"=>"Yes"))); 
}

public function createimage(){
 if($this->request->data){
 $img1 = $this->request->data['myBackground'];
 $img2 = $this->request->data['myFooter'];
 $name = $this->request->data['myName'];
 $mcaNumber = $this->request->data['mymcaNumber'];
 $designation = $this->request->data['myDesignation'];
 $quote = $this->request->data['myQuote'];
 $file = $this->createimageinstantly($img1,$img2,$name,$designation, $quote, $mcaNumber);
 
 $data = array(
  'Background'=>$img1,
  'Footer'=>$img2,
  'mcaName'=>$name,
  'mcaNumber'=>$mcaNumber,
  'Designation'=>$designation,
  'Quote'=>$quote,
  'File'=>$file
 );
 
 Posts::create()->save($data);
 $myfiles = $this->myfiles($mcaNumber);
 return $this->render(array('json' => array("success"=>"Yes",'files'=>$myfiles))); 
 }
}



public function myfiles($mcaNumber=null){
 $this->_render['layout'] = ''; 
 if($mcaNumber==""){
  $mcaNumber = $this->request->data['mcaNumber'];
 
   $dir    = '/tmp';
   $targetFolder = '/app/webroot/img/posts/';
   $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
   $files = scandir($targetPath);
   $myfiles = array();
   foreach($files as $f){
     $filemcaNumber = substr($f,0,8);
     if($filemcaNumber===$mcaNumber){
       array_push($myfiles,array('file'=>$f));
     }
   }
  return $this->render(array('json' => array("success"=>"Yes",'files'=>$myfiles))); 
 }else{
  
   $dir    = '/tmp';
   $targetFolder = '/app/webroot/img/posts/';
   $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
   $files = scandir($targetPath);
   $myfiles = array();
   foreach($files as $f){
     $filemcaNumber = substr($f,0,8);
     if($filemcaNumber===$mcaNumber){
       array_push($myfiles,array('file'=>$f));
     }
   }
  return $myfiles; 
 }
}
public function myInviteImages(){
   $mcaNumber = $this->request->data['mcaNumber'];
   $targetFolder = '/app/webroot/img/invite/';
   $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
   $files = scandir($targetPath);
   $myfiles = array();
   foreach($files as $f){
     $filemcaNumber = substr($f,0,8);
     if($filemcaNumber=="00000000"){
      array_push($myfiles,array('file'=>$f));
     }

     if($filemcaNumber!=$mcaNumber){
      continue;
     }
     
     array_push($myfiles,array('file'=>$f));
   }
  return $this->render(array('json' => array("success"=>"Yes",'files'=>$myfiles))); 
}

function createLoyaltyimageinstantly($data,$mcaNumber,$mrp){
   $mobile = Mobiles::find('first',array(
     'conditions'=>array('mcaNumber'=>$mcaNumber)
    ));

 
   $x=400;$y=600;
   $code = $data['Code'];
   $name = $data['Name'];
   $MRP = $data['MRP'];
   $DP = $data['DP'];
   $saving = $data['Saving'];
   $savingpercent = $data['SavingPercent'];
   $afterfree = $data['AfterFree'];
   $afterloyalty = $data['AfterLoyalty'];
   header('Content-Type: image/png');
   $imageFolder = '/app/webroot/img/products/';
   $targetFolder = '/app/webroot/img/whatsapp/';
   $fontFolder = '/';
   $imagePath = $_SERVER['DOCUMENT_ROOT'] . $imageFolder;
   $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
 
   $img = $imagePath.$code."_400.jpg";

   $outputImage = imagecreatetruecolor(400, 630);
   $white = imagecolorallocate($outputImage, 255, 255, 255);
   $black = imagecolorallocate($outputImage, 0, 0, 0);
   $red = imagecolorallocate($outputImage, 255, 0, 0);
   $blue = imagecolorallocate($outputImage, 0, 0, 255);
   $green = imagecolorallocate($outputImage, 0, 102, 0);
   $brown = imagecolorallocate($outputImage, 102, 0, 0);
   
   imagefill($outputImage, 0, 0, $white);
   $first = imagecreatefromjpeg($img);
   imagecopyresized($outputImage,$first,0,200,0,0, $x, $y,$x,$y);
   $text = 'MRP: '.$MRP;
   $font =  $fontFolder . 'arial.ttf';
   imagettftext($outputImage, 12, 0, 10, 30, $black, './fonts/calibrib.ttf', wordwrap($code." ".$name ,50,"\n",true));  
   imagettftext($outputImage, 14, 0, 10, 70, $black, './fonts/calibri.ttf', 'MRP: Rs.'.number_format($MRP,0));
if($mrp=="" || $mrp == null){   
   imagettftext($outputImage, 14, 0, 10, 90, $blue, './fonts/calibri.ttf', 'Distributor Price: Rs.'.number_format($DP,0));
   imagettftext($outputImage, 14, 0, 10, 110, $green, './fonts/calibri.ttf', 'Cost After FREE Gift: Rs.'.number_format($afterfree,0) . "");
   imagettftext($outputImage, 14, 0, 10, 130, $green, './fonts/calibri.ttf', 'Cost After ONE Year Loyalty: Rs.'.number_format($afterloyalty,0) . "");
   
   imagettftext($outputImage, 14, 0, 10, 150, $brown, './fonts/calibri.ttf', 'Savings: Rs.'.number_format($MRP-$afterloyalty,0) . "");
   imagettftext($outputImage, 14, 0, 10, 170, $brown, './fonts/calibri.ttf', 'Savings %: '.number_format(($MRP-$afterloyalty)/$MRP*100,0) . "%");
}   
   $mobileInfo = "Call/WhatsApp me : ";//.$mobile['mcaName']."  +91".$mobile['Mobile'];
   imagettftext($outputImage, 14, 0, 10, 190, $black, './fonts/calibrib.ttf', wordwrap($mobileInfo,60,"\n",true));
   imagettftext($outputImage, 17, 0, 10, 210, $red, './fonts/calibrib.ttf', wordwrap("To Understand HOW this system works",60,"\n",true));
  imagettftext($outputImage, 14, 0, 10, 620, $white, './fonts/calibrib.ttf', wordwrap("Best Business in Today's Time, USE-SHARE-EARN",60,"\n",true));

  $filename=$code.'.png';
  imagepng($outputImage, $targetPath . $filename);
  imagedestroy($outputImage);
  return $filename;

}

function createimageinstantly($img1="",$img2="",$name="", $designation="", $quote="", $mcaNumber=""){
  $x=$y=600;
  header('Content-Type: image/png');
  $imageFolder = '/app/webroot/';
  $targetFolder = '/app/webroot/img/posts/';
  $fontFolder = '/';
  $imagePath = $_SERVER['DOCUMENT_ROOT'] . $imageFolder;
  $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
  
  $img1 = $imagePath.$img1;
  $img2 = $imagePath.$img2;


  $outputImage = imagecreatetruecolor(600, 600);

  // set background to white
  $white = imagecolorallocate($outputImage, 255, 255, 255);
  $black = imagecolorallocate($outputImage, 0, 0, 0);
  imagefill($outputImage, 0, 0, $white);

  $first = imagecreatefrompng($img1);
  $second = imagecreatefrompng($img2);

  //imagecopyresized ( resource $dst_image , resource $src_image , int $dst_x , int $dst_y , int $src_x , int $src_y , int $dst_w , int $dst_h , int $src_w , int $src_h )
  imagecopyresized($outputImage,$first,0,0,0,0, $x, $y,$x,$y);
  imagecopyresized($outputImage,$second,0,500,0,0, $x, $y,$x,$y);
//  imagecopyresized($outputImage,$third,200,200,0,0, 100, 100, 204, 148);

  // Add the text
  //imagettftext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text )
  //$white = imagecolorallocate($im, 255, 255, 255);
  $text = 'School Name Here';
  $font =  $fontFolder . 'arial.ttf';
  
  imagettftext($outputImage, 24, 0, 10, 540, $white, './fonts/Raleway-Black.ttf', $name); 
  imagettftext($outputImage, 20, 0, 10, 580, $white, './fonts/Raleway-Medium.ttf', $designation); 
  
  imagettftext($outputImage, 24, 0, 12, 102, $black, './fonts/Gobold Bold.otf', wordwrap($quote,35,"\n",true));
  imagettftext($outputImage, 24, 0, 10, 100, $white, './fonts/Gobold Bold.otf', wordwrap($quote,35,"\n",true));  
  $filename=$mcaNumber."-".round(microtime(true)).'.png';
  imagepng($outputImage, $targetPath . $filename);
  imagedestroy($outputImage);
  return $filename;
 }

public function findpost(){
 if($this->request->data){ 
  $imageFile = $this->request->data['imageFile'];
  $mcaNumber = $this->request->data['mcaNumber'];
  
  $post = Posts::find('first',array(
   'conditions'=>array(
     'File'=>$imageFile,
     'mcaNumber'=>$mcaNumber
    )
  ));
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
  ));
  
  $name = str_replace(" ","-",strtolower($user['mcaName']));
  
  $shortURLs = Urls::find('all',array(
   'conditions'=>array('URL'=>array('$regex'=>$name))
  ));
  
 return $this->render(array('json' => array("success"=>"Yes",'post'=>$post,'shortURL'=>$shortURLs)));
 }
}

public function clients(){
   if($this->request->data){
    $user = Users::find('first',array(
     'conditions'=>array('mcaNumber'=>(string)$this->request->data['mcaNumber'])
    ));
    
    if(count($user)!=0){
      $username = str_replace(" ","-",strtolower($user['mcaName']));
    }
   
   $pages = X_pages::find('all',array(
    'conditions'=>array('OR'=>array('alias'=>array('LIKE'=>'%'.$username)))
   ));
   $page_id = array();
   foreach($pages as $p){
     array_push($page_id,$p->id);
   }
   
   $pagehits = X_page_hits::find('all',array(
    'conditions'=>array('OR'=>array('page_id'=>array('=' => $page_id)))
   ));
   
//   x_lead_stages_change_logs
   $lead_id = array();
   foreach($pagehits as $ph){
     array_push($lead_id,$ph->lead_id);
   }
   
   $leads = X_leads::find('all',array(
    'conditions'=>array(
     'OR'=>array('id'=>array('=' => $lead_id),'phone'=>array('<>'=>'null')),
     ),
     'order'=>array('id'=>'DESC')
   ));
   $stages = X_stages::find('all');
   }
 return $this->render(array('json' => array("success"=>"Yes",'leads'=>$leads,'stages'=>$stages)));
}

public function registration(){
  $mcaNumber = $this->request->data['mcaNumber']; 
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
  ));
  
  $name = str_replace(" ","-",strtolower($user['mcaName']));
  
  $shortURLs = Urls::find('all',array(
   'conditions'=>array('URL'=>array('$regex'=>$name))
  ));
 return $this->render(array('json' => array("success"=>"Yes",'data'=>$shortURLs)));
}

public function getleadinfo(){
 
 if($this->request->data){
  $lead_id = $this->request->data['id'];
  $lead = X_leads::find('first',array(
   'conditions'=>array('id'=>$lead_id)
  ));
  $stages = X_stages::find('all');
 }
 return $this->render(array('json' => array("success"=>"Yes",'lead'=>$lead,'stages'=>$stages)));
 
}
public function saveleadinfo(){
 if($this->request->data){
  $id=$this->request->data['lead_id'];
  $data = array(
   'firstname'=>$this->request->data['firstname'],
   'lastname'=>$this->request->data['lastname'],
   'address1'=>$this->request->data['address1'],   
   'address2'=>$this->request->data['address2'],   
   'city'=>$this->request->data['city'],
   'zipcode'=>$this->request->data['zipcode'],
   'email'=>$this->request->data['email'],
   'mobile'=>$this->request->data['mobile'],
   'phone'=>$this->request->data['phone'],
   'facebook'=>$this->request->data['facebook'],
   'stage_id'=>$this->request->data['stage_id'],
  );
  $conditions = array('id'=>$id);
  
  X_leads::update($data,$conditions);

  $lead_id = $this->request->data['lead_id'];
  $lead = X_leads::find('first',array(
   'conditions'=>array('id'=>$lead_id)
  ));
  $stages = X_stages::find('all');
  
 }
 return $this->render(array('json' => array("success"=>"Yes",'lead'=>$lead,'stages'=>$stages)));
}

public function deletepost(){
 if($this->request->data){
  $targetFolder = '/webroot/img/posts/';
  $targetPath = LITHIUM_APP_PATH . $targetFolder;
  $imageFile = str_replace("https://sff.team/img/posts/","",$this->request->data['imageFile']);
  $finalFile = $targetPath . $imageFile;  
  unlink($finalFile);
  $conditions = array('File'=>(string)$imageFile);
  Posts::remove($conditions);
  return $this->render(array('json' => array("success"=>"Yes",'file'=>$finalFile,'image'=>$imageFile)));
 }
}

public function saveUserImage(){
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $base64 = $this->request->data['avatar'];
  
  $img = str_replace('data:image/png;base64,', '', $base64);
  $img = str_replace(' ', '+', $img);
  $fileData = base64_decode($img);
  //saving
  $imageFolder = '/app/webroot/img/user/';  
  $imagePath = $_SERVER['DOCUMENT_ROOT'] . $imageFolder;
  $fileName = $imagePath . 'photo-'.$mcaNumber.'-'.round(microtime(true)).'.png';
  file_put_contents($fileName, $fileData);
  
  $data = array(
   'mcaNumber'=>$mcaNumber,
   'image'=>$fileName
  );
 
 }
  return $this->render(array('json' => array("success"=>"Yes",'image'=>$data)));
}

public function useUserImage(){
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
   $targetFolder = '/app/webroot/img/user/';
   $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
   $files = scandir($targetPath);
   $myfiles = array();
     foreach($files as $f){
     $filemcaNumber = substr($f,6,8);
     if($filemcaNumber===$mcaNumber){
       array_push($myfiles,array('file'=>$f));
     }
   }
 }
 return $this->render(array('json' => array("success"=>"Yes",'image'=>$myfiles)));
}


public function zoom(){
 
 date_default_timezone_set('Asia/Kolkata');
 $zooms = Zooms::find('all',
  
  array(
  'conditions'=>array(
   'payload.object.participant.user_name'=>array('$ne'=>'Nilam Doctor'),
   'payload.object.participant.join_time'=>array('$ne'=>''),
   ),
  'order'=>array('_id'=>'DESC'),
  'limit'=>1000
  )
 );
 
 $data = array();
 foreach($zooms as $z){
  if($z['payload']['object']['participant']['join_time']!=null || $z['payload']['object']['participant']['leave_time']!=null ){
   if($z['payload']['object']['participant']['join_time']==null){
     $join_date = "";
     $join_time = "";
   }else{
    $join_date = date('Y-M-d',strtotime($z['payload']['object']['participant']['join_time']));
    $join_time = date('H:i',strtotime($z['payload']['object']['participant']['join_time']));
    }
   if($z['payload']['object']['participant']['leave_time']==null){
     $leave_time = "";
     $leave_date = "";
   }else{
    $leave_date = date('Y-M-d',strtotime($z['payload']['object']['participant']['leave_time']));
    $leave_time = date('H:i',strtotime($z['payload']['object']['participant']['leave_time']));
    }
      
  array_push($data, array(
   'JoinTime' => $join_time,
   'LeaveTime' => $leave_time,
   'JoinDate' => $join_date,
   'LeaveDate' => $leave_date,
   'UserName'=>$z['payload']['object']['participant']['user_name'],
   'Event'=>$z['event']
  ));
  }
  
  $oldDate = "";
  $oldName = "";
  $oldLeaveTime = "";
  $allData = array();
  foreach($data as $d){
    if($d['JoinDate']==""){
     
    }else{
     $newDate = $d['JoinDate'];
     $newName = $d['UserName'];
     $newJoinTime = $d['JoinTime'];
    }
    if($d['LeaveDate']==""){
     
    }else{
     $newDate = $d['LeaveDate'];
     $newName = $d['UserName'];
     $newLeaveTime = $d['LeaveTime'];
    }
    
     if($oldDate==$newDate){
     // if($oldName==$newName){
      // if($oldJoinTime==$newJoinTime){
       array_push($allData,array(
        'Date'=>$newDate,
        'userName'=>$newName,
//        'timeLeave'=>$newLeaveTime,
        'timeJoin'=>$newJoinTime,
       ));
      // }
    // $oldJoinTime = $newJoinTime;
    // $oldLeaveTime = $newLeaveTime;
     // }
    // $oldName = $newName; 
     }
     $oldDate = $newDate;
  }
  
 }
 
 return $this->render(array('json' => array("success"=>"Yes",'zoom'=>$allData)));
 
 }

 public function circleoflife(){
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $circles = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>$mcaNumber),
   'fields'=>array('Circle'),
  ));
  $dataCircle = array();
  $data = array();
  if($circles['Circle']){
   
   foreach($circles['Circle'] as $c){
    
    $data = array(
    'SelfImage'=>$c['SelfImage']?:0,
    'Business'=>$c['Business']?:0,
    'Finance'=>$c['Finance']?:0,
    'Health'=>$c['Health']?:0,
    'Social'=>$c['Social']?:0,
    'Family'=>$c['Family']?:0,
    'Romance'=>$c['Romance']?:0,
    'Recreation'=>$c['Recreation']?:0,
    'Contribution'=>$c['Contribution']?:0,
    'PresonalGrowth'=>$c['PresonalGrowth']?:0,
    'Spiritual'=>$c['Spiritual']?:0,
    'CircleDate'=>$c['CircleDate']?:0,
    );
    array_push($dataCircle,$data);
   }
   $datanew = array(
    'SelfImage'=>$this->request->data['SelfImage']?:0,
    'Business'=>$this->request->data['Business']?:0,
    'Finance'=>$this->request->data['Finance']?:0,
    'Health'=>$this->request->data['Health']?:0,
    'Social'=>$this->request->data['Social']?:0,
    'Family'=>$this->request->data['Family']?:0,
    'Romance'=>$this->request->data['Romance']?:0,
    'Recreation'=>$this->request->data['Recreation']?:0,
    'Contribution'=>$this->request->data['Contribution']?:0,
    'PresonalGrowth'=>$this->request->data['PresonalGrowth']?:0,
    'Spiritual'=>$this->request->data['Spiritual']?:0,
    'CircleDate'=>$this->request->data['CircleDate']?:0,
   );
   array_push($dataCircle,$datanew);
  }else{
   $data = array(
    'SelfImage'=>$this->request->data['SelfImage']?:0,
    'Business'=>$this->request->data['Business']?:0,
    'Finance'=>$this->request->data['Finance']?:0,
    'Health'=>$this->request->data['Health']?:0,
    'Social'=>$this->request->data['Social']?:0,
    'Family'=>$this->request->data['Family']?:0,
    'Romance'=>$this->request->data['Romance']?:0,
    'Recreation'=>$this->request->data['Recreation']?:0,
    'Contribution'=>$this->request->data['Contribution']?:0,
    'PresonalGrowth'=>$this->request->data['PresonalGrowth']?:0,
    'Spiritual'=>$this->request->data['Spiritual']?:0,
    'CircleDate'=>$this->request->data['CircleDate']?:0,
   );
   array_push($dataCircle,$data);
  }
  
  
  
  $mcaNumber = $this->request->data['mcaNumber'];
  
  $Circle = array('Circle'=>$dataCircle);
  $conditions = array('mcaNumber'=>$this->request->data['mcaNumber']);
  Users::update($Circle,$conditions);
 }
 
 $circles = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber),
  'fields'=>array('Circle','mcaNumber','mcaName'),
 ));
 
  return $this->render(array('json' => array("success"=>"Yes",'circles'=>$circles)));
 }
 
 
 public function previouscircle(){
  if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>$mcaNumber),
   'fields'=>array('Circle','mcaNumber','mcaName'),
  ));
  return $this->render(array('json' => array("success"=>"Yes",'circles'=>$user)));
  }
 }

 public function baselines(){
   $baselines = Baselines::find('all',array(
   
   ));
  return $this->render(array('json' => array("success"=>"Yes",'baselines'=>$baselines)));
 }

 public function submitbaselines(){
  if($this->request->data){
   $mcaNumber = $this->request->data['mcaNumber'];
   $baseline = $this->request->data['baselines'];
   $DateTest = $this->request->data['DateTest'];
   $explode = str_replace("<br>", ": ",explode(",",$baseline));
   $explode = str_replace(",", ": ",explode(",",$baseline));
   $data = array(
    'Baseline'=>array(
      'DateTest'=>$DateTest,
      'Text' => $explode)
   );
   $conditions = array('mcaNumber'=>$mcaNumber);
   Users::update($data,$conditions);
  }
  return $this->render(array('json' => array("success"=>"Yes",'data'=>$data)));
 }

public function getBaseLine(){
  if($this->request->data){
   $mcaNumber = $this->request->data['mcaNumber'];
   $user = Users::find('first',array(
    'conditions'=>array('mcaNumber'=>(string)$mcaNumber),
    'fields'=>array('mcaNumber','mcaName','Baseline')
   ));
  }
  return $this->render(array('json' => array("success"=>"Yes",'data'=>$user)));
}

public function saveProspects(){
 if($this->request->data){
  Prospects::create()->save($this->request->data);
 }
 return $this->render(array('json' => array("success"=>"Yes")));
}

public function getProspects(){
 if($this->request->data){
  $prospects = Prospects::find('all',array(
   'conditions'=>array(
   'mcaNumber'=>$this->request->data['mcaNumber'],
   'Joined'=>array('$exists'=>false)
   )
  ));
  $objections = Objections::find('all');
  
  return $this->render(array('json' => array("success"=>"Yes",'prospects'=>$prospects,'objections'=>$objections)));
 }
 return $this->render(array('json' => array("success"=>"No")));
}

public function getChecks($mcaNumber = null){

 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
 }
 
  $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
   $yyyymm = date('Y-m');
   $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
   $p2yyyymm = date("Y-m", strtotime("-2 month", strtotime(date("F") . "1")) );
   $p3yyyymm = date("Y-m", strtotime("-3 month", strtotime(date("F") . "1")) );
   $left = $user['left'];
   $right = $user['right'];
   $team = Users::find('all',array(
    'conditions'=> array(
      'left'=>array('$gt'=>$left),
      'right'=>array('$lt'=>$right),
      'Enable'=>'Yes',
      $p1yyyymm.'.Gross'=>array('$gt'=>0)
     ),
     'fields'=>array('mcaName','mcaNumber','refer',$p1yyyymm.'.Gross',$p2yyyymm.'.Gross',$p3yyyymm.'.Gross',$p1yyyymm.'.GBV',$p2yyyymm.'.GBV',$p3yyyymm.'.GBV',$p1yyyymm.'.Level',$p2yyyymm.'.Level',$p2yyyymm.'.Level')
    )
 );
 $me = array(   'user.mcaNumber'=>$user['mcaNumber'],
   'user.mcaName'=>$user['mcaName'],
   'user.'.$p1yyyymm.'.GBV' =>$user[$p1yyyymm]['GBV'],
   'user.'.$p2yyyymm.'.GBV' =>$user[$p2yyyymm]['GBV'],
   'user.'.$p3yyyymm.'.GBV' =>$user[$p3yyyymm]['GBV'],
   'user.'.$p1yyyymm.'.Gross' =>$user[$p1yyyymm]['Gross'],
   'user.'.$p2yyyymm.'.Gross' =>$user[$p2yyyymm]['Gross'],
   'user.'.$p3yyyymm.'.Gross' =>$user[$p3yyyymm]['Gross'],
   'user.'.$p1yyyymm.'.Level' =>$user[$p1yyyymm]['Level'],
   'user.'.$p2yyyymm.'.Level' =>$user[$p2yyyymm]['Level'],
   'user.'.$p3yyyymm.'.Level' =>$user[$p3yyyymm]['Level'],);
  // $this->_render['layout'] = 'noHeaderFooter';
  // return compact('me','team');
  return $this->render(array('json' => array("success"=>"Yes",
   'user'=>$me,
   'team'=>$team)));

 
}

public function getTargets(){
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
 }
 $yyyymm = date('Y-m');
 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
 $p2yyyymm = date("Y-m", strtotime("-2 month", strtotime(date("F") . "1")) );
 $p3yyyymm = date("Y-m", strtotime("-3 month", strtotime(date("F") . "1")) );
   
  $user = Users::find('first',array(
  'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
 
 $me = array(
  'mcaName'=>$user['mcaName'],
  'mcaNumber'=>$user['mcaNumber'],
  'DateJoin'=>$user['DateJoin'],
  'user.'.$yyyymm.'.Level' =>$user[$yyyymm]['Level']?:0,
  'user.'.$p1yyyymm.'.Level' =>$user[$p1yyyymm]['Level']?:0,
  'user.'.$p2yyyymm.'.Level' =>$user[$p2yyyymm]['Level']?:0,
  'user.'.$p3yyyymm.'.Level' =>$user[$p3yyyymm]['Level']?:0,
  'user.'.$yyyymm.'.Percent' =>$user[$yyyymm]['Percent']?:0,
  'user.'.$p1yyyymm.'.Percent' =>$user[$p1yyyymm]['Percent']?:0,
  'user.'.$p2yyyymm.'.Percent' =>$user[$p2yyyymm]['Percent']?:0,
  'user.'.$p3yyyymm.'.Percent' =>$user[$p3yyyymm]['Percent']?:0,
  'user.'.$yyyymm.'.Legs' =>$user[$yyyymm]['Legs']?:0,
  'user.'.$p1yyyymm.'.Legs' =>$user[$p1yyyymm]['Legs']?:0,
  'user.'.$p2yyyymm.'.Legs' =>$user[$p2yyyymm]['Levs']?:0,
  'user.'.$p3yyyymm.'.Legs' =>$user[$p3yyyymm]['Legs']?:0,
  'user.'.$yyyymm.'.PV' =>$user[$yyyymm]['PV']?:0,
  'user.'.$p1yyyymm.'.PV' =>$user[$p1yyyymm]['PV']?:0,
  'user.'.$p2yyyymm.'.PV' =>$user[$p2yyyymm]['PV']?:0,
  'user.'.$p3yyyymm.'.PV' =>$user[$p3yyyymm]['PV']?:0,
  'user.'.$yyyymm.'.GPV' =>$user[$yyyymm]['GPV']?:0,
  'user.'.$p1yyyymm.'.GPV' =>$user[$p1yyyymm]['GPV']?:0,
  'user.'.$p2yyyymm.'.GPV' =>$user[$p2yyyymm]['GPV']?:0,
  'user.'.$p3yyyymm.'.GPV' =>$user[$p3yyyymm]['GPV']?:0,
  'user.'.$yyyymm.'.GrossPV' =>$user[$yyyymm]['GrossPV']?:0,
  'user.'.$p1yyyymm.'.GrossPV' =>$user[$p1yyyymm]['GrossPV']?:0,
  'user.'.$p2yyyymm.'.GrossPV' =>$user[$p2yyyymm]['GrossPV']?:0,
  'user.'.$p3yyyymm.'.GrossPV' =>$user[$p3yyyymm]['GrossPV']?:0,
  'user.'.$yyyymm.'.PGPV' =>$user[$yyyymm]['PGPV']?:0,
  'user.'.$p1yyyymm.'.PGPV' =>$user[$p1yyyymm]['PGPV']?:0,
  'user.'.$p2yyyymm.'.PGPV' =>$user[$p2yyyymm]['PGPV']?:0,
  'user.'.$p3yyyymm.'.PGPV' =>$user[$p3yyyymm]['PGPV']?:0,
  'user.'.$yyyymm.'.GBV' =>$user[$yyyymm]['GBV']?:0,
  'user.'.$p1yyyymm.'.GBV' =>$user[$p1yyyymm]['GBV']?:0,
  'user.'.$p2yyyymm.'.GBV' =>$user[$p2yyyymm]['GBV']?:0,
  'user.'.$p3yyyymm.'.GBV' =>$user[$p3yyyymm]['GBV']?:0,
  'user.'.$yyyymm.'.PGBV' =>$user[$yyyymm]['PGBV']?:0,
  'user.'.$p1yyyymm.'.PGBV' =>$user[$p1yyyymm]['PGBV']?:0,
  'user.'.$p2yyyymm.'.PGBV' =>$user[$p2yyyymm]['PGBV']?:0,
  'user.'.$p3yyyymm.'.PGBV' =>$user[$p3yyyymm]['PGBV']?:0,
 );
 
  return $this->render(array('json' => array("success"=>"Yes",'user'=>$me,)));
}

 public function notification($mcaNumber=null){
  
  $notification = Notifications::find('first',array(
   'conditions'=>array(
    'mcaNumber'=>$mcaNumber,
    'action'=>array('$exists'=>false)
    )
  ));
  $findmobile = Mobiles::find('first',array(
   'conditions'=>array('mcaNumber'=>$notification['mcaNumberNew'])
  ));
 if(count($findmobile)==0){
  $findmobile = array('Mobile'=>'0000000000');
 }
 return $this->render(array('json' => array("success"=>"Yes",'notification'=>$notification,'mobile'=>$findmobile)));
}

public function newArchive(){
 if($this->request->data){
  $mcaNumber = $this->request->data['mcaNumber'];
  $_id = $this->request->data['_id'];
  
  $data = array('action'=>'Archive');
  $conditions = array(
   'mcaNumber'=>$mcaNumber,
   '_id'=>(string)$_id,
  );
  Notifications::update($data,$conditions);
  return $this->render(array('json' => array("success"=>"Yes")));
 } 
 return $this->render(array('json' => array("success"=>"No")));
}

public function byTUYNames(){
 $tuyNames = Malls::find('all',array(
  'order'=>array('TUYName'=>'ASC','InDemand'=>'Desc','Code'=>'ASC','Percent'=>'DESC')
 ));
 
 $tuy = array();
 $tuysub = array();
 $allTUY = array();
  foreach($tuyNames as $t){
    $tuyName = $t['TUYName'];
    if (in_array($t['TUYName'], $tuy) ) {
      continue;
    }
    $tuy[] = $t['TUYName'];
  }
  foreach($tuy as $t){
   foreach($tuyNames as $tn){
     if($t==$tn['TUYName']){
      array_push($tuysub,
       array(
       'Code'=>$tn['Code'],
       'Name'=>$tn['Name'],
       'Weight'=>$tn['Weight'],
       'MRP'=>$tn['MRP'],
       'DP'=>$tn['DP'],
       'BV'=>$tn['BV'],
       'PV'=>$tn['PV'],
       'Percent'=>$tn['Percent'],
       'Saving'=>$tn['Saving'],
       'SavingPercent'=>$tn['SavingPercent'],
       'InDemand'=>$tn['InDemand'],
       'BuyInLoyalty'=>$tn['BuyInLoyalty'],
       'TUYName'=>$tn['TUYName'],
       'Video'=>$tn['Video'],
      ));
     }
   }
     array_push($allTUY,array('TUYName'=>$t,'Values'=>$tuysub));
     $tuysub=array();
  }
 
 return $this->render(array('json' => array("success"=>"Yes",'TUY'=>$tuy,'Products'=>$allTUY,)));
}

public function getItemsCategory(){
 $category = $this->request->data['category'];
 $products = Malls::find("all",array(
  'conditions'=>array('Code'=> array('like'=>'/^'.$category.'/')),
  'order'=>array('TUYName'=>'ASC','Code'=>'ASC','Percent'=>'DESC')
 ));

 $tuy = array();
 $tuysub = array();
 $allTUY = array();
  foreach($products as $t){
    $tuyName = $t['TUYName'];
    if (in_array($t['TUYName'], $tuy) ) {
      continue;
    }
    $tuy[] = $t['TUYName'];
  }
  foreach($tuy as $t){
   foreach($products as $tn){
     if($t==$tn['TUYName']){
      array_push($tuysub,
       array(
       'Code'=>$tn['Code'],
       'Name'=>$tn['Name'],
       'Weight'=>$tn['Weight'],
       'MRP'=>$tn['MRP'],
       'DP'=>$tn['DP'],
       'BV'=>$tn['BV'],
       'PV'=>$tn['PV'],
       'Percent'=>$tn['Percent'],
       'Saving'=>$tn['Saving'],
       'SavingPercent'=>$tn['SavingPercent'],
       'InDemand'=>$tn['InDemand'],
       'BuyInLoyalty'=>$tn['BuyInLoyalty'],
       'TUYName'=>$tn['TUYName'],
       'Video'=>$tn['Video'],
      ));
     }
   }
     array_push($allTUY,array('TUYName'=>$t,'Values'=>$tuysub));
     $tuysub=array();
  }

 
 return $this->render(array('json' => array("success"=>"Yes",'TUY'=>$tuy,'Products'=>$allTUY)));
}

public function offers(){
  $this->_render['layout'] = 'sale';
}

public function invitees(){
 set_time_limit(0);
 $invitees = Invitees::find('all',
  array(
   'conditions'=>array('sent'=>"Yes-2")
  )
 );
 $x = 1;
 foreach($invitees as $i){
  $this->sendsmsinviteeonly('92143138',$this->request->data['message'],$i['Number']);
  $data = array(
   'sent'=>'Yes-3',
  );
  $conditions = array(
   'Number'=> $i['Number']
  );
  Invitees::update($data,$conditions);
  sleep(1);
  $x = $x +1;
 }
 
 return $this->render(array('json' => array("success"=>"Yes",'count'=>$x))); 
}


public function sendsmsinviteeonly($mcaNumber,$message,$mobile){
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
  ));
  $function = new Functions();
  $message = $message . "\n--".$user['mcaName']. "\n".str_replace("##","\n",$user['Inner']['mobile']);
  $mobile = "+91".$mobile;
  $function->twilio_api($mobile,$message);
 
 return true; 
}


public function outline(){
 ini_set('max_execution_time', '0');
 ini_set("memory_limit", "-1");
 
 if($this->request->data['id']!="0000"){
  $outline = Outlines::find('first',array(
   'conditions'=>array('_id'=>(string)$this->request->data['id']),
   'order'=>array('_id'=>'ASC')
  ));
  $id = $outline['id'];
 }else{
  $outline = Outlines::find('first',array(
   'order'=>array('_id'=>'ASC')
  ));
  $id = $outline['_id'];
 }
 
 $allLevels = array();
  
 array_push($allLevels,array(
   'id' => (string)$outline['_id'],
   'left'=>$outline['left'],
   'right'=>$outline['right'],
   'outline_audio'=>$outline['outline_audio']?:"",
   'outline_image'=>$outline['outline_image']?:"",
   'outline_description'=>$outline['outline_description']?:"",
   'outline_order'=>$outline['outline_order']?:"",
   'outline_pdf'=>$outline['outline_pdf']?:"",
   'outline_text'=>$outline['outline_text']?:"",
   'outline_url'=>$outline['outline_url']?:"",
   'outline_video'=>$outline['outline_video']?:"",
   'outline_name'=>$outline['outline_name']?:"",
   'outline_refer_id'=>$outline['outline_refer_id']?:"",
 ));
 
    $outlines = Outlines::find('all',array(
    'conditions'=>array(
     'outline_refer_id'=>(string)$outline['_id']
    ),
    'order'=>array('_id'=>'ASC'),
    ));

    foreach($outlines as $o){
     array_push($allLevels,array(
     'id' => (string)$o['_id'],
     'left'=>$o['left'],
     'right'=>$o['right'],
     'outline_audio'=>$o['outline_audio']?:"",
     'outline_image'=>$o['outline_image']?:"",
     'outline_description'=>$o['outline_description']?:"",
     'outline_order'=>$o['outline_order']?:"",
     'outline_pdf'=>$o['outline_pdf']?:"",
     'outline_text'=>$o['outline_text']?:"",
     'outline_url'=>$o['outline_url']?:"",
     'outline_video'=>$o['outline_video']?:"",
     'outline_name'=>$o['outline_name']?:"",
     'outline_refer_id'=>$o['outline_refer_id']?:"",
    ));
    }
 
 
 return $this->render(array('json' => array("success"=>"Yes",'count'=>count($allLevels),'Levels'=>$allLevels))); 
}

function callFollowup($mobile,$date, $time, $title, $speaker){
   $function = new Functions();
   $returncall = $function->twilioCall("+91".$mobile,$date, $time, $title, $speaker);  // Testing if it works  
   return $this->render(array('json' => array("success"=>"Yes")));
}

//end of class
}


