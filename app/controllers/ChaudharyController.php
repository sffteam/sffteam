<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use lithium\data\Connections;
use app\extensions\action\Functions;
use app\extensions\action\GoogleAuthenticator;
use app\models\C_products;
use app\models\C_users;
use \MongoDate;

class ChaudharyController extends \lithium\action\Controller {
 protected function _init() {
    parent::_init();
 }
 
 public function index(){
  return $this->render(array('json' => array("success"=>"Yes")));
 }

 public function categories(){
  $categories = C_products::find('all',array(
   'order'=>array('MainCategory'=>'DESC')
  ));
  $allcategories = array();
  $newcategory = "";
  foreach($categories as $c){
   if($newcategory != $c['MainCategory']){
    array_push($allcategories,$c['MainCategory']);
    $newcategory = $c['MainCategory'];
   }
  }
  return $this->render(array('json' => array("success"=>"Yes",'categories'=>$allcategories)));
 }

  public function products($category = null){
   $products = C_products::find('all',array(
   'conditions'=>array('MainCategory'=> array('like'=>'/^'.$category.'/')),
   'order'=>array('Product Name'=>'ASC')
  ));
  $allproducts = array();
  $newproduct = "";
  foreach($products as $c){
   if($newproduct != $c['Product Name']){
    array_push($allproducts,
     array(
      'Name'=>$c['Product Name'],
      'SKU Number'=>$c['SKU Number']
     ));
    $newproduct = $c['Product Name'];
   }
  }
  return $this->render(array('json' => array("success"=>"Yes",'allproducts'=>$allproducts)));
  }
  
  public function prices($product = null){
   $product = urldecode($product);
   $prices = C_products::find('all',array(
   'conditions'=>array('Product Name'=> array('like'=>'/^'.$product.'/')),
   'order'=>array('Net Content/Count'=>'ASC')
  ));
   return $this->render(array('json' => array("success"=>"Yes",'prices'=>$prices)));
  }
 
}