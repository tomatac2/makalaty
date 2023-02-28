<?php
declare(strict_types=1);

namespace App\Controller\Api;
use Cake\Datasource\FactoryLocator;
 
class UsersController extends AppController
{

   public function initialize(): void
{
    parent::initialize();
    $this->Authentication->allowUnauthenticated(['login','index']);
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
         'order'=> ['Users.id'=>'DESC' ] //id
        ] ;
      $index = $this->paginate($this->Users);
      $pagination = $this->request->getAttribute('paging')['Users'];

       if($index){
         $msg = "قائمة  المستخدمين"  ; $success = true ;   $data = $index ; 
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


public function login()
{
    $result = $this->Authentication->getResult();
    if ($result->isValid()) {
      $msg = "user login"  ; $success = true ; 
      
      $identity = $this->request->getAttribute('identity');
      $data = [
         "id"=> $identity->id , 
         "username"=> $identity->username , 
         "email"=> $identity->email , 
         "user_group"=> $identity->user_group , 
      ] ; 

      //tablereigtry "orm"
      $userModel = FactoryLocator::get('Table')->get('Users'); 
      $data["token"] = $userModel->jwtToken($data);
      


    }else{
     $msg = "wrong email or password"  ; $success = false ; $data = json_decode("{}");
    }

   // fixed response in all functions
   $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data];   
   $this->set(['response' => $response]);
   $this->viewBuilder()->setOption('serialize', true);
   $this->RequestHandler->renderAs($this, 'json');
}



 
}
