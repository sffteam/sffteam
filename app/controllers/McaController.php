<?php
namespace app\controllers;

use app\models\Urls;
use app\models\Malls;
use app\models\Users;
use app\models\Mobiles;

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
 public function reports($mcaNumber=null,$user=null){
  
  if($mcaNumber!=null){
   $mcaDetails = Users::find('first',array(
   'conditions'=>array(
    'mcaNumber'=>$mcaNumber,
    )
  ));
  $findmobile = Mobiles::find('first',array(
   'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
  }
  
  $yyyymm = date('Y-m');
  $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
   $left = $mcaDetails['left'];
   $right = $mcaDetails['right'];
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
 $joinee = count($this->findJoinee($mcaNumber));
  
  $users = Users::find('all',array(
   'conditions'=>array(
    'refer'=>$mcaNumber,
     $yyyymm=>array('$exists'=>true),
     $pyyyymm.'.Percent'=>array('$ne'=>null)
     ),
   'order'=>array()
   ));

  
  
  $url = 'reports';
  return compact('url','mcaNumber','user','mcaDetails','findmobile','team','joinee','users');
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
    'Weight'=>$p['Weight'],
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




//----------------------------------------------------------
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



}