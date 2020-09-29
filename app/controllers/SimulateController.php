<?php
namespace app\controllers;
use \lithium\data\Model;
use app\models\S_users;

class SimulateController extends \lithium\action\Controller {


 protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'savings';
 }

 public function AddUser($month=null){
  $name = $this->Name();
  
  $users = S_users::find('all',array(
  'order'=>array('mcaNumber'=>'ASC')
  ));
  $countusers = S_users::count('all');
  

  $yyyymm = date("Y-m", strtotime($month ." month", strtotime(date("F") . "1")) );

 foreach($users as $u){
  $user = S_users::find('first',array(
  'conditions'=>array('mcaNumber'=>$u['mcaNumber'])
  ));
  $new_mcaNumber = "";

  for($i = 1; $i<4 ;$i++){

   if($new_mcaNumber==""){
    $refer = $u['mcaNumber'];
   }else{
    $refer = $new_mcaNumber;
   }

  
  $maxuser = S_users::find('first',array(
  'order'=>array('mcaNumber'=>'DESC'),
  'limit'=>1
  ));
//  print_r($maxuser['mcaNumber']); 
   
   $newName = $this->Name();
    $data = array(
    'mcaNumber' => (string)((integer)$maxuser['mcaNumber']+1),
    'mcaName' => $newName,
    'DateJoin' => $yyyymm . '-01',
    'refer' => (string)((integer)$refer),
    'refer_id'=> (string)((integer)$refer),
    'refer_name'=>$u['mcaName'],
    'Enable'=>'Enable',
    'ValidTitle'=>"Consultant",
    'PaidTitle'=>"Consultant",
    'Percent'=>7,
    'PrevCummPV'=>0,
    'ExtraPV'=>0,
    'PV'=>110,
    'BV'=>2970,
    'GPV'=>0,
    'GBV'=>0,
    'GrossPV'=>0,
    'PGPV'=>0,
    'PGBV'=>0,
    'RollUpBV'=>0,
    'Level'=>22,
    'Legs'=>0,
    'QDLegs'=>0,
    'APB'=>0,
    'DB'=>0,
    'LPB'=>0,
    'TF'=>0,
    'CF'=>0,
    'HF'=>0,
    'Gross'=>0,
    );
    
   $new_mcaNumber = $this->adduserSimulate($data,$yyyymm);
  // print_r($id);
  }
 }
 
// $this->batchProcess($month);
 
 return $this->render(array('json' => array("success"=>"Yes",'count'=>$name)));
 }
 
 
 public function batchProcess($month){
  $yyyymm = date("Y-m", strtotime($month ." month", strtotime(date("F") . "1")) );
  $users = S_users::find('all',array(
   'order'=>array('mcaNumber'=>'DESC')
  ));
  
  foreach($users as $u){
   print_r($u['mcaNumber']."\n - ");
   $ancestors = $u['ancestors'];
   $pv = $u[$yyyymm]['PV'];
   $bv = $u[$yyyymm]['BV'];
   $data = array(
    $yyyymm . ".GPV" => $u[$yyyymm]['GPV']+$pv,
    $yyyymm . ".GBV" => $u[$yyyymm]['GBV']+$bv,
    'mcaNumber'=>(string)$u['mcaNumber'],
    'mcaName'=>(string)$u['mcaName'],
    
   );
   print_r($data);
   $conditions = array('mcaNumber'=>(string)$u['mcaNumber']);
   S_users::update($data,$conditions);
   
   foreach($ancestors as $a){
    if($a!=""){
    print_r($a ."a\n");
    $conditions = array('mcaNumber'=>(string)$a);
    
    $upline = S_users::find('first',array(
     'conditions'=>$conditions
    ));
    $gpv = $upline[$yyyymm]['GPV']+ $pv;
    $gbv = $upline[$yyyymm]['GBV']+ $bv;
    
    $data = array(
     $yyyymm . ".GPV" => $gpv,
     $yyyymm . ".GBV" => $gbv,
     'mcaNumber'=>(string)$a
     
    ); 
    print_r($data);
    S_users::update($data,$conditions);
    }
   }
   
  }
  
  return $this->render(array('json' => array("success"=>"Yes")));
 }
 
 public function adduserSimulate($data,$yyyymm){
 
  if($data){
  if($data['mcaNumber']!="" && $data["mcaName"]!=""){

   $refer = S_users::first(array(
     'fields'=>array('left','mcaNumber','ancestors','mcaName'),
      'conditions'=>array('mcaNumber'=>(string)$data['refer'])
     ));
   $refer_ancestors = $refer['ancestors'];
   
   $ancestors = array();
   if(count($refer_ancestors)>0){
    foreach ($refer_ancestors as $ra){
     array_push($ancestors, $ra);
    }
   }
   $refer_mcanumber = (string) $refer['mcaNumber'];

   array_push($ancestors,$refer_mcanumber);

   $refer_id = $refer_mcanumber;
   $refer_left = (integer)$refer['left'];
   $refer_left_inc = (integer)$refer['left'];
   $refername = S_users::find('first',array(
     'fields'=>array('mcaName','mcaNumber'),
     'conditions'=>array('mcaNumber'=>(string)$data['refer'])
   ));
   
   $refer_name = $refername['mcaName'];
   $refer_id = $refername['mcaNumber']; 

   
  }else{
   $refer_left = 0;
   $refer_name = "";
   $refer_id = "";
   $ancestors = array();
  }
   S_users::update(
    array(
     '$inc' => array('right' => (integer)2)
    ),
    array('right' => array('>'=>(integer)$refer_left_inc)),
    array('multi' => true)
   );
   S_users::update(
    array(
     '$inc' => array('left' => (integer)2)
    ),
    array('left' => array('>'=>(integer)$refer_left_inc)),
    array('multi' => true)
   );
  
  $data = array(
   'mcaName'=>(string)$data["mcaName"],
   'mcaNumber'=>(string)$data["mcaNumber"],
   'refer'=>(string)$data["refer"],
   'refer_name'=>$refer_name,
   'refer_id'=>(string)$refer_id,
   'ancestors'=> $ancestors,
   'DateJoin'=>(string)$data["DateJoin"],
   'left'=>(integer)($refer_left+1),
   'right'=>(integer)($refer_left+2),
   'Enable'=>$data['Enable'],
    $yyyymm.'.ValidTitle'=>(string)$data['ValidTitle'],
    $yyyymm.'.PaidTitle'=>(string)$data['PaidTitle'],
    $yyyymm.'.Percent'=>(integer)$data['Percent'],
    $yyyymm.'.PrevCummPV'=>(integer)$data['PrevCummPV'],
    $yyyymm.'.ExtraPV'=>(integer)$data['ExtraPV'],     
    $yyyymm.'.PV'=>(integer)$data['PV'],
    $yyyymm.'.BV'=>(integer)$data['BV'],
    $yyyymm.'.GPV'=>(integer)$data['GPV'],
    $yyyymm.'.GBV'=>(integer)$data['GBV'],
    $yyyymm.'.GrossPV'=>(integer)$data['GrossPV'],
    $yyyymm.'.PGPV'=>(integer)$data['PGPV'],
    $yyyymm.'.PGBV'=>(integer)$data['PGBV'],
    $yyyymm.'.RollUpBV'=>(integer)$data['RollUpBV'],
    'Level'=>(integer)$data['Level'],
    $yyyymm.'.Legs'=>(integer)$data['Legs'],
    $yyyymm.'.QDLegs'=>(integer)$data['QDLegs'],
    $yyyymm.'.APB'=>(integer)$data['APB'],
    $yyyymm.'.DB'=>(integer)$data['DB'],
    $yyyymm.'.LPB'=>(integer)$data['LPB'],
    $yyyymm.'.TF'=>(integer)$data['TF'],
    $yyyymm.'.CF'=>(integer)$data['CF'],
    $yyyymm.'.HF'=>(integer)$data['HF'],
    $yyyymm.'.Gross'=>(integer)$data['Gross'],

  );
  S_users::create()->save($data);
  return $data['mcaNumber'];
  }

 }

public function Name(){
 
  $firstname = array("Nilam","Ruchi","Hiral","Vasantha","Love","Preeti","Kamini","Vaishali","Ruchita","Paras","Caroyln","Janak","Chanda","Rushi","Alpaben","Aman","Amisha","Amitsingh","Aneesh","Aniketsingh","Anilkumar","Anjana","Ankit","Ankita","Antara","Anupama","Anupma","Anuradha","Archesh","Arunaben","Asha","Ashif","Ashwin","Asmita","Bajranglal","Bajrangsingh","Bajrui","Bhagvanji","Bhagvatiben","Bharatiben","Bharatkumar","Bhavnaben","Bhupendrakumar","Bina","Bipinkumar","Brijnath","Chandrikaben","Chayaben","Chhaya","Chhayaben","Chirag","Darshnaben","Deepak","Deepakkumar","Deepmala","Dhananajay","Dharmendra","Dharmesh","Dharmeshbhai","Dharmistha","Digvijaysinh","Dilaversinh","Dinesh","Dineshbhai","Ekta","Gamit","Geeta","Geetaben","Gendalal","Gitaben","Gohil","Gordhanbhai","Grishmaben","Hansaben","Harshvardhan","Hasan","Hemantkumar","Hemlataben","Heta","Hetal","Hetalben","Hiren","Jatin","Jigarsinh","Jitendrasingh","Jyoti","Kanaksinh","Kanchanben","Kapil","Kapilaben","Kavita","Khushboo","Kiran","Kushwaha","Laduben","Maheshkumar","Mahi","Makwana","Mamta","Maniben","Manoj","Manthankumar","Mayankkumar","Meenal");
  $lastname = array("Parmar","Purohit","Dua","Singh","Sood","Desai","Darji","Lokhandwala","Patel","Chauhan","Choudhari","Danani","Dataniya","Deep","Doctor","Dua","Gamit","Gawankar","Gurjar","Jalali","Kumar","Kumari","Laljibhai","Makawana","Mehta","Mishara","Mistry","Muzaammil","Patel","Pathan","Prajapati","Rajput","Ramlawat","Rampuriya","Ritaben","Saboo","Sekh","Shah","Shahdadpuri","Shaikh","Shantilal","Sharma","Sheorn","Singar","Singh","Solanki","Tiwari","Tiwari","Vaghela","Vaishnav","Vankar","Vekariya","Yadav","Zameer",);  
    $name = $firstname[rand ( 0 , count($firstname) -1)];
    $name .= ' ';
    $name .= $lastname[rand ( 0 , count($lastname) -1)];
 return $name;
}



//Tree
public function tree($mcaNumber = null,$yyyymm=null,$D=null ){
	ini_set('max_execution_time', '0');
	ini_set("memory_limit", "-1");

$this->_render['layout'] = 'noHeaderFooter';
 
			$selfline = S_users::find('first',array(
				'conditions'=>array('mcaNumber'=>$mcaNumber)
			));
			
			$user = S_users::find('first',array(
				'conditions'=>array('mcaNumber'=>$mcaNumber)
			));
   
   
   
			$allS_users = array();
   
				array_push($allS_users,array(
					'mcaNumber'=>$user['mcaNumber'],
					'mcaName'=>$user['mcaName'],
					'refer'=>$user['refer'],
     'PV'=>$user[$yyyymm]['PV'],
     'PGPV'=>$user[$yyyymm]['PGPV'],
					'PGBV'=>$user[$yyyymm]['PGBV'],
					'GrossPV'=>$user[$yyyymm]['GrossPV'],
     'GPV'=>$user[$yyyymm]['GPV'],
					'GBV'=>$user[$yyyymm]['GBV'],
					'RollUpPV'=>$user[$yyyymm]['RollUpPV'],					
					'InActive'=>$user[$yyyymm]['InActive'],
					'PaidTitle'=>$user[$yyyymm]['PaidTitle'],
					'DateJoin'=>$user['DateJoin'],
					'Days'=>(string)round((time()-strtotime($user['DateJoin']))/60/60/24,0)
				));				
			if($D==null){
				$S_users = S_users::find('all',array(
					'conditions'=>array(
						'left'=>array('$gt'=>$user['left']),
						'right'=>array('$lt'=>$user['right']),
					),
					'order'=>array(
					//'mcaName'=>'ASC'
					)
			));
			}else{
				$S_users = S_users::find('all',array(
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
			
			
			
			foreach($S_users as $u){
    $count = $this->countChilds($u['mcaNumber']);
//    print_r($u['mcaName']."<br>");
				array_push($allS_users,array(
					'mcaNumber'=>$u['mcaNumber'],
					'mcaName'=>$u['mcaName'],
					'refer'=>$u['refer'],
     'PV'=>$u[$yyyymm]['PV'],
					'PGPV'=>$u[$yyyymm]['PGPV'],
					'PGBV'=>$u[$yyyymm]['PGBV'],
					'GrossPV'=>$u[$yyyymm]['GrossPV'],
					'RollUpPV'=>$u[$yyyymm]['RollUpPV'],
     'GPV'=>$u[$yyyymm]['GPV'],
					'GBV'=>$u[$yyyymm]['GBV'],
					'InActive'=>$u[$yyyymm]['InActive'],
					'PaidTitle'=>$u[$yyyymm]['PaidTitle'],
					'DateJoin'=>$u['DateJoin'],
					'Days'=>(string)round((time()-strtotime($u['DateJoin']))/60/60/24,0)
    ));				
			}
			$self = S_users::find('first', array(
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
				'PGBV'=>$self[$yyyymm]['PGBV'],
				'GrossPV'=>$self[$yyyymm]['GrossPV'],
				'RollUpPV'=>$self[$yyyymm]['RollUpPV'],
    'GPV'=>$self[$yyyymm]['GPV'],
				'GBV'=>$self[$yyyymm]['GBV'],
				'InActive'=>$self[$yyyymm]['InActive'],
				'PaidTitle'=>$self[$yyyymm]['PaidTitle'],
				'Days'=>(string)round((time()-strtotime($self['DateJoin']))/60/60/24,0)
			);

// print_r($allS_users);

			return compact('allS_users','level','selfline','yyyymm','D');	

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
		$ParentDetails = S_users::find('all',array(
			'conditions'=>array(
			'mcaNumber' => $user_id
			)));
		foreach($ParentDetails as $pd){
			$left = $pd['left'];
			$right = $pd['right'];
		}
		$NodeDetails = S_users::count(array(
			'conditions' => array(
				'left'=>array('$gt'=>$left),
				'right'=>array('$lt'=>$right)
			))
		);

		return $NodeDetails;
	}

















}


?>