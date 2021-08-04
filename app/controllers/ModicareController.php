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
    'HC' => array('Name'=>'HOME','color'=>'#e53935','percent'=>'50%'),
    'AB' => array('Name'=>'AGARBATTI','color'=>'#e239A5','percent'=>'30%'),
    'LC' => array('Name'=>'LAUNDRY','color'=>'#303f9f','percent'=>'35% to 60%'),
    'PC' => array('Name'=>'PERSONAL','color'=>'#8e24aa','percent'=>'10% to 50%'),
    'FP' => array('Name'=>'FOOD','color'=>'#00796b','percent'=>'10% to 50%'),
    'SC' => array('Name'=>'SKINCARE','color'=>'#0288d1','percent'=>'60%'),
    'MJ' => array('Name'=>'JEWELERY','color'=>'#455a64','percent'=>'40%'),
    'UC' => array('Name'=>'COSMETICS','color'=>'#388e3c','percent'=>'60%'),
    'BC' => array('Name'=>'BABYCARE','color'=>'#afb42b','percent'=>'40% to 60%'),
    'AG' => array('Name'=>'AGRICULTURE','color'=>'#fbc02d','percent'=>'60%'),
    'AC' => array('Name'=>'AUTOCARE','color'=>'#e64a19','percent'=>'50%'),
    'HL' => array('Name'=>'WELLNESS','color'=>'#6d4c41','percent'=>'40% to 60%'),
    'WA' => array('Name'=>'WATCHES','color'=>'#0097a7','percent'=>'50%'),
    'MG' => array('Name'=>'TECHNOLOGY','color'=>'#01579b','percent'=>'60%'),
				'00' => array('Name'=>'Others','color'=>'#01579b','percent'=>'105 to 60%'),
				'60' => array('Name'=>'Extra','color'=>'#01579b','percent'=>'0%'),
    );

  return $this->render(array('json' => array("success"=>"Yes",'Category'=>$CategoriesArray,'CategorySwiper'=>$CategoriesSwiperArray)));  
  
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
 
//end of class
}


