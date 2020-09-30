<?php
namespace app\controllers;
use \lithium\data\Model;
use app\models\Users;

class CertificateController extends \lithium\action\Controller {


 protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'savings';
 }

 public function index($mcaNumber=null){
  
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
  ));
  
  
  return compact('user');
 }


}


?>