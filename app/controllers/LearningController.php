<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use app\extensions\action\Functions;

use app\models\Malls;
use app\models\Settings;
use app\models\Points;

class LearningController extends \lithium\action\Controller {

	 protected function _init() {
  parent::_init();
//  $user = Session::read('default');
  // if($user==null){
   // return $this->redirect('/savings');
  // }
  $this->_render['layout'] = 'default';
 }
	public function index(){
	}
	
	public function e(){
	}
	



}
?>