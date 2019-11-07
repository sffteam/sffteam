<?php
namespace app\controllers;
use \lithium\template\View;
use app\extensions\action\Functions;
use app\extensions\action\GoogleAuthenticator;
use app\controllers\DashboardController;

use app\models\Malls;
use app\models\Invoices;
use app\models\Users;
use app\models\Settings;
use app\models\Messages;
use app\models\Points;
class TwilioController extends \lithium\action\Controller {

	protected function _init() {
  parent::_init();
  $this->_render['layout'] = null;
 }
	
	public function index(){}
	
	public function received(){
	}

}