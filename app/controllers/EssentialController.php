<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use \lithium\data\Model;
use app\models\Malls;
use app\models\Mobiles;
use app\models\Users;

class EssentialController extends \lithium\action\Controller {
 
 
 protected function _init() {
  parent::_init();
//  $user = Session::read('default');
  // if($user==null){
   // return $this->redirect('/savings');
  // }
  $this->_render['layout'] = 'sale';
 }
 public function index($category = null, $mcaNumber = "",$price=null,$top=null){
  
 if($category=="all"){
 $tuyNames = Malls::find('all',array(
  'order'=>array('TUYName'=>'ASC','Code'=>'ASC','Percent'=>'DESC')
 ));
 }else if($category=="top"){
   $tuyNames = Malls::find('all',array(
     'conditions'=>array(
					'InDemand'=>array('$ne'=>0)
					),
     'order'=>array('Code'=>'DESC','Name'=>'DESC','TUYName'=>'DESC','Percent'=>'DESC')
   ));
  }else{
 $tuyNames = Malls::find('all',array(
  'conditions'=>array('Code'=> array('like'=>'/^'.$category.'/')), 
     'order'=>array('Name'=>'DESC','TUYName'=>'DESC','Code'=>'DESC','Percent'=>'DESC')
 ));
 }
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
  
  if($category=="all"){
   $products = Malls::find('all',array(
          'order'=>array('Name'=>'DESC','TUYName'=>'DESC','Code'=>'DESC','Percent'=>'DESC')
   ));
  }else if($category=="top"){
   $products = Malls::find('all',array(
     'conditions'=>array(
						'InDemand'=>array('$ne'=>0)
						),
        'order'=>array('Name'=>'DESC','TUYName'=>'DESC','Code'=>'DESC','Percent'=>'DESC')
   ));
  }else{
			$products = Malls::find('all',array(
     'conditions'=>array('Code'=> array('like'=>'/^'.$category.'/')),
        'order'=>array('Name'=>'DESC','TUYName'=>'DESC','Code'=>'DESC','Percent'=>'DESC')
   ));
		}
  if($mcaNumber!=null){
   $mobile = Mobiles::find('first',array(
    'conditions'=>array('mcaNumber'=>$mcaNumber)
   ));
  }
if($category != 'top')  {
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
		}else{
	   $CategoriesArray = array(  'HC' => 'Home Care',
    'LC' => 'Laundry Care',
    'PC' => 'Personal Care',
    'FP' => 'Food & Beverages',
    'SC' => 'Skin Care',
    'FS' => 'Food Supplement',
    'BC' => 'Baby Care',
    'HL' => 'Wellness',
   );
				$CategoriesSwiperArray = array(
    'HC' => 'Home Care',
    'LC' => 'Laundry Care',
    'PC' => 'Personal Care',
    'FP' => 'Food & Beverages',
    'SC' => 'Skin Care',
    'FS' => 'Food Supplement',
    'BC' => 'Baby Care',
    'HL' => 'Wellness',
				);
		}
   return compact('products','mobile','CategoriesArray','tuy','CategoriesSwiperArray','price','category');
  
 }
 
}

