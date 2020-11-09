<?php
namespace app\controllers;
use \lithium\data\Model;
use app\models\F_items;
use app\models\users;

class FalsabjiController extends \lithium\action\Controller {


 protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'framework7';
 }

 public function index($type=null){
  if($type==null){
   $items = F_items::find('all',array(
   )); 
  }else{
   $items = F_items::find('all',array(
   'conditions'=>array('Type'=>$type)
  ));
  }
  return $this->render(array('json' => array("success"=>"Yes",'items'=>$items)));  
 }


}


?>