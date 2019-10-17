<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use app\extensions\action\Functions;

use app\models\Malls;
use app\models\Settings;
use app\models\Points;

class CategoryController extends \lithium\action\Controller {

	 protected function _init() {
  parent::_init();
//  $user = Session::read('default');
  // if($user==null){
   // return $this->redirect('/savings');
  // }
  $this->_render['layout'] = 'default';
 }
	public function index(){
				$CategoriesArray = array(
		  'FS' => 'Food Supplement',
				'PC' => 'Personal Care',
    'HL' => 'Health',
				'HC' => 'Home Care',
    'LC' => 'Laundry Care',
				'FP' => 'Food Products',
				'SC' => 'Skin Care',
    'BC' => 'Baby Care',
				'UC' => 'Urban Color',
    'AG' => 'Agriculture',
    'AC' => 'Auto Care',
    'MJ' => 'Jewelery',
				'00' => 'Others',
    '60' => 'Extra',
				);
		return compact('CategoriesArray');
	}
	public function i($Code = null){
		
				$CategoriesArray = array(
		  'FS' => 'Food Supplement',
				'PC' => 'Personal Care',
    'HL' => 'Health',
				'HC' => 'Home Care',
    'LC' => 'Laundry Care',
				'FP' => 'Food Products',
				'SC' => 'Skin Care',
    'BC' => 'Baby Care',
				'UC' => 'Urban Color',
    'AG' => 'Agriculture',
    'AC' => 'Auto Care',
    'MJ' => 'Jewelery',
				'00' => 'Others',
    '60' => 'Extra',
				);
				$products = Malls::find('all',array(
			'conditions'=>array('Code'=> array('like'=>'/^'.$Code.'/'))
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
		return compact('AllProducts','CategoriesArray');
	}
}
?>
