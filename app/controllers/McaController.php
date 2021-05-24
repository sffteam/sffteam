<?php
namespace app\controllers;

use app\models\Urls;


class McaController extends \lithium\action\Controller {


protected function _init() {
  parent::_init();
//  $user = Session::read('default');
  // if($user==null){
   // return $this->redirect('/savings');
  // }
  $this->_render['layout'] = 'mca';
 }
 public function index(){
 }
 public function reports(){
 }
 public function pdfs(){
 }
 public function videos(){
 }

}
