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
use app\models\Names;
use app\models\Dporders;
use app\models\Settings;

use \MongoRegex;
use \MongoClient;

class ModicareController extends \lithium\action\Controller {


 protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'savings';
 }
 public function index(){
  $CategoriesArray = array(
  'HC' => 'Home Care 50%',
  'AB' => 'Agarbatti 30%',
  'LC' => 'Laundry Care 35% & 60%',
  'PC' => 'Personal Care 10% to 60%',
  'FP' => 'Food & Beverages 10% - 65%',
  'SC' => 'Skin Care 60%',
  'FS' => 'Food Supplement 60%',
  'MJ' => 'Jewelery 40%',
  'UC' => 'Cosmetics - Urban Color 60%',
  'BC' => 'Baby Care 40 - 60%',
  'AG' => 'Agriculture 60%',
  'AC' => 'Auto Care 50%',
  'HL' => 'Wellness 40-60%',
  'WA' => 'Watches 50%',
  'MG' => 'Technology 60%',
  '00' => 'Others 10% to 60%',
  '60' => 'Extra 0% to 60%',
  );
  $CategoriesSwiperArray = array(
    'HC' => array('Name'=>'Home Care','color'=>'#e53935','percent'=>'50%'),
    'AB' => array('Name'=>'Agarbatti','color'=>'#e239A5','percent'=>'30%'),
    'LC' => array('Name'=>'Laundry Care','color'=>'#303f9f','percent'=>'35% to 60%'),
    'PC' => array('Name'=>'Personal Care','color'=>'#8e24aa','percent'=>'10% to 50%'),
    'FP' => array('Name'=>'Food & Beverages','color'=>'#00796b','percent'=>'10% to 50%'),
    'SC' => array('Name'=>'Skin Care','color'=>'#0288d1','percent'=>'60%'),
    'MJ' => array('Name'=>'Jewelery','color'=>'#455a64','percent'=>'40%'),
    'UC' => array('Name'=>'Cosmetics - Urban Color','color'=>'#388e3c','percent'=>'60%'),
    'BC' => array('Name'=>'Baby Care','color'=>'#afb42b','percent'=>'40% to 60%'),
    'AG' => array('Name'=>'Agriculture','color'=>'#fbc02d','percent'=>'60%'),
    'AC' => array('Name'=>'Auto Care','color'=>'#e64a19','percent'=>'50%'),
    'HL' => array('Name'=>'Wellness','color'=>'#6d4c41','percent'=>'40% to 60%'),
    'WA' => array('Name'=>'Watches','color'=>'#0097a7','percent'=>'50%'),
    'MG' => array('Name'=>'Technology','color'=>'#01579b','percent'=>'60%'),
				'00' => array('Name'=>'Others','color'=>'#01579b','percent'=>'105 to 60%'),
				'60' => array('Name'=>'Extra','color'=>'#01579b','percent'=>'0%'),
    );
  $products = Malls::find('all',array(
   'order'=>array('DP'=>'ASC','Name'=>'ASC')
  ));
  $AllProducts = array();
  
  foreach($products as $p){
					$names = Names::find('first',array(
						'conditions'=>array('Code'=>$p['Code'])
					));
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
				'Video'=>$names['Video'],
				'Short'=>$names['Short'],
				'Category'=>$names['Category'],
				'Description'=>$names['Description'],
				'Hindi'=>$names['Hindi'],

   ));
  }

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
public function getproducts(){
 $products = Malls::find('all',array(
  'order'=>array('Code'=>'ASC','Name'=>'ASC')
 ));
 
 $allproducts = array();
 foreach ($products as $p){
					$names = Names::find('first',array(
						'conditions'=>array('Code'=>$p['Code'])
					));

  array_push($allproducts,array(
   'Code'=>$p['Code'],
   'Name'=>$p['Name'],
			'Short'=>$names['Short'],
			'Category'=>$names['Category'],
  ));
 }
 
 return $this->render(array('json' => array("success"=>"Yes",'products'=>$allproducts)));   
}

public function getproductsimages(){
  $CategoriesArray = array(
  'HC' => 'Home Care',
  'AB' => 'Agarbatti',
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
 
 $allproducts = array();
 foreach($CategoriesArray as $key=>$val){
  $Code = $key;
  //print_r($Code);
  $data = array(
   'category'=>$val,
   'category_'=> str_replace(" ","_",$val),
  );
  
  
  $products = Malls::find('all',array(
   'conditions'=>array('Code'=> array('like'=>'/^'.$Code.'/')),
  ));
  $allparams = array();
    foreach($products as $p){
      $dataParam = array(
       'url'=>'https://sff.team/img/products/'. $p['Code'].'.jpg',
       'caption'=> '<span class="text-color-yellow"> &nbsp;'.$val.'&nbsp; </span><br>'.$p['Name'].' <br>['.$p['Code'].'] <span class="text-color-red">MRP: <strike>'.number_format($p['MRP'],2).'</strike></span> <span class="text-color-green">DP: '.number_format($p['DP'],2).'<span class="text-color-yellow"> PV: '.number_format($p['PV'],2).'</span> <span class="text-color-green">BV: '.number_format($p['BV'],2).'</span> <span class="text-color-blue">'.number_format($p['BV']/$p['DP']*100,0).'%</span>',
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
					$names = Names::find('first',array(
						'conditions'=>array('Code'=>$tn['Code'])
					));
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
       'Video'=>$names['Video'],
							'Short'=>$names['Short'],
							'Category'=>$names['Category'],
							'Description'=>$names['Description'],
							'Hindi'=>$names['Hindi'],
      ));
     }
   }
     array_push($allTUY,array('TUYName'=>$t,'Values'=>$tuysub));
     $tuysub=array();
  }

 
 return $this->render(array('json' => array("success"=>"Yes",'TUY'=>$tuy,'Products'=>$allTUY)));
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
				$names = Names::find('first',array(
					'conditions'=>array('Code'=>$code)
				));
   array_push($CartProducts,array(
    'Code' => $product['Code'],
    'Name' => $product['Name'],
    'MRP' => $product['MRP'],
    'DP' => $product['DP'],
    'BV' => $product['BV'],
    'PV' => $product['PV'],
    'Weight' => $product['Weight'],
    'Percent' => $product['Percent'],
    'Quantity'=> (integer)$quantity,
				'Short'=>$names['Short'],
				'Category'=>$names['Category'],
   ));
   }
   
   $settings = Settings::find('first');
    $walletpoints = round($product['BV']*$quantity*$settings['WalletPoints']/100,0);
    if($product['discountType']=="Rs"){
     $totalPV = floatval(($product['PV']));
     $totalBV = floatval(($product['BV']));
     $totalDP = floatval(($product['DP']));
     $totalWeight = floatval(($product['Weight']));
     $totalvalue = floatval(($product['MRP'] - $product['discount'])*$quantity);
    }else if($product['discountType']=="Percent"){
     $totalPV = floatval(($product['PV'])); 
     $totalBV = floatval(($product['BV']));
     $totalDP = floatval(($product['DP']));
     $totalWeight = floatval(($product['Weight']));
     $totalvalue = floatval(($product['MRP']-$product['MRP']*$product['discount']/100)*$quantity); 
    }else{
     $totalPV = floatval($product['PV']*$quantity); 
     $totalBV = floatval($product['BV']*$quantity); 
     $totalDP = floatval($product['DP']*$quantity);
     $totalWeight = floatval(($product['Weight']));
     $totalvalue = floatval($product['MRP']*$quantity); 
    }
    $wp = $wp + $walletpoints;
    $value = $value + $totalvalue;
    $valueBV = $valueBV + $totalBV;
    $valuePV = $valuePV + $totalPV;
    $valueDP = $valueDP + $totalDP;
    $valueWeight = $valueWeight + $totalWeight;
  }
  return $this->render(array('json' => array("success"=>"Yes","value"=>$value,"valueBV"=>$valueBV,"valuePV"=>$valuePV,"valueDP"=>$valueDP,"valueWeight"=>$valueWeight,"CartProducts"=>$CartProducts,'mcaNumber'=>$cart['mcaNumber'])));  
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
			$totalPV = floatval($product['PV']*$quantity); 
			$totalBV = floatval($product['BV']*$quantity); 
			$totalDP = floatval($product['DP']*$quantity); 
			$totalvalue = floatval($product['MRP']*$quantity); 
			$totalWeight = floatval($product['Weight']*$quantity); 

    $value = $value + $totalvalue;
    $valueBV = $valueBV + $totalBV;
    $valuePV = $valuePV + $totalPV;
    $valueDP = $valueDP + $totalDP;
    $valueWeight = $valueWeight + $totalWeight;
   }
   
  return $this->render(array('json' => array("success"=>"Yes","value"=>$value,"valueBV"=>$valueBV?:0,"valuePV"=>$valuePV?:0,"valueDP"=>$valueDP?:0,"weight"=>$valueWeight?:0)));  

 }
public function product($Code,$format=null){
  $product = Malls::find('first',array(
   'conditions'=>array('Code'=> $Code)
  ));
  if($format=="jpg"){
   return compact('product');
  }
		$names = Names::find('first',array(
			'conditions'=>array('Code'=>$Code)
		));
				$product['Video']=$names['Video'];
				$product['Short']=$names['Short'];
				$product['Category']=$names['Category'];
				$product['Description']=$names['Description'];
				$product['Hindi']=$names['Hindi'];
 return $this->render(array('json' => array("success"=>"Yes","product"=>$product)));  
}

public function cartsubmit(){
  
  $products = array();
  foreach($this->request->data as $key=>$val){
   if(substr($key,0,9)=="minusCode"){
   $Code = str_replace("minusCode","",$key);
   $prices = Malls::find('first',array(
   'conditions'=>array('Code'=> $Code)
   ));
   $names = Names::find('first',array(
   'conditions'=>array('Code'=> $Code)
   ));    
    array_push($products, 
     array(
      'Code'=>str_replace("minusCode","",$key),
      'Quantity'=>(integer)$val,
						'MRP'=>$prices['MRP'],
      'DP'=>$prices['DP'],
						'BV'=>$prices['BV'],
						'PV'=>$prices['PV'],
      'Value' => (integer)$val * $prices['DP'],
      'Name'=>$prices['Name'],
						'Short'=>$names['Short'],
						'Category'=>$names['Category'],
      'Weight'=>$prices['Weight'],
      )
    ); 
   }
     $totalPV = floatval($prices['PV']*$val); 
     $totalBV = floatval($prices['BV']*$val); 
     $totalDP = floatval($prices['DP']*$val);
     $totalWeight = floatval(($prices['Weight']*$val));
     $totalMRP = floatval($prices['MRP']*$val); 
					
    $value = $value + $totalMRP;
    $valueBV = $valueBV + $totalBV;
    $valuePV = $valuePV + $totalPV;
    $valueDP = $valueDP + $totalDP;
    $valueWeight = $valueWeight + $totalWeight;

  }
  $data = array(
   'Name'=>$this->request->data['C_name'],
			'mcaNumber'=>$this->request->data['C_mcaNumber'],
   'Mobile'=>$this->request->data['C_mobile'],
			'DP_Mobile'=>$this->request->data['DP_mobile'],
   'Address'=>$this->request->data['C_address'],
   'Pincode'=>$this->request->data['C_pincode'],
   'Products'=>$products,
   'DateTime'=>date('d-m-Y'),
  );
  Dporders::create()->save($data);
    return $this->render(array('json' => array("success"=>"Yes",'data'=>$data,"value"=>$value,"valueBV"=>$valueBV,"valuePV"=>$valuePV,"valueDP"=>$valueDP,"valueWeight"=>$valueWeight,)));
 }


//end of class
}


