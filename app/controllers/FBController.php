<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use \lithium\data\Model;

use app\models\Participants;
use app\models\Users;
class FBController extends \lithium\action\Controller {
 public function index(){
  
 $this->_render['layout'] = 'sale';
 }
 public function post($mcaNumber=null,$img1="",$img2=""){
  
  $this->_render['layout'] = 'sale';
  $user = Users::find('first',array(
   'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
  ));
  
  $x=$y=1000;
  header('Content-Type: image/png');
  $imageFolder = '/app/webroot/img/fbposts/';
  $postFolder = '/app/webroot/img/post/';
  $targetFolder = '/app/webroot/img/fbposts/';
  $fontFolder = '/';
  $imagePath = $_SERVER['DOCUMENT_ROOT'] . $imageFolder;
  $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
  $postPath = $_SERVER['DOCUMENT_ROOT'] . $postFolder;

  $img1 = $imagePath.$img1.".png";
  $img2 = $postPath.$img2.".png";  
  $outputImage = imagecreatetruecolor(1000, 1000);
  
  print_r($img2);
  $first = imagecreatefrompng($img1);
  $second = imagecreatefrompng($img2);
//imagecopy ( $dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w , $src_h );
  
  imagecopy($outputImage,$first, 20,20,0,0, 400,400);
  imagecopy($outputImage,$second,40,40,0,0, 500,500);
  
  
  
  
  $white = imagecolorallocate($outputImage, 255, 255, 255);
  $black = imagecolorallocate($outputImage, 0, 0, 0);
  imagefill($outputImage, 0, 0, $black);
  
  $filename=$mcaNumber."-".round(microtime(true)).'.png';
  imagepng($outputImage, $targetPath . $filename);
  imagedestroy($outputImage);
  
  
  
  return compact('user','filename');
  
 }
 
}
?>