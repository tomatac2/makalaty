<?php
declare(strict_types=1);

namespace App\Controller\Api;
use Cake\Datasource\FactoryLocator;
use Cake\View\Helper\PaginatorHelper ;

class CommentsController extends AppController
{

   public function initialize(): void
{
    parent::initialize();
    $this->Authentication->allowUnauthenticated(['activeAndBlock','index']);
}

 

// ////////index/////////
public function index()
{
   $jwtData = FactoryLocator::get('Table')->get('Users')->jwtData(); 
   $userModel =  FactoryLocator::get('Table')->get('Users') ; 
   if($jwtData && $jwtData->user_group == "admin"):
     
       //get all records from DB
       $this->paginate =  [
         'limit' => 5 ,
         'order'=> ['Comments.id'=>'DESC' ] //id
        ] ;
      $index = $this->paginate($this->Comments);
      $pagination = $this->request->getAttribute('paging')['Comments'];

       if($index){
         $msg = "عرض كل التعليقات"  ; $success = true ;   $data = $index ; 
      } else{
         //not found
         $msg = "لايوجد تعليقات";   $success = false ; $data = json_decode("[]");  // {} == 1  [] > 1
      }
   

   else :   $msg = "غير مسموح الدخول لهذه الصفحة"  ; $success = false ; $data = json_decode("{}");
      
   endif;

    
   // fixed response in all functions
   $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data , "pagination"=>$pagination ];   
   $this->set(['response' => $response]);
   $this->viewBuilder()->setOption('serialize', true);
   $this->RequestHandler->renderAs($this, 'json');
}

 

// ////////activeAndBlock/////////
public function activeAndBlock($id)
{
   $jwtData = FactoryLocator::get('Table')->get('Users')->jwtData(); 
   $userModel =  FactoryLocator::get('Table')->get('Users') ; 
   if($jwtData && $jwtData->user_group == "admin"):
     
      //get record from DB
      $checkCommentStatus = $this->Comments->get($id) ;
      if($checkCommentStatus){
      
        if($checkCommentStatus->status == "active") :
            $msg = "تم حظر التعليق بنجاح"  ;
            $status = "inactive";
        else :   
               $msg = "تم تنشيط التعليق بنجاح"  ; 
               $status = "active";
         endif;
         //update status on DB
         $checkCommentStatus->status = $status ; 
         $this->Comments->save($checkCommentStatus);

         $success = true ;   $data = $checkCommentStatus ; 
      } else{
         //not found
         $msg = "التعليق غير موجود";   $success = false ; $data = json_decode("{}");
      }
   

   else :   $msg = "غير مسموح الدخول لهذه الصفحة"  ; $success = false ; $data = json_decode("{}");
      
   endif;

    
   // fixed response in all functions
   $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data];   
   $this->set(['response' => $response]);
   $this->viewBuilder()->setOption('serialize', true);
   $this->RequestHandler->renderAs($this, 'json');
}




 
}







