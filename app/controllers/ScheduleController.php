<?php
namespace app\controllers;
use \lithium\template\View;
use app\models\Questions;
use app\models\Qusers;

use app\extensions\action\GoogleAuthenticator;



class ScheduleController extends \lithium\action\Controller {

 protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'savings';
 }

 public function index(){}

 public function register(){}

}
?>