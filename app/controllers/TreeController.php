<?php
namespace app\controllers;
use app\models\Users;


class TreeController extends \lithium\action\Controller {
 protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'noHeaderFooter';
 }

public function index($mcaNumber = null,$yyyymm=null,$D=null ){
	ini_set('max_execution_time', '0');
	ini_set("memory_limit", "-1");

$this->_render['layout'] = 'noHeaderFooter';
 
			$selfline = Users::find('first',array(
				'conditions'=>array('mcaNumber'=>$mcaNumber)
			));
			
			$user = Users::find('first',array(
				'conditions'=>array('mcaNumber'=>$mcaNumber)
			));
   
			$allusers = array();
   
				array_push($allusers,array(
					'mcaNumber'=>$user['mcaNumber'],
					'mcaName'=>$user['mcaName'],
					'refer'=>$user['refer'],
     'PV'=>$user[$yyyymm]['PV'],
     'PGPV'=>$user[$yyyymm]['PGPV'],
					'GrossPV'=>$user[$yyyymm]['GrossPV'],
     'GPV'=>$user[$yyyymm]['GPV'],
					'GBV'=>$user[$yyyymm]['GBV'],
					'RollUpPV'=>$user[$yyyymm]['RollUpPV'],					
					'InActive'=>$user[$yyyymm]['InActive'],
					'PaidTitle'=>$user[$yyyymm]['PaidTitle']
				));				
			if($D==null){
				$users = Users::find('all',array(
					'conditions'=>array(
						'left'=>array('$gt'=>$user['left']),
						'right'=>array('$lt'=>$user['right']),
					),
					'order'=>array(
					//'mcaName'=>'ASC'
					)
			));
			}else{
				$users = Users::find('all',array(
					'conditions'=>array(
						'left'=>array('$gt'=>$user['left']),
						'right'=>array('$lt'=>$user['right']),
						$yyyymm.'.Level'=>22
					),
					'order'=>array(
					//'mcaName'=>'ASC'
					)
			));	
			}
			
			
			
			foreach($users as $u){
    $count = $this->countChilds($u['mcaNumber']);
    //print_r($u['mcaName']."<br>");
				array_push($allusers,array(
					'mcaNumber'=>$u['mcaNumber'],
					'mcaName'=>$u['mcaName'],
					'refer'=>$u['refer'],
     'PV'=>$u[$yyyymm]['PV'],
					'PGPV'=>$u[$yyyymm]['PGPV'],
					'GrossPV'=>$u[$yyyymm]['GrossPV'],
					'RollUpPV'=>$u[$yyyymm]['RollUpPV'],
     'GPV'=>$u[$yyyymm]['GPV'],
					'GBV'=>$u[$yyyymm]['GBV'],
					'InActive'=>$u[$yyyymm]['InActive'],
					'PaidTitle'=>$u[$yyyymm]['PaidTitle']
    ));				
			}
			$self = Users::find('first', array(
				'conditions'=>array(
					'mcaNumber'=>(string)$mcaNumber,
				),
				'order'=>array('mcaName'=>'ASC')
			));
			$selfline = array(
				'mcaNumber'=>$self['mcaNumber'],
				'mcaName'=>$self['mcaName'],
				'_id'=>(string)$self['_id'],
				'DateJoin'=>$self['DateJoin'],
				'refer'=>$self['refer'],
				'referName'=>$self['refer_name'],
    'PV'=>$self[$yyyymm]['PV'],
				'PGPV'=>$self[$yyyymm]['PGPV'],
				'GrossPV'=>$self[$yyyymm]['GrossPV'],
				'RollUpPV'=>$self[$yyyymm]['RollUpPV'],
    'GPV'=>$self[$yyyymm]['GPV'],
				'GBV'=>$self[$yyyymm]['GBV'],
				'InActive'=>$self[$yyyymm]['InActive'],
				'PaidTitle'=>$self[$yyyymm]['PaidTitle'],
				'Days'=>(string)round((time()-strtotime($self['DateJoin']))/60/60/24,0)
			);

			return compact('allusers','level','selfline','yyyymm','D');	

 }



	public function countChilds($user_id){
	#Retrieving a Full Tree
	/* 	SELECT node.user_id
	FROM details AS node,
			details AS parent
	WHERE node.lft BETWEEN parent.lft AND parent.rgt
		   AND parent.user_id = 3
	ORDER BY node.lft;
	
	parent = db.details.findOne({user_id: ObjectId("50e876e49d5d0cbc08000000")});
	query = {left: {$gt: parent.left, $lt: parent.right}};
	select = {user_id: 1};
	db.details.find(query,select).sort({left: 1})
	 */
		$ParentDetails = Users::find('all',array(
			'conditions'=>array(
			'mcaNumber' => $user_id
			)));
		foreach($ParentDetails as $pd){
			$left = $pd['left'];
			$right = $pd['right'];
		}
		$NodeDetails = Users::count(array(
			'conditions' => array(
				'left'=>array('$gt'=>$left),
				'right'=>array('$lt'=>$right)
			))
		);

		return $NodeDetails;
	}

} 
 
?>