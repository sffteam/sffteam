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

public function savevideo(){
	if($this->request->data){
		$mcaNumber = $this->request->data['VideomcaNumber'];
		$base64 = $this->request->data['outputVideo'];
		
		$video = str_replace('data:video/mp4;base64,', '', $base64);
		$video = str_replace(' ', '+', $video);
		$fileData = base64_decode($video);
		//saving
		$videoFolder = '/app/webroot/img/videos/';		
		$videoPath = $_SERVER['DOCUMENT_ROOT'] . $videoFolder;
		$videoTime = round(microtime(true));
		$fileName = $videoPath . 'photo-'.$mcaNumber.'-'.$videoTime.'.mp4';
		file_put_contents($fileName, $fileData);
		
		$data = array(
			'mcaNumber'=>$mcaNumber,
			'image'=> $fileName,
			'DateTime' => new \MongoDate;
			'VideoTime'=>$videoTime
		);
		Videos::create()->save($data);
	
	}
		return $this->render(array('json' => array("success"=>"Yes",'video'=>$data)));
}


//end of class
}


