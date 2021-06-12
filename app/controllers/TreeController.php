<?php
namespace app\controllers;
use app\models\Users;
use app\models\Mobiles;


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
   $mobile = Mobiles::find('first',array(
				'conditions'=>array('mcaNumber'=>$mcaNumber)
			));
			$allusers = array();
   
   
				array_push($allusers,array(
					'mcaNumber'=>$user['mcaNumber'],
					'mcaName'=>$user['mcaName'],
     'mobile'=>$mobile['Mobile'],
					'refer'=>$user['refer'],
     'KYC'=>$user['KYC'],
     'NEFT'=>$user['NEFT'],
     'PV'=>$user[$yyyymm]['PV'],
     'ExtraPV'=>$user[$yyyymm]['ExtraPV'],     
     'PGPV'=>$user[$yyyymm]['PGPV'],
					'PGBV'=>$user[$yyyymm]['PGBV'],
					'GrossPV'=>$user[$yyyymm]['GrossPV'],
     'GPV'=>$user[$yyyymm]['GPV'],
					'GBV'=>$user[$yyyymm]['GBV'],
					'RollUpPV'=>$user[$yyyymm]['RollUpPV'],					
					'InActive'=>$user[$yyyymm]['InActive'],
					'PaidTitle'=>$user[$yyyymm]['PaidTitle'],
					'ValidTitle'=>$user[$yyyymm]['ValidTitle'],
     'Gross'=>$user[$yyyymm]['Gross'],
     'TotalEPV'=>$user[$yyyymm]['TotalEPV'],
					'DateJoin'=>$user['DateJoin'],
					'Days'=>(string)round((time()-strtotime($user['DateJoin']))/60/60/24,0)
				));				
    
			if($D==null){
				$users = Users::find('all',array(
					'conditions'=>array(
						'left'=>array('$gt'=>$user['left']),
						'right'=>array('$lt'=>$user['right']),
      "Enable" => "Yes"
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
						$yyyymm.'.Percent'=>(integer)16,
      "Enable" => "Yes"
					),
					'order'=>array(
					//'mcaName'=>'ASC'
					)
			));	
			}
			print_r(count($users));exit;
			
			foreach($users as $u){
    $mobile = Mobiles::find('first',array(
				'conditions'=>array('mcaNumber'=>$u['mcaNumber'])
			));
    $count = $this->countChilds($u['mcaNumber']);
    //print_r($u['mcaName']."<br>");
				array_push($allusers,array(
					'mcaNumber'=>$u['mcaNumber'],
     'mobile'=>$mobile['Mobile'],
					'mcaName'=>$u['mcaName'],
					'refer'=>$u['refer'],
     'KYC'=>$u['KYC'],
     'NEFT'=>$u['NEFT'],
     'PV'=>$u[$yyyymm]['PV'],
     'ExtraPV'=>$u[$yyyymm]['ExtraPV'],
					'PGPV'=>$u[$yyyymm]['PGPV'],
					'PGBV'=>$u[$yyyymm]['PGBV'],
					'GrossPV'=>$u[$yyyymm]['GrossPV'],
					'RollUpPV'=>$u[$yyyymm]['RollUpPV'],
     'GPV'=>$u[$yyyymm]['GPV'],
					'GBV'=>$u[$yyyymm]['GBV'],
					'InActive'=>$u[$yyyymm]['InActive'],
					'PaidTitle'=>$u[$yyyymm]['PaidTitle'],
     'ValidTitle'=>$u[$yyyymm]['ValidTitle'],
     'Gross'=>$u[$yyyymm]['Gross'],
     'TotalEPV'=>$u[$yyyymm]['TotalEPV'],
					'DateJoin'=>$u['DateJoin'],
					'Days'=>(string)round((time()-strtotime($u['DateJoin']))/60/60/24,0)
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
    'NEFT'=>$self['NEFT'],
    'KYC'=>$self['KYC'],
				'refer'=>$self['refer'],
				'referName'=>$self['refer_name'],
    'PV'=>$self[$yyyymm]['PV'],
    'ExtraPV'=>$self[$yyyymm]['ExtraPV'],
				'PGPV'=>$self[$yyyymm]['PGPV'],
				'PGBV'=>$self[$yyyymm]['PGBV'],
				'GrossPV'=>$self[$yyyymm]['GrossPV'],
				'RollUpPV'=>$self[$yyyymm]['RollUpPV'],
    'GPV'=>$self[$yyyymm]['GPV'],
				'GBV'=>$self[$yyyymm]['GBV'],
				'InActive'=>$self[$yyyymm]['InActive'],
				'PaidTitle'=>$self[$yyyymm]['PaidTitle'],
    'ValidTitle'=>$self[$yyyymm]['ValidTitle'],
    'Gross'=>$self[$yyyymm]['Gross'],
    'TotalEPV'=>$self[$yyyymm]['TotalEPV'],
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