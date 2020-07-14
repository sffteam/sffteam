<?php
namespace app\controllers;

use app\models\Zooms;

class ZoomController extends \lithium\action\Controller {

 protected function _init() {
			parent::_init();
			$this->_render['layout'] = '';
	}
	
	public function index() {
 }

	public function user() {
		
  $content = file_get_contents("php://input", false, stream_context_create($arrContextOptions));
  $update = json_decode($content, true);
  
		
		if (isset($update["applicationId"])) {
			Zooms::create()->save($update);	
		}
			return $this->render(array('json' => array("success"=>"Yes")));
 }

	
	
//end of functions
}
?>