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
    'HC' => array('Name'=>'Home Care','r'=>229,'g'=>57, 'b'=>53,'color'=>'#e53935','percent'=>'50%'),
    'AB' => array('Name'=>'Agarbatti','r'=>229,'g'=>57, 'b'=>53,'color'=>'#e239A5','percent'=>'30%'),
    'LC' => array('Name'=>'Laundry Care','r'=>229,'g'=>57, 'b'=>53,'color'=>'#303f9f','percent'=>'35% to 60%'),
    'PC' => array('Name'=>'Personal Care','r'=>229,'g'=>57, 'b'=>53,'color'=>'#8e24aa','percent'=>'10% to 50%'),
    'FP' => array('Name'=>'Food & Beverages','r'=>229,'g'=>57, 'b'=>53,'color'=>'#00796b','percent'=>'10% to 50%'),
    'SC' => array('Name'=>'Skin Care','r'=>229,'g'=>57, 'b'=>53,'color'=>'#0288d1','percent'=>'60%'),
    'MJ' => array('Name'=>'Jewelery','r'=>229,'g'=>57, 'b'=>53,'color'=>'#455a64','percent'=>'40%'),
    'UC' => array('Name'=>'Cosmetics - Urban Color','r'=>229,'g'=>57, 'b'=>53,'color'=>'#388e3c','percent'=>'60%'),
    'BC' => array('Name'=>'Baby Care','r'=>229,'g'=>57, 'b'=>53,'color'=>'#afb42b','percent'=>'40% to 60%'),
    'AG' => array('Name'=>'Agriculture','r'=>229,'g'=>57, 'b'=>53,'color'=>'#fbc02d','percent'=>'60%'),
    'AC' => array('Name'=>'Auto Care','r'=>229,'g'=>57, 'b'=>53,'color'=>'#e64a19','percent'=>'50%'),
    'HL' => array('Name'=>'Wellness','r'=>229,'g'=>57, 'b'=>53,'color'=>'#6d4c41','percent'=>'40% to 60%'),
    'WA' => array('Name'=>'Watches','r'=>229,'g'=>57, 'b'=>53,'color'=>'#0097a7','percent'=>'50%'),
    'MG' => array('Name'=>'Technology','r'=>229,'g'=>57, 'b'=>53,'color'=>'#01579b','percent'=>'60%'),
				'00' => array('Name'=>'Others','r'=>229,'g'=>57, 'b'=>53,'color'=>'#01579b','percent'=>'105 to 60%'),
				'60' => array('Name'=>'Extra','r'=>229,'g'=>57, 'b'=>53,'color'=>'#01579b','percent'=>'0%'),
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

public function dplabels(){
	ini_set('memory_limit','-1');
 set_time_limit(0);
 $products = Names::find('all',array(
		'order'=>array('Code'=>'ASC')
	));
	$arrayImages = array();
	foreach($products as $p){
		$file = $this->createImageInstantly($p['Code']);
		array_push($arrayImages,$file);
	}

	return $this->render(array('json' => array("success"=>"Yes",'Images'=>$arrayImages)));
}

public function createImageInstantly($Code){
	ini_set('memory_limit','-1');
 set_time_limit(0);
	$p = Names::find('first',array(
		'conditions'=>array('Code'=>$Code)
	));
	$m = Malls::find('first',array(
		'conditions'=>array('Code'=>$Code)
	));	
	$x=1200;$y=450;
	$code = $p['Code'];
	$short = $p['Short'];
	$category = $p['Category'];
	$MRP = $m['MRP'];
	$DP = $m['DP'];
	$BV = $m['BV'];
	$PV = $m['PV'];
	$Weight = round($m['Weight']/100)*100;
	header('Content-Type: image/png');
	$targetFolder = '/app/webroot/img/dpimages/';
	$imageFolder = '/app/webroot/img/products/';
	$fontFolder = '/';

	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$imagePath = $_SERVER['DOCUMENT_ROOT'] . $imageFolder;
	
	$outputImage = imagecreatetruecolor($x, $y);
	$white = imagecolorallocate($outputImage, 255, 255, 255);
	$black = imagecolorallocate($outputImage, 0, 0, 0);
	$red = imagecolorallocate($outputImage, 255, 0, 0);
	$blue = imagecolorallocate($outputImage, 0, 0, 255);
	$green = imagecolorallocate($outputImage, 0, 102, 0);
	$brown = imagecolorallocate($outputImage, 102, 0, 0);



	imagefill($outputImage, 0, 0, $white);
	$text = 'MRP: '.$MRP;
	// $widthCode = $x - strlen(trim($code.$short))*100/2;
	// $widthCategory = $x - strlen(trim($category))*150/2;
	// $widthMRP = $x - strlen(trim("MRP: ".number_format($MRP,1)))*160/2;
	// $widthDP = $x - strlen(trim("DP: ".number_format($DP,1)))*170/2;
	// $widthBVPV = $x - strlen(trim("BV: ".number_format($BV,1))."  -  ".trim("PV: ".number_format($PV,1)))*80/2;
	
	$widthCode = $widthCategory = $widthMRP = $widthDP = $widthBVPV = 30;
	
		$img = $imagePath.$code."_400.jpg";
  $first = imagecreatefromjpeg($img);
  imagecopyresized($outputImage,$first,700,0,0,0, 400, 400,380,380);

	
	imagettftext($outputImage, 36, 0, $widthCode, 100, $black, './fonts/GothamBold.ttf', wordwrap(" ".$code." ".$short ,50,"\n",true));
	imagettftext($outputImage, 40, 0, $widthCategory,170, $black, './fonts/GothamBold.ttf', wordwrap(" ".$category ,50,"\n",true));
	
	
	imagettftext($outputImage, 50, 0, $widthMRP,240, $red, './fonts/GothamBold.ttf', wordwrap(" ".trim("MRP: ".number_format($MRP,1)) ,40,"\n",true));
	
	imageline($outputImage,50,190,500,240,$black);
	imageline($outputImage,51,191,501,241,$black);
	imageline($outputImage,50,240,500,190,$black);
	imageline($outputImage,51,241,501,191,$black);
	
	imageline($outputImage,1,1,1200,1,$black);
	imageline($outputImage,1,3,1200,3,$black);
	
	imageline($outputImage,1,1,1,450,$black);
	imageline($outputImage,3,1,3,450,$black);
	
	imageline($outputImage,1,449,1200,449,$black);
	imageline($outputImage,1,447,1200,447,$black);
	
	imageline($outputImage,1199,1,1199,449,$black);
	imageline($outputImage,1197,1,1197,449,$black);
	
	
	imagettftext($outputImage, 50, 0, $widthDP,310, $blue, './fonts/GothamBold.ttf', wordwrap(" ".trim("DP: ".number_format($DP,1)) ,40,"\n",true));
	imagettftext($outputImage, 40, 0, $widthBVPV,370, $green, './fonts/GothamBold.ttf', wordwrap(" ".trim("BV: ".number_format($BV,1))."  -  ".trim("PV: ".number_format($PV,1)) ,30,"\n",true));
	imagettftext($outputImage, 30, 0, $widthBVPV,410, $black, './fonts/GothamBold.ttf', wordwrap(" ".number_format($BV/$DP*100,0)."%" ,30,"\n",true));
	
	imagettftext($outputImage, 20, 0, 35,30, $black, './fonts/Raleway-Medium.ttf', wordwrap("WeCapacitate" ,60,"\n",true));

	$filename='x-'.$code.'.png';
	imagepng($outputImage, $targetPath . $filename);
	imagedestroy($outputImage);
	return compact('code','short','category','MRP','DP','BV','PV','Weight');
}

public function banner($Code=null){
	$products = Names::find('all',array(
		'conditions'=>array('Code'=> array('like'=>'/^'.$Code.'/')),
	));
	$arrayImages = array();
	
	ini_set('memory_limit','-1');
 set_time_limit(0);
	$x=2400;$y=30000;
	header('Content-Type: image/png');
	$targetFolder = '/app/webroot/img/dpimages/';
	$imageFolder = '/app/webroot/img/products/';
	$fontFolder = '/';

	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$imagePath = $_SERVER['DOCUMENT_ROOT'] . $imageFolder;
	
	$outputImage = imagecreatetruecolor($x, $y);
	$white = imagecolorallocate($outputImage, 255, 255, 255);
	$black = imagecolorallocate($outputImage, 0, 0, 0);
	$red = imagecolorallocate($outputImage, 255, 0, 0);
	$blue = imagecolorallocate($outputImage, 0, 0, 255);
	$green = imagecolorallocate($outputImage, 0, 102, 0);
	$brown = imagecolorallocate($outputImage, 102, 0, 0);
	imagefill($outputImage, 0, 0, $white);
	
	
	$filename=$Code.'.png';
	$xx = 0;
	$yy = 0;
	foreach($products as $p){
	$m = Malls::find('first',array(
		'conditions'=>array('Code'=>$p['Code'])
	));	
	$pr = Names::find('first',array(
		'conditions'=>array('Code'=>$p['Code'])
	));
	$code = $pr['Code'];
	$short = $pr['Short'];
	$category = $pr['Category'];
		$img = $imagePath.$code."_400.jpg";
  $first = imagecreatefromjpeg($img);


  imagecopyresized($outputImage,$first,$xx,$yy,0,0, 400, 400,398,398);
  imageline($outputImage,$xx,$yy,($xx+400),($yy),$black);
		imageline($outputImage,($xx+400),$yy,($xx+400),($yy+500),$black);
		
  imagettftext($outputImage, 12, 0, ($xx+20), ($yy+430), $black, './fonts/GothamBold.ttf', wordwrap(" ".$code." ".$short ,50,"\n",true));
  imagettftext($outputImage, 12, 0, ($xx+20), ($yy+460), $black, './fonts/GothamBold.ttf', wordwrap(" ".$category ,50,"\n",true));
		
		$xx = $xx + 400;
		if($xx == 2400){
			$yy = $yy + 500;
			$xx = 0;
		}
	}
	imagepng($outputImage, $targetPath . $filename);
	imagedestroy($outputImage);
	return $this->render(array('json' => array("success"=>"Yes",'Images'=>$Code)));
	
}

public function dtod(){
	ini_set('memory_limit','-1');
 set_time_limit(0);
 $products = Names::find('all',array(
		'order'=>array('Code'=>'ASC')
	));
	$arrayImages = array();
	foreach($products as $p){
		$file = $this->createImageInstantlydtod($p['Code']);
		array_push($arrayImages,$file);
	}

	return $this->render(array('json' => array("success"=>"Yes",'Images'=>$arrayImages)));
}

public function createImageInstantlydtod($Code){
	ini_set('memory_limit','-1');
 set_time_limit(0);
	$p = Names::find('first',array(
		'conditions'=>array('Code'=>$Code)
	));
	$m = Malls::find('first',array(
		'conditions'=>array('Code'=>$Code)
	));	
	$x=600;$y=800;
	$code = $p['Code'];
	$short = $p['Short'];
	$category = $p['Category'];
	$desc = $p['Description'];
	$MRP = $m['MRP'];
	$DP = $m['DP'];
	$BV = $m['BV'];
	$PV = $m['PV'];
	$Weight = round($m['Weight']/100)*100;
	header('Content-Type: image/png');
	$targetFolder = '/app/webroot/img/dpimages/';
	$imageFolder = '/app/webroot/img/products/';
	$fontFolder = '/';

	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$imagePath = $_SERVER['DOCUMENT_ROOT'] . $imageFolder;

  $Categories = array(
    'HC' => array('Name'=>'Home Care','r'=>229,'g'=>57, 'b'=>53,'color'=>'#e53935','percent'=>'50%'),
    'AB' => array('Name'=>'Agarbatti','r'=>227,'g'=>167, 'b'=>165,'color'=>'#e239A5','percent'=>'30%'),
    'LC' => array('Name'=>'Laundry Care','r'=>48,'g'=>63, 'b'=>159,'color'=>'#303f9f','percent'=>'35% to 60%'),
    'PC' => array('Name'=>'Personal Care','r'=>142,'g'=>36, 'b'=>170,'color'=>'#8e24aa','percent'=>'10% to 50%'),
    'FP' => array('Name'=>'Food & Beverages','r'=>0,'g'=>121, 'b'=>107,'color'=>'#00796b','percent'=>'10% to 50%'),
    'SC' => array('Name'=>'Skin Care','r'=>2,'g'=>136, 'b'=>209,'color'=>'#0288d1','percent'=>'60%'),
    'MJ' => array('Name'=>'Jewelery','r'=>69,'g'=>90, 'b'=>100,'color'=>'#455a64','percent'=>'40%'),
    'UC' => array('Name'=>'Cosmetics - Urban Color','r'=>56,'g'=>142, 'b'=>60,'color'=>'#388e3c','percent'=>'60%'),
    'BC' => array('Name'=>'Baby Care','r'=>175,'g'=>180, 'b'=>43,'color'=>'#afb42b','percent'=>'40% to 60%'),
    'AG' => array('Name'=>'Agriculture','r'=>251,'g'=>192, 'b'=>45,'color'=>'#fbc02d','percent'=>'60%'),
    'AC' => array('Name'=>'Auto Care','r'=>230,'g'=>74, 'b'=>35,'color'=>'#e64a19','percent'=>'50%'),
    'HL' => array('Name'=>'Wellness','r'=>109,'g'=>76, 'b'=>67,'color'=>'#6d4c41','percent'=>'40% to 60%'),
    'WA' => array('Name'=>'Watches','r'=>0,'g'=>151, 'b'=>167,'color'=>'#0097a7','percent'=>'50%'),
    'MG' => array('Name'=>'Technology','r'=>1,'g'=>87, 'b'=>155,'color'=>'#01579b','percent'=>'60%'),
				'00' => array('Name'=>'Others','r'=>14,'g'=>18, 'b'=>155,'color'=>'#01579b','percent'=>'105 to 60%'),
				'60' => array('Name'=>'Extra','r'=>22,'g'=>180, 'b'=>34,'color'=>'#01579b','percent'=>'0%'),
    );



	$outputImage = imagecreatetruecolor($x, $y);
		foreach($Categories as $key=>$val){
			if(substr($Code,0,2)==$key){
				$background = imagecolorallocate($outputImage, $val['r'], $val['g'], $val['b']);
			}
		}
	
	$white = imagecolorallocate($outputImage, 255, 255, 255);
	$black = imagecolorallocate($outputImage, 0, 0, 0);
	$red = imagecolorallocate($outputImage, 255, 0, 0);
	$blue = imagecolorallocate($outputImage, 0, 0, 255);
	$green = imagecolorallocate($outputImage, 0, 102, 0);
	$brown = imagecolorallocate($outputImage, 102, 0, 0);
	
	imagefill($outputImage, 0, 0, $white);
	$text = 'MRP: '.$MRP;
	$widthCode = $widthCategory = $widthMRP = $widthDP = $widthBVPV = 30;
	
		$img = $imagePath.$code."_400.jpg";
  $first = imagecreatefromjpeg($img);
		
		$img = $imagePath."WeCap-logo.jpg";
		$second = imagecreatefromjpeg($img);
		
		$img = $imagePath."ModiCare-Logo.jpg";
		$third = imagecreatefromjpeg($img);
		
  imagecopyresized($outputImage,$first,100,130,0,0, 400, 400,380,380);
		imagecopy($outputImage,$second,10,130,0,0,80,80);
		imagecopy($outputImage,$third,490,130,0,0,100,34);

	imagefilledrectangle($outputImage,0,0,$x,80, $background);
	imagettftext($outputImage, 20, 0, $widthCode, 110, $black, './fonts/GothamBold.ttf', wordwrap(" ".$code." ".$short ,50,"\n",true));
	imagettftext($outputImage, 26, 0, $widthCategory,50, $white, './fonts/GothamBold.ttf', wordwrap(" ".$category ,50,"\n",true));
//	imagettftext($outputImage, 20, 0, $widthCode,50, $brown, './fonts/GothamBold.ttf', wordwrap(" ".$Weight ,50,"\n",true));
	$a = $this->imagettftextjustified($outputImage, 14, 0, 20, 550, $black, './fonts/GothamBook.ttf', $desc, 550, $minspacing=3,$linespacing=1);
//	imagettftext($outputImage, 14, 0, 10,550, $black, './fonts/GothamBook.ttf', wordwrap($desc ,60,"\n",true));
	
	$filename=$code.'.png';
	imagepng($outputImage, $targetPath . $filename);
	imagedestroy($outputImage);
	return compact('code','short','category','MRP','DP','BV','PV','Weight');
}

public function costing(){
	ini_set('memory_limit','-1');
 set_time_limit(0);
 $products = Names::find('all',array(
		'order'=>array('Code'=>'ASC')
	));
	$arrayImages = array();
	foreach($products as $p){
		$file = $this->createImageInstantlydcosting($p['Code']);
		array_push($arrayImages,$file);
	}

	return $this->render(array('json' => array("success"=>"Yes",'Images'=>$arrayImages)));
}

public function createImageInstantlydcosting($Code){
	ini_set('memory_limit','-1');
 set_time_limit(0);
	$p = Names::find('first',array(
		'conditions'=>array('Code'=>$Code)
	));
	$m = Malls::find('first',array(
		'conditions'=>array('Code'=>$Code)
	));	
	$x=900;$y=1600;
	$code = $p['Code'];
	$short = $p['Short'];
	$category = $p['Category'];
	$desc = $p['Description'];
	$MRP = $m['MRP'];
	$DP = $m['DP'];
	$BV = $m['BV'];
	$PV = $m['PV'];
	$Weight = round($m['Weight']/100)*100;
	header('Content-Type: image/png');
	$targetFolder = '/app/webroot/img/costing/';
	$imageFolder = '/app/webroot/img/products/';
	$fontFolder = '/';

	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$imagePath = $_SERVER['DOCUMENT_ROOT'] . $imageFolder;

  $Categories = array(
    'HC' => array('Name'=>'Home Care','r'=>229,'g'=>57, 'b'=>53,'color'=>'#e53935','percent'=>'50%'),
    'AB' => array('Name'=>'Agarbatti','r'=>227,'g'=>167, 'b'=>165,'color'=>'#e239A5','percent'=>'30%'),
    'LC' => array('Name'=>'Laundry Care','r'=>48,'g'=>63, 'b'=>159,'color'=>'#303f9f','percent'=>'35% to 60%'),
    'PC' => array('Name'=>'Personal Care','r'=>142,'g'=>36, 'b'=>170,'color'=>'#8e24aa','percent'=>'10% to 50%'),
    'FP' => array('Name'=>'Food & Beverages','r'=>0,'g'=>121, 'b'=>107,'color'=>'#00796b','percent'=>'10% to 50%'),
    'SC' => array('Name'=>'Skin Care','r'=>2,'g'=>136, 'b'=>209,'color'=>'#0288d1','percent'=>'60%'),
    'MJ' => array('Name'=>'Jewelery','r'=>69,'g'=>90, 'b'=>100,'color'=>'#455a64','percent'=>'40%'),
    'UC' => array('Name'=>'Cosmetics - Urban Color','r'=>56,'g'=>142, 'b'=>60,'color'=>'#388e3c','percent'=>'60%'),
    'BC' => array('Name'=>'Baby Care','r'=>175,'g'=>180, 'b'=>43,'color'=>'#afb42b','percent'=>'40% to 60%'),
    'AG' => array('Name'=>'Agriculture','r'=>251,'g'=>192, 'b'=>45,'color'=>'#fbc02d','percent'=>'60%'),
    'AC' => array('Name'=>'Auto Care','r'=>230,'g'=>74, 'b'=>35,'color'=>'#e64a19','percent'=>'50%'),
    'HL' => array('Name'=>'Wellness','r'=>109,'g'=>76, 'b'=>67,'color'=>'#6d4c41','percent'=>'40% to 60%'),
    'WA' => array('Name'=>'Watches','r'=>0,'g'=>151, 'b'=>167,'color'=>'#0097a7','percent'=>'50%'),
    'MG' => array('Name'=>'Technology','r'=>1,'g'=>87, 'b'=>155,'color'=>'#01579b','percent'=>'60%'),
				'00' => array('Name'=>'Others','r'=>14,'g'=>18, 'b'=>155,'color'=>'#01579b','percent'=>'105 to 60%'),
				'60' => array('Name'=>'Extra','r'=>22,'g'=>180, 'b'=>34,'color'=>'#01579b','percent'=>'0%'),
    );



	$outputImage = imagecreatetruecolor($x, $y);
		foreach($Categories as $key=>$val){
			if(substr($Code,0,2)==$key){
				$background = imagecolorallocate($outputImage, $val['r'], $val['g'], $val['b']);
			}
		}
	
	$white = imagecolorallocate($outputImage, 255, 255, 255);
	$black = imagecolorallocate($outputImage, 0, 0, 0);
	$red = imagecolorallocate($outputImage, 255, 0, 0);
	$blue = imagecolorallocate($outputImage, 0, 0, 255);
	$green = imagecolorallocate($outputImage, 0, 102, 0);
	$brown = imagecolorallocate($outputImage, 102, 0, 0);
	
	imagefill($outputImage, 0, 0, $white);
	$text = 'MRP: '.$MRP;
	$widthCode = $widthCategory = $widthMRP = $widthDP = $widthBVPV = 30;
	
		$img = $imagePath.$code."_400.jpg";
  $first = imagecreatefromjpeg($img);
		
		$img = $imagePath."WeCap-logo.jpg";
		$second = imagecreatefromjpeg($img);
		
		$img = $imagePath."ModiCare-Logo.jpg";
		$third = imagecreatefromjpeg($img);
		
  imagecopyresized($outputImage,$first,260,130,0,0, 280, 280,400,400);
		imagecopy($outputImage,$second,10,130,0,0,80,80);
		imagecopy($outputImage,$third,780,130,0,0,100,34);

	imagefilledrectangle($outputImage,0,0,$x,80, $background);
	imagettftext($outputImage, 20, 0, $widthCode, 110, $black, './fonts/GothamBold.ttf', wordwrap(" ".$code." ".$short ,50,"\n",true));
	imagettftext($outputImage, 26, 0, $widthCategory,50, $white, './fonts/GothamBold.ttf', wordwrap(" ".$category ,50,"\n",true));
	imagettftext($outputImage, 26, 0, 750,50, $white, './fonts/GothamBold.ttf', wordwrap(" ".number_format($BV/$DP*100,0).'%' ,150,"\n",true));
//	imagettftext($outputImage, 20, 0, $widthCode,50, $brown, './fonts/GothamBold.ttf', wordwrap(" ".$Weight ,50,"\n",true));

	imageline($outputImage,50,420,850,420,$black);
	imageline($outputImage,50,470,850,470,$black);
	imageline($outputImage,50,520,850,520,$black);
	imageline($outputImage,50,570,850,570,$black);
	imageline($outputImage,50,620,850,620,$black);
	imageline($outputImage,50,670,850,670,$black);
	imageline($outputImage,50,720,850,720,$black);
	imageline($outputImage,50,770,850,770,$black);
	imageline($outputImage,50,820,850,820,$black);
	
	imageline($outputImage,50,420,50,820,$black);
	imageline($outputImage,400,420,400,820,$black);
	imageline($outputImage,850,420,850,820,$black);
	imageline($outputImage,550,420,550,820,$black);
	imageline($outputImage,700,420,700,820,$black);
	
	$a = $this->imagettftextjustified($outputImage, 14, 0, 410, 430, $black, './fonts/GothamBold.ttf', '1st 6 months', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 14, 0, 560, 430, $black, './fonts/GothamBold.ttf', 'Next 6 months', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 14, 0, 710, 430, $black, './fonts/GothamBold.ttf', 'Total 12 months', 860, $minspacing=3,$linespacing=1);
	
	$a = $this->imagettftextjustified($outputImage, 16, 0, 80, 480, $red, './fonts/GothamBold.ttf', 'MRP', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 430, 480, $red, './fonts/GothamBold.ttf', $MRP, 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 590, 480, $red, './fonts/GothamBold.ttf', $MRP, 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 730, 480, $red, './fonts/GothamBold.ttf', $MRP, 860, $minspacing=3,$linespacing=1);

	$a = $this->imagettftextjustified($outputImage, 16, 0, 80, 530, $green, './fonts/GothamBold.ttf', 'DP Distribution Price', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 430, 530, $green, './fonts/GothamBold.ttf', $DP, 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 590, 530, $green, './fonts/GothamBold.ttf', $DP, 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 730, 530, $green, './fonts/GothamBold.ttf', $DP, 860, $minspacing=3,$linespacing=1);

	$a = $this->imagettftextjustified($outputImage, 16, 0, 80, 580, $blue, './fonts/GothamBold.ttf', 'FREE Gift', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 430, 580, $blue, './fonts/GothamBold.ttf', number_format($DP*.1,1), 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 590, 580, $blue, './fonts/GothamBold.ttf', number_format($DP*.1,1), 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 730, 580, $blue, './fonts/GothamBold.ttf', number_format($DP*.1,1), 860, $minspacing=3,$linespacing=1);

	$a = $this->imagettftextjustified($outputImage, 16, 0, 80, 630, $green, './fonts/GothamBold.ttf', 'Cost after FREE Gift', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 430, 630, $green, './fonts/GothamBold.ttf', number_format($DP-$DP*.1,1), 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 590, 630, $green, './fonts/GothamBold.ttf', number_format($DP-$DP*.1,1), 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 730, 630, $green, './fonts/GothamBold.ttf', number_format($DP-$DP*.1,1), 860, $minspacing=3,$linespacing=1);

	$a = $this->imagettftextjustified($outputImage, 16, 0, 80, 680, $blue, './fonts/GothamBold.ttf', 'Loyalty Voucher in Rs.', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 430, 680, $blue, './fonts/GothamBold.ttf', number_format($DP/6,1), 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 590, 680, $blue, './fonts/GothamBold.ttf', number_format($DP/3,1), 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 730, 680, $blue, './fonts/GothamBold.ttf', number_format($DP/4,1), 860, $minspacing=3,$linespacing=1);

	$a = $this->imagettftextjustified($outputImage, 14, 0, 80, 730, $green, './fonts/GothamBold.ttf', 'Net Effective Cost after Loyalty', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 430, 730, $green, './fonts/GothamBold.ttf', number_format(($DP-$DP*.1) - $DP/6,0), 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 590, 730, $green, './fonts/GothamBold.ttf', number_format(($DP-$DP*.1) - $DP/3,0), 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 730, 730, $green, './fonts/GothamBold.ttf', number_format(($DP-$DP*.1) - $DP/4,0), 860, $minspacing=3,$linespacing=1);


	$a = $this->imagettftextjustified($outputImage, 16, 0, 80, 780, $green, './fonts/GothamBold.ttf', 'Discount MRP / %', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 430, 780, $green, './fonts/GothamBold.ttf', number_format($MRP-(($DP-$DP*.1) - $DP/6),0).' / '.number_format(($MRP-(($DP-$DP*.1) - $DP/6))/$MRP*100,0).'%', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 570, 780, $green, './fonts/GothamBold.ttf', number_format($MRP-(($DP-$DP*.1) - $DP/3),0).' / '.number_format(($MRP-(($DP-$DP*.1) - $DP/3))/$MRP*100,0).'%', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 16, 0, 730, 780, $green, './fonts/GothamBold.ttf', number_format($MRP-(($DP-$DP*.1) - $DP/4),0).' / '.number_format(($MRP-(($DP-$DP*.1) - $DP/4))/$MRP*100,0).'%', 860, $minspacing=3,$linespacing=1);



	$a = $this->imagettftextjustified($outputImage, 13, 0, 20, 830, $black, './fonts/GothamBook.ttf', 'Additional Advantage: Cash back benifits of Accumulated Performance Bonus of 7% to 16% of BV and Director Bonus 4% of BV, which comes back into your bank account every month as per your position.', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 13, 0, 20, 870, $black, './fonts/GothamBook.ttf', '* This is as per current scheme of the company.', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 13, 0, 20, 890, $black, './fonts/GothamBook.ttf', '1. Purchase amount should be between Rs. 2500 and Rs. 5000 per month regularly.', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 13, 0, 20, 910, $black, './fonts/GothamBook.ttf', '2. Purchase should be done between 1st to 15th of each month for taking advantage of Free Gift and Loyalty.', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 13, 0, 20, 930, $black, './fonts/GothamBook.ttf', '3. Any product combination of your choice can be taken every month.', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 13, 0, 20, 950, $black, './fonts/GothamBook.ttf', '4. Free Delivery by courier above Rs. 4000 purchase. Below Rs. 4000, Rs. 77 courier charges.', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 13, 0, 20, 970, $black, './fonts/GothamBook.ttf', '5. The above example is for general understanding. Please enquire for current scheme applicable to you.', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 13, 0, 20, 990, $black, './fonts/GothamBold.ttf', 'E&OE', 860, $minspacing=3,$linespacing=1);
	$a = $this->imagettftextjustified($outputImage, 13, 0, 800, 990, $black, './fonts/GothamBold.ttf', 'Sept 2021', 860, $minspacing=3,$linespacing=1);
	
	
	$a = $this->imagettftextjustified($outputImage, 15, 0, 20, 1010, $black, './fonts/GothamBook.ttf', $desc, 860, $minspacing=3,$linespacing=1);
//	imagettftext($outputImage, 14, 0, 10,550, $black, './fonts/GothamBook.ttf', wordwrap($desc ,60,"\n",true));
	
	$filename=$code.'.png';
	imagepng($outputImage, $targetPath . $filename);
	imagedestroy($outputImage);
	return compact('code','short','category','MRP','DP','BV','PV','Weight');
}

function imagettftextjustified(&$image, $size, $angle, $left, $top, $color, $font, $text, $max_width, $minspacing=3,$linespacing=1)
{
$wordwidth = array();
$linewidth = array();
$linewordcount = array();
$largest_line_height = 0;
$lineno=0;
$words=explode(" ",$text);
$wln=0;
$linewidth[$lineno]=0;
$linewordcount[$lineno]=0;
foreach ($words as $word)
{
$dimensions = imagettfbbox($size, $angle, $font, $word);
$line_width = $dimensions[2] - $dimensions[0];
$line_height = $dimensions[1] - $dimensions[7];
if ($line_height>$largest_line_height) $largest_line_height=$line_height;
if (($linewidth[$lineno]+$line_width+$minspacing)>$max_width)
{
$lineno++;
$linewidth[$lineno]=0;
$linewordcount[$lineno]=0;
$wln=0;
}
$linewidth[$lineno]+=$line_width+$minspacing;
$wordwidth[$lineno][$wln]=$line_width;
$wordtext[$lineno][$wln]=$word;
$linewordcount[$lineno]++;
$wln++;
}
for ($ln=0;$ln<=$lineno;$ln++)
{
$slack=$max_width-$linewidth[$ln];
if (($linewordcount[$ln]>1)&&($ln!=$lineno)) $spacing=($slack/($linewordcount[$ln]-1));
else $spacing=$minspacing;
$x=0;
for ($w=0;$w<$linewordcount[$ln];$w++)
{
imagettftext($image, $size, $angle, $left + intval($x), $top + $largest_line_height + ($largest_line_height * $ln * $linespacing), $color, $font, $wordtext[$ln][$w]);
$x+=$wordwidth[$ln][$w]+$spacing+$minspacing;
}
}
return true;
}

//end of class
}


