<?php
namespace app\controllers;

use app\models\Urls;


class XController extends \lithium\action\Controller {

	public function shorturl($longURL=null){
			if($longURL){
				$longURL =  "https://circle.sff.team/page/preview/".urlencode(strtolower($longURL));
				$shortURL = substr(sha1($longURL),0,6);
				$data = array(
					'URL'=>$longURL,
					'Short'=>$shortURL
				);
			$url = Urls::find('first',array(
				'Short'=>$shortURL
			));
			if($url['Short']!=$shortURL){
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

}
