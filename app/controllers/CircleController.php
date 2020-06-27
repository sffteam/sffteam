<?php
namespace app\controllers;

use app\models\X_assets;
use app\models\X_categories;
use app\models\Malls;


class CircleController extends \lithium\action\Controller {

 protected function _init() {
			parent::_init();
			$this->_render['layout'] = '';
	}
	
	public function index() {
		
		$CategoriesArray = array(
    'HL' => 'Health & Wellness',
				'HC' => 'Home Care',
		  'SC' => 'Skin Care',

    'LC' => 'Laundry Care',
				'FP' => 'Food & Beverages',
				'FS' => 'Food Supplements',

				'PC' => 'Personal Care',
				'FS' => 'Food Supplement',
				'MJ' => 'Jewelery',

				'UC' => 'Cosmetics - Urban Color',
    'BC' => 'Baby Care',
    'AG' => 'Agriculture',

    'AC' => 'Auto Care',
    'WA' => 'Watches',				
				'MG' => 'Technology',

				'00' => 'Others',
    '60' => 'Extra',
				);

		$malls = Malls::find('all');
		$assets = X_assets::find('all');
		
		return compact('assets','malls','CategoriesArray');
 }


	public function addcategories(){
		$CategoriesArray = array(
    'HL' => 'Health & Wellness',
				'HC' => 'Home Care',
		  'SC' => 'Skin Care',

    'LC' => 'Laundry Care',
				'FP' => 'Food & Beverages',
				'FS' => 'Food Supplements',

				'PC' => 'Personal Care',
				'FS' => 'Food Supplement',
				'MJ' => 'Jewelery',

				'UC' => 'Cosmetics - Urban Color',
    'BC' => 'Baby Care',
    'AG' => 'Agriculture',

    'AC' => 'Auto Care',
    'WA' => 'Watches',				
				'MG' => 'Technology',

				'00' => 'Others',
    '60' => 'Extra',
				);

				$i = 1;
			foreach($CategoriesArray as $k=>$v){
				
				$data = array(
					'id'=>$i,
					 "is_published"=>1,
						"date_added"=> gmdate('Y-m-d h:i:s'),
						"created_by"=>1,
						"created_by_user"=>'Nilam Doctor',
						"date_modified"=>null,
						"modified_by"=>1,
						"modified_by_user"=>'Nilam Doctor',
						"checked_out"=>null,
						"checked_out_by"=>null,
						"checked_out_by_user"=>'Nilam Doctor',
						"title"=>$v,  
						"description"=>null,
						"alias"=>$k,
						"color"=>null,
						"bundle"=>'asset'
				);
				$i++;
				
				$find = X_categories::find('first',array(
						'conditions'=>array('alias'=>$k)
				));
				$conditions = array('alias'=>$k);
				if(count($find)>0){
					X_categories::update($data,$conditions);
					
				}else{
					X_categories::create()->save($data);
				}
				
			}
			return $this->render(array('json' => array("success"=>"Yes",'products'=>$data)));		
		
	}


//end of functions
}
?>