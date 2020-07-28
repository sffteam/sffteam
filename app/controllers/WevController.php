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

	public function getVideos(){
			if($this->request->data){
			$mcaNumber = $this->request->data['mcaNumber'];
			$targetFolder = '/app/webroot/img/videos/';
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			$files = scandir($targetPath);
			$myfiles = array();
					foreach($files as $f){
						if($f!="." && $f!=".."){
							array_push($myfiles,array('file'=>$f));
						}
					}
		}

		
		return $this->render(array('json' => array("success"=>"Yes",'data'=>$myfiles)));
	}

//end of class
}


