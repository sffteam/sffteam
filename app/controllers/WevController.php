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
		if($this->request->data){
			Videos::create()->save($this->request->data);
			return $this->render(array('json' => array("success"=>"Yes",'data'=>$this->request->data)));
		}
		return $this->render(array('json' => array("success"=>"No")));
	}
	public function getvideos(){
		if($this->request->data){
			$videos = Videos::find('all',array(
				'conditions'=>array('approved'=>'Yes'),
//				'limit'=>5,
				'offset'=>$this->request->data['skip'],
				'order'=>array('_id'=>'ASC'),
			));
			return $this->render(array('json' => array("success"=>"Yes",'videos'=>$videos)));
		}
		return $this->render(array('json' => array("success"=>"No")));
	}




//end of class
}


