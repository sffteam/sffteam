<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use \lithium\data\Model;
use app\extensions\action\Functions;
use app\extensions\action\GoogleAuthenticator;
use app\controllers\DashboardController;

use lithium\data\Connections;
use \MongoRegex;
use app\models\Videos;
class WevController extends \lithium\action\Controller {


 protected function _init() {
  parent::_init();
//  $user = Session::read('default');
  // if($user==null){
   // return $this->redirect('/savings');
  // }
  $this->_render['layout'] = 'savings';
 }
	public function index(){
		return $this->render(array('json' => array("success"=>"Yes",'data'=>$user)));
	}
	public function uploadvideo(){
		return $this->render(array('json' => array("success"=>"Yes",'data'=>$this->request->data)));
	}

	public function getvideos(){
			$videos = Videos::find('all',array(
				'limit'=>3
			));
			return $this->render(array('json' => array("success"=>"Yes",'videos'=>$videos)));
	}




//end of class
}


