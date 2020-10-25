<?php
namespace app\controllers;

use app\models\Outlines;



 class OutlineController extends \lithium\action\Controller {

  protected function _init() {
   parent::_init();
   $this->_render['layout'] = 'outline';
   $this->set(array('title'=>'Outlines'));
  }

  public function index($_id=null){
   if($this->request->data){		
    $post = $this->request->data['post'];
    
    switch($post){
     case 'add':
     $data = array(
          'outline_name' => $this->request->data['outline_name'],
          'outline_text' => $this->request->data['outline_text'],
          'outline_description' => $this->request->data['outline_description'],
          'outline_order' => $this->request->data['outline_order'],
          'outline_video' => $this->request->data['outline_video'],
          'outline_audio' => $this->request->data['outline_audio'],									
          'outline_image' => $this->request->data['outline_image'],									
          'outline_pdf' => $this->request->data['outline_pdf'],									
          'outline_url' => $this->request->data['outline_url'],
          'DateTime' => new \MongoDate(),
          'outline_refer_id' => $this->request->data['outline_refer'],
         );				
         
     $this->addOutline($data);
     break;
     
     case 'edit':
      $data = array(
          'outline_name' => $this->request->data['outline_name'],
          'outline_text' => $this->request->data['outline_text'],
          'outline_description' => $this->request->data['outline_description'],
          'outline_order' => $this->request->data['outline_order'],
          'outline_video' => $this->request->data['outline_video'],
          'outline_audio' => $this->request->data['outline_audio'],									
          'outline_image' => $this->request->data['outline_image'],									
          'outline_pdf' => $this->request->data['outline_pdf'],									
          'outline_url' => $this->request->data['outline_url'],
          'DateTime' => new \MongoDate(),
          'outline_refer_id' => $this->request->data['outline_refer'],
         );		
         
     $conditions = array('_id'=>(string)$this->request->data['_id']);
     Outlines::update($data,$conditions);
     return $this->redirect('/outline');
     break;
     
    }
   
   }
   
   $outline = Outlines::find('first',array(
    'conditions'=>array('_id'=>(string)$_id)
   ));
   
   $data = Outlines::find('all',array(
     'fields'=>array('outline_name','_id','ancestors_names','outline_text','outline_description'),
     'order'=>array('left'=>'ASC')
   ));
   
   return compact('data','outline');
   
  }
  
  public function delete($_id=null){
   $conditions = array('_id'=>(string)$_id);
   Outlines::remove($conditions);
   
   return $this->redirect('/outline');
   
  }

 function AddOutline($data){
   if($data){
    if($data['outline_name']!="" ){
      $refer = Outlines::first(array(
       'conditions'=>array('_id'=>(string)$data['outline_refer_id'])
      ));
     if(count($refer)>0){
       $refer_ancestors = $refer['ancestors'];
       $refer_ancestors_name = $refer['ancestors_names'];
        $ancestors = array();
        $ancestors_names = array();
        if(count($refer_ancestors)>0){
         foreach ($refer_ancestors as $ra){
          array_push($ancestors, $ra);
         }
        }
        if(count($refer_ancestors_name)>0){
         foreach ($refer_ancestors_name as $ra){
          array_push($ancestors_names, $ra);
         }
        }

      $refer_id = (string) $refer['_id'];
      $refer_name = (string) $refer['outline_name'];

      array_push($ancestors,$refer_id);
      array_push($ancestors_names,$refer_name);
      
      $refer_left = (integer)$refer['left'];
      $refer_left_inc = (integer)$refer['left'];
      
      Outlines::update(
       array(
        '$inc' => array('right' => (integer)2)
       ),
       array('right' => array('>'=>(integer)$refer_left_inc)),
       array('multi' => true)
      );
      Outlines::update(
       array(
        '$inc' => array('left' => (integer)2)
       ),
       array('left' => array('>'=>(integer)$refer_left_inc)),
       array('multi' => true)
      );
      
      
      $newData = array(
          'outline_name' => $data['outline_name'],
          'outline_text' => $data['outline_text'],
          'outline_description' => $data['outline_description'],
          'outline_order' => $data['outline_order'],
          'outline_video' => $data['outline_video'],
          'outline_audio' => $data['outline_audio'],									
          'outline_image' => $data['outline_image'],									
          'outline_pdf' => $data['outline_pdf'],									
          'outline_url' => $data['outline_url'],
          'DateTime' => new \MongoDate(),
          'outline_refer_id' => $data['outline_refer_id'],
          'left'=>(integer)($refer_left+1),
          'right'=>(integer)($refer_left+2),
          'ancestors'=> $ancestors,
          'ancestors_names'=> $ancestors_names,
      );
      
      Outlines::create()->save($newData);
      return true;
     }else{
      return false;
     }
    }
  }	
 }




}
?>