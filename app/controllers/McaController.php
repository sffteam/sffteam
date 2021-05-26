<?php
namespace app\controllers;

use app\models\Urls;
use app\models\Malls;

class McaController extends \lithium\action\Controller {


protected function _init() {
  parent::_init();
//  $user = Session::read('default');
  // if($user==null){
   // return $this->redirect('/savings');
  // }
  $this->_render['layout'] = 'mca';
 }
 public function index(){
  $url = 'index';
  return compact('url');
 }
 public function reports(){
  $url = 'reports';
  return compact('url');
 }
 
 public function products($Code=null){
  $Categories = array(
    'HC' => 'Home Care 50%',
    'AB' => 'Agarbatti 30%',
    'LC' => 'Laundry Care 35% & 60%',
    'PC' => 'Personal Care 10% to 40%',
    'FP' => 'Food & Beverages 20% - 25%',
    'SC' => 'Skin Care 60%',
    'FS' => 'Food Supplement 50%',
    'MJ' => 'Jewelery 40%',
    'UC' => 'Cosmetics - Urban Color 60%',
    'BC' => 'Baby Care 55%',
    'AG' => 'Agriculture 60%',
    'AC' => 'Auto Care 50%',
    'HL' => 'Wellness 60%',
    'WA' => 'Watches 50%',
    'MG' => 'Technology 60%',
    '00' => 'Others 10% to 50%',
    '60' => 'Extra ',
    );
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

  $url = 'products';
  return compact('url','Categories','AllProducts');
 }
 public function pdfs(){
  $url = 'pdfs';
  return compact('url');
 }
 public function videos(){
  $url = 'videos';
  return compact('url');
 }
 public function discovery(){
  $url = 'videos';
  return compact('url');
 }
 public function business(){
  $url = 'videos';
  return compact('url');
 }
 public function productvideo(){
  $url = 'videos';
  return compact('url');
 }
 public function objection(){
  $url = 'videos';
  return compact('url');
 }
 public function knowledge(){
  $url = 'videos';
  return compact('url');
 } 
}
