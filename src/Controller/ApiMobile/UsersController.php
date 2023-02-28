<?php
declare(strict_types=1);

namespace App\Controller\ApiMobile;
use Cake\Datasource\FactoryLocator;
 
class UsersController extends AppController
{

   public function initialize(): void
{
    parent::initialize();
    $this->Authentication->allowUnauthenticated(['register','login','profile']);
}


public function profile(){
   $jwtData = FactoryLocator::get('Table')->get('Users')->jwtData(); 
   $userModel =  FactoryLocator::get('Table')->get('Users') ; 
   if($jwtData && $jwtData->user_group == "user"):

      $msg = "الملف الشخصى"  ; $success = true ; 
      $data = [
         "id"=> $jwtData->id ,
         "username"=> $jwtData->username ,
         "email" => $jwtData->email ,
      ];


   else :   $msg = "غير مسموح الدخول لهذه الصفحة"  ; $success = false ; $data = json_decode("{}");
   endif;

    
   // fixed response in all functions
   $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data ];   
   $this->set(['response' => $response]);
   $this->viewBuilder()->setOption('serialize', true);
   $this->RequestHandler->renderAs($this, 'json');

}
public function register()
{
   $req = $this->request->getData();
   $fields=[
      "username"=>$req["username"],
      "email"=>$req["email"],
      "password"=>$req["password"],
   ];
   $newUser = $this->Users->newEmptyEntity();
   $newUser = $this->Users->patchEntity($newUser,$fields,["validate"=>"register"]);
   if($this->Users->save( $newUser )):
      $success = true ; $msg = "تم تسجيل حسابك بنجاح"; $data = $newUser;
   else :   
         $success = false ; 
         $msg = $this->Users->getDbErrors($newUser->getErrors()) ;  
         $data = json_decode("{}");
   endif;

   // fixed response in all functions
   $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data];   
   $this->set(['response' => $response]);
   $this->viewBuilder()->setOption('serialize', true);
   $this->RequestHandler->renderAs($this, 'json');
}


public function login()
{
   //echo 2 ; exit ; 
    $result = $this->Authentication->getResult();
    if ($result->isValid()) {
      $msg = "تم تسجيل الدخول بنجاح"  ; $success = true ; 
      
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
     $msg = "خطأ فى البريد الاكترونى او كلمة المرور"  ; $success = false ; $data = json_decode("{}");
    }

   // fixed response in all functions
   $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data];   
   $this->set(['response' => $response]);
   $this->viewBuilder()->setOption('serialize', true);
   $this->RequestHandler->renderAs($this, 'json');
}



 
}
