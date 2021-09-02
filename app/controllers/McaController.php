<?php
namespace app\controllers;

use app\models\Urls;
use app\models\Malls;
use app\models\Users;
use app\models\Mobiles;
use app\models\Certificates;

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
 
 public function checkmca(){
  $date = date_create($this->request->data['DateJoin']);
  if($this->request->data){
  $user = Users::find('first',array(
   'conditions'=>array(
    'mcaNumber'=>(string)$this->request->data['mcaNumber'],
    'DateJoin'=>date_format($date,"d M Y"),
    )
  ));
  print_r(date_format($date,"d M Y"));
  print_r(count($user)) ;
   if(count($user)==1){
    $this->redirect('/mca/reports/'.$this->request->data['mcaNumber'].'/');
   }else{
    $this->redirect('/mca/reports/');
   }
   //return $this->render(array('json' => array("success"=>"No")));  
  }

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
   
  $allusers = $this->searchdown($mcaNumber);
  
  $url = 'reports';
  return compact('url','mcaNumber','user','mcaDetails','findmobile','team','joinee','users','allusers');
 }


public function searchdown($mcaNumber=null){
 ini_set('memory_limit', '-1');
 $yyyymm = date('Y-m');
 $pyyyymm = date('Y-m', strtotime('first day of last month'));
 
 if($mcaNumber){
  $users = Users::find('all',array(
   'conditions'=>array(
    'refer'=>$mcaNumber,
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
//    if($user['Enable']=='Yes'){
  //  }
  
  $Indusers = Users::find('first',array(
   'conditions'=>array(
    'mcaNumber'=>$u['mcaNumber'],
     $yyyymm=>array('$exists'=>true),
     $pyyyymm.'.Percent'=>array('$ne'=>null)
     ),
   'order'=>array($yyyymm.'.GPV'=>'DESC',$pyyyymm.'.GPV'=>'DESC')
   ));
//   print_r($Indusers['left']);
   $team = Users::count('all',array('conditions'=>
   array(
      'left'=>array('$gt'=>$Indusers['left']),
      'right'=>array('$lt'=>$Indusers['right']),
//       $yyyymm=>array('$exists'=>true),
//       $p1yyyymm.'.Percent'=>array('$ne'=>null),
      'Enable'=>'Yes'
   )
   )
 );
 
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
     'ExtraPV'=>$u[$yyyymm]['ExtraPV']?:0,
     'TotalEPV'=>$u[$yyyymm]['TotalEPV']?:0,
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
     'Team'=>$team,
     'InActive' => (integer)$u[$yyyymm]['InActive']?:"",
    ),
    $pyyyymm => array(
     'PV'=>$u[$pyyyymm]['PV']?:0,
     'ExtraPV'=>$u[$pyyyymm]['ExtraPV']?:0,
     'TotalEPV'=>$u[$pyyyymm]['TotalEPV']?:0,
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
   
   return $allusers;
  }else{
   return null;  
  }
 }
 return null;
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

public function certificates($commando = null){
	
	$certificates = Certificates::find('all',array(
		'order'=>array('commando'=>'DESC')
	));
	
	$trainings = array();
	$training = ".........";

	foreach($certificates as $c){
		if($training != $c['commando']){
			array_push($trainings,array('training'=>$c['commando'],'date'=>$c['date']));
			$training = $c['commando'];
		}
	}
	
	if($commando==null){
		
	}else{
		$commando = urldecode($commando);
		print_r($commando);
		$participants = Certificates::find('all',array(
			conditions=>array('commando'=>$commando)
		));
	}

	return compact('trainings','participants');
}



}