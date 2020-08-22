<?php
namespace app\controllers;

use app\models\Products;



class ProductsController extends \lithium\action\Controller {

 public function index() {
		$categories = Products::find('all',array(
			'fields'=>array('category'),
			'order'=>array('category'=>'ASC')
		));
		$category = '';
		$allcategories = array();
		
		foreach($categories as $c){
			$count = Products::count(array(
				'category'=>$c['category']
			));
			
			
			$oldcategory = $c['category'];
				if($category != $c['category']){
					array_push($allcategories,array('Name'=>$c['category'],'count'=>$count));
				}
				$category = $c['category'];
		}  
  
  return compact('allcategories');
 }
 
 public function category($category=null){
  $category = urldecode($category);
  $products = Products::find('all',array(
   'conditions'=>array('category'=>$category),
			'order'=>array('code'=>'ASC')
		));
  
		$categories = Products::find('all',array(
			'fields'=>array('category'),
			'order'=>array('category'=>'ASC')
		));
		$category = '';
		$allcategories = array();
		
		foreach($categories as $c){
			$count = Products::count(array(
				'category'=>$c['category']
			));
			
			
			$oldcategory = $c['category'];
				if($category != $c['category']){
					array_push($allcategories,array('Name'=>$c['category'],'count'=>$count));
				}
				$category = $c['category'];
		}  
  
		return compact('allcategories','products');
 }
 
 public function product($code=null){
  
  if($this->request->data){
			$data = array(
				'description'=>$this->request->data['description'],
				'video'=>$this->request->data['video']
			);
			$product = Products::find('first',array(
		'conditions'=>array('code'=>$this->request->data['code']),
		))->save($data);
		
		$product = Products::find('first',array(
		'conditions'=>array('code'=>$this->request->data['code']),
		));
		}
  
  $product = Products::find('first',array(
   'conditions'=>array('code'=>$code),
			'order'=>array('code'=>'ASC')
		));
  
  
  
  
		$categories = Products::find('all',array(
			'fields'=>array('category'),
			'order'=>array('category'=>'ASC')
		));
		$category = '';
		$allcategories = array();
		
		foreach($categories as $c){
			$count = Products::count(array(
				'category'=>$c['category']
			));
			
			
			$oldcategory = $c['category'];
				if($category != $c['category']){
					array_push($allcategories,array('Name'=>$c['category'],'count'=>$count));
				}
				$category = $c['category'];
		}  
  
  
  
  
  return compact('allcategories','product');
  
 }
	
	public function testimonials(){
		  $this->_render['layout'] = '';
		
	}
}
?>