<?php
namespace app\controllers;

use app\models\Savings;
use app\models\Products;
use app\models\Plans;

class FailureController extends \lithium\action\Controller {

 protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'savings';
 }

 public function index(){
 $save = "No";
 	return $this->render(array('json' => array("success"=>$save)));		
 }
 
}

?>