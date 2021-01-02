<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use \lithium\data\Model;
use app\extensions\action\Functions;
use app\extensions\action\GoogleAuthenticator;
use app\controllers\DashboardController;
use app\models\Malls;
use app\models\Contacts;
use app\models\Tools;
use app\models\Invoices;
use app\models\Modicare_products; // Only for Transfer of products.. Not required
use app\models\Users;
use app\models\Orders;
use app\models\Versions;
use app\models\Mobiles;
use app\models\Settings;
use app\models\Seminars;
use app\models\Prospects;
use app\models\Messages;
use app\models\Points;
use \MongoRegex;

class AdminmallsController extends \lithium\action\Controller {


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
				'00' => 'Others',
    '60' => 'Extra',
				);
				
		return $this->render(array('json' => array("success"=>"Yes",'products'=>$AllProducts,'Category'=>$CategoriesArray)));		
		
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
							'caption'=> ' <span class="text-color-yellow">'.$val.'</span><br>'.$p['Name']." <br>".$p['Code']." <span class='text-color-red'>MRP: <strike>".number_format($p['MRP'],2)."</strike></span> <span class='text-color-green'>DP: ".number_format($p['DP'],2)." PV: ".number_format($p['PV'],2)."</span>",
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
	
public function getTools(){
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


public function getproducts(){
	$products = Malls::find('all',array(
		'order'=>array('Code'=>'ASC','Name'=>'ASC')
	));
	
	$allproducts = array();
	foreach ($products as $p){
		array_push($allproducts,array(
			'Code'=>trim($p['Code']),
			'Name'=>$p['Name'],
			'MRP'=>$p['MRP'],			
			'DP'=>$p['DP'],			
			'BV'=>$p['BV'],			
			'PV'=>$p['PV'],			
		));
	}
	
	return $this->render(array('json' => array("success"=>"Yes",'products'=>$allproducts)));			
}	

public function changeprice(){
	if($this->request->data){
		$Code = $this->request->data['Code'];
		$Value = $this->request->data['Value'];
		$What = $this->request->data['What'];
		$data = array(
			$What => $Value
		);
		$conditions = array(
			'Code'=>$Code
		);
		Malls::update($data,$conditions);
	}
	return $this->render(array('json' => array("success"=>"Yes")));			
}

public function addproduct(){
	if($this->request->data){
		Malls::create()->save($this->request->data);
	}
	return $this->render(array('json' => array("success"=>"Yes")));			
}
public function deleteproduct(){
	if($this->request->data){
		Malls::remove(array('Code'=>$this->request->data['Code']));
	}
	return $this->render(array('json' => array("success"=>"Yes")));			
}

public function getmobiles(){
	$numbers = Mobiles::find('all',array(
		'fields'=>array('mcaNumber')
	));
	$next = array();
	foreach($numbers as $n){
		array_push($next,$n['mcaNumber']);
	}
	
	$yyyymm = date('Y-m');
	$yyyy = date('Y');
	
	$p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );	
	 $mobile = Users::find('all',array(
		 'conditions'=>array(
			'mcaNumber'=>array('$nin'=>$next),
//			'DateJoin'=> array('$regex'=>$yyyy,'$options'=>'i'),
			'Enable'=>'Yes'
		 ),
		 'fields'=>array('mcaNumber', 'mcaName', $p1yyyymm.'.PV', $yyyymm.'.PV', 'DateJoin'),
		//	'limit'=>100,
			'order'=>array($p1yyyymm.'.PV'=>'DESC')
	 ));
	return $this->render(array('json' => array("success"=>"Yes",'mobiles'=>$mobile)));			
}

public function getmobilesjoin(){
	$numbers = Mobiles::find('all',array(
		'fields'=>array('mcaNumber')
	));
	$next = array();
	foreach($numbers as $n){
		array_push($next,$n['mcaNumber']);
	}
	
	$yyyymm = date('Y-m');
	$yyyy = date('Y');
	$yyyyMM = date('M Y');
	
	$p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );	
	 $mobile = Users::find('all',array(
		 'conditions'=>array(
			'mcaNumber'=>array('$nin'=>$next),
			'DateJoin'=>array('$regex'=>$yyyyMM,'$options'=>'i'),
			'Enable'=>'Yes'
		 ),
		 'fields'=>array('mcaNumber', 'mcaName', $p1yyyymm.'.PV', $yyyymm.'.PV', 'DateJoin'),
		//	'limit'=>100,
			'order'=>array($p1yyyymm.'.PV'=>'DESC')
	 ));
	return $this->render(array('json' => array("success"=>"Yes",'mobiles'=>$mobile)));			
}

public function addmobile(){
	if($this->request->data){
		$name = Users::find('first',array(
			'conditions'=>array('mcaNumber'=>$this->request->data['mcaNumber']),
			'fields'=>array('mcaNumber', 'mcaName'),
		));
		
		$data = array(
			'mcaNumber'=>$this->request->data['mcaNumber'],
			'mcaName'=>$name['mcaName'],
			'Mobile'=>$this->request->data['Mobile'],
			'Email'=>$this->request->data['email'],
		);
		Mobiles::create()->save($data);
		
	}
	return $this->render(array('json' => array("success"=>"Yes",'name'=>$name)));			
}


//end of class
}


