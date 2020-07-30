<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use \lithium\data\Model;
use app\extensions\action\Functions;
use app\extensions\action\GoogleAuthenticator;
use app\controllers\DashboardController;
//use app\extensions\action\Google;
use lithium\data\Connections;
use \MongoRegex;
use app\models\Videos;
class WevController extends \lithium\action\Controller {


 protected function _init() {
  parent::_init();
//  $user = Session::read('default');
  // if($user==null){
   // return $this->redirect('/savings');
  // }
  $this->_render['layout'] = 'savings';
 }
	public function index(){
		return $this->render(array('json' => array("success"=>"Yes",'data'=>$user)));
	}

	public function uploadvideo(){
		return $this->render(array('json' => array("success"=>"Yes",'data'=>$this->request->data)));
	}

	public function getVideos(){
			if($this->request->data){
			$mcaNumber = $this->request->data['mcaNumber'];
			$targetFolder = '/app/webroot/img/videos/';
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			$files = scandir($targetPath);
			$myfiles = array();
					foreach($files as $f){
						if($f!="." && $f!=".."){
							array_push($myfiles,array('file'=>$f));
						}
					}
		}

		
		return $this->render(array('json' => array("success"=>"Yes",'data'=>$myfiles)));
	}

public function savevideo(){

	ini_set('max_input_time', -1);
	ini_set('max_execution_time', -1);
	ini_set('memory_limit','-1');




	if($this->request->data){
		$mcaNumber = $this->request->data['VideomcaNumber'];
		$base64 = $this->request->data['outputVideo'];
		
		$video = str_replace('data:video/mp4;base64,', '', $base64);
		$video = str_replace(' ', '+', $video);
		$fileData = base64_decode($video);
		//saving
		$videoFolder = '/app/webroot/img/videos/';		
		$videoPath = $_SERVER['DOCUMENT_ROOT'] . $videoFolder;
		$videoTime = round(microtime(true));
		$fileName = $videoPath . $mcaNumber.'-'.$videoTime.'.mp4';
		file_put_contents($fileName, $fileData);
		
		$data = array(
			'mcaNumber'=>$mcaNumber,
			'image'=> $fileName,
			'DateTime' => new \MongoDate,
			'VideoTime'=>$videoTime
		);
		Videos::create()->save($data);
	
	}
		return $this->render(array('json' => array("success"=>"Yes",'video'=>$data)));
}

public function yt(){
	
$client = new Google_Client();
$client->setApplicationName('YouTube');
$client->setScopes([
    'https://www.googleapis.com/auth/youtube.upload',
]);

// TODO: For this request to work, you must replace
//       "YOUR_CLIENT_SECRET_FILE.json" with a pointer to your
//       client_secret.json file. For more information, see
//       https://cloud.google.com/iam/docs/creating-managing-service-account-keys
$client->setAuthConfig();
$client->setAccessType('offline');

// Request authorization from the user.
$authUrl = $client->createAuthUrl();
printf("Open this link in your browser:\n%s\n", $authUrl);
print('Enter verification code: ');
$authCode = trim(fgets(STDIN));

// Exchange authorization code for an access token.
$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
$client->setAccessToken($accessToken);

// Define service object for making API requests.
$service = new Google_Service_YouTube($client);

// Define the $video object, which will be uploaded as the request body.
$video = new Google_Service_YouTube_Video();

// Add 'snippet' object to the $video object.
$videoSnippet = new Google_Service_YouTube_VideoSnippet();
$videoSnippet->setCategoryId('22');
$videoSnippet->setDescription('Description of uploaded video.');
$videoSnippet->setTitle('Test video upload.');
$video->setSnippet($videoSnippet);

// Add 'status' object to the $video object.
$videoStatus = new Google_Service_YouTube_VideoStatus();
$videoStatus->setPrivacyStatus('private');
$video->setStatus($videoStatus);

// TODO: For this request to work, you must replace "YOUR_FILE"
//       with a pointer to the actual file you are uploading.
//       The maximum file size for this operation is 137438953472.
$content = file_get_contents("php://input", false, stream_context_create($arrContextOptions));
$update = json_decode($content, true);
print_r($update);
$response = $service->videos->insert(
  'snippet,status',
  $video,
  array(
    'data' => file_get_contents("YOUR_FILE"),
    'mimeType' => 'application/octet-stream',
    'uploadType' => 'multipart'
  )
);
print_r($response);

}
//end of class
}


