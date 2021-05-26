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
  $url = 'index';
  return compact('url');
 }
 public function reports(){
  $url = 'reports';
  return compact('url');
 }
 
 public function products(){
  $url = 'products';
  return compact('url');
 }
 public function pdfs(){
  $url = 'pdfs';
  return compact('url');
 }
 public function videos(){
  $url = 'videos';
  return compact('url');
 }
 public function discovery(){
  $url = 'videos';
  return compact('url');
 }
 public function business(){
  $url = 'videos';
  return compact('url');
 }
 public function productvideo(){
  $url = 'videos';
  return compact('url');
 }
 public function objection(){
  $url = 'videos';
  return compact('url');
 }
 public function knowledge(){
  $url = 'videos';
  return compact('url');
 } 
}
