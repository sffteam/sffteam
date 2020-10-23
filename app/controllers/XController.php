<?php
namespace app\controllers;

use app\models\Urls;


class XController extends \lithium\action\Controller {


protected function _init() {
  parent::_init();
//  $user = Session::read('default');
  // if($user==null){
   // return $this->redirect('/savings');
  // }
  $this->_render['layout'] = 'sale';
 }
	public function shorturl($longURL=null,$title=null){
			if($longURL){
				$longURL =  "https://circle.sff.team/the-unstoppable-you/".urlencode(strtolower($longURL));
				$shortURL = substr(sha1($longURL),0,6);
				$data = array(
					'URL'=>$longURL,
					'Short'=>$shortURL
				);
			$url = Urls::find('first',array(
				'conditions'=>array('Short'=>(string)$shortURL)
			));
			
			if(count($url)!=0){}else{
				Urls::create()->save($data);
			}
				return $shortURL;	
			}
			return false;
		}
		
	public function go($short){
		$this->_render['layout'] = '';
		$url = Urls::find('first',array(
			'conditions'=>array('Short'=>$short)
		));
		return compact('url');
	}


 public function p(){
  
  
 }
 public function product(){
  
  
 }

 public function join(){
  
  
 }




}
