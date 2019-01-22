<?php
namespace app\controllers;

use app\models\Directors;

use app\models\Builders;


class TeamController extends \lithium\action\Controller {

 public function index() {
  $directors = Directors::find('all',array(
   'order'=>array('_id'=>'DESC')
  ));
  
  		return compact('directors');
 }
 public function qualified($legs=null,$yyyymm=null){
  
  $directors = Directors::find('all',array(
   'order'=>array('_id'=>'DESC')
  ));
  
  $previousmonth = date('Y-m',strtotime("-1 month", strtotime(date("F") . "1")));
  
  var_dump(array($previousmonth.'.Legs'=>(integer)$legs),
  array($previousmonth.'.Percent'=>array('$gte'=>(integer)22)));
  print_r($previousmonth.'.Legs');
  $builders = Builders::find('all',array(
    $conditions = array(
//     $previousmonth.'.QDLegs'=>(integer)$legs,
     $previousmonth.'.Percent'=>array('$gte'=>(integer)22)
    ),
    $order = array($previousmonth.'.Percent'=>'DESC',$previousmonth.'.Legs'=>'ASC')
  ));
  		return compact('directors','builders','previousmonth');
 }

 public function privacy(){ }
 public function terms(){ }
 public function support(){ }
 }
?>