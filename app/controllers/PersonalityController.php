<?php
namespace app\controllers;
use lithium\storage\Session;
use app\extensions\action\GoogleAuthenticator;
use app\extensions\action\Functions;
use app\extensions\action\Uuid;

use app\models\X_personalitytests;
use app\models\X_personalityusers;
use app\models\X_personalityresults;

class PersonalityController extends \lithium\action\Controller {

	protected function _init(){
		parent::_init();
//		$this->_render['layout'] = 'coach';
	}

	public function index(){
		
	if($this->request->data){
		$data = $this->request->data;
		$person = X_personalityusers::create();
		$id = $person->save($data);
		// print_r($person['_id']);
		$newID = (string)$person['_id'];
		$questions = X_personalitytests::find('all');
		$result = $this->assess($newID,true);
		return $this->render(array('json' => array("success"=>"Yes",'_id'=>$newID,"result"=>$result)));		      
		
	}
		$questions = X_personalitytests::find('all');
		return $this->render(array('json' => array("success"=>"Yes",'questions'=>$questions)));		      
		
	}
public function assess($id=null,$json=false){
	
	$personalityusers = X_personalityusers::find('first',array(
		'conditions'=>array('_id'=>$id)
	));
	
	$a=14;$e=20;$n=38;$c=14;$o=8;
	
	
	for($i=1;$i<=50;$i++){
		$question = 'selected'.$i;
		$questions = X_personalitytests::find('first', array(
			'conditions'=>array('Number'=>(string)$i)
		));
		$variable = 'selected'.$i;
		
					// print_r($questions['Category'].": ");
					// print_r($variable.": ");
					// print_r($questions['Action']);
					// print_r($personalityusers[$variable]."# ");
		switch ($questions['Category']){
			case "A":
			if($questions['Action']=="+"){
				$a = $a + $personalityusers[$variable];
			}
			if($questions['Action']=="-"){
				$a = $a - $personalityusers[$variable];
			}
			break;
			case "E":
			if($questions['Action']=="+"){
				$e = $e + $personalityusers[$variable];
			}else{
				$e = $e - $personalityusers[$variable];
			}
			break;
			case "N":
			if($questions['Action']=="+"){
				$n = $n + $personalityusers[$variable];
			}else{
				$n = $n - $personalityusers[$variable];
			}
			break;
			case "C":
			if($questions['Action']=="+"){
				$c = $c + $personalityusers[$variable];
			}else{
				$c = $c - $personalityusers[$variable];
			}
			break;
			case "O":
			if($questions['Action']=="+"){
				$o = $o + $personalityusers[$variable];
			}else{
				$o = $o - $personalityusers[$variable];
			}
			break;
			
		}
	}
	
	$a = (integer)$a/10;
	$e = (integer)$e/10;
	$n = (integer)$n/10;
	$c = (integer)$c/10;
	$o = (integer)$o/10;
	
	$resultA = X_personalityresults::find('all',array(
		'conditions'=>array(
			'Category'=>'A',
			),
		));
	foreach($resultA as $r){
		if($r['Point']==round($a)){
			$AnalysisA = ' <div class="block-header">'.$r['Discription']." (".$a."): </div><p>". $r['Analysis'] .'</p>';
		}
	}
		$resultE = X_personalityresults::find('all',array(
		'conditions'=>array(
			'Category'=>'E',
			),
		));
	foreach($resultE as $r){
		if($r['Point']==round($e)){
			$AnalysisE = ' <div class="block-header">'.$r['Discription'].' ('.$e.'): </div><p>'. $r['Analysis'] .'</p>';
		}
	}
		$resultN = X_personalityresults::find('all',array(
		'conditions'=>array(
			'Category'=>'N',
			),
		));
	foreach($resultN as $r){
		if($r['Point']==round($n)){
			$AnalysisN = ' <div class="block-header">'.$r['Discription'].' ('.$n.'): </div><p>'. $r['Analysis'] .'</p>';
		}
	}
		$resultC = X_personalityresults::find('all',array(
		'conditions'=>array(
			'Category'=>'C',
			),
		));
	foreach($resultC as $r){
		if($r['Point']==round($c)){
			$AnalysisC = ' <div class="block-header">'.$r['Discription'].' ('.$c.'): </div><p>'. $r['Analysis'] .'</p>';
		}
	}
		$resultO = X_personalityresults::find('all',array(
		'conditions'=>array(
			'Category'=>'O',
			),
		));
	foreach($resultO as $r){
		if($r['Point']==round($o)){
			$AnalysisO = '<div class="block-header">'.$r['Discription'].' ('.$o.'): </div><p>'. $r["Analysis"] .'</p>';
		}
	}
	
	
		if($json==true){
			$html = '<div class="block-title">'.$personalityusers['Name'].'</div>';
			$html = $html . "".$AnalysisA;
			$html = $html . "".$AnalysisE;
			$html = $html . "".$AnalysisC;
			$html = $html . "".$AnalysisN;
			$html = $html . "".$AnalysisO;
			
			return $html;
		}else{
			return compact('personalityusers','a','e','n','c','o','AnalysisA','AnalysisE','AnalysisC','AnalysisN','AnalysisO');
		}
}
}
?>