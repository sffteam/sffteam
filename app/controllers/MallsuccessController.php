<?php
namespace app\controllers;

use app\models\Orders;
use app\models\Malls;
use \lithium\template\View;
use app\extensions\action\Functions;

use \Swift_MailTransport;
use \Swift_Mailer;
use \Swift_Message;
use \Swift_Attachment;


class MallsuccessController extends \lithium\action\Controller {

 protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'savings';
 }

 public function index(){
//  $this->_render['layout'] = null;
 $save = "Yes";
$resphash = null;
$salt = PAYUMONEY_SALT;
$CalcHashString = null;
  $postdata = $_POST;
  $msg = '';
  if (isset($postdata ['key'])) {
   $productInfoEx = explode("-",$postdata['productinfo']);
   $mcaNumber = $productInfoEx[0];
   $conditions = array(
					'_id'=>$postdata['udf1']
			);
   
   $user = Orders::find('first',array(
    'conditions'=>$conditions
   ));
    $payUMoneyArray = [];
    $count = 0;
   if($user['payuMoney']){
    $count = count($user['payuMoney']);
    foreach($user['payuMoney'] as $p){
      $previousPayUMoney = array(
        'key'				=>   $p['key'],
        'salt'				=>   $p['salt'],
        'txnid' 				=> 	$p['txnid'],
        'amount'      		=> 	$p['amount'],
        'productInfo'  		=> 	$p['productinfo'],
        'firstname'    		=> 	$p['firstname'],
        'email'        		=>	$p['email'],
        'udf5'				=>   $p['udf5'],
        'udf1'				=>   $p['udf1'],
        'mihpayid'			=>	$p['mihpayid'],
        'status'				=> 	$p['status'],
        'date'     => $p['date'],
        'resphash'				=> 	$p['hash'],
        'CalcHashString'=>$p['CalcHashString'],
        'message'=>$p['message'],
      );
       array_push($payUMoneyArray,$previousPayUMoney);
     }
   }
   
   $key				=   $postdata['key'];
   $txnid 				= 	$postdata['txnid'];
   $amount      		= 	$postdata['amount'];
   $productInfo  		= 	$postdata['productinfo'];
   $firstname    		= 	$postdata['firstname'];
   $email        		=	$postdata['email'];
   $udf5				=   $postdata['udf5'];
   $udf1				=   $postdata['udf1'];
   $mihpayid			=	$postdata['mihpayid'];
   $status				= 	$postdata['status'];
   $resphash				= 	$postdata['hash'];
   $keyString 	  		=  	$key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'|'.$udf1.'||||'.$udf5.'|||||';
   $keyArray 	  		= 	explode("|",$keyString);
   $reverseKeyArray 	= 	array_reverse($keyArray);
   $reverseKeyString	=	implode("|",$reverseKeyArray);
   $CalcHashString 	= 	strtolower(hash('sha512', $salt.'|'.$status.'|'.$reverseKeyString));

   $newPayment = array(
       'key'				=>   $postdata['key'],
       'txnid' 				=> 	$postdata['txnid'],
       'amount'      		=> 	$postdata['amount'],
       'productInfo'  		=> 	$postdata['productinfo'],
       'firstname'    		=> 	$postdata['firstname'],
       'email'        		=>	$postdata['email'],
       'udf5'				=>   $postdata['udf5'],
       'udf1'				=>   $postdata['udf1'],
       'mihpayid'			=>	$postdata['mihpayid'],
       'status'				=> 	$postdata['status'],
       'date'     => gmdate('Y-M-d H:i:s'),
       'resphash'				=> 	$postdata['hash'],
       'CalcHashString'=>$CalcHashString,
       
   );
   array_push($payUMoneyArray,$newPayment);
   $pm = array('payuMoney'=>$payUMoneyArray);
   Orders::update($pm,$conditions);    
   
   if ($status == 'success' && $resphash == $CalcHashString) {
     $data = array('payuMoney.'.$count.'.approved' =>'Yes','payment.'.$count.'.approved' =>'Yes','payuMoney.'.$count.'.msg' =>'Hash Verified');
     Orders::update($data,$conditions);    
     
     // $function = new Functions();
     // $function->addmallnotify($mcaNumber,"Payment received Rs. ".$postdata['amount'],"We have received your payment through PayUMoney transaction ID: ". $postdata['txnid']);
     
   }else if ($status == 'success'){
     $data = array('payuMoney.'.$count.'.approved' =>'Yes','payment.'.$count.'.approved' =>'Yes','payuMoney.'.$count.'.msg' =>'Hash Not Verified');
     Orders::update($data,$conditions);    
     // $function = new Functions();
     // $function->addmallnotify($mcaNumber,"Payment received Rs. ".$postdata['amount'],"We have received your payment through PayUMoney transaction ID: ". $postdata['txnid']);
   }else if ($status != 'success'){
    $data = array('payuMoney.'.$count.'.approved' =>'No','payuMoney.'.$count.'.msg' =>'Hash Incorrect');
    Orders::update($data,$conditions);   
				// $function = new Functions();
    // $function->addmallnotify($mcaNumber,"Payment not complete Rs. ".$postdata['amount'],"Your payment is canceled/not authorized transaction ID: ". $postdata['txnid']);
   }else{
    $save = "No";
   }
       
 
    if ($status == 'success'){
      //create PDF Agreement based on payment.
      
      
      // $print = $this->createPDF($productInfoEx[0]);
      // $function = new Functions();
      // $function->addmallnotify($productInfoEx[0],"Order","Order created!");
      
      
      //send email to user code
      /////////////////////////
      // $sendemail = $this->sendEmailTo($postdata['email'],$productInfoEx[0]);
    }
//     return $this->render(array('json' => array("success"=>$data)));		      
    			return compact('postdata');		
  }
 }
 
 public function printpdf($mcaNumber){
    $print = $this->createPDF($mcaNumber);
    
    return $this->redirect('/dashboard/');
 }

 public function sendemail($email,$mcaNumber){
    $print = $this->sendEmailTo($email,$mcaNumber);
       return $this->render(array('json' => array("success"=>$print)));		      
//    return $this->redirect('/dashboard/');
 }
 
 private function sendEmailTo($email,$mcaNumber){
 					$emaildata = array(
						'mcaNumber' => $mcaNumber,
						'email' => $email
					);
     $agreement = Orders::find('first',array(
      'conditions'=>array(
      'mcaNumber'=>$mcaNumber
      )
     ));
						$function = new Functions();
						$compact = array('data'=>$emaildata,'agreement'=>$agreement);
						$from = array(NOREPLY => "noreply@sff.team");
						$email = $email;
      $attach = OUTPUT_DIR.$agreement['mcaNumber'].'-'.gmdate("Y-M-d",hexdec(substr($agreement['_id'], 0, 8)))."-Agreement".".pdf";
						$function->sendEmailTo($email,$compact,'success','sendagreement',"SFF - Agreement",$from,'','','',$attach);
//    sendEmailTo($email, $compact ,$controller,$template,$subject,$from,$mail1,$mail2 ,$mail3,$attach )
}
 
 private function createPDF($mcaNumber){
  $agreement = Orders::find('first',array(
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
		compact('agreement'),
		array(
			'controller' => 'print',
			'template'=>'printAgreement',
			'type' => 'pdf',
			'layout' =>'AgreementPrint'
		)
		);	
  
  return true;
 }
}
?>