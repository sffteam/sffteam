<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use lithium\data\Connections;
use app\extensions\action\Functions;
use app\extensions\action\GoogleAuthenticator;
use app\models\C_products;
use app\models\C_users;
use app\models\C_inquiry;
use app\models\C_orders;
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
    
   $prices = C_products::find('all',array(
   'conditions'=>array('Product Name'=> array('like'=>'/^'.$c['Product Name'].'/')),
   'order'=>array('SKU Number'=>'ASC')
   ));
    $allprices = array();
    foreach($prices as $p){
      array_push($allprices,
       array(
       "_id"=>$p['_id'],
       "SKU"=>$p['SKU Number'],
       "Weight"=>$p['Net Weight'],
       "MRP"=>$p['MRP:Pan India'],
       "ShelfLife"=>$p['Shelf Life Value'],
       "ShelfLifeUnit"=>$p['Shelf Life Unit'],
       "IGST"=>$p['IGST'],
       "CGST"=>$p['CGST'],
       "SGST"=>$p['SGST'],
       "user_id"=>$p['user_id'],
       )
      );
     }
    
    array_push($allproducts,
     array(
      'Name'=>$c['Product Name'],
      'SKU Number'=>$c['SKU Number'],
      'SKUs'=>$allprices
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
  public function submit(){
   if($this->request->data){
    C_inquiry::create()->save($this->request->data);
    return $this->render(array('json' => array("success"=>"Yes")));
   }
   
  }
  
  public function cartproducts(){
   $cart = $this->request->data;
   $CartProducts = array();
   foreach ($cart as $code => $quantity){
    if($code!="X"){
     $product = C_products::find('first',array(
      'conditions'=>array('SKU Number'=>(string)$code)
     ));
    }
    if(count($product)>0){
    array_push($CartProducts,       array(
        "_id"=>$product['_id'],
        "Name"=>$product['Product Name'],
        "SKU"=>$product['SKU Number'],
        "Weight"=>$product['Net Weight'],
        "MRP"=>$product['MRP:Pan India'],
        "ShelfLife"=>$product['Shelf Life Value'],
        "ShelfLifeUnit"=>$product['Shelf Life Unit'],
        "IGST"=>$product['IGST'],
        "CGST"=>$product['CGST'],
        "SGST"=>$product['SGST'],
        "user_id"=>$product['user_id'],
        'Quantity'=> (integer)$quantity
        )
    );
    }
   }
   return $this->render(array('json' => array("success"=>"Yes","CartProducts"=>$CartProducts)));  
  }
	public function cartsubmit(){
  
  $products = array();
  foreach($this->request->data as $key=>$val){
   if(substr($key,0,9)=="minusCode"){
    $SKU = str_replace("minusCode","",$key);
   $prices = C_products::find('first',array(
   'conditions'=>array('SKU Number'=> $SKU)
   ));
    
    array_push($products, 
     array(
      'SKU'=>str_replace("minusCode","",$key),
      'Quantity'=>(integer)$val,
      'Rate'=>$prices['MRP:Pan India'],
      'Value' => (integer)$val * $prices['MRP:Pan India'],
      "Name"=>$prices['Product Name'],
      "Weight"=>$prices['Net Weight'],
      )
    ); 
   }
  }
  $data = array(
   'Name'=>$this->request->data['C_name'],
   'Mobile'=>$this->request->data['C_mobile'],
   'Address'=>$this->request->data['C_address'],
   'Pincode'=>$this->request->data['C_pincode'],
   'Products'=>$products,
   'DateTime'=>date('d-m-Y')
  );
  C_orders::create()->save($data);
    return $this->render(array('json' => array("success"=>"Yes",'data'=>$data)));
 }
}