<?php
namespace app\controllers;


class ZoomController extends \lithium\action\Controller {

 protected function _init() {
			parent::_init();
			$this->_render['layout'] = '';
	}
	
	public function index() {
 }

	public function user() {
		
			return $this->render(array('json' => array("success"=>"Yes",'data'=>$this->request-data)));
 }

	
	
//end of functions
}
?>