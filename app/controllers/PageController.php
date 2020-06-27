<?php
namespace app\controllers;

use app\models\X_assets;
use app\models\X_categories;
use app\models\Malls;


class PageController extends \lithium\action\Controller {

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
			return $this->render(array('json' => array("success"=>"Yes",'categories'=>$data)));		
		
	}

	public function addassets(){
		
		$products = Malls::find('all',array());
			$i = 1;
			
		foreach($products as $p){
			$category = substr($p['Code'],0,2);
				$find = X_categories::find('first',array(
						'conditions'=>array('alias'=>$category)
				));
			
			$data = array(
			 "id"=>$i,
				"category_id"=>$find->id,
				"is_published"=>1,
				"date_added"=> gmdate('Y-m-d h:i:s'),
				"created_by"=>1,
				"created_by_user"=>'Nilam Doctor',
				"date_modified"=>gmdate('Y-m-d h:i:s'),
				"modified_by"=>1,
				"modified_by_user"=>'Nilam Doctor',
				"checked_out"=>null,
				"checked_out_by"=>null,
				"checked_out_by_user"=>'Nilam Doctor',
				"title"=>$p->Name,  
				"description"=>'MRP: '. number_format((float)$p->MRP, 2, '.', '') .', DP: '.number_format((float)$p->DP, 2, '.', '').', BV: '.number_format((float)$p->BV, 2, '.', '').', PV: '.number_format((float)$p->PV, 2, '.', ''),
				"alias"=>$p->Code,
				"storage_location"=>'remote',
				"path"=>null,
				"remote_path"=>"https://sff.team/img/products/".$p->Code."_400.jpg",
				"original_file_name"=>$p->Code,
				"lang"=>'en',
				"publish_up"=>null,
				"publish_down"=>null,
				"download_count"=>0,
				"unique_download_count"=>0,
				"revision"=>0,
				"extension"=>'jpg',
				"mime"=>'image/jpeg',
				"size"=>0,
				"disallow"=>0
			);
			$i++;

				$find = X_assets::find('first',array(
						'conditions'=>array('original_file_name'=>$p->Code)
				));
				$conditions = array('original_file_name'=>$p->Code);
				if(count($find)>0){
					X_assets::update($data,$conditions);
					
				}else{
					X_assets::create()->save($data);
				}
		}
		return $this->render(array('json' => array("success"=>"Yes",'categories'=>$data)));		
	}

	public function preview($cat=null){
		
		
				$categories = X_categories::find('all',array(
					'conditions'=>array('bundle'=>'asset'),
				));
				
				$products = X_assets::find('all',array(
					'conditions'=>array('category_id'=>(integer)$cat)
				));
				$category = X_categories::find('first',array(
						'conditions'=>array('id'=>(integer)$cat)
				));
		return compact('categories','products','category');
		
	}


//end of functions
}
?>