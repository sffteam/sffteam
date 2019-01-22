<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use app\extensions\action\Functions;

use app\models\Notifications;
use app\models\Users;
use app\models\Points;
use app\models\Plans;
use app\models\Savings;
use app\models\Products;
use app\models\Admins;
use app\models\Logins;
use app\models\Reasons;

class DashboardController extends \lithium\action\Controller {


 protected function _init() {
  parent::_init();
  $user = Session::read('default');
  if($user==null){
   return $this->redirect('/savings');
  }
  $this->_render['layout'] = 'savings';
 }
 public function index() {
  $approvedNo = Savings::count(array('approved'=>'No'));
  $approvedYes = Savings::count(array(
   'approved'=>'Yes'));
  $registeredYes = Savings::find('all',array(
    'conditions'=>array(
      'approved'=>'Yes',
   )));
   $registered = 0;
   $paid = 0;
   foreach ($registeredYes as $r){
    if($r['payment']['summary']){
    foreach($r['payment']['summary'] as $p){
     if($p['approved']=='Yes' && $p['shopping']==1110){
       $registered = $registered + 1;
     }
     if($p['approved']=='Yes' && $p['shopping']>1110){
       $paid = $paid + 1;
     }
    }
   }
  }
  $points = Points::find('all');
  return compact('approvedNo','approvedYes','registered','paid','points');
 }
 public function approve(){
  $approvedNo = Savings::count(array('approved'=>'No'));
  $approvedYes = Savings::count(array(
   'approved'=>'Yes'));
  $registeredYes = Savings::find('all',array(
    'conditions'=>array(
      'approved'=>'Yes',
   )));
   $registered = 0;
   $paid = 0;
   foreach ($registeredYes as $r){
    if($r['payment']['summary']){
    foreach($r['payment']['summary'] as $p){
     if($p['approved']=='Yes' && $p['shopping']==1110){
       $registered = $registered + 1;
     }
     if($p['approved']=='Yes' && $p['shopping']>1110){
       $paid = $paid + 1;
     }
    }
   }
  }
  $users = Savings::find('all',array(
   'conditions'=>array('approved'=>'No')
  ));
  $reasons = Reasons::find('all');
  $points = Points::find('all');
  return compact ('users','reasons','approvedNo','approvedYes','registered','paid','points');
 }
 
 public function approved(){
  $approvedNo = Savings::count(array('approved'=>'No'));
  $approvedYes = Savings::count(array('approved'=>'Yes'));
  $registeredYes = Savings::find('all',array(
    'conditions'=>array(
      'approved'=>'Yes',
   )));
   $registered = 0;
   $paid = 0;
   foreach ($registeredYes as $r){
    if($r['payment']['summary']){
    foreach($r['payment']['summary'] as $p){
     if($p['approved']=='Yes' && $p['shopping']==1110){
       $registered = $registered + 1;
     }
     if($p['approved']=='Yes' && $p['shopping']>1110){
       $paid = $paid + 1;
     }
    }
   }
  }
  $users = Savings::find('all',array(
   'conditions'=>array('approved'=>'Yes')
  ));
  $reasons = Reasons::find('all');
  $points = Points::find('all');
  
  return compact ('users','reasons','approvedNo','approvedYes','registered','paid','points');
 }
 public function registered(){
  $approvedNo = Savings::count(array('approved'=>'No'));
  $approvedYes = Savings::count(array('approved'=>'Yes'));
  $registeredYes = Savings::find('all',array(
    'conditions'=>array(
      'approved'=>'Yes',
   )));
   $registered = 0;
   $paid = 0;
   foreach ($registeredYes as $r){
    if($r['payment']['summary']){
    foreach($r['payment']['summary'] as $p){
     if($p['approved']=='Yes' && $p['shopping']==1110){
       $registered = $registered + 1;
     }
     if($p['approved']=='Yes' && $p['shopping']>1110){
       $paid = $paid + 1;
     }
    }
   }
  }
  
  
  
  
  $users = Savings::find('all',array(
   'conditions'=>array(
    'payment'=>array(
      '$elemMatch'=>array('approved'=>'Yes'
      )
    )
   )
  ));
  
  
  
  
  
  
  
  
  
  $reasons = Reasons::find('all');
  $points = Points::find('all');
  return compact ('users','reasons','approvedNo','approvedYes','registered','paid','points');
 }
 public function doapprove($reason="",$mcaNumber="",$point=""){
  if($reason=="" || $mcaNumber=="" || $point==""){
    $success = "No";
    
    return $this->render(array('json' => array("success"=>$success)));		
  }else{
   $reason = Reasons::find('first',array(
    'conditions'=>array('_id'=>(string)$reason)
   ));
   $points = Points::find('first',array(
    'conditions'=>array('name'=>urldecode($point))
   ));
   
   $pointfound = array(
    'name'=>$points['name'],
    'address'=>$points['address'],
    'street'=>$points['street'],
    'city'=>$points['city'],
    'pin'=>$points['pin'],
    'state'=>$points['state'],
    'person'=>$points['person'],
    'mobile'=>$points['mobile'],
    'email'=>$points['email']
   );
   
   $data = array(
    'approved'=>$reason['approve'],
    'point'=>$pointfound,
    'reason'=>$reason['reason'],
   );
   $conditions = array(
    'mcaNumber'=>(string)$mcaNumber
   );
   $success = "Yes";
   Savings::update($data,$conditions);
   
   if($reason['approve']=="Yes"){

    $function = new Functions();
    $function->addnotify($mcaNumber,"Your application is Approved!","Your application is approved. Please make an initial payment of Rs. 1110 towards training and literature.");


   }else{
    $function = new Functions();
    $function->addnotify($mcaNumber,"Your application is waiting for approval","Please correct the application and resubmit again!");
   } 
   
   return $this->render(array('json' => array("success"=>$reason['approve'])));		
  }
 }

 
 public function products($cat=null){
  $categories = Products::find('all',array(
			'fields'=>array('category','code'),
			'order'=>array('category'=>'ASC')
		));
		$category = '';
		$allcategories = array();
		
		foreach($categories as $c){
			$count = Products::count(array(
				'category'=>$c['category']
			));
			$oldcategory = $c['category'];
				if($category != $c['category']){
					array_push($allcategories,array('name'=>$c['category'],'count'=>$count));
				}
				$category = $c['category'];
		}
  
  $allproducts = array();
 		$products = Products::find('all',array(
			'conditions'=>array('category'=>rawurldecode(urldecode($cat))),
			'order'=>array('code'=>'ASC')
		));
		$product = array();
		$allproducts = array();
		foreach($products as $p){
			$product = array(
				'_id' => (string)$p['_id'],
				'category' => (string)$p['category'],
				'code' => (string)$p['code'],
				'name' => (string)$p['name'],
				'size' => (string)$p['size'],
				'mrp' => (string)$p['mrp'],
				'dp' => (string)$p['dp'],
				'bv' => (string)$p['bv'],
    'discount'=>(string)$p['discount'],
    'discountType'=>(string)$p['discountType'],
    'stock'=>(string)$p['stock'],
    'quantity'=>(string)$p['quantity'],
				'description' => (string)$p['description'],
				'video' => (string)$p['video'],
			);
			array_push($allproducts,$product);
		}
  return compact('allproducts','allcategories','category');		
 }
 
 public function product($code=null){
  $product = Products::find('first',array(
   'conditions'=>array('code'=>$code),
			'order'=>array('code'=>'ASC')
		));
  
  
		$categories = Products::find('all',array(
			'fields'=>array('category'),
			'order'=>array('category'=>'ASC')
		));
		$category = '';
		$allcategories = array();
		
		foreach($categories as $c){
			$count = Products::count(array(
				'category'=>$c['category']
			));
			
			
			$oldcategory = $c['category'];
				if($category != $c['category']){
					array_push($allcategories,array('name'=>$c['category'],'count'=>$count));
				}
				$category = $c['category'];
		}  
  return compact('allcategories','product');
  
 }
 public function updateProduct($code,$discount,$discountType,$stock,$quantity){
  $data = array(
   'discount'=>$discount,
   'discountType'=>$discountType,
   'stock'=>$stock,
   'quantity'=>$quantity,
  );
  $conditions = array('code'=>$code);
  Products::update($data,$conditions);
  
  $users = Savings::find('all',array(
   'conditions'=>array('approved'=>'Yes')
  ));

  $product = Products::find('first',array(
   'conditions'=>array('code'=>$code)
  ));
  
  
  foreach($users as $u){
      $function = new Functions();
      $function->addnotify($u['mcaNumber'],"Product code: ".$code. ", ".$product['name']." updated by administrator.","Check the product code for updation in discount, discount type or stock availability.");
  }
  
  
  return $this->render(array('json' => array("success"=>"Yes")));		
 }
 
 public function import(){
  
  
		if($this->request->data){
			$file = $this->request->data['file'];	
			
			if($_FILES['file']['tmp_name'] == 0){	
				$name = $_FILES['file']['tmp_name'];
    $ext = strtolower(end(explode('.', $_FILES['file']['tmp_name'])));
    $type = $_FILES['file']['tmp_name'];
    $tmpName = $_FILES['file']['tmp_name'];
			}
			$row = 1;
 print_r($file);
			if (($handle = fopen($tmpName, "r")) !== FALSE) {
						while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
							$num = count($data);
							$row++;
								$data = array(
									'mcaNumber' => (string)$data[1],
									'mcaName' => ucwords(strtolower((string)$data[2])),
									'refer' => (integer)$data[5],
									'DateJoin' => (string)$data[4],
								);
								$user = Users::find("first",array(
								"conditions"=>array('mcaNumber'=>$data['mcaNumber'])
								));
								if(count($user)!=1){
									if($data['mcaNumber']!=""){
										if((int)$data['mcaNumber']>0){
											$this->adduserImports($data);
											print_r($data);
										}
									}
								}else{
											$this->updateuserImport($data);
        }
						}
						fclose($handle);
			}
  
  }
 }
 public function updateuserImport($data){
			$data = array(
				'mcaName'=>(string)$data["mcaName"],
				'mcaNumber'=>(string)$data["mcaNumber"],
				'refer'=>(string)$data["refer"],
				'refer_name'=>$refer_name,
				'refer_id'=>(string)$refer_id,
				'ancestors'=> $ancestors,
				'DateJoin'=>(string)$data["DateJoin"],
				'left'=>(integer)($refer_left+1),
				'right'=>(integer)($refer_left+2)
			);
   $conditions = array('mcaNumber'=>(string)$data["mcaNumber"]);
			Users::update($data,$conditions);
 }

 	public function adduserImports($data){
		
			if($data){
			if($data['mcaNumber']!="" && $data["mcaName"]!=""){
				print_r($data['refer']);
				$refer = Users::first(array(
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
				$refername = Users::find('first',array(
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
				Users::update(
					array(
						'$inc' => array('right' => (integer)2)
					),
					array('right' => array('>'=>(integer)$refer_left_inc)),
					array('multi' => true)
				);
				Users::update(
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
			);
			Users::create()->save($data);
			
		}

	}
 
 public function users($sponsor=null){
  
		$users = Users::find("all",array(
			'order'=>array('_id'=>'ASC')
		));
		if($this->request->data){
			if($this->request->data['mcaNumber']!="" && $this->request->data["mcaName"]!=""){

$saving = Savings::find('first',array(
  'conditions'=>array('mcaNumber'=>$this->request->data['mcaNumber'])
));

  $Plan = $this->request->data["Plan"];
print_r($Plan);
   $refer = Users::first(array(
						'fields'=>array('left','mcaNumber','ancestors','mcaName','plan'),
							'conditions'=>array('mcaNumber'=>$this->request->data['refer'])
						));
				$refer_ancestors = $refer['ancestors'];
				$ancestors = array();

				foreach ($refer_ancestors as $ra){
					array_push($ancestors, $ra);
				}
				$refer_mcanumber = (string) $refer['mcaNumber'];

				array_push($ancestors,$refer_mcanumber);

				$refer_id = $refer_mcanumber;
				$refer_left = (integer)$refer['left'];
				$refer_left_inc = (integer)$refer['left'];
				$refername = Users::find('first',array(
						'fields'=>array('mcaName','mcaNumber'),
						'conditions'=>array('mcaNumber'=>$this->request->data['refer'])
				));
				$refer_name = $refername['mcaName'];
				$refer_id = $refername['mcaNumber']; 
		
			}else{
				$refer_left = 0;
				$refer_name = "";
				$refer_id = "";
				$ancestors = array();
			}
   
   Users::update(
					array('$inc' => array('right' => (integer)2)),
					array('right' => array('>'=>(integer)$refer_left_inc)),
					array('multi' => true)
				);
				Users::update(
					array('$inc' => array('left' => (integer)2)),
					array('left' => array('>'=>(integer)$refer_left_inc)),
					array('multi' => true)
				);
			
			$data = array(
				'mcaName'=>(string)ucwords($this->request->data["mcaName"]),
				'mcaNumber'=>(string)$this->request->data["mcaNumber"],
				'refer'=>(string)$this->request->data["refer"],
				'refer_name'=>$refer_name,
				'refer_id'=>(string)$refer_id,
				'ancestors'=> $ancestors,
				'DateJoin'=>(string)$this->request->data["DateJoin"],
				'left'=>(integer)($refer_left+1),
				'right'=>(integer)($refer_left+2),
    'DP'=>(integer)$Plan,
    'PBV'=>(integer)$Plan/2,
    'GBV'=>(integer)$Plan/2,
			);

			Users::create()->save($data);
  }		
  
		$users = Users::find("all",array(
			'order'=>array('_id'=>'ASC')
		));
  $plans = Plans::find('all');

  $approvedNo = Savings::count(array('approved'=>'No'));
  $approvedYes = Savings::count(array(
   'approved'=>'Yes'));
  $registeredYes = Savings::find('all',array(
    'conditions'=>array(
      'approved'=>'Yes',
   )));
   
 
   $registered = 0;
   $paid = 0;
   
   foreach ($registeredYes as $r){
    if($r['payment']['summary']){
    foreach($r['payment']['summary'] as $p){
     if($p['approved']=='Yes' && $p['shopping']==1110){
       $registered = $registered + 1;
     }
     if($p['approved']=='Yes' && $p['shopping']>1110){
       $paid = $paid + 1;
     }
    }
   }
   }
  if($this->request->data){
   if($this->request->data['mcaNumber']!="" && $this->request->data["mcaName"]!=""){
     $getParents = $this->getParents((string)$this->request->data["mcaNumber"])  ;
     foreach($getParents as $p){
      $data = array('$inc' => array('GBV' => (integer)($Plan/2)));
      $conditions = array('mcaNumber'=>$p['mcaNumber']);
      Users::update($data,$conditions);
     }
   }
  }
 

  return compact('users','plans','approvedNo','approvedYes','registered','paid','sponsor');
 }

public function updateUser(){
  if($this->request->data){
   if($this->request->data['mcaNumber']!=""){
     $getParents = $this->getParents((string)$this->request->data["mcaNumber"])  ;
     foreach($getParents as $p){
      $data = array('$inc' => array('GBV' => (integer)($this->request->data['Plan']/2)));
      $conditions = array('mcaNumber'=>$p['mcaNumber']);
      Users::update($data,$conditions);
     }
   }
  }
  
  $plans = Plans::find('all');

  return compact('mcaNumber','plans');
}
 
 public function usertree($mcaNumber = null,$yyyymm=null){
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
     'PBV'=>$user['PBV'],
     'GBV'=>$user['GBV'],
     'DP'=>$user['DP'],
				));				
			
			$users = Users::find('all',array(
					'conditions'=>array(
						'left'=>array('$gt'=>$user['left']),
						'right'=>array('$lt'=>$user['right']),
					),
					'order'=>array(
						'mcaName'=>'ASC'
					)
			));
			
			
			foreach($users as $u){
    $count = $this->countChilds($u['mcaNumber']);
    //print_r($u[$yyyymm]['PaidTitle']);exit;
				array_push($allusers,array(
					'mcaNumber'=>$u['mcaNumber'],
					'mcaName'=>$u['mcaName'],
					'refer'=>$u['refer'],
     'PBV'=>$u['PBV'],
     'GBV'=>$u['GBV'],
     'DP'=>$u['DP'],
    ));				
			}
			$self = Users::find('first', array(
				'conditions'=>array('mcaNumber'=>(string)$mcaNumber),
				'order'=>array('mcaName'=>'ASC')
			));
			$selfline = array(
				'mcaNumber'=>$self['mcaNumber'],
				'mcaName'=>$self['mcaName'],
				'_id'=>(string)$self['_id'],
				'DateJoin'=>$self['DateJoin'],
				'refer'=>$self['refer'],
				'referName'=>$self['refer_name'],
    'PBV'=>$self['PBV'],
    'GBV'=>$self['GBV'],
    'DP'=>$self['DP'],

				'Days'=>(string)round((time()-strtotime($self['DateJoin']))/60/60/24,0)
			);

			return compact('allusers','level','selfline');	

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
	public function getParents($user_id){
	#Retrieving a Single Path above a user
	/* SELECT parent.user_id
	FROM details AS node,
			details AS parent
	WHERE node.lft BETWEEN parent.lft AND parent.rgt
			AND node.user_id = 10
	ORDER BY node.lft;
	
	node = db.details.findOne({user_id: ObjectId("50e876e49d5d0cbc08000000")});
	query = {left: {$gt: node.left, $lt: node.right}};
	select = {user_id: 1};
	db.details.find(query,select).sort({left: 1})
	 */
			$NodeDetails = Users::find('all',array(
				'conditions'=>array(
				'mcaNumber' => $user_id
			)));
			foreach($NodeDetails as $pd){
				$left = $pd['left'];
				$right = $pd['right'];
			}
			$ParentDetails = Users::find('all',array(
				'conditions' => array(
					'left'=>array('$lt'=>$left),
					'right'=>array('$gt'=>$right)
				),
				'order'=>array('left'=>'ASC')
				));
		return $ParentDetails;
	}	
 public function paid(){
  $approvedNo = Savings::count(array('approved'=>'No'));
  $approvedYes = Savings::count(array(
   'approved'=>'Yes'));
  $registeredYes = Savings::find('all',array(
    'conditions'=>array(
      'approved'=>'Yes',
   )));

		$users = Savings::find("all",array(
			'order'=>array('_id'=>'ASC')
		));  
  $registered = 0;
   $paid = 0;
   foreach ($registeredYes as $r){
    if($r['payment']['summary']){
    foreach($r['payment']['summary'] as $p){
     if($p['approved']=='Yes' && $p['shopping']==1110){
       $registered = $registered + 1;
     }
     if($p['approved']=='Yes' && $p['shopping']>1110){
       $paid = $paid + 1;
     }
    }
   }
  }
  return compact('users','approvedNo','approvedYes','registered','paid');

 }
 
 public function invoices($mcaNumber=null){
  if($mcaNumber==null){
  $users = Savings::find('all',array(
   'conditions'=>array(
    'payment'=>array(
      '$elemMatch'=>array(
       'approved'=>'Yes',
       'shopping'=>array('$gt'=>10000)
      )
    )
   )
  ));
  }else{
   $users = Savings::find('all',array(
   'conditions'=>array(
    'mcaNumber'=>$mcaNumber
   )
  ));
  }
 return compact('users');
   
 }
 public function orders($mcaNumber=null){
  $yyyymm = gmdate('Y-m');
  if($mcaNumber==null){
  $users = Savings::find('all',array(
   'conditions'=>array(
    'summary.'.$yyyymm.'.delivery'=>array('$ne'=>'')
   )
  ));
  }else{
   $users = Savings::find('all',array(
   'conditions'=>array(
    'mcaNumber'=>$mcaNumber
   )
  ));
  }
 return compact('users');
}
public function getorder($yyyy = null,$mcaNumber=null){
   $user = Savings::find('first',array(
   'conditions'=>array(
    'mcaNumber'=>$mcaNumber
   )
  ));
  $print = $this->createPDF($mcaNumber,$yyyy);
  
  
 return $this->render(array('json' => array("success"=>"Yes", 'user'=>$user['summary'][$yyyy],'order'=>$user[$yyyy])));		
}

 public function orderpdf($mcaNumber,$yyyy){
    $print = $this->createPDF($mcaNumber,$yyyy);
 }
 private function createPDF($mcaNumber,$yyyy){
  $order = Savings::find('first',array(
   'conditions'=>array(
    'mcaNumber'=>$mcaNumber
    )
  ));

		$view  = new View(array(
		'paths' => array(
			'template' => '{:library}/views/{:controller}/{:template}.{:type}.php',
			'layout'   => '{:library}/views/layouts/{:layout}.{:type}.php',
		)
		));
		
  echo $view->render(
		'all',
		compact('order','yyyy'),
		array(
			'controller' => 'print',
			'template'=>'printOrder',
			'type' => 'pdf',
			'layout' =>'OrderPrint'
		)
		);	
  
  return true;
 }

 public function saveinvoice($yyyymm=null,$mcaNumber=null,$dp1=null,$bv1=null,$invoice1=null,$dp2=null,$bv2=null,$invoice2=null,$date1=null,$date2=null){

  $invoices = [];
  $invoice = array(
   'DP'=>$dp1,
   'BV'=>$bv1,
   'Invoice'=>$invoice1,
   'Date'=>$date1,
  );
  array_push($invoices,$invoice);
  $invoice = array(
   'DP'=>$dp2,
   'BV'=>$bv2,
   'Invoice'=>$invoice2,
   'Date'=>$date2,
  );
  array_push($invoices,$invoice);
  $data = array(
   'summary.'.$yyyymm.'.invoices'=>$invoices 
  );
  
  $conditions = array('mcaNumber'=>$mcaNumber);
  Savings::update($data,$conditions);
  $data = array(
   'summary.'.$yyyymm.'.dp'=>(integer)$dp1+(integer)$dp2,
   'summary.'.$yyyymm.'.pbv'=>(integer)$bv1+(integer)$bv2,
   'summary.'.$yyyymm.'.gbv' => (integer)$bv1+(integer)$bv2,
  );
  
  Users::update($data,$conditions);

     $function = new Functions();
     $function->addnotify($mcaNumber,"Invoice prepared","We have prepared an invoice on your MCA number ".$mcaNumber.". It will be emailed to you.");

  
  
     $getParents = $this->getParents((string)$mcaNumber)  ;
     foreach($getParents as $p){
      $data = array('$inc' => array('summary.'.$yyyymm.'.gbv' => (integer)$bv1+(integer)$bv2));
      $conditions = array('mcaNumber'=>$p['mcaNumber']);
      Users::update($data,$conditions);

      $function = new Functions();
      $function->addnotify($p['mcaNumber'],"GBV updated","We have prepared an invoice on your downline MCA ".$mcaNumber.". Your GBV is updated.");
      
     }
  
  
  return $this->render(array('json' => array("success"=>"Yes")));		
 }
 public function delivered($mcaNumber,$yyyymm){
  $data = array(
   'summary.'.$yyyymm.'.delivery'=>'Delivered',
   'summary.'.$yyyymm.'.delStatus'=>'50',
  );
  $conditions = array(
   'mcaNumber'=>$mcaNumber
  );
  Savings::update($data,$conditions);
  
  
     $data = array(
      'mcaNumber'=>$mcaNumber,
      'subtitle'=>"Order delivered",
      'title'=>"We have delivered your order. ",
     );
  
  
  return $this->redirect('/dashboard/orders');
 }
}
?>