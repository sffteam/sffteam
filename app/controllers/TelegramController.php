<?php 
namespace app\controllers; 
use app\models\Telegrams; 
use app\models\Users; 
use app\models\Malls;
use app\models\Mobiles;
use app\models\Distributors;

// API TOKEN 


 class TelegramController extends \lithium\action\Controller {
 public function run($botURL){
		
if($botURL != TELEGRAM){return "False";}
define('API_URL', 'https://api.telegram.org/bot'.TELEGRAM.'/');
define('LITHIUM_WEBROOT_PATH', str_replace("\\","/",str_replace("F:","",dirname(LITHIUM_APP_PATH))) . '/app/webroot');
  $arrContextOptions=array(
   "ssl"=>array(
   "verify_peer"=>false,
   "verify_peer_name"=>false,
  ),
 );
  $content = file_get_contents("php://input", false, stream_context_create($arrContextOptions));
  $update = json_decode($content, true);
  $parse_mode="HTML";
		
if (isset($update["message"])) {
	
  $this->processMessage($update["message"]);
} else if (isset($update["callback_query"])){
    $callbackQuery = $update["callback_query"];
    $queryId = $callbackQuery["from"]["id"];
    $data = $callbackQuery["data"];
    $this->apiRequest("sendMessage", array('chat_id' => $queryId, "text" => $data, "parse_mode"=>$parse_mode));

} else if (isset($update["inline_query"])) {
    $inlineQuery = $update["inline_query"];
    $queryId = $inlineQuery["id"];
    $queryText = $inlineQuery["query"];
    $queryFrom = $inlineQuery["from"]["first_name"]. " " . $inlineQuery["from"]["last_name"]. " (".$inlineQuery["from"]["username"].")";
     $message_text = $queryFrom . "
You can type
[DP Location] or
[EVENT <Date YYYY-MM-DD> <Venue> <City> <State> <Person> 'String']
";

    if (isset($queryText) && $queryText !== "") {
      $this->apiRequestJson("answerInlineQuery", [
        "inline_query_id" => $queryId,
        "results" => $this->queryInline($queryText,$queryId,$messageText),
        "cache_time" => 86400,
      ]);
    } else {
      $this->apiRequestJson("answerInlineQuery", [
       "inline_query_id" => $queryId,
       "cache_time"=>5,
       "results" => [
          [
            "type" => "article",
            "id" => "0",
            "title" => "ProductCode",
            "message_text" => "@indianeaglesteam_bot DP Satellite",
          ],
          [
            "type" => "article",
            "id" => "1",
            "title" => "Offer",
            "message_text" => "/offer",
          ],

        ]
      ]);
    }
}
  //return "OK"; 
   return $this->render(array('layout' => false));
}

function queryInline($queryText,$queryId,$messageText) {

 $start = substr($queryText,0,strpos($queryText," "));
 /////////////////////////////////////////////////////

   $this->apiRequestJson("answerInlineQuery", [
       "inline_query_id" => $queryId,
       "results" => [
          [
            "type" => "article",
            "id" => "0",
            "title" => $start,
            "message_text" => $start,
          ],
        ]
      ]);
      
 /////////////////////////////////////////////////////





  
  if(!$start){ return [[
    "type" => "article",
    "id" => "0",
    "title" => "Type any of the following:",
    "message_text" => $messageText,
  ]];
  } else if(strtolower($start)==='dp'){
   $results = [
	"textContent"=>1,
	"textContent"=>2,
	];
  }
  foreach ($results as $result) {
    $titles[] = trim($result[textContent]);
  }
  
  foreach ($results as $result) {
    $snippets[] = trim($result[textContent]);
  }
  
  foreach ($results as $result) {
    $urls[] = trim($result[textContent]);
  }
  
  foreach (range(0, count($titles) - 1) as $i) {
    $collection[] = [
      "type" => "article",
      "id" => "$i",
      "title" => "$titles[$i]",
      "message_text" => "$titles[$i]\n$snippets[$i]\n$urls[$i]",
    ];
  }
  
  return $collection;
}
 public function curl_get_contents($url){
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_HEADER, 0);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_URL, $url);
   $data = curl_exec($ch);
   curl_close($ch);
   return $data;
 }
function apiRequestWebhook($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  $parameters["method"] = $method;
  header("Content-Type: application/json");
  echo json_encode($parameters);
  return true;
}
function exec_curl_request($handle) {
  $response = curl_exec($handle);
  if ($response === false) {
    $errno = curl_errno($handle);
    $error = curl_error($handle);
    error_log("Curl returned error $errno: $error\n");
    curl_close($handle);
    return false;
  }
  $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
  curl_close($handle);
  if ($http_code >= 500) {
    // do not wat to DDOS server if something goes wrong
    sleep(10);
    return false;
  } else if ($http_code != 200) {
    $response = json_decode($response, true);
    error_log("Request has failed with error {$response['error_code']}: {$response['description']}\n");
    if ($http_code == 401) {
      throw new Exception('Invalid access token provided');
    }
    return false;
  } else {
    $response = json_decode($response, true);
    if (isset($response['description'])) {
      error_log("Request was successfull: {$response['description']}\n");
    }
    $response = $response['result'];
  }
  return $response;
}
function apiRequest($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }
  $url = API_URL.$method.'?'.http_build_query($parameters);
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_SAFE_UPLOAD, false);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  return $this->exec_curl_request($handle);
}
function apiRequestPhoto($method,$photo, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }

  $url = API_URL.$method.'?'.http_build_query($parameters);
print_r($url);
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  curl_setopt($handle, CURLOPT_SAFE_UPLOAD, false);
  curl_setopt($handle, CURLOPT_INFILESIZE, filesize($photo));
  return $this->exec_curl_request($handle);
}

function apiRequestJson($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  $parameters["method"] = $method;
  $handle = curl_init(API_URL);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
  curl_setopt($handle, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
  return $this->exec_curl_request($handle);
}
function processMessage($message) {
  // process incoming message
  $message_id = $message['message_id'];
  $chat_id = $message['chat']['id'];
  if (isset($message['text'])) {
    // incoming text message
    $text = $message['text'];
$userName = $message['chat']['first_name'] . " " . $message['chat']['last_name'] . " (".$message['chat']['username'].")";
$ReplyText = "Hi ".$userName.",
<b>IndianEagles.Team</b> welcomes you.
We provide with the following details:
|- DP Distributor Points search
|- Event Information
|- MCA number search
|- Name search  
Select one from DP, Events, MCA, Name
";
$parse_mode="HTML";
//$userName = $inlineQuery["from"]["first_name"]. " " . $inlineQuery["from"]["last_name"]. " (".$inlineQuery["from"]["username"].")";
		$this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $message, "parse_mode"=>$parse_mode));
    if (strpos(strtolower($text), "mca") === 0){
      $commands = split(" ", $text);
      $ReplyText = $this->getMCA($commands[1],$userName);
      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode));
    }else if (strpos(strtolower($text), "name") === 0){
      $commands = split(" ", $text);
      $ReplyText = $this->getName($commands[1],$userName);
      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode));
    }else if (strpos(strtolower($text), "event") === 0){
      $commands = split(" ", $text);
      $ReplyText = $this->getEvent($commands[1],$userName);
      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode));
    }else if (strpos(strtolower($text), "events") === 0){
      $commands = split(" ", $text);
      $ReplyText = $this->getEvents($commands[1],$userName);
      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode));
    }else if (strpos($text, "test") === 0) {
      $inline_button1 = array("text"=>"Google url","url"=>"http://google.com");
      $inline_button2 = array("text"=>"Month","switch_inline_query"=>'June');
      $inline_keyboard = [[$inline_button1,$inline_button2]];
      $keyboard=array("inline_keyboard"=>$inline_keyboard);
      $replyMarkup = json_encode($keyboard); 
       $this->apiRequestJson("sendMessage", array('chat_id' => $chat_id, "parse_mode"=>$parse_mode, "text" => $ReplyText, 
       'reply_markup' => array(
        'inline_keyboard' => $inline_keyboard,
        'resize_keyboard' => true)));
    }else  if (strpos($text, "/start") === 0) {
     $this->apiRequestJson("sendMessage", array('chat_id' => $chat_id, "parse_mode"=>$parse_mode, "text" => $ReplyText, 
       'reply_markup' => array(
       'keyboard' => array(array('Products','Offers','Distributor','Event')),
       'one_time_keyboard' => true,
       'resize_keyboard' => true)));
    }else if($text === "Products"){
$ReplyText = "Hi ".$userName.",
<b>Products</b>
Use / command to select the product code,

or /start to go back to options
";

      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode));
    }else if($text === "Offers"){
$ReplyText = "Hi ".$userName.",
<b>Offers</b>
Select one of the following:
|- NewJoinee - Offer for New Joinee
|- Repurchase - Offer for Repurchase program
|- SpecialOffer - Special Offers available every month

or /start to go back to options
";
      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode,
       'reply_markup' => array(
        'keyboard' => array(array('NewJoinee','Repurchase','SpecialOffer')),
        'one_time_keyboard' => true,
        'resize_keyboard' => true)));

     }
     else if($text === "NewJoinee"){}
     else if($text === "Repurchase"){}
     else if($text === "SpecialOffer"){}
     else if($text === "Distributor"){
$ReplyText = "Hi ".$userName.",
<b>Disributor</b>
To search a Distributor, you have to write DP [AREA] to search the DPs
|- DP [AREA]

or /start to go back to options
";
      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode));

     }
     else if(strtoupper(substr($text,0,2)) === "DP"){
$searchText = substr($text,2,strlen($text));
if(strlen($searchText)<3){
	$ReplyText = "Hi ".$userName.",
<b>Disributor Point in ".substr($text,2,strlen($text))."</b>
Search city name should be more than 2 characters.";

      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode));
return "OK";
exit;
}
$ReplyText = "Hi ".$userName.",
<b>Disributor Point in ".substr($text,2,strlen($text))."</b>
";
$search = Distributors::find('all',array(
 'conditions'=>array('City'=>array('$regex'=>''.trim($searchText).'','$options'=>'i'))
));
$distributor = "
";
foreach ($search as $s){
$distributor = $distributor . $s['Address'];
$distributor = $distributor . "
";
$distributor = $distributor . $s['City']; 
$distributor = $distributor . " - ";
$distributor = $distributor . $s['State'];
$distributor = $distributor . "
";
$distributor = $distributor . $s['Mobile'];
$distributor = $distributor . "
";
$distributor = $distributor . "
";
}
$ReplyText = $ReplyText . $distributor."
or /start to go back to options";


      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode));
     }
     else if($text === "Consultant"){
      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode));
     }
     else if ($text === "Hello" || $text === "Hi") {
//      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => 'Nice to meet you'));
    } else if (strpos($text, "/stop") === 0) {
      // stop now
    } else {
      $productCode = strtoupper(substr($text,1,strlen($text)));
      $ReplyText = $this->getProduct($productCode,$userName);
      $ReplyTextBase = $this->getProductBase($productCode,$userName);
      $ReplyTextDP = $this->getProductNoDP($productCode,$userName);				

      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode));
      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyTextDP, "parse_mode"=>$parse_mode));

      $photo = LITHIUM_WEBROOT_PATH."/img/".strtoupper($productCode).".jpg";

      $this->UploadPhoto($productCode,$chat_id,$ReplyTextBase);
      $this->UploadProduct($productCode,$chat_id,$ReplyTextBase);



    }
  } else {
//    $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => 'I understand only text messages'));
  }
 }	

        public function getProductBase($productCode,$userName){
                $product = Products::find('first',array(
                        'conditions'=>array('Code'=>$productCode)
                ));
                if(count($product)!=0){
                        $text = "Product Code: ".$product['Code']. "
";
                        $text = $text . "Name: ".str_replace("-","",str_replace("&","",$product['Name'])). "
";
                        $text = $text . "Category: ".str_replace("-","",str_replace("&","",$product['Category'])). "
";
                        $text = $text . "Size: ".$product['Size']. "
";
                        $text = $text . "MRP: ".$product['MRP']. "
";
                        $text = $text . "DP: ".$product['DP']. "
";
                        $text = $text . "BV: ".$product['BV']. "

";
                        $text = $text . $userName. "

";
                }else{
                        if(strtolower(substr($productCode,0,2))=='bp'){
                                $text = "Business Plan";
                        }else{
//                                $text = "Product Not Found!";
                        }
                }
                return $text;
        }


	public function getProduct($productCode,$userName){
		$product = Products::find('first',array(
			'conditions'=>array('Code'=>$productCode)
		));
		if(count($product)!=0){
			$text = "Product Code: <b>".$product['Code']. "</b>
";
			$text = $text . "Name: <b>".str_replace("-","",str_replace("&","",$product['Name'])). "</b>
";
			$text = $text . "Category: ".str_replace("-","",str_replace("&","",$product['Category'])). "
";
			$text = $text . "Size: ".$product['Size']. "
";
			$text = $text . "MRP: ".$product['MRP']. "
";
			$text = $text . "DP: ".$product['DP']. "
";
			$text = $text . "BV: ".$product['BV']. "

";
			$text = $text . $userName. "

";
//			$text = $text . "<b>Description</b>: ".$product['Description']. "";
		}else{
			if(strtolower(substr($productCode,0,2))=='bp'){
				$text = "Business Plan";
			}else{
//				$text = "Product Not Found!";
			}
		}
		return $text;
	}
	public function getProductNoDP($productCode,$userName){
		$product = Products::find('first',array(
			'conditions'=>array('Code'=>$productCode)
		));
		if(count($product)!=0){
			$text = "Product Code: <b>".$product['Code']. "</b>
";
			$text = $text . "Name: <b>".str_replace("-","",str_replace("&","",$product['Name'])). "</b>
";
			$text = $text . "Category: ".str_replace("-","",str_replace("&","",$product['Category'])). "
";
			$text = $text . "Size: ".$product['Size']. "
";
			$text = $text . "MRP: ".$product['MRP']. "

";
			$text = $text . $userName. "

";			
		}else{
			if(strtolower(substr($productCode,0,2))=='bp'){
				$text = "Business Plan";
			}else{
//				$text = "Product Not Found!";
			}
		}
		return $text;
	}
	public function UploadPhoto($productCode,$message_id,$text){
		$photo = LITHIUM_WEBROOT_PATH."/img/".strtoupper($productCode).".jpg";
		$bot_url    = "https://api.telegram.org/bot".TELEGRAM."/";
		$url = $bot_url . "sendPhoto?chat_id=" . $message_id ;
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, array("photo"=>$this->curl_file_create($photo), "caption"=> $text)); 
		curl_setopt($ch, CURLOPT_INFILESIZE, filesize($photo));
		$output = curl_exec($ch);
		curl_close($ch);
	}
        public function UploadProduct($productCode,$message_id,$text){
                $photo = LITHIUM_WEBROOT_PATH."/product/".strtoupper($productCode).".jpg";
                $bot_url    = "https://api.telegram.org/bot".TELEGRAM."/";
                $url = $bot_url . "sendPhoto?chat_id=" . $message_id ;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, array("photo"=>$this->curl_file_create($photo), "caption"=> $text));
                curl_setopt($ch, CURLOPT_INFILESIZE, filesize($photo));
                $output = curl_exec($ch);
                curl_close($ch);
        }

function curl_file_create($filename, $mimetype = '', $postname = '') {
        return "@$filename;filename="
            . ($postname ?: basename($filename))
            . ($mimetype ? ";type=$mimetype" : '');
}


	function moneyFormatIndia($num) {
    $explrestunits = "" ;
    if(strlen($num)>3) {
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
            if($i==0) {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            } else {
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
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

function searchName($mcaName){
$commands = split(" ", $mcaName);
for($i = 1;$i<=count($commands[1]);$i++){
$name = $name . " ".$commands[$i];
}
//return($name);

				$users = Users::find('all',array(
					'conditions'=>array('mcaName'=>array('$regex'=>trim($name),'$options'=>'i')),
					'order'=>array('mcaName'=>'ASC')
				));
//				print_r(count($users));
				foreach($users as $user){
					$resultTable = $resultTable . $user['mcaName'].' - '.$user['mcaNumber'].' - '.$user['Mobile'].'
';
//					print_r($user['mcaName']);
				}
//				print_r($resultTable);
				return $resultTable;

}
	public function getMCA($mcaNumber){
		setlocale(LC_MONETARY, 'en_IN');
		$user = Users::find('first',array(
			'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
		));
		$count = $this->countChilds($mcaNumber);
		if(count($user)==1){
		$mobile = Mobiles::find('first',array(
			'conditions'=>array('mcaNumber'=>$mcaNumber)
		));
		}else{
			$mobile="";
			
		}
		$thismonth = date('Y-m',time());
		$text = "Hi ".$userName.",
MCA Number Search: <b>".$mcaNumber."</b>
";

		if(count($user)!=0){
			$text = "MCA Number: ".$user['mcaNumber']. "
";
			$text = $text . "MCA Name: ".$user['mcaName']. "
";
			$text = $text . "Joining Date: ".$user['DateJoin']. "
";
			$text = $text . "Downline: ".$count. "
";
			$text = $text . "Mobile: +91".$mobile['Mobile']. "
";
			// $text = $text . "Valid Title: ".$user[$thismonth]['ValidTitle']. "
// ";
			// $text = $text . "Paid as Title: ".$user[$thismonth]['PaidTitle']. "
// ";
			// $text = $text . "Percent: ".$user[$thismonth]['Percent']. "%
// ";
			// $text = $text . "PBV: ".$this->moneyFormatIndia($user[$thismonth]['BV']). "
// ";
			// $text = $text . "GBV: ".$this->moneyFormatIndia($user[$thismonth]['GBV']). "
// ";
			// $text = $text . "TGBV: ".$this->moneyFormatIndia($user[$thismonth]['TGBV']). "
// ";
			// $text = $text . "TCGBV: ".$this->moneyFormatIndia($user[$thismonth]['TCGBV']). "
// ";
			// $text = $text . "PGBV: ".$this->moneyFormatIndia($user[$thismonth]['PGBV']). "
// ";
			// $text = $text . "Roll Up: ".$this->moneyFormatIndia($user[$thismonth]['Rollup']). "
// ";
			// $text = $text . "Legs: ".$user[$thismonth]['Legs']. "
// ";
			// $text = $text . "Qualified Director Legs: ".$user[$thismonth]['QDLegs']. "
// ";
			// $text = $text . "NEFT: ".$user[$thismonth]['NEFT']. "
// ";
			// $text = $text . "Aadhar: ".$user[$thismonth]['Aadhar']. "
// ";
		}else{
			$text = "MCA No: ".$mcaNumber. " not found!";
		}
		return $text;
	}
public function getName($mcaName){
		setlocale(LC_MONETARY, 'en_IN');
		$users = Users::find('all',array(
					'conditions'=>array('mcaName'=>array('$regex'=>trim($mcaName),'$options'=>'i')),
     'order'=>array('mcaName'=>'ASC')
			));
		
		$thismonth = date('Y-m',time());
	$text = "Hi ".$userName.",
Name Search: <b>".$mcaName."</b>
";
  
		if(count($users)!=0){
   foreach ($users as $user){ 
			$text = $text . "MCA Number: ".$user['mcaNumber']. "
";
			$text = $text . "MCA Name: ".$user['mcaName']. "
";
			$text = $text . "Joining Date: ".$user['DateJoin']. "
";
			$text = $text . "Mobile: +91".$user['Mobile']. "
";
   $text = $text . "
";
   }
		}else{
			$text = "Name: ".$mcaName. " not found!";
		}
		return $text;
	}
}?>
