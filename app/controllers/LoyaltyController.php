<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use \lithium\data\Model;
use app\models\Malls;
use app\models\Mobiles;
use app\models\Users;

class LoyaltyController extends \lithium\action\Controller {
 
 
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
  'conditions'=>array(
   'Code'=> array('like'=>'/^'.$category.'/'),
   'InDemand'=>array('$ne'=>0)
   ), 
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
   return compact('products','mobile','CategoriesArray','tuy','CategoriesSwiperArray','price','category');
  
 }
 
}

